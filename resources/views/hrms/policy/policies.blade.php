@extends('hrms.layouts.base')

@section('content')

    <section id="content" class="animated fadeIn">

        <div class="row" >

            <!-- -------------- FAQ Left Column -------------- -->
            <div class="col-md-12">
                <div class="box box-success">
                <div class="panel bg-gradient">

                    <div class="mt40">
                        <h2 class="text-muted mb20 mtn"> Policies </h2>
                        <div class="panel-group accordion" id="accordion1">
                            @foreach($policies as $key => $policy)
                                <div class="panel">
                                    <div class="panel-heading">
                                        <a class="accordion-toggle accordion-icon link-unstyled collapsed" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_{{$policy->id}}">
                                            {{++$key.". ".strip_tags($policy->title)}}
                                        </a>
                                    </div>
                                    <div id="accordion1_{{$policy->id}}" class="panel-collapse collapse" style="height: 0px;">
                                        <div class="panel-body">
                                            {{$policy->description}}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- -------------- FAQ Right Column -------------- -->
        </div>
    </section>
    <!-- -------------- /Content -------------- -->
    </section>
@endsection