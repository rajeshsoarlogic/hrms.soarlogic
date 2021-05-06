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
                <li class="breadcrumb-current-item"> Company Detail Listings </li>
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
                            <span class="panel-title hidden-xs"> Company Detail Lists </span>
                        </div>
                        <div class="panel-body pn">
                            @if(Session::has('flash_message'))
                                <div class="alert alert-success">
                                    {{ Session::get('flash_message') }}
                                </div>
                            @endif
                            <div class="table-responsive">
                                <table class="table allcp-form theme-warning tc-checkbox-1 fs13">
                                    <thead>
                                    <tr class="bg-light">
                                        <th class="text-center">#</th>
                                        <th class="text-center">Address</th>
                                        <th class="text-center">Bank Details</th>
                                        <th class="text-center">PAN</th>
                                        <th class="text-center">GST Num</th>
                                        <th class="text-center">Soft Tech Num</th>
                                        <th class="text-center">Other Details</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i =0;?>
                                    @foreach($companies as $company)
                                        <tr>
                                            <td class="text-center">{{$i+=1}}</td>
                                            <td class="text-center">{{strip_tags($company->address)}}</td>
                                            <td class="text-center">{{strip_tags($company->bank_details)}}</td>
                                            <td class="text-center">{{$company->pan}}</td>
                                            <td class="text-center">{{$company->gst_num}}</td>
                                            <td class="text-center">{{$company->soft_tech_num}}</td>
                                            <td class="text-center">{{strip_tags($company->other_details)}}</td>
                                            <td class="text-center">
                                                <div class="btn-group text-right">
                                                    <button type="button" class="btn btn-success br2 btn-xs fs12 dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> Action
                                                        <span class="caret ml5"></span>
                                                    </button>
                                                    <ul class="dropdown-menu" role="menu">
                                                        <li>
                                                            <a href="{{ route('company-detail.edit', $company->id) }}">Edit</a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('company-detail.show', $company->id) }}">View</a>
                                                        </li>
                                                        <li>
                                                            <form id="del-company-{{$company->id}}" name="del-company-{{$company->id}}" action="{{ route('company-detail.destroy', [ 'id'=> $company->id ]) }}" method="POST" >
                                                                {{ csrf_field() }}
                                                                {{ method_field('DELETE') }}
                                                                <input type="submit" name="del-company-btn" value="Delete" class="form-control" />
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        {!! $companies->render() !!}
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
    </section>

</div>
@endsection