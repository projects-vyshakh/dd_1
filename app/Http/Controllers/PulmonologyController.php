<?php namespace App\Http\Controllers;
use Input;
use DB;
use Log;
use App\Quotation;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Contracts\Routing\ResponseFactory;
use Session;
use Request;
use Carbon\Carbon;
use App;
use PDF;
use View;
//use Illuminate\Support\Collection::sortBy();

//Classes
use App\classes\DBAuth;
use App\classes\DBUtils;
use App\classes\DOMPDF;

//Models
use App\Models\DoctorsModel;
use App\Models\PatientsModel;

//use App\Models\CardioMedicalHistoryPresentPastModel;
use App\Models\SurgeryHistoryModel;
use App\Models\DrugAllergyHistoryModel;
use App\Models\PulmoMedicalHistoryModel;
use App\Models\PulmoMedicalHistoryPresentPastModel;
use App\Models\PulmoMedicalOtherHistoryModel;


class PulmonologyController extends Controller {

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

	/*public function convertDateToMysql($date){

		$date1  		  = str_replace('/', '-', $date);
		$convertedDate    = date('Y-d-m', strtotime($date1));
		return $convertedDate;
	}
	public function generate_random_password($length = 5) {
	    $alphabets = range('A','Z');
	    $numbers = range('0','9');
	    //$additional_characters = array('_','.');
	    $final_array = array_merge($alphabets,$numbers);
	         
	    $password = '';
	  
	    while($length--) {
	      $key = array_rand($final_array);
	      $password .= $final_array[$key];
	    }
	  
	    return $password;
  	}
*/
	public function __construct()
	{
		//$doctorId = Session::get('doctorId');
		//$loginStatus = DBAuth::isDoctorLoggedIn($doctorId);
		/*$flag=0;
		$connected = fopen("http://www.google.com:80/","r");
		  if($connected)
		  {
		     
		  } 
		  else {
		  	 
		  	
		  	$flag=1;
		  	
		  }
		  if($flag==1){
		  	Session::flush();
		  	return Redirect::to('doctorlogin');
		  }*/
		
	}
	


	//Pulmo
	//-------------------------------------------------------------------

	public function showPulmoPersonalInformation(){

		$patientId = Session::get('patientId');
		$doctorId = Session::get('doctorId');

		

		if(!empty($doctorId)){ 
			if(!empty($patientId)){ 
				$gender = DB::table('business_key_details')->where('business_key', '=', 'GENDER')->orderBy('business_value')->lists('business_value', 'business_value');
		
				$maritialStatus = DB::table('business_key_details')->where('business_key', '=', 'MARITIAL_STATUS')->lists('business_value', 'business_value');
				
				$country =  DB::table('countries')->select('country_name','sortname','id')->orderBy('country_name', 'asc')->lists('country_name', 'id'); 	

				$doctorsList = DB::table('doctors')->select('first_name','last_name','id_doctor')->orderBy('first_name', 'asc')->lists('first_name', 'id_doctor'); 	
				
				
				/*$state =  DB::table('states')->select('id','state_name','country_id')->orderBy('state_name', 'asc')->lists('state_name', 'state_name'); 	*/
				
				$city =  DB::table('cities')->select('city_name','state_id')->orderBy('city_name', 'asc')->lists('city_name', 'city_name'); 	
				    	

				    if(in_array('', $gender)){
				     	 array_unshift($gender, 'Female');
				    }	
				    if(!in_array('', $maritialStatus)){
				     	 array_unshift($maritialStatus, '');
				    } 
				    if(!in_array('', $country)){
				     	 array_unshift($country, '');
				    } 
				    /*if(!in_array('', $state)){
				     	 array_unshift($state, '');
				    } */
				    if(!in_array('', $city)){
				     	 array_unshift($city, '');
				    }
				   

				    $patientId = Session::get('patientId');  		
				    $patientData = DB::table('patients')
				    						 ->where('id_patient','=',$patientId)->first();

				    $doctorData = DB::table('doctors')
				    						 ->where('id_doctor','=',$doctorId)->first();
				    						 
				//Log::info("Patientdata",array($patientData));

				return view('pulmopersonalinformation',array('gender' => $gender,'maritialStatus'=>$maritialStatus,'country' => $country,  'city' => $city,'patientId'=>$patientId, 'patientData'=>$patientData,'doctorData'=>$doctorData,'doctorsList'=>$doctorsList));
			}
			else{
				return Redirect::to('doctor/home')->with(array('error'=>"You are not authorised to view the page"));
			}
		}
		else{
			return Redirect::to('doctor/logout');
		}
		
			
		
	}

