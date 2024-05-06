<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use App\Models\ {
    ZonesArea
}
;

class ZoneAreaController extends Controller
 {
    public function getZoneArea(Request $request) {
        try {
            $language = $request->input('language', 'english');
    
            
            $data_output = ZonesArea::where('is_active', true);
    
            if ($language == 'hindi') {
                $data_output = $data_output->select('hindi_name', 'hindi_description', 'hindi_audio_link', 'hindi_video_upload', 'image', 'latitude', 'longitude');
            } else {
                $data_output = $data_output->select('english_name', 'english_description', 'english_audio_link', 'english_video_upload', 'image', 'latitude', 'longitude');
            }
    
            $data_output = $data_output->get();
    
            foreach ($data_output as &$galleryimage) {
                $galleryimage['image'] = Config::get('DocumentConstant.ZONESAREA_VIEW') . $galleryimage['image'];
            }
    
            return response()->json(['status' => true, 'message' => 'All data retrieved successfully', 'data' => $data_output], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Facilities List Fail', 'error' => $e->getMessage()], 500);
        }
    }
}
