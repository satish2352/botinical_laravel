<?php
namespace App\Http\Repository\Admin\ZoneCoOrdinate;
use Illuminate\Database\QueryException;
use DB;
use Illuminate\Support\Carbon;
// use Session;
use App\Models\ {
    ZoneCoOrdinate
};
use Config;

class ZoneCoOrdinateRepository  {


    public function getAll(){
        try {
          $data_output = ZoneCoOrdinate::orderBy('updated_at', 'desc')->get();
            return $data_output;
        } catch (\Exception $e) {
            return $e;
        }
    }   
    public function addAll($request){
        try {
            $data = array();
            $add_data = new ZoneCoOrdinate();
            $add_data->colour_picker = $request['colour_picker'];
            $add_data->save(); 
    
            $last_insert_id = $add_data->id;
    
            // Ensure the file extension is .kml
            $imageExtension = $request->file('image')->getClientOriginalExtension();
            if ($imageExtension !== 'kml') {
                throw new \Exception('The file must be a KML file.');
            }
    
            $imageName = $last_insert_id . '_' . rand(100000, 999999) . $imageExtension;
            
            $add_data->image = $imageName;
            $add_data->save();
            $data['ImageName'] = $imageName;
            return $data;
    
        } catch (\Exception $e) {
            return [
                'msg' => $e->getMessage(),
                'status' => 'error'
            ];
        }
    }
    
    public function updateAll($request){
        try {
            $return_data = array();
            $data_output = ZoneCoOrdinate::find($request->id);

            if (!$data_output) {
                return [
                    'msg' => 'Data not found.',
                    'status' => 'error'
                ];
            }
            // Store the previous image names
            $previousImage = $data_output->image;
            // Update the fields from the request
            $data_output->colour_picker = $request['colour_picker'];         
            
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
        $data_output = ZoneCoOrdinate::find($id);
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
        $data_output = ZoneCoOrdinate::find($request); // Assuming $request directly contains the ID        
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
        $tress = ZoneCoOrdinate::find($id);
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