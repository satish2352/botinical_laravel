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

    public function addContactUs( Request $request ) {
        try {

                $all_data_validation = [
                    'english_name' => 'required',
                    'email' => 'required',
                    'english_address' => 'required',
                    'english_message' => 'required',
                ];

                $customMessages = [
                    'english_name.required'=>'full name is required',
                    'email.required'=>'email is required.',
                    'english_address.required'=>'address is required',
                    'english_message.date_format'=>'message is required',

                ];

                $validator = Validator::make( $request->all(), $all_data_validation, $customMessages );

                if ( $validator->fails() ) {
                    $errors = $validator->errors()->all();
                    $errorMessage = '';
                    $errorMessage = implode( ' \n', $validator->errors()->all() );
                    return response()->json( [
                        'status' => 'false',
                        'message' => 'Validation Fail: ' . $errorMessage,
                    ], 200 );
                }

                $user = auth()->user();

                $labour_data = new ContactInformation();
                $labour_data->user_id = $user->id;
                $labour_data->english_name = $request->english_name;
                $labour_data->email = $request->email;
                $labour_data->english_address = $request->english_address;
                $labour_data->english_message = $request->english_message;
                
                $labour_data->save();
              
                return response()->json( [
                    'status' => 'true',
                    'message' => 'Contact added successfully',
                ] );
            }
        } catch ( \Exception $e ) {
            return response()->json( [ 'status' => 'false', 'message' => 'An error occurred',
            'error' => $e->getMessage() ], 500 );
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
