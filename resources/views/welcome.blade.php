<!DOCTYPE html>
<!-- Template Name: Clip-One - Responsive Admin Template build with Twitter Bootstrap 3.x Version: 1.4 Author: ClipTheme -->
<!--[if IE 8]><html class="ie8 no-js" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9 no-js" lang="en"><![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
	<!--<![endif]-->
	<!-- start: HEAD -->
	<head>

	<title>Doctor's Diary | Welcome</title>
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
	
	  
	
	<link rel="stylesheet" href="ddroot/assets/plugins/bootstrap/css/bootstrap.min.css" type="text/css">
	<link rel="stylesheet" href="ddroot/assets/plugins/font-awesome/css/font-awesome.min.css" type="text/css">
	<link rel="stylesheet" href="ddroot/assets/fonts/style.css" type="text/css">
	<link rel="stylesheet" href="ddroot/assets/css/main.css" type="text/css">
	<link rel="stylesheet" href="ddroot/assets/css/main-responsive.css" type="text/css">
	<link rel="stylesheet" href="ddroot/assets/plugins/iCheck/skins/all.css" type="text/css">
	<link rel="stylesheet" href="ddroot/assets/plugins/Swiper-master/dist/css/swiper.min.css" type="text/css">
	<link rel="stylesheet" href="ddroot/assets/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.csss" type="text/css">
	<link rel="stylesheet" href="ddroot/assets/css/print.css" type="text/css">
	<link rel="stylesheet" href="ddroot/assets/css/dd-responsive.css" type="text/css">
	<link rel="stylesheet" href="ddroot/assets/plugins/Swiper-master/dist/css/swiper.min.css" type="text/css">
	   
	   

	</head>
	<!-- end: HEAD -->
	<!-- start: BODY -->

	<?php 
		$currentPath = Route::getCurrentRoute()->getPath();

	?>
	
	<body style="background-color:#000">
	<div class=" navbar-fixed-top resize-login dd_login_header_2">
	<div class="inner_wrapper">
	<div class="container dd_pd_0">
	       	<div class="row dd_mg_0">
	       		<div class="col-sm-12 dd_pd_0">
	       		<div class="logo_div">
	   		  <a class="navbar-brand dd_logo_img" href="http://www.doctorsdiary.co">
	                  
	</a>
	</div>
			<div class="login_div">
								<div class="doctorlogin_main">
									<span class="doctor_login">

										<a href="doctor/login" @if($currentPath=="doctor/login") class="topmenu-active dd_doctor_login" @endif>Doctor Login</a>&nbsp;  &nbsp;

								</div>
		        		 		<div class="patientlogin_main"> 		
		        		 		       		 		 	
		        		 		 	<a href="patient/login" @if($currentPath=="patient/login") class="topmenu-active res_patient_login" @endif>
		        		 		 		Patient Login
		        		 		 	</a>
		        		 		</div>
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

	      
	          
	       <div class="swiper-wrapper dd_swiper_opacity   ">
	        
	           <div class="swiper-slide"  style="background-image:url(ddroot/assets/images/slider1.jpg);">

	           <div class="inner_wrapper">

	              <span class="dd_slider_hd2  ">
	      
	           The electronic health record platform for billion Indian population
	             </span>

	             </div>


                </div>

	          

	           <div class="swiper-slide" style="background-image:url(ddroot/assets/images/slider2.jpg)">

	            <div class="inner_wrapper">	           	
	           <span class="dd_slider_hd2">
	           The electronic health record platform that saves lives from epidemics

	           </span>
	           </div>


	           </div>
	           <div class="swiper-slide" style="background-image:url(ddroot/assets/images/slider3.jpg)">

	             <div class="inner_wrapper">

	           <span class="dd_slider_hd2">
	             The electronic health record platform that helps fight cancer

	           </span> 
	           </div>
	           	

	           </div>
	           <div class="swiper-slide" style="background-image:url(ddroot/assets/images/slider4.jpg) ">

	             <div class="inner_wrapper">
	          <span class="dd_slider_hd2">
	            The electronic health record platform with machine learning algorithms
	           </span> 	 
	           </div>         
	           </div>

	           <div class="swiper-slide" style="background-image:url(ddroot/assets/images/slider5.jpg) ">
	             <div class="inner_wrapper">
	          <span class="dd_slider_hd2">
	           The electronic health record platform that helps in quantitative research
	           </div> 	          
	           </div>


	           <div class="swiper-slide" style="background-image:url(ddroot/assets/images/slider6.jpg) ">
	             <div class="inner_wrapper">
	          <span class="dd_slider_hd2">
	            The electronic health record platform that brings personalized medicine
	           </span> 
	           </div>	          
	           </div>


	           <div class="swiper-slide" style="background-image:url(ddroot/assets/images/slider7.jpg) ">

	             <div class="inner_wrapper">
	          <span class="dd_slider_hd2">
	              The electronic health record platform that is backed by supercomputing
	           </span>
	           </div> 	          
	           </div>
