@extends('layouts.app')
@section('title', 'User profile')
@section('content')

<div class="page-header">

    <div class="page-header-title">
        <h4>User Profile</h4>
    </div>

    <div class="page-header-breadcrumb">

        <ul class="breadcrumb-title">
            <li class="breadcrumb-item">
                <a href="#!">
                    <i class="icofont icofont-home"></i>
                </a>
            </li>

            <li class="breadcrumb-item"><a href="#!">User Profile</a></li>
        </ul>

    </div>

</div>

<div class="page-body">
    
    <div class="card">
        <div class="card-header">
            <h4>Profile Info</h4>
        </div>
        <br>
        <div class="card-block table-border-style">

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Label</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Username</td>
                            <td>{{Auth::user()->name}}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>{{Auth::user()->email}}</td>
                        </tr>
                        <tr>
                            <td>Roles</td>
                            <td>{{Auth::user()->roles_name->roles_name}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <br>
            
        </div>
    </div>
</div>

@endsection