	public function addPulmoPersonalInformation(){
		
		$input 		= Request::all();
		$doctorId 	= Session::get('doctorId');
		$patientId 	= Session::get('patientId');
		$createdDate = date('Y-m-d H:i:s');
		//var_dump($input); die();

		$patientExistCheck = DB::table('patients')->where('id_patient','=',$patientId)->count();

		(!empty($input['first_name']))?$firstName 			= $input['first_name']:$firstName = "";
		(!empty($input['middle_name']))?$middleName 		= $input['middle_name']:$middleName = "";
		(!empty($input['last_name']))?$lastName 			= $input['last_name']:$lastName = "";
		(!empty($input['aadhar_no']))?$aadharNo 			= $input['aadhar_no']:$aadharNo = "";
		(!empty($input['gender']))?$gender 					= $input['gender']:$gender = "";
		(!empty($input['dob']))?$dob 						= $input['dob']:$dob = "";	
		(!empty($input['age']))?$age 						= $input['age']:$age = "";
		(!empty($input['maritial_status']))?$marriedStatus 	= $input['maritial_status']:$marriedStatus = "";

		(!empty($input['refferedby']))?$refferedby 			= $input['refferedby']:$refferedby = "";
		(!empty($input['occupation']))?$occupation 			= $input['occupation']:$occupation = "";
		
		(!empty($input['house']))?$house 					= $input['house']:$house = "";	
		(!empty($input['street']))?$street 					= $input['street']:$street = "";
		(!empty($input['city']))?$city 						= $input['city']:$city = "";
		(!empty($input['country']))?$country 				= $input['country']:$country = "";	
		(!empty($input['state']))?$state 					= $input['state']:$state = "";
		(!empty($input['pincode']))?$pincode 				= $input['pincode']:$pincode = "";
		(!empty($input['phone']))?$phone 					= $input['phone']:$phone = "";
		(!empty($input['email']))?$email 					= $input['email']:$email = "";
		(!empty($input['time_of_appointment']))?$time_of_appointment	= $input['time_of_appointment']:$time_of_appointment	= "";
		
		($gender=="Male")?$profileImageName = "patient_profile_m.jpg":$profileImageName="patient_profile_L.jpg";	
       

		if($patientExistCheck>0){
			//return Redirect::to('patientpersonalinformation')->
			//echo "existing patient";
		 	if(!empty($firstName) || !empty($lastName) || !empty($gender) || !empty($dob) || !empty($age) || 
           	   !empty($house) || !empty($street) || !empty($country) || !empty($state) || !empty($pincode) ||
           	   !empty($phone) || !empty($email) || !empty($time_of_appointment) ){

           	   	$editedDate = date('Y-m-d');

		 		$inputValue = array('first_name'		=>	$firstName,
									'middle_name'		=> 	$middleName,
									'last_name'			=> 	$lastName,
									'reffered_by'		=>	$refferedby,
									'id_aadhar' 		=>	$aadharNo,
									'gender' 			=> 	$gender,
									'dob' 				=> 	$dob,
									'age' 				=> 	$age,
									'maritial_status' 	=> 	$marriedStatus,
									'house_name' 		=> 	$house,
									'street' 			=> 	$street,
									'city' 				=> 	$city,
									'state'   			=> 	$state,
									'pincode'	 		=> 	$pincode,
									'country' 			=> 	$country,
									'phone' 			=> 	$phone,
									'email' 			=> 	$email,
									'occupation' 		=> 	$occupation,
									'time_of_appointment' => $time_of_appointment,
									
									'profile_image_large'=>$profileImageName,
									'id_doctor' 		=> 	$doctorId,
									'edited_date' 		=> $editedDate);



		 			$patientPersonalInfoUpdate = DB::table('patients')->where('id_patient','=',$patientId)->update($inputValue);

		 			if($patientPersonalInfoUpdate){
		 				return Redirect::to('doctor/pulmopersonalinformation')->with(array('success'=>"Data updated successfully"));	
		 			}
		 			else{
		 				return Redirect::to('doctor/pulmopersonalinformation')->with(array('error'=>"No changes to update"));
		 			}
			}
			else{
				
				return Redirect::to('doctor/pulmopersonalinformation')->with(array('success'=>'Data saved successfully'));
			}

		}
		else{
			//echo "new patient";
			if(!empty($firstName) || !empty($lastName) || !empty($gender) || !empty($dob) || !empty($age) || 
	           !empty($house) || !empty($street) || !empty($country) || !empty($state) || !empty($pincode) ||
	           !empty($phone) || !empty($email) || !empty($time_of_appointment) )


			{
				
				$inputValue = array('id_patient' => $input['id_patient'],
									'first_name'=>$firstName,
									'middle_name'=> $middleName,
									'last_name'=> $lastName,
									'reffered_by'		=>	$refferedby,
									'id_aadhar' =>	$aadharNo,
									'gender' => $gender,
									'dob' => $dob,
									'age' => $age,
									'maritial_status' => $marriedStatus,
									'house_name' => $house,
									'street' => $street,
									'city' => $city,
									'state' => $state,
									'pincode' => $pincode,
									'country' => $country,
									'phone' => $phone,
									'email' => $email,
									'occupation' => $occupation,
									'time_of_appointment' => $time_of_appointment,
									'profile_image_large'=>$profileImageName,
									'id_doctor' => $doctorId,
									'created_date' => $createdDate);
									
				$patientPersonalInfoSave = DB::table('patients')->insert($inputValue);
				if($patientPersonalInfoSave){
					return Redirect::to('doctor/pulmopersonalinformation')->with(array('success'=>'Data saved successfully'));
				}
			}
			else{
				return Redirect::to('doctor/pulmopersonalinformation')->with(array('success'=>'Data saved successfully'));
			}

		}
	}


