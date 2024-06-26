@extends('admin.layouts.master')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
                            <div class="container-fluid">
                                <div class="row paddingbottom">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="sparkline12-list">
                                            <div class=" " style="display: flex; justify-content:space-between">
                                                <h3 class="page-title">Users
                                                </h3>
                                                <nav aria-label="breadcrumb">
                                                    <ol class="breadcrumb" style="background-color: #fff;">
                                                        <li class="breadcrumb-item"><a href="{{ route('list-users') }}">Users</a></li>
                                                        <li class="breadcrumb-item active" aria-current="page"> Users </li>
                                                    </ol>
                                                </nav>
                                            </div>
                                            <div class="sparkline12-graph">
                                                <div class="basic-login-form-ad">
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <div class="all-form-element-inner">
                            <form class="forms-sample" id="regForm" name="frm_register" method="post" role="form"
                                action="{{ route('update-users') }}" enctype="multipart/form-data">
                                <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                <div class="row">
                                    {{-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email ID</label>&nbsp<span class="red-text">*</span>
                                        <input type="text" class="form-control" name="email" id="email"
                                            placeholder="" value="{{$user_data['data_users']['email']}}">
                                        @if ($errors->has('email'))
                                        <span
                                            class="red-text"><?php //echo $errors->first('email', ':message'); ?></span>
                                        @endif
                                    </div>
                                </div> 
                                          <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label for="u_uname">User Name</label>&nbsp<span class="red-text">*</span>
                                            <input type="text" class="form-control" name="u_uname" id="u_uname"
                                                placeholder="" value="{{ $user_data['data_users']['u_uname'] }}">
                                            @if ($errors->has('u_uname'))
                                                <span class="red-text"><?php echo $errors->first('u_uname', ':message'); ?></span>
                                            @endif
                                        </div>
                                    </div> --}}
                                    {{-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">Password</label>&nbsp<span class="red-text">*</span>
                                        <input type="text" class="form-control" name="password" id="password"
                                            placeholder="" value="{{decrypt($user_data['data_users']['password'])}}">
                                        @if ($errors->has('password'))
                                        <span
                                            class="red-text"><?php echo $errors->first('password', ':message'); ?></span>
                                        @endif
                                    </div>
                                </div> --}}

                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label for="role_id">Role Type</label>&nbsp<span class="red-text">*</span>
                                            <select class="form-control" id="role_id" name="role_id"
                                                onchange="myFunction(this.value)">
                                                <option>Select</option>
                                                @foreach ($user_data['roles'] as $role)
                                                    <option value="{{ $role['id'] }}"
                                                        @if ($role['id'] == $user_data['data_users']['role_id']) <?php echo 'selected'; ?> @endif>
                                                        {{ $role['role_name'] }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('role_id'))
                                                <span class="red-text"><?php echo $errors->first('role_id', ':message'); ?></span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label for="full_name">Full Name</label>&nbsp<span class="red-text">*</span>
                                            <input type="text" class="form-control mb-2" name="full_name" id="full_name"
                                                placeholder="" value="{{ $user_data['data_users']['full_name'] }}"
                                                oninput="this.value = this.value.replace(/[^a-zA-Z\s.]/g, '').replace(/(\..*)\./g, '$1');">
                                            @if ($errors->has('full_name'))
                                                <span class="red-text"><?php echo $errors->first('full_name', ':message'); ?></span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label for="mobile_number">Number</label>&nbsp<span class="red-text">*</span>
                                            <input type="text" class="form-control mb-2" name="mobile_number" id="mobile_number"
                                                placeholder="" value="{{ $user_data['data_users']['mobile_number'] }}"
                                                onkeyup="editvalidateMobileNumber(this.value)"
                                                pattern="[789]{1}[0-9]{9}" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');"  maxlength="10" minlength="10"
                                                >
                                            <span id="edit-message" class="red-text"></span>
                                            @if ($errors->has('mobile_number'))
                                                <span class="red-text"><?php echo $errors->first('mobile_number', ':message'); ?></span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label for="occupation">Occupation</label>&nbsp<span class="red-text">*</span>
                                            <input type="text" class="form-control mb-2" name="occupation" id="occupation"
                                                placeholder="" value="{{ $user_data['data_users']['occupation'] }}"
                                                oninput="this.value = this.value.replace(/[^a-zA-Z\s.]/g, '').replace(/(\..*)\./g, '$1');">
                                            @if ($errors->has('occupation'))
                                                <span class="red-text"><?php echo $errors->first('occupation', ':message'); ?></span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label for="address">Address</label>&nbsp<span class="red-text">*</span>
                                            <input type="text" class="form-control mb-2" name="address" id="address"
                                                placeholder="" value="{{ $user_data['data_users']['address'] }}">
                                            @if ($errors->has('address'))
                                                <span class="red-text"><?php echo $errors->first('address', ':message'); ?></span>
                                            @endif
                                        </div>
                                    </div>
                               
                                    {{-- <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label for="pincode">Pincode</label>&nbsp<span class="red-text">*</span>
                                            <input type="text" class="form-control mb-2" name="pincode" id="pincode"
                                                placeholder="" value="{{ $user_data['data_users']['pincode'] }}"
                                                onkeyup="editvalidatePincode(this.value)">
                                            <span id="edit-message-pincode" class="red-text"></span>
                                            @if ($errors->has('pincode'))
                                                <span class="red-text"><?php //echo $errors->first('pincode', ':message'); ?></span>
                                            @endif
                                        </div>
                                    </div> --}}



                                    <br>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group form-check form-check-flat form-check-primary">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" name="is_active"
                                                    id="is_active" value="y" data-parsley-multiple="is_active"
                                                    @if ($user_data['data_users']['is_active']) <?php echo 'checked'; ?> @endif>
                                                Is Active
                                                <i class="input-helper"></i><i class="input-helper"></i></label>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-sm-12 user_tbl">
                                        <div id="data_for_role">
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-sm-12 text-center mt-3">
                                        <input type="hidden" class="form-check-input" name="edit_id" id="edit_id"
                                            value="{{ $user_data['data_users']['id'] }}">
                                            <button type="submit" class="btn btn-sm btn-success" id="submitButton">
                                                Save &amp; Update
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

        {{-- <script>
            function getStateCity(stateId, city_id) {

                $('#city').html('<option value="">Select City</option>');
                if (stateId !== '') {
                    $.ajax({
                        url: '{{ route('cities') }}',
                        type: 'GET',
                        data: {
                            stateId: stateId
                        },

                        success: function(response) {
                            if (response.city.length > 0) {
                                $.each(response.city, function(index, city) {
                                    $('#city').append('<option value="' + city
                                        .location_id +
                                        '" selected>' + city.name + '</option>');
                                });
                                if (city_id != null) {
                                    $('#city').val(city_id);
                                } else {
                                    $('#city').val("");
                                }
                            }
                        }
                    });
                }
            }

            // function getState(stateId) {
            //     $('#state').html('<option value="">Select State</option>');
            //     if (stateId !== '') {
            //         $.ajax({
            //             url: '{{ route('states') }}',
            //             type: 'GET',
            //             data: {
            //                 stateId: stateId
            //             },
            //             success: function(response) {
            //                 if (response.state.length > 0) {
            //                     $.each(response.state, function(index, state) {
            //                         $('#state').append('<option value="' + state
            //                             .location_id +
            //                             '" selected>' + state.name + '</option>');
            //                     });
            //                     $('#state').val(stateId);
            //                 }
            //             }
            //         });
            //     }
            // }
        </script> --}}

        <script type="text/javascript">
            function submitRegister() {
                document.getElementById("frm_register").submit();
            }
        </script>
        <script>
            function editvalidateMobileNumber(mobile_number) {
                var mobileNumberPattern = /^\d*$/;
                var validationMessage = document.getElementById("edit-message");

                if (mobileNumberPattern.test(mobile_number)) {
                    validationMessage.textContent = "";
                } else {
                    validationMessage.textContent = "Only numbers are allowed.";
                }
            }
        </script>
        <script>
            function editvalidatePincode(mobile_number) {
                var pincodePattern = /^\d*$/;
                var validationMessage = document.getElementById("edit-message-pincode");

                if (pincodePattern.test(mobile_number)) {
                    validationMessage.textContent = "";
                } else {
                    validationMessage.textContent = "Only numbers are allowed.";
                }
            }
        </script>

        <script>
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
                $.validator.addMethod('mypassword', function(value, element) {
                        return this.optional(element) || (value.match(/[a-z]/) && value.match(/[A-Z]/) && value
                            .match(/[0-9]/));
                    },
                    'Password must contain at least one uppercase, lowercase and numeric');

                $("#frm_register1").validate({
                    rules: {

                        password: {
                            //required: true,
                            minlength: 6,
                            mypassword: true

                        },
                        password_confirmation: {
                            //required: true,
                            equalTo: "#password"
                        },
                    },
                    messages: {
                        password: {
                            required: "Please enter your new password",
                            minlength: "Password should be minimum 8 characters"
                        },
                        password_confirmation: {
                            required: "Please Enter Password Same as New Password for Confirmation",
                            equalTo: "Password does not Match! Please check the Password"
                        }
                    }
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                $("#show_hide_password a").on('click', function(event) {
                    event.preventDefault();
                    if ($('#show_hide_password input').attr("type") == "text") {
                        $('#show_hide_password input').attr('type', 'password');
                        $('#show_hide_password i').addClass("bx-hide");
                        $('#show_hide_password i').removeClass("bx-show");
                    } else if ($('#show_hide_password input').attr("type") == "password") {
                        $('#show_hide_password input').attr('type', 'text');
                        $('#show_hide_password i').removeClass("bx-hide");
                        $('#show_hide_password i').addClass("bx-show");
                    }
                });
            });
        </script>
  <script>
    $(document).ready(function() {
        // Function to check if all input fields are filled with valid data
        function checkFormValidity() {
            const role_id = $('#role_id').val();
            const f_name = $('#f_name').val();
            const m_name = $('#m_name').val();
            const l_name = $('#l_name').val();
            const mobile_number = $('#mobile_number').val();
            const designation = $('#designation').val();
            const address = $('#address').val();
            const state = $('#state').val();
            const city = $('#city').val();
            // const user_profile = $('#user_profile').val();
            const pincode = $('#pincode').val();
            
        }

        // Call the checkFormValidity function on file input change
        $('input, #english_image, #marathi_image').on('change', function() {
            checkFormValidity();
            validator.element(this); // Revalidate the file input
        });
        // Initialize the form validation
        var form = $("#regForm");
        var validator = form.validate({
            rules: {
                // email: {
                //     required: true,
                // },
                role_id: {
                    required: true,
                },
                // password: {
                //     required: true,
                // },
                // password_confirmation: {
                //     required: true,
                // },
                f_name: {
                    required: true,
                },
                m_name: {
                    required: true,
                },
                l_name: {
                    required: true,
                },
                mobile_number: {
                    required: true,
                },
                designation: {
                    required: true,
                },
                address: {
                    required: true,
                },
                state: {
                    required: true,
                },
                city: {
                    required: true,
                },
                // user_profile: {
                //     required: true,
                // },
                pincode: {
                    required: true,
                },
            },
            messages: {
                // email: {
                //     required: "Please Enter the Eamil",
                // },
                role_id: {
                    required: "Please Select Role Name",
                },
                // password: {
                //     required: "Please Enter the Password",
                // },
                // password_confirmation: {
                //     required: "Please Enter the Confirmation Password",
                // },
                f_name: {
                    required: "Please Enter the First Name",
                },
                m_name: {
                    required: "Please Enter the Middle Name",
                },
                l_name: {
                    required: "Please Enter the Last Name",
                },
                mobile_number: {
                    required: "Please Enter the Number",
                },
                designation: {
                    required: "Please Enter the Designation",
                },
                address: {
                    required: "Please Enter the Address",
                },

                state: {
                    required: "Please Select State",
                },
                city: {
                    required: "Please Select State",
                },
                // user_profile: {
                //     required: "Upload Media File",
                //     accept: "Only png, jpeg, and jpg image files are allowed.", // Update the error message for the accept rule
                // },
                pincode: {
                    required: "Please Enter the Pincode",
                },
            },
            submitHandler: function(form) {
                form.submit();
            }
        });

        // Submit the form when the "Update" button is clicked
        $("#submitButton").click(function() {
            // Validate the form
            if (form.valid()) {
                form.submit();
            }
        });
    });
