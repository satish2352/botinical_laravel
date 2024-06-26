@extends('admin.layouts.master')

@section('content')
    <?php $data_permission = getPermissionForCRUDPresentOrNot('list-role', session('permissions'));
    ?>
  
                                    <div class="data-table-area mg-tb-15">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="sparkline13-list">
                                                        <div class="sparkline13-hd">
                                                            <div class="main-sparkline13-hd">
                                                                <h1>Role <span class="table-project-n">Data</span> Table</h1>
                                                                    <div class="form-group-inner login-btn-inner row">
                                                                        <div class="col-lg-2" >
                                                                            <div class="login-horizental cancel-wp pull-left">
                                                                                Role List
                                                                                @if (in_array('per_add', $data_permission))


                                                                                <a href="{{ route('add-role') }}"><button
                                                                                    class="btn btn-sm btn-primary login-submit-cs" type="submit"
                                                                                    href="{{ route('add-role') }}">Add Role</button></a>

                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    <div class="col-lg-10"></div>
                                                                </div>
                                                            </div>
                                                        </div>






                                    @include('admin.layouts.alert')
                                    <div class="sparkline13-graph">
                                        <div class="datatable-dashv1-list custom-datatable-overright">
                                            <div id="toolbar">
                                                <select class="form-control">
                                                    <option value="">Export Basic</option>
                                                    <option value="all">Export All</option>
                                                    <option value="selected">Export Selected</option>
                                                </select>
                                            </div>
                                            <div class="table-responsive">
                                                <table id="order-listing" class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Sr. No.</th>
                                                            <th>Role Name</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($roles as $item)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $item->role_name }}</td>
                                                                <!-- <td>
                                                                        <button data-id="{{ $item->id }}" type="submit"
                                                                            class="active-btn btn btn-sm btn-outline-primary m-1"
                                                                            data-toggle="tooltip" data-placement="top"
                                                                            title="{{ $item->is_active ? 'Active' : 'Inactive' }}">
                                                                            <span class="status-icon {{ $item->is_active ? '1' : '0' }}">
                                                                                <i
                                                                                    class="fa {{ $item->is_active ? 'fa-thumbs-up' : 'fa-thumbs-down' }}"></i>
                                                                            </span>
                                                                        </button>
                                                                    </td> -->
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
                                                                <td class="d-flex">
                                                                    @if (in_array('per_update', $data_permission))
                                                                        <a href="{{ route('edit-role', base64_encode($item->id)) }}"
                                                                            class="btn btn-sm btn-outline-primary m-1"
                                                                            title="Edit"><i
                                                                                class="fas fa-pencil-alt"></i></a>
                                                                    @endif

                                                                    {{-- <a data-id="{{ $item->id }}"
                                                                        class="show-btn btn btn-sm btn-outline-primary m-1"
                                                                        title="Show"><i class="fas fa-eye"></i></a> --}}
                                                                    @if (in_array('per_delete', $data_permission))
                                                                        <a data-id="{{ $item->id }}"
                                                                            class="delete-btn btn btn-sm btn-outline-danger m-1"
                                                                            title="Delete"><i
                                                                                class="fas fa-archive"></i></a>
                                                                    @endif

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
        <form method="POST" action="{{ url('/delete-role') }}" id="deleteform">
            @csrf
            <input type="hidden" name="delete_id" id="delete_id" value="">
        </form>
        <form method="POST" action="{{ url('/show-role') }}" id="showform">
            @csrf
            <input type="hidden" name="show_id" id="show_id" value="">
        </form>
        <form method="POST" action="{{ url('/update-one-role') }}" id="activeform">
            @csrf
            <input type="hidden" name="active_id" id="active_id" value="">
        </form>
    @endsection
