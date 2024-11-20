<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Validator;
use App\Models\ {
    TreePlantMaster,
    IconMaster,
    Roles,
    Tress,
    Flowers,
    Amenities,
    ZonesArea
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


    public function getIconMaster(Request $request) {
        try {
            $data_output = IconMaster::where('is_active','=',true)
            ->select('id', 'name','image')
           ->get()
           ->toArray();
                            
            return response()->json([
                'status' => true,
                'message' => 'All data retrieved successfully',
                'data' => $data_output
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Tree Icon List Fail',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getRole(Request $request) {
        try {
            $data_output = Roles::where('is_active','=',true)
            ->select('id', 'role_name')
           ->get()
           ->toArray();
                            
            return response()->json([
                'status' => true,
                'message' => 'All data retrieved successfully',
                'data' => $data_output
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Tree Icon List Fail',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function countTressPlantAminitiesZoneOrderNumberARVR(Request $request)
{
    try {
        // Example setup for language (this can be replaced with actual logic)
        $language = $request->input('language', 'english'); // Default language is English
        $category_id = 1;

        // Fetch counts for different entities
        $treesCount = Tress::where('is_active', true)->count();
        $plantCount = Flowers::where('is_active', true)->count();
        $amenitiesCount = Amenities::where('is_active', true)->count();
        $zoneCount = ZonesArea::where('is_active', true)->count();

        // Calculate ARVR Count
        $ARVRCount = Amenities::leftJoin('tbl_amenities_category', 'tbl_amenities.amenities_category_id', '=', 'tbl_amenities_category.id')
            ->where('tbl_amenities.is_active', true) 
            ->where('tbl_amenities_category.id', $category_id)
            ->count();

        // Calculate the Order Number Count
        $orderNumberCount = Amenities::where('id', '!=', 1)
            ->where('order_number', '>', 0)
            ->where('is_active', true)
            ->count();

        // Return the counts in the response
        return response()->json([
            'status' => true,
            'message' => 'Counts retrieved successfully',
            'trees' => $treesCount,
            'plants' => $plantCount,
            'amenities' => $amenitiesCount,
            'zones' => $zoneCount,
            'ARVR' => $ARVRCount,
            'order_number' => $orderNumberCount,
        ], 200);

    } catch (\Exception $e) {
        // Return error if any exception occurs
        return response()->json([
            'status' => false,
            'message' => 'Counts retrieval failed',
            'error' => $e->getMessage(),
        ], 500);
    }
}





 
}
