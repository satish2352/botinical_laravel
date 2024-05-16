<!-- Static Table Start -->
@extends('admin.layouts.master')
@section('content')
<style>
.fixed-table-loading {
    display: none;
} 

</style>

<div class="data-table-area mg-tb-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="sparkline13-list">
                    <div class="sparkline13-hd">
                        <div class="main-sparkline13-hd">
                            <h1>Contact Enquiry <span class="table-project-n">Data</span> Table</h1>
                                <div class="form-group-inner login-btn-inner row">
                                    {{-- <div class="col-lg-2" >
                                        <div class="login-horizental cancel-wp pull-left">
                                                <a href="{{ route('add-contact-enquiry') }}" ><button class="btn btn-sm btn-primary login-submit-cs" type="submit" href="{{route('add-charges')}}">Add Charges</button></a>
                                        </div>
                                    </div> --}}
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
                                            <th>Name </th>
                                            <th>Email </th>
                                            <th>Address </th>
                                            <th>Message </th>
                                            <th> Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data_output as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ strip_tags($item->full_name) }}</td>
                                                <td>{{ strip_tags($item->email) }}</td>
                                                <td>{{ strip_tags($item->address) }}</td>
                                                <td>{{ strip_tags($item->message) }}</td>
                                        
                                                <td>
                                                    <div class="d-flex">
                                                        {{-- @if (in_array('per_delete', $data_permission)) --}}
                                                        <a data-id="{{ $item->id }}"
                                                            class="delete-btn btn btn-sm btn-outline-danger m-1"
                                                            title="Delete"><i class="fas fa-archive"></i></a>
                                                        {{-- @endif --}}

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

    <form method="POST" action="{{ url('/delete-contact-enquiry') }}" id="deleteform">
        @csrf
        <input type="hidden" name="delete_id" id="delete_id" value="">
    </form>
   
@endsection
