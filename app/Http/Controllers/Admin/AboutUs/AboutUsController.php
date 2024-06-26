<?php

namespace App\Http\Controllers\Admin\AboutUs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Admin\AboutUs\AboutUsServices;
use Validator;
use Illuminate\Validation\Rule;
use Config;

class AboutUsController extends Controller
{

    public function __construct(){
    $this->service = new AboutUsServices();
    }

    public function index(){
        try {
            $aboutus = $this->service->getAll();
            return view('admin.pages.aboutus.list-aboutus', compact('aboutus'));
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function add(){
        return view('admin.pages.aboutus.add-aboutus');
    }

    public function store(Request $request){

        $rules = [
            'english_name' => 'required|max:255',
            'hindi_name' => 'required|max:255',
            'english_description' => 'required',
            'hindi_description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:' . Config::get("AllFileValidation.ABOUT_US_IMAGE_MAX_SIZE") . '|min:' . Config::get("AllFileValidation.ABOUT_US_IMAGE_MIN_SIZE"),
          
        ];
        
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
            'image.max' => 'The image size must not exceed ' . Config::get("AllFileValidation.ABOUT_US_IMAGE_MAX_SIZE") . ' KB.',
            'image.min' => 'The image size must be at least ' . Config::get("AllFileValidation.ABOUT_US_IMAGE_MIN_SIZE") . ' KB.',
          
        ];
        try {
            $validation = Validator::make($request->all(), $rules, $messages);
            
            if ($validation->fails()) {
                return redirect('add-aboutus')
                    ->withInput()
                    ->withErrors($validation);
            } else {
                $add_data = $this->service->addAll($request);

                if ($add_data) {
                    $msg = $add_data['msg'];
                    $status = $add_data['status'];

                    if ($status == 'success') {
                        return redirect('list-aboutus')->with(compact('msg', 'status'));
                    } else {
                        return redirect('add-aboutus')->withInput()->with(compact('msg', 'status'));
                    }
                }
            }
        } catch (Exception $e) {
            return redirect('add-aboutus')->withInput()->with(['msg' => $e->getMessage(), 'status' => 'error']);
        }
    }

    public function show(Request $request){
        try {
            $aboutus = $this->service->getById($request->show_id);
          
            return view('admin.pages.aboutus.show-aboutus', compact('aboutus'));
        } catch (\Exception $e) {
            return $e;
        }
    }
    
    public function edit(Request $request){
        $edit_data_id = base64_decode($request->edit_id);      
        $aboutus = $this->service->getById($edit_data_id);
        return view('admin.pages.aboutus.edit-aboutus', compact('aboutus'));
    }
    
    public function update(Request $request){
        $rules = [
            // 'english_name' => 'required|max:255',
            // 'hindi_name' => 'required|max:255',
            // 'english_description' => 'required',
            // 'hindi_description' => 'required',
       
        ];

        // if($request->has('image')) {
        //     $rules['image'] = 'required|image|mimes:jpeg,png,jpg|max:'.Config::get("AllFileValidation.SLIDER_IMAGE_MAX_SIZE").'|min:'.Config::get("AllFileValidation.SLIDER_IMAGE_MIN_SIZE");
        // }
        
        $messages = [   
            // 'english_name.required' => 'Please enter the name.',
            // 'english_name.max' => 'Please enter an name with a maximum length of 255 characters.',
            // 'hindi_name.required' => 'कृपया नाम दर्ज करें |',
            // 'hindi_name.max' => 'कृपया अधिकतम 255 अक्षरों वाला नाम दर्ज करें |',
            // 'english_description.required' => 'Please enter the description.',
            // 'hindi_description.required' => 'कृपया विवरण दर्ज करें |',

           
            // 'image.required' => 'The image is required.',
            // 'image.image' => 'The file must be an image.',
            // 'image.mimes' => 'The image must be in JPEG, PNG, or JPG format.',
            // 'image.max' => 'The image size must not exceed ' . Config::get("AllFileValidation.ABOUT_US_IMAGE_MAX_SIZE") . ' KB.',
            // 'image.min' => 'The image size must be at least ' . Config::get("AllFileValidation.ABOUT_US_IMAGE_MIN_SIZE") . ' KB.',
           
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
                        return redirect('list-aboutus')->with(compact('msg', 'status'));
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
            return redirect('list-aboutus')->with('flash_message', 'Updated!');  
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
                    return redirect('list-aboutus')->with(compact('msg', 'status'));
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