	public function showPulmoMedicalHistory(){

		
		$patientId 	= Session::get('patientId');
		$doctorId 	= Session::get('doctorId');

		if(!empty($doctorId)){
			if(!empty($patientId)){
				$patientPersonalData = PatientsModel::where('id_patient','=',$patientId)->first();
				$doctorData 		 = DoctorsModel::where('id_doctor','=',$doctorId)->first();
		      	$medicalHistory		 = DB::table('pulmo_medical_history')
		      	                                    ->where('id_patient','=',$patientId)
		      	                                    ->where('created_date', DB::raw("(select max(`created_date`) from pulmo_medical_history where id_patient='$patientId')"))
		      	                                    ->get();

				$medicalHistoryPresentPastMore = PulmoMedicalHistoryPresentPastModel::where('id_patient','=',$patientId)
				                                          ->where('created_date', DB::raw("(select max(`created_date`) from pulmo_medical_history_present_past_more  where  id_patient='$patientId')"))->get();	
															//dd($medicalHistoryPresentPastMore);


				$surgeryHistory = DB::table('medical_history_surgical')
				                     	->where('created_date', DB::raw("(select max(`created_date`) from medical_history_surgical  where  id_patient='$patientId')"))
				                        ->where('id_patient','=',$patientId)
				                        ->get();
				$drugAllergyHistory = DB::table('medical_history_drug_allergy')
				                        ->where('created_date', DB::raw("(select max(`created_date`) from medical_history_drug_allergy  where  id_patient='$patientId')"))
				                        ->where('id_patient','=',$patientId)
				                        ->get();
				$othermedicalHistory = PulmoMedicalOtherHistoryModel::where('id_patient','=',$patientId)
				                        ->where('created_date', DB::raw("(select max(`created_date`) from pulmo_medical_other_history  where  id_patient='$patientId')"))
				                        ->get();

				
				
				return view('pulmomedicalhistory',array('medicalHistory'=>$medicalHistory,'medicalHistoryPresentPastMore'=>$medicalHistoryPresentPastMore,'surgeryHistory'=>$surgeryHistory,'drugAllergyHistory'=>$drugAllergyHistory,'patientPersonalData'=>$patientPersonalData,'doctorData'=>$doctorData,'othermedicalHistory'=>$othermedicalHistory));
			}
			else{
				return Redirect::to('doctor/home')->with(array('error'=>"You are not authorised to view the page"));
			}
		}
		else{
			return Redirect::to('doctor/logout');
		}
		
			
		

		
		
	}


