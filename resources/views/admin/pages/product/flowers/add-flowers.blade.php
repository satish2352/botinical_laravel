@extends('admin.layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row paddingbottom">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="sparkline12-list">
                    <div class=" " style="display: flex; justify-content:space-between">
                        <h3 class="page-title">Plant
                        </h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb" style="background-color: #fff;">
                                <li class="breadcrumb-item"><a href="{{ route('list-flowers') }}">Plant</a></li>
                                <li class="breadcrumb-item active" aria-current="page"> Plant </li>
                            </ol>
                        </nav>
                    </div>
                    <div class="sparkline12-graph">
                        <div class="basic-login-form-ad">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="all-form-element-inner">
                                        <form class="forms-sample" action="{{ route('store-flowers') }}" method="POST"
                                            enctype="multipart/form-data" id="regForm">
                                            @csrf
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="tree_plant_id">Name</label>&nbsp;<span class="red-text">*</span>
                                                        <select class="form-control" id="tree_plant_id" name="tree_plant_id">
                                                            <option value="">Select</option>
                                                            @foreach ($dataOutputTreePlant as $data)
                                                                <option value="{{ $data['id'] }}">{{ $data['english_name'] }}</option>
                                                            @endforeach
                                                        </select>
                                                        @if ($errors->has('tree_plant_id'))
                                                            <span class="red-text">{{ $errors->first('tree_plant_id', ':message') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="hindi_name">नाम </label>&nbsp<span
                                                            class="red-text">*</span>
                                                        <input class="form-control mb-2" name="hindi_name" id="hindi_name"
                                                            placeholder="नाम दर्ज करें" name="hindi_name"
                                                            value="{{ old('hindi_name') }}" readonly>
                                                        @if ($errors->has('hindi_name'))
                                                            <span class="red-text"><?php echo $errors->first('hindi_name', ':message'); ?></span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="english_botnical_name">Botnical Name</label>&nbsp<span
                                                            class="red-text">*</span>
                                                        <input class="form-control mb-2" name="english_botnical_name"
                                                            id="english_botnical_name" placeholder="Enter the Name"
                                                            name="english_botnical_name"
                                                            value="{{ old('english_botnical_name') }}" readonly>
                                                        @if ($errors->has('english_botnical_name'))
                                                            <span class="red-text"><?php echo $errors->first('english_botnical_name', ':message'); ?></span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="hindi_botnical_name">वानस्पतिक नाम </label>&nbsp<span
                                                            class="red-text">*</span>
                                                        <input class="form-control mb-2" name="hindi_botnical_name"
                                                            id="hindi_botnical_name" placeholder="वानस्पतिक नाम दर्ज करें"
                                                            name="hindi_botnical_name"
                                                            value="{{ old('hindi_botnical_name') }}" readonly>
                                                        @if ($errors->has('hindi_botnical_name'))
                                                            <span class="red-text"><?php echo $errors->first('hindi_botnical_name', ':message'); ?></span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="english_common_name">Common Name</label>&nbsp<span
                                                            class="red-text">*</span>
                                                        <input class="form-control mb-2" name="english_common_name"
                                                            id="english_common_name" placeholder="Enter the Name"
                                                            name="english_common_name"
                                                            value="{{ old('english_common_name') }}" readonly>
                                                        @if ($errors->has('english_common_name'))
                                                            <span class="red-text"><?php echo $errors->first('english_common_name', ':message'); ?></span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="hindi_common_name">साधारण नाम </label>&nbsp<span
                                                            class="red-text">*</span>
                                                        <input class="form-control mb-2" name="hindi_common_name"
                                                            id="hindi_common_name" placeholder="साधारण नाम दर्ज करें"
                                                            name="hindi_common_name" value="{{ old('hindi_common_name') }}" readonly>
                                                        @if ($errors->has('hindi_common_name'))
                                                            <span class="red-text"><?php echo $errors->first('hindi_common_name', ':message'); ?></span>
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
                                                        <input type="file" name="hindi_audio_link"
                                                            id="hindi_audio_link" accept="audio/*"
                                                            value="{{ old('hindi_audio_link') }}"
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
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="latitude">Latitude</label>&nbsp<span
                                                            class="red-text">*</span>
                                                        <input class="form-control mb-2" name="latitude" id="latitude"
                                                            placeholder="Enter the Latitude" name="latitude"
                                                            value="{{ old('latitude') }}">
                                                        @if ($errors->has('latitude'))
                                                            <span class="red-text"><?php echo $errors->first('latitude', ':message'); ?></span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="longitude">Longitude</label>&nbsp<span
                                                            class="red-text">*</span>
                                                        <input class="form-control mb-2" name="longitude" id="longitude"
                                                            placeholder="Enter the Longitude" name="longitude"
                                                            value="{{ old('longitude') }}">
                                                        @if ($errors->has('longitude'))
                                                            <span class="red-text"><?php echo $errors->first('longitude', ':message'); ?></span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="icon_id">Icon</label>&nbsp<span class="red-text">*</span>
                                                        <select class="form-control" id="icon_id" name="icon_id">
                                                            <option>Select</option>
                                                            @foreach ($dataOutputIcon as $data)
                                                                @if (old('icon_id') == $data['id'])
                                                                    <option value="{{ $data['id'] }}" data-image="{{ Config::get('DocumentConstant.ICON_MASTER_VIEW') }}{{ $data->image }}" selected>
                                                                        {{ strip_tags($data['name']) }}
                                                                    </option>
                                                                @else
                                                                    <option value="{{ $data['id'] }}" data-image="{{ Config::get('DocumentConstant.ICON_MASTER_VIEW') }}{{ $data->image }}">
                                                                        {{ strip_tags($data['name']) }}
                                                                    </option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                        @if ($errors->has('icon_id'))
                                                        <span class="red-text"><?php echo $errors->first('icon_id', ':message'); ?></span>
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
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="image_two">Image </label> (optional)<br>
                                                        <input type="file" name="image_two" id="image_two"
                                                            accept="image_two/*" value="{{ old('image_two') }}"
                                                            class="form-control mb-2">
                                                        @if ($errors->has('image_two'))
                                                            <span class="red-text"><?php echo $errors->first('image_two', ':message'); ?></span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="image_three">Image </label> (optional)<br>
                                                        <input type="file" name="image_three" id="image_three"
                                                            accept="image_three/*" value="{{ old('image_three') }}"
                                                            class="form-control mb-2">
                                                        @if ($errors->has('image_three'))
                                                            <span class="red-text"><?php echo $errors->first('image_three', ':message'); ?></span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="image_four">Image </label> (optional)<br>
                                                        <input type="file" name="image_four" id="image_four"
                                                            accept="image_four/*" value="{{ old('image_four') }}"
                                                            class="form-control mb-2">
                                                        @if ($errors->has('image_four'))
                                                            <span class="red-text"><?php echo $errors->first('image_four', ':message'); ?></span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="image_five">Image </label> (optional)<br>
                                                        <input type="file" name="image_five" id="image_five"
                                                            accept="image_five/*" value="{{ old('image_five') }}"
                                                            class="form-control mb-2">
                                                        @if ($errors->has('image_five'))
                                                            <span class="red-text"><?php echo $errors->first('image_five', ':message'); ?></span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="height">Height</label>&nbsp<span
                                                            class="red-text">*</span>
                                                        <input class="form-control mb-2" name="height"
                                                            id="height" placeholder="Enter the Height"
                                                            name="height" value="{{ old('height') }}">
                                                        @if ($errors->has('height'))
                                                            <span class="red-text"><?php echo $errors->first('height', ':message'); ?></span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="height_type">Height Type</label>&nbsp;<span class="red-text">*</span>
                                                        <select class="form-control" id="height_type" name="height_type">
                                                            <option value="" disabled {{ old('height_type') == '' ? 'selected' : '' }}>Select Height Type</option>
                                                            <option value="feet" {{ old('height_type') == 'feet' ? 'selected' : '' }}>Feet</option>
                                                            <option value="cm" {{ old('height_type') == 'cm' ? 'selected' : '' }}>CM</option>
                                                        </select>
                                                        @if ($errors->has('height_type'))
                                                        <span class="red-text"><?php echo $errors->first('height_type', ':message'); ?></span>
                                                    @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="canopy">Canopy</label>&nbsp<span
                                                            class="red-text">*</span>
                                                        <input class="form-control mb-2" name="canopy"
                                                            id="canopy" placeholder="Enter the canopy"
                                                            name="canopy" value="{{ old('canopy') }}">
                                                        @if ($errors->has('canopy'))
                                                            <span class="red-text"><?php echo $errors->first('canopy', ':message'); ?></span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="canopy_type">Canopy Type</label>&nbsp;<span class="red-text">*</span>
                                                        <select class="form-control" id="canopy_type" name="canopy_type">
                                                            <option value="" disabled {{ old('height_type') == '' ? 'selected' : '' }}>Select Height Type</option>
                                                            <option value="feet" {{ old('height_type') == 'feet' ? 'selected' : '' }}>Feet</option>
                                                            <option value="cm" {{ old('height_type') == 'cm' ? 'selected' : '' }}>CM</option>
                                                        </select>
                                                        @if ($errors->has('canopy_type'))
                                                        <span class="red-text"><?php echo $errors->first('canopy_type', ':message'); ?></span>
                                                    @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="girth">Girth</label>&nbsp<span
                                                            class="red-text">*</span>
                                                        <input class="form-control mb-2" name="girth"
                                                            id="girth" placeholder="Enter the girth"
                                                            name="girth" value="{{ old('girth') }}">
                                                        @if ($errors->has('girth'))
                                                            <span class="red-text"><?php echo $errors->first('canopy', ':message'); ?></span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="girth_type">Girth Type</label>&nbsp;<span class="red-text">*</span>
                                                        <select class="form-control" id="girth_type" name="girth_type">
                                                            <option value="" disabled {{ old('height_type') == '' ? 'selected' : '' }}>Select Height Type</option>
                                                            <option value="feet" {{ old('height_type') == 'feet' ? 'selected' : '' }}>Feet</option>
                                                            <option value="cm" {{ old('height_type') == 'cm' ? 'selected' : '' }}>CM</option>
                                                        </select>
                                                        @if ($errors->has('girth_type'))
                                                        <span class="red-text"><?php echo $errors->first('girth_type', ':message'); ?></span>
                                                    @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-sm-12 text-center">
                                                    <button type="submit" class="btn btn-sm btn-success">
                                                        Save &amp; Submit
                                                    </button>
                                                    {{-- <button type="reset" class="btn btn-sm btn-danger">Cancel</button> --}}
                                                    <span><a href="{{ route('list-flowers') }}"
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
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script>
    $(document).ready(function() {
        $('#tree_plant_id').change(function(e) {
            e.preventDefault();
            var treePlantId = $(this).val();
            $('#hindi_name').val(''); // Clear the current value
            $('#english_botnical_name').val(''); // Clear the current value
            $('#hindi_botnical_name').val(''); // Clear the current value
            $('#english_common_name').val(''); // Clear the current value
            $('#hindi_common_name').val(''); // Clear the current value

            if (treePlantId !== '') {
                $.ajax({
                    url: "{{ url('/search-tree') }}/" + treePlantId, // Include id in URL
                    type: 'GET',
                    success: function(response) {
                        console.log(response);
                        if (response && response.english_botnical_name && response.hindi_name && response.hindi_botnical_name && response.english_common_name && response.hindi_common_name) { // Match JSON key
                            $('#hindi_name').val(response.hindi_name);
                            $('#english_botnical_name').val(response.english_botnical_name);
                            $('#hindi_botnical_name').val(response.hindi_botnical_name);
                            $('#english_common_name').val(response.english_common_name);
                            $('#hindi_common_name').val(response.hindi_common_name);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error: ', status, error);
                    }
                });
            }
        });
    });
</script>
    <script>
        jQuery.noConflict();
        jQuery(document).ready(function($) {
            $("#regForm").validate({
                rules: {
                    tree_plant_id: {
                    required: true
                },
                    english_name: {
                        required: true
                    },
                    hindi_name: {
                        required: true,
                    },
                    english_botnical_name: {
                        required: true
                    },
                    hindi_botnical_name: {
                        required: true,
                    },
                    english_common_name: {
                        required: true
                    },
                    hindi_common_name: {
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
                    icon_id:{
                        required: true,
                    },
                    height:{
                        required: true,
                    },
                    height_type:{
                        required: true,
                    },
                    canopy:{
                        required: true,
                    },
                    canopy_type:{
                        required: true,
                    },
                    girth:{
                        required: true,
                    },
                    girth_type:{
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
                    tree_plant_id: {
                    required: "Please select the tree plant."
                    },
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
                        required: "कृपया वानस्पतिक नाम दर्ज करें. |",
                    },
                    english_common_name: {
                        required: "Please Enter Common Name.",
                    },
                    hindi_common_name: {
                        required: "कृपया सामान्य नाम दर्ज करें. |",
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
                    icon_id: {
                        required: "Please select the Icon.",
                    },
                    height: {
                        required: "Please enter the height.",
                    },
                    height_type: {
                        required: "Please select the height type.",
                    },
                    canopy:{
                        required: "Please enter the canopy.",
                    },
                    canopy_type:{
                        required: "Please select the canopy type.",
                    },
                    girth:{
                        required: "Please enter the girth.",
                    },
                    girth_type:{
                        required: "Please select the girth type.",
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
