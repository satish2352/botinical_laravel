<?php
namespace App\Http\Services\Admin\Master;
use App\Http\Repository\Admin\Master\IconMasterRepository;
use Carbon\Carbon;

use App\Models\
{ IconMaster };
use Config;
class IconMasterServices
{
	protected $repo;
    public function __construct(){
        $this->repo = new IconMasterRepository();
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
                $path = Config::get('DocumentConstant.ICON_MASTER_ADD');
                $ImageName = $last_id['ImageName'];

                uploadImage($request, 'image', $path, $ImageName);
              
                return ['status' => 'success', 'msg' => 'Data Added Successfully.'];
            } else {
                return ['status' => 'error', 'msg' => 'Image Name not found in response.'];
            }
        } catch (Exception $e) {
            return ['status' => 'error', 'msg' => $e->getMessage()];
        }      
    }

   
    
    public function updateAll($request){
        try {
            $return_data = $this->repo->updateAll($request);
            $path = Config::get('DocumentConstant.ICON_MASTER_ADD');
            if ($request->hasFile('image')) {
                if ($return_data['image']) {
                    if (file_exists_view(Config::get('DocumentConstant.ICON_MASTER_DELETE') . $return_data['image'])) {
                        removeImage(Config::get('DocumentConstant.ICON_MASTER_DELETE') . $return_data['image']);
                    }
                }
                $ImageName = $return_data['last_insert_id'] . '_' . rand(100000, 999999) . '_image.' . $request->image->extension();
                uploadImage($request, 'image', $path, $ImageName);
                $data_output = IconMaster::find($return_data['last_insert_id']);
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
    public function getById($id)
    {
        try {
            return $this->repo->getById($id);
        } catch (\Exception $e) {
            return $e;
        }
    }
    public function updateOneCategory($id)
    {
        return $this->repo->updateOneCategory($id);
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