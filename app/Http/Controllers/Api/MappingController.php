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
    public function filterMapData(Request $request) {
        try {
            $language = $request->input('language', 'english');
            $category_id = $request->input('icon_id');
            $tress_id = $request->input( 'tress_id' );
            $amenities_id = $request->input('amenities_id');
            $flowers_id = $request->input('flowers_id');
    
            // Initialize response variables
            $totalRecords = 0;
            $data_output = [];
    
            // Filter data for Tress
            $basic_query_object_trees = Tress::where('tbl_trees.is_active', true);
            
            if ($tress_id) {
                $basic_query_object_trees->where('tbl_trees.id', $tress_id);
            }
    
            $totalRecords = $basic_query_object_trees->count();
    
            if ($language == 'hindi') {
                $data_output_trees = $basic_query_object_trees
                    ->leftJoin('icon_master', 'tbl_trees.icon_id', '=', 'icon_master.id')
                    ->select('tbl_trees.id as id', 'tbl_trees.icon_id', 'icon_master.name as icon_name', 'tbl_trees.hindi_name as name','icon_master.image as icon_image','hindi_description as description',
                'tbl_trees.hindi_audio_link as audio_link',
                'tbl_trees.hindi_video_upload as video_upload',
                'tbl_trees.latitude',
                'tbl_trees.height','tbl_trees.height_type', 'tbl_trees.canopy', 'tbl_trees.canopy_type','tbl_trees.girth','tbl_trees.girth_type',
                'tbl_trees.longitude', 'tbl_trees.image')
                    ->when($category_id, function ($query) use ($category_id) {
                        $query->where('icon_master.id', $category_id);
                    })
                    ->get()
                    ->toArray();
            } else {
                $data_output_trees = $basic_query_object_trees
                    ->leftJoin('icon_master', 'tbl_trees.icon_id', '=', 'icon_master.id')
                    ->select('tbl_trees.id as id', 'tbl_trees.icon_id', 'icon_master.name as icon_name', 'icon_master.image as icon_image', 'tbl_trees.english_name as name', 'english_description as description',
                    'tbl_trees.english_audio_link as audio_link',
                    'tbl_trees.english_video_upload as video_upload',
                    'tbl_trees.latitude',
                    'tbl_trees.longitude', 'tbl_trees.height','tbl_trees.height_type', 'tbl_trees.canopy', 'tbl_trees.canopy_type','tbl_trees.girth','tbl_trees.girth_type', 'tbl_trees.image')
                    ->when($category_id, function ($query) use ($category_id) {
                        $query->where('icon_master.id', $category_id);
                    })
                    ->get()
                    ->toArray();
            }
    
            foreach ($data_output_trees as &$treeDetail) {
                $treeDetail['image'] = Config::get('DocumentConstant.TRESS_VIEW') . $treeDetail['image'];
                $treeDetail['icon_image'] = Config::get('DocumentConstant.ICON_MASTER_VIEW') . $treeDetail['icon_image'];

                if ($language == 'hindi') {
                    $treeDetail['audio_link'] = Config::get('DocumentConstant.TRESS_VIEW') . $treeDetail['audio_link'];
                } else {
                    $treeDetail['audio_link'] = Config::get('DocumentConstant.TRESS_VIEW') . $treeDetail['audio_link'];
                }
                if ($language == 'hindi') {
                    $treeDetail['video_upload'] = Config::get('DocumentConstant.TRESS_VIEW') . $treeDetail['video_upload'];
                } else {
                    $treeDetail['video_upload'] = Config::get('DocumentConstant.TRESS_VIEW') . $treeDetail['video_upload'];
                }
            }
    
            // Filter data for Flowers
            $basic_query_object_flowers = Flowers::where('tbl_flowers.is_active', true);
            
            if ($flowers_id) {
                $basic_query_object_flowers->where('tbl_flowers.id', $flowers_id);
            }
    
            $totalRecords = $basic_query_object_flowers->count();
    
            if ($language == 'hindi') {
                $data_output_flowers = $basic_query_object_flowers
                    ->leftJoin('icon_master', 'tbl_flowers.icon_id', '=', 'icon_master.id')
                    ->select('tbl_flowers.id as id', 'tbl_flowers.icon_id', 'icon_master.name as icon_name', 'tbl_flowers.hindi_name as name', 'icon_master.image as icon_image', 'hindi_description as description',
                    'tbl_flowers.hindi_audio_link as audio_link',
                    'tbl_flowers.hindi_video_upload as video_upload',
                    'tbl_flowers.latitude',
                    'tbl_flowers.longitude', 
                    'tbl_flowers.height','tbl_flowers.height_type', 'tbl_flowers.canopy', 'tbl_flowers.canopy_type','tbl_flowers.girth','tbl_flowers.girth_type',
                    'tbl_flowers.image')
                    ->when($category_id, function ($query) use ($category_id) {
                        $query->where('icon_master.id', $category_id);
                    })
                    ->get()
                    ->toArray();
            } else {
                $data_output_flowers = $basic_query_object_flowers
                    ->leftJoin('icon_master', 'tbl_flowers.icon_id', '=', 'icon_master.id')
                    ->select('tbl_flowers.id as id', 'tbl_flowers.icon_id', 'icon_master.name as icon_name', 'icon_master.image as icon_image', 'tbl_flowers.english_name as name', 'english_description as description',
                    'tbl_flowers.english_audio_link as audio_link',
                    'tbl_flowers.english_video_upload as video_upload',
                    'tbl_flowers.latitude',
                    'tbl_flowers.longitude', 'tbl_flowers.height','tbl_flowers.height_type', 'tbl_flowers.canopy', 'tbl_flowers.canopy_type','tbl_flowers.girth','tbl_flowers.girth_type', 'tbl_flowers.image')
                    ->when($category_id, function ($query) use ($category_id) {
                        $query->where('icon_master.id', $category_id);
                    })
                    ->get()
                    ->toArray();
            }
    
            foreach ($data_output_flowers as &$flowerDetail) {
                $flowerDetail['image'] = Config::get('DocumentConstant.FLOWERS_VIEW') . $flowerDetail['image'];
                $flowerDetail['icon_image'] = Config::get('DocumentConstant.ICON_MASTER_VIEW') . $flowerDetail['icon_image'];
            
                if ($language == 'hindi') {
                    $flowerDetail['audio_link'] = Config::get('DocumentConstant.FLOWERS_VIEW') . $flowerDetail['audio_link'];
                } else {
                    $flowerDetail['audio_link'] = Config::get('DocumentConstant.FLOWERS_VIEW') . $flowerDetail['audio_link'];
                }
                if ($language == 'hindi') {
                    $flowerDetail['video_upload'] = Config::get('DocumentConstant.FLOWERS_VIEW') . $flowerDetail['video_upload'];
                } else {
                    $flowerDetail['video_upload'] = Config::get('DocumentConstant.FLOWERS_VIEW') . $flowerDetail['video_upload'];
                }
            }
              // Filter data for Aminities
              $basic_query_object_aminities = Amenities::where('tbl_amenities.is_active', true);
            
              if ($flowers_id) {
                  $basic_query_object_aminities->where('tbl_amenities.id', $flowers_id);
              }
      
              $totalRecords = $basic_query_object_aminities->count();
      
              if ($language == 'hindi') {
                  $data_output_aminities = $basic_query_object_aminities
                      ->leftJoin('icon_master', 'tbl_amenities.icon_id', '=', 'icon_master.id')
                      ->select('tbl_amenities.id as id', 'tbl_amenities.icon_id', 'icon_master.name as icon_name', 'tbl_amenities.hindi_name as name', 'icon_master.image as icon_image', 'hindi_description as description',
                      'tbl_amenities.hindi_audio_link as audio_link',
                      'tbl_amenities.hindi_video_upload as video_upload',
                      'tbl_amenities.latitude',
                      'tbl_amenities.longitude', 
                      'tbl_amenities.image')
                      ->when($category_id, function ($query) use ($category_id) {
                          $query->where('icon_master.id', $category_id);
                      })
                      ->get()
                      ->toArray();
              } else {
                  $data_output_aminities = $basic_query_object_aminities
                      ->leftJoin('icon_master', 'tbl_amenities.icon_id', '=', 'icon_master.id')
                      ->select('tbl_amenities.id as id', 'tbl_amenities.icon_id', 'icon_master.name as icon_name', 'icon_master.image as icon_image', 'tbl_amenities.english_name as name', 'english_description as description',
                      'tbl_amenities.english_audio_link as audio_link',
                      'tbl_amenities.english_video_upload as video_upload',
                      'tbl_amenities.latitude',
                      'tbl_amenities.longitude', 'tbl_amenities.image')
                      ->when($category_id, function ($query) use ($category_id) {
                          $query->where('icon_master.id', $category_id);
                      })
                      ->get()
                      ->toArray();
              }
      
              foreach ($data_output_aminities as &$aminitiesDetail) {
                  $aminitiesDetail['image'] = Config::get('DocumentConstant.AMENITIES_VIEW') . $aminitiesDetail['image'];
                  $aminitiesDetail['icon_image'] = Config::get('DocumentConstant.ICON_MASTER_VIEW') . $aminitiesDetail['icon_image'];
              
                  if ($language == 'hindi') {
                    $aminitiesDetail['audio_link'] = Config::get('DocumentConstant.AMENITIES_VIEW') . $aminitiesDetail['audio_link'];
                } else {
                    $aminitiesDetail['audio_link'] = Config::get('DocumentConstant.AMENITIES_VIEW') . $aminitiesDetail['audio_link'];
                }
                if ($language == 'hindi') {
                    $aminitiesDetail['video_upload'] = Config::get('DocumentConstant.AMENITIES_VIEW') . $aminitiesDetail['video_upload'];
                } else {
                    $aminitiesDetail['video_upload'] = Config::get('DocumentConstant.AMENITIES_VIEW') . $aminitiesDetail['video_upload'];
                }
                }
    
            // Combine both data sets into a single response
            $combined_data_output = array_merge($data_output_trees, $data_output_flowers,$data_output_aminities);
    
            return response()->json([
                'status' => 'true',
                'message' => 'All data retrieved successfully',
                'totalRecords' => $totalRecords,
                'data' => $combined_data_output
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'false',
                'message' => 'Amenities Us List Fail',
                'error' => $e->getMessage()
            ], 500);
        }
    }
   
    
    // public function filterMapData(Request $request) {
    //     try {
    //         $language = $request->input('language', 'english');
    //         $category_id = $request->input('icon_id');
    //         $tress_id = $request->input('tress_id');
    //         $flowers_id = $request->input('flowers_id');
    
    //         // Initialize response variables
    //         $treesData = [];
    //         $flowersData = [];
    
    //         // Filter data for Trees
    //         $basic_query_object_trees = Tress::where('tbl_trees.is_active', true);
    
    //         if ($tress_id) {
    //             $basic_query_object_trees->where('tbl_trees.id', $tress_id);
    //         }
    
    //         $data_output_trees = $basic_query_object_trees
    //             ->leftJoin('icon_master', 'tbl_trees.icon_id', '=', 'icon_master.id')
    //             ->select('tbl_trees.id as id', 'tbl_trees.icon_id', 'icon_master.name as icon_name',
    //                 'tbl_trees.' . $language . '_name as name', $language . '_description as description',
    //                 'tbl_trees.' . $language . '_audio_link as audio_link',
    //                 'tbl_trees.' . $language . '_video_upload as video_upload',
    //                 'tbl_trees.latitude', 'tbl_trees.longitude', 'tbl_trees.height', 'tbl_trees.height_type',
    //                 'tbl_trees.canopy', 'tbl_trees.canopy_type', 'tbl_trees.girth', 'tbl_trees.girth_type',
    //                 'tbl_trees.image', 'icon_master.image as icon_image')
    //             ->when($category_id, function ($query) use ($category_id) {
    //                 $query->where('icon_master.id', $category_id);
    //             })
    //             ->get()
    //             ->toArray();
    
    //         foreach ($data_output_trees as &$treeDetail) {
    //             $treeDetail['image'] = Config::get('DocumentConstant.TREES_VIEW') . $treeDetail['image'];
    //             $treeDetail['icon_image'] = Config::get('DocumentConstant.ICON_MASTER_VIEW') . $treeDetail['icon_image'];
    //         }
    
    //         $treesData = $data_output_trees;
    
    //         // Filter data for Flowers
    //         $basic_query_object_flowers = Flowers::where('tbl_flowers.is_active', true);
    
    //         if ($flowers_id) {
    //             $basic_query_object_flowers->where('tbl_flowers.id', $flowers_id);
    //         }
    
    //         $data_output_flowers = $basic_query_object_flowers
    //             ->leftJoin('icon_master', 'tbl_flowers.icon_id', '=', 'icon_master.id')
    //             ->select('tbl_flowers.id as id', 'tbl_flowers.icon_id', 'icon_master.name as icon_name',
    //                 'tbl_flowers.' . $language . '_name as name', $language . '_description as description',
    //                 'tbl_flowers.' . $language . '_audio_link as audio_link',
    //                 'tbl_flowers.' . $language . '_video_upload as video_upload',
    //                 'tbl_flowers.latitude', 'tbl_flowers.longitude', 'tbl_flowers.height', 'tbl_flowers.height_type',
    //                 'tbl_flowers.canopy', 'tbl_flowers.canopy_type', 'tbl_flowers.girth', 'tbl_flowers.girth_type',
    //                 'tbl_flowers.image', 'icon_master.image as icon_image')
    //             ->when($category_id, function ($query) use ($category_id) {
    //                 $query->where('icon_master.id', $category_id);
    //             })
    //             ->get()
    //             ->toArray();
    
    //         foreach ($data_output_flowers as &$flowerDetail) {
    //             $flowerDetail['image'] = Config::get('DocumentConstant.FLOWERS_VIEW') . $flowerDetail['image'];
    //             $flowerDetail['icon_image'] = Config::get('DocumentConstant.ICON_MASTER_VIEW') . $flowerDetail['icon_image'];
    //         }
    
    //         $flowersData = $data_output_flowers;
    
    //         return response()->json([
    //             'status' => 'true',
    //             'message' => 'All data retrieved successfully',
    //             'treesData' => $treesData,
    //             'flowersData' => $flowersData
    //         ], 200);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'status' => 'false',
    //             'message' => 'Data retrieval failed',
    //             'error' => $e->getMessage()
    //         ], 500);
    //     }
    // }
    
    
 }
