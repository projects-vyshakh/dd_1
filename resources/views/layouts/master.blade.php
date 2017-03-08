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
    <link rel="shortcut icon" href="../assets/images/logo-mob.png" type="image/x-icon">
    <!-- <meta content="authenticity_token" name="csrf-param"> -->
     @if($currentPath=="doctor/patientpersonalinformation" || 
         $currentPath=="doctor/cardiopersonalinformation")
         <title>Patient Personal Information</title> 
    @endif

    @if($currentPath == 'doctor/patientobstetricshistory')
        <title>Patient Obstetrics History</title>
    @endif

    @if($currentPath=="doctor/patientmedicalhistory" || 
        $currentPath=="doctor/cardiomedicalhistory")
        <title>Patient Medical History</title> 
    @endif

    @if($currentPath=="doctor/patientprevioustreatment" || 
        $currentPath == 'doctor/cardioprevioustreatment')
        <title>Patient Previous Treatments</title> 
    @endif


    @if($currentPath=="doctor/patientexamination" || 
        $currentPath == 'doctor/cardioexamination')
        <title>Patient Examination</title> 
    @endif

    @if($currentPath=="doctor/patientlabdata" || 
        $currentPath == 'doctor/cardiolabdata')
        <title>Patient Lab Data</title> 
    @endif

    @if($currentPath=="doctor/patientdiagnosis" || 
        $currentPath == 'doctor/cardiodiagnosis')
        <title>Patient Diagnosis</title> 
    @endif

    @if($currentPath=="doctor/patientprescmanagement")
        <title>Patient Prescription Management</title> 
    @endif

    @if($currentPath=="doctor/patientprescmedicine")
        <title>Patient Medicinal Prescription</title> 
    @endif

    @if($currentPath=="doctor/printsetup")<title>Settings</title> @endif

    @if($currentPath=="patient/dashboard")<title>Dashboard</title> @endif

    @if($currentPath=="patient/profile")<title>Personal Information </title> @endif

    @if($currentPath=="patient/previoustreatment")<title>Patient Previous Treatment</title> @endif

    @if($currentPath=="patient/changepassword")<title>Change Password</title> @endif

    
    <!-- Pediatrician -->
    @if($currentPath=="doctor/pediapersonalinformation")
        <title>Patient Personal Information</title> 
    @endif

    @if($currentPath=="doctor/pediaexamination")
        <title>Patient Examination</title> 
    @endif


    <!-- Pathology -->
    @if($currentPath=="doctor/pathologypersonalinformation")
        <title>Patient Personal Information</title> 
    @endif

    @if($currentPath=="doctor/pathologyreportupload")
        <title>Upload Patient Report</title> 
    @endif

    @if($currentPath=="doctor/pathlabhistory")
        <title>Lab History</title> 
    @endif

    <!-- Pulmo -->
    @if($currentPath=="doctor/pulmopersonalinformation")
         <title>Patient Personal Information</title> 
    @endif
    @if($currentPath=="doctor/pulmomedicalhistory" )
        <title>Patient Medical History</title> 
    @endif


    <!-- Admin -->
    @if($currentPath=="admin/home")<title>Home</title> @endif

    @if($currentPath=="admin/patientsearch")<title>Search Patients</title> @endif

    @if($currentPath=="admin/doctorsearch")<title>Search Doctors</title> @endif

    @if($currentPath=="admin/doctorauthorize")<title>Authorize Doctors</title> @endif


     <!-- Disease Admin -->
    @if($currentPath=="diseaseatlas/admin/home")<title>Admin Home</title> @endif
    @if($currentPath=="diseaseatlas/admin/adddisease")<title>Add Disease</title> @endif

    
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

</head>

