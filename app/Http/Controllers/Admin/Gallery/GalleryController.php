<?php

namespace App\Http\Controllers\Admin\Gallery;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Admin\Gallery\GalleryServices;
use Validator;
use Illuminate\Validation\Rule;
use Config;

class GalleryController extends Controller
{

    public function __construct(){
    $this->service = new GalleryServices();
    }

    public function index(){
        try {
            $gallery = $this->service->getAll();
            return view('admin.pages.gallery.list-gallery', compact('gallery'));
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function add(){
        return view('admin.pages.gallery.add-gallery');
    }

    public function store(Request $request){

        $rules = [
            'image' => 'required|image|mimes:jpeg,png,jpg|max:' . Config::get("AllFileValidation.FLOWERS_IMAGE_MAX_SIZE") . '|min:' . Config::get("AllFileValidation.FLOWERS_IMAGE_MIN_SIZE"),
        ];
        
        $messages = [
            'image.required' => 'The image is required.',
            'image.image' => 'The file must be an image.',
            'image.mimes' => 'The image must be in JPEG, PNG, or JPG format.',
            'image.max' => 'The image size must not exceed ' . Config::get("AllFileValidation.GALLERY_IMAGE_MAX_SIZE") . ' KB.',
            'image.min' => 'The image size must be at least ' . Config::get("AllFileValidation.FLOWERS_IMAGE_MIN_SIZE") . ' KB.',
        ];
        try {
            $validation = Validator::make($request->all(), $rules, $messages);
            
            if ($validation->fails()) {
                return redirect('add-gallery')
                    ->withInput()
                    ->withErrors($validation);
            } else {
                $add_data = $this->service->addAll($request);

                if ($add_data) {
                    $msg = $add_data['msg'];
                    $status = $add_data['status'];

                    if ($status == 'success') {
                        return redirect('list-gallery')->with(compact('msg', 'status'));
                    } else {
                        return redirect('add-gallery')->withInput()->with(compact('msg', 'status'));
                    }
                }
            }
        } catch (Exception $e) {
            return redirect('add-gallery')->withInput()->with(['msg' => $e->getMessage(), 'status' => 'error']);
        }
    }

    public function show(Request $request){
        try {
            $gallery = $this->service->getById($request->show_id);
          
            return view('admin.pages.gallery.show-gallery', compact('gallery'));
        } catch (\Exception $e) {
            return $e;
        }
    }
    
    public function edit(Request $request){
        $edit_data_id = base64_decode($request->edit_id);      
        $gallery = $this->service->getById($edit_data_id);
        return view('admin.pages.gallery.edit-gallery', compact('gallery'));
    }
    
    public function update(Request $request){
        $rules = [];
        $messages = [];   
    
        if ($request->has('image')) {
            $rules['image'] = 'required|image|mimes:jpeg,png,jpg|max:' . Config::get("AllFileValidation.GALLERY_IMAGE_MAX_SIZE") . '|min:' . Config::get("AllFileValidation.GALLERY_IMAGE_MIN_SIZE");
            $messages += [
                'image.required' => 'The image is required.',
                'image.image' => 'The file must be an image.',
                'image.mimes' => 'The image must be in JPEG, PNG, or JPG format.',
                'image.max' => 'The image size must not exceed ' . Config::get("AllFileValidation.GALLERY_IMAGE_MAX_SIZE") . ' KB.',
                'image.min' => 'The image size must be at least ' . Config::get("AllFileValidation.GALLERY_IMAGE_MIN_SIZE") . ' KB.',
            ];
        }
    
        try {
            $validation = Validator::make($request->all(), $rules, $messages);
            if ($validation->fails()) {
                return redirect()->back()
                    ->withInput()
                    ->withErrors($validation);
            } else {
                $update_slide = $this->service->updateAll($request);
                if ($update_slide) {
                    $msg = $update_slide['msg'];
                    $status = $update_slide['status'];
                    if ($status == 'success') {
                        return redirect('list-gallery')->with(compact('msg', 'status'));
                    } else {
                        return redirect()->back()
                            ->withInput()
                            ->with(compact('msg', 'status'));
                    }
                }
            }
        } catch (Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with(['msg' => $e->getMessage(), 'status' => 'error']);
        }
    }
    

    public function updateOne(Request $request){
        try {
            $active_id = $request->active_id;
        $result = $this->service->updateOne($active_id);
            return redirect('list-gallery')->with('flash_message', 'Updated!');  
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function destroy(Request $request){
        try {
            $delete_data = $this->service->deleteById($request->delete_id);
            if ($delete_data) {
                $msg = $delete_data['msg'];
                $status = $delete_data['status'];
                if ($status == 'success') {
                    return redirect('list-gallery')->with(compact('msg', 'status'));
                } else {
                    return redirect()->back()
                        ->withInput()
                        ->with(compact('msg', 'status'));
                }
            }
        } catch (\Exception $e) {
            return $e;
        }
    } 

}