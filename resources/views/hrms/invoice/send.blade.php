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
                <li class="breadcrumb-current-item"> Send Invoice </li>
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
                                <span class="panel-title hidden-xs"> Send Invoice </span>
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
                                        {!! Form::open(['class' => 'form-horizontal', 'url' => route('invoice.send.to.client'), 'method' => 'post']) !!}
                                            <div class="form-group">
                                                <label class="col-md-3 control-label"> Client Name </label>
                                                <div class="col-md-6">
                                                    <select name="client_id" id="client_id" class="form-control" required>
                                                        <option value="">== SELECT CLIENT ==</option>
                                                        @foreach($clients as $client)
                                                        <option value="{{$client->id}}">{{$client->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="emails" class="col-md-3 control-label"> Emails </label>
                                                <div class="col-md-6">
                                                    <input type="text" placeholder="Emails (eg. email1@test.com,email2@test.com)" name="emails" id="emails" class="form-control" required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="invoice_id" class="col-md-3 control-label"> Invoice File</label>
                                                <div class="col-md-6">
                                                    <span class="invoice_name"></span>
                                                    <input type="hidden" name="invoice_id" id="invoice_id" class="form-control" required />
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-3 control-label"></label>
                                                <div class="col-md-2">
                                                    <input type="submit" class="btn btn-bordered btn-info btn-block" value="Submit">
                                                </div>
                                                <div class="col-md-2">
                                                    <a class="btn btn-bordered btn-success btn-block" href="{{route('invoice.index')}}">Cancel</a>
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
    <script type="text/javascript">
    $(document).ready(function(){
        $("#client_id").on("change", function(){
            var clientId = $(this).val();
            if(clientId!=''){
                $.ajax({
                    type: "POST",
                    url: "{{ route('get.client.invoice') }}",
                    data: {
                        client_id: clientId,
                        _token: "{{ csrf_token() }}",
                    },
                    success: function(result) {
                        var invoiceTitle, invoiceId;
                        invoiceTitle = invoiceId = '';
                        $.each(result.invoices, function(ind, val){
                            invoiceTitle += val.title + ", ";
                            invoiceId += val.id + ",";
                        });
                        $("span.invoice_name").html(invoiceTitle);
                        $("#invoice_id").val(invoiceId);
                    },
                    error: function(result) {
                        alert('error');
                    }
                });
            }else{
                $("span.invoice_name").html('');
                $("#invoice_id").val('');
            }
        });
    });
    </script>
@endpush