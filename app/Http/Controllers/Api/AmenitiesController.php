<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AmenitiesController extends Controller
{
    public function getAllAmenitiesList( Request $request ) {
        try {
            $user = auth()->user()->id;
            $data_output = Amenities::all();
            foreach ($data_output as $about) {
                $about->image = Config::get('DocumentConstant.AMENITIES_VIEW') . $about->image;
            }

            return response()->json( [ 'status' => 'true', 'message' => 'All data retrieved successfully', 'data' => $data_output ], 200 );
        } catch ( \Exception $e ) {
            return response()->json( [ 'status' => 'false', 'message' => 'Amenities Us List Fail', 'error' => $e->getMessage() ], 500 );
        }
    }
}
