<?php
//use Session;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

/*Route::get('home', 'HomeController@index');
*/


Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::get('blade', function () 
{ 
	return view('page',array('name' => 'The Raven'));
});

Route::get('helloworld',  array('as' => 'helloworld', 'uses' => 'PrintTestController@helloworld'));


// Login Controller
Route::get('doctor/signup',  array('as' => 'doctor/signup', 'uses' => 'LoginController@showDoctorRegister'));

Route::get('doctor/login',  array('as' => 'doctor/login', 'uses' => 'LoginController@showDoctorLogin'));

Route::get('doctor/logout',  array('as' => 'doctor/logout', 'uses' => 'LoginController@showLogout'));

Route::get('doctor/forgetpassword',  array('as' => 'doctor/forgetpassword', 'uses' => 'LoginController@showDoctorForgetPassword'));

Route::post('handleDoctorForgetPassword',  array('as' => 'handleDoctorForgetPassword', 'uses' => 'LoginController@handleDoctorForgetPassword'));

Route::get('doctor/verify',  array('as' => 'doctor/verify', 'uses' => 'LoginController@showDoctorOtpCheck'));

Route::post('handleDoctorForgetOtpCheck',  array('as' => 'handleDoctorForgetOtpCheck', 'uses' => 'LoginController@handleDoctorForgetOtpCheck'));

Route::get('doctor/newpassword',  array('as' => 'doctor/newpassword', 'uses' => 'LoginController@showDoctorAddNewPassword'));

Route::post('handleDoctorAddNewPassword',  array('as' => 'handleDoctorAddNewPassword', 'uses' => 'LoginController@handleDoctorAddNewPassword'));

Route::post('handleDoctorLogin', array('as' => 'handleDoctorLogin', 'uses' => 'LoginController@handleDoctorLogin')); 

Route::post('handleDoctorSignUp', array('as' => 'handleDoctorSignUp', 'uses' => 'LoginController@handleDoctorSignUp'));


Route::get('patient/login',  array('as' => 'patient/login', 'uses' => 'LoginController@showPatientLogin'));

Route::post('handlePatientLogin', array('as' => 'handlePatientLogin', 'uses' => 'LoginController@handlePatientLogin')); 

Route::get('patient/logout',  array('as' => 'patient/logout', 'uses' => 'LoginController@handlePatientLogout'));

Route::get('patient/signup',  array('as' => 'patient/signup', 'uses' => 'PatientController@showPatientOtpCheck'));

Route::get('patient/forgetpassword',  array('as' => 'patient/forgetpassword', 'uses' => 'LoginController@showPatientForgetPassword'));


Route::post('handlePatientForgetPassword',  array('as' => 'handlePatientForgetPassword', 'uses' => 'LoginController@handlePatientForgetPassword'));


Route::get('patient/verify',  array('as' => 'patient/verify', 'uses' => 'LoginController@showPatientOtpCheck'));

Route::post('handlePatientForgetOtpCheck',  array('as' => 'handlePatientForgetOtpCheck', 'uses' => 'LoginController@handlePatientForgetOtpCheck'));

Route::any('patient/setnewpassword',  array('as' => 'patient/setnewpassword', 'uses' => 'LoginController@showPatientAddNewPassword'));

Route::post('handlePatientAddNewPassword',  array('as' => 'handlePatientAddNewPassword', 'uses' => 'LoginController@handlePatientAddNewPassword'));


// GynController
Route::any('doctor/home',  array('before'=>'isDoctorLoggedIn','as' => 'doctor/home', 'uses' => 'DoctorController@showDoctorHome'));

Route::post('handleNewPatientId',  array('before'=>'isDoctorLoggedIn','as' => 'handleNewPatientId', 'uses' => 'DoctorController@handleNewPatientId'));

Route::post('handleOldPatientId',  array('before'=>'isDoctorLoggedIn','as' => 'handleOldPatientId', 'uses' => 'DoctorController@handleOldPatientId'));

Route::any('doctor/patientpersonalinformation',  array('before'=>'isDoctorLoggedIn','as' => 'doctor/patientpersonalinformation', 'uses' =>'DoctorController@showPatientPersonalInformation'));

