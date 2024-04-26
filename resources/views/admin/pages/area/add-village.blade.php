@extends('admin.layouts.master')
@section('content')
    <style>
        label {
            margin-top: 20px;
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
                            <h1>Add district Data</h1>
                        </center>
                    </div>
                </div>
                <div class="sparkline12-graph">
                    <div class="basic-login-form-ad">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="all-form-element-inner">
                                    <form action="{{ route('add-village') }}" method="POST" id="frm_register" name="frm_register"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group-inner">
                                            <div class="row">
                                                    <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="district">District</label>&nbsp<span class="red-text">*</span>
                                                        <select class="form-control" name="district" id="district">
                                                            <option value="">Select District</option>
                                                            @foreach ($dynamic_district as $district)
                                                                @if (old('district') == $district['location_id'])
                                                                    <option value="{{ $district['location_id'] }}" selected>
                                                                        {{ $district['name'] }}</option>
                                                                @else
                                                                    <option value="{{ $district['location_id'] }}">
                                                                        {{ $district['name'] }}
                                                                    </option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                        @if ($errors->has('district'))
                                                            <span class="red-text"><?php echo $errors->first('district', ':message'); ?></span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="taluka">Taluka</label>&nbsp<span class="red-text">*</span>
                                                        <select class="form-control" name="taluka" id="taluka">
                                                            <option value="">Select Taluka</option>
                                                        </select>
                                                        @if ($errors->has('taluka'))
                                                            <span class="red-text"><?php echo $errors->first('taluka', ':message'); ?></span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="name">Village Name</label>&nbsp<span class="red-text">*</span>
                                                        <input type="text" class="form-control" name="name" id="name"
                                                            placeholder="" value="{{ old('name') }}"
                                                            oninput="this.value = this.value.replace(/[^a-zA-Z\s.]/g, '').replace(/(\..*)\./g, '$1');">
                                                        @if ($errors->has('name'))
                                                            <span class="red-text"><?php echo $errors->first('name', ':message'); ?></span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="login-btn-inner">
                                                <div class="row">
                                                    <div class="col-lg-5"></div>
                                                    <div class="col-lg-7">
                                                        <div class="login-horizental cancel-wp pull-left">
                                                            <a href="{{ route('list-village') }}" class="btn btn-white"
                                                                style="margin-bottom:50px">Cancel</a>
                                                            <button class="btn btn-sm btn-primary login-submit-cs"
                                                                type="submit" style="margin-bottom:50px">Save Data</button>
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
            $(document).ready(function() {

                $('#district').change(function(e) {
                    e.preventDefault();
                    var districtId = $('#district').val();
                    console.log(districtId);
                    $('#taluka').html('<option value="">Select Taluka</option>');

                    if (districtId !== '') {
                        $.ajax({
                            url: '{{ route('taluka') }}',
                            type: 'GET',
                            data: {
                                districtId: districtId
                            },
                            // headers: {
                            //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            // },
                            success: function(response) {
                                // console.log(response);
                                if (response.taluka.length > 0) {
                                    $.each(response.taluka, function(index, taluka) {
                                        $('#taluka').append('<option value="' + taluka
                                            .location_id +
                                            '">' + taluka.name + '</option>');
                                    });
                                }
                            }
                        });
                    }
                });
            });
        </script>

        <script>
            $(document).ready(function() {

                $('#taluka').change(function(e) {
                    e.preventDefault();
                    var talukaId = $('#taluka').val();
                    console.log(talukaId);
                    $('#village').html('<option value="">Select Village</option>');

                    if (talukaId !== '') {
                        $.ajax({
                            url: '{{ route('village') }}',
                            type: 'GET',
                            data: {
                                talukaId: talukaId
                            },
                            // headers: {
                            //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            // },
                            success: function(response) {
                                // console.log(response);
                                if (response.village.length > 0) {
                                    $.each(response.village, function(index, village) {
                                        $('#village').append('<option value="' + village
                                            .location_id +
                                            '">' + village.name + '</option>');
                                    });
                                }
                            }
                        });
                    }
                });
            });
        </script>

    <script>
        jQuery.noConflict();
        jQuery(document).ready(function($) {
            $("#frm_register").validate({
                rules: {
                    name: {
                        required: true
                    },
                    district: {
                        required: true
                    },
                    taluka: {
                        required: true
                    },

                },
                messages: {
                    name: {
                        required: "Please Enter the Taluka Name.",
                    },
                    district: {
                        required: "Please select District Name.",
                    },
                    taluka: {
                        required: "Please select Taluka Name.",
                    },

                },
            });
        });
    </script>
@endsection
