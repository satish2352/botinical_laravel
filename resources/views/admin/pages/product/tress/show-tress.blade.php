@extends('admin.layouts.master')

@section('content')
<div class="data-table-area mg-tb-15">
    <div class="container-fluid">
        <div class="row showpage">
            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                <div class="sparkline13-list">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 d-flex justify-content-start align-items-center">
                            <h3 class="page-title">
                                Tree Details
                            </h3>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 d-flex justify-content-end align-items-center">
                            <div>
                                <a href="{{ route('list-tress') }}" class="btn btn-sm btn-primary ml-3">Back</a>
                            </div>
                        </div>

                    </div>
                    <div class="card mt-2">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="row ">
                                        <div class="col-lg-3 col-md-3 col-sm-3">
                                            <label>Title :</label>
                                        </div>
                                        <div class="col-lg-8 col-md-8 col-sm-8">
                                            <label>{{ strip_tags($tress->english_name) }}</label>
                                        </div>
                                    </div>
                                    <div class="row ">
                                        <div class="col-lg-3 col-md-3 col-sm-3">
                                            <label>नाम :</label>
                                        </div>
                                        <div class="col-lg-8 col-md-8 col-sm-8">
                                            <label>{{ strip_tags($tress->hindi_name) }}</label>
                                        </div>
                                    </div>
                                    <div class="row ">
                                        <div class="col-lg-3 col-md-3 col-sm-3">
                                            <label>Botnical Name :</label>
                                        </div>
                                        <div class="col-lg-8 col-md-8 col-sm-8">
                                            <label>{{ strip_tags($tress->english_botnical_name) }}</label>
                                        </div>
                                    </div>
                                    <div class="row ">
                                        <div class="col-lg-3 col-md-3 col-sm-3">
                                            <label>वानस्पतिक नाम :</label>
                                        </div>
                                        <div class="col-lg-8 col-md-8 col-sm-8">
                                            <label>{{ strip_tags($tress->hindi_botnical_name) }}</label>
                                        </div>
                                    </div>
                                    <div class="row ">
                                        <div class="col-lg-3 col-md-3 col-sm-3">
                                            <label>Common Name :</label>
                                        </div>
                                        <div class="col-lg-8 col-md-8 col-sm-8">
                                            <label>{{ strip_tags($tress->english_common_name) }}</label>
                                        </div>
                                    </div>
                                    <div class="row ">
                                        <div class="col-lg-3 col-md-3 col-sm-3">
                                            <label>साधारण नाम :</label>
                                        </div>
                                        <div class="col-lg-8 col-md-8 col-sm-8">
                                            <label>{{ strip_tags($tress->hindi_common_name) }}</label>
                                        </div>
                                    </div>
                                    <div class="row ">
                                        <div class="col-lg-3 col-md-3 col-sm-3">
                                            <label>Description :</label>
                                        </div>
                                        <div class="col-lg-8 col-md-8 col-sm-8">
                                            <label>{{ strip_tags($tress->english_description) }}</label>
                                        </div>
                                    </div>
                                    <div class="row ">
                                        <div class="col-lg-3 col-md-3 col-sm-3">
                                            <label>वर्णन :</label>
                                        </div>
                                        <div class="col-lg-8 col-md-8 col-sm-8">
                                            <label>{{ strip_tags($tress->hindi_description) }}</label>
                                        </div>
                                    </div>

                                    <div class="row ">
                                        <div class="col-lg-3 col-md-3 col-sm-3">
                                            <label>Height :</label>
                                        </div>
                                        <div class="col-lg-8 col-md-8 col-sm-8">
                                            <label>{{ strip_tags($tress->height) }} {{ strip_tags($tress->height_type) }}</label>
                                        </div>
                                    </div>
                                    <div class="row ">
                                        <div class="col-lg-3 col-md-3 col-sm-3">
                                            <label>Canopy :</label>
                                        </div>
                                        <div class="col-lg-8 col-md-8 col-sm-8">
                                            <label>{{ strip_tags($tress->canopy) }} {{ strip_tags($tress->canopy_type) }}</label>
                                        </div>
                                    </div>
                                    <div class="row ">
                                        <div class="col-lg-3 col-md-3 col-sm-3">
                                            <label>Girth :</label>
                                        </div>
                                        <div class="col-lg-8 col-md-8 col-sm-8">
                                            <label>{{ strip_tags($tress->girth) }} {{ strip_tags($tress->girth_type) }}</label>
                                        </div>
                                    </div>
                                    <div class="row rowpadd">
                                        <div class="col-lg-3 col-md-3 col-sm-3">
                                            <label> Images :</label>
                                        </div>
                                        <div class="col-lg-8 col-md-8 col-sm-8">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-4 col-sm-4">
                                                    @if(!empty($tress->image))
                                                        <img src="{{ Config::get('DocumentConstant.TRESS_VIEW') }}{{ $tress->image }}" style="width:300px; height:150px;" alt="{{ strip_tags($tress['english_name']) }} Image" />
                                                    @else
                                                    @endif
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4">
                                                    @if(!empty($tress->image_two))
                                                        <img src="{{ Config::get('DocumentConstant.TRESS_VIEW') }}{{ $tress->image_two }}" style="width:300px; height:150px;" alt="{{ strip_tags($tress['english_name']) }} Image" />
                                                    @else
                                                    @endif
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4">
                                                    @if(!empty($tress->image_three))
                                                        <img src="{{ Config::get('DocumentConstant.TRESS_VIEW') }}{{ $tress->image_three }}" style="width:300px; height:150px;" alt="{{ strip_tags($tress['english_name']) }} Image" />
                                                    @else
                                                    @endif
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 pt-4 pt-4">
                                                    @if(!empty($tress->image_four))
                                                        <img src="{{ Config::get('DocumentConstant.TRESS_VIEW') }}{{ $tress->image_four }}" style="width:300px; height:150px;" alt="{{ strip_tags($tress['english_name']) }} Image" />
                                                    @else
                                                    @endif
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 pt-4 pt-4">
                                                    @if(!empty($tress->image_five))
                                                        <img src="{{ Config::get('DocumentConstant.TRESS_VIEW') }}{{ $tress->image_five }}" style="width:300px; height:150px;" alt="{{ strip_tags($tress['english_name']) }} Image" />
                                                    @else
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="row rowpadd">
                                        <div class="col-lg-3 col-md-3 col-sm-3">
                                            <label> Audio :</label>
                                        </div>
                                        <div class="col-lg-8 col-md-8 col-sm-8">
                                            <audio controls>
                                                <source src="{{ Config::get('DocumentConstant.TRESS_VIEW') }}{{ $tress->english_audio_link }}" type="audio/mpeg">
                                            </audio>
                                        </div>
                                    </div>
                                    <div class="row rowpadd">
                                        <div class="col-lg-3 col-md-3 col-sm-3">
                                            <label> ऑडियो :</label>
                                        </div>
                                        <div class="col-lg-8 col-md-8 col-sm-8">
                                            <audio controls>
                                                <source src="{{ Config::get('DocumentConstant.TRESS_VIEW') }}{{ $tress->hindi_audio_link }}" type="audio/mpeg">
                                            </audio>
                                        </div>
                                    </div>                                    
                                    <div class="row rowpadd">
                                        <div class="col-lg-3 col-md-3 col-sm-3">
                                            <label> Video :</label>
                                        </div>
                                        <div class="col-lg-8 col-md-8 col-sm-8">
                                            <div id="english_videoPreview">
                                                <video id="english_videoPreview" width="300" height="150" controls>
                                                    <source src="" type="video/mp4">
                                                </video>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row rowpadd">
                                        <div class="col-lg-3 col-md-3 col-sm-3">
                                            <label> वीडियो :</label>
                                        </div>
                                        <div class="col-lg-8 col-md-8 col-sm-8">
                                            <div id="hindi_videoPreview">
                                                <video  id="hindi_videoPreview" width="300" height="150" controls>
                                                    <source src="" type="video/mp4">
                                                </video>
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


        <!-- content-wrapper ends -->
    @endsection
