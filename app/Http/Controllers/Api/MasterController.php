<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Validator;
use App\Models\ {
    TreePlantMaster
};


class MasterController extends Controller
{
      public function getTreePlantMaster(Request $request) {
        try {
            // $language = $request->input('language', 'english'); 
            $tree_plant_id = $request->input('tree_plant_id');

            $data_output = TreePlantMaster::where('is_active','=',true)
            ->when($tree_plant_id, function ($query) use ($tree_plant_id) {
                $query->where('tbl_tree_plant.id', $tree_plant_id); 
            });
            
            $data_output =  $data_output->select('id', 'english_name','hindi_name', 'english_botnical_name', 'hindi_botnical_name', 'english_common_name', 'hindi_common_name');
           
            $data_output =  $data_output->get()
                            ->toArray();
                            
            return response()->json([
                'status' => true,
                'message' => 'All data retrieved successfully',
                'data' => $data_output
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Tree Plant List Fail',
                'error' => $e->getMessage()
            ], 500);
        }
    }
 
}
