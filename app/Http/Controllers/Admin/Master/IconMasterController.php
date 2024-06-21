<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Admin\Master\IconMasterServices;
use Session;
use Validator;
use Config;
use Carbon;

class IconMasterController extends Controller
{ 
    public function __construct(){
        $this->service = new IconMasterServices();
    }



    public function index(){
        try {
            $data_output = $this->service->getAll();
            return view('admin.pages.master.icon.list-icon', compact('data_output'));
        } catch (\Exception $e) {
            return $e;
        }
    }    


    public function add(){
        return view('admin.pages.master.icon.add-icon');
    }




      public function store(Request $request){
         $rules = [
                    'name' => 'required|max:255',
                    'image' => 'required|image|mimes:jpeg,png,jpg|max:' . Config::get("AllFileValidation.ICON_MASTER_IMAGE_MAX_SIZE") . '|min:' . Config::get("AllFileValidation.ICON_MASTER_IMAGE_MIN_SIZE"),
                    
                ];

                $messages = [
                    'name.required' => 'Please enter the name.',
                    'name.max' => 'The name must not exceed 255 characters.',
                    'name.required' => 'कृपया नाम दर्ज करें |',
                    'name.max' => 'नाम 255 अक्षरों से अधिक नहीं होना चाहिए.',
                    'image.required' => 'The image is required.',
                    'image.image' => 'The file must be an image.',
                    'image.mimes' => 'The image must be in JPEG, PNG, or JPG format.',
                    'image.max' => 'The image size must not exceed ' . Config::get("AllFileValidation.ICON_MASTER_IMAGE_MAX_SIZE") . ' KB.',
                    'image.min' => 'The image size must be at least ' . Config::get("AllFileValidation.ICON_MASTER_IMAGE_MIN_SIZE") . ' KB.',
                ];
  
          try {
              $validation = Validator::make($request->all(), $rules, $messages);
              
              if ($validation->fails()) {
                  return redirect('add-icon')
                      ->withInput()
                      ->withErrors($validation);
              } else {
                  $add_record = $this->service->addAll($request);
                //   dd($add_record);
                  if ($add_record) {
                      $msg = $add_record['msg'];
                      $status = $add_record['status'];
  
                      if ($status == 'success') {
                          return redirect('list-icon')->with(compact('msg', 'status'));
                      } else {
                          return redirect('add-icon')->withInput()->with(compact('msg', 'status'));
                      }
                  }
              }
          } catch (Exception $e) {
              return redirect('add-icon')->withInput()->with(['msg' => $e->getMessage(), 'status' => 'error']);
          }
      }




  public function edit(Request $request){
    $edit_data_id = base64_decode($request->edit_id);
    $editData = $this->service->getById($edit_data_id);
    return view('admin.pages.master.icon.edit-icon', compact('editData'));
}


public function update(Request $request){
    $rules = [
        'name' => 'required|max:255',
    ];

    if($request->has('image')) {
        $rules['image'] = 'required|image|mimes:jpeg,png,jpg|max:'.Config::get("AllFileValidation.ICON_MASTER_IMAGE_MAX_SIZE").'|min:'.Config::get("AllFileValidation.ICON_MASTER_IMAGE_MIN_SIZE");
    }
    $messages = [   
        'name.required' => 'Please enter the name.',
        'name.max' => 'Please enter an name with a maximum length of 255 characters.',

        'image.required' => 'The image is required.',
        'image.image' => 'The file must be an image.',
        'image.mimes' => 'The image must be in JPEG, PNG, or JPG format.',
        'image.max' => 'The image size must not exceed ' . Config::get("AllFileValidation.ICON_MASTER_IMAGE_MAX_SIZE") . ' KB.',
        'image.min' => 'The image size must be at least ' . Config::get("AllFileValidation.ICON_MASTER_IMAGE_MIN_SIZE") . ' KB.',
    
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
                    return redirect('list-icon')->with(compact('msg', 'status'));
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


        public function updateOneCategory(Request $request)
        {
            try {
                $active_id = $request->active_id;
                $result = $this->service->updateOneCategory($active_id);
                return redirect('list-icon')->with('flash_message', 'Updated!');
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
                        return redirect('list-icon')->with(compact('msg', 'status'));
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
