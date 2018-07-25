@extends('layouts.app')
@section('title', 'Event\'s Category')
@section('content')

<div class="page-header">
    <div class="page-header-title">
        <h4>Events Category</h4>
    </div>
    <div class="page-header-breadcrumb">
        <ul class="breadcrumb-title">
            <li class="breadcrumb-item">
                <a href="#!">
                    <i class="icofont icofont-home"></i>
                </a>
            </li>
            <li class="breadcrumb-item"><a href="#!">Events Category</a>
            </li>
        </ul>
    </div>
</div>

<div class="page-body">

    <?php $start_count =  ($categories->perpage() * $categories->currentPage()) - $categories->perpage() + 1; ?>

	{{-- Table info section --}}

	<div class="card">
        <div class="card-header">
            <h5>Events Category</h5>
            @if(Auth::user()->roles_id == 1)
            <div class="card-header-right">
                <i class="icofont icofont-rounded-down"></i>
                <i class="icofont icofont-refresh"></i>
                <a href="{{route('event_cat.create')}}"><i class="icofont icofont-ui-add"></i></a>
            </div>
            @endif
        </div>
        <div class="card-block table-border-style">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Event Category</th>
                            <th>Created at</th>
                            @if(Auth::user()->roles_id == 1)
                            <th>Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <th scope="row">{{$start_count}}</th>
                                <th>{{$category->category_name}}</th>
                                <th>{{$category->created_at}}</th>
                                @if(Auth::user()->roles_id == 1)
                                <th>
                                    <a class="btn btn-success btn-icon" href="{{route('event_cat.edit',$category->id)}}"><i class="icofont icofont-edit"></i></a>
                                </th>
                                @endif
                            </tr>
                            <?php $start_count ++; ?>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        @if(count($categories) != 0)
            {!! $categories->appends(request()->input())->links('pagination') !!}
        @endif

    </div>

</div>
@endsection