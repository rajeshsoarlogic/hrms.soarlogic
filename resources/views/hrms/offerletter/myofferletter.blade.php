@extends('hrms.layouts.base')

<style>
.offer-indent{
    text-indent: 5rem;
}
</style>

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
                    <a href=""> My Offer Letter </a>
                </li>
                <li class="breadcrumb-current-item"> My Offer Letter </li>
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
                                <div class="row">
                                    <div class="col-md-10">
                                        <span class="panel-title hidden-xs"> My Offer Letter </span>
                                    </div>
                                    <div class="col-md-2 text-right">
                                        <span class="panel-title text-info">
                                            <a href="{{asset('storage/app/offerletter/'.$offerLetter->pdf_name)}}" target="_blank" title="Download">
                                                <i class="fa fa-download" aria-hidden="true"></i>
                                            </a>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="panel-body pn p25 pb10">
                                @if($offerLetter != null)
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h3>Dear {{$offerLetter->name}},</h3>
                                            <p class="offer-indent">{!! nl2br($offerLetter->description) !!}</p>
                                        </div>
                                        <div class="col-md-3">
                                            <p>Stamp: <img src="{{ asset('storage/app/stamps/'.$stamp->picture) }}" class="img-responsive" /></p>
                                            <p>Manager (HRM): <img src="{{ asset('storage/app/offerletter/sig/'.$offerLetter->signature) }}" class="img-responsive" /></p>
                                        </div>
                                        <div class="col-md-3"></div>
                                        <div class="col-md-6">
                                            <p>Emp Signature: <img src="{{ asset('storage/app/offerletter/sig/emp/'.$offerLetter->emp_signature) }}" class="img-responsive" /></p>
                                        </div>
                                    </div>
                                @else
                                    <p class="alert alert-info text-center"><b>Offerletter not found</b></p>
                                @endif
                            </div>

                            <div class="panel-footer">
                                <span class="panel-title hidden-xs"> Soarlogic Information Technologies Pvt. Ltd. </span>
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
        
    });
    </script>
@endpush