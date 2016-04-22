<?php namespace App\Http\Controllers;
use Input;
use DB;
use Log;
use App\Quotation;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Contracts\Routing\ResponseFactory;
use Session;
use Request;


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
	public function showDoctorHome(){
		Session::forget('patientId');
		return view('doctorhome');
		//echo 'Doctor ome';
	}
	public function showpatientInformation(){
		return view('patientinformation');
	}
	
	public function showPatientPersonalInformation(){
		$gender = DB::table('business_key_details')->where('business_key', '=', 'GENDER')->lists('business_value', 'business_value');
		
		$maritialStatus = DB::table('business_key_details')->where('business_key', '=', 'MARITIAL_STATUS')->lists('business_value', 'business_value');
		
		$country =  DB::table('countries')->select('country_name','sortname','id')->orderBy('country_name', 'asc')->lists('country_name', 'id'); 	
		
		$state =  DB::table('states')->select('id','state_name','country_id')->orderBy('state_name', 'asc')->lists('state_name', 'state_name'); 	
		
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


		    $patientId = Session::get('patientId');  		
		    $patientData = DB::table('patients')
		    						
		    						 ->where('id_patient','=',$patientId)->get();
		//Log::info("Patientdata",array($patientData));

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
		
		$input = Request::all();
		var_dump(json_encode($input));
		
		$var1 = $input['dob'];
		$date1 = str_replace('/', '-', $var1);
		$newDob = date('Y-m-d', strtotime($date1));

		$var2 = $input['now_date'];
		$date2 = str_replace('/', '-', $var2);
		$editedDate = date('Y-m-d', strtotime($date2));
		$createdDate  = date('Y-m-d', strtotime($date2));

		$doctorId = Session::get('doctorId');

		$patientIdExistCheck = DB::table('patients')->where('id_patient','=',$input['id_patient'])->get();
		var_dump($patientIdExistCheck);
		if(!empty($patientIdExistCheck)){
			foreach ($patientIdExistCheck as $key=> $value) {
				$createdDate = $value->created_date;
			}
		}
		else{
			$editedDate = " ";
		}
		


		$inputValue = array('id_patient' => $input['id_patient'],
								'first_name'=>$input['first_name'],
								'middle_name'=> $input['middle_name'],
								'last_name'=> $input['last_name'],
								'id_aadhar' => $input['aadhar_no'],
								'gender' => $input['gender'],
								'dob' => $newDob,
								'age' => $input['age'],
								'maritial_status' => $input['maritial_status'],
								'house_name' => $input['house'],
								'street' => $input['street'],
								'city' => $input['city'],
								'state' => $input['state'],
								'pincode' => $input['pincode'],
								'country' => $input['country'],
								'phone' => $input['phone'],
								'email' => $input['email'],
								'id_doctor' => $doctorId,
								'created_date' => $createdDate,
								'edited_date'=>$editedDate);
		
		



		
		if($patientIdExistCheck){
			
			echo "enter into patientId Exist of addPatientPersonalInformation";


			//	var_dump($inputValue);
			$patientPersonalInfoUpdate = DB::table('patients')->where('id_patient','=',$input['id_patient'])->update($inputValue);

			if($patientPersonalInfoUpdate){
				//return Redirect::to('patientpersonalinformation');
				//echo 'Hai';
				return Redirect::to('patientpersonalinformation')->with(array('success'=>'Data updated successfully'));
			}
			else{
				return Redirect::to('patientpersonalinformation')->with(array('error'=>'No values changed for update '));
			}

		}
		else{

			

			$patientPersonalInfoSave = DB::table('patients')->insert($inputValue);
			if($patientPersonalInfoSave){
				return Redirect::to('patientpersonalinformation')->with(array('success'=>'Data saved successfully'));
			}
		}
	}

	public function showPatientExamination(){
		return view('patientexamination');
	}

	public function patientIdSubmit(){
		$patientId     = Input::get('patient_id');
		$patientStatus = Input::get('patient_status');

		$patientData = DB::table('patients As p')
		    						 ->leftJoin('states As s','p.state','=','s.id')
		    						 ->where('id_patient','=',$patientId)->get();
		Log::info("Patientdata",array($patientData));

		Session::put('patientId',$patientId);
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
				/*echo $patientStatus;
				echo "New patient";*/
				if($patientStatus=="old"){
					return Redirect::to('doctorhome')->with(array('error'=>'Invalid patient Id'));
				}
				else{
					 
					return Redirect::to('patientpersonalinformation');
					
				}
				

			}
				
		}
	}
	
	
	

}
