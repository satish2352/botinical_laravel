<?php

namespace App\Http\Controllers\Admin\AmenitiesCategory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Admin\AmenitiesCategory\AmenitiesCategoryServices;
use Session;
use Validator;
use Config;
use Carbon;

class AmenitiesCategoryController extends Controller
{ 
    public function __construct(){
        $this->service = new AmenitiesCategoryServices();
    }



    public function index(){
        try {
            $data_output = $this->service->getAll();
            return view('admin.pages.amenities-category.list-amenities-category', compact('data_output'));
        } catch (\Exception $e) {
            return $e;
        }
    }    


    public function add(){
        return view('admin.pages.amenities-category.add-amenities-category');
    }




      public function store(Request $request){
         $rules = [
                    'english_name' => 'required|max:255',
                    'hindi_name' => 'required|max:255',
                    'icon' => 'required',
                    
                ];

                $messages = [
                    'english_name.required' => 'Please enter the name.',
                    'english_name.max' => 'The name must not exceed 255 characters.',
                    'english_name.required' => 'कृपया नाम दर्ज करें |',
                    'english_name.max' => 'नाम 255 अक्षरों से अधिक नहीं होना चाहिए.',
                    'icon.required' => 'Please enter the icon name.',
                ];
  
          try {
              $validation = Validator::make($request->all(), $rules, $messages);
              
              if ($validation->fails()) {
                  return redirect('add-amenities-category')
                      ->withInput()
                      ->withErrors($validation);
              } else {
                  $add_record = $this->service->addAll($request);
                //   dd($add_record);
                  if ($add_record) {
                      $msg = $add_record['msg'];
                      $status = $add_record['status'];
  
                      if ($status == 'success') {
                          return redirect('list-amenities-category')->with(compact('msg', 'status'));
                      } else {
                          return redirect('add-amenities-category')->withInput()->with(compact('msg', 'status'));
                      }
                  }
              }
          } catch (Exception $e) {
              return redirect('add-amenities-category')->withInput()->with(['msg' => $e->getMessage(), 'status' => 'error']);
          }
      }




  public function edit(Request $request){
    $edit_data_id = base64_decode($request->edit_id);
    $editData = $this->service->getById($edit_data_id);
    return view('admin.pages.amenities-category.edit-amenities-category', compact('editData'));
}


        public function update(Request $request){
            $rules = [
                'english_name' => 'required|max:255',
                'hindi_name' => 'required|max:255',
                'icon' => 'required',
                    
                ];
    
                     
            $messages = [
                'english_name.required' => 'Please enter the name.',
                'english_name.max' => 'The name must not exceed 255 characters.',
                'english_name.required' => 'कृपया नाम दर्ज करें |',
                'english_name.max' => 'नाम 255 अक्षरों से अधिक नहीं होना चाहिए.',
                'icon.required' => 'Please enter the icon name.',
              
                ];
    
            try {
                $validation = Validator::make($request->all(),$rules, $messages);
                if ($validation->fails()) {
                    return redirect()->back()
                        ->withInput()
                        ->withErrors($validation);
                } else {
                    $update_data = $this->service->updateAll($request);
                    // dd($update_data);
                    if ($update_data) {
                        $msg = $update_data['msg'];
                        $status = $update_data['status'];
                        if ($status == 'success') {
                            return redirect('list-amenities-category')->with(compact('msg', 'status'));
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
                return redirect('list-amenities-category')->with('flash_message', 'Updated!');
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
                        return redirect('list-amenities-category')->with(compact('msg', 'status'));
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