	public function addPulmoMedicalHistory(){
		$input = Request::all();
    	//var_dump(json_encode($input));

	
    	$referenceId = Session::get('referenceId');
	    $patientId   = Session::get('patientId');
	    $doctorId    = Session::get('doctorId');
	    $createdDate = date('Y-m-d H:i:s');
	    $specializationText = Session::get('doctorSpecialization');

	    //var_dump(json_encode($input));
	    //die();

	    //if this is NA then checked the Not known else unchecked the not known
		$presentPastNotKnown  	= $input['present-past-check-value']; 
		$familyNotKnown       	= $input['family-check-value'];	
		$surgeryNotKnown      	= $input['surgery-check-value'];
		$generalAllergyNotKnown = $input['generalallergy-check-value'];
		$drugAllergyNotKnown 	= $input['drugallergy-check-value'];
		$socialNotKnown 		= $input['social-check-value'];
		$otherNotKnown 			= $input['other-check-value'];

	    $patientExistCheck = PatientsModel::where('id_patient','=',$patientId)->count();
	   
	    $medicalHistoryExist = PulmoMedicalHistoryModel::where('id_patient','=',$patientId)
	    					->where('medical_history_reference','=',$referenceId)
	    					->count();

	    if($patientExistCheck>0)
	    {
	    	
	    	(!empty($input['father']))?$fatherHistory = $input['father']:$fatherHistory = [''];
	    	(!empty($input['father_other']))?$fatherHistoryOther = $input['father_other']:$fatherHistoryOther = '';
	    	(!empty($input['mother']))?$motherHistory = $input['mother']:$motherHistory = [''];
	    	(!empty($input['mother_other']))?$motherHistoryOther = $input['mother_other']:$motherHistoryOther = '';
	    	(!empty($input['sibling']))?$siblingHistory = $input['sibling']:$siblingHistory = [''];
	    	(!empty($input['sibling_other']))?$siblingHistoryOther = $input['sibling_other']:$siblingHistoryOther = '';
	    	(!empty($input['grandfather']))?$grandfatherHistory = $input['grandfather']:$grandfatherHistory = [''];
	    	(!empty($input['grandfather_other']))?$grandfatherHistoryOther = $input['grandfather_other']:$grandfatherHistoryOther = '';
	    	(!empty($input['grandmother']))?$grandmotherHistory = $input['grandmother']:$grandmotherHistory = [''];
	    	(!empty($input['grandmother_other']))?$grandmotherHistoryOther = $input['grandmother_other']:$grandmotherHistoryOther = '';
	    	(!empty($input['allergy_general']))?$allergyGeneral = $input['allergy_general'] : $allergyGeneral=[''];
	    	(!empty($input['alcohol']))?$alcohol = $input['alcohol']:$alcohol = "";
    		(!empty($input['tobaco-smoke']))?$tobacoSmoke = $input['tobaco-smoke']:$tobacoSmoke = "";
    		(!empty($input['tobaco-chew']))?$tobacoChew = $input['tobaco-chew']:$tobacoChew = "";
    		(!empty($input['other-social-history']))?$OtherSocialHistory = $input['other-social-history']:$OtherSocialHistory = "";

    		(!empty($input['anaesthesia']))?$anaesthesiaHistory = $input['anaesthesia']:$anaesthesiaHistory = "";
    		//Addmore illness
    		
    		//Surgery History
    		(!empty($input['surgery']))?$surgery = $input['surgery']:$surgery = "";
    		

    		//Allergy History
	    	(!empty($input['medication-drug-allergy']))?$allergyMedication = $input['medication-drug-allergy']: $allergyMedication="";
	    	(!empty($input['reaction-drug-allergy']))?$allergyReaction= $input['reaction-drug-allergy']: $allergyReaction="";
	    	
	    	//(!empty($input['allergy_counter']))?$allergyCounter = $input['allergy_counter']:$allergyCounter=0;

	    	if($medicalHistoryExist>0){
	    		
	    		if( !empty($input['father'])  || 
	    			!empty($input['mother'])  ||
		    	    !empty($input['sibling']) || 
		    	    !empty($input['grandfather']) || 
		    	    !empty($input['grandmother']) ||
		    	    !empty($input['allergy_general']) || 
		    	    !empty($input['alcohol']) || 
		    	    !empty($input['tobaco-smoke']) || 
		    	    !empty($input['tobaco-chew'])  || 
		    	    !empty($input['other-social-history']) ||
		    	    !empty($input['present-past-check-value']) ||
			    	!empty($input['family-check-value']) || 
			    	!empty($input['surgery-check-value']) ||
			    	!empty($input['generalallergy-check-value']) || 
			    	!empty($input['drugallergy-check-value']) || !empty($input['social-check-value']) || !empty($input['other-check-value']))
    			{
    				$editedDate = date('Y-m-d H:i:s');
    				$dataArray = array(
			    					   	'history_family_father' => json_encode($fatherHistory),
			    					   	'history_family_father_other' => $fatherHistoryOther,
			    					   	'history_family_mother' => json_encode($motherHistory),
			    					   	'history_family_mother_other' => $motherHistoryOther,
			    					   	'history_family_sibling' => json_encode($siblingHistory),
			    					   	'history_family_sibling_other' => $siblingHistoryOther,
			    					   	'history_family_grandfather' => json_encode($grandfatherHistory),
			    					   	'history_family_grandfather_other' => $grandfatherHistoryOther,
			    					   	'history_family_grandmother' => json_encode($grandmotherHistory),
			    					   	'history_family_grandmother_other' => $grandmotherHistoryOther,
			    					   	'history_allergy_general' =>json_encode($allergyGeneral),
			    					   	'history_social_alcohol' => $alcohol,
			    					   	'history_social_tobacco_smoke' => $tobacoSmoke,
			    					   	'history_social_tobacco_chew' => $tobacoChew,
			    					   	'history_social_other' => $OtherSocialHistory,
			    					   	'history_prev_intervention_anaesthesia' => $anaesthesiaHistory,
			    					   	'history_presentpast_no'=>$presentPastNotKnown,
										'history_family_no'=>$familyNotKnown,
										'history_surgery_no'=>$surgeryNotKnown,
										'history_generalallergy_no'=>$generalAllergyNotKnown,
										'history_drugallergy_no'=>$drugAllergyNotKnown,
										'history_social_no'=>$socialNotKnown,
										'history_other_no'=>$otherNotKnown,
			    					   'id_doctor' => $doctorId,
			    					   'edited_date' => $editedDate);

    				$dataUpdate = PulmoMedicalHistoryModel::where('id_patient','=',$patientId)
    							->where('medical_history_reference','=',$referenceId)
    							->update($dataArray);
    			}

    			//Add more illness
    			$this->illnessDataManagement($input,$patientId,$doctorId,$referenceId,$createdDate,$specializationText );
				//Surgery Management
				$this->surgeryDataManagement($input,$surgery,$patientId,$doctorId,$referenceId,$createdDate);
				//Drug allergy managent
				$this->drugDataManagement($input,$allergyMedication,$allergyReaction,$patientId,$doctorId,$referenceId,$createdDate);

				//Other History managent
				$this->otherDataManagement($input,$patientId,$doctorId,$referenceId,$createdDate,$specializationText );

    			

    			return Redirect::to('doctor/pulmomedicalhistory')->with(array('success'=>"Data updated successfully"));

	    	}
	    	else{
	    		
	    		if(!empty($input['father'])  || 
	    		   !empty($input['mother']) ||
		    	   !empty($input['sibling']) || 
		    	   !empty($input['grandfather']) || 
		    	   !empty($input['grandmother']) ||
		    	   !empty($input['allergy_general']) || 
		    	   !empty($input['alcohol']) || 
		    	   !empty($input['tobaco-smoke']) || 
		    	   !empty($input['tobaco-chew'])  || 
		    	   !empty($input['other-social-history']) ||
		    	   !empty($input['present-past-check-value']) ||
			       !empty($input['family-check-value']) || 
			       !empty($input['surgery-check-value']) ||
			       !empty($input['generalallergy-check-value']) || 
			       !empty($input['drugallergy-check-value']) || 
			       !empty($input['social-check-value']) || 
			       !empty($input['other-check-value']))
    			{

    				//echo "MedicalEx<0"; 
	    			//Menstrual History, Present & Past, Family History, General Allergy, Social History and Other
	    			$dataArray = array(
			    					   'medical_history_reference' => $referenceId,
			    					   'history_family_father' => json_encode($fatherHistory),
			    					   'history_family_father_other' => $fatherHistoryOther,
			    					   'history_family_mother' => json_encode($motherHistory),
			    					   'history_family_mother_other' => $motherHistoryOther,
			    					   'history_family_sibling' => json_encode($siblingHistory),
			    					   'history_family_sibling_other' => $siblingHistoryOther,
			    					   'history_family_grandfather' => json_encode($grandfatherHistory),
			    					   'history_family_grandfather_other' => $grandfatherHistoryOther,
			    					   'history_family_grandmother' => json_encode($grandmotherHistory),
			    					   'history_family_grandmother_other' => $grandmotherHistoryOther,
			    					   'history_allergy_general' =>json_encode($allergyGeneral),
			    					   'history_social_alcohol' => $alcohol,
			    					   'history_social_tobacco_smoke' => $tobacoSmoke,
			    					   'history_social_tobacco_chew' => $tobacoChew,
			    					   'history_social_other' => $OtherSocialHistory,
			    					   'history_prev_intervention_anaesthesia' => $anaesthesiaHistory,
			    					   'history_presentpast_no'=>$presentPastNotKnown,
										'history_family_no'=>$familyNotKnown,
										'history_surgery_no'=>$surgeryNotKnown,
										'history_generalallergy_no'=>$generalAllergyNotKnown,
										'history_drugallergy_no'=>$drugAllergyNotKnown,
										'history_social_no'=>$socialNotKnown,
										'history_other_no'=>$otherNotKnown,
			    					   'id_patient' => $patientId,
			    					   'id_doctor' => $doctorId,
			    					   'created_date' => $createdDate);

    				$dataInsert = PulmoMedicalHistoryModel::insert($dataArray);
	    		}
	    		
	    		//Add more illness
    			$this->illnessDataManagement($input,$patientId,$doctorId,$referenceId,$createdDate,$specializationText );
				//Surgery Management
				$this->surgeryDataManagement($input,$surgery,$patientId,$doctorId,$referenceId,$createdDate);
				//Drug allergy managent
				$this->drugDataManagement($input,$allergyMedication,$allergyReaction,$patientId,$doctorId,$referenceId,$createdDate);
				//More other history
				$this->otherDataManagement($input,$patientId,$doctorId,$referenceId,$createdDate,$specializationText );

	    		return Redirect::to('doctor/pulmomedicalhistory')->with(array('success'=>"Data saved successfully"));

	    	}

      	
	    }
	    else{
	    	return Redirect::to('doctor/pulmomedicalhistory')->with(array('error'=>"Please save patient personal information"));
	    }	


	}

