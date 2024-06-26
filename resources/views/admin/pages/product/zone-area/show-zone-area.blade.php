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
                                Zone Area Details
                            </h3>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 d-flex justify-content-end align-items-center">
                            <div>
                                <a href="{{ route('list-zone-area') }}" class="btn btn-sm btn-primary ml-3">Back</a>
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
                                            <label>{{ strip_tags($zonearea->english_name) }}</label>
                                        </div>
                                    </div>
                                    <div class="row ">
                                        <div class="col-lg-3 col-md-3 col-sm-3">
                                            <label>नाम :</label>
                                        </div>
                                        <div class="col-lg-8 col-md-8 col-sm-8">
                                            <label>{{ strip_tags($zonearea->hindi_name) }}</label>
                                        </div>
                                    </div>
                                    <div class="row ">
                                        <div class="col-lg-3 col-md-3 col-sm-3">
                                            <label>Description :</label>
                                        </div>
                                        <div class="col-lg-8 col-md-8 col-sm-8">
                                            <label>{{ strip_tags($zonearea->english_description) }}</label>
                                        </div>
                                    </div>
                                    <div class="row ">
                                        <div class="col-lg-3 col-md-3 col-sm-3">
                                            <label>वर्णन :</label>
                                        </div>
                                        <div class="col-lg-8 col-md-8 col-sm-8">
                                            <label>{{ strip_tags($zonearea->hindi_description) }}</label>
                                        </div>
                                    </div>
                                    <div class="row rowpadd">
                                        <div class="col-lg-3 col-md-3 col-sm-3">
                                            <label> Image :</label>
                                        </div>
                                        <div class="col-lg-8 col-md-8 col-sm-8">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-4 col-sm-4">
                                                    @if(!empty($zonearea->image))
                                                        <img src="{{ Config::get('DocumentConstant.ZONESAREA_VIEW') }}{{ $zonearea->image }}" style="width:300px; height:150px;" alt="{{ strip_tags($zonearea['english_name']) }} Image" />
                                                    @else
                                                    @endif
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4">
                                                    @if(!empty($zonearea->image_two))
                                                        <img src="{{ Config::get('DocumentConstant.ZONESAREA_VIEW') }}{{ $zonearea->image_two }}" style="width:300px; height:150px;" alt="{{ strip_tags($zonearea['english_name']) }} Image" />
                                                    @else
                                                    @endif
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4">
                                                    @if(!empty($zonearea->image_three))
                                                        <img src="{{ Config::get('DocumentConstant.ZONESAREA_VIEW') }}{{ $zonearea->image_three }}" style="width:300px; height:150px;" alt="{{ strip_tags($zonearea['english_name']) }} Image" />
                                                    @else
                                                    @endif
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4">
                                                    @if(!empty($zonearea->image_four))
                                                        <img src="{{ Config::get('DocumentConstant.ZONESAREA_VIEW') }}{{ $zonearea->image_four }}" style="width:300px; height:150px;" alt="{{ strip_tags($zonearea['english_name']) }} Image" />
                                                    @else
                                                    @endif
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4">
                                                    @if(!empty($zonearea->image_five))
                                                        <img src="{{ Config::get('DocumentConstant.ZONESAREA_VIEW') }}{{ $zonearea->image_five }}" style="width:300px; height:150px;" alt="{{ strip_tags($zonearea['english_name']) }} Image" />
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
                                                <source src="{{ Config::get('DocumentConstant.ZONESAREA_VIEW') }}{{ $zonearea->english_audio_link }}" type="audio/mpeg">
                                            </audio>
                                        </div>
                                    </div>
                                    <div class="row rowpadd">
                                        <div class="col-lg-3 col-md-3 col-sm-3">
                                            <label> ऑडियो :</label>
                                        </div>
                                        <div class="col-lg-8 col-md-8 col-sm-8">
                                            <audio controls>
                                                <source src="{{ Config::get('DocumentConstant.ZONESAREA_VIEW') }}{{ $zonearea->hindi_audio_link }}" type="audio/mpeg">
                                            </audio>
                                        </div>
                                    </div>
                                    
                                    <div class="row rowpadd">
                                        <div class="col-lg-3 col-md-3 col-sm-3">
                                            <label> Video :</label>
                                        </div>
                                        <div class="col-lg-8 col-md-8 col-sm-8">
                                            <video id="english_videoPreview" width="300" height="150" controls>
                                                <source src="{{ Config::get('DocumentConstant.ZONESAREA_VIEW') }}{{ $zonearea->english_video_upload }}" type="video/mp4">
                                            </video>
                                        </div>
                                    </div>
                                    <div class="row rowpadd">
                                        <div class="col-lg-3 col-md-3 col-sm-3">
                                            <label> वीडियो :</label>
                                        </div>
                                        <div class="col-lg-8 col-md-8 col-sm-8">
                                            <video id="hindi_videoPreview" width="300" height="150" controls>
                                                <source src="{{ Config::get('DocumentConstant.ZONESAREA_VIEW') }}{{ $zonearea->hindi_video_upload }}" type="video/mp4">
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


        <!-- content-wrapper ends -->
    @endsection
