@extends('admin.layouts.master')
@section('content')
    <style>
        @import url("https://fonts.google.com/specimen/Titillium+Web");

        .card {
            background-color: #fff;
            border-radius: 10px;
            border: none;
            position: relative;
            margin-bottom: 30px;
            box-shadow: 0 0.46875rem 2.1875rem rgba(90, 97, 105, 0.1), 0 0.9375rem 1.40625rem rgba(90, 97, 105, 0.1), 0 0.25rem 0.53125rem rgba(90, 97, 105, 0.12), 0 0.125rem 0.1875rem rgba(90, 97, 105, 0.1);
        }

        .l-bg-cherry {
            background: #d24d4d73 !important;
            color: #fff;
        }

        .l-bg-blue-dark {
            background: #a2d9c6 !important;
            color: #fff;
        }

        .l-bg-green-dark {
            background: #9b9b9b8f !important;
            color: #fff;
        }

        .l-bg-orange-dark {
            background: #e2bfda !important;
            color: #fff;
        }

        .card .card-statistic-3 .card-icon-large .fas,
        .card .card-statistic-3 .card-icon-large .far,
        .card .card-statistic-3 .card-icon-large .fab,
        .card .card-statistic-3 .card-icon-large .fal {
            font-size: 110px;
        }

        .card .card-statistic-3 .card-icon {
            text-align: center;
            line-height: 50px;
            margin-left: 15px;
            color: #000;
            position: absolute;
            right: -5px;
            top: 20px;
            opacity: 0.1;
        }

        .l-bg-cyan {
            background: linear-gradient(135deg, #289cf5, #84c0ec) !important;
            color: #fff;
        }

        .l-bg-green {
            background: linear-gradient(135deg, #23bdb8 0%, #43e794 100%) !important;
            color: #fff;
        }

        .l-bg-orange {
            background: linear-gradient(to right, #f9900e, #ffba56) !important;
            color: #fff;
        }

        .l-bg-cyan {
            background: linear-gradient(135deg, #289cf5, #84c0ec) !important;
            color: #fff;
        }

        .homeIcon1 {
            font-size: 2.5rem;
            color: #ec671f;
        }

        .dashboard_Card1 {
            background: darksalmon;
            border-radius: 10px;
        }

        .homeIcon2 {
            font-size: 2.5rem;
            color: #ec671f;
        }

        .dashboard_Card2 {
            background: #c9bcff;
            border-radius: 10px;
        }

        .homeIcon3 {
            font-size: 2.5rem;
            color: #ec671f;
        }

        .dashboard_Card3 {
            background: #ec8ca3;
            border-radius: 10px;
        }

        .homeIcon4 {
            font-size: 2.5rem;
            color: #ec671f;
        }

        .dashboard_Card4 {
            background: #d2ec8c;
            border-radius: 10px;
        }

        .homeIcon5 {
            font-size: 2.5rem;
            color: #ec671f;
        }

        .dashboard_Card5 {
            background: #8cecbf;
            border-radius: 10px;
        }

        .homeIcon6 {
            font-size: 2.5rem;
            color: #ec671f;
        }

        .dashboard_Card6 {
            background: #ec8cdb;
            border-radius: 10px;
        }

        .homeIcon7 {
            font-size: 2.5rem;
            color: #ec671f;
        }

        .dashboard_Card7 {
            background: #8cecdb;
            border-radius: 10px;
        }

        .homeIcon8 {
            font-size: 2.5rem;
            color: #ec671f;
        }

        .dashboard_Card8 {
            background: #8cec93;
            border-radius: 10px;
        }

        .homeIcon9 {
            font-size: 2.5rem;
            color: #ec671f;
        }

        .dashboard_Card9 {
            background: #e0dfeb;
            border-radius: 10px;
        }

        .homeIcon10 {
            font-size: 2.5rem;
            color: #ec671f;
        }

        .dashboard_Card10 {
            background: #85edc5;
            border-radius: 10px;
        }

        .homeIcon11 {
            font-size: 2.5rem;
            color: #ec671f;
        }

        .dashboard_Card11 {
            background: #add8f6;
            border-radius: 10px;
        }

        .media-body {
            text-align: right !important;
            font-size: 24px;
            font-family: "Anta", sans-serif;
            /* font-family: titillium -webkit-body; */
        }

        .media-body h3 {
            text-align: right !important;
            font-size: 24px;
            font-family: "Anta", sans-serif;
            /* font-family: titillium -webkit-body; */
        }
        .dash_card_title{
            color: #fff;
        }
        .dash_count{
            color: #fff;
        }
    </style>
    <?php 
    // $data_for_url = session('data_for_url'); 
    ?>
  
            <div class="data-table-area mg-tb-15">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="sparkline13-list">
                                <div class="row">
                                    @if (isset($status) && $return_data['status'] == 'success')
                                        <div class="alert alert-success" role="alert">
                                            {{ $return_data['msg'] }}
                                        </div>
                                    @endif

                                    {{-- <div class="col-12 grid-margin">
                                        <div class="card"> --}}
                                            <div class="card-body">
                                                <div class="container dash-height">
                                                    @if (isset($status) && $return_data['status'] == 'success')
                                    <div class="alert alert-success" role="alert">
                                        {{ $return_data['msg'] }}
                                    </div>
                                    @endif
                                                    <div class="col-md-12">
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <a 
                                                                    href="{{ route('list-amenities-category') }}"
                                                                    >
                                                                        <div class="card">
                                                                            <div class="card-body"
                                                                                style="background-color:#{{ str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT) . str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT) . str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT) }}">
                                                                                <div class="card-statistic-3 p-4">
                                                                                    <div class="mb-4">
                                                                                        <h4 class="mb-0 dash_card_title">Aminities Category</h4>
                                                                                    </div>
                                                                                    <div class="row align-items-center mb-2 d-flex">
                                                                                        <div class="col-8">
                                                                                            <h4
                                                                                                class="d-flex align-items-center mb-0 dash_count">
                                                                                                {{$return_data['amenitie-category']}} </h4>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <a 
                                                                    href="{{ route('list-amenities') }}"
                                                                    >
                                                                        <div class="card">
                                                                            <div class="card-body"
                                                                                style="background-color:#{{ str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT) . str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT) . str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT) }}">
                                                                                <div class="card-statistic-3 p-4">
                                                                                    <div class="mb-4">
                                                                                        <h4 class="mb-0 dash_card_title">Aminities</h4>
                                                                                    </div>
                                                                                    <div class="row align-items-center mb-2 d-flex">
                                                                                        <div class="col-8">
                                                                                            <h4
                                                                                                class="d-flex align-items-center mb-0 dash_count">
                                                                                                {{$return_data['amenitie']}}</h4>
                                                                                                
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <a 
                                                                    href="{{ route('list-flowers') }}"
                                                                    >
                                                                        <div class="card">
                                                                            <div class="card-body"
                                                                                style="background-color:#{{ str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT) . str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT) . str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT) }}">
                                                                                <div class="card-statistic-3 p-4">
                                                                                    <div class="mb-4">
                                                                                        <h4 class="mb-0 dash_card_title">Plant</h4>
                                                                                    </div>
                                                                                    <div class="row align-items-center mb-2 d-flex">
                                                                                        <div class="col-8">
                                                                                            <h4
                                                                                                class="d-flex align-items-center mb-0 dash_count">
                                                                                                {{$return_data['flowers']}}</h4>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <a 
                                                                    href="{{ route('list-tress') }}"
                                                                    >
                                                                        <div class="card">
                                                                            <div class="card-body"
                                                                                style="background-color:#{{ str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT) . str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT) . str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT) }}">
                                                                                <div class="card-statistic-3 p-4">
                                                                                    <div class="mb-4">
                                                                                        <h4 class="mb-0 dash_card_title">Tree</h4>
                                                                                    </div>
                                                                                    <div class="row align-items-center mb-2 d-flex">
                                                                                        <div class="col-8">
                                                                                            <h4
                                                                                                class="d-flex align-items-center mb-0 dash_count">
                                                                                                {{$return_data['tress']}}</h4>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <a 
                                                                    href="{{ route('list-zone-area') }}"
                                                                    >
                                                                        <div class="card">
                                                                            <div class="card-body"
                                                                                style="background-color:#{{ str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT) . str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT) . str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT) }}">
                                                                                <div class="card-statistic-3 p-4">
                                                                                    <div class="mb-4">
                                                                                        <h4 class="mb-0 dash_card_title">Zone Area</h4>
                                                                                    </div>
                                                                                    <div class="row align-items-center mb-2 d-flex">
                                                                                        <div class="col-8">
                                                                                            <h4
                                                                                                class="d-flex align-items-center mb-0 dash_count">
                                                                                                {{$return_data['zone-area']}} </h4>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <a 
                                                                    href="{{ route('list-ticket') }}"
                                                                    >
                                                                        <div class="card">
                                                                            <div class="card-body"
                                                                                style="background-color:#{{ str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT) . str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT) . str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT) }}">
                                                                                <div class="card-statistic-3 p-4">
                                                                                    <div class="mb-4">
                                                                                        <h4 class="mb-0 dash_card_title">Ticket</h4>
                                                                                    </div>
                                                                                    <div class="row align-items-center mb-2 d-flex">
                                                                                        <div class="col-8">
                                                                                            <h4
                                                                                                class="d-flex align-items-center mb-0 dash_count">
                                                                                                {{$return_data['ticket']}} </h4>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <a 
                                                                    href="{{ route('list-gallery') }}"
                                                                    >
                                                                        <div class="card">
                                                                            <div class="card-body"
                                                                                style="background-color:#{{ str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT) . str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT) . str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT) }}">
                                                                                <div class="card-statistic-3 p-4">
                                                                                    <div class="mb-4">
                                                                                        <h4 class="mb-0 dash_card_title">Gallery</h4>
                                                                                    </div>
                                                                                    <div class="row align-items-center mb-2 d-flex">
                                                                                        <div class="col-8">
                                                                                            <h4
                                                                                                class="d-flex align-items-center mb-0 dash_count">
                                                                                                {{$return_data['gallery']}} </h4>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <a 
                                                                    href="{{ route('list-contact-enquiry') }}"
                                                                    >
                                                                        <div class="card">
                                                                            <div class="card-body"
                                                                                style="background-color:#{{ str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT) . str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT) . str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT) }}">
                                                                                <div class="card-statistic-3 p-4">
                                                                                    <div class="mb-4">
                                                                                        <h4 class="mb-0 dash_card_title">Contact Enquiry</h4>
                                                                                    </div>
                                                                                    <div class="row align-items-center mb-2 d-flex">
                                                                                        <div class="col-8">
                                                                                            <h4
                                                                                                class="d-flex align-items-center mb-0 dash_count">
                                                                                                {{$return_data['contact-enquiry']}} </h4>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                            

                                                                <div class="col-md-3">
                                                                    <a 
                                                                    href="{{ route('list-aboutus') }}"
                                                                    >
                                                                        <div class="card">
                                                                            <div class="card-body"
                                                                                style="background-color:#{{ str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT) . str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT) . str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT) }}">
                                                                                <div class="card-statistic-3 p-4">
                                                                                    <div class="mb-4">
                                                                                        <h4 class="mb-0 dash_card_title">About Us</h4>
                                                                                    </div>
                                                                                    <div class="row align-items-center mb-2 d-flex">
                                                                                        <div class="col-8">
                                                                                            <h4
                                                                                                class="d-flex align-items-center mb-0 dash_count">
                                                                                                {{$return_data['aboutus']}} </h4>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </a>
                                                                </div>

                                                            </div>
                                                    </div>


                                                </div>
                                            
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        @endsection
