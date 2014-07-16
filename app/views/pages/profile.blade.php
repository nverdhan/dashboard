@extends('layouts.default')
@section('page-heading')
    Profile
@stop
@section('page-logo')
    "ec-user"
@stop
@section('content')
<div class="outlet">

	<!-- Start .outlet -->
	<!-- Page start here ( usual with .row ) -->
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<!-- col-lg-4 start here -->
			<div class="panel panel-default plain profile-widget">
				<!-- Start .panel -->
				<div class="panel-heading white-bg pl0 pr0">
					<img class="profile-image img-responsive" src="assets/img/profile-cover.jpg" alt="profile cover">
				</div>
				<div class="panel-body">
                    <div class="col-lg-4 col-xs-4 col-md-4 col-sm-12">
                        <div class="profile-avatar">
    					   <img class="img-responsive" src="assets/img/avatars/male.jpg" alt="">
    					</div>
    				</div>
    				<div class="col-lg-8 col-xs-8 col-md-8 col-sm-12">
    					<div class="profile-name page-header">
                            {{$student['studentname']}}
    					</div>
                        <div class="profile-quote">
                            <div class="well well-sm">
                                <h5><i class="en-users"></i>
                                {{$student['batchname']}} Batch</h5><br>
                                <address>
                                    <strong>{{$student['institutename']}}</strong> <br>
                                    {{$student['instituteaddress']}}
                                </address>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer white-bg">
                        <ul class="profile-info">
                            <li><i class="ec-mobile"></i> {{$student['contactdetails']}}</li>
                            <li><i class="ec-location"></i> {{$student['address']}}</li>
                            <li><i class="ec-location"></i> {{$student['city']}}</li>
                            <li><i class="ec-mail"></i> {{$student['parentemail']}}</li>
                        </ul>
                    </div>
                </div>
                <!-- End .panel -->
                            </div>
                        <!-- col-lg-4 end here -->
                    </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        	<!-- col-lg-4 start here -->
                        	
                             <div class="panel panel-default plain">
                        	 	<!-- Start .panel -->
                        	 	<div class="panel-heading white-bg">
                        	 		<h4 class="panel-title"><i class="br-alarm"></i> Notifications </h4>
                        	 	</div>
                                
                            
                        	 	<div class="panel-body">
                                    <p> Coming Soon </p>
                            <script>
                        	// 		<form class="form-vertical hover-stripped" role="form">
                        	// 			<div class="form-group">
                        	// 				<label class="control-label">Username</label>
                        	// 				<input type="text" class="form-control" value="" disabled>
                        	// 				<!--<a href="#" class="help-block color-red">Request new ?</a>--> 
                        	// 			</div>
                        	// 			<div class="form-group">
                        	// 				<label class="control-label">Full name</label>
                        	// 				<input type="text" class="form-control" value="" disabled>
                        	// 			</div>
                        	// 			<div class="form-group">
                        	// 				<label class="control-label">Email</label>
                        	// 				<input type="email" class="form-control" value="">
                        	// 			</div>
                        	// 			<div class="form-group">
                        	// 				<label class="control-label">New password</label>
                        	// 				<input type="password" class="form-control">
                        	// 			</div>
                        	// 			<div class="form-group">
                        	// 				<label class="control-label">Repeat password</label>
                        	// 				<input type="password" class="form-control">
                        	// 			</div>
                        	// 			<div class="form-group">
                        	// 				<label class="control-label">More info</label>
                        	// 				<textarea class="form-control" rows="3"></textarea>
                        	// 			</div>
                        	// 			<!-- End .form-group  -->
                        	// 			<div class="form-group mb15">
                        	// 				<button class="btn btn-primary">Change</button>
                        	// 			</div>
                        	// 			<!-- End .form-group  -->
                        	// 		</form>
                        	// 	</div>
                            </script>
                        	 </div>
                            
                        	<!-- End .panel -->
                        </div>
                        <!-- col-lg-4 end here -->
                    </div>
                    <!-- Page End here -->
                </div>
                <!-- End .outlet -->
            </div>
            <!-- End .content-wrapper -->
            <div class="clearfix"></div>
        </div>
        <!-- End #content -->

        <!-- {{HTML::script('assets/js/profileapp.js')}} -->
        
        @stop

