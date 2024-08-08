<?php
namespace App\Http\Repository\Admin\Master;
use Illuminate\Database\QueryException;
use DB;
use Illuminate\Support\Carbon;
// use Session;
use App\Models\ {
TreePlantMaster
};
use Config;

class TreePlantRepository  {


    public function getAll(){
        try {
          $data_output = TreePlantMaster::orderBy('updated_at', 'desc')->get();
            return $data_output;
        } catch (\Exception $e) {
            return $e;
        }
    }


    public function addAll($request)
    {   
        try {

            $dataOutput = new TreePlantMaster();
            $dataOutput->english_name = $request->english_name;
            $dataOutput->hindi_name = $request->hindi_name;
            $dataOutput->english_botnical_name = $request->english_botnical_name;
            $dataOutput->hindi_botnical_name = $request->hindi_botnical_name;
            $dataOutput->english_common_name = $request->english_common_name;
            $dataOutput->hindi_common_name = $request->hindi_common_name;
            $dataOutput->save();

            return [
                'status' => 'success'
            ];

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
          

            $dataOutput = TreePlantMaster::find($request->id);

            if (!$dataOutput) {
                return [
                    'msg' => 'Update Data not found.',
                    'status' => 'error'
                ];
            }

            $dataOutput->english_name = $request->english_name;
            $dataOutput->hindi_name = $request->hindi_name;
            $dataOutput->english_botnical_name = $request->english_botnical_name;
            $dataOutput->hindi_botnical_name = $request->hindi_botnical_name;
            $dataOutput->english_common_name = $request->english_common_name;
            $dataOutput->hindi_common_name = $request->hindi_common_name;

            $dataOutput->save();
            $return_data['image'] = $previousEnglishImage;
            return  $return_data;
        
        } catch (\Exception $e) {
            return [
                'msg' => 'Failed to Update Data.',
                'status' => 'error',
                'error' => $e->getMessage()
            ];
        }
    }

    public function getById($id)
{
    try {
        $data_output = TreePlantMaster::find($id);
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
        $data_output = TreePlantMaster::find($request); // Assuming $request directly contains the ID        
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
        $data_output = TreePlantMaster::find($id);
        $data_output->delete();
            
        return $data_output;
    } catch (\Exception $e) {
        return $e;
    }
}
   
}