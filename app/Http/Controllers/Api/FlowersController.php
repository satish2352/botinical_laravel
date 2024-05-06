<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use App\Models\ {
    Flowers
}
;

class FlowersController extends Controller {
    public function getFlowersList( Request $request ) {
        try {
            $language = $request->input( 'language', 'english' );
            

            $page = isset( $request[ 'start' ] ) ? $request[ 'start' ] : Config::get( 'DocumentConstant.DEFAULT_START' ) ;
            $rowperpage = DEFAULT_LENGTH;
            $start = ( $page - 1 ) * $rowperpage;

            $basic_query_object = Flowers::where( 'is_active', '=', true );

            $totalRecords = $basic_query_object->select( 'tbl_flowers.id' )->get()->count();

            if ( $language == 'hindi' ) {
                $data_output =   $basic_query_object->select( 'hindi_name', 'hindi_description', 'hindi_audio_link', 'hindi_video_upload', 'image', 'latitude', 'longitude' );
            } else {
                $data_output =  $basic_query_object->select( 'english_name', 'english_description', 'english_audio_link', 'english_video_upload', 'image', 'latitude', 'longitude' );
            }

            foreach ( $data_output as &$amenity ) {
                $amenity[ 'image' ] = Config::get( 'DocumentConstant.FLOWERS_VIEW' ) . $amenity[ 'image' ];
            }

            $data_output =  $data_output->skip( $start )
            ->take( $rowperpage )->get()
            ->toArray();

            if ( sizeof( $data_output ) > 0 ) {
                $totalPages = ceil( $totalRecords/$rowperpage );
            } else {
                $totalPages = 0;
            }

            return response()->json( [
                'status' => 'true',
                'message' => 'All data retrieved successfully',
                'totalRecords' => $totalRecords,
                'totalPages'=>$totalPages, 'page_no_to_hilight'=>$page,
                'data' => $data_output
            ], 200 );
        } catch ( \Exception $e ) {
            return response()->json( [
                'status' => 'false',
                'message' => 'Flowers List Fail',
                'error' => $e->getMessage()
            ], 500 );
        }
    }
}
