<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use App\Models\ {
    Gallery
}
;

class GalleryController extends Controller
 {
    public function getGallery( Request $request ) {
        try {
            $page = isset( $request[ 'start' ] ) ? $request[ 'start' ] : Config::get( 'DocumentConstant.DEFAULT_START' ) ;
            $rowperpage = DEFAULT_LENGTH;
            $start = ( $page - 1 ) * $rowperpage;

            $basic_query_object = Gallery::where( 'is_active', '=', true );

            $totalRecords = $basic_query_object->select( 'tbl_gallery.id' )->get()->count();

            $data_output =   $basic_query_object->select( 'image' );

            $data_output =  $data_output->skip($start)
            ->take( $rowperpage )->get()
            ->toArray();
            foreach ( $data_output as &$galleryimage ) {
                $galleryimage[ 'image' ] = Config::get( 'DocumentConstant.GALLERY_VIEW' ) . $galleryimage[ 'image' ];
            }

            if ( sizeof( $data_output ) > 0 ) {
                $totalPages = ceil( $totalRecords/$rowperpage );
            } else {
                $totalPages = 0;
            }

            return response()->json( [ 'status' => 'true', 'message' => 'All data retrieved successfully', 'totalRecords' => $totalRecords,
            'totalPages'=>$totalPages, 'page_no_to_hilight'=>$page,
            'data' => $data_output ], 200 );
        } catch ( \Exception $e ) {
            return response()->json( [ 'status' => 'false', 'message' => 'Gallery List Fail', 'error' => $e->getMessage() ], 500 );
        }
    }
}
