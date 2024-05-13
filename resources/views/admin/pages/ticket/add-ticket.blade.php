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
                                                        <label for="name">Name</label>&nbsp<span
                                                            class="red-text">*</span>
                                                        <input class="form-control mb-2" name="name" id="name"
                                                            placeholder="Enter the Name" 
                                                            value="{{ old('name') }}">
                                                        @if ($errors->has('name'))
                                                            <span class="red-text"><?php echo $errors->first('name', ':message'); ?></span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="ticket_cost">Ticket Cost</label>&nbsp<span
                                                            class="red-text">*</span>
                                                        <input class="form-control mb-2" name="ticket_cost" id="ticket_cost"
                                                            placeholder="Enter the Name"
                                                            value="{{ old('ticket_cost') }}">
                                                        @if ($errors->has('ticket_cost'))
                                                            <span class="red-text"><?php echo $errors->first('ticket_cost', ':message'); ?></span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="rules_terms">Rules Terms</label>&nbsp<span
                                                            class="red-text">*</span>
                                                        <input class="form-control mb-2" name="rules_terms" id="rules_terms"
                                                            placeholder="Enter the Name" 
                                                            value="{{ old('rules_terms') }}">
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
                                                            placeholder="Enter the Description" name="description">{{ old('description') }}</textarea>
                                                        @if ($errors->has('description'))
                                                            <span class="red-text"><?php echo $errors->first('description', ':message'); ?></span>
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
