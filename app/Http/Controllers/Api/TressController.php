<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use App\Models\ {
    Tress
};

class TressController extends Controller
{
    public function getTressList(Request $request) {
        try {
            $language = $request->input('language', 'english'); 

            $tress_id = $request->input( 'tress_id' );

            $page = isset( $request[ 'start' ] ) ? $request[ 'start' ] : Config::get( 'DocumentConstant.DEFAULT_START' ) ;
            $rowperpage = DEFAULT_LENGTH;
            $start = ( $page - 1 ) * $rowperpage;
                                        
            $basic_query_object = Tress::where('is_active', true)
            ->when($tress_id, function ($query) use ($tress_id) {
                $query->where('id', $tress_id);
            });
             $totalRecords = $basic_query_object->select( 'tbl_trees.id' )->get()->count();                
                            
            if ($language == 'hindi') {
                $data_output =  $basic_query_object->select('id', 'hindi_name as name',
                'hindi_description as description',
                'hindi_audio_link as audio_link',
                'hindi_video_upload as video_upload',
                'image',
                'latitude',
                'longitude');
            } else {
                $data_output = $basic_query_object->select('id', 'english_name as name',
                'english_description as description',
                'english_audio_link as audio_link',
                'english_video_upload as video_upload',
                'image',
                'latitude',
                'longitude');
            }

            $data_output =  $basic_query_object->skip($start)
            ->take($rowperpage)->get()
            ->toArray();
           
            foreach ( $data_output as &$tressimage ) {
                $tressimage[ 'image' ] = Config::get( 'DocumentConstant.TRESS_VIEW' ) . $tressimage[ 'image' ];
                if ($language == 'hindi') {
                    $tressimage['hindi_audio_link'] = Config::get('DocumentConstant.TRESS_VIEW') . $tressimage['hindi_audio_link'];
                } else {
                    $tressimage['english_audio_link'] = Config::get('DocumentConstant.TRESS_VIEW') . $tressimage['english_audio_link'];
                }
                if ($language == 'hindi') {
                    $tressimage['hindi_video_upload'] = Config::get('DocumentConstant.TRESS_VIEW') . $tressimage['hindi_video_upload'];
                } else {
                    $tressimage['english_video_upload'] = Config::get('DocumentConstant.TRESS_VIEW') . $tressimage['english_video_upload'];
                }
            }
                
            if ( sizeof( $data_output ) > 0 ) {
                $totalPages = ceil( $totalRecords/$rowperpage );
            } else {
                $totalPages = 0;
            }

            return response()->json([
                'status' => 'true',
                'message' => 'All data retrieved successfully',
                'totalRecords' => $totalRecords,
                'totalPages'=>$totalPages, 
                'page_no_to_hilight'=>$page,
                'data' => $data_output
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'false',
                'message' => 'Tress List Fail',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getParticularTressAudio( Request $request ) {
        try {
            $language = $request->input( 'language', 'english' );
            
            $tress_id = $request->input( 'tress_id' );

            $basic_query_object = Tress::where('is_active', true)
            ->where('id', $tress_id);

            if ( $language == 'hindi' ) {
                $data_output =   $basic_query_object->select('id','hindi_audio_link');
            } else {
                $data_output =  $basic_query_object->select('id','english_audio_link');
            }

            $data_output =  $data_output->get()->toArray();

            foreach ( $data_output as &$flowerdetail ) {
                if ($language == 'hindi') {
                    $flowerdetail['hindi_audio_link'] = Config::get('DocumentConstant.TRESS_VIEW') . $flowerdetail['hindi_audio_link'];
                } else {
                    $flowerdetail['english_audio_link'] = Config::get('DocumentConstant.TRESS_VIEW') . $flowerdetail['english_audio_link'];
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

    public function getParticularTressVideo( Request $request ) {
        try {
            $language = $request->input( 'language', 'english' );
            
            $tress_id = $request->input( 'tress_id' );

            $basic_query_object = Tress::where('is_active', true)
            ->where('id', $tress_id);

            if ( $language == 'hindi' ) {
                $data_output =   $basic_query_object->select('id','hindi_video_upload');
            } else {
                $data_output =  $basic_query_object->select('id','english_video_upload');
            }

            $data_output =  $data_output->get()->toArray();

            foreach ( $data_output as &$flowerdetail ) {
                if ($language == 'hindi') {
                    $flowerdetail['hindi_video_upload'] = Config::get('DocumentConstant.TRESS_VIEW') . $flowerdetail['hindi_video_upload'];
                } else {
                    $flowerdetail['english_video_upload'] = Config::get('DocumentConstant.TRESS_VIEW') . $flowerdetail['english_video_upload'];
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