Route::any('addPatientPersonalInformation', array('before'=>'isDoctorLoggedIn','as' => 'addPatientPersonalInformation', 'uses' => 'DoctorController@addPatientPersonalInformation'));

Route::any('doctor/patientobstetricshistory', array('before'=>'isDoctorLoggedIn','as'=>'doctor/patientobstetricshistory','uses'=>'DoctorController@showPatientObstetricsHistory'));

Route::any('addPatientObstetricsHistory', array('before'=>'isDoctorLoggedIn','as' => 'addPatientObstetricsHistory', 'uses' => 'DoctorController@addPatientObstetricsHistory'));

Route::any('doctor/patientmedicalhistory', array('before'=>'isDoctorLoggedIn','as'=>'doctor/patientmedicalhistory','uses'=>'DoctorController@showPatientMedicalHistory'));

Route::any('addPatientMedicalHistory', array('before'=>'isDoctorLoggedIn','as' => 'addPatientMedicalHistory', 'uses' => 'DoctorController@addPatientMedicalHistory'));

Route::any('doctor/patientprevioustreatment', array('before'=>'isDoctorLoggedIn','as'=>'doctor/patientprevioustreatment','uses'=>'DoctorController@showPatientPreviousTreatment'));

Route::any('patientprevioustreatmentextended', array('before'=>'isDoctorLoggedIn','as'=>'patientprevioustreatmentextended','uses'=>'DoctorController@patientPreviousTreatmentExtended'));

Route::any('getPrevPrescDoctorData', array('as'=>'getPrevPrescDoctorData','uses'=>'DoctorController@getPrevPrescDoctorData'));

Route::get('doctor/patientexamination', array('before'=>'isDoctorLoggedIn','as'=>'doctor/patientexamination','uses'=>'DoctorController@showPatientExamination'));

Route::post('addPatientExamination',  array('before'=>'isDoctorLoggedIn','as' => 'addPatientExamination', 'uses' => 'DoctorController@addPatientExamination'));

Route::get('doctor/patientlabdata', array('before'=>'isDoctorLoggedIn','as'=>'doctor/patientlabdata','uses'=>'DoctorController@showPatientLabdata'));

Route::get('doctor/patientdiagnosis', array('before'=>'isDoctorLoggedIn','as'=>'doctor/patientdiagnosis','uses'=>'DoctorController@showPatientDiagnosis'));

Route::post('addPatientDiagnosis',  array('before'=>'isDoctorLoggedIn','as' => 'addPatientDiagnosis', 'uses' => 'DoctorController@addPatientDiagnosis'));

Route::any('doctor/patientprescmanagement', array('before'=>'isDoctorLoggedIn','as'=>'doctor/patientprescmanagement','uses'=>'DoctorController@showPatientPrescManagement'));

Route::post('addPatientPrescManagement',  array('before'=>'isDoctorLoggedIn','as' => 'addPatientPrescManagement', 'uses' => 'DoctorController@addPatientPrescManagement'));

Route::get('doctor/patientprescmedicine', array('before'=>'isDoctorLoggedIn','as'=>'doctor/patientprescmedicine','uses'=>'DoctorController@showPatientPrescMedicine'));

Route::post('showPatientPrescMedicineAjax', array('before'=>'isDoctorLoggedIn','as'=>'showPatientPrescMedicineAjax','uses'=>'DoctorController@showPatientPrescMedicineAjax'));

Route::post('addPatientPrescMedicine',  array('before'=>'isDoctorLoggedIn','as' => 'addPatientPrescMedicine', 'uses' => 'DoctorController@addPatientPrescMedicine'));

Route::post('showPatientPrescMedicine',  array('before'=>'isDoctorLoggedIn','as' => 'showPatientPrescMedicine', 'uses' => 'DoctorController@showPatientPrescMedicine'));


// UtilityController
Route::get('prescriptionshare',  array('uses' => 'UtilityController@showPrescriptionShare'));

Route::any('error',  array('as' => 'error', 'uses' => 'UtilityController@showErrorPage'));

Route::any('getMedicineList',  array('as' => 'getMedicineList', 'uses' => 'UtilityController@getMedicineList'));

Route::get('doctor/patientprescmedicine/shared/{sharedId}', 'UtilityController@handleSharedPrescription');

