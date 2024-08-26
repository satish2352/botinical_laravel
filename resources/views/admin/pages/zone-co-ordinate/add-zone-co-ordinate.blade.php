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
                            <h1>Add Zone Co-Ordinate</h1>
                        </center>
                    </div>
                </div>
                <div class="sparkline12-graph">
                    <div class="basic-login-form-ad">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="all-form-element-inner">
                                    <form action="{{ route('store-zone-co-ordinate') }}" method="POST" id="addDesignsForm"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group-inner">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label for="colour_picker">Color Picker :</label>
                                                    <input type="color" class="form-control" id="colour_picker"
                                                        name="colour_picker" placeholder="Enter colour_picker">
                                                    @if ($errors->has('colour_picker'))
                                                        <span class="red-text"><?php echo $errors->first('colour_picker', ':message'); ?></span>
                                                    @endif
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="image">Upload KML File </label>&nbsp<span class="red-text">*</span><br>
                                                        <input type="file" name="image" id="kml_file"
                                                            accept=".kml" value="{{ old('image') }}"
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
                                                            <a href="{{ route('list-zone-co-ordinate') }}" class="btn btn-white"
                                                                style="margin-bottom:50px">Cancel</a>
                                                            <button class="btn btn-sm btn-primary login-submit-cs"
                                                                type="submit" style="margin-bottom:50px">Save Zone Co-Ordinate</button>
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
