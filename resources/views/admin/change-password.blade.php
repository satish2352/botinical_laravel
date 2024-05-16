@extends('admin.layouts.master')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper mt-6">
            {{-- <div class="page-header">
                <h3 class="page-title">
                    Change Password
                </h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('change-password') }}">Profile</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> Change Password</li>
                    </ol>
                </nav>
            </div> --}}

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
<div class="container-fluid">
    <div class="row paddingbottom">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="sparkline12-list">
                <div class=" " style="display: flex; justify-content:space-between">
                    <h3 class="page-title">Change Password
                    </h3>
                   
                </div>
            <div class="row">
                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <form class="forms-sample" action="{{ url('update-password') }}" method="POST"
                                enctype="multipart/form-data" id="regForm">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group">
                                        <input type="hidden" class="form-control mb-2" name="id" id="id"
                                                placeholder="Enter New Password">
                                            <label for="new_password">New Password</label>&nbsp<span class="red-text">*</span>
                                            <input type="password" class="form-control mb-2" name="new_password" id="new_password"
                                                placeholder="Enter New Password">
                                        </div>
                                        <div class="form-group">
                                            <label for="confirm_password">Confirm Password</label>&nbsp<span class="red-text">*</span>
                                            <input type="password" class="form-control mb-2"  name="confirm_password" id="confirm_password"
                                                placeholder="Confirm Password">
                                            <span id="passwordMatch" class="red-text"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 text-center">
                                         @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        <button type="submit" class="btn btn-sm btn-success" onclick="validatePassword()" id="submitButton" >
                                            Save &amp; Submit
                                        </button>
                                        <span><a href="{{ route('/dashboard') }}"  class="btn btn-sm btn-primary">Back</a></span>
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
        function validatePassword() {
            var newPassword = document.getElementById("new_password").value;
            var confirmPassword = document.getElementById("confirm_password").value;

            if (newPassword === confirmPassword) {
                document.getElementById("passwordMatch").innerHTML = "";
                
            } else {
                document.getElementById("passwordMatch").innerHTML = "Passwords do not match";
            }
        }
    </script>
@endsection
