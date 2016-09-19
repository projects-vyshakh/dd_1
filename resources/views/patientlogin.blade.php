<!DOCTYPE html>
<!-- Template Name: Clip-One - Responsive Admin Template build with Twitter Bootstrap 3.x Version: 1.4 Author: ClipTheme -->
<!--[if IE 8]><html class="ie8 no-js" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9 no-js" lang="en"><![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
	<!--<![endif]-->
	<!-- start: HEAD -->
	<head>

		<title>Doctor's Diary | Patient Login</title>
		<!-- start: META -->
		<meta charset="utf-8" />
		<!--[if IE]><meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1" /><![endif]-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta content="" name="description" />
		<meta content="" name="author" />
		<link rel="shortcut icon" href="assets/images/logo-mob.png" type="image/x-icon">
		<style type="text/css">

	body {
        background-color: #000;
        font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
        font-size: 14px;
        color:#000;
        margin: 0;
        padding: 0;
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
		.topmenu-active{
			color :black;
		}
		.resize-login{
			z-index: 10001;
		}
		  html, body {
        position: relative;
        height: 100%;
    }

    .swiper-container {
        width: 100%;
        height: 100%;
    }
    .swiper-slide {
        background-position: center;
        background-size: cover;
    }
		</style>
		<!-- end: META -->
		<!-- start: MAIN CSS -->
		{!!Html::style('assets/plugins/bootstrap/css/bootstrap.min.css')!!}
	    {!!Html::style('assets/plugins/font-awesome/css/font-awesome.min.css')!!}
	    {!!Html::style('assets/fonts/style.css')!!}
	    
	    {!!Html::style('assets/css/main.css')!!}
	    {!!Html::style('assets/css/main-responsive.css')!!}
	    {!!Html::style('assets/plugins/iCheck/skins/all.css')!!}
	    {!!Html::style('assets/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css')!!}
	    {!!Html::style('assets/plugins/perfect-scrollbar/src/perfect-scrollbar.css')!!}
	    
	    {!!Html::style('assets/css/print.css',array('media' => 'print')) !!}

	   
	     {!!Html::style('assets/css/dd-responsive.css')!!}

	     {!!Html::style('assets/plugins/Swiper-master/dist/css/swiper.min.css')!!}
	
	      
	    
	    

	</head>
	<!-- end: HEAD -->
	<!-- start: BODY -->
	<?php
		$currentPath = Route::getCurrentRoute()->getPath();
		//echo $currentPath;
	?>
	<body style="background-color:#000">
		<div class=" navbar-fixed-top resize-login dd_login_header">
			<div class="inner_wrapper">
				<div class="container dd_pd_0">
	        		<div class="row dd_mg_0">
	        		 	<div class="col-sm-12 dd_pd_0">
	        		 		<div class="logo_div">
	    		 			   <a class="navbar-brand dd_logo_img" href="http://ww.doctorsdiary.co">
				                   
								</a>
							</div>
							<div class="login_div">
								<span class="doctor_login"><img src="assets/images/doctor_icon.png"></span>
									<a href="doctorlogin" @if($currentPath=="doctorlogin") class="topmenu-active" @endif>Doctor Login</a>&nbsp; | &nbsp;
	        		 		 		
	        		 		 	<span class="doctor_login"><img src="assets/images/patient_icon.png"></span>
	        		 		 		<a href="patientlogin" @if($currentPath=="patientlogin") class="topmenu-active" @endif>
	        		 		 		Patient Login
	        		 		 		</a>
	        		 		</div>
							<!-- <div class="login_div">
	        		 			<a href="patientlogin" @if($currentPath=="login") class="topmenu-active" @endif>Login</a>&nbsp; | &nbsp;
	        		 		 	<a href="doctorsignup" @if($currentPath=="register") class="topmenu-active" @endif>Register</a>
	        		 		</div> -->
	        		 	</div>
	        		</div>
	        	</div>
	        </div>
        </div>
       <!-- Swiper -->
	    <div class="swiper-container dd_bg_black">

	       
	           
	        <div class="swiper-wrapper dd_swiper_opacity  ">
	         
	            <div class="swiper-slide"  style="background-image:url(assets/images/slider1.jpeg);">

	               <span class="dd_slider_hd">
	       
	             The EHR platform for billion Indian Population
	              </span>
                </div>

	           

	            <div class="swiper-slide" style="background-image:url(assets/images/slider2.jpeg)">	            	
	            <span class="dd_slider_hd">
	             The EHR platform with Machine Learning Algorithms
	            </span>
	            </div>
	            <div class="swiper-slide" style="background-image:url(assets/images/slider3.jpeg)">

	            <span class="dd_slider_hd">
	             The EHR platform that helps fight Cancer
	            </span> 
	            	

	            </div>
	            <div class="swiper-slide" style="background-image:url(assets/images/slider4.jpg) ">
		           <span class="dd_slider_hd">
		             The EHR platform backed by Supercomputing
		            </span> 	           
	            </div>

	            <div class="swiper-slide" style="background-image:url(assets/images/slider5.jpg) ">
		           <span class="dd_slider_hd">
		             The EHR platform that saves lives from Epidemics
		            </span> 	           
	            </div>


	            <div class="swiper-slide" style="background-image:url(assets/images/slider6.jpeg) ">
		           <span class="dd_slider_hd">
		             The EHR platform that brings Personalized Medicine
		            </span> 	           
	            </div>


	            <div class="swiper-slide" style="background-image:url(assets/images/slider7.jpg) ">
		           <span class="dd_slider_hd">
		                The EHR platform that helps in Quantitative Research
		            </span> 	           
	            </div>
<!-- 	            <div class="swiper-slide" style="background-image:url(assets/images/slider1.jpeg)">ggg</div> -->
	        </div>
	        <!-- Add Pagination -->
	       <!--  <div class="swiper-pagination swiper-pagination-white"></div> -->
	        <!-- Add Arrows -->
	  <!--       <div class="swiper-button-next swiper-button-white"></div>
	        <div class="swiper-button-prev swiper-button-white"></div> -->
	        <div class="inner_wrapper ">
					<div class="box_2">
			        	<!-- <div class="main-login"> -->
			        	<div>
			        		<div class="logo">
			        			<span class="login_HD dd_signfont">Sign In</span>
			        		</div>
			        		<div class="box-login " style="display: block;">
			        			<div class="row">
									<div class="col-sm-12">
										<?php 
											$error = Session::get('error');
								            $success = Session::get('success');
							                Session::forget('error');
							                Session::forget('success');
							        
								        ?>
							          	@if(!empty($error))
								            <div class="alert alert-danger display-none" style="display: block;">
								              <a class="close" aria-hidden="true" href="#" data-dismiss="alert">×</a>
								                {{$error}}
								            </div>
							          	@elseif(!empty($success))
								            <div class="alert alert-success display-none" style="display: block;">
								              <a class="close" aria-hidden="true" href="#" data-dismiss="alert">×</a>
								                {{$success}}
								            </div>
							          	@endif
			        					{!! Form::open(array('route' => 'handlePatientLogin', 'role'=>'form', 'id'=>'login', 'class'=>'form-horizontal form-login','name' =>'form-login')) !!}
					        				<div class="form-group">
												<div class="col-sm-12 dd_login">
													<span class="input-icon ">
														{!! Form::text('id_patient', null, $attributes = array('class'=>'form-control dd_input','placeholder' => 'Patient ID', 'id'=>'id_patient'));  !!}
														<span class="dd_input_icon_name"></span> 
													</span>
												</div>
					        				</div>
					        				<div class="form-group dd_mg_B_10">
					        					<div class="col-sm-12 dd_login">
													<span class="input-icon dd_relative">
														{!! Form::password('password', array('placeholder'=>'Password', 'class'=>'form-control dd_input', 'id'=>'password' ) ) !!}
														<span class="dd_input_icon"></span>

													</span>
												</div>
					        				</div>
					        				<div class="form-group dd_mg_B_10">
					        					<div class="col-sm-12 dd_mg_B_T_10">
													<span class="input-icon ">
														<button type="submit" class="btn btn-primary btn-block dd_btn">Login</button>
													</span>
												</div>
												<div class="col-sm-12">
													<p><a href="forgetpassword" class="dd_textalign_center">Forgot Password?</a></p>
												</div>
					        				</div>
					        				<div class="form-group dd_mg_B_10">
					        					<div class="col-sm-12">
													<p><a href="patientregistercheckid" class="btn btn-primary btn-block dd_btn_center dd_Active_mg"> Register</a></p>
												</div>
					        				</div>
					        				<!-- <hr class="dd_border_CL"> -->
					        				<!-- <div class="form-group ">
					        					<div class="col-sm-2 "></div>
					        					<div class="col-sm-12 dd_textalign_center_mg">New to Doctor's Diary?&nbsp;<a href="doctorsignup">Signup</a></div>
											</div> -->
					        			
										{!! Form::close() !!}
			        				</div>
			        			</div>
			        		</div>
			        			
						</div>
					</div>
				</div>


		<footer>
				<div class="navbar-fixed-bottom " style="z-index: 20000; bottom: 0;">
			      <div class="container " style="height:">
			        <div class="row">
			        	<div class="col-sm-12">
			        	<div class="inner_wrapper">
			        		<div class="footer_div footer_pd dd_left ">
			        			&copy 2016 Doctor's Diary | Powered by Brainpan <!-- Innovations.  -->
			        		</div>
			        		<div class="footer_div_2 dd_right">
				        		<ul class="footer_ul">
					        		<li class="footer_li">
					        		 <a href="" class="footer_a">Terms & Conditions</a>	
					        		</li>
					        		<li class="footer_li">
					        		<a href="" class="footer_a">Blog</a>
					        		</li>
					        		<li class="footer_li">
					        		<a href="" class="footer_a">Career</a>
					        		</li>
					        		<li class="footer_li">
					        		<a href="" class="footer_a">About Us</a>
					        		</li>
				        			
				        		</ul>
			        			
			        		</div>
			        		</div>
			        	</div>
			        </div>
			      </div>
				</div>
			</footer>








	    </div>
	  	

		
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

	     {!!Html::script('assets/plugins/Swiper-master/dist/js/swiper.min.js')!!}
	   	
	
		<script>
			jQuery(document).ready(function() {
				//Main.init();
				Login.init();
				
			  	var swiper = new Swiper('.swiper-container', {
			        pagination: '.swiper-pagination',
			        speed: 1500,
			        paginationClickable: true,
			        autoplay : 5000,
			        preloadImages : true,
			        nextButton: '.swiper-button-next',
			        prevButton: '.swiper-button-prev',
			        spaceBetween: 5000,
			        effect: 'fade',

			    });
				
			});
		</script>
	</body>
	<!-- end: BODY -->
</html>