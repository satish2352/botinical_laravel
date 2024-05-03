<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use App\Models\ {
    Amenities,
    CategoryAmenities
};


class AmenitiesController extends Controller
{
      public function getAmenitiesCategory(Request $request) {
        try {
            $language = $request->input('language', 'english'); 
            $data_output = CategoryAmenities::where('is_active','=',true);
            if ($language == 'hindi') {
                $data_output =  $data_output->select('hindi_name');
            } else {
                $data_output = $data_output->select('english_name');
            }
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
                'message' => 'Amenities Category List Fail',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
public function getAllAmenitiesList(Request $request){
    try {
        // $user = auth()->user()->id;
        $language = $request->input('language', 'english');
        $category_id = $request->input('amenities_category_id');
        $data_output = Amenities::where('is_active', true);
        if ($language == 'hindi') {
            $data_output = $data_output->leftJoin('tbl_amenities_category', 'tbl_amenities.amenities_category_id', '=', 'tbl_amenities_category.id')
            ->select('tbl_amenities.hindi_name as name', 'tbl_amenities.amenities_category_id', 'tbl_amenities.hindi_description as description', 'tbl_amenities.hindi_audio_link as audio_link', 'tbl_amenities.hindi_video_upload as video_upload', 'tbl_amenities.image');
        } else {
            $data_output = $data_output->leftJoin('tbl_amenities_category', 'tbl_amenities.amenities_category_id', '=', 'tbl_amenities_category.id')
            ->select('tbl_amenities.english_name as name', 'tbl_amenities.amenities_category_id', 'tbl_amenities.english_description as description', 'tbl_amenities.english_audio_link as audio_link', 'tbl_amenities.english_video_upload as video_upload', 'tbl_amenities.image');
        }
        $data_output = $data_output->get()->toArray();

        foreach ($data_output as &$amenity) {
            $amenity['image'] = Config::get('DocumentConstant.AMENITIES_VIEW') . $amenity['image'];
        }

        return response()->json(['status' => 'true', 'message' => 'All data retrieved successfully', 'data' => $data_output], 200);
    } catch (\Exception $e) {
        return response()->json(['status' => 'false', 'message' => 'Amenities Us List Fail', 'error' => $e->getMessage()], 500);
    }
}
}
