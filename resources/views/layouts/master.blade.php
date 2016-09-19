<?php



$currentPath = Route::getCurrentRoute()->getPath();
//echo $currentPath;
$patientId = Session::get('patientId');

if(!empty($specialization )){
    $specialization  = $specialization ;
}
else{
    $specialization ="0";
}

//$patientName = Session::get('patientName');

$todayDate = date('d-M-Y');
?>

<!doctype html>
<html lang="en">
<head>
     <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <link rel="shortcut icon" href="assets/images/logo-mob.png" type="image/x-icon">
    <!-- <meta content="authenticity_token" name="csrf-param"> -->
    @if($currentPath=="patientpersonalinformation")<title>Patient Personal Information</title> @endif
    @if($currentPath=="patientobstetricshistory")<title>Patient Obstetrics History</title> @endif
    @if($currentPath=="patientmedicalhistory")<title>Patient Medical History</title> @endif
    @if($currentPath=="patientprevioustreatment")<title>Patient Previous Treatments</title> @endif
    @if($currentPath=="patientexamination")<title>Patient Examination</title> @endif
    @if($currentPath=="patientlabdata")<title>Patient Lab Data</title> @endif
    @if($currentPath=="patientdiagnosis")<title>Patient Diagnosis</title> @endif
    @if($currentPath=="patientprescmanagement")<title>Patient Prescription Management</title> @endif
    @if($currentPath=="patientprescmedicine")<title>Patient Medicinal Prescription</title> @endif
    @if($currentPath=="patientprofilemanagement")<title>Patient Profile Management</title> @endif
    @if($currentPath=="patientprofileedit")<title>Patient Profile Edit</title> @endif
    @if($currentPath=="patientprofileprevtreatment")<title>Patient Previous Treatment</title> @endif
    @if($currentPath=="patientchangepassword")<title>Patient Change Password</title> @endif
    
    {!!Html::style('assets/plugins/bootstrap/css/bootstrap.min.css')!!}
    
    {!!Html::style('assets/fonts/style.css')!!}
   <!--  {!!Html::style('assets/plugins/font-awesome/css/font-awesome.min.css')!!} -->
    {!!Html::style('assets/css/main.css')!!}
    {!!Html::style('assets/css/main-responsive.css')!!}
    {!!Html::style('assets/plugins/iCheck/skins/all.css')!!}
    {!!Html::style('assets/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css')!!}
    {!!Html::style('assets/plugins/perfect-scrollbar/src/perfect-scrollbar.css')!!}
    {!!Html::style('assets/css/theme_light.css',array('id'=>'skin_color'))!!}
    {!!Html::style('assets/css/print.css',array('media' => 'print')) !!}
    {!!Html::style('assets/css/dd-responsive.css')!!}
     
    @yield('head')
   

   

    <link rel="stylesheet" href="">

 
</head>

