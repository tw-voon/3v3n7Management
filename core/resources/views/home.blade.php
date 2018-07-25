@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')

<script type="text/javascript" src="{{ asset('js/highcharts.js') }}"></script>

<div class="page-header">
    <div class="page-header-title">
        <h4>Dashboard</h4>
    </div>
    <div class="page-header-breadcrumb">
        <ul class="breadcrumb-title">
            <li class="breadcrumb-item">
                <a href="#!">
                    <i class="icofont icofont-home"></i>
                </a>
            </li>
            <li class="breadcrumb-item"><a href="#!">Dashboard</a>
            </li>
        </ul>
    </div>
</div>

<div class="page-body">
    <div class="row">

        @if(Auth::user()->roles_id == 1)
        <div class="col-md-6 col-xl-3">
            <div class="card social-widget-card">
                <div class="card-block-big bg-facebook">
                    <h3>{{$data['total_agency']}}</h3>
                    <span class="m-t-10">Agency</span>
                    <i class="icofont icofont-business-man-alt-1"></i>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card social-widget-card">
                <div class="card-block-big bg-facebook">
                    <h3>{{$data['total_event']}}</h3>
                    <span class="m-t-10">Event</span>
                    <i class="icofont icofont-files"></i>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card social-widget-card">
                <div class="card-block-big bg-facebook">
                    <h3>{{$data['total_app_user']}}</h3>
                    <span class="m-t-10">user</span>
                    <i class="icofont icofont-users-alt-2"></i>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 col-xl-3">
            <div class="card social-widget-card">
                <div class="card-block-big bg-facebook">
                    <h3>{{$data['hot_category']}}</h3>
                    @if($data['hot_category'] != 'No trending category')
                        <span class="m-t-10">is hot category</span>
                    @else
                        <span class="m-t-10">found yet</span>
                    @endif
                    <i class="icofont icofont-fire-alt"></i>
                </div>
            </div>
        </div>
        @endif

        @if(Auth::user()->roles_id == 4)
        <div class="col-md-12 col-xl-6">
            <!-- widget primary card start -->
            <div class="card table-card widget-primary-card">
                <div class="">
                    <div class="row-table">
                        <div class="col-sm-3 card-block-big">
                            <i class="icofont icofont-star"></i>
                        </div>
                        <div class="col-sm-9">
                            <h3>{{$data['ongoing_event']}}</h3>
                            <h6>Ongoing Events</h6>
                        </div>
                    </div>
                </div>
            </div>
            <!-- widget primary card end -->
        </div>
        <div class="col-md-6 col-xl-6">
            <!-- widget-success-card start -->
            <div class="card table-card widget-success-card">
                <div class="">
                    <div class="row-table">
                        <div class="col-sm-3 card-block-big">
                            <i class="icofont icofont-trophy-alt"></i>
                        </div>
                        <div class="col-sm-9">
                            <h3>{{$data['completed_event']}}</h3>
                            <h6>Completed Events</h6>
                        </div>
                    </div>
                </div>
            </div>
            <!-- widget-success-card end -->
        </div>
        @endif

        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5>Monthly Event Chart</h5>
                </div>
                <div class="card-block">
                    <div id="chartsss" style="width: 100%; height: auto; margin: 0 auto"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5>Top 5 Coming Soon Event</h5>
                </div>
                <div class="card-block">

                    <div class="table-responsive">
                        <table class="table table-hover m-0">
                            <thead>
                                <tr>
                                    <th>Image Cover</th>
                                    <th>Title</th>
                                    <th>Event Time</th>
                                    <th>Location</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data['coming_events'] as $event)

                                <tr>
                                    <td>
                                        <img style="max-height:100px;max-width: 150px;width:100%;height:100%; object-fit: cover;" src="{{ asset('images/' . $event->media[0]->link) }}">
                                    </td>
                                    <td>
                                        <a href="{{route('event.view', $event->id)}}">{{$event->title}}</a>
                                    </td>
                                    <td>
                                        {{$event->start_time}} <br> {{$event->end_time}}
                                    </td>
                                    <td>
                                        {{$event->locations->name}}
                                    </td>
                                </tr>

                                @endforeach

                                @if(count($data['coming_events']) == 0)
                                    <tr class="text-center">
                                        <td colspan="4">No Upcoming events</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

        </div>
    </div> 
</div>


<!-- Horizontal-Timeline js -->
<script type="text/javascript" src="{{ asset('js/jquery-2.1.4.js') }}"></script>
<script type="text/javascript" src="{{ asset('pages/dashboard/horizontal-timeline/js/jquery.mobile.custom.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('pages/dashboard/horizontal-timeline/js/main.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/modernizr/modernizr.js') }}"></script>
<script type="text/javascript" src="{{ asset('node_modules/moment/moment.js') }}"></script>
<script type="text/javascript" src="{{ asset('node_modules/chart.js/dist/Chart.js') }}"></script>

<script>
$(document).ready(function() {

    // console.log(<?php // print_r($graph) ?>);
    Highcharts.chart('chartsss', <?php print_r($graph) ?>);

});
</script>
@endsection
