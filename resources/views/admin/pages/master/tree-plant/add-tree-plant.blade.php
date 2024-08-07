@extends('admin.layouts.master')
@section('content')
    <style>
        label {
            /* margin-top: 20px; */
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
                            <h1>Add Tree Plant</h1>
                        </center>
                    </div>
                </div>
                <div class="sparkline12-graph">
                    <div class="basic-login-form-ad">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="all-form-element-inner">
                                    <form action="{{ route('store-tree-plant') }}" method="POST" id="addDesignsForm"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group-inner">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label for="english_name">Name :</label>
                                                    <input type="text" class="form-control" id="english_name"
                                                        name="english_name" placeholder="Enter name">
                                                    @if ($errors->has('english_name'))
                                                        <span class="red-text"><?php echo $errors->first('english_name', ':message'); ?></span>
                                                    @endif
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label for="hindi_name">नाम :</label>
                                                    <input type="text" class="form-control" id="hindi_name"
                                                        name="hindi_name" placeholder="नाम दर्ज करें">
                                                    @if ($errors->has('hindi_name'))
                                                        <span class="red-text"><?php echo $errors->first('hindi_name', ':message'); ?></span>
                                                    @endif
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label for="english_botnical_name">Botnical Name :</label>
                                                    <input type="text" class="form-control" id="english_botnical_name"
                                                        name="english_botnical_name" placeholder="Enter the botnical name">
                                                    @if ($errors->has('english_botnical_name'))
                                                        <span class="red-text"><?php echo $errors->first('english_botnical_name', ':message'); ?></span>
                                                    @endif
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label for="hindi_botnical_name">वानस्पतिक नाम :</label>
                                                    <input type="text" class="form-control" id="hindi_botnical_name"
                                                        name="hindi_botnical_name" placeholder="वानस्पतिक नाम दर्ज करें">
                                                    @if ($errors->has('hindi_botnical_name'))
                                                        <span class="red-text"><?php echo $errors->first('hindi_botnical_name', ':message'); ?></span>
                                                    @endif
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label for="english_common_name">Common Name :</label>
                                                    <input type="text" class="form-control" id="english_common_name"
                                                        name="english_common_name" placeholder="Enter the common name">
                                                    @if ($errors->has('english_common_name'))
                                                        <span class="red-text"><?php echo $errors->first('english_common_name', ':message'); ?></span>
                                                    @endif
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label for="hindi_common_name">साधारण नाम :</label>
                                                    <input type="text" class="form-control" id="hindi_common_name"
                                                        name="hindi_common_name" placeholder="साधारण नाम दर्ज करें">
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
                                                            <a href="{{ route('list-tree-plant') }}" class="btn btn-white"
                                                                style="margin-bottom:50px">Cancel</a>
                                                            <button class="btn btn-sm btn-primary login-submit-cs"
                                                                type="submit" style="margin-bottom:50px">Save Category</button>
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
