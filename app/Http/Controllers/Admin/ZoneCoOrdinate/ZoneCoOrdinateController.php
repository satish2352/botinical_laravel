<?php

namespace App\Http\Controllers\Admin\ZoneCoOrdinate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Admin\ZoneCoOrdinate\ZoneCoOrdinateServices;
use Session;
use Validator;
use Config;
use Carbon;
use Illuminate\Validation\Rule;

class ZoneCoOrdinateController extends Controller
{ 
    public function __construct(){
        $this->service = new ZoneCoOrdinateServices();
    }



    public function index(){
        try {
            $data_output = $this->service->getAll();
            return view('admin.pages.zone-co-ordinate.list-zone-co-ordinate', compact('data_output'));
        } catch (\Exception $e) {
            return $e;
        }
    }    


    public function add(){
        return view('admin.pages.zone-co-ordinate.add-zone-co-ordinate');
    }




      public function store(Request $request){
         $rules = [
                    // 'colour_picker' => 'required',
                    // 'image' => 'required|file|mimes:kml|max:' . Config::get("AllFileValidation.ZONE_CO_ORDINATE_KML_MAX_SIZE") . '|min:' . Config::get("AllFileValidation.ZONE_CO_ORDINATE_KML_MIN_SIZE"),
                    
                ];

                $messages = [
                    // 'colour_picker.required' => 'Please enter the colour picker.',
                    // 'image.required' => 'The image is required.',
                    // // 'image.image' => 'The file must be an kml.',
                    // // 'image.mimes' => 'The image must be in kml format.',
                    // 'image.max' => 'The kml file size must not exceed ' . Config::get("AllFileValidation.ZONE_CO_ORDINATE_KML_MAX_SIZE") . ' KB.',
                    // 'image.min' => 'The kml file size must be at least ' . Config::get("AllFileValidation.ZONE_CO_ORDINATE_KML_MIN_SIZE") . ' KB.',
                ];
  
          try {
              $validation = Validator::make($request->all(), $rules, $messages);
              
              if ($validation->fails()) {
                  return redirect('add-zone-co-ordinate')
                      ->withInput()
                      ->withErrors($validation);
              } else {
                  $add_record = $this->service->addAll($request);
                //   dd($add_record);
                  if ($add_record) {
                      $msg = $add_record['msg'];
                      $status = $add_record['status'];
  
                      if ($status == 'success') {
                          return redirect('list-zone-co-ordinate')->with(compact('msg', 'status'));
                      } else {
                          return redirect('add-zone-co-ordinate')->withInput()->with(compact('msg', 'status'));
                      }
                  }
              }
          } catch (Exception $e) {
              return redirect('add-zone-co-ordinate')->withInput()->with(['msg' => $e->getMessage(), 'status' => 'error']);
          }
      }




  public function edit(Request $request){
    $edit_data_id = base64_decode($request->edit_id);
    $editData = $this->service->getById($edit_data_id);
    return view('admin.pages.zone-co-ordinate.edit-zone-co-ordinate', compact('editData'));
}


public function update(Request $request){
    $id = $request->edit_id;
    $rules = [
        'colour_picker' => ['required'],
    ];

    if($request->has('image')) {
        // $rules['image'] = 'required|image|mimes:jpeg,png,jpg|max:'.Config::get("AllFileValidation.ZONE_CO_ORDINATE_KML_MAX_SIZE").'|min:'.Config::get("AllFileValidation.ZONE_CO_ORDINATE_KML_MIN_SIZE");
    }
    $messages = [   
        // 'colour_picker.required' => 'Please enter the colour picker.',
        // 'image.required' => 'The image is required.',
        // 'image.image' => 'The file must be an image.',
        // 'image.mimes' => 'The image must be in JPEG, PNG, or JPG format.',
        // 'image.max' => 'The image size must not exceed ' . Config::get("AllFileValidation.ZONE_CO_ORDINATE_KML_MAX_SIZE") . ' KB.',
        // 'image.min' => 'The image size must be at least ' . Config::get("AllFileValidation.ZONE_CO_ORDINATE_KML_MIN_SIZE") . ' KB.',
    
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
                    return redirect('list-zone-co-ordinate')->with(compact('msg', 'status'));
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
                return redirect('list-zone-co-ordinate')->with('flash_message', 'Updated!');
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
                        return redirect('list-zone-co-ordinate')->with(compact('msg', 'status'));
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
