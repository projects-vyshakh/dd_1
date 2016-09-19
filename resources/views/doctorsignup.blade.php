<!DOCTYPE html>
<!-- Template Name: Clip-One - Responsive Admin Template build with Twitter Bootstrap 3.x Version: 1.4 Author: ClipTheme -->
<!--[if IE 8]><html class="ie8 no-js" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9 no-js" lang="en"><![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
	<!--<![endif]-->
	<!-- start: HEAD -->
	<head>

		<title>Doctor's Diary | Doctor's Signup</title>
		<!-- start: META -->
		<meta charset="utf-8" />
		<!--[if IE]><meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1" /><![endif]-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta content="" name="description" />
		<meta content="" name="author" />
		<meta name="_token" content="{!! csrf_token() !!}"/>
		
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
	  	{!!Html::style('assets/plugins/bootstrap-multiselect/css/bootstrap-multiselect.css')!!}
	    
	    

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
	    		 			   <a class="navbar-brand dd_logo_img" href="htt://www.doctorsdiar.co">
				                   
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
	        		 	</div>
	        		</div>
	        	</div>
	        </div>
        </div>
       <!-- Swiper -->
	    <div class="swiper-container dd_bg_black">
				<!-- <span class="dd_slider_hd">The EHR platform that helps in Quantitative Research</span> -->
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
	        </div>
	       
	        <div class="inner_wrapper ">
				<div class="box_register">
	        	<!-- <div class="main-login"> -->
	        	<div class="box-register-inner">
		        	<div>
		        		<div class="dd_create dd_mg_20">
		        			<span class="login_HD  dd_signfont ">Create An Account</span>
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
	        					{!! Form::open(array('route' => 'handleDoctorSignUp', 'role'=>'form', 'id'=>'register-form', 'class'=>'form-horizontal register-form','name' =>'register-form')) !!}
	        						{!! Form::hidden('signup_parameter', 'signup1', $attributes = array('class'=>'form-control', 'id'=>'signup_parameter'));  !!}
			        				<!-- <div class="errorHandler alert alert-danger no-display">
										<i class="fa fa-remove-sign"></i> You have some form errors. Please check below.
									</div> -->
			        		<!-- 		<div class="form-group dd_mg_B_10 ">
										<div class="col-sm-12">
											<span class=" ">
												{!! Form::text('first_name', null, $attributes = array('class'=>'form-control first_name dd_input dd_register_Bg_cl','placeholder' => 'First Name', 'id'=>'first_name'));  !!}
											
											</span>
										</div>
			        				</div> -->
			        			<!-- 	<div class="form-group dd_mg_B_10 ">
										<div class="col-sm-12">
											<span class=" ">
												{!! Form::text('middle_name', null, $attributes = array('class'=>'form-control middle_name dd_input','placeholder' => 'Middle Name', 'id'=>'middle_name'));  !!}
												
											</span>
										</div>
			        				</div> -->
			        		<!-- 		<div class="form-group dd_mg_B_10 ">
										<div class="col-sm-12">
											<span class=" ">
												{!! Form::text('last_name', null, $attributes = array('class'=>'form-control last_name dd_input','placeholder' => 'Last Name', 'id'=>'last_name'));  !!}
												
											</span>
										</div>
			        				</div> -->
			        			<!-- 	<div class="form-group dd_mg_B_10 ">
										<div class="col-sm-12">
											<span class=" ">
												{!! Form::text('aadhar_no', null, $attributes = array('class'=>'form-control aadhar_no dd_input','placeholder' => 'Aadhar No', 'id'=>'aadhar_no'));  !!}
												
											</span>
										</div>
			        				</div> -->
			        			<!-- 	<div class="form-group dd_mg_B_10 ">
										<div class="col-sm-12">
											<span class=" ">
												{!! Form::select('gender', $gender, Input::old('gender'), $attributes = array('class' => 'form-control dd_input')); !!}
												
											</span>
										</div>
			        				</div> -->
			        	<!-- 			<div class="form-group dd_mg_B_10 ">
										<div class="col-sm-12">
											<span class=" ">
												{!! Form::select('maritial_status', $maritialStatus, Input::old('maritial_status'), $attributes = array('class' => 'form-control dd_input')); !!}
											
											</span>
										</div>
			        				</div> -->
			        			<!-- 	<div class="form-group dd_mg_B_10 ">
										<div class="col-sm-12">
											<span class=" ">
												{!! Form::text('house', Input::old('house'), $attributes = array('class'=>'form-control dd_input', 'placeholder' => 'House No / Name'));  !!}
												
											</span>
										</div>
			        				</div> -->
			        			<!-- 	<div class="form-group dd_mg_B_10 ">
										<div class="col-sm-12">
											<span class=" ">
												{!! Form::text('street', Input::old('street'), $attributes = array('class'=>'form-control dd_input', 'placeholder' => 'Street Name'));  !!}
											</span>
										</div>
			        				</div> -->
			        			<!-- 	<div class="form-group dd_mg_B_10 ">
										<div class="col-sm-12">
											<span class=" ">
												{!! Form::select('country', $country, Input::old('country'), $attributes = array('class' => 'form-control country dd_input', 'id'=>'country')); !!}
											</span>
										</div>
			        				</div> -->
			        			<!-- 	<div class="form-group dd_mg_B_10">
			        					<div class="col-sm-12">
											<span class="">
												{!! Form::select('state', $state, Input::old('state'), $attributes = array('class' => 'form-control dd_input state','id' =>'state')); !!}
												
											</span>
										</div>

			        				</div> -->
			        		<!-- 		<div class="form-group dd_mg_B_10">
			        					<div class="col-sm-12">
											<span class="">
												{!! Form::text('city', Input::old('city'), $attributes = array('class' => 'form-control dd_input', 'placeholder' => 'City')); !!}
											
											</span>
										</div>
			        				</div>
