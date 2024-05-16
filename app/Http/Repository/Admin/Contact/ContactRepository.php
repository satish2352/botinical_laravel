<?php
namespace App\Http\Repository\Admin\Contact;
use Illuminate\Database\QueryException;

use App\Models\ {
    ContactEnquiry
};
use Config;

class ContactRepository  {


    public function getAll(){
        try {
          $data_output = ContactEnquiry::get();
            return $data_output;
        } catch (\Exception $e) {
            return $e;
        }
    }
    public function deleteById($id){
        try {
            $data_output = ContactEnquiry::find($id);
            $data_output->delete();
                
            return $data_output;
        } catch (\Exception $e) {
            return $e;
        }
    }
    

}