	public function illnessDataManagement($input,$patientId,$doctorId,$referenceId,$createdDate,$specializationText ){
			//var_dump(json_encode($input));
			$presentPastDivCount =	$input['presentPastDivCount'];

			$conditionString 	 = 	array('id_patient' => $patientId, 'illness_reference'=>$referenceId);
			$illnessData	     =	PulmoMedicalHistoryPresentPastModel::where($conditionString)->get();
			$illnessAllArray 	 = 	array();
			for($i=1;$i<=$presentPastDivCount;$i++){
					isset($input['illness_name'.$i])?$illnessName = $input['illness_name'.$i]				: $illnessName = "";
					isset($input['illness_status'.$i])?$illnessStatus = $input['illness_status'.$i]				: $illnessStatus = "";
					isset($input['illness_medication'.$i])?$illnessMedication = $input['illness_medication'.$i]	: $illnessMedication 	 = "";
					empty($illnessStatus)?$illnessStatus=" ":$illnessStatus	=	$illnessStatus;
					if(!empty($illnessName)){
							$illnessArray = array(  'id_patient' 		=> $patientId,
										    	    'id_doctor' 		=> $doctorId,
												    'illness_name' 		=> $illnessName,
												    'illness_status' 	=> $illnessStatus,
												    'medication' 		=> $illnessMedication,
												    'illness_reference' => $referenceId,
										    		'created_date' 		=> $createdDate
												);
												array_push($illnessAllArray,$illnessArray);
					}
			}
			

			switch ($specializationText) {
	    		case '1':
	    		break;
	    		case '2':
	    		break;
	    		case '3':
	    		break;
	    		case '4':
	    			if(count($illnessData)>0){
								//Update illness data by deleting the existing with same reference
								$whereString 			= array('id_patient'=>$patientId,'illness_reference'=>$referenceId);
								$illnessDataFind =  PulmoMedicalHistoryPresentPastModel::where($whereString)->delete();
								if($illnessDataFind){
										PulmoMedicalHistoryPresentPastModel::insert($illnessAllArray);
								}
						}
						else{
								//inserting the new illness data
								 PulmoMedicalHistoryPresentPastModel::insert($illnessAllArray);
						}
	    			break;	
	    		default:
	    			# code...
	    			break;
	    	}
	}

