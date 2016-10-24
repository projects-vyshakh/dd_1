<?php namespace App\Http\Controllers;
use Input;
use DB;
use Log;
use App\Quotation;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Contracts\Routing\ResponseFactory;
use Session;
use Request;
use App\classes\DBUtils;
use App\classes\DOMPDF;
use Carbon\Carbon;
use App\classes\DBAuth;
use App;
use PDF;
use View;
//use Illuminate\Support\Collection::sortBy();

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

	public function showCardioMedicalHistory(){

		$patientId 	= Session::get('patientId');
		$doctorId  = Session::get('doctorId');
		$patientPersonalData 	= DB::table('patients')->where('id_patient','=',$patientId)->first();
		$doctorData 	= DB::table('doctors')->where('id_doctor','=',$doctorId)->first();
      

		$medicalHistory = DB::table('cardiac_medical_history')
									->where('id_patient','=',$patientId)
									->where('created_date', DB::raw("(select max(`created_date`) from cardiac_medical_history)"))
									->get();

		$medicalHistoryPresentPastMore = DB::table('cardiac_medical_history_present_past_more')
													->where('id_patient','=',$patientId)
													
													->distinct('illness_name')
													->get();
/*
		$medicalHistoryPresentPastMore = DB::table('medical_history_present_past_more')
													->where('id_patient','=',$patientId)
													->get();*/

		$surgeryHistory = DB::table('medical_history_surgical')->where('id_patient','=',$patientId)->get();

		$drugAllergyHistory = DB::table('medical_history_drug_allergy')->where('id_patient','=',$patientId)->get();
		
		
		return view('cardiomedicalhistory',array('medicalHistory'=>$medicalHistory,'medicalHistoryPresentPastMore'=>$medicalHistoryPresentPastMore,'surgeryHistory'=>$surgeryHistory,'drugAllergyHistory'=>$drugAllergyHistory,'patientPersonalData'=>$patientPersonalData,'doctorData'=>$doctorData));
	}


	public function addCardioMedicalHistory(){
		$input = Request::all();
    	var_dump(json_encode($input));

    	
	
    	$referenceId = Session::get('referenceId');
	    $patientId   = Session::get('patientId');
	    $doctorId    = Session::get('doctorId');
	    $createdDate = date('Y-m-d H:i:s');
	    $specializationText = '2';

	    //var_dump(json_encode($input));
	    //die();

	    $patientExistCheck = DB::table('patients')->where('id_patient','=',$patientId)->count();

	    $medicalHistoryExist = DB::table('cardiac_medical_history')
	    										->where('id_patient','=',$patientId)
	    										->where('medical_history_reference','=',$referenceId)
	    										->count();


	    if($patientExistCheck>0)
	    {
	    	
	    	(!empty($input['father']))?$fatherHistory = $input['father']:$fatherHistory = ['NA'];
	    	(!empty($input['father_other']))?$fatherHistoryOther = $input['father_other']:$fatherHistoryOther = '';
	    	(!empty($input['mother']))?$motherHistory = $input['mother']:$motherHistory = ['NA'];
	    	(!empty($input['mother_other']))?$motherHistoryOther = $input['mother_other']:$motherHistoryOther = '';
	    	(!empty($input['sibling']))?$siblingHistory = $input['sibling']:$siblingHistory = ['NA'];
	    	(!empty($input['sibling_other']))?$siblingHistoryOther = $input['sibling_other']:$siblingHistoryOther = '';
	    	(!empty($input['grandfather']))?$grandfatherHistory = $input['grandfather']:$grandfatherHistory = ['NA'];
	    	(!empty($input['grandfather_other']))?$grandfatherHistoryOther = $input['grandfather_other']:$grandfatherHistoryOther = '';
	    	(!empty($input['grandmother']))?$grandmotherHistory = $input['grandmother']:$grandmotherHistory = ['NA'];
	    	(!empty($input['grandmother_other']))?$grandmotherHistoryOther = $input['grandmother_other']:$grandmotherHistoryOther = '';
	    	(!empty($input['allergy_general']))?$allergyGeneral = $input['allergy_general'] : $allergyGeneral=['NA'];
	    	(!empty($input['alcohol']))?$alcohol = $input['alcohol']:$alcohol = "NA";
    		(!empty($input['tobaco-smoke']))?$tobacoSmoke = $input['tobaco-smoke']:$tobacoSmoke = "NA";
    		(!empty($input['tobaco-chew']))?$tobacoChew = $input['tobaco-chew']:$tobacoChew = "NA";
    		(!empty($input['other-social-history']))?$OtherSocialHistory = $input['other-social-history']:$OtherSocialHistory = "NA";
    		(!empty($input['other_medical_history']))?$otherMedicalHistory = $input['other_medical_history']:$otherMedicalHistory = "";

    		//Addmore illness
    		
    		//Surgery History
    		(!empty($input['surgery']))?$surgery = $input['surgery']:$surgery = "";
    		

    		//Allergy History
	    	(!empty($input['medication-drug-allergy']))?$allergyMedication = $input['medication-drug-allergy']: $allergyMedication="";
	    	(!empty($input['reaction-drug-allergy']))?$allergyReaction= $input['reaction-drug-allergy']: $allergyReaction="";
	    	
	    	//(!empty($input['allergy_counter']))?$allergyCounter = $input['allergy_counter']:$allergyCounter=0;

	    	if($medicalHistoryExist>0){
	    		
	    		if( !empty($input['father']) || !empty($input['mother']) ||
		    	   !empty($input['sibling']) || !empty($input['grandfather']) || !empty($input['grandmother']) ||
		    	   !empty($input['allergy_general']) || !empty($input['alcohol']) || !empty($input['tobaco-smoke']) || !empty($input['tobaco-chew'])  || !empty($input['other-social-history']))
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
			    					   'history_prev_intervention_anaesthesia' => $otherMedicalHistory,
			    					   'id_doctor' => $doctorId,
			    					   'edited_date' => $editedDate);

    				$dataUpdate = DB::table('cardiac_medical_history')
    												->where('id_patient','=',$patientId)
    												->where('medical_history_reference','=',$referenceId)
    												->update($dataArray);
    			}

    			//Add more illness
    			$this->illnessSurgeryDrugInsert($input,$surgery,$allergyMedication,$allergyReaction,$patientId,$doctorId,$referenceId,$createdDate,$specializationText);

    			return Redirect::to('cardiomedicalhistory')->with(array('success'=>"Data updated successfully"));

	    	}
	    	else{
	    		
	    		if( !empty($input['father']) || !empty($input['mother']) ||
		    	   !empty($input['sibling']) || !empty($input['grandfather']) || !empty($input['grandmother']) ||
		    	   !empty($input['allergy_general']) || !empty($input['alcohol']) || !empty($input['tobaco-smoke']) || !empty($input['tobaco-chew'])  || !empty($input['other-social-history']))
    			{

    				echo "MedicalEx<0"; 
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
			    					   'history_prev_intervention_anaesthesia' => $otherMedicalHistory,
			    					   'id_patient' => $patientId,
			    					   'id_doctor' => $doctorId,
			    					   'created_date' => $createdDate);

    				$dataInsert = DB::table('cardiac_medical_history')->insert($dataArray);
	    		}
	    		

	    		$this->illnessSurgeryDrugInsert($input,$surgery,$allergyMedication,$allergyReaction,$patientId,$doctorId,$referenceId,$createdDate,$specializationText);

	    		//return Redirect::to('cardiomedicalhistory')->with(array('success'=>"Data saved successfully"));

	    	}

      	
	    }
	    else{
	    	return Redirect::to('cardiomedicalhistory')->with(array('error'=>"Please save patient personal information"));
	    }	


	}

    public function showCardioExamination(){
    	$patientId = Session::get('patientId');
    	$doctorId = Session::get('doctorId');
		$patientPersonalData 	= DB::table('patients')->where('id_patient','=',$patientId)->first();
		$doctorData 	= DB::table('doctors')->where('id_doctor','=',$doctorId)->first();

        
		$bloodGroup = DB::table('business_key_details')->where('business_key', '=', 'BLOOD_GROUP')->lists('business_value', 'business_value');
		$diagNormalAbnormal = DB::table('business_key_details')->where('business_key', '=', 'GENERAL_NORMAL_ABNORMAL')->lists('business_value', 'business_value');
		$diagYesNo = DB::table('business_key_details')->where('business_key', '=', 'GENERAL_YES_NO')->lists('business_value', 'business_value');
		$diagAvafRvrf = DB::table('business_key_details')->where('business_key', '=', 'DIAGNOSIS_PELVIC_AVAF_RVRF')->lists('business_value', 'business_value');

		$vitalExist = DB::table('vitals')->where('id_patient','=',$patientId)
										 ->where('id_vitals', DB::raw("(select max(`id_vitals`) from vitals where id_patient = '$patientId')"))
										 ->first();

		$diagExam = DB::table('diagnosis_gynaecology_exam')->where('id_patient','=',$patientId)
										 ->where('id_diag_gynaecology_exam', DB::raw("(select max(`id_diag_gynaecology_exam`) from diagnosis_gynaecology_exam where id_patient = '$patientId')"))
										 ->first();								 

		if(!in_array('', $bloodGroup)){
		     	 array_unshift($bloodGroup, '');
		}
		if(!in_array('', $diagNormalAbnormal)){
		     	 array_unshift($diagNormalAbnormal, '');
		}
		if(!in_array('', $diagAvafRvrf)){
		     	 array_unshift($diagAvafRvrf, '');
		}
		if(!in_array('', $diagYesNo)){
		     	 array_unshift($diagYesNo, '');
		}
		return view('cardioexamination',array('bloodGroup'=>$bloodGroup,'diagNormalAbnormal'=>$diagNormalAbnormal,'diagYesNo'=>$diagYesNo,'diagAvafRvrf'=>$diagAvafRvrf,'vitalExist'=>$vitalExist,'diagExam'=>$diagExam,'patientPersonalData'=>$patientPersonalData,'doctorData'=>$doctorData));
    }

    public function cardiacExam(){
    	echo "sdsdsdsd";

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


					print_r($originalCreatedDate);
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
