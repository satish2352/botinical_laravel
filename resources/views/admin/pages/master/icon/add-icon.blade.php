@extends('admin.layouts.master')
@section('content')
    <style>
        label {
            margin-top: 20px;
        }

        .error {
            color: red !important;
        }
    </style>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="sparkline12-list">
                <div class="sparkline12-hd">
                    <div class="main-sparkline12-hd">
                        <center>
                            <h1>Add Icon</h1>
                        </center>
                    </div>
                </div>
                <div class="sparkline12-graph">
                    <div class="basic-login-form-ad">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="all-form-element-inner">
                                    <form action="{{ route('store-icon') }}" method="POST" id="addDesignsForm"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group-inner">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label for="name">Name :</label>
                                                    <input type="text" class="form-control" id="name"
                                                        name="name" placeholder="Enter name">
                                                    @if ($errors->has('name'))
                                                        <span class="red-text"><?php echo $errors->first('name', ':message'); ?></span>
                                                    @endif
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="image">Image </label>&nbsp<span
                                                            class="red-text">*</span><br>
                                                        <input type="file" name="image" id="image"
                                                            accept="image/*" value="{{ old('image') }}"
                                                            class="form-control mb-2">
                                                        @if ($errors->has('image'))
                                                            <span class="red-text"><?php echo $errors->first('image', ':message'); ?></span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="login-btn-inner">
                                                <div class="row">
                                                    <div class="col-lg-5"></div>
                                                    <div class="col-lg-7">
                                                        <div class="login-horizental cancel-wp pull-left">
                                                            <a href="{{ route('list-icon') }}" class="btn btn-white"
                                                                style="margin-bottom:50px">Cancel</a>
                                                            <button class="btn btn-sm btn-primary login-submit-cs"
                                                                type="submit" style="margin-bottom:50px">Save Icon</button>
                                                        </div>
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
    <script src="js/vendor/jquery-1.11.3.min.js"></script>
    <script src="js/password-meter/pwstrength-bootstrap.min.js"></script>
    <script src="js/password-meter/zxcvbn.js"></script>
    <script src="js/password-meter/password-meter-active.js"></script>

    <script>
        jQuery.noConflict();
        jQuery(document).ready(function($) {
            $("#addDesignsForm").validate({
                rules: {
                    name: {
                        required: true
                    },
                    icon: {
                        required: true
                    },

                },
                messages: {
                    name: {
                        required: "Please Enter Name.",
                    },
                    icon: {
                        required: "Please Enter Icon.",
                    },

                },
            });
        });
    </script>
@endsection
