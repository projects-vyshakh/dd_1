<?php namespace App\Http\Controllers;
use DB;
use Log;
use App\Quotation;


class DoctorController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	/*public function __construct()
	{
		$this->middleware('auth');
	}
*/
	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	
	public function showpatientInformation(){
		return view('patientinformation');
	}
	
	public function showPatientPersonalInformation(){
		$gender = DB::table('business_key_details')->where('business_key', '=', 'GENDER')->lists('business_value', 'business_value');
		
		$maritialStatus = DB::table('business_key_details')->where('business_key', '=', 'MARITIAL_STATUS')->lists('business_value', 'business_value');
		
		$country =  DB::table('countries')->select('country_name','sortname','id')->orderBy('country_name', 'asc')->lists('country_name', 'id'); 	
		
		$state =  DB::table('states')->select('state_name','country_id')->orderBy('state_name', 'asc')->lists('state_name', 'state_name'); 	
		
		$city =  DB::table('cities')->select('city_name','state_id')->orderBy('city_name', 'asc')->lists('city_name', 'city_name'); 	
		    	

		    if(!in_array('', $gender)){
		     	 array_unshift($gender, '');
		    }	
		    if(!in_array('', $maritialStatus)){
		     	 array_unshift($maritialStatus, '');
		    } 
		    if(!in_array('', $country)){
		     	 array_unshift($country, '');
		    } 
		    if(!in_array('', $state)){
		     	 array_unshift($state, '');
		    } 
		    if(!in_array('', $city)){
		     	 array_unshift($city, '');
		    }	  		

		return view('patientpersonalinformation',array('gender' => $gender,'maritialStatus'=>$maritialStatus,'country' => $country, 'state' => $state, 'city' => $city));
	}
	public function showPatientObstetricsHistory(){
		return view('patientobstetricshistory');
	}
	public function showPatientMedicalHistory(){
		return view('patientmedicalhistory');
	}
	public function showPatientPreviousTreatment(){
		return view('patientprevioustreatment');
	}
	public function addPatientPersonalInformation(){
		echo "vyshakh";
	}

	public function showPatientExamination(){
		return view('patientexamination');
	}
	
	
	

}
