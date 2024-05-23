<?php
namespace App\Http\Repository\Admin\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\QueryException;
use DB;
use Illuminate\Support\Carbon;
// use Session;
use App\Models\ {
	Amenities,
    CategoryAmenities
};
use Config;

class AmenitiesRepository  {
	
    public function getAll()
    {
        try {
            $dataOutputCategory = CategoryAmenities::join('tbl_amenities', 'tbl_amenities.amenities_category_id','=', 'tbl_amenities_category.id')
            ->select(
                'tbl_amenities.english_name as amenities_english_name', 
                'tbl_amenities.hindi_name as amenities_hindi_name', 
                'tbl_amenities.english_description', 
                'tbl_amenities.hindi_description', 
                'tbl_amenities.image', 
                'tbl_amenities_category.english_name',
                'tbl_amenities_category.hindi_name',
                'tbl_amenities_category.id',
                )
                ->orderBy('tbl_amenities_category.id', 'desc')
               ->get();          
             return $dataOutputCategory;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function addAll($request){
        try {
           
            $data =array();
            $add_data = new Amenities();
            $add_data->amenities_category_id = $request['amenities_category_id'];
            $add_data->english_name = $request['english_name'];
            $add_data->hindi_name = $request['hindi_name'];
            $add_data->english_description = $request['english_description'];
            $add_data->hindi_description = $request['hindi_description'];
            $add_data->latitude = $request['latitude'];
            $add_data->longitude = $request['longitude'];
            $add_data->english_audio_link = $request->has('english_audio_link') ? $request->english_audio_link : '';
            $add_data->hindi_audio_link = $request->has('hindi_audio_link') ? $request->hindi_audio_link : '';
            $add_data->english_video_upload = $request->has('english_video_upload') ? $request->english_video_upload : '';
            $add_data->hindi_video_upload = $request->has('hindi_video_upload') ? $request->hindi_video_upload : '';
            $add_data->save(); 

             
            $last_insert_id = $add_data->id;
            
            $ImageName = $last_insert_id .'_' . rand(100000, 999999) . '_image.' . $request->image->extension();

            $EnglishAudioUpload = $last_insert_id .'_' . rand(100000, 999999) . '_english.' . $request->english_audio_link->extension();
            $HindiAudioUpload = $last_insert_id .'_' . rand(100000, 999999) . '_hindi.' . $request->hindi_audio_link->extension();

            $EnglishVideoUpload = $last_insert_id .'_' . rand(100000, 999999) . '_english.' . $request->english_video_upload->extension();
            $HindiVideoUpload = $last_insert_id .'_' . rand(100000, 999999) . '_hindi.' . $request->hindi_video_upload->extension();


            $add_data = Amenities::find($last_insert_id); 
            $add_data->image = $ImageName; 
            $add_data->english_audio_link = $EnglishAudioUpload; 
            $add_data->hindi_audio_link = $HindiAudioUpload; 
            $add_data->english_video_upload = $EnglishVideoUpload; 
            $add_data->hindi_video_upload = $HindiVideoUpload; 

           
            $add_data->save();
            
            $data['ImageName'] =$ImageName;
            $data['EnglishAudioUpload'] =$EnglishAudioUpload;
            $data['HindiAudioUpload'] =$HindiAudioUpload;
            $data['EnglishVideoUpload'] =$EnglishVideoUpload;
            $data['HindiVideoUpload'] =$HindiVideoUpload;
            
            return $data;
    
        } catch (\Exception $e) {
            return [
                'msg' => $e,
                'status' => 'error'
            ];
        }
    }
    


    public function getById($id){
        try {
            $citizenvolunteer = CategoryAmenities::join('tbl_amenities_category', 'tbl_amenities_category.id', '=', 'tbl_amenities.amenities_category_id')
                ->select('tbl_amenities.*', 'tbl_amenities_category.english_name')
                ->where('tbl_amenities.id', $id)
                ->first();
   
            if ($citizenvolunteer) {
                return $citizenvolunteer;
            } else {
                return null;
            }
        } catch (\Exception $e) {
            return [
                'msg' => 'Failed to get by id Citizen Volunteer.',
                'status' => 'error',
                'error' => $e->getMessage()
            ];
        }
    }
    
    

//     public function getById($id){
//         try {
//             // $data_output = Amenities::find($id);


//             $data_output = CategoryAmenities::join('tbl_amenities', 'tbl_amenities.amenities_category_id','=', 'tbl_amenities_category.id')
//             ->select(
//                 'tbl_amenities.english_name as amenities_english_name', 
//                 'tbl_amenities.hindi_name as amenities_hindi_name', 
//                 'tbl_amenities.english_description', 
//                 'tbl_amenities.hindi_description', 
//                 'tbl_amenities.image', 
//                 'tbl_amenities_category.english_name',
//                 'tbl_amenities_category.hindi_name',
//                 'tbl_amenities_category.id',
//                 )
//                 ->orderBy('tbl_amenities_category.id', 'desc')
//                ->get();

// dd($data_output )

//             if ($data_output) {
//                 return $data_output;
//             } else {
//                 return null;
//             }
//         } catch (\Exception $e) {
//             return $e;
//             return [
//                 'msg' => 'Failed to get by id data.',
//                 'status' => 'error'
//             ];
//         }
//     }
    
    public function updateAll($request){
        try {
            $return_data = array();
            $data_output = Amenities::find($request->id);

            if (!$data_output) {
                return [
                    'msg' => 'Data not found.',
                    'status' => 'error'
                ];
            }

            // Store the previous image names
            $previousImage = $data_output->image;
            $previousEnglishAudio = $data_output->english_audio_link;
            $previousHindiAudio = $data_output->hindi_audio_link;

            $previousEnglishVideo = $data_output->english_video_upload;
            $previousHindiVideo = $data_output->hindi_video_upload;

            // Update the fields from the request
            $data_output->amenities_category_id = $request['amenities_category_id'];
            $data_output->english_name = $request['english_name'];
            $data_output->hindi_name = $request['hindi_name'];
            $data_output->english_description = $request['english_description'];
            $data_output->hindi_description = $request['hindi_description'];
            $data_output->latitude = $request['latitude'];
            $data_output->longitude = $request['longitude'];
            
            $data_output->save();
            $last_insert_id = $data_output->id;

            $return_data['last_insert_id'] = $last_insert_id;
            $return_data['image'] = $previousImage;
            $return_data['english_audio_link'] = $previousEnglishAudio;
            $return_data['hindi_audio_link'] = $previousHindiAudio;

            $return_data['english_video_upload'] = $previousEnglishVideo;
            $return_data['hindi_video_upload'] = $previousHindiVideo;

            return  $return_data;
        
        } catch (\Exception $e) {
            return [
                'msg' => 'Failed to update Data.',
                'status' => 'error',
                'error' => $e->getMessage() // Return the error message for debugging purposes
            ];
        }
    }

    public function updateOne($request){
        try {
            $data = Amenities::find($request); 

            if ($data) {
                $is_active = $data->is_active === 1 ? 0 : 1;
                $data->is_active = $is_active;
                $data->save();

                return [
                    'msg' => 'Data updated successfully.',
                    'status' => 'success'
                ];
            }

            return [
                'msg' => 'Data not found.',
                'status' => 'error'
            ];
        } catch (\Exception $e) {
            return [
                'msg' => 'Failed to update Data.',
                'status' => 'error'
            ];
        }
    }

    public function deleteById($id){
            try {
                $data_output = Amenities::find($id);
                if ($data_output) {
                    if (file_exists_view(Config::get('DocumentConstant.AMENITIES_DELETE') . $data_output->image)){
                        removeImage(Config::get('DocumentConstant.AMENITIES_DELETE') . $data_output->image);
                    }
                    if (file_exists_view(Config::get('DocumentConstant.AMENITIES_DELETE') . $data_output->english_audio_link)){
                        removeImage(Config::get('DocumentConstant.AMENITIES_DELETE') . $data_output->english_audio_link);
                    }
                    if (file_exists_view(Config::get('DocumentConstant.AMENITIES_DELETE') . $data_output->hindi_audio_link)){
                        removeImage(Config::get('DocumentConstant.AMENITIES_DELETE') . $data_output->hindi_audio_link);
                    }
                    if (file_exists_view(Config::get('DocumentConstant.AMENITIES_DELETE') . $data_output->english_video_upload)){
                        removeImage(Config::get('DocumentConstant.AMENITIES_DELETE') . $data_output->english_video_upload);
                    }
                    if (file_exists_view(Config::get('DocumentConstant.AMENITIES_DELETE') . $data_output->hindi_video_upload)){
                        removeImage(Config::get('DocumentConstant.AMENITIES_DELETE') . $data_output->hindi_video_upload);
                    }
                    
                    $data_output->delete();
                    
                    return $data_output;
                } else {
                    return null;
                }
            } catch (\Exception $e) {
                return $e;
            }
    }


}