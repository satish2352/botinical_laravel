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
        $typeMap = [
            1 => 'tree',
            2 => 'flower',
            3 => 'aminities',
        ];
        if (!array_key_exists($type, $typeMap)) {
            return response()->json(['status' => 'false', 'message' => 'Invalid type provided'], 400);
        }
       $typeName = $typeMap[$type];


       $typeNameFolderName =[
        1 => 'TRESS',
        2 => 'FLOWERS',
        3 => 'AMENITIES',
       ];

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
                'english_audio_link' => 'sometimes|nullable|mimes:mp3|max:'.Config::get('AllFileValidation.AUDIO_MAX_SIZE').'|min:'.Config::get('AllFileValidation.AUDIO_MIN_SIZE'),
                'hindi_audio_link' => 'sometimes|nullable|mimes:mp3|max:'.Config::get('AllFileValidation.AUDIO_MAX_SIZE').'|min:'.Config::get('AllFileValidation.AUDIO_MIN_SIZE'),
                'english_video_upload' => 'sometimes|nullable|mimetypes:video/mp4|max:'.Config::get('AllFileValidation.VIDEO_MAX_SIZE').'|min:'.Config::get('AllFileValidation.VIDEO_MIN_SIZE'),
                'hindi_video_upload' => 'sometimes|nullable|mimetypes:video/mp4|max:'.Config::get('AllFileValidation.VIDEO_MAX_SIZE').'|min:'.Config::get('AllFileValidation.VIDEO_MIN_SIZE'),
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
if (!array_key_exists($typeName, $validationRules)) {
    return response()->json(['status' => 'false', 'message' => 'Invalid type provided'], 400);
}

// Validate request based on type
$validator = Validator::make($request->all(), $validationRules[$typeName], $customMessages);

// Check if validation fails
if ($validator->fails()) {
    return response()->json(['status' => 'false', 'message' => $validator->errors()->all()], 200);
}

