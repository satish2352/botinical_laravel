@extends('admin.layouts.master')

@section('content')
    <div class="data-table-area mg-tb-15">
        <div class="container-fluid">
            <div class="row showpage">
                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                    <div class="sparkline13-list">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 d-flex justify-content-start align-items-center">
                                <h3 class="page-title">
                                    Ticket Details
                                </h3>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 d-flex justify-content-end align-items-center">
                                <div>
                                    <a href="{{ route('list-ticket') }}" class="btn btn-sm btn-primary ml-3">Back</a>
                                </div>
                            </div>

                        </div>
                        <div class="card mt-2">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="row ">
                                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                                        <label>Name :</label>
                                                    </div>
                                                    <div class="col-lg-8 col-md-8 col-sm-8">
                                                        <label>{{ strip_tags($ticket->english_name) }}</label>
                                                    </div>
                                                </div>
                                                <div class="row ">
                                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                                        <label>नाम :</label>
                                                    </div>
                                                    <div class="col-lg-8 col-md-8 col-sm-8">
                                                        <label>{{ strip_tags($ticket->hindi_name) }}</label>
                                                    </div>
                                                </div>
                                                <div class="row ">
                                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                                        <label>Description :</label>
                                                    </div>
                                                    <div class="col-lg-8 col-md-8 col-sm-8">
                                                        <label>{{ strip_tags($ticket->english_description) }}</label>
                                                    </div>
                                                </div>
                                                <div class="row ">
                                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                                        <label>वर्णन :</label>
                                                    </div>
                                                    <div class="col-lg-8 col-md-8 col-sm-8">
                                                        <label>{{ strip_tags($ticket->hindi_description) }}</label>
                                                    </div>
                                                </div>
                                                <div class="row ">
                                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                                        <label>Ticket Cost :</label>
                                                    </div>
                                                    <div class="col-lg-8 col-md-8 col-sm-8">
                                                        <label>{{ strip_tags($ticket->english_ticket_cost) }}</label>
                                                    </div>
                                                </div>
                                                <div class="row ">
                                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                                        <label>टिकट की कीमत :</label>
                                                    </div>
                                                    <div class="col-lg-8 col-md-8 col-sm-8">
                                                        <label>{{ strip_tags($ticket->hindi_ticket_cost) }}</label>
                                                    </div>
                                                </div>
                                                <div class="row ">
                                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                                        <label>Rules Terms :</label>
                                                    </div>
                                                    <div class="col-lg-8 col-md-8 col-sm-8">
                                                        <label>{{ strip_tags($ticket->english_rules_terms) }}</label>
                                                    </div>
                                                </div>
                                                <div class="row ">
                                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                                        <label>नियम शर्तें :</label>
                                                    </div>
                                                    <div class="col-lg-8 col-md-8 col-sm-8">
                                                        <label>{{ strip_tags($ticket->hindi_rules_terms) }}</label>
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


                <!-- content-wrapper ends -->
            @endsection
