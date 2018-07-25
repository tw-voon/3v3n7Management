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



<?php // echo "<pre>"; ?>

	<?php // print_r($events_data[0]->media); ?>

<?php // echo "</pre>"; ?>



<div class="page-body">

	<div class="card">

		<div class="row" style="padding:10px;">

			<div class="col-12 col-md-7 col-xl-7">

				

				<div id="carouselExampleControls" class="carousel slide" data-ride="carousel" data-interval="false" style="padding: 15px; border: 1px #eee solid; border-radius: 10px;">



					<ol class="carousel-indicators">

						<?php $count = 0; ?>

						@foreach($events_data[0]->media as $media)

					    	<li data-target="#carouselExampleControls" style="height: 3px; margin:2px;" data-slide-to="<?php echo $count; ?>" class="<?php echo $count == 1 ? 'active' : ''; ?>"></li>

					    	<?php $count ++ ; ?>

				  		@endforeach

					</ol>

			

				  	<div class="carousel-inner">

				  		<?php $count = 1; ?>

				  		@foreach($events_data[0]->media as $media)

				    	<div class="item <?php echo $count == 1 ? 'active' : '' ?>">

				      		<img class="d-block" style="width: 100%; max-height: 400px; object-fit: cover; margin: auto;" src="{{ asset('images/' . $media->link) }}" alt="First slide">

				    	</div>

				    	<?php $count ++; ?>

				  		@endforeach

				  	</div>

				  	<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">

				    	<span class="carousel-control-prev-icon" aria-hidden="true"></span>

				    	<span class="sr-only">Previous</span>

				  	</a>

				  	<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">

				    	<span class="carousel-control-next-icon" aria-hidden="true"></span>

				    	<span class="sr-only">Next</span>

				  	</a>



				</div>



			</div>

			<div class="col-12 col-md-5 col-xl-5">



				<div class="form-input">

					<h2 class="title text-info">

						{{$events_data[0]->title}}

					</h2>

				</div>



				<br>



				<table class="table m-0">

                    <tbody>

                        <tr>

                            <th style="width: 22%;"><span><i class="icofont icofont-calendar"></i></span> Start Time  </th>

                            <td>{{$events_data[0]->start_time}}</td>

                        </tr>

                        <tr>

                            <th style="width: 22%;"><span><i class="icofont icofont-calendar"></i></span> End Time </th>

                            <td>{{$events_data[0]->end_time}}</td>

                        </tr>

                        <tr>

                            <th style="width: 22%;"><span><i class="icofont icofont-location-pin"></i></span> Location </th>

                            <td>{{$events_data[0]->locations->name}}</td>

                        </tr>

                        <tr data-toggle="modal" data-target="#myModalmap">

                            <th style="width: 22%;"></th>

                            <td style="width: 78%">

                            	<p style="word-wrap: break-word; width: 100%;white-space: normal;">

                            		{{$events_data[0]->locations->address}}</p>

                            </td>

                        </tr>

                        <tr data-toggle="modal" data-target="#attendModal">

                            <th style="width: 22%;"><span><i class="icofont icofont-users-alt-1"></i></span> User attend </th>

                            <td>{{count($user_join)}}</td>

                        </tr>

                        <tr>

                            <th style="width: 22%;"><span><i class="icofont icofont-like"></i></span> User like </th>

                            <td>{{$events_data[0]->support}}</td>

                        </tr>

                        <tr>

                            <th style="width: 22%;"><span><i class="icofont icofont-book-mark"></i></span> User bookmark </th>

                            <td>{{$events_data[0]->support}}</td>

                        </tr>

                        <tr>

                            <th style="width: 22%;"><span><i class="icofont icofont-businessman"></i></span> Event officer </th>

                            <td style="word-wrap: break-word; width: 100%;white-space: normal;">

                            	@if($events_data[0]->officer == null)

                            		No officer assign yet

                            	@else

                            		{{$events_data[0]->officer->user->name}}

                            	@endif

                            </td>

                        </tr>

                    </tbody>

                </table>

				

			</div>

		</div>



	</div>



	<div class="row">

		<div class="col-lg-6 col-md-6 col-12">

			<div class="card">



			  	<div class="card-header">

                    <h5 class="card-header-text">Event Details</h5>

                </div>



	  			<div class="card-block user-desc">

                    <div class="view-desc">

                        <p>{{$events_data[0]->description}}</p>

                    </div>

                </div>



			</div>



	  		<div class="card hidden">



	  			<div class="card-header">

                    <h5 class="card-header-text">Event VIP</h5>

                </div>



	  			<div class="card-block user-desc">

                    <div class="view-desc">

                        @foreach($special_user as $user)

                       <div class="media mt-2 ml-2">

                            <div class="media-left">

                                <a href="#">

                                    <img class="media-object img-circle comment-img" src="{{ asset('images/avatar-2.png') }}" alt="Generic placeholder image">

                                </a>

                            </div>

                            <div class="media-body ml-2">

                                <h6 class="media-heading">{{$user->user->name}}<span class="f-12 text-muted m-l-5"></span></h6>

                                <hr>

                            </div>

                        </div>

                        @endforeach

                    </div>

                </div>



	  		</div>



		</div>



		<div class="col-lg-6 col-md-6 col-12">



			<div class="card">



			  	<div class="card-header">

                    <h5 class="card-header-text">Event Feedback</h5>

                </div>



	  			<div class="card-block user-desc">

                    <div class="view-desc" style="max-height: 500px; overflow: auto;">

                    	@if(count($feedbacks) > 0)

                    	@foreach($feedbacks as $feedback)

                        <div class="media mt-2 ml-2">

	                        <div class="media-left">

	                            <a href="#">

	                                <img class="media-object img-circle comment-img" src="{{ asset('images/avatar-2.png') }}" alt="Generic placeholder image">

	                            </a>

	                        </div>

	                        <div class="media-body ml-2">

	                            <h6 class="media-heading">{{$feedback->user->name}}<span class="f-12 text-muted m-l-5">{{$feedback->created_at}}</span></h6>

	                            <div class="stars-example-css review-star">

	                            	<?php for ($i=1; $i < 6 ; $i++) { ?>

	                            		@if($i < (int)$feedback->rating)

	                            			<i class="icofont icofont-star" style="color:#1abc9c;"></i>

	                            		@else

	                            			<i class="icofont icofont-star" style="color:#ccc;"></i>

	                            		@endif

	                            	<?php } ?>

	                            </div>

	                            <p class="m-b-0">{{$feedback->message}}</p>

	                            <hr>

	                        </div>

	                    </div>

                        @endforeach

                        @else



                        <div class="text-center">

                        	<h3> No Feedback yet</h3>

                        </div>

                        

                        @endif

                    </div>

                </div>



			</div>



		</div>

	</div>