try {
    if ($typeName == 'tree') {
        $data = new Tress();
    } elseif ($typeName == 'flower') {
        $data = new Flowers();
    } elseif ($typeName == 'aminities') {
        $data = new Amenities();
        $data->english_name = $request->english_name;
        $data->hindi_name = $request->hindi_name;
    }

    // Set common attributes
    $data->icon_id = $request->icon_id;
    $data->english_description = $request->english_description;
    $data->hindi_description = $request->hindi_description;
    $data->latitude = $request->latitude;
    $data->longitude = $request->longitude;

    if ($typeName != 'aminities') {
        $data->tree_plant_id = $request->tree_plant_id;
        $data->height = $request->height;
        $data->height_type = $request->height_type;
        $data->canopy = $request->canopy;
        $data->canopy_type = $request->canopy_type;
        $data->girth = $request->girth;
        $data->girth_type = $request->girth_type;
    } else {
        $data->amenities_category_id = $request->amenities_category_id;
        $data->open_time_first = $request->open_time_first;
        $data->close_time_first = $request->close_time_first;
        $data->open_time_second = $request->open_time_second;
        $data->close_time_second = $request->close_time_second;
    }
    $data->save();

    // Get last inserted ID
    $last_insert_id = $data->id;

    // Define path based on type
    

    if ($typeName == 'tree') {
        $path = Config::get('DocumentConstant.' . 'TRESS_ADD');
    } elseif ($typeName == 'flower') {
        $path = Config::get('DocumentConstant.' . 'FLOWERS_ADD');
    } elseif ($typeName == 'aminities') {
        $path = Config::get('DocumentConstant.' . 'AMENITIES_ADD');
    }

    // Handle file uploads
    $treeImage = $last_insert_id . '_' . rand(100000, 999999) . '_image.' . $request->image->extension();
    uploadImage($request, 'image', $path, $treeImage);

    if ($typeName != 'aminities') {
        if ($request->hasFile('english_audio_link')) {
            $englishAudio = $last_insert_id . '_' . rand(100000, 999999) . '_english.' . $request->english_audio_link->extension();
            uploadImage($request, 'english_audio_link', $path, $englishAudio);
        }
        if ($request->hasFile('hindi_audio_link')) {
            $hindiAudio = $last_insert_id . '_' . rand(100000, 999999) . '_hindi.' . $request->hindi_audio_link->extension();
            uploadImage($request, 'hindi_audio_link', $path, $hindiAudio);
        }
        if ($request->hasFile('english_video_upload')) {
            $englishVideo = $last_insert_id . '_' . rand(100000, 999999) . '_english.' . $request->english_video_upload->extension();
            uploadImage($request, 'english_video_upload', $path, $englishVideo);
        }
        if ($request->hasFile('hindi_video_upload')) {
            $hindiVideo = $last_insert_id . '_' . rand(100000, 999999) . '_hindi.' . $request->hindi_video_upload->extension();
            uploadImage($request, 'hindi_video_upload', $path, $hindiVideo);
        }
    }

    // Handle optional file uploads
    $optionalImages = ['image_two', 'image_three', 'image_four', 'image_five'];
    foreach ($optionalImages as $imageField) {
        if ($request->hasFile($imageField)) {
            $imageName = $last_insert_id . '_' . rand(100000, 999999) . '_' . $imageField . '.' . $request->file($imageField)->extension();
            uploadImage($request, $imageField, $path, $imageName);
            $data->$imageField = $imageName;
        }
    }

    // Update file paths in database
    // $data->image = $treeImage;
    // if ($typeName != 'aminities') {
    //     $data->english_audio_link = $englishAudio ?? null;
    //     $data->hindi_audio_link = $hindiAudio ?? null;
    //     $data->english_video_upload = $englishVideo ?? null;
    //     $data->hindi_video_upload = $hindiVideo ?? null;
    // }
    // $data->save();

    // Update file paths in database
    $data->image = $treeImage;
    if ($typeName != 'aminities') {
        $data->english_audio_link = $englishAudio ?? null;
        $data->hindi_audio_link = $hindiAudio ?? null;
        $data->english_video_upload = $englishVideo ?? null;
        $data->hindi_video_upload = $hindiVideo ?? null;
    }
    $data->save();

        return response()->json(['status' => 'true', 'message' => ucfirst($typeName) . ' Added Successfully.', 'data' => $data], 200);
    } catch (Exception $e) {
        return response()->json(['status' => 'false', 'message' => 'An error occurred: ' . $e->getMessage()], 500);
    }

}
    
    
// public function updateTreePlantAminities(Request $request)
// {
//     $typeMap = [
//         1 => 'tree',
//         2 => 'flower',
//         3 => 'aminities',
//     ];

//     $type = $request->input('type'); // Get the type from the request

//     // Check if the type is valid
//     if (!array_key_exists($type, $typeMap)) {
//         return response()->json(['status' => 'false', 'message' => 'Invalid type provided'], 400);
//     }

//     $typeName = $typeMap[$type];

//     // Define validation rules and custom messages
//     $validationRules = [
//         'tree' => [
//         //   'tree_plant_id' => 'required',
//         //     'latitude' => 'required|numeric|between:-90,90',
//         //     'longitude' => 'required|numeric|between:-180,180',
//         ],
//         'flower' => [
//             'tree_plant_id' => 'required|exists:flowers,id',
//             'latitude' => 'required|numeric|between:-90,90',
//             'longitude' => 'required|numeric|between:-180,180',
//         ],
//         'aminities' => [
//             'aminities_id' => 'required|exists:amenities,id',
//             'latitude' => 'required|numeric|between:-90,90',
//             'longitude' => 'required|numeric|between:-180,180',
//         ],
//     ];

