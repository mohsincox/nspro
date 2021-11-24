@extends('layouts.app')

@section('content')
<div class="container-fluid mt-1">
    <div class="row">
        <div class="col-sm-12" style="padding-left: 0px; padding-right: 0px;">
            <div class="card bg-dark text-white">
                <div class="card-header text-center" style="padding: 0px;">
                    Nestle Inbound CRM <small><?php echo 'Phone No: <mark>'.'$phone_number'; ?></mark></small> & <small><?php echo 'Agent: <mark>'.'$agent'; ?></mark></small>
                </div>

                <div class="card-body" style="padding: 5px;">
                    {!! Form::open(['url' => 'foo/bar', 'method' => 'get']) !!}
                        <div class="row">
                            <div class="col-sm-4" style="padding-left: 10px; padding-right: 10px;">
                                <div class="input-group mb-2 input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white">Name</span>
                                    </div>
                                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter Name', 'autocomplete' => 'off']) !!}
                                </div>
                            </div>
                            <div class="col-sm-4" style="padding-left: 10px; padding-right: 10px;">
                                <div class="input-group mb-2 input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white">Division</span>
                                    </div>
                                    {!! Form::select('division', ['Barishal' => 'Barishal', 'Chittagong' => 'Chittagong', 'Dhaka' => 'Dhaka'], null, ['class' => 'form-control','placeholder' => 'Select Division']) !!}
                                </div>
                            </div>
                            <div class="col-sm-4" style="padding-left: 10px; padding-right: 10px;">
                                <div class="input-group mb-2 input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white">District</span>
                                    </div>
                                    {!! Form::select('district', ['Barishal' => 'Barishal', 'Chittagong' => 'Chittagong', 'Dhaka' => 'Dhaka'], null, ['class' => 'form-control','placeholder' => 'Select District']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4" style="padding-left: 10px; padding-right: 10px;">
                                <div class="input-group mb-2 input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white">Police Station</span>
                                    </div>
                                    {!! Form::select('police_station', ['Barishal Police Station' => 'Barishal Police Station', 'Chittagong Police Station' => 'Chittagong Police Station', 'Dhaka Police Station' => 'Dhaka Police Station'], null, ['class' => 'form-control','placeholder' => 'Select Police Station']) !!}
                                </div>
                            </div>
                            <div class="col-sm-4" style="padding-left: 10px; padding-right: 10px;">
                                <div class="input-group mb-2 input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white">Alternative Phone</span>
                                    </div>
                                    {!! Form::text('alternative_phone_number', null, ['class' => 'form-control', 'placeholder' => 'Enter Alternative Phone', 'autocomplete' => 'off']) !!}
                                </div>
                            </div>
                            <div class="col-sm-4" style="padding-left: 10px; padding-right: 10px;">
                                <div class="input-group mb-2 input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white">ECO</span>
                                    </div>
                                    {!! Form::text('eco', null, ['class' => 'form-control', 'placeholder' => 'Enter Alternative Phone', 'autocomplete' => 'off']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4" style="padding-left: 10px; padding-right: 10px;">
                                <div class="input-group mb-2 input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white">Number of Child</span>
                                    </div>
                                    {!! Form::select('number_of_child', ['1' => '1', '2' => '2', '3' => '3'], null, ['class' => 'form-control','placeholder' => 'Select Number of Child']) !!}
                                </div>
                            </div>
                            <div class="col-sm-4" style="padding-left: 10px; padding-right: 10px;">
                                <div class="input-group mb-2 input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white">1st Child Name</span>
                                    </div>
                                    {!! Form::text('1st_child_name', null, ['class' => 'form-control', 'placeholder' => 'Enter 1st Child Name', 'autocomplete' => 'off']) !!}
                                </div>
                            </div>
                            <div class="col-sm-4" style="padding-left: 10px; padding-right: 10px;">
                                <div class="input-group mb-2 input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white">1st Child Gender</span>
                                    </div>
                                    {!! Form::select('1st_child_gender', ['Male' => 'Male', 'Female' => 'Female'], null, ['class' => 'form-control','placeholder' => 'Select 1st Child Gender']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4" style="padding-left: 10px; padding-right: 10px;">
                                <div class="input-group mb-2 input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white">1st Child DOB</span>
                                    </div>
                                    {!! Form::text('1st_child_date_of_birth', null, ['class' => 'form-control', 'placeholder' => 'Enter 1st Child Date of Birth', 'autocomplete' => 'off', 'id' => '1st_child_date_of_birth', 'readonly' => 'readonly']) !!}
                                    <span id="1st_child_date_of_birth_show"></span>
                                </div>
                            </div>
                            <div class="col-sm-4" style="padding-left: 10px; padding-right: 10px;">
                                <div class="input-group mb-2 input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white">2nd Child Name</span>
                                    </div>
                                    {!! Form::text('2nd_child_name', null, ['class' => 'form-control', 'placeholder' => 'Enter 1st Child Name', 'autocomplete' => 'off']) !!}
                                </div>
                            </div>
                            <div class="col-sm-4" style="padding-left: 10px; padding-right: 10px;">
                                <div class="input-group mb-2 input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white">2nd Child Gender</span>
                                    </div>
                                    {!! Form::select('2nd_child_gender', ['Male' => 'Male', 'Female' => 'Female'], null, ['class' => 'form-control', 'placeholder' => 'Select 2nd Child Gender']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4" style="padding-left: 10px; padding-right: 10px;">
                                <div class="input-group mb-2 input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white">2nd Child DOB</span>
                                    </div>
                                    {!! Form::text('2nd_child_date_of_birth', null, ['class' => 'form-control', 'placeholder' => 'Enter 2nd Child Date of Birth', 'autocomplete' => 'off', 'id' => '2nd_child_date_of_birth', 'readonly' => 'readonly']) !!}
                                    <span id="2nd_child_date_of_birth_show"></span>
                                </div>
                            </div>
                            <div class="col-sm-4" style="padding-left: 10px; padding-right: 10px;">
                                <div class="input-group mb-2 input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white">1st Prefered Brand</span>
                                    </div>
                                    {!! Form::select('1st_prefered_brand', ['Male' => 'Male', 'Female' => 'Female'], null, ['class' => 'form-control', 'placeholder' => 'Select 1st Prefered Brand']) !!}
                                </div>
                            </div>
                            <div class="col-sm-4" style="padding-left: 10px; padding-right: 10px;">
                                <div class="input-group mb-2 input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white">2nd Prefered Brand</span>
                                    </div>
                                    {!! Form::select('2nd_prefered_brand', ['Male' => 'Male', 'Female' => 'Female'], null, ['class' => 'form-control', 'placeholder' => 'Select 2nd Prefered Brand']) !!}
                                </div>
                            </div>
                        </div>
					{!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('style')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.11.2/themes/mint-choc/jquery-ui.css">
@endsection

@section('script')
    <script src="https://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
    <script>
        $( function() {
            // $( "#datepicker" ).datepicker({ changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd" });
            // $( "#datepicker" ).datepicker( "setDate", "0" );
            $( "#1st_child_date_of_birth" ).datepicker({ changeMonth: true, changeYear: true, maxDate: +0 });
            $( "#1st_child_date_of_birth" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
            $( "#2nd_child_date_of_birth" ).datepicker({ changeMonth: true, changeYear: true, maxDate: +0 });
            $( "#2nd_child_date_of_birth" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
        } );
     </script>

     <script type="text/javascript">
        $(document).ready(function(){
            $("#1st_child_date_of_birth").change(function(){
                var dateOfBirth2 = $("#1st_child_date_of_birth").val();
                var url = '{{ url("/test2")}}';
                $.get(url+'?dateOfBirth2='+dateOfBirth2, function (data) {
                    $('#1st_child_date_of_birth_show').html(data);
                });
            });
        });

        $(document).ready(function(){
            $("#2nd_child_date_of_birth").change(function(){
                var dateOfBirth2 = $("#2nd_child_date_of_birth").val();
                var url = '{{ url("/test2")}}';
                $.get(url+'?dateOfBirth2='+dateOfBirth2, function (data) {
                    $('#2nd_child_date_of_birth_show').html(data);
                });
            });
        });
    </script>
@endsection