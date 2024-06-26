<?php

namespace App\Http\Controllers\Admin\Ticket;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Admin\Ticket\TicketServices;
use Validator;
use Illuminate\Validation\Rule;
use Config;

class TicketController extends Controller
{

    public function __construct(){
    $this->service = new TicketServices();
    }

    public function index(){
        try {
            $ticket = $this->service->getAll();
            return view('admin.pages.ticket.list-ticket', compact('ticket'));
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function add(){
        return view('admin.pages.ticket.add-ticket');
    }

    public function store(Request $request){

        $rules = [
            'english_name' => 'required|max:255',
            'hindi_name' => 'required|max:255',
            'english_description' => 'required',
            'hindi_description' => 'required',
            'english_rules_terms' => 'required',
            'hindi_rules_terms' => 'required',
            'english_ticket_cost' => 'required',
            'hindi_ticket_cost' => 'required',
        ];
        
        $messages = [
         'english_name.required' => 'Please enter the name.',
            'english_name.max' => 'Please enter an name with a maximum length of 255 characters.',
            'hindi_name.required' => 'कृपया नाम दर्ज करें |',
            'hindi_name.max' => 'कृपया अधिकतम 255 अक्षरों वाला नाम दर्ज करें |',
            'english_description.required' => 'Please enter the description.',
            'hindi_description.required' => 'कृपया विवरण दर्ज करें |',
            'english_rules_terms.required' => 'Please enter the rules terms',
            'hindi_rules_terms.required' => 'कृपया नियम शर्तें दर्ज करें',
            'english_ticket_cost.required' => 'Please enter the ticket cost',
            'english_ticket_cost.required' => 'कृपया टिकट की कीमत दर्ज करें',
           
        ];
        try {
            $validation = Validator::make($request->all(), $rules, $messages);
            
            if ($validation->fails()) {
                return redirect('add-ticket')
                    ->withInput()
                    ->withErrors($validation);
            } else {
                $add_data = $this->service->addAll($request);

                if ($add_data) {
                    $msg = $add_data['msg'];
                    $status = $add_data['status'];

                    if ($status == 'success') {
                        return redirect('list-ticket')->with(compact('msg', 'status'));
                    } else {
                        return redirect('add-ticket')->withInput()->with(compact('msg', 'status'));
                    }
                }
            }
        } catch (Exception $e) {
            return redirect('add-ticket')->withInput()->with(['msg' => $e->getMessage(), 'status' => 'error']);
        }
    }

    public function show(Request $request){
        try {
            $ticket = $this->service->getById($request->show_id);
          
            return view('admin.pages.ticket.show-ticket', compact('ticket'));
        } catch (\Exception $e) {
            return $e;
        }
    }
    
    public function edit(Request $request){
        $edit_data_id = base64_decode($request->edit_id);      
        $ticket = $this->service->getById($edit_data_id);
        return view('admin.pages.ticket.edit-ticket', compact('ticket'));
    }
    
    public function update(Request $request){
        $rules = [
            'english_name' => 'required|max:255',
            'hindi_name' => 'required|max:255',
            'english_description' => 'required',
            'hindi_description' => 'required',
            'english_rules_terms' => 'required',
            'hindi_rules_terms' => 'required',
            'english_ticket_cost' => 'required',
            'hindi_ticket_cost' => 'required',
            

        ];
      
        $messages = [   
            'english_name.required' => 'Please enter the name.',
            'english_name.max' => 'Please enter an name with a maximum length of 255 characters.',
            'hindi_name.required' => 'कृपया नाम दर्ज करें |',
            'hindi_name.max' => 'कृपया अधिकतम 255 अक्षरों वाला नाम दर्ज करें |',
            'english_description.required' => 'Please enter the description.',
            'hindi_description.required' => 'कृपया विवरण दर्ज करें |',
            'english_rules_terms.required' => 'Please enter the rules terms',
            'hindi_rules_terms.required' => 'कृपया नियम शर्तें दर्ज करें',
            'english_ticket_cost.required' => 'Please enter the ticket cost',
            'english_ticket_cost.required' => 'कृपया टिकट की कीमत दर्ज करें',
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
                        return redirect('list-ticket')->with(compact('msg', 'status'));
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
            return redirect('list-ticket')->with('flash_message', 'Updated!');  
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
                    return redirect('list-ticket')->with(compact('msg', 'status'));
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