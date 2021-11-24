@extends('layouts.app')

@section('content')
<div class="container mt-1">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Brand Dashboard</div>

                <div class="card-body" style="background-color: #ECF0F5">
                <!-- <div class="card-body" style="background-color: #b0ecf9"> -->
                    
                    <div class="row">
                        <div class="col-md-4 col-sm-12 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-aqua"><i class="fa fa-clock-o"></i></span>
                                <div class="info-box-content">
                                    <center><span class="info-box-text" style="font-size: 18px;">Lactogen</span></center>
                                    <center><span class="info-box-number" style="font-size: 35px;">{{ $brand1Count }}</span></center>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>
                                <div class="info-box-content">
                                    <center><span class="info-box-text" style="font-size: 18px;">NAN</span></center>
                                    <center><span class="info-box-number" style="font-size: 35px;">{{ $brand2Count }}</span></center>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-aqua"><i class="fa fa-phone"></i></span>
                                <div class="info-box-content">
                                    <center><span class="info-box-text" style="font-size: 18px;">GUM</span></center>
                                    <center><span class="info-box-number" style="font-size: 35px;">{{ $brand3Count }}</span></center>
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
                                    <center><span class="info-box-text" style="font-size: 18px;">CERELAC</span></center>
                                    <center><span class="info-box-number" style="font-size: 35px;">{{ $brand4Count }}</span></center>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12 col-12">
                            <div class="info-box bg-green">
                                <span class="info-box-icon"><i class="fa fa-bullhorn"></i></span>
                                <div class="info-box-content">
                                    <center><span class="info-box-text" style="font-size: 18px;">Nescafe</span></center>
                                    <center><span class="info-box-number" style="font-size: 35px;">{{ $brand5Count }}</span></center>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12 col-12">
                            <div class="info-box bg-green">
                                <span class="info-box-icon"><i class="fa fa-tty"></i></span>
                                <div class="info-box-content">
                                    <center><span class="info-box-text" style="font-size: 18px;">Nesfruita</span></center>
                                    <center><span class="info-box-number" style="font-size: 35px;">{{ $brand6Count }}</span></center>
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
                                    <center><span class="info-box-text" style="font-size: 18px;">Nestle Everyday</span></center>
                                    <center><span class="info-box-number" style="font-size: 35px;">{{ $brand7Count }}</span></center>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12 col-12">
                            <div class="info-box">
                                <span class="info-box-icon purple" style="color: #FFFFFF !important;"><i class="fa fa-bar-chart"></i></span>
                                <div class="info-box-content">
                                    <center><span class="info-box-text" style="font-size: 18px;">Maggi Soup</span></center>
                                    <center><span class="info-box-number" style="font-size: 35px;">{{ $brand8Count }}</span></center>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12 col-12">
                            <div class="info-box">
                                <span class="info-box-icon purple" style="color: #FFFFFF !important;"><i class="fa fa-headphones"></i></span>
                                <div class="info-box-content">
                                    <center><span class="info-box-text" style="font-size: 18px;">Maggi Noodles</span></center>
                                    <center><span class="info-box-number" style="font-size: 35px;">{{ $brand9Count }}</span></center>
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
                                    <center><span class="info-box-text" style="font-size: 18px;">MAGGI Seasoning Mix</span></center>
                                    <center><span class="info-box-number" style="font-size: 35px;">{{ $brand10Count }}</span></center>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12 col-12">
                            <div class="info-box bg-red">
                                <span class="info-box-icon "><i class="fa fa-arrow-right"></i></span>
                                <div class="info-box-content">

                                    <center><span class="info-box-text" style="font-size: 18px;">Maggi Sauce</span></center>

                                    <center><span class="info-box-number" style="font-size: 35px;">{{ $brand11Count }}</span></center>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12 col-12">
                            <div class="info-box bg-red">
                                <span class="info-box-icon "><i class="fa fa-share"></i></span>
                                <div class="info-box-content">
                                    <center><span class="info-box-text" style="font-size: 18px;">Corn Flakes</span></center>
                                    <center><span class="info-box-number" style="font-size: 35px;">{{ $brand12Count }}</span></center>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- =========================================================== -->

                    <div class="row">
                        <div class="col-md-4 col-sm-12 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-yellow"><i class="fa fa-tablet"></i></span>
                                <div class="info-box-content">
                                    <center><span class="info-box-text" style="font-size: 18px;">Koko Krunch</span></center>
                                    <center><span class="info-box-number" style="font-size: 35px;">{{ $brand13Count }}</span></center>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-yellow"><i class="fa fa-check"></i></span>
                                <div class="info-box-content">
                                    <center><span class="info-box-text" style="font-size: 18px;">MILO Cereal</span></center>
                                    <center><span class="info-box-number" style="font-size: 35px;">{{ $brand14Count }}</span></center>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-yellow"><i class="fa fa-paper-plane"></i></span>
                                <div class="info-box-content">
                                    <center><span class="info-box-text" style="font-size: 18px;">Honey Star</span></center>
                                    <center><span class="info-box-number" style="font-size: 35px;">{{ $brand15Count }}</span></center>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- =========================================================== -->

                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-md-4 col-sm-12 col-12">
                            <div class="small-box bg-aqua" style="background-color: #008080 !important;">
                                <div class="inner">
                                    <h3>{{ $brand16Count }}</h3>
                                    <p><b>Kitkat</b></p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-files-o"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12 col-12">
                            <div class="small-box bg-aqua" style="background-color: #008080 !important;">
                                <div class="inner">
                                    <h3>{{ $brand17Count }}</h3>
                                    <p><b>Munch</b></p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-clipboard"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12 col-12">
                            <div class="small-box bg-aqua" style="background-color: #008080 !important;">
                                <div class="inner">
                                    <h3>{{ $brand18Count }}</h3>
                                    <p><b>Bar One</b></p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- =========================================================== -->
                    
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-md-4 col-sm-12 col-12">
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3>{{ $brand19Count }}</h3>
                                    <p><b>Nestle Classic</b></p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-hand-o-right"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12 col-12">
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3>{{ $brand20Count }}</h3>
                                    <p><b>Milky Bar</b></p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-anchor"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12 col-12">
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3>{{ $brand21Count }}</h3>
                                    <p><b>Multi Product</b></p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-tablet"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- =========================================================== -->

                    <div class="row">
                        <div class="col-md-3 col-sm-12 col-12">
                            <div class="circle-tile ">
                                <div class="circle-tile-heading green"><i class="fa fa-users fa-fw fa-3x"></i></div>
                                <div class="circle-tile-content green" style="padding-top: 40px;">
                                    <div class="circle-tile-number text-faded" id="new_total" style="font-size: 32px;">{{ $brand22Count }}</div>
                                    <div class="circle-tile-description text-faded"> <h4 style="margin-top: 0; margin-bottom: 0;">  N/A </h4> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12 col-12">
                            <div class="circle-tile ">
                                <div class="circle-tile-heading blue"><i class="fa fa-calendar fa-fw fa-3x"></i></div>
                                <div class="circle-tile-content blue" style="padding-top: 40px;">
                                    <div class="circle-tile-number text-faded" id=""  style="font-size: 32px;">{{ $brand23Count }}</div>
                                    <div class="circle-tile-description text-faded"> <h4 style="margin-top: 0; margin-bottom: 0;">  Corporate </h4></div> 
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12 col-12">
                            <div class="circle-tile ">
                                <div class="circle-tile-heading dark-blue"><i class="fa fa-check fa-fw fa-3x"></i></div>
                                <div class="circle-tile-content dark-blue" style="padding-top: 40px;">
                                    <div class="circle-tile-number text-faded" id=""  style="font-size: 32px;">{{ $brand24Count }}</div>
                                    <div class="circle-tile-description text-faded"> <h4 style="margin-top: 0; margin-bottom: 0;"> NIDO </h4></div> 
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12 col-12">
                            <div class="circle-tile ">
                                <div class="circle-tile-heading purple"><i class="fa fa-paper-plane fa-fw fa-3x"></i></div>
                                <div class="circle-tile-content purple" style="padding-top: 40px;">
                                    <div class="circle-tile-number text-faded" id="answered_total"  style="font-size: 32px;">{{ $brand25Count }}</div>
                                    <div class="circle-tile-description text-faded"> <h4 style="margin-top: 0; margin-bottom: 0;"> Baby & Me </h4></div> 
                                </div>
                            </div>
                        </div>
                    </div>

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
