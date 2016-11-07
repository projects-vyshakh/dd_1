<!DOCTYPE html>
<!-- Template Name: Clip-One - Responsive Admin Template build with Twitter Bootstrap 3.x Version: 1.4 Author: ClipTheme -->
<!--[if IE 8]><html class="ie8 no-js" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9 no-js" lang="en"><![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
    <!--<![endif]-->
    <!-- start: HEAD -->
    <head>

        <title>Doctor's Diary | Home</title>
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
    <body style="background-color:#f9f9f9">
        <div class=" resize-login dd_login_header"><!-- navbar-fixed-top -->
            <div class="inner_wrapper_2">
                <div class="container dd_pd_0">
                    <div class="row dd_mg_0">
                        <div class="col-sm-12 dd_pd_0">
                            <div class="logo_div">
                               <a class="navbar-brand dd_logo_img_2" href="http://ww.doctorsdiary.co">
                                   
                                </a>
                            </div>
                                              
                            <div class="navbar-tools  pull-right">
                            <!-- start: TOP NAVIGATION MENU -->
                            @if($currentPath=="doctorhome")
                                <ul class="nav navbar-right dd_profil">
                                    <li class="dropdown current-user">
                                        <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" data-close-others="true" href="#">
                                            <img src="assets/images/avatar-1-small.jpg" class="circle-img" alt="">
                                            <span class="username">{{ucfirst($doctorData->first_name)." ".ucfirst($doctorData->last_name)}}</span>
                                            <i class="clip-chevron-down"></i>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="logout">
                                                    <i class="clip-exit"></i>
                                                    &nbsp;Log Out
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            @endif
                    <!-- end: TOP NAVIGATION MENU -->
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


             <div class="box_admin">

             <div class="dd_profile_pic_div">
                 
                 <div class="dd_profile_pic"></div> 
             </div>

                    <div class="dd_logo_responsive">
                                    <div class="navbar-tools  pull-right">
                                    <!-- start: TOP NAVIGATION MENU -->
                                    @if($currentPath=="doctorhome")
                                        <ul class="nav navbar-right dd_profil">
                                            <li class="dropdown current-user">
                                                <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" data-close-others="true" href="#">
                                                    <img src="assets/images/avatar-1-small.jpg" class="circle-img" alt="">
                                                    <span class="username">{{ucfirst($doctorData->first_name)." ".ucfirst($doctorData->last_name)}}</span>
                                                    <i class="clip-chevron-down"></i>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a href="logout">
                                                            <i class="clip-exit"></i>
                                                            &nbsp;Log Out
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    @endif
                            <!-- end: TOP NAVIGATION MENU -->
                                    </div>                        
                    </div>
                <div class="row dd_pd_LR_20">
                    <div class="col-sm-12 dd-id-hd dd-pd-B_10">
                        Welcome to Doctor’s Diary
                    </div>
  
                </div>
                <div class="row dd_padding_lr">
                    <div class="col-sm-6 dd_border_right dd_patient_pd_L">
                        <div class="row">
                            <div class=" dd_upper">New Patient ID</div>
                        </div>
                       <!--  <div class="row">
                             <div class="col-sm-12 dd_upper_2">Enter New Patient ID </div>
                        </div> -->
                        <div class=" dd_margin_0 dd_width_90 dd_border_0">
                           <!--  <div class="content"></div> -->
                                {!! Form::open(array('route' => 'patientIdSubmit', 'role'=>'form', 'id'=>'addNewPatientPersonalInformation','name'=>'form-newpatient', 'class'=>'form-horizontal form-newpatient','novalidate'=>'novalidate')) !!}
                                    <input name="_token" type="hidden" value="{!! csrf_token() !!}" />
                           
                                    <div class="form-group ">
                                         {!! Form::hidden('patient_status', 'new', $attributes = array('class'=>'dd_form_id ','placeholder' => 'Enter New Patient Id'));  !!}

                                        <div class="dd_my_from">
                                            <div class="dd_form_id  ">
                                                {!! Form::text('patient_id', null, $attributes = array('class'=>'dd_form_id dd_border_0','placeholder' => ''));  !!}
                                                <!-- <i class="fa fa-user"></i>  -->
                                            </div>
                                        </div>
                                    
                                        <div class="dd_my_btn  dd_btn_PD_0">
                                            <div class="dd_btn_home_2">
                                                <button type="submit" class="dd_btn_3">Submit</button>
                                                
                                            </div>
                                        </div> 
                                  </div>



                                {!! Form::close() !!}
                        </div>

                    </div>

        
                    <div class="col-sm-6 dd_patient_pd_R">
                        <div class="row">
                            <div class=" dd_upper">Old Patient ID </div>
                        </div>
                    <!--     <div class="row">
                            <div class="col-sm-12 dd_upper_2">Enter Old Patient ID </div>
                        </div> -->
                        <div class=" dd_width_90 dd_border_0">
                           <!--  <div class="content"></div> -->
                            
                                {!! Form::open(array('route' => 'patientIdSubmit', 'role'=>'form', 'id'=>'addPatientPersonalInformation', 'class'=>'form-horizontal form-existpatient','novalidate'=>'novalidate')) !!}
                                    <input name="_token" type="hidden" value="{!! csrf_token() !!}" />
                                    <div class="form-group ">
                                        {!! Form::hidden('patient_status', 'old', $attributes = array('class'=>'form-control','placeholder' => 'Enter New Patient Id'));  !!}  
                                        <div class="dd_my_from">
                                            <div class="dd_form_id">
                                                {!! Form::text('patient_id', null, $attributes = array('class'=>'dd_form_id','placeholder' => ''));  !!}
                                                <!-- <i class="fa fa-user"></i> --> 
                                            </div>
                                        </div>
                                        <div class="">
                                            <div class="dd_my_btn  dd_btn_PD_0">
                                                <div class="dd_btn_home_2">
                                                    <button type="submit" class="dd_btn_3">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                {!! Form::close() !!}
                        </div>
                    </div> 

                  <div class=" core-box dd_margin_0 dd_width_90 dd_border_0 dd_relative">
                        <div class="heading ">
                              <?php $error = Session::get('error');
                                $success = Session::get('success');
                                Session::forget('error');
                                Session::forget('success');
                               
                              ?>
                              @if(!empty($error))
                                <div class="dd_alert dd_abs col-sm-6 display-none" style="display: block;">
                                  <a class="close" aria-hidden="true" href="#" data-dismiss="alert">×</a>
                                          {{$error}}
                                </div>
                              @elseif(!empty($success))
                                <div class="dd_alert_2 display-none" style="display: block;">
                                  <a class="close" aria-hidden="true" href="#" data-dismiss="alert">×</a>
                                          {{$success}}
                                </div>
                              @endif
                                    
                        </div>
                    </div>  
                </div>
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