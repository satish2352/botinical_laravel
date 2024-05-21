@extends('admin.layouts.master')

@section('content')
<div class="data-table-area mg-tb-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="sparkline13-list">
                    <div class="sparkline13-hd">
                        <div class="main-sparkline13-hd">
                            <h1>User <span class="table-project-n">Data</span> Table</h1>
                            <div class="form-group-inner login-btn-inner row">
                                <div class="col-lg-2">
                                    <div class="login-horizental cancel-wp pull-left">
                                        <a href="{{ route('add-users') }}"><button
                                                class="btn btn-sm btn-primary login-submit-cs" type="submit"
                                                href="{{ route('add-users') }}">Add User</button></a>
                                    </div>
                                </div>
                                <div class="col-lg-10"></div>
                            </div>
                        </div>
                    </div>



            <div class="row">
                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    @include('admin.layouts.alert')
                                    <div class="table-responsive">
                                        <table id="table" 
                                        data-toggle="table" 
                                        data-pagination="true" data-search="true" data-show-columns="true"
                                             data-show-pagination-switch="true" data-show-refresh="true"
                                            data-key-events="true" data-show-toggle="true" data-resizable="true"
                                            data-cookie="true" data-cookie-id-table="saveId" data-show-export="true"
                                            data-click-to-select="true" data-toolbar="#toolbar">
                                            <thead>
                                                <tr>
                                                    <th>Sr. No.</th>
                                                    <th>Name</th>
                                                    <th>Role</th>
                                                    <th>Email</th>
                                                    <th>Address</th>
                                                    <th>Mobile</th>
                                                    <th>Profile</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($register_user as $item)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $item->full_name }}</td>
                                                        <td>{{ $item->role_id }}</td>
                                                        <td>{{ $item->email }}</td>
                                                        <td>{{ $item->Address }}</td>
                                                        <td>{{ $item->mobile_number }}</td>
                                                        <td> <img class="img-size"
                                                            src="{{ Config::get('DocumentConstant.USER_PROFILE_VIEW') }}{{ $item->user_profile }}"
                                                            alt="No Image" style="width:100px; height:100px;" />
                                                    </td>


                                                        <td>
                                                            <label class="switch">
                                                                <input data-id="{{ $item->id }}" type="checkbox"
                                                                    {{ $item->is_active ? 'checked' : '' }}
                                                                    class="active-btn btn btn-sm btn-outline-primary m-1"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="{{ $item->is_active ? 'Active' : 'Inactive' }}">
                                                                <span class="slider round "></span>
                                                            </label>

                                                        </td>


                                                        {{-- <td>@if ($item->is_active)
                                                        <button type="button" class="btn btn-success btn-sm">Active</button>
                                                        @else 
                                                        <button type="button" class="btn btn-danger btn-sm">In Active</button>
                                                        
                                                        @endif</td> --}}
                                                        <td class="d-flex">
                                                            <a href="{{ route('edit-users', base64_encode($item->id)) }}"
                                                                class="edit-btn btn btn-sm btn-outline-primary m-1"><i
                                                                    class="fas fa-pencil-alt"></i></a>
                                                            <a data-id="{{ $item->id }}"
                                                                class="show-btn btn btn-sm btn-outline-primary m-1"><i
                                                                    class="fas fa-eye"></i></a>
                                                            <a data-id="{{ $item->id }}"
                                                                class="delete-btn btn btn-sm btn-outline-danger m-1"
                                                                title="Delete Tender"><i class="fas fa-archive"></i></a>


                                                        </td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
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
    </div>
</div>
        <form method="POST" action="{{ url('/delete-users') }}" id="deleteform">
            @csrf
            <input type="hidden" name="delete_id" id="delete_id" value="">
        </form>
        <form method="POST" action="{{ url('/show-users') }}" id="showform">
            @csrf
            <input type="hidden" name="show_id" id="show_id" value="">
        </form>
        {{-- <form method="GET" action="{{ url('/edit-users') }}" id="editform">
            @csrf
            <input type="hidden" name="edit_id" id="edit_id" value="">
        </form> --}}
        <form method="POST" action="{{ url('/update-active-user') }}" id="activeform">
            @csrf
            <input type="hidden" name="active_id" id="active_id" value="">
        </form>

        <!-- content-wrapper ends -->
    @endsection
