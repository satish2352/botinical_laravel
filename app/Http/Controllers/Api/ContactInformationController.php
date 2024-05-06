<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\ {
    ContactInformation
};

class ContactInformationController extends Controller
{
    public function getContactInformation( Request $request ) {
        try {
            $language = $request->input( 'language', 'english' );

            $contact_info_id = $request->input( 'contact_info_id' );
        

            $basic_query_object = ContactInformation::where( 'is_active', '=', true )
                                                      ->where('id', $contact_info_id);

                        if ( $language == 'hindi' ) {
                $data_output =   $basic_query_object->select( 'hindi_name', 'hindi_price' );
            } else {
                $data_output =  $basic_query_object->select( 'english_name', 'english_price' );
            }

            $data_output =  $data_output->get()->toArray();

            return response()->json( [ 'status' => 'true', 'message' => 'All data retrieved successfully','data' => $data_output ], 200 );
        } catch ( \Exception $e ) {
            return response()->json( [ 'status' => 'false', 'message' => 'Charges List Fail', 'error' => $e->getMessage() ], 500 );
        }
    }
}
