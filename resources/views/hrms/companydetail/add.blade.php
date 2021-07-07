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
                <li class="breadcrumb-current-item"> Add Company Detail </li>
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
                                <span class="panel-title hidden-xs"> Add Company Detail </span>
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
                                        {!! Form::open(['class' => 'form-horizontal createForm', 'url' => route('company-detail.store'), 'method' => 'post', 'files' => true]) !!}
                                            <div class="form-group">
                                                <label for="address" class="col-md-2 control-label"> Address </label>
                                                <div class="col-md-10">
                                                    <textarea placeholder="Address..." name="address" id="address" class="ckeditor form-control" required></textarea>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="bank_details" class="col-md-2 control-label"> Bank Details </label>
                                                <div class="col-md-10">
                                                    <textarea placeholder="Bank Details..." name="bank_details" id="bank_details" class="ckeditor form-control" required></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="pan" class="col-md-2 control-label"> PAN </label>
                                                <div class="col-md-10">
                                                    <input type="text" placeholder="PAN" name="pan" id="pan" class="form-control" required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="gst_num" class="col-md-2 control-label"> GST Number </label>
                                                <div class="col-md-10">
                                                    <input type="text" placeholder="GST Number" name="gst_num" id="gst_num" class="form-control" required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="soft_tech_num" class="col-md-2 control-label"> Soft Tech Number </label>
                                                <div class="col-md-10">
                                                    <input type="text" placeholder="Soft Tech Number" name="soft_tech_num" id="soft_tech_num" class="form-control" required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="other_details" class="col-md-2 control-label"> Other Details </label>
                                                <div class="col-md-10">
                                                    <textarea name="other_details" id="other_details" class="ckeditor form-control" required></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="moa_aoa" class="col-md-2 control-label"> MOA-AOA </label>
                                                <div class="col-md-10">
                                                    <input type="file" name="moa_aoa" id="moa_aoa" class="form-control">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="mca_certificate" class="col-md-2 control-label"> MCA Certificate </label>
                                                <div class="col-md-10">
                                                    <input type="file" name="mca_certificate" id="mca_certificate" class="form-control">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-2 control-label"></label>
                                                <div class="col-md-2">
                                                    <input type="button" class="btn btn-bordered btn-info btn-block create-sub-btn" value="Submit">
                                                </div>
                                                <div class="col-md-2">
                                                    <a class="btn btn-bordered btn-success btn-block" href="{{route('company-detail.index')}}">Cancel</a>
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

        $('.ckeditor').ckeditor();
    });
    </script>
@endpush