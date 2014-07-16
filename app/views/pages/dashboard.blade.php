@extends('layouts.default')
@section('page-heading')
Dashboard
@stop
@section('page-logo')
"im-screen"
@stop
@section('content')

@include('pages.elements.carousel')
{{HTML::script('assets/js/dashboardApp.js')}}
<div class="row" ng-app = 'dashboardApp'>
	<!-- Start .row -->
	<div class="col-lg-12 col-md-12 sortable-layout">
		<!-- Start col-lg-6 -->
		<div class="panel panel-brown toggle panelMove panelClose panelRefresh">
			<!-- Start .panel -->
			<div class="panel-heading">
				<h4 class="panel-title"><i class="im-bars"></i> Percentile Plot</h4>
			</div>
			<div class="panel-body brown-bg">
				<div id="percentile-plot" style="width: 100%; height:250px;"></div>
			</div>
		</div>
		<script type="text/javascript">percentileplot = {{$percentileplot or undefined}}</script>
		<!-- {{print_r($studentstats)}} -->
	</div>
    <!-- Donut Chart -->
    <div class="col-lg-6 col-md-6 sortable-layout" ng-controller = 'AccuracyController as accuracy'>
        <!-- Start col-lg-6 -->
        <div class="panel panel-default toggle panelMove panelClose panelRefresh">
            <!-- Start .panel -->
            <div class="panel-heading">
                <h4 class="panel-title"><i class="im-pie"></i>Accuracy Stats</h4>
            </div>
            <div class="panel-body" ng-controller = 'SubjectButtonController as Button'>
                <!-- [[accuracy.AccuracyStats.Overall]] <br> -->

                <div class = "btn-group">
                    <button class = "btn btn-default dropdown-toggle" data-toggle = "dropdown" type = "button">
                        [[accuracy.Subjects[Button.selection].long]]
                        <span class = "caret"></span>
                    </button>
                    <ul class = "dropdown-menu" role="menu">
                        <li ng-repeat='subject in accuracy.Subjects'>
                            <a href ng-click = "Button.setSelection(subject.num, subject.short)"> [[subject.long]] </a>
                        </li>
                    </ul>
                </div>
                <div id="donut-chart-[[accuracy.Subjects[0].short]]" style="width: 100%; height:250px;" ng-show='Button.isSelected([[accuracy.Subjects[0].num]])'></div>
                <div id="donut-chart-[[accuracy.Subjects[1].short]]" style="width: 100%; height:250px;" ng-show='Button.isSelected([[accuracy.Subjects[1].num]])'></div>
                <div id="donut-chart-[[accuracy.Subjects[2].short]]" style="width: 100%; height:250px;" ng-show='Button.isSelected([[accuracy.Subjects[2].num]])'></div>
                <div id="donut-chart-[[accuracy.Subjects[3].short]]" style="width: 100%; height:250px;" ng-show='Button.isSelected([[accuracy.Subjects[3].num]])'></div>
            </li>
            </div>
        </div>
        <!-- End .panel -->
    </div>
</div>




@stop
