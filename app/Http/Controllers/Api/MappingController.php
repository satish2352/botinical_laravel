<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use App\Models\ {
    Tress,
    Flowers,
    Amenities,
    IconMaster
}
;

class MappingController extends Controller
 {
    // public function filterMapData(Request $request) {
    //     try {
    //         $language = $request->input('language', 'english');
    //         $category_id = $request->input('icon_id');
    //         $tress_id = $request->input( 'tress_id' );
    //         $amenities_id = $request->input('amenities_id');
    //         $flowers_id = $request->input('flowers_id');
    
    //         // Initialize response variables
    //         $totalRecords = 0;
    //         $data_output = [];
    
    //         // Filter data for Tress
    //         $basic_query_object_trees = Tress::where('tbl_trees.is_active', true);
            
    //         if ($tress_id) {
    //             $basic_query_object_trees->where('tbl_trees.id', $tress_id);
    //         }
    
    //         $totalRecords = $basic_query_object_trees->count();
    
    //         if ($language == 'hindi') {
    //             $data_output_trees = $basic_query_object_trees
    //                 ->leftJoin('icon_master', 'tbl_trees.icon_id', '=', 'icon_master.id')
    //                 ->select('tbl_trees.id as id', 'tbl_trees.icon_id', 'icon_master.name as icon_name', 'tbl_trees.hindi_name as name','icon_master.image as icon_image','hindi_description as description',
    //             'tbl_trees.hindi_audio_link as audio_link',
    //             'tbl_trees.hindi_video_upload as video_upload',
    //             'tbl_trees.latitude',
    //             'tbl_trees.height','tbl_trees.height_type', 'tbl_trees.canopy', 'tbl_trees.canopy_type','tbl_trees.girth','tbl_trees.girth_type',
    //             'tbl_trees.longitude', 'tbl_trees.image', 'tbl_trees.image_two', 'tbl_trees.image_three', 'tbl_trees.image_four', 'tbl_trees.image_five')
    //                 ->when($category_id, function ($query) use ($category_id) {
    //                     $query->where('icon_master.id', $category_id);
    //                 })
    //                 ->get()
    //                 ->toArray();
    //         } else {
    //             $data_output_trees = $basic_query_object_trees
    //                 ->leftJoin('icon_master', 'tbl_trees.icon_id', '=', 'icon_master.id')
    //                 ->select('tbl_trees.id as id', 'tbl_trees.icon_id', 'icon_master.name as icon_name', 'icon_master.image as icon_image', 'tbl_trees.english_name as name', 'english_description as description',
    //                 'tbl_trees.english_audio_link as audio_link',
    //                 'tbl_trees.english_video_upload as video_upload',
    //                 'tbl_trees.latitude',
    //                 'tbl_trees.longitude', 'tbl_trees.height','tbl_trees.height_type', 'tbl_trees.canopy', 'tbl_trees.canopy_type','tbl_trees.girth','tbl_trees.girth_type', 'tbl_trees.image', 'tbl_trees.image_two', 'tbl_trees.image_three', 'tbl_trees.image_four', 'tbl_trees.image_five')
    //                 ->when($category_id, function ($query) use ($category_id) {
    //                     $query->where('icon_master.id', $category_id);
    //                 })
    //                 ->get()
    //                 ->toArray();
    //         }
    //         foreach ($data_output_trees as &$treeDetail) {
    //             $treeDetail['image'] = Config::get('DocumentConstant.TRESS_VIEW') . $treeDetail['image'];
    //             $treeDetail['image_two'] = $treeDetail['image_two'] ? Config::get('DocumentConstant.TRESS_VIEW') . $treeDetail['image_two'] : null;
    //             $treeDetail['image_three'] = $treeDetail['image_three'] ? Config::get('DocumentConstant.TRESS_VIEW') . $treeDetail['image_three'] : null;
    //             $treeDetail['image_four'] = $treeDetail['image_four'] ? Config::get('DocumentConstant.TRESS_VIEW') . $treeDetail['image_four'] : null;
    //             $treeDetail['image_five'] = $treeDetail['image_five'] ? Config::get('DocumentConstant.TRESS_VIEW') . $treeDetail['image_five'] : null;
    //             $treeDetail['icon_image'] = $treeDetail['icon_image'] ? Config::get('DocumentConstant.ICON_MASTER_VIEW') . $treeDetail['icon_image'] : null;
    //             if ($language == 'hindi') {
    //                 $treeDetail['audio_link'] = $treeDetail['audio_link'] ? Config::get('DocumentConstant.TRESS_VIEW') . $treeDetail['audio_link'] : null;
    //                 $treeDetail['video_upload'] = $treeDetail['video_upload'] ? Config::get('DocumentConstant.TRESS_VIEW') . $treeDetail['video_upload'] : null;
    //             } else {
    //                 $treeDetail['audio_link'] = $treeDetail['audio_link'] ? Config::get('DocumentConstant.TRESS_VIEW') . $treeDetail['audio_link'] : null;
    //                 $treeDetail['video_upload'] = $treeDetail['video_upload'] ? Config::get('DocumentConstant.TRESS_VIEW') . $treeDetail['video_upload'] : null;
    //             }
    //         }
    //         // Filter data for Flowers
    //         $basic_query_object_flowers = Flowers::where('tbl_flowers.is_active', true);
            
    //         if ($flowers_id) {
    //             $basic_query_object_flowers->where('tbl_flowers.id', $flowers_id);
    //         }
    
    //         $totalRecords = $basic_query_object_flowers->count();
    
    //         if ($language == 'hindi') {
    //             $data_output_flowers = $basic_query_object_flowers
    //                 ->leftJoin('icon_master', 'tbl_flowers.icon_id', '=', 'icon_master.id')
    //                 ->select('tbl_flowers.id as id', 'tbl_flowers.icon_id', 'icon_master.name as icon_name', 'tbl_flowers.hindi_name as name', 'icon_master.image as icon_image', 'hindi_description as description',
    //                 'tbl_flowers.hindi_audio_link as audio_link',
    //                 'tbl_flowers.hindi_video_upload as video_upload',
    //                 'tbl_flowers.latitude',
    //                 'tbl_flowers.longitude', 
    //                 'tbl_flowers.height','tbl_flowers.height_type', 'tbl_flowers.canopy', 'tbl_flowers.canopy_type','tbl_flowers.girth','tbl_flowers.girth_type',
    //                 'tbl_flowers.image', 'tbl_flowers.image_two', 'tbl_flowers.image_three', 'tbl_flowers.image_four', 'tbl_flowers.image_five')
    //                 ->when($category_id, function ($query) use ($category_id) {
    //                     $query->where('icon_master.id', $category_id);
    //                 })
    //                 ->get()
    //                 ->toArray();
    //         } else {
    //             $data_output_flowers = $basic_query_object_flowers
    //                 ->leftJoin('icon_master', 'tbl_flowers.icon_id', '=', 'icon_master.id')
    //                 ->select('tbl_flowers.id as id', 'tbl_flowers.icon_id', 'icon_master.name as icon_name', 'icon_master.image as icon_image', 'tbl_flowers.english_name as name', 'english_description as description',
    //                 'tbl_flowers.english_audio_link as audio_link',
    //                 'tbl_flowers.english_video_upload as video_upload',
    //                 'tbl_flowers.latitude',
    //                 'tbl_flowers.longitude', 'tbl_flowers.height','tbl_flowers.height_type', 'tbl_flowers.canopy', 'tbl_flowers.canopy_type','tbl_flowers.girth','tbl_flowers.girth_type', 'tbl_flowers.image', 'tbl_flowers.image_two', 'tbl_flowers.image_three', 'tbl_flowers.image_four', 'tbl_flowers.image_five')
    //                 ->when($category_id, function ($query) use ($category_id) {
    //                     $query->where('icon_master.id', $category_id);
    //                 })
    //                 ->get()
    //                 ->toArray();
    //         }
    //         foreach ($data_output_flowers as &$flowerDetail) {
    //             $flowerDetail['image'] = Config::get('DocumentConstant.FLOWERS_VIEW') . $flowerDetail['image'];
    //             $flowerDetail['image_two'] = $flowerDetail['image_two'] ? Config::get('DocumentConstant.FLOWERS_VIEW') . $flowerDetail['image_two'] : null;
    //             $flowerDetail['image_three'] = $flowerDetail['image_three'] ? Config::get('DocumentConstant.FLOWERS_VIEW') . $flowerDetail['image_three'] : null;
    //             $flowerDetail['image_four'] = $flowerDetail['image_four'] ? Config::get('DocumentConstant.FLOWERS_VIEW') . $flowerDetail['image_four'] : null;
    //             $flowerDetail['image_five'] = $flowerDetail['image_five'] ? Config::get('DocumentConstant.FLOWERS_VIEW') . $flowerDetail['image_five'] : null;
    //             $flowerDetail['icon_image'] = $flowerDetail['icon_image'] ? Config::get('DocumentConstant.ICON_MASTER_VIEW') . $flowerDetail['icon_image'] : null;
    
    //             if ($language == 'hindi') {
    //                 $flowerDetail['audio_link'] = $flowerDetail['audio_link'] ? Config::get('DocumentConstant.FLOWERS_VIEW') . $flowerDetail['audio_link'] : null;
    //                 $flowerDetail['video_upload'] = $flowerDetail['video_upload'] ? Config::get('DocumentConstant.FLOWERS_VIEW') . $flowerDetail['video_upload'] : null;
    //             } else {
    //                 $flowerDetail['audio_link'] = $flowerDetail['audio_link'] ? Config::get('DocumentConstant.FLOWERS_VIEW') . $flowerDetail['audio_link'] : null;
    //                 $flowerDetail['video_upload'] = $flowerDetail['video_upload'] ? Config::get('DocumentConstant.FLOWERS_VIEW') . $flowerDetail['video_upload'] : null;
    //             }
    //         }
    //           // Filter data for Aminities
    //           $basic_query_object_aminities = Amenities::where('tbl_amenities.is_active', true);
            
    //           if ($flowers_id) {
    //               $basic_query_object_aminities->where('tbl_amenities.id', $flowers_id);
    //           }
      
    //           $totalRecords = $basic_query_object_aminities->count();
      
    //           if ($language == 'hindi') {
    //               $data_output_aminities = $basic_query_object_aminities
    //                   ->leftJoin('icon_master', 'tbl_amenities.icon_id', '=', 'icon_master.id')
    //                   ->select('tbl_amenities.id as id', 'tbl_amenities.icon_id', 'icon_master.name as icon_name', 'tbl_amenities.hindi_name as name', 'icon_master.image as icon_image', 'hindi_description as description',
    //                   'tbl_amenities.hindi_audio_link as audio_link',
    //                   'tbl_amenities.hindi_video_upload as video_upload',
    //                   'tbl_amenities.latitude',
    //                   'tbl_amenities.longitude', 
    //                   'tbl_amenities.image', 'tbl_amenities.image_two', 'tbl_amenities.image_three', 'tbl_amenities.image_four', 'tbl_amenities.image_five', 'tbl_amenities.open_time_first', 'tbl_amenities.close_time_first', 'tbl_amenities.open_time_second', 'tbl_amenities.close_time_second')
    //                   ->when($category_id, function ($query) use ($category_id) {
    //                       $query->where('icon_master.id', $category_id);
    //                   })
    //                   ->get()
    //                   ->toArray();
    //           } else {
    //               $data_output_aminities = $basic_query_object_aminities
    //                   ->leftJoin('icon_master', 'tbl_amenities.icon_id', '=', 'icon_master.id')
    //                   ->select('tbl_amenities.id as id', 'tbl_amenities.icon_id', 'icon_master.name as icon_name', 'icon_master.image as icon_image', 'tbl_amenities.english_name as name', 'english_description as description',
    //                   'tbl_amenities.english_audio_link as audio_link',
    //                   'tbl_amenities.english_video_upload as video_upload',
    //                   'tbl_amenities.latitude',
    //                   'tbl_amenities.longitude', 'tbl_amenities.image', 'tbl_amenities.image_two', 'tbl_amenities.image_three', 'tbl_amenities.image_four', 'tbl_amenities.image_five', 'tbl_amenities.open_time_first', 'tbl_amenities.close_time_first', 'tbl_amenities.open_time_second', 'tbl_amenities.close_time_second')
    //                   ->when($category_id, function ($query) use ($category_id) {
    //                       $query->where('icon_master.id', $category_id);
    //                   })
    //                   ->get()
    //                   ->toArray();
    //           }
    //           foreach ($data_output_aminities as &$aminitiesDetail) {
    //             $aminitiesDetail['image'] = Config::get('DocumentConstant.AMENITIES_VIEW') . $aminitiesDetail['image'];
    //             $aminitiesDetail['image_two'] = $aminitiesDetail['image_two'] ? Config::get('DocumentConstant.AMENITIES_VIEW') . $aminitiesDetail['image_two'] : null;
    //             $aminitiesDetail['image_three'] = $aminitiesDetail['image_three'] ? Config::get('DocumentConstant.AMENITIES_VIEW') . $aminitiesDetail['image_three'] : null;
    //             $aminitiesDetail['image_four'] = $aminitiesDetail['image_four'] ? Config::get('DocumentConstant.AMENITIES_VIEW') . $aminitiesDetail['image_four'] : null;
    //             $aminitiesDetail['image_five'] = $aminitiesDetail['image_five'] ? Config::get('DocumentConstant.AMENITIES_VIEW') . $aminitiesDetail['image_five'] : null;
    //             $aminitiesDetail['icon_image'] = $aminitiesDetail['icon_image'] ? Config::get('DocumentConstant.ICON_MASTER_VIEW') . $aminitiesDetail['icon_image'] : null;

    //             if ($language == 'hindi') {
    //                 $aminitiesDetail['audio_link'] = $aminitiesDetail['audio_link'] ? Config::get('DocumentConstant.AMENITIES_VIEW') . $aminitiesDetail['audio_link'] : null;
    //                 $aminitiesDetail['video_upload'] = $aminitiesDetail['video_upload'] ? Config::get('DocumentConstant.AMENITIES_VIEW') . $aminitiesDetail['video_upload'] : null;
    //             } else {
    //                 $aminitiesDetail['audio_link'] = $aminitiesDetail['audio_link'] ? Config::get('DocumentConstant.AMENITIES_VIEW') . $aminitiesDetail['audio_link'] : null;
    //                 $aminitiesDetail['video_upload'] = $aminitiesDetail['video_upload'] ? Config::get('DocumentConstant.AMENITIES_VIEW') . $aminitiesDetail['video_upload'] : null;
    //             }
    //         }
    //         // Combine both data sets into a single response
    //         $combined_data_output = array_merge($data_output_trees, $data_output_flowers,$data_output_aminities);
    
    //         return response()->json([
    //             'status' => 'true',
    //             'message' => 'All data retrieved successfully',
    //             'totalRecords' => $totalRecords,
    //             'data' => $combined_data_output
    //         ], 200);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'status' => 'false',
    //             'message' => 'Amenities Us List Fail',
    //             'error' => $e->getMessage()
    //         ], 500);
    //     }
    // }
    // public function filterMapDataNew(Request $request) {
    //     try {
    //         $language = $request->input('language', 'english');
    //         $category_id = $request->input('icon_id');
    //         $tress_id = $request->input('tress_id');
    //         $flowers_id = $request->input('flowers_id');
    //         $amenities_id = $request->input('amenities_id');
    
    //         $treesData = [];
    //         $flowersData = [];
    //         $amenitiesData = [];
    
    //         // Filter data for Trees
    //         $basic_query_object_trees = Tress::join('tbl_tree_plant', 'tbl_tree_plant.id', '=', 'tbl_trees.tree_plant_id')
    //         ->where('tbl_tree_plant.is_active', true);
            
    
    //         if ($tress_id) {
    //             $basic_query_object_trees->where('tbl_trees.id', $tress_id);
    //         }
    
    //         $data_output_trees = $basic_query_object_trees
    //             ->leftJoin('icon_master', 'tbl_trees.icon_id', '=', 'icon_master.id')
    //             ->select('tbl_trees.id as id', 'tbl_trees.icon_id', 'icon_master.name as icon_name',
    //                 'tbl_tree_plant.' . $language . '_name as name', $language . '_description as description',
    //                 'tbl_trees.' . $language . '_audio_link as audio_link',
    //                 'tbl_trees.' . $language . '_video_upload as video_upload',
    //                 'tbl_trees.latitude', 'tbl_trees.longitude', 'tbl_trees.height', 'tbl_trees.height_type',
    //                 'tbl_trees.canopy', 'tbl_trees.canopy_type', 'tbl_trees.girth', 'tbl_trees.girth_type',
    //                 'tbl_trees.image', 'icon_master.image as icon_image', 'tbl_trees.image_two', 
    //                 'tbl_trees.image_three', 'tbl_trees.image_four', 'tbl_trees.image_five')
    //             ->when($category_id, function ($query) use ($category_id) {
    //                 $query->where('icon_master.id', $category_id);
    //             })
    //             ->get()
    //             ->toArray();
    
    //         foreach ($data_output_trees as &$treeDetail) {
    //             $treeDetail['image'] = Config::get('DocumentConstant.TRESS_VIEW') . $treeDetail['image'];
    //             $treeDetail['image_two'] = $treeDetail['image_two'] ? Config::get('DocumentConstant.TRESS_VIEW') . $treeDetail['image_two'] : null;
    //             $treeDetail['image_three'] = $treeDetail['image_three'] ? Config::get('DocumentConstant.TRESS_VIEW') . $treeDetail['image_three'] : null;
    //             $treeDetail['image_four'] = $treeDetail['image_four'] ? Config::get('DocumentConstant.TRESS_VIEW') . $treeDetail['image_four'] : null;
    //             $treeDetail['image_five'] = $treeDetail['image_five'] ? Config::get('DocumentConstant.TRESS_VIEW') . $treeDetail['image_five'] : null;
    //             $treeDetail['icon_image'] = $treeDetail['icon_image'] ? Config::get('DocumentConstant.ICON_MASTER_VIEW') . $treeDetail['icon_image'] : null;

    //             if ($language == 'hindi') {
    //                 $treeDetail['audio_link'] = $treeDetail['audio_link'] ? Config::get('DocumentConstant.TRESS_VIEW') . $treeDetail['audio_link'] : null;
    //                 $treeDetail['video_upload'] = $treeDetail['video_upload'] ? Config::get('DocumentConstant.TRESS_VIEW') . $treeDetail['video_upload'] : null;
    //             } else {
    //                 $treeDetail['audio_link'] = $treeDetail['audio_link'] ? Config::get('DocumentConstant.TRESS_VIEW') . $treeDetail['audio_link'] : null;
    //                 $treeDetail['video_upload'] = $treeDetail['video_upload'] ? Config::get('DocumentConstant.TRESS_VIEW') . $treeDetail['video_upload'] : null;
    //             }
    //         }
    
    //         $treesData = $data_output_trees;
    
    //         // Filter data for Flowers
    //         $basic_query_object_flowers = Flowers::join('tbl_tree_plant', 'tbl_tree_plant.id', '=', 'tbl_flowers.tree_plant_id')
    //         ->where('tbl_tree_plant.is_active', true);
    
    //         if ($flowers_id) {
    //             $basic_query_object_flowers->where('tbl_flowers.id', $flowers_id);
    //         }
    
    //         $data_output_flowers = $basic_query_object_flowers
    //             ->leftJoin('icon_master', 'tbl_flowers.icon_id', '=', 'icon_master.id')
    //             ->leftJoin('icon_master', 'tbl_flowers.icon_id', '=', 'icon_master.id')
    //             ->select('tbl_flowers.id as id', 'tbl_flowers.icon_id', 'icon_master.name as icon_name',
    //                 'tbl_tree_plant.' . $language . '_name as name', $language . '_description as description',
    //                 'tbl_flowers.' . $language . '_audio_link as audio_link',
    //                 'tbl_flowers.' . $language . '_video_upload as video_upload',
    //                 'tbl_flowers.latitude', 'tbl_flowers.longitude', 'tbl_flowers.height', 'tbl_flowers.height_type',
    //                 'tbl_flowers.canopy', 'tbl_flowers.canopy_type', 'tbl_flowers.girth', 'tbl_flowers.girth_type',
    //                 'tbl_flowers.image', 'icon_master.image as icon_image', 'tbl_flowers.image_two', 'tbl_flowers.image_three',
    //                  'tbl_flowers.image_four', 'tbl_flowers.image_five')
    //             ->when($category_id, function ($query) use ($category_id) {
    //                 $query->where('icon_master.id', $category_id);
    //             })
    //             ->get()
    //             ->toArray();
    //             foreach ($data_output_flowers as &$flowerDetail) {
    //             $flowerDetail['image'] = Config::get('DocumentConstant.FLOWERS_VIEW') . $flowerDetail['image'];
    //             $flowerDetail['image_two'] = $flowerDetail['image_two'] ? Config::get('DocumentConstant.FLOWERS_VIEW') . $flowerDetail['image_two'] : null;
    //             $flowerDetail['image_three'] = $flowerDetail['image_three'] ? Config::get('DocumentConstant.FLOWERS_VIEW') . $flowerDetail['image_three'] : null;
    //             $flowerDetail['image_four'] = $flowerDetail['image_four'] ? Config::get('DocumentConstant.FLOWERS_VIEW') . $flowerDetail['image_four'] : null;
    //             $flowerDetail['image_five'] = $flowerDetail['image_five'] ? Config::get('DocumentConstant.FLOWERS_VIEW') . $flowerDetail['image_five'] : null;
    //             $flowerDetail['icon_image'] = $flowerDetail['icon_image'] ? Config::get('DocumentConstant.ICON_MASTER_VIEW') . $flowerDetail['icon_image'] : null;

    //             if ($language == 'hindi') {
    //                 $flowerDetail['audio_link'] = $flowerDetail['audio_link'] ? Config::get('DocumentConstant.FLOWERS_VIEW') . $flowerDetail['audio_link'] : null;
    //                 $flowerDetail['video_upload'] = $flowerDetail['video_upload'] ? Config::get('DocumentConstant.FLOWERS_VIEW') . $flowerDetail['video_upload'] : null;
    //             } else {
    //                 $flowerDetail['audio_link'] = $flowerDetail['audio_link'] ? Config::get('DocumentConstant.FLOWERS_VIEW') . $flowerDetail['audio_link'] : null;
    //                 $flowerDetail['video_upload'] = $flowerDetail['video_upload'] ? Config::get('DocumentConstant.FLOWERS_VIEW') . $flowerDetail['video_upload'] : null;
    //             }
    //         }
    
    //         $flowersData = $data_output_flowers;
    
    //         // Filter data for Amenities
    //         $basic_query_object_amenities = Amenities::where('tbl_amenities.is_active', true);
    
    //         if ($amenities_id) {
    //             $basic_query_object_amenities->where('tbl_amenities.id', $amenities_id);
    //         }
    
    //         $data_output_amenities = $basic_query_object_amenities
    //             ->leftJoin('icon_master', 'tbl_amenities.icon_id', '=', 'icon_master.id')
    //             ->select('tbl_amenities.id as id', 'tbl_amenities.icon_id', 'icon_master.name as icon_name',
    //                 'tbl_amenities.' . $language . '_name as name', $language . '_description as description',
    //                 'tbl_amenities.' . $language . '_audio_link as audio_link',
    //                 'tbl_amenities.' . $language . '_video_upload as video_upload',
    //                 'tbl_amenities.latitude', 'tbl_amenities.longitude', 
    //                 'tbl_amenities.image', 'icon_master.image as icon_image', 'tbl_amenities.image_two', 
    //                 'tbl_amenities.image_three', 'tbl_amenities.image_four', 'tbl_amenities.image_five',
    //                 'tbl_amenities.open_time_first', 'tbl_amenities.close_time_first', 'tbl_amenities.open_time_second', 
    //                 'tbl_amenities.close_time_second')
    //             ->when($category_id, function ($query) use ($category_id) {
    //                 $query->where('icon_master.id', $category_id);
    //             })
    //             ->get()
    //             ->toArray();
    //         foreach ($data_output_amenities as &$amenitiesDetail) {
    //             $amenitiesDetail['image'] = Config::get('DocumentConstant.AMENITIES_VIEW') . $amenitiesDetail['image'];
    //             $amenitiesDetail['image_two'] = $amenitiesDetail['image_two'] ? Config::get('DocumentConstant.AMENITIES_VIEW') . $amenitiesDetail['image_two'] : null;
    //             $amenitiesDetail['image_three'] = $amenitiesDetail['image_three'] ? Config::get('DocumentConstant.AMENITIES_VIEW') . $amenitiesDetail['image_three'] : null;
    //             $amenitiesDetail['image_four'] = $amenitiesDetail['image_four'] ? Config::get('DocumentConstant.AMENITIES_VIEW') . $amenitiesDetail['image_four'] : null;
    //             $amenitiesDetail['image_five'] = $amenitiesDetail['image_five'] ? Config::get('DocumentConstant.AMENITIES_VIEW') . $amenitiesDetail['image_five'] : null;
    //             $amenitiesDetail['icon_image'] = $amenitiesDetail['icon_image'] ? Config::get('DocumentConstant.ICON_MASTER_VIEW') . $amenitiesDetail['icon_image'] : null;

    //             if ($language == 'hindi') {
    //                 $amenitiesDetail['audio_link'] = $amenitiesDetail['audio_link'] ? Config::get('DocumentConstant.AMENITIES_VIEW') . $amenitiesDetail['audio_link'] : null;
    //                 $amenitiesDetail['video_upload'] = $amenitiesDetail['video_upload'] ? Config::get('DocumentConstant.AMENITIES_VIEW') . $amenitiesDetail['video_upload'] : null;
    //             } else {
    //                 $amenitiesDetail['audio_link'] = $amenitiesDetail['audio_link'] ? Config::get('DocumentConstant.AMENITIES_VIEW') . $amenitiesDetail['audio_link'] : null;
    //                 $amenitiesDetail['video_upload'] = $amenitiesDetail['video_upload'] ? Config::get('DocumentConstant.AMENITIES_VIEW') . $amenitiesDetail['video_upload'] : null;
    //             }
    //         }
    
    //         $amenitiesData = $data_output_amenities;
    
    //         if ($tress_id) {
    //             return response()->json([
    //                 'status' => 'true',
    //                 'message' => 'Tree data retrieved successfully',
    //                 'treesData' => $treesData
    //             ], 200);
    //         }
    
    //         if ($flowers_id) {
    //             return response()->json([
    //                 'status' => 'true',
    //                 'message' => 'Flower data retrieved successfully',
    //                 'flowersData' => $flowersData
    //             ], 200);
    //         }
    
    //         if ($amenities_id) {
    //             return response()->json([
    //                 'status' => 'true',
    //                 'message' => 'Amenities data retrieved successfully',
    //                 'amenitiesData' => $amenitiesData
    //             ], 200);
    //         }
    
    //         // If no specific ID parameters are provided, return all data
    //         return response()->json([
    //             'status' => 'true',
    //             'message' => 'All data retrieved successfully',
    //             'treesData' => $treesData,
    //             'flowersData' => $flowersData,
    //             'amenitiesData' => $amenitiesData
    //         ], 200);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'status' => 'false',
    //             'message' => 'Data retrieval failed',
    //             'error' => $e->getMessage()
    //         ], 500);
    //     }
    // }
    public function filterMapDataNew(Request $request) {
        try {
            $language = $request->input('language', 'english');
            $category_id = $request->input('icon_id');
            $tress_id = $request->input('tress_id');
            $flowers_id = $request->input('flowers_id');
            $amenities_id = $request->input('amenities_id');
            $search_name = $request->input('name');

            $treesData = [];
            $flowersData = [];
            $amenitiesData = [];
    
            // Filter data for Trees
            $basic_query_object_trees = Tress::join('tbl_tree_plant', 'tbl_tree_plant.id', '=', 'tbl_trees.tree_plant_id')
                ->where('tbl_tree_plant.is_active', true);
            
            if ($tress_id) {
                $basic_query_object_trees->where('tbl_trees.id', $tress_id);
            }
            if ($search_name) {
                    $basic_query_object_trees->where('tbl_tree_plant.' . $language . '_name', 'LIKE', '%' . $search_name . '%');
            }
            $data_output_trees = $basic_query_object_trees
                ->leftJoin('icon_master', 'tbl_trees.icon_id', '=', 'icon_master.id')
                ->select('tbl_trees.id as id', 'tbl_trees.icon_id', 'icon_master.name as icon_name',
                    'tbl_tree_plant.' . $language . '_name as name', $language . '_description as description',
                    'tbl_trees.' . $language . '_audio_link as audio_link',
                    'tbl_trees.' . $language . '_video_upload as video_upload',
                    'tbl_trees.latitude', 'tbl_trees.longitude', 'tbl_trees.height', 'tbl_trees.height_type',
                    'tbl_trees.canopy', 'tbl_trees.canopy_type', 'tbl_trees.girth', 'tbl_trees.girth_type',
                    'tbl_trees.image', 'icon_master.image as icon_image', 'tbl_trees.image_two', 
                    'tbl_trees.image_three', 'tbl_trees.image_four', 'tbl_trees.image_five')
                ->when($category_id, function ($query) use ($category_id) {
                    $query->where('icon_master.id', $category_id);
                })
                ->get()
                ->toArray();
    
            foreach ($data_output_trees as &$treeDetail) {
                $treeDetail['image'] = Config::get('DocumentConstant.TRESS_VIEW') . $treeDetail['image'];
                $treeDetail['image_two'] = $treeDetail['image_two'] ? Config::get('DocumentConstant.TRESS_VIEW') . $treeDetail['image_two'] : null;
                $treeDetail['image_three'] = $treeDetail['image_three'] ? Config::get('DocumentConstant.TRESS_VIEW') . $treeDetail['image_three'] : null;
                $treeDetail['image_four'] = $treeDetail['image_four'] ? Config::get('DocumentConstant.TRESS_VIEW') . $treeDetail['image_four'] : null;
                $treeDetail['image_five'] = $treeDetail['image_five'] ? Config::get('DocumentConstant.TRESS_VIEW') . $treeDetail['image_five'] : null;
                $treeDetail['icon_image'] = $treeDetail['icon_image'] ? Config::get('DocumentConstant.ICON_MASTER_VIEW') . $treeDetail['icon_image'] : null;
    
                if ($language == 'hindi') {
                    $treeDetail['audio_link'] = $treeDetail['audio_link'] ? Config::get('DocumentConstant.TRESS_VIEW') . $treeDetail['audio_link'] : null;
                    $treeDetail['video_upload'] = $treeDetail['video_upload'] ? Config::get('DocumentConstant.TRESS_VIEW') . $treeDetail['video_upload'] : null;
                } else {
                    $treeDetail['audio_link'] = $treeDetail['audio_link'] ? Config::get('DocumentConstant.TRESS_VIEW') . $treeDetail['audio_link'] : null;
                    $treeDetail['video_upload'] = $treeDetail['video_upload'] ? Config::get('DocumentConstant.TRESS_VIEW') . $treeDetail['video_upload'] : null;
                }
            }
    
            $treesData = $data_output_trees;
    
            // Filter data for Flowers
            $basic_query_object_flowers = Flowers::join('tbl_tree_plant', 'tbl_tree_plant.id', '=', 'tbl_flowers.tree_plant_id')
                ->where('tbl_tree_plant.is_active', true);
    
            if ($flowers_id) {
                $basic_query_object_flowers->where('tbl_flowers.id', $flowers_id);
            }
            if ($search_name) {
                $basic_query_object_flowers->where('tbl_tree_plant.' . $language . '_name', 'LIKE', '%' . $search_name . '%');
            }
            $data_output_flowers = $basic_query_object_flowers
                ->leftJoin('icon_master', 'tbl_flowers.icon_id', '=', 'icon_master.id')
                ->select('tbl_flowers.id as id', 'tbl_flowers.icon_id', 'icon_master.name as icon_name',
                    'tbl_tree_plant.' . $language . '_name as name', $language . '_description as description',
                    'tbl_flowers.' . $language . '_audio_link as audio_link',
                    'tbl_flowers.' . $language . '_video_upload as video_upload',
                    'tbl_flowers.latitude', 'tbl_flowers.longitude', 'tbl_flowers.height', 'tbl_flowers.height_type',
                    'tbl_flowers.canopy', 'tbl_flowers.canopy_type', 'tbl_flowers.girth', 'tbl_flowers.girth_type',
                    'tbl_flowers.image', 'icon_master.image as icon_image', 'tbl_flowers.image_two', 'tbl_flowers.image_three',
                    'tbl_flowers.image_four', 'tbl_flowers.image_five')
                ->when($category_id, function ($query) use ($category_id) {
                    $query->where('icon_master.id', $category_id);
                })
                ->get()
                ->toArray();
    
            foreach ($data_output_flowers as &$flowerDetail) {
                $flowerDetail['image'] = Config::get('DocumentConstant.FLOWERS_VIEW') . $flowerDetail['image'];
                $flowerDetail['image_two'] = $flowerDetail['image_two'] ? Config::get('DocumentConstant.FLOWERS_VIEW') . $flowerDetail['image_two'] : null;
                $flowerDetail['image_three'] = $flowerDetail['image_three'] ? Config::get('DocumentConstant.FLOWERS_VIEW') . $flowerDetail['image_three'] : null;
                $flowerDetail['image_four'] = $flowerDetail['image_four'] ? Config::get('DocumentConstant.FLOWERS_VIEW') . $flowerDetail['image_four'] : null;
                $flowerDetail['image_five'] = $flowerDetail['image_five'] ? Config::get('DocumentConstant.FLOWERS_VIEW') . $flowerDetail['image_five'] : null;
                $flowerDetail['icon_image'] = $flowerDetail['icon_image'] ? Config::get('DocumentConstant.ICON_MASTER_VIEW') . $flowerDetail['icon_image'] : null;
    
                if ($language == 'hindi') {
                    $flowerDetail['audio_link'] = $flowerDetail['audio_link'] ? Config::get('DocumentConstant.FLOWERS_VIEW') . $flowerDetail['audio_link'] : null;
                    $flowerDetail['video_upload'] = $flowerDetail['video_upload'] ? Config::get('DocumentConstant.FLOWERS_VIEW') . $flowerDetail['video_upload'] : null;
                } else {
                    $flowerDetail['audio_link'] = $flowerDetail['audio_link'] ? Config::get('DocumentConstant.FLOWERS_VIEW') . $flowerDetail['audio_link'] : null;
                    $flowerDetail['video_upload'] = $flowerDetail['video_upload'] ? Config::get('DocumentConstant.FLOWERS_VIEW') . $flowerDetail['video_upload'] : null;
                }
            }
    
            $flowersData = $data_output_flowers;
    
            // Filter data for Amenities
            $basic_query_object_amenities = Amenities::where('tbl_amenities.is_active', true);
    
            if ($amenities_id) {
                $basic_query_object_amenities->where('tbl_amenities.id', $amenities_id);
            }
            if ($search_name) {
                $basic_query_object_amenities->where('tbl_amenities.' . $language . '_name', 'LIKE', '%' . $search_name . '%');
            }
            $data_output_amenities = $basic_query_object_amenities
                ->leftJoin('icon_master', 'tbl_amenities.icon_id', '=', 'icon_master.id')
                ->select('tbl_amenities.id as id', 'tbl_amenities.icon_id', 'icon_master.name as icon_name',
                    'tbl_amenities.' . $language . '_name as name', $language . '_description as description',
                    'tbl_amenities.' . $language . '_audio_link as audio_link',
                    'tbl_amenities.' . $language . '_video_upload as video_upload',
                    'tbl_amenities.latitude', 'tbl_amenities.longitude', 
                    'tbl_amenities.image', 'icon_master.image as icon_image', 'tbl_amenities.image_two', 
                    'tbl_amenities.image_three', 'tbl_amenities.image_four', 'tbl_amenities.image_five',
                    'tbl_amenities.open_time_first', 'tbl_amenities.close_time_first', 'tbl_amenities.open_time_second', 
                    'tbl_amenities.close_time_second')
                ->when($category_id, function ($query) use ($category_id) {
                    $query->where('icon_master.id', $category_id);
                })
                ->get()
                ->toArray();
    
            foreach ($data_output_amenities as &$amenitiesDetail) {
                $amenitiesDetail['image'] = Config::get('DocumentConstant.AMENITIES_VIEW') . $amenitiesDetail['image'];
                $amenitiesDetail['image_two'] = $amenitiesDetail['image_two'] ? Config::get('DocumentConstant.AMENITIES_VIEW') . $amenitiesDetail['image_two'] : null;
                $amenitiesDetail['image_three'] = $amenitiesDetail['image_three'] ? Config::get('DocumentConstant.AMENITIES_VIEW') . $amenitiesDetail['image_three'] : null;
                $amenitiesDetail['image_four'] = $amenitiesDetail['image_four'] ? Config::get('DocumentConstant.AMENITIES_VIEW') . $amenitiesDetail['image_four'] : null;
                $amenitiesDetail['image_five'] = $amenitiesDetail['image_five'] ? Config::get('DocumentConstant.AMENITIES_VIEW') . $amenitiesDetail['image_five'] : null;
                $amenitiesDetail['icon_image'] = $amenitiesDetail['icon_image'] ? Config::get('DocumentConstant.ICON_MASTER_VIEW') . $amenitiesDetail['icon_image'] : null;
    
                if ($language == 'hindi') {
                    $amenitiesDetail['audio_link'] = $amenitiesDetail['audio_link'] ? Config::get('DocumentConstant.AMENITIES_VIEW') . $amenitiesDetail['audio_link'] : null;
                    $amenitiesDetail['video_upload'] = $amenitiesDetail['video_upload'] ? Config::get('DocumentConstant.AMENITIES_VIEW') . $amenitiesDetail['video_upload'] : null;
                } else {
                    $amenitiesDetail['audio_link'] = $amenitiesDetail['audio_link'] ? Config::get('DocumentConstant.AMENITIES_VIEW') . $amenitiesDetail['audio_link'] : null;
                    $amenitiesDetail['video_upload'] = $amenitiesDetail['video_upload'] ? Config::get('DocumentConstant.AMENITIES_VIEW') . $amenitiesDetail['video_upload'] : null;
                }
            }
    
            $amenitiesData = $data_output_amenities;
    
            if ($tress_id) {
                return response()->json([
                    'status' => 'true',
                    'message' => 'Tree data retrieved successfully',
                    'treesData' => $treesData
                ], 200);
            }
    
            if ($flowers_id) {
                return response()->json([
                    'status' => 'true',
                    'message' => 'Flower data retrieved successfully',
                    'flowersData' => $flowersData
                ], 200);
            }
    
            if ($amenities_id) {
                return response()->json([
                    'status' => 'true',
                    'message' => 'Amenities data retrieved successfully',
                    'amenitiesData' => $amenitiesData
                ], 200);
            }
    
            // If no specific ID parameters are provided, return all data
            return response()->json([
                'status' => 'true',
                'message' => 'All data retrieved successfully',
                'treesData' => $treesData,
                'flowersData' => $flowersData,
                'amenitiesData' => $amenitiesData
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'false',
                'message' => 'Data retrieval failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    
    
    
 }
