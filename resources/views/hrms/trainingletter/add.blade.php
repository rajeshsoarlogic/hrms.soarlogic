@extends('hrms.layouts.base')

@push('styles')
<style>
#signature-pad{
    border: 2px solid;
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
                    <a href=""> Training Letter </a>
                </li>
                <li class="breadcrumb-current-item"> Add Training Letter </li>
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
                                <span class="panel-title hidden-xs"> Add Training Letter </span>
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
                                        {!! Form::open(['class' => 'form-horizontal', 'url' => route('training-letter.store'), 'method' => 'post']) !!}
                                            <div class="form-group">
                                                <label class="col-md-3 control-label"> Employee </label>
                                                <div class="col-md-6">
                                                    <select name="user_id" id="user_id" class="form-control" required>
                                                        <option value="">--- SELECT ---</option>
                                                        @foreach($emps as $emp)
                                                            <option value="{{$emp->id}}" data-photo="{{asset('public/photos/'.$emp->employee->photo)}}">{{$emp->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-3 emp-photo hide"></div>
                                            </div>

                                            <div class="form-group">
                                                <label for="description" class="col-md-3 control-label"> Offer Letter </label>
                                                <div class="col-md-9">
                                                    <textarea name="description" id="description" class="ckeditor form-control"></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="stamp" class="col-md-3 control-label"> Stamp </label>
                                                <div class="col-md-9">
                                                    <select name="stamp_id" id="stamp_id" class="form-control" required>
                                                        <option value="">--- SELECT ---</option>
                                                        @foreach($stamps as $stamp)
                                                            <option value="{{$stamp->id}}">{{$stamp->title}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="" class="col-md-3 control-label"> Signature </label>
                                                <div class="col-md-6">
                                                    <div class="wrapper">
                                                        <canvas id="signature-pad" class="signature-pad" width="400"></canvas>
                                                    </div>
                                                    <input type="hidden" name="signature" id="signature" value="" />
                                                </div>
                                                <div class="col-md-3">
                                                    <input class="btn btn-bordered btn-info" type="button" id="save" value="Save">
                                                    <input class="btn btn-bordered btn-danger" type="button" id="clear" value="Clear">
                                                    <p id="sig-saved-msg" class="sig-saved-msg alert alert-success hide"></p>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-3 control-label"></label>
                                                <div class="col-md-2">
                                                    <input type="submit" class="btn btn-bordered btn-info btn-block save-offer-btn" id="save-offer-btn" value="Submit">
                                                </div>
                                                <div class="col-md-2">
                                                    <a class="btn btn-bordered btn-success btn-block" href="{{route('offer-letter.index')}}">Cancel</a>
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
    <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
        $("#user_id").on("change", function(){
            //alert($(this).find(':selected').data("photo"));
            var photo = $(this).find(':selected').data("photo");
            if(photo != undefined){
                $(".emp-photo").html(`<img src="${photo}" class="img-responsive" />`);
                $(".emp-photo").removeClass("hide");
            }else{
                $(".emp-photo").addClass("hide");
                $(".emp-photo").remove('img');
            }
        });

        var config = {
            enterMode: 'ENTER_BR'
        };
        $('.ckeditor').ckeditor(config);
    });

    /*signature pad coding*/
    var signaturePad = new SignaturePad(document.getElementById('signature-pad'), {
        backgroundColor: 'rgba(255, 255, 255, 0)',
        penColor: 'rgb(0, 0, 0)'
    });
    var saveButton = document.getElementById('save');
    var cancelButton = document.getElementById('clear');

    saveButton.addEventListener('click', function (event) {
        if(signaturePad.isEmpty()){
            alert("signature pad is empty");
            return false;
        }
        var data = signaturePad.toDataURL('image/png');

        //save signatue to hidden field
        document.getElementById("signature").value = data;
        document.getElementById("sig-saved-msg").innerHTML = "Signatue updated";
        document.getElementById("sig-saved-msg").classList.remove("hide");
    });

    cancelButton.addEventListener('click', function (event) {
        signaturePad.clear();
        document.getElementById("signature").value = "";
        document.getElementById("sig-saved-msg").innerHTML = "";
        document.getElementById("sig-saved-msg").classList.add("hide");
    });
    /*END*/
    </script>
@endpush