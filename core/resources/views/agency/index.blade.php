@extends('layouts.app')
@section('title', 'Agency')
@section('content')

<div class="page-header">
    <div class="page-header-title">
        <h4>Events</h4>
    </div>
    <div class="page-header-breadcrumb">
        <ul class="breadcrumb-title">
            <li class="breadcrumb-item">
                <a href="#!">
                    <i class="icofont icofont-home"></i>
                </a>
            </li>
            <li class="breadcrumb-item"><a href="#!">Events</a>
            </li>
        </ul>
    </div>
</div>

<div class="page-body">

    <?php $start_count =  ($agencies->perpage() * $agencies->currentPage()) - $agencies->perpage() + 1; ?>

    {{-- Table info section --}}

    <div class="card">
        <div class="card-header">
            <h5>Events List</h5>
            <span>Total of <code> Number of Events </code> inside table </span>
            <div class="card-header-right">
                <i class="icofont icofont-rounded-down"></i>
                <i class="icofont icofont-refresh"></i>
                <a href="{{route('agency.create')}}"><i class="icofont icofont-ui-add"></i></a>
            </div>
        </div>
        <div class="card-block table-border-style">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Event Category</th>
                            <th>Created at</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($agencies as $agency)
                            <tr>
                                <th scope="row">{{$start_count}}</th>
                                <th>{{$agency->name}}</th>
                                <th>{{$agency->created_at}}</th>
                                <th>
                                    <a class="btn btn-success btn-icon" href="{{route('agency.edit', $agency->id)}}"><i class="icofont icofont-edit"></i></a>
                                </th>
                            </tr>
                            <?php $start_count ++; ?>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        @if(count($agencies) != 0)
            {!! $agencies->appends(request()->input())->links('pagination') !!}
        @endif

    </div>

</div>

@endsection