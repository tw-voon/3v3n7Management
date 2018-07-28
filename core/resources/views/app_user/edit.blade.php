@extends('layouts.app')
@section('title', $appsuser[0]->name)
@section('content')

<div class="page-header">
    <div class="page-header-title">
        <h4>{{$appsuser[0]->name}}</h4>
    </div>
    <div class="page-header-breadcrumb">
        <ul class="breadcrumb breadcrumb-title">
            <li class="breadcrumb-item">
                <a href="#!">
                    <i class="icofont icofont-home"></i>
                </a>
            </li>
            <li class="breadcrumb-item"><a href="{{route('event_cat.index')}}">Event Category</a>
            <li class="breadcrumb-item"><a href="#!">{{$appsuser[0]->name}}</a>
            </li>
        </ul>
    </div>
</div>

<div class="page-body">

    {{-- Table info section --}}

    <div class="card">
        <div class="card-header">
            <h5>{{$appsuser[0]->name}}</h5>
        </div>
        <div class="card-block" style="padding: 15px 20px;">
            <h4 class="sub-title">Category Information</h4>

             <div class="row">
                <div class="clearfix col-md-12">
                    @if (count($errors) > 0)
                        <div class="alert alert-warning">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>

            <form id="form" method="POST" action="{{route('app_user.update',$appsuser[0]->id)}}">
                <input name="_method" type="hidden" value="POST"> {{csrf_field()}}
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Username </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control form-control-round" placeholder="User name" name="name" value="{{$appsuser[0]->name}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Email </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control form-control-round" placeholder="Email" name="email" value="{{$appsuser[0]->email}}">
                    </div>
                </div>
            </form>

            <div class="row pull-right" style="margin:auto;">
                <button class="btn btn-success"><i class="icofont icofont-save"></i>  Update</button>
            </div>

        </div>
    </div>

</div>

@endsection