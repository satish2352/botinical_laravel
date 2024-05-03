<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use App\Models\ {
    AboutUs,
    Amenities,
    Charges
}
;

class AboutUsListController extends Controller {
    public function getAllAboutUsList( Request $request ) {
        try {
            $user = auth()->user()->id;
            $data_output = AboutUs::all();
            foreach ($data_output as $about) {
                $about->image = Config::get('DocumentConstant.ABOUTUS_VIEW') . $about->image;
            }

            return response()->json( [ 'status' => 'true', 'message' => 'All data retrieved successfully', 'data' => $data_output ], 200 );
        } catch ( \Exception $e ) {
            return response()->json( [ 'status' => 'false', 'message' => 'About Us List Fail', 'error' => $e->getMessage() ], 500 );
        }
    }

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

    public function getAllChargesList( Request $request ) {
        try {
            $user = auth()->user()->id;
            $data_output = Charges::all();
            foreach ($data_output as $about) {
                $about->image = Config::get('DocumentConstant.AMENITIES_VIEW') . $about->image;
            }

            return response()->json( [ 'status' => 'true', 'message' => 'All data retrieved successfully', 'data' => $data_output ], 200 );
        } catch ( \Exception $e ) {
            return response()->json( [ 'status' => 'false', 'message' => 'Charges List Fail', 'error' => $e->getMessage() ], 500 );
        }
    }

}
