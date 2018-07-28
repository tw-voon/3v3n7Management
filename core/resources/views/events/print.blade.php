<!DOCTYPE html>
<html>
<head>
	<title>{{$event->title}}</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('node_modules/bootstrap/dist/css/bootstrap.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('icon/icofont/css/icofont.css') }}">
</head>
<body>

	<div class="container-fluid">
		<div class="row" style="margin-top: 50px;">
			<div class="col-2 border-right">
				<h6>Event Name: </h6>
			</div>
			<div class="col-10">
				<h6>{{$event->title}}</h6>
			</div>
			<br />
			<div class="col-2 border-right">
				<h6>Event Time: </h6>
			</div>
			<div class="col-10">
				<h6>{{$event->start_time . ' - ' . $event->end_time}}</h6>
			</div>
		</div>
		<br />
		<div class="row form-group">
			<div class="col-12">
				<hr />
				<label>Participant Name List: </label>
			</div>
		</div>

		<div class="row">
			<div class="col-12">
				<table class="table table-hover table-bordered">
					 <thead>
		                <tr>
		                    <th class="text-center" style="width: 5%;">No</th>
		                    <th style="width: 40%;">Name</th>
		                    <th style="width: 35%;">Email</th>
		                    <th style="width: 20%;" class="text-center">Required Transport</th>
		                </tr>        
		            </thead>
					<tbody>
						<?php $count = 1; ?>
		                @foreach($user_join as $joined)
		                <tr>
		                    <td class="text-center">{{$count}}</td>
		                    <td>{{$joined->user->name}}</td>
		                    <td>{{$joined->user->email}}</td>
		                    <td class="text-center">
		                        @if($joined->required_transport)
		                            Yes
		                        @else
		                            No
		                        @endif
		                    </td>
		                </tr>
		                <?php $count ++; ?>
		                @endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>

<script type="text/javascript" src="{{ asset('js/jquery-2.1.4.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/jquery/dist/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/tether/dist/js/tether.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/bootstrap/dist/js/bootstrap.min.js') }}"></script>

<script type="text/javascript">
	$(document).ready(function(){
		window.print();
	})
</script>
</body>
</html>