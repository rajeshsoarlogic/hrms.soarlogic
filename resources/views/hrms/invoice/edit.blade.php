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
                    <a href=""> Invoice </a>
                </li>
                <li class="breadcrumb-current-item"> Edit Invoice </li>
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
                            <span class="panel-title hidden-xs"> Edit Invoice </span>
                        </div>

                        <div class="panel-body pn">
                            <div class="table-responsive">
                                <div class="panel-body p25 pb10">

                                    @if(Session::has('flash_message'))
                                        <div class="alert alert-success">
                                            {{ Session::get('flash_message') }}
                                        </div>
                                    @endif
                                    {!! Form::open(['class' => 'form-horizontal', 'url' => route('invoice.update', $invoice->id), 'method' => 'put', 'files' => true]) !!}
                                        <div class="form-group">
                                            <label class="col-md-3 control-label"> Title </label>
                                            <div class="col-md-6">
                                                <input type="text" placeholder="Invoice Title..." name="title" id="title" class="form-control" value="{{$invoice->title}}" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="invoice" class="col-md-3 control-label"> Invoice File</label>
                                            <div class="col-md-6">
                                                <input type="file" placeholder="Invoice file" name="invoice" id="invoice" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="date" class="col-md-3 control-label"> Date </label>
                                            <div class="col-md-6">
                                                <input type="date" placeholder="Invoice date" name="date" id="date" value="{{$invoice->date}}" class="form-control" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="client_id" class="col-md-3 control-label"> Client </label>
                                            <div class="col-md-6">
                                                <select  name="client_id" id="client_id" class="form-control" required>
                                                    @foreach($clients as $client)
                                                    <option value="{{$client->id}}" @if($invoice->client_id == $client->id) selected @endif>{{$client->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label"></label>
                                            <div class="col-md-2">
                                                <input type="submit" class="btn btn-bordered btn-info btn-block" value="Update">
                                            </div>
                                            <div class="col-md-2">
                                                <a href="{{route('invoice.index')}}" class="btn btn-bordered btn-success btn-block">Cancel</a>
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