Route::post('getState',  array('as' => 'getState', 'uses' => 'UtilityController@getState'));




// SettingsController
Route::any('patientprevioustreatmentprint', array('before'=>'isDoctorLoggedIn','as'=>'patientprevioustreatmentprint','uses'=>'SettingsController@patientPreviousTreatmentPrint'));

Route::any('doctor/printsetup',  array('before'=>'isDoctorLoggedIn','as' => 'printsetup', 'uses' => 'SettingsController@showPrintSetup')); 

Route::post('addPrintSettings',  array('before'=>'isDoctorLoggedIn','as' => 'addPrintSettings', 'uses' => 'SettingsController@addPrintSettings'));

Route::any('fetchprintsetupdata',  array('before'=>'isDoctorLoggedIn','as' => 'fetchprintsetupdata', 'uses' => 'SettingsController@fetchPrintSetupData')); 




//Patient Controlls
//------------------------------------------------------------

Route::any('patient/dashboard', array('as'=>'patient/dashboard','uses'=>'PatientController@showPatientDashboard'));

Route::any('patient/profile', array('as'=>'patient/profile','uses'=>'PatientController@showPatientProfile'));

Route::any('handlePatientProfile', array('as' => 'handlePatientProfile', 'uses' => 'PatientController@handlePatientProfile'));


Route::any('patient/previoustreatment', array('as'=>'patient/previoustreatment','uses'=>'PatientController@showPatientProfilePrevTreatment'));


Route::any('patient/changepassword', array('as'=>'patient/changepassword','uses'=>'PatientController@showPatientChangePassword'));

Route::any('handlePatientChangePassword', array('as'=>'handlePatientChangePassword','uses'=>'PatientController@handlePatientChangePassword'));

Route::post('handlePatientRegisterOtpCheck',  array('as' => 'handlePatientRegisterOtpCheck', 'uses' => 'PatientController@handlePatientRegisterOtpCheck'));


Route::get('patient/registerpassword',  array('as' => 'patient/registerpassword', 'uses' => 'PatientController@showPatientRegisterPassword'));




Route::get('patientregistercheckid', array('as' => 'patientregistercheckid', 'uses' => 'LoginController@showPatientIdCheckForActivate')); 




Route::post('handlePatientIdCheckForActivate', array('as' => 'handlePatientIdCheckForActivate','uses' => 'LoginController@handlePatientIdCheckForActivate'));

Route::get('patientsetnewpassword', array('before'=>'isPatientLoggedIn','as' => 'patientsetnewpassword', 'uses' => 'LoginController@showPatientSetNewPassword'));

Route::any('patientprofileprevioustreatmentextended', array('as'=>'patientprofileprevioustreatmentextended','uses'=>'PatientController@patientProfilePreviousTreatmentExtended'));



Route::post('handlePatientSetnewPassword', array('as' => 'handlePatientSetnewPassword', 'uses' => 'LoginController@handlePatientSetnewPassword'));




Route::post('handlePatientRegisterPassword',  array('as' => 'handlePatientRegisterPassword', 'uses' => 'PatientController@handlePatientRegisterPassword'));




Route::any('flushAllSessions',  array('before'=>'isDoctorLoggedIn','as' => 'flushAllSessions', 'uses' => 'DoctorController@flushAllSessions'));




Route::any('patientprofileprevtreatmentprint', array('as'=>'patientprofileprevtreatmentprint','uses'=>'SettingsController@patientProfilePrevTreatmentPrint'));




Route::any('patientprevioustreatmenttest', array('before'=>'isDoctorLoggedIn','as'=>'patientprevioustreatmenttest','uses'=>'DoctorController@showPatientPreviousTreatmentTest'));





Route::get('migration', array('before'=>'isDoctorLoggedIn','as'=>'migration','uses'=>'DoctorController@showMigration'));






//Cardio
//-------------------------------------------------------------------------
Route::any('doctor/cardiopersonalinformation', array('before'=>'isDoctorLoggedIn','as'=>'cardiopersonalinformation','uses'=>'CardiologyController@showCardioPersonalInformation'));

Route::any('addCardioPersonalInformation', array('as'=>'addCardioPersonalInformation','uses'=>'CardiologyController@addCardioPersonalInformation'));

