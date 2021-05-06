@extends('hrms.layouts.base')

@section('content')
        <!-- START CONTENT -->
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
                    <a href=""> Company Detail </a>
                </li>
                <li class="breadcrumb-current-item"> view Company Detail </li>
            </ol>
        </div>
    </header>
    <!-- -------------- Content -------------- -->
    <section id="content" class="table-layout animated fadeIn">
        <!-- -------------- Column Center -------------- -->
        <div class="chute-affix" data-spy="" data-offset-top="200">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-success">
                    <div class="panel">
                        <div class="panel-heading">
                            <span class="panel-title hidden-xs"> View Company Detail </span>
                        </div>

                        <div class="panel-body pn">
                            <div class="table-responsive">
                                <div class="panel-body p25 pb10">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <th scope="row">Address</th>
                                                <td>{{strip_tags($companyDetail->address)}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Bank Details</th>
                                                <td>{{strip_tags($companyDetail->bank_details)}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">PAN</th>
                                                <td>{{$companyDetail->pan}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row"> GST Number </th>
                                                <td>{{$companyDetail->gst_num}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Soft Tech Number</th>
                                                <td>{{$companyDetail->soft_tech_num}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Other Details</th>
                                                <td>{{strip_tags($companyDetail->other_details)}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">MOA-AOA</th>
                                                <td>
                                                    <a href="{{asset('storage/app/moa_aoa/'.$companyDetail->moa_aoa)}}" target="_blank">
                                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">MCA Certificate</th>
                                                <td>
                                                    <a href="{{asset('storage/app/mca_certificate/'.$companyDetail->mca_certificate)}}" target="_blank">
                                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                                    </a>
                                                </td>
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

    </section>

</div>
@endsection
