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
                    <a href=""> Candidate </a>
                </li>
                <li class="breadcrumb-current-item"> {{$recruiter->name}} </li>
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
                                <span class="panel-title hidden-xs"> {{$recruiter->name}} </span>
                            </div>

                            <div class="panel-body pn">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th>Name</th>
                                            <th>{{$recruiter->name}}</th>
                                        </tr>
                                        <tr>
                                            <th>Skype ID</th>
                                            <td>{{$recruiter->skypeid}}</td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td>{{$recruiter->email}}</td>
                                        </tr>
                                        <tr>
                                            <th>Mobile Number</th>
                                            <td>{{$recruiter->mobile_num}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
@endsection

@push('scripts')
    <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
        
    });
    </script>
@endpush