</div>





<script type="text/javascript" src="{{ asset('plugins/jquery/dist/jquery.min.js') }}"></script>

<div id="attendModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-full" role="document">
        <div class="modal-content">
            <div class="modal-header"><h4>User who joined this event</h4></div>
            <div class="modal-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                        </tr>        
                    </thead>
                    <tbody>
                        <?php $count = 1; ?>
                        @foreach($user_join as $joined)
                        <tr>
                            <td>{{$count}}</td>
                            <td>{{$joined->user->name}}</td>
                            <td>{{$joined->user->email}}</td>
                        </tr>
                        <?php $count ++; ?>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

  <div id="myModalmap" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog" style="width: 50vw; max-width: 50vw;">



    <!-- Modal content-->

    <div class="modal-content" style="width: 50vw; margin: auto;">

      <div class="modal-header" style="width: 50vw; margin: auto;">

        <h4 class="modal-title">{{$events_data[0]->locations->name}}</h4>

      </div>

      <div class="modal-body">

        <div id="map" style="height: 500px;"></div>

      </div>

      <div class="modal-footer">

        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

      </div>

    </div>



  </div>



  <script>

    function initMap() {

      var uluru = {lat: <?php echo $events_data[0]->locations->lat ?>, lng: <?php echo $events_data[0]->locations->lon ?>};

      var map = new google.maps.Map(document.getElementById('map'), {

        zoom: 15,

        center: uluru,

        zoomControl: false,

      });

      var marker = new google.maps.Marker({

        position: uluru,

        map: map

      });

    
    }

    </script>

</div>


  <script async defer

    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBEw4F7C21g9g3i7JnsNIemUxLUH2NpVDk&callback=initMap">

  </script>


<script type="text/javascript">

	$(document).ready(function(){

		// $('#mytab a').on('click',function(e){

		// 	e.preventDefault()

		// 	$(this).parent().parent().children('li').removeClass('active');

  // 			$(this).tab('show');

		// });

    // $("#myModalmap").on("shown.bs.modal", function () {

    //   initMap();

    // });

    $("#myModalmap").on("shown.bs.modal", function (e) {

      initMap();
      e.preventDefault();
      // $('body').addClass('modal-open');
      // $("#myModalmap").css('display','block');

    });

    // $("#myModalmap").on("hidden.bs.modal", function () {

    //   $("#myModalmap").hide();

    // });

	});

</script>





@endsection