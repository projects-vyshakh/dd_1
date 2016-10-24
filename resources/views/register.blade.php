<!DOCTYPE html>
<!-- Template Name: Clip-One - Responsive Admin Template build with Twitter Bootstrap 3.x Version: 1.4 Author: ClipTheme -->
<!--[if IE 8]><html class="ie8 no-js" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9 no-js" lang="en"><![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
	<!--<![endif]-->
	<!-- start: HEAD -->
	<head>

		<title>Doctor'Diary | Register</title>
		<!-- start: META -->
		<meta charset="utf-8" />
		<!--[if IE]><meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1" /><![endif]-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta content="" name="description" />
		<meta content="" name="author" />
		<style type="text/css">
		.register-box {
		    background: #fff none repeat scroll 0 0;
		    height: 350px; 
		    position: absolute;
		    right: 12%;
		    top: 20%;
		    width: 650px;
		    z-index: 1000;
		    overflow: scroll;
		    overflow-x : hidden;
		    padding: 20px;
		    box-shadow: none;
		}
		.topmenu-active{
			color :black;
		}
		</style>
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
	    
	    
<!-- 		<link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets/plugins/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="assets/fonts/style.css">
		<link rel="stylesheet" href="assets/css/main.css">
		<link rel="stylesheet" href="assets/css/main-responsive.css">
		<link rel="stylesheet" href="assets/plugins/iCheck/skins/all.css">
		<link rel="stylesheet" href="assets/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css">
		<link rel="stylesheet" href="assets/plugins/perfect-scrollbar/src/perfect-scrollbar.css">
		<link rel="stylesheet" href="assets/css/theme_light.css" type="text/css" id="skin_color">
		<link rel="stylesheet" href="assets/css/print.css" type="text/css" media="print"/> -->
		<!--[if IE 7]>
		<link rel="stylesheet" href="assets/plugins/font-awesome/css/font-awesome-ie7.min.css">
		<![endif]-->
		<!-- end: MAIN CSS -->
		<!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
		<!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
	</head>
	<!-- end: HEAD -->
	<!-- start: BODY -->
	<?php
		$currentPath = Route::getCurrentRoute()->getPath();
		//echo $currentPath;
	?>
	<body class="login example2">
		<div class="navbar navbar-inverse navbar-fixed-top">

        	<div class="container">
        		<div class="row">
        		 	<div class="col-sm-12">
        		 		<div class="navbar-header">
        		 			<div class="col-sm-6">
        		 		
	        			 		<button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
	        				 	<span class="clip-list-2"></span>
		                		</button>

				                <a class="navbar-brand" href="login">
				                   <img src="assets/images/logo2.png" height="45px">

								</a>
							</div>
						</div>
        		 		
        		 		<div class="col-sm-6">
        		 			<a href="login" @if($currentPath=="login") class="topmenu-active" @endif>Login</a>&nbsp; | &nbsp;
        		 		 	<a href="register" @if($currentPath=="register") class="topmenu-active" @endif>Register</a>
        		 		</div>
        		 	</div>
        		</div>
        	</div>
        </div>
        <header id="myCarousel" class="carousel slide">

	        <div class="register-box">
	        	<!-- <div class="main-login"> -->
	        	<div>
	        		<div class="logo">
	        			<h3>Create a new account</h3>
	        		</div>
	        		<div class="box-login" style="display:block; box-shadow: none;">
	        			<div class="row">
							<div class="col-sm-12">
	        					{!! Form::open(array('route' => 'handleLogin', 'role'=>'form', 'id'=>'login', 'class'=>'form-horizontal form-login','name' =>'form-login')) !!}
			        				<!-- <div class="errorHandler alert alert-danger no-display">
										<i class="fa fa-remove-sign"></i> You have some form errors. Please check below.
									</div> -->
									<div class="form-group">
					    				<!-- {!! Form::label('registration_id', 'Registration Id', $attributes = array('class'=>'col-sm-2 control-label'));  !!}	 -->	
										<div class="col-sm-12">
											<span class="input-icon">
												{!! Form::text('registration_id', null, $attributes = array('class'=>'form-control','placeholder' => 'Registration Id'));  !!}
												<i class="fa fa-user"></i> 
											</span>
										</div>
									</div>	
			        				<div class="form-group">
					    				<!-- {!! Form::label('name', 'Name', $attributes = array('class'=>'col-sm-2 control-label'));  !!} -->		
										<div class="col-sm-6">
											<span class="input-icon">
												{!! Form::text('first_name', null, $attributes = array('class'=>'form-control','placeholder' => 'First Name'));  !!}
												<i class="fa fa-user"></i> 
											</span>
										</div>
										<!-- {!! Form::label('first_name', 'First Name', $attributes = array('class'=>'col-sm-2 control-label'));  !!} -->	
									<!-- 	<div class="col-sm-4">
											<span class="input-icon">
												{!! Form::text('middle_name', null, $attributes = array('class'=>'form-control','placeholder' => 'Middle Name'));  !!}
												<i class="fa fa-quote-left"></i> </span>
										</div> -->

										<div class="col-sm-6">
											<span class="input-icon">
												{!! Form::text('last_name', null, $attributes = array('class'=>'form-control','placeholder' => 'Last Name'));  !!}
												<i class="fa fa-quote-left"></i> </span>
										</div>
									</div>
									<hr>

									<div class="form-group">
										<!-- {!! Form::label('house', 'House', $attributes = array('class'=>'col-sm-2 control-label'));  !!}	 -->	
										<div class="col-sm-6">
											<span class="input-icon">
												{!! Form::text('house', Input::old('house'), $attributes = array('class'=>'form-control', 'placeholder' => 'House No / Name'));  !!}
												<i class="fa fa-user"></i> 
											</span>
										</div>
									<!-- 	{!! Form::label('street', 'Street', $attributes = array('class'=>'col-sm-2 control-label'));  !!} -->		
										<div class="col-sm-6">
											<span class="input-icon">
												{!! Form::text('street', Input::old('street'), $attributes = array('class'=>'form-control', 'placeholder' => 'Street Name'));  !!}
												<i class="fa fa-user"></i> 
											</span>
										</div>
									</div>
									<div class="form-group">
										<!-- {!! Form::label('country', 'Country', $attributes = array('class'=>'col-sm-2 control-label'));  !!}	 -->	
										<div class="col-sm-6">
											<span class="input-icon">
												<!-- {!! Form::select('country', $country, $attributes = array('class'=>'form-control', 'placeholder' => 'City Name'));  !!} -->
												{!! Form::select('country', $country, null, $attributes = array('class' => 'form-control')); !!}
												<!-- <i class="fa fa-user"></i>  -->
											</span>
										</div>
										<!-- {!! Form::label('state', 'State', $attributes = array('class'=>'col-sm-2 control-label'));  !!}	 -->	
										<div class="col-sm-6">
											<span class="input-icon">
												{!! Form::select('state', $state, null, $attributes = array('class' => 'form-control')); !!}
												
												<!-- <i class="fa fa-user"></i>  -->
											</span>
										</div>
									</div>
									<div class="form-group">
										<!-- {!! Form::label('city', 'City', $attributes = array('class'=>'col-sm-2 control-label'));  !!} -->		
										<div class="col-sm-6">
											<span class="input-icon">
												<!-- {!! Form::select('country', $country, $attributes = array('class'=>'form-control', 'placeholder' => 'City Name'));  !!} -->
												{!! Form::select('city', $city, null, $attributes = array('class' => 'form-control')); !!}
												<!-- <i class="fa fa-user"></i>  -->
											</span>
										</div>
										<!-- {!! Form::label('pincode', 'Pincode', $attributes = array('class'=>'col-sm-2 control-label'));  !!}	 -->	
										<div class="col-sm-6">
											<span class="input-icon">
												<!-- {!! Form::select('country', $country, $attributes = array('class'=>'form-control', 'placeholder' => 'City Name'));  !!} -->
												{!! Form::text('pincode', Input::old('pincode'), $attributes = array('class' => 'form-control', 'placeholder' => 'Pincode')); !!}
												<!-- <i class="fa fa-user"></i>  -->
											</span>
										</div>
									</div>	
									<hr>
									<div class="form-group">
										<!-- {!! Form::label('phone', 'Phone No', $attributes = array('class'=>'col-sm-2 control-label'));  !!}	 -->	
										<div class="col-sm-6">
											<span class="input-icon">
												<!-- {!! Form::select('country', $country, $attributes = array('class'=>'form-control', 'placeholder' => 'City Name'));  !!} -->
												{!! Form::text('phone', Input::old('phone'), $attributes = array('class' => 'form-control', 'placeholder' => 'Phone Number')); !!}
												<!-- <i class="fa fa-user"></i>  -->
											</span>
										</div>
										<!-- {!! Form::label('email', 'Email', $attributes = array('class'=>'col-sm-2 control-label'));  !!} -->		
										<div class="col-sm-6">
											<span class="input-icon">
												<!-- {!! Form::select('country', $country, $attributes = array('class'=>'form-control', 'placeholder' => 'City Name'));  !!} -->
												{!! Form::text('email', Input::old('email'), $attributes = array('class' => 'form-control', 'placeholder' => 'Email')); !!}
												<!-- <i class="fa fa-user"></i>  -->
											</span>
										</div>
									</div>
									<div class="form-group">
										<!-- {!! Form::label('password', 'Password', $attributes = array('class'=>'col-sm-2 control-label'));  !!} -->	
										<div class="col-sm-6">
											{!! Form::password('password', array('placeholder'=>'Password', 'class'=>'form-control', 'id'=>'password' ) ) !!}
										</div>
										<!-- {!! Form::label('confirm_password', 'Confirm Password', $attributes = array('class'=>'col-sm-2 control-label'));  !!} -->	
										<div class="col-sm-6">
											{!! Form::password('confirm_password', array('placeholder'=>'Confirm Password', 'class'=>'form-control', 'id'=>'confirm_password' ) ) !!}
										</div>
									</div>
									<hr>
									<div class="form-group">
										<!-- {!! Form::label('qualification', 'Qualification', $attributes = array('class'=>'col-sm-2 control-label'));  !!}	 -->
										<div class="col-sm-6">
											<span class="input-icon">
												<!-- {!! Form::select('country', $country, $attributes = array('class'=>'form-control', 'placeholder' => 'City Name'));  !!} -->
												{!! Form::select('country', $country, null, $attributes = array('class' => 'form-control')); !!}
												<!-- <i class="fa fa-user"></i>  -->
											</span>
										</div>
										<!-- {!! Form::label('accredition', 'Accredition', $attributes = array('class'=>'col-sm-2 control-label'));  !!}	 -->
										<div class="col-sm-6">
											<span class="input-icon">
												<!-- {!! Form::select('country', $country, $attributes = array('class'=>'form-control', 'placeholder' => 'City Name'));  !!} -->
												{!! Form::select('country', $country, null, $attributes = array('class' => 'form-control')); !!}
												<!-- <i class="fa fa-user"></i>  -->
											</span>
										</div>
										
									</div>
									<div class="form-group">
										<div class="col-sm-10"></div>
										<div class="col-sm-2">
											<button type="submit" class="btn btn-primary btn-block">Save</button>
										</div>
										
									</div>
			        				<!-- <div class="form-group">
			        				  
			        					<div class="col-sm-10">
			        						<p>Click ! Your health data infront of you</p>
			        						<p>Click ! Health analysis for you</p>
			        						<p>Oh ! And did we forget health predictions too</p>
			        					</div>
			        				</div> -->	
			        				<!-- <div class="form-group">
			        				  
			        					<div class="col-sm-10">
			        						
			        					</div>
			        				</div>	 -->

	        					{!! Form::close() !!}
	        				</div>
	        			</div>
	        		</div>
	        			
				</div>
			</div>	
	        <!-- Indicators -->
	        <ol class="carousel-indicators">
	            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
	            <li data-target="#myCarousel" data-slide-to="1"></li>
	            <li data-target="#myCarousel" data-slide-to="2"></li>
	        </ol>

	        <!-- Wrapper for Slides -->
	        <div class="carousel-inner">
	            <div class="item active">
	                <!-- Set the first background image using inline CSS below. -->
	                <div class="fill" style="background-image:url('http://placehold.it/1900x1080&text=Slide One');"></div>
	               <!--  <div class="carousel-caption">
	                    <h2>Caption 1</h2>
	                </div> -->
	            </div>
	            <div class="item">
	                <!-- Set the second background image using inline CSS below. -->
	                <div class="fill" style="background-image:url('http://placehold.it/1900x1080&text=Slide Two');"></div>
	                <!-- <div class="carousel-caption">
	                    <h2>Caption 2</h2>
	                </div> -->
	            </div>
	            <div class="item">
	                <!-- Set the third background image using inline CSS below. -->
	                <div class="fill" style="background-image:url('http://placehold.it/1900x1080&text=Slide Three');"></div>
	               <!--  <div class="carousel-caption">
	                    <h2>Caption 3</h2>
	                </div> -->
	            </div>
	        </div>

	        <!-- Controls -->
	        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
	            <span class="icon-prev"></span>
	        </a>
	        <a class="right carousel-control" href="#myCarousel" data-slide="next">
	            <span class="icon-next"></span>
	        </a>
	        <!-- start: COPYRIGHT -->
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

    	</header>	
