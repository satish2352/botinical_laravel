<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Validator;
use App\Models\ {
    Amenities,
    CategoryAmenities
};


class AmenitiesController extends Controller
{

    public function addAmenities(Request $request) {
        // Define the validation rules
        $validator = Validator::make($request->all(), [
            'english_name' => 'required',
            'hindi_name' => 'required',
            'english_description' => 'required',
            'hindi_description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'english_audio_link' => 'required',
            'hindi_audio_link' => 'required',
            'english_video_upload' => 'required|mimes:mp4,mov,avi|max:10000',
            'hindi_video_upload' => 'required|mimes:mp4,mov,avi|max:10000',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
        ]);
    
        // Define custom validation messages
        $customMessages = [
            'english_name.required' => 'English name is required.',
            'hindi_name.required' => 'Hindi name is required.',
            'english_description.required' => 'English description is required.',
            'hindi_description.required' => 'Hindi description is required.',
            'image.required' => 'Image is required.',
            'image.image' => 'Image must be a valid image file.',
            'image.mimes' => 'Image must be a file of type: jpeg, png, jpg.',
            'image.max' => 'Image size must not exceed 2048 KB.',
            'english_audio_link.required' => 'English audio link is required.',
            'hindi_audio_link.required' => 'Hindi audio link is required.',
            'english_video_upload.required' => 'English video upload is required.',
            'english_video_upload.mimes' => 'English video must be a file of type: mp4, mov, avi.',
            'english_video_upload.max' => 'English video size must not exceed 10000 KB.',
            'hindi_video_upload.required' => 'Hindi video upload is required.',
            'hindi_video_upload.mimes' => 'Hindi video must be a file of type: mp4, mov, avi.',
            'hindi_video_upload.max' => 'Hindi video size must not exceed 10000 KB.',
            'latitude.required' => 'Latitude is required.',
            'latitude.numeric' => 'Latitude must be a number.',
            'latitude.between' => 'Latitude must be between -90 and 90.',
            'longitude.required' => 'Longitude is required.',
            'longitude.numeric' => 'Longitude must be a number.',
            'longitude.between' => 'Longitude must be between -180 and 180.',
          
        ];
    
        // Check if validation fails
        if ($validator->fails()) {
            return response()->json(['status' => 'false', 'message' => $validator->errors()->all()], 200);
        }
    
        try {
            // Save tree data
            $amenities_data = new Amenities();
            $amenities_data->amenities_category_id = $request->amenities_category_id;
            $amenities_data->icon_id = $request->icon_id;
            $amenities_data->english_name = $request->english_name;
            $amenities_data->hindi_name = $request->hindi_name;
            $amenities_data->english_description = $request->english_description;
            $amenities_data->hindi_description = $request->hindi_description;
            $amenities_data->latitude = $request->latitude;
            $amenities_data->longitude = $request->longitude;
            $amenities_data->open_time_first = $request->open_time_first;
            $amenities_data->close_time_first = $request->close_time_first;
            $amenities_data->open_time_second = $request->open_time_second;
            $amenities_data->close_time_second = $request->close_time_second;
            $amenities_data->save();
    
            // Get last inserted ID
            $last_insert_id = $amenities_data->id;
    
            // Handle file uploads
            $treeImage = $last_insert_id . '_' . rand(100000, 999999) . '_image.' . $request->image->extension();
            $englishAudio = $last_insert_id . '_' . rand(100000, 999999) . '_english.' . $request->english_audio_link->extension();
            $hindiAudio = $last_insert_id . '_' . rand(100000, 999999) . '_hindi.' . $request->hindi_audio_link->extension();
            $englishVideo = $last_insert_id . '_' . rand(100000, 999999) . '_english.' . $request->english_video_upload->extension();
            $hindiVideo = $last_insert_id . '_' . rand(100000, 999999) . '_hindi.' . $request->hindi_video_upload->extension();
            $path = Config::get('DocumentConstant.AMENITIES_ADD');
    
            // Save files
            $request->image->move(public_path($path), $treeImage);
            $request->english_audio_link->move(public_path($path), $englishAudio);
            $request->hindi_audio_link->move(public_path($path), $hindiAudio);
            $request->english_video_upload->move(public_path($path), $englishVideo);
            $request->hindi_video_upload->move(public_path($path), $hindiVideo);
    
            // Update tree data with file names
            $amenities_data->image = $treeImage;
            $amenities_data->english_audio_link = $englishAudio;
            $amenities_data->hindi_audio_link = $hindiAudio;
            $amenities_data->english_video_upload = $englishVideo;
            $amenities_data->hindi_video_upload = $hindiVideo;
            $amenities_data->save();
    
            return response()->json(['status' => 'true', 'message' => 'Plant added successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'false', 'message' => 'Plant addition failed', 'error' => $e->getMessage()], 500);
        }
    }
      public function getAmenitiesCategory(Request $request) {
        try {
            $language = $request->input('language', 'english'); 
            $data_output = CategoryAmenities::where('is_active','=',true);
            if ($language == 'hindi') {
                $data_output =  $data_output->select('id','hindi_name as name', 'icon');
            } else {
                $data_output = $data_output->select('id','english_name as name', 'icon');
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
    
    // public function getAllAmenitiesList(Request $request){
    //     try {
    //         $language = $request->input('language', 'english');
    //         $aminities_id = $request->input( 'aminities_id' );

    //         $page = isset( $request[ 'start' ] ) ? $request[ 'start' ] : Config::get( 'DocumentConstant.DEFAULT_START' ) ;
    //         $rowperpage = DEFAULT_LENGTH;
    //         $start = ( $page - 1 ) * $rowperpage;

           
    //         $basic_query_object = Amenities::where('tbl_amenities.is_active', true)
    //         ->when($aminities_id, function ($query) use ($aminities_id) {
    //             $query->where('id', $aminities_id);
    //         });
    //         $totalRecords = $basic_query_object->select('tbl_amenities.id')->get()->count();
    //         if ($language == 'hindi') {
    //             $data_output =   $basic_query_object->select('id', 'hindi_name as name', 'hindi_description as description', 'hindi_audio_link as audio_link', 'hindi_video_upload as video_upload', 'image', 'latitude', 'longitude');
    //         } else {
    //             $data_output =  $basic_query_object->select('id', 'english_name as name', 'english_description as description', 'english_audio_link as audio_link', 'english_video_upload as video_upload', 'image', 'latitude', 'longitude');
    //         }
    //         $data_output =  $data_output->skip($start)
    //         ->take($rowperpage)->get()
    //         ->toArray();


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
    //         if ( sizeof( $data_output ) > 0 ) {
    //             $totalPages = ceil( $totalRecords/$rowperpage );
    //         } else {
    //             $totalPages = 0;
    //         }

    //         return response()->json(['status' => 'true', 'message' => 'All data retrieved successfully', 
    //         'totalRecords' => $totalRecords,
    //         'totalPages'=>$totalPages, 
    //         'page_no_to_hilight'=>$page,
    //         'data' => $data_output], 200);
    //     } catch (\Exception $e) {
    //         return response()->json(['status' => 'false', 'message' => 'Amenities Us List Fail', 'error' => $e->getMessage()], 500);
    //     }
    // }
    public function getAllAmenitiesList(Request $request){
        try {
            $language = $request->input('language', 'english');
            $category_id = $request->input('amenities_category_id');
            $amenities_id = $request->input('amenities_id');

            $page = isset( $request[ 'start' ] ) ? $request[ 'start' ] : Config::get( 'DocumentConstant.DEFAULT_START' ) ;
            $rowperpage = DEFAULT_LENGTH;
            $start = ( $page - 1 ) * $rowperpage;


            $basic_query_object = Amenities::where('tbl_amenities.is_active', true)
            ->when($amenities_id, function ($query) use ($amenities_id) {
                $query->where('tbl_amenities.id', $amenities_id); 
            });

            $totalRecords = $basic_query_object->select('tbl_amenities.id')->get()->count();

            if ($language == 'hindi') {
                $data_output = $basic_query_object->leftJoin('tbl_amenities_category', 'tbl_amenities.amenities_category_id', '=', 'tbl_amenities_category.id')
                ->select('tbl_amenities.id as id','tbl_amenities_category.hindi_name as category_name','tbl_amenities.hindi_name as name', 'tbl_amenities.amenities_category_id', 'tbl_amenities.hindi_description as description', 'tbl_amenities.hindi_audio_link as audio_link', 'tbl_amenities.hindi_video_upload as video_upload', 'tbl_amenities.image', 'tbl_amenities.open_time_first', 'tbl_amenities.close_time_first', 'tbl_amenities.open_time_second', 'tbl_amenities.close_time_second','tbl_amenities.image_two', 'tbl_amenities.image_three', 'tbl_amenities.image_four', 'tbl_amenities.image_five', 'tbl_amenities.latitude', 'tbl_amenities.longitude')
                ->when($category_id, function ($query) use ($category_id) {
                    $query->where('tbl_amenities_category.id', $category_id);
                });
            } else {
                $data_output = $basic_query_object->leftJoin('tbl_amenities_category', 'tbl_amenities.amenities_category_id', '=', 'tbl_amenities_category.id')
                ->select('tbl_amenities.id as id','tbl_amenities_category.english_name as category_name','tbl_amenities.english_name as name', 'tbl_amenities.amenities_category_id', 'tbl_amenities.english_description as description', 'tbl_amenities.english_audio_link as audio_link', 'tbl_amenities.english_video_upload as video_upload', 'tbl_amenities.image', 'tbl_amenities.open_time_first', 'tbl_amenities.close_time_first', 'tbl_amenities.open_time_second', 'tbl_amenities.close_time_second','tbl_amenities.image_two', 'tbl_amenities.image_three', 'tbl_amenities.image_four', 'tbl_amenities.image_five', 'tbl_amenities.latitude', 'tbl_amenities.longitude')
            ->when($category_id, function ($query) use ($category_id) {
                    $query->where('tbl_amenities_category.id', $category_id);
                });
            }
            $data_output =  $data_output->skip($start)
            ->take($rowperpage)->get()
            ->toArray();

            // foreach ( $data_output as &$flowerdetail ) {
            //     $flowerdetail[ 'image' ] = Config::get( 'DocumentConstant.AMENITIES_VIEW' ) . $flowerdetail[ 'image' ];
            //     $flowerdetail[ 'image_two' ] = Config::get( 'DocumentConstant.AMENITIES_VIEW' ) . $flowerdetail[ 'image_two' ];
            //     $flowerdetail[ 'image_three' ] = Config::get( 'DocumentConstant.AMENITIES_VIEW' ) . $flowerdetail[ 'image_three' ];
            //     $flowerdetail[ 'image_four' ] = Config::get( 'DocumentConstant.AMENITIES_VIEW' ) . $flowerdetail[ 'image_four' ];
            //     $flowerdetail[ 'image_five' ] = Config::get( 'DocumentConstant.AMENITIES_VIEW' ) . $flowerdetail[ 'image_five' ];
                                
            //     if ($language == 'hindi') {
            //         $flowerdetail['audio_link'] = Config::get('DocumentConstant.AMENITIES_VIEW') . $flowerdetail['audio_link'];
            //     } else {
            //         $flowerdetail['audio_link'] = Config::get('DocumentConstant.AMENITIES_VIEW') . $flowerdetail['audio_link'];
            //     }
            //     if ($language == 'hindi') {
            //         $flowerdetail['video_upload'] = Config::get('DocumentConstant.AMENITIES_VIEW') . $flowerdetail['video_upload'];
            //     } else {
            //         $flowerdetail['video_upload'] = Config::get('DocumentConstant.AMENITIES_VIEW') . $flowerdetail['video_upload'];
            //     }

            // }

            foreach ($data_output as &$amenity) {
            $amenity['image'] = Config::get('DocumentConstant.AMENITIES_VIEW') . $amenity['image'];
            $amenity['image_two'] = $amenity['image_two'] ? Config::get('DocumentConstant.AMENITIES_VIEW') . $amenity['image_two'] : null;
            $amenity['image_three'] = $amenity['image_three'] ? Config::get('DocumentConstant.AMENITIES_VIEW') . $amenity['image_three'] : null;
            $amenity['image_four'] = $amenity['image_four'] ? Config::get('DocumentConstant.AMENITIES_VIEW') . $amenity['image_four'] : null;
            $amenity['image_five'] = $amenity['image_five'] ? Config::get('DocumentConstant.AMENITIES_VIEW') . $amenity['image_five'] : null;

            if ($language == 'hindi') {
                $amenity['audio_link'] = $amenity['audio_link'] ? Config::get('DocumentConstant.AMENITIES_VIEW') . $amenity['audio_link'] : null;
                $amenity['video_upload'] = $amenity['video_upload'] ? Config::get('DocumentConstant.AMENITIES_VIEW') . $amenity['video_upload'] : null;
            } else {
                $amenity['audio_link'] = $amenity['audio_link'] ? Config::get('DocumentConstant.AMENITIES_VIEW') . $amenity['audio_link'] : null;
                $amenity['video_upload'] = $amenity['video_upload'] ? Config::get('DocumentConstant.AMENITIES_VIEW') . $amenity['video_upload'] : null;
            }
        }


            if ( sizeof( $data_output ) > 0 ) {
                $totalPages = ceil( $totalRecords/$rowperpage );
            } else {
                $totalPages = 0;
            }

            return response()->json(['status' => 'true', 'message' => 'All data retrieved successfully', 'totalRecords' => $totalRecords,
                'totalPages'=>$totalPages, 
                'page_no_to_hilight'=>$page,
                'data' => $data_output], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'false', 'message' => 'Amenities Us List Fail', 'error' => $e->getMessage()], 500);
        }
    }
    public function getParticularAmenitiesAudio( Request $request ) {
        try {
            $language = $request->input( 'language', 'english' );
            
            $amenities_id = $request->input( 'amenities_id' );

            $basic_query_object = Amenities::where('is_active', true)
            ->where('id', $amenities_id);

            if ( $language == 'hindi' ) {
                $data_output =   $basic_query_object->select('id','hindi_audio_link as audio_link');
            } else {
                $data_output =  $basic_query_object->select('id','english_audio_link as audio_link');
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
