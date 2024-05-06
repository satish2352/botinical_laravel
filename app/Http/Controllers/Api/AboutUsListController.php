<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use App\Models\ {
    AboutUs,
    Amenities,
    Charges
}
;

class AboutUsListController extends Controller {
   
    public function getAllAboutUsList( Request $request ) {
        try {
             $language = $request->input( 'language', 'english' );
            $page = isset( $request[ 'start' ] ) ? $request[ 'start' ] : Config::get( 'DocumentConstant.DEFAULT_START' ) ;
            $rowperpage = DEFAULT_LENGTH;
            $start = ( $page - 1 ) * $rowperpage;

            $basic_query_object = AboutUs::where( 'is_active', '=', true );

            $totalRecords = $basic_query_object->select( 'tbl_aboutus.id' )->get()->count();

            if ( $language == 'hindi' ) {
                $data_output =   $basic_query_object->select( 'hindi_name', 'hindi_description', 'image' );
            } else {
                $data_output =  $basic_query_object->select( 'english_name', 'english_description', 'image' );
            }

            $data_output =  $data_output->skip( $start )
            ->take( $rowperpage )->get()
            ->toArray();
            foreach ( $data_output as &$aboutusimage ) {
                $aboutusimage[ 'image' ] = Config::get( 'DocumentConstant.ABOUTUS_VIEW' ) . $aboutusimage[ 'image' ];
            }

            if ( sizeof( $data_output ) > 0 ) {
                $totalPages = ceil( $totalRecords/$rowperpage );
            } else {
                $totalPages = 0;
            }

            return response()->json( [ 'status' => 'true', 'message' => 'All data retrieved successfully', 'totalRecords' => $totalRecords,
            'totalPages'=>$totalPages, 'page_no_to_hilight'=>$page,
            'data' => $data_output ], 200 );
        } catch ( \Exception $e ) {
            return response()->json( [ 'status' => 'false', 'message' => 'Charges List Fail', 'error' => $e->getMessage() ], 500 );
        }
    }

    public function getAllChargesList( Request $request ) {
        try {
            // $user = auth()->user()->id;
            $data_output = Charges::all();

            $language = $request->input( 'language', 'english' );

            $page = isset( $request[ 'start' ] ) ? $request[ 'start' ] : Config::get( 'DocumentConstant.DEFAULT_START' ) ;
            $rowperpage = DEFAULT_LENGTH;
            $start = ( $page - 1 ) * $rowperpage;

            $basic_query_object = Charges::where( 'is_active', '=', true );

            $totalRecords = $basic_query_object->select( 'tbl_charges.id' )->get()->count();

            if ( $language == 'hindi' ) {
                $data_output =   $basic_query_object->select( 'hindi_name', 'hindi_price' );
            } else {
                $data_output =  $basic_query_object->select( 'english_name', 'english_price' );
            }

            $data_output =  $data_output->skip( $start )
            ->take( $rowperpage )->get()
            ->toArray();

            if ( sizeof( $data_output ) > 0 ) {
                $totalPages = ceil( $totalRecords/$rowperpage );
            } else {
                $totalPages = 0;
            }

            return response()->json( [ 'status' => 'true', 'message' => 'All data retrieved successfully', 'totalRecords' => $totalRecords,
            'totalPages'=>$totalPages, 'page_no_to_hilight'=>$page,
            'data' => $data_output ], 200 );
        } catch ( \Exception $e ) {
            return response()->json( [ 'status' => 'false', 'message' => 'Charges List Fail', 'error' => $e->getMessage() ], 500 );
        }
    }

}
