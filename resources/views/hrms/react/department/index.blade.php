@extends('hrms.layouts.reactbase')

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
                    <a href=""> Department </a>
                </li>
                <li class="breadcrumb-current-item"> Department Listings </li>
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
                            <span class="panel-title hidden-xs"> Department Lists </span>
                        </div>
                        <div class="panel-body pn">
                          <div id="department"></div>
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
      });
    </script>
    <script src="{{ asset('public/js/app.js') }}"></script>
@endpush