<!-- app/views/login.blade.php -->

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Login | EdRoot Analytics</title>
    <!-- Mobile specific metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- Force IE9 to render in normal mode -->
    <!--[if IE]><meta http-equiv="x-ua-compatible" content="IE=9" /><![endif]-->
    <meta name="author" content="Edroot Analytics" />
    <meta name="description" content="Edroot - Bringing analytics to education"
    />
    <meta name="keywords" content="Edroot, Analytics, education, portal, student, IIT JEE"
    />
    <meta name="application-name" content="Edroot Portal" />
    <!-- Import google fonts - Heading first/ text second -->
    <link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Open+Sans:400,700|Droid+Sans:400,700' />
        <!--[if lt IE 9]>
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400" rel="stylesheet" type="text/css" />
<link href="http://fonts.googleapis.com/css?family=Open+Sans:700" rel="stylesheet" type="text/css" />
<link href="http://fonts.googleapis.com/css?family=Droid+Sans:400" rel="stylesheet" type="text/css" />
<link href="http://fonts.googleapis.com/css?family=Droid+Sans:700" rel="stylesheet" type="text/css" />
<![endif]-->
<!-- Css files -->
<!-- Icons -->
{{ HTML::style('assets/css/icons.css')}}
{{ HTML::style('assets/css/bootstrap.css'); }}
{{ HTML::style('assets/css/main.css'); }}
<link rel="icon" href="assets/img/ico/favicon.ico" type="image/png">
<!-- Windows8 touch icon ( http://www.buildmypinnedsite.com/ )-->
<meta name="msapplication-TileColor" content="#3399cc" />
</head>
<body class="login-page">
    <!-- Start #login -->
    <div id="login" class="animated bounceIn">
        <img id="logo" src="assets/img/logo.png" style="width:50%;" alt="EdRoot Logo">
        <!-- Start .login-wrapper -->
        <div class="login-wrapper">
            <ul id="myTab" class="nav nav-tabs nav-justified bn">
                <li>
                    <a href data-toggle="tab">Login</a>
                </li>
            </ul>

            <div id="myTabContent" class="tab-content bn">
                <div class="tab-pane fade in active" id="log-in">
                   {{ Form::open(array('route' => 'login.store', 'class'=> 'form-horizontal mt10')) }}
                   <div class="form-group">
                    <div class="col-lg-12">
                        {{ Form::text('username', Input::old('username'), array('placeholder' => 'Your username','value'=>'admin', 'class'=> 'form-control left-icon')) }}
                        <i class="ec-user s16 left-input-icon"></i>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-12">
                        {{ Form::password('password', array('placeholder'=>'Your password','value'=>'awesome','class'=>'form-control left-icon')) }}
                        <i class="ec-locked s16 left-input-icon"></i>
                        <span class="help-block"><a href="#"><small>Forgot password ?</small></a></span> 
                    </div>
                    <div class="col-lg-12">
                        {{ $errors->first('email') }}
                        {{ $errors->first('password') }}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-6">
                        <!-- col-lg-12 start here -->
                        {{ Form::submit('Login',array('class'=>'btn btn-success btn-block pull-right')) }}
                    </div>
                    <!-- col-lg-12 end here -->
                </div>
                {{ Form::close() }}
                <!--</form>-->
            </div>
        </div>
    </div>
    <!-- End #.login-wrapper -->
</div>
<!-- End #login -->
<!-- Javascripts -->
{{ HTML::script('assets/js/bootstrap/bootstrap.min.js'); }}
</body>
</html>

