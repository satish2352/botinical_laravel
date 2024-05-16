<?php $data_for_url = session('data_for_url'); ?>
<div class="left-sidebar-pro">
    <nav id="sidebar" class="">
        <div class="sidebar-header">
            <a href="index.html"><img class="main-logo" src="{{ asset('website/assets/img/logo/LANSCAPE LOG.png') }}"
                    alt=""></a>
            <strong><img src="{{ asset('website/assets/img/logo/LANSCAPE LOG.png') }}" alt=""></strong>
        </div>
        <div class="left-custom-menu-adp-wrap comment-scrollbar">
            <nav class="sidebar-nav left-sidebar-menu-pro">
                <ul class="metismenu" id="menu1">
                    <li class="{{ Request::is('list-contact-information') ? 'active' : '' }}">
                        <a class="has-arrow" href="{{ route('list-contact-information') }}" aria-expanded="false">
                            <i class="fa big-icon fa-envelope icon-wrap"></i>
                            <span class="mini-click-non">Dashboard</span>
                        </a>
                    </li> 
                    <li class="{{ Request::is('list-roles') ? 'active' : '' }}">
                        <a class="has-arrow" href="{{ route('list-roles') }}" aria-expanded="false">
                            <i class="fa big-icon fa-envelope icon-wrap"></i>
                            <span class="mini-click-non">Master</span>
                        </a>
                        <ul class="submenu-angle" aria-expanded="false">                          
                           
                            <li class="nav-item {{ Request::is('list-roles') ? 'active' : '' }}">
                                <a title="Inbox" href="{{ route('list-roles') }}">
                                    <i class="fa fa-inbox sub-icon-mg" aria-hidden="true"></i>
                                    <span class="mini-sub-pro">Roles</span>
                                </a>
                            </li>

                            <li class="nav-item {{ Request::is('list-amenities-category') ? 'active' : '' }}">
                                <a title="Inbox" href="{{ route('list-amenities-category') }}">
                                    <i class="fa fa-inbox sub-icon-mg" aria-hidden="true"></i>
                                    <span class="mini-sub-pro">Amenities Category</span>
                                </a>
                            </li>
                            <li class="{{ Request::is('list-charges') ? 'active' : '' }}">
                                <a class="has-arrow" href="{{ route('list-charges') }}" aria-expanded="false">
                                    <i class="fa big-icon fa-envelope icon-wrap"></i>
                                    <span class="mini-click-non">Charges</span>
                                </a>
                            </li> 
                            {{-- <li class="nav-item {{ Request::is('list-district') ? 'active' : '' }}">
                                <a title="Inbox" href="{{ route('list-district') }}">
                                    <i class="fa fa-inbox sub-icon-mg" aria-hidden="true"></i>
                                    <span class="mini-sub-pro">List District</span>
                                </a>
                            </li>

                            <li class="nav-item {{ Request::is('list-taluka') ? 'active' : '' }}">
                                <a title="Inbox" href="{{ route('list-taluka') }}">
                                    <i class="fa fa-inbox sub-icon-mg" aria-hidden="true"></i>
                                    <span class="mini-sub-pro">List Taluka</span>
                                </a>
                            </li>

                            <li class="nav-item {{ Request::is('list-village') ? 'active' : '' }}">
                                <a title="Inbox" href="{{ route('list-village') }}">
                                    <i class="fa fa-inbox sub-icon-mg" aria-hidden="true"></i>
                                    <span class="mini-sub-pro">List Village</span>
                                </a>
                            </li> --}}

                        </ul>
                    </li>
                    <li class="{{ Request::is('list-aboutus') ? 'active' : '' }}">
                        <a class="has-arrow" href="{{ route('list-aboutus') }}" aria-expanded="false">
                            <i class="fa big-icon fa-envelope icon-wrap"></i>
                            <span class="mini-click-non">About Us</span>
                        </a>
                    </li> 
                    <li class="{{ Request::is('list-zone-area') ? 'active' : '' }}">
                        <a class="has-arrow" href="{{ route('list-zone-area') }}" aria-expanded="false">
                            <i class="fa big-icon fa-envelope icon-wrap"></i>
                            <span class="mini-click-non">Zone Management</span>
                        </a>
                    </li> 
                    <li class="{{ Request::is('list-tress') ? 'active' : '' }}">
                        <a class="has-arrow" href="{{ route('list-tress') }}" aria-expanded="false">
                            <i class="fa big-icon fa-envelope icon-wrap"></i>
                            <span class="mini-click-non">Product</span>
                        </a>
                        <ul class="submenu-angle" aria-expanded="false">                          
                           
                            <li class="{{ Request::is('list-tress') ? 'active' : '' }}">
                                <a class="has-arrow" href="{{ route('list-tress') }}" aria-expanded="false">
                                    <i class="fa fa-tree icon-wrap"></i>
                                    <span class="mini-click-non">Trees Management</span>
                                </a>
                            </li> 
                            <li class="{{ Request::is('list-flowers') ? 'active' : '' }}">
                                <a class="has-arrow" href="{{ route('list-flowers') }}" aria-expanded="false">
                                    <i class="fa big-icon fa-envelope icon-wrap"></i>
                                    <span class="mini-click-non">Flowers Management</span>
                                </a>
                            </li> 
                            <li class="{{ Request::is('list-amenities') ? 'active' : '' }}">
                                <a class="has-arrow" href="{{ route('list-amenities') }}" aria-expanded="false">
                                    <i class="fa big-icon fa-envelope icon-wrap"></i>
                                    <span class="mini-click-non">Amenities Management</span>
                                </a>
                            </li> 

                        </ul>
                    </li>




                   
                    <li class="{{ Request::is('list-roles') ? 'active' : '' }}">
                        <a class="has-arrow" href="{{ route('list-roles') }}" aria-expanded="false">
                            <i class="fa big-icon fa-envelope icon-wrap"></i>
                            <span class="mini-click-non">Facilities Management</span>
                        </a>
                    </li> 
                    <li class="{{ Request::is('list-ticket') ? 'active' : '' }}">
                        <a class="has-arrow" href="{{ route('list-ticket') }}" aria-expanded="false">
                            <i class="fa big-icon fa-envelope icon-wrap"></i>
                            <span class="mini-click-non">Ticket Management</span>
                        </a>
                    </li> 
                    <li class="{{ Request::is('list-gallery') ? 'active' : '' }}">
                        <a class="has-arrow" href="{{ route('list-gallery') }}" aria-expanded="false">
                            <i class="fa big-icon fa-envelope icon-wrap"></i>
                            <span class="mini-click-non">Gallery</span>
                        </a>
                    </li> 
                 
                    <li class="{{ Request::is('list-contact-information') ? 'active' : '' }}">
                        <a class="has-arrow" href="{{ route('list-contact-information') }}" aria-expanded="false">
                            <i class="fa big-icon fa-envelope icon-wrap"></i>
                            <span class="mini-click-non">Contact Details</span>
                        </a>
                    </li> 
                    <li class="{{ Request::is('list-contact-enquiry') ? 'active' : '' }}">
                        <a class="has-arrow" href="{{ route('list-contact-enquiry') }}" aria-expanded="false">
                            <i class="fa big-icon fa-envelope icon-wrap"></i>
                            <span class="mini-click-non">Contact Enquiry</span>
                        </a>
                    </li> 
                    <li class="{{ Request::is('list-roles', 'organizations-list-employees',  'list-roles', 'list-district', 'list-taluka', 'list-village') ? 'active' : '' }}">
                        <a class="has-arrow" href="{{ route('list-roles') }}" aria-expanded="false">
                            <i class="fa big-icon fa-envelope icon-wrap"></i>
                            <span class="mini-click-non">User Management</span>
                        </a>
                    </li> 
                    <li class="{{ Request::is('list-roles', 'organizations-list-employees',  'list-roles', 'list-district', 'list-taluka', 'list-village') ? 'active' : '' }}">
                        <a class="has-arrow" href="{{ route('list-roles') }}" aria-expanded="false">
                            <i class="fa big-icon fa-envelope icon-wrap"></i>
                            <span class="mini-click-non">Reporting and Analytics</span>
                        </a>
                    </li> 



                </ul>
            </nav>
        </div>
    </nav>
