<!DOCTYPE html>
<!-- Template Name: Clip-One - Responsive Admin Template build with Twitter Bootstrap 3.x Version: 1.4 Author: ClipTheme -->
<!--[if IE 8]><html class="ie8 no-js" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9 no-js" lang="en"><![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- start: HEAD -->
<head>

	<title>Doctor's Diary | Password</title>
	<!-- start: META -->
	<meta charset="utf-8" />
	<!--[if IE]><meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1" /><![endif]-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta content="" name="description" />
	<meta content="" name="author" />
	<link rel="shortcut icon" href="../assets/images/logo-mob.png" type="image/x-icon">
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
<body style="background-color:#f9f9f9">
	<div class=" navbar-fixed-top resize-login dd_login_header"><!-- navbar-fixed-top -->
		<div class="inner_wrapper_2">
			<div class="container dd_pd_0">
				<div class="row dd_mg_0">
					<div class="col-sm-12 dd_pd_0">
						<div class="logo_div">
							<a class="navbar-brand dd_logo_img_2" href="http://ww.doctorsdiary.co">
								
							</a>
						</div>
						<div class="login_div">
							<div class="doctorlogin_main">
								<span class="doctor_login"></span>

								<a href="../doctor/login" @if($currentPath=="doctor/login") class="topmenu-active dd_doctor_login"  style="color: #428bca" @endif>Doctor Login</a>&nbsp;  &nbsp;

							</div>
							<div class="patientlogin_main"> 		
								<span class="patient_login">
								</span>	        		 		 	
								<a href="patient/login" @if($currentPath=="patient/login") class="topmenu-active"  style="color: #428bca" @endif>
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
	        	

	        	
	        	
	        	
	        	<!-- Add Pagination -->
	        	<!--  <div class="swiper-pagination swiper-pagination-white"></div> -->
	        	<!-- Add Arrows -->
	  <!--       <div class="swiper-button-next swiper-button-white"></div>
	  <div class="swiper-button-prev swiper-button-white"></div> -->
	  <div class="inner_wrapper_3 ">

	  	<div class="dd_doctor_login_main_hd">

	  		<span>Sign in or create an account</span></div>
	  		
	  		<div class="doctor_login_main">
	  			

	  			<div class="box_2">
	  				<div class="box_2_main">
	  					<!-- <div class="main-login"> -->
	  					<div>

	  						<div class="dd_logo_responsive">

	  							<img src="../assets/images/logo-mob.png" alt="">			        		
	  						</div>
	  						<div class="dd_drlogin_responsive">

	  							<div class="login_div2">
	  								<div class="doctorlogin_main2">								

	  									<a href="../doctor/login" @if($currentPath=="doctor/login") class="topmenu-active dd_doctor_login" @endif>Doctor Login</a>&nbsp; / &nbsp;

	  								</div>
	  								<div class="patientlogin_main2"> 		
	  									
	  									<a href="patient/login" @if($currentPath=="patient/login") class="topmenu-active" @endif>
	  										Patient Login
	  									</a>
	  								</div>
	  							</div>
	  							
	  							
	  						</div>

	  						<?php 
	  						$doctorData 	= Session::get('doctorData');
	  						$patientData 	= Session::get('patientData');

	  						Session::forget('doctorData');
	  						Session::forget('patientData');
	  						
	  						?>
	  						


	  						<div class="box-login " style="display: block;">

	  							<div class="logo">
	  								<span class="login_HD dd_signfont">Add New Password</span>
	  							</div>
	  							<div class="row">
	  								<div class="col-sm-12">
	  									{!! Form::open(array('route' => 'handlePatientAddNewPassword', 'role'=>'form', 'id'=>'new-password', 'class'=>'form-horizontal new-password','name' =>'new-password')) !!}
	  									
	  									@if(!empty($patientData))
	  									{!! Form::hidden('doctor_patient_id',$patientData->id_patient,array('placeholder'=>'Password', 'class'=>'form-control dd_input', 'id'=>'id-doctor-patient' ) ) !!}
	  									@endif

	  									<div class="form-group">
	  										<div class="col-sm-12 dd_login">
	  											<span class="input-icon ">
	  												{!! Form::password('password', array('placeholder'=>'Password', 'class'=>'form-control dd_input', 'id'=>'password' ) ) !!}
	  												<span class="dd_input_icon_name"></span> 
	  											</span>
	  										</div>
	  									</div>
	  									<div class="form-group">
	  										<div class="col-sm-12 dd_login">
	  											<span class="input-icon ">
	  												{!! Form::password('cpassword', array('placeholder'=>'Confirm Password', 'class'=>'form-control dd_input', 'id'=>'cpassword' ) ) !!}
	  												<span class="dd_input_icon_name"></span> 
	  											</span>
	  										</div>
	  									</div>
                                            <!-- <div class="form-group dd_mg_B_10">
                                                <div class="col-sm-12 dd_login">
                                                    <span class="input-icon dd_relative">
                                                        {!! Form::password('password', array('placeholder'=>'Password', 'class'=>'form-control dd_input', 'id'=>'password' ) ) !!}
                                                        <span class="dd_input_icon"></span>

                                                    </span>
                                                </div>
                                            </div> -->
                                            <div class="form-group dd_mg_B_10">
                                            	<div class="col-sm-12 dd_mg_B_T_10">
                                            		<span class="input-icon ">
                                            			<button type="submit" class="btn btn-primary btn-block dd_btn_new">Submit</button>
                                            		</span>
                                            	</div>
                                                <!-- <div class="col-sm-12 dd_login_mg_30 dd_font_size_14px dd">
                                                    <a href="forgetpassword" class="dd_textalign_center ">Forgot Password?</a>
                                                </div>
                                                <div class="col-sm-12 dd_textalign_center dd_mg_25 dd_dummy dd_font_size_14px">
                                                <span class="dd_color_light_bl">New User ?</span><a href="doctorsignup" class=""> Register Now</a>
                                            </div> -->
                                        </div>
                                        <!--    <hr class="dd_border_CL">
                                            <div class="form-group ">
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
                    <div class="box_right">
						<div class="logo">
			  				<span class="login_HD dd_signfont">Already have an account on Doctor's Diary?</span>
			  			</div>
						<div class="col-sm-12 dd_textalign_center dd_pd_0 dd_dummy dd_font_size_14px">
			  				<!-- <span class="dd_color_light_bl">New User ?</span> -->
			  				<span class="input-icon ">
			  					<button type="submit" class="btn btn-primary btn-block dd_btn_new patient_login_btn">
			  						<a href="login" class=""> Login Now</a></button>
			  				</span>
			  			</div>
					</div>


                    <div class="dd_clear"></div>
                </div>



                <div class="dd_clear"></div>
            </div>


            <footer>
            	<div class="navbar-fixed-bottom dd_footer" style="z-index: 20000; bottom: 0;">
            		<div class="container " style="height:">
            			<div class="row">
            				<div class="col-sm-12">
            					<div class="inner_wrapper_2">
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
		{!!Html::script('assets/js/forgetpassword.js')!!}

		
		
		
		<script>
			jQuery(document).ready(function() {
				//Main.init();
				
				forgetPassword.init();
				$('.patient_login_btn').click(function(e){
		            e.preventDefault();
		            window.location='login';
		        });	
				
				
			});
		</script>
	</body>
	<!-- end: BODY -->
	</html>