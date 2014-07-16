<!doctype html>
<html>
<head>
	@include('includes.head')
</head>
<body>
	<div id="header">
		@include('includes.header')
	</div>

	<div id="sidebar">
		@include('includes.sidebar')
	</div>
	<div id="content" class="row">
		<div class="content-wrapper">
			<div class="row">
				<!-- Start .row -->
				<!-- Start .page-header -->
				<div class="col-lg-12 heading">
					<h1 class="page-header"><i class=@section('page-logo') @show></i> @section('page-heading') @show</h1>
					<!-- Start .bredcrumb -->
					<ul id="crumb" class="breadcrumb">
					</ul>
					<!-- End .breadcrumb -->
					<!-- Start .option-buttons -->
					<div class="option-buttons">
						<div class="btn-toolbar" role="toolbar">
							<div class="btn-group">
								<a id="clear-localstorage" class="btn tip" title="Reset panels position">
									<i class="ec-refresh color-red s24"></i>
								</a>
							</div>
						</div>
					</div>
					<!-- End .option-buttons -->
				</div>
				<!-- End .page-header -->
			</div>
			<ul>
			</div>
			@yield('content')
		</div>
		@include('includes.footer')
	</body>
	</html>