<?php

namespace App\Http\Controllers\Admin\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use App\Http\Services\DashboardServices;
use App\Models\ {
    CategoryAmenities,
    Amenities,
    AboutUs,
    Flowers,
    Tress,
    ZonesArea,
    Ticket,
    Gallery,
    ContactEnquiry,
    Charges
  

};
use Validator;

class DashboardController extends Controller {
    /**
     * Topic constructor.
     */
    public function __construct()
    {
        // $this->service = new DashboardServices();
    }

    // public function index()
    // {
    //     return view('admin.pages.dashboard');
    // }

    public function index()
    {
        $return_data = array();
        $return_data['amenitie-category'] = count(CategoryAmenities::where('is_active',true)->orderBy('updated_at', 'desc')->get());
        $return_data['amenitie'] = count(Amenities::where('is_active',true)->orderBy('updated_at', 'desc')->get());
        $return_data['flowers'] = count(Flowers::where('is_active',true)->orderBy('updated_at', 'desc')->get());
        $return_data['tress'] = count(Tress::where('is_active',true)->orderBy('updated_at', 'desc')->get());
        $return_data['zone-area'] = count(ZonesArea::where('is_active',true)->orderBy('updated_at', 'desc')->get());
        $return_data['ticket'] = count(Ticket::where('is_active',true)->orderBy('updated_at', 'desc')->get());
        $return_data['gallery'] = count(Gallery::where('is_active',true)->orderBy('updated_at', 'desc')->get());
        $return_data['contact-enquiry'] = count(ContactEnquiry::where('is_active',true)->orderBy('updated_at', 'desc')->get());
        $return_data['aboutus'] = count(AboutUs::where('is_active',true)->orderBy('updated_at', 'desc')->get());


        return view('admin.pages.dashboard',compact('return_data'));
    }



}