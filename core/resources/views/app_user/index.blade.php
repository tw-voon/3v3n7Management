@extends('layouts.app')

@section('title', 'Application User')

@section('content')



<div class="page-header">

    <div class="page-header-title">

        <h4>Application User</h4>

    </div>

    <div class="page-header-breadcrumb">

        <ul class="breadcrumb-title">

            <li class="breadcrumb-item">

                <a href="#!">

                    <i class="icofont icofont-home"></i>

                </a>

            </li>

            <li class="breadcrumb-item"><a href="#!">Application User</a>

            </li>

        </ul>

    </div>

</div>



<div class="page-body">



    <?php $start_count =  ($appsuser->perpage() * $appsuser->currentPage()) - $appsuser->perpage() + 1; ?>



	{{-- Table info section --}}



	<div class="card">

        <div class="card-header">

            <h5>User List</h5>

            <span>Total of <code> Number of Events </code> inside table </span>

            <div class="card-header-right">

                <i class="icofont icofont-rounded-down"></i>

                <i class="icofont icofont-refresh"></i>

                @if(Auth::user()->roles_id == 1)
                <a href="{{route('app_user.create')}}"><i class="icofont icofont-ui-add"></i></a>
                @endif
            </div>

        </div>

        <div class="card-block table-border-style">

            <div class="table-responsive">

                <table class="table table-hover">

                    <thead>

                        <tr>

                            <th>#</th>

                            <th>Username</th>

                            <th>Email</th>

                            <th>Roles</th>

                            <th>Register Time</th>

                            <th>Action</th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($appsuser as $user)

                            <tr>

                                <th scope="row">{{$start_count}}</th>

                                <th>{{$user->name}}</th>

                                <th>{{$user->email}}</th>

                                <th>{{$user->roles_name->roles_name}}</th>

                                <th>{{$user->created_at}}</th>

                                <th>

                                    <a class="btn btn-success btn-icon" href="{{route('app_user.edit',$user->id)}}"><i class="icofont icofont-edit"></i></a>

                                </th>

                            </tr>

                            <?php $start_count ++; ?>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>



        @if(count($appsuser) != 0)

            {!! $appsuser->appends(request()->input())->links('pagination') !!}

        @endif



    </div>



</div>

@endsection