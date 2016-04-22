<?php

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


Route::get('login',  array('as' => 'login', 'uses' => 'LoginController@showLogin'));
Route::get('register',  array('as' => 'register', 'uses' => 'LoginController@showRegister'));
Route::post('handleLogin', array('as' => 'handleLogin', 'uses' => 'LoginController@handleLogin'));

Route::any('doctorhome',  array('as' => 'doctorhome', 'uses' => 'DoctorController@showDoctorHome'));
Route::get('doctordashboard',  array('as' => 'doctordashboard', 'uses' => 'HomeController@doctorDashboard'));
Route::get('patientinformation', 'DoctorController@showPatientInformation');
Route::get('patientdiagnosis', 'DoctorController@showPatientDiagnosis');
Route::any('patientpersonalinformation', 'DoctorController@showPatientPersonalInformation');
/*Route::post('patientpersonalinformation', 'DoctorController@PatientPersonalInformation');*/
Route::any('patientobstetricshistory', 'DoctorController@showPatientObstetricsHistory');
Route::any('patientmedicalhistory', 'DoctorController@showPatientMedicalHistory');
Route::any('patientprevioustreatment', 'DoctorController@showPatientPreviousTreatment');
Route::any('addPatientPersonalInformation', array('as' => 'addPatientPersonalInformation', 'uses' => 'DoctorController@addPatientPersonalInformation'));

Route::get('patientexamination', 'DoctorController@showPatientExamination');

Route::post('getState',  array('as' => 'getState', 'uses' => 'UtilityController@getState'));

Route::post('patientIdSubmit',  array('as' => 'patientIdSubmit', 'uses' => 'DoctorController@patientIdSubmit'));
