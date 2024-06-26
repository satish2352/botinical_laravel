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
                                        <form class="forms-sample" action="{{ route('store-ticket') }}" method="POST"
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
                                                        <label for="english_ticket_cost">Ticket Cost</label>&nbsp<span
                                                            class="red-text">*</span>
                                                        <input class="form-control mb-2" name="english_ticket_cost" id="english_ticket_cost"
                                                            placeholder="Enter the Ticket Cost"
                                                            value="{{ old('english_ticket_cost') }}">
                                                        @if ($errors->has('english_ticket_cost'))
                                                            <span class="red-text"><?php echo $errors->first('english_ticket_cost', ':message'); ?></span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="hindi_ticket_cost">तिकिटाची किंमत</label>&nbsp<span
                                                            class="red-text">*</span>
                                                        <input class="form-control mb-2" name="hindi_ticket_cost" id="hindi_ticket_cost"
                                                            placeholder="टिकट की लागत दर्ज करें"
                                                            value="{{ old('hindi_ticket_cost') }}">
                                                        @if ($errors->has('hindi_ticket_cost'))
                                                            <span class="red-text"><?php echo $errors->first('hindi_ticket_cost', ':message'); ?></span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="english_rules_terms">Rules Terms</label>&nbsp<span
                                                            class="red-text">*</span>
                                                        <input class="form-control mb-2" name="english_rules_terms" id="english_rules_terms"
                                                            placeholder="Enter the Name" 
                                                            value="{{ old('english_rules_terms') }}">
                                                        @if ($errors->has('english_rules_terms'))
                                                            <span class="red-text"><?php echo $errors->first('english_rules_terms', ':message'); ?></span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="hindi_rules_terms">नियम शर्तें</label>&nbsp<span
                                                            class="red-text">*</span>
                                                        <input class="form-control mb-2" name="hindi_rules_terms" id="hindi_rules_terms"
                                                            placeholder="नियम शर्तें दर्ज करें" 
                                                            value="{{ old('hindi_rules_terms') }}">
                                                        @if ($errors->has('hindi_rules_terms'))
                                                            <span class="red-text"><?php echo $errors->first('hindi_rules_terms', ':message'); ?></span>
                                                        @endif
                                                    </div>
                                                </div>
                                              
                                                <div class="col-md-12 col-sm-12 text-center">
                                                    <button type="submit" class="btn btn-sm btn-success">
                                                        Save &amp; Submit
                                                    </button>
                                                    {{-- <button type="reset" class="btn btn-sm btn-danger">Cancel</button> --}}
                                                    <span><a href="{{ route('list-ticket') }}"
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
                    name: {
                        required: true
                    },
                    ticket_cost: {
                        required: true
                    },
                    description: {
                        required: true,
                    },
                },
                messages: {
                    name: {
                        required: "Please Enter Name.",
                    },
                    ticket_cost: {
                        required: "Please Enter Ticket Cost.",
                    },
                    description: {
                        required: "Please Enter Description.",
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
