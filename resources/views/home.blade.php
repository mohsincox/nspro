@extends('layouts.app')

@section('content')
<div class="container mt-1">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body" style="background-color: #ECF0F5">
                <!-- <div class="card-body" style="background-color: #b0ecf9"> -->
                    
                    <div class="row">
                        <div class="col-md-4 col-sm-12 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-aqua"><i class="fa fa-clock-o"></i></span>
                                <div class="info-box-content">
                                    <center><span class="info-box-text" style="font-size: 35px;">{{ date("h:i") }}</span></center>
                                    <center><span class="info-box-number" style="font-size: 18px;">{{ date("m/d/Y") }}</span></center>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>
                                <div class="info-box-content">
                                    <center><span class="info-box-text" style="font-size: 18px;">Users</span></center>
                                    <center><span class="info-box-number" style="font-size: 35px;">{{ $userCount }}</span></center>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-aqua"><i class="fa fa-phone"></i></span>
                                <div class="info-box-content">
                                    <center><span class="info-box-text" style="font-size: 18px;">Profile (Total)</span></center>
                                    <center><span class="info-box-number" style="font-size: 35px;">{{ $profileTotalCount }}</span></center>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- =========================================================== -->

                    <div class="row">
                        <div class="col-md-4 col-sm-12 col-12">
                            <div class="info-box bg-green">
                                <span class="info-box-icon"><i class="fa fa-hand-o-right"></i></span>
                                <div class="info-box-content">
                                    <center><span class="info-box-text" style="font-size: 18px;">Profile (Today)</span></center>
                                    <center><span class="info-box-number" style="font-size: 35px;">{{ $profileTodayCount }}</span></center>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12 col-12">
                            <div class="info-box bg-green">
                                <span class="info-box-icon"><i class="fa fa-bullhorn"></i></span>
                                <div class="info-box-content">
                                    <center><span class="info-box-text" style="font-size: 18px;">CRM (Total) Inbound Call</span></center>
                                    <center><span class="info-box-number" style="font-size: 35px;">{{ $crmTotalCount }}</span></center>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12 col-12">
                            <div class="info-box bg-green">
                                <span class="info-box-icon"><i class="fa fa-tty"></i></span>
                                <div class="info-box-content">
                                    <center><span class="info-box-text" style="font-size: 18px;">CRM (Today) Inbound Call</span></center>
                                    <center><span class="info-box-number" style="font-size: 35px;">{{ $crmTodayCount }}</span></center>
                                </div>
                            </div>
                        </div> 
                    </div>

                    <!-- =========================================================== -->

                     <div class="row">
                        <div class="col-md-4 col-sm-12 col-12">
                            <div class="info-box">
                                <span class="info-box-icon purple" style="color: #FFFFFF !important;"><i class="fa fa-bell-o"></i></span>
                                <div class="info-box-content">
                                    <center><span class="info-box-text" style="font-size: 18px;">Category</span></center>
                                    <center><span class="info-box-number" style="font-size: 35px;">{{ $categoryCount }}</span></center>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12 col-12">
                            <div class="info-box">
                                <span class="info-box-icon purple" style="color: #FFFFFF !important;"><i class="fa fa-bar-chart"></i></span>
                                <div class="info-box-content">
                                    <center><span class="info-box-text" style="font-size: 18px;">Brand</span></center>
                                    <center><span class="info-box-number" style="font-size: 35px;">{{ $brandCount - 2 }}</span></center>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12 col-12">
                            <div class="info-box">
                                <span class="info-box-icon purple" style="color: #FFFFFF !important;"><i class="fa fa-headphones"></i></span>
                                <div class="info-box-content">
                                    <center><span class="info-box-text" style="font-size: 18px;">Product</span></center>
                                    <center><span class="info-box-number" style="font-size: 35px;">{{ $productCount }}</span></center>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- =========================================================== -->

                    <div class="row">
                        <div class="col-md-4 col-sm-12 col-12">
                            <div class="info-box bg-red">
                                <span class="info-box-icon "><i class="fa fa-pause"></i></span>
                                <div class="info-box-content">
                                    <center><span class="info-box-text" style="font-size: 18px;">Division</span></center>
                                    <center><span class="info-box-number" style="font-size: 35px;">{{ $divisionCount - 1 }}</span></center>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12 col-12">
                            <div class="info-box bg-red">
                                <span class="info-box-icon "><i class="fa fa-arrow-right"></i></span>
                                <div class="info-box-content">
                                    <center><span class="info-box-text" style="font-size: 18px;">District</span></center>
                                    <center><span class="info-box-number" style="font-size: 35px;">{{ $districtCount - 1 }}</span></center>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12 col-12">
                            <div class="info-box bg-red">
                                <span class="info-box-icon "><i class="fa fa-share"></i></span>
                                <div class="info-box-content">
                                    <center><span class="info-box-text" style="font-size: 18px;">Thana</span></center>
                                    <center><span class="info-box-number" style="font-size: 35px;">{{ $policeStationCount - 1 }}</span></center>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- =========================================================== -->

                    <!-- <div class="row">
                        <div class="col-md-4 col-sm-12 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-yellow"><i class="fa fa-tablet"></i></span>
                                <div class="info-box-content">
                                    <center><span class="info-box-text" style="font-size: 18px;">Nestle Profile</span></center>
                                    <center><span class="info-box-number" style="font-size: 35px;">{{ 00 }}</span></center>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-yellow"><i class="fa fa-check"></i></span>
                                <div class="info-box-content">
                                    <center><span class="info-box-text" style="font-size: 18px;">Nestle Profile</span></center>
                                    <center><span class="info-box-number" style="font-size: 35px;">{{ 00 }}</span></center>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-yellow"><i class="fa fa-paper-plane"></i></span>
                                <div class="info-box-content">
                                    <center><span class="info-box-text" style="font-size: 18px;">Nestle Profile</span></center>
                                    <center><span class="info-box-number" style="font-size: 35px;">{{ 00 }}</span></center>
                                </div>
                            </div>
                        </div>
                    </div> -->

                    <!-- =========================================================== -->

                    <!-- Small boxes (Stat box) -->
                    <!-- <div class="row">
                        <div class="col-md-4 col-sm-12 col-12">
                            <div class="small-box bg-aqua" style="background-color: #008080 !important;">
                                <div class="inner">
                                    <h3>{{ 00 }}</h3>
                                    <p><b>Nestle Profile</b></p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-files-o"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12 col-12">
                            <div class="small-box bg-aqua" style="background-color: #008080 !important;">
                                <div class="inner">
                                    <h3>{{ 00 }}</h3>
                                    <p><b>Nestle Profile</b></p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-clipboard"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12 col-12">
                            <div class="small-box bg-aqua" style="background-color: #008080 !important;">
                                <div class="inner">
                                    <h3>{{ 00 }}</h3>
                                    <p><b>Nestle Profile</b></p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                            </div>
                        </div>
                    </div> -->

                    <!-- =========================================================== -->
                    
                    <!-- Small boxes (Stat box) -->
                    <!-- <div class="row">
                        <div class="col-md-4 col-sm-12 col-12">
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3>{{ 66 }}</h3>
                                    <p><b>Nestle Profile</b></p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-hand-o-right"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12 col-12">
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3>{{ 00 }}</h3>
                                    <p><b>Nestle Profile</b></p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-anchor"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12 col-12">
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3>{{ 00 }}</h3>
                                    <p><b>Nestle Profile</b></p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-tablet"></i>
                                </div>
                            </div>
                        </div>
                    </div> -->

                    <!-- =========================================================== -->

                    <!-- <div class="row">
                        <div class="col-md-3 col-sm-12 col-12">
                            <div class="circle-tile ">
                                <div class="circle-tile-heading green"><i class="fa fa-users fa-fw fa-3x"></i></div>
                                <div class="circle-tile-content green" style="padding-top: 40px;">
                                    <div class="circle-tile-number text-faded" id="new_total" style="font-size: 32px;">{{ 00 }}</div>
                                    <div class="circle-tile-description text-faded"> <h4 style="margin-top: 0; margin-bottom: 0;"> Nestle Profile </h4> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12 col-12">
                            <div class="circle-tile ">
                                <div class="circle-tile-heading blue"><i class="fa fa-calendar fa-fw fa-3x"></i></div>
                                <div class="circle-tile-content blue" style="padding-top: 40px;">
                                    <div class="circle-tile-number text-faded" id=""  style="font-size: 32px;">{{ 00 }}</div>
                                    <div class="circle-tile-description text-faded"> <h4 style="margin-top: 0; margin-bottom: 0;"> Nestle Profile </h4></div> 
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12 col-12">
                            <div class="circle-tile ">
                                <div class="circle-tile-heading dark-blue"><i class="fa fa-check fa-fw fa-3x"></i></div>
                                <div class="circle-tile-content dark-blue" style="padding-top: 40px;">
                                    <div class="circle-tile-number text-faded" id=""  style="font-size: 32px;">{{ 00 }}</div>
                                    <div class="circle-tile-description text-faded"> <h4 style="margin-top: 0; margin-bottom: 0;"> Nestle Profile </h4></div> 
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12 col-12">
                            <div class="circle-tile ">
                                <div class="circle-tile-heading purple"><i class="fa fa-paper-plane fa-fw fa-3x"></i></div>
                                <div class="circle-tile-content purple" style="padding-top: 40px;">
                                    <div class="circle-tile-number text-faded" id="answered_total"  style="font-size: 32px;">{{ 00 }}</div>
                                    <div class="circle-tile-description text-faded"> <h4 style="margin-top: 0; margin-bottom: 0;"> Nestle Profile </h4></div> 
                                </div>
                            </div>
                        </div>
                    </div> -->

                    <!-- =========================================================== -->

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('style')
    <link href="{{ asset('assets/css/style.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style_dash.css') }}" rel="stylesheet">
@endsection
