@extends('layouts.app')
@section('title', 'Reporting')
@section('content')

<div class="page-header">
    <div class="page-header-title">
        <h4>Reporting</h4>
    </div>
    <div class="page-header-breadcrumb">
        <ul class="breadcrumb-title">
            <li class="breadcrumb-item">
                <a href="#!">
                    <i class="icofont icofont-home"></i>
                </a>
            </li>
            <li class="breadcrumb-item"><a href="#!">Reporting</a>
            </li>
        </ul>
    </div>
</div>

<div class="page-body">
    
    <div class="row">
        <div class="col-3 col-md-3">
            <div class="card">
                <div class="card-header">
                    <h5>Monthly Report<h5>
                </div>
                <div class="card-block">
                    <p>This will generate a monthly report based on how many event have been helded in each month by category</p>
                    <div><a class="btn btn-info btn-round btn-block" href="{{route('report.monthly')}}"><i class="icofont icofont-file-excel"></i> Export Excel</a></div>
                </div>
            </div>
        </div>

        @if(Auth::user()->roles_id == 1)
        <div class="col-3 col-md-3">
            <div class="card">
                <div class="card-header">
                    <h5>Agency Event Report<h5>
                </div>
                <div class="card-block">
                    <p>This will generate a monthly report based on how many event have been helded in each month by each agency</p>
                    <div><a class="btn btn-info btn-round btn-block" href="{{route('report.agency')}}"><i class="icofont icofont-file-excel"></i> Export Excel</a></div>
                </div>
            </div>
        </div>
        <div class="col-3 col-md-3">
            <div class="card">
                <div class="card-header">
                    <h5>App Roles Report<h5>
                </div>
                <div class="card-block">
                    <p>This will generate a monthly report based on how many user had been enrolled into this System (exlude Admin)</p>
                    <div><a class="btn btn-info btn-round btn-block" href="{{route('report.roles_user')}}"><i class="icofont icofont-file-excel"></i> Export Excel</a></div>
                </div>
            </div>
        </div>
        @endif
        
    </div>
</div>

@endsection