	public function surgeryDataManagement($input,$surgery,$patientId,$doctorId,$referenceId,$createdDate){
				
		if(!empty($surgery))
		{
			$surgeryExistDetails = DB::table('medical_history_surgical')
														->where('id_patient','=',$patientId)
														->where('surgery_reference','=',$referenceId)
														->count();
			if($surgeryExistDetails>0){
				$surgeryDelete = DB::table('medical_history_surgical')
											->where('id_patient','=',$patientId)
											->where('surgery_reference','=',$referenceId)
											->delete();
				if($surgeryDelete){
					$this->surgeryDataManagementExtended($surgery,$patientId,$doctorId,$referenceId,$createdDate);
				}
				else{
					return Redirect::to('pulmomedicalhistory',array('error'=>'Failed to save data'));
				}
				
			}
			else{
				$this->surgeryDataManagementExtended($surgery,$patientId,$doctorId,$referenceId,$createdDate);
			}


			
	    		
		}
	}
	public function surgeryDataManagementExtended($surgery,$patientId,$doctorId,$referenceId,$createdDate){
		$surgeryArray = array();
		for($i=0;$i<count($surgery); $i++)
		{
			if(!empty($surgery[$i])){
				$surgeryData = array('surgery_name' => $surgery[$i],
							    	 'id_patient'   => $patientId,
							    	 'id_doctor'	=> $doctorId,
							    	 'surgery_reference'=>$referenceId,
							    	 'created_date'	=> $createdDate);
																  
				array_push($surgeryArray,$surgeryData);
			}
		}
		//dd($surgeryArray);
		SurgeryHistoryModel::insert($surgeryArray);
	}
	public function drugDataManagement($input,$allergyMedication,$allergyReaction,$patientId,$doctorId,$referenceId,$createdDate){
		$drugDataExists  = DB::table('medical_history_drug_allergy')
											->where('id_patient','=',$patientId)
											->where('drug_allergy_reference','=',$referenceId)
											->count();

		if($drugDataExists>0){
			$deleteDrugData = DB::table('medical_history_drug_allergy')
											->where('id_patient','=',$patientId)
											->where('drug_allergy_reference','=',$referenceId)
											->delete();
			if($deleteDrugData){
				$this->drugDataManagementExtended($allergyMedication,$allergyReaction,$patientId,$doctorId,$createdDate,$referenceId);
			}
		}
		else{
			$this->drugDataManagementExtended($allergyMedication,$allergyReaction,$patientId,$doctorId,$createdDate,$referenceId);
		}
	}

