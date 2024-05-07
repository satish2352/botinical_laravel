<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\ {
    ContactInformation
}
;

class ContactInformationController extends Controller
 {

    public function addContactUs(Request $request)
    {
        try {
            $all_data_validation = [
                'english_name' => 'required',
                'email' => 'required|email',
                'english_address' => 'required',
                'english_message' => 'required',
            ];
    
            $customMessages = [
                'english_name.required' => 'Full name is required.',
                'email.required' => 'Email is required.',
                'email.email' => 'Invalid email format.',
                'english_address.required' => 'Address is required.',
                'english_message.required' => 'Message is required.',
            ];
    
            $validator = Validator::make($request->all(), $all_data_validation, $customMessages);
    
            if ($validator->fails()) {
                $errorMessage = implode(' ', $validator->errors()->all());
                return response()->json([
                    'status' => 'false',
                    'message' => 'Validation Fail: ' . $errorMessage,
                ], 400);
            }
    
            $user = auth()->user();
    
            $contact_info = new ContactInformation();
            $contact_info->user_id = $user->id;
            $contact_info->english_name = $request->english_name;
            $contact_info->email = $request->email;
            $contact_info->english_address = $request->english_address;
            $contact_info->english_message = $request->english_message;
    
            $contact_info->save();
    
            return response()->json([
                'status' => 'true',
                'message' => 'Contact added successfully.',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'false',
                'message' => 'An error occurred',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

        public function getContactInformation( Request $request ) {
            try {
                $language = $request->input( 'language', 'english' );

                $contact_info_id = $request->input( 'contact_info_id' );

                $basic_query_object = ContactInformation::where( 'is_active', '=', true )
                ->where( 'id', $contact_info_id );

                if ( $language == 'hindi' ) {
                    $data_output =   $basic_query_object->select( 'hindi_name', 'email', 'hindi_address', 'english_message' );
                } else {
                    $data_output =  $basic_query_object->select( 'english_name', 'email', 'english_address', 'english_address' );
                }

                $data_output =  $data_output->get()->toArray();

                return response()->json( [ 'status' => 'true', 'message' => 'All data retrieved successfully', 'data' => $data_output ], 200 );
            } catch ( \Exception $e ) {
                return response()->json( [ 'status' => 'false', 'message' => 'Contact Information Fail', 'error' => $e->getMessage() ], 500 );
            }
        }
    }