</script>    



{{-- <script>
    $(document).ready(function() {
        // Function to check if all input fields are filled with valid data
        function checkFormValidity() {
            // const email = $('#email').val();
            const role_id = $('#role_id').val();
            // const password = $('#password').val();
            // const password_confirmation = $('#password_confirmation').val();
            const f_name = $('#f_name').val();
            const m_name = $('#m_name').val();
            const l_name = $('#l_name').val();
            const number = $('#number').val();
            const designation = $('#designation').val();
            const address = $('#address').val();
            const state = $('#state').val();
            const city = $('#city').val();
            // const user_profile = $('#user_profile').val();
            const pincode = $('#pincode').val();

            // Enable the submit button if all fields are valid
            if (role_id && f_name && m_name && l_name && number && designation && address && state && city && pincode) {
                $('#submitButton').prop('disabled', false);
            } else {
                $('#submitButton').prop('disabled', true);
            }
        }

        // Call the checkFormValidity function on input change
        $('input,textarea, select, #user_profile').on('input change',
            checkFormValidity);

        // Initialize the form validation
        $("#regForm").validate({
            rules: {
                // email: {
                //     required: true,
                // },
                role_id: {
                    required: true,
                },
                // password: {
                //     required: true,
                // },
                // password_confirmation: {
                //     required: true,
                // },
                f_name: {
                    required: true,
                },
                m_name: {
                    required: true,
                },
                l_name: {
                    required: true,
                },
                number: {
                    required: true,
                },
                designation: {
                    required: true,
                },
                address: {
                    required: true,
                },
                state: {
                    required: true,
                },
                city: {
                    required: true,
                },
                // user_profile: {
                //     required: true,
                // },
                pincode: {
                    required: true,
                },

            },
            messages: {
                // email: {
                //     required: "Please Enter the Eamil",
                // },
                role_id: {
                    required: "Please Select Role Name",
                },
                // password: {
                //     required: "Please Enter the Password",
                // },
                // password_confirmation: {
                //     required: "Please Enter the Confirmation Password",
                // },
                f_name: {
                    required: "Please Enter the First Name",
                },
                m_name: {
                    required: "Please Enter the Middle Name",
                },
                l_name: {
                    required: "Please Enter the Last Name",
                },
                number: {
                    required: "Please Enter the Number",
                },
                designation: {
                    required: "Please Enter the Designation",
                },
                address: {
                    required: "Please Enter the Address",
                },

                state: {
                    required: "Please Select State",
                },
                city: {
                    required: "Please Select State",
                },
                // user_profile: {
                //     required: "Upload Media File",
                //     accept: "Only png, jpeg, and jpg image files are allowed.", // Update the error message for the accept rule
                // },
                pincode: {
                    required: "Please Enter the Pincode",
                },
            },

        });
    });
</script> --}}
    @endsection
