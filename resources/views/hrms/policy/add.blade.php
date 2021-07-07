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
                    <a href=""> Policy </a>
                </li>
                <li class="breadcrumb-current-item"> Add Policy </li>
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
                                <span class="panel-title hidden-xs"> Add Policy </span>
                            </div>

                            <div class="panel-body pn">
                                <div class="table-responsive">
                                    <div class="panel-body p25 pb10">
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        @if(Session::has('flash_message'))
                                            <div class="alert alert-success">
                                                {{ Session::get('flash_message') }}
                                            </div>
                                        @endif
                                        {!! Form::open(['class' => 'form-horizontal createForm', 'url' => route('policy.store'), 'method' => 'post']) !!}
                                            <div class="form-group">
                                                <label class="col-md-3 control-label"> Title </label>
                                                <div class="col-md-9">
                                                    <input type="text" placeholder="Policy Title..." name="title" id="title" class="form-control" required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="description" class="col-md-3 control-label"> Description </label>
                                                <div class="col-md-9">
                                                    <textarea name="description" id="description" class="ckeditor form-control"></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-3 control-label"></label>
                                                <div class="col-md-2">
                                                    <input type="button" class="btn btn-bordered btn-info btn-block create-sub-btn" value="Submit">
                                                </div>
                                                <div class="col-md-2">
                                                    <a class="btn btn-bordered btn-success btn-block" href="{{route('policy.index')}}">Cancel</a>
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
    <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
        $(".create-sub-btn").on("click", function(){
            $("#loader").removeClass("hide");
            setTimeout(() => {
                $(".createForm").submit();
            }, 500);
        });

        var config = {
            enterMode: 'ENTER_BR'
        };
        $('.ckeditor').ckeditor(config);
    });
    </script>
@endpush