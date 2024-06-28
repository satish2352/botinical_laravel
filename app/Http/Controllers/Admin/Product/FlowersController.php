<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Admin\Product\FlowersServices;
use Validator;
use Illuminate\Validation\Rule;
use Config;
use App\Models\ {
    FLOWERS,
    IconMaster
}
;

class FlowersController extends Controller {

    public function __construct() {
        $this->service = new FlowersServices();
    }

    public function index() {
        try {
            $flowers = $this->service->getAll();
            return view( 'admin.pages.product.flowers.list-flowers', compact( 'flowers' ) );
        } catch ( \Exception $e ) {
            return $e;
        }
    }

    public function add() {
        $dataOutputIcon = IconMaster::get();
        return view( 'admin.pages.product.flowers.add-flowers', compact( 'dataOutputIcon' ) );
    }

    public function store( Request $request ) {

        $rules = [
            'english_name' => 'required|max:255',
            'hindi_name' => 'required|max:255',
            'english_description' => 'required',
            'hindi_description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:' . Config::get( 'AllFileValidation.FLOWERS_IMAGE_MAX_SIZE' ) . '|min:' . Config::get( 'AllFileValidation.FLOWERS_IMAGE_MIN_SIZE' ),
            'english_audio_link' => 'required|mimes:mp3|max:' . Config::get( 'AllFileValidation.AUDIO_MAX_SIZE' ) . '|min:' . Config::get( 'AllFileValidation.AUDIO_MIN_SIZE' ),
            'hindi_audio_link' => 'required|mimes:mp3|max:' . Config::get( 'AllFileValidation.AUDIO_MAX_SIZE' ) . '|min:' . Config::get( 'AllFileValidation.AUDIO_MIN_SIZE' ),
            'english_video_upload' => 'required|mimetypes:video/mp4|max:' . Config::get( 'AllFileValidation.VIDEO_MAX_SIZE' ) . '|min:' . Config::get( 'AllFileValidation.VIDEO_MIN_SIZE' ),
            'hindi_video_upload' => 'required|mimetypes:video/mp4|max:' . Config::get( 'AllFileValidation.VIDEO_MAX_SIZE' ) . '|min:' . Config::get( 'AllFileValidation.VIDEO_MIN_SIZE' ),
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
        ];
        if ( $request->has( 'image_two' ) ) {
            $rules[ 'image_two' ] = 'required|image|mimes:jpeg,png,jpg|max:'.Config::get( 'AllFileValidation.FLOWERS_IMAGE_MAX_SIZE' ).'|min:'.Config::get( 'AllFileValidation.FLOWERS_IMAGE_MIN_SIZE' );
        }
        if ( $request->has( 'image_three' ) ) {
            $rules[ 'image_three' ] = 'required|image|mimes:jpeg,png,jpg|max:'.Config::get( 'AllFileValidation.FLOWERS_IMAGE_MAX_SIZE' ).'|min:'.Config::get( 'AllFileValidation.FLOWERS_IMAGE_MIN_SIZE' );
        }
        if ( $request->has( 'image_four' ) ) {
            $rules[ 'image_four' ] = 'required|image|mimes:jpeg,png,jpg|max:'.Config::get( 'AllFileValidation.FLOWERS_IMAGE_MAX_SIZE' ).'|min:'.Config::get( 'AllFileValidation.FLOWERS_IMAGE_MIN_SIZE' );
        }
        if ( $request->has( 'image_five' ) ) {
            $rules[ 'image_five' ] = 'required|image|mimes:jpeg,png,jpg|max:'.Config::get( 'AllFileValidation.FLOWERS_IMAGE_MAX_SIZE' ).'|min:'.Config::get( 'AllFileValidation.FLOWERS_IMAGE_MIN_SIZE' );
        }

        $messages = [
            'english_name.required' => 'Please enter the name.',
            'english_name.max' => 'Please enter an name with a maximum length of 255 characters.',
            'hindi_name.required' => 'कृपया नाम दर्ज करें |',
            'hindi_name.max' => 'कृपया अधिकतम 255 अक्षरों वाला नाम दर्ज करें |',
            'english_description.required' => 'Please enter the description.',
            'hindi_description.required' => 'कृपया विवरण दर्ज करें |',
            'image.required' => 'The image is required.',
            'image.image' => 'The file must be an image.',
            'image.mimes' => 'The image must be in JPEG, PNG, or JPG format.',
            'image.max' => 'The image size must not exceed ' . Config::get( 'AllFileValidation.FLOWERS_IMAGE_MAX_SIZE' ) . ' KB.',
            'image.min' => 'The image size must be at least ' . Config::get( 'AllFileValidation.FLOWERS_IMAGE_MIN_SIZE' ) . ' KB.',

            'image_two.required' => 'The image is required.',
            'image_two.image' => 'The file must be an image.',
            'image_two.mimes' => 'The image must be in JPEG, PNG, or JPG format.',
            'image_two.max' => 'The image size must not exceed ' . Config::get( 'AllFileValidation.FLOWERS_IMAGE_MAX_SIZE' ) . ' KB.',
            'image_two.min' => 'The image size must be at least ' . Config::get( 'AllFileValidation.FLOWERS_IMAGE_MIN_SIZE' ) . ' KB.',

            'image_three.required' => 'The image is required.',
            'image_three.image' => 'The file must be an image.',
            'image_three.mimes' => 'The image must be in JPEG, PNG, or JPG format.',
            'image_three.max' => 'The image size must not exceed ' . Config::get( 'AllFileValidation.FLOWERS_IMAGE_MAX_SIZE' ) . ' KB.',
            'image_three.min' => 'The image size must be at least ' . Config::get( 'AllFileValidation.FLOWERS_IMAGE_MIN_SIZE' ) . ' KB.',

            'image_four.required' => 'The image is required.',
            'image_four.image' => 'The file must be an image.',
            'image_four.mimes' => 'The image must be in JPEG, PNG, or JPG format.',
            'image_four.max' => 'The image size must not exceed ' . Config::get( 'AllFileValidation.FLOWERS_IMAGE_MAX_SIZE' ) . ' KB.',
            'image_four.min' => 'The image size must be at least ' . Config::get( 'AllFileValidation.FLOWERS_IMAGE_MIN_SIZE' ) . ' KB.',

            'image_five.required' => 'The image is required.',
            'image_five.image' => 'The file must be an image.',
            'image_five.mimes' => 'The image must be in JPEG, PNG, or JPG format.',
            'image_five.max' => 'The image size must not exceed ' . Config::get( 'AllFileValidation.FLOWERS_IMAGE_MAX_SIZE' ) . ' KB.',
            'image_five.min' => 'The image size must be at least ' . Config::get( 'AllFileValidation.FLOWERS_IMAGE_MIN_SIZE' ) . ' KB.',

            'english_audio_link.required' => 'Please upload the English audio file.',
            'hindi_audio_link.required' => 'हिंदी ऑडियो फ़ाइल अपलोड करें।',
            'english_audio_link.mimes' => 'The English audio must be in MP3 format.',
            'hindi_audio_link.mimes' => 'हिंदी ऑडियो MP3 प्रारूप में होना चाहिए।',
            'english_audio_link.max' => 'The English audio size must not exceed ' . Config::get( 'AllFileValidation.AUDIO_MAX_SIZE' ) . ' KB.',
            'english_audio_link.min' => 'The English audio size must be at least ' . Config::get( 'AllFileValidation.AUDIO_MIN_SIZE' ) . ' KB.',
            'hindi_audio_link.max' => 'हिंदी ऑडियो आकार ' . Config::get( 'AllFileValidation.AUDIO_MAX_SIZE' ) . ' KB से अधिक नहीं होना चाहिए।',
            'hindi_audio_link.min' => 'हिंदी ऑडियो आकार कम से कम ' . Config::get( 'AllFileValidation.AUDIO_MIN_SIZE' ) . ' KB होना चाहिए।',
            'english_video_upload.required' => 'Please upload the English video file.',
            'hindi_video_upload.required' => 'हिंदी वीडियो फ़ाइल अपलोड करें।',
            'english_video_upload.mimetypes' => 'The English video must be in MP4 format.',
            'hindi_video_upload.mimetypes' => 'हिंदी वीडियो MP4 प्रारूप में होना चाहिए।',
            'english_video_upload.max' => 'The English video size must not exceed ' . Config::get( 'AllFileValidation.VIDEO_MAX_SIZE' ) . ' KB.',
            'english_video_upload.min' => 'The English video size must be at least ' . Config::get( 'AllFileValidation.VIDEO_MIN_SIZE' ) . ' KB.',
            'hindi_video_upload.max' => 'हिंदी वीडियो आकार ' . Config::get( 'AllFileValidation.VIDEO_MAX_SIZE' ) . ' KB से अधिक नहीं होना चाहिए।',
            'hindi_video_upload.min' => 'हिंदी वीडियो आकार कम से कम ' . Config::get( 'AllFileValidation.VIDEO_MIN_SIZE' ) . ' KB होना चाहिए।',
            'latitude.required' => 'Please enter the latitude.',
            'latitude.numeric' => 'Latitude must be a number.',
            'latitude.between' => 'Latitude must be between -90 and 90.',
            'longitude.required' => 'Please enter the longitude.',
            'longitude.numeric' => 'Longitude must be a number.',
            'longitude.between' => 'Longitude must be between -180 and 180.',
        ];
        try {
            $validation = Validator::make( $request->all(), $rules, $messages );

            if ( $validation->fails() ) {
                return redirect( 'add-flowers' )
                ->withInput()
                ->withErrors( $validation );
            } else {
                $add_data = $this->service->addAll( $request );

                if ( $add_data ) {
                    $msg = $add_data[ 'msg' ];
                    $status = $add_data[ 'status' ];

                    if ( $status == 'success' ) {
                        return redirect( 'list-flowers' )->with( compact( 'msg', 'status' ) );
                    } else {
                        return redirect( 'add-flowers' )->withInput()->with( compact( 'msg', 'status' ) );
                    }
                }
            }
        } catch ( Exception $e ) {
            return redirect( 'add-flowers' )->withInput()->with( [ 'msg' => $e->getMessage(), 'status' => 'error' ] );
        }
    }

