<?php
namespace App\Http\Repository\Admin\Master;
use Illuminate\Database\QueryException;
use DB;
use Illuminate\Support\Carbon;
// use Session;
use App\Models\ {
GalleryCategory
};
use Config;

class GalleryCategoryRepository  {


    public function getAll(){
        try {
          $data_output = GalleryCategory::orderBy('updated_at', 'desc')->get();
            return $data_output;
        } catch (\Exception $e) {
            return $e;
        }
    }


    public function addAll($request)
    {   
        try {

            $dataOutput = new GalleryCategory();
            $dataOutput->english_name = $request->english_name;
            $dataOutput->hindi_name = $request->hindi_name;
            $dataOutput->save();

            return [
                'status' => 'success'
            ];

        } catch (\Exception $e) {
            return [
                'msg' => $e->getMessage(),
                'status' => 'error'
            ];
        }
    }
        public function updateAll($request){
        try { 
            $return_data = array();
          

            $dataOutput = GalleryCategory::find($request->id);

            if (!$dataOutput) {
                return [
                    'msg' => 'Update Data not found.',
                    'status' => 'error'
                ];
            }

           
            $dataOutput->english_name = $request->english_name;
            $dataOutput->hindi_name = $request->hindi_name;

            $dataOutput->save();
            $return_data['image'] = $previousEnglishImage;
            return  $return_data;
        
        } catch (\Exception $e) {
            return [
                'msg' => 'Failed to Update Data.',
                'status' => 'error',
                'error' => $e->getMessage()
            ];
        }
    }

    public function getById($id)
{
    try {
        $data_output = GalleryCategory::find($id);
        if ($data_output) {
            return $data_output;
        } else {
            return null;
        }
    } catch (\Exception $e) {
		return [
            'msg' => $e,
            'status' => 'error'
        ];
    }
}

public function updateOneCategory($request) {
    try {
        $data_output = GalleryCategory::find($request); // Assuming $request directly contains the ID        
        if ($data_output) {
            $is_active = $data_output->is_active === 1 ? 0 : 1;
            $data_output->is_active = $is_active;
            // dd($marquee);
            $data_output->save();

            return [
                'msg' => 'updated successfully.',
                'status' => 'success'
            ];
        }

        return [
            'msg' => 'data not found.',
            'status' => 'error'
        ];
    } catch (\Exception $e) {
        return [
            'msg' => 'Failed to update data.',
            'status' => 'error'
        ];
    }
}

public function deleteById($id){
    try {
        $data_output = GalleryCategory::find($id);
        $data_output->delete();
            
        return $data_output;
    } catch (\Exception $e) {
        return $e;
    }
}
   
}