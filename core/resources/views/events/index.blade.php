@extends('layouts.app')

@section('title', 'Events')

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



<?php $start_count =  ($events->perpage() * $events->currentPage()) - $events->perpage() + 1; ?>



<div class="page-body">



	{{-- Table info section --}}



	<div class="card">

        <div class="card-header">

            <h5>Events List</h5>

            <span>Total of <code> Number of Events </code> inside table </span>

            <div class="card-header-right">

                <i class="icofont icofont-rounded-down"></i>

                <i class="icofont icofont-refresh"></i>

                {{-- <i class="icofont icofont-close-circled"></i> --}}

            </div>

        </div>

        <div class="card-block table-border-style">

            <div class="table-responsive">

                <table class="table table-hover">

                    <thead>

                        <tr>

                            <th>#</th>

                            <th>Event Name</th>

                            <th>Agency Name</th>

                            <th>Event Category</th>

                            <th>Event Status</th>

                            <th class="text-center">Action</th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($events as $event)

                        <tr>

                            <th scope="row">{{$start_count}}</th>

                            <td>{{$event->title}}</td>

                            <td>{{$event->user->name}}</td>

                            <td>{{$event->category->category_name}}</td>

                            <td>{{$event->status_id == '1' ? 'Ongoing' : 'Completed'}}</td>

                            <td class="text-center">

                                <a class="btn btn-success btn-icon" href="{{route('event.view', $event->id)}}"><i class="icofont icofont-eye-alt"></i></a>
                                <a class="btn btn-danger btn-icon btn-remove" href="#" data-value="{{$event->id}}"><i class="icofont icofont-ui-delete"></i></a>

                            </td>

                        </tr>

                        <?php $start_count ++; ?>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

        @if(count($events) != 0)

            {!! $events->appends(request()->input())->links('pagination') !!}

        @endif

    </div>



</div>

<script type="text/javascript">
    $(document).ready(function(){

        $('.btn-remove').on('click', function(){
            var event_id = $(this).attr('data-value');

            swal({
              title: "Are you sure ?",
              text: "Are you sure want to delete this event ? Once deleted, this action cannot be undone!",
              type: "warning",
              showCancelButton: true,
              closeOnConfirm: false,
              showLoaderOnConfirm: true,
              confirmButtonColor: '#8CD4F5',
              confirmButtonText: "Confirm remove",
              cancelButtonText: "Cancel"
            }, function (confirm) {

                console.log(confirm);

                if(confirm){

                    $.ajax({
                        url: "events/remove",
                        type: "post",
                        data: { _token : '<?php echo csrf_token(); ?>', event_id: event_id},
                        dataType: 'html',
                        success: function(json){

                            console.log(json);
                            swal("Success", "Successfully delete this events", "success");
                            setTimeout(function () {
                                location.reload();
                            }, 1000);

                        },
                        error: function(json){

                            console.log(json);
                            swal("Error", "Error encounter while delete this event", "error");

                        }
                    })

                }
              
            });

        });
    });
</script>

@endsection