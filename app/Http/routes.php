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

Route::get('doctorforgetpassword',  array('as' => 'doctorforgetpassword', 'uses' => 'LoginController@showDoctorForgetPassword'));
Route::post('handleDoctorForgetPassword',  array('as' => 'handleDoctorForgetPassword', 'uses' => 'LoginController@handleDoctorForgetPassword'));

Route::get('patientforgetpassword',  array('as' => 'patientforgetpassword', 'uses' => 'LoginController@showPatientForgetPassword'));
Route::post('handlePatientForgetPassword',  array('as' => 'handlePatientForgetPassword', 'uses' => 'LoginController@handlePatientForgetPassword'));

Route::get('doctorotpcheck',  array('as' => 'doctorotpcheck', 'uses' => 'LoginController@showDoctorOtpCheck'));
Route::post('handleDoctorForgetOtpCheck',  array('as' => 'handleDoctorForgetOtpCheck', 'uses' => 'LoginController@handleDoctorForgetOtpCheck'));


Route::get('patientotpcheck',  array('as' => 'patientotpcheck', 'uses' => 'LoginController@showPatientOtpCheck'));
Route::post('handlePatientForgetOtpCheck',  array('as' => 'handlePatientForgetOtpCheck', 'uses' => 'LoginController@handlePatientForgetOtpCheck'));


Route::get('doctoraddnewpassword',  array('as' => 'doctoraddnewpassword', 'uses' => 'LoginController@showDoctorAddNewPassword'));
Route::post('handleDoctorAddNewPassword',  array('as' => 'handleDoctorAddNewPassword', 'uses' => 'LoginController@handleDoctorAddNewPassword'));

Route::get('patientaddnewpassword',  array('as' => 'patientaddnewpassword', 'uses' => 'LoginController@showPatientAddNewPassword'));
Route::post('handlePatientAddNewPassword',  array('as' => 'handlePatientAddNewPassword', 'uses' => 'LoginController@handlePatientAddNewPassword'));



Route::get('doctorlogin',  array('as' => 'doctorlogin', 'uses' => 'LoginController@showDoctorLogin'));
Route::get('patientlogin',  array('as' => 'patientlogin', 'uses' => 'LoginController@showPatientLogin'));
Route::get('logout',  array('as' => 'logout', 'uses' => 'LoginController@showLogout'));
Route::get('doctorsignup',  array('as' => 'doctorsignup', 'uses' => 'LoginController@showDoctorRegister'));
Route::get('doctorsignupinformation',  array('as' => 'doctorsignupinformation', 'uses' => 'LoginController@showDoctorSignupInformation'));
Route::post('handleDoctorLogin', array('as' => 'handleDoctorLogin', 'uses' => 'LoginController@handleDoctorLogin')); 
Route::post('handleDoctorSignUp', array('as' => 'handleDoctorSignUp', 'uses' => 'LoginController@handleDoctorSignUp'));

//PATIENT DETAILS
Route::post('handlePatientLogin', array('as' => 'handlePatientLogin', 'uses' => 'LoginController@handlePatientLogin')); 
Route::get('patientlogout',  array('as' => 'patientlogout', 'uses' => 'LoginController@handlePatientLogout'));

Route::get('patientregistercheckid', array('as' => 'patientregistercheckid', 'uses' => 'LoginController@showPatientIdCheckForActivate')); 
Route::post('handlePatientIdCheckForActivate', array('as' => 'handlePatientIdCheckForActivate','uses' => 'LoginController@handlePatientIdCheckForActivate'));
/*Route::get('patientotpcheck', array('before'=>'isPatientLoggedIn','as' => 'patientotpcheck', 'uses' => 'LoginController@showPatientOtpCheck'));*/
/*Route::post('handlePatientOtpCheck', array('as' => 'handlePatientOtpCheck', 'uses' => 'LoginController@handlePatientOtpCheck'));*/

Route::get('patientsetnewpassword', array('before'=>'isPatientLoggedIn','as' => 'patientsetnewpassword', 'uses' => 'LoginController@showPatientSetNewPassword'));
Route::post('handlePatientSetnewPassword', array('as' => 'handlePatientSetnewPassword', 'uses' => 'LoginController@handlePatientSetnewPassword'));

//---------------------------------------------------------------------------------------------------------------

Route::any('doctorhome',  array('before'=>'isDoctorLoggedIn','as' => 'doctorhome', 'uses' => 'DoctorController@showDoctorHome'));
Route::post('patientIdSubmit',  array('before'=>'isDoctorLoggedIn','as' => 'patientIdSubmit', 'uses' => 'DoctorController@patientIdSubmit'));
/*
Route::get('doctordashboard',  array('as' => 'doctordashboard', 'uses' => 'HomeController@doctorDashboard'));
Route::get('patientinformation', 'DoctorController@showPatientInformation');*/


