@extends('layouts.base')

@push('styles')
<style>
.pt{
    padding-top:50px;
}
.offer{
    text-indent: 5em;
}
#signature-pad{
    border: 2px solid;
}
</style>
@endpush

@section('content')
<!-- START CONTENT -->
<div class="row">
    <div class="col-md-12 text-center">
        <h2 class="text-muted">Offerletter</h2>
        <h2 class="text-muted">Soarlogic Information Pvt. Ltd.</h2>
    </div>
</div>

<div class="row panel bg-gradient">
    <div class="col-md-8 mt40">
        <div class="wrapper">
            <div class="row">
                <div class="col-md-4">
                    <p>Dear {{$offerLetter->name}}, </p>
                </div>
                <div class="col-md-12 offer">
                    <p>{!! nl2br($offerLetter->description) !!}</p>
                </div>
            </div>

            <div class="row pt">
                <div class="col-md-12">
                    <img src="{{ asset('storage/app/stamps/'.$offerLetter->stamp->picture) }}" class="img-responsive" width="100" />
                </div><br>
                <div class="col-md-12">
                    <img src="{{ asset('storage/app/signature/'.$signature->signature) }}" class="img-responsive" width="100" />
                </div>
            </div>

            <div class="row pt">
                <div class="col-md-3">
                    <p>Employee Signature: </p>
                    <p><small><b>NOTE: Do digital sign with mouse in given box</b></small></p>
                </div>
                <div class="col-md-8">
                    <canvas id="signature-pad" class="signature-pad" width="530"></canvas>
                </div>
                <div class="col-md-1">
                    <input class="btn btn-bordered btn-danger" type="button" id="clear" value="Clear">
                </div>
            </div>

            <div class="row pt">
                <div class="col-md-1">
                    <input type="checkbox" name="checkPolicy" id="checkPolicy" />
                </div>
                <div class="col-md-11">
                    <p>I am ready to accept all company policy</p>
                    <p>Please read all policy before accepting the offerletter</p>
                </div>
            </div>

            <div class="row pt mb20">
                <div class="col-md-12 text-center">
                    <p id="sig-saved-msg" class="sig-saved-msg alert alert-success hide"></p>
                    <input class="btn btn-bordered btn-info" type="button" name="save" id="save" value="Accept">
                    <input class="btn btn-bordered btn-info" type="button" name="reject" id="reject" value="Reject">
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mt40">
        <h2 class="text-muted mb20 mtn"> Policies </h2>
        <div class="panel-group accordion" id="accordion1">
            @foreach($policies as $key => $policy)
                <div class="panel">
                    <div class="panel-heading">
                        <a class="accordion-toggle accordion-icon link-unstyled collapsed" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_{{$policy->id}}">
                            {{++$key.". ".strip_tags($policy->title)}}
                        </a>
                    </div>
                    <div id="accordion1_{{$policy->id}}" class="panel-collapse collapse" style="height: 0px;">
                        <div class="panel-body">
                            {{strip_tags($policy->description)}}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
    <script type="text/javascript">
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
        if(!$('#checkPolicy').is(":checked")){
            alert("Please read the policy and tick the checkbox to accept offerletter");
            return false;
        }

        var data = signaturePad.toDataURL('image/png');
        $.ajax({
            type: "POST",
            url: "{{ route('accept.offerletter.process') }}",
            data: {
                id: "{{$offerLetter->id}}",
                emp_sig: data,
                _token: "{{ csrf_token() }}",
            },
            success: function(result) {
                if(result.success){
                    //$("#sig-saved-msg").html("Login link send to your email, Please check your email");
                    //$("#sig-saved-msg").removeClass("hide");
                    setTimeout(() => {
                        window.location = result.redirect_url;
                    }, 3000);
                }
            },
            error: function(result) {
                alert('error');
            }
        });
    });

    $("#reject").on('click', function(e){
        $.ajax({
            type: "POST",
            url: "{{ route('reject.offerletter.process') }}",
            data: {
                id: "{{$offerLetter->id}}",
                _token: "{{ csrf_token() }}",
            },
            success: function(result) {
                if(result.success){
                    $("#sig-saved-msg").html("Thanks for your time");
                    $("#sig-saved-msg").removeClass("hide");
                    // setTimeout(() => {
                    //     window.location = result.redirect_url;
                    // }, 3000);
                }
            },
            error: function(result) {
                alert('error');
            }
        });
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