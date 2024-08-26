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
                            <h1>Edit Zone Co-Ordinate Data</h1>
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
                                    <form action="{{ route('update-zone-co-ordinate') }}" method="POST"
                                        enctype="multipart/form-data" id="addDesignsForm" autocomplete="off">
                                        @csrf
                                        <div class="form-group-inner">
                                            <input type="hidden" class="form-control"
                                                value="@if (old('id')) {{ old('id') }}@else{{ $editData->id }} @endif"
                                                id="id" name="id">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label for="colour_picker"> Name:</label>
                                                    <input type="text" class="form-control"
                                                        value="@if (old('colour_picker')) {{ old('colour_picker') }}@else{{ $editData->colour_picker }} @endif"
                                                        id="colour_picker" name="colour_picker"
                                                        placeholder="Enter colour picker">
                                                    @if ($errors->has('colour_picker'))
                                                        <span class="red-text"><?php echo $errors->first('colour_picker', ':message'); ?></span>
                                                    @endif
                                                </div>

                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="image"> Image</label>
                                                        <input type="file" name="image" class="form-control"
                                                            id="image" accept=".kml" placeholder="image">

                                                    </div>
                                                    @if ($errors->has('image'))
                                                        <div class="red-text"><?php echo $errors->first('image', ':message'); ?>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>


                                            <div class="login-btn-inner">
                                                <div class="row">
                                                    <div class="col-lg-5"></div>
                                                    <div class="col-lg-7">
                                                        <div class="login-horizental cancel-wp pull-left">
                                                            <a href="{{ route('list-zone-co-ordinate') }}">
                                                                <button class="btn btn-white"
                                                                    style="margin-bottom:50px">Cancel</button>
                                                            </a>
                                                            <button class="btn btn-sm btn-primary login-submit-cs"
                                                                type="submit" style="margin-bottom:50px">Update Zone Co-Ordinate</button>
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
             colour_picker: {
                 required: true
             },
             kml_file: {
                 required: true,
                 fileExtension: "kml",
                 fileSize: [1, 2048], // File size in KB
             },
 
         },
         messages: {
             colour_picker: {
                 required: "Please enter a color picker.",
             },
             kml_file: {
                 required: "Please upload a KML file.",
                 fileExtension: "Only KML files are allowed.",
                 fileSize: "File size must be between 1 KB and 2 MB.",
             },
         },
     });
 });
 
     </script>
@endsection
