<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Validator;
use App\Models\ {
    ContactInformation,
    ContactEnquiry
}
;

class ContactInformationController extends Controller
 {

    public function addContactUs(Request $request)
    {
        try {
            $all_data_validation = [
                'full_name' => 'required',
                'email' => 'required|email',
                'address' => 'required',
                'message' => 'required',
            ];
    
            $customMessages = [
                'full_name.required' => 'Full name is required.',
                'email.required' => 'Email is required.',
                'email.email' => 'Invalid email format.',
                'address.required' => 'Address is required.',
                'message.required' => 'Message is required.',
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
    
            $contact_info = new ContactEnquiry();
            $contact_info->full_name = $request->full_name;
            $contact_info->email = $request->email;
            $contact_info->address = $request->address;
            $contact_info->message = $request->message;
    
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
                    $data_output =   $basic_query_object->select('hindi_address as address', 'email',  'hindi_director_number as director_number', 'hindi_officer_number as officer_number');
                } else {
                    $data_output =  $basic_query_object->select('english_address as address', 'email', 'english_director_number as director_number', 'english_officer_number as officer_number');
                }

                $data_output =  $data_output->get()->toArray();

                return response()->json( [ 'status' => 'true', 'message' => 'All data retrieved successfully', 'data' => $data_output ], 200 );
            } catch ( \Exception $e ) {
                return response()->json( [ 'status' => 'false', 'message' => 'Contact Information Fail', 'error' => $e->getMessage() ], 500 );
            }
        }
    }
