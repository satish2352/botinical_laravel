<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use App\Models\ {
    Tress,
    Flowers,
    IconMaster
}
;

class MappingController extends Controller
 {
    public function filterMapData(Request $request) {
        try {
            $language = $request->input('language', 'english');
            $category_id = $request->input('icon_id');
            $amenities_id = $request->input('amenities_id');
            $flowers_id = $request->input('flowers_id');
    
            // Initialize response variables
            $totalRecords = 0;
            $data_output = [];
    
            // Filter data for Tress
            $basic_query_object_trees = Tress::where('tbl_trees.is_active', true);
            
            if ($amenities_id) {
                $basic_query_object_trees->where('tbl_trees.id', $amenities_id);
            }
    
            $totalRecords = $basic_query_object_trees->count();
    
            if ($language == 'hindi') {
                $data_output_trees = $basic_query_object_trees
                    ->leftJoin('icon_master', 'tbl_trees.icon_id', '=', 'icon_master.id')
                    ->select('tbl_trees.id as id', 'tbl_trees.icon_id', 'icon_master.name as icon_name', 'tbl_trees.hindi_name as name', 'tbl_trees.image')
                    ->when($category_id, function ($query) use ($category_id) {
                        $query->where('icon_master.id', $category_id);
                    })
                    ->get()
                    ->toArray();
            } else {
                $data_output_trees = $basic_query_object_trees
                    ->leftJoin('icon_master', 'tbl_trees.icon_id', '=', 'icon_master.id')
                    ->select('tbl_trees.id as id', 'tbl_trees.icon_id', 'icon_master.name as icon_name', 'icon_master.image as icon_image', 'tbl_trees.english_name as name', 'tbl_trees.image')
                    ->when($category_id, function ($query) use ($category_id) {
                        $query->where('icon_master.id', $category_id);
                    })
                    ->get()
                    ->toArray();
            }
    
            foreach ($data_output_trees as &$treeDetail) {
                $treeDetail['image'] = Config::get('DocumentConstant.TRESS_VIEW') . $treeDetail['image'];
                $treeDetail['icon_image'] = Config::get('DocumentConstant.ICON_MASTER_VIEW') . $treeDetail['icon_image'];
            }
    
            // Filter data for Flowers
            $basic_query_object_flowers = Flowers::where('tbl_flowers.is_active', true);
            
            if ($amenities_id) {
                $basic_query_object_flowers->where('tbl_flowers.id', $amenities_id);
            }
    
            $totalRecords = $basic_query_object_flowers->count();
    
            if ($language == 'hindi') {
                $data_output_flowers = $basic_query_object_flowers
                    ->leftJoin('icon_master', 'tbl_flowers.icon_id', '=', 'icon_master.id')
                    ->select('tbl_flowers.id as id', 'tbl_flowers.icon_id', 'icon_master.name as icon_name', 'tbl_flowers.hindi_name as name', 'tbl_flowers.image')
                    ->when($category_id, function ($query) use ($category_id) {
                        $query->where('icon_master.id', $category_id);
                    })
                    ->get()
                    ->toArray();
            } else {
                $data_output_flowers = $basic_query_object_flowers
                    ->leftJoin('icon_master', 'tbl_flowers.icon_id', '=', 'icon_master.id')
                    ->select('tbl_flowers.id as id', 'tbl_flowers.icon_id', 'icon_master.name as icon_name', 'icon_master.image as icon_image', 'tbl_flowers.english_name as name', 'tbl_flowers.image')
                    ->when($category_id, function ($query) use ($category_id) {
                        $query->where('icon_master.id', $category_id);
                    })
                    ->get()
                    ->toArray();
            }
    
            foreach ($data_output_flowers as &$flowerDetail) {
                $flowerDetail['image'] = Config::get('DocumentConstant.FLOWERS_VIEW') . $flowerDetail['image'];
                $flowerDetail['icon_image'] = Config::get('DocumentConstant.ICON_MASTER_VIEW') . $flowerDetail['icon_image'];
            }
    
            // Combine both data sets into a single response
            $combined_data_output = array_merge($data_output_trees, $data_output_flowers);
    
            return response()->json([
                'status' => 'true',
                'message' => 'All data retrieved successfully',
                'totalRecords' => $totalRecords,
                'Data' => $combined_data_output
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'false',
                'message' => 'Amenities Us List Fail',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    
 }
