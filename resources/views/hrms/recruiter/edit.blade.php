@extends('hrms.layouts.base')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
<style>
</style>
@endpush

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
                    <a href=""> Candidates </a>
                </li>
                <li class="breadcrumb-current-item"> Edit Candidate </li>
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
                            <span class="panel-title hidden-xs"> Edit Candidate </span>
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
                                    {!! Form::open(['class' => 'form-horizontal', 'url' => route('recruiter.update', $recruiter->id), 'method' => 'put', 'files' => true]) !!}
                                        <div class="form-group">
                                            <label for="name" class="col-md-3 control-label"> Name </label>
                                            <div class="col-md-9">
                                                <input type="text" name="name" id="name" value="{{$recruiter->name}}" class="form-control" placeholder="Name" required />
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="skypeid" class="col-md-3 control-label"> Skype ID </label>
                                            <div class="col-md-9">
                                                <input type="text" name="skypeid" id="skypeid" value="{{$recruiter->skypeid}}" class="form-control" placeholder="Skype ID" required />
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="email" class="col-md-3 control-label"> Email </label>
                                            <div class="col-md-9">
                                                <input type="email" name="email" id="email" value="{{$recruiter->email}}" class="form-control" placeholder="Email" required />
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="mobile_num" class="col-md-3 control-label"> Mobile Number </label>
                                            <div class="col-md-9">
                                                <input type="text" name="mobile_num" id="mobile_num" value="{{$recruiter->mobile_num}}" max="10" maxlength="10" class="form-control" placeholder="Mobile Number" required />
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="exp_in_yrs" class="col-md-3 control-label"> Experience (in years) </label>
                                            <div class="col-md-9">
                                                <select name="exp_in_yrs" id="exp_in_yrs" class="form-control" required>
                                                    <option> Select Experience </option>
                                                    @for ($i = 0; $i < 41; $i++)
                                                        <option value="{{$i}}" @if($i ==  $recruiter->exp_in_yrs) selected @endif>{{$i}}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="resume" class="col-md-3 control-label"> Resume </label>
                                            <div class="col-md-9">
                                                <input type="file" name="resume" id="resume" class="form-control" />
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="skills" class="col-md-3 control-label"> Skills </label>
                                            <div class="col-md-9">
                                                <select name="skills[]" id="skills" class="form-control skills" data-live-search="true" multiple title="Choose Skill ..." data-size="5" data-container="body" required>
                                                    @foreach ($skills as $skill)
                                                        <option value="{{$skill->id}}">{{$skill->title}}</option>
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
                                                <a href="{{route('recruiter.index')}}" class="btn btn-bordered btn-success btn-block">Cancel</a>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script>

    <script type="text/javascript">
    $(document).ready(function(){
        @php $skills_saved = unserialize($recruiter->skills); @endphp
        //console.log("skill array: ",{{json_encode($skills_saved, JSON_NUMERIC_CHECK)}});
        $('.skills').selectpicker('val', {{json_encode($skills_saved, JSON_NUMERIC_CHECK)}});
    });
    </script>
@endpush