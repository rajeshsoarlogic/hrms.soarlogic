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
                            <a href=""> Company Expenses </a>
                        </li>
                        <li class="breadcrumb-current-item"> Edit Company Expenses </li>
                    </ol>
            </div>
        </header>
        <!-- -------------- Content -------------- -->
        <section id="content" class="table-layout animated fadeIn" >
            <!-- -------------- Column Center -------------- -->
            <div class="chute-affix" data-spy="affix" data-offset-top="200">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box box-success">
                        <div class="panel">
                            <div class="panel-heading">
                                    <span class="panel-title hidden-xs"> Edit Company Expenses </span>
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
                                                {{Session::get('flash_message')}}
                                            </div>
                                        @endif
                                        {!! Form::open(['class' => 'form-horizontal', 'url' => route('company-expense.update', $companyExpense->id), 'method' => 'put']) !!}
                                        <!-- <div class="form-group">
                                            <label class="col-md-3 control-label"> Select Employee </label>
                                            <div class="col-md-6">
                                                <select class="select2-multiple form-control select-primary" name="employee_id" id="employee_id" required>
                                                    <option value="" selected>Select One</option>
                                                    {{-- @foreach($emps as $emp)
                                                        <option value="{{$emp->id}}" @if($emp->id == $companyExpense->employee_id) selected @endif>{{$emp->name}}</option>
                                                    @endforeach --}}
                                                </select>
                                            </div>
                                        </div> -->

                                        <div class="form-group">
                                            <label for="item" class="col-md-3 control-label"> Item </label>
                                            <div class="col-md-6">
                                                <input type="text" name="item" id="item" class="form-control" value="{{$companyExpense->item}}" placeholder="Item bought" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="purchase_from" class="col-md-3 control-label"> Purchase From</label>
                                            <div class="col-md-6">
                                                <input type="text" name="purchase_from" id="purchase_from" class="form-control" value="{{$companyExpense->purchase_from}}" placeholder="Item bought from" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="date_of_purchase" class="col-md-3 control-label"> Date of Purchase </label>
                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar text-alert pr11"></i>
                                                    </div>
                                                    <input type="text" id="date_of_purchase" class="select2-single form-control" value="{{Carbon\Carbon::parse($companyExpense->date_of_purchase)->format('m/d/Y')}}" name="date_of_purchase" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="amount" class="col-md-3 control-label"> Amount</label>
                                            <div class="col-md-6">
                                                <input type="text" name="amount" id="amount" class="form-control" value="{{$companyExpense->amount}}" placeholder="price" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label"></label>
                                            <div class="col-md-2">
                                                <input type="submit" class="btn btn-bordered btn-info btn-block" value="Submit">
                                            </div>
                                            <div class="col-md-2">
                                                <a class="btn btn-bordered btn-success btn-block" href="{{route('company-expense.index')}}">Cancel</a>
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
        $("#date_of_purchase").datepicker({
            prevText: '<i class="fa fa-chevron-left"></i>',
            nextText: '<i class="fa fa-chevron-right"></i>',
            showButtonPanel: false,
            beforeShow: function (input, inst) {
                var newclass = 'allcp-form';
                var themeClass = $(this).parents('.allcp-form').attr('class');
                var smartpikr = inst.dpDiv.parent();
                if (!smartpikr.hasClass(themeClass)) {
                    inst.dpDiv.wrap('<div class="' + themeClass + '"></div>');
                }
            }
        });
    });
    </script>
@endpush