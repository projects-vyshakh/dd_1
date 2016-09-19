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
use App\classes\DBJsonFiles;
use Response;

class APIController extends Controller {

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
	
/*	public function __construct()
	{
		$this->auths();

	}*/

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */



	public function diagnosisMigrationService(){

		//return view('migaration');
		
		$input = Request::all();
		//$input = (object) $input;
		//var_dump($input);
		//echo count($input);
		$obsDataArray = array();
		$obsArray = array();
		$vitalsArray = array();
		$diagExamArray = array();
		$diagArray = array();

		//$testFile = json_decode($input);

		//print_r($input);
		/*foreach($input as $index){
			
			foreach($index as $indexVal){
				
				$indexVal = (object) $indexVal;
				//var_dump($indexVal);
				(isset($indexVal->patientID))?$patientId = $indexVal->patientID: $patientId = "";
				isset($indexVal->days)?$days = $indexVal->days : $days = "";
				isset($indexVal->dosage)?$dosage = $indexVal->dosage : $dosage = "";
				isset($indexVal->drug)?$drug = $indexVal->drug : $drug = "";
				$days = (array) $days;
				$dosage = (array) $dosage;
				$drug = (array) $drug;

				var_dump($days);

				foreach($days as $key => $newDays){
					

					isset($days[$key])?$days = $days[$key]: $days="";
					isset($dosage[$key])?$dosage = $dosage[$key]: $dosage="";
					isset($drug[$key])?$drug = $drug[$key]: $drug = "";
					
					echo $key;
					
				}
				
			}
			
		}*/

		//die();
	
		foreach($input as $index=> $val){
			
			foreach($val as $index=>$val1){

				(isset($val1['patientID']))?$patientId = $val1['patientID']: $patientId = "";
				(isset($val1['typeFlag']))?$typeFlag = $val1['typeFlag']: $typeFlag = "";


				//var_dump(json_encode($val1['Lmp_date']));
				
				if($typeFlag==1){
					
					(isset($val1['Married_Life']))?$marriedLife = $val1['Married_Life']: $marriedLife = "";
					(isset($val1['Gravida']))?$gravida = $val1['Gravida']: $gravida = "";
					(isset($val1['Husband_Blood_Group']))?$husbandBloodGroup = $val1['Husband_Blood_Group']: $husbandBloodGroup = "";
					(isset($val1['Para']))?$para = $val1['Para']: $para = "";
					(isset($val1['Living']))?$living = $val1['Living']: $living = "";
					(isset($val1['Abortion']))?$abortion = $val1['Abortion']: $abortion = "";
					(isset($val1['CreatedAt']))?$createdDate = $val1['CreatedAt']: $createdDate = "";
					(isset($val1['Lmp_date']))?$lmpDate = $val1['Lmp_date']: $lmpDate = "";
					(isset($val1['Lmp_dysmenorrhea']))?$lmpDysmenorrhea = $val1['Lmp_dysmenorrhea']: $lmpDysmenorrhea = "";
					(isset($val1['Lmp_flow']))?$lmpFlow = $val1['Lmp_flow']: $lmpFlow = "";
					(isset($val1['Menstrual_Days']))?$lmpDays = $val1['Menstrual_Days']: $lmpDays = "";
					(isset($val1['Menstrual_Cycle']))?$lmpCycle = $val1['Menstrual_Cycle']: $lmpCycle = "";
					(isset($val1['Menstrual_Regular_Irregular']))?$lmpType = $val1['Menstrual_Regular_Irregular']: $lmpType = "";
					(isset($val1['Pregnency_EDD']))?$expectedDeliveryDate = $val1['Pregnency_EDD']: $expectedDeliveryDate = "";
					(isset($val1['Pregnency_LDD']))?$lastDeliveryDate = $val1['Pregnency_LDD']: $lastDeliveryDate = "";
					(isset($val1['Pregnency_DOG']))?$gestationalAge = $val1['Pregnency_DOG']: $gestationalAge = "";
					(isset($val1['createdAt']))?$createdDate = $val1['createdAt']: $createdDate = "";
					(isset($val1['updatedAt']))?$updatedDate = $val1['updatedAt']: $updatedDate = "";

					(isset($val1['Pregnancy_Term']))?$pregnancyTerm = $val1['Pregnancy_Term']: $pregnancyTerm = "";
					(isset($val1['Pregnency_Abortion']))?$pregAbortion = $val1['Pregnency_Abortion']: $pregAbortion = "";
					(isset($val1['Pregnency_Gender']))?$pregGender = $val1['Pregnency_Gender']: $pregGender = "";
					(isset($val1['Pregnency_Type']))?$pregKind = $val1['Pregnency_Type']: $pregKind = "";
					(isset($val1['Pregnency_Week']))?$pregWeek = $val1['Pregnency_Week']: $pregWeek = "";
					(isset($val1['Pregnency_Year']))?$pregYear = $val1['Pregnency_Year']: $pregYear = "";
					(isset($val1['Pregnency_live']))?$pregHealth = $val1['Pregnency_live']: $pregHealth = "";
					(isset($val1['pregnency_normal']))?$pregType = $val1['pregnency_normal']: $pregType = "";

					//Vitals
					(isset($val1['weight']))?$weight = $val1['weight']: $weight = "";
					(isset($val1['height']))?$height = $val1['height']: $height = "";
					(isset($val1['bmi']))?$bmi = $val1['bmi']: $bmi = "";
					(isset($val1['bloodgroup']))?$bloodGroup = $val1['bloodgroup']: $bloodGroup = "";
					(isset($val1['bloodpressure']))?$bloodPressure = $val1['bloodpressure']: $bloodPressure = "";
					(isset($val1['pulse']))?$pulse = $val1['pulse']: $pulse = "";
					(isset($val1['respiratoryrate']))?$respiratoryRate = $val1['respiratoryrate']: $respiratoryRate = "";
					(isset($val1['temperature']))?$temperature = $val1['temperature']: $temperature = "";
					(isset($val1['spo2']))?$spo2 = $val1['spo2']: $spo2 = "";

					//Diagnosis examination
					(isset($val1['externalgenetalia']))?$externalGenetalia = $val1['externalgenetalia']: $externalGenetalia = "";

					(isset($val1['breast_galactorrhea']))?$sysBreastGalactorrhea = $val1['breast_galactorrhea']: $sysBreastGalactorrhea = "";

					(isset($val1['breast_lump']))?$sysBreastLump = $val1['breast_lump']: $sysBreastLump = "";

					(isset($val1['breast_other']))?$sysBreastOther = $val1['breast_other']: $sysBreastOther = "";
					(isset($val1['cervix_bleeding']))?$sysPelvicCervixBleeding = $val1['cervix_bleeding']: $sysPelvicCervixBleeding = "";

					(isset($val1['cervix_healthy']))?$sysPelvicCervixHealthy = $val1['cervix_healthy']: $sysPelvicCervixHealthy = "";

					(isset($val1['cervix_lbc']))?$sysPelvicCervixLbc = $val1['cervix_lbc']: $sysPelvicCervixLbc = "";

					(isset($val1['preabdomenexamination']))?$preAbdomenExam = $val1['preabdomenexamination']: $preAbdomenExam = "";

					(isset($val1['secondarysex_acne']))?$sysSecondarySexAcne = $val1['secondarysex_acne']: $sysSecondarySexAcne = "";

					(isset($val1['secondarysex_hair']))?$sysSecondarySexHair = $val1['secondarysex_hair']: $sysSecondarySexHair = "";

					(isset($val1['secondarysex_other']))?$sysSecondarySexOther = $val1['secondarysex_other']: $sysSecondarySexOther = "";

					(isset($val1['secondarysex_welldeveloped']))?$sysSecondarySexWellDeveloped = $val1['secondarysex_welldeveloped']: $sysSecondarySexWellDeveloped = "";

					(isset($val1['uterus_avaf']))?$sysPelvicAvaf = $val1['uterus_avaf']: $sysPelvicAvaf = "";

					(isset($val1['uterus_others']))?$sysPelvicOther = $val1['uterus_others']: $sysPelvicOther = "";

					(isset($val1['uterus_rvrf']))?$sysPelvicRvrf = $val1['uterus_rvrf']: $sysPelvicRvrf = "";


					//Diagnosis

					(isset($val1['symptoms']))?$symptoms = $val1['symptoms']: $symptoms = "";

					(isset($val1['syndromes']))?$syndromes = $val1['syndromes']: $syndromes = "";

					(isset($val1['suspectedDisease']))?$suspectedDisease = $val1['suspectedDisease']: $suspectedDisease = "";

					(isset($val1['additionalComments']))?$additionalComments = $val1['additionalComments']: $additionalComments = "";

					//$pregTerm = explode(',',$pregnancyTerm);
					//var_dump($pregTerm);
				


					if(!empty($bloodPressure)){
						$bloodPressure = explode('/',$bloodPressure);
						if(!empty($bloodPressure[0])){
							$systolic = $bloodPressure[0];
						}
						else{
							$systolic = "";
						}
						if(!empty($bloodPressure[1])){
							$diastolic = $bloodPressure[1];
						}
						else{
							$diastoic = "";
						}
						
					}
					else{
						
						$systolic = "";
						$diastolic = "";

					}

					//var_dump($systolic);
					

					
					if(!empty($expectedDeliveryDate)){
						$expectedDeliveryDate = date('Y-m-d',strtotime($expectedDeliveryDate));
					}
					else{
						$expectedDeliveryDate = "";
					}

					if(!empty($lastDeliveryDate)){
						$lastDeliveryDate = date('Y-m-d',strtotime($lastDeliveryDate));
					}
					else{
						$lastDeliveryDate = "";
					}

					$mergedArray = array();
					$mergedArrayData = array();
					

					$marriedLife = preg_split( '/(yrs| months|years| month)/', $marriedLife);
					$createdDate = preg_split( '/(T| Z)/', $createdDate);
					$createdTime = explode(".",$createdDate[1]);

					if(!empty($updatedDate)){
						$updatedDate = preg_split( '/(T| Z)/', $updatedDate);
					}
					else{
						$updatedDate = "";
					}
					
				


					$obsArray =  array(   'id_patient' 					=> $patientId,
										  /*'id_doctor' 					=> $doctorId,*/
										  'married_life' 				=> $marriedLife[0],
										  'husband_blood_group' 		=> $husbandBloodGroup,
										  'gravida' 					=> $gravida,
										  'para' 						=> $para,
										  'living' 						=> $living,
										  'abortion' 					=> $abortion,
										  'obs_last_delivery_date' 		=> $lastDeliveryDate,
										  'obs_expected_delivery_date' 	=> $expectedDeliveryDate,
										  'obs_gestational_age' 		=> $gestationalAge,
										  'obs_reference' 				=> '',
										  'created_date' 				=> $createdDate[0]." ".$createdTime[0],
										  'edited_date' 				=> $updatedDate[0]);

					

						

					array_push($obsDataArray,$obsArray);
					

					//var_dump($obsArray);
					if(!empty($lmpDate) || !empty($lmpDysmenorrhea) || !empty($lmpFlow) ){
						foreach($lmpDate as $index=>$lmpDateVal){
							isset($lmpDysmenorrhea[$index])?$lmpDysmenorrhea = $lmpDysmenorrhea[$index]:$lmpDysmenorrhea = "";
							isset($lmpFlow[$index])?$lmpFlow = $lmpFlow[$index]:$lmpFlow = "";
							isset($lmpDays[$index])?$lmpDays = $lmpDays[$index]:$lmpDays = "";
							isset($lmpCycle[$index])?$lmpCycle = $lmpCycle[$index]:$lmpCycle = "";
							isset($lmpType[$index])?$lmpMensusType = $lmpType[$index]:$lmpMensusType = "";
							
							 $newLmpDate = date('Y-m-d',strtotime($lmpDate[$index]));
						

							$lmpData = array(	'obs_lmp_date' 				=> $newLmpDate,
							    		  		'obs_lmp_flow' 				=> $lmpFlow,
									      		'obs_lmp_dysmenorrhea' 		=> $lmpDysmenorrhea,
									      		'obs_menstrual_type'		=> $lmpMensusType,
									      		'obs_lmp_days' 				=> $lmpDays,
									      		'obs_lmp_cycle'  			=> $lmpCycle);
							$mergedArray = array_merge($obsArray,$lmpData);
							
							
							//DB::table('sp_gynaecology_obs')->insert($mergedArray);			      		
						}
					}

					$pregArray = array();
					if(!empty($pregKind) || !empty($pregType) || !empty($pregTerm) || !empty($pregAbortion) || 
						!empty($pregHealth) || !empty($pregWeek) || !empty($pregYear) ||!empty($pregGender)){
						/*foreach($pregKind as $index=>$pregKindVal){
							isset($pregKind[$index])?$pregKind = $pregKind[$index]:$pregKind = "";
							isset($pregType[$index])?$pregType = $pregType[$index]:$pregType = "";
							isset($pregTerm[$index])?$pregTerm = $pregTerm[$index]:$pregTerm = "";
							isset($pregAbortion[$index])?$pregAbortion = $pregAbortion[$index]:$pregAbortion = "";
							isset($pregHealth[$index])?$pregHealth = $pregHealth[$index]:$pregHealth = "";
							isset($pregWeek[$index])?$pregWeek = $pregWeek[$index]:$pregWeek = "";
							isset($pregYear[$index])?$pregYear = $pregYear[$index]:$pregYear = "";
							isset($pregGender[$index])?$pregGender = $pregGender[$index]:$pregGender = "";

							$pregKind = explode(',',$pregKind);
							$pregType = explode(',',$pregType);
							$pregTerm = explode(',',$pregTerm);


						}*/

						
						//$PregnancyTerm = explode(',',$pregTerm);
						//var_dump($PregnancyTerm);


						
					}


					

						//Vitals Data
						$vitalsData = array('weight' => $weight,
	    							'height' => $height,
	    							'bmi' => $bmi,
	    							'blood_group' => $bloodGroup,
	    							'systolic_pressure' => $systolic,
	    							'diastolic_pressure' => $diastolic,
	    							'sp'=> $spo2,
	    							'pulse' => $pulse,
	    							'respiratoryrate' =>$respiratoryRate,
	    							'temperature'=>$temperature,
	    							'id_patient' => $patientId,
	    							/*'id_doctor'=>$doctorId,*/
	    							
	    							'created_date' => $createdDate[0]." ".$createdTime[0],
	    							'edited_date' 				=> $updatedDate[0]);

						array_push($vitalsArray,$vitalsData);

						

						

					

						//Diagnosis Examination


						if( !empty($externalGenetalia) 	|| 
							!empty($preAbdomenExam) 	|| 
							!empty($sysBreastLump) 		|| 
							!empty($sysBreastGalactorrhea) || 
							!empty($sysBreastOther) 		|| 
							!empty($sysSecondarySexWellDeveloped) || 
							!empty($sysSecondarySexHair) || 
							!empty($sysSecondarySexAcne) ||
							!empty($sysSecondarySexOther) || 
							!empty($sysPelvicCervixHealthy) || 
							!empty($sysPelvicCervixBleeding) ||
							!empty($sysPelvicCervixLbc) || 
							!empty($sysPelvicAvaf) || 
							!empty($sysPelvicRvrf) ||
							!empty($sysPelvicOther) )
						{

							//$externalGenetalia = preg_split( '/(,| )/', $externalGenetalia);

							$externalGenetalia 				= explode(',',$externalGenetalia);
							$preAbdomenExam 				= explode(',',$preAbdomenExam);
							$sysBreastLump 					= explode(',',$sysBreastLump);
							$sysBreastGalactorrhea 			= explode(',',$sysBreastGalactorrhea);
							$sysBreastOther 				= explode(',',$sysBreastOther);
							$sysSecondarySexWellDeveloped 	= explode(',',$sysSecondarySexWellDeveloped);
							$sysSecondarySexHair 			= explode(',',$sysSecondarySexHair);
							$sysSecondarySexAcne 			= explode(',',$sysSecondarySexAcne);
							$sysSecondarySexOther 			= explode(',',$sysSecondarySexOther);
							$sysPelvicCervixHealthy 		= explode(',',$sysPelvicCervixHealthy);
							$sysPelvicCervixBleeding  		= explode(',',$sysPelvicCervixBleeding);
							$sysPelvicCervixLbc 			= explode(',',$sysPelvicCervixLbc);

				


							$systemicSaveData = array('diag_systemic_external_genetalia'=> $externalGenetalia[0],
    									'diag_systemic_external_genetalia_detail' => $externalGenetalia[1],
    									'diag_systemic_breast_lump' => $sysBreastLump[0],
    									'diag_systemic_breast_detail'=>$sysBreastLump[1],
    									'diag_systemic_breast_galatorrhea'=>$sysBreastGalactorrhea[0],
    									'diag_systemic_breast_galatorrhea_detail'=> $sysBreastGalactorrhea[1],
    									'diag_systemic_breast_other'=>$sysBreastOther[0],
    									'diag_systemic_breast_other_detail'=>$sysBreastOther[1],
    									'diag_systemic_secondarysex_welldeveloped'=>$sysSecondarySexWellDeveloped[0],
    									'diag_systemic_secondarysex_welldeveloped_detail'=>$sysSecondarySexWellDeveloped[1],
    									'diag_systemic_secondarysex_hair'=>$sysSecondarySexHair[0],
    									'diag_systemic_secondarysex_hair_detail'=>$sysSecondarySexHair[1],
    									'diag_systemic_secondarysex_acne'=>$sysSecondarySexAcne[0],
    									'diag_systemic_secondarysex_acne_detail'=>$sysSecondarySexAcne[1],
    									'diag_systemic_secondarysex_other'=>$sysSecondarySexOther[0],
    									'diag_systemic_secondarysex_other_detail'=>$sysSecondarySexOther[1],
    									'diag_systemic_preabdomen' => $preAbdomenExam[0],
    									'diag_systemic_preabdomen_detail'=>$preAbdomenExam[1],
    									'diag_pelvic_perspeculum_healthy'=>$sysPelvicCervixHealthy[0],
    									'diag_pelvic_perspeculum_healthy_detail'=>$sysPelvicCervixHealthy[1],
    									'diag_pelvic_perspeculum_bleeding' =>$sysPelvicCervixBleeding[0],
    									'diag_pelvic_perspeculum_bleeding_detail'=>$sysPelvicCervixBleeding[1],
    									'diag_pelvic_perspeculum_lbc' => $sysPelvicCervixLbc[0],
    									'diag_pelvic_perspeculum_lbc_detail'=>$sysPelvicCervixLbc[1],
    									'diag_pelvic_pervaginal_avaf' =>$sysPelvicAvaf,
    									'diag_pelvic_pervaginal_rfrf'=>$sysPelvicRvrf,
    									'diag_pelvic_pervaginal_others'=>$sysPelvicOther,
    									'id_patient' => $patientId,
	    								/*'id_doctor'=>$doctorId,*/
	    								'created_date' 	    => $createdDate[0]." ".$createdTime[0],
										'edited_date' 		=> $updatedDate[0]);

								array_push($diagExamArray,$systemicSaveData);

						}

						if(!empty($symptoms) || !empty($syndromes) || !empty($suspectedDisease) ||
							!empty($additionalComments)){
							//var_dump($symptoms);

							
							//$symptoms = str_replace("\n"," ",$symptoms);
							$diagData = array('diag_symptoms'=>json_encode([$symptoms]),
				    						  'diag_syndromes'=>$syndromes,
				    						  'diag_suspected_diseases'=>[$suspectedDisease],
				    						  'diag_comment' => $additionalComments,
				    						  'id_patient' => $patientId,
				    						  'created_date' 	    => $createdDate[0]." ".$createdTime[0],
											  'edited_date' 		=> $updatedDate[0]);

							array_push($diagArray, $diagData);
							//var_dump($diagData);
							
						}
					

				}
				else{

					isset($val1['days'])?$days = $val1['days']: $days ="";
					isset($val1['dosage'])?$dosage = $val1['dosage']: $dosage ="";
					isset($val1['drug'])?$drug = $val1['drug']: $drug ="";
					isset($val1['drugStartDate'])?$drugStartDate = $val1['drugStartDate']: $drugStartDate ="";
					isset($val1['duration'])?$duration = $val1['duration']: $duration ="";
					isset($val1['quantity'])?$quantity = $val1['quantity']: $quantity ="";
					isset($val1['followup'])?$followupDate = $val1['followup']: $followupDate ="";
					isset($val1['treatment'])?$treatment = $val1['treatment']: $treatment ="";
					isset($val1['createdAt'])?$createdDate = $val1['createdAt']: $createdDate ="";
					isset($val1['updatedAt'])?$updatedDate = $val1['updatedAt']: $updatedDate ="";
					if(!empty($followupDate)){
						$followupDate = date('Y-m-d',strtotime($followupDate));
					}
					else{
						$followupDate = "";
					}

					$createdDate = preg_split( '/(T| Z)/', $createdDate);
					$createdTime = explode(".",$createdDate[1]);

					if(!empty($updatedDate)){
						$updatedDate = preg_split( '/(T| Z)/', $updatedDate);
					}
					else{
						$updatedDate = "";
					}
					//$days = explode('",',$days);
					$days = (array) $days;
					$dosage = (array) $dosage;
					$drug = (array) $drug;
					$drugStartDate = (array) $drugStartDate;
					$duration = (array) $duration;
					$quantity = (array) $quantity;
					var_dump($quantity);
					foreach($days as $key=>$newDays){

						/*$days = $days[$key];
						$dosage = $dosage[$key];
						$drug = $drug[$key];
						$drugStartDate = $drugStartDate[$key];
						$duration = $duration[$key];*/
						//var_dump($quantity[$key]);
						/*if($quantity[$key]=="o.d( once per day")
						{
							echo "Vyshakh";
						}
						else{
							echo "vivek";
						}*/

						if(!empty($quantity[$key])){
							//var_dump($quantity[$key]);
							if(($quantity[$key]=="o.d(once per day)") || ($quantity[$key]=="o.p.d(once per day)")){
								//echo "Vyshah";
								$morning = 1;
								$noon = "";
								$night = "";

							}
							elseif($quantity[$key]=="BDS/bds(twice daily)"){
								$morning = 1;
								$noon =1;
								$night = "";
							}
							elseif ($quantity[$key]=="t.d.s(three times a day)") {
								$morning = 1;
								$noon = 1;
								$night = 1;
							}
							elseif ($quantity[$key]=="h.s.(at bedtime)") {
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
						//echo "<br>";
						//echo "morning-->".$morning."<br>";	
						//echo "noon-->".$noon."<br>";	
						//echo "night-->".$night."<br>";	

						$insertValue = array(	'drug_name' => $drug[$key],
		    									'dosage' => $dosage[$key],
		    									'dosage_unit' => "",
		    									'duration' => $duration[$key],
		    									'duration_unit' => "Days",
		    									'morning' => $morning,
		    									'noon' => $noon,
		    									'night' => $night,
		    									'start_date' =>$drugStartDate[$key],
		    									'instruction' => "",
		    									'food_status' => "",
		    									'follow_up_date' => $followupDate,
		    									'treatment' => $treatment,
		    									'id_patient' => $patientId
		    									/*'id_doctor' =>$doctorId,*/
		    									);

						DB::table('prescription')->insert($insertValue);




					}					
					
					
					//var_dump($days[1]);

				}
				
				//var_dump($mergedArray);
				
				//var_dump($val1['typeFlag']);
			}
			//var_dump($mergedArrayData);
			
		}

		//DB::table('sp_gynaecology_obs')->insert($obsDataArray);
		//DB::table('vitals')->insert($vitalsArray);
		 // DB::table('diagnosis')->insert($diagArray);

		//DB::table('diagnosis_gynaecology_exam')->insert($diagExamArray);
		
		//var_dump($obsDataArray);
		

		//DB::table('testServices')->insert(array('title'=>$input['diag_symptoms']));

	}



	public function doctorMigrationService(){
		$userMaster = DB::table('UserMaster')->get();
		//var_dump($userMaster);

		$doctorArray = array();

		foreach ($userMaster as $key => $userMasterVal) {
			//var_dump($userMasterVal);

			$accredition = $userMasterVal->results_accredition;
			$city = $userMasterVal->results_city;
			$street = $userMasterVal->results_street;
			$country = $userMasterVal->results_country;
			$imaRegisterNo = $userMasterVal->results_docRegistrationNumber;
			$email = $userMasterVal->results_email;
			$firstName = $userMasterVal->results_firstName;
			$lastName = $userMasterVal->results_lastName;
			$phone = $userMasterVal->results_phone;
			$pincode = $userMasterVal->results_pincode;
			$qualification = $userMasterVal->results_qualification;
			$specialization = $userMasterVal->results_specialization;
			$state = $userMasterVal->results_state;
			$superSpecialization = $userMasterVal->results_superSpecialization;
			$password = $userMasterVal->results_password;
			$createdDate = $userMasterVal->results_createdAt;
			$createdDate = preg_split( '/(T| Z)/', $createdDate);
			$createdTime = explode(".",$createdDate[1]);
			$editedDate  = $userMasterVal->results_updatedAt;
			$editedDate = preg_split( '/(T| Z)/', $editedDate);
			$editedTime = explode(".",$editedDate[1]);

		

			$key = 'n1C5DE6oc63KDV4A4kZ0gc51QK24ke6o';

				
				$iv = mcrypt_create_iv(
				    mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC),
				    MCRYPT_DEV_URANDOM
				);

				$encrypted = base64_encode(
				    $iv .
				    mcrypt_encrypt(
				        MCRYPT_RIJNDAEL_128,
				        hash('sha256', $key, true),
				       	$password,
				        MCRYPT_MODE_CBC,
				        $iv
				    )
				);

			$regsiterValues = array('first_name' => $firstName,
									'last_name' => $lastName,
									'street' => $street,
									'country' => $country,
									'state' => $state,
									'city' => $city,
									'pincode' => $pincode,
									'phone' => $phone,
									'email' => $email,
									'password' => $encrypted,
									'qualification' => json_encode([$qualification]),
									'specialization' => $specialization,
									'super_specialization' => $superSpecialization,
									'accredition' => $accredition,
									'doctor_registration_no' => $imaRegisterNo,
									'status' =>1,
									'created_date' 	    => $createdDate[0]." ".$createdTime[0],
									'edited_date' 		=> $editedDate[0]);
									
				array_push($doctorArray,$regsiterValues);

			//var_dump($regsiterValues);

			
		}
		DB::table('doctors')->insert($doctorArray);

	}

	public function patientMigrationService(){
		
		$input = DBJsonFiles::patientJsonFile();
		var_dump($input);
	}



	public function deviceAuthenticationService(){
		$input = Request::all();
		$authenticationNumber = $input['authentication_number'];
		$deviceId = $input['device_id'];


		$authenticationExist = DB::table('authentication')
										->where('authentication_number','=',$authenticationNumber)
										->first();




		if(!empty($authenticationExist)){
			if($authenticationExist->authentication_flag=="True"){
				$status = array('status'=>"error",'message'=>'Device already regsitered');
			}
			else{
				$data = array('device_id'=>$deviceId,'authentication_flag'=>'True');
				$authenticationUpdate = DB::table('authentication')
													->where('authentication_number','=',$authenticationNumber)
													->update($data);

				if($authenticationUpdate){
					$status = array('status'=>"success",'message'=>'Device registered successfully');
				}
				else{
					$status = array('status'=>"error",'message'=>'Failed to register the device.');
				}

			}
		}
		else{
			$status = array('status'=>"error",'message'=>'Invalid Authentication Code or Device id.');
		}

		$result['response'] = $status;	
		return response()->json($result);						
	}

	public function doctorLoginService(){
		//return view('login');
		$email 		= Input::get('email');
		$password 	= Input::get('password');

		$checkLoginCredentials = DB::table('doctors')->where('email','=',$email)->where('status','=','1')->first();
		
		
				
				if(!empty($checkLoginCredentials))
				{
					$passwordEncrypted = $checkLoginCredentials->password;
					//Decrypt
					$key = 'n1C5DE6oc63KDV4A4kZ0gc51QK24ke6o';
					
					$data = base64_decode($passwordEncrypted);
					$iv = substr($data, 0, mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC));

					$decrypted = rtrim(
					    mcrypt_decrypt(
					        MCRYPT_RIJNDAEL_128,
					        hash('sha256', $key, true),
					        substr($data, mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC)),
					        MCRYPT_MODE_CBC,
					        $iv
					    ),
					    "\0"
					);
					
				
					if($password==$decrypted){
						$status = array('status'=>"success",'message'=>'Login Success');
						$result['result'] = $checkLoginCredentials;
					}
					else{
						$status = array('status'=>"error",'message'=>'Invalid login credentials');
						//$checkLoginCredentials = null;

					}
				}
				else{

					$status = array('status'=>"error",'message'=>'Email id either Denied or not Exists');
				}	
		
