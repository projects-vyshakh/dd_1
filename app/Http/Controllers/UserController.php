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
use App\Http\Controllers\Controller;
use App\Http\Manager\SubscriptionManager;


class UserController extends Controller {

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
	}*/

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
/*
	 public function __construct()
    {
        $this->middleware('auth');
    }*/
    public function showUserLogin(){
    	return view('dduserlogin');

    }
    public function handleUserLogin(){
     	$email 		= Input::get('email');
		$password 	= Input::get('password');


		$checkLoginCredentials = DB::table('users')->where('email','=',$email)->where('status','=','1')->first();
		if(!empty($checkLoginCredentials))
		{
			$passwordEncrypted = $checkLoginCredentials->password;
			//$passwordEncrypted = "ns8nqYKWONCYH2B4qU60HP9ntcSzYCeiCvV1b++32CQ=";
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
				Session::put('userId',$checkLoginCredentials->id_user);
				Session::put('userType',$checkLoginCredentials->user_type);
				return Redirect::to('userhome');
			}
			else{
				return Redirect::to('dduserlogin')->with(array('error'=>"Login failed!!! Please check the credentials"));
			}
		}
		else{

			!empty($status)?$checkLoginCredentials->status:$status=1;
			if($status==0){
				//echo "enter into else 0";
				return Redirect::to('dduserlogin')->with(array('error'=>"Your account is not verified. Please contact administrator"));
			}
			else{
				//echo "enter into 0 else ";
				return Redirect::to('dduserlogin')->with(array('error'=>$email." "."is Denied or Not Exist"));
			}

			
		}	
	
    }
    public function showUserHome(){
    	return view('userhome');
    }
    /*public function showUserImport(){
    	return view('userjsonimport');
    }*/
    public function showUserJsonImport(){
    	return view('userjsonimport');
    }

    public function showDiagnosisDataMigration(){
    	//var_dump($_FILES['diagnosis_json']);
    	
    	
    	$file_tmp =$_FILES['diagnosis_json']['tmp_name'];
		$file_name = $_FILES['diagnosis_json']['name'];
		$fileExist = 'assets/jsonfiles/'.$file_name;

		if (file_exists($fileExist)) {
		   move_uploaded_file($file_tmp,"assets/jsonfiles/".$file_name);
		   chmod('assets/jsonfiles/'.$file_name, 0777);
		} 
		else {
		    //mkdir("assets/jsonfiles", 0777);
		    chmod('assets/jsonfiles/', 0777);
		    move_uploaded_file($file_tmp,"assets/jsonfiles/".$file_name);
		   	chmod('assets/jsonfiles/'.$file_name, 0777);

		}

		$str = file_get_contents('assets/jsonfiles/'.$file_name);
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

				//var_dump($jsonData);
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

						//OBS Details
						(isset($jsonData['Abortion']))?$abortion = $jsonData['Abortion']: $abortion = "";
						(isset($jsonData['Gravida']))?$gravida = $jsonData['Gravida']: $gravida = "";
						(isset($jsonData['Husband_Blood_Group']))?$husBloodGroup = $jsonData['Husband_Blood_Group']: $husBloodGroup = "";
						(isset($jsonData['Living']))?$living = $jsonData['Living']: $living = "";
						(isset($jsonData['Married_Life']))?$marriedLife = $jsonData['Married_Life']: $marriedLife = "";
						(isset($jsonData['Para']))?$para = $jsonData['Para']: $para = "";
						
						(isset($jsonData['Lmp_date']))?$lmpDate = $jsonData['Lmp_date']: $lmpDate = "";
						(isset($jsonData['Lmp_dysmenorrhea']))?$lmpDysmenorrhea = $jsonData['Lmp_dysmenorrhea']: $lmpDysmenorrhea = "";
						(isset($jsonData['Lmp_flow']))?$lmpFlow = $jsonData['Lmp_flow']: $lmpFlow = "";
						(isset($jsonData['Menstrual_Cycle']))?$cycle = $jsonData['Menstrual_Cycle']: $cycle = "";
						(isset($jsonData['Menstrual_Days']))?$days = $jsonData['Menstrual_Days']: $days = "";
						(isset($jsonData['Menstrual_Regular_Irregular']))?$menstrualType = $jsonData['Menstrual_Regular_Irregular']: $menstrualType = "";
						//echo $abortion."--".$gravida."--".$husBloodGroup."--".$living."--".$marriedLife."--".$para."--";
						//echo  json_encode($lmpDate);
						$lmpDate = (object) $lmpDate;
						foreach($lmpDate as $index=>$lmpDateVal){
							if(!empty($lmpDateVal)){

								$lmpDateVal = date('Y-m-d',strtotime($lmpDateVal));
							}
							else{
								$lmpDateVal = "";
							}
						}
						$lmpDysmenorrhea = (object) $lmpDysmenorrhea;
						foreach($lmpDysmenorrhea as $index=>$lmpDysmenorrheaVal){
							
						}
						$lmpFlow = (object) $lmpFlow;
						foreach($lmpFlow as $index=>$lmpFlowVal){
							
						}
						
						$cycle = (object) $cycle;
						foreach($cycle as $index=>$cycleVal){
							
						}
						$days = (object) $days;
						foreach($days as $index=>$daysVal){
							
						}
						$menstrualType = (object) $menstrualType;
						foreach($menstrualType as $index=>$menstrualTypeVal){
							
						}
						
						//echo $menstrualTypeVal.">>".$daysVal.">>".$cycleVal.">>".$lmpFlowVal.$lmpDateVal;

						$obsData = array('id_patient'=>$patientId,
										 'married_life'=>$marriedLife,
										 'husband_blood_group'=>$husBloodGroup,
										 'gravida'=>$gravida,
										 'para'=>$para,
										 'living'=>$living,
										 'abortion'=>$abortion,
										 'obs_lmp_date'=>$lmpDateVal,
										 'obs_lmp_flow' => $lmpFlowVal,
										 'obs_lmp_dysmenorrhea'=>$lmpDysmenorrheaVal,
										 'obs_lmp_days'=>$daysVal,
										 'obs_lmp_cycle'=>$cycleVal,
										 'obs_menstrual_type'=>$menstrualTypeVal,
										  'created_date' 		=> $createdDate[0]." ".$createdTime[0],
										  'edited_date' 		=> $updatedDate[0]);

						//DB::table('sp_gynaecology_obs')->insert($obsData);

						/*Vitals Data*/
						(isset($jsonData['weight']))?$weight = $jsonData['weight']: $weight = "";
						(isset($jsonData['height']))?$height = $jsonData['height']: $height = "";
						(isset($jsonData['bmi']))?$bmi = $jsonData['bmi']: $bmi = "";
						(isset($jsonData['pulse']))?$pulse = $jsonData['pulse']: $pulse = "";
						(isset($jsonData['respiratoryrate']))?$respiratoryRate = $jsonData['respiratoryrate']: $respiratoryRate = "";
						(isset($jsonData['temperature']))?$temperature = $jsonData['temperature']: $temperature = "";
						(isset($jsonData['spo2']))?$spo2 = $jsonData['spo2']: $spo2 = "";
						(isset($jsonData['bloodgroup']))?$bloodGroup = $jsonData['bloodgroup']: $bloodGroup = "";
						(isset($jsonData['bloodpressure']))?$bloodPressure = $jsonData['bloodpressure']: $bloodPressure = "";

						if(!empty($bloodPressure)){
							$bloodPressure = explode('/',$bloodPressure);
							$systolic = $bloodPressure[0];
							$diastolic = $bloodPressure[1];
						}
						else{
							$systolic = "";
							$diastolic = "";
						}
						
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

						//DB::table('vitals')->insert($vitalsData);


						/*Diagnosis Examination*/


						(isset($jsonData['externalgenetalia']))?$externalGenetalia = $jsonData['externalgenetalia']: $externalGenetalia = "";

						(isset($jsonData['breast_galactorrhea']))?$sysBreastGalactorrhea = $jsonData['breast_galactorrhea']: $sysBreastGalactorrhea = "";

						(isset($jsonData['breast_lump']))?$sysBreastLump = $jsonData['breast_lump']: $sysBreastLump = "";

						(isset($jsonData['breast_other']))?$sysBreastOther = $jsonData['breast_other']: $sysBreastOther = "";
						(isset($jsonData['cervix_bleeding']))?$sysPelvicCervixBleeding = $jsonData['cervix_bleeding']: $sysPelvicCervixBleeding = "";

						(isset($jsonData['cervix_healthy']))?$sysPelvicCervixHealthy = $jsonData['cervix_healthy']: $sysPelvicCervixHealthy = "";

						(isset($jsonData['cervix_lbc']))?$sysPelvicCervixLbc = $jsonData['cervix_lbc']: $sysPelvicCervixLbc = "";

						(isset($jsonData['preabdomenexamination']))?$preAbdomenExam = $jsonData['preabdomenexamination']: $preAbdomenExam = "";

						(isset($jsonData['secondarysex_acne']))?$sysSecondarySexAcne = $jsonData['secondarysex_acne']: $sysSecondarySexAcne = "";

						(isset($jsonData['secondarysex_hair']))?$sysSecondarySexHair = $jsonData['secondarysex_hair']: $sysSecondarySexHair = "";

						(isset($jsonData['secondarysex_other']))?$sysSecondarySexOther = $jsonData['secondarysex_other']: $sysSecondarySexOther = "";

						(isset($jsonData['secondarysex_welldeveloped']))?$sysSecondarySexWellDeveloped = $jsonData['secondarysex_welldeveloped']: $sysSecondarySexWellDeveloped = "";

						(isset($jsonData['uterus_avaf']))?$sysPelvicAvaf = $jsonData['uterus_avaf']: $sysPelvicAvaf = "";

						(isset($jsonData['uterus_others']))?$sysPelvicOther = $jsonData['uterus_others']: $sysPelvicOther = "";

						(isset($jsonData['uterus_rvrf']))?$sysPelvicRvrf = $jsonData['uterus_rvrf']: $sysPelvicRvrf = "";

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
	    								
	    								'created_date' 	    => $createdDate[0]." ".$createdTime[0],
										'edited_date' 		=> $updatedDate[0]);

							DB::table('diagnosis_gynaecology_exam')->insert($systemicSaveData);

						}

				}
				else{
					echo "</br>";
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


					//print_r($originalCreatedDate);
					//echo "<br>";

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
					//DB::table('prescription_gynaecology')->insert($prescGynData);

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

    public function showPatientsDataMigration(){
    	$file_tmp =$_FILES['patients_json']['tmp_name'];
		$file_name = $_FILES['patients_json']['name'];
		$fileExist = 'assets/jsonfiles/'.$file_name;

		if (file_exists($fileExist)) {
		   move_uploaded_file($file_tmp,"assets/jsonfiles/".$file_name);
		   chmod('assets/jsonfiles/'.$file_name, 0777);
		} 
		else {
		    //mkdir("assets/jsonfiles", 0777);
		    chmod('assets/jsonfiles/', 0777);
		    move_uploaded_file($file_tmp,"assets/jsonfiles/".$file_name);
		   	chmod('assets/jsonfiles/'.$file_name, 0777);

		}

		$str = file_get_contents('assets/jsonfiles/'.$file_name);
		$json = json_decode($str, true);

		
		foreach($json as $index=> $val){

			//var_dump($val);
			$newVal = (object) $val;

			foreach($newVal as $index=> $jsonData){
				//var_dump($jsonData);
				(isset($jsonData['patientID']))?$patientId = $jsonData['patientID']: $patientId = "";
				(isset($jsonData['typeFlag']))?$typeFlag = $jsonData['typeFlag']: $typeFlag = "";
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
				
					

				$dataExists = DB::table('medical_history')->where('id_patient','=',$patientId)->get();


				/*Family History*/

				/*(isset($jsonData['majorIllnessFamilyStatus']))?$illnessFamily = $jsonData['majorIllnessFamilyStatus']: $illnessFamily = [""];
				(isset($jsonData['menarche_number']))?$menarche = $jsonData['menarche_number']: $menarche = "";
				(isset($jsonData['menopause_number']))?$menopause = $jsonData['menopause_number']: $menopause = "";

			
				
					$menarche = (object) $menarche;

					foreach($menarche as $menarcheVal){
						
					}
					$menopause = (object) $menopause;
					foreach($menopause as $menopauseVal){
						
					}
					
				
				$illnessFamily = implode(';', $illnessFamily);
				$illnessFamily = explode(';', $illnessFamily);
				
				

				$illnessFamilyArray = array();
				for($f=0;$f<sizeof($illnessFamily);$f++){
					
					
					
					array_push($illnessFamilyArray ,$illnessFamily[$f]);

				}

				(isset($illnessFamilyArray[0]))?$illnessFamily0 = $illnessFamilyArray[0]: $illnessFamily0 = "";
				(isset($illnessFamilyArray[1]))?$illnessFamily1 = $illnessFamilyArray[1]: $illnessFamily1 = "";
				(isset($illnessFamilyArray[2]))?$illnessFamily2 = $illnessFamilyArray[2]: $illnessFamily2 = "";
				(isset($illnessFamilyArray[3]))?$illnessFamily3 = $illnessFamilyArray[3]: $illnessFamily3 = "";
				(isset($illnessFamilyArray[4]))?$illnessFamily4 = $illnessFamilyArray[4]: $illnessFamily4 = "";
				
				
					
					
					$illnessFamily0 = explode(',',$illnessFamily0);
					$illnessFamily1 = explode(',',$illnessFamily1);
					$illnessFamily2 = explode(',',$illnessFamily2);
					$illnessFamily3 = explode(',',$illnessFamily3);
					$illnessFamily4 = explode(',',$illnessFamily4);

					
					$ilnessFamilyArray0 = array();
					for($i0=0;$i0<sizeof($illnessFamily0);$i0++){
						array_push($ilnessFamilyArray0 ,$illnessFamily0[$i0]);
					}

					$ilnessFamilyArray1 = array();
					for($i1=0;$i1<sizeof($illnessFamily1);$i1++){
						array_push($ilnessFamilyArray1 ,$illnessFamily1[$i1]);
					}
					
					$ilnessFamilyArray2 = array();
					for($i2=0;$i2<sizeof($illnessFamily2);$i2++){
						array_push($ilnessFamilyArray2 ,$illnessFamily2[$i2]);
					}

					$ilnessFamilyArray3 = array();
					for($i3=0;$i3<sizeof($illnessFamily3);$i3++){
						array_push($ilnessFamilyArray3 ,$illnessFamily3[$i3]);
					}

					$ilnessFamilyArray4 = array();
					for($i4=0;$i4<sizeof($illnessFamily4);$i4++){
						array_push($ilnessFamilyArray4 ,$illnessFamily4[$i4]);
					}


					if(!empty($dataExists)){
						$illnessFamilyStatusData = array(
												 'menstrual_menarche'=>$menarcheVal,
												 'menstrual_menopause'=>$menopauseVal,
												 'history_family_father'=>json_encode($ilnessFamilyArray0),
												 'history_family_mother'=>json_encode($ilnessFamilyArray1),
												 'history_family_sibling'=>json_encode($ilnessFamilyArray2),
												 'history_family_grandfather'=>json_encode($ilnessFamilyArray3),
												 'history_family_grandmother'=>json_encode($ilnessFamilyArray4),
												 'created_date' => $createdDate[0],
							   					 'edited_date'=>$updatedDate[0]

												 );
						DB::table('medical_history')->where('id_patient','=',$patientId)->update($illnessFamilyStatusData);
					}
					else{
						$illnessFamilyStatusData = array(
												 'id_patient'=>$patientId,
												 'menstrual_menarche'=>$menarcheVal,
												 'menstrual_menopause'=>$menopauseVal,
												 'history_family_father'=>json_encode($ilnessFamilyArray0),
												 'history_family_mother'=>json_encode($ilnessFamilyArray1),
												 'history_family_sibling'=>json_encode($ilnessFamilyArray2),
												 'history_family_grandfather'=>json_encode($ilnessFamilyArray3),
												 'history_family_grandmother'=>json_encode($ilnessFamilyArray4),
												 'created_date' => $createdDate[0],
							   					 'edited_date'=>$updatedDate[0]

												 );
						DB::table('medical_history')->insert($illnessFamilyStatusData);
					}*/



				

				

				/*Family History ends*/	
				/*---------------------------------------------------------------------------------------------------*/

				/*Social History*/
			/*	(isset($jsonData['socialHistoryStatus']))?$socialHistoryStatus = $jsonData['socialHistoryStatus']: $socialHistoryStatus = "";

				if(!empty($socialHistoryStatus)){
					$socialHistoryStatus = implode(',', $socialHistoryStatus);
					$socialHistoryStatus = explode(',', $socialHistoryStatus);
					

					if(!empty($dataExists)){
						$socialHistoryData = array( 
											   'history_social_alcohol'=>$socialHistoryStatus[0],
											   'history_social_tobacco_smoke'=>$socialHistoryStatus[1],
											   'history_social_tobacco_chew'=>$socialHistoryStatus[2],
											   'history_social_other'=>$socialHistoryStatus[3],
											   'created_date' => $createdDate[0],
							   					'edited_date'=>$updatedDate[0]
											);
						DB::table('medical_history')->where('id_patient','=',$patientId)->update($socialHistoryData);
					}
					else{
						$socialHistoryData = array( 'id_patient'=>$patientId,
												   'history_social_alcohol'=>$socialHistoryStatus[0],
												   'history_social_tobacco_smoke'=>$socialHistoryStatus[1],
												   'history_social_tobacco_chew'=>$socialHistoryStatus[2],
												   'history_social_other'=>$socialHistoryStatus[3],
												   'created_date' => $createdDate[0],
								   					'edited_date'=>$updatedDate[0]
												);
						DB::table('medical_history')->insert($socialHistoryData);
					}
				}*/

				/*Social History ends*/
				//-------------------------------------------------------------------------------------------------
				
				/*Allergy History*/
				/*(isset($jsonData['Allergy_History']))?$allergyHistory = $jsonData['Allergy_History']: $allergyHistory = ["NA"];
				
				$allergyHistory = implode(',', $allergyHistory);
				$allergyHistory = explode(',', $allergyHistory);

				
				
				$allergyArray = array();
				for($a=0;$a<sizeof($allergyHistory);$a++){
					
					
					
					array_push($allergyArray ,$allergyHistory[$a]);

				}

				
				

				if(!empty($dataExists)){
					$allergyHistoryData = array('history_allergy_general'=>json_encode($allergyHistory),
											
											'created_date' => $createdDate[0],
								   			'edited_date'=>$updatedDate[0]);
					DB::table('medical_history')->where('id_patient','=',$patientId)->update($allergyHistoryData);
				}
				else{
					$allergyHistoryData = array('history_allergy_general'=>json_encode($allergyHistory),
											'id_patient'=>$patientId,
											'created_date' => $createdDate[0],
								   			'edited_date'=>$updatedDate[0]);
					DB::table('medical_history')->insert($allergyHistoryData);
				}*/
				
				

				//Allergy history ends
				//-------------------------------------------------------------------------------------------------------
			


				//Surgical History
				//----------------------------------------------------------------------------------------------------
				/*(isset($jsonData['Surgeries']))?$surgeryHistory = $jsonData['Surgeries']: $surgeryHistory = ["NA"];

				

				for($s=0;$s<sizeof($surgeryHistory);$s++){
					$surgeryHistory = implode(',',$surgeryHistory);
					$surgeryHistory = explode(',',$surgeryHistory);
				
					foreach($surgeryHistory as $index=>$surgeryHistoryVal){
						if(!empty($surgeryHistoryVal)){
							$surgeryData = array('surgery_name'=>$surgeryHistoryVal,'id_patient'=>$patientId,'created_date' => $createdDate[0],'edited_date'=>$updatedDate[0]);
							//DB::table('medical_history_surgical')->insert($surgeryData);
						}
						
					}
					
				}*/
				//Surgical History Ends
				//---------------------------------------------------------------------------------------------------


				//Drug allergy history
				//---------------------------------------------------------------------------------------------------
					/*(isset($jsonData['allergiesMedication']))?$allergiesMedication = $jsonData['allergiesMedication']: $allergiesMedication = ["NA"];
					(isset($jsonData['allergiesReaction']))?$allergiesReaction = $jsonData['allergiesReaction']: $allergiesReaction = ["NA"];


					foreach ($allergiesMedication as $index => $allergiesMedicationVal)
					{

						if(isset($allergiesMedication[$index])){
							$medicationExplode = explode(',',$allergiesMedication[$index]);
						}
						else{
							$medicationExplode = "";
						}

						if(isset($allergiesReaction[$index])){
							$reactionExplode = explode(',',$allergiesReaction[$index]);
						}
						else{
							$reactionExplode = "";
						}

						

						

						for($e=0;$e<sizeof($medicationExplode);$e++){
							if(isset($medicationExplode[$e])){
								echo "</br>";echo "</br>";
								if(isset($reactionExplode[$e])){
									echo "Medication::".$medicationExplode[$e]."|"."Reaction::".$reactionExplode[$e];
									echo "</br>";
									$drugAllergyData = array('drug_name'=>$medicationExplode[$e],
														 'reaction'=>$reactionExplode[$e],
														 'id_patient'=>$patientId,
														 ,'created_date' => $createdDate[0],'edited_date'=>$updatedDate[0]);
									if(!empty($medicationExplode[$e])){
										DB::table('medical_history_drug_allergy')->insert($drugAllergyData);
									}
									

								}
							}
							
						}
						
							
						
					    
					}*/


				//Drug allergy history ends
				//---------------------------------------------------------------------------------------------------









			}


			

		}

    }
}