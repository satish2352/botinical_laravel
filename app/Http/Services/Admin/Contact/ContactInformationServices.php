<?php
namespace App\Http\Services\Admin\Contact;
use App\Http\Repository\Admin\Contact\ContactInformationRepository;
use Carbon\Carbon;


use Config;
class ContactInformationServices
{
	protected $repo;
    public function __construct(){
        $this->repo = new ContactInformationRepository();
    }


    public function getAll(){
        try {
            return $this->repo->getAll();
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function updateAll($request){
        try {
            $return_data = $this->repo->updateAll($request);
            dd($return_data);
            die();
      
            if ($return_data) {
                return ['status' => 'success', 'msg' => 'Data Updated Successfully.'];
            } else {
                return ['status' => 'error', 'msg' => 'Data  Not Updated.'];
            }  
        } catch (Exception $e) {
            return ['status' => 'error', 'msg' => $e->getMessage()];
        }      
    }
    public function getById($id)
    {
        try {
            return $this->repo->getById($id);
        } catch (\Exception $e) {
            return $e;
        }
    }
    public function updateOneCategory($id)
    {
        return $this->repo->updateOneCategory($id);
    }
    
}