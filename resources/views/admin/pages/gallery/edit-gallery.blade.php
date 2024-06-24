@extends('admin.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row paddingbottom">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="sparkline12-list">
                <div class=" " style="display: flex; justify-content:space-between">
                    <h3 class="page-title">Gallery
                    </h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb" style="background-color: #fff;">
                            <li class="breadcrumb-item"><a href="{{ route('list-gallery') }}">Gallery</a></li>
                            <li class="breadcrumb-item active" aria-current="page"> Gallery </li>
                        </ol>
                    </nav>
                </div>
                <div class="sparkline12-graph">
                    <div class="basic-login-form-ad">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="all-form-element-inner">
                            <form class="forms-sample" action="{{ route('update-gallery') }}" method="post" id="regForm"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label for="gallery_category_id">Category:</label> &nbsp<span
                                                class="red-text">*</span>
                                            <select class="form-control mb-2" name="gallery_category_id"
                                                id="gallery_category_id">
                                                <option value="" default>Select Category</option>
                                                @foreach ($dataOutputCategory as $service)
                                                    <option value="{{ $service->id }}"
                                                        @if ($gallery->gallery_category_id == $service->id) {{ 'selected' }} @endif>
                                                        {{ $service->english_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('gallery_category_id'))
                                                <span class="red-text">
                                                    <?php echo $errors->first('gallery_category_id', ':message'); ?>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                       <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label for="image"> Image</label>
                                            <input type="file" name="image" class="form-control"
                                                id="image" accept="image/*" placeholder="image">
                                           
                                        </div>
                                        <img id="english"
                                            src="{{ Config::get('DocumentConstant.GALLERY_VIEW') }}{{ $gallery->image }}"
                                            class="img-fluid img-thumbnail" width="150">
                                        <img id="english_imgPreview" src="#" alt="pic"
                                            class="img-fluid img-thumbnail" width="150" style="display:none">
                                            @if ($errors->has('image'))
                                            <div class="red-text"><?php echo $errors->first('image', ':message'); ?>
                                            </div>
                                        @endif
                                        </div>
                                    <div class="col-md-12 col-sm-12 text-center">
                                        <button type="submit" class="btn btn-sm btn-success" >
                                            Save &amp; Update
                                        </button>
                                        <span><a href="{{ route('list-gallery') }}"
                                                class="btn btn-sm btn-primary ">Back</a></span>
                                    </div>
                                </div>
                                <input type="hidden" name="id" id="id" class="form-control"
                                    value="{{ $gallery->id }}" placeholder="">
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
