<?php
namespace App\Http\Repository\Admin\AboutUs;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\QueryException;
use App\Models\ {
	AboutUsElement
};
use Config;

class AboutUsElementRepository  {
	public function getAll(){
        try {
            return AboutUsElement::orderBy('updated_at', 'desc')->get();
        } catch (\Exception $e) {
            return $e;
        }
    }
    public function addAll($request){
        try {
           
            $data =array();
            $add_data = new AboutUsElement();
            $add_data->english_name = $request['english_name'];
            $add_data->hindi_name = $request['hindi_name'];
            $add_data->english_description = $request['english_description'];
            $add_data->hindi_description = $request['hindi_description'];
            $add_data->open_time = $request['open_time'];
            $add_data->close_time = $request['close_time'];
          
            $add_data->save(); 

             
            $last_insert_id = $add_data->id;
            
            $ImageName = $last_insert_id .'_' . rand(100000, 999999) . '_image.' . $request->image->extension();

            $add_data = AboutUsElement::find($last_insert_id); 
            $add_data->image = $ImageName; 
                 
            $add_data->save();
            
            $data['ImageName'] =$ImageName;
            
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
            $data_output = AboutUsElement::find($id);
          
            if ($data_output) {
                return $data_output;
            } else {
                return null;
            }
        } catch (\Exception $e) {
            return $e;
            return [
                'msg' => 'Failed to get by id data.',
                'status' => 'error'
            ];
        }
    }
    
    public function updateAll($request){
        try {
            $return_data = array();
            $data_output = AboutUsElement::find($request->id);

            if (!$data_output) {
                return [
                    'msg' => 'Data not found.',
                    'status' => 'error'
                ];
            }

            // Store the previous image names
            $previousImage = $data_output->image;
           
            // Update the fields from the request
            $data_output->english_name = $request['english_name'];
            $data_output->hindi_name = $request['hindi_name'];
            $data_output->english_description = $request['english_description'];
            $data_output->hindi_description = $request['hindi_description'];
            $data_output->open_time = $request['open_time'];
            $data_output->close_time = $request['close_time'];
            
            $data_output->save();
            $last_insert_id = $data_output->id;

            $return_data['last_insert_id'] = $last_insert_id;
            $return_data['image'] = $previousImage;

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
            $data = AboutUsElement::find($request); 

            if ($data) {
                $is_active = $data->is_active === '1' ? '0' : '1';
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
                $data_output = AboutUsElement::find($id);
                if ($data_output) {
                    if (file_exists_view(Config::get('DocumentConstant.ABOUTUS_ELEMENT_DELETE') . $data_output->image)){
                        removeImage(Config::get('DocumentConstant.ABOUTUS_ELEMENT_DELETE') . $data_output->image);
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