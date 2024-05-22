<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use App\Models\ {
    AboutUs,
    Amenities,
    Charges,
    AboutUsElement,
    Ticket
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
                $data_output =   $basic_query_object->select('id', 'hindi_name as name', 'hindi_description as description', 'image' );
            } else {
                $data_output =  $basic_query_object->select('id', 'english_name as name', 'english_description as description', 'image' );
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

    public function getAllAboutUsElementList( Request $request ) {
        try {
             $language = $request->input( 'language', 'english' );
            $page = isset( $request[ 'start' ] ) ? $request[ 'start' ] : Config::get( 'DocumentConstant.DEFAULT_START' ) ;
            $rowperpage = DEFAULT_LENGTH;
            $start = ( $page - 1 ) * $rowperpage;

            $basic_query_object = AboutUsElement::where( 'is_active', '=', true );

            $totalRecords = $basic_query_object->select( 'tbl_aboutus_element.id' )->get()->count();

            if ( $language == 'hindi' ) {
                $data_output =   $basic_query_object->select('id', 'hindi_name as name', 'hindi_description as description', 'image' );
            } else {
                $data_output =  $basic_query_object->select('id', 'english_name as name', 'english_description as description', 'image' );
            }

            $data_output =  $data_output->skip( $start )
            ->take( $rowperpage )->get()
            ->toArray();
            foreach ( $data_output as &$aboutusimage ) {
                $aboutusimage[ 'image' ] = Config::get( 'DocumentConstant.ABOUTUS_ELEMENT_VIEW' ) . $aboutusimage[ 'image' ];
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
                $data_output =   $basic_query_object->select('id', 'hindi_name as name', 'hindi_price as price' );
            } else {
                $data_output =  $basic_query_object->select('id', 'english_name as name', 'english_price as price' );
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

    
    public function getAllTicketList( Request $request ) {
        try {
            // $user = auth()->user()->id;
            $data_output = Ticket::all();

            $language = $request->input( 'language', 'english' );

            $page = isset( $request[ 'start' ] ) ? $request[ 'start' ] : Config::get( 'DocumentConstant.DEFAULT_START' ) ;
            $rowperpage = DEFAULT_LENGTH;
            $start = ( $page - 1 ) * $rowperpage;

            $basic_query_object = Ticket::where( 'is_active', '=', true );

            $totalRecords = $basic_query_object->select( 'tbl_ticket.id' )->get()->count();

            if ( $language == 'hindi' ) {
                $data_output =   $basic_query_object->select('id', 'hindi_name as name', 'hindi_description as description', 'hindi_ticket_cost as ticket_cost', 'hindi_rules_terms as rules_terms' );
            } else {
                $data_output =  $basic_query_object->select('id', 'english_name as name', 'english_description as description', 'english_ticket_cost as ticket_cost', 'english_rules_terms as rules_terms' );
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
            return response()->json( [ 'status' => 'false', 'message' => 'Ticket List Fail', 'error' => $e->getMessage() ], 500 );
        }
    }

}
