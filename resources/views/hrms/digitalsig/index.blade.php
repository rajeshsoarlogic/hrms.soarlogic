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
                    <a href=""> Digital Signature </a>
                </li>
                <li class="breadcrumb-current-item"> Digital Signature Listings </li>
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
                            <span class="panel-title hidden-xs"> Digital Signature Lists </span>
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
                                        <th class="text-center">Title</th>
                                        <th class="text-center">Signature</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i =0;?>
                                    @foreach($signatures as $sig)
                                        <tr>
                                            <td class="text-center">{{$i+=1}}</td>
                                            <td class="text-center">{{$sig->title}}</td>
                                            <td class="text-center">
                                                <img src="{{ asset('storage/app/signature/'.$sig->signature) }}" class="img-thumbnail" width="50" />
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group text-right">
                                                    <button type="button" class="btn btn-success br2 btn-xs fs12 dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> Action
                                                        <span class="caret ml5"></span>
                                                    </button>
                                                    <ul class="dropdown-menu" role="menu">
                                                        <li>
                                                            <a href="{{ route('digital-sig.edit', $sig->id) }}">Edit</a>
                                                        </li>
                                                        <li>
                                                            <form id="del-sig-{{$sig->id}}" name="del-sig-{{$sig->id}}" action="{{ route('digital-sig.destroy', [ 'id'=> $sig->id ]) }}" method="POST" >
                                                                {{ csrf_field() }}
                                                                {{ method_field('DELETE') }}
                                                                <input type="submit" name="del-sig-btn" value="Delete" class="form-control" />
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        {!! $signatures->render() !!}
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