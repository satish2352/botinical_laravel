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
                            <h1>Add district Data</h1>
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
                                    <form action="{{ route('update-district') }}" method="POST"
                                        enctype="multipart/form-data" id="frm_register" name="frm_register" autocomplete="off">
                                        @csrf
                                        <div class="form-group-inner">
                                            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="name">District Name</label>&nbsp<span class="red-text">*</span>
                                                        <input type="text" class="form-control mb-2" name="name" id="name"
                                                            placeholder="" value="{{ $district_data['name'] }}"
                                                            oninput="this.value = this.value.replace(/[^a-zA-Z\s.]/g, '').replace(/(\..*)\./g, '$1');">
                                                        @if ($errors->has('name'))
                                                            <span class="red-text"><?php echo $errors->first('name', ':message'); ?></span>
                                                        @endif
                                                    </div>
                                                </div>      

                                            </div>


                                            <div class="login-btn-inner">
                                                <div class="row">
                                                    <div class="col-lg-5"></div>
                                                    <div class="col-lg-7">
                                                        <div class="login-horizental cancel-wp pull-left">
                                                            <a href="{{ route('list-district') }}" class="btn btn-white"
                                                                style="margin-bottom:50px">Cancel</a>
                                                            <!-- <button class="btn btn-sm btn-primary login-submit-cs"
                                                                type="submit" style="margin-bottom:50px">Save Data</button> -->
                                                                <input type="hidden" class="form-check-input" name="edit_id" id="edit_id"
                                                            value="{{ $district_data['location_id'] }}">
                                                            <button type="submit" class="btn btn-sm btn-primary login-submit-cs" style="margin-bottom:50px" id="submitButton">
                                                                Save &amp; Update
                                                            </button>
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
            $("#frm_register").validate({
                rules: {
                    name: {
                        required: true
                    },

                },
                messages: {
                    name: {
                        required: "Please Enter the District Name.",
                    },

                },
            });
        });
    </script>
@endsection
