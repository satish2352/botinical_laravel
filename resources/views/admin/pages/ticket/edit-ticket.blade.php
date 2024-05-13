@extends('admin.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row paddingbottom">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="sparkline12-list">
                <div class=" " style="display: flex; justify-content:space-between">
                    <h3 class="page-title">Ticket
                    </h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb" style="background-color: #fff;">
                            <li class="breadcrumb-item"><a href="{{ route('list-ticket') }}">Ticket</a></li>
                            <li class="breadcrumb-item active" aria-current="page"> Ticket </li>
                        </ol>
                    </nav>
                </div>
                <div class="sparkline12-graph">
                    <div class="basic-login-form-ad">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="all-form-element-inner">
                            <form class="forms-sample" action="{{ route('update-ticket') }}" method="post" id="regForm"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label for="name">Name </label>&nbsp<span class="red-text">*</span>
                                            <input class="form-control" name="name" id="name"
                                                placeholder="Enter the Name"
                                                value=" @if (old('name')) {{ old('name') }}@else{{ $ticket->name }} @endif">
                                            <label class="error py-2" for="name" id="name_error"></label>
                                            @if ($errors->has('name'))
                                                <span class="red-text"><?php echo $errors->first('name', ':message'); ?></span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label for="ticket_cost">Ticket Cost</label>&nbsp<span class="red-text">*</span>
                                            <input class="form-control" name="ticket_cost" id="ticket_cost"
                                                placeholder="नाम दर्ज करें"
                                                value="@if (old('ticket_cost')) {{ old('ticket_cost') }}@else{{ $ticket->ticket_cost }} @endif">
                                            <label class="error py-2" for="ticket_cost" id="ticket_cost_error"></label>
                                            @if ($errors->has('ticket_cost'))
                                                <span class="red-text"><?php echo $errors->first('ticket_cost', ':message'); ?></span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label for="rules_terms">Rules Terms</label>&nbsp<span class="red-text">*</span>
                                            <input class="form-control" name="rules_terms" id="rules_terms"
                                                placeholder="नाम दर्ज करें"
                                                value="@if (old('rules_terms')) {{ old('rules_terms') }}@else{{ $ticket->rules_terms }} @endif">
                                            <label class="error py-2" for="rules_terms" id="rules_terms_error"></label>
                                            @if ($errors->has('rules_terms'))
                                                <span class="red-text"><?php echo $errors->first('rules_terms', ':message'); ?></span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label for="description">Description</label>&nbsp<span
                                                class="red-text">*</span>
                                            <textarea class="form-control english_description" name="description" id="description"
                                                placeholder="Enter the Description">
                                                <label class="error py-2" for="description" id="description_error"></label>
                                            @if (old('description')){{ old('description') }}@else{{ $ticket->description }}@endif
                                            </textarea>
                                            @if ($errors->has('description'))
                                                <span class="red-text"><?php echo $errors->first('description', ':message'); ?></span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 text-center">
                                        <button type="submit" class="btn btn-sm btn-success" >
                                            Save &amp; Update
                                        </button>
                                        <span><a href="{{ route('list-ticket') }}"
                                                class="btn btn-sm btn-primary ">Back</a></span>
                                    </div>
                                </div>
                                <input type="hidden" name="id" id="id" class="form-control"
                                    value="{{ $ticket->id }}" placeholder="">
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
{{-- <script>
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
                latitude: {
                    required: "Please enter the Latitude.",
                },
                longitude: {
                    required: "Please enter the Longitude.",
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
</script>     --}}
    @endsection