Route::any('doctor/cardiomedicalhistory', array('before'=>'isDoctorLoggedIn','as'=>'doctor/cardiomedicalhistory','uses'=>'CardiologyController@showCardioMedicalHistory'));

Route::any('addCardioMedicalHistory', array('before'=>'isDoctorLoggedIn','as' => 'addCardioMedicalHistory', 'uses' => 'CardiologyController@addCardioMedicalHistory'));

Route::any('doctor/cardioexamination', array('before'=>'isDoctorLoggedIn','as' => 'doctor/cardioexamination', 'uses' => 'CardiologyController@showCardioExamination'));

Route::any('addCardiacExamination', array('as' => 'addCardiacExamination', 'uses' => 'CardiologyController@addCardiacExamination'));

Route::any('doctor/cardiodiagnosis', array('as' => 'doctor/cardiodiagnosis', 'uses' => 'CardiologyController@showCardiacDiagnosis'));

Route::any('addCardioDiagnosis', array('as' => 'addCardioDiagnosis', 'uses' => 'CardiologyController@addCardioDiagnosis'));

Route::any('doctor/cardiolabdata', array('as' => 'doctor/cardiolabdata', 'uses' => 'CardiologyController@showCardiacLabdata'));

Route::any('doctor/cardioprevioustreatment', array('before'=>'isDoctorLoggedIn','as' => 'doctor/cardioprevioustreatment', 'uses' => 'CardiologyController@showCardioPreviousTreatment'));

Route::any('cardioprevioustreatmentextended', array('before'=>'isDoctorLoggedIn','as'=>'cardioprevioustreatmentextended','uses'=>'CardiologyController@cardioPreviousTreatmentExtended'));


// Pediatrician Controllers
//-----------------------------------------------------------------------------------------
Route::any('doctor/pediapersonalinformation', array('before'=>'isDoctorLoggedIn','as'=>'doctor/pediapersonalinformation','uses'=>'PediatricsController@showPediaPersonalInformation'));

Route::any('addPediaPersonalInformation', array('before'=>'isDoctorLoggedIn','as'=>'addPediaPersonalInformation','uses'=>'PediatricsController@addPediaPersonalInformation'));

Route::any('doctor/pediaexamination', array('before'=>'isDoctorLoggedIn','as' => 'doctor/pediaexamination', 'uses' => 'PediatricsController@showPediaExamination'));

Route::any('addPediaExamination', array('before'=>'isDoctorLoggedIn','as' => 'addPediaExamination', 'uses' => 'PediatricsController@addPediaExamination'));


//PULMONOLOGY CONTROLLER
//-------------------------------------------------------------------------
Route::any('doctor/pulmopersonalinformation', array('before'=>'isDoctorLoggedIn','as'=>'pulmopersonalinformation','uses'=>'PulmonologyController@showPulmoPersonalInformation'));

Route::any('addPulmoPersonalInformation', array('as'=>'addPulmoPersonalInformation','uses'=>'PulmonologyController@addPulmoPersonalInformation'));

Route::any('doctor/pulmomedicalhistory', array('before'=>'isDoctorLoggedIn','as'=>'doctor/pulmomedicalhistory','uses'=>'PulmonologyController@showPulmoMedicalHistory'));

Route::any('addPulmoMedicalHistory', array('before'=>'isDoctorLoggedIn','as' => 'addPulmoMedicalHistory', 'uses' => 'PulmonologyController@addPulmoMedicalHistory')); 


//PATHOLOGY CONTROLLER
//-----------------------------------------------------------------------
Route::any('doctor/pathologypersonalinformation', array('before'=>'isDoctorLoggedIn','as'=>'doctor/pathologypersonalinformation','uses'=>'PathologyController@showPathologyPersonalInformation'));

Route::any('addPathologyPersonalInformation', array('before'=>'isDoctorLoggedIn','as'=>'addPathologyPersonalInformation','uses'=>'PathologyController@addPathologyPersonalInformation'));

Route::any('doctor/pathologyreportupload', array('before'=>'isDoctorLoggedIn','as'=>'doctor/pathologyreportupload','uses'=>'PathologyController@showPathologyReportUpload'));

