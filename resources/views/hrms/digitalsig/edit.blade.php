@extends('hrms.layouts.base')

@push('styles')
<style>
#signature-pad{
    border: 2px solid #ddd;
}
</style>
@endpush

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
                    <a href=""> Digital Signature </a>
                </li>
                <li class="breadcrumb-current-item"> Edit Digital Signature </li>
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
                            <span class="panel-title hidden-xs"> Edit Digital Signature </span>
                        </div>

                        <div class="panel-body pn">
                            <div class="table-responsive">
                                <div class="panel-body p25 pb10">

                                    @if(Session::has('flash_message'))
                                        <div class="alert alert-success">
                                            {{ Session::get('flash_message') }}
                                        </div>
                                    @endif
                                    {!! Form::open(['class' => 'form-horizontal', 'id' => 'digSigFrm', 'url' => route('digital-sig.update', $signature->id), 'method' => 'put']) !!}
                                        <div class="form-group">
                                            <label for="title" class="col-md-3 control-label"> Title </label>
                                            <div class="col-md-6">
                                                <input type="text" placeholder="Signature Title..." name="title" id="title"  value="{{$signature->title}}" class="form-control" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="signature" class="col-md-3 control-label">
                                            Signature <br><small class="text-info"><b>NOTE: Do digital sign with mouse in given box</b></small>
                                            </label>
                                            <div class="col-md-6">
                                                <div class="wrapper">
                                                    <canvas id="signature-pad" class="signature-pad" width="450"></canvas>
                                                </div>
                                                <input type="hidden" name="signature" id="signature" value="" />
                                            </div>
                                            <div class="col-md-3">
                                                <a class="" id="clear" href="javascript:void(0);"><i class="fa fa-refresh" aria-hidden="true"></i> Clear</a>
                                                <img src="{{ asset('storage/app/signature/'.$signature->signature) }}" class="img-responsive img-thumbnail">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label"></label>
                                            <div class="col-md-2">
                                                <input class="btn btn-bordered btn-info btn-block" type="button" id="save" value="Update">
                                            </div>
                                            <div class="col-md-2">
                                                <a href="{{route('digital-sig.index')}}" class="btn btn-bordered btn-success btn-block">Cancel</a>
                                            </div>
                                        </div>
                                    {!! Form::close() !!}
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
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
        });

        /*signature pad coding*/
        var signaturePad = new SignaturePad(document.getElementById('signature-pad'), {
            backgroundColor: 'rgba(255, 255, 255, 0)',
            penColor: 'rgb(0, 0, 0)'
        });

        var saveButton = document.getElementById('save');
        var cancelButton = document.getElementById('clear');

        saveButton.addEventListener('click', function (event) {
            var data = "";
            if(!signaturePad.isEmpty()){
                data = signaturePad.toDataURL('image/png');
            }
            
            //save signatue to hidden field
            document.getElementById("signature").value = data;
            //form submit
            $("#digSigFrm").submit();
        });

        cancelButton.addEventListener('click', function (event) {
            signaturePad.clear();
            document.getElementById("signature").value = "";
        });
        /*END*/
    </script>
@endpush