<body >
    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
       
            <div class="navbar-header">
                <!-- start: RESPONSIVE MENU TOGGLER -->
                <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
                    <span class="clip-list-2"></span>
                </button>
                <!-- end: RESPONSIVE MENU TOGGLER -->
                <!-- start: LOGO -->
                @if($currentPath=='patientprofilemanagement' || $currentPath=='patientprofileprevtreatment' || $currentPath=='patientprofileedit' || $currentPath=='patientchangepassword')
                    <div class="dd_main_logo">
                        <img src="assets/images/logo.png" height="40px">  
                    </div>
                @else
                    <a class="navbar-brand" href="doctorhome">
                       <!--  CLIP<i class="clip-clip"></i>ONE -->
                       <img src="assets/images/home.png" height="38px" style="display:block">

                    </a>
                @endif
                

                <!-- Top Menu Starts-->
                @if(($currentPath =='patientprofileprevtreatment') || ($currentPath =='patientprofilemanagement') || ($currentPath =='patientprofileedit') || ($currentPath=='patientchangepassword'))
                @else
                <div class="nav navbar-left">
                    <div class="horizontal-menu navbar-collapse collapse">
                        <ul class="nav navbar-nav">
                            <li id="patient-top-menu-li"  @if($currentPath == 'patientpersonalinformation' || $currentPath == 'patientobstetricshistory' || $currentPath == 'patientmedicalhistory' || $currentPath == 'patientprevioustreatment' || $currentPath == 'cardiomedicalhistory') class="active" @endif >
                                <a href="patientpersonalinformation" id="patient-menu">
                               <i class="icon pricon icon-pr-patient" ng-show="navOption.key"></i>
                               <!--  <img src="assets/images/Patient.png"> -->
                                    Patient
                                </a>
                            </li>
                            <li id="diagnosis-top-menu-li" @if($currentPath == 'patientexamination' || $currentPath == 'patientlabdata' || $currentPath == 'patientdiagnosis') class="active" @endif>
                                <a href="patientexamination" id="diagnosis-menu">
                                <!-- <img src="assets/images/Diagnosis.png"> -->
                               <i class="icon pricon icon-pr-Diagnosis" ng-show="navOption.key"></i>
                                    Diagnosis
                                </a>
                            </li>
                            <li id="diagnosis-top-menu-li" @if($currentPath == 'patientprescmanagement' || $currentPath=='patientprescmedicine') class="active" @endif>
                                <a href="patientprescmanagement" id="diagnosis-menu">
                                <!-- <img src="assets/images/Diagnosis.png"> -->
                               <i class="icon pricon icon-pr-prescriptions" ng-show="navOption.key"></i>

                                    Prescription
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- end: LOGO -->
                @endif

            </div>
            @if($currentPath=='patientprofilemanagement' || $currentPath=='patientprofileprevtreatment' || $currentPath =='patientprofileedit' || $currentPath=='patientchangepassword')
            @else
                 <div class="dd_main_logo">
                   <img src="assets/images/logo.png" height="40px" style="display:block">  
                </div>
            @endif
               

            <div class="navbar-tools">

                    <!-- start: TOP NAVIGATION MENU -->
                @if($currentPath!="patientpersonalinformation" &&$currentPath!="patientobstetricshistory" &&     $currentPath!="patientmedicalhistory" && $currentPath!="patientprevioustreatment" &&$currentPath!="patientexamination" &&$currentPath!="patientlabdata" && $currentPath!="patientdiagnosis" && $currentPath!="patientprescmanagement" && $currentPath!="patientprescmedicine" &&
                $currentPath!="cardiomedicalhistory" )
                    <ul class="nav navbar-right">

                        <!-- start: TO-DO DROPDOWN -->
                       <!--  <li class="dropdown">
                            <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" data-close-others="true" href="#">
                                <i class="clip-list-5"></i>
                                <span class="badge"> 12</span>
                            </a>
                            <ul class="dropdown-menu todo">
                                <li>
                                    <span class="dropdown-menu-title"> You have 12 pending tasks</span>
                                </li>
                                <li>
                                    <div class="drop-down-wrapper">
                                        <ul>
                                            <li>
                                                <a class="todo-actions" href="javascript:void(0)">
                                                    <i class="fa fa-square-o"></i>
                                                    <span class="desc" style="opacity: 1; text-decoration: none;">Staff Meeting</span>
                                                    <span class="label label-danger" style="opacity: 1;"> today</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="todo-actions" href="javascript:void(0)">
                                                    <i class="fa fa-square-o"></i>
                                                    <span class="desc" style="opacity: 1; text-decoration: none;"> New frontend layout</span>
                                                    <span class="label label-danger" style="opacity: 1;"> today</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="todo-actions" href="javascript:void(0)">
                                                    <i class="fa fa-square-o"></i>
                                                    <span class="desc"> Hire developers</span>
                                                    <span class="label label-warning"> tommorow</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="todo-actions" href="javascript:void(0)">
                                                    <i class="fa fa-square-o"></i>
                                                    <span class="desc">Staff Meeting</span>
                                                    <span class="label label-warning"> tommorow</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="todo-actions" href="javascript:void(0)">
                                                    <i class="fa fa-square-o"></i>
                                                    <span class="desc"> New frontend layout</span>
                                                    <span class="label label-success"> this week</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="todo-actions" href="javascript:void(0)">
                                                    <i class="fa fa-square-o"></i>
                                                    <span class="desc"> Hire developers</span>
                                                    <span class="label label-success"> this week</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="todo-actions" href="javascript:void(0)">
                                                    <i class="fa fa-square-o"></i>
                                                    <span class="desc"> New frontend layout</span>
                                                    <span class="label label-info"> this month</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="todo-actions" href="javascript:void(0)">
                                                    <i class="fa fa-square-o"></i>
                                                    <span class="desc"> Hire developers</span>
                                                    <span class="label label-info"> this month</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="todo-actions" href="javascript:void(0)">
                                                    <i class="fa fa-square-o"></i>
                                                    <span class="desc" style="opacity: 1; text-decoration: none;">Staff Meeting</span>
                                                    <span class="label label-danger" style="opacity: 1;"> today</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="todo-actions" href="javascript:void(0)">
                                                    <i class="fa fa-square-o"></i>
                                                    <span class="desc" style="opacity: 1; text-decoration: none;"> New frontend layout</span>
                                                    <span class="label label-danger" style="opacity: 1;"> today</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="todo-actions" href="javascript:void(0)">
                                                    <i class="fa fa-square-o"></i>
                                                    <span class="desc"> Hire developers</span>
                                                    <span class="label label-warning"> tommorow</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="view-all">
                                    <a href="javascript:void(0)">
                                        See all tasks <i class="fa fa-arrow-circle-o-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </li> -->
                        <!-- end: TO-DO DROPDOWN-->
                        <!-- start: NOTIFICATION DROPDOWN -->
                        <li class="dropdown">
                            <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" data-close-others="true" href="#">
                                <i class="clip-notification-2"></i>
                                <span class="badge"> 11</span>
                            </a>
                            <ul class="dropdown-menu notifications">
                                <li>
                                    <span class="dropdown-menu-title"> You have 11 notifications</span>
                                </li>
                                <li>
                                    <div class="drop-down-wrapper">
                                        <ul>
                                            <li>
                                                <a href="javascript:void(0)">
                                                    <span class="label label-primary"><i class="fa fa-user"></i></span>
                                                    <span class="message"> New user registration</span>
                                                    <span class="time"> 1 min</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)">
                                                    <span class="label label-success"><i class="fa fa-comment"></i></span>
                                                    <span class="message"> New comment</span>
                                                    <span class="time"> 7 min</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)">
                                                    <span class="label label-success"><i class="fa fa-comment"></i></span>
                                                    <span class="message"> New comment</span>
                                                    <span class="time"> 8 min</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)">
                                                    <span class="label label-success"><i class="fa fa-comment"></i></span>
                                                    <span class="message"> New comment</span>
                                                    <span class="time"> 16 min</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)">
                                                    <span class="label label-primary"><i class="fa fa-user"></i></span>
                                                    <span class="message"> New user registration</span>
                                                    <span class="time"> 36 min</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)">
                                                    <span class="label label-warning"><i class="fa fa-shopping-cart"></i></span>
                                                    <span class="message"> 2 items sold</span>
                                                    <span class="time"> 1 hour</span>
                                                </a>
                                            </li>
                                            <li class="warning">
                                                <a href="javascript:void(0)">
                                                    <span class="label label-danger"><i class="fa fa-user"></i></span>
                                                    <span class="message"> User deleted account</span>
                                                    <span class="time"> 2 hour</span>
                                                </a>
                                            </li>
                                            <li class="warning">
                                                <a href="javascript:void(0)">
                                                    <span class="label label-danger"><i class="fa fa-shopping-cart"></i></span>
                                                    <span class="message"> Transaction was canceled</span>
                                                    <span class="time"> 6 hour</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)">
                                                    <span class="label label-success"><i class="fa fa-comment"></i></span>
                                                    <span class="message"> New comment</span>
                                                    <span class="time"> yesterday</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)">
                                                    <span class="label label-primary"><i class="fa fa-user"></i></span>
                                                    <span class="message"> New user registration</span>
                                                    <span class="time"> yesterday</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)">
                                                    <span class="label label-primary"><i class="fa fa-user"></i></span>
                                                    <span class="message"> New user registration</span>
                                                    <span class="time"> yesterday</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)">
                                                    <span class="label label-success"><i class="fa fa-comment"></i></span>
                                                    <span class="message"> New comment</span>
                                                    <span class="time"> yesterday</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)">
                                                    <span class="label label-success"><i class="fa fa-comment"></i></span>
                                                    <span class="message"> New comment</span>
                                                    <span class="time"> yesterday</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                               
                                <li class="view-all">
                                    <a href="javascript:void(0)">
                                        See all notifications <i class="fa fa-arrow-circle-o-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- end: NOTIFICATION DROPDOWN -->
                        <!-- start: MESSAGE DROPDOWN -->
                       <!--  <li class="dropdown">
                            <a class="dropdown-toggle" data-close-others="true" data-hover="dropdown" data-toggle="dropdown" href="#">
                                <i class="clip-bubble-3"></i>
                                <span class="badge"> 9</span>
                            </a>
                            <ul class="dropdown-menu posts">
                                <li>
                                    <span class="dropdown-menu-title"> You have 9 messages</span>
                                </li>
                                <li>
                                    <div class="drop-down-wrapper">
                                        <ul>
                                            <li>
                                                <a href="javascript:;">
                                                    <div class="clearfix">
                                                        <div class="thread-image">
                                                            <img alt="" src="./assets/images/avatar-2.jpg">
                                                        </div>
                                                        <div class="thread-content">
                                                            <span class="author">Nicole Bell</span>
                                                            <span class="preview">Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.</span>
                                                            <span class="time"> Just Now</span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <div class="clearfix">
                                                        <div class="thread-image">
                                                            <img alt="" src="./assets/images/avatar-1.jpg">
                                                        </div>
                                                        <div class="thread-content">
                                                            <span class="author">Peter Clark</span>
                                                            <span class="preview">Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.</span>
                                                            <span class="time">2 mins</span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <div class="clearfix">
                                                        <div class="thread-image">
                                                            <img alt="" src="./assets/images/avatar-3.jpg">
                                                        </div>
                                                        <div class="thread-content">
                                                            <span class="author">Steven Thompson</span>
                                                            <span class="preview">Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.</span>
                                                            <span class="time">8 hrs</span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <div class="clearfix">
                                                        <div class="thread-image">
                                                            <img alt="" src="./assets/images/avatar-1.jpg">
                                                        </div>
                                                        <div class="thread-content">
                                                            <span class="author">Peter Clark</span>
                                                            <span class="preview">Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.</span>
                                                            <span class="time">9 hrs</span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <div class="clearfix">
                                                        <div class="thread-image">
                                                            <img alt="" src="./assets/images/avatar-5.jpg">
                                                        </div>
                                                        <div class="thread-content">
                                                            <span class="author">Kenneth Ross</span>
                                                            <span class="preview">Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.</span>
                                                            <span class="time">14 hrs</span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="view-all">
                                    <a href="pages_messages.html">
                                        See all messages <i class="fa fa-arrow-circle-o-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </li> -->
                        <!-- end: MESSAGE DROPDOWN -->
                        <!-- start: USER DROPDOWN -->
                        @if($currentPath =='patientprofilemanagement' || $currentPath =='patientprofileprevtreatment' || $currentPath =='patientprofileedit' || $currentPath=='patientchangepassword')
                            <div class="nav navbar-left">
                                <div class="horizontal-menu navbar-collapse collapse">
                                    <ul class="nav navbar-nav">
                                        <li id="patient-top-menu-li"  @if($currentPath == 'patientpersonalinformation' || $currentPath == 'patientobstetricshistory' || $currentPath == 'patientmedicalhistory' || $currentPath == 'patientprevioustreatment') class="active" @endif >
                                            <a href="#" id="patient-menu">
                                            <i class="fa fa-user" aria-hidden="true"></i>
             
                                           <!--  <img src="assets/images/Patient.png"> -->
                                                Dashboard
                                            </a>
                                        </li>
                                        
                                    </ul>
                                </div>
                            </div>

                        <!-- end: LOGO -->
                        @endif

                        @if($currentPath=='patientprofilemanagement' || $currentPath=='patientprofileprevtreatment' || $currentPath=='patientprofileedit')

                        <li class="dropdown current-user">
                            <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" data-close-others="true" href="#">
                                <img src="assets/images/avatar-1-small.jpg" class="circle-img" alt="">
                                <span class="username">{{$patientName}}</span>
                                <i class="clip-chevron-down"></i>
                            </a>
                            <ul class="dropdown-menu">
                                
                                    <li>
                                        <a href="patientprofileedit">
                                            <i class="clip-user-2"></i>
                                            &nbsp;My Profile
                                        </a>
                                    </li>
                                    
                                    <li>
                                        <a href="patientchangepassword">
                                            <i class="clip-calendar"></i>
                                            &nbsp;Change Password
                                        </a>
                                    </li>
                              
                                <!--
                                <li>
                               
                                    <a href="pages_messages.html">
                                        <i class="clip-bubble-4"></i>
                                        &nbsp;My Messages (3)
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="utility_lock_screen.html"><i class="clip-locked"></i>
                                        &nbsp;Lock Screen </a>
                                </li> -->
                                <li>
                                    <a href="patientlogout">
                                        <i class="clip-exit"></i>
                                        &nbsp;Log Out
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endif
                        <!-- end: USER DROPDOWN -->
                        <!-- start: PAGE SIDEBAR TOGGLE -->
                        <!-- <li>
                            <a class="sb-toggle" href="#"><i class="fa fa-outdent"></i></a>
                        </li> -->
                        <!-- end: PAGE SIDEBAR TOGGLE -->
                    </ul>
                    @endif
                    <!-- end: TOP NAVIGATION MENU -->
                </div>
        </div>
    </div>
    <div class="main-container">
            <div class="navbar-content">
                <div class="main-navigation navbar-collapse collapse" style="position:fixed">
                    <!-- start: MAIN MENU TOGGLER BUTTON -->
                    <div class="navigation-toggler">
                        <i class="clip-chevron-left"></i>
                        <i class="clip-chevron-right"></i>
                    </div>
                    @if($currentPath == 'patientpersonalinformation' || $currentPath == 'patientobstetricshistory' || $currentPath == 'patientmedicalhistory' || $currentPath == 'patientprevioustreatment' || $currentPath == 'cardiomedicalhistory')
                    <!-- Patient side menu starts -->
                    <div id="patient-side-menu">
                        <ul class="main-navigation-menu">
                            <li  @if($currentPath == 'patientpersonalinformation') class="active open" @endif>
                                <a href="patientpersonalinformation">
                              <!--    <i class="clip-home-3"></i> --> 
                                 <span class="dd_input_icon_patientpersonalinformation"></span>
                                    <span class="title"> Personal Information </span><span class="selected"></span>
                                </a>
                            </li>
                            
                            @if($specialization == 1)
                                <li  @if($currentPath == 'patientobstetricshistory') class="active open" @endif>
                                    <a href="patientobstetricshistory"> 
                                        <span class="dd_input_icon_Obstetrics"></span>
                                        <span class="title"> Obstetrics History </span><span class="selected"></span>
                                    </a>
                                </li>
                                <li  @if($currentPath == 'patientmedicalhistory') class="active open" @endif>
                                    <a href="patientmedicalhistory">
                                        <span class="dd_input_icon_Medical_History"></span>
                                        <span class="title"> Medical History </span><span class="selected"></span>
                                    </a>
                                </li>
                                <li  @if($currentPath == 'patientprevioustreatment') class="active open" @endif>
                                    <a href="patientprevioustreatment">
                                        <span class="dd_input_icon_Previous_Treatments"></span>
                                        <span class="title"> Previous Treatments </span>
                                        <span class="selected"></span>
                                    </a>
                                </li>
                            @elseif($specialization == 2)
                                 <li  @if($currentPath == 'cardiomedicalhistory') class="active open" @endif>
                                    <a href="cardiomedicalhistory">
                                        <span class="dd_input_icon_Medical_History"></span>
                                        <span class="title"> Medical History </span><span class="selected"></span>
                                    </a>
                                </li> 
                                <li  @if($currentPath == 'patientprevioustreatment') class="active open" @endif>
                                    <a href="patientprevioustreatment">
                                        <span class="dd_input_icon_Previous_Treatments"></span>
                                        <span class="title"> Previous Treatments </span>
                                        <span class="selected"></span>
                                    </a>
                                </li> 

                            @endif    
                        </ul>
                    </div>
                    @endif
                    <!-- Patient side menu ends --> 

                    <!-- Diagnosis side menu starts -->
                    @if(($currentPath == 'patientexamination') || ($currentPath == 'patientdiagnosis') ||       ($currentPath == 'patientlabdata'))
                    <!-- Diagbreadcrumbmenu"> -->
                    <div id="diagnosis-side-menu">
                        <ul class="main-navigation-menu">
                            <li @if($currentPath == 'patientexamination') class="active open" @endif>
                                <a href="patientexamination">
                               <!--  <i class="clip-home-3"></i>  -->
                                <span class="dd_input_icon_Examination"></span>
                                    <span class="title"> Examination </span><span class="selected"></span>
                                </a>
                            </li>
                            <li @if($currentPath == 'patientlabdata') class="active open" @endif>
                                <a href="patientlabdata">
                              <!--   <i class="clip-home-3"></i> -->
                                <span class="dd_input_icon_Lab_Data"></span>
                                    <span class="title"> Lab Data </span><span class="selected"></span>
                                </a>
                            </li>
                             <li @if($currentPath == 'patientdiagnosis') class="active open" @endif>
                                <a href="patientdiagnosis">
                               <!--  <i class="clip-home-3"></i> -->
                                 <span class="dd_input_icon_Diagnosis"></span>
                                    <span class="title"> Diagnosis </span><span class="selected"></span>
                                </a>
                            </li>
                    
                        </ul>
                    </div>
                    @endif   
                    <!-- Diagnosis side menu ends --> 

                    <!-- Prescription side menu starts -->
                    @if(($currentPath == 'patientprescmanagement') || ($currentPath == 'patientprescmedicine'))
                    <!-- Diagbreadcrumbmenu"> -->
                    <div id="diagnosis-side-menu">
                        <ul class="main-navigation-menu">
                            <li @if($currentPath == 'patientprescmanagement') class="active open" @endif>
                                <a href="patientprescmanagement">
                                <!-- <i class="clip-home-3"></i> -->
                                 <span class="dd_input_icon_Management"></span>
                                    <span class="title"> Management </span><span class="selected"></span>
                                </a>
                            </li>
                            <li @if($currentPath == 'patientprescmedicine') class="active open" @endif>
                                <a href="patientprescmedicine">
                              <!--   <i class="clip-home-3"></i> -->
                               <span class="dd_input_icon_Medicine"></span>
                                    <span class="title"> Medicine </span><span class="selected"></span>
                                </a>
                            </li>
                            <!--  <li @if($currentPath == 'patientdiagnosis') class="active open" @endif>
                                <a href="patientdiagnosis"><i class="clip-home-3"></i>
                                    <span class="title"> Diagnosis </span><span class="selected"></span>
                                </a>
                            </li> -->
                    
                        </ul>
                    </div>
                    @endif   
                    <!-- Diagnosis side menu ends -->     



                    <!-- Patient Prfofile Management side menu starts -->
                    @if(($currentPath == 'patientprofilemanagement') || ($currentPath == 'patientprofileprevtreatment') || ($currentPath == 'patientprofileedit'))
                    <!-- Diagbreadcrumbmenu"> -->
                    <div id="diagnosis-side-menu">
                        <ul class="main-navigation-menu">
                            <li @if($currentPath == 'patientprofilemanagement' || $currentPath == 'patientprofileedit') class="active open" @endif>
                                <a href="patientprofilemanagement">
                                <!-- <i class="clip-home-3"></i> -->
                                 <span class="dd_input_icon_Management"></span>
                                    <span class="title"> Personal Information </span><span class="selected"></span>
                                </a>
                            </li>
                            <li @if($currentPath == 'patientprofileprevtreatment') class="active open" @endif>
                                <a href="patientprofileprevtreatment">
                              <!--   <i class="clip-home-3"></i> -->
                               <span class="dd_input_icon_Medicine"></span>
                                    <span class="title"> Previous Treatments </span><span class="selected"></span>
                                </a>
                            </li>
                            <!--  <li @if($currentPath == 'patientdiagnosis') class="active open" @endif>
                                <a href="patientdiagnosis"><i class="clip-home-3"></i>
                                    <span class="title"> Diagnosis </span><span class="selected"></span>
                                </a>
                            </li> -->
                    
                        </ul>
                    </div>
                    @endif   
                    <!-- Diagnosis side menu ends -->  



                </div>    
            </div>
            <div class="main-content">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <ol class="breadcrumb dd_breadcrumb">
                                <div class="col-sm-8">
                                    @if($currentPath == 'patientprofilemanagement' || $currentPath == 'patientprofileprevtreatment' || $currentPath == 'patientprofileedit')
                                    @else
                                        <a style="font-size: 14px;text-decoration: none;float: left">
                                            PATIENT ID : {{$patientId}}
                                           
                                        </a>
                                    @endif
                                </div>
                                <div class="">
                                    <a style="font-size: 14px;text-decoration: none;float: right">
                                            
                                            PATIENT NAME : {{$patientName}}
                                    </a>
                                    <!-- <a style="font-size: 14px;float:right;text-decoration: none">TODAY : {{$todayDate}}</a> -->
                                </div>
                                <!-- <li>
                                    <i class="clip-home-3"></i>
                                    <a href="#">
                                        Home
                                    </a>
                                </li>
                                <li>
                                   
                                    <a href="patientpersonalinformation">
                                        Patient
                                    </a>
                                </li>
                                <li class="active">
                                    @if($currentPath == 'patientpersonalinformation')  Personal Information @endif
                                    @if($currentPath == 'patientobstetricshistory')    Obstetrics History  @endif
                                    @if($currentPath == 'patientmedicalhistory')       Medical History     @endif
                                    @if($currentPath == 'patientprevioustreatment')    Previous Treatments @endif
                                    
                                </li> -->
                               <!--  <li class="search-box">
                                    <form class="sidebar-search">
                                        <div class="form-group">
                                            <img src="assets/images/humanbody.png">
                                            <input type="submit" value="Humanbody">
                                        </div>
                                    </form>
                                </li> -->
                            </ol>
                            @yield('main')
                        </div>
                    </div>    
                </div>

            </div>

    </div>        
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
  <script>
    $.ajaxSetup({
       headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
    });
  </script>
  
</body>
</html>