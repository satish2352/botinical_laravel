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
                                Tress Details
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
                                            <label>शीर्षक :</label>
                                        </div>
                                        <div class="col-lg-8 col-md-8 col-sm-8">
                                            <label>{{ strip_tags($tress->hindi_name) }}</label>
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
                                    <div class="row rowpadd">
                                        <div class="col-lg-3 col-md-3 col-sm-3">
                                            <label> Image :</label>
                                        </div>
                                        <div class="col-lg-8 col-md-8 col-sm-8">
                                            <img src="{{ Config::get('DocumentConstant.TRESS_VIEW') }}{{ $tress->image }}"
                                                style="width:300px; height:150px;" alt=" {{ strip_tags($tress['english_name']) }} Image"/>
                                        </div>
                                    </div>
                                    <div class="row rowpadd">
                                        <div class="col-lg-3 col-md-3 col-sm-3">
                                            <label> Audio :</label>
                                        </div>
                                        <div class="col-lg-8 col-md-8 col-sm-8">
                                            <audio controls>
                                                <source src="{{ Config::get('DocumentConstant.TRESS_VIEW') }}{{ $tress->english_audio_link }}" type="audio/mpeg">
                                                Your browser does not support the audio element.
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
                                                Your browser does not support the audio element.
                                            </audio>
                                        </div>
                                    </div>
                                    
                                    <div class="row rowpadd">
                                        <div class="col-lg-3 col-md-3 col-sm-3">
                                            <label> Video :</label>
                                        </div>
                                        <div class="col-lg-8 col-md-8 col-sm-8">
                                            <video width="300" height="150" controls>
                                                <source src="{{ Config::get('DocumentConstant.TRESS_VIEW') }}{{ $tress->english_video_upload }}" type="video/mp4">
                                                Your browser does not support the video element.
                                            </video>
                                        </div>
                                    </div>
                                    <div class="row rowpadd">
                                        <div class="col-lg-3 col-md-3 col-sm-3">
                                            <label> वीडियो :</label>
                                        </div>
                                        <div class="col-lg-8 col-md-8 col-sm-8">
                                            <video width="300" height="150" controls>
                                                <source src="{{ Config::get('DocumentConstant.TRESS_VIEW') }}{{ $tress->hindi_video_upload }}" type="video/mp4">
                                                Your browser does not support the video element.
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
