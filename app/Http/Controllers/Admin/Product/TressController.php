<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tress;
use App\Http\Services\Admin\Product\TressServices;
use Validator;
use Illuminate\Validation\Rule;
use Config;

class TressController extends Controller
{

    public function __construct(){
    $this->service = new TressServices();
    }

    public function index(){
        try {
            $tress = $this->service->getAll();
            return view('admin.pages.product.tress.list-tress', compact('tress'));
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function add(){
        return view('admin.pages.product.tress.add-tress');
    }

    public function store(Request $request){
        $rules = [
            // 'english_name' => 'required|max:255',
            // 'marathi_name' => 'required|max:255',
            // 'english_description' => 'required',
            // 'marathi_description' => 'required',
            // 'image' => 'required|image|mimes:jpeg,png,jpg|max:'.Config::get("AllFileValidation.TRESS_IMAGE_MAX_SIZE").'|min:'.Config::get("AllFileValidation.TRESS_IMAGE_MIN_SIZE").'',
            // 'latitude' =>'required',
            // 'longitude' =>'required',
        ];

        $messages = [    
            // 'english_name.required'=>'Please enter name.',
            // // 'english_name.regex' => 'Please  enter text only.',
            // 'english_name.max'   => 'Please  enter text length upto 255 character only.',
            // 'marathi_name.required'=>'कृपया शीर्षक प्रविष्ट करा.',
            // 'marathi_name.max'   => 'कृपया केवळ २५५ वर्णांपर्यंत मजकूराची लांबी प्रविष्ट करा.',     
            // 'english_description.required' => 'Please enter description.',
            // 'marathi_description.required' => 'कृपया वर्णन प्रविष्ट करा.',
            // 'image.required' => 'The image is required.',
            // 'image.image' => 'The image must be a valid image file.',
            // 'image.mimes' => 'The image must be in JPEG, PNG, JPG format.',
            // 'image.max' => 'The image size must not exceed '.Config::get("AllFileValidation.TRESS_IMAGE_MAX_SIZE").'KB .',
            // 'image.min' => 'The image size must not be less than '.Config::get("AllFileValidation.TRESS_IMAGE_MIN_SIZE").'KB .',
            // // 'image.dimensions' => 'The image dimensions must be between 1500x500 and 2000x1000 pixels.',
            // 'latitude.required'=>'Please enter latitude.',
            // 'longitude.regex'=>'Please enter valid latitude.',
        ];

        try {
            $validation = Validator::make($request->all(), $rules, $messages);
            
            if ($validation->fails()) {
                return redirect('add-tress')
                    ->withInput()
                    ->withErrors($validation);
            } else {
                $add_tress = $this->service->addAll($request);

                if ($add_tress) {
                    $msg = $add_tress['msg'];
                    $status = $add_tress['status'];

                    if ($status == 'success') {
                        return redirect('list-tress')->with(compact('msg', 'status'));
                    } else {
                        return redirect('add-tress')->withInput()->with(compact('msg', 'status'));
                    }
                }
            }
        } catch (Exception $e) {
            return redirect('add-tress')->withInput()->with(['msg' => $e->getMessage(), 'status' => 'error']);
        }
    }

    public function show(Request $request){
        try {
            $tress = $this->service->getById($request->show_id);
          
            return view('admin.pages.product.tress.show-tress', compact('tress'));
        } catch (\Exception $e) {
            return $e;
        }
    }
    
    public function edit(Request $request){
        $edit_data_id = base64_decode($request->edit_id);      
        $tress = $this->service->getById($edit_data_id);
        return view('admin.pages.product.tress.edit-tress', compact('tress'));
    }
    
    public function update(Request $request){
        $rules = [
            // 'english_name' => 'required|max:255',
            // 'marathi_name' => 'required|max:255',
            // 'english_description' => 'required',
            // 'marathi_description' => 'required',
            // 'url' => ['required','regex:/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i'],
        ];

        if($request->has('image')) {
            $rules['image'] = 'required|image|mimes:jpeg,png,jpg|max:'.Config::get("AllFileValidation.SLIDER_IMAGE_MAX_SIZE").'|min:'.Config::get("AllFileValidation.SLIDER_IMAGE_MIN_SIZE");
        }
        // if($request->has('marathi_image')) {
        //     $rules['marathi_image'] = 'required|image|mimes:jpeg,png,jpg|max:'.Config::get("AllFileValidation.SLIDER_IMAGE_MAX_SIZE").'|dimensions:min_width=1500,min_height=500,max_width=2000,max_height=1000|min:'.Config::get("AllFileValidation.SLIDER_IMAGE_MIN_SIZE");
        // }
        $messages = [   
            // 'english_name.required'=>'Please enter name.',
            // // 'english_name.regex' => 'Please  enter text only.',
            // 'english_name.max'   => 'Please  enter text length upto 255 character only.',
            // 'marathi_name.required'=>'कृपया शीर्षक प्रविष्ट करा.',
            // 'marathi_name.max'   => 'कृपया केवळ २५५ वर्णांपर्यंत मजकूराची लांबी प्रविष्ट करा.',     
            // 'english_description.required' => 'Please enter description.',
            // 'marathi_description.required' => 'कृपया वर्णन प्रविष्ट करा.',
            // 'english_image.required' => 'The image is required.',
            // 'english_image.image' => 'The image must be a valid image file.',
            // 'english_image.mimes' => 'The image must be in JPEG, PNG, JPG format.',
            // 'english_image.max' => 'The image size must not exceed '.Config::get("AllFileValidation.SLIDER_IMAGE_MAX_SIZE").'KB .',
            // 'english_image.min' => 'The image size must not be less than '.Config::get("AllFileValidation.SLIDER_IMAGE_MIN_SIZE").'KB .',
            // 'english_image.dimensions' => 'The image dimensions must be between 1500x500 and 2000x1000 pixels.',
            // 'marathi_image.required' => 'कृपया छायाचित्र आवश्यक आहे.',
            // 'marathi_image.image' => 'कृपया छायाचित्र फाइल कायदेशीर असणे आवश्यक आहे.',
            // 'marathi_image.mimes' => 'कृपया छायाचित्र JPEG, PNG, JPG स्वरूपात असणे आवश्यक आहे.',
            // 'marathi_image.max' => 'कृपया प्रतिमेचा आकार जास्त नसावा.'.Config::get("AllFileValidation.SLIDER_IMAGE_MAX_SIZE").'KB .',
            // 'marathi_image.min' => 'कृपया प्रतिमेचा आकार पेक्षा कमी नसावा.'.Config::get("AllFileValidation.SLIDER_IMAGE_MIN_SIZE").'KB .',
            // 'marathi_image.dimensions' => 'कृपया छायाचित्र 1500x500 आणि 2000x1000 पिक्सेल दरम्यान असणे आवश्यक आहे.',
            // 'url.required'=>'Please enter url.',
            // 'url.regex'=>'Please valid url.',
        ];

        try {
            $validation = Validator::make($request->all(),$rules, $messages);
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
                        return redirect('list-slide')->with(compact('msg', 'status'));
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
            return redirect('list-tress')->with('flash_message', 'Updated!');  
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function destroy(Request $request){
        try {
            $delete_slide = $this->service->deleteById($request->delete_id);
            if ($delete_slide) {
                $msg = $delete_slide['msg'];
                $status = $delete_slide['status'];
                if ($status == 'success') {
                    return redirect('list-slide')->with(compact('msg', 'status'));
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