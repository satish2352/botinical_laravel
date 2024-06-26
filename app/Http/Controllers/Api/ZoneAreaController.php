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
    public function getZoneArea(Request $request) {
        try {
            $language = $request->input('language', 'english');
    
            $zone_id = $request->input('zone_id');

            $basic_query_object = ZonesArea::where('is_active', true)
            ->when($zone_id, function ($query) use ($zone_id) {
                $query->where('id', $zone_id);
            });                 
    
            if ($language == 'hindi') {
                $data_output = $basic_query_object->select('id','hindi_name as name', 'hindi_description as description', 'hindi_audio_link as audio_link', 'hindi_video_upload as video_upload', 'image', 'latitude', 'longitude');
            } else {
                $data_output = $basic_query_object->select('id','english_name as name', 'english_description as description', 'english_audio_link as audio_link', 'english_video_upload as video_upload', 'image', 'latitude', 'longitude');
            }
    
            $data_output = $data_output->get();
    
            foreach ( $data_output as &$zoneimage ) {
                $zoneimage[ 'image' ] = Config::get( 'DocumentConstant.ZONESAREA_VIEW' ) . $zoneimage[ 'image' ];
                if ($language == 'hindi') {
                    $zoneimage['audio_link'] = Config::get('DocumentConstant.ZONESAREA_VIEW') . $zoneimage['audio_link'];
                } else {
                    $zoneimage['audio_link'] = Config::get('DocumentConstant.ZONESAREA_VIEW') . $zoneimage['audio_link'];
                }
                if ($language == 'hindi') {
                    $zoneimage['video_upload'] = Config::get('DocumentConstant.ZONESAREA_VIEW') . $zoneimage['video_upload'];
                } else {
                    $zoneimage['video_upload'] = Config::get('DocumentConstant.ZONESAREA_VIEW') . $zoneimage['video_upload'];
                }
            }
    
            return response()->json(['status' => true, 'message' => 'All data retrieved successfully', 'data' => $data_output], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Facilities List Fail', 'error' => $e->getMessage()], 500);
        }
    }

    public function getParticularZoneAreaAudio( Request $request ) {
        try {
            $language = $request->input( 'language', 'english' );
            
            $zone_id = $request->input( 'zone_id' );

            $basic_query_object = ZonesArea::where('is_active', true)
            ->where('id', $zone_id);

            if ( $language == 'hindi' ) {
                $data_output =   $basic_query_object->select('id','hindi_audio_link as audio_link');
            } else {
                $data_output =  $basic_query_object->select('id','english_audio_link as audio_link');
            }

            $data_output =  $data_output->get()->toArray();

            foreach ( $data_output as &$flowerdetail ) {
                if ($language == 'hindi') {
                    $flowerdetail['audio_link'] = Config::get('DocumentConstant.ZONESAREA_VIEW') . $flowerdetail['audio_link'];
                } else {
                    $flowerdetail['audio_link'] = Config::get('DocumentConstant.ZONESAREA_VIEW') . $flowerdetail['audio_link'];
                }
            }

            return response()->json( [
                'status' => 'true',
                'message' => 'All data retrieved successfully',
                'data' => $data_output
            ], 200 );
        } catch ( \Exception $e ) {
            return response()->json( [
                'status' => 'false',
                'message' => 'Audio Getting Fail',
                'error' => $e->getMessage()
            ], 500 );
        }
    }

    public function getParticularZoneAreaVideo( Request $request ) {
        try {
            $language = $request->input( 'language', 'english' );
            
            $zone_id = $request->input( 'zone_id' );

            $basic_query_object = ZonesArea::where('is_active', true)
            ->where('id', $zone_id);

            if ( $language == 'hindi' ) {
                $data_output =   $basic_query_object->select('id','hindi_video_upload as video_upload');
            } else {
                $data_output =  $basic_query_object->select('id','english_video_upload as video_upload');
            }

            $data_output =  $data_output->get()->toArray();

            foreach ( $data_output as &$flowerdetail ) {
                if ($language == 'hindi') {
                    $flowerdetail['video_upload'] = Config::get('DocumentConstant.ZONESAREA_VIEW') . $flowerdetail['video_upload'];
                } else {
                    $flowerdetail['video_upload'] = Config::get('DocumentConstant.ZONESAREA_VIEW') . $flowerdetail['video_upload'];
                }
            }

            return response()->json( [
                'status' => 'true',
                'message' => 'All data retrieved successfully',
                'data' => $data_output
            ], 200 );
        } catch ( \Exception $e ) {
            return response()->json( [
                'status' => 'false',
                'message' => 'Video Getting Fail',
                'error' => $e->getMessage()
            ], 500 );
        }
    } 
}