Route::any('addPathologyReportUpload', array('before'=>'isDoctorLoggedIn','as'=>'addPathologyReportUpload','uses'=>'PathologyController@addPathologyReportUpload'));

Route::any('doctor/pathlabhistory', array('before'=>'isDoctorLoggedIn','as'=>'pathlabhistory','uses'=>'PathologyController@showPathlabHistory'));




//Admin controller
//----------------------------------------------------------

Route::any('admin/login', array('as'=>'admin/login','uses'=>'UserController@showUserLogin'));

Route::any('handleUserLogin', array('as'=>'handleUserLogin','uses'=>'UserController@handleUserLogin'));

Route::any('admin/home', array('as'=>'admin/home','uses'=>'UserController@showUserHome'));

Route::any('admin/patientsearch', array('as'=>'admin/patientsearch','uses'=>'UserController@showPatientSearch'));

Route::any('handleSearchPatient', array('as'=>'handleSearchPatient','uses'=>'UserController@handleSearchPatient'));


Route::any('admin/doctorsearch', array('as'=>'admin/doctorsearch','uses'=>'UserController@showDoctorSearch'));

Route::any('handleSearchDoctor', array('as'=>'handleSearchDoctor','uses'=>'UserController@handleSearchDoctor'));

Route::any('admin/doctorauthorize', array('as'=>'admin/doctorauthorize','uses'=>'UserController@showDoctorAuthorize'));

Route::any('handleDoctorAuthorize', array('as'=>'handleDoctorAuthorize','uses'=>'UserController@handleDoctorAuthorize'));

Route::any('handleDoctorStatusChange', 'UserController@handleDoctorStatusChange');

Route::any('admin/logout', array('as'=>'admin/logout','uses'=>'UserController@showUserLogout'));

//Print Controllers
Route::post('patientPrescPrint', array('before'=>'isDoctorLoggedIn','as'=>'patientPrescPrint','uses'=>'SettingsController@patientPrescPrint'));



//Disease Atlas controller
//----------------------------------------------------------
Route::any('diseaseatlas', array('as'=>'diseaseatlas','uses'=>'DiseaseAdminController@showDiseaseIndex'));

Route::any('viewdisease', array('as'=>'viewdisease','uses'=>'DiseaseAdminController@SearchDiseaseIndex'));

Route::any('diseaseatlas/admin', array('as'=>'adminlogin','uses'=>'DiseaseAdminController@showAdminLogin'));

Route::any('diseaseatlas/handleDiseaseAdminLogin', array('as'=>'handleDiseaseAdminLogin','uses'=>'DiseaseAdminController@handleDiseaseAdminLogin'));

Route::any('diseaseatlas/admin/home', array('as'=>'diseaseadminhome','uses'=>'DiseaseAdminController@showDiseaseAdminhome'));

Route::any('diseaseatlas/admin/adddisease', array('as'=>'adddisease','uses'=>'DiseaseAdminController@showAddDisease'));

Route::any('diseaseatlas/importdiseaserecord', array('as'=>'importdiseaserecord','uses'=>'DiseaseAdminController@handleImportDiseaseRecord'));

Route::get('diseaseatlas/admin/logout',  array('as' => 'logout', 'uses' => 'DiseaseAdminController@showLogout'));






//Services
//----------------------------------------------------------//




Route::post('diagnosisMigrationService', array('before'=>'auths','as' => 'diagnosisMigrationService', 'uses' => 'APIController@diagnosisMigrationService')); 

Route::any('patientMigrationService', array('as' => 'patientMigrationService', 'uses' => 'APIController@patientMigrationService')); 

Route::any('doctorMigrationService', array('as' => 'doctorMigrationService', 'uses' => 'APIController@doctorMigrationService')); 

Route::any('getCountryStateService', array('before'=>'auths','as' => 'getCountryStateService', 'uses' => 'APIController@getCountryStateService')); 

Route::any('doctorLoginService', array('before'=>'auths','as' => 'doctorLoginService', 'uses' => 'APIController@doctorLoginService'));

Route::any('deviceAuthenticationService', array('before'=>'auths','as' => 'deviceAuthenticationService', 'uses' => 'APIController@deviceAuthenticationService'));

Route::post('checkPatientExistService', array('before'=>'auths','as' => 'checkPatientExistService', 'uses' => 'APIController@checkPatientExistService'));

