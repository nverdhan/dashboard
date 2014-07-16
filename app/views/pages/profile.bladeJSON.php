@extends('layouts.default')
@section('content')
{{HTML::script('assets/js/angular.min.js')}}
<script>
angular.module('profileapp', [],function($interpolateProvider) {
        $interpolateProvider.startSymbol('[[');
        $interpolateProvider.endSymbol(']]');
    })
  .controller('StudentController', ['$scope', function($scope) {
    $scope.student = {{$profiledata or undefined}};
  }]);
</script>
<div class="outlet" ng-app="profileapp">

	<!-- Start .outlet -->
	<!-- Page start here ( usual with .row ) -->
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"  ng-controller="StudentController">
			<!-- col-lg-4 start here -->
			<div class="panel panel-default plain profile-widget">
				<!-- Start .panel -->
				<div class="panel-heading white-bg pl0 pr0">
					<img class="profile-image img-responsive" src="assets/img/profile-cover.jpg" alt="profile cover">
				</div>
				<div class="panel-body">
					<div class="col-lg-4 col-md-4 col-sm-12">
						<div class="profile-avatar">
							<img class="img-responsive" src="assets/img/avatars/male.jpg" alt="">
						</div>
					</div>
					<div class="col-lg-8 col-md-8 col-sm-12">
						<div class="profile-name">
                            [[student.studentname]]
						</div>
                                        <div class="profile-quote">
                                            <p>[[student.batchname]] <br>
                                               [[student.institutename]] <br>
                                               [[student.instituteaddress]]
                                            </p>
                                        </div>
                                        <!-- <div class="profile-stats-info">
                                            <a href="#" class="tipB" title="Views"><i class="im-eye2"></i> <strong>5600</strong></a>
                                            <a href="#" class="tipB" title="Comments"><i class="im-bubble"></i> <strong>75</strong></a>
                                            <a href="#" class="tipB" title="Likes"><i class="im-heart"></i> <strong>45</strong></a>
                                        </div> -->
                                    </div>
                                </div>
                                <div class="panel-footer white-bg">
                                	<ul class="profile-info">
                                		<li><i class="ec-mobile"></i> </li>
                                		<li><i class="ec-location"></i> </li>
                                		<li><i class="ec-location"></i> </li>
                                		<li><i class="ec-mail"></i> </li>
                                	</ul>
                                </div>
                            </div>
                            <!-- End .panel -->
                        </div>
                        <!-- col-lg-4 end here -->
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