	public function drugDataManagementExtended($allergyMedication,$allergyReaction,$patientId,$doctorId,$createdDate,$referenceId){
    	if(!empty($allergyMedication) && !empty($allergyReaction))
		{
	    		$allergyMedication 	= array_filter($allergyMedication);
	    		$allergyReaction   	= array_filter($allergyReaction);
				$allergyArray 		= array();

	    		if(!empty($allergyMedication) && !empty($allergyReaction))
				{

					foreach($allergyMedication as $index=>$value){
						isset($allergyMedication[$index])?$drugName = $allergyMedication[$index]:$drugName ="";
						isset($allergyReaction[$index])?$reactionName 	= $allergyReaction[$index]:$reactionName 	="";	
							
							$allergyData 	= array('drug_name'  => $drugName,							 				'reaction'	 => $reactionName,						 				'id_patient' => $patientId,						 					'id_doctor'  => $doctorId,											'drug_allergy_reference'=> $referenceId,
													'created_date' => $createdDate);
										array_push($allergyArray,$allergyData);
					}
					DrugAllergyHistoryModel::insert($allergyArray);
				}
				
		}
    }
    public function otherDataManagement($input,$patientId,$doctorId,$referenceId,$createdDate,$specializationText ){
			//var_dump(json_encode($input));
			$otherHistoryDivCount =	$input['otherHistoryDivCount'];

			$conditionString 	 = 	array('id_patient' => $patientId, 'other_history_reference'=>$referenceId);
			$otherHistoryData	     =	PulmoMedicalOtherHistoryModel::where($conditionString)->get();
			$otherHistoryAllArray 	 = 	array();
			for($i=1;$i<=$otherHistoryDivCount;$i++){
					isset($input['other_history_name'.$i])?$otherhistoryName = $input['other_history_name'.$i]				: $otherhistoryName = "";
					isset($input['other_history_status'.$i])?$otherHistoryStatus = $input['other_history_status'.$i]				: $otherHistoryStatus = "";
					isset($input['other_history_comments'.$i])?$otherHistoryComments = $input['other_history_comments'.$i]	: $otherHistoryComments 	 = "";
					empty($otherHistoryStatus)?$otherHistoryStatus=" ":$otherHistoryStatus	=	$otherHistoryStatus;
					if(!empty($otherhistoryName)){
							$otherHistoryArray = array(  'id_patient' 		=> $patientId,
										    	    'id_doctor' 		=> $doctorId,
												    'other_history_name'	=> $otherhistoryName,
												    'other_history_status' 	=> $otherHistoryStatus,
												    'other_history_comments' => $otherHistoryComments,
												    'other_history_reference' => $referenceId,
										    		'created_date' 		=> $createdDate
												);
												array_push($otherHistoryAllArray,$otherHistoryArray);
					}
			}
			

			switch ($specializationText) {
	    		case '1':
	    		break;
	    		case '2':
	    		break;
	    		case '3':
	    		break;
	    		case '4':
	    			if(count($otherHistoryData)>0){
								//Update illness data by deleting the existing with same reference
								$whereString= array('id_patient'=>$patientId,
									'other_history_reference'=>$referenceId);
								$otherHistoryDataFind =  PulmoMedicalOtherHistoryModel::where($whereString)->delete();
								if($otherHistoryDataFind){
										PulmoMedicalOtherHistoryModel::insert($otherHistoryAllArray);
								}
						}
						else{
								//inserting the new illness data
								 PulmoMedicalOtherHistoryModel::insert($otherHistoryAllArray);
						}
	    			break;	
	    		default:
	    			# code...
	    			break;
	    	}
	}


}
