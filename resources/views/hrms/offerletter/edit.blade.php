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
                    <a href=""> Offer Letter </a>
                </li>
                <li class="breadcrumb-current-item"> Edit Offer Letter </li>
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
                                <span class="panel-title hidden-xs"> Edit Offer Letter </span>
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
                                        {!! Form::open(['class' => 'form-horizontal', 'url' => route('offer-letter.update', $offerLetter->id), 'method' => 'put']) !!}
                                            <div class="form-group">
                                                <label for="name" class="col-md-2 control-label"> Candidate Name </label>
                                                <div class="col-md-10">
                                                    <input type="text" name="name" id="name" value="{{$offerLetter->name}}" class="form-control" placeholder="Name..." required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="email" class="col-md-2 control-label"> Candidate Email </label>
                                                <div class="col-md-10">
                                                    <input type="email" name="email" id="email" value="{{$offerLetter->email}}" class="form-control" placeholder="Email..." required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="other_emails" class="col-md-2 control-label"> Other Email </label>
                                                <div class="col-md-10">
                                                    <input type="text" name="other_emails" id="other_emails" value="{{$offerLetter->other_emails}}" class="form-control" placeholder="Other comma seperated emails...">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="template_id" class="col-md-2 control-label"> Template </label>
                                                <div class="col-md-10">
                                                    <select name="template_id" id="template_id" class="form-control" required>
                                                        <option value="">--- SELECT ---</option>
                                                        @foreach($templates as $template)
                                                            <option value="{{$template->id}}" data-description="{{$template->description}}" @if($template->id == $offerLetter->template_id) selected @endif>{{$template->title}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="description" class="col-md-2 control-label"> Offer Letter </label>
                                                <div class="col-md-10">
                                                    <textarea name="description" id="description" class="ckeditor form-control">{{$offerLetter->description}}</textarea>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="stamp" class="col-md-2 control-label"> Stamp </label>
                                                <div class="col-md-10">
                                                    <select name="stamp_id" id="stamp_id" class="form-control" required>
                                                        <option value="">--- SELECT ---</option>
                                                        @foreach($stamps as $stamp)
                                                            <option value="{{$stamp->id}}" @if($stamp->id == $offerLetter->stamp_id) selected @endif>{{$stamp->title}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="digital_signature_id" class="col-md-2 control-label"> Digital Signature </label>
                                                <div class="col-md-4">
                                                    <select name="digital_signature_id" id="digital_signature_id" class="form-control" required>
                                                        <option value="">--- SELECT ---</option>
                                                        @foreach($signatures as $sig)
                                                            <option value="{{$sig->id}}" data-signature="{{asset('storage/app/signature/'.$sig->signature)}}" @if($sig->id == $offerLetter->digital_signature_id) selected @endif>{{$sig->title}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-6 sig-photo hide"></div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-2 control-label"></label>
                                                <div class="col-md-2">
                                                    <input type="submit" class="btn btn-bordered btn-info btn-block" value="Update">
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
    <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
        $("#digital_signature_id").on("change", function(){
            //alert($(this).find(':selected').data("photo"));
            var signature = $(this).find(':selected').data("signature");
            if(signature != undefined){
                $(".sig-photo").html(`<img src="${signature}" class="img-responsive" />`);
                $(".sig-photo").removeClass("hide");
            }else{
                $(".sig-photo").addClass("hide");
                $(".sig-photo").remove('img');
            }
        });

        $("#template_id").on("change", function(){
            var description = $(this).find(':selected').data("description");
            // instance, using default configuration.
            CKEDITOR.replace('description');
            if(description != undefined){
                //set data
                CKEDITOR.instances['description'].setData(description);
            }else{
                CKEDITOR.instances['description'].setData("");
            }
        });

        $('.ckeditor').ckeditor(config);
    });
    </script>
@endpush