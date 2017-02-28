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
use App\Models\CardioMedicalHistoryPresentPastModel;
use App\Models\SurgeryHistoryModel;
use App\Models\DrugAllergyHistoryModel;

class CardiologyController extends Controller {

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
	


	//Cardio
	//-------------------------------------------------------------------

	public function showCardioPersonalInformation(){

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
				    						 ->where('id_patient','=',$patientId)->get();

				    $doctorData = DB::table('doctors')
				    						 ->where('id_doctor','=',$doctorId)->first();
				    						 
				//Log::info("Patientdata",array($patientData));

				return view('cardiopersonalinformation',array('gender' => $gender,'maritialStatus'=>$maritialStatus,'country' => $country,  'city' => $city,'patientId'=>$patientId, 'patientData'=>$patientData,'doctorData'=>$doctorData,'doctorsList'=>$doctorsList));
			}
			else{
				return Redirect::to('doctor/home')->with(array('error'=>"You are not authorised to view the page"));
			}
		}
		else{
			return Redirect::to('doctor/logout');
		}
		
			
		
	}

	public function addCardioPersonalInformation(){
		
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
		(!empty($input['house']))?$house 					= $input['house']:$house = "";	
		(!empty($input['street']))?$street 					= $input['street']:$street = "";
		(!empty($input['city']))?$city 						= $input['city']:$city = "";
		(!empty($input['country']))?$country 				= $input['country']:$country = "";	
		(!empty($input['state']))?$state 					= $input['state']:$state = "";
		(!empty($input['pincode']))?$pincode 				= $input['pincode']:$pincode = "";
		(!empty($input['phone']))?$phone 					= $input['phone']:$phone = "";
		(!empty($input['email']))?$email 					= $input['email']:$email = "";
		(!empty($input['refferedby']))?$refferedby 			= $input['refferedby']:$refferedby = "";
		($gender=="Male")?$profileImageName = "patient_profile_m.jpg":$profileImageName="patient_profile_L.jpg";	
       
		if($patientExistCheck>0){
			//return Redirect::to('patientpersonalinformation')->
			//echo "existing patient";
		 	if(!empty($firstName) || !empty($lastName) || !empty($gender) || !empty($dob) || !empty($age) || 
           	   !empty($house) || !empty($street) || !empty($country) || !empty($state) || !empty($pincode) ||
           	   !empty($phone) || !empty($email) ){

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
									'profile_image_large'=>$profileImageName,
									'id_doctor' 		=> 	$doctorId,
									'edited_date' 		=> $editedDate);



		 			$patientPersonalInfoUpdate = DB::table('patients')->where('id_patient','=',$patientId)->update($inputValue);

		 			if($patientPersonalInfoUpdate){
		 				return Redirect::to('doctor/cardiopersonalinformation')->with(array('success'=>"Data updated successfully"));	
		 			}
		 			else{
		 				return Redirect::to('doctor/cardiopersonalinformation')->with(array('error'=>"No changes to update"));
		 			}
			}
			else{
				
				return Redirect::to('doctor/cardiopersonalinformation')->with(array('success'=>'Data saved successfully'));
			}

		}
		else{
			//echo "new patient";
			if(!empty($firstName) || !empty($lastName) || !empty($gender) || !empty($dob) || !empty($age) || 
	           !empty($house) || !empty($street) || !empty($country) || !empty($state) || !empty($pincode) ||
	           !empty($phone) || !empty($email) )


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
									'profile_image_large'=>$profileImageName,
									'id_doctor' => $doctorId,
									'created_date' => $createdDate);
									
				$patientPersonalInfoSave = DB::table('patients')->insert($inputValue);
				if($patientPersonalInfoSave){
					return Redirect::to('doctor/cardiopersonalinformation')->with(array('success'=>'Data saved successfully'));
				}
			}
			else{
				return Redirect::to('doctor/cardiopersonalinformation')->with(array('success'=>'Data saved successfully'));
			}

		}
	}


	public function showCardioMedicalHistory(){

		
		$patientId 	= Session::get('patientId');
		$doctorId 	= Session::get('doctorId');

		if(!empty($doctorId)){
			if(!empty($patientId)){
				$patientPersonalData = PatientsModel::where('id_patient','=',$patientId)->first();
				$doctorData 		 = DoctorsModel::where('id_doctor','=',$doctorId)->first();
		      	$medicalHistory		 = DB::table('cardiac_medical_history')
		      	                                    ->where('id_patient','=',$patientId)
		      	                                    ->where('created_date', DB::raw("(select max(`created_date`) from cardiac_medical_history where id_patient='$patientId')"))
		      	                                    ->get();

				$medicalHistoryPresentPastMore = CardioMedicalHistoryPresentPastModel::where('id_patient','=',$patientId)
				                                          ->where('created_date', DB::raw("(select max(`created_date`) from cardiac_medical_history_present_past_more  where  id_patient='$patientId')"))->get();	
															//dd($medicalHistoryPresentPastMore);


				$surgeryHistory = DB::table('medical_history_surgical')
				                                ->where('created_date', DB::raw("(select max(`created_date`) from medical_history_surgical  where  id_patient='$patientId')"))
				                                ->where('id_patient','=',$patientId)
				                                ->get();
				$drugAllergyHistory = DB::table('medical_history_drug_allergy')
				                                    ->where('created_date', DB::raw("(select max(`created_date`) from medical_history_drug_allergy  where  id_patient='$patientId')"))
				                                   
				                                    ->where('id_patient','=',$patientId)->get();
				
				
				return view('cardiomedicalhistory',array('medicalHistory'=>$medicalHistory,'medicalHistoryPresentPastMore'=>$medicalHistoryPresentPastMore,'surgeryHistory'=>$surgeryHistory,'drugAllergyHistory'=>$drugAllergyHistory,'patientPersonalData'=>$patientPersonalData,'doctorData'=>$doctorData));
			}
			else{
				return Redirect::to('doctor/home')->with(array('error'=>"You are not authorised to view the page"));
			}
		}
		else{
			return Redirect::to('doctor/logout');
		}
		
			
		

		
		
	}


	public function addCardioMedicalHistory(){
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

		

	    $patientExistCheck = PatientsModel::where('id_patient','=',$patientId)->count();
	   
	    $medicalHistoryExist = DB::table('cardiac_medical_history')
	    										->where('id_patient','=',$patientId)
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
    		(!empty($input['other_medical_history']))?$otherMedicalHistory = $input['other_medical_history']:$otherMedicalHistory = "";
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
			    	!empty($input['drugallergy-check-value']) || !empty($input['social-check-value']))
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
			    					   	'history_other'=>$otherMedicalHistory,
			    					   	'history_presentpast_no'=>$presentPastNotKnown,
										'history_family_no'=>$familyNotKnown,
										'history_surgery_no'=>$surgeryNotKnown,
										'history_generalallergy_no'=>$generalAllergyNotKnown,
										'history_drugallergy_no'=>$drugAllergyNotKnown,
										'history_social_no'=>$socialNotKnown,
			    					   'id_doctor' => $doctorId,
			    					   'edited_date' => $editedDate);

    				$dataUpdate = DB::table('cardiac_medical_history')
    												->where('id_patient','=',$patientId)
    												->where('medical_history_reference','=',$referenceId)
    												->update($dataArray);
    			}

    			//Add more illness
    			$this->illnessDataManagement($input,$patientId,$doctorId,$referenceId,$createdDate,$specializationText );
				//Surgery Management
				$this->surgeryDataManagement($input,$surgery,$patientId,$doctorId,$referenceId,$createdDate);
				//Drug allergy managent
				$this->drugDataManagement($input,$allergyMedication,$allergyReaction,$patientId,$doctorId,$referenceId,$createdDate);

    			

    			return Redirect::to('doctor/cardiomedicalhistory')->with(array('success'=>"Data updated successfully"));

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
			       !empty($input['social-check-value']))
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
			    					   'history_other'=>$otherMedicalHistory,
			    					   'history_presentpast_no'=>$presentPastNotKnown,
										'history_family_no'=>$familyNotKnown,
										'history_surgery_no'=>$surgeryNotKnown,
										'history_generalallergy_no'=>$generalAllergyNotKnown,
										'history_drugallergy_no'=>$drugAllergyNotKnown,
										'history_social_no'=>$socialNotKnown,
			    					   'id_patient' => $patientId,
			    					   'id_doctor' => $doctorId,
			    					   'created_date' => $createdDate);

    				$dataInsert = DB::table('cardiac_medical_history')->insert($dataArray);
	    		}
	    		
	    		//Add more illness
    			$this->illnessDataManagement($input,$patientId,$doctorId,$referenceId,$createdDate,$specializationText );
				//Surgery Management
				$this->surgeryDataManagement($input,$surgery,$patientId,$doctorId,$referenceId,$createdDate);
				//Drug allergy managent
				$this->drugDataManagement($input,$allergyMedication,$allergyReaction,$patientId,$doctorId,$referenceId,$createdDate);

	    		return Redirect::to('doctor/cardiomedicalhistory')->with(array('success'=>"Data saved successfully"));

	    	}

      	
	    }
	    else{
	    	return Redirect::to('doctor/cardiomedicalhistory')->with(array('error'=>"Please save patient personal information"));
	    }	


	}

	public function illnessDataManagement($input,$patientId,$doctorId,$referenceId,$createdDate,$specializationText ){
			//var_dump(json_encode($input));
			$presentPastDivCount =	$input['presentPastDivCount'];

			$conditionString 	 = 	array('id_patient' => $patientId, 'illness_reference'=>$referenceId);
			$illnessData	     =	CardioMedicalHistoryPresentPastModel::where($conditionString)->get();
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
						/*if(count($illnessData)>0){
								//Update illness data by deleting the existing with same reference
								$whereString 			= array('id_patient'=>$patientId,'illness_reference'=>$referenceId);
								$illnessDataFind =  MedicalHistoryPresentPastModel::where($whereString)->delete();
								if($illnessDataFind){
										MedicalHistoryPresentPastModel::insert($illnessAllArray);
								}
						}
						else{
								//inserting the new illness data
								 MedicalHistoryPresentPastModel::insert($illnessAllArray);
						}*/
	    		break;
	    		case '2':
	    			if(count($illnessData)>0){
								//Update illness data by deleting the existing with same reference
								$whereString 			= array('id_patient'=>$patientId,'illness_reference'=>$referenceId);
								$illnessDataFind =  CardioMedicalHistoryPresentPastModel::where($whereString)->delete();
								if($illnessDataFind){
										CardioMedicalHistoryPresentPastModel::insert($illnessAllArray);
								}
						}
						else{
								//inserting the new illness data
								 CardioMedicalHistoryPresentPastModel::insert($illnessAllArray);
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
					return Redirect::to('patientmedicalhistory',array('error'=>'Failed to save data'));
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

    public function showCardioPreviousTreatment(){
		$patientId 	= Session::get('patientId');
		$doctorId = Session::get('doctorId');

		if(!empty($doctorId)){
			if(!empty($patientId)){
				$patientPersonalData 	= DB::table('patients')->where('id_patient','=',$patientId)->first();
				$doctorData 	= DB::table('doctors')->where('id_doctor','=',$doctorId)->first();

				return view('cardioprevioustreatment',array('patientPersonalData'=>$patientPersonalData,'doctorData'=>$doctorData));
			}
			else{
				return Redirect::to('doctorhome')->with(array('error'=>"You are not authorised to view the page"));
			}
		}
		else{
			return Redirect::to('logout');
		}
		
		


		
	}
	public function cardioPreviousTreatmentExtended(){
		$year = Input::get('year');
		
		//$year = $input['year'];
		$patientId 	= Session::get('patientId');
		$doctorId = Session::get('doctorId');
		$patientPersonalData 	= DB::table('patients')->where('id_patient','=',$patientId)->first();
		$doctorData 	= DB::table('doctors')->where('id_doctor','=',$doctorId)->first();
		
		
		$bloodGroup = DB::table('business_key_details')->where('business_key', '=', 'BLOOD_GROUP')->lists('business_value', 'business_value');
		$diseases 	=  DB::table('diseases')->select('disease_name')->orderBy('disease_name', 'asc')->lists('disease_name', 'disease_name');

		$symptoms =  DB::table('symptoms')->select('symptoms')->orderBy('symptoms', 'asc')->lists('symptoms', 'symptoms'); 

		$drugFrequency = DB::table('drug_frequency')->lists('frequency_name', 'id_drug_frequency');

		$dosageUnit = DB::table('business_key_details')->where('business_key', '=', 'MED_DOSE_UNIT')->lists('business_value', 'business_value');

		$drugDurationUnit = DB::table('business_key_details')->where('business_key', '=', 'MED_DURATION_UNIT')->lists('business_value', 'business_value');


		
		$obsData 	= DB::table('sp_gynaecology_obs')
		                                    ->where('id_patient','=',$patientId)
		                                    ->where('id_doctor','=',$doctorId)
		                                    ->where('created_date','LIKE','%'.$year.'%')
										    ->groupBy('created_date')
										    ->orderBy('created_date','desc')
										    ->get();

										   //var_dump($obsData);
										    //die();

		

		$pregData   = DB::table('sp_gynaecology_obs_preg')
		                                    ->where('id_patient','=',$patientId)
		                                    ->where('id_doctor','=',$doctorId)
		                                    ->where('created_date','LIKE','%'.$year.'%')
		                                    ->orderBy('created_date','desc')
		                                    ->get();



		$vitalsData = DB::table('vitals')
		                            ->where('id_patient','=',$patientId)
		                            ->where('id_doctor','=',$doctorId)
		                            ->where('created_date','LIKE','%'.$year.'%')
		                            ->orderBy('created_date','desc')
		                            ->get();



		$diagnosisData =  DB::table('cardiac_examination')
		                            ->where('id_patient','=',$patientId)
		                            ->where('id_doctor','=',$doctorId)
		                            ->where('created_date','LIKE','%'.$year.'%')
		                            ->orderBy('created_date','desc')
		                            ->get();


		$prescMedicineData =  DB::table('prescription')
		                            ->where('id_patient','=',$patientId)
		                            ->where('id_doctor','=',$doctorId)
		                            ->where('created_date','LIKE','%'.$year.'%')
		                            ->orderBy('created_date','desc')
		                            ->get();


		$test =  DB::table('vitals As obs')
								 ->join('sp_gynaecology_obs_preg As preg','obs.id_patient','=','preg.id_patient')
								 ->where('obs.id_patient','=',$patientId)
								 ->get();
/*
		$test = array_sort($test);

		var_dump(json_encode($test));
		die();*/
		
		
		$obsCreatedDateArray = array();
		$obsCreatedDateArray_dup = array();
		foreach($obsData as $index=>$obsDataVal){
				array_push($obsCreatedDateArray, $obsDataVal->created_date);
				array_push($obsCreatedDateArray_dup, date('Y-m-d',strtotime($obsDataVal->created_date)));
		}
		$obsCreatedDateArray = array_unique($obsCreatedDateArray);
		$obsCreatedDateArray_dup = array_unique($obsCreatedDateArray_dup);
		
		

		$pregCreatedDateArray = array();
		$pregCreatedDateArray_dup = array();
		foreach($pregData as $index=>$pregDataVal){
				array_push($pregCreatedDateArray, $pregDataVal->created_date);
				array_push($pregCreatedDateArray_dup, date('Y-m-d',strtotime($pregDataVal->created_date)));
		}
		$pregCreatedDateArray = array_unique($pregCreatedDateArray);
		$pregCreatedDateArray_dup = array_unique($pregCreatedDateArray_dup);
	

		$vitalsCreatedDateArray = array();
		$vitalsCreatedDateArray_dup = array();
		foreach($vitalsData as $index=>$vitalsDataVal){
				array_push($vitalsCreatedDateArray, $vitalsDataVal->created_date);
				array_push($vitalsCreatedDateArray_dup, date('Y-m-d',strtotime($vitalsDataVal->created_date)));
		}
		$vitalsCreatedDateArray = array_unique($vitalsCreatedDateArray);
		$vitalsCreatedDateArray_dup = array_unique($vitalsCreatedDateArray_dup);

		$diagnosisCreatedDateArray = array();
		$diagnosisCreatedDateArray_dup = array();
		foreach($diagnosisData as $index=>$diagnosisDataVal){
			array_push($diagnosisCreatedDateArray,$diagnosisDataVal->created_date);
			array_push($diagnosisCreatedDateArray_dup, date('Y-m-d',strtotime($diagnosisDataVal->created_date)));
		}
		$diagnosisCreatedDateArray = array_unique($diagnosisCreatedDateArray);
		$diagnosisCreatedDateArray_dup = array_unique($diagnosisCreatedDateArray_dup);
		/*var_dump(json_encode(array_unique($diagnosisCreatedDateArray)));
		echo "</br>";*/

		$prescMedicineCreatedDateArray = array();
		$prescMedicineCreatedDateArray_dup = array();
		for($i=0;$i<count($prescMedicineData);$i++){
			array_push($prescMedicineCreatedDateArray, $prescMedicineData[$i]->created_date);
			array_push($prescMedicineCreatedDateArray_dup, date('Y-m-d',strtotime($prescMedicineData[$i]->created_date)));
		}
		$prescMedicineCreatedDateArray = array_unique($prescMedicineCreatedDateArray);
		$prescMedicineCreatedDateArray_dup = array_unique($prescMedicineCreatedDateArray_dup);


		
		/*var_dump(json_encode(array_unique($prescMedicineCreatedDateArray)));
		echo "</br>";*/

		$mergedArray = array_merge($obsCreatedDateArray,$pregCreatedDateArray,$vitalsCreatedDateArray,$diagnosisCreatedDateArray,$prescMedicineCreatedDateArray);
		$mergedArray = array_unique($mergedArray);


			
		$mergedArrayDup = array_merge($obsCreatedDateArray_dup,$pregCreatedDateArray_dup,$vitalsCreatedDateArray_dup,$diagnosisCreatedDateArray_dup,$prescMedicineCreatedDateArray_dup);
		$mergedArrayDup = array_unique($mergedArrayDup);	
			

		
		$largestDateArray = array();
		foreach($mergedArray as $index=>$mergedArrayVal){
			
			array_push($largestDateArray, $mergedArrayVal);
			
		}
		
		//Logic for Sorting the Date array
		$n = count($mergedArray); //count of date array
		//echo $n;
		for($i = 0; $i < $n - 1; $i++)
		{
		  	$min = $i;
		  for($j = $i + 1; $j < $n; $j++)
		  {
		   if($largestDateArray[$j] > $largestDateArray[$min])
		   $min = $j;
		  }
		  $temp = $largestDateArray[$i];
		  $largestDateArray[$i] = $largestDateArray[$min];
		  $largestDateArray[$min] = $temp;
		}

		$mergedArray = $largestDateArray;


		$largestDateArrayDup = array();
		foreach($mergedArrayDup as $index=>$mergedArrayDupVal){
			
			array_push($largestDateArrayDup, $mergedArrayDupVal);
			
		}
		
		//Logic for Sorting the Date array
		$n = count($mergedArrayDup); //count of date array
		//echo $n;
		for($i = 0; $i < $n - 1; $i++)
		{
		  	$min = $i;
		  for($j = $i + 1; $j < $n; $j++)
		  {
		   if($largestDateArrayDup[$j] > $largestDateArrayDup[$min])
		   $min = $j;
		  }
		  $temp = $largestDateArrayDup[$i];
		  $largestDateArrayDup[$i] = $largestDateArrayDup[$min];
		  $largestDateArrayDup[$min] = $temp;
		}

		
		$mergedArrayDup = $largestDateArrayDup;
		
		$originalCreatedDate = array_unique($mergedArray);
		$originalCreatedDateDup = array_unique($mergedArrayDup);
	  

	 	
	   
		$obsData = DB::table('sp_gynaecology_obs')
											->whereIn('created_date', $originalCreatedDate)
											->where('created_date','LIKE','%'.$year.'%')
											->where('id_patient','=',$patientId)
											->where('id_doctor','=',$doctorId)
											->get();	
											
											
		$lmpData = DB::table('sp_gynaecology_obs_lmp')
											->whereIn('created_date', $originalCreatedDate)
											->where('created_date','LIKE','%'.$year.'%')
											->where('id_patient','=',$patientId)
											->where('id_doctor','=',$doctorId)
											->get();	

			/*var_dump(json_encode($lmpData));
			die();		*/						

		$pregData = DB::table('sp_gynaecology_obs_preg')
											->whereIn('created_date', $originalCreatedDate)
											->where('created_date','LIKE','%'.$year.'%')
											->where('id_patient','=',$patientId)
											->where('id_doctor','=',$doctorId)
											->get();
		$vitalsData = DB::table('vitals')
									->whereIn('created_date', $originalCreatedDate)
									->where('created_date','LIKE','%'.$year.'%')
									->where('id_patient','=',$patientId)
									->where('id_doctor','=',$doctorId)
									->get();
		$diagnosisData = DB::table('cardiac_examination')
									->whereIn('created_date', $originalCreatedDate)
									->where('created_date','LIKE','%'.$year.'%')
									->where('id_patient','=',$patientId)
									->where('id_doctor','=',$doctorId)
									->get();
		$prescMedicineData = DB::table('prescription')
									->whereIn('created_date', $originalCreatedDate)
									->where('created_date','LIKE','%'.$year.'%')
									->where('id_patient','=',$patientId)
									->where('id_doctor','=',$doctorId)
									->get();

									
		return json_encode(array('obsData' => $obsData,'lmpData' => $lmpData,'pregData' => $pregData,'vitalsData'=>$vitalsData,'originalCreatedDate'=>$originalCreatedDate,'bloodGroup'=>$bloodGroup,'diagnosisData'=>$diagnosisData,'diseases'=>$diseases,'prescMedicineData'=>$prescMedicineData,'drugFrequency'=>$drugFrequency,'originalCreatedDateDup'=>$originalCreatedDateDup,'symptoms'=>$symptoms,'patientPersonalData'=>$patientPersonalData,'doctorData'=>$doctorData,'dosageUnit'=>$dosageUnit,'drugDurationUnit'=>$drugDurationUnit));
		//die();

		//return view('patientprevioustreatment',array('obsData' => $obsData,'lmpData' => $lmpData,'pregData' => $pregData,'vitalsData'=>$vitalsData,'originalCreatedDate'=>$originalCreatedDate,'bloodGroup'=>$bloodGroup,'diagnosisData'=>$diagnosisData,'diseases'=>$diseases,'prescMedicineData'=>$prescMedicineData,'drugFrequency'=>$drugFrequency,'originalCreatedDateDup'=>$originalCreatedDateDup,'symptoms'=>$symptoms,'patientPersonalData'=>$patientPersonalData,'doctorData'=>$doctorData,'dosageUnit'=>$dosageUnit,'drugDurationUnit'=>$drugDurationUnit));
	}	

    public function showCardioExamination(){
    	$patientId = Session::get('patientId');
    	$doctorId = Session::get('doctorId');

    	if(!empty($doctorId)){
			if(!empty($patientId)){
				$patientPersonalData 	= DB::table('patients')->where('id_patient','=',$patientId)->first();
				$doctorData 	= DB::table('doctors')->where('id_doctor','=',$doctorId)->first();

		        
				$bloodGroup = DB::table('business_key_details')->where('business_key', '=', 'BLOOD_GROUP')->lists('business_value', 'business_value');
				

				$vitalExist = DB::table('vitals')->where('id_patient','=',$patientId)
												 ->where('id_vitals', DB::raw("(select max(`id_vitals`) from vitals where id_patient = '$patientId')"))
												 ->first();

				$cardiacExamData = DB::table('cardiac_examination')
													->where('id_patient','=',$patientId)
													->where('id_cardiac_examination', DB::raw("(select max(`id_cardiac_examination`) from cardiac_examination where id_patient = '$patientId')"))
													->first();

				
				if(!in_array('', $bloodGroup)){
				     	 array_unshift($bloodGroup, '');
				}
				
				return view('cardioexamination',array('bloodGroup'=>$bloodGroup,'vitalExist'=>$vitalExist,'patientPersonalData'=>$patientPersonalData,'doctorData'=>$doctorData,'cardioExamData'=>$cardiacExamData));
			}
			else{
				return Redirect::to('doctorhome')->with(array('error'=>"You are not authorised to view the page"));
			}
		}
		else{
			return Redirect::to('logout');
		}
		
		
    }

    public function addCardiacExamination(){
    	$input = Request::all();
    	//var_dump($input);

    	$patientId 		= Session::get('patientId');
    	$doctorId 		= Session::get('doctorId');
    	$referenceId 	= Session::get('referenceId');
    	$createdDate 	= date('Y-m-d H:i:s');

    	$responseFlag  = array();
    	//Vitals Insert and Update
    	$vitalsExist = DB::table('vitals')
    								->where('id_patient','=',$patientId)
    								/*->where('created_date', DB::raw("(select max(`created_date`) from vitals where id_patient='$patientId')"))*/
    								->where('vitals_reference','=',$referenceId)
    								->get();
    								

    	$patientExistCheck 		= DB::table('patients')->where('id_patient','=',$patientId)->count();

    	if($patientExistCheck>0){

    		//Vitals Data
        	(!empty($input['weight']))?$weight = $input['weight']:$weight="";
	    	(!empty($input['height']))?$height = $input['height']:$height="";
	    	(!empty($input['bmi']))?$bmi = $input['bmi']:$bmi="";
	    	(!empty($input['bloodgroup']))?$bloodGroup = $input['bloodgroup']:$bloodGroup="";
	    	(!empty($input['systolic_pressure']))?$systolicPressure = $input['systolic_pressure']:$systolicPressure="";
	    	(!empty($input['diastolic_pressure']))?$diastolicPressure = $input['diastolic_pressure']:$diastolicPressure="";
	    	(!empty($input['spo2']))?$spo2 = $input['spo2']:$spo2="";
	    	(!empty($input['pulse']))?$pulse = $input['pulse']:$pulse="";
	    	(!empty($input['respiratory_rate']))?$respiratoryRate = $input['respiratory_rate']:$respiratoryRate="";
	    	(!empty($input['temperature']))?$temperature = $input['temperature']:$temperature="";




	    	if(!empty($vitalsExist)){
	    		if(!empty($weight) || !empty($height) || !empty($bmi) || !empty($bloodGroup) || 
	    		   !empty($systolicPressure) || !empty($diastolicPressure)  ||
		    	   !empty($spo2) || !empty($pulse) || !empty($respiratoryRate) || !empty($temperature) )
		    	{
		    		
		    			$vitalsData = array('weight' => $weight,
			    							'height' => $height,
			    							'bmi' 	  => $bmi,
			    							'blood_group' => $bloodGroup,
			    							'systolic_pressure' => $systolicPressure,
			    							'diastolic_pressure' => $diastolicPressure,
			    							'sp'=> $spo2,
			    							'pulse' => $pulse,
			    							'respiratoryrate' =>$respiratoryRate,
			    							'temperature'=>$temperature,
			    							'edited_date' => $createdDate);

	    				$vitalsUpdate = DB::table('vitals')
	    											->where('id_patient','=',$patientId)
	    											->where('id_doctor','=',$doctorId)
	    											->where('vitals_reference','=',$referenceId)
	    											->update($vitalsData);

	    				if($vitalsUpdate){
	    					array_push($responseFlag,1);
	    				}	

		    	}
	    	}
	    	else{
	    		if(!empty($weight) || !empty($height) || !empty($bmi) || !empty($bloodGroup) || 
		    	   !empty($systolicPressure) || !empty($diastolicPressure)  ||
		    	   !empty($spo2) || !empty($pulse) || !empty($respiratoryRate) || !empty($temperature) )
		    	{
		    		//echo "One or more values are there";
		    		$vitalsData = array('weight' => $weight,
		    							'height' => $height,
		    							'bmi' => $bmi,
		    							'blood_group' => $bloodGroup,
		    							'systolic_pressure' => $systolicPressure,
	    								'diastolic_pressure' => $diastolicPressure,
		    							'sp'=> $spo2,
		    							'pulse' => $pulse,
		    							'respiratoryrate' =>$respiratoryRate,
		    							'temperature'=>$temperature,
		    							'id_patient' => $patientId,
		    							'id_doctor'=>$doctorId,
		    							'vitals_reference'=>$referenceId,
		    							'created_date' => $createdDate);
		    		$vitalsSave = DB::table('vitals')->insert($vitalsData);

		    		if($vitalsSave){
	    					array_push($responseFlag,2);
	    			}	
		    	}
	    	}
	    	//-------------------------------------------------------------------------------------------------


	    	//Cardio examination
	    	(!empty($input['cvs']))?$cvs = $input['cvs']:$cvs="";
	    	(!empty($input['cvs_comments']))?$cvsComments = $input['cvs_comments']:$cvsComments="";
	    	(!empty($input['lungs']))?$lungs = $input['lungs']:$lungs="";
	    	(!empty($input['lungs_comments']))?$lungsComments = $input['lungs_comments']:$lungsComments="";
	    	(!empty($input['abdomen']))?$abdomen = $input['abdomen']:$abdomen="";
	    	(!empty($input['abdomen_comments']))?$abdomenComments = $input['abdomen_comments']:$abdomenComments="";
	    	(!empty($input['ecg']))?$ecg = $input['ecg']:$ecg="";
	    	(!empty($input['ecg_comments']))?$ecgComments = $input['ecg_comments']:$ecgComments="";

	    	$cardiacExamData = DB::table('cardiac_examination')
	    									->where('id_patient','=',$patientId)
    										->where('created_date', DB::raw("(select max(`created_date`) from cardiac_examination where id_patient='$patientId')"))
    										->where('cardiac_reference','=',$referenceId)
    										->get();

	    	if(!empty($cardiacExamData)){
	    		if(!empty($cvs) || !empty($cvsComments) || !empty($lungs) || !empty($lungsComments) ||
	    		   !empty($abdomen) || !empty($abdomenComments) || !empty($ecg) || !empty($ecgComments)){
	    			$cardiacExam = array('cvs_status'=>$cvs,
	    								 'cvs_comments'=>$cvsComments,
	    								 'lungs_status'=>$lungs,
	    								 'lungs_comments'=>$lungsComments,
	    								 'abdomen_status'=>$abdomen,
	    								 'abdomen_comments'=>$abdomenComments,
	    								 'ecg_status'=>$ecg,
	    								 'ecg_comments'=>$ecgComments,
	    								 'id_doctor'=>$doctorId,
	    								 'edited_date'=>$createdDate);

	    			$cardiacExamUpdate = DB::table('cardiac_examination')
	    												->where('id_patient','=',$patientId)
	    												->where('cardiac_reference','=',$referenceId)
	    												->update($cardiacExam);
	    			if($cardiacExamUpdate){
	    					array_push($responseFlag,1);
	    			}	
	    		}
	    	}
	    	else{
	    		if(!empty($cvs) || !empty($cvsComments) || !empty($lungs) || !empty($lungsComments) ||
	    		   !empty($abdomen) || !empty($abdomenComments) || !empty($ecg) || !empty($ecgComments)){
	    			$cardiacExam = array('cvs_status'=>$cvs,
	    								 'cvs_comments'=>$cvsComments,
	    								 'lungs_status'=>$lungs,
	    								 'lungs_comments'=>$lungsComments,
	    								 'abdomen_status'=>$abdomen,
	    								 'abdomen_comments'=>$abdomenComments,
	    								 'ecg_status'=>$ecg,
	    								 'ecg_comments'=>$ecgComments,
	    								 'id_doctor'=>$doctorId,
	    								 'id_patient'=>$patientId,
	    								 'cardiac_reference'=>$referenceId,
	    								 'created_date'=>$createdDate);

	    			$cardiacExamSave = DB::table('cardiac_examination')->insert($cardiacExam);
	    			if($cardiacExamSave){
	    					array_push($responseFlag,2);
	    			}	
	    		}
	    	}
	    	//-----------------------------------------------------------------------------------------------

	    	if(in_array(1, $responseFlag)){
	    		return Redirect::to('doctor/cardioexamination')->with(array('success'=>"Data updated successfully"));
	    	}
	    	elseif (in_array(2, $responseFlag)) {
	    		return Redirect::to('doctor/cardioexamination')->with(array('success'=>"Data saved successfully"));
	    	}
	    	else
	    	{
	    		return Redirect::to('doctor/cardioexamination')->with(array('success'=>"Data saved successfully"));
	    	}
	    }
	    else{	
			return Redirect::to('doctor/cardiopersonalinformation')->with(array('error'=>'Please save patient personal information'));
			    	
		}	

    }

    public function showCardiacDiagnosis(){
		$patientId 		= Session::get('patientId');
		$doctorId 		= Session::get('doctorId');
		$symptomsArray = array();

		if(!empty($doctorId)){
			if(!empty($patientId)){
				$patientPersonalData 	= PatientsModel::where('id_patient','=',$patientId)->first();
				$doctorData 			= DoctorsModel::where('id_doctor','=',$doctorId)->first();
				
		     
				$diseases =  DB::table('diseases')->select('disease_name')->orderBy('disease_name', 'asc')->lists('disease_name', 'disease_name'); 
				$symptoms =  DB::table('symptoms')->select('symptoms')->orderBy('symptoms', 'asc')->lists('symptoms','symptoms'); 

				


				$diag = DB::table('diagnosis')
											->where('id_patient','=',$patientId)
											->where('created_date', DB::raw("(select max(`created_date`) from diagnosis where id_patient='$patientId')"))
											->where('id_diagnosis', DB::raw("(select max(`id_diagnosis`) from diagnosis where id_patient='$patientId')"))
											->first();



				return View('cardiodiagnosis',array('diseases'=>$diseases,'diag'=>$diag,'symptoms'=>$symptoms,'patientPersonalData'=>$patientPersonalData,'doctorData'=>$doctorData));
			}
			else{
				return Redirect::to('doctorhome')->with(array('error'=>"You are not authorised to view the page"));
			}
		}
		else{
			return Redirect::to('logout');
		}
		
			
		

		
	}
	public function showCardiacLabdata(){
		$patientId = Session::get('patientId');
		$doctorId 		= Session::get('doctorId');

		if(!empty($doctorId)){
			if(!empty($patientId)){
				$patientPersonalData 	= DB::table('patients')->where('id_patient','=',$patientId)->first();
					$doctorData 	= DB::table('doctors')->where('id_doctor','=',$doctorId)->first();
					return View('cardiolabdata',array('patientPersonalData'=>$patientPersonalData,'doctorData'=>$doctorData));
				
			}
			else{
				return Redirect::to('doctorhome')->with(array('error'=>"You are not authorised to view the page"));
			}
		}
		else{
			return Redirect::to('logout');
		}
	}	
			
		


		
	public function addCardioDiagnosis(){
    	
		$input 				= Request::all();
    	$patientId 			= Session::get('patientId'); 
        $doctorId 	 		= Session::get('doctorId');
        $referenceId 		= Session::get('referenceId'); 
        $createdDate 		= date('Y-m-d h:i:s');
		
		//dd($input);
		
		$doctorData 			= DoctorsModel::where('id_doctor','=',$doctorId)->first();
		$patientPersonalData 	= PatientsModel::where('id_patient','=',$patientId)->first();
		
	
     
		$diseases 	  =  DB::table('diseases')->select('disease_name')->orderBy('disease_name', 'asc')->lists('disease_name', 'disease_name'); 
		$symptoms =  DB::table('symptoms')->select('symptoms')->orderBy('symptoms', 'asc')->lists('symptoms','symptoms'); 

					

		
		
    
    	
        $patientExistCheck = DB::table('patients')->where('id_patient','=',$patientId)->count();

        if($patientExistCheck>0){
        	$diagExistCheck = DB::table('diagnosis')
        	                            ->where('id_patient','=',$patientId)
        	                            ->where('diag_reference','=',$referenceId)
        	                            ->first();
    											
	    	(!empty($input['symptoms']))?$symptoms= $input['symptoms']:$symptoms =[""];
	    	(!empty($input['syndromes']))?$syndromes= $input['syndromes']:$syndromes ="";
	    	(!empty($input['diseases']))?$diseases= $input['diseases']:$diseases =[""];
	    	(!empty($input['additional_comment']))?$additionalComment= $input['additional_comment']:$additionalComment ="";

	    	
		
	    			
	    	if(!empty($diagExistCheck)){
	    		$diseases = array_filter($diseases);
	    		$symptoms = array_filter($symptoms);
	    		$diagData = array('diag_symptoms'			=>json_encode($symptoms),
	    						  'diag_syndromes'			=>$syndromes,
	    						  'diag_suspected_diseases'	=>json_encode($diseases),
	    						  'diag_comment' 			=> $additionalComment,
	    						  'id_doctor' 				=>$doctorId,
	    						  'edited_date'				=>$createdDate
	    						);
	    		
	    		
	    		
	    		

		    	if(empty($symptoms) && empty($syndromes) && empty($diseases) && empty($additionalComment))
		    	{
		    		return Redirect::to('doctor/cardiodiagnosis')->with(array('error'=>"Failed to update data. Please fill the empty fields"));	
		    	}
		    	else{
		    		$diagUpdate = DB::table('diagnosis')
		    		                            ->where('id_patient','=',$patientId)
		    		                            ->where('diag_reference','=',$referenceId)
		    		                            ->update($diagData);
		    		
		    		if($diagUpdate){
		    			
		    			return Redirect::to('doctor/cardiodiagnosis')->with(array('success'=>"Data updated successfully",'newSymptoms'=>$symptoms));	
		    		}
		    		else{
		    		//echo "dises nsss ok";
		    			return Redirect::to('doctor/cardiodiagnosis')->with(array('error'=>"Failed to update data."));	
		    		}	
		    	}

	    	}
	    	else{

	    		$diseases = array_filter($diseases);
	    		$symptoms = array_filter($symptoms);
	    		$diagData = array('diag_symptoms'				=>json_encode($symptoms),
		    						  'diag_syndromes'			=>$syndromes,
		    						  'diag_suspected_diseases'	=>json_encode($diseases),
		    						  'diag_comment' 			=> $additionalComment,
		    						  'id_patient'				=>$patientId,
		    						  'id_doctor'				=>$doctorId,
		    						  'diag_reference' 			=> $referenceId,
		    						  'created_date'			=>$createdDate);


		    	if(empty($symptoms) && empty($syndromes) && empty($diseases) && empty($additionalComment))
		    	{
		    		return Redirect::to('doctor/cardiodiagnosis')->with(array('error'=>"Failed to save data. Please fill the empty fields"));	
		    	}
		    	else{
		    		$diagSave = DB::table('diagnosis')->insert($diagData);
		    		if($diagSave){
		    			return Redirect::to('doctor/cardiodiagnosis')->with(array('success'=>"Data saved successfully"));	
		    		}
		    		else{
		    		//echo "dises nsss ok";
		    			return Redirect::to('doctor/cardiodiagnosis')->with(array('error'=>"Failed to save data."));	
		    		}
		    	}



	    	}		

        }
        else{
        	return Redirect::to('doctor/cardiodiagnosis')->with(array('error'=>"Please save patient personal data "));	
        }	

    	

    
    }


	public function showMigration(){
		$str = file_get_contents('http://localhost/doctorsdiary1/public/Diagnosis.json');
		$json = json_decode($str, true);

		//var_dump(json_encode($json));
		//return view('migration');


		$obsDataArray = array();
		$obsArray = array();
		$vitalsArray = array();
		$diagExamArray = array();
		$diagArray = array();

		
	
		foreach($json as $index=> $val){

			//var_dump($val);
			$newVal = (object) $val;

			foreach($newVal as $index=> $jsonData){
				(isset($jsonData['patientID']))?$patientId = $jsonData['patientID']: $patientId = "";
				(isset($jsonData['typeFlag']))?$typeFlag = $jsonData['typeFlag']: $typeFlag = "";

				if($typeFlag==1){
						(isset($jsonData['objectId']))?$objectId = $jsonData['objectId']: $objectId = "";
						(isset($jsonData['Pregnancy_Term']))?$pregnancyTerm = $jsonData['Pregnancy_Term']: $pregnancyTerm = "";
						(isset($jsonData['Pregnency_Type']))?$pregnancyKind = $jsonData['Pregnency_Type']: $pregnancyKind = "";
						(isset($jsonData['Pregnency_Abortion']))?$pregnancyAbortion = $jsonData['Pregnency_Abortion']: $pregnancyAbortion = "";
						(isset($jsonData['Pregnency_Gender']))?$pregnancyGender = $jsonData['Pregnency_Gender']: $pregnancyGender = "";
						(isset($jsonData['Pregnency_Week']))?$pregnancyWeek = $jsonData['Pregnency_Week']: $pregnancyWeek = "";
						(isset($jsonData['Pregnency_Year']))?$pregnancyYear = $jsonData['Pregnency_Year']: $pregnancyYear = "";
						(isset($jsonData['Pregnency_live']))?$pregnancyHealth = $jsonData['Pregnency_live']: $pregnancyHealth = "";
						(isset($jsonData['pregnency_normal']))?$pregnancyType = $jsonData['pregnency_normal']: $pregnancyType = "";
						(isset($jsonData['createdAt']))?$createdDate = $jsonData['createdAt']: $createdDate = "";
						(isset($jsonData['updatedAt']))?$updatedDate = $jsonData['updatedAt']: $updatedDate = "";

						$createdDate = preg_split( '/(T| Z)/', $createdDate);
						$createdTime = explode(".",$createdDate[1]);

						

						if(!empty($updatedDate)){
							$updatedDate = preg_split( '/(T| Z)/', $updatedDate);
						}
						else{
							$updatedDate = "";
						}

						



						//Pregnancy Data

						if(!empty($pregnancyTerm) || !empty($pregnancyKind) || !empty($pregnancyAbortion) || !empty($pregnancyGender) || !empty($pregnancyWeek) || !empty($pregnancyYear) || !empty($pregnancyHealth) || !empty($pregnancyType)){
						
							
							$pregnancyKind = $pregnancyKind[0];
							$pregnancyType = $pregnancyType[0];
							$pregnancyTerm = $pregnancyTerm[0];
							$pregnancyAbortion = $pregnancyAbortion[0];
							$pregnancyGender = $pregnancyGender[0];
							$pregnancyWeek = $pregnancyWeek[0];
							$pregnancyYear = $pregnancyYear[0];
							$pregnancyHealth = $pregnancyHealth[0];
							

							$pregnancyTerm = explode(',',$pregnancyTerm);
							$pregnancyKind = explode(',',$pregnancyKind);
							$pregnancyAbortion = explode(',',$pregnancyAbortion);
							$pregnancyGender = explode(',',$pregnancyGender);
							$pregnancyWeek = explode(',',$pregnancyWeek);
							$pregnancyYear = explode(',',$pregnancyYear);
							$pregnancyHealth = explode(',',$pregnancyHealth);
							$pregnancyType = explode(',',$pregnancyType);

							
							foreach($pregnancyKind as $index=> $pregnancyKindVal){
								
								(isset($pregnancyKind[$index]))?$pregnancyKind = $pregnancyKind[$index]: $pregnancyKind = "";
								
								(isset($pregnancyType[$index]))?$pregnancyType= $pregnancyType[$index]: $pregnancyType = "";
								
								(isset($pregnancyTerm[$index]))?$pregnancyTerm = $pregnancyTerm[$index]: $pregnancyTerm = "";
								
								(isset($pregnancyAbortion[$index]))?$pregnancyAbortion = $pregnancyAbortion[$index]: $pregnancyAbortion = "";
								
								(isset($pregnancyHealth[$index]))?$pregnancyHealth = $pregnancyHealth[$index]: $pregnancyHealth = "";

								
								(isset($pregnancyYear[$index]))?$pregnancyYear = $pregnancyYear[$index]: $pregnancyYear = "";
									
								
								(isset($pregnancyWeek[$index]))?$pregnancyWeek = $pregnancyWeek[$index]: $pregnancyWeek = "";
								
								(isset($pregnancyGender[$index]))?$pregnancyGender = $pregnancyGender[$index]: $pregnancyGender = "";
								
							
								$pregData = array('id_patient' 			=> $patientId,
										      
										      'obs_preg_kind' 		=> $pregnancyKind,
										      'obs_preg_type' 		=> $pregnancyType,
										      'obs_preg_term' 		=> $pregnancyTerm,
										      'obs_preg_abortion' 	=> $pregnancyAbortion,
										      'obs_preg_health' 	=> $pregnancyHealth,
										      'obs_preg_gender' 	=> $pregnancyGender,
										      'obs_preg_years' 		=> $pregnancyYear,
										      'obs_preg_weeks' 		=> $pregnancyWeek,
										      'created_date' 		=> $createdDate[0]." ".$createdTime[0],
										      'edited_date' 		=> $updatedDate[0]
										     );

								//DB::table('sp_gynaecology_obs_preg')->insert($pregData);
								
							}

						}	

				}
				else{

					isset($jsonData['days'])?$days = $jsonData['days']: $days ="";
					isset($jsonData['dosage'])?$dosage = $jsonData['dosage']: $dosage ="";
					isset($jsonData['drug'])?$drug = $jsonData['drug']: $drug ="";
					isset($jsonData['drugStartDate'])?$drugStartDate = $jsonData['drugStartDate']: $drugStartDate ="";
					isset($jsonData['duration'])?$duration = $jsonData['duration']: $duration ="";
					isset($jsonData['quantity'])?$quantity = $jsonData['quantity']: $quantity ="";
					isset($jsonData['followup'])?$followupDate = $jsonData['followup']: $followupDate ="";
					isset($jsonData['treatment'])?$treatment = $jsonData['treatment']: $treatment ="";
					isset($jsonData['createdAt'])?$createdDate = $jsonData['createdAt']: $createdDate ="";
					isset($jsonData['updatedAt'])?$updatedDate = $jsonData['updatedAt']: $updatedDate ="";

					//Prescription Treatment
					isset($jsonData['lineoftreatment'])?$lineOfTreatment = $jsonData['lineoftreatment']: $lineOfTreatment ="";
					isset($jsonData['general_exercise'])?$generalExercise = $jsonData['general_exercise']: $generalExercise ="";
					isset($jsonData['general_diet'])?$generalDiet = $jsonData['general_diet']: $generalDiet ="";
					isset($jsonData['general_diet_highprotein'])?$generalDietHighProtein = $jsonData['general_diet_highprotein']: $generalDietHighProtein ="";
					isset($jsonData['exercise'])?$exercise = $jsonData['exercise']: $exercise ="";
					
					/*$newCreatedDate = substr($createdDate, 0, 10);
					$createdTime = substr($createdDate, 11, 8);*/

					$newCreatedDate = preg_split( '/(T| Z)/', $createdDate);
					$createdTime = explode(".",$newCreatedDate[1]);
					$originalCreatedDate = $newCreatedDate[0]." ".$createdTime[0];
					$editedDate = preg_split( '/(T| Z)/', $updatedDate);
							

					

					if(!empty($drug)){
						foreach($drug as $index=>$drugVal){
							
							if(!empty($followupDate)){
								$newFollowupDate = substr($updatedDate, 0, 10);
							}
							else{
								$newFollowupDate = "";
							}

							
							

							if(!empty($quantity[$index])){
							//var_dump($quantity[$key]);
								if(($quantity[$index]=="o.d(once per day)") || ($quantity[$index]=="o.p.d(once per day)")){
									//echo "Vyshah";
									$morning = 1;
									$noon = "";
									$night = "";

								}
								elseif($quantity[$index]=="BDS/bds(twice daily)"){
									$morning = 1;
									$noon =1;
									$night = "";
								}
								elseif ($quantity[$index]=="t.d.s(three times a day)") {
									$morning = 1;
									$noon = 1;
									$night = 1;
								}
								elseif ($quantity[$index]=="h.s.(at bedtime)") {
									$morning = "";
									$noon = "";
									$night = 1;
								}
								else{
									$morning = "";
									$noon = "";
									$night = "";
								}
							}
						

						$insertValue = array(	'drug_name' => $drug[$index],
		    									'dosage' => $dosage[$index],
		    									'dosage_unit' => "",
		    									'duration' => $duration[$index],
		    									'duration_unit' => "Days",
		    									'morning' => $morning,
		    									'noon' => $noon,
		    									'night' => $night,
		    									'start_date' =>$drugStartDate[$index],
		    									'instruction' => "",
		    									'food_status' => "",
		    									'follow_up_date' => $followupDate,
		    									'treatment' => $treatment,
		    									'id_patient' => $patientId,
		    									'created_date' => $originalCreatedDate,
		    									'edited_date'=>$editedDate[0]
		    									
		    									);

						//DB::table('prescription')->insert($insertValue);
							
						}
					
					}

					if(!empty($lineOfTreatment)){
					

					$prescLineOfTreatment = explode(',',$lineOfTreatment);
					$prescGeneralExercise = explode(',',$generalExercise);
					$prescGeneralDietHighProtein = explode(',',$generalDietHighProtein);
					
					$generalDiet = (array) $generalDiet;
					$generalProtein = (array) $prescGeneralDietHighProtein[0];
					$generalDietOther = $prescGeneralDietHighProtein[1];	

					$generaDietArray = array_merge($generalDiet,$generalProtein);				


					
					echo "<br>";

					$prescGynData = array(	'line_of_treatment' => $prescLineOfTreatment[0],
										   	'line_of_treatment_detail' => $prescLineOfTreatment[1],
										   	'presc_general_exercise'=>$prescGeneralExercise[0],
										   	'presc_general_exercise_detail'=>$prescGeneralExercise[1],
										   	'presc_general_diet' =>json_encode($generaDietArray),
										   	'presc_general_diet_detail'=>$generalDietOther,
										   	'presc_exercise'=>$exercise,
										   	'id_patient' => $patientId,
										   	'created_date' => $originalCreatedDate,
										   	'edited_date'=>$editedDate[0]
										  );
					DB::table('prescription_gynaecology')->insert($prescGynData);

	/*				$prescGynData = array(	'line_of_treatment' => $prescLineOfTreatment[0],
										   	'line_of_treatment_detail' => $prescLineOfTreatment[1],
										   	'presc_general_exercise'=>$prescGeneralExercise[0],
										   	'presc_general_exercise_detail'=>$prescGeneralExercise[1],
										    'presc_general_diet' => $generalDietFinal,
										   	'presc_general_diet_detail'=>$generalOther,	
										   	'presc_exercise'=>$exercise,
										   	'id_patient' => $patientId,
										   	'created_date' => $originalCreatedDate,
		    								'edited_date'=>$editedDate
		    								

										   );
					

									 
					DB::table('prescription_gynaecology')->insert($prescGynData);*/

				}
					


				}

				
				
				
				
				
			}
			
		}
			
			
	}	

}