//     $customMessages = [
//         'tree_plant_id.required' => 'Please provide the Tree ID.',
//         'tree_plant_id.exists' => 'The provided Tree ID does not exist.',
//         'plant_id.required' => 'Please provide the Plant ID.',
//         'plant_id.exists' => 'The provided Plant ID does not exist.',
//         'aminities_id.required' => 'Please provide the Amenities ID.',
//         'aminities_id.exists' => 'The provided Amenities ID does not exist.',
//         'latitude.required' => 'Latitude is required.',
//         'latitude.numeric' => 'Latitude must be a number.',
//         'latitude.between' => 'Latitude must be between -90 and 90.',
//         'longitude.required' => 'Longitude is required.',
//         'longitude.numeric' => 'Longitude must be a number.',
//         'longitude.between' => 'Longitude must be between -180 and 180.',
//     ];

//     // Determine the validation key and model class based on the type
//     $validationKey = $typeName;
//     $idField = $typeName . '_id';

//     $validator = Validator::make($request->all(), $validationRules[$validationKey], $customMessages);

//     // Check if validation fails
//     if ($validator->fails()) {
//         return response()->json(['status' => 'false', 'message' => $validator->errors()->all()], 200);
//     }

//     // Determine the model class dynamically
//     $modelClass = [
//         'tree' => Tress::class,
//         'flower' => Flower::class,
//         'aminities' => Amenities::class,
//     ][$typeName];

//     try {
//         // Find the record by ID
//         $data = $modelClass::find($request->input($idField));

//         // Check if record exists
//         if (!$data) {
//             return response()->json(['status' => 'false', 'message' => ucfirst($validationKey) . ' not found.'], 404);
//         }

//         // Update latitude and longitude
//         $data->latitude = $request->latitude;
//         $data->longitude = $request->longitude;

//         // Save the updated data
//         $data->save();