    public function show( Request $request ) {
        try {
            $flowers = $this->service->getById( $request->show_id );

            return view( 'admin.pages.product.flowers.show-flowers', compact( 'flowers' ) );
        } catch ( \Exception $e ) {
            return $e;
        }
    }

    public function edit( Request $request ) {
        $dataOutputIcon = IconMaster::get();
        $edit_data_id = base64_decode( $request->edit_id );

        $flowers = $this->service->getById( $edit_data_id );
        return view( 'admin.pages.product.flowers.edit-flowers', compact( 'flowers', 'dataOutputIcon' ) );
    }

    public function update( Request $request ) {
        $rules = [
            'english_name' => 'required|max:255',
            'hindi_name' => 'required|max:255',
            'english_description' => 'required',
            'hindi_description' => 'required',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
        ];

        if ( $request->has( 'image' ) ) {
            $rules[ 'image' ] = 'required|image|mimes:jpeg,png,jpg|max:'.Config::get( 'AllFileValidation.FLOWERS_IMAGE_MAX_SIZE' ).'|min:'.Config::get( 'AllFileValidation.FLOWERS_IMAGE_MIN_SIZE' );
        }
        if ( $request->has( 'image_two' ) ) {
            $rules[ 'image_two' ] = 'required|image|mimes:jpeg,png,jpg|max:'.Config::get( 'AllFileValidation.FLOWERS_IMAGE_MAX_SIZE' ).'|min:'.Config::get( 'AllFileValidation.FLOWERS_IMAGE_MIN_SIZE' );
        }
        if ( $request->has( 'image_three' ) ) {
            $rules[ 'image_three' ] = 'required|image|mimes:jpeg,png,jpg|max:'.Config::get( 'AllFileValidation.FLOWERS_IMAGE_MAX_SIZE' ).'|min:'.Config::get( 'AllFileValidation.FLOWERS_IMAGE_MIN_SIZE' );
        }
        if ( $request->has( 'image_four' ) ) {
            $rules[ 'image_four' ] = 'required|image|mimes:jpeg,png,jpg|max:'.Config::get( 'AllFileValidation.FLOWERS_IMAGE_MAX_SIZE' ).'|min:'.Config::get( 'AllFileValidation.FLOWERS_IMAGE_MIN_SIZE' );
        }
        if ( $request->has( 'image_five' ) ) {
            $rules[ 'image_five' ] = 'required|image|mimes:jpeg,png,jpg|max:'.Config::get( 'AllFileValidation.FLOWERS_IMAGE_MAX_SIZE' ).'|min:'.Config::get( 'AllFileValidation.FLOWERS_IMAGE_MIN_SIZE' );
        }
        if ( $request->has( 'english_audio_link' ) ) {
            $rules[ 'english_audio_link' ] = 'required|mimes:mp3|max:'. Config::get( 'AllFileValidation.AUDIO_MAX_SIZE' ) . '|min:' . Config::get( 'AllFileValidation.AUDIO_MIN_SIZE' );
        }
        if ( $request->has( 'hindi_audio_link' ) ) {
            $rules[ 'hindi_audio_link' ] = 'required|mimes:mp3|max:'. Config::get( 'AllFileValidation.AUDIO_MAX_SIZE' ) . '|min:' . Config::get( 'AllFileValidation.AUDIO_MIN_SIZE' );
        }
        if ( $request->has( 'english_video_upload' ) ) {
            $rules[ 'english_video_upload' ] = 'required|mimetypes:video/mp4|max:' . Config::get( 'AllFileValidation.VIDEO_MAX_SIZE' ) . '|min:' . Config::get( 'AllFileValidation.VIDEO_MIN_SIZE' );
        }
        if ( $request->has( 'hindi_video_upload' ) ) {
            $rules[ 'hindi_video_upload' ] = 'required|mimetypes:video/mp4|max:' . Config::get( 'AllFileValidation.VIDEO_MAX_SIZE' ) . '|min:' . Config::get( 'AllFileValidation.VIDEO_MIN_SIZE' );
        }
        $messages = [
            'english_name.required' => 'Please enter the name.',
            'english_name.max' => 'Please enter an name with a maximum length of 255 characters.',
            'hindi_name.required' => 'कृपया नाम दर्ज करें |',
            'hindi_name.max' => 'कृपया अधिकतम 255 अक्षरों वाला नाम दर्ज करें |',
            'english_description.required' => 'Please enter the description.',
            'hindi_description.required' => 'कृपया विवरण दर्ज करें |',

            'latitude.required' => 'Please enter the latitude.',
            'latitude.numeric' => 'Latitude must be a number.',
            'latitude.between' => 'Latitude must be between -90 and 90.',
            'longitude.required' => 'Please enter the longitude.',
            'longitude.numeric' => 'Longitude must be a number.',
            'longitude.between' => 'Longitude must be between -180 and 180.',

            'image.required' => 'The image is required.',
            'image.image' => 'The file must be an image.',
            'image.mimes' => 'The image must be in JPEG, PNG, or JPG format.',
            'image.max' => 'The image size must not exceed ' . Config::get( 'AllFileValidation.FLOWERS_IMAGE_MAX_SIZE' ) . ' KB.',
            'image.min' => 'The image size must be at least ' . Config::get( 'AllFileValidation.FLOWERS_IMAGE_MIN_SIZE' ) . ' KB.',

            'image_two.required' => 'The image is required.',
            'image_two.image' => 'The file must be an image.',
            'image_two.mimes' => 'The image must be in JPEG, PNG, or JPG format.',
            'image_two.max' => 'The image size must not exceed ' . Config::get( 'AllFileValidation.FLOWERS_IMAGE_MAX_SIZE' ) . ' KB.',
            'image_two.min' => 'The image size must be at least ' . Config::get( 'AllFileValidation.FLOWERS_IMAGE_MIN_SIZE' ) . ' KB.',

            'image_three.required' => 'The image is required.',
            'image_three.image' => 'The file must be an image.',
            'image_three.mimes' => 'The image must be in JPEG, PNG, or JPG format.',
            'image_three.max' => 'The image size must not exceed ' . Config::get( 'AllFileValidation.FLOWERS_IMAGE_MAX_SIZE' ) . ' KB.',
            'image_three.min' => 'The image size must be at least ' . Config::get( 'AllFileValidation.FLOWERS_IMAGE_MIN_SIZE' ) . ' KB.',

            'image_four.required' => 'The image is required.',
            'image_four.image' => 'The file must be an image.',
            'image_four.mimes' => 'The image must be in JPEG, PNG, or JPG format.',
            'image_four.max' => 'The image size must not exceed ' . Config::get( 'AllFileValidation.FLOWERS_IMAGE_MAX_SIZE' ) . ' KB.',
            'image_four.min' => 'The image size must be at least ' . Config::get( 'AllFileValidation.FLOWERS_IMAGE_MIN_SIZE' ) . ' KB.',

            'image_five.required' => 'The image is required.',
            'image_five.image' => 'The file must be an image.',
            'image_five.mimes' => 'The image must be in JPEG, PNG, or JPG format.',
            'image_five.max' => 'The image size must not exceed ' . Config::get( 'AllFileValidation.FLOWERS_IMAGE_MAX_SIZE' ) . ' KB.',
            'image_five.min' => 'The image size must be at least ' . Config::get( 'AllFileValidation.FLOWERS_IMAGE_MIN_SIZE' ) . ' KB.',

            'english_audio_link.required' => 'Please upload the English audio file.',
            'hindi_audio_link.required' => 'हिंदी ऑडियो फ़ाइल अपलोड करें।',
            'english_audio_link.mimes' => 'The English audio must be in MP3 format.',
            'hindi_audio_link.mimes' => 'हिंदी ऑडियो MP3 प्रारूप में होना चाहिए।',
            'english_audio_link.max' => 'The English audio size must not exceed ' . Config::get( 'AllFileValidation.AUDIO_MAX_SIZE' ) . ' KB.',
            'english_audio_link.min' => 'The English audio size must be at least ' . Config::get( 'AllFileValidation.AUDIO_MIN_SIZE' ) . ' KB.',
            'hindi_audio_link.max' => 'हिंदी ऑडियो आकार ' . Config::get( 'AllFileValidation.AUDIO_MAX_SIZE' ) . ' KB से अधिक नहीं होना चाहिए।',
            'hindi_audio_link.min' => 'हिंदी ऑडियो आकार कम से कम ' . Config::get( 'AllFileValidation.AUDIO_MIN_SIZE' ) . ' KB होना चाहिए।',
            'english_video_upload.required' => 'Please upload the English video file.',
            'hindi_video_upload.required' => 'हिंदी वीडियो फ़ाइल अपलोड करें।',
            'english_video_upload.mimetypes' => 'The English video must be in MP4 format.',
            'hindi_video_upload.mimetypes' => 'हिंदी वीडियो MP4 प्रारूप में होना चाहिए।',
            'english_video_upload.max' => 'The English video size must not exceed ' . Config::get( 'AllFileValidation.VIDEO_MAX_SIZE' ) . ' KB.',
            'english_video_upload.min' => 'The English video size must be at least ' . Config::get( 'AllFileValidation.VIDEO_MIN_SIZE' ) . ' KB.',
            'hindi_video_upload.max' => 'हिंदी वीडियो आकार ' . Config::get( 'AllFileValidation.VIDEO_MAX_SIZE' ) . ' KB से अधिक नहीं होना चाहिए।',
            'hindi_video_upload.min' => 'हिंदी वीडियो आकार कम से कम ' . Config::get( 'AllFileValidation.VIDEO_MIN_SIZE' ) . ' KB होना चाहिए।',

        ];

        try {
            $validation = Validator::make( $request->all(), $rules, $messages );
            if ( $validation->fails() ) {
                return redirect()->back()
                ->withInput()
                ->withErrors( $validation );
            } else {
                $update_slide = $this->service->updateAll( $request );
                if ( $update_slide ) {
                    $msg = $update_slide[ 'msg' ];
                    $status = $update_slide[ 'status' ];
                    if ( $status == 'success' ) {
                        return redirect( 'list-flowers' )->with( compact( 'msg', 'status' ) );
                    } else {
                        return redirect()->back()
                        ->withInput()
                        ->with( compact( 'msg', 'status' ) );
                    }
                }
            }
        } catch ( Exception $e ) {
            return redirect()->back()
            ->withInput()
            ->with( [ 'msg' => $e->getMessage(), 'status' => 'error' ] );
        }
    }

    public function updateOne( Request $request ) {
        try {
            $active_id = $request->active_id;
            $result = $this->service->updateOne( $active_id );
            return redirect( 'list-flowers' )->with( 'flash_message', 'Updated!' );

        } catch ( \Exception $e ) {
            return $e;
        }
    }

    public function destroy( Request $request ) {
        try {
            $delete_data = $this->service->deleteById( $request->delete_id );
            if ( $delete_data ) {
                $msg = $delete_data[ 'msg' ];
                $status = $delete_data[ 'status' ];
                if ( $status == 'success' ) {
                    return redirect( 'list-flowers' )->with( compact( 'msg', 'status' ) );
                } else {
                    return redirect()->back()
                    ->withInput()
                    ->with( compact( 'msg', 'status' ) );
                }
            }
        } catch ( \Exception $e ) {
            return $e;
        }
    }

}