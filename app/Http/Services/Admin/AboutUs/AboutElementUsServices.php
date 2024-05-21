<?php
namespace App\Http\Services\Admin\AboutUs;

use App\Http\Repository\Admin\AboutUs\AboutUsElementRepository;

use App\Models\
{ AboutUsElement };
use Carbon\Carbon;
use Config;
use Storage;

class AboutElementUsServices
{

	protected $repo;

    /**
     * TopicService constructor.
     */
    public function __construct()
    {
        $this->repo = new AboutUsElementRepository();
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
                $path = Config::get('DocumentConstant.ABOUTUS_ELEMENT_ADD');
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
        
            $path = Config::get('DocumentConstant.ABOUTUS_ELEMENT_ADD');
            if ($request->hasFile('image')) {
                if ($return_data['image']) {
                    if (file_exists_view(Config::get('DocumentConstant.ABOUTUS_ELEMENT_DELETE') . $return_data['image'])) {
                        removeImage(Config::get('DocumentConstant.ABOUTUS_ELEMENT_DELETE') . $return_data['image']);
                    }
                }
                $ImageName = $return_data['last_insert_id'] . '_' . rand(100000, 999999) . '_image.' . $request->image->extension();
                uploadImage($request, 'image', $path, $ImageName);
                $data_output = AboutUsElement::find($return_data['last_insert_id']);
                $data_output->image = $ImageName;
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