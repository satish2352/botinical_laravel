<?php
namespace App\Http\Repository\Admin\Gallery;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\QueryException;
use App\Models\ {
	Gallery,
    GalleryCategory
};
use Config;

class GalleryRepository  {
    public function getAll() {
        try {
            return Gallery::leftJoin('tbl_gallery_category', 'tbl_gallery.gallery_category_id', '=', 'tbl_gallery_category.id')
                ->select('tbl_gallery.id as id', 'tbl_gallery_category.english_name', 'tbl_gallery_category.hindi_name', 'tbl_gallery.image')
                ->orderBy('tbl_gallery.updated_at', 'desc')
                ->get();
        } catch (\Exception $e) {
            \Log::error('Error fetching galleries: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to fetch galleries'], 500);
        }
    }
    
    public function addAll($request){
        try {
        
            $data =array();
            $add_data = new Gallery();
            $add_data->gallery_category_id = $request['gallery_category_id'];
            $add_data->save();              
            $last_insert_id = $add_data->id;
            $ImageName = $last_insert_id .'_' . rand(100000, 999999) . '_image.' . $request->image->extension();

            $add_data = Gallery::find($last_insert_id); 
            $add_data->image = $ImageName; 
                    
            $add_data->save();
            
            $data['ImageName'] =$ImageName;
            return $data;
    
        } catch (\Exception $e) {
            return [
                'msg' => $e,
                'status' => 'error'
            ];
        }
    }
    

    public function getById($id){
        try {
            $data_output = Gallery::find($id);
          
            if ($data_output) {
                return $data_output;
            } else {
                return null;
            }
        } catch (\Exception $e) {
            return $e;
            return [
                'msg' => 'Failed to get by id data.',
                'status' => 'error'
            ];
        }
    }
    
    public function updateAll($request){
        try {
            $return_data = array();
            $data_output = Gallery::find($request->id);
            if (!$data_output) {
                return [
                    'msg' => 'Data not found.',
                    'status' => 'error'
                ];
            }

            // Store the previous image names
            $previousImage = $data_output->image;
         
            $data_output->gallery_category_id = $request['gallery_category_id'];
            $data_output->save();
            $last_insert_id = $data_output->id;
            $return_data['last_insert_id'] = $last_insert_id;
            $return_data['image'] = $previousImage;
          
            return  $return_data;
        
        } catch (\Exception $e) {
            return [
                'msg' => 'Failed to update Data.',
                'status' => 'error',
                'error' => $e->getMessage() // Return the error message for debugging purposes
            ];
        }
    }

    public function updateOne($request){
        try {
            $data = Gallery::find($request); 

            if ($data) {
                $is_active = $data->is_active === '1' ? '0' : '1';
                $data->is_active = $is_active;
                $data->save();
                return [
                    'msg' => 'Data updated successfully.',
                    'status' => 'success'
                ];
            }

            return [
                'msg' => 'Data not found.',
                'status' => 'error'
            ];
        } catch (\Exception $e) {
            return [
                'msg' => 'Failed to update Data.',
                'status' => 'error'
            ];
        }
    }

   

    public function deleteById($id){
            try {
                $data_output = Gallery::find($id);
                if ($data_output) {
                    if (file_exists_view(Config::get('DocumentConstant.GALLERY_VIEW') . $data_output->image)){
                        removeImage(Config::get('DocumentConstant.GALLERY_VIEW') . $data_output->image);
                    }
                    
                    $data_output->delete();
                    
                    return $data_output;
                } else {
                    return null;
                }
            } catch (\Exception $e) {
                return $e;
            }
    }


}