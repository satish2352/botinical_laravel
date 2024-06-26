<!-- Static Table Start -->
@extends('admin.layouts.master')
@section('content')
<style>
.fixed-table-loading {
    display: none;
} 
/*
#table thead th {
    white-space: nowrap;
}
#table thead th{
    width: 300px !important; 
    padding-right: 49px !important;
padding-left: 20px !important;
}
.custom-datatable-overright table tbody tr td {
    padding-left: 19px !important;
    padding-right: 5px !important;
    font-size: 14px;
    text-align: left;
} */
</style>
<?php $data_permission = getPermissionForCRUDPresentOrNot('list-slide', session('permissions'));
    ?>
<div class="data-table-area mg-tb-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="sparkline13-list">
                    <div class="sparkline13-hd">
                        <div class="main-sparkline13-hd">
                            <h1>Conatct Information <span class="table-project-n">Data</span> Table</h1>
                                {{-- <div class="form-group-inner login-btn-inner row">
                                    <div class="col-lg-2" >
                                        <div class="login-horizental cancel-wp pull-left">
                                                <a href="{{ route('add-charges') }}" ><button class="btn btn-sm btn-primary login-submit-cs" type="submit" href="{{route('add-charges')}}">Add Charges</button></a>
                                        </div>
                                    </div>
                                <div class="col-lg-10"></div>
                            </div> --}}
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
                                            <th>Director Number</th>
                                            <th>निदेशक क्रमांक</th>
                                            <th>Officer Number</th>
                                            <th>अधिकारी क्रमांक</th>
                                            <th>Email</th>
                                            <th>Address</th>
                                            <th>पता</th>
                                            
                                            <th> Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data_output as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ strip_tags($item->english_director_number) }}</td>
                                                <td>{{ strip_tags($item->hindi_director_number) }}</td>
                                                <td>{{ strip_tags($item->english_officer_number) }}</td>
                                                <td>{{ strip_tags($item->hindi_officer_number) }}</td>
                                                <td>{{ strip_tags($item->email) }}</td>
                                                <td>{{ strip_tags($item->english_address) }}</td>
                                                <td>{{ strip_tags($item->hindi_address) }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        @if (in_array('per_update', $data_permission))
                                                        <a href="{{ route('edit-contact-information', base64_encode($item->id)) }}"
                                                            class="btn btn-sm btn-outline-primary m-1"
                                                            title="Edit"><i class="fas fa-pencil-alt"></i></a>
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

    <form method="POST" action="{{ url('/delete-charges') }}" id="deleteform">
        @csrf
        <input type="hidden" name="delete_id" id="delete_id" value="">
    </form>
    <form method="POST" action="{{ url('/update-one-charges') }}" id="activeform">
        @csrf
        <input type="hidden" name="active_id" id="active_id" value="">
    </form>
@endsection
