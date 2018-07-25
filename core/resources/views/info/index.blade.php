@extends('layouts.app')

@section('title', 'System Info')

@section('content')



<div class="page-header">

    <div class="page-header-title">

        <h4>System Info Page</h4>

    </div>

    <div class="page-header-breadcrumb">

        <ul class="breadcrumb-title">

            <li class="breadcrumb-item">

                <a href="#!">

                    <i class="icofont icofont-home"></i>

                </a>

            </li>

            <li class="breadcrumb-item"><a href="#!">Info Page</a>

            </li>

        </ul>

    </div>

</div>



<?php $count = 1; ?>



<div class="page-body">



	{{-- Table info section --}}



	<div class="card">

        <div class="card-header">

            <h5>Events System Info</h5>

            <div class="card-header-right">

                <i class="icofont icofont-rounded-down"></i>

                <i class="icofont icofont-refresh"></i>

                <i class="icofont icofont-close-circled"></i>

            </div>

        </div>

        <div class="card-block">



            <form id="form" method="POST" action="{{route('info.save')}}">

                <input name="_method" type="hidden" value="POST"> {{csrf_field()}}

                <textarea name="info_text">@if(isset($info->source)){{html_entity_decode($info->source)}}@endif</textarea>

                <br>

                <div class="row pull-right" style="margin:auto;">

                    <button class="btn btn-success"><i class="icofont icofont-save"></i>  Save</button>

                </div>



            </form>

            

        </div>

    </div>



</div>



<script src="/core/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>

<script src="/core/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>

<script>

    $('textarea').ckeditor();

    // $('.textarea').ckeditor(); // if class is prefered.

</script>



@endsection