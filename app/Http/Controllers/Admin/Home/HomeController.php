<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Admin\Home\HomeServices;
use Validator;
use Illuminate\Validation\Rule;
use Config;

class HomeController extends Controller
{

    public function __construct(){
    $this->service = new HomeServices();
    }

    public function index(){
        try {
            $home = $this->service->getAll();
            return view('admin.pages.home.list-home', compact('home'));
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function add(){
        return view('admin.pages.home.add-home');
    }

    public function store(Request $request){

        $rules = [
            // 'english_name' => 'required|max:255',
            // 'hindi_name' => 'required|max:255',
            // 'english_description' => 'required',
            // 'hindi_description' => 'required',
            // 'english_image' => 'required|image|mimes:jpeg,png,jpg|max:' . Config::get("AllFileValidation.HOME_IMAGE_MAX_SIZE") . '|min:' . Config::get("AllFileValidation.HOME_IMAGE_MIN_SIZE"),
          
        ];
        
        $messages = [
            // 'english_name.required' => 'Please enter the name.',
            // 'english_name.max' => 'Please enter an name with a maximum length of 255 characters.',
            // 'hindi_name.required' => 'कृपया नाम दर्ज करें |',
            // 'hindi_name.max' => 'कृपया अधिकतम 255 अक्षरों वाला नाम दर्ज करें |',
            // 'english_description.required' => 'Please enter the description.',
            // 'hindi_description.required' => 'कृपया विवरण दर्ज करें |',
            // 'english_image.required' => 'The image is required.',
            // 'english_image.image' => 'The file must be an image.',
            // 'english_image.mimes' => 'The image must be in JPEG, PNG, or JPG format.',
            // 'english_image.max' => 'The image size must not exceed ' . Config::get("AllFileValidation.HOME_IMAGE_MAX_SIZE") . ' KB.',
            // 'english_image.min' => 'The image size must be at least ' . Config::get("AllFileValidation.HOME_IMAGE_MIN_SIZE") . ' KB.',
          
        ];
        try {
            $validation = Validator::make($request->all(), $rules, $messages);
            
            if ($validation->fails()) {
                return redirect('add-home')
                    ->withInput()
                    ->withErrors($validation);
            } else {
                $add_data = $this->service->addAll($request);

                if ($add_data) {
                    $msg = $add_data['msg'];
                    $status = $add_data['status'];

                    if ($status == 'success') {
                        return redirect('list-home')->with(compact('msg', 'status'));
                    } else {
                        return redirect('add-home')->withInput()->with(compact('msg', 'status'));
                    }
                }
            }
        } catch (Exception $e) {
            return redirect('add-home')->withInput()->with(['msg' => $e->getMessage(), 'status' => 'error']);
        }
    }

    public function show(Request $request){
        try {
            $home = $this->service->getById($request->show_id);
          
            return view('admin.pages.home.show-home', compact('home'));
        } catch (\Exception $e) {
            return $e;
        }
    }
    
    public function edit(Request $request){
        $edit_data_id = base64_decode($request->edit_id);      
        $home = $this->service->getById($edit_data_id);
        return view('admin.pages.home.edit-home', compact('home'));
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
                        return redirect('list-home')->with(compact('msg', 'status'));
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
            return redirect('list-home')->with('flash_message', 'Updated!');  
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
                    return redirect('list-home')->with(compact('msg', 'status'));
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