Route::any('patientpersonalinformation',  array('before'=>'isDoctorLoggedIn','as' => 'patientpersonalinformation', 'uses' =>'DoctorController@showPatientPersonalInformation'));
Route::any('addPatientPersonalInformation', array('before'=>'isDoctorLoggedIn','as' => 'addPatientPersonalInformation', 'uses' => 'DoctorController@addPatientPersonalInformation'));

Route::any('patientobstetricshistory', array('before'=>'isDoctorLoggedIn','as'=>'patientobstetricshistory','uses'=>'DoctorController@showPatientObstetricsHistory'));
Route::any('addPatientObstetricsHistory', array('before'=>'isDoctorLoggedIn','as' => 'addPatientObstetricsHistory', 'uses' => 'DoctorController@addPatientObstetricsHistory'));

Route::any('patientmedicalhistory', array('before'=>'isDoctorLoggedIn','as'=>'patientmedicalhistory','uses'=>'DoctorController@showPatientMedicalHistory'));
Route::any('addPatientMedicalHistory', array('before'=>'isDoctorLoggedIn','as' => 'addPatientMedicalHistory', 'uses' => 'DoctorController@addPatientMedicalHistory'));

Route::any('patientprevioustreatment', array('before'=>'isDoctorLoggedIn','as'=>'patientprevioustreatment','uses'=>'DoctorController@showPatientPreviousTreatment'));

Route::any('patientprevioustreatmentextended', array('before'=>'isDoctorLoggedIn','as'=>'patientprevioustreatmentextended','uses'=>'DoctorController@patientPreviousTreatmentExtended'));

Route::any('patientprevioustreatmentprint', array('before'=>'isDoctorLoggedIn','as'=>'patientprevioustreatmentprint','uses'=>'DoctorController@patientPreviousTreatmentPrint'));

Route::any('patientprevioustreatmenttest', array('before'=>'isDoctorLoggedIn','as'=>'patientprevioustreatmenttest','uses'=>'DoctorController@showPatientPreviousTreatmentTest'));


Route::get('patientexamination', array('before'=>'isDoctorLoggedIn','as'=>'patientexamination','uses'=>'DoctorController@showPatientExamination'));
Route::post('addPatientExamination',  array('before'=>'isDoctorLoggedIn','as' => 'addPatientExamination', 'uses' => 'DoctorController@addPatientExamination'));

Route::get('patientdiagnosis', array('before'=>'isDoctorLoggedIn','as'=>'patientdiagnosis','uses'=>'DoctorController@showPatientDiagnosis'));
Route::post('addPatientDiagnosis',  array('before'=>'isDoctorLoggedIn','as' => 'addPatientDiagnosis', 'uses' => 'DoctorController@addPatientDiagnosis'));

Route::get('patientlabdata', array('before'=>'isDoctorLoggedIn','as'=>'patientlabdata','uses'=>'DoctorController@showPatientLabdata'));

Route::get('migration', array('before'=>'isDoctorLoggedIn','as'=>'migration','uses'=>'DoctorController@showMigration'));


Route::any('patientprescmanagement', array('before'=>'isDoctorLoggedIn','as'=>'patientprescmanagement','uses'=>'DoctorController@showPatientPrescManagement'));
Route::post('addPatientPrescManagement',  array('before'=>'isDoctorLoggedIn','as' => 'addPatientPrescManagement', 'uses' => 'DoctorController@addPatientPrescManagement'));

Route::get('patientprescmedicine', array('before'=>'isDoctorLoggedIn','as'=>'patientprescmedicine','uses'=>'DoctorController@showPatientPrescMedicine'));

Route::post('addPatientPrescMedicine',  array('before'=>'isDoctorLoggedIn','as' => 'addPatientPrescMedicine', 'uses' => 'DoctorController@addPatientPrescMedicine'));

Route::post('showPatientPrescMedicine',  array('before'=>'isDoctorLoggedIn','as' => 'showPatientPrescMedicine', 'uses' => 'DoctorController@showPatientPrescMedicine'));

Route::any('patientprescprint',  array('before'=>'isDoctorLoggedIn','as' => 'patientprescprint', 'uses' => 'DoctorController@patientPrescPrint'));


Route::post('getState',  array('as' => 'getState', 'uses' => 'UtilityController@getState'));

/*Route::any('doctorsettings',  array('before'=>'isDoctorLoggedIn','as' => 'doctorsettings', 'uses' => 'DoctorController@doctorSettings'));*/

Route::any('printsetup',  array('before'=>'isDoctorLoggedIn','as' => 'printsetup', 'uses' => 'DoctorController@showPrintSetup')); 


Route::post('addPrintSettings',  array('before'=>'isDoctorLoggedIn','as' => 'addPrintSettings', 'uses' => 'DoctorController@addPrintSettings'));

Route::any('fetchprintsetupdata',  array('before'=>'isDoctorLoggedIn','as' => 'fetchprintsetupdata', 'uses' => 'DoctorController@fetchPrintSetupData')); 


