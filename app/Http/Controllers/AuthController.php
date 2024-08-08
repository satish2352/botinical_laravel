<?php
namespace App\Http\Controllers;
// use Illuminate\Support\Facades\Cache;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Http\Request;
use App\Models\ {
    User
}
;

class AuthController extends Controller
 {
    /**
    * Create a new AuthController instance.
    *
    * @return void
    */

//     public function __construct()
//  {
//         $this->middleware( 'auth:api', [ 'except' => [ 'login', 'verifyOTP' ] ] );
//     }

public function __construct()
{
    $this->middleware('auth:api', ['except' => ['login', 'verifyotp', 'get-home-data', 'get-aboutus-element-list', 'add-contactus-form','get-contact-information']]);
}


    /**
    * Get a JWT via given credentials.
    *
    * @return \Illuminate\Http\JsonResponse
    */
    // public function login()
    // {
    //     $credentials = request( [ 'mobile_number' ] );
    // Include 'password' field

    //     if ( ! $token = auth()->attempt( $credentials ) ) {
    //         return response()->json( [ 'error' => 'Unauthorized' ], 401 );
    //     }

    //     return $this->respondWithToken( $token );
    // }
    // ====================

    public function login( Request $request ){
        try {
            $all_data_validation = [
                'mobile_number' => [ 'required', 'digits:10', 'regex:/^[6789]\d{9}$/' ],
            ];

            $customMessages = [
                'mobile_number.required' => 'Mobile number is required.',
                'mobile_number.digits' => 'Mobile number must be 10 digits.',
                'mobile_number.regex' => 'Mobile number must start with 9, 8, 7 or 6.',
            ];

            $validator = Validator::make( $request->all(), $all_data_validation, $customMessages );

            if ( $validator->fails() ) {
                $errors = $validator->errors()->all();
                $errorMessage = implode( ' \n ', $errors );
                return response()->json( [
                    'status' => 'false',
                    'message' => 'Validation Fail: ' . $errorMessage,
                ], 200 );
            }

            // Fetch mobile number directly from request
            $mobileNumber = $request->input( 'mobile_number' );

            // Check if user exists with the provided mobile number
            $user = User::where( 'mobile_number', $mobileNumber )->first();

            if ( !$user ) {
                // If user doesn't exist, create a new one
                $user = new User();
                $user->mobile_number = $mobileNumber;
                $user->save();
            }

            // Generate OTP (You can implement your OTP generation logic here)
            $otp = "1234";

            // Update user's OTP
                $user->user_otp = $otp;
                $user->save();

                return response()->json( [
                    'status' => 'true',
                    'message' => 'OTP sent successfully.',
                ] );
            } catch ( \Exception $e ) {
                return response()->json( [ 'status' => 'false', 'message' => 'Login fail', 'error' => $e->getMessage() ], 500 );
            }
        }

        /**
        * Verify OTP and generate token.
        *
        * @return \Illuminate\Http\JsonResponse
        */

        public function verifyOTP( Request $request ){
            try {
                // Validate the request data
                $request->validate( [
                    'mobile_number' => 'required|string',
                    'user_otp' => 'required|string'
                ] );

                // Retrieve mobile number and OTP from the request
                $mobileNumber = $request->input( 'mobile_number' );
                $otpEntered = $request->input( 'user_otp' );

                // Retrieve the user record by mobile number
                $user = User::where( 'mobile_number', $mobileNumber )->first();

                // Check if the user exists
                if ( !$user ) {
                    return response()->json( [ 'status' => 'false', 'message' => 'User not found' ], 200 );
                }

                // Retrieve OTP stored for the user
                $otpStored = $user->user_otp;

                // Check if OTPs match
                if ( $otpStored && $otpStored === $otpEntered ) {

                    $token = auth()->login( $user );
                   
                    if (!$token) {
                        return response()->json(['error' => 'Unauthorized'], 401);
                    }
                    
                    $user->update( [ 'remember_token' => $token ] );

                    return response()->json( [
                        'status' => 'true',
                        'message' => 'OTP verification successful. Login successful!',
                        'data'=>$user,
                        'token' => $token,
                        'token_type' => 'bearer',
                        'expires_in' => auth()->factory()->getTTL() * 60
                    ] );
                } else {
                    return response()->json( [ 'status' => 'false', 'message' => 'Invalid OTP' ], 200 );
                }
            } catch ( \Exception $e ) {
                return response()->json( [ 'status' => 'false', 'error' => $e->getMessage() ], 500 );
            }
        }
    // =================

    // public function login(Request $request)
    // {

    //     $validator = Validator::make($request->all(), [
    //         'email' => 'required|email',
    //         'password' => 'required',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json(['status' => 'error', 'message' => $validator->errors()->all()], 200);
    //     }


    //     $email = $request->email;
    //     $password = $request->password;

    //     $user = User::where('email', $email)->first();
    //     if (!$user) {
    //         return response()->json(['status' => 'False','message' => 'User not found'], 200);
    //     }
    //     if ($user->is_active != 1) {
    //         return response()->json(['status' => 'False', 'message' => 'User is not active please active admin side.'], 200);
    //     }

    //     $credentials = request(['email', 'password']);

    //     if (! $token = auth()->attempt($credentials)) {
    //         return response()->json(['status' => 'False', 'message' => 'Invalid email or password. Please correct it'], 200);
    //     }

    //     $user->update(['remember_token' => $token]);
    //     return response()->json([
    //         'status' => 'True',
    //         'message' => 'Login successfully',
    //         'data' => $user,
    //         'token' => $token,
    //         'token_type' => 'bearer',
    //         'expires_in' => auth()->factory()->getTTL() * 60
    //         // 'expires_in' => auth()->factory()->getTTL() * 60 * 24 * 365 * 10, // 10 years
    //     ]);

    // }

        public function userRegistration(Request $request) {
            try {
                // Validation rules
                $all_data_validation = [
                    'full_name' => 'required',
                    'date_of_birth' => 'required|date_format:d/m/Y',
                    'email' => 'required|email|unique:users,email',
                    'gender' => 'required',
                    'role_id' => 'required',
                    'mobile_number' => 'required|regex:/^[0-9]{10}$/|unique:users,mobile_number',
                    'address' => 'required',
                    'occupation' => 'required',
                    'password' => 'required',
                ];
        
                // Custom validation messages
                $customMessages = [
                    'full_name.required' => 'Full name is required.',
                    'email.required' => 'Email is required.',
                    'email.unique' => 'This email is already registered.',
                    'mobile_number.required' => 'Please enter a mobile number.',
                    'mobile_number.regex' => 'Please enter a 10-digit mobile number.',
                    'mobile_number.unique' => 'This mobile number is already registered.',
                    'date_of_birth.required' => 'Date of birth is required.',
                    'date_of_birth.date_format' => 'Date of birth must be in the format d/m/Y.',
                    'gender.required' => 'Please select a gender.',
                    'address.required' => 'Address is required.',
                    'occupation.required' => 'Occupation is required.',
                    'role_id.required' => 'Role ID is required.',
                ];
        
                // Validate the request data
                $validator = Validator::make($request->all(), $all_data_validation, $customMessages);
        
                if ($validator->fails()) {
                    $errorMessage = implode(" \n", $validator->errors()->all());
                    return response()->json([
                        'status' => 'false',
                        'message' => 'Validation Fail: ' . $errorMessage,
                    ], 200);
                }
        
                // Create a new user instance
                $labour_data = new User();
                $labour_data->role_id = $request->role_id;
                $labour_data->full_name = $request->full_name;
                $labour_data->date_of_birth = $request->date_of_birth;
                $labour_data->email = $request->email;
                $labour_data->password = bcrypt($request['password']);
                $labour_data->mobile_number = $request->mobile_number;
                $labour_data->gender = $request->gender;
                $labour_data->address = $request->address;
                $labour_data->occupation = $request->occupation;
                
                if ($request->role_id == 2) {
                    $labour_data->is_active = 0; // Driver role
                } else {
                    $labour_data->is_active = 1; // Other roles
                }
                $labour_data->save();
        
                return response()->json(['status' => 'true', 'message' => 'User added successfully', 'data' => $labour_data], 200);
        
            } catch (\Exception $e) {
                return response()->json(['status' => 'false', 'message' => 'User add failed', 'error' => $e->getMessage()], 500);
            }
        }
        
        
        /**
        * Get the authenticated User.
        *
        * @return \Illuminate\Http\JsonResponse
        */

        public function me()
 {
            return response()->json( auth()->user() );
        }

        /**
        * Log the user out ( Invalidate the token ).
        *
        * @return \Illuminate\Http\JsonResponse
        */

        public function logout()
 {
            auth()->logout();

            return response()->json( [ 'message' => 'Successfully logged out' ] );
        }

        /**
        * Refresh a token.
        *
        * @return \Illuminate\Http\JsonResponse
        */

        public function refresh()
 {
            return $this->respondWithToken( auth()->refresh() );
        }

        /**
        * Get the token array structure.
        *
        * @param  string $token
        *
        * @return \Illuminate\Http\JsonResponse
        */
        protected function respondWithToken( $token )
 {
            return response()->json( [
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL() * 60
            ] );
        }
    }