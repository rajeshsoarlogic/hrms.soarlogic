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
                    <a href=""> Stamps </a>
                </li>
                <li class="breadcrumb-current-item"> Edit Stamp </li>
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
                            <span class="panel-title hidden-xs"> Edit Stamp </span>
                        </div>

                        <div class="panel-body pn">
                            <div class="table-responsive">
                                <div class="panel-body p25 pb10">

                                    @if(Session::has('flash_message'))
                                        <div class="alert alert-success">
                                            {{ Session::get('flash_message') }}
                                        </div>
                                    @endif
                                    {!! Form::open(['class' => 'form-horizontal', 'url' => route('stamp.update', $stamp->id), 'method' => 'put', 'files' => true]) !!}
                                        <div class="form-group">
                                            <label class="col-md-3 control-label"> Title </label>
                                            <div class="col-md-6">
                                                <input type="text" placeholder="Stamp Title..." name="title" id="title"  value="{{$stamp->title}}" class="form-control" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label"> Stamp Img </label>
                                            <div class="col-md-4">
                                                <input type="file" placeholder="Stamp file..." name="picture" id="picture" class="form-control">
                                            </div>
                                            <div class="col-md-2">
                                                <img src="{{ asset('storage/app/stamps/'.$stamp->picture) }}" class="img-responsive img-thumbnail">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label"></label>
                                            <div class="col-md-2">
                                                <input type="submit" class="btn btn-bordered btn-info btn-block" value="Update">
                                            </div>
                                            <div class="col-md-2">
                                                <a href="{{route('stamp.index')}}" class="btn btn-bordered btn-success btn-block">Cancel</a>
                                            </div>
                                        </div>
                                        {!! Form::close() !!}
                                        {{--</form>--}}
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