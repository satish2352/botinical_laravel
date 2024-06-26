@extends('admin.layouts.master')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        .password-toggle {
            cursor: pointer;
            position: absolute;
            top: 50%;
            right: 20px;
            transform: translateY(-50%);
        }

        .fa-eye-slash {
            /* display: none; */
        }
    </style>
  <div class="container-fluid">
    <div class="row paddingbottom">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="sparkline12-list">
                <div class=" " style="display: flex; justify-content:space-between">
                    <h3 class="page-title">User 
                    </h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb" style="background-color: #fff;">
                            <li class="breadcrumb-item"><a href="{{ route('list-users') }}">User</a></li>
                            <li class="breadcrumb-item active" aria-current="page"> User </li>
                        </ol>
                    </nav>
                </div>
                <div class="sparkline12-graph">
                    <div class="basic-login-form-ad">
        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                            <form class="forms-sample" id="frm_register" name="frm_register" method="post" role="form"
                                action="{{ route('add-users') }}" enctype="multipart/form-data">
                                <div class="row">
                                    <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />

                                    {{--        <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label for="u_uname">User Name</label>&nbsp<span class="red-text">*</span>
                                            <input type="text" class="form-control" name="u_uname" id="u_uname"
                                                placeholder="" value="{{ old('u_uname') }}">
                                            @if ($errors->has('u_uname'))
                                                <span class="red-text"><?php echo $errors->first('u_uname', ':message'); ?></span>
                                            @endif
                                        </div>
                                    </div>
                                    --}}
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label for="email">Email ID</label>&nbsp<span class="red-text">*</span>
                                            <input type="text" class="form-control" name="email" id="email"
                                                placeholder="" value="{{ old('email') }}">
                                            @if ($errors->has('email'))
                                                <span class="red-text"><?php echo $errors->first('email', ':message'); ?></span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label for="role_id">Role Type</label>&nbsp<span class="red-text">*</span>
                                            <select class="form-control" id="role_id" name="role_id"
                                                onchange="myFunction(this.value)">
                                                <option value="">Select</option>
                                                @foreach ($roles as $role)
                                                    @if (old('role_id') == $role['id'])
                                                        <option value="{{ $role['id'] }}" selected>
                                                            {{ $role['role_name'] }}</option>
                                                    @else
                                                        <option value="{{ $role['id'] }}">{{ $role['role_name'] }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @if ($errors->has('role_id'))
                                                <span class="red-text"><?php echo $errors->first('role_id', ':message'); ?></span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label for="password">Password</label>&nbsp<span class="red-text">*</span>
                                            <input type="password" class="password form-control" name="password"
                                                id="password" placeholder="" value="{{ old('password') }}">
                                            <span id="togglePassword" class="togglePpassword password-toggle"
                                                onclick="togglePasswordVisibility()">
                                                <i class="fa fa-eye-slash"></i>
                                            </span>
                                            @if ($errors->has('password'))
                                                <span class="red-text"><?php echo $errors->first('password', ':message'); ?></span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label for="password_confirmation">Confirm Password</label>&nbsp<span
                                                class="red-text">*</span>
                                            <input type="password" class="password_confirmation form-control"
                                                id="password_confirmation" name="password_confirmation"
                                                value="{{ old('password_confirmation') }}">
                                            <span id="toggleConfirmPassword" class=" toggleConfirmPpassword password-toggle"
                                                onclick="toggleConfirmPasswordVisibility()">
                                                <i class="fa fa-eye-slash"></i>
                                            </span>
                                            <span id="password-error" class="error-message red-text"></span>
                                            @if ($errors->has('password_confirmation'))
                                                <span class="red-text"><?php echo $errors->first('password_confirmation', ':message'); ?></span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label for="full_name">Full Name</label>&nbsp<span class="red-text">*</span>
                                            <input type="text" class="form-control" name="full_name" id="full_name"
                                                placeholder="" value="{{ old('full_name') }}"
                                                oninput="this.value = this.value.replace(/[^a-zA-Z\s.]/g, '').replace(/(\..*)\./g, '$1');">
                                            @if ($errors->has('full_name'))
                                                <span class="red-text"><?php echo $errors->first('full_name', ':message'); ?></span>
                                            @endif
                                        </div>
                                    </div>

                                  
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label for="mobile_number">Mobile Number</label>&nbsp<span
                                                class="red-text">*</span>
                                            <input type="text" class="form-control" name="mobile_number" id="mobile_number"
                                                pattern="[789]{1}[0-9]{9}"
                                                oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');"
                                                maxlength="10" minlength="10" placeholder=""
                                                value="{{ old('mobile_number') }}"
                                                onkeyup="addvalidateMobileNumber(this.value)">
                                            <span id="validation-message" class="red-text"></span>
                                            @if ($errors->has('mobile_number'))
                                                <span class="red-text"><?php echo $errors->first('mobile_number', ':message'); ?></span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label for="occupation">Occupation</label>&nbsp<span
                                                class="red-text">*</span>
                                            <input type="text" class="form-control" name="occupation"
                                                id="occupation" placeholder="" value="{{ old('occupation') }}"
                                                oninput="this.value = this.value.replace(/[^a-zA-Z\s.]/g, '').replace(/(\..*)\./g, '$1');">
                                            @if ($errors->has('occupation'))
                                                <span class="red-text"><?php echo $errors->first('occupation', ':message'); ?></span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label for="address">Address</label>&nbsp<span class="red-text">*</span>
                                            <input type="text" class="form-control" name="address" id="address"
                                                placeholder="" value="{{ old('address') }}">
                                            @if ($errors->has('address'))
                                                <span class="red-text"><?php echo $errors->first('address', ':message'); ?></span>
                                            @endif
                                        </div>
                                    </div>
                                    {{-- <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label for="state">State</label>&nbsp<span class="red-text">*</span>
                                            <select class="form-control" id="state" name="state">
                                                <option>Select State</option>
                                                @foreach ($dynamic_state as $state)
                                                    @if (old('state') == $state['location_id'])
                                                        <option value="{{ $state['location_id'] }}" selected>
                                                            {{ $state['name'] }}</option>
                                                    @else
                                                        <option value="{{ $state['location_id'] }}">
                                                            {{ $state['name'] }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label for="city">City</label>&nbsp<span class="red-text">*</span>
                                            <select class="form-control" name="city" id="city">
                                                <option value="">Select City</option>
                                            </select>
                                            @if ($errors->has('city'))
                                                <span class="red-text"><?php //echo $errors->first('city', ':message'); ?></span>
                                            @endif
                                        </div>
                                    </div> --}}
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label for="user_profile">Profile Photo</label>&nbsp<span
                                                class="red-text">*</span><br>
                                            <input type="file" name="user_profile" id="user_profile" accept="image/*"
                                                value="{{ old('user_profile') }}"><br>
                                            @if ($errors->has('user_profile'))
                                                <span class="red-text"><?php echo $errors->first('user_profile', ':message'); ?></span>
                                            @endif
                                        </div>
                                    </div>
                                
                                    <div class="col-lg-12 col-md-12 col-sm-12 user_tbl">
                                        <div id="data_for_role">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="col-lg-6 col-md-6 col-sm-6 mt-3">
                                        <div class="form-group form-check form-check-flat form-check-primary">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" name="is_active"
                                                    id="is_active" value="y" data-parsley-multiple="is_active"
                                                    {{ old('is_active') ? 'checked' : '' }}>
                                                Is Active
                                                <i class="input-helper"></i><i class="input-helper"></i></label>
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-sm-12 text-center">
                                        <button type="submit" class="btn btn-sm btn-success" id="submitButton">
                                            Save &amp; Submit
                                        </button>
                                        {{-- <button type="reset" class="btn btn-sm btn-danger">Cancel</button> --}}
                                        <span><a href="{{ route('list-users') }}"
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
    </div>
        <script type="text/javascript">
            function submitRegister() {
                document.getElementById("frm_register").submit();
            }
        </script>
        <script>
            function addvalidateMobileNumber(number) {
                var mobileNumberPattern = /^\d*$/;
                var validationMessage = document.getElementById("validation-message");

                if (mobileNumberPattern.test(number)) {
                    validationMessage.textContent = "";
                } else {
                    validationMessage.textContent = "Please enter only numbers.";
                }
            }
        </script>
        {{-- <script>
            function addvalidatePincode(number) {
                var pincodePattern = /^\d*$/;
                var validationMessage = document.getElementById("validation-message-pincode");

                if (pincodePattern.test(number)) {
                    validationMessage.textContent = "";
                } else {
                    validationMessage.textContent = "Please enter only numbers.";
                }
            }
        </script> --}}


        <script>
            $(document).ready(function() {

                $('#state').change(function(e) {
                    e.preventDefault();
                    var stateId = $('#state').val();
                    // console.log(stateId);
                    $('#city').html('<option value="">Select City</option>');

                    if (stateId !== '') {
                        $.ajax({
                            url: '{{ route('cities') }}',
                            type: 'GET',
                            data: {
                                stateId: stateId
                            },
                            // headers: {
                            //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            // },
                            success: function(response) {
                                console.log(response);
                                if (response.city.length > 0) {
                                    $.each(response.city, function(index, city) {
                                        $('#city').append('<option value="' + city
                                            .location_id +
                                            '">' + city.name + '</option>');
                                    });
                                }
                            }
                        });
                    }
                });
            });
        </script>
        <script>
            function myFunction(role_id) {
                // alert(role_id);
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
                    const email = $('#email').val();
                    const role_id = $('#role_id').val();
                    const password = $('#password').val();
                    const password_confirmation = $('#password_confirmation').val();
                    const full_name = $('#full_name').val();
                    const mobile_number = $('#mobile_number').val();
                    const occupation = $('#occupation').val();
                    const address = $('#address').val();
                    // const gender = $('#gender').val();
                    // const city = $('#city').val();
                    const user_profile = $('#user_profile').val();
                    const date_of_birth = $('#date_of_birth').val();

                    // Enable the submit button if all fields are valid
                    // if (email && role_id && password && password_confirmation && full_name &&
                    //     number && occupation && address && user_profile && date_of_birth && gender) {
                    //     $('#submitButton').prop('disabled', false);
                    // } else {
                    //     $('#submitButton').prop('disabled', true);
                    // }
                }

                // Call the checkFormValidity function on input change
                $('input,textarea, select, #user_profile').on('input change',
                    checkFormValidity);

                    $.validator.addMethod("mobile_number", function(value, element) {
                    return this.optional(element) || /^[0-9]{10}$/.test(value);
                }, "Please enter a valid 10-digit mobile_number.");

                $.validator.addMethod("email", function(value, element) {
                    // Regular expression for email validation
                    const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
                    return this.optional(element) || emailRegex.test(value);
                }, "Please enter a valid email address.");

                // Initialize the form validation
                $("#regForm").validate({
                    rules: {
                        email: {
                            required: true,
                        //     remote: {
                        //     url: '/web/check-email-exists',
                        //     type: 'post',
                        //     data: {
                        //         email: function() {
                        //             return $('#email').val();
                        //         }
                        //     }
                        // },
                            email:true,
                        },
                        role_id: {
                            required: true,
                        },
                        password: {
                            required: true,
                        },
                        password_confirmation: {
                            required: true,
                        },
                        full_name: {
                            required: true,
                        },
                        mobile_number: {
                            required: true,
                            mobile_number:true,
                        },
                        occupation: {
                            required: true,
                        },
                        address: {
                            required: true,
                        },
                        gender: {
                            required: true,
                        },
                        // city: {
                        //     required: true,
                        // },
                        user_profile: {
                            required: true,
                        },
                        date_of_birth: {
                            required: true,
                        },

                    },
                    messages: {
                        email: {
                            required: "Please Enter the Eamil",
                            // remote: "This Email already exists."
                        },
                        role_id: {
                            required: "Please Select Role Name",
                        },
                        password: {
                            required: "Please Enter the Password",
                        },
                        password_confirmation: {
                            required: "Please Enter the Confirmation Password",
                        },
                        full_name: {
                            required: "Please Enter the First Name",
                        },
                        mobile_number: {
                            required: "Please Enter the mobile number",
                        },
                        occupation: {
                            required: "Please Enter the occupation",
                        },
                        address: {
                            required: "Please Enter the Address",
                        },

                        gender: {
                            required: "Please Select gender",
                        },
                        // city: {
                        //     required: "Please Select State",
                        // },
                        user_profile: {
                            required: "Upload Media File",
                            accept: "Only png, jpeg, and jpg image files are allowed.", // Update the error message for the accept rule
                        },
                        date_of_birth: {
                            required: "Please Enter the date_of_birth",
                        },
                    },

                });
            });
        </script>
    @endsection
