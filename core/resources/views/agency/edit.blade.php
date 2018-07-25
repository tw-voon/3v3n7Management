@extends('layouts.app')
@section('title', 'New Agency')
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
            <li class="breadcrumb-item"><a href="{{route('agency.index')}}">Events</a>
            <li class="breadcrumb-item"><a href="#!">{{$agency->name}}</a>
            </li>
        </ul>
    </div>
</div>

<div class="page-body">

    {{-- Table info section --}}

    <div class="card">
        <div class="card-header">
            <h5>{{$agency->name}}</h5>
        </div>
        <div class="card-block">

            <div class="row">
                <div class="col-md-10"><h4 class="sub-title">Agency Information</h4></div>
                <div class="col-md-2">
                    <div class="pull-right">
                        <span><i class="icofont icofont-edit"></i></span>
                        <a class="btn btn-link" id="edit_info" href="javascript:void(0)">Edit</a>
                    </div>
                </div>
            </div>

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
            
            <div class="edit_container hidden">

                <form id="form" method="POST" action="{{route('agency.update', $agency->id)}}">
                    <input name="_method" type="hidden" value="POST"> {{csrf_field()}}
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Agency Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control form-control-round" placeholder="Agency name" name="name" value="{{$agency->name}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-10">
                            <textarea style="border-radius: 20px;" rows="10" placeholder="Agency brief description" name="description" class="form-control form-control-round">{{$agency->description}}</textarea>
                        </div>
                    </div>
                    <div class="row pull-right" style="margin:auto;">
                        <button class="btn btn-success"><i class="icofont icofont-save"></i>  Update</button>
                    </div>
                </form>
                
            </div>

            <div class="display_container">

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Agency Name</label>
                    <div class="col-sm-10">
                        {{$agency->name}}
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-10">
                        {{$agency->description}}
                    </div>
                </div>
                
            </div>
            

        </div>
    </div>

    <div class="row">

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Agency User</h5>
                    <div class="pull-right">
                        <a class="btn btn-icon btn-success btn-new-user" href="{{route('agency_user.create',['agency_id' => $agency->id])}}"><i class="icofont icofont-ui-add"></i></a>
                    </div>
                </div>
                <div class="card-block">
                    @foreach($agency_user as $user)
                    <div class="media mt-2 ml-2">
                            <div class="media-left">
                                <a href="#">
                                    <img class="media-object img-circle comment-img" src="{{ asset('images/avatar-2.png') }}" alt="Generic placeholder image">
                                </a>
                            </div>
                            <div class="media-body ml-2">
                                <h6 class="media-heading">{{$user->user->name}}<span class="f-12 text-muted m-l-5"></span></h6>
                                <span><a href="{{route('agency_user.edit',$user->user->id)}}" class="m-r-10 f-12"><i class="icofont icofont-edit"></i> Edit</a></span>
                                <hr>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <h5 style="padding: 15px;">Agency Event</h5>
                <div class="card-block">
                    <table class="table m-0">
                        <tbody>
                            <tr>
                                <th style="width: 22%;">Total Event: </th>
                                <td>{{$event_helded}}</td>
                            </tr>
                            <tr>
                                <th style="width: 22%;">Ongoing Event: </th>
                                <td>{{$ongoing}}</td>
                            </tr>
                            <tr>
                                <th style="width: 22%;">Completed Event: </th>
                                <td>{{$completed}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <div id="myModal" class="modal fade">
        <div class="modal-dialog" style="width: 50vw; max-width: 50vw; height: 100%;">

            <!-- Modal content-->
            <div class="modal-content" style="width: 50vw; margin: auto;">
                <div class="modal-header" style="width: 50vw; margin: auto;">
                    <h4 class="modal-title">Add New Officer</h4>
                    <p class="text-small">Please input user email</p>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-3 col-md-3">
                            <label>Email </label>
                        </div>
                        <div class="col-9 col-md-9">
                            <input type="text" name="email" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script type="text/javascript" src="{{ asset('js/jquery-2.1.4.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function(){

        $('#edit_info').on('click', function(){

            if($('.edit_container').hasClass('hidden')){

                $('#edit_info').text("Close");
                $('.edit_container').removeClass('hidden');
                $('.display_container').addClass('hidden');

            } else {
                $('#edit_info').text("Edit");
                $('.display_container').removeClass('hidden');
                $('.edit_container').addClass('hidden');

            }

        });

    });
</script>

@endsection