<?php
namespace App\Http\Controllers;
// use Illuminate\Support\Facades\Cache; 

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Http\Request;
use App\Models\ {
	User
};

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'verifyotp']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    // public function login()
    // {
    //     $credentials = request(['mobile_number']); // Include 'password' field

    //     if (! $token = auth()->attempt($credentials)) {
    //         return response()->json(['error' => 'Unauthorized'], 401);
    //     }

    //     return $this->respondWithToken($token);
    // }
    // public function login(Request $request){
    //     try {
    //         // $credentials = request()->validate([
    //         //     'mobile_number' => ['required', 'string', 'digits:10', 'regex:/^[6-9]\d{9}$/']
    //         // ]);
                  
    //         $all_data_validation = [
    //             'mobile_number' => ['required', 'digits:10', 'regex:/^[6789]\d{9}$/'],
    //         ];

    //         $customMessages = [
    //             'mobile_number.required' => 'Mobile number is required.',
    //             'mobile_number.digits' => 'Mobile number must be 10 digits.',
    //             'mobile_number.regex' => 'Mobile number must start with 9, 8, 7 or 6.',
    //         ];
    
    //         $validator = Validator::make($request->all(), $all_data_validation, $customMessages);
          
    //        if ($validator->fails()) {
    //             $errors = $validator->errors()->all();
    //             $errorMessage = implode(" \n ", $errors);
    //             return response()->json([
    //                 'status' => 'false',
    //                 'message' => 'Validation Fail: ' . $errorMessage,
    //             ], 200);
    //         }
    
    //         // Check if user exists with the provided mobile number
    //         $user = User::where('mobile_number', $credentials['mobile_number'])->first();
            
    //         if(!$user) {
    //             // If user doesn't exist, create a new one
    //             $user = new User();
    //             $user->mobile_number = $credentials['mobile_number'];
    //         }
    
    //         // $otp = mt_rand(1000, 9999); 
    //         $otp = "1234";
    //         $user->user_otp = $otp;
    //         $user->save();
            
    //         $token = auth()->login($user);
    
    //         $user->update(['remember_token' => $token]);
            
    //         return response()->json([
    //             'status' => 'true',
    //             'message' => 'Login successful',
    //             'data' => $user,
    //             'token' => $token,
    //             'token_type' => 'bearer',
    //             'expires_in' => auth()->factory()->getTTL() * 60
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json(['status' => 'false','message' => 'Login fail', 'error' => $e->getMessage()], 500);
    //     }
    // }
    public function login(Request $request){
        try {
            $all_data_validation = [
                'mobile_number' => ['required', 'digits:10', 'regex:/^[6789]\d{9}$/'],
            ];
    
            $customMessages = [
                'mobile_number.required' => 'Mobile number is required.',
                'mobile_number.digits' => 'Mobile number must be 10 digits.',
                'mobile_number.regex' => 'Mobile number must start with 9, 8, 7 or 6.',
            ];
    
            $validator = Validator::make($request->all(), $all_data_validation, $customMessages);
    
            if ($validator->fails()) {
                $errors = $validator->errors()->all();
                $errorMessage = implode(" \n ", $errors);
                return response()->json([
                    'status' => 'false',
                    'message' => 'Validation Fail: ' . $errorMessage,
                ], 200);
            }
    
            // Fetch mobile number directly from request
            $mobileNumber = $request->input('mobile_number');
    
            // Check if user exists with the provided mobile number
            $user = User::where('mobile_number', $mobileNumber)->first();
    
            if(!$user) {
                // If user doesn't exist, create a new one
                $user = new User();
                $user->mobile_number = $mobileNumber;
            }
    
            $otp = "1234"; // Generate your OTP here
            $user->user_otp = $otp;
            $user->save();
    
            $token = auth()->login($user);
    
            $user->update(['remember_token' => $token]);
    
            return response()->json([
                'status' => 'true',
                'message' => 'Login successful',
                'data' => $user,
                'token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL() * 60
            ]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'false','message' => 'Login fail', 'error' => $e->getMessage()], 500);
        }
    }
    
    
    public function verifyOTP(Request $request){
        try {
            // Validate the request data
            $request->validate([
                'mobile_number' => 'required|string',
                'user_otp' => 'required|string'
            ]);
    
            // Retrieve mobile number and OTP from the request
            $userContact = $request->input('mobile_number');
            $otpEntered = $request->input('user_otp');
    
            // Retrieve the user record by mobile number
            $user = User::where('mobile_number', $userContact)->first();
    
            // Check if the user exists
            if (!$user) {
                return response()->json(['error' => 'User not found'], 200);
            }
    
            // Retrieve OTP stored for the user
            $otpStored = $user->user_otp;
    
            // Check if OTPs match
            if ($otpStored && $otpStored === $otpEntered) {
                $user->user_otp = null;
                $user->save();
    
                return response()->json(['status' => 'true', 'message' => 'OTP verification successful. Login successful!']);
            } else {
                return response()->json(['status' => 'false','message' => 'Invalid OTP'], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'false','error' => $e->getMessage()], 500);
        }
    }    
    
    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}