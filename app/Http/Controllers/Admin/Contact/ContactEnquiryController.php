<?php

namespace App\Http\Controllers\Admin\Contact;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Admin\Contact\ContactServices;
use Session;
use Validator;
use Config;
use Carbon;

class ContactEnquiryController extends Controller
{ 
    public function __construct(){
        $this->service = new ContactServices();
    }

    public function index(){
        try {
            $data_output = $this->service->getAll();
            return view('admin.pages.contact-enquiry.list-contact-enquiry', compact('data_output'));
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
                    return redirect('list-contact-enquiry')->with(compact('msg', 'status'));
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