Route::post('getPatientPersonalInformationService', array('before'=>'auths','as' => 'getPatientPersonalInformationService', 'uses' => 'APIController@getPatientPersonalInformationService'));

Route::post('addPatientPersonalInformationService', array('before'=>'auths','as' => 'addPatientPersonalInformationService', 'uses' => 'APIController@addPatientPersonalInformationService'));

Route::post('getPatientData', array('before'=>'auths','as' => 'getPatientData', 'uses' => 'APIController@getPatientData'));

Route::post('getPatientObstetricsHistoryService', array('before'=>'auths','as' => 'getPatientObstetricsHistoryService', 'uses' => 'APIController@getPatientObstetricsHistoryService'));

Route::post('addPatientObstetricsHistoryService', array('before'=>'auths','as' => 'addPatientObstetricsHistoryService', 'uses' => 'APIController@addPatientObstetricsHistoryService'));

Route::post('addPatientMedicalHistoryService', array('before'=>'auths','as' => 'addPatientMedicalHistoryService', 'uses' => 'APIController@addPatientMedicalHistoryService'));

Route::post('getPatientMedicalHistoryService', array('before'=>'auths','as' => 'getPatientMedicalHistoryService', 'uses' => 'APIController@getPatientMedicalHistoryService'));

Route::post('getPatientPreviousTreatmentService', array('before'=>'auths','as' => 'getPatientPreviousTreatmentService', 'uses' => 'APIController@getPatientPreviousTreatmentService')); 

Route::post('addPatientExaminationService', array('before'=>'auths','as' => 'addPatientExaminationService', 'uses' => 'APIController@addPatientExaminationService')); 

Route::post('getPatientExaminationService', array('before'=>'auths','as' => 'getPatientExaminationService', 'uses' => 'APIController@getPatientExaminationService')); 

Route::post('addPatientDiagnosisService', array('before'=>'auths','as' => 'addPatientDiagnosisService', 'uses' => 'APIController@addPatientDiagnosisService')); 

Route::post('getPatientDiagnosisService', array('before'=>'auths','as' => 'getPatientDiagnosisService', 'uses' => 'APIController@getPatientDiagnosisService')); 

Route::post('addPatientPrescManagementService', array('before'=>'auths','as' => 'addPatientPrescManagementService', 'uses' => 'APIController@addPatientPrescManagementService')); 

Route::post('getPatientPrescManagementService', array('before'=>'auths','as' => 'getPatientPrescManagementService', 'uses' => 'APIController@getPatientPrescManagementService'));

Route::post('addPatientPrescMedicineService', array('before'=>'auths','as' => 'addPatientPrescMedicineService', 'uses' => 'APIController@addPatientPrescMedicineService')); 


Route::any('getPatientPrescMedicine', array('before'=>'auths','as' => 'getPatientPrescMedicine', 'uses' => 'APIController@getPatientPrescMedicine'));

Route::post('getMiscService', array('before'=>'auths','as' => 'getMiscService', 'uses' => 'APIController@getMiscService'));

//Route::any('auths', array('as' => 'auths', 'uses' => 'APIController@auths'));
Route::filter('auths',function(){
	//var_dump($_SERVER) ;
       if (empty($_SERVER['HTTP_KEY'])) {
           $_SERVER['HTTP_KEY'] = 0;
       }

       if ($_SERVER['HTTP_KEY'] != "12345") {
	           $error = array('status' => 'Error', 'msg' => 'Authentication Failed');
	           //$this->response($this->json($error), 401);
	           return response()->json($error) ;
       }


});

Route::filter('isDoctorLoggedIn',function(){
	
	$doctorId = Session::get('doctorId');
	//dd($doctorId);
	if(empty($doctorId)){
		return Redirect::to('doctor/login');
	}	
});

Route::filter('isPatientLoggedIn',function(){
	$patientId = Session::get('patientIdActivate');
		if(empty($patientId) || $patientId==" "){
			return Redirect::to('patient/login');
		
		}
});

Route::filter('isDoctorOtpCreated',function(){
	
	$otpCreated = Session::get('otp');
	
	if(empty($otpCreated) || $otpCreated==" "){
		return Redirect::to('doctor/login');
	}	
});