<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use App\Models\ {
    Facilities
}
;

class FacilitiesController extends Controller
 {
    public function getFacilities( Request $request ) {
        try {
            $language = $request->input( 'language', 'english' );

            $facilities_id = $request->input( 'facilities_id' );

            $page = isset( $request[ 'start' ] ) ? $request[ 'start' ] : Config::get( 'DocumentConstant.DEFAULT_START' ) ;
            $rowperpage = DEFAULT_LENGTH;
            $start = ( $page - 1 ) * $rowperpage;

            $basic_query_object = Facilities::where( 'is_active', '=', true )
            ->when($facilities_id, function ($query) use ($facilities_id) {
                $query->where('id', $facilities_id);
            });

            $totalRecords = $basic_query_object->select( 'tbl_facilities.id' )->get()->count();

            if ( $language == 'hindi' ) {
                $data_output =   $basic_query_object->select('id', 'hindi_name', 'hindi_description', 'image', 'latitude', 'longitude' );
            } else {
                $data_output =  $basic_query_object->select('id', 'english_name', 'english_description', 'image', 'latitude', 'longitude' );
            }

            $data_output =  $data_output->skip( $start )
            ->take( $rowperpage )->get()
            ->toArray();
            foreach ( $data_output as &$facilitiesimage ) {
                $facilitiesimage[ 'image' ] = Config::get( 'DocumentConstant.FACILITIES_VIEW' ) . $facilitiesimage[ 'image' ];
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
            return response()->json( [ 'status' => 'false', 'message' => 'Facilities List Fail', 'error' => $e->getMessage() ], 500 );
        }
    }
}
