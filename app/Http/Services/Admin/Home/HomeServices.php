<?php
namespace App\Http\Services\Admin\Home;

use App\Http\Repository\Admin\Home\HomeRepository;

use App\Models\
{ HomeData };
use Carbon\Carbon;
use Config;
use Storage;

class HomeServices
{

	protected $repo;

    /**
     * TopicService constructor.
     */
    public function __construct()
    {
        $this->repo = new HomeRepository();
    }
    
    public function getAll(){
        try {
            $result = $this->repo->getAll();
            dd($result); // This will dump the result and stop the execution
            die();
            return $result;
        } catch (\Exception $e) {
            dd($e); // This will dump the exception and stop the execution
            return $e;
        }
    }
    
   
    public function addAll($request){
        try {
            $last_id = $this->repo->addAll($request);
            if(isset($last_id['ImageName'])){
                $path = Config::get('DocumentConstant.HOME_DATA_ADD');
                $ImageName = $last_id['ImageName'];

                uploadImage($request, 'image', $path, $ImageName);
              
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
        
            $path = Config::get('DocumentConstant.HOME_DATA_ADD');
            if ($request->hasFile('english_image')) {
                if ($return_data['english_image']) {
                    if (file_exists_view(Config::get('DocumentConstant.HOME_DATA_DELETE') . $return_data['english_image'])) {
                        removeImage(Config::get('DocumentConstant.HOME_DATA_DELETE') . $return_data['english_image']);
                    }
                }
                $ImageName = $return_data['last_insert_id'] . '_' . rand(100000, 999999) . '_image.' . $request->english_image->extension();
                uploadImage($request, 'english_image', $path, $ImageName);
                $data_output = HomeData::find($return_data['last_insert_id']);
                $data_output->english_image = $ImageName;
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