//Cardio
//-------------------------------------------------------------------------
Route::any('cardiopersonalinformation', array('before'=>'isDoctorLoggedIn','as'=>'cardiopersonalinformation','uses'=>'CardiologyController@showCardioPersonalInformation'));

Route::any('addCardioPersonalInformation', array('as'=>'addCardioPersonalInformation','uses'=>'CardiologyController@addCardioPersonalInformation'));

Route::any('cardiomedicalhistory', array('before'=>'isDoctorLoggedIn','as'=>'cardiomedicalhistory','uses'=>'CardiologyController@showCardioMedicalHistory'));

Route::any('addCardioMedicalHistory', array('before'=>'isDoctorLoggedIn','as' => 'addCardioMedicalHistory', 'uses' => 'CardiologyController@addCardioMedicalHistory'));

Route::any('cardioexamination', array('before'=>'isDoctorLoggedIn','as' => 'cardioexamination', 'uses' => 'CardiologyController@showCardioExamination'));

Route::any('addCardiacExamination', array('as' => 'addCardiacExamination', 'uses' => 'CardiologyController@addCardiacExamination'));

Route::any('cardiodiagnosis', array('as' => 'cardiodiagnosis', 'uses' => 'CardiologyController@showCardiacDiagnosis'));

Route::any('cardiolabdata', array('as' => 'cardiolabdata', 'uses' => 'CardiologyController@showCardiacLabdata'));

Route::any('cardioprevioustreatment', array('as' => 'cardioprevioustreatment', 'uses' => 'CardiologyController@showCardioPreviousTreatment'));

Route::any('cardioprevioustreatmentextended', array('before'=>'isDoctorLoggedIn','as'=>'cardioprevioustreatmentextended','uses'=>'CardiologyController@cardioPreviousTreatmentExtended'));




//Patient Controlls
//------------------------------------------------------------

Route::any('patientprofilemanagement', array('as'=>'patientprofilemanagement','uses'=>'PatientController@showPatientProfileManagement'));
Route::any('patientprofileprevtreatment', array('as'=>'patientprofileprevtreatment','uses'=>'PatientController@showPatientProfilePrevTreatment'));
Route::any('patientprofileedit', array('as'=>'patientprofileedit','uses'=>'PatientController@showPatientProfileEdit'));
Route::any('patientProfileEdit', array('as' => 'patientProfileEdit', 'uses' => 'PatientController@patientProfileEdit'));
Route::any('patientprofileprevtreatmentextended', array('as'=>'patientprofileprevtreatmentextended','uses'=>'PatientController@patientProfilePreviousTreatmentExtended'));
Route::any('patientchangepassword', array('as'=>'patientchangepassword','uses'=>'PatientController@showPatientChangePassword'));
Route::any('handlePatientChangePassword', array('as'=>'handlePatientChangePassword','uses'=>'PatientController@handlePatientChangePassword'));



//Admin controller
//----------------------------------------------------------

Route::any('dduserlogin', array('as'=>'dduserlogin','uses'=>'UserController@showUserLogin'));
Route::any('handleUserLogin', array('as'=>'handleUserLogin','uses'=>'UserController@handleUserLogin'));
Route::any('userhome', array('as'=>'userhome','uses'=>'UserController@showUserHome'));
Route::any('import', array('as'=>'import','uses'=>'UserController@showUserImport'));
Route::any('userjsonimport', array('as'=>'userjsonimport','uses'=>'UserController@showUserJsonImport'));
Route::any('handleDiagnosisDataMigration', array('as'=>'handleDiagnosisDataMigration','uses'=>'UserController@showDiagnosisDataMigration'));
Route::any('handleMedicalDataMigration', array('as'=>'handleMedicalDataMigration','uses'=>'UserController@showMedicalDataMigration'));
Route::any('handleDoctorsDataMigration', array('as'=>'handleDoctorsDataMigration','uses'=>'UserController@showDoctorsDataMigration'));
Route::any('handlePatientsDataMigration', array('as'=>'handlePatientsDataMigration','uses'=>'UserController@showPatientsDataMigration'));
Route::any('handleUserDataMigration', array('as'=>'handleUserDataMigration','uses'=>'UserController@handleUserDataMigration'));


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
	//echo $doctorId;
	if(empty($doctorId) || $doctorId==" "){
		return Redirect::to('doctorlogin');
	}	
});

Route::filter('isPatientLoggedIn',function(){
	$patientId = Session::get('patientIdActivate');
		if(empty($patientId) || $patientId==" "){
			return Redirect::to('patientlogin');
		
		}
});

Route::filter('isDoctorOtpCreated',function(){
	
	$otpCreated = Session::get('otp');
	
	if(empty($otpCreated) || $otpCreated==" "){
		return Redirect::to('doctorlogin');
	}	
});