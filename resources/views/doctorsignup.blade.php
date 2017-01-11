<!DOCTYPE html>
<!-- Template Name: Clip-One - Responsive Admin Template build with Twitter Bootstrap 3.x Version: 1.4 Author: ClipTheme -->
<!--[if IE 8]><html class="ie8 no-js" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9 no-js" lang="en"><![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- start: HEAD -->
<head>

	<title>Doctor's Diary | Registration</title>
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

	{!!Html::style('assets/plugins/bootstrap-multiselect/css/bootstrap-multiselect.css')!!}
	
	<!-- {!!Html::style('assets/plugins/multiselectbox_jquery/jquery.multiselect.css')!!} -->

	<!-- {!!Html::style('assets/plugins/magicsuggest/magicsuggest-min.css')!!} -->
	<!-- {!!Html::style('assets/plugins/chosen/chosen.min.css')!!} -->

	<!-- {!!Html::style('assets/plugins/multiple-select-master/multiple-select.css')!!} -->


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
									<!-- <span class="doctor_login"><img src="assets/images/doctor_icon.png"></span>
								-->
								<a href="doctorlogin" @if($currentPath=="doctorlogin") class="topmenu-active dd_doctor_login"  style="color: #428bca" @endif>Doctor Login</a>&nbsp;  &nbsp;

							</div>
							<div class="patientlogin_main"> 		
		        		 		<!--  	<span class="patient_login"><img src="assets/images/patient_icon.png">
		        		 	</span>	     -->    		 		 	
		        		 	<a href="patientlogin" @if($currentPath=="patientlogin") class="topmenu-active"  style="color: #428bca" @endif>
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
	  <div class="inner_wrapper">



	  	<div class="doctor_login_main">


	  		<div class="box_register">


	  			<div class="box_2_register">
	  				<!-- <div class="main-login"> -->
	  				<div class="box-register-inner">
	  					<div class="dd_doctor_register_main_hd">Sign in or create an account</div>
	  					<div>
	  						<div class="dd_create dd_mg_20">
	  							<span class="login_HD  dd_signfont ">Create an Account</span>
	  						</div> 
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
	  					</div>

	  					<div class="box-login" style="display: block;">
	  						<div class="row dd_register_Bg_cl">
	  							<div class="col-sm-12">
	  								{!! Form::open(array('route' => 'handleDoctorSignUp', 'role'=>'form', 'id'=>'doctor-signup', 'class'=>'form-horizontal doctor-signup','name' =>'doctor-signup')) !!}
	  								{!! Form::hidden('signup_parameter', 'signup1', $attributes = array('class'=>'form-control', 'id'=>'signup_parameter'));  !!}
			        		


									<div class="dd_email_reg_label">Name</div>
									<div class="form-group dd_mg_B_40">
										<div class="col-sm-12">
											<span class="input-icon ">
												
											<div class="dd_input_4"> 
												{!! Form::text('first_name', null, $attributes = array('class'=>'form-control  first-name ','placeholder' => 'First Name', 'id'=>'first-name'));  !!}
											</div>
											<div class="dd_input_5"> 
												{!! Form::text('middle_name', null, $attributes = array('class'=>'form-control  middle-name dd_bodred_l_0 ','placeholder' => 'Middle Name', 'id'=>'middle-name'));  !!}
											</div>
											<div class="dd_input_6"> 
												{!! Form::text('last_name', null, $attributes = array('class'=>'form-control last-name dd_bodred_l_0','placeholder' => 'Last Name', 'id'=>'last-name'));  !!}
											</div>
												<!-- <i class="fa fa-user"></i>  -->
												<!-- <span class="dd_input_icon"></span> -->
											</span>
										</div>
										<div class="dd_clear"></div>
									</div>

									
									
									

									<div class="form-group dd_mg_B_40">
										<div class="col-sm-12">
											<span class="input-icon ">

											<div class="dd_input_2"> 
											<div class="dd_email_reg_label_2">Email</div>
												{!! Form::text('email',  Input::old('email'), $attributes = array('class' => 'form-control ', 'placeholder' => '')); !!}

											</div>

											<div class="dd_input_3"> 
											<div class="dd_email_reg_label_2">Phone </div>

											{!! Form::text('phone',Input::old('phone'), $attributes = array('class' => 'form-control  dd_bodred_l_0  ', 'placeholder' => '')); !!}
											</div>
												<!-- <span class="dd_input_icon_email"></span>  -->
												<!-- <i class="fa fa-user"></i>  -->
											</span>
										</div>
									</div>

									<div class="dd_email_reg_label">Password</div>

									<div class="form-group dd_mg_B_40">
										<div class="col-sm-12">
											<span class="input-icon ">

												<div class="dd_input_2"> 
													{!! Form::password('password', array('placeholder'=>'', 'class'=>'form-control ', 'id'=>'password' ) ) !!}

												</div>
												<div class="dd_input_3"> 

													{!! Form::password('cpassword', array('placeholder'=>'Confirm password', 'class'=>'form-control dd_bodred_l_0 ', 'id'=>'cpassword' ) ) !!}
												</div>
													<!-- <span class="dd_input_icon"></span> -->
													<!-- <i class="fa fa-user"></i>  -->
											</span>
										</div>

										<div class="dd_clear"></div>
									</div>

									
																	
									<div class="form-group dd_mg_B_40 ">
										<div class="col-sm-12">
											<span class="input-icon ">

											<div class="dd_input_2"> 
											<div class="dd_email_reg_label_2">Gender</div>
												{!! Form::select('gender', $gender, Input::old('gender'), $attributes = array('class' => 'form-control ')); !!}
											</div>

											<div class="dd_input_3"> 
												<div class="dd_email_reg_label_2">Martial Status</div>
												{!! Form::select('maritial_status', $maritialStatus, Input::old('maritial_status'), $attributes = array('class' => 'form-control  dd_bodred_l_0')); !!}
											</div>
												<!-- 	<span class="symbol required"></span>	 -->						
											</span>
										</div>
									</div> 


							

									<div class="form-group dd_mg_B_40">
										<div class="col-sm-12">
											<span class="input-icon ">
											

											<div class="dd_input_4">

												<div class="dd_email_reg_label_3">Country </div>
												{!! Form::select('country', $country, Input::old('country'), $attributes = array('class' => 'form-control country dd_input_', 'id'=>'country')); !!}
											</div>

											<div class="dd_input_5">

												<div class="dd_email_reg_label_3">State </div>
												{!! Form::select('state', $state, Input::old('state'), $attributes = array('class' => 'form-control  state dd_bodred_l_0','id' =>'state')); !!}
											</div>

											<div class="dd_input_6">

												<div class="dd_email_reg_label_3">City </div>
												{!! Form::text('city', Input::old('city'), $attributes = array('class' => 'form-control dd_bodred_l_0 ', 'placeholder' => 'City')); !!}
											</div>
												<!-- <span class="dd_input_icon"></span> -->
												<!-- <i class="fa fa-user"></i>  -->
											</span>
										</div>
									</div>


								

									<div class="form-group dd_mg_B_40">
										<div class="col-sm-12">
											<span class="input-icon ">
											<!-- 	 <i class="fa fa-sort-desc dd_fa_icons"></i>
										-->
										<div class="dd_input_2"> 
											<div class="dd_email_reg_label_2">Street </div>
											{!! Form::text('street', Input::old('street'), $attributes = array('class'=>'form-control ', 'placeholder' => ''));  !!}
										</div>
										
										<div class="dd_input_3">
										<div class="dd_email_reg_label_2">Pincode</div> 
										{!! Form::text('pincode', Input::old('pincode'), $attributes = array('class' => 'form-control dd_bodred_l_0 ', 'placeholder' => 'Pincode')); !!}
										</div>
										<!-- <span class="dd_input_icon"></span> -->

									</span>
								</div>
							</div>


							<div class="form-group dd_mg_B_40">
								<div class="col-sm-12">
									<span class="input-icon ">

									<div class="dd_input_2"> 

									<div class="dd_email_reg_label_2">Qualification </div>

										{!! Form::select('qualification[]', $qualification, Input::old('qualification'), $attributes = array('class' => 'form-control dd_qualification','id'=>'qualification','multiple' => 'multiple')); !!}

									</div>

									<div class="dd_input_2">
									<div class="dd_email_reg_label_2">Accredition </div>


									{!! Form::text('accredition', null,array('placeholder'=>'', 'class'=>'form-control dd_bodred_l_0 ', 'id'=>'accredition' ) ) !!}
									</div>
										
										
										
										<!-- <span class="dd_input_icon"></span> -->
										<!-- <i class="fa fa-user"></i>  -->
									</span>
								</div>
							</div>

						<div class="form-group dd_mg_B_40">
							<div class="col-sm-12">
								<span class="input-icon ">

								<div class="dd_input_2">
									<div class="dd_email_reg_label_2">Specialization </div>

									{!! Form::select('specialization', $specialization, Input::old('specialization'), $attributes = array('class' => 'form-control ')); !!}
								</div>

								<div class="dd_input_2">
									<div class="dd_email_reg_label_2">Super Specialization </div>


									{!! Form::text('super_specialization', null,array('placeholder'=>'', 'class'=>'form-control  super_specialization dd_bodred_l_0', 'id'=>'super_specialization' ) ) !!}

									</div>

									
									<!-- <span class="dd_input_icon"></span> -->
									<!-- <i class="fa fa-user"></i>  -->
								</span>
							</div>
						</div>



						<div class="dd_email_reg_label_2">IMA Registration Number</div>

						<div class="form-group dd_mg_B_40">
							<div class="col-sm-12">
								<span class="input-icon ">
									{!! Form::text('register_no', null,array('placeholder'=>'', 'class'=>'form-control dd_input', 'id'=>'register_no	' ) ) !!}
									<!-- <span class="dd_input_icon"></span> -->
									<!-- <i class="fa fa-user"></i>  -->
								</span>
							</div>
							<!-- <input type="checkbox" name="services" id="services" value="agree" class="services">  -->
						</div>

						<div class="form-group dd_mg_B_40 dd_agree">
							<div class="col-sm-12">
								<span class="input-icon ">
									<input type="checkbox" name="services" id="services" value="agree" class="services">
								</span>
								<p style="margin: -23px 20px 4px"> 
									I agree to the Doctor's Diary.

									
									<a target="_blank"> Privacy Policy </a> and
									<a  target="_blank"> Terms of Service. </a>
									
								</p>
							</div>
							<!--   -->
						</div>





						<div class="dd_agree form-group">

							<p>
								<!-- <a href="" class="dd_textalign_center"> -->
								<span>
								<!-- <input type="checkbox" name="services" id="services" value="agree" class="services">  -->
								</span>
								
								<!-- </a> -->
							</p>
						</div>

						<hr class="dd_PDB_30">


						<div class="form-group dd_mg_B_10">
							<div class="col-sm-12 dd_mg_B_10">
								<span class=" ">

									<button type="submit" class="btn btn-primary dd_btn_new">Save and Continue</button>
								</span>
							</div>
							<div class="col-sm-12 dd_mg_B_10">
								<span class=" ">

								</span>
							</div>
									<!-- 	<div class="col-sm-12">
										<p
										a href="" class="dd_textalign_center">I forget my password</a>
										</p>
									</div> -->
								</div>









									{!! Form::close() !!}

								</div>
							</div>
						</div>	
					</div>

				</div>
			</div>






			<div class="dd_clear"></div>
		</div>



		<div class="dd_clear"></div>
	</div>


	<footer>
		<div class="dd_footer" style="z-index: 20000; bottom: 0;">
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
		{!!Html::script('assets/js/login.js')!!}
		{!!Html::script('assets/js/doctorsignup.js')!!}
		<!-- {!!Html::script('assets/plugins/tooltip-validation/jquery-validate.bootstrap-tooltip.js')!!} -->
		{!!Html::script('assets/plugins/bootstrap-multiselect/js/bootstrap-multiselect.js')!!}

		<!-- {!!Html::script('assets/plugins/magicsuggest/magicsuggest-min.js')!!} -->
		{!!Html::script('assets/plugins/multiple-select-master/multiple-select.js')!!}

		<!-- {!!Html::script('assets/plugins/chosen/chosen.jquery.min.js')!!} -->

		<!-- {!!Html::script('assets/plugins/multiselectbox_jquery/jquery.multiselect.js')!!} -->

		<script>
			jQuery(document).ready(function() {
				//Main.init();
				Login.init();
				doctorSignup.init();
				$('#qualification').multiselect({ });
					
				
				

				
				
				




				
			});
		</script>
	</body>
	<!-- end: BODY -->
	</html>