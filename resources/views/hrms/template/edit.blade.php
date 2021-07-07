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
                    <a href=""> Template </a>
                </li>
                <li class="breadcrumb-current-item"> Edit Template </li>
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
                            <span class="panel-title hidden-xs"> Edit Template </span>
                        </div>

                        <div class="panel-body pn">
                            @if(Session::has('flash_message'))
                                <div class="alert alert-success">
                                    {{ Session::get('flash_message') }}
                                </div>
                            @endif
                            {!! Form::open(['class' => 'form-horizontal', 'url' => route('template.update', $template->id), 'method' => 'put']) !!}
                                <div class="form-group">
                                    <label for="title" class="col-md-2 control-label"> Title </label>
                                    <div class="col-md-10">
                                        <input type="text" placeholder="Template Title..." name="title" id="title"  value="{{$template->title}}" class="form-control" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="description" class="col-md-2 control-label"> Description </label>
                                    <div class="col-md-10">
                                        <textarea name="description" id="description" class="ckeditor form-control" required>{{$template->description}}</textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label"></label>
                                    <div class="col-md-2">
                                        <input type="submit" class="btn btn-bordered btn-info btn-block" value="Update">
                                    </div>
                                    <div class="col-md-2">
                                        <a href="{{route('template.index')}}" class="btn btn-bordered btn-success btn-block">Cancel</a>
                                    </div>
                                </div>
                            {!! Form::close() !!}
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
        $('.ckeditor').ckeditor();
    });
    </script>
@endpush