</div>
<div class="all-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="logo-pro">
                    <a href="index.html"><img class="main-logo" src="{{ asset('img/logo/logo.png') }}"
                            alt=""></a>
                </div>
            </div>
        </div>
    </div>
    <div class="header-advance-area">
        <div class="header-top-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="header-top-wraper">
                            <div class="row">
                                <div class="col-lg-1 col-md-0 col-sm-1 col-xs-12">
                                    <div class="menu-switcher-pro">
                                        <button type="button" id="sidebarCollapse"
                                            class="btn bar-button-pro header-drl-controller-btn btn-info navbar-btn">
                                            <i class="fa fa-bars"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-7 col-sm-6 col-xs-12">
                                    <div class="header-top-menu tabl-d-n">
                                        <ul class="nav navbar-nav mai-top-nav">

                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                                    <div class="header-right-info">
                                        <ul class="nav navbar-nav mai-top-nav header-right-menu">                                          
                                            <li class="nav-item">
                                                <a href="#" data-toggle="dropdown" role="button"
                                                    aria-expanded="false" class="nav-link dropdown-toggle">
                                                    <i class="fa fa-user adminpro-user-rounded header-riht-inf"
                                                        aria-hidden="true"></i>
                                                    <span class="admin-name"></span>
                                                    <i class="fa fa-angle-down adminpro-icon adminpro-down-arrow"></i>
                                                </a>
                                                <ul role="menu"
                                                    class="dropdown-header-top author-log dropdown-menu animated zoomIn">

                                                    <li><a href="{{ route('log-out') }}"><span
                                                                class="fa fa-lock author-log-ic"></span>Log Out</a>
                                                    </li>
                                                </ul>
                                            </li>

                                        </ul>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- </div> -->

