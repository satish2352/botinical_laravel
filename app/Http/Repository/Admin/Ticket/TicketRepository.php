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
            $add_data->name = $request['name'];
            $add_data->description = $request['description'];
            $add_data->rules_terms = $request['rules_terms'];
            $add_data->ticket_cost = $request['ticket_cost'];
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
            $data_output->name = $request['name'];
            $data_output->description = $request['description'];
            $data_output->rules_terms = $request['rules_terms'];
            $data_output->ticket_cost = $request['ticket_cost'];
          
            
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