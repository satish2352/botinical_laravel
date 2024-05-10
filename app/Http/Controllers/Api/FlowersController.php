<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use App\Models\ {
    Flowers
};

class FlowersController extends Controller {

    public function getFlowersList( Request $request ) {
        try {
            $language = $request->input( 'language', 'english' );
            
            $flowers_id = $request->input( 'flowers_id' );

            $page = isset( $request[ 'start' ] ) ? $request[ 'start' ] : Config::get( 'DocumentConstant.DEFAULT_START' ) ;
            $rowperpage = DEFAULT_LENGTH;
            $start = ( $page - 1 ) * $rowperpage;

            $basic_query_object = Flowers::where('is_active', true)
            ->when($flowers_id, function ($query) use ($flowers_id) {
                $query->where('id', $flowers_id);
            });

            $totalRecords = $basic_query_object->select('tbl_flowers.id')->get()->count();

            if ( $language == 'hindi' ) {
                $data_output =   $basic_query_object->select('id', 'hindi_name as name', 'hindi_description as description', 'hindi_audio_link as audio_link', 'hindi_video_upload as video_upload', 'image', 'latitude', 'longitude' );
            } else {
                $data_output =  $basic_query_object->select('id', 'english_name as name', 'english_description as description', 'english_audio_link as audio_link', 'english_video_upload as video_upload', 'image', 'latitude', 'longitude' );
            }

            $data_output =  $data_output->skip($start)
            ->take($rowperpage)->get()
            ->toArray();

            foreach ( $data_output as &$flowerdetail ) {
                $flowerdetail[ 'image' ] = Config::get( 'DocumentConstant.FLOWERS_VIEW' ) . $flowerdetail[ 'image' ];
                if ($language == 'hindi') {
                    $flowerdetail['audio_link'] = Config::get('DocumentConstant.FLOWERS_VIEW') . $flowerdetail['audio_link'];
                } else {
                    $flowerdetail['audio_link'] = Config::get('DocumentConstant.FLOWERS_VIEW') . $flowerdetail['audio_link'];
                }
                if ($language == 'hindi') {
                    $flowerdetail['video_upload'] = Config::get('DocumentConstant.FLOWERS_VIEW') . $flowerdetail['video_upload'];
                } else {
                    $flowerdetail['video_upload'] = Config::get('DocumentConstant.FLOWERS_VIEW') . $flowerdetail['video_upload'];
                }

            }

            if ( sizeof( $data_output ) > 0 ) {
                $totalPages = ceil( $totalRecords/$rowperpage );
            } else {
                $totalPages = 0;
            }

            return response()->json( [
                'status' => 'true',
                'message' => 'All data retrieved successfully',
                'totalRecords' => $totalRecords,
                'totalPages'=>$totalPages, 
                'page_no_to_hilight'=>$page,
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

    public function getParticularFlowersAudio( Request $request ) {
        try {
            $language = $request->input( 'language', 'english' );
            
            $flowers_id = $request->input( 'flowers_id' );

            $basic_query_object = Flowers::where('is_active', true)
            ->where('id', $flowers_id);

            if ( $language == 'hindi' ) {
                $data_output =   $basic_query_object->select('id','hindi_audio_link as audio_link');
            } else {
                $data_output =  $basic_query_object->select('id','english_audio_link as audio_link');
            }

            $data_output =  $data_output->get()->toArray();

            foreach ( $data_output as &$flowerdetail ) {
                if ($language == 'hindi') {
                    $flowerdetail['audio_link'] = Config::get('DocumentConstant.FLOWERS_VIEW') . $flowerdetail['audio_link'];
                } else {
                    $flowerdetail['audio_link'] = Config::get('DocumentConstant.FLOWERS_VIEW') . $flowerdetail['audio_link'];
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
    public function getParticularFlowersVideo( Request $request ) {
        try {
            $language = $request->input( 'language', 'english' );
            
            $flowers_id = $request->input( 'flowers_id' );

            $basic_query_object = Flowers::where('is_active', true)
            ->where('id', $flowers_id);

            if ( $language == 'hindi' ) {
                $data_output =   $basic_query_object->select('id','hindi_video_upload as video_upload');
            } else {
                $data_output =  $basic_query_object->select('id','english_video_upload as video_upload');
            }

            $data_output =  $data_output->get()->toArray();

            foreach ( $data_output as &$flowerdetail ) {
                if ($language == 'hindi') {
                    $flowerdetail['video_upload'] = Config::get('DocumentConstant.FLOWERS_VIEW') . $flowerdetail['video_upload'];
                } else {
                    $flowerdetail['video_upload'] = Config::get('DocumentConstant.FLOWERS_VIEW') . $flowerdetail['video_upload'];
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
