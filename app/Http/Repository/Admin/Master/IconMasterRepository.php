<?php
namespace App\Http\Repository\Admin\Master;
use Illuminate\Database\QueryException;
use DB;
use Illuminate\Support\Carbon;
// use Session;
use App\Models\ {
    IconMaster
};
use Config;

class IconMasterRepository  {


    public function getAll(){
        try {
          $data_output = IconMaster::orderBy('updated_at', 'desc')->get();
            return $data_output;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function addAll($request){
        try {
            
            $data =array();
            $add_data = new IconMaster();
            $add_data->name = $request['name'];
            $add_data->save(); 

            $last_insert_id = $add_data->id;
            
            $ImageName = $last_insert_id .'_' . rand(100000, 999999) . '_image.' . $request->image->extension();
            $add_data = IconMaster::find($last_insert_id); 
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
    
    public function updateAll($request){
        try {
            $return_data = array();
            $data_output = IconMaster::find($request->id);

            if (!$data_output) {
                return [
                    'msg' => 'Data not found.',
                    'status' => 'error'
                ];
            }
            // Store the previous image names
            $previousImage = $data_output->image;
            // Update the fields from the request
            $data_output->name = $request['name'];         
            
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
    public function getById($id)
{
    try {
        $data_output = IconMaster::find($id);
        if ($data_output) {
            return $data_output;
        } else {
            return null;
        }
    } catch (\Exception $e) {
		return [
            'msg' => $e,
            'status' => 'error'
        ];
    }
}

public function updateOneCategory($request) {
    try {
        $data_output = IconMaster::find($request); // Assuming $request directly contains the ID        
        if ($data_output) {
            $is_active = $data_output->is_active === 1 ? 0 : 1;
            $data_output->is_active = $is_active;
            // dd($marquee);
            $data_output->save();

            return [
                'msg' => 'updated successfully.',
                'status' => 'success'
            ];
        }

        return [
            'msg' => 'data not found.',
            'status' => 'error'
        ];
    } catch (\Exception $e) {
        return [
            'msg' => 'Failed to update data.',
            'status' => 'error'
        ];
    }
}


public function deleteById($id){
    try {
        $tress = IconMaster::find($id);
        if ($tress) {
            if (file_exists_view(Config::get('DocumentConstant.ICON_MASTER_DELETE') . $tress->image)){
                removeImage(Config::get('DocumentConstant.ICON_MASTER_DELETE') . $tress->image);
            }
            $tress->delete();
            
            return $tress;
        } else {
            return null;
        }
    } catch (\Exception $e) {
        return $e;
    }
}

   
}