//         return response()->json(['status' => 'true', 'message' => ucfirst($validationKey) . ' updated successfully.', 'data' => $data], 200);
//     } catch (Exception $e) {
//         return response()->json(['status' => 'false', 'message' => 'An error occurred: ' . $e->getMessage()], 500);
//     }
// }
public function updateTreePlantAminities(Request $request)
{
    $typeMap = [
        1 => 'tree',
        2 => 'flower',
        3 => 'aminities',
    ];

    $type = $request->input('type'); // Get the type from the request
    
    // Check if the type is valid
    if (!array_key_exists($type, $typeMap)) {
        return response()->json(['status' => 'false', 'message' => 'Invalid type provided'], 400);
    }

    $typeName = $typeMap[$type];

    // Define validation rules dynamically
    $validationRules = [
        'latitude' => 'required|numeric|between:-90,90',
        'longitude' => 'required|numeric|between:-180,180',
    ];

    if ($typeName === 'tree') {
        $validationRules['tree_plant_id'] = 'required|exists:tbl_trees,id';
    } elseif ($typeName === 'flower') {
        $validationRules['tree_plant_id'] = 'required|exists:tbl_flowers,id';
    } elseif ($typeName === 'aminities') {
        $validationRules['aminities_id'] = 'required|exists:tbl_amenities,id';
    }

    $customMessages = [
        'tree_plant_id.required' => 'Please provide the Tree ID.',
        'tree_plant_id.exists' => 'The provided Tree ID does not exist.',
        'aminities_id.required' => 'Please provide the Amenities ID.',
        'aminities_id.exists' => 'The provided Amenities ID does not exist.',
        'latitude.required' => 'Latitude is required.',
        'latitude.numeric' => 'Latitude must be a number.',
        'latitude.between' => 'Latitude must be between -90 and 90.',
        'longitude.required' => 'Longitude is required.',
        'longitude.numeric' => 'Longitude must be a number.',
        'longitude.between' => 'Longitude must be between -180 and 180.',
    ];

    $validator = Validator::make($request->all(), $validationRules, $customMessages);

    // Check if validation fails
    if ($validator->fails()) {
        return response()->json(['status' => 'false', 'message' => $validator->errors()->all()], 400);
    }

    // Determine the model class dynamically
    $modelClass = [
        'tree' => Tress::class,
        'flower' => Flowers::class,
        'aminities' => Amenities::class,
    ][$typeName];

    $idField = $typeName === 'aminities' ? 'aminities_id' : 'tree_plant_id';

    try {
        // Find the record by ID
        $data = $modelClass::find($request->input($idField));

        // Check if record exists
        if (!$data) {
            return response()->json(['status' => 'false', 'message' => ucfirst($typeName) . ' not found.'], 404);
        }

        // Update latitude and longitude
        $data->latitude = $request->latitude;
        $data->longitude = $request->longitude;

        // Save the updated data
        $data->save();

        return response()->json(['status' => 'true', 'message' => ucfirst($typeName) . ' updated successfully.', 'data' => $data], 200);
    } catch (Exception $e) {
        return response()->json(['status' => 'false', 'message' => 'An error occurred: ' . $e->getMessage()], 500);
    }
}




    public function getFlowersList( Request $request ) {
        try {
            $language = $request->input( 'language', 'english' );
            $flowers_id = $request->input( 'flowers_id' );
            $search_name = $request->input('name'); 

            $page = isset( $request[ 'start' ] ) ? $request[ 'start' ] : Config::get( 'DocumentConstant.DEFAULT_START' ) ;
            $rowperpage = DEFAULT_LENGTH;
            $start = ( $page - 1 ) * $rowperpage;

            $basic_query_object = Flowers::join('tbl_tree_plant', 'tbl_tree_plant.id', '=', 'tbl_flowers.tree_plant_id')
            ->where('tbl_tree_plant.is_active', true)
            ->where('tbl_flowers.is_active', true)
            ->when($flowers_id, function ($query) use ($flowers_id) {
                $query->where('tbl_flowers.id', $flowers_id);
            })
            ->when($search_name, function ($query) use ($search_name, $language) {
                // Adjust column name based on language
                $column = $language == 'hindi' ? 'tbl_tree_plant.hindi_name' : 'tbl_tree_plant.english_name';
                $query->where($column, 'like', '%' . $search_name . '%');  // Add the like condition
            });

            $totalRecords = $basic_query_object->select('tbl_flowers.id')->get()->count();

            if ( $language == 'hindi' ) {
                $data_output =   $basic_query_object->select('tbl_flowers.id', 'tbl_tree_plant.hindi_name as name', 'tbl_flowers.hindi_description as description', 'tbl_flowers.hindi_audio_link as audio_link', 'tbl_flowers.hindi_video_upload as video_upload', 'tbl_flowers.image', 'tbl_flowers.latitude', 'tbl_flowers.longitude', 'tbl_tree_plant.hindi_botnical_name as botnical_name','tbl_tree_plant.hindi_common_name as common_name','tbl_flowers.height','tbl_flowers.height_type', 'tbl_flowers.canopy', 'tbl_flowers.canopy_type','tbl_flowers.girth','tbl_flowers.image_two', 'tbl_flowers.image_three', 'tbl_flowers.image_four', 'tbl_flowers.image_five' ) ->orderBy('tbl_tree_plant.hindi_name', 'asc');
            } else {
                $data_output =  $basic_query_object->select('tbl_flowers.id', 'tbl_tree_plant.english_name as name', 'tbl_flowers.english_description as description', 'tbl_flowers.english_audio_link as audio_link', 'tbl_flowers.english_video_upload as video_upload', 'tbl_flowers.image', 'tbl_flowers.latitude', 'tbl_flowers.longitude', 'tbl_tree_plant.english_botnical_name as botnical_name', 'tbl_tree_plant.english_common_name as common_name','tbl_flowers.height','tbl_flowers.height_type', 'tbl_flowers.canopy', 'tbl_flowers.canopy_type','tbl_flowers.girth','tbl_flowers.girth_type','tbl_flowers.image_two', 'tbl_flowers.image_three', 'tbl_flowers.image_four','tbl_flowers.image_five' ) ->orderBy('tbl_tree_plant.english_name', 'asc');
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