<!--  -->
			        			<!-- 	<div class="form-group dd_mg_B_10">
			        					<div class="col-sm-12">
											<span class="">
												{!! Form::text('pincode', Input::old('pincode'), $attributes = array('class' => 'form-control dd_input', 'placeholder' => 'Pincode')); !!}
												
											</span>
										</div>
			        				</div> --> 
<!-- 
			        				<div class="form-group dd_mg_B_10">
			        					<div class="col-sm-12">
											<span class="">
												{!! Form::text('phone',Input::old('phone'), $attributes = array('class' => 'form-control dd_input', 'placeholder' => 'Phone Number')); !!}
												
											</span>
										</div>
			        				</div> -->

			        				<!-- <div class="dd_email_reg_label">email</div> -->

			        				<div class="form-group dd_mg_B_15">
			        					<div class="col-sm-12">
											<span class="input-icon ">
												{!! Form::text('email',  Input::old('email'), $attributes = array('class' => 'form-control dd_input', 'placeholder' => 'Email')); !!}
												<span class="dd_input_icon_email"></span> 
												<!-- <i class="fa fa-user"></i>  -->
											</span>
										</div>
			        				</div>

			        			<!-- 	<div class="dd_email_reg_label">Password</div> -->

			        				<div class="form-group dd_mg_B_15">
			        					<div class="col-sm-12">
											<span class="input-icon ">
												{!! Form::password('password', array('placeholder'=>'Password', 'class'=>'form-control dd_input', 'id'=>'password' ) ) !!}
												<span class="dd_input_icon"></span>
												<!-- <i class="fa fa-user"></i>  -->
											</span>
										</div>
			        				</div>


			        				<!-- <div class="dd_email_reg_label">Confirm password</div> -->
			        				<div class="form-group dd_mg_B_15">
			        					<div class="col-sm-12">
											<span class="input-icon ">
												{!! Form::password('cpassword', array('placeholder'=>'Confirm Password', 'class'=>'form-control dd_input', 'id'=>'cpassword' ) ) !!}
												<!-- <i class="fa fa-user"></i>  -->
												<span class="dd_input_icon"></span>
											</span>
										</div>
			        				</div>
			        		<!-- 		<div class="form-group dd_mg_B_10 ">
										<div class="col-sm-12">
											<span class=" ">
												{!! Form::select('qualification[]', $qualification, Input::old('qualification'), $attributes = array('class' => 'form-control dd_input','id'=>'qualification','multiple' => 'multiple')); !!}
												
											</span>
										</div>
			        				</div> -->
			        		
			        		<!-- 		<div class="form-group dd_mg_B_10">
			        					<div class="col-sm-12">
											<span class="">
												{!! Form::select('specialization', $specialization, Input::old('specialization'), $attributes = array('class' => 'form-control dd_input')); !!}
												
											</span>
										</div>
			        				</div> -->
			        		<!-- 		<div class="form-group dd_mg_B_10">
			        					<div class="col-sm-12">
											<span class="">
												{!! Form::text('super_specialization', null,array('placeholder'=>'Super specialization', 'class'=>'form-control dd_input super_specialization', 'id'=>'super_specialization' ) ) !!}
												
											</span>
										</div>
			        				</div> -->
			        			<!-- 	<div class="form-group dd_mg_B_10">
			        					<div class="col-sm-12">
											<span class="">
												{!! Form::text('accredition', null,array('placeholder'=>'Accredition', 'class'=>'form-control dd_input', 'id'=>'accredition' ) ) !!}
												
											</span>
										</div>
			        				</div> -->
			        			<!-- 	<div class="form-group dd_mg_B_10">
			        					<div class="col-sm-12">
											<span class="">
												{!! Form::text('register_no', null,array('placeholder'=>'IMA Register Number', 'class'=>'form-control dd_input', 'id'=>'register_no	' ) ) !!}
												
											</span>
										</div>
			        				</div> -->