<!-- 	           <div class="swiper-slide" style="background-image:url(assets/images/slider1.jpeg)">ggg</div> -->
	       </div>
	       <!-- Add Pagination -->
	      <!--  <div class="swiper-pagination swiper-pagination-white"></div> -->
	       <!-- Add Arrows -->
	 <!--       <div class="swiper-button-next swiper-button-white"></div>
	       <div class="swiper-button-prev swiper-button-white"></div> -->
	       <div class="inner_wrapper ">



	        	<div class="dd_logo_responsive">

				        		<img src="ddroot/assets/images/logo-mob.png" alt="">			        		
				        	</div>
				        	<div class="dd_drlogin_responsive">

				        				<div class="login_div2">
								<div class="doctorlogin_main2">								

										<a href="doctorlogin" @if($currentPath=="doctorlogin") class="topmenu-active dd_doctor_login" @endif>Doctor Login</a>&nbsp; / &nbsp;

								</div>
		        		 		<div class="patientlogin_main2"> 		
		        		 		         		 		 	
		        		 		 	<a href="patientlogin" @if($currentPath=="patientlogin") class="topmenu-active" @endif>
		        		 		 		Patient Login
		        		 		 	</a>
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
	
	   
	   <script type="text/javascript" src="ddroot/assets/plugins/jQuery-lib/2.0.3/jquery.min.js"></script>
	   <script type="text/javascript" src="ddroot/assets/plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js"></script>
	   <script type="text/javascript" src="ddroot/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	   <script type="text/javascript" src="ddroot/assets/plugins/jquery-inputlimiter/jquery.inputlimiter.1.3.1.min.js"></script>
	   <script type="text/javascript" src="ddroot/assets/plugins/autosize/jquery.autosize.min.js"></script>
	   <script type="text/javascript" src="ddroot/assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js"></script>
	   <script type="text/javascript" src="ddroot/assets/plugins/blockUI/jquery.blockUI.js"></script>
	   <script type="text/javascript" src="ddroot/assets/plugins/iCheck/jquery.icheck.min.js"></script>
	   <script type="text/javascript" src="ddroot/assets/plugins/perfect-scrollbar/src/perfect-scrollbar.js"></script>
	   <script type="text/javascript" src="ddroot/assets/plugins/perfect-scrollbar/src/jquery.mousewheel.js"></script>
	   <script type="text/javascript" src="ddroot/assets/plugins/less/less-1.5.0.min.js"></script>
	   <script type="text/javascript" src="ddroot/assets/plugins/jquery-cookie/jquery.cookie.js"></script>
	   <script type="text/javascript" src="ddroot/assets/plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js"></script>
	   <script type="text/javascript" src="ddroot/assets/js/main.js"></script>
	   <script type="text/javascript" src="ddroot/assets/plugins/jquery-validation/dist/jquery.validate.min.js"></script>
	   <script type="text/javascript" src="ddroot/assets/js/login.js"></script>
	   <script type="text/javascript" src="ddroot/assets/plugins/Swiper-master/dist/js/swiper.min.js"></script>
	
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
