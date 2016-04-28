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

	public function convertDateToMysql($date){

		$date1  		  = str_replace('/', '-', $date);
		$convertedDate    = date('Y-d-m', strtotime($date1));
		return $convertedDate;
	}

	
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

		$lmpFlow = DB::table('business_key_details')->where('business_key', '=', 'OBS_LMP_FLOW')->lists('business_value', 'business_value');
		$lmpDysmenohrrea = DB::table('business_key_details')->where('business_key', '=', 'OBS_LMP_DYSMENORRHEA')->lists('business_value', 'business_value');
		$lmpMensusType = DB::table('business_key_details')->where('business_key', '=', 'OBS_LMP_MENSUS_TYPE')->lists('business_value', 'business_value');
		$pregKind = DB::table('business_key_details')->where('business_key', '=', 'OBS_PREG_KIND')->lists('business_value', 'business_value');
		$pregType = DB::table('business_key_details')->where('business_key', '=', 'OBS_PREG_TYPE')->lists('business_value', 'business_value');
		$gender = DB::table('business_key_details')->where('business_key', '=', 'GENDER')->lists('business_value', 'business_value');
		$pregTerm = DB::table('business_key_details')->where('business_key', '=', 'OBS_PREG_TERM')->lists('business_value', 'business_value');
		$pregChildHealth = DB::table('business_key_details')->where('business_key', '=', 'OBS_PREG_HEALTH')->lists('business_value', 'business_value');

		if(!in_array('', $lmpFlow)){
		     	 array_unshift($lmpFlow, '');
		}
		if(!in_array('', $lmpDysmenohrrea)){
		     	 array_unshift($lmpDysmenohrrea, '');
		}	
		if(!in_array('', $lmpMensusType)){
		     	 array_unshift($lmpMensusType, '');
		}
		if(!in_array('', $pregKind)){
		     	 array_unshift($pregKind, '');
		}
		if(!in_array('', $pregType)){
		     	 array_unshift($pregType, '');
		}
		if(!in_array('', $gender)){
		     	 array_unshift($gender, '');
		}	
		if(!in_array('', $pregTerm)){
		     	 array_unshift($pregTerm, '');
		}	
		if(!in_array('', $pregChildHealth)){
		     	 array_unshift($pregChildHealth, '');
		}	


		$patientId = Session::get('patientId'); 
        $doctorId = Session::get('doctorId');  //echo "DoctorId".$doctorId;

        $patientPersonalData 	= DB::table('patients')->where('id_patient','=',$patientId)->first();
        $patientGynObsData	 	= DB::table('sp_gynaecology_obs')->where('id_patient','=',$patientId)->first();
        $patientGynObsLmpData 	= DB::table('sp_gynaecology_obs_lmp')->where('id_patient','=',$patientId)->get();
        $patientGynObsPregData  = DB::table('sp_gynaecology_obs_preg')->where('id_patient','=',$patientId)->get();
		
				
		

		return view('patientobstetricshistory',array('lmpFlow' => $lmpFlow,'lmpDysmenohrrea'=>$lmpDysmenohrrea, 'lmpMensusType' => $lmpMensusType, 'pregKind' => $pregKind, 'pregType' => $pregType,'gender' => $gender, 'pregTerm' =>$pregTerm, 'pregChildHealth' => $pregChildHealth,'patientPersonalData' =>$patientPersonalData, 'patientGynObsData' =>$patientGynObsData, 'patientGynObsLmpData' =>$patientGynObsLmpData, 'patientGynObsPregData' =>$patientGynObsPregData));
	}

	public function showPatientMedicalHistory(){
		return view('patientmedicalhistory');
	}

	public function showPatientPreviousTreatment(){
		return view('patientprevioustreatment');
	}

	public function addPatientPersonalInformation(){
		
		$input = Request::all();
		
		$date1 			= str_replace('/', '-', $input['dob']);
		$newDob 		= date('Y-m-d', strtotime($date1));
		$date2 			= str_replace('/', '-', $input['now_date']);
		$editedDate 	= date('Y-m-d', strtotime($date2));
		$createdDate  	= date('Y-m-d', strtotime($date2));

		$doctorId = Session::get('doctorId');

		$patientIdExistCheck = DB::table('patients')->where('id_patient','=',$input['id_patient'])->get();
		
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
				
				if($patientStatus=="old"){
					return Redirect::to('doctorhome')->with(array('error'=>'Invalid patient Id'));
				}
				else{
					 
					return Redirect::to('patientpersonalinformation');
					
				}
				

			}
				
		}
	}
	public function addPatientObstetricsHistory(){
		$input = Request::all();
        
        var_dump(json_encode($input));  //die();


        if(!empty($input['lmp_flow'])) { echo "no empty"; } else{ echo "empty"; } 
		$marriedLife 	 = $input['married_life'];
        $husBloodGroup 	 = $input['hus_bloodgroup'];
        $gravida 		 = $input['gravida'];
        $para 			 = $input['para'];
        $living 		 = $input['living'];
        $abortion 		 = $input['abortion'];
        $gestationalAge  = $input['gestational_age'];
        (!empty($input['last_mensus_date']))? $lastMensusDate = $input['last_mensus_date'] : $lastMensusDate="";
        (!empty($input['lmp_flow']))? $lmpFlow = $input['lmp_flow'] : $lmpFlow="";
        (!empty($input['lmp_dysmenorrhea']))? $lmpDysmenohrrea = $input['lmp_dysmenorrhea'] : $lmpDysmenohrrea="";
        (!empty($input['days']))? $days = $input['days'] : $days="";
        (!empty($input['cycle']))? $cycle = $input['cycle'] : $cycle="";
		
        $createdDate     = date('Y-m-d');
        $lmpCount        = $input['lmp_count'];
        (!empty($input['lmp_mensus_type']))? $lmpMensusType = $input['lmp_mensus_type'] : $lmpMensusType="";
        


		$date1  		 		= str_replace('/', '-', $input['last_delvery_date']);
		$lastDeliveryDate 		= date('Y-m-d', strtotime($date1));
		$date2  		  		= str_replace('/', '-', $input['expected_delvery_date']);
		$expectedDeliveryDate 	= date('Y-m-d', strtotime($date2));
		/*$date3  		  		= str_replace('/', '-', $lastMensusDate);
		$$lastMensusDate 	 	= date('Y-m-d', strtotime($date3));*/

		(!empty($input['preg_kind']))? $pregKind = $input['preg_kind'] : $pregKind="";
		(!empty($input['preg_type']))? $pregType = $input['preg_type'] : $pregType="";
		(!empty($input['preg_term']))? $pregTerm = $input['preg_term'] : $pregTerm="";
		(!empty($input['type_of_abortion']))? $pregAbortion = $input['type_of_abortion'] : $pregAbortion="";
		(!empty($input['preg_health'] ))? $pregHealth = $input['preg_health'] : $pregHealth="";
		(!empty($input['years']))? $pregYear = $input['years'] : $pregYear="";
		(!empty($input['weeks']))? $pregWeek = $input['weeks'] : $pregWeek="";
		(!empty($input['gender']))? $pregGender = $input['gender'] : $pregGender="";
		
		
		var_dump($pregKind);
		//die();

        $patientId 	= Session::get('patientId'); 
        $doctorId 	= Session::get('doctorId');  echo "DoctorId".$doctorId;

        $patientExistCheck 		= DB::table('patients')->where('id_patient','=',$patientId)->first();
        $patientGynObsExist 	= DB::table('sp_gynaecology_obs')->where('id_patient','=',$patientId)->first();
        $patientGynObsLmpExist 	= DB::table('sp_gynaecology_obs_lmp')->where('id_patient','=',$patientId)->get();
        $patientGynObsPregExist = DB::table('sp_gynaecology_obs_preg')->where('id_patient','=',$patientId)->get();

       
        //This is for checking whether the patient is available.

        if($patientExistCheck){

        	//Inserting into sp_gynaecology_obs
        	$insertValues = array('id_patient' => $patientId,
							  'id_doctor' => $doctorId,
							  'married_life' => $marriedLife,
							  'husband_blood_group' => $husBloodGroup,
							  'gravida' => $gravida,
							  'para' => $para,
							  'living' => $living,
							  'abortion' => $abortion,
							  'obs_last_delivery_date' => $lastDeliveryDate,
							  'obs_expected_delivery_date' => $expectedDeliveryDate,
							  'obs_gestational_age' => $gestationalAge,
							  'created_date' => $createdDate);
        	$gynObsData = DB::table('sp_gynaecology_obs')->insert($insertValues);
        	
        		//Inserting into sp_gynaecology_obs_lmp
        		if(!empty($lastMensusDate)){
        			echo "enter into last mensus date";
					foreach ($lastMensusDate as $index => $value)
					{
					    echo $lastMensusDate[$index] .' '. $lmpDysmenohrrea[$index].' '.$lmpFlow[$index].' '.$lmpMensusType[$index].' '.$days[$index].' '.$cycle[$index];
					   
					    $date1  		  = str_replace('/', '-', $lastMensusDate[$index]);
						$lastPeriodDate    = date('Y-m-d', strtotime($date1));
  						echo "LastPeriod".$lastPeriodDate;
					 
					    $lmpData = array('id_patient' => $patientId,
									     'id_doctor' => $doctorId,
									     'obs_lmp_date' => $lastPeriodDate,
									     'obs_lmp_flow' => $lmpFlow[$index],
									     'obs_lmp_dysmenorrhea' => $lmpDysmenohrrea[$index],
									     'obs_menstrual_type' => $lmpMensusType[$index],
									     'obs_lmp_days' => $days[$index],
									     'obs_lmp_cycle' => $cycle[$index],
									     'created_date' => $createdDate);
					    var_dump($lmpData);

					    $gynObsLmpData = DB::table('sp_gynaecology_obs_lmp')->insert($lmpData);
					}
				}
				
				//Inserting into sp_gynaecology_obs_preg
				if(!empty($pregKind)){ echo "Enter into Preg";
					foreach ($pregKind as $index => $value){
						echo $pregKind[$index].' '.$pregType[$index];
						$pregData = array('id_patient' => $patientId,
									      'id_doctor' => $doctorId, 
									      'obs_preg_kind' => $pregKind[$index],
									      'obs_preg_type' => $pregType[$index],
									      'obs_preg_term' => $pregTerm[$index],
									      'obs_preg_abortion' => $pregAbortion[$index],
									      'obs_preg_health' => $pregHealth[$index],
									      'obs_preg_gender' => $pregGender[$index],
									      'obs_preg_years' => $pregYear[$index],
									      'obs_preg_weeks' => $pregWeek[$index],
									      'created_date' => $createdDate);

						$gynObsPregData = DB::table('sp_gynaecology_obs_preg')->insert($pregData);


					}
				}
			
				return Redirect::to('patientobstetricshistory')->with(array('success' => "Data saved successfully"));
        }
        else{
        	return Redirect::to('patientobstetricshistory')->with(array('error' => "Please save patient personal information"));
        }

   }
	
	

}
