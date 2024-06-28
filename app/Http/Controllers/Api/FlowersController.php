<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Validator;
use App\Models\ {
    Flowers
};

class FlowersController extends Controller {

    public function addPlant(Request $request) {
        // Define the validation rules
        $validator = Validator::make($request->all(), [
            'english_name' => 'required',
            'hindi_name' => 'required',
            'english_botnical_name' => 'required', 
            'hindi_botnical_name' => 'required',
            'english_common_name' => 'required',
            'hindi_common_name' => 'required',
            'english_description' => 'required',
            'hindi_description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'english_audio_link' => 'required',
            'hindi_audio_link' => 'required',
            'english_video_upload' => 'required|mimes:mp4,mov,avi|max:10000',
            'hindi_video_upload' => 'required|mimes:mp4,mov,avi|max:10000',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'height' => 'required|numeric',
            'height_type' => 'required|string',
            'canopy' => 'required|numeric',
            'canopy_type' => 'required|string',
            'girth' => 'required|numeric',
            'girth_type' => 'required|string',
        ]);
    
        // Define custom validation messages
        $customMessages = [
            'english_name.required' => 'English name is required.',
            'hindi_name.required' => 'Hindi name is required.',
            'english_botnical_name.required' => 'English botanical name is required.',
            'hindi_botnical_name.required' => 'Hindi botanical name is required.',
            'english_common_name.required' => 'English common name is required.',
            'hindi_common_name.required' => 'Hindi common name is required.',
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
            'height.required' => 'Height is required.',
            'height.numeric' => 'Height must be a number.',
            'height_type.required' => 'Height type is required.',
            'height_type.string' => 'Height type must be a string.',
            'canopy.required' => 'Canopy is required.',
            'canopy.numeric' => 'Canopy must be a number.',
            'canopy_type.required' => 'Canopy type is required.',
            'canopy_type.string' => 'Canopy type must be a string.',
            'girth.required' => 'Girth is required.',
            'girth.numeric' => 'Girth must be a number.',
            'girth_type.required' => 'Girth type is required.',
            'girth_type.string' => 'Girth type must be a string.',
        ];
    
        // Check if validation fails
        if ($validator->fails()) {
            return response()->json(['status' => 'false', 'message' => $validator->errors()->all()], 200);
        }
    
        try {
            // Save tree data
            $tree_data = new Flowers();
            $tree_data->icon_id = $request->icon_id;
            $tree_data->english_name = $request->english_name;
            $tree_data->hindi_name = $request->hindi_name;
            $tree_data->english_botnical_name = $request->english_botnical_name;
            $tree_data->hindi_botnical_name = $request->hindi_botnical_name;
            $tree_data->english_common_name = $request->english_common_name;
            $tree_data->hindi_common_name = $request->hindi_common_name;
            $tree_data->english_description = $request->english_description;
            $tree_data->hindi_description = $request->hindi_description;
            $tree_data->latitude = $request->latitude;
            $tree_data->longitude = $request->longitude;
            $tree_data->height = $request->height;
            $tree_data->height_type = $request->height_type;
            $tree_data->canopy = $request->canopy;
            $tree_data->canopy_type = $request->canopy_type;
            $tree_data->girth = $request->girth;
            $tree_data->girth_type = $request->girth_type;
            $tree_data->save();
    
            // Get last inserted ID
            $last_insert_id = $tree_data->id;
    
            // Handle file uploads
            $treeImage = $last_insert_id . '_' . rand(100000, 999999) . '_image.' . $request->image->extension();
            $englishAudio = $last_insert_id . '_' . rand(100000, 999999) . '_english.' . $request->english_audio_link->extension();
            $hindiAudio = $last_insert_id . '_' . rand(100000, 999999) . '_hindi.' . $request->hindi_audio_link->extension();
            $englishVideo = $last_insert_id . '_' . rand(100000, 999999) . '_english.' . $request->english_video_upload->extension();
            $hindiVideo = $last_insert_id . '_' . rand(100000, 999999) . '_hindi.' . $request->hindi_video_upload->extension();
            $path = Config::get('DocumentConstant.FLOWERS_ADD');
    
            // Save files
            $request->image->move(public_path($path), $treeImage);
            $request->english_audio_link->move(public_path($path), $englishAudio);
            $request->hindi_audio_link->move(public_path($path), $hindiAudio);
            $request->english_video_upload->move(public_path($path), $englishVideo);
            $request->hindi_video_upload->move(public_path($path), $hindiVideo);
    
            // Update tree data with file names
            $tree_data->image = $treeImage;
            $tree_data->english_audio_link = $englishAudio;
            $tree_data->hindi_audio_link = $hindiAudio;
            $tree_data->english_video_upload = $englishVideo;
            $tree_data->hindi_video_upload = $hindiVideo;
            $tree_data->save();
    
            return response()->json(['status' => 'true', 'message' => 'Plant added successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'false', 'message' => 'Plant addition failed', 'error' => $e->getMessage()], 500);
        }
    }

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
                $data_output =   $basic_query_object->select('id', 'hindi_name as name', 'hindi_description as description', 'hindi_audio_link as audio_link', 'hindi_video_upload as video_upload', 'image', 'latitude', 'longitude', 'hindi_botnical_name as botnical_name','hindi_common_name as common_name','height','height_type', 'canopy', 'canopy_type','girth','image_two', 'image_three', 'image_four', 'image_five' );
            } else {
                $data_output =  $basic_query_object->select('id', 'english_name as name', 'english_description as description', 'english_audio_link as audio_link', 'english_video_upload as video_upload', 'image', 'latitude', 'longitude', 'english_botnical_name as botnical_name', 'english_common_name as common_name','height','height_type', 'canopy', 'canopy_type','girth','girth_type','image_two', 'image_three', 'image_four','image_five' );
            }

            $data_output =  $data_output->skip($start)
            ->take($rowperpage)->get()
            ->toArray();

            foreach ( $data_output as &$flowerdetail ) {
                $flowerdetail[ 'image' ] = Config::get( 'DocumentConstant.FLOWERS_VIEW' ) . $flowerdetail[ 'image' ];
                $flowerdetail[ 'image_two' ] = Config::get( 'DocumentConstant.FLOWERS_VIEW' ) . $flowerdetail[ 'image_two' ];
                $flowerdetail[ 'image_three' ] = Config::get( 'DocumentConstant.FLOWERS_VIEW' ) . $flowerdetail[ 'image_three' ];
                $flowerdetail[ 'image_four' ] = Config::get( 'DocumentConstant.FLOWERS_VIEW' ) . $flowerdetail[ 'image_four' ];
                $flowerdetail[ 'image_five' ] = Config::get( 'DocumentConstant.FLOWERS_VIEW' ) . $flowerdetail[ 'image_five' ];
                
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
