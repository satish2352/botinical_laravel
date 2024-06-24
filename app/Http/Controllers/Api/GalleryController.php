<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use App\Models\ {
    Gallery,
    GalleryCategory
}
;

class GalleryController extends Controller
 {
    public function getGallery(Request $request)
{
    try {
        $language = $request->input('language', 'english');
        $category_id = $request->input('gallery_category_id');
        $page = isset($request['start']) ? $request['start'] : Config::get('DocumentConstant.DEFAULT_START');
        $rowperpage = DEFAULT_LENGTH;
        $start = ($page - 1) * $rowperpage;

        $basic_query_object = Gallery::where('tbl_gallery.is_active', '=', true);

        $totalRecords = $basic_query_object->select('tbl_gallery.id')->get()->count();

        if ($language == 'hindi') {
            $data_output = $basic_query_object->leftJoin('tbl_gallery_category', 'tbl_gallery.gallery_category_id', '=', 'tbl_gallery_category.id')
                ->select('tbl_gallery.id as id', 'tbl_gallery_category.hindi_name as category_name', 'tbl_gallery.image')
                ->when($category_id, function ($query) use ($category_id) {
                    $query->where('tbl_gallery_category.id', $category_id);
                });
        } else {
            $data_output = $basic_query_object->leftJoin('tbl_gallery_category', 'tbl_gallery.gallery_category_id', '=', 'tbl_gallery_category.id')
                ->select('tbl_gallery.id as id', 'tbl_gallery_category.english_name as category_name', 'tbl_gallery.image')
                ->when($category_id, function ($query) use ($category_id) {
                    $query->where('tbl_gallery_category.id', $category_id);
                });
        }

        $data_output = $data_output->skip($start)
            ->take($rowperpage)->get()
            ->toArray();

        foreach ($data_output as &$galleryimage) {
            $galleryimage['image'] = Config::get('DocumentConstant.GALLERY_VIEW') . $galleryimage['image'];
        }

        if (sizeof($data_output) > 0) {
            $totalPages = ceil($totalRecords / $rowperpage);
        } else {
            $totalPages = 0;
        }

        return response()->json([
            'status' => 'true',
            'message' => 'All data retrieved successfully',
            'totalRecords' => $totalRecords,
            'totalPages' => $totalPages,
            'page_no_to_hilight' => $page,
            'data' => $data_output
        ], 200);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'false',
            'message' => 'Gallery List Fail',
            'error' => $e->getMessage()
        ], 500);
    }
}

}
