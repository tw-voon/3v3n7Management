@extends('layouts.app')
@section('title', 'Add new user')
@section('content')

<div class="page-header">
    <div class="page-header-title">
        <h4>Add new user</h4>
    </div>
    <div class="page-header-breadcrumb">
        <ul class="breadcrumb-title">
            <li class="breadcrumb-item">
                <a href="#!">
                    <i class="icofont icofont-home"></i>
                </a>
            </li>
            <li class="breadcrumb-item"><a href="{{route('app_user.index')}}">App User</a>
            <li class="breadcrumb-item"><a href="#!">New user</a>
            </li>
        </ul>
    </div>
</div>

<div class="page-body">

    {{-- Table info section --}}

    <div class="card">
        <div class="card-header">
            <h5>New User</h5>
        </div>
        <div class="card-block">
            <h4 class="sub-title">Please input usahawan user details</h4>

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

            <form id="form" method="POST" action="{{route('app_user.save')}}">
                <input name="_method" type="hidden" value="POST"> {{csrf_field()}}
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Username </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control form-control-round" placeholder="User name" name="name" />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Email </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control form-control-round" placeholder="Email" name="email" />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Password </label>
                    <div class="col-sm-10">
                        <input class="form-control form-control-round" type="text" placeholder="Password" name="password">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Password Again </label>
                    <div class="col-sm-10">
                        <input class="form-control form-control-round" placeholder="Password again" type="text" name="password_again">
                    </div>
                </div>
            </form>

            <div class="row pull-right" style="margin:auto;">
                <button class="btn btn-success btn-submit"><i class="icofont icofont-save"></i>  Save</button>
            </div>

        </div>
    </div>

</div>

<script type="text/javascript">
    $(document).ready(function(){

        $('.btn-submit').on('click', function(){

            var params = {
                'username': $('input[name="name"]').val(),
                'email': $('input[name="email"]').val(),
                'password': $('input[name="password"]').val(),
                'password_again': $('input[name="password_again"]').val()
            }
            
            console.log(params);
            $('.error_item').remove();
            // $('.has-danger').remove();
            // $('.form-control-danger').remove();

            if(params.username.length == 0){
                $('input[name="name"]').parent().parent().addClass('has-danger');
                $('input[name="name"]').addClass('form-control-danger');
                $('input[name="name"]').after('<div class="col-form-label error_item">Sorry, that username\'s taken. Try another?</div>');
                return;
            } else {
                $('input[name="name"]').parent().parent().removeClass('has-danger');
                $('input[name="name"]').removeClass('form-control-danger');
            }

            if(params.email.length == 0){
                $('input[name="email"]').parent().parent().addClass('has-danger');
                $('input[name="email"]').addClass('form-control-danger');
                $('input[name="email"]').after('<div class="col-form-label error_item">Sorry, that username\'s taken. Try another?</div>');
                return;
            } else {
                $('input[name="email"]').parent().parent().removeClass('has-danger');
                $('input[name="email"]').removeClass('form-control-danger');
            }

            if(params.password.length == 0){
                $('input[name="password"]').parent().parent().addClass('has-danger');
                $('input[name="password"]').addClass('form-control-danger');
                $('input[name="password"]').after('<div class="col-form-label error_item">Sorry, that username\'s taken. Try another?</div>');
                return;
            } else {
                $('input[name="password"]').parent().parent().removeClass('has-danger');
                $('input[name="password"]').removeClass('form-control-danger');
            }

            if(params.password_again.length == 0){
                $('input[name="password_again"]').parent().parent().addClass('has-danger');
                $('input[name="password_again"]').addClass('form-control-danger');
                $('input[name="password_again"]').after('<div class="col-form-label error_item">Sorry, that username\'s taken. Try another?</div>');
                return;
            } else {
                $('input[name="password_again"]').parent().parent().removeClass('has-danger');
                $('input[name="password_again"]').removeClass('form-control-danger');
            }

            if(params.password_again != params.password){
                $('input[name="password_again"]').parent().parent().addClass('has-danger');
                $('input[name="password_again"]').addClass('form-control-danger');
                $('input[name="password_again"]').after('<div class="col-form-label error_item">Sorry, please make sure that both password is the same</div>');
                return;
            } else {
                $('input[name="password_again"]').parent().parent().removeClass('has-danger');
                $('input[name="password_again"]').removeClass('form-control-danger');
            }

            $('#form').submit();

        });

    });
</script>

@endsection