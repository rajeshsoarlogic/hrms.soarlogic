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
                    <a href=""> Experience Letter </a>
                </li>
                <li class="breadcrumb-current-item"> Edit Experience Letter </li>
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
                                <span class="panel-title hidden-xs"> Edit Experience Letter </span>
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
                                        {!! Form::open(['class' => 'form-horizontal', 'url' => route('experience-letter.update', $experienceLetter->id), 'method' => 'put']) !!}
                                            <div class="form-group">
                                                <label class="col-md-2 control-label"> Employee </label>
                                                <div class="col-md-7">
                                                    <select name="user_id" id="user_id" class="form-control" required>
                                                        <option value="">--- SELECT ---</option>
                                                        @foreach($emps as $emp)
                                                            <option value="{{$emp->id}}" data-photo="{{asset('public/photos/'.$emp->employee->photo)}}" @if($emp->id == $experienceLetter->user_id) selected @endif>{{$emp->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-3 emp-photo hide"></div>
                                            </div>

                                            <div class="form-group">
                                                <label for="template_id" class="col-md-2 control-label"> Template </label>
                                                <div class="col-md-10">
                                                    <select name="template_id" id="template_id" class="form-control" required>
                                                        <option value="">--- SELECT ---</option>
                                                        @foreach($templates as $template)
                                                            <option value="{{$template->id}}" data-description="{{$template->description}}" @if($template->id == $experienceLetter->template_id) selected @endif>{{$template->title}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="description" class="col-md-2 control-label"> Letter </label>
                                                <div class="col-md-10">
                                                    <textarea name="description" id="description" class="ckeditor form-control">{{$experienceLetter->description}}</textarea>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="stamp" class="col-md-2 control-label"> Stamp </label>
                                                <div class="col-md-10">
                                                    <select name="stamp_id" id="stamp_id" class="form-control" required>
                                                        <option value="">--- SELECT ---</option>
                                                        @foreach($stamps as $stamp)
                                                            <option value="{{$stamp->id}}" @if($stamp->id == $experienceLetter->stamp_id) selected @endif>{{$stamp->title}}</option>
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
                                                            <option value="{{$sig->id}}" data-signature="{{asset('storage/app/signature/'.$sig->signature)}}" @if($sig->id == $experienceLetter->digital_signature_id) selected @endif>{{$sig->title}}</option>
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
                                                    <a class="btn btn-bordered btn-success btn-block" href="{{route('experience-letter.index')}}">Cancel</a>
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

        $("#digital_signature_id").on("change", function(){
            var signature = $(this).find(':selected').data("signature");
            if(signature != undefined){
                $(".sig-photo").html(`<img src="${signature}" class="img-responsive" />`);
                $(".sig-photo").removeClass("hide");
            }else{
                $(".sig-photo").addClass("hide");
                $(".sig-photo").remove('img');
            }
        });

        $('.ckeditor').ckeditor(config);
    });
    </script>
@endpush