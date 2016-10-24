<!DOCTYPE html>
<!-- Template Name: Clip-One - Responsive Admin Template build with Twitter Bootstrap 3.x Version: 1.4 Author: ClipTheme -->
<!--[if IE 8]><html class="ie8 no-js" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9 no-js" lang="en"><![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
	<!--<![endif]-->
	<!-- start: HEAD -->
	<head>

		<title>Doctor'Diary | Login</title>
		<!-- start: META -->
		<meta charset="utf-8" />
		<!--[if IE]><meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1" /><![endif]-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta content="" name="description" />
		<meta content="" name="author" />
	
		<!-- end: META -->
		<!-- start: MAIN CSS -->
		{!!Html::style('assets/plugins/bootstrap/css/bootstrap.min.css')!!}
	    {!!Html::style('assets/plugins/font-awesome/css/font-awesome.min.css')!!}
	    {!!Html::style('assets/fonts/style.css')!!}
	    {!!Html::style('assets/plugins/font-awesome/css/font-awesome.min.css')!!}
	    {!!Html::style('assets/css/main.css')!!}
	    {!!Html::style('assets/css/main-responsive.css')!!}
	    {!!Html::style('assets/plugins/iCheck/skins/all.css')!!}
	    {!!Html::style('assets/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css')!!}
	    {!!Html::style('assets/plugins/perfect-scrollbar/src/perfect-scrollbar.css')!!}
	    {!!Html::style('assets/css/theme_light.css',array('id'=>'skin_color'))!!}
	    {!!Html::style('assets/css/print.css',array('media' => 'print')) !!}

	     {!!Html::style('assets/plugins/fullslider/css/full-slider.css')!!}

	     <style>
	     	/*@media only screen and (max-width: 500px) {
			    .box {
				    background: #fff none repeat scroll 0 0;
				    height: 416px;
				    position: absolute;
				    right: 12%;
				    top: 18%;
				    width: 50px;
				    z-index: 10000;
				    color :blue;
				}
		    }*/
	     	@media only screen and (max-width: 320px) {
			   	.box {
				    background: #fff none repeat scroll 0 0;
				    /*height: 416px;*/
				    position: absolute;
				    right: 0%;
				    top: 18%;
				    width: 100px;
				    z-index: 10000;
				    color :red;
				}


			}
	     	.nav-height{
	     		height: 85px;
	     		box-shadow: none;
	     	}
	     	.top-menu-active{
	     		color: black;
	     		width: 400px;
	     		
	     	}
	     	.box {
			    background: #fff none repeat scroll 0 0;
			    /*height: 416px;*/
			    position: absolute;
			    right: 12%;
			    top: 18%;
			    width: 346px;
			    z-index: 10000;
			}
	     	
	     </style>

	  
	</head>
	<!-- end: HEAD -->
	<!-- start: BODY -->
	<?php
		$currentPath = Route::getCurrentRoute()->getPath();
		echo $currentPath;
	?>
	<body>

		<div class="navbar navbar-inverse navbar-fixed-top " >
			<div class="container nav-height">
				<div class="row">
					<div class="col-sm-12">
						<div class="form-group">
							<div class="col-sm-2">
								<a class="navbar-brand" href="login">
									<img src="assets/images/logo2.png">
								</a>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-2">
								
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-2">
								
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-2">
								
							</div>
						</div>
					
						<div class="form-group">
							<div class="col-sm-2">
								<a href = "login" @if($currentPath=='login') class="top-menu-active" @endif >Login</a> |
								<a href = "register" @if($currentPath=='register') class="top-menu-active" @endif >Register</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
 		<ol class="carousel-indicators">
		  <li data-target="#my<a href="http://www.jqueryscript.net/tags.php?/Carousel/">Carousel</a>" data-slide-to="0" class="active"></li>
		  <li data-target="#myCarousel" data-slide-to="1"></li>
		  <li data-target="#myCarousel" data-slide-to="2"></li>
		</ol>
		<div class="carousel-inner">
  <div class="item active"> <img src="3.jpg" style="width:100%" data-src="holder.js/900x500/auto/#7cbf00:#fff/text: " alt="First slide">
    <div class="container">
      <div class="carousel-caption">
        <h1> Headling 1 </h1>
        <p> Description 1</p>
      </div>
    </div>
  </div>
  <div class="item"> <img src="2.jpg" style="width:100%" data-src="" alt="Second slide">
    <div class="container">
      <div class="carousel-caption">
        <h2>
        Headling 2
        </h1>
        <p> Description 2</p>
      </div>
    </div>
  </div>
  <div class="item"> <img src="1.jpg" style="width:100%" data-src="" alt="Third slide">
    <div class="container">
      <div class="carousel-caption">
        <h2>
        Headling 3
        </h1>
        <p> Description 3</p>
      </div>
    </div>
  </div>
