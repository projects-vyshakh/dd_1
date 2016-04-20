<?php namespace App\Http\Controllers;
use Input;
use DB;
use Log;
use App\Quotation;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Contracts\Routing\ResponseFactory;
use Session;

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

	/*	    select *,s.state_name from patients As p JOIN states As s

on p.state = s.id 

where p.id_patient='KL100200'*/
		    $patientId = Session::get('patientId');  		
		    $patientData = DB::table('patients As p')
		    						 ->leftJoin('states As s','p.state','=','s.id')
		    						 ->where('id_patient','=',$patientId)->get();
		Log::info("Patientdata",array($patientData));

		return view('patientpersonalinformation',array('gender' => $gender,'maritialStatus'=>$maritialStatus,'country' => $country, 'state' => $state, 'city' => $city,'patientId'=>$patientId, 'patientData'=>$patientData));
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

	public function patientIdSubmit(){
		$patientId     = Input::get('patient_id');
		$patientStatus = Input::get('patient_status');

		$patientData = DB::table('patients')->where('id_patient','=',$patientId)->get();
		Log::info("Patientdata",array($patientData));

		if(!empty($patientData)){
			foreach ($patientData as $key => $value) {
					$patientId 	     = $value->id_patient;
					$firstName 	     = $value->first_name;
					$middleName      = $value->middle_name;
					$lastName        = $value->last_name;
					$aadharNo        = $value->id_aadhar;
					$patientGender   = $value->gender;
					$patientDob      = $value->dob;
					$age             = $value->age;
					$maritialStatus  = $value->maritial_status;
					$house           = $value->house_name;
					$street          = $value->street;
					$city            = $value->city;
					$state           = $value->state;
					$country         = $value->country;
					$pincode         = $value->pincode;
					$phone           = $value->phone;
					$email           = $value->email;
					//echo $patientDob;
			}
			Session::put('patientId',$patientId);
			/*Session::put('firstName',$firstName);
			Session::put('middleName',$middleName);
			Session::put('lastName',$lastName);
			Session::put('aadharNo',$aadharNo);
			Session::put('patientGender',$patientGender);
			Session::put('patientDob',$patientDob);
			Session::put('age',$age);
			Session::put('maritialStatus',$maritialStatus);
			Session::put('house',$house);
			Session::put('street',$street);
			Session::put('city',$city);
			Session::put('state',$state);
			Session::put('country',$country);
			Session::put('pincode',$pincode);
			Session::put('phone',$phone);
			Session::put('email',$email);*/
		}
			

	

		if(!empty($patientId)){

			$patientIdExistCheck = DB::table('patients')->where('id_patient','=',$patientId)->first();


			if($patientIdExistCheck){
				
				if($patientStatus=="new"){
					echo "Status from new and returns to home with exists message";
					return Redirect::to('doctorhome')->with(array('error'=>'Patient already exists'));
					//eturn view('doctorhome');
				}
				else{
					//echo "Status from old and returns to patient information";
					return Redirect::to('patientpersonalinformation');
					
            

			    }		
					
			}
			else{
				echo $patientStatus;
				echo "New patient";
				if($patientStatus=="old"){
					echo "No patient exist with this id.Are you sure you want to add new patient";
				}
				else{
					Session::flush();
					//return Redirect::to('patientpersonalinformation');
					echo "Add new patient";
				}
				

			}
				
		}
	}
	
	
	

}
