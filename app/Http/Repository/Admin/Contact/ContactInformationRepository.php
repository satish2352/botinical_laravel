<?php
namespace App\Http\Repository\Admin\Contact;
use Illuminate\Database\QueryException;

use App\Models\ {
    ContactInformation
};
use Config;

class ContactInformationRepository  {


    public function getAll(){
        try {
          $data_output = ContactInformation::orderBy('updated_at', 'desc')->get();
            return $data_output;
        } catch (\Exception $e) {
            return $e;
        }
    }


   
        public function updateAll($request){
        try { 
            $return_data = array();
          

            $dataOutput = ContactInformation::find($request->id);

            if (!$dataOutput) {
                return [
                    'msg' => 'Update Data not found.',
                    'status' => 'error'
                ];
            }
            $dataOutput->english_director_number = $request->english_director_number;
            $dataOutput->hindi_director_number = $request->hindi_director_number;
            $dataOutput->english_officer_number = $request->english_officer_number;
            $dataOutput->hindi_officer_number = $request->hindi_officer_number;
            $dataOutput->email = $request->email;
            $dataOutput->english_address = $request->english_address;
            $dataOutput->hindi_address = $request->hindi_address;

            $dataOutput->save();
            $return_data['image'] = $previousEnglishImage;
            return  $return_data;
        
        } catch (\Exception $e) {
            return [
                'msg' => 'Failed to Update Data.',
                'status' => 'error',
                'error' => $e->getMessage()
            ];
        }
    }

    public function getById($id)
{
    try {
        $data_output = ContactInformation::find($id);
        if ($data_output) {
            return $data_output;
        } else {
            return null;
        }
    } catch (\Exception $e) {
		return [
            'msg' => $e,
            'status' => 'error'
        ];
    }
}



}