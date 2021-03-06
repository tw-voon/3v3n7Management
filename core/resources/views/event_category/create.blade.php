@extends('layouts.app')
@section('title', 'New Event Category')
@section('content')

<div class="page-header">
    <div class="page-header-title">
        <h4>New Category</h4>
    </div>
    <div class="page-header-breadcrumb">
        <ul class="breadcrumb breadcrumb-title">
            <li class="breadcrumb-item">
                <a href="#!">
                    <i class="icofont icofont-home"></i>
                </a>
            </li>
            <li class="breadcrumb-item"><a href="{{route('event_cat.index')}}">Event Category</a>
            <li class="breadcrumb-item"><a href="#!">New Event Category</a>
            </li>
        </ul>
    </div>
</div>

<div class="page-body">

    {{-- Table info section --}}

    <div class="card">
        <div class="card-header">
            <h5>New Event Category</h5>
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

            <form id="form" method="POST" action="{{route('event_cat.save')}}">
                <input name="_method" type="hidden" value="POST"> {{csrf_field()}}
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Category Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control form-control-round" placeholder="Event category name" name="category_name">
                    </div>
                </div>
                <div class="row pull-right" style="margin:auto;">
                    <button class="btn btn-success"><i class="icofont icofont-save"></i>  Save</button>
                </div>
            </form>

        </div>
    </div>

</div>

@endsection