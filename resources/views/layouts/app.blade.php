<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Nestle</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('assets/css/dataTables.bootstrap4-1.10.19.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
    <style type="text/css">
        .btn-group-xs > .btn, .btn-xs {
            padding  : .25rem .4rem;
            font-size  : .875rem;
            line-height  : .5;
            border-radius : .2rem;
        }

        .alert {
            padding: 2px; 
            margin-bottom: 0px; 
        }
    </style>
     @yield('style')
</head>
<body id="app-layout">
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark" style="background-color: #0555af!important;">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('assets/image/nestle.png') }}" height="60" width="210">
                <!-- <img src="{{ asset('assets/images/myol8171.png') }}" height="63" width="63" style="margin-top: -26px;"> -->
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#"></a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    
                    @if (Auth::guest())
                        <li class="nav-item active">
                            <a class="nav-link btn btn-dark" href="{{ url('/login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <!-- <a class="nav-link" href="{{ url('/register') }}">Register</a> -->
                        </li>
                    @else
                      @can('admin-access')
                        <li class="nav-item dropdown active">
                            <a class="nav-link dropdown-toggle btn btn-danger" href="#" id="navbardrop" data-toggle="dropdown">Settings </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ url('/user') }}">User</a>
                                <a class="dropdown-item" href="{{ url('/category') }}">Category</a>
                                <a class="dropdown-item" href="{{ url('/brand') }}">Brand</a>
                                <a class="dropdown-item" href="{{ url('/product') }}">Product</a>
                                <a class="dropdown-item" href="{{ url('/quiz') }}">Quiz</a>
                                <a class="dropdown-item" href="{{ url('/select') }}">Select</a>
                                <a class="dropdown-item" href="{{ url('/option') }}">Option</a>
                                <a class="dropdown-item" href="{{ url('/upload-excel') }}">Upload</a>

                                <a class="dropdown-item" href="{{ url('/division') }}">Division</a>
                                <a class="dropdown-item" href="{{ url('/district') }}">District</a>
                                <a class="dropdown-item" href="{{ url('/police-station') }}">Police Station</a>
                                
                            </div>
                        </li>

                       <!-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Area </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ url('/division') }}">Division</a>
                                <a class="dropdown-item" href="{{ url('/district') }}">District</a>
                                <a class="dropdown-item" href="{{ url('/police-station') }}">Police Station</a>
                                
                            </div>
                        </li> -->

                        <!-- <li {{ ( Request::is('division') || Request::is('division/*') ? 'class=active' : '' ) }}>
                            <a class="nav-link" href="{{ url('/division') }}">Division</a>
                        </li>
                        <li {{ ( Request::is('district') || Request::is('district/*') ? 'class=active' : '' ) }}>
                            <a class="nav-link" href="{{ url('/district') }}">District</a>
                        </li>
                        <li {{ ( Request::is('police-station') || Request::is('police-station/*') ? 'class=active' : '' ) }}>
                            <a class="nav-link" href="{{ url('/police-station') }}">Police Station</a>
                        </li> -->

                        <!-- <li {{ ( Request::is('user') || Request::is('user/*') ? 'class=active' : '' ) }}>
                            <a class="nav-link" href="{{ url('/user') }}">User</a>
                        </li>
                        <li {{ ( Request::is('brand') || Request::is('brand/*') ? 'class=active' : '' ) }}>
                            <a class="nav-link" href="{{ url('/brand') }}">Brand</a>
                        </li>
                        <li {{ ( Request::is('product') || Request::is('product/*') ? 'class=active' : '' ) }}>
                            <a class="nav-link" href="{{ url('/product') }}">Product</a>
                        </li>
                        <li {{ ( Request::is('quiz') || Request::is('quiz/*') ? 'class=active' : '' ) }}>
                            <a class="nav-link" href="{{ url('/quiz') }}">Quiz</a>
                        </li>
                        <li {{ ( Request::is('select') || Request::is('select/*') ? 'class=active' : '' ) }}>
                            <a class="nav-link" href="{{ url('/select') }}">Select</a>
                        </li>
                        <li {{ ( Request::is('option') || Request::is('option/*') ? 'class=active' : '' ) }}>
                            <a class="nav-link" href="{{ url('/option') }}">Option</a>
                        </li> -->

                        <li class="active">
                            <a class="nav-link btn btn-dark ml-2" href="{{ url('/upload-excel') }}">Upload Excel</a>
                        </li>

                        <li class="nav-item dropdown active">
                            <a class="nav-link dropdown-toggle btn btn-info ml-2" href="#" id="navbardrop" data-toggle="dropdown">All CRM </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ url('/crm-profile/create?phone_number=01845428796&agent=Agent1') }}" target="_blank">Inbound CRM</a>
                                <a class="dropdown-item" href="{{ url('/fnm-crm-profile/create?phone_number=01845428796&agent=Agent1') }}" target="_blank">FNM CRM</a>
                                <a class="dropdown-item" href="{{ url('/field-user/create') }}">Field User CRM</a>
                            </div>
                        </li>
                        
                       @endcan
                        <!-- <li {{ ( Request::is('crm-profile') || Request::is('crm-profile/*') ? 'class=active' : '' ) }}>
                            <a class="nav-link" href="{{ url('/crm-profile/crm-report-form') }}">CRM Profile</a>
                        </li> -->
                        <!-- <li class="active">
                            <a class="nav-link btn btn-info ml-2" href="{{ url('/field-user/create') }}">Field User CRM</a>
                        </li> -->
                        
                        <li class="active">
                            <a class="nav-link btn btn-secondary ml-2" href="{{ url('/field-user') }}">Field User Info</a>
                        </li>
                        @can('admin-access')
                            <!-- <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Report </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ url('/crm-profile/crm-report-form') }}">CRM Report</a>
                                    <a class="dropdown-item" href="{{ url('/profile-report/child-age-form') }}">Child Age Wise Report</a>
                                    <a class="dropdown-item" href="{{ url('/profile-report/division-all-show') }}">All Division Report</a>
                                    <a class="dropdown-item" href="{{ url('/profile-report/division-wise-form') }}">Division Wise Report</a>
                                    <a class="dropdown-item" href="{{ url('/profile-report/district-wise-form') }}">District Wise Report</a>
                                    <a class="dropdown-item" href="{{ url('/profile-report/ps-wise-form') }}">Police Station Wise Report</a>
                                    <a class="dropdown-item" href="{{ url('/crm-profile/brand-wise-form') }}">Brand Wise Report</a>
                                    <a class="dropdown-item" href="{{ url('/crm-profile/brand-and-div-wise-form') }}">Brand and Division Wise Report</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Download </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ url('/crm-profile/crm-report-form-excel') }}">CRM Report Download</a>
                                    <a class="dropdown-item" href="{{ url('/profile-report/child-age-form-excel') }}">Child Age Wise Download</a>
                                    <a class="dropdown-item" href="{{ url('/profile-report/division-all-download-excel') }}" onclick="return confirm('Do you want to download?');">All Division Download</a>
                                    <a class="dropdown-item" href="{{ url('/profile-report/division-wise-form-excel') }}">Division Wise Download</a>
                                    <a class="dropdown-item" href="{{ url('/profile-report/district-wise-form-excel') }}">District Wise Download</a>
                                    <a class="dropdown-item" href="{{ url('/profile-report/ps-wise-form-excel') }}">Police Station Wise Download</a>
                                    <a class="dropdown-item" href="{{ url('/crm-profile/brand-wise-form-excel') }}">Brand Wise Download</a>
                                    <a class="dropdown-item" href="{{ url('/crm-profile/brand-and-div-wise-form-excel') }}">Brand and Division Wise Download</a>
                                </div>
                            </li> -->
                        
                            
                        @endcan
                        
                        @can('supervisor-access')
                            @if(Auth::user()->role == 'supervisor')
                              <li class="active">
                                  <a class="nav-link btn btn-secondary ml-2" href="{{ url('/crm-profile/crm-report-form-excel') }}">Supervisor Report</a>
                              </li>
                            @endif
                              <!-- <li {{ ( Request::is('report-single-form-excel') || Request::is('report-single-form-excel/*') ? 'class=active' : '' ) }}>
                                  <a class="nav-link" href="{{ url('/report-single-form-excel') }}">All Reports</a>
                              </li> -->

                              <!-- <li class="active">
                                  <a class="nav-link btn btn-warning ml-2" href="{{ url('/report-single-profile-form-excel') }}">All Reports</a>
                                  <a class="nav-link btn btn-warning ml-2" href="{{ url('/report-multi-div-form-excel') }}">All Reports</a>
                              </li> -->

                            <li class="nav-item dropdown active">
                                <a class="nav-link dropdown-toggle btn btn-warning ml-2" href="#" id="navbardrop" data-toggle="dropdown">All Reports</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ url('/all-report-tab-xls-form') }}" >All Reports</a>
                                    <a class="dropdown-item" href="{{ url('/profile-view-download') }}" >All Data Download</a>
                                    <a class="dropdown-item" href="{{ url('/dashboard') }}" >Dashboard</a>
                                    <a class="dropdown-item" href="{{ url('/brand-dashboard') }}" >Brand Dashboard</a>
                                    <a class="dropdown-item" href="{{ url('/get-download-index') }}" target="_blank">File Download</a>
                                    <!-- <a class="dropdown-item" href="{{ url('/report-single-profile-form-excel') }}">All Reports</a> -->
                                </div>
                            </li>

                              <li class="active">
                                <a class="nav-link btn btn-success ml-2" href="{{ url('/profile-view') }}">Profile Data</a>
                            </li>
                        @endcan
                        <li class="nav-item dropdown active">
                            <a class="nav-link dropdown-toggle btn btn-dark ml-2" href="#" id="navbardrop" data-toggle="dropdown">
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a>
                            </div>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-1">
        <div class="col-sm-8 offset-sm-2">
            @include('flash::message')
        </div> 
    </div>

    @yield('content')

    <footer class="mt-5">
      <!-- <div style="background-color: #343a40!important;"> -->
      <div style="background-color: #0555af!important;">
        <center><p style="font-family: 'Open Sans', serif; font-size: 12px; margin-top: 0px; padding: 10px;"><span style="color: #FFFFFF">Developed by</span> <a href="http://www.myolbd.com/" target="_blank" style="color: red;">MY Outsoursing Ltd. </a> <span style="color: #FFFFFF">All Rights Reserved.</span></p></center>
      </div>
    </footer>
    <!-- JavaScripts -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script> -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
    <script src="{{ asset('assets/js/dataTables-1.10.19.min.js') }}"></script>
    <!-- <script src="{{ asset('https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js') }}"></script> -->
    <script src="{{ asset('assets/js/dataTables.bootstrap4-1.10.19.min.js') }}"></script>
     @yield('script')
</body>
</html>
