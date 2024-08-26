<?php
namespace App\Http\Services\Admin\ZoneCoOrdinate;
use App\Http\Repository\Admin\ZoneCoOrdinate\ZoneCoOrdinateRepository;
use Carbon\Carbon;

use App\Models\
{ ZoneCoOrdinate };
use Config;
class ZoneCoOrdinateServices
{
	protected $repo;
    public function __construct(){
        $this->repo = new ZoneCoOrdinateRepository();
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
                $path = Config::get('DocumentConstant.ZONE_CO_ORDINATE_KML_ADD');
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

   
    
    // public function updateAll($request){
    //     try {
    //         $return_data = $this->repo->updateAll($request);
    //         $path = Config::get('DocumentConstant.ZONE_CO_ORDINATE_KML_ADD');
    //         if ($request->hasFile('image')) {
    //             if ($return_data['image']) {
    //                 if (file_exists_view(Config::get('DocumentConstant.ZONE_CO_ORDINATE_KML_DELETE') . $return_data['image'])) {
    //                     removeImage(Config::get('DocumentConstant.ZONE_CO_ORDINATE_KML_DELETE') . $return_data['image']);
    //                 }
    //             }
    //             $ImageName = $return_data['last_insert_id'] . '_' . rand(100000, 999999) . '_image.' . $request->image->extension();
    //             uploadImage($request, 'image', $path, $ImageName);
    //             $data_output = ZoneCoOrdinate::find($return_data['last_insert_id']);
    //             $data_output->image = $ImageName;
    //             $data_output->save();
    //         }
           
    //         if ($return_data) {
    //             return ['status' => 'success', 'msg' => 'Data Updated Successfully.'];
    //         } else {
    //             return ['status' => 'error', 'msg' => 'Data  Not Updated.'];
    //         }  
    //     } catch (Exception $e) {
    //         return ['status' => 'error', 'msg' => $e->getMessage()];
    //     }      
    // }
    // public function updateAll($request){
    //     try {
    //         $return_data = $this->repo->updateAll($request);
    //         $path = Config::get('DocumentConstant.ZONE_CO_ORDINATE_KML_ADD');
    //         if ($request->hasFile('image')) {
    //             if ($return_data['image']) {
    //                 if (file_exists_view(Config::get('DocumentConstant.ZONE_CO_ORDINATE_KML_DELETE') . $return_data['image'])) {
    //                     removeImage(Config::get('DocumentConstant.ZONE_CO_ORDINATE_KML_DELETE') . $return_data['image']);
    //                 }
    //             }
    //             $imageExtension = $request->file('image')->getClientOriginalExtension();
    //             if ($imageExtension !== 'kml') {
    //                 throw new \Exception('The file must be a KML file.');
    //             }
        
    //             $imageName = $last_insert_id . '_' . rand(100000, 999999) . $imageExtension;
    //             $ImageName = $return_data['last_insert_id'] . '_' . rand(100000, 999999) . '_image.' . $request->image->extension();
    //             uploadImage($request, 'image', $path, $ImageName);
    //             $data_output = ZoneCoOrdinate::find($return_data['last_insert_id']);
    //             $data_output->image = $ImageName;
    //             $data_output->save();
    //         }
           
    //         if ($return_data) {
    //             return ['status' => 'success', 'msg' => 'Data Updated Successfully.'];
    //         } else {
    //             return ['status' => 'error', 'msg' => 'Data  Not Updated.'];
    //         }  
    //     } catch (Exception $e) {
    //         return ['status' => 'error', 'msg' => $e->getMessage()];
    //     }      
    // }
    public function updateAll($request)
    {
        try {
            // Update the data using the repository method
            $return_data = $this->repo->updateAll($request);
            
            // Define the path for uploading KML files
            $path = Config::get('DocumentConstant.ZONE_CO_ORDINATE_KML_ADD');
            
            // Check if the request contains a file named 'image'
            if ($request->hasFile('image')) {
                
                // Check if there is an existing image and delete it if it exists
                if ($return_data['image']) {
                    $existingImagePath = Config::get('DocumentConstant.ZONE_CO_ORDINATE_KML_DELETE') . $return_data['image'];
                    if (file_exists($existingImagePath)) {
                        removeImage($existingImagePath); // Use removeImage function to delete the old KML file
                    }
                }
    
                // Validate the uploaded file's extension
                $imageExtension = $request->file('image')->getClientOriginalExtension();
                if (strtolower($imageExtension) !== 'kml') {
                    throw new \Exception('The file must be a KML file.');
                }
    
                // Reuse the old file name instead of generating a new one
                $ImageName = $return_data['image']; // Reuse the existing image name
                
                // Upload the new file using the uploadImage function
                uploadImage($request, 'image', $path, $ImageName);
    
                // Update the database record with the same image name
                $data_output = ZoneCoOrdinate::find($return_data['last_insert_id']);
                $data_output->image = $ImageName; // Ensure the file name remains unchanged
                $data_output->save();
            }
            
            // Return a success or error message based on the result
            if ($return_data) {
                return ['status' => 'success', 'msg' => 'Data Updated Successfully.'];
            } else {
                return ['status' => 'error', 'msg' => 'Data Not Updated.'];
            }
        } catch (\Exception $e) {
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