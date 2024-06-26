@extends('admin.layouts.master')

@section('content')
    <?php
    $restricted_options = ['add_1'];
    ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="sparkline12-list">
                <div class="sparkline12-hd">
                    <div class="main-sparkline12-hd">
                        <center>
                            <h1>Add Role</h1>
                        </center>
                    </div>
                </div>
                {{-- <div class="sparkline12-graph">
                    <div class="basic-login-form-ad">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="all-form-element-inner"> --}}
                            <form class="forms-sample" id="regForm" name="roleformid" method="post" role="form"
                                action="{{ route('add-role') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <div class="form-group">
                                                <label for="role_name">Role Name</label>&nbsp<span class="red-text">*</span>
                                                <input type="text" class="form-control role_name mb-2" name="role_name"
                                                    id="role_name" value="{{ old('role_name') }}"
                                                    placeholder="Enter the Role Name">
                                                @if ($errors->has('role_name'))
                                                    <span class="red-text"><?php echo $errors->first('role_name', ':message'); ?></span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Sr. No.</th>
                                                            <th>Functionality Name</th>
                                                            <th>Add</th>
                                                            <th>Update</th>
                                                            <th>Delete</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                       
                                                        @foreach ($permissions as $key => $permission)
                                                            <tr>
                                                                <td>{{ $key + 1 }}</td>
                                                                <td>
                                                                    <input type="hidden" class="form-check-input"
                                                                        name="permission_id_{{ $permission['id'] }}"
                                                                        id="permission_id_{{ $permission['id'] }}"
                                                                        value="{{ $permission['id'] }}"
                                                                        data-parsley-multiple="permission_id">
                                                                    {{ $permission['permission_name'] }}
                                                                </td>
                                                                <td>
                                                                    <label class="form-check-label">
                                                                        <?php $add_name = 'per_add_' . $permission['id']; ?>
                                                                        <input type="checkbox" class="form-check-input"
                                                                            name="per_add_{{ $permission['id'] }}"
                                                                            id="per_add_{{ $permission['id'] }}"
                                                                            value="add_{{ $permission['id'] }}"
                                                                            data-parsley-multiple="per_add"
                                                                            @if (in_array('add_' . $permission['id'], $restricted_options)) {{ 'disabled' }} @endif
                                                                            {{ old($add_name) ? 'checked' : '' }}>

                                                                        <i class="input-helper"></i><i
                                                                            class="input-helper"></i></label>
                                                                </td>
                                                                <td>
                                                                    <label class="form-check-label">
                                                                        <?php $per_update = 'per_update_' . $permission['id']; ?>
                                                                        <input type="checkbox" class="form-check-input"
                                                                            name="per_update_{{ $permission['id'] }}"
                                                                            id="per_update_{{ $permission['id'] }}"
                                                                            value="update_{{ $permission['id'] }}"
                                                                            data-parsley-multiple="per_update"
                                                                            @if (in_array('update_' . $permission['id'], $restricted_options)) {{ 'disabled' }} @endif
                                                                            {{ old($per_update) ? 'checked' : '' }}>

                                                                        <i class="input-helper"></i><i
                                                                            class="input-helper"></i></label>
                                                                </td>
                                                                <td>
                                                                    <label class="form-check-label">
                                                                        <?php $per_delete = 'per_delete_' . $permission['id']; ?>
                                                                        <input type="checkbox" class="form-check-input"
                                                                            name="per_delete_{{ $permission['id'] }}"
                                                                            id="per_delete_{{ $permission['id'] }}"
                                                                            value="delete_{{ $permission['id'] }}"
                                                                            data-parsley-multiple="per_delete"
                                                                            @if (in_array('delete_' . $permission['id'], $restricted_options)) {{ 'disabled' }} @endif
                                                                            {{ old($per_delete) ? 'checked' : '' }}>

                                                                        <i class="input-helper"></i><i
                                                                            class="input-helper"></i></label>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12 text-center pt-3 pb-5">
                                            <button type="submit" class="btn btn-sm btn-success" id="submitButton" >
                                                Save &amp; Submit
                                            </button>
                                            {{-- <button type="reset" class="btn btn-sm btn-danger">Cancel</button> --}}
                                            <span><a href="{{ route('list-role') }}"
                                                    class="btn btn-sm btn-primary ">Back</a></span>
                                        </div>
                                    </div>
                            </form>
                        {{-- </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
</div>
</div>
</div>    

        {{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <script>
        $(document).ready(function() {
            $("#regForm").validate({
                rules: {
                  role_name: {
                        required: true,
                        charactersOnly: true // Use custom validation method
                    },
                  
                  },
                messages: {
                    role_name: {
                        required: "Title name is required",
                        charactersOnly: "Only characters are allowed." // Custom error message for custom validation method
                    },
                   
                   
                }
            });
        });
    </script> --}}

        <script>
            $(document).ready(function() {
                myFunction($("#role_id").val());
            });

            function myFunction(role_id) {
                $("#data_for_role").empty();
                $.ajax({
                    url: "{{ route('list-role-wise-permission') }}",
                    method: "POST",
                    data: {
                        "role_id": role_id
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        $("#data_for_role").empty();
                        $("#data_for_role").append(data);
                    },
                    error: function(data) {}
                });
            }
        </script>
         <script>
            $(document).ready(function() {
                // Function to check if all input fields are filled with valid data
                function checkFormValidity() {
                    const role_name = $('#role_name').val();
                    
                    // Enable the submit button if all fields are valid
                    // if (role_name) {
                    //     $('#submitButton').prop('disabled', false);
                    // } else {
                    //     $('#submitButton').prop('disabled', true);
                    // }
                }

                // Call the checkFormValidity function on input change
                $('input').on('input change', checkFormValidity);

                // Initialize the form validation
                $("#regForm").validate({
                    rules: {
                        role_name: {
                            required: true,
                        },
                    },
                    messages: {
                        role_name: {
                            required: "Please Enter the Role Name",
                        },
                    },
                });
            });
        </script>
    @endsection
