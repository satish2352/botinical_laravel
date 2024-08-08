@extends('admin.layouts.master')
@section('content')
    <style>
        label {
            /* margin-top: 20px; */
        }
    </style>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="sparkline12-list">
                <div class="sparkline12-hd">
                    <div class="main-sparkline12-hd">
                        <center>
                            <h1>Edit Tree Plant Data</h1>
                        </center>
                    </div>
                </div>
                <div class="sparkline12-graph">
                    <div class="basic-login-form-ad">
                        <div class="row">
                            @if (session('msg'))
                                <div class="alert alert-{{ session('status') }}">
                                    {{ session('msg') }}
                                </div>
                            @endif

                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                @if (Session::get('status') == 'success')
                                    <div class="col-12 grid-margin">
                                        <div class="alert alert-custom-success " id="success-alert">
                                            <button type="button" data-bs-dismiss="alert"></button>
                                            <strong style="color: green;">Success!</strong> {{ Session::get('msg') }}
                                        </div>
                                    </div>
                                @endif

                                @if (Session::get('status') == 'error')
                                    <div class="col-12 grid-margin">
                                        <div class="alert alert-custom-danger " id="error-alert">
                                            <button type="button" data-bs-dismiss="alert"></button>
                                            <strong style="color: red;">Error!</strong> {!! session('msg') !!}
                                        </div>
                                    </div>
                                @endif

                                <div class="all-form-element-inner">
                                    <form action="{{ route('update-tree-plant') }}" method="POST"
                                        enctype="multipart/form-data" id="addDesignsForm" autocomplete="off">
                                        @csrf
                                        <div class="form-group-inner">
                                            <input type="hidden" class="form-control"
                                                value="@if (old('id')) {{ old('id') }}@else{{ $editData->id }} @endif"
                                                id="id" name="id">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label for="english_name">Name:</label>
                                                    <input type="text" class="form-control"
                                                        value="@if (old('english_name')) {{ old('english_name') }}@else{{ $editData->english_name }} @endif"
                                                        id="english_name" name="english_name"
                                                        placeholder="Enter tree-plant name">
                                                    @if ($errors->has('english_name'))
                                                        <span class="red-text"><?php echo $errors->first('english_name', ':message'); ?></span>
                                                    @endif
                                                </div>

                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label for="hindi_name">नाम:</label>
                                                    <input type="text" class="form-control"
                                                        value="@if (old('hindi_name')) {{ old('hindi_name') }}@else{{ $editData->hindi_name }} @endif"
                                                        id="hindi_name" name="hindi_name"
                                                        placeholder="श्रेणी नाम दर्ज करें">
                                                    @if ($errors->has('hindi_name'))
                                                        <span class="red-text"><?php echo $errors->first('hindi_name', ':message'); ?></span>
                                                    @endif
                                                </div>

                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label for="english_botnical_name">Botnical Name:</label>
                                                    <input type="text" class="form-control"
                                                        value="@if (old('english_botnical_name')) {{ old('english_botnical_name') }}@else{{ $editData->english_botnical_name }} @endif"
                                                        id="english_botnical_name" name="english_botnical_name"
                                                        placeholder="Enter the botnical name">
                                                    @if ($errors->has('english_botnical_name'))
                                                        <span class="red-text"><?php echo $errors->first('english_botnical_name', ':message'); ?></span>
                                                    @endif
                                                </div>

                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label for="hindi_botnical_name">वानस्पतिक नाम:</label>
                                                    <input type="text" class="form-control"
                                                        value="@if (old('hindi_botnical_name')) {{ old('hindi_botnical_name') }}@else{{ $editData->hindi_botnical_name }} @endif"
                                                        id="hindi_botnical_name" name="hindi_botnical_name"
                                                        placeholder="वानस्पतिक नाम दर्ज करें">
                                                    @if ($errors->has('hindi_botnical_name'))
                                                        <span class="red-text"><?php echo $errors->first('hindi_botnical_name', ':message'); ?></span>
                                                    @endif
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label for="english_common_name">Common Name:</label>
                                                    <input type="text" class="form-control"
                                                        value="@if (old('english_common_name')) {{ old('english_common_name') }}@else{{ $editData->english_common_name }} @endif"
                                                        id="english_common_name" name="english_common_name"
                                                        placeholder="Enter the common name">
                                                    @if ($errors->has('english_common_name'))
                                                        <span class="red-text"><?php echo $errors->first('english_common_name', ':message'); ?></span>
                                                    @endif
                                                </div>

                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label for="hindi_common_name">साधारण नाम:</label>
                                                    <input type="text" class="form-control"
                                                        value="@if (old('hindi_common_name')) {{ old('hindi_common_name') }}@else{{ $editData->hindi_common_name }} @endif"
                                                        id="hindi_common_name" name="hindi_common_name"
                                                        placeholder="साधारण नाम दर्ज करें">
                                                    @if ($errors->has('hindi_common_name'))
                                                        <span class="red-text"><?php echo $errors->first('hindi_common_name', ':message'); ?></span>
                                                    @endif
                                                </div>
                                            </div>


                                            <div class="login-btn-inner">
                                                <div class="row">
                                                    <div class="col-lg-5"></div>
                                                    <div class="col-lg-7">
                                                        <div class="login-horizental cancel-wp pull-left">
                                                            <a href="{{ route('list-tree-plant') }}">
                                                                <button class="btn btn-white"
                                                                    style="margin-bottom:50px">Cancel</button>
                                                            </a>
                                                            <button class="btn btn-sm btn-primary login-submit-cs"
                                                                type="submit" style="margin-bottom:50px">Update Category</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>    
    <script src="{{ asset('js/vendor/jquery-1.11.3.min.js') }}"></script>
    <script src="{{ asset('js/password-meter/pwstrength-bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/password-meter/zxcvbn.js') }}"></script>
    <script src="{{ asset('js/password-meter/password-meter-active.js') }}"></script>
    <!-- Include jQuery -->
    <script>
        jQuery.noConflict();
        jQuery(document).ready(function($) {
            $("#addDesignsForm").validate({
                rules: {
                    english_name: {
                        required: true
                    },
                    hindi_name: {
                        required: true
                    },
                    english_botnical_name: {
                        required: true
                    },
                    hindi_botnical_name: {
                        required: true
                    },
                    english_common_name: {
                        required: true
                    },
                    hindi_common_name: {
                        required: true
                    },

                },
                messages: {
                    english_name: {
                        required: "Please Enter Name.",
                    },
                    hindi_name: {
                        required: "कृपया नाम दर्ज करें |",
                    },
                    english_botnical_name: {
                        required: "Please Enter Botnical Name.",
                    },
                    hindi_botnical_name: {
                        required: "कृपया वानस्पतिक नाम दर्ज करें |",
                    },
                    english_common_name: {
                        required: "Please Enter Common Name.",
                    },
                    hindi_common_name: {
                        required: "कृपया सामान्य नाम दर्ज करें |",
                    },
                },
            });
        });
    </script>
@endsection
