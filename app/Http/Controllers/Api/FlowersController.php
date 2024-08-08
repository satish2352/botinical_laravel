<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Validator;
use App\Models\ {
    Flowers,
    Tress,
    Amenities
};

class FlowersController extends Controller {


    public function addTreePlantAminities(Request $request) {
        $type = $request->input('type'); // Get the type from the request
    
        // Define validation rules and custom messages for tree, flower, and amenities
        $validationRules = [
            'tree' => [
                'tree_plant_id' => 'required',
                'english_description' => 'required',
                'hindi_description' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'english_audio_link' => 'required',
                'hindi_audio_link' => 'required',
                'english_video_upload' => 'required|mimes:mp4|max:10000',
                'hindi_video_upload' => 'required|mimes:mp4|max:10000',
                'latitude' => 'required|numeric|between:-90,90',
                'longitude' => 'required|numeric|between:-180,180',
                'height' => 'required|numeric',
                'height_type' => 'required|string',
                'canopy' => 'required|numeric',
                'canopy_type' => 'required|string',
                'girth' => 'required|numeric',
                'girth_type' => 'required|string',
                'image_two' => 'sometimes|nullable|image|mimes:jpeg,png,jpg|max:'.Config::get('AllFileValidation.TRESS_IMAGE_MAX_SIZE').'|min:'.Config::get('AllFileValidation.TRESS_IMAGE_MIN_SIZE'),
                'image_three' => 'sometimes|nullable|image|mimes:jpeg,png,jpg|max:'.Config::get('AllFileValidation.TRESS_IMAGE_MAX_SIZE').'|min:'.Config::get('AllFileValidation.TRESS_IMAGE_MIN_SIZE'),
                'image_four' => 'sometimes|nullable|image|mimes:jpeg,png,jpg|max:'.Config::get('AllFileValidation.TRESS_IMAGE_MAX_SIZE').'|min:'.Config::get('AllFileValidation.TRESS_IMAGE_MIN_SIZE'),
                'image_five' => 'sometimes|nullable|image|mimes:jpeg,png,jpg|max:'.Config::get('AllFileValidation.TRESS_IMAGE_MAX_SIZE').'|min:'.Config::get('AllFileValidation.TRESS_IMAGE_MIN_SIZE'),
            ],
            'flower' => [
                'tree_plant_id' => 'required',
                'english_description' => 'required',
                'hindi_description' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'english_audio_link' => 'required',
                'hindi_audio_link' => 'required',
                'english_video_upload' => 'required|mimes:mp4|max:10000',
                'hindi_video_upload' => 'required|mimes:mp4|max:10000',
                'latitude' => 'required|numeric|between:-90,90',
                'longitude' => 'required|numeric|between:-180,180',
                'height' => 'required|numeric',
                'height_type' => 'required|string',
                'canopy' => 'required|numeric',
                'canopy_type' => 'required|string',
                'girth' => 'required|numeric',
                'girth_type' => 'required|string',
                'image_two' => 'sometimes|nullable|image|mimes:jpeg,png,jpg|max:'.Config::get('AllFileValidation.FLOWERS_IMAGE_MAX_SIZE').'|min:'.Config::get('AllFileValidation.FLOWERS_IMAGE_MIN_SIZE'),
                'image_three' => 'sometimes|nullable|image|mimes:jpeg,png,jpg|max:'.Config::get('AllFileValidation.FLOWERS_IMAGE_MAX_SIZE').'|min:'.Config::get('AllFileValidation.FLOWERS_IMAGE_MIN_SIZE'),
                'image_four' => 'sometimes|nullable|image|mimes:jpeg,png,jpg|max:'.Config::get('AllFileValidation.FLOWERS_IMAGE_MAX_SIZE').'|min:'.Config::get('AllFileValidation.FLOWERS_IMAGE_MIN_SIZE'),
                'image_five' => 'sometimes|nullable|image|mimes:jpeg,png,jpg|max:'.Config::get('AllFileValidation.FLOWERS_IMAGE_MAX_SIZE').'|min:'.Config::get('AllFileValidation.FLOWERS_IMAGE_MIN_SIZE'),
            ],
            'aminities' => [
                'english_name' => 'required',
                'hindi_name' => 'required',
                'english_description' => 'required',
                'hindi_description' => 'required',
                'latitude' => 'required|numeric|between:-90,90',
                'longitude' => 'required|numeric|between:-180,180',
                'english_audio_link' => 'sometimes|nullable|image|mimes:mp3|max:'.Config::get('AllFileValidation.AUDIO_MAX_SIZE').'|min:'.Config::get('AllFileValidation.AUDIO_MIN_SIZE'),
                'hindi_audio_link' => 'sometimes|nullable|image|mimes:mp3|max:'.Config::get('AllFileValidation.AUDIO_MAX_SIZE').'|min:'.Config::get('AllFileValidation.AUDIO_MIN_SIZE'),
                'english_video_upload' => 'sometimes|nullable|image|mimetypes:video/mp4|max:'.Config::get('AllFileValidation.VIDEO_MAX_SIZE').'|min:'.Config::get('AllFileValidation.VIDEO_MIN_SIZE'),
                'hindi_video_upload' => 'sometimes|nullable|image|mimetypes:video/mp4|max:'.Config::get('AllFileValidation.VIDEO_MAX_SIZE').'|min:'.Config::get('AllFileValidation.VIDEO_MIN_SIZE'),
                'image' => 'sometimes|nullable|image|mimes:jpeg,png,jpg|max:'.Config::get('AllFileValidation.AMENITIES_IMAGE_MAX_SIZE').'|min:'.Config::get('AllFileValidation.AMENITIES_IMAGE_MIN_SIZE'),
                'image_two' => 'sometimes|nullable|image|mimes:jpeg,png,jpg|max:'.Config::get('AllFileValidation.AMENITIES_IMAGE_MAX_SIZE').'|min:'.Config::get('AllFileValidation.AMENITIES_IMAGE_MIN_SIZE'),
                'image_three' => 'sometimes|nullable|image|mimes:jpeg,png,jpg|max:'.Config::get('AllFileValidation.AMENITIES_IMAGE_MAX_SIZE').'|min:'.Config::get('AllFileValidation.AMENITIES_IMAGE_MIN_SIZE'),
                'image_four' => 'sometimes|nullable|image|mimes:jpeg,png,jpg|max:'.Config::get('AllFileValidation.AMENITIES_IMAGE_MAX_SIZE').'|min:'.Config::get('AllFileValidation.AMENITIES_IMAGE_MIN_SIZE'),
                'image_five' => 'sometimes|nullable|image|mimes:jpeg,png,jpg|max:'.Config::get('AllFileValidation.AMENITIES_IMAGE_MAX_SIZE').'|min:'.Config::get('AllFileValidation.AMENITIES_IMAGE_MIN_SIZE'),
            ]
        ];
    
        $customMessages = [
            // Tree validation messages
            'tree.tree_plant_id.required' => 'Please select tree plant name.',
            'tree.english_description.required' => 'English description is required.',
            'tree.hindi_description.required' => 'Hindi description is required.',
            'tree.image.required' => 'Image is required.',
            'tree.image.image' => 'Image must be a valid image file.',
            'tree.image.mimes' => 'Image must be a file of type: jpeg, png, jpg.',
            'tree.image.max' => 'Image size must not exceed 2048 KB.',
            'tree.english_audio_link.required' => 'English audio link is required.',
            'tree.hindi_audio_link.required' => 'Hindi audio link is required.',
            'tree.english_video_upload.required' => 'English video upload is required.',
            'tree.english_video_upload.mimes' => 'English video must be a file of type: mp4.',
            'tree.english_video_upload.max' => 'English video size must not exceed 10000 KB.',
            'tree.hindi_video_upload.required' => 'Hindi video upload is required.',
            'tree.hindi_video_upload.mimes' => 'Hindi video must be a file of type: mp4.',
            'tree.hindi_video_upload.max' => 'Hindi video size must not exceed 10000 KB.',
            'tree.latitude.required' => 'Latitude is required.',
            'tree.latitude.numeric' => 'Latitude must be a number.',
            'tree.latitude.between' => 'Latitude must be between -90 and 90.',
            'tree.longitude.required' => 'Longitude is required.',
            'tree.longitude.numeric' => 'Longitude must be a number.',
            'tree.longitude.between' => 'Longitude must be between -180 and 180.',
            'tree.height.required' => 'Height is required.',
            'tree.height.numeric' => 'Height must be a number.',
            'tree.height_type.required' => 'Height type is required.',
            'tree.height_type.string' => 'Height type must be a string.',
            'tree.canopy.required' => 'Canopy is required.',
            'tree.canopy.numeric' => 'Canopy must be a number.',
            'tree.canopy_type.required' => 'Canopy type is required.',
            'tree.canopy_type.string' => 'Canopy type must be a string.',
            'tree.girth.required' => 'Girth is required.',
            'tree.girth.numeric' => 'Girth must be a number.',
            'tree.girth_type.required' => 'Girth type is required.',
            'tree.girth_type.string' => 'Girth type must be a string.',
            'tree.image_two.sometimes' => 'The image is required.',
            'tree.image_two.image' => 'The file must be an image.',
            'tree.image_two.mimes' => 'The image must be in JPEG, PNG, or JPG format.',
            'tree.image_two.max' => 'The image size must not exceed ' . Config::get('AllFileValidation.TRESS_IMAGE_MAX_SIZE') . ' KB.',
            'tree.image_two.min' => 'The image size must be at least ' . Config::get('AllFileValidation.TRESS_IMAGE_MIN_SIZE') . ' KB.',
            // Repeat similar structure for image_three, image_four, image_five...
        
            // Flower validation messages
            'flower.tree_plant_id.required' => 'Please select tree plant name.',
            'flower.english_description.required' => 'English description is required.',
            'flower.hindi_description.required' => 'Hindi description is required.',
            'flower.image.required' => 'Image is required.',
            'flower.image.image' => 'Image must be a valid image file.',
            'flower.image.mimes' => 'Image must be a file of type: jpeg, png, jpg.',
            'flower.image.max' => 'Image size must not exceed 2048 KB.',
            'flower.english_audio_link.required' => 'English audio link is required.',
            'flower.hindi_audio_link.required' => 'Hindi audio link is required.',
            'flower.english_video_upload.required' => 'English video upload is required.',
            'flower.english_video_upload.mimes' => 'English video must be a file of type: mp4.',
            'flower.english_video_upload.max' => 'English video size must not exceed 10000 KB.',
            'flower.hindi_video_upload.required' => 'Hindi video upload is required.',
            'flower.hindi_video_upload.mimes' => 'Hindi video must be a file of type: mp4.',
            'flower.hindi_video_upload.max' => 'Hindi video size must not exceed 10000 KB.',
            'flower.latitude.required' => 'Latitude is required.',
            'flower.latitude.numeric' => 'Latitude must be a number.',
            'flower.latitude.between' => 'Latitude must be between -90 and 90.',
            'flower.longitude.required' => 'Longitude is required.',
            'flower.longitude.numeric' => 'Longitude must be a number.',
            'flower.longitude.between' => 'Longitude must be between -180 and 180.',
            'flower.height.required' => 'Height is required.',
            'flower.height.numeric' => 'Height must be a number.',
            'flower.height_type.required' => 'Height type is required.',
            'flower.height_type.string' => 'Height type must be a string.',
            'flower.canopy.required' => 'Canopy is required.',
            'flower.canopy.numeric' => 'Canopy must be a number.',
            'flower.canopy_type.required' => 'Canopy type is required.',
            'flower.canopy_type.string' => 'Canopy type must be a string.',
            'flower.girth.required' => 'Girth is required.',
            'flower.girth.numeric' => 'Girth must be a number.',
            'flower.girth_type.required' => 'Girth type is required.',
            'flower.girth_type.string' => 'Girth type must be a string.',
            'flower.image_two.sometimes' => 'The image is required.',
            'flower.image_two.image' => 'The file must be an image.',
            'flower.image_two.mimes' => 'The image must be in JPEG, PNG, or JPG format.',
            'flower.image_two.max' => 'The image size must not exceed ' . Config::get('AllFileValidation.FLOWERS_IMAGE_MAX_SIZE') . ' KB.',
            'flower.image_two.min' => 'The image size must be at least ' . Config::get('AllFileValidation.FLOWERS_IMAGE_MIN_SIZE') . ' KB.',
            // Repeat similar structure for image_three, image_four, image_five...
        
            // Amenities validation messages
            'aminities.english_name.required' => 'English name is required.',
            'aminities.hindi_name.required' => 'Hindi name is required.',
            'aminities.english_description.required' => 'English description is required.',
            'aminities.hindi_description.required' => 'Hindi description is required.',
            'aminities.latitude.required' => 'Latitude is required.',
            'aminities.latitude.numeric' => 'Latitude must be a number.',
            'aminities.latitude.between' => 'Latitude must be between -90 and 90.',
            'aminities.longitude.required' => 'Longitude is required.',
            'aminities.longitude.numeric' => 'Longitude must be a number.',
            'aminities.longitude.between' => 'Longitude must be between -180 and 180.',
            'aminities.english_audio_link.sometimes' => 'English audio link is required.',
            'aminities.english_audio_link.mimes' => 'English audio must be a file of type: mp3.',
            'aminities.english_audio_link.max' => 'English audio size must not exceed ' . Config::get('AllFileValidation.AUDIO_MAX_SIZE') . ' KB.',
            'aminities.english_audio_link.min' => 'English audio size must be at least ' . Config::get('AllFileValidation.AUDIO_MIN_SIZE') . ' KB.',
            'aminities.hindi_audio_link.sometimes' => 'Hindi audio link is required.',
            'aminities.hindi_audio_link.mimes' => 'Hindi audio must be a file of type: mp3.',
            'aminities.hindi_audio_link.max' => 'Hindi audio size must not exceed ' . Config::get('AllFileValidation.AUDIO_MAX_SIZE') . ' KB.',
            'aminities.hindi_audio_link.min' => 'Hindi audio size must be at least ' . Config::get('AllFileValidation.AUDIO_MIN_SIZE') . ' KB.',
            'aminities.english_video_upload.sometimes' => 'English video upload is required.',
            'aminities.english_video_upload.mimetypes' => 'English video must be of type: video/mp4.',
            'aminities.english_video_upload.max' => 'English video size must not exceed ' . Config::get('AllFileValidation.VIDEO_MAX_SIZE') . ' KB.',
            'aminities.english_video_upload.min' => 'English video size must be at least ' . Config::get('AllFileValidation.VIDEO_MIN_SIZE') . ' KB.',
            'aminities.hindi_video_upload.sometimes' => 'Hindi video upload is required.',
            'aminities.hindi_video_upload.mimetypes' => 'Hindi video must be of type: video/mp4.',
            'aminities.hindi_video_upload.max' => 'Hindi video size must not exceed ' . Config::get('AllFileValidation.VIDEO_MAX_SIZE') . ' KB.',
            'aminities.hindi_video_upload.min' => 'Hindi video size must be at least ' . Config::get('AllFileValidation.VIDEO_MIN_SIZE') . ' KB.',
        ];
        
    
        // Check if type is valid
        if (!array_key_exists($type, $validationRules)) {
            return response()->json(['status' => 'false', 'message' => 'Invalid type provided'], 400);
        }
    
        // Validate request based on type
        $validator = Validator::make($request->all(), $validationRules[$type], $customMessages);
    
        // Check if validation fails
        if ($validator->fails()) {
            return response()->json(['status' => 'false', 'message' => $validator->errors()->all()], 200);
        }
    
        try {
            if ($type == 'tree') {
                $data = new Tress();
            } elseif ($type == 'flower') {
                $data = new Flowers();
            } elseif ($type == 'aminities') {
                $data = new Amenities();
                $data->english_name = $request->english_name;
                $data->hindi_name = $request->hindi_name;
            }
    
            // Set common attributes
            $data->icon_id = $request->icon_id;
            $data->tree_plant_id = $request->tree_plant_id;
            $data->english_description = $request->english_description;
            $data->hindi_description = $request->hindi_description;
            $data->latitude = $request->latitude;
            $data->longitude = $request->longitude;
            if ($type != 'aminities') {
                $data->height = $request->height;
                $data->height_type = $request->height_type;
                $data->canopy = $request->canopy;
                $data->canopy_type = $request->canopy_type;
                $data->girth = $request->girth;
                $data->girth_type = $request->girth_type;
            } else {
                $data->open_time_first = $request->open_time_first;
                $data->close_time_first = $request->close_time_first;
                $data->open_time_second = $request->open_time_second;
                $data->close_time_second = $request->close_time_second;
            }
            $data->save();
    
            // Get last inserted ID
            $last_insert_id = $data->id;
    
            // Define path based on type
            if ($type == 'tree') {
                $path = Config::get('DocumentConstant.TREE_ADD');
            } elseif ($type == 'flower') {
                $path = Config::get('DocumentConstant.FLOWERS_ADD');
            } else {
                $path = Config::get('DocumentConstant.AMENITIES_ADD');
            }
    
            // Handle file uploads
            $treeImage = $last_insert_id . '_' . rand(100000, 999999) . '_image.' . $request->image->extension();
            $englishAudio = $last_insert_id . '_' . rand(100000, 999999) . '_english.' . $request->english_audio_link->extension();
            $hindiAudio = $last_insert_id . '_' . rand(100000, 999999) . '_hindi.' . $request->hindi_audio_link->extension();
            $englishVideo = $last_insert_id . '_' . rand(100000, 999999) . '_english.' . $request->english_video_upload->extension();
            $hindiVideo = $last_insert_id . '_' . rand(100000, 999999) . '_hindi.' . $request->hindi_video_upload->extension();
            
            // Save files
            $request->image->move(public_path($path), $treeImage);
            $request->english_audio_link->move(public_path($path), $englishAudio);
            $request->hindi_audio_link->move(public_path($path), $hindiAudio);
            $request->english_video_upload->move(public_path($path), $englishVideo);
            $request->hindi_video_upload->move(public_path($path), $hindiVideo);
    
            // Update file paths in database
            $data->image = $treeImage;
            $data->english_audio_link = $englishAudio;
            $data->hindi_audio_link = $hindiAudio;
            $data->english_video_upload = $englishVideo;
            $data->hindi_video_upload = $hindiVideo;
            $data->save();
    
            return response()->json(['status' => 'true', 'message' => ucfirst($type) . ' Added Successfully.'], 200);
        } catch (Exception $e) {
            return response()->json(['status' => 'false', 'message' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }
    
    

    public function getFlowersList( Request $request ) {
        try {
            $language = $request->input( 'language', 'english' );
            
            $flowers_id = $request->input( 'flowers_id' );

            $page = isset( $request[ 'start' ] ) ? $request[ 'start' ] : Config::get( 'DocumentConstant.DEFAULT_START' ) ;
            $rowperpage = DEFAULT_LENGTH;
            $start = ( $page - 1 ) * $rowperpage;

            $basic_query_object = Flowers::join('tbl_tree_plant', 'tbl_tree_plant.id', '=', 'tbl_flowers.tree_plant_id')
            ->where('tbl_tree_plant.is_active', true)
            ->where('tbl_flowers.is_active', true)
            ->when($flowers_id, function ($query) use ($flowers_id) {
                $query->where('id', $flowers_id);
            });

            $totalRecords = $basic_query_object->select('tbl_flowers.id')->get()->count();

            if ( $language == 'hindi' ) {
                $data_output =   $basic_query_object->select('tbl_flowers.id', 'tbl_tree_plant.hindi_name as name', 'tbl_flowers.hindi_description as description', 'tbl_flowers.hindi_audio_link as audio_link', 'tbl_flowers.hindi_video_upload as video_upload', 'tbl_flowers.image', 'tbl_flowers.latitude', 'tbl_flowers.longitude', 'tbl_tree_plant.hindi_botnical_name as botnical_name','tbl_tree_plant.hindi_common_name as common_name','tbl_flowers.height','tbl_flowers.height_type', 'tbl_flowers.canopy', 'tbl_flowers.canopy_type','tbl_flowers.girth','tbl_flowers.image_two', 'tbl_flowers.image_three', 'tbl_flowers.image_four', 'tbl_flowers.image_five' );
            } else {
                $data_output =  $basic_query_object->select('tbl_flowers.id', 'tbl_tree_plant.english_name as name', 'tbl_flowers.english_description as description', 'tbl_flowers.english_audio_link as audio_link', 'tbl_flowers.english_video_upload as video_upload', 'tbl_flowers.image', 'tbl_flowers.latitude', 'tbl_flowers.longitude', 'tbl_tree_plant.english_botnical_name as botnical_name', 'tbl_tree_plant.english_common_name as common_name','tbl_flowers.height','tbl_flowers.height_type', 'tbl_flowers.canopy', 'tbl_flowers.canopy_type','tbl_flowers.girth','tbl_flowers.girth_type','tbl_flowers.image_two', 'tbl_flowers.image_three', 'tbl_flowers.image_four','tbl_flowers.image_five' );
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
