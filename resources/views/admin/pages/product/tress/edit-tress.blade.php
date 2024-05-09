@extends('admin.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="sparkline12-list">
                <div class=" " style="display: flex; justify-content:space-between">
                    <h3 class="page-title">Tress
                    </h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb" style="background-color: #fff;">
                            <li class="breadcrumb-item"><a href="{{ route('list-tress') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page"> Tress </li>
                        </ol>
                    </nav>
                </div>
                <div class="sparkline12-graph">
                    <div class="basic-login-form-ad">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="all-form-element-inner">
                            <form class="forms-sample" action="{{ route('update-tress') }}" method="post" id="regForm"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label for="english_name">Name </label>&nbsp<span class="red-text">*</span>
                                            <input class="form-control" name="english_name" id="english_name"
                                                placeholder="Enter the name"
                                                value=" @if (old('english_name')) {{ old('english_name') }}@else{{ $tress->english_name }} @endif">
                                            <label class="error py-2" for="english_name" id="english_name_error"></label>
                                            @if ($errors->has('english_name'))
                                                <span class="red-text"><?php echo $errors->first('english_name', ':message'); ?></span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label for="hindi_name">शीर्षक</label>&nbsp<span class="red-text">*</span>
                                            <input class="form-control" name="hindi_name" id="hindi_name"
                                                placeholder="Enter the Title"
                                                value="@if (old('hindi_name')) {{ old('hindi_name') }}@else{{ $tress->hindi_name }} @endif">
                                            <label class="error py-2" for="hindi_name" id="hindi_name_error"></label>
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
                                                placeholder="Enter the Description">
                                                <label class="error py-2" for="english_description" id="english_description_error"></label>
                                            @if (old('english_description'))
{{ old('english_description') }}@else{{ $tress->english_description }}
@endif
                                            </textarea>
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
                                                placeholder="वर्णन प्रविष्ट करा">
                                            @if (old('hindi_description'))
{{ old('hindi_description') }}@else{{ $tress->hindi_description }}
@endif
                                            </textarea>
                                            <label class="error py-2" for="english_description"
                                                id="english_description_error"></label>

                                            <label class="error py-2" for="hindi_description"
                                                id="hindi_description_error"></label>
                                            @if ($errors->has('hindi_description'))
                                                <span class="red-text"><?php echo $errors->first('hindi_description', ':message'); ?></span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label for="english_image"> Image</label>
                                            <input type="file" name="english_image" class="form-control"
                                                id="english_image" accept="image/*" placeholder="image">
                                            @if ($errors->has('english_image'))
                                                <div class="red-text"><?php echo $errors->first('english_image', ':message'); ?>
                                                </div>
                                            @endif
                                        </div>
                                        <img id="english"
                                            src="{{ Config::get('DocumentConstant.TRESS_VIEW') }}{{ $tress->image }}"
                                            class="img-fluid img-thumbnail" width="150">
                                        <img id="english_imgPreview" src="#" alt="pic"
                                            class="img-fluid img-thumbnail" width="150" style="display:none">
                                    </div>


                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label for="english_audio_link">Audio Upload </label>&nbsp<span
                                                class="red-text">*</span><br>
                                            <input type="file" name="english_audio_link"
                                                id="english_audio_link" accept="audio/*"
                                                value="{{ old('english_audio_link') }}"
                                                class="form-control mb-2">
                                            @if ($errors->has('english_audio_link'))
                                                <span class="red-text"><?php echo $errors->first('english_audio_link', ':message'); ?></span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label for="hindi_audio_link">ऑडियो अपलोड </label>&nbsp<span
                                                class="red-text">*</span><br>
                                            <input type="file" name="hindi_audio_link" id="hindi_audio_link"
                                                accept="audio/*" value="{{ old('hindi_audio_link') }}"
                                                class="form-control mb-2">
                                            @if ($errors->has('hindi_audio_link'))
                                                <span class="red-text"><?php echo $errors->first('hindi_audio_link', ':message'); ?></span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label for="english_video_upload">Video Upload </label>&nbsp<span
                                                class="red-text">*</span><br>
                                            <input type="file" name="english_video_upload"
                                                id="english_video_upload" accept="video/*"
                                                value="{{ old('english_video_upload') }}"
                                                class="form-control mb-2">
                                            @if ($errors->has('english_video_upload'))
                                                <span class="red-text"><?php echo $errors->first('english_video_upload', ':message'); ?></span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label for="hindi_video_upload">वीडियो अपलोड </label>&nbsp<span
                                                class="red-text">*</span><br>
                                            <input type="file" name="hindi_video_upload"
                                                id="hindi_video_upload" accept="video/*"
                                                value="{{ old('hindi_video_upload') }}"
                                                class="form-control mb-2">
                                            @if ($errors->has('hindi_video_upload'))
                                                <span class="red-text"><?php echo $errors->first('hindi_video_upload', ':message'); ?></span>
                                            @endif
                                        </div>
                                    </div>
                                    



                               
                                  
                                    <div class="col-md-12 col-sm-12 text-center">
                                        <button type="submit" class="btn btn-sm btn-success" >
                                            Save &amp; Update
                                        </button>
                                        {{-- <button type="reset" class="btn btn-sm btn-danger">Cancel</button> --}}
                                        <span><a href="{{ route('list-tress') }}"
                                                class="btn btn-sm btn-primary ">Back</a></span>
                                    </div>
                                </div>
                                <input type="hidden" name="id" id="id" class="form-control"
                                    value="{{ $tress->id }}" placeholder="">

                                {{-- <input type="text" name="currentMarathiImage" id="currentMarathiImage"
                                    class="form-control" value="" placeholder=""> --}}



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
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
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
                    required: "कृपया शीर्षक प्रविष्ट करा.",
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
    });
</script>    
    @endsection
