@extends('admin.layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row paddingbottom">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="sparkline12-list">
                    <div class=" " style="display: flex; justify-content:space-between">
                        <h3 class="page-title">About Us Element
                        </h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb" style="background-color: #fff;">
                                <li class="breadcrumb-item"><a href="{{ route('list-aboutus-element') }}">About Us Element</a></li>
                                <li class="breadcrumb-item active" aria-current="page"> About Us Element</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="sparkline12-graph">
                        <div class="basic-login-form-ad">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="all-form-element-inner">
                                        <form class="forms-sample" action="{{ route('store-aboutus-element') }}" method="POST"
                                            enctype="multipart/form-data" id="regForm">
                                            @csrf
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="english_name">Name</label>&nbsp<span
                                                            class="red-text">*</span>
                                                        <input class="form-control mb-2" name="english_name"
                                                            id="english_name" placeholder="Enter the Name"
                                                            name="english_name" value="{{ old('english_name') }}">
                                                        @if ($errors->has('english_name'))
                                                            <span class="red-text"><?php echo $errors->first('english_name', ':message'); ?></span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="hindi_name">नाम </label>&nbsp<span
                                                            class="red-text">*</span>
                                                        <input class="form-control mb-2" name="hindi_name" id="hindi_name"
                                                            placeholder="नाम दर्ज करें" name="hindi_name"
                                                            value="{{ old('hindi_name') }}">
                                                        @if ($errors->has('hindi_name'))
                                                            <span class="red-text"><?php echo $errors->first('hindi_name', ':message'); ?></span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="english_description">Description</label>&nbsp<span
                                                            class="red-text">*</span>
                                                        <textarea class="form-control english_description" name="english_description" id="english_description"
                                                            placeholder="Enter the Description" name="description">{{ old('english_description') }}</textarea>
                                                        @if ($errors->has('english_description'))
                                                            <span class="red-text"><?php echo $errors->first('english_description', ':message'); ?></span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="hindi_description"> वर्णन </label>&nbsp<span
                                                            class="red-text">*</span>
                                                        <textarea class="form-control hindi_description" name="hindi_description" id="hindi_description"
                                                            placeholder="विवरण दर्ज करें ">{{ old('hindi_description') }}</textarea>
                                                        @if ($errors->has('hindi_description'))
                                                            <span class="red-text"><?php echo $errors->first('hindi_description', ':message'); ?></span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="open_time">Open Time </label>&nbsp<span
                                                            class="red-text">*</span>
                                                        <input type="time" class="form-control mb-2" id="open_time" name="open_time"
                                                            id="open_time" placeholder="Enter the Name"
                                                            name="open_time" value="{{ old('open_time') }}">
                                                        @if ($errors->has('open_time'))
                                                            <span class="red-text"><?php echo $errors->first('open_time', ':message'); ?></span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="close_time">Close Time </label>&nbsp<span
                                                            class="red-text">*</span>
                                                        <input type="time" class="form-control mb-2" name="close_time"
                                                            id="close_time" placeholder="Enter the Name"
                                                            name="close_time" value="{{ old('close_time') }}">
                                                        @if ($errors->has('close_time'))
                                                            <span class="red-text"><?php echo $errors->first('close_time', ':message'); ?></span>
                                                        @endif
                                                    </div>
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
                                                <div class="col-md-12 col-sm-12 text-center">
                                                    <button type="submit" class="btn btn-sm btn-success">
                                                        Save &amp; Submit
                                                    </button>
                                                    {{-- <button type="reset" class="btn btn-sm btn-danger">Cancel</button> --}}
                                                    <span><a href="{{ route('list-aboutus-element') }}"
                                                            class="btn btn-sm btn-primary ">Back</a></span>
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
    <script>
        jQuery.noConflict();
        jQuery(document).ready(function($) {
            $("#regForm").validate({
                rules: {
                    english_name: {
                        required: true
                    },
                    hindi_name: {
                        required: true,
                    },
                    english_description: {
                        required: true
                    },
                    hindi_description: {
                        required: true,
                    },
                    latitude: {
                        required: true,
                    },
                    longitude: {
                        required: true,
                    },
                    open_time: {
                        required: true,
                    },
                    close_time: {
                        required: true,
                    },
                    image: {
                        required: true,
                        fileExtension: ["jpg", "jpeg", "png"],
                        fileSize: [10, 2048],
                    },
                    english_audio_link: {
                        required: true,
                        extension: "mp3",
                        fileSize: [10240, 1048576]
                    },
                    hindi_audio_link: {
                        required: true,
                        extension: "mp3",
                        fileSize: [10240, 1048576]
                    },
                    english_video_upload: {
                        required: true,
                        extension: "mp4",
                        fileSize: [102400, 5242880]
                    },
                    hindi_video_upload: {
                        required: true,
                        extension: "mp4",
                        fileSize: [102400, 5242880]
                    },

                },
                messages: {
                    english_name: {
                        required: "Please Enter Name.",
                    },
                    hindi_name: {
                        required: "कृपया नाम दर्ज करें |",
                    },
                    english_description: {
                        required: "Please Enter Description.",
                    },
                    hindi_description: {
                        required: "कृपया वर्णन दर्ज करें.",
                    },
                    latitude: {
                        required: "Please enter the Latitude.",
                    },
                    longitude: {
                        required: "Please enter the Longitude.",
                    },
                    open_time: {
                        required: "Please select open time.",
                    },
                    close_time: {
                        required: "Please select close time.",
                    },
                    image: {
                        required: "Please upload an Image (JPG, JPEG, PNG).",
                        fileExtension: "Only JPG, JPEG, and PNG images are allowed.",
                        fileSize: "File size must be between 10 KB and 2 MB.",
                    },

                    english_audio_link: {
                        required: "Please upload an Audio file MP3.",
                        extension: "Only MP3 audio files are allowed.",
                        fileSize: "File size must be between 10 KB and 1 MB.",
                    },
                    hindi_audio_link: {
                        required: "कृपया ऑडियो फ़ाइल MP3 अपलोड करें।",
                        extension: "केवल MP3 ऑडियो फ़ाइलें अनुमत हैं।",
                        fileSize: "फ़ाइल का आकार 10 KB और 1 MB के बीच होना चाहिए।",
                    },
                   
                    english_video_upload: {
                        required: "Please upload a Video file MP4.",
                        extension: "Only MP4 video files are allowed.",
                        fileSize: "File size must be between 100 KB and 5 MB.",
                    },
                    hindi_video_upload: {
                        required: "कृपया वीडियो फ़ाइल MP4 अपलोड करें।",
                        extension: "केवल MP4 वीडियो फ़ाइलें अनुमत हैं।",
                        fileSize: "फ़ाइल का आकार 100 KB और 5 MB के बीच होना चाहिए।",
                    },

                },
            });

             // Event listener for file inputs to remove validation messages
             $('input[type="file"]').change(function() {
                var input = $(this);
                var fieldName = input.attr('name');
                var errorLabel = $('label.error[for="' + fieldName + '"]');
                errorLabel.remove();
            });
        });
    </script>
@endsection
