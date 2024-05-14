<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use App\Models\ {
    Amenities,
    CategoryAmenities
};


class AmenitiesController extends Controller
{
      public function getAmenitiesCategory(Request $request) {
        try {
            $language = $request->input('language', 'english'); 
            $data_output = CategoryAmenities::where('is_active','=',true);
            if ($language == 'hindi') {
                $data_output =  $data_output->select('id','hindi_name as name');
            } else {
                $data_output = $data_output->select('id','english_name as name');
            }
            $data_output =  $data_output->get()
                            ->toArray();
                            
            return response()->json([
                'status' => true,
                'message' => 'All data retrieved successfully',
                'data' => $data_output
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Amenities Category List Fail',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    public function getAllAmenitiesList(Request $request){
        try {
            $language = $request->input('language', 'english');
            $aminities_id = $request->input( 'aminities_id' );

            $page = isset( $request[ 'start' ] ) ? $request[ 'start' ] : Config::get( 'DocumentConstant.DEFAULT_START' ) ;
            $rowperpage = DEFAULT_LENGTH;
            $start = ( $page - 1 ) * $rowperpage;

           
            $basic_query_object = Amenities::where('tbl_amenities.is_active', true)
            ->when($aminities_id, function ($query) use ($aminities_id) {
                $query->where('id', $aminities_id);
            });
            $totalRecords = $basic_query_object->select('tbl_amenities.id')->get()->count();
            if ($language == 'hindi') {
                $data_output =   $basic_query_object->select('id', 'hindi_name as name', 'hindi_description as description', 'hindi_audio_link as audio_link', 'hindi_video_upload as video_upload', 'image', 'latitude', 'longitude' );
            } else {
                $data_output =  $basic_query_object->select('id', 'english_name as name', 'english_description as description', 'english_audio_link as audio_link', 'english_video_upload as video_upload', 'image', 'latitude', 'longitude' );
            }
            $data_output =  $data_output->skip($start)
            ->take($rowperpage)->get()
            ->toArray();


            foreach ( $data_output as &$flowerdetail ) {
                $flowerdetail[ 'image' ] = Config::get( 'DocumentConstant.AMENITIES_VIEW' ) . $flowerdetail[ 'image' ];
                if ($language == 'hindi') {
                    $flowerdetail['audio_link'] = Config::get('DocumentConstant.AMENITIES_VIEW') . $flowerdetail['audio_link'];
                } else {
                    $flowerdetail['audio_link'] = Config::get('DocumentConstant.AMENITIES_VIEW') . $flowerdetail['audio_link'];
                }
                if ($language == 'hindi') {
                    $flowerdetail['video_upload'] = Config::get('DocumentConstant.AMENITIES_VIEW') . $flowerdetail['video_upload'];
                } else {
                    $flowerdetail['video_upload'] = Config::get('DocumentConstant.AMENITIES_VIEW') . $flowerdetail['video_upload'];
                }

            }
            if ( sizeof( $data_output ) > 0 ) {
                $totalPages = ceil( $totalRecords/$rowperpage );
            } else {
                $totalPages = 0;
            }

            return response()->json(['status' => 'true', 'message' => 'All data retrieved successfully', 
            'totalRecords' => $totalRecords,
            'totalPages'=>$totalPages, 
            'page_no_to_hilight'=>$page,
            'data' => $data_output], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'false', 'message' => 'Amenities Us List Fail', 'error' => $e->getMessage()], 500);
        }
    }
    // public function getAllAmenitiesList(Request $request){
    //     try {
    //         $language = $request->input('language', 'english');
    //         $category_id = $request->input('amenities_category_id');
    //         $data_output = Amenities::where('tbl_amenities.is_active', true); 
    //         if ($language == 'hindi') {
    //             $data_output = $data_output->leftJoin('tbl_amenities_category', 'tbl_amenities.amenities_category_id', '=', 'tbl_amenities_category.id')
    //             ->select('tbl_amenities.hindi_name as name', 'tbl_amenities.amenities_category_id', 'tbl_amenities.hindi_description as description', 'tbl_amenities.hindi_audio_link as audio_link', 'tbl_amenities.hindi_video_upload as video_upload', 'tbl_amenities.image')
    //             ->when($category_id, function ($query) use ($category_id) {
    //                 $query->where('tbl_amenities_category.id', $category_id);
    //             });
    //         } else {
    //             $data_output = $data_output->leftJoin('tbl_amenities_category', 'tbl_amenities.amenities_category_id', '=', 'tbl_amenities_category.id')
    //             ->select('tbl_amenities.english_name as name', 'tbl_amenities.amenities_category_id', 'tbl_amenities.english_description as description', 'tbl_amenities.english_audio_link as audio_link', 'tbl_amenities.english_video_upload as video_upload', 'tbl_amenities.image')
    //         ->when($category_id, function ($query) use ($category_id) {
    //                 $query->where('tbl_amenities_category.id', $category_id);
    //             });
    //         }
    //         $data_output = $data_output->get()->toArray();

    //         foreach ( $data_output as &$flowerdetail ) {
    //             $flowerdetail[ 'image' ] = Config::get( 'DocumentConstant.AMENITIES_VIEW' ) . $flowerdetail[ 'image' ];
    //             if ($language == 'hindi') {
    //                 $flowerdetail['audio_link'] = Config::get('DocumentConstant.AMENITIES_VIEW') . $flowerdetail['audio_link'];
    //             } else {
    //                 $flowerdetail['audio_link'] = Config::get('DocumentConstant.AMENITIES_VIEW') . $flowerdetail['audio_link'];
    //             }
    //             if ($language == 'hindi') {
    //                 $flowerdetail['video_upload'] = Config::get('DocumentConstant.AMENITIES_VIEW') . $flowerdetail['video_upload'];
    //             } else {
    //                 $flowerdetail['video_upload'] = Config::get('DocumentConstant.AMENITIES_VIEW') . $flowerdetail['video_upload'];
    //             }

    //         }

    //         return response()->json(['status' => 'true', 'message' => 'All data retrieved successfully', 'data' => $data_output], 200);
    //     } catch (\Exception $e) {
    //         return response()->json(['status' => 'false', 'message' => 'Amenities Us List Fail', 'error' => $e->getMessage()], 500);
    //     }
    // }
    public function getParticularAmenitiesAudio( Request $request ) {
        try {
            $language = $request->input( 'language', 'english' );
            
            $amenities_id = $request->input( 'amenities_id' );

            $basic_query_object = Amenities::where('is_active', true)
            ->where('id', $amenities_id);

            if ( $language == 'hindi' ) {
                $data_output =   $basic_query_object->select('id','hindi_audio_link as audio_link', 'icon');
            } else {
                $data_output =  $basic_query_object->select('id','english_audio_link as audio_link', 'icon');
            }

            $data_output =  $data_output->get()->toArray();

            foreach ( $data_output as &$flowerdetail ) {
                if ($language == 'hindi') {
                    $flowerdetail['audio_link'] = Config::get('DocumentConstant.AMENITIES_VIEW') . $flowerdetail['audio_link'];
                } else {
                    $flowerdetail['audio_link'] = Config::get('DocumentConstant.AMENITIES_VIEW') . $flowerdetail['audio_link'];
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
    public function getParticularAmenitiesVideo( Request $request ) {
        try {
            $language = $request->input( 'language', 'english' );
            
            $amenities_id = $request->input( 'amenities_id' );

            $basic_query_object = Flowers::where('is_active', true)
            ->where('id', $amenities_id);

            if ( $language == 'hindi' ) {
                $data_output =   $basic_query_object->select('id','hindi_video_upload as video_upload');
            } else {
                $data_output =  $basic_query_object->select('id','english_video_upload as video_upload');
            }

            $data_output =  $data_output->get()->toArray();

            foreach ( $data_output as &$flowerdetail ) {
                if ($language == 'hindi') {
                    $flowerdetail['video_upload'] = Config::get('DocumentConstant.AMENITIES_VIEW') . $flowerdetail['video_upload'];
                } else {
                    $flowerdetail['video_upload'] = Config::get('DocumentConstant.AMENITIES_VIEW') . $flowerdetail['video_upload'];
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
