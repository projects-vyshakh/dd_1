<!DOCTYPE html>
<html lang="en">
<head>
@section ('head')
<meta charset="utf-8" />
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1" /><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!-- end: META -->  <!-- STYLESHEETS --><!--[if lt IE 9]><script src={{ URL::asset('assets/js/flot/excanvas.min.js') }}></script><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script><![endif]-->
<!--   <link rel="stylesheet" type="text/css" href={{ URL::asset('assets/css/cloud-admin.css') }} >

  <link href={{ URL::asset('assets/font-awesome/css/font-awesome.min.css') }} rel="stylesheet">
  <!-- DATE RANGE PICKER -->
  <!-- <link rel="stylesheet" type="text/css" href={{ URL::asset('assets/js/bootstrap-daterangepicker/daterangepicker-bs3.css') }} /> -->
  <!-- ANIMATE -->
  <!-- <link rel="stylesheet" type="text/css" href={{ URL::asset('assets/css/animatecss/animate.min.css') }} /> --> 
  {!!Html::style('assets/plugins/bootstrap/css/bootstrap.min.css')!!}
  {!!Html::style('assets/plugins/font-awesome/css/font-awesome.min.css')!!}
  {!!Html::style('assets/fonts/style.css')!!}
  {!!Html::style('assets/plugins/font-awesome/css/font-awesome.min.css')!!}
  {!!Html::style('assets/css/main.css')!!}
  {!!Html::style('assets/css/main-responsive.css')!!}
  {!!Html::style('assets/plugins/iCheck/skins/all.css')!!}
  {!!Html::style('aassets/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css')!!}
  {!!Html::style('assets/plugins/perfect-scrollbar/src/perfect-scrollbar.css')!!}
  
 


  
@show
</head>
<body >
    @yield('page')
    @yield('sidemenu')
    @yield('content')

  @section('scripts')
  
    {!!Html::script('assets/plugins/jQuery-lib/2.0.3/jquery.min.js')!!}
    
    
    {!!Html::script('assets/plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js')!!}
    {!!Html::script('assets/plugins/bootstrap/js/bootstrap.min.js')!!}
    {!!Html::script('assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js')!!}
    {!!Html::script('assets/plugins/blockUI/jquery.blockUI.js')!!}
    {!!Html::script('assets/plugins/iCheck/jquery.icheck.min.js')!!}
    {!!Html::script('assets/plugins/perfect-scrollbar/src/perfect-scrollbar.js')!!}
    {!!Html::script('assets/plugins/perfect-scrollbar/src/jquery.mousewheel.js')!!}
    {!!Html::script('assets/plugins/less/less-1.5.0.min.js')!!}
    {!!Html::script('assets/plugins/jquery-cookie/jquery.cookie.js')!!}
    {!!Html::script('assets/plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js')!!}
    {!!Html::script('assets/js/main.js')!!}
    
    <!-- end: MAIN JAVASCRIPTS -->
 

  <!-- /JAVASCRIPTS -->
  @show
</body>
</html>