</div>
<a class="left carousel-control" href="#myCarousel" data-slide="prev">
  <span class="glyphicon glyphicon-chevron-left"></span>
</a>

<a class="right carousel-control" href="#myCarousel" data-slide="next">
  <span class="glyphicon glyphicon-chevron-right"></span>
</a>
<div id="myCarousel" class="carousel slide" data-ride="carousel"> 
  ...
</div>

		<footer>
			<div class="navbar-fixed-bottom" style="z-index: 20000">
		      <div class="container" style="height: 50px">
		        <div class="row">
		        	<div class="col-sm-12">
		        		<div class="col-sm-6">
		        			&copy2016 Doctor's Diary | Powered by BrainPan Innovations Pvt Ltd
		        		</div>
		        		<div class="col-sm-6">
		        			
		        		</div>
		        	</div>
		        </div>
		      </div>
			</div>
		</footer>
		<!-- end: HEADER -->
		
		
		<!-- start: MAIN JAVASCRIPTS -->
		<!--[if lt IE 9]>
		<script src="assets/plugins/respond.min.js"></script>
		<script src="assets/plugins/excanvas.min.js"></script>
		<script type="text/javascript" src="assets/plugins/jQuery-lib/1.10.2/jquery.min.js"></script>
		<![endif]-->
		<!--[if gte IE 9]><!-->
		{!!Html::script('assets/plugins/jQuery-lib/2.0.3/jquery.min.js')!!}
     
	    {!!Html::script('assets/plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js')!!}
	    {!!Html::script('assets/plugins/bootstrap/js/bootstrap.min.js')!!}
	    {!!Html::script('assets/plugins/jquery-inputlimiter/jquery.inputlimiter.1.3.1.min.js')!!}
		{!!Html::script('assets/plugins/autosize/jquery.autosize.min.js')!!}
	    {!!Html::script('assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js')!!}
	    {!!Html::script('assets/plugins/blockUI/jquery.blockUI.js')!!}
	    {!!Html::script('assets/plugins/iCheck/jquery.icheck.min.js')!!}
	    {!!Html::script('assets/plugins/perfect-scrollbar/src/perfect-scrollbar.js')!!}
	    {!!Html::script('assets/plugins/perfect-scrollbar/src/jquery.mousewheel.js')!!}
	    {!!Html::script('assets/plugins/less/less-1.5.0.min.js')!!}
	    {!!Html::script('assets/plugins/jquery-cookie/jquery.cookie.js')!!}
	    {!!Html::script('assets/plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js')!!}
	    {!!Html::script('assets/js/main.js')!!}


	    {!!Html::script('assets/plugins/jquery-validation/dist/jquery.validate.min.js')!!}
	    {!!Html::script('assets/js/login.js')!!}

	    {!!Html::script('assets/js/jssor.slider.mini.js')!!}

	    <!-- {!!Html::script('assets/plugins/fullslider/js/jquery.js')!!} -->
	    
	<!-- 	<script src="assets/plugins/jQuery-lib/2.0.3/jquery.min.js"></script>
		
		<script src="assets/plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js"></script>
		<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
		<script src="assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js"></script>
		<script src="assets/plugins/blockUI/jquery.blockUI.js"></script>
		<script src="assets/plugins/iCheck/jquery.icheck.min.js"></script>
		<script src="assets/plugins/perfect-scrollbar/src/jquery.mousewheel.js"></script>
		<script src="assets/plugins/perfect-scrollbar/src/perfect-scrollbar.js"></script>
		<script src="assets/plugins/less/less-1.5.0.min.js"></script>
		<script src="assets/plugins/jquery-cookie/jquery.cookie.js"></script>
		<script src="assets/plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js"></script>
		<script src="assets/js/main.js"></script> -->
		<!-- end: MAIN JAVASCRIPTS -->
		<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<!-- <script src="assets/plugins/jquery-validation/dist/jquery.validate.min.js"></script>
		<script src="assets/js/login.js"></script> -->
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->


		<script>
			jQuery(document).ready(function() {
				//Main.init();
				Login.init();
				//alert("vy");
				/*$('.carousel').carousel({
			        interval: 3000 //changes the speed
			    })*/







				
			});
		</script>
	</body>
	<!-- end: BODY -->
</html>