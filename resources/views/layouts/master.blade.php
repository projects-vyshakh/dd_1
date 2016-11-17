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
     @if($currentPath=="patientpersonalinformation" || $currentPath=="cardiopersonalinformation")<title>Patient Personal Information</title> @endif
    @if($currentPath=="patientobstetricshistory")<title>Patient Obstetrics History</title> @endif
    @if($currentPath=="patientmedicalhistory" || $currentPath=="cardiomedicalhistory")<title>Patient Medical History</title> @endif
    @if($currentPath=="patientprevioustreatment" || $currentPath == 'cardioprevioustreatment')<title>Patient Previous Treatments</title> @endif
    @if($currentPath=="patientexamination" || $currentPath == 'cardioexamination')<title>Patient Examination</title> @endif
    @if($currentPath=="patientlabdata" || $currentPath == 'cardiolabdata')<title>Patient Lab Data</title> @endif
    @if($currentPath=="patientdiagnosis" || $currentPath == 'cardiodiagnosis')<title>Patient Diagnosis</title> @endif
    @if($currentPath=="patientprescmanagement")<title>Patient Prescription Management</title> @endif
    @if($currentPath=="patientprescmedicine")<title>Patient Medicinal Prescription</title> @endif
    @if($currentPath=="printsetup")<title>Settings</title> @endif

    @if($currentPath=="patientprofilemanagement")<title>Patient Profile Management</title> @endif
    @if($currentPath=="patientprofileedit")<title>Patient Profile Edit</title> @endif
    @if($currentPath=="patientprofileprevtreatment")<title>Patient Previous Treatment</title> @endif
    @if($currentPath=="patientchangepassword")<title>Patient Change Password</title> @endif

    @if($currentPath=="userhome")<title>Home</title> @endif
    @if($currentPath=="userjsonimport")<title>Import</title> @endif
    
    {!!Html::style('assets/plugins/bootstrap/css/bootstrap.min.css')!!}
    
    {!!Html::style('assets/fonts/style.css')!!}
    {!!Html::style('assets/plugins/font-awesome/css/font-awesome.min.css')!!}
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
                @if($currentPath=='patientprofilemanagement' || $currentPath=='patientprofileprevtreatment' || $currentPath=='patientprofileedit' || $currentPath=='patientchangepassword')
                @else
                <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
                    <span class="clip-list-2"></span>
                </button>
                @endif
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
                            <li id="patient-top-menu-li"  @if($currentPath == 'patientpersonalinformation' || $currentPath == 'patientobstetricshistory' || $currentPath == 'patientmedicalhistory' || $currentPath == 'patientprevioustreatment' || $currentPath == 'cardiopersonalinformation' || $currentPath == 'cardiomedicalhistory' || $currentPath == 'cardioprevioustreatment') class="active" @endif >

                            @if($specialization==1)
                                <a href="patientpersonalinformation" id="patient-menu">
                                 <i class="icon pricon icon-pr-patient" ng-show="navOption.key"></i>
                               <!--  <img src="assets/images/Patient.png"> -->

                               <span class="dd_menu_main_L">
                                    Patient

                                    </span>
                                </a>
                                <div class="dd_resp_menu" id="patient-menu-div">
                                    <ul class="sub-menu" style="display:block">
                                        <li>
                                            <a href="patientpersonalinformation">
                                                <span class="title"> Personal Information </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="patientobstetricshistory">
                                                <span class="title"> Obstetrics History </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="patientmedicalhistory">
                                                <span class="title"> Medical History </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="patientprevioustreatment">
                                                <span class="title"> Prevoious Treatments </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            @elseif($specialization==2)
                                 <a href="cardiopersonalinformation" id="patient-menu">
                                 <i class="icon pricon icon-pr-patient" ng-show="navOption.key"></i>
                               <!--  <img src="assets/images/Patient.png"> -->
                                       <span class="dd_menu_main_L">
                                    Patient

                                    </span>
                                </a>
                                <div class="dd_resp_menu" id="patient-menu-div">
                                    <ul class="sub-menu" style="display:block">
                                        <li>
                                            <a href="patientpersonalinformation">
                                                <span class="title"> Personal Information </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="patientobstetricshistory">
                                                <span class="title"> Obstetrics History </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="patientmedicalhistory">
                                                <span class="title"> Medical History </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="patientprevioustreatment">
                                                <span class="title"> Prevoious Treatments </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            @endif
                            </li>
                            
                            <li id="diagnosis-top-menu-li" @if($currentPath == 'patientexamination' || $currentPath == 'patientlabdata' || $currentPath == 'patientdiagnosis' || $currentPath == 'cardioexamination' || $currentPath == 'cardiolabdata' || $currentPath == 'cardiodiagnosis') class="active" @endif>
                            @if($specialization==1)
                                <a href="patientexamination" id="diagnosis-menu">
                                <!-- <img src="assets/images/Diagnosis.png"> -->
                                    <i class="icon pricon icon-pr-Diagnosis" ng-show="navOption.key"></i>
                                    
                                       <span class="dd_menu_main_L">
                                    Diagnosis

                                    </span>
                                </a>
                                <div class="dd_resp_menu" id="diagnosis-menu-div">
                                    <ul class="sub-menu" style="display:block">
                                        <li>
                                            <a href="patientexamination">
                                                <span class="title"> Examination </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="patientlabdata">
                                                <span class="title"> Lab Data </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="patientdiagnosis">
                                                <span class="title"> Diagnosis </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            @elseif($specialization==2)
                                 <a href="cardioexamination" id="diagnosis-menu">
                                <!-- <img src="assets/images/Diagnosis.png"> -->
                                <i class="icon pricon icon-pr-Diagnosis" ng-show="navOption.key"></i>
                                <span class="dd_menu_main_L">
                                    Diagnosis
                               </span>


                                </a>
                                <div class="dd_resp_menu" id="diagnosis-menu-div">
                                    <ul class="sub-menu" style="display:block">
                                        <li>
                                            <a href="cardioexamination">
                                                <span class="title"> Examination </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="cardiolabdata">
                                                <span class="title"> Lab Data </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="cardiodiagnosis">
                                                <span class="title"> Diagnosis </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            @endif    
                            
                            </li>
                            <li id="presc-top-menu-li" @if($currentPath == 'patientprescmanagement' || $currentPath=='patientprescmedicine') class="active" @endif>
                                @if($specialization==1)
                                    <a href="patientprescmanagement" id="prescription-menu">
                                    <!-- <img src="assets/images/Diagnosis.png"> -->
                                        <i class="icon pricon icon-pr-prescriptions" ng-show="navOption.key"></i>

                                        
                                    <span class="dd_menu_main_L">
                                            Prescription

                                    </span>
                                    </a>
                                    <div class="dd_resp_menu" id="prescription-menu-div">
                                        <ul class="sub-menu" style="display:block">
                                            <li>
                                                <a href="patientprescmanagement">
                                                    <span class="title"> Management </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="patientprescmedicine">
                                                    <span class="title"> Medicine </span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                @elseif($specialization==2)
                                    <a href="patientprescmedicine" id="prescription-menu">
                                <!-- <img src="assets/images/Diagnosis.png"> -->
                                    <i class="icon pricon icon-pr-prescriptions" ng-show="navOption.key"></i>

                                       <span class="dd_menu_main_L">
                                            Prescription

                                    </span>
                                    </a>
                                    <div class="dd_resp_menu" id="prescription-menu-div">
                                        <ul class="sub-menu" style="display:block">
                                            <!-- <li>
                                                <a href="patientprescmanagement">
                                                    <span class="title"> Management </span>
                                                </a>
                                            </li> -->
                                            <li>
                                                <a href="patientprescmedicine">
                                                    <span class="title"> Medicine </span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                @endif
                            </li>
                            <li id="settings-top-menu-li" @if($currentPath == 'printsetup') class="active" @endif>


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
                 <!-- start: USER DROPDOWN -->
                        <li class="dropdown" style="list-style: none;">
                            <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" data-close-others="true" href="#">
                                <img src="assets/images/logo.png" height="40px" style="display:block">  
                                
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <!-- <a href="" class="dd_settings">
                                        <i class="clip-dd-user"></i>
                                        <span>&nbsp;My Profile</span>
                                    </a> -->
                                </li>
                                 <li>
                                    <a href="printsetup" class="dd_settings">
                                        <i class="clip-dd-settings"></i>
                                        <span>&nbsp;Settings</span>
                                    </a>
                                </li>
                                <!--<li>
                                    <a href="pages_messages.html">
                                        <i class="clip-bubble-4"></i>
                                        &nbsp;My Messages (3)
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="utility_lock_screen.html"><i class="clip-locked"></i>
                                        &nbsp;Lock Screen </a>
                                </li>
                                <li>
                                    <a href="login_example1.html">
                                        <i class="clip-exit"></i>
                                        &nbsp;Log Out
                                    </a>
                                </li> -->
                            </ul>
                        </li>
                        <!-- end: USER DROPDOWN -->
                   
                </div>
            @endif
               

            <div class="navbar-tools praji_nav">

                    <!-- start: TOP NAVIGATION MENU -->
                @if($currentPath!="patientpersonalinformation" &&$currentPath!="patientobstetricshistory" &&     $currentPath!="patientmedicalhistory" && $currentPath!="patientprevioustreatment" &&$currentPath!="patientexamination" &&$currentPath!="patientlabdata" && $currentPath!="patientdiagnosis" && $currentPath!="patientprescmanagement" && $currentPath!="patientprescmedicine" &&
                $currentPath!="cardiomedicalhistory" &&  $currentPath!="cardioexamination" &&  $currentPath!="cardiolabdata" &&  $currentPath!="cardiodiagnosis")
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


