<?php namespace App\Http\Controllers;
use Input;
use DB;
use Log;
use App\Quotation;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Contracts\Routing\ResponseFactory;
use Session;
use Request;
use View;
use App\classes\DBUtils;
use App\Http\Controllers\Controller;
use App\Http\Manager\SubscriptionManager;


//Models
//Models
use App\Models\PatientsModel;
use App\Models\DoctorsModel;
use App\Models\MedicalHistoryPresentPastModel;
use App\Models\SurgeryHistoryModel;
use App\Models\DrugAllergyHistoryModel;
use App\Models\MedicalHistoryModel;

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
				$userName = $checkLoginCredentials->first_name." ".$checkLoginCredentials->last_name;
				$userId = $checkLoginCredentials->id_user;
				Session::set('user_id',$checkLoginCredentials->id_user);
				Session::set('user_name',$userName);
				Session::set('user_type',$checkLoginCredentials->user_type);

				//$userData = array('userName'=>$$userName,'userId'=>$userId);
				return Redirect::to('userhome')->with(array('userName'=>$userName,'userId'=>$userId));
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
    	$userName = Session::get('user_name');
    	$userId   = Session::get('user_id');



    	return view('userhome',array('userName'=>$userName,'userId'=>$userId));
    }
   

    public function showPatientSearch(){
    	$userName = Session::get('user_name');
    	$userId   = Session::get('user_id');

    	
    	return view('patientsearch',array('userName'=>$userName,'userId'=>$userId));
    	
    }

   

    public function handleSearchPatient(){
    	$input 			= Request::all();
    	$patientId 		= $input['searchby_id'];
    	$patientName 	= $input['searchby_name'];

            
            $data = PatientsModel::where('id_patient', 'like', '%'.$patientId.'%')
            		->where('first_name', 'like', '%'.$patientName.'%')
            		->orderBy('first_name', 'ASC')
            	    ->get();

                       

		    $results = array(
		            "sEcho" => 1,
		        "iTotalRecords" => count($data),
		        "iTotalDisplayRecords" => count($data),
		          "aaData"=>$data);
		

		echo json_encode($results);

		
    	
    	

    }

    public function showDoctorSearch(){
    	$userName = Session::get('user_name');
    	$userId   = Session::get('user_id');

    	
    	return view('doctorsearch',array('userName'=>$userName,'userId'=>$userId));
    	
    }

    public function handleSearchDoctor(){

    	$input 			= Request::all();
    	$doctorId 		= $input['searchby_id'];
    	$doctorName 	= $input['searchby_name'];



           /* $data = DoctorsModel::where('id_doctor', 'like', '%'.$doctorId.'%')
            		->leftJoin('specialization As s','s.id_specialization','=',)
            		->where('first_name', 'like', '%'.$doctorName.'%')
            		->orderBy('first_name', 'ASC')
            	    ->get();

            	    dd($data);*/

           	$data = DB::table('doctors as d')->where('id_doctor', 'like', '%'.$doctorId.'%')
           			->leftJoin('specialization As s','s.id_specialization','=','d.specialization')
            		->where('first_name', 'like', '%'.$doctorName.'%')
            		->orderBy('first_name', 'ASC')
            	    ->get();

              

		    $results = array(
		            "sEcho" => 1,
		        "iTotalRecords" => count($data),
		        "iTotalDisplayRecords" => count($data),
		          "aaData"=>$data);
		

		echo json_encode($results);

		
    	
    	

    }

    public function showDoctorAuthorize(){
    	$userName = Session::get('user_name');
    	$userId   = Session::get('user_id');

    	$doctorAuthorizePending = DB::table('doctors as d')
    											->leftJoin('specialization as s','d.specialization','=','s.id_specialization')
    	                                        ->where('d.status','=',1)
    	                                        ->where('d.registration_status','=',0)
    	                                        ->get();

    	$parametersArray = array('userName'	=>$userName,
    							 'userId'	=>$userId,
    							 'doctorAuthorizePending'=>$doctorAuthorizePending);
	
    	return view('doctorauthorize',$parametersArray);
    }
    public function handleDoctorAuthorize(){
    	$input = Request::all();
    	$doctorId = $input['id_doctor'];


    	$dataArray = array('registration_status'=>1);
    	$doctorUpdate = DoctorsModel::where('id_doctor','=',$doctorId)->update($dataArray);

    	//$doctorUpdate = DB::table('doctors')->where('id_doctor','=',$doctorId)->update($dataArray);
    	if($doctorUpdate){
    		$doctorData = DoctorsModel::where('registration_status','=',0)->where('status','=',1)->get();
    		return json_encode($doctorData);
    	}
    	else{
    		return 0;
    	}
    	
    

    }







    public function showUserJsonImport(){
    	$userName = Session::get('user_name');
    	$userId   = Session::get('user_id');
    	return view('userjsonimport',array('userName'=>$userName,'userId'=>$userId));
    	
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

		$server = DB::table('diagnosis_test')->get();
		foreach($server as $index=>$serverVal){
			var_dump($serverVal->id_patient);
			echo "</br>";
		}

		die();
		/*$server = DB::table('diagnosis')->get();
						
			$server = (array)$server;
			$testArray = array();
			foreach($server as $index=>$serverVal){

				var_dump($serverVal->diag_symptoms);
				$diagData = array('diag_symptoms'=>$serverVal->diag_symptoms,
								  'diag_suspected_diseases'=>$serverVal->diag_suspected_diseases,
								  'diag_syndromes' => $serverVal->diag_syndromes,
								   'id_patient' => $serverVal->id_patient,
									'id_doctor' => $serverVal->id_doctor,
									'diag_comment'=>$serverVal->diag_comment,
									'diag_reference' => $serverVal->diag_reference,
									'created_date' 	    => $serverVal->created_date,
									'edited_date' 		=> $serverVal->edited_date);

						array_push($testArray, $diagData);
			}

			DB::table('diagnosis_test')->insert($testArray);
						die();*/

						

		//dd($json);

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
				
				//die();
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

							//echo $patientId."---";
							

							foreach($pregnancyKind as $index=> $pregnancyKindVal){
								
								//(isset($pregnancyKind[$index]))?$pregnancyKind = $pregnancyKind[$index]: $pregnancyKind = "";
								
								
								//(isset($pregnancyType[$index]))?$pregnancyType= $pregnancyType[$index]: $pregnancyType = "";
								
								
								//(isset($pregnancyTerm[$index]))?$pregnancyTerm = $pregnancyTerm[$index]: $pregnancyTerm = "";
								
								
								//(isset($pregnancyAbortion[$index]))?$pregnancyAbortion = $pregnancyAbortion[$index]: $pregnancyAbortion = "";
								
								//(isset($pregnancyHealth[$index]))?$pregnancyHealth = $pregnancyHealth[$index]: $pregnancyHealth = "";
								

								
								//(isset($pregnancyYear[$index]))?$pregnancyYear = $pregnancyYear[$index]: $pregnancyYear = "";
								
								
									
								
								//(isset($pregnancyWeek[$index]))?$pregnancyWeek = $pregnancyWeek[$index]: $pregnancyWeek = "";
								
								//(isset($pregnancyGender[$index]))?$pregnancyGender = $pregnancyGender[$index]: $pregnancyGender = "";
								
									

								if(empty($pregnancyKind[$index]) && empty($pregnancyType[$index]) && empty($pregnancyTerm[$index]) && empty($pregnancyAbortion[$index]) && empty($pregnancyHealth[$index]) && empty($pregnancyGender[$index]) && empty($pregnancyYear[$index]) && empty($pregnancyWeek[$index]) ){

								}
								else{
									$pregData = array('id_patient' 			=> $patientId,
											      
											      'obs_preg_kind' 		=> $pregnancyKind[$index],
											      'obs_preg_type' 		=> $pregnancyType[$index],
											      'obs_preg_term' 		=> $pregnancyTerm[$index],
											      'obs_preg_abortion' 	=> $pregnancyAbortion[$index],
											      'obs_preg_health' 	=> $pregnancyHealth[$index],
											      'obs_preg_gender' 	=> $pregnancyGender[$index],
											      'obs_preg_years' 		=> $pregnancyYear[$index],
											      'obs_preg_weeks' 		=> $pregnancyWeek[$index],
											      'created_date' 		=> $createdDate[0]." ".$createdTime[0],
											      'edited_date' 		=> $updatedDate[0]
											     );

								//	DB::table('sp_gynaecology_obs_preg')->insert($pregData);

								}
								



								
								
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

							//DB::table('diagnosis_gynaecology_exam')->insert($systemicSaveData);

						}

						// Diagnosis Data
						(isset($jsonData['symptoms']))?$symptoms = $jsonData['symptoms']: $symptoms = "";
						(isset($jsonData['suspected_diseases']))?$diseases = $jsonData['suspected_diseases']: $diseases = "";
						(isset($jsonData['syndromes']))?$syndromes = $jsonData['syndromes']: $syndromes = "";
						(isset($jsonData['additionalComments']))?$comments = $jsonData['additionalComments']: $comments = "";
						//echo $patientId."------->";
						//var_dump($symptoms);
						if(!empty($symptoms)){
							$symptomsExploded = explode(',',$symptoms);
						}
						else{
							$symptomsExploded = [""];
						}

						if(!empty($diseasesExploded)){
							$diseasesExploded = explode(',', $diseases);
						}
						else{
							$diseasesExploded = [""];
						}
						
						$diagData = array('diag_symptoms'=>json_encode($symptomsExploded),
										  'diag_suspected_diseases'=>json_encode($diseasesExploded),
										  'diag_syndromes' => $syndromes,
										  'id_patient' => $patientId,
										  'id_doctor' => '',
										  'created_date' 	    => $createdDate[0]." ".$createdTime[0],
										  'edited_date' 		=> $updatedDate[0]);
						echo $patientId;
						echo "</br>";
						var_dump($comments);
						echo "</br>";
						
						//DB::table('diagnosis_test')->insert($diagData);

						


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

		dd($json);
		
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
				/*(isset($jsonData['socialHistoryStatus']))?$socialHistoryStatus = $jsonData['socialHistoryStatus']: $socialHistoryStatus = "";

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
				
				/*Allergy History*/ //Removes /0026
				(isset($jsonData['Allergy_History']))?$allergyHistory = $jsonData['Allergy_History']: $allergyHistory = ["NA"];
				
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
				}
				
				

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
							DB::table('medical_history_surgical')->insert($surgeryData);
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
														 'created_date' => $createdDate[0],'edited_date'=>$updatedDate[0]);
									if(!empty($medicationExplode[$e])){
										DB::table('medical_history_drug_allergy')->insert($drugAllergyData);
									}
									

								}
							}
							
						}
						
							
						
					    
					}*/


				//Drug allergy history ends
				//---------------------------------------------------------------------------------------------------


				//Present Past Starts
				//-----------------------------------------------------------------------------
				/*(isset($jsonData['majorIllness']))?$majorIllness = $jsonData['majorIllness']: $majorIllness = [""];
				(isset($jsonData['majorIllnessStatus']))?$majorIllnessStatus = $jsonData['majorIllnessStatus']: $majorIllnessStatus = [""];
				echo $patientId;
				echo "</br>";
				
				
				$majorIllness 		= explode(',',$majorIllness[0]);
				$majorIllnessStatus = explode(',',$majorIllnessStatus[0]);

				


				foreach($majorIllnessStatus as $i=>$majorIllnessStatusVal){
					if(isset($majorIllnessStatus[$i])){
						$illnessStatus = explode("&",$majorIllnessStatus[$i]);
						

						if(!isset($illnessStatus[0])){
							$status = "NA";
						}
						else{
							$status = $illnessStatus[0];
							if($status=="Nil" || $status=="N/A"){
								$status = "NA";
							}
							else{
								$status = $status;
							}
						}

						if(!isset($illnessStatus[1])){
							$medication = "";
						}
						else{
							$medication = $illnessStatus[1];
							if($medication=="Nil" | $medication=="N/A"){
								$medication = "";
							}
							else{
								$medication = $medication;
							}
						}

						
						
					
					}
					echo "illness name-->".$majorIllness[$i]."|"." ";
					echo "Status----->".$status."|"." ";
					echo "Medication---->".$medication."|"." ";
					echo "</br>";

					$presentPastData = array('id_patient' => $patientId,
											 'illness_name'=>$majorIllness[$i],
											 'illness_status'=>$status,
											 'medication'=>$medication,
											 'created_date' => $createdDate[0],
											 'edited_date'=>$updatedDate[0]);

					DB::table('medical_history_present_past_more')->insert($presentPastData);

				}
*/
				//Present Past ends
				//---------------------------------------------------------------------------------------

				//patient personal information starts
				//--------------------------------------------------------------------------------------

				/*(isset($jsonData['firstName']))?$firstName = $jsonData['firstName']: $firstName = "";
				(isset($jsonData['lastName']))?$lastName = $jsonData['lastName']: $lastName = "";
				(isset($jsonData['middleName']))?$middleName = $jsonData['middleName']: $middleName = "";
				(isset($jsonData['aadharnumber']))?$aadhar = $jsonData['aadharnumber']: $aadhar = "";
				(isset($jsonData['sex']))?$gender = $jsonData['sex']: $gender = "";
				(isset($jsonData['dob']))?$dob = $jsonData['dob']: $dob = "";
				(isset($jsonData['maritalStatus']))?$maritalStatus = $jsonData['maritalStatus']: $maritalStatus = "";
				(isset($jsonData['streetName']))?$streetName = $jsonData['streetName']: $streetName = "";
				(isset($jsonData['cityName']))?$cityName = $jsonData['cityName']: $cityName = "";
				(isset($jsonData['state']))?$state = $jsonData['state']: $state = "";
				(isset($jsonData['pinCode']))?$pinCode = $jsonData['pinCode']: $pinCode = "";
				(isset($jsonData['country']))?$country = $jsonData['country']: $country = "";
				(isset($jsonData['phoneNumber']))?$phoneNumber = $jsonData['phoneNumber']: $phoneNumber = "";
				(isset($jsonData['email']))?$email = $jsonData['email']: $email = "";


				$splitYear = explode('-',$dob);

				if(empty($splitYear[1])){
					$year = $splitYear[0];
				}
				else{
					$year = $splitYear[2];
				}

				$currentYear =  date("Y");
				$age = $currentYear - $year;
				

				($country=="India")?$countryCode = "101" : $countryCode = "";

				if($firstName=="Mr" || $firstName=="Mrs" || $firstName=="Ms" || $firstName=="Mrs." || $firstName=="mrs" || $firstName=="mrs." || $firstName=="Miss" || $firstName=="miss" || $firstName=="Dr" ){
					if(!empty($middleName)){
						$firstName = $middleName;
					}
					else{
						$firstName = $lastName;
						$lastName = "";
					}
					
				}
				
				echo $firstName;
				echo "</br>";

				$patientIdExist = DB::table('patients')->where('id_patient','=',$patientId)->first();

				if(empty($patientIdExist)){
					//echo "V";
					$patientData = array('first_name'=>$firstName,
									'middle_name'=> $middleName,
									'last_name'=> $lastName,
									'id_aadhar' =>	$aadhar,
									'gender' => $gender,
									'dob' => $year,
									'age' => $age,
									'maritial_status' => $maritalStatus,
									'street' => $streetName,
									'city' => $cityName,
									'state' => $state,
									'pincode' => $pinCode,
									'country' => $countryCode,
									'phone' => $phoneNumber,
									'email' => $email,
									'id_patient'=>$patientId,
									'created_date' => $createdDate[0],
									'edited_date'=>$updatedDate[0]);

					DB::table('patients')->insert($patientData);
				}
*/
				

				//patient personal information ends
				//--------------------------------------------------------------------------------------
			}


			

		}

    }


    public function handleUserDataMigration(){
    	//var_dump($_FILES['diagnosis_json']);
    	
    	
    	$file_tmp =$_FILES['doctors_json']['tmp_name'];
		$file_name = $_FILES['doctors_json']['name'];
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

		dd($json);

		foreach($json as $index=> $val){

			
			$newVal = (object) $val;

			foreach($newVal as $index=> $input){
			
				$firstName 				= $input['firstName'];
				$lastName 				= $input['lastName'];
				$accredition 			= $input['accredition'];
				$city 					= $input['city'];
				$country 				= $input['country'];
				$imaRegisterNo 			= $input['docRegistrationNumber'];
				$email 					= $input['email'];
				$password 				= $input['password'];
				$phone 					= $input['phone'];
				$pincode 				= $input['pincode'];
				$qualification 			= $input['qualification'];
				$specialization 		= $input['specialization'];
				$state 					= $input['state'];
				$street  				= $input['street'];
				$superSpecialization 	= $input['superSpecialization'];

				$createdDate 	= $input['createdAt'];
				$updatedDate 	= $input['updatedAt'];



				$createdDate = preg_split( '/(T| Z)/', $createdDate);
				$createdTime = explode(".",$createdDate[1]);

						

				if(!empty($updatedDate)){
					$updatedDate = preg_split( '/(T| Z)/', $updatedDate);
				}
				else{
					$updatedDate = "";
				}

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
				

				$regsiterValues = array('first_name' 				=> $firstName,
										'last_name' 				=> $lastName,
										'accredition' 				=> $accredition,
										'city' 						=> $city,
										'country' 					=> $country,
										'doctor_registration_no' 	=> $imaRegisterNo,
										'email' 					=> $email,
										'password' 					=> $encrypted,
										'phone' 					=> $phone,
										'pincode' 					=> $pincode,
										'street' 					=> $street,
										'state' 					=> $state,
										'qualification' 			=> json_encode($qualification),
										'specialization' 			=> $specialization,
										'super_specialization' 		=> $superSpecialization,
										'registration_status'		=>1,
										'created_date' 				=> $createdDate[0],
										'edited_date'				=>$updatedDate[0]);
				

			 	DB::table('doctors')->insert($regsiterValues);

				
			}
		}

		
	}

	public function showOldPatientsList(){
		$userName = Session::get('user_name');
    	$userId   = Session::get('user_id');

    	$oldPatientsData = MedicalHistoryModel::where('id_doctor','=','')->get();


    	//var_dump($oldPatientsData);


    	//return View::make('oldpatientslist')->with(array('userName'=>$userName,'userId'=>$userId));
    	return view('oldpatientslist',array('userName'=>$userName,'userId'=>$userId,'oldPatientsData'=>$oldPatientsData));
	}
}