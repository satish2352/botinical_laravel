<?php
namespace App\Http\Repository\Admin\Ticket;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\QueryException;
use DB;
use Illuminate\Support\Carbon;
// use Session;
use App\Models\ {
	Ticket
};
use Config;

class TicketRepository  {
	public function getAll(){
        try {
            return Ticket::orderBy('updated_at', 'desc')->get();
        } catch (\Exception $e) {
            return $e;
        }
    }
     public function addAll($request){
        try {
            $add_data = new Ticket();
            $add_data->english_name = $request['english_name'];
            $add_data->hindi_name = $request['hindi_name'];
            $add_data->english_description = $request['english_description'];
            $add_data->hindi_description = $request['hindi_description'];
            $add_data->english_rules_terms = $request['english_rules_terms'];
            $add_data->hindi_rules_terms = $request['hindi_rules_terms'];
            $add_data->english_ticket_cost = $request['english_ticket_cost'];
            $add_data->hindi_ticket_cost = $request['hindi_ticket_cost'];

            $add_data->save(); 
    
            return $add_data;
    
        } catch (\Exception $e) {
            return [
                'msg' => $e->getMessage(), 
                'status' => 'error'
            ];
        }
    }
    
    

    public function getById($id){
        try {
            $data_output = Ticket::find($id);
          
            if ($data_output) {
                return $data_output;
            } else {
                return null;
            }
        } catch (\Exception $e) {
            return $e;
            return [
                'msg' => 'Failed to get by id data.',
                'status' => 'error'
            ];
        }
    }
    
    public function updateAll($request){
        try {
            $return_data = array();
            $data_output = Ticket::find($request->id);

            if (!$data_output) {
                return [
                    'msg' => 'Data not found.',
                    'status' => 'error'
                ];
            }
            // Update the fields from the request
            $data_output->english_name = $request['english_name'];
            $data_output->hindi_name = $request['hindi_name'];
            $data_output->english_description = $request['english_description'];
            $data_output->hindi_description = $request['hindi_description'];
            $data_output->english_rules_terms = $request['english_rules_terms'];
            $data_output->hindi_rules_terms = $request['hindi_rules_terms'];
            $data_output->english_ticket_cost = $request['english_ticket_cost'];
            $data_output->hindi_ticket_cost = $request['hindi_ticket_cost'];

            $data_output->save();
            $last_insert_id = $data_output->id;

            $return_data['last_insert_id'] = $last_insert_id;
          
            return  $return_data;
        
        } catch (\Exception $e) {
            return [
                'msg' => 'Failed to update Data.',
                'status' => 'error',
                'error' => $e->getMessage() // Return the error message for debugging purposes
            ];
        }
    }

    public function updateOne($request){
        try {
            $data = Ticket::find($request); 

            if ($data) {
                $is_active = $data->is_active === 1 ? 0 : 1;
                $data->is_active = $is_active;
                $data->save();

                return [
                    'msg' => 'Data updated successfully.',
                    'status' => 'success'
                ];
            }

            return [
                'msg' => 'Data not found.',
                'status' => 'error'
            ];
        } catch (\Exception $e) {
            return [
                'msg' => 'Failed to update Data.',
                'status' => 'error'
            ];
        }
    }

    public function deleteById($id){
            try {
                $data_output = Ticket::find($id);
                $data_output->delete();
                    
                return $data_output;
            } catch (\Exception $e) {
                return $e;
            }
    }


}