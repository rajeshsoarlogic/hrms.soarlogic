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
                    <a href=""> Candidate </a>
                </li>
                <li class="breadcrumb-current-item"> Candidate </li>
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
                            <span class="panel-title hidden-xs"> Candidate Lists </span>
                        </div>
                        <div class="panel-body pn">
                            @if(Session::has('flash_message'))
                                <div class="alert alert-success">
                                    {{ Session::get('flash_message') }}
                                </div>
                            @endif
                            <div class="table-responsive">
                                <table class="table allcp-form theme-warning tc-checkbox-1 fs13 table-bordered">
                                    <thead>
                                    <tr class="bg-light">
                                        <th class="text-center">#</th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Skype ID</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Mobile Number</th>
                                        <th class="text-center">Exp (in yrs)</th>
                                        <th class="text-center">Skill</th>
                                        <th class="text-center">Date</th>
                                        <th class="text-center">CV</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i =0;?>
                                    @foreach($recruiters as $recruiter)
                                        @php
                                        $skills_arr = unserialize($recruiter->skills);
                                        @endphp
                                        <tr>
                                            <td class="text-center">{{$i+=1}}</td>
                                            <td class="text-center">{{ $recruiter->name }}</td>
                                            <td class="text-center">{{ $recruiter->skypeid }}</td>
                                            <td class="text-center">{{ $recruiter->email }}</td>
                                            <td class="text-center">{{ $recruiter->mobile_num }}</td>
                                            <td class="text-center">{{ $recruiter->exp_in_yrs }}</td>
                                            <td class="text-center">
                                                @foreach($skills as $skill)
                                                    @if(in_array($skill->id, $skills_arr))
                                                        {{$skill->title}},
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td class="text-center">{{ $recruiter->created_at->format('d-M-Y') }}</td>
                                            <td class="text-center">
                                                <a href="{{asset('storage/app/recruiter/resume/'.$recruiter->resume)}}" target="_blank">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group text-right">
                                                    <button type="button" class="btn btn-success br2 btn-xs fs12 dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> Action
                                                        <span class="caret ml5"></span>
                                                    </button>
                                                    <ul class="dropdown-menu" role="menu">
                                                        <li><a href="{{ route('recruiter.edit', $recruiter->id) }}">Edit</a></li>
                                                        <li>
                                                            <form id="del-recruiter-{{$recruiter->id}}" action="{{ route('recruiter.destroy', [ 'id'=> $recruiter->id ]) }}" method="POST" >
                                                                {{ csrf_field() }}
                                                                {{ method_field('DELETE') }}
                                                                <input type="submit" name="del-recruiter-btn" value="Delete" class="form-control" />
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>{!! $recruiters->render() !!}</tr>
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