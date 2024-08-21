<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Validator;
use App\Models\ {
    User,
    Roles
};
use Illuminate\Support\Facades\Config;
use Storage;
use Carbon\Carbon;


class UserController extends Controller
{

    public function userRegistrationForm(Request $request) {
        try {
            // Validation rules
            $all_data_validation = [
                'full_name' => 'required',
                'date_of_birth' => 'required',
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
    
            // Set is_active based on the role_id
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
    public function getParticularUserProfile(Request $request) {

            try {
                $user = auth()->user()->id;
            
                $data_output = User::leftJoin('roles', 'users.role_id', '=', 'roles.id')
                ->where('users.id', $user)
                ->select('users.id',
                   'users.full_name',
                    'users.mobile_number',
                    'users.date_of_birth',  
                    'users.email',  
                    'users.gender', 
                    'users.occupation',   
                    'users.address',               
                    )->distinct('users.id')
                    ->get();
                    
                    foreach ($data_output as $userimage) {
                        $userimage->user_profile = Config::get('DocumentConstant.USER_PROFILE_VIEW') . $userimage->user_profile;
                    }
        
                return response()->json(['status' => 'true', 'message' => 'User data retrieved successfully','data' => $data_output], 200);
            } catch (\Exception $e) {
                return response()->json(['status' => 'false', 'message' => 'User details get fail','error' => $e->getMessage()], 500);
            }
    }
    
    public function changePasswordProfile(Request $request) {
        try {
            $all_data_validation = Validator::make($request->all(), [
                'old_password' => 'required|min:8|max:50', 
                'new_password' => 'required|min:8|max:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/|different:old_password', 
            ], [
                'old_password.required' => 'The old password field is required.',
                'old_password.min' => 'The old password must be at least 8 characters.',
                'old_password.max' => 'The old password may not be greater than 8 characters.',
                'new_password.required' => 'The new password field is required.',
                'new_password.min' => 'The new password must be at least 8 characters.',
                'new_password.max' => 'The new password may not be greater than 8 characters.',
                'new_password.regex' => 'The new password must contain at least 1 uppercase letter, 1 lowercase letter, 1 digit, and 1 special character.',
                'new_password.different' => 'The new password must be different from the old password.',
            ]);
          
            
            if ($all_data_validation->fails()) {
                $errorMessage = $all_data_validation->errors()->first(); // Simplified error message retrieval
                return response()->json([
                    'status' => 'false',
                    'message' => 'Validation Fail: ' . $errorMessage,
                ], 200); // Changed status code to 422 for validation errors
            }
    
            $user = auth()->user();
            if (!Hash::check($request->old_password, $user->password)) {
                return response()->json(['status' => 'false', 'message' => 'Invalid old password'], 200); // Changed status code to 401 for unauthorized
            }
    
            $user->password = Hash::make($request->new_password);
            $user->save();
    
            return response()->json(['status' => 'true', 'message' => 'Password updated successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'false', 'message' => 'Failed to update password', 'error' => $e->getMessage()], 500);
        }
    }
    // public function sendPasswordEmail($password, $email)
    // {
    //     try {
    //        $msg= Mail::raw('Your new password is: ' . $password, function ($message) use ($email) {
    //   info($msg);
    //   die();
    //         $message->to($email)->subject('Password Reset');
          
    //             $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));

                
    //         });           
    //         return true;

    //     } catch (\Exception $e) {
    //         // Log the error
    //         \Log::error($e);
    //         return false;
    //     }
    // }

 
    public function sendPasswordEmail($password, $email)
    {
        try {
            Mail::raw('Your new password is: ' . $password, function ($message) use ($email) {
                $message->to($email)->subject('Password Reset');
                $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
    
                // Log the email details if needed
                // info('Sending password reset email to: ' . $email);
                // info('Email subject: ' . $message->getSubject());
            });           
            return true;
    
        } catch (\Exception $e) {
            // Log the error
            \Log::error($e);
            return false;
        }
    }

    public function resetPasswordEmailBased(Request $request)
{
    try {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'false', 'message' => 'Invalid email format'], 200);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['status' => 'false', 'message' => 'Email not found'], 200);
        }

        // Generate a password with at least 1 uppercase, 1 lowercase, 1 digit, and 1 special character
        $uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $lowercase = 'abcdefghijklmnopqrstuvwxyz';
        $digits = '0123456789';
        $specialChars = '@$!%*?&';

        $password = '';
        $password .= $uppercase[random_int(0, strlen($uppercase) - 1)];
        $password .= $lowercase[random_int(0, strlen($lowercase) - 1)];
        $password .= $digits[random_int(0, strlen($digits) - 1)];
        $password .= $specialChars[random_int(0, strlen($specialChars) - 1)];

        // Fill the remaining characters randomly from all character sets
        $allCharacters = $uppercase . $lowercase . $digits . $specialChars;
        for ($i = 4; $i < 8; $i++) {
            $password .= $allCharacters[random_int(0, strlen($allCharacters) - 1)];
        }

        // Shuffle the password to ensure randomness
        $password = str_shuffle($password);

        // Send the email
        $emailSent = $this->sendPasswordEmail($password, $request->email);
        if (!$emailSent) {
            return response()->json(['status' => 'false', 'message' => 'Unable to reset password, please try again later'], 200);
        }

        // Update the user's password
        $user->password = Hash::make($password);
        $user->save();

        return response()->json(['status' => 'true', 'message' => 'Password updated successfully'], 200);
    } catch (\Exception $e) {
        \Log::error($e);
        return response()->json(['status' => 'false', 'message' => 'Failed to update password'], 500);
    }
}

    // public function resetPasswordEmailBased(Request $request)
    // {
    //     try {
    //         $validator = Validator::make($request->all(), [
    //             'email' => 'required|email',
    //         ]);

    //         if ($validator->fails()) {
    //             return response()->json(['status' => 'false', 'message' => 'Invalid email format'], 200);
    //         }

    //         $user = User::where('email', $request->email)->first();
            
    //         if (!$user) {
    //             return response()->json(['status' => 'false', 'message' => 'Email not found'], 200);
    //         }
            

    //         // $newPassword = Str::random(8); // Change the password length as needed
    //         $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789@$!%*?&';
    //         $newPassword = '';
    //         $length = 8;
    //         for ($i = 0; $i < $length; $i++) {
    //             $newPassword .= $characters[random_int(0, strlen($characters) - 1)];
    //         }
    //         $emailSent = $this->sendPasswordEmail($newPassword, $request->email);
    //         // info($emailSent);
    //         // die();
    //         if (!$emailSent) {
    //             return response()->json(['status' => 'false', 'message' => 'Unable to reset password please try after some time'], 200);
    //         }

            
    //         $user->password = Hash::make($newPassword);
    //         $user->save();
           
    //         return response()->json(['status' => 'true', 'message' => 'Password updated successfully'], 200);
    //     } catch (\Exception $e) {
            
    //         \Log::error($e);
    //         return response()->json(['status' => 'false', 'message' => 'Failed to update password'], 500);
    //     }
    // }   
}