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
                    <a href=""> Salary Slip </a>
                </li>
                <li class="breadcrumb-current-item"> Add Salary Slip </li>
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
                                <span class="panel-title hidden-xs"> Add Salary Slip </span>
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
                                        {!! Form::open(['class' => 'form-horizontal', 'url' => route('salaryslip.store'), 'method' => 'post']) !!}
                                            <div class="form-group">
                                                <label class="col-md-2 control-label"> Employee </label>
                                                <div class="col-md-10">
                                                    <select name="user_id" id="user_id" class="form-control" required>
                                                        <option value="">--- SELECT ---</option>
                                                        @foreach($emps as $emp)
                                                            <option value="{{$emp->id}}">{{$emp->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="department" class="col-md-2 control-label"> Department </label>
                                                <div class="col-md-10">
                                                    <input type="text" name="department" id="department" class="form-control" placeholder="Department" required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="month_year" class="col-md-2 control-label"> Month Year </label>
                                                <div class="col-md-10">
                                                    <input type="date" name="month_year" id="month_year" class="form-control" placeholder="Month Year" required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="pan" class="col-md-2 control-label"> PAN </label>
                                                <div class="col-md-10">
                                                    <input type="text" name="pan" id="pan" class="form-control" placeholder="PAN" required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="designation" class="col-md-2 control-label"> Designation </label>
                                                <div class="col-md-10">
                                                    <input type="text" name="designation" id="designation" class="form-control" placeholder="Designation" required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="basic" class="col-md-2 control-label"> Basic </label>
                                                <div class="col-md-10">
                                                    <input type="number" name="basic" id="basic" class="form-control" placeholder="Basic" required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="da" class="col-md-2 control-label"> DA </label>
                                                <div class="col-md-5">
                                                    <input type="number" name="da" id="da" class="form-control" placeholder="DA % i.e 5 % of Basic" required readonly="true">
                                                </div>
                                                <div class="col-md-5">
                                                    <span id="da_basic" class="form-control"></span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="hra" class="col-md-2 control-label"> HRA </label>
                                                <div class="col-md-5">
                                                    <input type="number" name="hra" id="hra" class="form-control" placeholder="HRA" required readonly="true">
                                                </div>
                                                <div class="col-md-5">
                                                    <span id="hra_basic" class="form-control"></span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="conveyance_allow" class="col-md-2 control-label"> Conveyance Allow </label>
                                                <div class="col-md-10">
                                                    <input type="number" name="conveyance_allow" id="conveyance_allow" class="form-control" placeholder="Conveyance Allow" required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="education_allow" class="col-md-2 control-label"> Education Allow </label>
                                                <div class="col-md-10">
                                                    <input type="number" name="education_allow" id="education_allow" class="form-control" placeholder="Education Allow" required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="medical_allow" class="col-md-2 control-label"> Medical Allow </label>
                                                <div class="col-md-10">
                                                    <input type="number" name="medical_allow" id="medical_allow" class="form-control" placeholder="Medical Allow" required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="internet_allow" class="col-md-2 control-label"> Internet Allow </label>
                                                <div class="col-md-10">
                                                    <input type="number" name="internet_allow" id="internet_allow" class="form-control" placeholder="Internet Allow" required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="special_allow" class="col-md-2 control-label"> Special Allow </label>
                                                <div class="col-md-10">
                                                    <input type="number" name="special_allow" id="special_allow" class="form-control" placeholder="Special Allow" required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="p_fund" class="col-md-2 control-label"> P Fund </label>
                                                <div class="col-md-10">
                                                    <input type="number" name="p_fund" id="p_fund" class="form-control" placeholder="P Fund" required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="taxes" class="col-md-2 control-label"> Taxes </label>
                                                <div class="col-md-10">
                                                    <input type="number" name="taxes" id="taxes" class="form-control" placeholder="Taxes" required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-2 control-label"></label>
                                                <div class="col-md-2">
                                                    <input type="submit" class="btn btn-bordered btn-info btn-block" value="Submit">
                                                </div>
                                                <div class="col-md-2">
                                                    <a class="btn btn-bordered btn-success btn-block" href="{{route('salaryslip.index')}}">Cancel</a>
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
        $('#basic').on('blur', function(){
            var basicPay = $(this).val();
            if(basicPay != ""){
                $("#da").attr('readonly', false);
                $("#hra").attr('readonly', false);
            }else{
                $("#da").attr('readonly', true);
                $("#da").val("");
                $("#da_basic").val('');
                
                $("#hra").attr('readonly', true);
                $("#hra").val("");
                $("#hra_basic").val('');
            }
        });

        /*Get DA of Basic Pay*/
        $('#da').on('blur', function(){
            var daVal = $(this).val();
            if(daVal != ""){
                var basicVal = $("#basic").val();
                $("#da_basic").text(`${daVal}% of ${basicVal} = ${(daVal*basicVal)/100}`);
            }else{
                $("#da_basic").html('');
            }
        });

        /*Get HRA of Basic Pay*/
        $('#hra').on('blur', function(){
            var hraVal = $(this).val();
            if(hraVal != ""){
                var basicVal = $("#basic").val();
                $("#hra_basic").text(`${hraVal}% of ${basicVal} = ${(hraVal*basicVal)/100}`);
            }else{
                $("#hra_basic").html('');
            }
        });
    });
    </script>
@endpush