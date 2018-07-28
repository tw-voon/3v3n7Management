@extends('layouts.app')
@section('title', 'New Agency User')
@section('content')

<div class="page-header">
    <div class="page-header-title">
        <h4>Events</h4>
    </div>
    <div class="page-header-breadcrumb">
        <ul class="breadcrumb breadcrumb-title">
            <li class="breadcrumb-item">
                <a href="#!">
                    <i class="icofont icofont-home"></i>
                </a>
            </li>
            <li class="breadcrumb-item"><a href="{{route('agency.index')}}">Events</a>
            <li class="breadcrumb-item"><a href="#!">New Agency User</a>
            </li>
        </ul>
    </div>
</div>

<div class="page-body">

    {{-- Table info section --}}

    <div class="card">
        <div class="card-header">
            <h5>New Agency User</h5>
        </div>
        <div class="card-block" style="padding: 15px 20px;">
            <h4 class="sub-title">New Agency User</h4>

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

            <form id="form" method="POST" action="{{route('agency_user.save')}}">
                <input name="_method" type="hidden" value="POST"> {{csrf_field()}}
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Username </label>
                    <div class="col-sm-10">
                        <input type="text" id="name" class="form-control form-control-round" placeholder="User name" name="name">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Email </label>
                    <div class="col-sm-10">
                        <input type="text" id="email" class="form-control form-control-round" placeholder="Email" name="email">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Password </label>
                    <div class="col-sm-10">
                        <input type="text" id="pssd" class="form-control form-control-round" placeholder="Password" name="password">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Password Confirm </label>
                    <div class="col-sm-10">
                        <input type="text" id="pssd_again" class="form-control form-control-round" placeholder="Password confirm" name="password_again">
                    </div>
                </div>
                <input type="hidden" name="agency_id" value="{{$requests}}">
            </form>

            <div class="row pull-right" style="margin:auto;">
                <button class="btn btn-success"><i class="icofont icofont-save"></i>  Save</button>
            </div>

        </div>
    </div>

</div>

<script type="text/javascript" src="{{ asset('js/jquery-2.1.4.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function(){

        $('.btn-success').on('click', function(){

            if($('#name').val().trim().length == 0){
                alert('Name is required');
                return;
            }

            if($('#email').val().trim().length == 0){
                alert('Email is required');
                return;
            }

            if($('#pssd').val().trim().length == 0){
                alert('Password cannot be empty');
                return;
            }

            if($('#pssd_again').val().trim().length == 0){
                alert('Password Confirm cannot be empty');
                return;
            }

            if($('#pssd_again').val().trim() != $('#pssd').val().trim()){
                alert('Password not the same');
                return;
            }

            $('#form').submit();
        });

    });
</script>

@endsection