<body >
    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="dd_container_dummy">
            <div class="navbar-header">


                <!-- RESPONSIVE MENU TOGGLER -->
                <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
                    <span class="clip-list-2"></span>
                </button>
                <!-- RESPONSIVE MENU TOGGLER -->


                <!--LOGO TOP LEFT ONLY FOR DOCTORS-->
                @if($currentPath    ==  'doctor/patientpersonalinformation' ||
                    $currentPath    ==  'doctor/patientobstetricshistory'   ||
                    $currentPath    ==  'doctor/patientmedicalhistory'      ||
                    $currentPath    ==  'doctor/patientprevioustreatment'   ||
                    $currentPath    ==  'doctor/patientexamination'         ||
                    $currentPath    ==  'doctor/patientlabdata'             ||
                    $currentPath    ==  'doctor/patientdiagnosis'           ||
                    $currentPath    ==  'doctor/patientprescmanagement'     ||
                    $currentPath    ==  'doctor/patientprescmedicine'       ||

                    $currentPath    ==  'doctor/cardiopersonalinformation'  ||
                    $currentPath    ==  'doctor/cardiomedicalhistory'       ||
                    $currentPath    ==  'doctor/cardioprevioustreatment'    ||
                    $currentPath    ==  'doctor/cardioexamination'          ||
                    $currentPath    ==  'doctor/cardiolabdata'              ||
                    $currentPath    ==  'doctor/cardiodiagnosis'            ||
                    $currentPath    ==  'doctor/cardioprescmanagement'      ||

                    $currentPath    ==  'doctor/pediapersonalinformation'   ||
                    $currentPath    ==  'doctor/pediaexamination'           ||

                    $currentPath    ==  'doctor/pathologypersonalinformation'   ||
                    $currentPath    ==  'doctor/pathologyreportupload'      ||

                    $currentPath    ==  'doctor/pulmopersonalinformation'  ||
                    $currentPath    ==  'doctor/pulmomedicalhistory'       ||
                    $currentPath    ==  'doctor/pathlabhistory'            ||

                    $currentPath    ==  'doctor/printsetup')

                   

                    <a class="navbar-brand" href="home">
                        <img src="../assets/images/home.png" height="38px" style="display:block">
                    </a>

                @endif
                 <!--LOGO TOP LEFT ONLY FOR DOCTORS ENDS-->




                <!-- TOP MENU STARTS -->
                <div class="nav navbar-left">
                    <div class="horizontal-menu navbar-collapse collapse">
                        <ul class="nav navbar-nav">

                            <!-- TOP PATIENT MENU-->
                            <li id="patient-top-menu-li"  
                                @if($currentPath == 'doctor/patientpersonalinformation' ||   
                                    $currentPath == 'doctor/patientobstetricshistory'   || 
                                    $currentPath == 'doctor/patientmedicalhistory'      || 
                                    $currentPath == 'doctor/patientprevioustreatment'   || 

                                    $currentPath == 'doctor/cardiopersonalinformation'  || 
                                    $currentPath == 'doctor/cardiomedicalhistory'       || 
                                    $currentPath == 'doctor/cardioprevioustreatment'    ||

                                    $currentPath == 'doctor/pediapersonalinformation'   ||

                                    $currentPath == 'doctor/pathologypersonalinformation' ||
                                    $currentPath == 'doctor/pathologyreportupload' ||
                                    $currentPath ==  'doctor/pathlabhistory'            ||

                                    $currentPath == 'doctor/pulmopersonalinformation'   ||
                                    $currentPath == 'doctor/pulmomedicalhistory' )   
                                    
                                    class="active" 
                                @endif >

                                @if($specialization==1)
                                    <a href="patientpersonalinformation" id="patient-menu">
                                        <i class="icon pricon icon-pr-patient" ng-show="navOption.key"></i>
                                        <span class="dd_menu_main_L">Patient</span>
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
                                        <span class="dd_menu_main_L">Patient</span>
                                    </a>
                                    <div class="dd_resp_menu" id="patient-menu-div">
                                        <ul class="sub-menu" style="display:block">
                                            <li>
                                                <a href="cardiopatientpersonalinformation">
                                                    <span class="title"> Personal Information </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="cardiomedicalhistory">
                                                    <span class="title"> Medical History </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="cardioprevioustreatment">
                                                    <span class="title"> Prevoious Treatments </span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                @elseif($specialization==3)
                                    <a href="pediapersonalinformation" id="patient-menu">
                                        <i class="icon pricon icon-pr-patient" ng-show="navOption.key"></i>
                                        <span class="dd_menu_main_L">Patient</span>
                                    </a>
                                    <div class="dd_resp_menu" id="patient-menu-div">
                                        <ul class="sub-menu" style="display:block">
                                            <li>
                                                <a href="pediapersonalinformation">
                                                    <span class="title"> Personal Information </span>
                                                </a>
                                            </li>


                                        </ul>
                                    </div>
                                 @elseif($specialization==4)
                                    <a href="pulmopersonalinformation" id="patient-menu">
                                        <i class="icon pricon icon-pr-patient" ng-show="navOption.key"></i>
                                        <span class="dd_menu_main_L">Patient</span>
                                    </a>
                                    <div class="dd_resp_menu" id="patient-menu-div">
                                        <ul class="sub-menu" style="display:block">
                                            <li>
                                                <a href="pulmopersonalinformation">
                                                    <span class="title"> Personal Information </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="pulmomedicalhistory">
                                                    <span class="title"> Medical History </span>
                                                </a>
                                            </li>
                                            
                                        </ul>
                                    </div>
                                @elseif($specialization==5) 
                                    <a href="pathologypersonalinformation" id="pathology-patient-menu">
                                        <i class="icon pricon icon-pr-patient" ng-show="navOption.key"></i>
                                        <span class="dd_menu_main_L">Patient</span>
                                    </a>
                                    <div class="dd_resp_menu" id="pathology-patient-menu-div">
                                        <ul class="sub-menu" style="display:block">
                                            <li>
                                                <a href="pathologypersonalinformation">
                                                    <span class="title"> Personal Information </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="pathlabhistory">
                                                    <span class="title"> Path Lab History </span>
                                                </a>
                                            </li>
                                             <li>
                                                <a href="pathologyreportupload">
                                                    <span class="title"> Upload Report </span>
                                                </a>
                                            </li>

                                        </ul>
                                    </div>
                                
                                
                                @endif
                            </li>
                            <!-- TOP PATIENT MENU ENDS -->

                            <!--TOP DIAGNOSIS MENU -->
                            <li id="diagnosis-top-menu-li" 
                                @if($currentPath == 'doctor/patientexamination' || 
                                    $currentPath == 'doctor/patientlabdata' || 
                                    $currentPath == 'doctor/patientdiagnosis' || 
                                    $currentPath == 'doctor/cardioexamination' || 
                                    $currentPath == 'doctor/cardiolabdata' || 
                                    $currentPath == 'doctor/cardiodiagnosis' || 
                                    $currentPath == 'doctor/pediaexamination') 
                                    class="active" 
                                @endif>
                                    @if($specialization==1)
                                        <a href="patientexamination" id="diagnosis-menu">
                                            <i class="icon pricon icon-pr-Diagnosis" ng-show="navOption.key"></i>
                                               <span class="dd_menu_main_L">Diagnosis</span>
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
                                            <i class="icon pricon icon-pr-Diagnosis" ng-show="navOption.key"></i>
                                                <span class="dd_menu_main_L">Diagnosis</span>
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
                                    
                                    @elseif($specialization==3)
                                        <a href="pediaexamination" id="diagnosis-menu">
                                            <i class="icon pricon icon-pr-Diagnosis" ng-show="navOption.key"></i>
                                                <span class="dd_menu_main_L"> Diagnosis</span>
                                        </a>
                                       <div class="dd_resp_menu" id="diagnosis-menu-div">
                                            <ul class="sub-menu" style="display:block">
                                                <li>
                                                    <a href="pediaexamination">
                                                        <span class="title"> Examination </span>
                                                    </a>
                                                </li>
                                                <!-- <li>
                                                    <a href="cardiolabdata">
                                                        <span class="title"> Lab Data </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="cardiodiagnosis">
                                                        <span class="title"> Diagnosis </span>
                                                    </a>
                                                </li> -->
                                            </ul>
                                        </div>
                                    @endif    
                            
                            </li>
                            <!-- TOP DIAGNOSIS ENDS -->


                            <!-- TOP PRESCRIPTION MENU -->
                            <li id="presc-top-menu-li" 
                                @if($currentPath    ==  'doctor/patientprescmanagement'     || 
                                    $currentPath    ==  'doctor/patientprescmedicine') 
                                    class="active" 
                                @endif>
                                    @if($specialization==1)
                                        <a href="patientprescmanagement" id="prescription-menu">
                                            <i class="icon pricon icon-pr-prescriptions" ng-show="navOption.key"></i>
                                                <span class="dd_menu_main_L"> Prescription</span>
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
                                            <i class="icon pricon icon-pr-prescriptions" ng-show="navOption.key"></i>
                                                <span class="dd_menu_main_L">Prescription</span>
                                        </a>
                                        <div class="dd_resp_menu" id="prescription-menu-div">
                                            <ul class="sub-menu" style="display:block">
                                                <li>
                                                    <a href="patientprescmedicine">
                                                        <span class="title"> Medicine </span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    @endif
                            </li>
                            <!-- TOP PRESCRIPTION MENU ENDS -->



                            
                        </ul>
                    </div>
                </div>






               
                

                <!-- Top Menu Starts-->
                @if(($currentPath =='patient/previoustreatment')  ||
                    ($currentPath=="patient/dashboard") ||    
                    ($currentPath =='patient/profile')     || 
                    ($currentPath=='patient/changepassword'))         
                    
                    
                @elseif($currentPath=="admin/home" || 
                        $currentPath=="admin/patientsearch" ||
                        $currentPath=="admin/doctorsearch" ||
                        $currentPath=="admin/doctorauthorize")
                    <div class="nav navbar-left">
                        <div class="horizontal-menu navbar-collapse collapse">
                            <ul class="nav navbar-nav">
                                <div class="dd_resp_menu" id="user_respo_menu" >
                                    <li id="user_respo_home_menu" @if($currentPath=="admin/home") class="active" @endif>
                                        <a href="home">
                                            <span class="dd_input_icon_dashboard"></span>
                                            <span class="title"> Dashboard </span>
                                        </a>
                                       
                                    </li>
                                  
                                    <li id="user_respo_patient_search_menu" @if($currentPath=="admin/patientsearch") class="active" @endif>
                                        <a href="patientsearch">
                                             <span class="dd_input_icon_search"></span>
                                            <span class="title"> Patient Search </span>
                                        </a>
                                       
                                    </li>
                                    <li id="user_respo_doctor_search_menu" @if($currentPath=="doctorsearch") class="active" @endif>
                                        <a href="doctorsearch">
                                             <span class="dd_input_icon_search"></span>
                                            <span class="title"> Doctor Search </span>
                                        </a>
                                       
                                    </li>
                                    <li id="user_respo_doctor_authorize_menu" @if($currentPath=="admin/doctorauthorize") class="active" @endif>
                                        <a href="doctorauthorize">
                                            <span class="dd_input_icon_authorize"></span>
                                            <span class="title"> Doctor Authorize </span>
                                        </a>
                                       
                                    </li>
                                </div>
                            </ul>
                        </div>
                    </div>
                @elseif($currentPath == 'diseaseatlas/admin/home' || $currentPath == 'diseaseatlas/admin/adddisease')
                    <div class="nav navbar-left">
                        <div class="horizontal-menu navbar-collapse collapse">
                            <ul class="nav navbar-nav">
                                <div class="dd_resp_menu" id="user_respo_menu" >
                                    <li id="user_respo_home_menu" @if($currentPath=="diseaseatlas/admin/home") class="active" @endif>
                                        <a href="home">
                                            <span class="dd_input_icon_dashboard"></span>
                                            <span class="title"> Dashboard </span>
                                        </a>
                                       
                                    </li>
                                    <li id="user_respo_home_menu"  @if($currentPath=="diseaseatlas/admin/adddisease") class="active" @endif>
                                        <a href="adddisease">
                                             <span class="dd_input_icon_dashboard"></span>
                                            <span class="title"> Add Disease </span>
                                        </a>
                                       
                                    </li>
                                </div>
                            </ul>
                        </div>
                    </div>
                @else
                

                <!-- end: LOGO -->
                @endif

            </div>


            <!-- RIGHT SIDE LOGO FOR DOCTORS -->
            @if($currentPath    ==  'doctor/patientpersonalinformation' ||
                $currentPath    ==  'doctor/patientobstetricshistory'   ||
                $currentPath    ==  'doctor/patientmedicalhistory'      ||
                $currentPath    ==  'doctor/patientprevioustreatment'   ||
                $currentPath    ==  'doctor/patientexamination'         ||
                $currentPath    ==  'doctor/patientlabdata'             ||
                $currentPath    ==  'doctor/patientdiagnosis'           ||
                $currentPath    ==  'doctor/patientprescmanagement'     ||
                $currentPath    ==  'doctor/patientprescmedicine'       ||

                $currentPath    ==  'doctor/cardiopersonalinformation'  ||
                $currentPath    ==  'doctor/cardiomedicalhistory'       ||
                $currentPath    ==  'doctor/cardioprevioustreatment'    ||
                $currentPath    ==  'doctor/cardioexamination'          ||
                $currentPath    ==  'doctor/cardiolabdata'              ||
                $currentPath    ==  'doctor/cardiodiagnosis'            ||
                $currentPath    ==  'doctor/cardioprescmanagement'      ||

                $currentPath    ==  'doctor/pediapersonalinformation'   ||
                $currentPath    ==  'doctor/pediaexamination'           ||

                $currentPath    ==  'doctor/pathologypersonalinformation'   ||
                $currentPath    ==  'doctor/pathologyreportupload'      ||
                $currentPath ==  'doctor/pathlabhistory'                ||

                 $currentPath   ==  'doctor/pulmopersonalinformation'  ||
                $currentPath    ==  'doctor/pulmomedicalhistory' ||
                
                $currentPath    ==  'doctor/printsetup')

                <div class="dd_main_logo">
                     <li class="dropdown" style="list-style: none;">
                        <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" data-close-others="true" href="#">
                            <img src="../assets/images/logo.png" height="40px" style="display:block">  
                            
                        </a>
                        <ul class="dropdown-menu">
                           <li>
                                <a href="printsetup" class="dd_settings">
                                    <i class="clip-dd-settings"></i>
                                    <span>&nbsp;Settings</span>
                                </a>
                            </li>
                            
                        </ul>
                    </li>
                </div>

            @endif
            <!-- RIGHT SIDE LOGO FOR DOCTORS ENDS -->


           
            <!-- RIGHT SIDE LOGO FOR DD ADMIN -->  
            @if($currentPath    ==  'admin/home'                ||
                $currentPath    ==  'admin/doctorsearch'        ||
                $currentPath    ==  'admin/patientsearch'       ||
                $currentPath    ==  'admin/doctorauthorize')

                <div class="dd_main_logo">
                    <li class="dropdown" style="list-style: none;">
                        <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle"  
                           data-close-others="true" href="#">
                            <img src="../assets/images/logo.png" height="40px" style="display:block">
                        </a>
                        <ul class="dropdown-menu">
                            
                             <li>
                                <a href="logout" class="dd_settings">
                                    <i class="dd_logout"></i>
                                    <span>&nbsp;Log Out</span>
                                </a>
                            </li>
                           
                        </ul>
                    </li>
                </div>

            @endif
            <!-- RIGHT SIDE LOGO FOR DD ADMIN ENDS -->  


            <!-- RIGHT SIDE LOGO FOR DISEASE ADMIN -->
            @if($currentPath    ==  'diseaseatlas/admin/home'       ||
                $currentPath    ==  'diseaseatlas/admin/adddisease')

                 <div class="dd_main_logo">
                    <li class="dropdown" style="list-style: none;">
                        <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle"  
                           data-close-others="true" href="#">
                            <img src="../../assets/images/logo.png" height="40px" style="display:block">
                        </a>
                        <ul class="dropdown-menu">
                            
                             <li>
                                <a href="logout" class="dd_settings">
                                    <i class="dd_logout"></i>
                                    <span>&nbsp;Log Out</span>
                                </a>
                            </li>
                           
                        </ul>
                    </li>
                </div>

            @endif
            <!-- RIGHT SIDE LOGO ENDS -->



            <div class="navbar-tools praji_nav">

                    <!-- start: TOP NAVIGATION MENU -->
                @if($currentPath!="doctor/patientpersonalinformation" &&        
                    $currentPath!="doctor/patientobstetricshistory" &&     
                    $currentPath!="doctor/patientmedicalhistory" && 
                    $currentPath!="doctor/patientprevioustreatment" && 
                    $currentPath!="doctor/patientexamination" && 
                    $currentPath!="doctor/patientlabdata" && 
                    $currentPath!="doctor/patientdiagnosis" && 
                    $currentPath!="doctor/patientprescmanagement" && 
                    $currentPath!="doctor/patientprescmedicine" &&
                    $currentPath!="doctor/cardiomedicalhistory" &&  
                    $currentPath!="doctor/cardioexamination" &&  
                    $currentPath!="doctor/cardiolabdata" &&  
                    $currentPath!="doctor/cardiodiagnosis" &&
                    $currentPath!="doctor/pathologypersonalinformation" &&
                    $currentPath!="doctor/pathologyreportupload")
                    <ul class="nav navbar-right">

                       

                        @if($currentPath=='patient/profile' ||
                            $currentPath=="patient/dashboard" ||     
                            $currentPath=='patient/previoustreatment' || 
                             
                            $currentPath=='patient/changepassword')

                        <li class="dropdown current-user">
                            <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" data-close-others="true" href="#">
                               <img src="../assets/images/patients/{{$patientData->profile_image_large}}" alt="" height="30px" width="30px" class="circle-img">
                                <span class="username">{{strtoupper($patientName)}}</span>
                                <i class="clip-chevron-down"></i>
                            </a>
                            <ul class="dropdown-menu patient_settings" >
                                
                                 
                                    
                                    <li class="dd_relative">
                                        <a href="changepassword" class="dd_padding_left_50 Change_Password">
                                            <i class="dd_change_password"></i>
                                            &nbsp;<span style="margin-left: 20px;">Change Password</span>
                                        </a>
                                    </li>
                              
                              
                                <li class="dd_relative">
                                    <a href="logout" class="dd_padding_left_50 Log_Out">
                                        <i class="dd_logout"></i>
                                        &nbsp;<span style="margin-left: 20px;">Log Out</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endif
                       
                    </ul>
                    @endif
                    <!-- end: TOP NAVIGATION MENU -->
                </div>
        </div>
    </div>


    <div class="main-container">

            <!-- SIDE MENUS -->
            <div class="navbar-content">
                <div class="main-navigation navbar-collapse collapse" style="position:fixed">
                    <!-- start: MAIN MENU TOGGLER BUTTON -->
                    <div class="navigation-toggler">
                        <i class="clip-chevron-left"></i>
                        <i class="clip-chevron-right"></i>
                    </div>


                    <!-- PATIENT SIDE MENU STARTS-->
               

                    @if($currentPath == 'doctor/patientpersonalinformation' || 
                        $currentPath == 'doctor/patientobstetricshistory' || 
                        $currentPath == 'doctor/patientmedicalhistory' || 
                        $currentPath == 'doctor/patientprevioustreatment' || 
                        $currentPath == 'doctor/cardiopersonalinformation' || 
                        $currentPath == 'doctor/cardiomedicalhistory' || 
                        $currentPath == 'doctor/cardioprevioustreatment' || 
                        $currentPath == 'doctor/pediapersonalinformation' ||
                        $currentPath == 'doctor/pathologypersonalinformation' ||
                        $currentPath == 'doctor/pathologyreportupload' ||
                        $currentPath ==  'doctor/pathlabhistory'     ||
                        $currentPath == 'doctor/pulmopersonalinformation' ||
                        $currentPath == 'doctor/pulmomedicalhistory' ||
                        $currentPath == 'doctor/printsetup')


                        @if($currentPath == 'doctor/printsetup')
                           
                            <div id="patient-side-menu">
                                <ul class="main-navigation-menu">
                                    <li  @if($currentPath == 'doctor/printsetup') class="active open" @endif>
                                        <a href="printsetup">
                                            <span class="dd_input_icon_Previous_Treatments"></span>
                                            <span class="title"> Print Settings </span>
                                            <span class="selected"></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        @else
                           
                            <div id="patient-side-menu">
                                <ul class="main-navigation-menu">

                                    <!-- Gynaecology Specialization -->
                                    @if($specialization == 1)
                                        <li  @if($currentPath == 'doctor/patientpersonalinformation') class="active open" @endif>
                                            <a href="patientpersonalinformation">
                                          <!--    <i class="clip-home-3"></i> --> 
                                             <span class="dd_input_icon_patientpersonalinformation"></span>
                                                <span class="title"> Personal Information </span><span class="selected"></span>
                                            </a>
                                        </li>
                                    
                                    
                                        <li  @if($currentPath == 'doctor/patientobstetricshistory') class="active open" @endif>
                                            <a href="patientobstetricshistory"> 
                                                <span class="dd_input_icon_Obstetrics"></span>
                                                <span class="title"> Obstetrics History </span><span class="selected"></span>
                                            </a>
                                        </li>
                                        <li  @if($currentPath=='doctor/patientmedicalhistory') class="active open" @endif>
                                            <a href="patientmedicalhistory">
                                                <span class="dd_input_icon_Medical_History"></span>
                                                <span class="title"> Medical History </span><span class="selected"></span>
                                            </a>
                                        </li>
                                        <li  @if($currentPath == 'doctor/patientprevioustreatment') class="active open" @endif>
                                            <a href="patientprevioustreatment">
                                                <span class="dd_input_icon_Previous_Treatments"></span>
                                                <span class="title"> Previous Treatments </span>
                                                <span class="selected"></span>
                                            </a>
                                        </li>
                                    
                                    <!-- Cardio Specialization    -->
                                    @elseif($specialization == 2) 
                                         <li  @if($currentPath == 'doctor/cardiopersonalinformation') class="active open" @endif>
                                            <a href="cardiopersonalinformation">
                                          <!--    <i class="clip-home-3"></i> --> 
                                             <span class="dd_input_icon_patientpersonalinformation"></span>
                                                <span class="title"> Personal Information </span><span class="selected"></span>
                                            </a>
                                        </li>
                                         <li  @if($currentPath == 'doctor/cardiomedicalhistory') class="active open" @endif>
                                            <a href="cardiomedicalhistory">
                                                <span class="dd_input_icon_Medical_History"></span>
                                                <span class="title"> Medical History </span><span class="selected"></span>
                                            </a>
                                        </li> 
                                        <li  @if($currentPath == 'doctor/cardioprevioustreatment') class="active open" @endif>
                                            <a href="cardioprevioustreatment">
                                                <span class="dd_input_icon_Previous_Treatments"></span>
                                                <span class="title"> Previous Treatments </span>
                                                <span class="selected"></span>
                                            </a>
                                        </li> 

                                    <!-- Pedia Specialization -->
                                    @elseif($specialization == 3) 
                                        <li  @if($currentPath == 'doctor/pediapersonalinformation') class="active open" @endif>
                                            <a href="pediapersonalinformation">
                                          <!--    <i class="clip-home-3"></i> --> 
                                             <span class="dd_input_icon_patientpersonalinformation"></span>
                                                <span class="title"> Personal Information </span><span class="selected"></span>
                                            </a>
                                        </li>

                                     <!-- Pulmo Specialization    -->
                                    @elseif($specialization == 4)
                                         <li  @if($currentPath == 'doctor/pulmopersonalinformation') class="active open" @endif>
                                            <a href="pulmopersonalinformation">
                                          <!--    <i class="clip-home-3"></i> --> 
                                             <span class="dd_input_icon_patientpersonalinformation"></span>
                                                <span class="title"> Personal Information </span><span class="selected"></span>
                                            </a>
                                        </li>
                                         <li  @if($currentPath == 'doctor/pulmomedicalhistory') class="active open" @endif>
                                            <a href="pulmomedicalhistory">
                                                <span class="dd_input_icon_Medical_History"></span>
                                                <span class="title"> Medical History </span><span class="selected"></span>
                                            </a>
                                        </li> 

                                    @elseif($specialization == 5) 

                                        <li  @if($currentPath == 'doctor/pathologypersonalinformation') class="active open" @endif>
                                            <a href="pathologypersonalinformation">
                                          <!--    <i class="clip-home-3"></i> --> 
                                             <span class="dd_input_icon_patientpersonalinformation"></span>
                                                <span class="title"> Personal Information </span><span class="selected"></span>
                                            </a>
                                        </li>
                                        <li  @if($currentPath == 'doctor/pathlabhistory') class="active open" @endif>
                                            <a href="pathlabhistory">
                                          <!--    <i class="clip-home-3"></i> --> 
                                             <span class="dd_input_icon_patientpersonalinformation"></span>
                                                <span class="title"> Path Lab History </span><span class="selected"></span>
                                            </a>
                                        </li>
                                        <li  @if($currentPath == 'doctor/pathologyreportupload') class="active open" @endif>
                                            <a href="pathologyreportupload">
                                          <!--    <i class="clip-home-3"></i> --> 
                                             <span class="dd_input_icon_patientpersonalinformation"></span>
                                                <span class="title"> Upload Report </span><span class="selected"></span>
                                            </a>
                                        </li>
                                    

                                    @endif    
                                </ul>
                            </div>
                        @endif

                        
                    @endif
                    <!-- PATIENT SIDE MENU ENDS --> 

                    
                    <!-- DIAGNOSIS SIDE MENU STARTS -->
                    @if($currentPath == 'doctor/patientexamination' || 
                        $currentPath == 'doctor/patientdiagnosis' || 
                        $currentPath == 'doctor/patientlabdata' || 
                        $currentPath == 'doctor/cardioexamination' || 
                        $currentPath == 'doctor/cardiolabdata' || 
                        $currentPath == 'doctor/cardiodiagnosis' || 
                        $currentPath == 'doctor/pediaexamination')

                    
                        @if($specialization=="1")
                            <div id="diagnosis-side-menu">
                                <ul class="main-navigation-menu">
                                    <li @if($currentPath == 'doctor/patientexamination') class="active open" @endif>
                                        <a href="patientexamination">
                                       <!--  <i class="clip-home-3"></i>  -->
                                        <span class="dd_input_icon_Examination"></span>
                                            <span class="title"> Examination </span><span class="selected"></span>
                                        </a>
                                    </li>
                                    <li @if($currentPath == 'doctor/patientlabdata') class="active open" @endif>
                                        <a href="patientlabdata">
                                      <!--   <i class="clip-home-3"></i> -->
                                        <span class="dd_input_icon_Lab_Data"></span>
                                            <span class="title"> Lab Data </span><span class="selected"></span>
                                        </a>
                                    </li>
                                     <li @if($currentPath == 'doctor/patientdiagnosis') class="active open" @endif>
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
                                    <li @if($currentPath == 'doctor/cardioexamination') class="active open" @endif>
                                        <a href="cardioexamination">
                                       <!--  <i class="clip-home-3"></i>  -->
                                        <span class="dd_input_icon_Examination"></span>
                                            <span class="title"> Examination </span><span class="selected"></span>
                                        </a>
                                    </li>
                                    <li @if($currentPath == 'doctor/cardiolabdata') class="active open" @endif>
                                        <a href="cardiolabdata">
                                      <!--   <i class="clip-home-3"></i> -->
                                        <span class="dd_input_icon_Lab_Data"></span>
                                            <span class="title"> Lab Data </span><span class="selected"></span>
                                        </a>
                                    </li>
                                     <li @if($currentPath == 'doctor/cardiodiagnosis') class="active open" @endif>
                                        <a href="cardiodiagnosis">
                                       <!--  <i class="clip-home-3"></i> -->
                                         <span class="dd_input_icon_Diagnosis"></span>
                                            <span class="title"> Diagnosis </span><span class="selected"></span>
                                        </a>
                                    </li>
                            
                                </ul>
                            </div>
                            @elseif($specialization=="3") 
                            <div id="diagnosis-side-menu">
                                <ul class="main-navigation-menu">
                                    <li @if($currentPath == 'doctor/pediaexamination') class="active open" @endif>
                                        <a href="pediaexamination">
                                       <!--  <i class="clip-home-3"></i>  -->
                                        <span class="dd_input_icon_Examination"></span>
                                            <span class="title"> Examination </span><span class="selected"></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        @endif  
                    @endif   
                    <!-- DIAGNOSIS SIDE MENU ENDS --> 

                    

                    <!-- PRESCRIPTION SIDE MENU STARTS -->
                    @if(($currentPath == 'doctor/patientprescmanagement') || ($currentPath == 'doctor/patientprescmedicine'))
                   
                        @if($specialization=="1")
                            <div id="diagnosis-side-menu">
                                <ul class="main-navigation-menu">
                                    <li @if($currentPath == 'doctor/patientprescmanagement') class="active open" @endif>
                                        <a href="patientprescmanagement">
                                         <span class="dd_input_icon_Management"></span>
                                            <span class="title"> Management </span><span class="selected"></span>
                                        </a>
                                    </li>
                                    <li @if($currentPath == 'doctor/patientprescmedicine') class="active open" @endif>
                                        <a href="patientprescmedicine">
                                       <span class="dd_input_icon_Medicine"></span>
                                            <span class="title"> Medicine </span><span class="selected"></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        @elseif($specialization=="2")
                            <div id="diagnosis-side-menu">
                                <ul class="main-navigation-menu">
                                   
                                    <li @if($currentPath == 'doctor/patientprescmedicine') class="active open" @endif>
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
                    <!-- PRESCRIPTION SIDE MENU ENDS -->     



                    <!-- PATIENT PROFILE SIDE MENU STARTS -->
                    @if(($currentPath == 'patient/profile') || 
                        ($currentPath == 'patient/dashboard') ||
                        ($currentPath == 'patient/previoustreatment') || 
                        ($currentPath == 'patient/changepassword'))
                   
                            <div id="diagnosis-side-menu">
                                <ul class="main-navigation-menu">
                                    <li @if($currentPath == 'patient/dashboard') class="active open" @endif>
                                        <a href="dashboard">
                                            <span class="dd_input_icon_dashboard"></span>
                                            <span class="title"> Dashboard </span><span class="selected"></span>
                                        </a>
                                    </li>
                                    <li 
                                        @if($currentPath == 'patient/profile' ||
                                            $currentPath=='patient/changepassword') 
                                                class="active open" 
                                        @endif>
                                        <a href="profile">
                                        <!-- <i class="clip-home-3"></i> -->
                                         <span class="dd_input_icon_Management"></span>
                                            <span class="title"> Personal Information </span><span class="selected"></span>
                                        </a>
                                    </li>
                                    <li @if($currentPath == 'patient/previoustreatment') class="active open" @endif>
                                        <a href="previoustreatment">
                                      <!--   <i class="clip-home-3"></i> -->
                                       <span class="dd_input_icon_Medicine"></span>
                                            <span class="title"> Previous Treatments </span><span class="selected"></span>
                                        </a>
                                    </li>
                                   
                                </ul>
                            </div>
                    @endif   
                    <!-- PATIENT PROFILE SIDE MENU ENDS -->


                    <!-- DD ADMIN SIDE MENU STARTS -->
                   
                    @if($currentPath == 'admin/home' || 
                        $currentPath == 'admin/patientsearch' ||
                        $currentPath == 'admin/doctorsearch' ||
                        $currentPath == 'admin/authorize' ||
                        $currentPath == 'admin/doctorauthorize')
                        
                            <div id="user-side-menu">
                                <div class="user_side_menu_normal">
                                    <ul class="main-navigation-menu">
                                        <li @if($currentPath == 'admin/home') class="active open" @endif>
                                            <a href="home">
                                             <span class="dd_input_icon_dashboard"></span>
                                                <span class="title"> Dashboard </span><span class="selected"></span>
                                            </a>
                                        </li>
                                     
                                        <li @if($currentPath == 'admin/patientsearch' || 
                                                $currentPath == 'admin/doctorsearch') class="active" 
                                            @endif>
                                            <a href="javascript:void(0)">
                                                <span class="dd_input_icon_search"></span>
                                                <span class="title"> Search </span><span class="selected"></span>
                                                <span class="selected"></span>
                                            </a>
                                            <ul class="sub-menu">
                                                <li @if($currentPath == 'admin/patientsearch') class="active" @endif>
                                                    <a href="patientsearch">
                                                        <span class="title"> Patients </span>
                                                    </a>
                                                </li>
                                                <li @if($currentPath == 'doctorsearch') class="active" @endif>
                                                    <a href="doctorsearch">
                                                        <span class="title"> Doctors </span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li @if($currentPath == 'admin/doctorauthorize' ) class="active"  @endif>
                                           
                                            <a href="javascript:void(0)">
                                                <span class="dd_input_icon_authorize"></span>
                                                <span class="title"> Authorize </span><span class="selected"></span>
                                                    <span class="selected"></span>
                                            </a>
                                            <ul class="sub-menu">
                                                <li @if($currentPath == 'admin/doctorauthorize') class="active" @endif>
                                                    <a href="doctorauthorize">
                                                        <span class="title"> Doctors </span>
                                                    </a>
                                                </li>
                                                
                                            </ul>
                                        </li>

                                        <!-- PATIENT SIDE MENU RESPONSIVE MODE STARTS -->
                                        <!-- <li>
                                            <div class="respo" id="respo">
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
                                            </div>
                                       </li> -->
                                       <!-- PATIENT SIDE MENU RESPONSIVE MODE ENDS -->
                                



                                    </ul>
                                </div>
                               
                            </div>
                    @endif

                    <!-- DD ADMIN SIDE MENU ENDS HERE -->


                    <!-- DISEASE ATLAS ADMIN STARTS HERE -->

                    @if($currentPath == 'diseaseatlas/admin/home'|| $currentPath == 'diseaseatlas/admin/adddisease')
                       <div id="user-side-menu">
                            <div class="user_side_menu_normal">
                                <ul class="main-navigation-menu">
                                    <li @if($currentPath == 'diseaseatlas/admin/home') class="active open" @endif>
                                        <a href="home">
                                            <span class="dd_input_icon_dashboard"></span>
                                            <span class="title"> Dashboard </span><span class="selected"></span>
                                        </a>
                                    </li>
                                    <li <li @if($currentPath == 'diseaseatlas/admin/adddisease') class="active open" @endif>
                                        <a href="adddisease">
                                            <span class="dd_input_icon_dashboard"></span>
                                            <span class="title"> Add Disease </span><span class="selected"></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @endif
                    <!-- DISEASE ATLAS ADMIN ENDS HERE -->

                </div>    
            </div>
            <!-- SIDE MENU -->


            <div class="main-content">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <ol class="breadcrumb dd_breadcrumb">

                                <!-- PATIENT ID ON BREADCRUMBS -->
                                <div class="col-sm-8">

                                    @if($currentPath    ==  'doctor/patientpersonalinformation' ||
                                        $currentPath    ==  'doctor/patientobstetricshistory'   ||
                                        $currentPath    ==  'doctor/patientmedicalhistory'      ||
                                        $currentPath    ==  'doctor/patientprevioustreatment'   ||
                                        $currentPath    ==  'doctor/patientexamination'         ||
                                        $currentPath    ==  'doctor/patientlabdata'             ||
                                        $currentPath    ==  'doctor/patientdiagnosis'           ||
                                        $currentPath    ==  'doctor/patientprescmanagement'     ||
                                        $currentPath    ==  'doctor/patientprescmedicine'       ||

                                        $currentPath    ==  'doctor/cardiopersonalinformation'  ||
                                        $currentPath    ==  'doctor/cardiomedicalhistory'       ||
                                        $currentPath    ==  'doctor/cardioprevioustreatment'    ||
                                        $currentPath    ==  'doctor/cardioexamination'          ||
                                        $currentPath    ==  'doctor/cardiolabdata'              ||
                                        $currentPath    ==  'doctor/cardiodiagnosis'            ||
                                        $currentPath    ==  'doctor/cardioprescmanagement'      ||

                                        $currentPath    ==  'doctor/pediapersonalinformation'   ||
                                        $currentPath    ==  'doctor/pediaexamination'           ||

                                        $currentPath    ==  'doctor/pathologypersonalinformation' ||
                                        $currentPath    ==  'doctor/pathologyreportupload'      ||

                                        $currentPath    ==  'doctor/pulmopersonalinformation' ||
                                        $currentPath    ==  'doctor/pulmomedicalhistory' )
                                        
                                        
                                        <a style="font-size: 14px;text-decoration: none;float: left">
                                            PATIENT ID: {{strtoupper($patientId)}}
                                        </a>
                                    @endif

                                    @if($currentPath    ==  'admin/home' || 
                                        $currentPath    ==  'admin/patientsearch'  || 
                                        $currentPath    ==  'admin/doctorsearch' || 
                                        $currentPath    ==  'admin/doctorauthorize')

                                            <a style="font-size: 14px;text-decoration: none;float: left">
                                                USER ID: {{strtoupper($userId)}}
                                            </a>
                                    @endif
                                    
                                    @if($currentPath    ==  'diseaseatlas/admin/home'|| 
                                        $currentPath    ==  'diseaseatlas/admin/adddisease') 
                                        <a style="font-size: 14px;text-decoration: none;float: left">
                                            ADMIN ID: {{strtoupper($AdminId)}}
                                        </a> 
                                    @endif      
                                </div>
                                <!-- PATIENT ID BREADCRUMBS ENDS -->


                                <!-- PATIENT NAME BREADCRUMPS STARTS -->
                                <div class="">

                                   @if($currentPath     ==  'admin/home' || 
                                        $currentPath    ==  'admin/patientsearch' || 
                                        $currentPath    ==  'admin/doctorsearch' || 
                                        $currentPath    ==  'admin/doctorauthorize' ||  
                                        $currentPath    ==  'diseaseatlas/admin/home'|| 
                                        $currentPath    ==  'diseaseatlas/admin/adddisease')

                                            <a style="font-size: 14px;text-decoration: none;float: right">
                                                USER NAME: {{strtoupper($userName)}}
                                            </a>
                                    @endif

                                    @if($currentPath    ==  'doctor/patientpersonalinformation' ||
                                        $currentPath    ==  'doctor/patientobstetricshistory'   ||
                                        $currentPath    ==  'doctor/patientmedicalhistory'      ||
                                        $currentPath    ==  'doctor/patientprevioustreatment'   ||
                                        $currentPath    ==  'doctor/patientexamination'         ||
                                        $currentPath    ==  'doctor/patientlabdata'             ||
                                        $currentPath    ==  'doctor/patientdiagnosis'           ||
                                        $currentPath    ==  'doctor/patientprescmanagement'     ||
                                        $currentPath    ==  'doctor/patientprescmedicine'       ||

                                        $currentPath    ==  'doctor/cardiopersonalinformation'  ||
                                        $currentPath    ==  'doctor/cardiomedicalhistory'       ||
                                        $currentPath    ==  'doctor/cardioprevioustreatment'    ||
                                        $currentPath    ==  'doctor/cardioexamination'          ||
                                        $currentPath    ==  'doctor/cardiolabdata'              ||
                                        $currentPath    ==  'doctor/cardiodiagnosis'            ||
                                        $currentPath    ==  'doctor/cardioprescmanagement'      ||

                                        $currentPath    ==  'doctor/pediapersonalinformation'   ||
                                        $currentPath    ==  'doctor/pediaexamination'           ||

                                        $currentPath    ==  'doctor/pathologypersonalinformation' ||
                                        $currentPath    ==  'doctor/pathologyreportupload'      ||

                                        $currentPath    ==  'doctor/pulmopersonalinformation'   ||
                                        $currentPath    ==  'doctor/pulmomedicalhistory'        ||

                                        $currentPath    ==  'patient/dashboard'                 ||
                                        $currentPath    ==  'patient/profile'                   ||
                                        $currentPath    ==  'patient/previoustreatment')

                                        <a style="font-size: 14px;text-decoration: none;float: right" class="patient_name_res">
                                            PATIENT NAME: {{strtoupper($patientName)}}
                                        </a>
 
                                    @endif
                               
                             
                                </div>
                                <!-- PATIENT NAME BREADCRUMB ENDS -->

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
        //Main.init();
        masterElements.init();
    });
  </script>
  
</body>
</html>