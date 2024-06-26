@extends('admin.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row paddingbottom">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="sparkline12-list">
                <div class=" " style="display: flex; justify-content:space-between">
                    <h3 class="page-title">Home
                    </h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb" style="background-color: #fff;">
                            <li class="breadcrumb-item"><a href="{{ route('list-home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page"> Home </li>
                        </ol>
                    </nav>
                </div>
                <div class="sparkline12-graph">
                    <div class="basic-login-form-ad">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="all-form-element-inner">
                            <form class="forms-sample" action="{{ route('update-home') }}" method="post" id="regForm"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label for="english_name">Name </label>&nbsp<span class="red-text">*</span>
                                            <input class="form-control" name="english_name" id="english_name"
                                                placeholder="Enter the Name"
                                                value=" @if (old('english_name')) {{ old('english_name') }}@else{{ $home->english_name }} @endif">
                                            <label class="error py-2" for="english_name" id="english_name_error"></label>
                                            @if ($errors->has('english_name'))
                                                <span class="red-text"><?php echo $errors->first('english_name', ':message'); ?></span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label for="hindi_name">नाम</label>&nbsp<span class="red-text">*</span>
                                            <input class="form-control" name="hindi_name" id="hindi_name"
                                                placeholder="नाम दर्ज करें"
                                                value="@if (old('hindi_name')) {{ old('hindi_name') }}@else{{ $home->hindi_name }} @endif">
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
                                            @if (old('english_description')){{ old('english_description') }}@else{{ $home->english_description }}@endif
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
                                                placeholder="विवरण दर्ज करें">
                                            @if (old('hindi_description')){{ old('hindi_description') }}@else{{ $home->hindi_description }}@endif
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
                                            <label for="english_image"> Photo</label>
                                            <input type="file" name="english_image" class="form-control"
                                                id="english_image" accept="image/*" placeholder="image">
                                           
                                        </div>
                                        <img id="english"
                                            src="{{ Config::get('DocumentConstant.HOME_DATA_VIEW') }}{{ $home->english_image }}"
                                            class="img-fluid img-thumbnail" width="150">
                                        <img id="english_imgPreview" src="#" alt="pic"
                                            class="img-fluid img-thumbnail" width="150" style="display:none">
                                            @if ($errors->has('english_image'))
                                            <div class="red-text"><?php echo $errors->first('english_image', ':message'); ?>
                                            </div>
                                        @endif
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <div class="form-group">
                                                <label for="hindi_image"> तस्वीर</label>
                                                <input type="file" name="hindi_image" class="form-control"
                                                    id="hindi_image" accept="image/*" placeholder="image">
                                               
                                            </div>
                                            <img id="hindi_english"
                                                src="{{ Config::get('DocumentConstant.HOME_DATA_VIEW') }}{{ $home->hindi_image }}"
                                                class="img-fluid img-thumbnail" width="150">
                                            <img id="hindi_imgPreview" src="#" alt="pic"
                                                class="img-fluid img-thumbnail" width="150" style="display:none">
                                                @if ($errors->has('hindi_image'))
                                                <div class="red-text"><?php echo $errors->first('hindi_image', ':message'); ?>
                                                </div>
                                            @endif
                                            </div>

                                    <div class="col-md-12 col-sm-12 text-center">
                                        <button type="submit" class="btn btn-sm btn-success" >
                                            Save &amp; Update
                                        </button>
                                        <span><a href="{{ route('list-home') }}"
                                                class="btn btn-sm btn-primary ">Back</a></span>
                                    </div>
                                </div>
                                <input type="hidden" name="id" id="id" class="form-control"
                                    value="{{ $home->id }}" placeholder="">
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
             
                // image: {
                //     required: true,
                //     fileExtension: ["jpg", "jpeg", "png"],
                //     fileSize: [10, 2048],
                // },
                // english_audio_link: {
                //     required: true,
                //     extension: "mp3",
                //     fileSize: [10240, 1048576]
                // },
                // hindi_audio_link: {
                //     required: true,
                //     extension: "mp3",
                //     fileSize: [10240, 1048576]
                // },
                // english_video_upload: {
                //     required: true,
                //     extension: "mp4",
                //     fileSize: [102400, 5242880]
                // },
                // hindi_video_upload: {
                //     required: true,
                //     extension: "mp4",
                //     fileSize: [102400, 5242880]
                // },

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
                    required: "कृपया वर्णन दर्ज करें |",
                },
              
                // image: {
                //     required: "Please upload an Image (JPG, JPEG, PNG).",
                //     fileExtension: "Only JPG, JPEG, and PNG images are allowed.",
                //     fileSize: "File size must be between 10 KB and 2 MB.",
                // },

                // english_audio_link: {
                //     required: "Please upload an Audio file MP3.",
                //     extension: "Only MP3 audio files are allowed.",
                //     fileSize: "File size must be between 10 KB and 1 MB.",
                // },
                // hindi_audio_link: {
                //     required: "कृपया ऑडियो फ़ाइल MP3 अपलोड करें।",
                //     extension: "केवल MP3 ऑडियो फ़ाइलें अनुमत हैं।",
                //     fileSize: "फ़ाइल का आकार 10 KB और 1 MB के बीच होना चाहिए।",
                // },
               
                // english_video_upload: {
                //     required: "Please upload a Video file MP4.",
                //     extension: "Only MP4 video files are allowed.",
                //     fileSize: "File size must be between 100 KB and 5 MB.",
                // },
                // hindi_video_upload: {
                //     required: "कृपया वीडियो फ़ाइल MP4 अपलोड करें।",
                //     extension: "केवल MP4 वीडियो फ़ाइलें अनुमत हैं।",
                //     fileSize: "फ़ाइल का आकार 100 KB और 5 MB के बीच होना चाहिए।",
                // },

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
