@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title text-center"><code><b><i class="fa fa-edit"></i> Profile Information of {{ $profile->phone_number }} </b></code> </h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">          
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td><b>Phone Number</b></td>
                                    <td>{{ $profile->phone_number }}</td>
                                    <td><b>Consumer Name</b></td>
                                    <td>{{ $profile->consumer_name }}</td>
                                </tr>
                                <tr>
                                    <td><b>Consumer Age</b></td>
                                    <td>{{ $profile->consumer_age }}</td>
                                    <td><b>Date of Birth</b></td>
                                    <td>{{ $profile->consumer_dob }}</td>
                                </tr>
                                <tr>
                                    <td><b>Consumer Gender</b></td>
                                    <td>{{ $profile->consumer_gender }}</td>
                                    <td><b>Marital Status</b></td>
                                    <td>{{ $profile->marital_status }}</td>
                                </tr>
                                <tr>
                                    <td><b>Customer Address</b></td>
                                    <td>{{ $profile->customer_address }}</td>
                                     <td><b>Thana</b></td>
                                    @if(isset($profile->policeStation->name))
                                        <td>{{ $profile->policeStation->name }}</td>
                                    @else
                                        <td></td>
                                    @endif
                                </tr>
                                <tr>
                                    <td><b>District</b></td>
                                    @if(isset($profile->district->name))
                                        <td>{{ $profile->district->name }}</td>
                                    @else
                                        <td></td>
                                    @endif
                                    <td><b>Division</b></td>
                                    @if(isset($profile->division->name))
                                        <td>{{ $profile->division->name }}</td>
                                    @else
                                        <td></td>
                                    @endif
                                </tr>
                                <tr>
                                    <td><b>Alternative No.</b></td>
                                    <td>{{ $profile->alternative_phone_number }}</td>
                                    <td><b>Profession</b></td>
                                    <td>{{ $profile->profession }}</td>
                                </tr>
                                <tr>
                                    <td><b>SEC</b></td>
                                    <td>{{ $profile->sec }}</td>
                                    <td><b>Number of Child</b></td>
                                    <td>{{ $profile->number_of_child }}</td>
                                </tr>
                                <tr>
                                    <td><b>Total Family Member</b></td>
                                    <td>{{ $profile->total_family_member }}</td>
                                    <td><b>Child1 DOB</b></td>
                                    <td>{{ $profile->child1_DOB }}</td>
                                </tr>
                                <tr>
                                    <td><b>Child2 DOB</b></td>
                                    <td>{{ $profile->child2_DOB }}</td>
                                    <td><b>Child3 DOB</b></td>
                                    <td>{{ $profile->child3_DOB }}</td>
                                </tr>
                                <tr>
                                    <td><b>Brand</b></td>
                                    @if(isset($profile->brand->name))
                                        <td>{{ $profile->brand->name }}</td>
                                    @else
                                        <td></td>
                                    @endif
                                    <td><b>Product</b></td>
                                    <td>{{ $profile->product }}</td>
                                </tr>
                                <tr>
                                    <td><b>Prefered Brand</b></td>
                                    <td>{{ $profile->prefered_brand }}</td>
                                    <td><b>Act. Camp. Name</b></td>
                                    <td>{{ $profile->activity_campaign_name }}</td>
                                </tr>
                                <tr>
                                    <td><b>Interested in CRM</b></td>
                                    <td>{{ $profile->interested_in_crm }}</td>
                                    <td><b>Interested in FNM</b></td>
                                    <td>{{ $profile->interested_in_fnm }}</td>
                                </tr>
                                <tr>
                                    <td><b>Kids Age</b></td>
                                    <td>{{ $profile->kids_age }}</td>
                                    <td><b>Agent</b></td>
                                    <td>{{ $profile->agent }}</td>
                                </tr>
                                <!-- <tr>
                                    <td><b>created_by</b></td>
                                    <td>{{ $profile->createdBy->name }}</td>
                                    <td><b>updated_by</b></td>
                                    @if(isset($profile->updatedBy->name))
                                        <td>{{ $profile->updatedBy->name }}</td>
                                    @else
                                        <td></td>
                                    @endif
                                </tr> -->
                                <tr>
                                    <td><b>Created At</b></td>
                                    <td>{{ $profile->created_at }}</td>
                                    <td><b>Updated At</b></td>
                                    <td>{{ $profile->updated_at }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
