@extends('hrms.layouts.base')

@push('styles')
<style>
#signature-pad{
    border: 2px solid;
}
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
                    <a href=""> Employee Performance </a>
                </li>
                <li class="breadcrumb-current-item"> Add Employee Performance </li>
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
                                <span class="panel-title hidden-xs"> Add Employee Performance </span>
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
                                        
                                        {!! Form::open(['class' => 'form-horizontal', 'url' => route('employee-performance.store'), 'method' => 'post']) !!}
                                            <div class="form-group">
                                                <label class="col-md-2 control-label"> Employee </label>
                                                <div class="col-md-10">
                                                    <select name="employee_id" id="employee_id" class="form-control" required>
                                                        <option value="">--- SELECT ---</option>
                                                        @foreach($emps as $emp)
                                                            <option value="{{$emp->id}}">{{$emp->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- <div class="form-group">
                                                <label for="department_id" class="col-md-2 control-label"> Department </label>
                                                <div class="col-md-10">
                                                    <select name="department_id" id="department_id" class="form-control" required>
                                                        <option value="">--- SELECT ---</option>
                                                        @foreach($departments as $dept)
                                                            <option value="{{$dept->id}}">{{$dept->title}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div> -->

                                            <div class="form-group">
                                                <label for="reviewer_name" class="col-md-2 control-label"> Reviewer Name </label>
                                                <div class="col-md-10">
                                                    <input type="text" name="reviewer_name" id="reviewer_name" class="form-control" required />
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="reviewer_title" class="col-md-2 control-label"> Reviewer Title </label>
                                                <div class="col-md-10">
                                                    <input type="text" name="reviewer_title" id="reviewer_title" class="form-control" required />
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="review_date" class="col-md-2 control-label"> Reviewer Date </label>
                                                <div class="col-md-10">
                                                    <input type="date" name="review_date" id="review_date" class="form-control" required />
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="potential" class="col-md-2 control-label"> Works To Full Potential </label>
                                                <div class="col-md-10">
                                                    <select name="potential" id="potential" class="form-control" required>
                                                        <option value="">--- SELECT ---</option>
                                                        @foreach($qualities as $key => $quality)
                                                            <option value="{{$key}}">{{$quality}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="work_quality" class="col-md-2 control-label"> Quality Of Work</label>
                                                <div class="col-md-10">
                                                    <select name="work_quality" id="work_quality" class="form-control" required>
                                                        <option value="">--- SELECT ---</option>
                                                        @foreach($qualities as $key => $quality)
                                                            <option value="{{$key}}">{{$quality}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="work_consistency" class="col-md-2 control-label"> Work Consistency </label>
                                                <div class="col-md-10">
                                                    <select name="work_consistency" id="work_consistency" class="form-control" required>
                                                        <option value="">--- SELECT ---</option>
                                                        @foreach($qualities as $key => $quality)
                                                            <option value="{{$key}}">{{$quality}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="communication" class="col-md-2 control-label"> Communication </label>
                                                <div class="col-md-10">
                                                    <select name="communication" id="communication" class="form-control" required>
                                                        <option value="">--- SELECT ---</option>
                                                        @foreach($qualities as $key => $quality)
                                                            <option value="{{$key}}">{{$quality}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="independent_work" class="col-md-2 control-label"> Independent Work </label>
                                                <div class="col-md-10">
                                                    <select name="independent_work" id="independent_work" class="form-control" required>
                                                        <option value="">--- SELECT ---</option>
                                                        @foreach($qualities as $key => $quality)
                                                            <option value="{{$key}}">{{$quality}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="takes_initiative" class="col-md-2 control-label"> Takes Initiative </label>
                                                <div class="col-md-10">
                                                    <select name="takes_initiative" id="takes_initiative" class="form-control" required>
                                                        <option value="">--- SELECT ---</option>
                                                        @foreach($qualities as $key => $quality)
                                                            <option value="{{$key}}">{{$quality}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="group_work" class="col-md-2 control-label"> Group Work </label>
                                                <div class="col-md-10">
                                                    <select name="group_work" id="group_work" class="form-control" required>
                                                        <option value="">--- SELECT ---</option>
                                                        @foreach($qualities as $key => $quality)
                                                            <option value="{{$key}}">{{$quality}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="productivity" class="col-md-2 control-label"> Productivity </label>
                                                <div class="col-md-10">
                                                    <select name="productivity" id="productivity" class="form-control" required>
                                                        <option value="">--- SELECT ---</option>
                                                        @foreach($qualities as $key => $quality)
                                                            <option value="{{$key}}">{{$quality}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="creativity" class="col-md-2 control-label"> Creativity </label>
                                                <div class="col-md-10">
                                                    <select name="creativity" id="creativity" class="form-control" required>
                                                        <option value="">--- SELECT ---</option>
                                                        @foreach($qualities as $key => $quality)
                                                            <option value="{{$key}}">{{$quality}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="honesty" class="col-md-2 control-label"> Honesty </label>
                                                <div class="col-md-10">
                                                    <select name="honesty" id="honesty" class="form-control" required>
                                                        <option value="">--- SELECT ---</option>
                                                        @foreach($qualities as $key => $quality)
                                                            <option value="{{$key}}">{{$quality}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="integrity" class="col-md-2 control-label"> Integrity </label>
                                                <div class="col-md-10">
                                                    <select name="integrity" id="integrity" class="form-control" required>
                                                        <option value="">--- SELECT ---</option>
                                                        @foreach($qualities as $key => $quality)
                                                            <option value="{{$key}}">{{$quality}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="coworker_relations" class="col-md-2 control-label"> Coworker Relations </label>
                                                <div class="col-md-10">
                                                    <select name="coworker_relations" id="coworker_relations" class="form-control" required>
                                                        <option value="">--- SELECT ---</option>
                                                        @foreach($qualities as $key => $quality)
                                                            <option value="{{$key}}">{{$quality}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="client_relations" class="col-md-2 control-label"> Client Relations </label>
                                                <div class="col-md-10">
                                                    <select name="client_relations" id="client_relations" class="form-control" required>
                                                        <option value="">--- SELECT ---</option>
                                                        @foreach($qualities as $key => $quality)
                                                            <option value="{{$key}}">{{$quality}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="technical_skills" class="col-md-2 control-label"> Technical Skills </label>
                                                <div class="col-md-10">
                                                    <select name="technical_skills" id="technical_skills" class="form-control" required>
                                                        <option value="">--- SELECT ---</option>
                                                        @foreach($qualities as $key => $quality)
                                                            <option value="{{$key}}">{{$quality}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="dependability" class="col-md-2 control-label"> Dependability </label>
                                                <div class="col-md-10">
                                                    <select name="dependability" id="dependability" class="form-control" required>
                                                        <option value="">--- SELECT ---</option>
                                                        @foreach($qualities as $key => $quality)
                                                            <option value="{{$key}}">{{$quality}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="punctuallity" class="col-md-2 control-label"> Punctuallity </label>
                                                <div class="col-md-10">
                                                    <select name="punctuallity" id="punctuallity" class="form-control" required>
                                                        <option value="">--- SELECT ---</option>
                                                        @foreach($qualities as $key => $quality)
                                                            <option value="{{$key}}">{{$quality}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="attendance" class="col-md-2 control-label"> Attendance </label>
                                                <div class="col-md-10">
                                                    <select name="attendance" id="attendance" class="form-control" required>
                                                        <option value="">--- SELECT ---</option>
                                                        @foreach($qualities as $key => $quality)
                                                            <option value="{{$key}}">{{$quality}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="previous_review_goals_achieved" class="col-md-2 control-label"> Previous Review Goals Achieved </label>
                                                <div class="col-md-10">
                                                    <textarea name="previous_review_goals_achieved" id="previous_review_goals_achieved" class="ckeditor form-control" required></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="goals_for_next_review" class="col-md-2 control-label"> Previous Review Goals Achieved </label>
                                                <div class="col-md-10">
                                                    <textarea name="goals_for_next_review" id="goals_for_next_review" class="ckeditor form-control" required></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="comment_and_approval" class="col-md-2 control-label"> Comment And Approval </label>
                                                <div class="col-md-10">
                                                    <textarea name="comment_and_approval" id="comment_and_approval" class="ckeditor form-control" required></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-2 control-label"></label>
                                                <div class="col-md-2">
                                                    <input type="submit" class="btn btn-bordered btn-info btn-block save-empPerformance-btn" id="save-empPerformance-btn" value="Submit">
                                                </div>
                                                <div class="col-md-2">
                                                    <a class="btn btn-bordered btn-success btn-block" href="{{route('employee-performance.index')}}">Cancel</a>
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
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
    <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.ckeditor').ckeditor();
        });
    </script>
@endpush