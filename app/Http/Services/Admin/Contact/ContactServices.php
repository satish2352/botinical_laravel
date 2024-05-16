<?php
namespace App\Http\Services\Admin\Contact;
use App\Http\Repository\Admin\Contact\ContactRepository;
use Carbon\Carbon;


use Config;
class ContactServices
{
	protected $repo;
    public function __construct(){
        $this->repo = new ContactRepository();
    }
    public function getAll(){
        try {
            return $this->repo->getAll();
        } catch (\Exception $e) {
            return $e;
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
       public function deleteById($id)
    {
        try {
            $delete = $this->repo->deleteById($id);
          
            if ($delete) {
                return ['status' => 'success', 'msg' => 'Deleted Successfully.'];
            } else {
                return ['status' => 'error', 'msg' => ' Not Deleted.'];
            }  
        } catch (Exception $e) {
            return ['status' => 'error', 'msg' => $e->getMessage()];
        } 
    }
}