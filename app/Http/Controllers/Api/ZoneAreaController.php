<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use App\Models\ {
    ZonesArea
}
;

class ZoneAreaController extends Controller
 {
    public function getZoneArea( Request $request ) {
        try {
            $language = $request->input( 'language', 'english' );

           

            $basic_query_object = ZonesArea::where( 'is_active', '=', true );

            $totalRecords = $basic_query_object->select( 'tbl_zones_area.id' )->get()->count();

            if ( $language == 'hindi' ) {
                $data_output =   $basic_query_object->select( 'hindi_name', 'hindi_description', 'hindi_audio_link', 'hindi_video_upload', 'image', 'latitude', 'longitude' );
            } else {
                $data_output =  $basic_query_object->select( 'english_name', 'english_description', 'english_audio_link', 'english_video_upload', 'image', 'latitude', 'longitude' );
            }
            foreach ( $data_output as &$galleryimage ) {
                $galleryimage[ 'image' ] = Config::get( 'DocumentConstant.ZONESAREA_VIEW' ) . $galleryimage[ 'image' ];
            }


            return response()->json( [ 'status' => 'true', 'message' => 'All data retrieved successfully', 
            'data' => $data_output ], 200 );
        } catch ( \Exception $e ) {
            return response()->json( [ 'status' => 'false', 'message' => 'Facilities List Fail', 'error' => $e->getMessage() ], 500 );
        }
    }
}