<!-- 		<div class="main-login col-sm-4 col-sm-offset-4">
			<div class="logo">CLIP<i class="clip-clip"></i>ONE
			</div>
		
			<div class="box-login">
				<h3>Sign in to your account</h3>
				<p>
					Please enter your name and password to log in.
				</p>
				<form class="form-login" action="index.html">
					<div class="errorHandler alert alert-danger no-display">
						<i class="fa fa-remove-sign"></i> You have some form errors. Please check below.
					</div>
					<fieldset>
						<div class="form-group">
							<span class="input-icon">
								<input type="text" class="form-control" name="username" placeholder="Username">
								<i class="fa fa-user"></i> </span>
						</div>
						<div class="form-group form-actions">
							<span class="input-icon">
								<input type="password" class="form-control password" name="password" placeholder="Password">
								<i class="fa fa-lock"></i>
								<a class="forgot" href="#">
									I forgot my password
								</a> </span>
						</div>
						<div class="form-actions">
							<label for="remember" class="checkbox-inline">
								<input type="checkbox" class="grey remember" id="remember" name="remember">
								Keep me signed in
							</label>
							<button type="submit" class="btn btn-bricky pull-right">
								Login <i class="fa fa-arrow-circle-right"></i>
							</button>
						</div>
						<div class="new-account">
							Don't have an account yet?
							<a href="#" class="register">
								Create an account
							</a>
						</div>
					</fieldset>
				</form>
			</div>
			

		
			
		</div> -->
		
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
				$('.carousel').carousel({
			        interval: 3000 //changes the speed
			    })
				
			});
		</script>
	</body>
	<!-- end: BODY -->
</html>