<!-- 			        				<div class=" dd_mg_B_10 dd_terms ">
										<p>
										

 <input type="checkbox" name="vehicle" value="Bike"> 
										I agree to the Doctord Diary


<a target="_blank">Terms of Service</a>
and
<a  target="_blank">Privacy Policy</a>
										
										</p>
									</div> -->


			        				<div class="form-group dd_mg_0email">
			        					<div class="col-sm-12 dd_subit_mg_top">
											<span class=" ">
												<button type="submit" class="btn btn-primary btn-block dd_btn">	
												<a class="dd_btn_next" href="doctorsignupinformation.php">Next</a></button>

											</span>
										</div>
					
			        				</div>
			        			
		

	        					{!! Form::close() !!}
	        			
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
	    {!!Html::script('assets/js/doctors-information.js')!!}
	    {!!Html::script('assets/plugins/bootstrap-multiselect/js/bootstrap-multiselect.js')!!}
	    {!!Html::script('assets/plugins/Swiper-master/dist/js/swiper.min.js')!!}
	   	
	
		<script>
			jQuery(document).ready(function() {
				//Main.init();
				//Login.init();
				//doctorElements.init();

				$('#qualification').multiselect();
			    //$('.btn-group').addClass('multiselect-fullwidth');
				
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


			  	var form = $('.register-form');
                var errorHandler = $('.errorHandler', form);
                var successHandler = $('.successHandler', form);
                

		        
                form.validate({
                    rules: {
                       
		                email           :   { required: true, email : true }, 
		                password        :   { required: true, minlength : 5 },   	 
                        cpassword       : 	{
									            required: true,
									            minlength: 5,
									            equalTo: "#password"
									        }
                        
                    },
                    messages: {
                       
		                email           : "Please specify valid email",
		                password        : "Please specify password(Min : 5chars)",
		               	cpassword        : "Please enter same values as above",
		                
                       
                       
                    },    
                    submitHandler: function (form) {
                        errorHandler.hide();
                        form.submit();
                        //alert('hh');
                    },
                    invalidHandler: function (event, validator) { //display error alert on form submit
                        errorHandler.show();
                    }
                });








				
			});
		</script>
	</body>
	<!-- end: BODY -->
</html>