<?php
namespace App\Http\Services\Admin\Product;

use App\Http\Repository\Admin\Product\FlowersRepository;

use App\Models\
{ Flowers };
use Carbon\Carbon;
use Config;
use Storage;

class FlowersServices
{

	protected $repo;

    /**
     * TopicService constructor.
     */
    public function __construct()
    {
        $this->repo = new FlowersRepository();
    }
    
    public function getAll(){
        try {
            return $this->repo->getAll();
        } catch (\Exception $e) {
            return $e;
        }
    }
   
    public function addAll($request){
        try {
            $last_id = $this->repo->addAll($request);
          
            if(isset($last_id['ImageName'])){
                $path = Config::get('DocumentConstant.FLOWERS_ADD');
                $ImageName = $last_id['ImageName'];
                $EnglishAudioUpload = $last_id['EnglishAudioUpload'];
                $HindiAudioUpload = $last_id['HindiAudioUpload'];
                $EnglishVideoUpload = $last_id['EnglishVideoUpload'];
                $HindiVideoUpload = $last_id['HindiVideoUpload'];
    
                uploadImage($request, 'image', $path, $ImageName);
                uploadImage($request, 'english_audio_link', $path, $EnglishAudioUpload);
                uploadImage($request, 'hindi_audio_link', $path, $HindiAudioUpload);
                uploadImage($request, 'english_video_upload', $path, $EnglishVideoUpload);
                uploadImage($request, 'hindi_video_upload', $path, $HindiVideoUpload);
    
                if (isset($last_id['ImageName2'])) {
                    $ImageName2 = $last_id['ImageName2'];
                    uploadImage($request, 'image_two', $path, $ImageName2);
                }
    
                if (isset($last_id['ImageName3'])) {
                    $ImageName3 = $last_id['ImageName3'];
                    uploadImage($request, 'image_three', $path, $ImageName3);
                }
    
                if (isset($last_id['ImageName4'])) {
                    $ImageName4 = $last_id['ImageName4'];
                    uploadImage($request, 'image_four', $path, $ImageName4);
                }
    
                if (isset($last_id['ImageName5'])) {
                    $ImageName5 = $last_id['ImageName5'];
                    uploadImage($request, 'image_five', $path, $ImageName5);
                }
    
                return ['status' => 'success', 'msg' => 'Data Added Successfully.'];
            } else {
                return ['status' => 'error', 'msg' => 'ImageName not found in response.'];
            }
        } catch (Exception $e) {
            return ['status' => 'error', 'msg' => $e->getMessage()];
        }
    }
    
    
    public function getById($id){
        try {
            return $this->repo->getById($id);
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function updateAll($request){
        try {
            $return_data = $this->repo->updateAll($request);
          
            $path = Config::get('DocumentConstant.FLOWERS_ADD');
            if ($request->hasFile('image')) {
                if ($return_data['image']) {
                    if (file_exists_view(Config::get('DocumentConstant.FLOWERS_DELETE') . $return_data['image'])) {
                        removeImage(Config::get('DocumentConstant.FLOWERS_DELETE') . $return_data['image']);
                    }
                }
                $ImageName = $return_data['last_insert_id'] . '_' . rand(100000, 999999) . '_image.' . $request->image->extension();
                uploadImage($request, 'image', $path, $ImageName);
                $data_output = Flowers::find($return_data['last_insert_id']);
                $data_output->image = $ImageName;
                $data_output->save();
            }
            if ($request->hasFile('image_two')) {
                if (isset($return_data['image_two']) && $return_data['image_two']) {
                    if (file_exists_view(Config::get('DocumentConstant.FLOWERS_DELETE') . $return_data['image_two'])) {
                        removeImage(Config::get('DocumentConstant.FLOWERS_DELETE') . $return_data['image_two']);
                    }
                }
                $ImageName = $return_data['last_insert_id'] . '_' . rand(100000, 999999) . '_image.' . $request->image_two->extension();
                uploadImage($request, 'image_two', $path, $ImageName);
                $data_output = Flowers::find($return_data['last_insert_id']);
                $data_output->image_two = $ImageName;
                $data_output->save();
            }
    
            if ($request->hasFile('image_three')) {
                if (isset($return_data['image_three']) && $return_data['image_three']) {
                    if (file_exists_view(Config::get('DocumentConstant.FLOWERS_DELETE') . $return_data['image_three'])) {
                        removeImage(Config::get('DocumentConstant.FLOWERS_DELETE') . $return_data['image_three']);
                    }
                }
                $ImageName = $return_data['last_insert_id'] . '_' . rand(100000, 999999) . '_image.' . $request->image_three->extension();
                uploadImage($request, 'image_three', $path, $ImageName);
                $data_output = Flowers::find($return_data['last_insert_id']);
                $data_output->image_three = $ImageName;
                $data_output->save();
            }
    
            if ($request->hasFile('image_four')) {
                if (isset($return_data['image_four']) && $return_data['image_four']) {
                    if (file_exists_view(Config::get('DocumentConstant.FLOWERS_DELETE') . $return_data['image_four'])) {
                        removeImage(Config::get('DocumentConstant.FLOWERS_DELETE') . $return_data['image_four']);
                    }
                }
                $ImageName = $return_data['last_insert_id'] . '_' . rand(100000, 999999) . '_image.' . $request->image_four->extension();
                uploadImage($request, 'image_four', $path, $ImageName);
                $data_output = Flowers::find($return_data['last_insert_id']);
                $data_output->image_four = $ImageName;
                $data_output->save();
            }
    
            if ($request->hasFile('image_five')) {
                if (isset($return_data['image_five']) && $return_data['image_five']) {
                    if (file_exists_view(Config::get('DocumentConstant.FLOWERS_DELETE') . $return_data['image_five'])) {
                        removeImage(Config::get('DocumentConstant.FLOWERS_DELETE') . $return_data['image_five']);
                    }
                }
                $ImageName = $return_data['last_insert_id'] . '_' . rand(100000, 999999) . '_image.' . $request->image_five->extension();
                uploadImage($request, 'image_five', $path, $ImageName);
                $data_output = Flowers::find($return_data['last_insert_id']);
                $data_output->image_five = $ImageName;
                $data_output->save();
            }
    
            if ($request->hasFile('english_audio_link')) {
                if ($return_data['english_audio_link']) {
                    if (file_exists_view(Config::get('DocumentConstant.FLOWERS_DELETE') . $return_data['english_audio_link'])) {
                        removeImage(Config::get('DocumentConstant.FLOWERS_DELETE') . $return_data['english_audio_link']);
                    }
                }
                $EnglishAudioUpload = $return_data['last_insert_id'] . '_' . rand(100000, 999999) . '_english.' . $request->english_audio_link->extension();
                uploadImage($request, 'english_audio_link', $path, $EnglishAudioUpload);
                $data_output = Flowers::find($return_data['last_insert_id']);
                $data_output->english_audio_link = $EnglishAudioUpload;
                $data_output->save();
            }

            if ($request->hasFile('hindi_audio_link')) {
                if ($return_data['hindi_audio_link']) {
                    if (file_exists_view(Config::get('DocumentConstant.FLOWERS_DELETE') . $return_data['hindi_audio_link'])) {
                        removeImage(Config::get('DocumentConstant.FLOWERS_DELETE') . $return_data['hindi_audio_link']);
                    }
                }
                $HindiAudioUpload = $return_data['last_insert_id'] . '_' . rand(100000, 999999) . '_english.' . $request->hindi_audio_link->extension();
                uploadImage($request, 'hindi_audio_link', $path, $HindiAudioUpload);
                $data_output = Flowers::find($return_data['last_insert_id']);
                $data_output->hindi_audio_link = $HindiAudioUpload;
                $data_output->save();
            }

            if ($request->hasFile('english_video_upload')) {
                if ($return_data['english_video_upload']) {
                    if (file_exists_view(Config::get('DocumentConstant.FLOWERS_DELETE') . $return_data['english_video_upload'])) {
                        removeImage(Config::get('DocumentConstant.FLOWERS_DELETE') . $return_data['english_video_upload']);
                    }
                }
                $EnglishVideoUpload = $return_data['last_insert_id'] . '_' . rand(100000, 999999) . '_english.' . $request->english_video_upload->extension();
                uploadImage($request, 'english_video_upload', $path, $EnglishVideoUpload);
                $data_output = Flowers::find($return_data['last_insert_id']);
                $data_output->english_video_upload = $EnglishVideoUpload;
                $data_output->save();
            }

            if ($request->hasFile('hindi_video_upload')) {
                if ($return_data['hindi_video_upload']) {
                    if (file_exists_view(Config::get('DocumentConstant.FLOWERS_DELETE') . $return_data['hindi_video_upload'])) {
                        removeImage(Config::get('DocumentConstant.FLOWERS_DELETE') . $return_data['hindi_video_upload']);
                    }
                }
                $HindiVideoUpload = $return_data['last_insert_id'] . '_' . rand(100000, 999999) . '_english.' . $request->hindi_video_upload->extension();
                uploadImage($request, 'hindi_video_upload', $path, $HindiVideoUpload);
                $data_output = Flowers::find($return_data['last_insert_id']);
                $data_output->hindi_video_upload = $HindiVideoUpload;
                $data_output->save();
            }
            
            if ($return_data) {
                return ['status' => 'success', 'msg' => 'Data Updated Successfully.'];
            } else {
                return ['status' => 'error', 'msg' => 'Data  Not Updated.'];
            }  
        } catch (Exception $e) {
            return ['status' => 'error', 'msg' => $e->getMessage()];
        }      
    }

    public function updateOne($id){
        return $this->repo->updateOne($id);
    }

   
    public function deleteById($id)
    {
        try {
            $delete = $this->repo->deleteById($id);
            if ($delete) {
                return ['status' => 'success', 'msg' => 'Deleted Successfully.'];
            } else {
                return ['status' => 'error', 'msg' => ' Not Deleted.'];
            }  
        } catch (Exception $e) {
            return ['status' => 'error', 'msg' => $e->getMessage()];
        } 
    }



}