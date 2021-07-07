@extends('hrms.layouts.base')

@section('content')
    <!-- START CONTENT -->
    <input type="hidden" value="{{csrf_token()}}" id="token">
    <div class="content">
        <header id="topbar" class="alt">
            <div class="topbar-left">
                <ol class="breadcrumb">
                    <li class="breadcrumb-icon">
                        <a href="/dashboard">
                            <span class="fa fa-home"></span>
                        </a>
                    </li>
                    <li class="breadcrumb-active">
                        <a href="/dashboard"> Dashboard </a>
                    </li>
                    <li class="breadcrumb-link">
                        <a href=""> Employee </a>
                    </li>
                    <li class="breadcrumb-current-item"> {{ $emp->name }} Details </li>
                </ol>
            </div>
        </header>


        <!-- -------------- Content -------------- -->
        <section id="content" class="table-layout animated fadeIn">
            <!-- -------------- Column Center -------------- -->
            <div class="chute chute-center">
                <!-- -------------- Products Status Table -------------- -->
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box box-success">
                            <div class="panel">
                                <div class="panel-heading">
                                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                        <li class="nav-item active">
                                            <a class="nav-link active" id="pills-personal-tab" data-toggle="pill" href="#pills-personal" role="tab" aria-controls="pills-personal" aria-selected="true">
                                                Personal Details
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="pills-employment-tab" data-toggle="pill" href="#pills-employment" role="tab" aria-controls="pills-employment" aria-selected="false">
                                                Employment Details
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="pills-banking-tab" data-toggle="pill" href="#pills-banking" role="tab" aria-controls="pills-banking" aria-selected="false">
                                                Banking Details
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="pills-exemp-tab" data-toggle="pill" href="#pills-exemp" role="tab" aria-controls="pills-exemp" aria-selected="false">
                                                Ex Employment Details
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="panel-body pn">
                                    <div class="tab-content" id="pills-tabContent">
                                        <div class="tab-pane active" id="pills-personal" role="tabpanel" aria-labelledby="pills-personal-tab">
                                            <div class="row">
                                                <div class="col-md-5"></div>
                                                <div class="col-md-2">
                                                    @if(isset($emp->employee->photo))
                                                        <img src="{{asset('public/photos/'.$emp->employee->photo)}}" class="img-responsive rounded float-center">
                                                    @else
                                                        <img src="/public/assets/img/avatars/profile_pic.png" class="img-responsive rounded float-center">
                                                    @endif
                                                </div>
                                                <div class="col-md-5"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <table class="table table-bordered">
                                                        <tbody>
                                                            <tr>
                                                                <th>Employee Code</th>
                                                                <th>{{$emp->employee->code}}</th>
                                                            </tr>
                                                            <tr>
                                                                <th>Employee Name</th>
                                                                <td>{{$emp->name}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Employee Email</th>
                                                                <td>{{$emp->email}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Employment Status</th>
                                                                <td>@if($emp->employee->status == 1) Present @else EX @endif</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Role</th>
                                                                <td>{{$emp->role->role->name}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Gender</th>
                                                                <td>@if($emp->employee->gender == 0) Male @else Female @endif</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Date of Birth</th>
                                                                <td>{{$emp->employee->date_of_birth}}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-md-6">
                                                    <table class="table table-bordered">
                                                        <tbody>
                                                            <tr>
                                                                <th>Date of Joining</th>
                                                                <td>{{$emp->employee->date_of_joining}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Mobile Number</th>
                                                                <td>{{$emp->employee->number}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Qualification</th>
                                                                <td>{{$emp->employee->qualification}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Emergency Number</th>
                                                                <td>{{$emp->employee->emergency_number}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>PAN Number</th>
                                                                <td>{{$emp->employee->pan_number}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Father's Name</th>
                                                                <td>{{$emp->employee->father_name}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Current Address</th>
                                                                <td>{{$emp->employee->current_address}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Permanent Address</th>
                                                                <td>{{$emp->employee->permanent_address}}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="pills-employment" role="tabpanel" aria-labelledby="pills-employment-tab">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <table class="table table-bordered">
                                                        <tbody>
                                                            <tr>
                                                                <th>Category</th>
                                                                <th>{{$emp->employee->employee_category_id}}</th>
                                                            </tr>
                                                            <tr>
                                                                <th>Joining Formalities</th>
                                                                <td>@if($emp->employee->formalities == 1) Completed @else Pending @endif</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Offer Acceptance</th>
                                                                <td>@if($emp->employee->offer_acceptance == 1) Completed @else Pending @endif</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Probation Period</th>
                                                                <td>
                                                                    @if($emp->employee->probation_period == "0")
                                                                        0 days
                                                                    @elseif($emp->employee->probation_period == "0")
                                                                        Pending
                                                                    @elseif($emp->employee->probation_period == "90")
                                                                        90 days
                                                                    @elseif($emp->employee->probation_period == "180")
                                                                        180 days
                                                                    @elseif($emp->employee->probation_period == "Other")
                                                                        Other
                                                                    @else
                                                                        N/A
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-md-6">
                                                    <table class="table table-bordered">
                                                        <tbody>
                                                            <tr>
                                                                <th>Date of Confirmation</th>
                                                                <td>{{$emp->employee->date_of_confirmation}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Department</th>
                                                                <td>{{$emp->employee->department}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Salary on Confirmation</th>
                                                                <td>{{$emp->employee->salary}}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="pills-banking" role="tabpanel" aria-labelledby="pills-banking-tab">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <table class="table table-bordered">
                                                        <tbody>
                                                            <tr>
                                                                <th>Bank Account Number</th>
                                                                <th>{{$emp->employee->account_number}}</th>
                                                            </tr>
                                                            <tr>
                                                                <th>Bank Name</th>
                                                                <td>{{$emp->employee->bank_name}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>IFSC Code</th>
                                                                <td>{{$emp->employee->ifsc_code}}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-md-6">
                                                    <table class="table table-bordered">
                                                        <tbody>
                                                            <tr>
                                                                <th>PF Account Number</th>
                                                                <td>{{$emp->employee->pf_account_number}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>UN Number</th>
                                                                <td>{{$emp->employee->un_number}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>PF Status</th>
                                                                <td>@if($emp->employee->pf_status == 0) Inactive @else Active @endif</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="pills-exemp" role="tabpanel" aria-labelledby="pills-exemp-tab">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <table class="table table-bordered">
                                                        <tbody>
                                                            <tr>
                                                                <th>Date of Resignation</th>
                                                                <th>{{$emp->employee->date_of_resignation}}</th>
                                                            </tr>
                                                            <tr>
                                                                <th>Notice Period</th>
                                                                <td>
                                                                @if($emp->employee->notice_period == 1)
                                                                    1 Month
                                                                @elseif($emp->employee->notice_period == 2)
                                                                    2 Month
                                                                @else
                                                                @endif
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-md-6">
                                                    <table class="table table-bordered">
                                                        <tbody>
                                                            <tr>
                                                                <th>Last Working Day</th>
                                                                <td>{{$emp->employee->last_working_day}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Full & Final</th>
                                                                <td>@if($emp->employee->full_final == 1) Yes @else No @endif</td>
                                                            </tr>
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
                </div>
            </div>
        </section>
    </div>

@endsection