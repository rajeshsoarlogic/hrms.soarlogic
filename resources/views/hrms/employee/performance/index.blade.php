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
                    <a href=""> Employee Performance </a>
                </li>
                <li class="breadcrumb-current-item"> Employee Performance Listings </li>
            </ol>
        </div>
    </header>


    <!-- -------------- Content -------------- -->
    <section id="content" class="table-layout animated fadeIn">

        <!-- -------------- Column Center -------------- -->
        <div class="chute chute-center">

            <!-- -------------- Products Status Table -------------- -->
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-success">
                    <div class="panel">
                        <div class="panel-heading">
                            <span class="panel-title hidden-xs"> Employee Performance Lists </span>
                        </div>
                        <div class="panel-body pn">
                            @if(Session::has('flash_message'))
                                <div class="alert alert-success">
                                    {{ Session::get('flash_message') }}
                                </div>
                            @endif
                            <div class="table-responsive">
                                <table class="table allcp-form theme-warning tc-checkbox-1 fs13">
                                    <thead>
                                    <tr class="bg-light">
                                        <th class="text-center">#</th>
                                        <th class="text-center">Reviewer Name</th>
                                        <th class="text-center">Reviewer Title</th>
                                        <th class="text-center">Review Date</th>
                                        <th class="text-center">Potential</th>
                                        <th class="text-center">Work Quality</th>
                                        <th class="text-center">Work Consistency</th>
                                        <th class="text-center">Communication</th>
                                        <th class="text-center">Comment And Approval</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i =0;?>
                                    @foreach($performances as $item)
                                        <tr>
                                            <td class="text-center">{{$i+=1}}</td>
                                            <td class="text-center">{{$item->reviewer_name}}</td>
                                            <td class="text-center">{{$item->reviewer_title}}</td>
                                            <td class="text-center">{{$item->review_date}}</td>
                                            <td class="text-center">{{$qualities[$item->potential]}}</td>
                                            <td class="text-center">{{$qualities[$item->work_quality]}}</td>
                                            <td class="text-center">{{$qualities[$item->work_consistency]}}</td>
                                            <td class="text-center">{{$qualities[$item->communication]}}</td>
                                            <td class="text-center">{!! nl2br($item->comment_and_approval) !!}</td>
                                            <td class="text-center">
                                                <div class="btn-group text-right">
                                                    <button type="button" class="btn btn-success br2 btn-xs fs12 dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> Action
                                                        <span class="caret ml5"></span>
                                                    </button>
                                                    <ul class="dropdown-menu" role="menu">
                                                        <li>
                                                            <a href="{{ route('employee-performance.edit', $item->id) }}">Edit</a>
                                                        </li>
                                                        <li>
                                                            <form id="del-item-{{$item->id}}" action="{{ route('employee-performance.destroy', [ 'id'=> $item->id ]) }}" method="POST" >
                                                                {{ csrf_field() }}
                                                                {{ method_field('DELETE') }}
                                                                <input type="submit" name="del-item-btn" value="Delete" class="form-control" />
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        {!! $performances->render() !!}
                                    </tr>
                                    </tbody>
                                </table>
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