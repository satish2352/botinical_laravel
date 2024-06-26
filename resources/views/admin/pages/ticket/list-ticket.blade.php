<!-- Static Table Start -->
@extends('admin.layouts.master')
@section('content')
    <style>
        .fixed-table-loading {
            display: none;
        }
    </style>
<?php $data_permission = getPermissionForCRUDPresentOrNot('list-ticket', session('permissions'));
    ?>
    <div class="data-table-area mg-tb-15">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="sparkline13-list">
                        <div class="sparkline13-hd">
                            <div class="main-sparkline13-hd">
                                <h1>Ticket <span class="table-project-n">Data</span> Table</h1>
                                <div class="form-group-inner login-btn-inner row">
                                    <div class="col-lg-2">
                                        <div class="login-horizental cancel-wp pull-left">
                                            @if (in_array('per_add', $data_permission))
                                            <a href="{{ route('add-ticket') }}"><button
                                                    class="btn btn-sm btn-primary login-submit-cs" type="submit"
                                                    href="{{ route('add-ticket') }}">Add Ticket</button></a>
                                                    @endif
                                                </div>
                                    </div>
                                    <div class="col-lg-10"></div>
                                </div>
                            </div>
                        </div>

                        @if (Session::get('status') == 'success')
                            <div class="alert alert-success alert-success-style1">
                                <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                                    <span class="icon-sc-cl" aria-hidden="true">&times;</span>
                                </button>
                                <i class="fa fa-check adminpro-checked-pro admin-check-pro" aria-hidden="true"></i>
                                <p><strong>Success!</strong> {{ Session::get('msg') }}</p>
                            </div>
                        @endif
                        @if (Session::get('status') == 'error')
                            <div class="alert alert-danger alert-mg-b alert-success-style4">
                                <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                                    <span class="icon-sc-cl" aria-hidden="true">&times;</span>
                                </button>
                                <i class="fa fa-times adminpro-danger-error admin-check-pro" aria-hidden="true"></i>
                                <p><strong>Danger!</strong> {{ Session::get('msg') }}</p>
                            </div>
                        @endif

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
                                    <table id="table" 
                                    data-toggle="table" 
                                    data-pagination="true" data-search="true" data-show-columns="true"
                                         data-show-pagination-switch="true" data-show-refresh="true"
                                        data-key-events="true" data-show-toggle="true" data-resizable="true"
                                        data-cookie="true" data-cookie-id-table="saveId" data-show-export="true"
                                        data-click-to-select="true" data-toolbar="#toolbar"
                                        >
                                        <thead>
                                            <tr>
                                                <th data-field="id">Sr.No.</th>
                                                <th>Name</th>
                                                <th>नाम</th>
                                                <th>Description </th>
                                                <th>विवरण</th>
                                                <th>Ticket Cost </th>
                                                <th>टिकट की कीमत</th>
                                                <th>Terms and Rules </th>
                                                <th>नियम एवं शर्तें</th>
                                                <th>Status </th>
                                                <th> Action </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($ticket as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ strip_tags($item->english_name) }}</td>
                                                    <td>{{ strip_tags($item->hindi_name) }}</td>
                                                    <td class="truncate">{{ strip_tags($item->english_description) }}</td>
                                                    <td class="truncate">{{ strip_tags($item->hindi_description) }}</td>
                                                    <td>{{ strip_tags($item->english_ticket_cost) }}</td>
                                                    <td>{{ strip_tags($item->hindi_ticket_cost) }}</td>
                                                    <td>{{ strip_tags($item->english_rules_terms) }}</td>
                                                    <td>{{ strip_tags($item->hindi_rules_terms) }}</td>
                                                    <td>
                                                        <label class="switch">
                                                            <input data-id="{{ $item->id }}" type="checkbox"
                                                                {{ $item->is_active ? 'checked' : '' }}
                                                                class="active-btn btn btn-sm btn-outline-primary m-1"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="{{ $item->is_active ? 'Active' : 'Inactive' }}">
                                                            <span class="slider round"></span>
                                                        </label>

                                                    </td>
                                                    <td>
                                                        <div class="d-flex">
                                                            @if (in_array('per_update', $data_permission))
                                                            <a href="{{ route('edit-ticket', base64_encode($item->id)) }}"
                                                                class="btn btn-sm btn-outline-primary m-1"
                                                                title="Edit"><i class="fas fa-pencil-alt"></i></a>
                                                            @endif

                                                            <a data-id="{{ $item->id }}"
                                                                class="show-btn btn btn-sm btn-outline-primary m-1"
                                                                title="Show"><i class="fas fa-eye"></i></a>
                                                            @if (in_array('per_delete', $data_permission))
                                                            <a data-id="{{ $item->id }}"
                                                                class="delete-btn btn btn-sm btn-outline-danger m-1"
                                                                title="Delete"><i class="fas fa-archive"></i></a>
                                                            @endif

                                                        </div>
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
    <form method="POST" action="{{ url('/delete-ticket') }}" id="deleteform">
        @csrf
        <input type="hidden" name="delete_id" id="delete_id" value="">
    </form>
    <form method="POST" action="{{ url('/show-ticket') }}" id="showform">
        @csrf
        <input type="hidden" name="show_id" id="show_id" value="">
    </form>
    <form method="POST" action="{{ url('/update-active-ticket') }}" id="activeform">
        @csrf
        <input type="hidden" name="active_id" id="active_id" value="">
    </form>

    <!-- content-wrapper ends -->
<!-- Include jQuery before your custom script -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $('.delete-btn').click(function(e) {
    
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $("#delete_id").val($(this).attr("data-id"));
                    $("#deleteform").submit();
                }
            })
    
        });
    </script>
    
    
    <script>
        
        $('.show-btn').click(function(e) {
            alert('hii');
            $("#show_id").val($(this).attr("data-id"));
            $("#showform").submit();
        })
    </script>
    
    <script>
        $('.edit-user-btn').click(function(e) {
            $("#edit_user_id").val($(this).attr("data-id"));
            $("#edituserform").submit();
        })
    </script>
    
    <script>
        $('.active-btn').click(function(e) {
            $("#active_id").val($(this).attr("data-id"));
            $("#activeform").submit();
        })
    </script>
@endsection
