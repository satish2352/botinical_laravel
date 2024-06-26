@extends('admin.layouts.master')
@section('content')
    <style>
        label {
            margin-top: 20px;
        }
    </style>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="sparkline12-list">
                <div class="sparkline12-hd">
                    <div class="main-sparkline12-hd">
                        <center>
                            <h1>Edit Contact Details</h1>
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
                                    <form action="{{ route('update-contact-information') }}" method="POST"
                                        enctype="multipart/form-data" id="addDesignsForm" autocomplete="off">
                                        @csrf
                                        <div class="form-group-inner">
                                            <input type="hidden" class="form-control"
                                                value="@if (old('id')) {{ old('id') }}@else{{ $editData->id }} @endif"
                                                id="id" name="id">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label for="english_director_number">Director Number :</label>
                                                    <input type="text" class="form-control"
                                                        value="@if (old('english_director_number')) {{ old('english_director_number') }}@else{{ $editData->english_director_number }} @endif"
                                                        id="english_director_number" name="english_director_number"
                                                        placeholder="Enter name">
                                                    @if ($errors->has('english_director_number'))
                                                        <span class="red-text"><?php echo $errors->first('english_director_number', ':message'); ?></span>
                                                    @endif
                                                </div>

                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label for="hindi_director_number">निदेशक क्रमांक :</label>
                                                    <input type="text" class="form-control"
                                                        value="@if (old('hindi_director_number')) {{ old('hindi_director_number') }}@else{{ $editData->hindi_director_number }} @endif"
                                                        id="hindi_director_number" name="hindi_director_number"
                                                        placeholder="नाम दर्ज करें">
                                                    @if ($errors->has('hindi_director_number'))
                                                        <span class="red-text"><?php echo $errors->first('hindi_director_number', ':message'); ?></span>
                                                    @endif
                                                </div>

                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label for="english_officer_number">Officer Number :</label>
                                                    <input type="text" class="form-control"
                                                        value="@if (old('english_officer_number')) {{ old('english_officer_number') }}@else{{ $editData->english_officer_number }} @endif"
                                                        id="english_officer_number" name="english_officer_number"
                                                        placeholder="Enter price">
                                                    @if ($errors->has('english_officer_number'))
                                                        <span class="red-text"><?php echo $errors->first('english_officer_number', ':message'); ?></span>
                                                    @endif
                                                </div>

                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label for="hindi_officer_number">अधिकारी क्रमांक :</label>
                                                    <input type="text" class="form-control"
                                                        value="@if (old('hindi_officer_number')) {{ old('hindi_officer_number') }}@else{{ $editData->hindi_officer_number }} @endif"
                                                        id="hindi_officer_number" name="hindi_officer_number"
                                                        placeholder="अधिकारी क्रमांक दर्ज करें">
                                                    @if ($errors->has('hindi_officer_number'))
                                                        <span class="red-text"><?php echo $errors->first('hindi_officer_number', ':message'); ?></span>
                                                    @endif
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label for="english_address">Address :</label>
                                                    <textarea class="form-control" id="english_address" name="english_address" placeholder="Enter Address">@if (old('english_address')) {{ old('english_address') }}@else{{ $editData->english_address }} @endif</textarea>
                                                    @if ($errors->has('english_address'))
                                                        <span class="red-text"><?php echo $errors->first('english_address', ':message'); ?></span>
                                                    @endif
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label for="hindi_address">पता :</label>
                                                    <textarea class="form-control" id="hindi_address" name="hindi_address" placeholder="पता दर्ज करें">@if (old('hindi_address')) {{ old('hindi_address') }}@else{{ $editData->hindi_address }} @endif</textarea>
                                                    @if ($errors->has('hindi_address'))
                                                        <span class="red-text"><?php echo $errors->first('hindi_address', ':message'); ?></span>
                                                    @endif
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label for="email">Email :</label>
                                                    <input type="email" class="form-control"
                                                        value="@if (old('email')) {{ old('email') }}@else{{ $editData->email }} @endif"
                                                        id="email" name="email"
                                                        placeholder="Please Enter Email">
                                                    @if ($errors->has('email'))
                                                        <span class="red-text"><?php echo $errors->first('email', ':message'); ?></span>
                                                    @endif
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label for="google_link">Google Map Link :</label>
                                                    <input type="text" class="form-control" id="google_link"
                                                        name="google_link"    value="@if (old('google_link')) {{ old('google_link') }}@else{{ $editData->google_link }} @endif"  placeholder="Enter name">
                                                    @if ($errors->has('google_link'))
                                                        <span class="red-text"><?php echo $errors->first('google_link', ':message'); ?></span>
                                                    @endif
                                                </div>



                                            </div>
                                            <div class="login-btn-inner">
                                                <div class="row">
                                                    <div class="col-lg-5"></div>
                                                    <div class="col-lg-7">
                                                        <div class="login-horizental cancel-wp pull-left">
                                                            <a href="{{ route('list-contact-information') }}">
                                                                <button class="btn btn-white"
                                                                    style="margin-bottom:50px">Cancel</button>
                                                            </a>
                                                            <button class="btn btn-sm btn-primary login-submit-cs"
                                                                type="submit" style="margin-bottom:50px">Save Data</button>
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
    {{-- <script>
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

                },
                messages: {
                    english_name: {
                        required: "Please Enter Name.",
                    },
                    hindi_name: {
                        required: "कृपया नाम दर्ज करें |",
                    },

                },
            });
        });
    </script> --}}
@endsection
