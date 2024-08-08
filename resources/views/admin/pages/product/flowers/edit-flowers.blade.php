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
                                        <form class="forms-sample" action="{{ route('update-flowers') }}" method="post"
                                            id="regForm" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="tree_plant_id">Name :</label> &nbsp<span
                                                            class="red-text">*</span>
                                                        <select class="form-control mb-2" name="tree_plant_id"
                                                            id="tree_plant_id">
                                                            <option value="" default>Select Category</option>
                                                            @foreach ($dataOutputTreePlant as $data)
                                                                <option value="{{ $data->id }}"
                                                                    @if ($flowers->tree_plant_id == $data->id) {{ 'selected' }} @endif>
                                                                    {{ $data->english_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @if ($errors->has('tree_plant_id'))
                                                            <span class="red-text">
                                                                <?php echo $errors->first('tree_plant_id', ':message'); ?>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="hindi_name">नाम</label>&nbsp<span
                                                            class="red-text">*</span>
                                                        <input class="form-control" name="hindi_name" id="hindi_name"
                                                            placeholder="नाम दर्ज करें"
                                                            value="@if (old('hindi_name')) {{ old('hindi_name') }}@else{{ $flowers->hindi_name }} @endif" readonly>
                                                        <label class="error py-2" for="hindi_name"
                                                            id="hindi_name_error"></label>
                                                        @if ($errors->has('hindi_name'))
                                                            <span class="red-text"><?php echo $errors->first('hindi_name', ':message'); ?></span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="english_botnical_name">Botnical Name </label>&nbsp<span
                                                            class="red-text">*</span>
                                                        <input class="form-control" name="english_botnical_name"
                                                            id="english_botnical_name" placeholder="Enter the Name"
                                                            value=" @if (old('english_botnical_name')) {{ old('english_botnical_name') }}@else{{ $flowers->english_botnical_name }} @endif" readonly>
                                                        <label class="error py-2" for="english_botnical_name"
                                                            id="english_botnical_name_error"></label>
                                                        @if ($errors->has('english_botnical_name'))
                                                            <span class="red-text"><?php echo $errors->first('english_botnical_name', ':message'); ?></span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="hindi_botnical_name">वानस्पतिक नाम</label>&nbsp<span
                                                            class="red-text">*</span>
                                                        <input class="form-control" name="hindi_botnical_name"
                                                            id="hindi_botnical_name" placeholder="वानस्पतिक नाम दर्ज करें"
                                                            value="@if (old('hindi_botnical_name')) {{ old('hindi_botnical_name') }}@else{{ $flowers->hindi_botnical_name }} @endif" readonly>
                                                        <label class="error py-2" for="hindi_botnical_name"
                                                            id="hindi_botnical_name_error"></label>
                                                        @if ($errors->has('hindi_botnical_name'))
                                                            <span class="red-text"><?php echo $errors->first('hindi_botnical_name', ':message'); ?></span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="english_common_name">Common Name </label>&nbsp<span
                                                            class="red-text">*</span>
                                                        <input class="form-control" name="english_common_name"
                                                            id="english_common_name" placeholder="Enter the Name"
                                                            value=" @if (old('english_common_name')) {{ old('english_common_name') }}@else{{ $flowers->english_common_name }} @endif" readonly>
                                                        <label class="error py-2" for="english_common_name"
                                                            id="english_common_name_error"></label>
                                                        @if ($errors->has('english_common_name'))
                                                            <span class="red-text"><?php echo $errors->first('english_common_name', ':message'); ?></span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="hindi_common_name">साधारण नाम </label>&nbsp<span
                                                            class="red-text">*</span>
                                                        <input class="form-control" name="hindi_common_name"
                                                            id="hindi_common_name" placeholder="साधारण नाम दर्ज करें"
                                                            value="@if (old('hindi_common_name')) {{ old('hindi_common_name') }}@else{{ $flowers->hindi_common_name }} @endif" readonly>
                                                        <label class="error py-2" for="hindi_common_name"
                                                            id="hindi_common_name_error"></label>
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
                                                            placeholder="Enter the Description">
                                                <label class="error py-2" for="english_description" id="english_description_error"></label>
                                            @if (old('english_description'))
{{ old('english_description') }}@else{{ $flowers->english_description }}
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
                                                            placeholder="विवरण दर्ज करें">
                                            @if (old('hindi_description'))
{{ old('hindi_description') }}@else{{ $flowers->hindi_description }}
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
                                                        <label for="latitude">Latitude </label>&nbsp<span
                                                            class="red-text">*</span>
                                                        <input class="form-control" name="latitude" id="latitude"
                                                            placeholder="Enter the name"
                                                            value=" @if (old('latitude')) {{ old('latitude') }}@else{{ $flowers->latitude }} @endif">
                                                        <label class="error py-2" for="latitude"
                                                            id="latitude_error"></label>
                                                        @if ($errors->has('latitude'))
                                                            <span class="red-text"><?php echo $errors->first('latitude', ':message'); ?></span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="longitude">Longitude </label>&nbsp<span
                                                            class="red-text">*</span>
                                                        <input class="form-control" name="longitude" id="longitude"
                                                            placeholder="Enter the name"
                                                            value=" @if (old('longitude')) {{ old('longitude') }}@else{{ $flowers->longitude }} @endif">
                                                        <label class="error py-2" for="longitude"
                                                            id="longitude_error"></label>
                                                        @if ($errors->has('longitude'))
                                                            <span class="red-text"><?php echo $errors->first('longitude', ':message'); ?></span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="english_audio_link">Audio Upload </label>
                                                        <input type="file" name="english_audio_link"
                                                            id="english_audio_link" accept="audio/*"
                                                            class="form-control">

                                                    </div>
                                                    <div id="englishaudio">
                                                        <audio controls>
                                                            <source
                                                                src="{{ Config::get('DocumentConstant.FLOWERS_VIEW') }}{{ $flowers->english_audio_link }}"
                                                                accept="audio/*">
                                                        </audio>
                                                    </div>
                                                    <div id="english_audioPreview" style="display:none">
                                                        <audio controls>
                                                            <source
                                                                src="{{ Config::get('DocumentConstant.FLOWERS_VIEW') }}{{ $flowers->english_audio_link }}"
                                                                accept="audio/*">
                                                        </audio>
                                                    </div>
                                                    @if ($errors->has('english_audio_link'))
                                                        <div class="red-text"><?php echo $errors->first('english_audio_link', ':message'); ?>
                                                        </div>
                                                    @endif
                                                </div>

                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="hindi_audio_link">ऑडियो अपलोड </label>&nbsp<span
                                                            class="red-text">*</span><br>
                                                        <input type="file" name="hindi_audio_link"
                                                            id="hindi_audio_link" accept="audio/*"
                                                            value="{{ old('hindi_audio_link') }}"
                                                            class="form-control mb-2">
                                                        <div id="hindiaudio">
                                                            <audio controls>
                                                                <source
                                                                    src="{{ Config::get('DocumentConstant.FLOWERS_VIEW') }}{{ $flowers->hindi_audio_link }}"
                                                                    accept="audio/*">
                                                            </audio>
                                                        </div>
                                                        <div id="hindi_audioPreview" style="display:none">
                                                            <audio controls>
                                                                <source
                                                                    src="{{ Config::get('DocumentConstant.FLOWERS_VIEW') }}{{ $flowers->hindi_audio_link }}"
                                                                    accept="audio/*">
                                                            </audio>
                                                        </div>
                                                        @if ($errors->has('hindi_audio_link'))
                                                            <span class="red-text"><?php echo $errors->first('hindi_audio_link', ':message'); ?></span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="english_video_upload">Video Upload</label>&nbsp<span
                                                            class="red-text">*</span><br>
                                                        <input type="file" name="english_video_upload"
                                                            id="english_video_upload" accept="video/*"
                                                            value="{{ old('english_video_upload') }}"
                                                            class="form-control mb-2">

                                                        <div id="englishvideo">
                                                            <video width="300" height="150" controls>
                                                                <source
                                                                    src="{{ Config::get('DocumentConstant.FLOWERS_VIEW') }}{{ $flowers->english_video_upload }}"
                                                                    type="video/mp4">
                                                            </video>
                                                        </div>
                                                        <div id="english_videoPreview" style="display:none">
                                                            <video width="300" height="150" controls>
                                                                <source
                                                                    src="{{ Config::get('DocumentConstant.FLOWERS_VIEW') }}{{ $flowers->english_video_upload }}"
                                                                    type="video/mp4">
                                                            </video>
                                                        </div>

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

                                                        <div id="hindivideo">
                                                            <video width="300" height="150" controls>
                                                                <source
                                                                    src="{{ Config::get('DocumentConstant.FLOWERS_VIEW') }}{{ $flowers->hindi_video_upload }}"
                                                                    type="video/mp4">
                                                            </video>
                                                        </div>
                                                        <div id="hindi_videoPreview" style="display:none">
                                                            <video width="300" height="150" controls>
                                                                <source
                                                                    src="{{ Config::get('DocumentConstant.FLOWERS_VIEW') }}{{ $flowers->hindi_video_upload }}"
                                                                    type="video/mp4">
                                                            </video>
                                                        </div>

                                                        @if ($errors->has('hindi_video_upload'))
                                                            <span class="red-text"><?php echo $errors->first('hindi_video_upload', ':message'); ?></span>
                                                        @endif

                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4">
                                                    <div class="form-group">
                                                        <label for="icon_id">Icon:</label> &nbsp;<span class="red-text">*</span>
                                                        <select class="form-control mb-2" name="icon_id" id="icon_id">
                                                            <option value="" default>Select Icon</option>
                                                            @foreach ($dataOutputIcon as $service)
                                                                <option value="{{ $service['id'] }}" {{ old('icon_id', $flowers->icon_id) == $service->id ? 'selected' : '' }}>
                                                                    {{ $service->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @if ($errors->has('icon_id'))
                                                            <span class="red-text">{{ $errors->first('icon_id') }}</span>
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
                                                        src="{{ Config::get('DocumentConstant.FLOWERS_VIEW') }}{{ $flowers->image }}"
                                                        class="img-fluid img-thumbnail" width="150">
                                                    <img id="english_imgPreview" src="#" alt="pic"
                                                        class="img-fluid img-thumbnail" width="150"
                                                        style="display:none">
                                                    @if ($errors->has('image'))
                                                        <div class="red-text"><?php echo $errors->first('image', ':message'); ?>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="image_two"> Image</label> (optional)
                                                        <input type="file" name="image_two" class="form-control"
                                                            id="image_two" accept="image/*" placeholder="upload image">

                                                    </div>
                                                    <img id="english_two"
                                                        src="{{ Config::get('DocumentConstant.FLOWERS_VIEW') }}{{ $flowers->image_two }}"
                                                        class="img-fluid img-thumbnail" width="150">
                                                    <img id="english_imgPreview_two" src="#" alt="pic"
                                                        class="img-fluid img-thumbnail" width="150"
                                                        style="display:none">
                                                    @if ($errors->has('image_two'))
                                                        <div class="red-text"><?php echo $errors->first('image_two', ':message'); ?>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="image_three"> Image</label> (optional)
                                                        <input type="file" name="image_three" class="form-control"
                                                            id="image_three" accept="image/*" placeholder="upload image">

                                                    </div>
                                                    <img id="english_three"
                                                        src="{{ Config::get('DocumentConstant.FLOWERS_VIEW') }}{{ $flowers->image_three }}"
                                                        class="img-fluid img-thumbnail" width="150">
                                                    <img id="english_imgPreview_three" src="#" alt="pic"
                                                        class="img-fluid img-thumbnail" width="150"
                                                        style="display:none">
                                                    @if ($errors->has('image_three'))
                                                        <div class="red-text"><?php echo $errors->first('image_three', ':message'); ?>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="image_four"> Image</label> (optional)
                                                        <input type="file" name="image_four" class="form-control"
                                                            id="image_four" accept="image/*" placeholder="upload image">

                                                    </div>
                                                    <img id="english_four"
                                                        src="{{ Config::get('DocumentConstant.FLOWERS_VIEW') }}{{ $flowers->image_four }}"
                                                        class="img-fluid img-thumbnail" width="150">
                                                    <img id="english_imgPreview_four" src="#" alt="pic"
                                                        class="img-fluid img-thumbnail" width="150"
                                                        style="display:none">
                                                    @if ($errors->has('image_four'))
                                                        <div class="red-text"><?php echo $errors->first('image_four', ':message'); ?>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="image_five"> Image</label> (optional)
                                                        <input type="file" name="image_five" class="form-control"
                                                            id="image_five" accept="image/*" placeholder="upload image">

                                                    </div>
                                                    <img id="english_five"
                                                        src="{{ Config::get('DocumentConstant.FLOWERS_VIEW') }}{{ $flowers->image_five }}"
                                                        class="img-fluid img-thumbnail" width="150">
                                                    <img id="english_imgPreview_five" src="#" alt="pic"
                                                        class="img-fluid img-thumbnail" width="150"
                                                        style="display:none">
                                                    @if ($errors->has('image_five'))
                                                        <div class="red-text"><?php echo $errors->first('image_five', ':message'); ?>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="height">Height</label>&nbsp<span
                                                            class="red-text">*</span>
                                                        <input class="form-control mb-2" name="height"
                                                            id="height" placeholder="Enter the Height"
                                                            name="height" value=" @if (old('height')) {{ old('height') }}@else{{ $flowers->height }} @endif">
                                                        @if ($errors->has('height'))
                                                            <span class="red-text"><?php echo $errors->first('height', ':message'); ?></span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="height_type">Height Type</label>&nbsp;<span class="red-text">*</span>
                                                        <select class="form-control" id="height_type" name="height_type">
                                                            <option value="" selected disabled>Select Height Type</option>
                                                            <option value="feet" {{ old('height_type', $flowers->height_type) == 'feet' ? 'selected' : '' }}>Feet</option>
                                                            <option value="cm" {{ old('height_type', $flowers->height_type) == 'cm' ? 'selected' : '' }}>CM</option>
                                                        </select>
                                                        @if ($errors->has('height_type'))
                                                            <span class="red-text">{{ $errors->first('height_type', ':message') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="canopy">Canopy</label>&nbsp<span
                                                            class="red-text">*</span>
                                                        <input class="form-control mb-2" name="canopy"
                                                            id="canopy" placeholder="Enter the canopy"
                                                            name="canopy"  value=" @if (old('canopy')) {{ old('canopy') }}@else{{ $flowers->canopy }} @endif">
                                                        @if ($errors->has('canopy'))
                                                            <span class="red-text"><?php echo $errors->first('canopy', ':message'); ?></span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="canopy_type">Canopy Type</label>&nbsp;<span class="red-text">*</span>
                                                        <select class="form-control" id="canopy_type" name="canopy_type">
                                                            <option value="" selected disabled>Select Canopy Type</option>
                                                            <option value="feet" {{ old('canopy_type', $flowers->canopy_type) == 'feet' ? 'selected' : '' }}>Feet</option>
                                                            <option value="cm" {{ old('canopy_type', $flowers->canopy_type) == 'cm' ? 'selected' : '' }}>CM</option>
                                                        </select>
                                                        @if ($errors->has('canopy_type'))
                                                            <span class="red-text">{{ $errors->first('canopy_type', ':message') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="girth">Girth</label>&nbsp<span
                                                            class="red-text">*</span>
                                                        <input class="form-control mb-2" name="girth"
                                                            id="girth" placeholder="Enter the girth"
                                                            name="girth"  value=" @if (old('girth')) {{ old('girth') }}@else{{ $flowers->girth }} @endif">
                                                        @if ($errors->has('girth'))
                                                            <span class="red-text"><?php echo $errors->first('canopy', ':message'); ?></span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="girth_type">Girth Type</label>&nbsp;<span class="red-text">*</span>
                                                        <select class="form-control" id="girth_type" name="girth_type">
                                                            <option value="" selected disabled>Select Girth Type</option>
                                                            <option value="feet" {{ old('girth_type', $flowers->girth_type) == 'feet' ? 'selected' : '' }}>Feet</option>
                                                            <option value="cm" {{ old('girth_type', $flowers->girth_type) == 'cm' ? 'selected' : '' }}>CM</option>
                                                        </select>
                                                        @if ($errors->has('girth_type'))
                                                            <span class="red-text">{{ $errors->first('girth_type', ':message') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-sm-12 text-center">
                                                    <button type="submit" class="btn btn-sm btn-success">
                                                        Save &amp; Update
                                                    </button>
                                                    <span><a href="{{ route('list-flowers') }}"
                                                            class="btn btn-sm btn-primary ">Back</a></span>
                                                </div>
                                            </div>
                                            <input type="hidden" name="id" id="id" class="form-control"
                                                value="{{ $flowers->id }}" placeholder="">
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
                        required: "कृपया वर्णन दर्ज करें |",
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