<!----------------------------------------------- Prajeesh remove notification------------------------------ -->

                 <!--        <li class="dropdown">
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
                        </li> -->
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
                                            <a href="#" id="patient-menu" class="dd_padding_left_50">
                                            <i class="dd_dashboard" aria-hidden="true"></i>
             
                                           <!--  <img src="assets/images/Patient.png"> -->
                                                Dashboard
                                            </a>
                                        </li>
                                        
                                    </ul>
                                </div>
                            </div>

                        <!-- end: LOGO -->
                        @endif

                        @if($currentPath=='patientprofilemanagement' || $currentPath=='patientprofileprevtreatment' || $currentPath=='patientprofileedit' || $currentPath=='patientchangepassword')

                        <li class="dropdown current-user">
                            <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" data-close-others="true" href="#">
                                <!-- <img src="assets/images/avatar-1-small.jpg" class="circle-img" alt=""> -->
                                <!-- <img src="assets/images/patient_profile_s.jpg" class="circle-img" alt="">
                                -->
                                <img src="assets/images/patients/{{$patientData->profile_image_large}}" alt="" height="30px" width="30px" class="circle-img">
                                <span class="username">{{strtoupper($patientName)}}</span>
                                <i class="clip-chevron-down"></i>
                            </a>
                            <ul class="dropdown-menu patient_settings" >
                                
                                    <li>
                                        <a href="patientprofileedit" class="dd_padding_left_50 My_Profile">
                                            <i class="dd_myprofile dd_myprofile_hover"></i>
                                            &nbsp;My Profile
                                        </a>
                                    </li>
                                    
                                    <li class="dd_relative">
                                        <a href="patientchangepassword" class="dd_padding_left_50 Change_Password">
                                            <i class="dd_change_password"></i>
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
                                <li class="dd_relative">
                                    <a href="patientlogout" class="dd_padding_left_50 Log_Out">
                                        <i class="dd_logout"></i>
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
                    @if($currentPath == 'patientpersonalinformation' || $currentPath == 'patientobstetricshistory' || $currentPath == 'patientmedicalhistory' || $currentPath == 'patientprevioustreatment' || $currentPath == 'cardiopersonalinformation' || $currentPath == 'cardiomedicalhistory' || $currentPath == 'cardioprevioustreatment' || $currentPath== 'printsetup')
                    <!-- Patient side menu starts -->
                    <div id="patient-side-menu">
                        <ul class="main-navigation-menu">
                            @if($specialization == 1)
                                <li  @if($currentPath == 'patientpersonalinformation') class="active open" @endif>
                                    <a href="patientpersonalinformation">
                                  <!--    <i class="clip-home-3"></i> --> 
                                     <span class="dd_input_icon_patientpersonalinformation"></span>
                                        <span class="title"> Personal Information </span><span class="selected"></span>
                                    </a>
                                </li>
                            
                            
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
                                 <li  @if($currentPath == 'cardiopersonalinformation') class="active open" @endif>
                                    <a href="cardiopersonalinformation">
                                  <!--    <i class="clip-home-3"></i> --> 
                                     <span class="dd_input_icon_patientpersonalinformation"></span>
                                        <span class="title"> Personal Information </span><span class="selected"></span>
                                    </a>
                                </li>
                                 <li  @if($currentPath == 'cardiomedicalhistory') class="active open" @endif>
                                    <a href="cardiomedicalhistory">
                                        <span class="dd_input_icon_Medical_History"></span>
                                        <span class="title"> Medical History </span><span class="selected"></span>
                                    </a>
                                </li> 
                                <li  @if($currentPath == 'cardioprevioustreatment') class="active open" @endif>
                                    <a href="cardioprevioustreatment">
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
                    @if(($currentPath == 'patientexamination') || ($currentPath == 'patientdiagnosis') || ($currentPath == 'patientlabdata' || $currentPath == 'cardioexamination' || $currentPath == 'cardiolabdata' || $currentPath == 'cardiodiagnosis'))

                    <!-- Diagbreadcrumbmenu"> -->
                        @if($specialization=="1")
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
                        @elseif($specialization=="2") 
                            <div id="diagnosis-side-menu">
                                <ul class="main-navigation-menu">
                                    <li @if($currentPath == 'cardioexamination') class="active open" @endif>
                                        <a href="cardioexamination">
                                       <!--  <i class="clip-home-3"></i>  -->
                                        <span class="dd_input_icon_Examination"></span>
                                            <span class="title"> Examination </span><span class="selected"></span>
                                        </a>
                                    </li>
                                    <li @if($currentPath == 'cardiolabdata') class="active open" @endif>
                                        <a href="cardiolabdata">
                                      <!--   <i class="clip-home-3"></i> -->
                                        <span class="dd_input_icon_Lab_Data"></span>
                                            <span class="title"> Lab Data </span><span class="selected"></span>
                                        </a>
                                    </li>
                                     <li @if($currentPath == 'cardiodiagnosis') class="active open" @endif>
                                        <a href="cardiodiagnosis">
                                       <!--  <i class="clip-home-3"></i> -->
                                         <span class="dd_input_icon_Diagnosis"></span>
                                            <span class="title"> Diagnosis </span><span class="selected"></span>
                                        </a>
                                    </li>
                            
                                </ul>
                            </div>
                        @endif  
                    @endif   
                    <!-- Diagnosis side menu ends --> 

                     <!-- User Side Menus Starts -->
                     @if(($currentPath == 'userhome' || $currentPath == 'userjsonimport'))
                         <div id="user-side-menu">
                            <ul class="main-navigation-menu">
                                <li @if($currentPath == 'userhome') class="active open" @endif>
                                    <a href="userpersonalinformation">
                                     <span class="dd_input_icon_Management"></span>
                                        <span class="title"> Personal Information </span><span class="selected"></span>
                                    </a>
                                </li>
                                <li @if($currentPath=='userjsonimport') class="active " @endif>
                                    <a href="javascript:void(0)">
                                  
                                        <span class="dd_input_icon_Medicine"></span>
                                        <span class="title"> Import </span><span class="selected"></span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li  @if($currentPath == 'userjsonimport') class="active open" @endif>
                                            <a href="userjsonimport">
                                                <span class="title"> Json Files </span>
                                                <!-- <span class="badge badge-new">new</span> -->
                                            </a>
                                        </li>
                                       
                                        
                                    </ul>        
                                </li>
                               
                        
                            </ul>
                        </div>
                    @endif

                    <!-- Prescription side menu starts -->
                    @if(($currentPath == 'patientprescmanagement') || ($currentPath == 'patientprescmedicine'))
                    <!-- Diagbreadcrumbmenu"> -->
                        @if($specialization=="1")
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
                        @elseif($specialization=="2")
                            <div id="diagnosis-side-menu">
                                <ul class="main-navigation-menu">
                                   
                                    <li @if($currentPath == 'patientprescmedicine') class="active open" @endif>
                                        <a href="patientprescmedicine">
                                      <!--   <i class="clip-home-3"></i> -->
                                       <span class="dd_input_icon_Medicine"></span>
                                            <span class="title"> Medicine </span><span class="selected"></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        @endif

                    @endif   
                    <!-- Diagnosis side menu ends -->     



                    <!-- Patient Prfofile Management side menu starts -->
                    @if(($currentPath == 'patientprofilemanagement') || ($currentPath == 'patientprofileprevtreatment') || ($currentPath == 'patientprofileedit' || $currentPath=='patientchangepassword'))
                    <!-- Diagbreadcrumbmenu"> -->
                    <div id="diagnosis-side-menu">
                        <ul class="main-navigation-menu">
                            <li @if($currentPath == 'patientprofilemanagement' || $currentPath == 'patientprofileedit' || $currentPath=='patientchangepassword') class="active open" @endif>
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
                                    @if($currentPath == 'patientprofilemanagement' || $currentPath == 'patientprofileprevtreatment' || $currentPath == 'patientprofileedit' || $currentPath == 'patientchangepassword')
                                    @else
                                        <a style="font-size: 14px;text-decoration: none;float: left">
                                            PATIENT ID: {{strtoupper($patientId)}}
                                           
                                        </a>
                                    @endif
                                </div>
                                <div class="">
                                    <a style="font-size: 14px;text-decoration: none;float: right">
                                            
                                            PATIENT NAME: {{strtoupper($patientName)}}
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
    {!!Html::script('assets/js/master.js')!!}
    
    <!-- end: MAIN JAVASCRIPTS -->
    

  <!-- /JAVASCRIPTS -->
  @show
  <script>
    $.ajaxSetup({
       headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
    });
    jQuery(document).ready(function() {
        masterElements.init();
    });
  </script>
  
</body>
</html>