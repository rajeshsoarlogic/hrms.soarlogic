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
                        <a href=""> Client </a>
                    </li>
                    <li class="breadcrumb-current-item"> Add Client</li>
                </ol>
            </div>
        </header>
        <!-- -------------- Content -------------- -->
        <section id="content" class="table-layout animated fadeIn">
            <!-- -------------- Column Center -------------- -->
            <div class="chute-affix" data-spy="affix" data-offset-top="200">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box box-success">
                            <div class="panel">
                                <div class="panel-heading">
                                    <span class="panel-title hidden-xs"> Add Client </span>
                                </div>

                                <div class="panel-body pn">
                                    <div class="table-responsive">
                                        <div class="panel-body p25 pb10">
                                            @if(Session::has('flash_message'))
                                                <div class="alert alert-success">
                                                    {{Session::get('flash_message')}}
                                                </div>
                                            @endif
                                            {!! Form::open(['class' => 'form-horizontal createForm']) !!}

                                            <div class="form-group">
                                                <label class="col-md-3 control-label"> Client </label>
                                                <div class="col-md-6">
                                                    <input type="text" name="name" id="input002" class="select2-single form-control" placeholder="Name" required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-3 control-label"> Address </label>
                                                <div class="col-md-6">
                                                    <textarea class="select2-single form-control" rows="3" id="address" placeholder="Client Address" name="address"></textarea>
                                                </div>
                                            </div>

                                                <div class="form-group">
                                                    <label class="col-md-3 control-label"> Company </label>
                                                    <div class="col-md-6">
                                                        <input type="text" name="company" id="input002" class="select2-single form-control" placeholder="Company">
                                                    </div>
                                                </div>

                                                <div class="form-group code-group">
                                                    <label class="col-md-3 control-label"> Code </label>
                                                    <div class="col-md-6">
                                                        <input type="text" name="code" id="code" class="select2-single form-control" placeholder="Unique Code" required>
                                                    </div>
                                                </div>

                                            <div class="form-group">
                                                <label class="col-md-3 control-label"></label>
                                                <div class="col-md-2">
                                                    <input type="button" class="btn btn-bordered btn-info btn-block save-client create-sub-btn" value="Submit">
                                                </div>
                                                <div class="col-md-2"><a href="/add-client">
                                                        <input type="button" class="btn btn-bordered btn-success btn-block" value="Reset"></a>
                                                </div>
                                            </div>
                                            {!! Form::close() !!}
                                            <div id="loader" class="loaderCustom text-danger hide">
                                                <strong>Loading</strong> <i class="fa fa-spinner fa-spin fa-5x" aria-hidden="true"></i>
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

@push('scripts')
    <script type="text/javascript">
    $(document).ready(function(){
        $(".create-sub-btn").on("click", function(){
            $("#loader").removeClass("hide");
            setTimeout(() => {
                $(".createForm").submit();
            }, 500);
        });
    });
    </script>
@endpush