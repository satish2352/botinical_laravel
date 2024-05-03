<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use App\Models\ {
    Tress
};

class TressController extends Controller
{
    public function getTressList(Request $request) {
        try {
            $language = $request->input('language', 'english'); 
            $data_output = Tress::where('is_active','=',true);
            if ($language == 'hindi') {
                $data_output =  $data_output->select('hindi_name', 'hindi_description', 'hindi_audio_link', 'hindi_video_upload', 'image', 'latitude', 'longitude');
            } else {
                $data_output = $data_output->select('english_name', 'english_description', 'english_audio_link', 'english_video_upload', 'image', 'latitude', 'longitude');
            }
            $data_output =  $data_output->get()
                            ->toArray();
                            
            return response()->json([
                'status' => 'true',
                'message' => 'All data retrieved successfully',
                'data' => $data_output
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'false',
                'message' => 'Tress List Fail',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