		$result['response'] = $status;
		
		return response()->json($result);
	
	}
	
	public function checkPatientExistService(){
		$patientId = Input::get('id_patient');
		
		$patientExistData = DB::table('patients')->where('id_patient','=',$patientId)->first();
		//echo $patient;

		$patientData = $this->getPatientPersonalInformationService($patientId);
		//$obstetricsHistoryData = $this->getPatientObstetricsHistoryService($patientId);
		
		if(count($patientExistData)>0){
			$status = array('status'=>"error",'message'=>'Patient already exists');
			
			$result['result']['patientPersonalData']	= $patientData;
			//$result['response'] = $status;


			//Obstetrics History
			//-------------------------------------------------------

					$patientGynObsData	 	= DB::table('sp_gynaecology_obs')
        										->where('id_patient','=',$patientId)
        										->where('created_date',DB::raw("(select max(`created_date`) from sp_gynaecology_obs where id_patient='$patientId')"))
        										
        										->first();
        		
       
	        										

	        $patientGynObsPregData  = DB::table('sp_gynaecology_obs_preg')
	        										->where('id_patient','=',$patientId)
	        										->where('created_date',DB::raw("(select max(`created_date`) from sp_gynaecology_obs_preg where id_patient='$patientId')"))
	        										->where('id_gyn_preg',DB::raw("(select max(`id_gyn_preg`) from sp_gynaecology_obs_preg where id_patient='$patientId')"))
	        										->get();


	      

	        	if(!empty($patientGynObsData)){
	        		


					$result['result']['patientGynObsData']['id_patient'] = $patientGynObsData->id_patient;
					$result['result']['patientGynObsData']['id_doctor'] 	= $patientGynObsData->id_doctor;
					$result['result']['patientGynObsData']['obs_reference'] 	= $patientGynObsData->obs_reference;
					$result['result']['patientGynObsData']['married_life'] = $patientGynObsData->married_life;
					$result['result']['patientGynObsData']['husband_blood_group'] = $patientGynObsData->husband_blood_group;
					$result['result']['patientGynObsData']['gravida'] = $patientGynObsData->gravida;
					$result['result']['patientGynObsData']['para'] = $patientGynObsData->para;
					$result['result']['patientGynObsData']['living'] = $patientGynObsData->living;
					$result['result']['patientGynObsData']['abortion'] = $patientGynObsData->abortion;
					$result['result']['patientGynObsData']['obs_last_delivery_date'] = $patientGynObsData->obs_last_delivery_date;
					$result['result']['patientGynObsData']['obs_expected_delivery_date'] = $patientGynObsData->obs_expected_delivery_date;
					$result['result']['patientGynObsData']['obs_gestational_age'] = $patientGynObsData->obs_gestational_age;
					$result['result']['patientGynObsData']['obs_lmp_date'] 			=  $patientGynObsData->obs_lmp_date;
			       	$result['result']['patientGynObsData']['obs_lmp_flow'] 			= $patientGynObsData->obs_lmp_flow;
			        $result['result']['patientGynObsData']['obs_lmp_dysmenorrhea'] 	= $patientGynObsData->obs_lmp_dysmenorrhea;
			        $result['result']['patientGynObsData']['obs_lmp_days'] 			= $patientGynObsData->obs_lmp_days;
			        $result['result']['patientGynObsData']['obs_lmp_cycle'] 			= $patientGynObsData->obs_lmp_cycle;
			        $result['result']['patientGynObsData']['obs_menstrual_type'] 		= $patientGynObsData->obs_menstrual_type;
			        $result['result']['patientGynObsData']['created_date'] 		=  $patientGynObsData->created_date;
			       
				}

	        	

	       
	        //---------------------------------------------------------------------------------------------

		    //PREG
		    //--------------------------------------------------------------------------------------------
		        

		        $obsPregTypeArray = Array();
		        $obsPregKindArray	= Array();
		        $obsPregTermArray	= Array();
		        $obsPregAbortionArray	= Array();
		        $obsPregHealthArray	= Array();
		        $obsPregGenderArray	= Array();
		        $obsPregYears		=	Array();
		        $obsPregWeeks 		=	Array();

		        if(!empty($patientGynObsPregData)){


			        foreach($patientGynObsPregData as $index=> $patientGynObsPregDataVal){
			        	//var_dump($patientGynObsPregDataVal);
			        	array_push($obsPregTypeArray,$patientGynObsPregDataVal->obs_preg_type);
			        	array_push($obsPregKindArray,$patientGynObsPregDataVal->obs_preg_kind);
			        	array_push($obsPregTermArray,$patientGynObsPregDataVal->obs_preg_term);
			        	array_push($obsPregAbortionArray,$patientGynObsPregDataVal->obs_preg_abortion);
			        	array_push($obsPregHealthArray,$patientGynObsPregDataVal->obs_preg_health);
			        	array_push($obsPregGenderArray,$patientGynObsPregDataVal->obs_preg_gender);
			        	array_push($obsPregYears,$patientGynObsPregDataVal->obs_preg_years);
			        	array_push($obsPregWeeks,$patientGynObsPregDataVal->obs_preg_weeks);
			        }
			        $result['result']['patientGynObsPregData']['obs_preg_type'] 			= $obsPregTypeArray;
			        $result['result']['patientGynObsPregData']['obs_preg_kind'] 			= $obsPregKindArray;
			        $result['result']['patientGynObsPregData']['obs_preg_term'] 			= $obsPregTermArray;
			        $result['result']['patientGynObsPregData']['obs_preg_abortion'] 		= $obsPregAbortionArray;
			        $result['result']['patientGynObsPregData']['obs_preg_health'] 			= $obsPregHealthArray;
			        $result['result']['patientGynObsPregData']['obs_preg_gender'] 			= $obsPregGenderArray;
			        $result['result']['patientGynObsPregData']['obs_preg_years'] 			= $obsPregYears;
			        $result['result']['patientGynObsPregData']['obs_preg_weeks'] 			= $obsPregWeeks;
			    }

/*
		    	if(!empty($patientGynObsData) || !empty($patientGynObsPregData) ){
		    		return response()->json($result);
		    	}
		    	else{
		    		$status = array("status"=>"error","message"=>"Data not found");
		    		$result['result'] = $status;
		    		return response()->json($result);
		    	}*/


			//-------------------------------------------------------

		    //Medical History
		    //----------------------------------------------------------------
		    			$medicalHistoryData = DB::table('medical_history')
    										->where('id_patient','=',$patientId)
    										->where('created_date',DB::raw("(select max(`created_date`) from medical_history 	    where id_patient='$patientId')"))
    										->first();
    	$illnessData = DB::table('medical_history_present_past_more')->where('id_patient','=',$patientId)->get();

    	$surgicalData = DB::table('medical_history_surgical')->where('id_patient','=',$patientId)->get();

    	$drugAllergyData = DB::table('medical_history_drug_allergy')->where('id_patient','=',$patientId)->get(); 	

    	//	var_dump($illnessData);	

    	if(!empty($medicalHistoryData)){
    		$result['result']['patientMedicalHistoryData']['id_patient'] = $medicalHistoryData->id_patient;
    		$result['result']['patientMedicalHistoryData']['id_doctor'] = $medicalHistoryData->id_doctor;
    		$result['result']['patientMedicalHistoryData']['menarche'] = $medicalHistoryData->menstrual_menarche;
    		$result['result']['patientMedicalHistoryData']['menopause'] = $medicalHistoryData->menstrual_menopause;
    		$result['result']['patientMedicalHistoryData']['father'] = json_decode($medicalHistoryData->history_family_father);
    		$result['result']['patientMedicalHistoryData']['father_other'] = $medicalHistoryData->history_family_father_other;
    		$result['result']['patientMedicalHistoryData']['mother'] = json_decode($medicalHistoryData->history_family_mother);
    		$result['result']['patientMedicalHistoryData']['mother_other'] =$medicalHistoryData->history_family_mother_other;
    		$result['result']['patientMedicalHistoryData']['sibling'] = json_decode($medicalHistoryData->history_family_sibling);
    		$result['result']['patientMedicalHistoryData']['sibling_other'] = $medicalHistoryData->history_family_sibling_other;
    		$result['result']['patientMedicalHistoryData']['grandfather'] = json_decode($medicalHistoryData->history_family_grandfather);
    		$result['result']['patientMedicalHistoryData']['grandfather_other'] = $medicalHistoryData->history_family_grandfather_other;
    		$result['result']['patientMedicalHistoryData']['grandmother'] = json_decode($medicalHistoryData->history_family_grandmother);
    		$result['result']['patientMedicalHistoryData']['grandmother_other'] = $medicalHistoryData->history_family_grandmother_other;
    		$result['result']['patientMedicalHistoryData']['allergy_general'] = json_decode($medicalHistoryData->history_allergy_general);
    		$result['result']['patientMedicalHistoryData']['alcohol'] =$medicalHistoryData->history_social_alcohol;
    		$result['result']['patientMedicalHistoryData']['tobaco-smoke'] = $medicalHistoryData->history_social_tobacco_smoke;
    		$result['result']['patientMedicalHistoryData']['tobaco-chew'] = $medicalHistoryData->history_social_tobacco_chew;
    		$result['result']['patientMedicalHistoryData']['other-social-history'] = $medicalHistoryData->history_social_other;
    		$result['result']['patientMedicalHistoryData']['created_date'] = $medicalHistoryData->created_date;
    		$result['result']['patientMedicalHistoryData']['referenceId'] = $medicalHistoryData->medical_history_reference;
    	}

    	if(!empty($illnessData)){
    		$illnessNameArray = array();
	    	$illnessStatusArray = array();
	    	$illnessMedicationArray = array();
	    	for($i=0;$i<count($illnessData);$i++){
	    		
	    		array_push($illnessNameArray,$illnessData[$i]->illness_name );
	    		array_push($illnessStatusArray,$illnessData[$i]->illness_status);
	    		array_push($illnessMedicationArray,$illnessData[$i]->medication);
	    	}

	    	$result['result']['patientMedicalHistoryData']['illness_name'] = $illnessNameArray;
	    	$result['result']['patientMedicalHistoryData']['illness_status'] = $illnessStatusArray;
	    	$result['result']['patientMedicalHistoryData']['illness_medication'] = $illnessMedicationArray;
	
    	}

    	if(!empty($surgicalData)){
    		$surgeryArray = array();
    		for($i=0;$i<count($surgicalData);$i++){
    			array_push($surgeryArray,$surgicalData[$i]->surgery_name );
    		}
    		$result['result']['patientMedicalHistoryData']['surgery'] = $surgeryArray;
    	}

    	if(!empty($drugAllergyData)){
    		$drugNameArray = array();
    		$reactionNameArray = array();
    		for($i=0;$i<count($drugAllergyData);$i++){
    			array_push($drugNameArray,$drugAllergyData[$i]->drug_name );
    			array_push($reactionNameArray,$drugAllergyData[$i]->reaction );
    		}
    		$result['result']['patientMedicalHistoryData']['medication-drug-allergy'] = $drugNameArray;
    		$result['result']['patientMedicalHistoryData']['reaction-drug-allergy'] = $reactionNameArray;
    	}


		    //----------------------------------------------------------------


    		$status = array('status'=>"success",'message'=>'Patient alredy exists');
    		$result['response'] = $status;

			return response()->json($result);



		}
		else{
			$status = array('status'=>"error",'message'=>'No Patient exists with this id');
		}
	    
	    //$result['result'] = $patientExistData;
	    $result['response'] = $status;
		return response()->json($result);
		
	}

	public function getCountryStateService(){
		$country = DB::table('countries')->get();
		$state  = DB::table('states')->get();
		$result['country_list'] = $country;
		$result['state_list'] = $state;
		return response()->json($result);
	}
	
	public function getPatientData(){
			/*$input = Request::all();//Request::all('id_patient');
			var_dump($input) ;*/
		$patientId = Input::get('patientId');
		$patientData = DB::table('patients')->where('id_patient','=',$patientId)->get();
		//var_dump(json_encode($patientData));
	    
	    $status = array('status'=>"success",'message'=>'Success');
	    $result['result'] = $patientData;
	    $result['response'] = $status;

	   
         return response()->json($result);
	}

	public function getPatientPersonalInformationService(){
		$patientId   = Input::get('id_patient');
		

		$patientData = DB::table('patients')->where('id_patient','=',$patientId)->first();

		if($patientData){
			$status = array('status'=>"success",'message'=>'Patient Data Found');
			//$result['result'] 	= $patientData;
			//$result['response'] = $status;
			//return response()->json($result);
			return $patientData;
		}
		else{
			$status = array('status'=>"error",'message'=>'No Patient exists with this id');
			//$result['result'] 	= $patientData;
			$result['response'] = $status;
			return response()->json($result);
		}

	}
	public function addPatientPersonalInformationService(){
		$input     = Request::all();
		$doctorId  = Input::get('id_doctor');
		$patientId = Input::get('id_patient');//Session::get('patientId'); 
		//$patientId =  $input['id_patient'];
		$createdDate = $input['created_date'];
		/*$country = $input['country'];

		$country = DB::table('countries')->where('country_name','=',$country)->first();*/
		
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

		
		if($patientExistCheck>0){
			if(!empty($firstName) || !empty($lastName) || !empty($gender) || !empty($dob) || !empty($age) || 
	           !empty($house) || !empty($street) || !empty($country) || !empty($state) || !empty($pincode) ||
	           !empty($phone) || !empty($email) )


			{
				

				$editedDate = date('Y-m-d');
				$inputValue = array('first_name'=>$firstName,
									'middle_name'=> $middleName,
									'last_name'=> $lastName,
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
									'id_doctor' => $doctorId,
									'edited_date' => $createdDate);

				$patientUpdate = DB::table('patients')->where('id_patient','=',$patientId)->update($inputValue);

				
					$status = array('status'=>"success",'message'=>'Data updated successfully');
					//$result['result'] = $patientId;
					$result['response'] = $status;
					return response()->json($result);

				
			}



			
		}
		else
		{


			if(!empty($firstName) || !empty($lastName) || !empty($gender) || !empty($dob) || !empty($age) || 
	           !empty($house) || !empty($street) || !empty($country) || !empty($state) || !empty($pincode) ||
	           !empty($phone) || !empty($email) )


			{
				//echo "Vyshakh";
				$inputValue = array('id_patient' => $input['id_patient'],
									'first_name'=>$firstName,
									'middle_name'=> $middleName,
									'last_name'=> $lastName,
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
									'id_doctor' => $doctorId,
									'created_date' => $createdDate);
									
				$patientPersonalInfoSave = DB::table('patients')->insert($inputValue);
				if($patientPersonalInfoSave){
					$status = array('status'=>"success",'message'=>'Data saved successfully');
				    //$result['result'] = $patientData;
				    $result['response'] = $status;
					return response()->json($result);
				}
			}
			else{
				$status = array('status'=>"error",'message'=>'Please check the fields');
				$result['result'] = $patientId;
				$result['response'] = $status;
				return response()->json($result);
			}
		}
		
	}

	public function getPatientObstetricsHistoryService(){

		 //$patientId = Input::get('id_patient');
		 //$doctorId  = Input::get('id_doctor');


		$patientExistCheck = DB::table('patients')->where('id_patient','=',$patientId)->first();


		if(!empty($patientExistCheck)){
			$patientGynObsData	 	= DB::table('sp_gynaecology_obs')
        										->where('id_patient','=',$patientId)
        										->where('created_date',DB::raw("(select max(`created_date`) from sp_gynaecology_obs where id_patient='$patientId')"))
        										
        										->first();
        		
       
	        										

	        $patientGynObsPregData  = DB::table('sp_gynaecology_obs_preg')
	        										->where('id_patient','=',$patientId)
	        										->where('created_date',DB::raw("(select max(`created_date`) from sp_gynaecology_obs_preg where id_patient='$patientId')"))
	        										->where('id_gyn_preg',DB::raw("(select max(`id_gyn_preg`) from sp_gynaecology_obs_preg where id_patient='$patientId')"))
	        										->get();


	      

	        	if(!empty($patientGynObsData)){
	        		return $patientGynObsData;


					$result['result']['id_patient'] = $patientGynObsData->id_patient;
					$result['result']['id_doctor'] 	= $patientGynObsData->id_doctor;
					$result['result']['obs_reference'] 	= $patientGynObsData->obs_reference;
					$result['result']['married_life'] = $patientGynObsData->married_life;
					$result['result']['husband_blood_group'] = $patientGynObsData->husband_blood_group;
					$result['result']['gravida'] = $patientGynObsData->gravida;
					$result['result']['para'] = $patientGynObsData->para;
					$result['result']['living'] = $patientGynObsData->living;
					$result['result']['abortion'] = $patientGynObsData->abortion;
					$result['result']['obs_last_delivery_date'] = $patientGynObsData->obs_last_delivery_date;
					$result['result']['obs_expected_delivery_date'] = $patientGynObsData->obs_expected_delivery_date;
					$result['result']['obs_gestational_age'] = $patientGynObsData->obs_gestational_age;
					$result['result']['obs_lmp_date'] 			=  $patientGynObsData->obs_lmp_date;
			       	$result['result']['obs_lmp_flow'] 			= $patientGynObsData->obs_lmp_flow;
			        $result['result']['obs_lmp_dysmenorrhea'] 	= $patientGynObsData->obs_lmp_dysmenorrhea;
			        $result['result']['obs_lmp_days'] 			= $patientGynObsData->obs_lmp_days;
			        $result['result']['obs_lmp_cycle'] 			= $patientGynObsData->obs_lmp_cycle;
			        $result['result']['obs_menstrual_type'] 		= $patientGynObsData->obs_menstrual_type;
			        $result['result']['created_date'] 		=  $patientGynObsData->created_date;
			       
				}

	        	

	       
	        //---------------------------------------------------------------------------------------------

		    //PREG
		    //--------------------------------------------------------------------------------------------
		        

		        $obsPregTypeArray = Array();
		        $obsPregKindArray	= Array();
		        $obsPregTermArray	= Array();
		        $obsPregAbortionArray	= Array();
		        $obsPregHealthArray	= Array();
		        $obsPregGenderArray	= Array();
		        $obsPregYears		=	Array();
		        $obsPregWeeks 		=	Array();

		        if(!empty($patientGynObsPregData)){


			        foreach($patientGynObsPregData as $index=> $patientGynObsPregDataVal){
			        	//var_dump($patientGynObsPregDataVal);
			        	array_push($obsPregTypeArray,$patientGynObsPregDataVal->obs_preg_type);
			        	array_push($obsPregKindArray,$patientGynObsPregDataVal->obs_preg_kind);
			        	array_push($obsPregTermArray,$patientGynObsPregDataVal->obs_preg_term);
			        	array_push($obsPregAbortionArray,$patientGynObsPregDataVal->obs_preg_abortion);
			        	array_push($obsPregHealthArray,$patientGynObsPregDataVal->obs_preg_health);
			        	array_push($obsPregGenderArray,$patientGynObsPregDataVal->obs_preg_gender);
			        	array_push($obsPregYears,$patientGynObsPregDataVal->obs_preg_years);
			        	array_push($obsPregWeeks,$patientGynObsPregDataVal->obs_preg_weeks);
			        }
			        $result['result']['obs_preg_type'] 			= $obsPregTypeArray;
			        $result['result']['obs_preg_kind'] 			= $obsPregKindArray;
			        $result['result']['obs_preg_term'] 			= $obsPregTermArray;
			        $result['result']['obs_preg_abortion'] 		= $obsPregAbortionArray;
			        $result['result']['obs_preg_health'] 			= $obsPregHealthArray;
			        $result['result']['obs_preg_gender'] 			= $obsPregGenderArray;
			        $result['result']['obs_preg_years'] 			= $obsPregYears;
			        $result['result']['obs_preg_weeks'] 			= $obsPregWeeks;
			    }


	    	if(!empty($patientGynObsData) || !empty($patientGynObsPregData) ){
	    		return response()->json($result);
	    	}
	    	else{
	    		$status = array("status"=>"error","message"=>"Data not found");
	    		$result['result'] = $status;
	    		return response()->json($result);
	    	}
		}
		else{
			$status = array("status"=>"error","message"=>"Invalid PatientID");
	    	$result['result'] = $status;
	    	return response()->json($result);
		}
		
        

	}
	public function addPatientObstetricsHistoryService(){
		$input = Request::all();
        
        

        $patientId 	 = Input::get('id_patient'); 
        $doctorId 	 = Input::get('id_doctor');
        $referenceId = Input::get('obs_reference'); 
        $createdDate = Input::get('created_date'); 
        $flagArray 		=	array();
        //Creating a 5digits random alpha numeric for reference
       ;
       
        
        (!empty($input['married_life']))? $marriedLife = $input['married_life'] : $marriedLife="";
        (!empty($input['husband_blood_group']))? $husBloodGroup = $input['husband_blood_group'] : $husBloodGroup="";
        (!empty($input['gravida']))? $gravida = $input['gravida'] : $gravida="";
        (!empty($input['para']))? $para = $input['para'] : $para="";
		(!empty($input['living']))? $living = $input['living'] : $living="";
        (!empty($input['abortion']))? $abortion = $input['abortion'] : $abortion="";
        (!empty($input['obs_gestational_age']))? $gestationalAge  = $input['obs_gestational_age'] : $gestationalAge="";
        (!empty($input['obs_last_delivery_date']))? $lastDeliveryDate  = $input['obs_last_delivery_date'] : $lastDeliveryDate="";
        (!empty($input['obs_expected_delivery_date']))? $expectedDeliveryDate  = $input['obs_expected_delivery_date'] : $expectedDeliveryDate="";

        if(!empty($lastDeliveryDate)){
        	$date1  		 		= str_replace('/', '-',$lastDeliveryDate);
			$lastDeliveryDate 		= date('Y-m-d', strtotime($date1));
        }
        else{
        	$lastDeliveryDate = "0000-00-00";
        }

        if(!empty($expectedDeliveryDate)){
        	$date2  		  		= str_replace('/', '-', $expectedDeliveryDate);
			$expectedDeliveryDate 	= date('Y-m-d', strtotime($date2));
        }
        else{
        	$expectedDeliveryDate = "0000-00-00";
        }


	
		
      	
		

        

        $patientExistCheck 		= DB::table('patients')->where('id_patient','=',$patientId)->count();


        $patientGynObsExist 	= DB::table('sp_gynaecology_obs')
        											->where('id_patient','=',$patientId)
        											->where('obs_reference','=',$referenceId)
        											->count();
        //echo "Count Gyn Obs--".$patientGynObsExist." ". $patientId." ".$referenceId;

        											
		$patientGynObsPregExist = DB::table('sp_gynaecology_obs_preg')
													->where('id_patient','=',$patientId)
													->get();


        //This is for checking whether the patient is available.

        if($patientExistCheck>0){
        	if($patientGynObsExist>0){
        	
        		if(	!empty($marriedLife) || !empty($gravida) || !empty($para) || !empty($living) || 
        	   	   	!empty($abortion) || !empty($husBloodGroup)  || !empty($gestationalAge) || 
        	   	   	!empty($lastDeliveryDate) || !empty($expectedDeliveryDate) 
        	   	   	 )
        	   	   	
        	  	   	
	        	{
	        		$gynObsData = array(  
										  'id_doctor' 					=> $doctorId,
										  'married_life' 				=> $marriedLife,
										  'husband_blood_group' 		=> $husBloodGroup,
										  'gravida' 					=> $gravida,
										  'para' 						=> $para,
										  'living' 						=> $living,
										  'abortion' 					=> $abortion,
										  'obs_last_delivery_date' 		=> $lastDeliveryDate,
										  'obs_expected_delivery_date' 	=> $expectedDeliveryDate,
										  'obs_gestational_age' 		=> $gestationalAge,
										  'obs_reference' 				=> $referenceId,
										  'edited_date' 				=> $createdDate);
	        		$gynDataUpdate = DB::table('sp_gynaecology_obs')
	        										->where('id_patient','=',$patientId)
	        										->where('obs_reference','=',$referenceId)
	        										->update($gynObsData);

	        		array_push($flagArray,1);
	        	}
	        	else{
	        		array_push($flagArray,0);
	        	}

	        	/*LMP Update in case of initially gyn data exists*/
	        	$lmpUpdateFlag = $this->lmpInsertUpdate($patientGynObsExist,$input,$patientId,$referenceId,$doctorId,$createdDate);

	        	$this->pregDataInsert($input,$patientId,$doctorId,$referenceId,$createdDate);

	        	if(!empty($lmpUpdateFlag)){
	        		array_push($flagArray,$lmpUpdateFlag);
	        	}

	        	if(in_array("1",$flagArray)){
	        		$status = array("status"=>"Success","message"=>"Data updated successfully");
    				$result['response'] = $status;
    				return response()->json($result);
	        		//return Redirect::to('patientobstetricshistory')->with(array('success'=>"Data updated successfully"));	
	        	}
	        	else{
	        		$status = array("status"=>"Error","message"=>"Failed to update data");
    				$result['response'] = $status;
    				return response()->json($result);
	        		//return Redirect::to('patientobstetricshistory')->with(array('error'=>"Failed to update data"));	
	        	}
	   	   	 									
        	}
        	else
        	{

        		if(	!empty($marriedLife) || !empty($gravida) || !empty($para) || !empty($living) || 
        	   	   	!empty($abortion) || !empty($husBloodGroup)  || !empty($gestationalAge) || 
        	   	   	!empty($lastDeliveryDate) || !empty($expectedDeliveryDate) 
        	   	   	 )
        	   	   	
        	   	   	

        	   	   	
	        	{
	        		$gynObsData = array(  'id_patient' 					=> $patientId,
										  'id_doctor' 					=> $doctorId,
										  'married_life' 				=> $marriedLife,
										  'husband_blood_group' 		=> $husBloodGroup,
										  'gravida' 					=> $gravida,
										  'para' 						=> $para,
										  'living' 						=> $living,
										  'abortion' 					=> $abortion,
										  'obs_last_delivery_date' 		=> $lastDeliveryDate,
										  'obs_expected_delivery_date' 	=> $expectedDeliveryDate,
										  'obs_gestational_age' 		=> $gestationalAge,
										  'obs_reference' 				=> $referenceId,
										  'created_date' 				=> $createdDate);
	        		$gynDataInsert = DB::table('sp_gynaecology_obs')->insert($gynObsData);

	        		array_push($flagArray, 1);
	        		
	        	}
	        	else{
	        		array_push($flagArray, 0);
	        	}

	        	/*LMP insert & udate.If no lmp data and adding only lmp inserts*/
	        	 $patientGynObsExist 	= DB::table('sp_gynaecology_obs')
        											->where('id_patient','=',$patientId)
        											->where('obs_reference','=',$referenceId)
        											->count();

        			$lmpFlag = $this->lmpInsertUpdate($patientGynObsExist,$input,$patientId,$referenceId,$doctorId,$createdDate);

        			$this->pregDataInsert($input,$patientId,$doctorId,$referenceId,$createdDate);

        			if(!empty($lmpFlag)){
        				array_push($flagArray, $lmpFlag);
        			}

        			if(in_array("1",$flagArray))
        			{
        				$status = array("status"=>"Success","message"=>"Data saved successfully");
    					$result['response'] = $status;
    					return response()->json($result);
        				//return Redirect::to('patientobstetricshistory')->with(array('success'=>"Data saved successfully"));
        			}
        			else{
        				$status = array("status"=>"Error","message"=>"Failed to save data");
    					$result['response'] = $status;
    					return response()->json($result);
        				//return Redirect::to('patientobstetricshistory')->with(array('error'=>"Failed to save data"));
        			}
		  	}
        }
        else
        {
        	$status = array("status"=>"Error","message"=>"Please add the patient personal information");
    		$result['response'] = $status;
    		return response()->json($result);
        	//return Redirect::to('patientobstetricshistory')->with(array('error' => "Please add patient personal information"));
        }

	}


	public function lmpInsertUpdate($patientGynObsExist,$input,$patientId,$referenceId,$doctorId,$createdDate){
    	(!empty($input['obs_lmp_date']))? $lastMensusDate = $input['obs_lmp_date'] : $lastMensusDate="";
        (!empty($input['obs_lmp_flow']))? $lmpFlow = $input['obs_lmp_flow'] : $lmpFlow="";
        (!empty($input['obs_lmp_dysmenorrhea']))?$lmpDysmenorrhea = $input['obs_lmp_dysmenorrhea']:$lmpDysmenorrhea="";
        (!empty($input['obs_lmp_days']))? $days = $input['obs_lmp_days'] : $days="";
        (!empty($input['obs_lmp_cycle']))? $cycle = $input['obs_lmp_cycle'] : $cycle="";
		(!empty($input['obs_menstrual_type']))? $lmpMensusType = $input['obs_menstrual_type'] : $lmpMensusType="";
		$lmpFlag = 0;
       
       	if(!empty($lastMensusDate)){
        	$date1  		 		= str_replace('/', '-', $lastMensusDate);
			$lastMensusDate 		= date('Y-m-d', strtotime($date1));
        }
        else{
        	$lastMensusDate = "";
        }
        
        if($patientGynObsExist>0){
			if(	!empty($lastMensusDate) && !empty($lmpFlow) && !empty($lmpDysmenorrhea) && 
   	   	 		!empty($days) && !empty($cycle) && !empty($lmpMensusType))
   	   	 	{
   	   	 		$lmpData = array(	'obs_lmp_date' 				=> $lastMensusDate,
				    		  		'obs_lmp_flow' 				=> $lmpFlow,
						      		'obs_lmp_dysmenorrhea' 		=> $lmpDysmenorrhea,
						      		'obs_menstrual_type'		=> $lmpMensusType,
						      		'obs_lmp_days' 				=> $days,
						      		'obs_lmp_cycle'  			=> $cycle,
						      		'edited_date'       		=> $createdDate
						    	);
   	   	 		$lmpUpdate  = DB::table('sp_gynaecology_obs')
   	   	 		                                ->where('id_patient','=',$patientId)
   	   	 										->where('obs_reference','=',$referenceId)	
   	   	 										->update($lmpData);
   	   	 		return $lmpFlag=1;
   	   	 										
   	   	 	}
   	   	 	else{
   	   	 		return $lmpFlag = 0;
   	   	 	}
       	}
		else
		{
			if(	!empty($lastMensusDate) && !empty($lmpFlow) && !empty($lmpDysmenorrhea) && 
   	   	 		!empty($days) && !empty($cycle) && !empty($lmpMensusType))
   	   	 	{
   	   	 		$lmpData = array(	'obs_lmp_date' 				=> $lastMensusDate,
				    		  		'obs_lmp_flow' 				=> $lmpFlow,
						      		'obs_lmp_dysmenorrhea' 		=> $lmpDysmenorrhea,
						      		'obs_menstrual_type'		=> $lmpMensusType,
						      		'obs_lmp_days' 				=> $days,
						      		'obs_lmp_cycle'  			=> $cycle,
						      		'id_patient' 				=> $patientId,
						      		'id_doctor' 				=> $doctorId,
						      		'obs_reference' 			=> $referenceId,
						      		'created_date' 				=> $createdDate
						    	);
   	   	 		$lmpInsert  = DB::table('sp_gynaecology_obs')->insert($lmpData);

   	   	 		return $lmpFlag=1;	
   	   	 	}
   	   	 	else{
   	   	 		return $lmpFlag = 0;
   	   	 	}	
		}


    }

   	public function pregDataInsert($input,$patientId,$doctorId,$referenceId,$createdDate)
    {
    	
    		/*PREG Data
      	----------------------------------------------------------------------------------------*/
		(!empty($input['obs_preg_kind']))? $pregKind = $input['obs_preg_kind'] : $pregKind="";
		(!empty($input['obs_preg_type']))? $pregType = $input['obs_preg_type'] : $pregType="";
		(!empty($input['obs_preg_term']))? $pregTerm = $input['obs_preg_term'] : $pregTerm="";
		(!empty($input['obs_preg_abortion']))? $pregAbortion = $input['obs_preg_abortion'] : $pregAbortion="";
		(!empty($input['obs_preg_health'] ))? $pregHealth = $input['obs_preg_health'] : $pregHealth="";
		(!empty($input['obs_preg_years']))? $pregYear = $input['obs_preg_years'] : $pregYear="";
		(!empty($input['obs_preg_weeks']))? $pregWeek = $input['obs_preg_weeks'] : $pregWeek="";
		(!empty($input['obs_preg_gender']))? $pregGender = $input['obs_preg_gender'] : $pregGender="";
		
		/*----------------------------------------------------------------------------------------*/
    		
    		//Inserting into sp_gynaecology_obs_preg
			if((!empty($pregKind) || $pregKind!=0) && (!empty($pregType) || $pregType!=0) && 
			   (!empty($pregTerm) || $pregTerm!=0) && !empty($pregAbortion) && (!empty($pregHealth) || $pregHealth!=0) &&
			   !empty($pregWeek) && !empty($pregYear) && (!empty($pregGender) || $pregGender!=0) ){ 

			  
			
				foreach ($pregKind as $index => $value){
					
					//echo $pregKind[$index].' '.$pregType[$index];
					$pregData = array('id_patient' 			=> $patientId,
								      'id_doctor' 			=> $doctorId, 
								      'obs_preg_kind' 		=> $pregKind[$index],
								      'obs_preg_type' 		=> $pregType[$index],
								      'obs_preg_term' 		=> $pregTerm[$index],
								      'obs_preg_abortion' 	=> $pregAbortion[$index],
								      'obs_preg_health' 	=> $pregHealth[$index],
								      'obs_preg_gender' 	=> $pregGender[$index],
								      'obs_preg_years' 		=> $pregYear[$index],
								      'obs_preg_weeks' 		=> $pregWeek[$index],
								      'obs_preg_reference' 	=> $referenceId,
								      'created_date' 		=> $createdDate);
					if((!empty($pregKind[$index]) || $pregKind[$index]!=0) && 
					   (!empty($pregType[$index]) || $pregType[$index]!=0) && 
					   (!empty($pregTerm[$index]) || $pregTerm[$index]!=0) && 
					   
					   (!empty($pregHealth[$index]) || $pregHealth[$index]!=0) &&
					   
					   (!empty($pregGender[$index]) || $pregGender[$index]!=0)){ 

						//var_dump($pregData);
						
							$gynObsPregData = DB::table('sp_gynaecology_obs_preg')->insert($pregData);
						}
				}
				
				
			}
			
    }








	public function addPatientMedicalHistoryService(){

    	$input = Request::all();
    	
    	$referenceId = Input::get('referenceId'); //$input['referenceId'];
	    $patientId   = Input::get('id_patient');
	    $doctorId    = Input::get('id_doctor');
	    $createdDate = Input::get('created_date');
		
	   
	
	    $patientExistCheck = DB::table('patients')->where('id_patient','=',$patientId)->count();


	    //echo $patientExistCheck;
	    


	    $medicalHistoryExist = DB::table('medical_history')
	    										->where('id_patient','=',$patientId)
	    										->where('medical_history_reference','=',$referenceId)
	    										->where('created_date','=',$createdDate)
	    										->count();
	    //echo $medicalHistoryExist;

	    	
	   
	    if($patientExistCheck>0)
	    {
	    	//echo "patient exist";
	    	 
	    	(!empty($input['menarche']))?$menarche = $input['menarche']:$menarche = "";
	    	(!empty($input['menopause']))?$menopause = $input['menopause']:$menopause = "";
	    	(!empty($input['hypertension']))?$hypertension = $input['hypertension']:$hypertension = "NA";
	    	(!empty($input['medication_hypertension']))?$medicationHypertension = $input['medication_hypertension']:$medicationHypertension = "NA";
	    	(!empty($input['diabetes']))?$diabetes = $input['diabetes']:$diabetes = "NA";
	    	(!empty($input['medication_diabetes']))?$medicationDiabetes = $input['medication_diabetes']:$medicationDiabetes = "NA";
	    	(!empty($input['hyperthyroidism']))?$hyperthyroidism = $input['hyperthyroidism']:$hyperthyroidism = "NA";
	    	(!empty($input['medication_hyperthyroidism']))?$medicationHyperthyroidism = $input['medication_hyperthyroidism']:$medicationHyperthyroidism = "NA";
	    	(!empty($input['hypothyroidism']))?$hypothyroidism = $input['hypothyroidism']:$hypothyroidism = "NA";
	    	(!empty($input['medication_hypothyroidism']))?$medicationHypothyroidism = $input['medication_hypothyroidism']:$medicationHypothyroidism = "NA";
	    	
	    	(!empty($input['cyst']))?$cyst = $input['cyst']:$cyst = "NA";
	    	(!empty($input['medication_cyst']))?$medicationCyst = $input['medication_cyst']:$medicationCyst = "NA";
	    	(!empty($input['endometriosis']))?$endometriosis = $input['endometriosis']:$endometriosis = "NA";
	    	(!empty($input['medication_endometriosis']))?$medicationEndometriosis = $input['medication_endometriosis']:$medicationEndometriosis = "NA";
	    	(!empty($input['uterinefibroids']))?$uterineFibroids = $input['uterinefibroids']:$uterineFibroids = "NA";
	    	(!empty($input['medication_uterinefibroids']))?$medicationUterinefibroids = $input['medication_uterinefibroids']:$medicationUterinefibroids = "NA";
	    	(!empty($input['uti']))?$uti = $input['uti']:$uti = "NA";
	    	(!empty($input['medication_uti']))?$medicationUti = $input['medication_uti']:$medicationUti = "NA";
	    	(!empty($input['cancer']))?$cancer = $input['cancer']:$cancer = "NA";
	    	(!empty($input['medication_cancer']))?$medicationCancer = $input['medication_cancer']:$medicationCancer = "NA";
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

    		//Addmore illness
    		(!empty($input['illness_counter']))?$illnessCounter = $input['illness_counter']: $illnessCounter = 0 ;
    		//Surgery History
    		(!empty($input['surgery']))?$surgery = $input['surgery']:$surgery = "";
    		(!empty($input['surgery_counter']))?$surgeryCounter = $input['surgery_counter']: $surgeryCounter = 0 ;

    		//Allergy History
	    	(!empty($input['medication-drug-allergy']))?$allergyMedication = $input['medication-drug-allergy']: $allergyMedication="";
	    	(!empty($input['reaction-drug-allergy']))?$allergyReaction= $input['reaction-drug-allergy']: $allergyReaction="";
	    	(!empty($input['allergy_counter']))?$allergyCounter = $input['allergy_counter']:$allergyCounter=0;

	    	(!empty($input['illness_name']))?$illnessName = $input['illness_name']:$illnessName = "";
		    (!empty($input['illness_status']))?$illnessStatus = $input['illness_status']:$illnessStatus = "NA";
		    (!empty($input['illness_medication']))?$illnessMedication = $input['illness_medication']:$illnessMedication = "";

		    (!empty($input['other_medical_history']))?$otherMedicalHistory = $input['other_medical_history']:$otherMedicalHistory = "";

	    	if($medicalHistoryExist>0)
	    	{

	    		if(!empty($input['menarche']) || !empty($input['menopause']) || !empty($input['hypertension']) ||
		    	   !empty($input['medication_hypertension']) || !empty($input['diabetes']) ||
		    	   !empty($input['medication_diabetes']) || !empty($input['hyperthyroidism']) ||
		    	   !empty($input['medication_hyperthyroidism']) || !empty($input['hypothyroidism']) ||
		    	   !empty($input['medication_hypothyroidism']) || !empty($input['cyst']) || 
		    	   !empty($input['medication_cyst']) || !empty($input['endometriosis']) ||
		    	   !empty($input['medication_endometriosis']) || !empty($input['uterinefibroids']) ||
		    	   !empty($input['medication_uterinefibroids']) || !empty($input['uti']) || 
		    	   !empty($input['medication_uti']) || !empty($input['cancer']) || 
		    	   !empty($input['medication_cancer']) || !empty($input['father']) || !empty($input['mother']) ||
		    	   !empty($input['sibling']) || !empty($input['grandfather']) || !empty($input['grandmother']) ||
		    	   !empty($input['allergy_general']) || !empty($input['alcohol']) || !empty($input['tobaco-smoke']) || !empty($input['tobaco-chew'])  || !empty($input['other-social-history']))
    			{
    				

    				$editedDate = Input::get('created_date');
    				$dataArray = array('menstrual_menarche' => $menarche,
			    					   'menstrual_menopause' => $menopause,
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
			    					   'history_other' => $otherMedicalHistory,
			    					   'id_doctor' => $doctorId,
			    					   'edited_date' => $editedDate);
    				//var_dump($dataArray);


    				$dataInsert = DB::table('medical_history')
    												->where('id_patient','=',$patientId)
    												->where('medical_history_reference','=',$referenceId)
    												->update($dataArray);

    				if($dataInsert>0){
	    				//echo "Updated";
	    			}
    				

    				
    				
    			}


    			//Present Past More
    			$count = count($illnessName);									
			    for($i=0;$i<$count;$i++){
			    	if(!empty($illnessName[$i]) && !empty($illnessStatus[$i])){
						$illnessArray = array('id_patient' 			=> $patientId,
		    							  'id_doctor' 			=> $doctorId,
		    							  'illness_name' 		=> $illnessName[$i],
		    							  'illness_status' 		=> $illnessStatus[$i],
		    							  'medication' 			=> $illnessMedication[$i],
		    							  'illness_reference' 	=> $referenceId,
		    							  'created_date' 		=> $createdDate);
						$presentPastMoreSave = DB::table('medical_history_present_past_more')->insert($illnessArray);
					}
					
			    }
		    
			   


	    		if(!empty($surgery)) { $surgery = array_filter($surgery);} {
	    			//echo "njan ipo surgeryude not empty if il und";
	    			
			    	if(!empty($surgery)){
			    		for($i=0;$i<count($input['surgery']); $i++){
			    			$suregeryData = array('surgery_name' => $surgery[$i],
			    								  'id_patient' => $patientId,
			    								  'id_doctor' => $doctorId,
			    								  'surgery_reference'=>$referenceId,
			    								  'created_date'=> $createdDate);

			    			$surgerySave = DB::table('medical_history_surgical')->insert($suregeryData);

			    		}
			    	}
				}

				if(!empty($allergyMedication) && !empty($allergyReaction)){
					//echo "ini allergy insert akundo nokam";
		    		$allergyMedication = array_filter($allergyMedication);
		    		$allergyReaction   = array_filter($allergyReaction);
		    		
		    		if(!empty($allergyMedication) && !empty($allergyReaction)){

		    			$this->addDrugAllergyDetails($allergyMedication,$allergyReaction,$patientId,$doctorId,$referenceId,$createdDate);
		    		}
		    	}
		    	else{
		    		if($allergyCounter>0){
		    			//return Redirect::to('patientmedicalhistory')->with(array('error'=>'Please fill data'));
		    		}
		    	}

    			$status = array('status'=>"success",'message'=>'Data updated successfully');
				
				$result['response'] = $status;
				return response()->json($result);
    			

	    	}
	    	else
	    	{
	    		//echo "insert cheyanm";

	    		if(!empty($input['menarche']) || !empty($input['menopause']) || !empty($input['hypertension']) ||
		    	   !empty($input['medication_hypertension']) || !empty($input['diabetes']) ||
		    	   !empty($input['medication_diabetes']) || !empty($input['hyperthyroidism']) ||
		    	   !empty($input['medication_hyperthyroidism']) || !empty($input['hypothyroidism']) ||
		    	   !empty($input['medication_hypothyroidism']) || !empty($input['cyst']) || 
		    	   !empty($input['medication_cyst']) || !empty($input['endometriosis']) ||
		    	   !empty($input['medication_endometriosis']) || !empty($input['uterinefibroids']) ||
		    	   !empty($input['medication_uterinefibroids']) || !empty($input['uti']) || 
		    	   !empty($input['medication_uti']) || !empty($input['cancer']) || 
		    	   !empty($input['medication_cancer']) || !empty($input['father']) || !empty($input['mother']) ||
		    	   !empty($input['sibling']) || !empty($input['grandfather']) || !empty($input['grandmother']) ||
		    	   !empty($input['allergy_general']) || !empty($input['alcohol']) || !empty($input['tobaco-smoke']) || !empty($input['tobaco-chew'])  || !empty($input['other-social-history']))
    			{
    				//Menstrual History, Present & Past, Family History, General Allergy, Social History and Other
	    			$dataArray = array('menstrual_menarche' => $menarche,
			    					   'menstrual_menopause' => $menopause,
			    					   'medical_history_reference' => $referenceId,
			    					   'history_family_father' =>json_encode($fatherHistory),
			    					   'history_family_father_other' => $fatherHistoryOther,
			    					   'history_family_mother' => json_encode($motherHistory),
			    					   'history_family_mother_other' => $motherHistoryOther,
			    					   'history_family_sibling' => json_encode($siblingHistory),
			    					   'history_family_sibling_other' => $siblingHistoryOther,
			    					   'history_family_grandfather' =>json_encode($grandfatherHistory),
			    					   'history_family_grandfather_other' => $grandfatherHistoryOther,
			    					   'history_family_grandmother' => json_encode($grandmotherHistory),
			    					   'history_family_grandmother_other' => $grandmotherHistoryOther,
			    					   'history_allergy_general' =>json_encode($allergyGeneral),
			    					   'history_social_alcohol' => $alcohol,
			    					   'history_social_tobacco_smoke' => $tobacoSmoke,
			    					   'history_social_tobacco_chew' => $tobacoChew,
			    					   'history_social_other' => $OtherSocialHistory,
			    					   'history_other' => $otherMedicalHistory,
			    					   'id_patient' => $patientId,
			    					   'id_doctor' => $doctorId,
			    					   'created_date' => $createdDate);

	    			$dataInsert = DB::table('medical_history')->insert($dataArray);
		
    				
    			}
    			//Present Past More
    			
			   	$count = count($illnessName);									
			    for($i=0;$i<$count;$i++){
			    	if(!empty($illnessName[$i]) && !empty($illnessStatus[$i]) && !empty($illnessMedication[$i])){
						$illnessArray = array('id_patient' 			=> $patientId,
		    							  'id_doctor' 			=> $doctorId,
		    							  'illness_name' 		=> $illnessName[$i],
		    							  'illness_status' 		=> $illnessStatus[$i],
		    							  'medication' 			=> $illnessMedication[$i],
		    							  'illness_reference' 	=> $referenceId,
		    							  'created_date' 		=> $createdDate);
						$presentPastMoreSave = DB::table('medical_history_present_past_more')->insert($illnessArray);
					}
					
			    }
		    


	    		if(!empty($surgery)) { $surgery = array_filter($surgery);} {
	    			//echo "njan ipo surgeryude not empty if il und";
	    			
			    	if(!empty($surgery)){
			    		for($i=0;$i<count($input['surgery']); $i++){
			    			$suregeryData = array('surgery_name' => $surgery[$i],
			    								  'id_patient' => $patientId,
			    								  'id_doctor' => $doctorId,
			    								  'surgery_reference'=>$referenceId,
			    								  'created_date'=> $createdDate);

			    			$surgerySave = DB::table('medical_history_surgical')->insert($suregeryData);

			    		}
			    	}
				}

				if(!empty($allergyMedication) && !empty($allergyReaction)){
					//echo "ini allergy insert akundo nokam";
		    		$allergyMedication = array_filter($allergyMedication);
		    		$allergyReaction   = array_filter($allergyReaction);
		    		
		    		if(!empty($allergyMedication) && !empty($allergyReaction)){
		    			$this->addDrugAllergyDetails($allergyMedication,$allergyReaction,$patientId,$doctorId,$referenceId,$createdDate);
		    		}
		    	}
		    	else{
		    		if($allergyCounter>0){
		    			//return Redirect::to('patientmedicalhistory')->with(array('error'=>'Please fill data'));
		    		}
		    	}

	    	}
	    	
	    	$status = array('status'=>"success",'message'=>'Data saved successfully');
				
			$result['response'] = $status;
			return response()->json($result);
	  
	    	//return Redirect::to('patientmedicalhistory')->with(array("success"=>"Data saved"));
	    }



    }
    public function illnessSurgeryDrugInsert($illnessCounter,$input,$surgery,$allergyMedication,$allergyReaction,$allergyCounter,$patientId,$doctorId,$referenceId,$createdDate){
    	

	    	//Surgery History Insert
	    	/*if($surgeryCounter>0){*/
	    	if(!empty($surgery)) { $surgery = array_filter($surgery); }
	    	if(!empty($surgery)){
	    		for($i=0;$i<count($input['surgery']); $i++){
	    			$suregeryData = array('surgery_name' => $surgery[$i],
	    								  'id_patient' => $patientId,
	    								  'id_doctor' => $doctorId,
	    								  'surgery_reference'=>$referenceId,
	    								  'created_date'=> $createdDate);

	    			$surgerySave = DB::table('medical_history_surgical')->insert($suregeryData);

	    		}
	    	}
		    //}	

		    	//Drug Allergy History
	    	//if($allergyCounter>0){
	    		
	    	if(!empty($allergyMedication) && !empty($allergyReaction)){
	    		$allergyMedication = array_filter($allergyMedication);
	    		$allergyReaction   = array_filter($allergyReaction);
	    		
	    		if(!empty($allergyMedication) && !empty($allergyReaction)){
	    			$this->addDrugAllergyDetails($allergyMedication,$allergyReaction,$patientId,$doctorId,$referenceId,$createdDate);
	    		}
	    	}
	    	else{
	    		if($allergyCounter>0){
	    			//$status = array('status'=>"error",'message'=>'Please fill empty data');
				
					//$result['response'] = $status;
					//return response()->json($result);
	    		}
	    	}
		    //}	
	    

    }
    public function addDrugAllergyDetails($allergyMedication,$allergyReaction,$patientId,$doctorId,$referenceId,$createdDate){

		//echo "njan addDrugAllergyDetails Keriye";
			foreach($allergyMedication as $index=>$value){
				
				$drugName = $allergyMedication[$index];
				$reactionName = $allergyReaction[$index];
				$allergyData = array('drug_name' => $drugName,
									 'reaction' => $reactionName,
									 'id_patient' => $patientId,
									 'id_doctor' => $doctorId,
									 'drug_allergy_reference' => $referenceId,
									 'created_date' => $createdDate);
				$alleryInsert = DB::table('medical_history_drug_allergy')->insert($allergyData);
			}
			
		//}

    }


    public function getPatientMedicalHistoryService(){

    	$patientId = Input::get('id_patient');

    	$medicalHistoryData = DB::table('medical_history')
    										->where('id_patient','=',$patientId)
    										->where('created_date',DB::raw("(select max(`created_date`) from medical_history 	    where id_patient='$patientId')"))
    										->first();
    	$illnessData = DB::table('medical_history_present_past_more')->where('id_patient','=',$patientId)->get();

    	$surgicalData = DB::table('medical_history_surgical')->where('id_patient','=',$patientId)->get();

    	$drugAllergyData = DB::table('medical_history_drug_allergy')->where('id_patient','=',$patientId)->get(); 	

    	//	var_dump($illnessData);	

    	if(!empty($medicalHistoryData)){
    		$result['result']['id_patient'] = $medicalHistoryData->id_patient;
    		$result['result']['id_doctor'] = $medicalHistoryData->id_doctor;
    		$result['result']['menarche'] = $medicalHistoryData->menstrual_menarche;
    		$result['result']['menopause'] = $medicalHistoryData->menstrual_menopause;
    		$result['result']['father'] = json_decode($medicalHistoryData->history_family_father);
    		$result['result']['father_other'] = $medicalHistoryData->history_family_father_other;
    		$result['result']['mother'] = json_decode($medicalHistoryData->history_family_mother);
    		$result['result']['mother_other'] =$medicalHistoryData->history_family_mother_other;
    		$result['result']['sibling'] = json_decode($medicalHistoryData->history_family_sibling);
    		$result['result']['sibling_other'] = $medicalHistoryData->history_family_sibling_other;
    		$result['result']['grandfather'] = json_decode($medicalHistoryData->history_family_grandfather);
    		$result['result']['grandfather_other'] = $medicalHistoryData->history_family_grandfather_other;
    		$result['result']['grandmother'] = json_decode($medicalHistoryData->history_family_grandmother);
    		$result['result']['grandmother_other'] = $medicalHistoryData->history_family_grandmother_other;
    		$result['result']['allergy_general'] = json_decode($medicalHistoryData->history_allergy_general);
    		$result['result']['alcohol'] =$medicalHistoryData->history_social_alcohol;
    		$result['result']['tobaco-smoke'] = $medicalHistoryData->history_social_tobacco_smoke;
    		$result['result']['tobaco-chew'] = $medicalHistoryData->history_social_tobacco_chew;
    		$result['result']['other-social-history'] = $medicalHistoryData->history_social_other;
    		$result['result']['created_date'] = $medicalHistoryData->created_date;
    		$result['result']['referenceId'] = $medicalHistoryData->medical_history_reference;
    	}

    	if(!empty($illnessData)){
    		$illnessNameArray = array();
	    	$illnessStatusArray = array();
	    	$illnessMedicationArray = array();
	    	for($i=0;$i<count($illnessData);$i++){
	    		
	    		array_push($illnessNameArray,$illnessData[$i]->illness_name );
	    		array_push($illnessStatusArray,$illnessData[$i]->illness_status);
	    		array_push($illnessMedicationArray,$illnessData[$i]->medication);
	    	}

	    	$result['result']['illness_name'] = $illnessNameArray;
	    	$result['result']['illness_status'] = $illnessStatusArray;
	    	$result['result']['illness_medication'] = $illnessMedicationArray;
	
    	}

    	if(!empty($surgicalData)){
    		$surgeryArray = array();
    		for($i=0;$i<count($surgicalData);$i++){
    			array_push($surgeryArray,$surgicalData[$i]->surgery_name );
    		}
    		$result['result']['surgery'] = $surgeryArray;
    	}

    	if(!empty($drugAllergyData)){
    		$drugNameArray = array();
    		$reactionNameArray = array();
    		for($i=0;$i<count($drugAllergyData);$i++){
    			array_push($drugNameArray,$drugAllergyData[$i]->drug_name );
    			array_push($reactionNameArray,$drugAllergyData[$i]->reaction );
    		}
    		$result['result']['medication-drug-allergy'] = $drugNameArray;
    		$result['result']['reaction-drug-allergy'] = $reactionNameArray;
    	}
    	
    	return response()->json($result);					

    }	
    public function getPatientPreviousTreatmentService(){

    	$patientId = Input::get('id_patient');
    	//echo $patientId;

    	$patientExistCheck = DB::table('patients')->where('id_patient','=',$patientId)->first();


    	if(!empty($patientExistCheck)){
    		$obsData 	= DB::table('sp_gynaecology_obs')
		                                    ->where('id_patient','=',$patientId)
										    ->groupBy('created_date')
										    ->orderBy('created_date','asc')
										    ->get();

			

			
/*
			$pregData   = DB::table('sp_gynaecology_obs_preg')
			                                    ->where('id_patient','=',$patientId)->orderBy('created_date','desc')->get();



			$vitalsData = DB::table('vitals')
			                            ->where('id_patient','=',$patientId)->orderBy('created_date','desc')->get();



			$diagnosisData =  DB::table('diagnosis')
			                            ->where('id_patient','=',$patientId)->orderBy('created_date','desc')->get();


			$prescMedicineData =  DB::table('prescription')
			                            ->where('id_patient','=',$patientId)->orderBy('created_date','desc')->get();*/
			   
			
			$pregData = DB::table('sp_gynaecology_obs_preg')->where('id_patient','=',$patientId)->orderBy('created_date','desc')->get();
			$vitalsData = DB::table('vitals')->where('id_patient','=',$patientId)->orderBy('created_date','desc')->get();
			$diagnosisData =  DB::table('diagnosis')->where('id_patient','=',$patientId)->orderBy('created_date','desc')->get();
			$prescMedicineData =  DB::table('prescription')->where('id_patient','=',$patientId)->orderBy('created_date','desc')->get();
			
			
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
		  
		 	//var_dump(json_encode($originalCreatedDate));
		 	
		   
			/*$obsData = DB::table('sp_gynaecology_obs')
												->whereIn('created_date', $originalCreatedDate)
												->where('id_patient','=',$patientId)
												->get();	
					
												
			

			$pregData = DB::table('sp_gynaecology_obs_preg')
												->whereIn('created_date', $originalCreatedDate)
												->where('id_patient','=',$patientId)
												->get();
			$vitalsData = DB::table('vitals')
										->whereIn('created_date', $originalCreatedDate)
										->where('id_patient','=',$patientId)
										->get();
			$diagnosisData = DB::table('diagnosis AS d')
										->leftJoin('vitals AS v','v.id_patient','=','d.id_patient')
										->whereIn('d.created_date', $originalCreatedDate)
										->where('d.id_patient','=',$patientId)
										->get();*/


			//Decoding Json ecnodded
			$diagnosisDataArray = array();
			if(!empty($diagnosisData)){

				foreach($diagnosisData as $index=>$diagnosisDataVal){
					$diagnosisData = array("id_diagnosis"=>$diagnosisDataVal->id_diagnosis,
									        "id_patient"=>$diagnosisDataVal->id_patient,
									        "id_doctor"=>$diagnosisDataVal->id_doctor,
									        "diag_symptoms"=>json_decode($diagnosisDataVal->diag_symptoms),
									        "diag_syndromes"=>$diagnosisDataVal->diag_syndromes,
									        "diag_suspected_diseases"=>json_decode($diagnosisDataVal->diag_suspected_diseases),
									        "diag_comment"=>$diagnosisDataVal->diag_comment,
									        "diag_reference"=>$diagnosisDataVal->diag_reference,
									        "created_date"=>$diagnosisDataVal->created_date,
									        "edited_date"=>$diagnosisDataVal->edited_date
			        				);

					array_push($diagnosisDataArray,$diagnosisData);
				}
			}


			$prescMedicineData = DB::table('prescription')
										->whereIn('created_date', $originalCreatedDate)
										->where('id_patient','=',$patientId)
										->get();

			//var_dump($originalCreatedDateDup);

			//var_dump($obsData);
			/*echo "<br>";
			$obsDataArray = array();
			$createdDateArray =  array();

			foreach ($originalCreatedDateDup as $index => $originalCreatedDateDupVal) {
				echo $originalCreatedDateDupVal;
				if(!empty($obsData)){
					foreach($obsData as $index=>$obsDataVal){
						$obsCreatedDate = date('Y-m-d',strtotime($obsDataVal->created_date));
						
						if($originalCreatedDateDupVal==$obsCreatedDate){
							//var_dump($obsDataVal);
							$createdDate = $obsCreatedDate;
							echo "Or->".$originalCreatedDateDupVal."=".$createdDate;
							echo "<br>";
							
							

						}
						else{
							echo "Not mathing";
						}
						$result['result']['created_date'] = '';
						
					}

				}

			}*/
			//$result['result']['created_date'] = $newArray;
			//$result['result']['gyn_obs_data'] =$obsDataArray;
			
			/*return response()->json($result);


			die();*/

	        if(!empty($obsData)){
	        	$status = array('status'=>"success",'message'=>'Obs Data exists');
				$result['result']['gyn_obs_data'] =$obsData;
				$result['response']['gyn_obs_response'] = $status;
	        }
	        else{
	        	$status = array('status'=>"error",'message'=>'Obs Data Not Found');
				$result['result']['gyn_obs_data'] =[];
				$result['response']['gyn_obs_response'] = $status;
	        }

	        /*if(!empty($lmpData)){
	        	$status = array('status'=>"success",'message'=>'Obs Lmp Data exists');
				$result['result']['gyn_obs_lmp_data'] =$lmpData;
				$result['response']['gyn_obs__lmp_response'] = $status;
	        }
	        else{
	        	$status = array('status'=>"error",'message'=>'Obs Lmp Data Not Found');
				$result['result']['gyn_obs_lmp_data'] =$lmpData;
				$result['response']['gyn_obs__lmp_response'] = $status;
	        }*/

	        if(!empty($pregData)){
	        	$status = array('status'=>"success",'message'=>'Obs Preg Data exists');
				$result['result']['gyn_obs_preg_data'] =$pregData;
				$result['response']['gyn_obs_preg_response'] = $status;
	        }
	        else{
	        	$status = array('status'=>"error",'message'=>'Obs Preg Data Not Found');
				$result['result']['gyn_obs_preg_data'] =[];
				$result['response']['gyn_obs_preg_response'] = $status;
	        }

	        if(!empty($vitalsData)){
	        	$status = array('status'=>"success",'message'=>'Vitals Data exists');
				$result['result']['vitals_data'] =$vitalsData;
				$result['response']['vitals_response'] = $status;
	        }
	        else{
	        	$status = array('status'=>"error",'message'=>'Vitals Data Not Found');
				$result['result']['vitals_data'] =[];
				$result['response']['vitals_response'] = $status;
	        }

	        if(!empty($diagnosisDataArray)){
	        	$status = array('status'=>"success",'message'=>'Diagnosis Data exists');
				$result['result']['diag_data'] =$diagnosisDataArray;
				$result['response']['diag_response'] = $status;
	        }
	        else{
	        	$status = array('status'=>"error",'message'=>'Diagnosis Data Not Found');
				$result['result']['diag_data'] =[];
				$result['response']['diag_response'] = $status;
	        }

	        if(!empty($prescMedicineData)){
	        	$status = array('status'=>"success",'message'=>'MedicalPrescription Data exists');
				$result['result']['presc_data'] =$prescMedicineData;
				$result['response']['presc_response'] = $status;
	        }
	        else{
	        	$status = array('status'=>"error",'message'=>'MedicalPrescription Data Not Found');
				$result['result']['presc_data'] =[];
				$result['response']['presc_response'] = $status;
	        }


			return response()->json($result);
    	}
    	else{
    		$status = array('status'=>"error",'message'=>'Invalid PatientID');
			$result['response']= $status;
			return response()->json($result);
    	}
    	
    	
    }

    public function addPatientExaminationService(){
    	$input = Request::all();
    	

    	$patientId 		= $input['id_patient']; //"KL100";//Session::get('patientId');
    	$doctorId 		= $input['id_doctor']; //"2";//Session::get('doctorId');
    	$referenceId 	= $input['diag_reference'];//"C50BX";//Session::get('referenceId');
    	$createdDate 	= $input['created_date']; //date('Y-m-d H:i:s');


    	 $patientExistCheck = DB::table('patients')->where('id_patient','=',$patientId)->count();


    	if($patientExistCheck>0){

    	 
	    	//Vitals Insert and Update
	    	$vitalsExist = DB::table('vitals')
	    								->where('id_patient','=',$patientId)
	    								->where('vitals_reference','=',$referenceId)
	    								->get();

	    	
	    	(!empty($input['weight']))?$weight = $input['weight']:$weight="";
	    	(!empty($input['height']))?$height = $input['height']:$height="";
	    	(!empty($input['bmi']))?$bmi = $input['bmi']:$bmi="";
	    	(!empty($input['blood_group']))?$bloodGroup = $input['blood_group']:$bloodGroup="";
	    	(!empty($input['systolic_pressure']))?$systolicPressure = $input['systolic_pressure']:$systolicPressure="";
	    	(!empty($input['diastolic_pressure']))?$diastolicPressure = $input['diastolic_pressure']:$diastolicPressure="";
	    	(!empty($input['sp']))?$spo2 = $input['sp']:$spo2="";
	    	(!empty($input['pulse']))?$pulse = $input['pulse']:$pulse="";
	    	(!empty($input['respiratoryrate']))?$respiratoryRate = $input['respiratoryrate']:$respiratoryRate="";
	    	(!empty($input['temperature']))?$temperature = $input['temperature']:$temperature="";

	    	

	    	if(!empty($vitalsExist)){
	    		if(!empty($weight) || !empty($height) || !empty($bmi) || !empty($bloodGroup) || !empty($systolicPressure) ||
		    	   !empty($diastolicPressure) || !empty($spo2) || !empty($pulse) || !empty($respiratoryRate) || !empty($temperature) )
		    	{
		    		//echo "Vitals Update";
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
	    							'edited_date' => $createdDate);

	    				$vitalsUpdate = DB::table('vitals')
	    											->where('id_patient','=',$patientId)
	    											->where('id_doctor','=',$doctorId)
	    											->where('vitals_reference','=',$referenceId)
	    											->where('created_date','=',$createdDate)
	    											->update($vitalsData);
		    	}
	    	
	    				

	    	}
	    	else
	    	{
	    			//echo "Vitals Insert";

		    	if(!empty($weight) || !empty($height) || !empty($bmi) || !empty($bloodGroup) || !empty($systolicPressure) ||
		    	   !empty($diastolicPressure) ||
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
		    	}

	    	}


	    	//Systemic Examination

	    	$systemicExamExist = DB::table('diagnosis_gynaecology_exam')
	    											->where('id_patient','=',$patientId)
				    								->where('created_date','=',$createdDate)
				    								->where('diag_reference','=',$referenceId)
				    								->get();



	    	(!empty($input['diag_systemic_external_genetalia']))?$externalGenetalia = $input['diag_systemic_external_genetalia']:$externalGenetalia="";
	    	(!empty($input['diag_systemic_external_genetalia_detail']))?$extGenetaliaOther= $input['diag_systemic_external_genetalia_detail']:$extGenetaliaOther="";
	    	(!empty($input['diag_systemic_preabdomen']))?$preAbdomenExam = $input['diag_systemic_preabdomen']:$preAbdomenExam="";
	    	(!empty($input['diag_systemic_preabdomen_detail']))?$preAbdomenOther = $input['diag_systemic_preabdomen_detail']:$preAbdomenOther="";
	    	(!empty($input['diag_systemic_breast_lump']))?$sysBreastLump = $input['diag_systemic_breast_lump']:$sysBreastLump="";
	    	(!empty($input['diag_systemic_breast_detail']))?$sysBreastLumpOther = $input['diag_systemic_breast_detail']:$sysBreastLumpOther="";
	    	(!empty($input['diag_systemic_breast_galatorrhea']))?$sysBreastGalactorrhea = $input['diag_systemic_breast_galatorrhea']:$sysBreastGalactorrhea="";
	    	(!empty($input['diag_systemic_breast_galatorrhea_detail']))?$sysBreastGalactorrheaOther = $input['diag_systemic_breast_galatorrhea_detail']:$sysBreastGalactorrheaOther="";
	    	(!empty($input['diag_systemic_breast_other']))?$sysBreastOther = $input['diag_systemic_breast_other']:$sysBreastOther="";
	    	(!empty($input['diag_systemic_breast_other_detail']))?$sysBreastOtherOther = $input['diag_systemic_breast_other_detail']:$sysBreastOtherOther="";
	    	(!empty($input['diag_systemic_secondarysex_welldeveloped']))?$sysSecondarySexWellDeveloped = $input['diag_systemic_secondarysex_welldeveloped']:$sysSecondarySexWellDeveloped="";
	    	(!empty($input['diag_systemic_secondarysex_welldeveloped_detail']))?$sysSecondarySexWellDevelopedOther = $input['diag_systemic_secondarysex_welldeveloped_detail']:$sysSecondarySexWellDevelopedOther="";
	    	(!empty($input['diag_systemic_secondarysex_hair']))?$sysSecondarySexHair = $input['diag_systemic_secondarysex_hair']:$sysSecondarySexHair="";
	    	(!empty($input['diag_systemic_secondarysex_hair_detail']))?$sysSecondarySexHairOther = $input['diag_systemic_secondarysex_hair_detail']:$sysSecondarySexHairOther ="";
	    	(!empty($input['diag_systemic_secondarysex_acne']))?$sysSecondarySexAcne = $input['diag_systemic_secondarysex_acne']:$sysSecondarySexAcne ="";
	    	(!empty($input['diag_systemic_secondarysex_acne_detail']))?$sysSecondarySexAcneOther = $input['diag_systemic_secondarysex_acne_detail']:$sysSecondarySexAcneOther ="";
	    	(!empty($input['diag_systemic_secondarysex_other']))?$sysSecondarySexOther = $input['diag_systemic_secondarysex_other']:$sysSecondarySexOther ="";
	    	(!empty($input['diag_systemic_secondarysex_other_detail']))?$sysSecondarySexOtherOther = $input['diag_systemic_secondarysex_other_detail']:$sysSecondarySexOtherOther ="";
	    	(!empty($input['diag_pelvic_perspeculum_healthy']))?$sysPelvicCervixHealthy = $input['diag_pelvic_perspeculum_healthy']:$sysPelvicCervixHealthy ="";
	    	(!empty($input['diag_pelvic_perspeculum_healthy_detail']))?$sysPelvicCervixHealthyOther = $input['diag_pelvic_perspeculum_healthy_detail']:$sysPelvicCervixHealthyOther ="";
	    	(!empty($input['diag_pelvic_perspeculum_bleeding']))?$sysPelvicCervixBleeding = $input['diag_pelvic_perspeculum_bleeding']:$sysPelvicCervixBleeding ="";
	    	(!empty($input['diag_pelvic_perspeculum_bleeding_detail']))?$sysPelvicCervixBleedingOther= $input['diag_pelvic_perspeculum_bleeding_detail']:$sysPelvicCervixBleedingOther ="";
	    	(!empty($input['diag_pelvic_perspeculum_lbc']))?$sysPelvicCervixLbc= $input['diag_pelvic_perspeculum_lbc']:$sysPelvicCervixLbc ="";
	    	(!empty($input['diag_pelvic_perspeculum_lbc_detail']))?$sysPelvicCervixLbcOther= $input['diag_pelvic_perspeculum_lbc_detail']:$sysPelvicCervixLbcOther ="";
	    	(!empty($input['diag_pelvic_pervaginal_avaf']))?$sysPelvicAvaf= $input['diag_pelvic_pervaginal_avaf']:$sysPelvicAvaf ="";
	    	(!empty($input['diag_pelvic_pervaginal_rfrf']))?$sysPelvicRvrf= $input['diag_pelvic_pervaginal_rfrf']:$sysPelvicRvrf ="";
	    	(!empty($input['diag_pelvic_pervaginal_others']))?$sysPelvicOther= $input['diag_pelvic_pervaginal_others']:$sysPelvicOther ="";
	    	
	    	

	    	if(!empty($systemicExamExist)){
	    		$systemicUpdateData = array('diag_systemic_external_genetalia'=> $externalGenetalia,
	    									'diag_systemic_external_genetalia_detail' => $extGenetaliaOther,
	    									'diag_systemic_breast_lump' => $sysBreastLump,
	    									'diag_systemic_breast_detail'=>$sysBreastLumpOther,
	    									'diag_systemic_breast_galatorrhea'=>$sysBreastGalactorrhea,
	    									'diag_systemic_breast_galatorrhea_detail'=> $sysBreastGalactorrheaOther,
	    									'diag_systemic_breast_other'=>$sysBreastOther,
	    									'diag_systemic_breast_other_detail'=>$sysBreastOtherOther,
	    									'diag_systemic_secondarysex_welldeveloped'=>$sysSecondarySexWellDeveloped,
	    									'diag_systemic_secondarysex_welldeveloped_detail'=>$sysSecondarySexWellDevelopedOther,
	    									'diag_systemic_secondarysex_hair'=>$sysSecondarySexHair,
	    									'diag_systemic_secondarysex_hair_detail'=>$sysSecondarySexHairOther,
	    									'diag_systemic_secondarysex_acne'=>$sysSecondarySexAcne,
	    									'diag_systemic_secondarysex_acne_detail'=>$sysSecondarySexAcneOther,
	    									'diag_systemic_secondarysex_other'=>$sysSecondarySexOther,
	    									'diag_systemic_secondarysex_other_detail'=>$sysSecondarySexOtherOther,
	    									'diag_systemic_preabdomen' => $preAbdomenExam,
	    									'diag_systemic_preabdomen_detail'=>$preAbdomenOther,
	    									'diag_pelvic_perspeculum_healthy'=>$sysPelvicCervixHealthy,
	    									'diag_pelvic_perspeculum_healthy_detail'=>$sysPelvicCervixHealthyOther,
	    									'diag_pelvic_perspeculum_bleeding' =>$sysPelvicCervixBleeding,
	    									'diag_pelvic_perspeculum_bleeding_detail'=>$sysPelvicCervixBleedingOther,
	    									'diag_pelvic_perspeculum_lbc' => $sysPelvicCervixLbc,
	    									'diag_pelvic_perspeculum_lbc_detail'=>$sysPelvicCervixLbcOther,
	    									'diag_pelvic_pervaginal_avaf' =>$sysPelvicAvaf,
	    									'diag_pelvic_pervaginal_rfrf'=>$sysPelvicRvrf,
	    									'diag_pelvic_pervaginal_others'=>$sysPelvicOther,
	    									'edited_date' => $createdDate);

	    		if(!empty($externalGenetalia) || !empty($preAbdomenExam) || !empty($sysBreastLump) || 
		    	   !empty($sysBreastGalactorrhea) || !empty($sysBreastOther) || !empty($sysSecondarySexWellDeveloped) ||
		    	   !empty($sysSecondarySexHair) || !empty($sysSecondarySexAcne) || !empty($sysPelvicCervixHealthy) ||
		    	   !empty($sysPelvicCervixBleeding) || !empty($sysPelvicCervixLbc) || !empty($sysPelvicAvaf) ||
		    	   !empty($sysPelvicRvrf) || !empty($sysPelvicOther))
		    	{
		    		//echo "njan ipo update nte id nte ulil und";
		    		$systemicUpdate = DB::table('diagnosis_gynaecology_exam')
				    											->where('id_patient','=',$patientId)
				    											->where('id_doctor','=',$doctorId)
				    											->where('created_date','=',$createdDate)
				    											->where('diag_reference','=',$referenceId)
				    											->update($systemicUpdateData);

		    	}
	    	}
	    	else{
	    		
	    		$systemicSaveData = array('diag_systemic_external_genetalia'=> $externalGenetalia,
	    									'diag_systemic_external_genetalia_detail' => $extGenetaliaOther,
	    									'diag_systemic_breast_lump' => $sysBreastLump,
	    									'diag_systemic_breast_detail'=>$sysBreastLumpOther,
	    									'diag_systemic_breast_galatorrhea'=>$sysBreastGalactorrhea,
	    									'diag_systemic_breast_galatorrhea_detail'=> $sysBreastGalactorrheaOther,
	    									'diag_systemic_breast_other'=>$sysBreastOther,
	    									'diag_systemic_breast_other_detail'=>$sysBreastOtherOther,
	    									'diag_systemic_secondarysex_welldeveloped'=>$sysSecondarySexWellDeveloped,
	    									'diag_systemic_secondarysex_welldeveloped_detail'=>$sysSecondarySexWellDevelopedOther,
	    									'diag_systemic_secondarysex_hair'=>$sysSecondarySexHair,
	    									'diag_systemic_secondarysex_hair_detail'=>$sysSecondarySexHairOther,
	    									'diag_systemic_secondarysex_acne'=>$sysSecondarySexAcne,
	    									'diag_systemic_secondarysex_acne_detail'=>$sysSecondarySexAcneOther,
	    									'diag_systemic_secondarysex_other'=>$sysSecondarySexOther,
	    									'diag_systemic_secondarysex_other_detail'=>$sysSecondarySexOtherOther,
	    									'diag_systemic_preabdomen' => $preAbdomenExam,
	    									'diag_systemic_preabdomen_detail'=>$preAbdomenOther,
	    									'diag_pelvic_perspeculum_healthy'=>$sysPelvicCervixHealthy,
	    									'diag_pelvic_perspeculum_healthy_detail'=>$sysPelvicCervixHealthyOther,
	    									'diag_pelvic_perspeculum_bleeding' =>$sysPelvicCervixBleeding,
	    									'diag_pelvic_perspeculum_bleeding_detail'=>$sysPelvicCervixBleedingOther,
	    									'diag_pelvic_perspeculum_lbc' => $sysPelvicCervixLbc,
	    									'diag_pelvic_perspeculum_lbc_detail'=>$sysPelvicCervixLbcOther,
	    									'diag_pelvic_pervaginal_avaf' =>$sysPelvicAvaf,
	    									'diag_pelvic_pervaginal_rfrf'=>$sysPelvicRvrf,
	    									'diag_pelvic_pervaginal_others'=>$sysPelvicOther,
	    									'id_patient' => $patientId,
		    								'id_doctor'=>$doctorId,
		    								'diag_reference'=>$referenceId,
		    								'created_date' => $createdDate);	
		    	
		    	if(!empty($externalGenetalia) || !empty($preAbdomenExam) || !empty($sysBreastLump) || 
		    	   !empty($sysBreastGalactorrhea) || !empty($sysBreastOther) || !empty($sysSecondarySexWellDeveloped) ||
		    	   !empty($sysSecondarySexHair) || !empty($sysSecondarySexAcne) || !empty($sysPelvicCervixHealthy) ||
		    	   !empty($sysPelvicCervixBleeding) || !empty($sysPelvicCervixLbc) || !empty($sysPelvicAvaf) ||
		    	   !empty($sysPelvicRvrf) || !empty($sysPelvicOther))
		    	{
		    		$systemicSave = DB::table('diagnosis_gynaecology_exam')->insert($systemicSaveData);
		    	}
		    }
	    }
	    else{
	    	$status = array('status'=>"error",'message'=>'Invalid patient ID');
	    }

	   $status = array('status'=>"success",'message'=>'Data saved successfully');
		

		$result['response'] = $status;	
		return response()->json($result);		
    }

    public function getPatientExaminationService(){
    	$input = Request::all();
    	$patientId 		= $input['id_patient'];

    	$patientExistCheck = DB::table('patients')->where('id_patient','=',$patientId)->first();

    	if(!empty($patientExistCheck)){
    		$patientExaminationData = DB::table('vitals As v')
    											->leftJoin('diagnosis_gynaecology_exam As d','d.id_patient','=','v.id_patient')
    											->where('d.id_diag_gynaecology_exam',DB::raw("(select max(`id_diag_gynaecology_exam`) from diagnosis_gynaecology_exam where id_patient='$patientId')"))
    											->where('v.id_vitals',DB::raw("(select max(`id_vitals`) from vitals where id_patient='$patientId')"))
    											->first();


    		if(!empty($patientExaminationData)){
    			$status = array('status'=>"success",'message'=>'Data exists');
    			$result['response'] = $status;
    			//$result['response'] = $patientVitalsData;
    			$result['result'] = $patientExaminationData;
    			//$result['response']['id_doctor'] = "L5222";
    			return response()->json($result);	
    		}
    		else{
    			$status = array('status'=>"error",'message'=>'No Data exists');
    			$result['response'] = $status;
    			return response()->json($result);	
    		}
    		

    	}
    	else{
    		$status = array('status'=>"error",'message'=>'Invalid patient ID');
    		$result = $status;
    		return response()->json($result);	
    	}

    	
    	


    }

    public function addPatientDiagnosisService(){
    	$input 		 = Request::all();


	
	  	$patientId 		= $input['id_patient']; //"KL100";//Session::get('patientId');
    	$doctorId 		= $input['id_doctor']; //"2";//Session::get('doctorId');
    	$referenceId 	= $input['diag_reference'];//"C50BX";//Session::get('referenceId');
    	$createdDate 	= $input['created_date'];
    	//var_dump($input);
    	//die();

    	$patientExistCheck = DB::table('patients')->where('id_patient','=',$patientId)->first();

    	if(!empty($patientExistCheck)){
    		
    		$diagExistCheck = DB::table('diagnosis')->where('id_patient','=',$patientId)
    											->where('diag_reference','=',$referenceId)
    											->where('created_date','=',$createdDate)
    											->first();
   
	    	(!empty($input['diag_symptoms']))?$symptoms= $input['diag_symptoms']:$symptoms ="";
	    	(!empty($input['diag_syndromes']))?$syndromes= $input['diag_syndromes']:$syndromes ="";
	    	(!empty($input['diag_suspected_diseases']))?$diseases= $input['diag_suspected_diseases']:$diseases ="";
	    	(!empty($input['diag_comment']))?$additionalComment= $input['diag_comment']:$additionalComment ="";
	    		
	    	if(!empty($diagExistCheck)){
	    		
	    		$diagData = array('diag_symptoms'=>json_encode($symptoms),
	    						  'diag_syndromes'=>$syndromes,
	    						  'diag_suspected_diseases'=>json_encode($diseases),
	    						  'diag_comment' => $additionalComment,
	    						  'edited_date'=>$createdDate);
	    		if(!empty($diseases)){
		    		$diagUpdate = DB::table('diagnosis')->update($diagData);
		    		if(!empty($diagUpdate)){
		    			$status = array('status'=>"success",'message'=>'Data updated successfully');
	    				$result['response'] = $status;
	    				return response()->json($result);
		    		}
		    		else 
		    		{
		    			$status = array('status'=>"error",'message'=>'Failed to  update data');
	    				$result['response'] = $status;
	    				return response()->json($result);
		    		}	
		    	}

	    	}
	    	else{
	    		
	    		$diagData = array('diag_symptoms'=>json_encode($symptoms),
		    						  'diag_syndromes'=>$syndromes,
		    						  'diag_suspected_diseases'=>json_encode($diseases),
		    						  'diag_comment' => $additionalComment,
		    						  'id_patient'=>$patientId,
		    						  'id_doctor'=>$doctorId,
		    						  'diag_reference' => $referenceId,
		    						  'created_date'=>$createdDate);
	    		if(!empty($diseases)){
	    			
		    		$diagSave = DB::table('diagnosis')->insert($diagData);
		    		if(!empty($diagSave)){
		    			$status = array('status'=>"success",'message'=>'Data saved successfully');
	    				$result['response'] = $status;
	    				return response()->json($result);
		    		}
		    		else 
		    		{
		    			$status = array('status'=>"error",'message'=>'Failed to  save data');
	    				$result['response'] = $status;
	    				return response()->json($result);
		    		}	
	    		}
	    		else{
	    			echo "empty";
	    		}

	    	}				
    	}
    	else{
    		$status = array('status'=>"error",'message'=>'Invalid patient id');
			$result['response'] = $status;
			return response()->json($result);
    	}

    						

    	//return Redirect::to('patientdiagnosis')->with(array('success'=>"Data saved successfully"));	

    
    }

    public function getPatientDiagnosisService(){
    	$input = Request::all();
    	$patientId 		= $input['id_patient'];

    	$patientExistCheck = DB::table('patients')->where('id_patient','=',$patientId)->first();

    	if(!empty($patientExistCheck)){
    		$patientDiagnosisData = DB::table('diagnosis')
    											->where('id_diagnosis',DB::raw("(select max(`id_diagnosis`) from diagnosis where id_patient='$patientId')"))
    											->get();

    		foreach($patientDiagnosisData as $index=>$val){
    			  $diagId = $val->id_diagnosis;
    			  $patientId = $val->id_patient;
			      $doctorId = $val->id_doctor;
			      $symptoms = json_decode($val->diag_symptoms);
			      $syndrome = $val->diag_syndromes;
			      $diseases = json_decode($val->diag_suspected_diseases);
			      $comment = $val->diag_comment;
			      $referenceId = $val->diag_reference;
			      $createdDate = $val->created_date;
			      $editedDate = $val->edited_date;

    		}

    		$patientDiagnosisData = array(
								      "id_diagnosis"=> $diagId,
								      "id_patient"=> $patientId,
								      "id_doctor"=> $doctorId,
								      "diag_symptoms"=>$symptoms,
								      "diag_syndromes"=> $syndrome,
								      "diag_suspected_diseases"=> $diseases,
								      "diag_comment"=> $comment,
								      "diag_reference"=> $referenceId,
								      "created_date"=> $createdDate,
								      "edited_date"=> $editedDate
								    );
			
    		if(!empty($patientDiagnosisData)){
    			$status = array('status'=>"success",'message'=>'Data exists');
    			$result['response'] = $status;
    			$result['result'] = (array) $patientDiagnosisData;
    			return response()->json($result);	
    		}
    		else{
    			$status = array('status'=>"error",'message'=>'No Data exists');
    			$result['response'] = $status;
    			return response()->json($result);	
    		}
    		

    	}
    	else{
    		$status = array('status'=>"error",'message'=>'Invalid patient ID');
    		$result = $status;
    		return response()->json($result);	
    	}
    }

    public function addPatientPrescManagementService(){
    	$input = Request::all();
		$patientId 		= $input['id_patient']; //"KL100";//Session::get('patientId');
    	$doctorId 		= $input['id_doctor']; //"2";//Session::get('doctorId');
    	$referenceId 	= $input['id_reference'];//"C50BX";//Session::get('referenceId');
    	$createdDate 	= $input['created_date'];
		//var_dump($input);

		$patientExistCheck = DB::table('patients')->where('id_patient','=',$patientId)->count();

		if($patientExistCheck>0){

			$prescGynDataExist = DB::table('prescription_gynaecology')
    											->where('id_patient','=',$patientId)
			    								->where('created_date','=',$createdDate)
			    								->where('presc_gyn_reference','=',$referenceId)
			    								->get();

			(!empty($input['line_of_treatment']))?$prescLineOfTreatment= $input['line_of_treatment']:$prescLineOfTreatment ="";
			(!empty($input['line_of_treatment_detail']))?$prescLineOfTreatmentOther= $input['line_of_treatment_detail']:$prescLineOfTreatmentOther ="";
			(!empty($input['presc_general_exercise']))?$prescGeneralExercise= $input['presc_general_exercise']:$prescGeneralExercise ="";
			(!empty($input['presc_general_exercise_detail']))?$prescGeneralExerciseOther= $input['presc_general_exercise_detail']:$prescGeneralExerciseOther ="";
			(!empty($input['presc_general_diet']))?$prescDiet= $input['presc_general_diet']:$prescDiet =[""];
			(!empty($input['presc_general_diet_detail']))?$prescDietOther= $input['presc_general_diet_detail']:$prescDietOther ="";
			(!empty($input['presc_exercise']))?$exercise= $input['presc_exercise']:$exercise ="";

			$prescDiet = array_filter($prescDiet);

			if(!empty($prescGynDataExist)){
				$prescGynData = array('line_of_treatment' => $prescLineOfTreatment,
									  'line_of_treatment_detail' => $prescLineOfTreatmentOther,
									  'presc_general_exercise'=>$prescGeneralExercise,
									  'presc_general_exercise_detail'=>$prescGeneralExerciseOther,
									  'presc_general_diet'=>json_encode($prescDiet),
									  'presc_general_diet_detail'=>$prescDietOther,
									  'presc_exercise'=>$exercise,
									  'edited_date'=>$createdDate);
				if(!empty($prescLineOfTreatment) || !empty($prescGeneralExercise) || !empty($prescDiet)){

					$prescTreatmentUpdate = DB::table('prescription_gynaecology')
											->where('id_patient','=',$patientId)
											->where('presc_gyn_reference','=',$referenceId)
											->where('created_date','=',$createdDate)
											->update($prescGynData);

					if($prescTreatmentUpdate){
						$status = array('status'=>"success",'message'=>'Data updated successfully');
	    				$result['response'] = $status;
	    				return response()->json($result);
					}
					else{
						$status = array('status'=>"error",'message'=>'Failed to update data');
	    				$result['response']= $status;
	    				return response()->json($result);
					}
				}
				else{
					$status = array('status'=>"error",'message'=>'No data for update');
	    			$result['response']= $status;
	    			return response()->json($result);
					//return Redirect::to('patientprescmanagement')->with(array('error'=>"No data for update"));
				}							

			}
			else{
				
				if(!empty($prescLineOfTreatment) || !empty($prescGeneralExercise) || !empty($prescDiet)){
					
					$prescGynData = array('line_of_treatment' => $prescLineOfTreatment,
									  'line_of_treatment_detail' => $prescLineOfTreatmentOther,
									  'presc_general_exercise'=>$prescGeneralExercise,
									  'presc_general_exercise_detail'=>$prescGeneralExerciseOther,
									  'presc_general_diet'=>json_encode($prescDiet),
									  'presc_general_diet_detail'=>$prescDietOther,
									  'presc_exercise'=>$exercise,
									  'id_patient' => $patientId,
									  'id_doctor' => $doctorId,
									  'presc_gyn_reference'=>$referenceId,
									  'created_date'=>$createdDate);

					$prescTreatmentSave = DB::table('prescription_gynaecology')->insert($prescGynData);

					if($prescTreatmentSave){
						$status = array('status'=>"success",'message'=>'Data saved successfully');
	    				$result['response'] = $status;
	    				return response()->json($result);
					}
					else{
						$status = array('status'=>"error",'message'=>'Failed to save data');
	    				$$result['response'] = $status;
	    				return response()->json($result);
					}

				}
				else{
					$status = array('status'=>"error",'message'=>'No data to save');
	    			$result['response'] = $status;
	    			return response()->json($result);
				}

			}

			//return Redirect::to('patientprescmanagement')->with(array('success'=>'Data saved successfully'));
		}
		else{
			$status = array('status'=>"error",'message'=>'Invalid patient ID');
    		$result['response'] = $status;
    		return response()->json($result);	
			//return Redirect::to('patientpersonalinformation')->with(array('error'=>'Please save patient personal information'));
		}
    }

    public function getPatientPrescManagementService(){
    	$input = Request::all();
    	$patientId 		= $input['id_patient'];


    	$patientExistCheck = DB::table('patients')->where('id_patient','=',$patientId)->first();

    	if(!empty($patientExistCheck)){
    		$patientPrescriptionData = DB::table('prescription_gynaecology')
    											->where('id_prescription_gynaecology',DB::raw("(select max(`id_prescription_gynaecology`) from prescription_gynaecology where id_patient='$patientId')"))
    											->get();


    										

    		if(!empty($patientPrescriptionData)){
    			$status = array('status'=>"success",'message'=>'Data exists');
    			$result['response'] = $status;
    			


    			foreach($patientPrescriptionData as $index=>$patientPrescriptionDataVal){

    				$patientPrescriptionData =	array(
						      "id_prescription_gynaecology"=> $patientPrescriptionDataVal->id_prescription_gynaecology,
						      "id_patient"=> $patientPrescriptionDataVal->id_patient,
						      "id_doctor"=> $patientPrescriptionDataVal->id_doctor,
						      "line_of_treatment"=> $patientPrescriptionDataVal->line_of_treatment,
						      "line_of_treatment_detail"=>$patientPrescriptionDataVal->line_of_treatment_detail,
						      "presc_general_exercise"=>$patientPrescriptionDataVal->presc_general_exercise,
						      "presc_general_exercise_detail"=> $patientPrescriptionDataVal->presc_general_exercise_detail,
						      "presc_general_diet"=>json_decode($patientPrescriptionDataVal->presc_general_diet),
						      "presc_general_diet_detail"=> $patientPrescriptionDataVal->presc_general_diet_detail,
							  "presc_exercise"=>  $patientPrescriptionDataVal->presc_exercise,
						      "presc_gyn_reference"=>  $patientPrescriptionDataVal->presc_gyn_reference,
						      "created_date"=>  $patientPrescriptionDataVal->created_date,
						      "edited_date"=>  null
					       );
    			}

    			$result['result'] = $patientPrescriptionData;


    			return response()->json($result);	
    		}
    		else{
    			$status = array('status'=>"error",'message'=>'No Data exists');
    			$result['response'] = $status;
    			return response()->json($result);	
    		}
    		

    	}
    	else{
    		$status = array('status'=>"error",'message'=>'Invalid patient ID');
    		$result = $status;
    		return response()->json($result);	
    	}
    }

    public function addPatientPrescMedicineService(){
    	$input = Request::all();

    	$flagArray = array();
    	$multi = array();
		/*$patientId 		= $input['id_patient']; //"KL100";//Session::get('patientId');
    	$doctorId 		= $input['id_doctor']; //"2";//Session::get('doctorId');
    	$referenceId 	= $input['id_reference'];//"C50BX";//Session::get('referenceId');
    	$createdDate 	= $input['created_date'];
    	$flagArray = array();*/
    	

    	foreach($input as $index=>$val){
    		//var_dump($val['drug_name']);

    		$patientId 		= $val['id_patient']; //"KL100";//Session::get('patientId');
	    	$doctorId 		= $val['id_doctor']; //"2";//Session::get('doctorId');
	    	$referenceId 	= $val['presc_ref_id'];//"C50BX";//Session::get('referenceId');
	    	$createdDate 	= $val['created_date'];

    		(isset($val["drug_name"]))?$drugName = $val["drug_name"]:$drugName = "";
			(isset($val["dosage"]))?$dosage   =  $val["dosage"]:$dosage   =  "";
    		(isset($val["dosage_unit"]))?$dosageUnit   =  $val["dosage_unit"]:$dosageUnit   =  "";
    		(isset($val["duration"]))?$duration   =  $val["duration"]:$duration   =  "";
    		(isset($val["duration_unit"]))?$durationUnit   =  $val["duration_unit"]:$durationUnit   =  "";
    		(isset($val["morning"]))?$morning   =  $val["morning"]:$morning   =  "";
    		(isset($val["noon"]))?$noon   =  $val["noon"]:$noon   =  "";
    		(isset($val["night"]))?$night   =  $val["night"]:$night   =  "";
    		(isset($val["start_date"]))?$startDate   =  $val["start_date"]:$startDate   =  "";
    		(!empty($startDate))?$startDate = date('Y-m-d',strtotime($startDate)):$startDate="";
    		(isset($val["instruction"]))?$instruction   =  $val["instruction"]:$instruction   =  "";
    		(isset($val["food_status"]))?$foodStatus   =  $val["food_status"]:$foodStatus   =  "";
    		(isset($val["follow_up_date"]))?$followUpDate   =  $val["follow_up_date"]:$followUpDate   =  "";
    		(!empty($followUpDate))?$followUpDate = date('Y-m-d',strtotime($followUpDate)):$followUpDate="";
    		(isset($val["treatment"]))?$treatment   =  $val["treatment"]:$treatment   =  "";

    		
    		$patientExistCheck = DB::table('patients')->where('id_patient','=',$patientId)->first();
    		if(!empty($patientExistCheck)){
	    		if(	!empty($drugName) && !empty($dosage) && !empty($dosageUnit)  && !empty($duration)  && !empty($durationUnit)){

	    			$insertValue = array(	'drug_name' => $drugName,
	    									'dosage' => $dosage,
	    									'dosage_unit' => $dosageUnit,
	    									'duration' => $duration,
	    									'duration_unit' => $durationUnit,
	    									'morning' => $morning,
	    									'noon' => $noon,
	    									'night' => $night,
	    									'start_date' =>$startDate,
	    									'instruction' => $instruction,
	    									'food_status' => $foodStatus,
	    									'follow_up_date' => $followUpDate,
	    									'treatment' => $treatment,
	    									'id_patient' => $patientId,
	    									'id_doctor' =>$doctorId,
	    									'presc_ref_id' =>$referenceId,
	    									'created_date' => $createdDate
	    									);
	    			array_push($multi,$insertValue);
	    			array_push($flagArray ,1);
	    		}
	    		else{
	    			array_push($flagArray ,0);

	    		}
    		}
    		else{
		    		$status = array('status'=>"Error",'message'=>'Invalid patient ID');
			    	$result = $status;
			    	return response()->json($result);	
		    	}



    	}


    	//var_dump($multi);
    	

    	if(in_array(1,$flagArray)){
    		DB::table('prescription')->insert($multi);
    		$status = array('status'=>"Success",'message'=>'Data saved successfully');
    		$result = $status;
    		return response()->json($result);	
    	}
    	else{
    		$status = array('status'=>"Error",'message'=>'Failed to save data');
    		$result = $status;
    		return response()->json($result);	
    	}

    	/*if(in_array(1,$flagArray)){
				    
		    		$status = array('status'=>"Success",'message'=>'Data saved successfully');
		    		$result = $status;
		    		return response()->json($result);	
		    	}
		    	else{
		    		$status = array('status'=>"Error",'message'=>'Failed to save data');
		    		$result = $status;
		    		return response()->json($result);	
		    }*/

    	//die();



    	/*$count = $input['count'];
    	

    	$patientExistCheck = DB::table('patients')->where('id_patient','=',$patientId)->first();
    		if(!empty($count)){
    			if(!empty($patientExistCheck)){
    		
    				for($i=1;$i<=$count;$i++){
			    		(isset($input["drug_name".$i]))?$drugName = $input["drug_name".$i]:$drugName = "";
			    		(isset($input["dosage".$i]))?$dosage   =  $input["dosage".$i]:$dosage   =  "";
			    		(isset($input["dosage_unit".$i]))?$dosageUnit   =  $input["dosage_unit".$i]:$dosageUnit   =  "";
			    		(isset($input["duration".$i]))?$duration   =  $input["duration".$i]:$duration   =  "";
			    		(isset($input["duration_unit".$i]))?$durationUnit   =  $input["duration_unit".$i]:$durationUnit   =  "";
			    		(isset($input["morning".$i]))?$morning   =  $input["morning".$i]:$morning   =  "";
			    		(isset($input["noon".$i]))?$noon   =  $input["noon".$i]:$noon   =  "";
			    		(isset($input["night".$i]))?$night   =  $input["night".$i]:$night   =  "";
			    		(isset($input["start_date".$i]))?$startDate   =  $input["start_date".$i]:$startDate   =  "";
			    		(!empty($startDate))?$startDate = date('Y-m-d',strtotime($startDate)):$startDate="";
			    		(isset($input["instruction".$i]))?$instruction   =  $input["instruction".$i]:$instruction   =  "";
			    		(isset($input["food_status".$i]))?$foodStatus   =  $input["food_status".$i]:$foodStatus   =  "";
			    		(isset($input["follow_up_date"]))?$followUpDate   =  $input["follow_up_date"]:$followUpDate   =  "";
			    		(!empty($followUpDate))?$followUpDate = date('Y-m-d',strtotime($followUpDate)):$followUpDate="";
			    		(isset($input["treatment".$i]))?$treatment   =  $input["treatment".$i]:$treatment   =  "";



			    		if(	!empty($drugName) && !empty($dosage) && !empty($dosageUnit)  && !empty($duration)  && !empty($durationUnit) &&
			    			!empty($morning)  && !empty($noon)  && !empty($night)  && !empty($foodStatus) ){

			    			$insertValue = array(	'drug_name' => $drugName,
			    									'dosage' => $dosage,
			    									'dosage_unit' => $dosageUnit,
			    									'duration' => $duration,
			    									'duration_unit' => $durationUnit,
			    									'morning' => $morning,
			    									'noon' => $noon,
			    									'night' => $night,
			    									'start_date' =>$startDate,
			    									'instruction' => $instruction,
			    									'food_status' => $foodStatus,
			    									'follow_up_date' => $followUpDate,
			    									'treatment' => $treatment,
			    									'id_patient' => $patientId,
			    									'id_doctor' =>$doctorId,
			    									'presc_ref_id' =>$referenceId,
			    									'created_date' => $createdDate
			    									);
			    			array_push($multi,$insertValue);
			    			array_push($flagArray ,1);
			    		}
			    		else{
			    			array_push($flagArray ,0);

			    		}

			    	}

			    	if(in_array(1,$flagArray)){
			    		$status = array('status'=>"Success",'message'=>'Data saved successfully');
			    		$result = $status;
			    		return response()->json($result);	
			    	}
			    	else{
			    		$status = array('status'=>"Error",'message'=>'Failed to save data');
			    		$result = $status;
			    		return response()->json($result);	
			    	}
		    	}
		    	else{
		    		$status = array('status'=>"Error",'message'=>'Invalid patient ID');
			    	$result = $status;
			    	return response()->json($result);	
		    	}
		    }
    		else{
    			$status = array('status'=>"Error",'message'=>'Count is empty');
			    $result = $status;
			    return response()->json($result);	
    		}
    		*/
    		

    	

    }

    public function getPatientPrescMedicine(){
    	$patientId = Input::get('id_patient');

    	$patientExistCheck = DB::table('patients')->where('id_patient','=',$patientId)->first();

    	if(!empty($patientExistCheck)){
    		$prescMedicineData = DB::table('prescription')
    											->where('created_date',DB::raw("(select max(`created_date`) from prescription where id_patient='$patientId')"))
    											->where('id_patient','=',$patientId)
    											->get();

    			if(!empty($prescMedicineData)){
    				$status = array('status'=>"Success",'message'=>'Data available');
					$result['response'] = $status;
					$result['result'] = $prescMedicineData;
					return response()->json($result);
    			}
    			else{
    				$status = array('status'=>"Error",'message'=>'No Data available');
					$result = $status;
					return response()->json($result);	
    			}

    	}
    	else{
    		$status = array('status'=>"Error",'message'=>'Invalid patient id');
			$result = $status;
			return response()->json($result);	
    	}
    }

    public function getMiscService(){

    	$symptoms = DB::table('symptoms')->get();
    	$diseases = DB::table('diseases')->get();
    	$drugName = DB::table('drug_list')->get();



    	$miscDataArray = array('symptomsData'=>$symptoms,'diseasesData'=>$diseases,'medicineData'=>$drugName);

    	$result = $miscDataArray;
    	return response()->json($result);
    }

	
}
