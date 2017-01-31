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
use Illuminate\Database\Eloquent\ModelNotFoundException;

//Models
use App\Models\PatientsModel;
use App\Models\DoctorsModel;
use App\Models\MedicalHistoryModel;
use App\Models\MedicalHistoryPresentPastModel;
use App\Models\SurgeryHistoryModel;
use App\Models\DrugAllergyHistoryModel;
use App\Models\PrescriptionModel;

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
	public function showDoctorHome(){


		Session::forget('patientId');
		Session::forget('referenceId');
		Session::forget('patientName');

		$doctorId = Session::get('doctorId');


		

		$doctorData = DoctorsModel::where('id_doctor','=',$doctorId)->first();
		

		if(!empty($doctorData)){
			return view('doctorhome',array('doctorData'=>$doctorData));
		}
		else{
			echo "sds";
		}
		
		//echo 'Doctor ome'; 
		
	}
	public function flushAllSessions(){
		Session::flush();
		return 1;
	}
	public function showpatientInformation(){
		return view('patientinformation');
	}
	
	public function showPatientPersonalInformation(){

		$patientId = Session::get('patientId');
		$doctorId = Session::get('doctorId');


		if(empty($doctorId)){
			//header('location:doctorlogin');
			return Redirect::to('logout');
		}
		else{
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

				return view('patientpersonalinformation',array('gender' => $gender,'maritialStatus'=>$maritialStatus,'country' => $country,  'city' => $city,'patientId'=>$patientId, 'patientData'=>$patientData,'doctorData'=>$doctorData,'doctorsList'=>$doctorsList));
			}
			else{
				return Redirect::to('doctorhome')->with(array('error'=>'You are not authorised to view the page'));
			}
			
		}
		
		
	}
	public function showPatientObstetricsHistory(){
		$patientId = Session::get('patientId');
		$doctorId  = Session::get('doctorId');


		if(empty($doctorId)){
			//header('location:doctorlogin');
			return Redirect::to('logout');
		}
		else{
			if(!empty($patientId)){
				$lmpFlow = DB::table('business_key_details')->where('business_key', '=', 'OBS_LMP_FLOW')->lists('business_value', 'business_value');
				$lmpDysmenohrrea = DB::table('business_key_details')->where('business_key', '=', 'OBS_LMP_DYSMENORRHEA')->lists('business_value', 'business_value');
				$lmpMensusType = DB::table('business_key_details')->where('business_key', '=', 'OBS_LMP_MENSUS_TYPE')->lists('business_value', 'business_value');
				$pregKind = DB::table('business_key_details')->where('business_key', '=', 'OBS_PREG_KIND')->lists('business_value', 'business_value');
				$pregType = DB::table('business_key_details')->where('business_key', '=', 'OBS_PREG_TYPE')->lists('business_value', 'business_value');
				$gender = DB::table('business_key_details')->where('business_key', '=', 'GENDER')->lists('business_value', 'business_value');
				$pregTerm = DB::table('business_key_details')->where('business_key', '=', 'OBS_PREG_TERM')->lists('business_value', 'business_value');
				$pregChildHealth = DB::table('business_key_details')->where('business_key', '=', 'OBS_PREG_HEALTH')->lists('business_value', 'business_value');
				$bloodGroup = DB::table('business_key_details')->where('business_key', '=', 'BLOOD_GROUP')->lists('business_value', 'business_value');


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
				if(!in_array('', $bloodGroup)){
				     	 array_unshift($bloodGroup, '');
				}


				
		        $patientPersonalData 	= DB::table('patients')->where('id_patient','=',$patientId)->first();

		        $doctorData 	= DB::table('doctors')->where('id_doctor','=',$doctorId)->first();

		    
		        
		        $patientGynObsData	 	= DB::table('sp_gynaecology_obs')
		        										->where('id_patient','=',$patientId)
		        										->where('id_gyn', DB::raw("(select max(`id_gyn`) from sp_gynaecology_obs where 		id_patient='$patientId')"))
		        										->where('id_gyn',DB::raw("(select max(`id_gyn`) from sp_gynaecology_obs where id_patient='$patientId')"))
		        										->first();
		        
		        $patientGynObsPregData  = DB::table('sp_gynaecology_obs_preg')
		        											->where('id_patient','=',$patientId)
		        											->where('created_date', DB::raw("(select max(`created_date`) from sp_gynaecology_obs_preg where id_patient='$patientId')"))
		        											->where('id_gyn_preg',DB::raw("(select max(`id_gyn_preg`) from sp_gynaecology_obs_preg where id_patient='$patientId')"))
		        											->get();
				


		        $pregnancyCount = DB::table('sp_gynaecology_obs_preg')->where('id_patient','=',$patientId)->count();



				return view('patientobstetricshistory',
					   array('lmpFlow' 					=> $lmpFlow,
					   	     'lmpDysmenohrrea'			=>$lmpDysmenohrrea, 
					   	     'lmpMensusType' 			=> $lmpMensusType, 
					   	     'pregKind' 				=> $pregKind, 
					   	     'pregType' 				=> $pregType,
					   	     'gender' 					=> $gender, 
					   	     'pregTerm' 				=>$pregTerm, 
					   	     'pregChildHealth' 			=> $pregChildHealth,
					   	     'patientPersonalData' 		=>$patientPersonalData, 
					   	     'patientGynObsData' 		=>$patientGynObsData,  
					   	     'patientGynObsPregData' 	=>$patientGynObsPregData,
					   	     'bloodGroup' 				=> $bloodGroup,
					   	     'doctorData'				=>$doctorData,
					   	     'pregnancyCount'			=>$pregnancyCount));
			}
			else{
				return Redirect::to('doctorhome')->with(array('error'=>'You are not authorised to view the page'));
			}
		
		}
			

		
	}

	public function patientObstetricsDataAjax(){
		
		$lmpFlow = DB::table('business_key_details')->where('business_key', '=', 'OBS_LMP_FLOW')->lists('business_value', 'business_value');
		$lmpDysmenohrrea = DB::table('business_key_details')->where('business_key', '=', 'OBS_LMP_DYSMENORRHEA')->lists('business_value', 'business_value');
		$lmpMensusType = DB::table('business_key_details')->where('business_key', '=', 'OBS_LMP_MENSUS_TYPE')->lists('business_value', 'business_value');
		$pregKind = DB::table('business_key_details')->where('business_key', '=', 'OBS_PREG_KIND')->lists('business_value', 'business_value');
		$pregType = DB::table('business_key_details')->where('business_key', '=', 'OBS_PREG_TYPE')->lists('business_value', 'business_value');
		$gender = DB::table('business_key_details')->where('business_key', '=', 'GENDER')->lists('business_value', 'business_value');
		$pregTerm = DB::table('business_key_details')->where('business_key', '=', 'OBS_PREG_TERM')->lists('business_value', 'business_value');
		$pregChildHealth = DB::table('business_key_details')->where('business_key', '=', 'OBS_PREG_HEALTH')->lists('business_value', 'business_value');
		$bloodGroup = DB::table('business_key_details')->where('business_key', '=', 'BLOOD_GROUP')->lists('business_value', 'business_value');


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
		if(!in_array('', $bloodGroup)){
		     	 array_unshift($bloodGroup, '');
		}


		$patientId = Session::get('patientId'); 
        $doctorId  = Session::get('doctorId');  //echo "DoctorId".$doctorId;

        $patientPersonalData 	= DB::table('patients')->where('id_patient','=',$patientId)->first();

        $doctorPersonalData 	= DB::table('doctors')->where('id_doctor','=',$doctorId)->first();

    
        
        $patientGynObsData	 	= DB::table('sp_gynaecology_obs')
        										->where('id_patient','=',$patientId)
        										->where('id_gyn', DB::raw("(select max(`id_gyn`) from sp_gynaecology_obs where 		id_patient='$patientId')"))
        										->where('id_gyn',DB::raw("(select max(`id_gyn`) from sp_gynaecology_obs where id_patient='$patientId')"))
        										->first();
        
        $patientGynObsPregData  = DB::table('sp_gynaecology_obs_preg')
        											->where('id_patient','=',$patientId)
        											->where('created_date', DB::raw("(select max(`created_date`) from sp_gynaecology_obs_preg where id_patient='$patientId')"))
        											->where('id_gyn_preg',DB::raw("(select max(`id_gyn_preg`) from sp_gynaecology_obs_preg where id_patient='$patientId')"))
        											->get();
		
		/*$lastLmpDate = 	DB::table('sp_gynaecology_obs_lmp')
												->where('id_patient','=',$patientId)
        										->where('obs_lmp_date', DB::raw("(select max(`obs_lmp_date`) from sp_gynaecology_obs_lmp where id_patient='$patientId')"))
        										->first();*/


        $pregnancyCount = DB::table('sp_gynaecology_obs_preg')->where('id_patient','=',$patientId)->count();

        $data = array('lmpFlow' => $lmpFlow,
        			  'lmpDysmenohrrea'=>$lmpDysmenohrrea, 
        			  'lmpMensusType' => $lmpMensusType, 
        			  'pregKind' => $pregKind, 
        			  'pregType' => $pregType,
        			  'gender' => $gender, 
        			  'pregTerm' =>$pregTerm, 
        			  'pregChildHealth' => $pregChildHealth,
        			  'patientPersonalData' =>$patientPersonalData, 
        			  'patientGynObsData' =>$patientGynObsData, /*'patientGynObsLmpData' =>$patientGynObsLmpData,*/ 
        			  'patientGynObsPregData' =>$patientGynObsPregData,
        			  'bloodGroup' => $bloodGroup,
        			  /*'lastLmpDate'=>$lastLmpDate,*/
        			  'doctorPersonalData'=>$doctorPersonalData,
        			  'pregnancyCount'=>$pregnancyCount);
        return json_encode($data);
	}

	public function showPatientMedicalHistory(){



		$patientId 	= Session::get('patientId');
		$doctorId 	= Session::get('doctorId');

		if(!empty($doctorId)){
			if(!empty($patientId)){
				$patientPersonalData = PatientsModel::where('id_patient','=',$patientId)->first();
				$doctorData 		 = DoctorsModel::where('id_doctor','=',$doctorId)->first();
		      	$medicalHistory		 = DB::table('medical_history')
		      	                                    ->where('id_patient','=',$patientId)
		      	                                    ->where('created_date', DB::raw("(select max(`created_date`) from medical_history where id_patient='$patientId')"))
		      	                                    ->get();
		      	                                    

		      	/*$medicalHistory		 = DB::table('medical_history')
		      	                                    ->where('id_patients','=',$patientId)
		      	                                    ->where('id_medical_history', DB::raw("(select max(`id_medical_history`) from medical_history where id_patient='$patientId')"))
		      	                                    ->get();*/
		      	    //dd($medicalHistory);

				$medicalHistoryPresentPastMore  	= MedicalHistoryPresentPastModel::where('id_patient','=',$patientId)
				                                          ->where('created_date', DB::raw("(select max(`created_date`) from medical_history_present_past_more  where  id_patient='$patientId')"))->get();							
				$surgeryHistory = DB::table('medical_history_surgical')
				                                ->where('created_date', DB::raw("(select max(`created_date`) from medical_history_surgical  where  id_patient='$patientId')"))
				                                ->where('id_patient','=',$patientId)
				                                ->get();
				$drugAllergyHistory = DB::table('medical_history_drug_allergy')
				                                    ->where('created_date', DB::raw("(select max(`created_date`) from medical_history_drug_allergy  where  id_patient='$patientId')"))
				                                   
				                                    ->where('id_patient','=',$patientId)->get();
				
			
				return view('patientmedicalhistory',array('patientPersonalData'=>$patientPersonalData,'doctorData'=>$doctorData,'medicalHistory'=>$medicalHistory,'medicalHistoryPresentPastMore'=>$medicalHistoryPresentPastMore,'surgeryHistory'=>$surgeryHistory,'drugAllergyHistory'=>$drugAllergyHistory));
			}
			else{
				return Redirect::to('doctorhome')->with(array('error'=>'You are not authorised to view the page'));
			}
		}
		else{

		}
		
		
	}

	public function patientPreviousTreatmentExtended(){
		$year = Input::get('year');
		
		//$year = $input['year'];
		$patientId 				= Session::get('patientId');
		$doctorId 				= Session::get('doctorId');
		//$patientPersonalData 	= DB::table('patients')->where('id_patient','=',$patientId)->first();
		//$doctorData 			= DB::table('doctors')->where('id_doctor','=',$doctorId)->first();
		
		$patientPersonalData = PatientsModel::where('id_patient','=',$patientId)->first();
		$doctorData 		 = DoctorsModel::where('id_doctor','=',$doctorId)->first();

		$bloodGroup = DB::table('business_key_details')->where('business_key', '=', 'BLOOD_GROUP')->lists('business_value', 'business_value');
		$diseases 	=  DB::table('diseases')->select('disease_name')->orderBy('disease_name', 'asc')->lists('disease_name', 'disease_name');

		$symptoms =  DB::table('symptoms')->select('symptoms')->orderBy('symptoms', 'asc')->lists('symptoms', 'symptoms'); 

		$drugFrequency = DB::table('drug_frequency')->lists('frequency_name', 'id_drug_frequency');

		$dosageUnit = DB::table('business_key_details')->where('business_key', '=', 'MED_DOSE_UNIT')->lists('business_value', 'business_value');

		$drugDurationUnit = DB::table('business_key_details')->where('business_key', '=', 'MED_DURATION_UNIT')->lists('business_value', 'business_value');


		
		$obsData 	= DB::table('sp_gynaecology_obs')
		                                    ->where('id_patient','=',$patientId)
		                                    
		                                    ->where('created_date','LIKE','%'.$year.'%')
										    ->groupBy('created_date')
										    ->orderBy('created_date','desc')
										    ->get();

										   //var_dump($obsData);
										    
		

		$pregData   = DB::table('sp_gynaecology_obs_preg')
		                                    ->where('id_patient','=',$patientId)
		                                    //->where('id_doctor','=',$doctorId)
		                                    ->where('created_date','LIKE','%'.$year.'%')
		                                    ->orderBy('created_date','desc')
		                                    ->get();



		$vitalsData = DB::table('vitals')
		                            ->where('id_patient','=',$patientId)
		                           //->where('id_doctor','=',$doctorId)
		                            ->where('created_date','LIKE','%'.$year.'%')
		                            ->orderBy('created_date','desc')
		                            ->get();



		$diagnosisData =  DB::table('diagnosis')
		                            ->where('id_patient','=',$patientId)
		                            //->where('id_doctor','=',$doctorId)
		                            ->where('created_date','LIKE','%'.$year.'%')
		                            ->orderBy('created_date','desc')
		                            ->get();


		$prescMedicineData =  DB::table('prescription')
		                            ->where('id_patient','=',$patientId)
		                            //->where('id_doctor','=',$doctorId)
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
											//->where('id_doctor','=',$doctorId)
											->get();	
											
											
		/*$lmpData = DB::table('sp_gynaecology_obs_lmp')
											->whereIn('created_date', $originalCreatedDate)
											->where('created_date','LIKE','%'.$year.'%')
											->where('id_patient','=',$patientId)
											//->where('id_doctor','=',$doctorId)
											->get();	*/

			/*var_dump(json_encode($lmpData));
			die();		*/						

		$pregData = DB::table('sp_gynaecology_obs_preg')
											->whereIn('created_date', $originalCreatedDate)
											->where('created_date','LIKE','%'.$year.'%')
											->where('id_patient','=',$patientId)
											//->where('id_doctor','=',$doctorId)
											->get();
		$vitalsData = DB::table('vitals')
									->whereIn('created_date', $originalCreatedDate)
									->where('created_date','LIKE','%'.$year.'%')
									->where('id_patient','=',$patientId)
									//->where('id_doctor','=',$doctorId)
									->get();
		$diagnosisData = DB::table('diagnosis')
									->whereIn('created_date', $originalCreatedDate)
									->where('created_date','LIKE','%'.$year.'%')
									->where('id_patient','=',$patientId)
									//->where('id_doctor','=',$doctorId)
									->get();
		$prescMedicineData = DB::table('prescription')
									->whereIn('created_date', $originalCreatedDate)
									->where('created_date','LIKE','%'.$year.'%')
									->where('id_patient','=',$patientId)
									//->where('id_doctor','=',$doctorId)
									->get();

									
		return json_encode(array('obsData' => $obsData,/*'lmpData' => $lmpData,*/'pregData' => $pregData,'vitalsData'=>$vitalsData,'originalCreatedDate'=>$originalCreatedDate,'bloodGroup'=>$bloodGroup,'diagnosisData'=>$diagnosisData,'diseases'=>$diseases,'prescMedicineData'=>$prescMedicineData,'drugFrequency'=>$drugFrequency,'originalCreatedDateDup'=>$originalCreatedDateDup,'symptoms'=>$symptoms,'patientPersonalData'=>$patientPersonalData,'doctorData'=>$doctorData,'dosageUnit'=>$dosageUnit,'drugDurationUnit'=>$drugDurationUnit));
		//die();

		//return view('patientprevioustreatment',array('obsData' => $obsData,'lmpData' => $lmpData,'pregData' => $pregData,'vitalsData'=>$vitalsData,'originalCreatedDate'=>$originalCreatedDate,'bloodGroup'=>$bloodGroup,'diagnosisData'=>$diagnosisData,'diseases'=>$diseases,'prescMedicineData'=>$prescMedicineData,'drugFrequency'=>$drugFrequency,'originalCreatedDateDup'=>$originalCreatedDateDup,'symptoms'=>$symptoms,'patientPersonalData'=>$patientPersonalData,'doctorData'=>$doctorData,'dosageUnit'=>$dosageUnit,'drugDurationUnit'=>$drugDurationUnit));
	}

	public function showPatientPreviousTreatment(){
		$patientId 	= Session::get('patientId');
		$doctorId 	= Session::get('doctorId');

		if(!empty($doctorId)){
			if(!empty($patientId)){
				$patientPersonalData = DB::table('patients')->where('id_patient','=',$patientId)->first();
				$doctorData 	= DB::table('doctors')->where('id_doctor','=',$doctorId)->first();

		        return view('patientprevioustreatment',array('patientPersonalData'=>$patientPersonalData,'doctorData'=>$doctorData));
			}
			else{
				return Redirect::to('doctorhome')->with(array('error'=>'You are not authorised to view the page'));
			}
		}
		
	}

	public function showPatientPreviousTreatmentTest(){
		$patientId 	= Session::get('patientId');
		$doctorId = Session::get('doctorId');
		$patientPersonalData 	= DB::table('patients')->where('id_patient','=',$patientId)->first();
		$doctorData 	= DB::table('doctors')->where('id_doctor','=',$doctorId)->first();

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
		                                    ->where('created_date','LIKE','%'.$year.'%')
										    ->groupBy('created_date')
										    ->orderBy('created_date','desc')
										    ->get();

										   //var_dump($obsData);
										    //die();

		

		$pregData   = DB::table('sp_gynaecology_obs_preg')
		                                    ->where('id_patient','=',$patientId)
		                                    ->where('created_date','LIKE','%'.$year.'%')
		                                    ->orderBy('created_date','desc')
		                                    ->get();



		$vitalsData = DB::table('vitals')
		                            ->where('id_patient','=',$patientId)
		                            ->where('created_date','LIKE','%'.$year.'%')
		                            ->orderBy('created_date','desc')
		                            ->get();



		$diagnosisData =  DB::table('diagnosis')
		                            ->where('id_patient','=',$patientId)
		                            ->where('created_date','LIKE','%'.$year.'%')
		                            ->orderBy('created_date','desc')
		                            ->get();


		$prescMedicineData =  DB::table('prescription')
		                            ->where('id_patient','=',$patientId)
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
											->get();	
											
											
		/*$lmpData = DB::table('sp_gynaecology_obs_lmp')
											->whereIn('created_date', $originalCreatedDate)
											->where('created_date','LIKE','%'.$year.'%')
											->where('id_patient','=',$patientId)
											->get();	*/

			/*var_dump(json_encode($lmpData));
			die();		*/						

		$pregData = DB::table('sp_gynaecology_obs_preg')
											->whereIn('created_date', $originalCreatedDate)
											->where('created_date','LIKE','%'.$year.'%')
											->where('id_patient','=',$patientId)
											->get();
		$vitalsData = DB::table('vitals')
									->whereIn('created_date', $originalCreatedDate)
									->where('created_date','LIKE','%'.$year.'%')
									->where('id_patient','=',$patientId)
									->get();
		$diagnosisData = DB::table('diagnosis')
									->whereIn('created_date', $originalCreatedDate)
									->where('created_date','LIKE','%'.$year.'%')
									->where('id_patient','=',$patientId)
									->get();
		$prescMedicineData = DB::table('prescription')
									->whereIn('created_date', $originalCreatedDate)
									->where('created_date','LIKE','%'.$year.'%')
									->where('id_patient','=',$patientId)
									->get();

									
	
		//die();

		return view('patientprevioustreatmenttest',array('obsData' => $obsData,/*'lmpData' => $lmpData,*/'pregData' => $pregData,'vitalsData'=>$vitalsData,'originalCreatedDate'=>$originalCreatedDate,'bloodGroup'=>$bloodGroup,'diagnosisData'=>$diagnosisData,'diseases'=>$diseases,'prescMedicineData'=>$prescMedicineData,'drugFrequency'=>$drugFrequency,'originalCreatedDateDup'=>$originalCreatedDateDup,'symptoms'=>$symptoms,'patientPersonalData'=>$patientPersonalData,'doctorData'=>$doctorData,'dosageUnit'=>$dosageUnit,'drugDurationUnit'=>$drugDurationUnit));

	}
	
	

	//Diagnosis
	public function showPatientExamination(){
		$patientId = Session::get('patientId');
		$doctorId  = Session::get('doctorId');

		if(!empty($doctorId)){
			if(!empty($patientId)){
				$doctorData 	= DB::table('doctors')->where('id_doctor','=',$doctorId)->first();
				$patientPersonalData 	= DB::table('patients')->where('id_patient','=',$patientId)->first();

		        
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
				return view('patientexamination',array('bloodGroup'=>$bloodGroup,'diagNormalAbnormal'=>$diagNormalAbnormal,'diagYesNo'=>$diagYesNo,'diagAvafRvrf'=>$diagAvafRvrf,'vitalExist'=>$vitalExist,'diagExam'=>$diagExam,'patientPersonalData'=>$patientPersonalData,'doctorData'=>$doctorData));
			}
			else{
				return Redirect::to('doctorhome')->with(array('error'=>'You are not authorised to view the page'));
			}
		}
		else{
			return Redirect::to('logout');
		}

		
	}
	public function showPatientDiagnosis(){
		$patientId = Session::get('patientId');
		$doctorId  = Session::get('doctorId');


		if(!empty($doctorId)){
			if(!empty($patientId)){
				$doctorData 			= DoctorsModel::where('id_doctor','=',$doctorId)->first();
				$patientPersonalData 	= PatientsModel::where('id_patient','=',$patientId)->first();

				$symptomsArray = array();
				
				$diseases =  DB::table('diseases')->select('disease_name')->orderBy('disease_name', 'asc')->lists('disease_name', 'disease_name'); 

				$symptoms =  DB::table('symptoms')->select('symptoms')->orderBy('symptoms', 'asc')->lists('symptoms','symptoms'); 

				
				//var_dump($symptoms);


				$diag = DB::table('diagnosis')
											->where('id_patient','=',$patientId)
											// ->where('created_date', DB::raw("(select max(`created_date`) from diagnosis where id_patient='$patientId')"))
											->where('id_diagnosis', DB::raw("(select max(`id_diagnosis`) from diagnosis where id_patient='$patientId')"))
											->first();

				$diag2 = DB::table('diagnosis')
				                    ->select('diag_symptoms','diag_suspected_diseases')
									->where('id_patient','=',$patientId)
									->where('id_diagnosis', DB::raw("(select max(`id_diagnosis`) from diagnosis      where id_patient='$patientId')"))
									->first();



							//$sym = (array)$diag2->diag_symptoms;
						if(!empty($diag2)){
							//Symptoms Merging
							if(!empty($diag->diag_symptoms)){
								$symFetchedArray = array();
								$symptomsName 	 = explode('"',$diag->diag_symptoms);
								
								for($i=0;$i<sizeof($symptomsName);$i++){
									
									if($i%2!=0){
										array_push($symFetchedArray,$symptomsName[$i]);
									}
									
								}
								
								$finalSymptomsFetchArray = array();
								foreach($symFetchedArray as $index=>$value){
									//var_dump($value);
									$finalSymptomsFetchArray[$value] = $value;
								}
								
								$symptoms = array_merge($symptoms,$finalSymptomsFetchArray);
							}
							else{
								$symptoms = $symptoms;
							}

							//Diseases Merging
							if(!empty($diag->diag_suspected_diseases)){
								$disFetchedArray = array();
								$diseasesName 	 = explode('"',$diag->diag_suspected_diseases);
								
								for($i=0;$i<sizeof($diseasesName);$i++){
									
									if($i%2!=0){
										array_push($disFetchedArray,$diseasesName[$i]);
									}
									
								}
								
								$finalDiseasesFetchArray = array();
								foreach($disFetchedArray as $index=>$value){
									//var_dump($value);
									$finalDiseasesFetchArray[$value] = $value;
								}
								
								$diseases = array_merge($diseases,$finalDiseasesFetchArray);
							}
							else{
								$symptoms = $symptoms;
							}
							
							
						}
						else{
							$symptoms = $symptoms;
						}				
							

						

				return View('patientdiagnosis',array('diseases'=>$diseases,'diag'=>$diag,'symptoms'=>$symptoms,'patientPersonalData'=>$patientPersonalData,'doctorData'=>$doctorData));
			}
			else{
				return Redirect::to('doctorhome')->with(array('error'=>'You are not authorised to view the page'));
			}
		}
		else{
			return Redirect::to('logout');
		}



		
	}
	public function showPatientLabdata(){
		$patientId = Session::get('patientId');
		$doctorId  = Session::get('doctorId');

		if(!empty($doctorId)){
			if(!empty($patientId)){
				$doctorData 	= DB::table('doctors')->where('id_doctor','=',$doctorId)->first();
				$patientPersonalData 	= DB::table('patients')->where('id_patient','=',$patientId)->first();
				return View('patientlabdata',array('patientPersonalData'=>$patientPersonalData,'doctorData'=>$doctorData));
			}
			else{
				return Redirect::to('doctorhome')->with(array('error'=>'You are not authorised to view the page'));
			}
		}
		else{
			return Redirect::to('logout');
		}
		
	}

	public function showPatientPrescManagement(){
		$patientId = Session::get('patientId');
		$doctorId  = Session::get('doctorId');

		if(!empty($doctorId)){
			if(!empty($patientId)){
				$doctorData 	= DB::table('doctors')->where('id_doctor','=',$doctorId)->first();
				$patientPersonalData 	= DB::table('patients')->where('id_patient','=',$patientId)->first();
		        
				$prescGynData = DB::table('prescription_gynaecology')->where('id_patient','=',$patientId)
													->where('created_date', DB::raw("(select max(`created_date`) from prescription_gynaecology where id_patient='$patientId')"))
													->where('id_prescription_gynaecology', DB::raw("(select max(`id_prescription_gynaecology`) from prescription_gynaecology where id_patient='$patientId')"))
													->first();
				return View('patientprescmanagement',array('prescGynData'=>$prescGynData,'patientPersonalData'=>$patientPersonalData,'doctorData'=>$doctorData));
			}
			else{
				return Redirect::to('doctorhome')->with(array('error'=>'You are not authorised to view the page'));
			}
		}
		else{
			return Redirect::to('logout');
		}
		
	}

	public function showPatientPrescMedicine(){
		$patientId = Session::get('patientId');
		$doctorId  = Session::get('doctorId');
		
		if(!empty($doctorId)){
			if(!empty($patientId)){
				$doctorData 	= DB::table('doctors')->where('id_doctor','=',$doctorId)->first();
				$patientPersonalData 	= DB::table('patients')->where('id_patient','=',$patientId)->first();
		       
				$presentDrugStatus = Input::get('present_drug');
				
				$drugFrequency = DB::table('drug_frequency')->lists('frequency_name', 'id_drug_frequency');
				


				$prescMedicine = DB::table('prescription')
											->where('id_patient','=',$patientId)
											->where('created_date', DB::raw("(select max(`created_date`) from prescription where id_patient='$patientId')"))
											->get();

				$dosageUnit = DB::table('business_key_details')->where('business_key', '=', 'MED_DOSE_UNIT')->lists('business_value', 'business_value');

				$drugDurationUnit = DB::table('business_key_details')->where('business_key', '=', 'MED_DURATION_UNIT')->lists('business_value', 'business_value');



										//var_dump($prescMedicine);
										//die();

											
				return View('patientprescmedicine',array('drugFrequency'=>$drugFrequency,'prescMedicine' => $prescMedicine,'patientPersonalData'=>$patientPersonalData,'dosageUnit'=>$dosageUnit,'drugDurationUnit'=>$drugDurationUnit,'doctorData'=>$doctorData));
			}
			else{
				return Redirect::to('doctorhome')->with(array('error'=>'You are not authorised to view the page'));
			}
		}
		else{
			return Redirect::to('logout');
		}

		
									
		

		
	}
	public function showPatientPrescMedicineAjax(){
				$patientId = Session::get('patientId');
				$doctorId  = Session::get('doctorId');
				
				$doctorData 	= DB::table('doctors')->where('id_doctor','=',$doctorId)->first();
				$patientPersonalData 	= DB::table('patients')->where('id_patient','=',$patientId)->first();
		       
				$presentDrugStatus = Input::get('present_drug');
				
				$drugFrequency = DB::table('drug_frequency')->lists('frequency_name', 'id_drug_frequency');
				
		
		
				$prescMedicine = DB::table('prescription')
											->where('id_patient','=',$patientId)
											->where('created_date', DB::raw("(select max(`created_date`) from prescription where id_patient='$patientId')"))
											->get();

				$medicalHistoryData =  DB::table('medical_history_present_past_more')
									->where('id_patient','=',$patientId)
		                            ->get();
		
				$dosageUnit = DB::table('business_key_details')->where('business_key', '=', 'MED_DOSE_UNIT')->lists('business_value', 'business_value');
		
				$drugDurationUnit = DB::table('business_key_details')->where('business_key', '=', 'MED_DURATION_UNIT')->lists('business_value', 'business_value');
		
				$data = array('drugFrequency'=>$drugFrequency,'prescMedicine' => $prescMedicine,'patientPersonalData'=>$patientPersonalData,'dosageUnit'=>$dosageUnit,'drugDurationUnit'=>$drugDurationUnit,'doctorData'=>$doctorData,'medicalHistoryData'=>$medicalHistoryData);
		
									
											
				return $data;

		
	}


	public function addPatientPersonalInformation(){
		
		$input 		= Request::all();
		$doctorId 	= Session::get('doctorId');
		$patientId 	= Session::get('patientId');
		$createdDate = date('Y-m-d H:i:s');
		

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
									'id_aadhar' 		=>	$aadharNo,
									'gender' 			=> 	$gender,
									'dob' 				=> 	$dob,
									'age' 				=> 	$age,
									'maritial_status' 	=> 	$marriedStatus,
									'reffered_by'		=>	$refferedby,
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
		 				return Redirect::to('patientpersonalinformation')->with(array('success'=>"Data updated successfully"));	
		 			}
		 			else{
		 				return Redirect::to('patientpersonalinformation')->with(array('error'=>"No changes to update"));
		 			}
			}
			else{
				
				return Redirect::to('patientpersonalinformation')->with(array('success'=>'Data saved successfully'));
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
									'id_aadhar' =>	$aadharNo,
									'gender' => $gender,
									'dob' => $dob,
									'age' => $age,
									'maritial_status' => $marriedStatus,
									'reffered_by'		=>	$refferedby,
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
					return Redirect::to('patientpersonalinformation')->with(array('success'=>'Data saved successfully'));
				}
			}
			else{
				return Redirect::to('patientpersonalinformation')->with(array('success'=>'Data saved successfully'));
			}

		}
	}

	public function handleNewPatientId(){
		$input 			= Request::all();
		$cityCode 		= $input['id_city'];
		$doctorCode 	= $input['id_doctor'];
		$patientCode 	= $input['id_patient'];
		$patientId      = $cityCode.$doctorCode.$patientCode;
		$specialization = Session::get('doctorSpecialization');
		$doctorId 		= Session::get('doctorId');

		//Keeping patient id in session for showing the details
		Session::put('patientId',$patientId);
		
		
		//Reference id to session
		$referenceId = DBUtils:: generate_random_password(5);
		Session::put('referenceId',$referenceId);
		
		
			$patientExistCheck = DB::table('patients')->where('id_patient','=',$patientId)->first();
			
			if(count($patientExistCheck)>0){
				
				return Redirect::to('doctorhome')->with(array('error'=>'Patient ID already existed.'));
			}
			else{
				
				switch ($specialization) {
					case '1':
						return Redirect::to('patientpersonalinformation');
					break;
					case '2':
						return Redirect::to('cardiopersonalinformation');
					break;
					
					default:

					break;
				}
			}

		

		
		
	}
	public function handleOldPatientId(){
		$input 			= Request::all();
		$cityCode 		= $input['id_city'];
		$doctorCode 	= $input['id_doctor'];
		$patientCode 	= $input['id_patient'];
		$patientId      = $cityCode.$doctorCode.$patientCode;
		$specialization = Session::get('doctorSpecialization');
		$doctorId 		= Session::get('doctorId');

	
		$patientExistCheck = PatientsModel::where('id_patient','=',$patientId)->first();

			

		//Keeping patient id in session for showing the details
		Session::put('patientId',$patientId);
		
		
		//Reference id to session
		$referenceId = DBUtils:: generate_random_password(5);
		Session::put('referenceId',$referenceId);

			

			//dd($patientExistCheck->first_name);
			if($patientExistCheck){
				Session::put('patientName',$patientExistCheck->first_name." ".$patientExistCheck->last_name);
				switch ($specialization) {
					case '1':
							return Redirect::to('patientpersonalinformation');
						break;
					case '2':
							return Redirect::to('cardiopersonalinformation');
						break;
					
					default:
						# code...
						break;
				}
				
			}
			else{
				Session::put('patientName','');
				return Redirect::to('doctorhome')->with(array('error'=>"Invalid PatientID. Please check."));
			}
		
		

	}

	
	public function addPatientObstetricsHistory(){
		$input = Request::all();
        
        


        $patientId 	 = Session::get('patientId'); 
        $doctorId 	 = Session::get('doctorId');
        $referenceId = Session::get('referenceId'); 
        $createdDate     = date('Y-m-d H:i:s');
        $flagArray 		=	array();
        //Creating a 5digits random alpha numeric for reference
       
       
        
        (!empty($input['married_life']))? $marriedLife = $input['married_life'] : $marriedLife="";
        (!empty($input['hus_blood_group']))? $husBloodGroup = $input['hus_blood_group'] : $husBloodGroup="";
        (!empty($input['gravida']))? $gravida = $input['gravida'] : $gravida="";
        (!empty($input['para']))? $para = $input['para'] : $para="";
		(!empty($input['living']))? $living = $input['living'] : $living="";
        (!empty($input['abortion']))? $abortion = $input['abortion'] : $abortion="";
        (!empty($input['gestational_age']))? $gestationalAge  = $input['gestational_age'] : $gestationalAge="";
        (!empty($input['last_delvery_date']))? $lastDeliveryDate  = $input['last_delvery_date'] : $lastDeliveryDate="";
        (!empty($input['expected_delvery_date']))? $expectedDeliveryDate  = $input['expected_delvery_date'] : $expectedDeliveryDate="";

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
	        		return Redirect::to('patientobstetricshistory')->with(array('success'=>"Data updated successfully"));	
	        	}
	        	else{
	        		return Redirect::to('patientobstetricshistory')->with(array('error'=>"Failed to update data"));	
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
        				return Redirect::to('patientobstetricshistory')->with(array('success'=>"Data saved successfully"));
        			}
        			else{
        				return Redirect::to('patientobstetricshistory')->with(array('error'=>"Failed to save data"));
        			}
		  	}
        }
        else
        {
        	return Redirect::to('patientobstetricshistory')->with(array('error' => "Please add patient personal information"));
        }

    }

    public function lmpInsertUpdate($patientGynObsExist,$input,$patientId,$referenceId,$doctorId,$createdDate){
    	
    	
    	(!empty($input['obs_lmp_date']))? $lastMensusDate = $input['obs_lmp_date'] : $lastMensusDate="";
        (!empty($input['obs_lmp_flow']))? $lmpFlow = $input['obs_lmp_flow'] : $lmpFlow="";
        (!empty($input['obs_lmp_dysmenorrhea']))?$lmpDysmenorrhea = $input['obs_lmp_dysmenorrhea']:$lmpDysmenorrhea="";
        (!empty($input['obs_lmp_days']))? $days = $input['obs_lmp_days'] : $days="";
        (!empty($input['obs_lmp_cycle']))? $cycle = $input['obs_lmp_cycle'] : $cycle="";
		(!empty($input['obs_menstrual_type']))? $lmpMensusType = $input['obs_menstrual_type'] : $lmpMensusType="";
		
       
       	if(!empty($lastMensusDate)){
        	$date1  		 		= str_replace('/', '-', $lastMensusDate);
			$lastMensusDate 		= date('Y-m-d', strtotime($date1));
        }
        else{
        	$lastMensusDate = "";
        }

        $lmpFlag = 0;
        
        if($patientGynObsExist>0){
        	
			if(	!empty($lastMensusDate) || !empty($lmpFlow) || !empty($lmpDysmenorrhea) ||
   	   	 		!empty($days) || !empty($cycle) || !empty($lmpMensusType))
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
		(!empty($input['preg_kind']))? $pregKind = $input['preg_kind'] : $pregKind="";
		(!empty($input['preg_type']))? $pregType = $input['preg_type'] : $pregType="";
		(!empty($input['preg_term']))? $pregTerm = $input['preg_term'] : $pregTerm="";
		(!empty($input['type_of_abortion']))? $pregAbortion = $input['type_of_abortion'] : $pregAbortion="";
		(!empty($input['preg_health'] ))? $pregHealth = $input['preg_health'] : $pregHealth="";
		(!empty($input['years']))? $pregYear = $input['years'] : $pregYear="";
		(!empty($input['months']))? $pregMonth = $input['months'] : $pregMonth="";
		(!empty($input['weeks']))? $pregWeek = $input['weeks'] : $pregWeek="";
		(!empty($input['gender']))? $pregGender = $input['gender'] : $pregGender="";
		
		/*----------------------------------------------------------------------------------------*/
    		
    		//Inserting into sp_gynaecology_obs_preg
			if(	!empty($pregKind)     || 
				!empty($pregType)     ||
				!empty($pregTerm)     ||
				!empty($pregAbortion) ||
				!empty($pregHealth)   ||
				!empty($pregWeek)     ||
				!empty($pregMonth)    ||
				!empty($pregYear)     ||
				!empty($pregGender)   ||
				$pregKind!=0 		  || 
				$pregType!=0    	  || 
				$pregTerm!=0 		  || 
				$pregHealth!=0        || 
				$pregGender!=0)
			{ 

			  
				foreach ($pregKind as $index => $value){
					
					isset($pregAbortion[$index])?$pregAbortion= $pregAbortion[$index]:$pregAbortion="";
					isset($pregHealth[$index])?$pregHealth= $pregHealth[$index]:$pregHealth="";
					isset($pregGender[$index])?$pregGender= $pregGender[$index]:$pregGender="";
					isset($pregYear[$index])?$pregYear= $pregYear[$index]:$pregYear="";
					isset($pregWeek[$index])?$pregWeek= $pregWeek[$index]:$pregWeek="";
					isset($pregMonth[$index])?$pregMonth= $pregMonth[$index]:$pregMonth="";
					//echo $pregKind[$index].' '.$pregType[$index];
					$pregData = array('id_patient' 			=> $patientId,
								      'id_doctor' 			=> $doctorId, 
								      'obs_preg_kind' 		=> $pregKind[$index],
								      'obs_preg_type' 		=> $pregType[$index],
								      'obs_preg_term' 		=> $pregTerm[$index],
								      'obs_preg_abortion' 	=> $pregAbortion,
								      'obs_preg_health' 	=> $pregHealth,
								      'obs_preg_gender' 	=> $pregGender,
								      'obs_preg_years' 		=> $pregYear,
								      'obs_preg_weeks' 		=> $pregWeek,
								      'obs_preg_months' 	=> $pregMonth,
								      'obs_preg_reference' 	=> $referenceId,
								      'created_date' 		=> $createdDate);
					
					if(!empty($pregKind[$index])	||
					   !empty($pregType[$index])	||
					   !empty($pregTerm[$index]) 	||
					   !empty($pregHealth[$index])	||
					   !empty($pregGender[$index])  ||
					   $pregKind[$index]!=0		||
					   $pregType[$index]!=0			||
					   $pregHealth[$index]!=0		||
					   $pregGender[$index]!=0	
					  )	
					
					{ 
						$gynObsPregData = DB::table('sp_gynaecology_obs_preg')->insert($pregData);
					}
				}
				
				
			}
			
    }

    public function addPatientMedicalHistory(){

    	$input 					= Request::all();
    	$referenceId 			= Session::get('referenceId');
	    $patientId   			= Session::get('patientId');
	    $doctorId   			= Session::get('doctorId'); 
	    $specializationText 	= Session::get('doctorSpecialization');
		$createdDate 			= date('Y-m-d H:i:s');

		//if this is NA then checked the Not known else unchecked the not known
		$presentPastNotKnown  	= $input['present-past-check-value']; 
		$familyNotKnown       	= $input['family-check-value'];	
		$surgeryNotKnown      	= $input['surgery-check-value'];
		$generalAllergyNotKnown = $input['generalallergy-check-value'];
		$drugAllergyNotKnown 	= $input['drugallergy-check-value'];
		$socialNotKnown 		= $input['social-check-value'];
		
		$patientExistCheck 		= 	PatientsModel::where('id_patient','=',$patientId)->count();
		$medicalHistoryExist 	= 	DB::table('medical_history')->where('id_patient','=',$patientId)->where('medical_history_reference','=',$referenceId)->count();
	    								

	    if($patientExistCheck>0)
	    {
	    	(!empty($input['menarche']))?$menarche = $input['menarche']:$menarche = "";
	    	(!empty($input['menopause']))?$menopause = $input['menopause']:$menopause = "";
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
	    	(!empty($input['allergy_general']))?$allergyGeneral = $input['allergy_general'] : $allergyGeneral=[""];
	    	(!empty($input['alcohol']))?$alcohol = $input['alcohol']:$alcohol = "";
    		(!empty($input['tobaco-smoke']))?$tobacoSmoke = $input['tobaco-smoke']:$tobacoSmoke = "";
    		(!empty($input['tobaco-chew']))?$tobacoChew = $input['tobaco-chew']:$tobacoChew = "";
    		(!empty($input['other-social-history']))?$OtherSocialHistory = $input['other-social-history']:$OtherSocialHistory = "";
    		(!empty($input['other_medical_history']))?$otherMedicalHistory = $input['other_medical_history']:$otherMedicalHistory = "";

			//Surgery History
    		(!empty($input['surgery']))?$surgery = $input['surgery']:$surgery = "";
	
			//Allergy History
	    	(!empty($input['medication-drug-allergy']))?$allergyMedication = $input['medication-drug-allergy']: $allergyMedication="";
	    	(!empty($input['reaction-drug-allergy']))?$allergyReaction= $input['reaction-drug-allergy']: $allergyReaction="";
	    	
	

	    	if($medicalHistoryExist>0){
	    		if  (!empty($input['menarche'])	 || !empty($input['menopause']) ||	!empty($input['hypertension']) 	||
			    	   !empty($input['medication_hypertension']) 	|| 	!empty($input['diabetes'])	 ||
			    	   !empty($input['medication_diabetes'])	 ||	 !empty($input['hyperthyroidism'])	 ||
			    	   !empty($input['medication_hyperthyroidism']) || !empty($input['hypothyroidism']) ||
			    	   !empty($input['medication_hypothyroidism']) || !empty($input['cyst']) || 
			    	   !empty($input['medication_cyst']) || !empty($input['endometriosis']) ||
			    	   !empty($input['medication_endometriosis']) || !empty($input['uterinefibroids']) ||
			    	   !empty($input['medication_uterinefibroids']) || !empty($input['uti']) || 
			    	   !empty($input['medication_uti']) || !empty($input['cancer']) || 
			    	   !empty($input['medication_cancer']) || !empty($input['father']) || !empty($input['mother']) ||
			    	   !empty($input['sibling']) || !empty($input['grandfather']) || !empty($input['grandmother']) ||
			    	   !empty($input['allergy_general']) || !empty($input['alcohol']) || !empty($input['tobaco-smoke']) || !empty($input['tobaco-chew'])  || !empty($input['other-social-history']) || !empty($input['present-past-check-value']) ||
			    	   !empty($input['family-check-value']) || !empty($input['surgery-check-value']) ||
			    	   !empty($input['generalallergy-check-value']) || !empty($input['drugallergy-check-value']) || !empty($input['social-check-value']) )
    			{		
    				$editedDate	 = date('Y-m-d H:i:s');
    				$dataArray 	 = array(
    								'menstrual_menarche'=> $menarche,
									'menstrual_menopause' => $menopause,
									'history_family_father' => json_encode($fatherHistory),
									'history_family_father_other'=> $fatherHistoryOther,
									'history_family_mother'=> json_encode($motherHistory),
									'history_family_mother_other' => $motherHistoryOther,
									'history_family_sibling'=> json_encode($siblingHistory),
									'history_family_sibling_other' => $siblingHistoryOther,
									'history_family_grandfather' => json_encode($grandfatherHistory),
								    'history_family_grandfather_other'=> $grandfatherHistoryOther,
									'history_family_grandmother' => json_encode($grandmotherHistory),
									'history_family_grandmother_other' => $grandmotherHistoryOther,
									'history_allergy_general'=>json_encode($allergyGeneral),
									'history_social_alcohol' => $alcohol,
									'history_social_tobacco_smoke' => $tobacoSmoke,
									'history_social_tobacco_chew' => $tobacoChew,
									'history_social_other' => $OtherSocialHistory,
									'history_other' => $otherMedicalHistory,
									'history_presentpast_no'=>$presentPastNotKnown,
									'history_family_no'=>$familyNotKnown,
									'history_surgery_no'=>$surgeryNotKnown,
									'history_generalallergy_no'=>$generalAllergyNotKnown,
									'history_drugallergy_no'=>$drugAllergyNotKnown,
									'history_social_no'=>$socialNotKnown,
									'id_doctor'=> $doctorId,
									'edited_date'=> $editedDate);

    					$dataUpdate = DB::table('medical_history')->where('id_patient','=',$patientId)->where('medical_history_reference','=',$referenceId)->update($dataArray);
    			}

    			//Add more illness
    			$this->illnessDataManagement($input,$patientId,$doctorId,$referenceId,$createdDate,$specializationText );
				//Surgery Management
				$this->surgeryDataManagement($input,$surgery,$patientId,$doctorId,$referenceId,$createdDate);
				//Drug allergy managent
				$this->drugDataManagement($input,$allergyMedication,$allergyReaction,$patientId,$doctorId,$referenceId,$createdDate);
					
	    			

    			return Redirect::to('patientmedicalhistory')->with(array('success'=>"Data updated successfully"));

	    	}
	    	else{
	    		
			    if(	!empty($input['menarche']) || !empty($input['menopause'])  || 
    				!empty($input['father']) || !empty($input['mother']) ||
	    	   		!empty($input['sibling']) || !empty($input['grandfather']) || 
	    	   		!empty($input['grandmother']) ||  !empty($input['allergy_general']) || 
	    	   		!empty($input['alcohol']) || !empty($input['tobaco-smoke']) || 
	    	   		!empty($input['tobaco-chew'])  || !empty($input['other-social-history']) ||
	    	   		!empty($input['present-past-check-value']) || !empty($input['family-check-value']) ||
	    	   		!empty($input['surgery-check-value']) || !empty($input['generalallergy-check-value']) || !empty($input['drugallergy-check-value']) || !empty($input['social-check-value']))
		    	{


	    			//Menstrual History, Present & Past, Family History, General Allergy, Social History and Other
	    			$dataArray = array('menstrual_menarche' => $menarche,
			    					   'menstrual_menopause' => $menopause,
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
			    					   'history_other' => $otherMedicalHistory,
			    					   'history_presentpast_no'=>$presentPastNotKnown,
			    					   'history_family_no'=>$familyNotKnown,
			    					   'history_surgery_no'=>$surgeryNotKnown,
			    					   'history_generalallergy_no'=>$generalAllergyNotKnown,
			    					   'history_drugallergy_no'=>$drugAllergyNotKnown,
			    					   'history_social_no'=>$socialNotKnown,
			    					   'id_patient' => $patientId,
			    					   'id_doctor' => $doctorId,
			    					   'created_date' => $createdDate);

    				$dataInsert = DB::table('medical_history')->insert($dataArray);
	    		}

	
				//Add more illness
    			$this->illnessDataManagement($input,$patientId,$doctorId,$referenceId,$createdDate,$specializationText );
				//Surgery Management
				$this->surgeryDataManagement($input,$surgery,$patientId,$doctorId,$referenceId,$createdDate);
				//Drug allergy managent
				$this->drugDataManagement($input,$allergyMedication,$allergyReaction,$patientId,$doctorId,$referenceId,$createdDate);
				
				return Redirect::to('patientmedicalhistory')->with(array('success'=>"Data saved successfully"));
	
		    }
		}
	    else{
	    	return Redirect::to('patientmedicalhistory')->with(array('error'=>"Please save patient personal information"));
	    }	
    }

	public function illnessDataManagement($input,$patientId,$doctorId,$referenceId,$createdDate,$specializationText ){

			//var_dump(json_encode($input));
			$presentPastDivCount =	$input['presentPastDivCount'];

			$conditionString 	 = 	array('id_patient' => $patientId, 'illness_reference'=>$referenceId);
			$illnessData	     =	MedicalHistoryPresentPastModel::where($conditionString)->get();
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
						if(count($illnessData)>0){
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
						}
	    		break;
	    		case '2':
	    			$illnessSave = DB::table('cardiac_medical_history_present_past_more')->insert($illnessAllArray);
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
    

    public function addPatientExamination(){
    	$input = Request::all();

    	$patientId 		= Session::get('patientId');
    	$doctorId 		= Session::get('doctorId');
    	$referenceId 	= Session::get('referenceId');
    	$createdDate 	= date('Y-m-d H:i:s');

    	$responseFlag  = array();

    	//var_dump(json_encode($input)); //die();

    	//Vitals Insert and Update
    	$vitalsExist = DB::table('vitals')
    								->where('id_patient','=',$patientId)
    								->where('created_date', DB::raw("(select max(`created_date`)=0 from vitals where id_patient='$patientId')"))
    								->where('vitals_reference','=',$referenceId)
    								->get();

    	
        $patientExistCheck 		= DB::table('patients')->where('id_patient','=',$patientId)->count();

        if($patientExistCheck>0){
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
	    											->update($vitalsData);

	    				if($vitalsUpdate){
	    					array_push($responseFlag,1);
	    				}	

		    	}
	    	
	    				

	    	}
	    	else
	    	{
	    			//echo "Vitals Insert";

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


	    	//Systemic Examination

	    	$systemicExamExist = DB::table('diagnosis_gynaecology_exam')
	    											->where('id_patient','=',$patientId)
				    								
				    								->where('diag_reference','=',$referenceId)
				    								->get();




	    	(!empty($input['ext_genetalia']))?$externalGenetalia = $input['ext_genetalia']:$externalGenetalia="";
	    	(!empty($input['ext_genetalia_other']))?$extGenetaliaOther= $input['ext_genetalia_other']:$extGenetaliaOther="";
	    	(!empty($input['preabdomen_examination']))?$preAbdomenExam = $input['preabdomen_examination']:$preAbdomenExam="";
	    	(!empty($input['preabdomin_other']))?$preAbdomenOther = $input['preabdomin_other']:$preAbdomenOther="";
	    	(!empty($input['sys_breast_lump']))?$sysBreastLump = $input['sys_breast_lump']:$sysBreastLump="";
	    	(!empty($input['sys_breast_lump_other']))?$sysBreastLumpOther = $input['sys_breast_lump_other']:$sysBreastLumpOther="";
	    	(!empty($input['sys_breast_galactorrhea']))?$sysBreastGalactorrhea = $input['sys_breast_galactorrhea']:$sysBreastGalactorrhea="";
	    	(!empty($input['sys_breast_galactorrhea_other']))?$sysBreastGalactorrheaOther = $input['sys_breast_galactorrhea_other']:$sysBreastGalactorrheaOther="";
	    	(!empty($input['sys_breast_other']))?$sysBreastOther = $input['sys_breast_other']:$sysBreastOther="";
	    	(!empty($input['sys_breast_other_other']))?$sysBreastOtherOther = $input['sys_breast_other_other']:$sysBreastOtherOther="";
	    	(!empty($input['sys_secondarysex_welldeveloped']))?$sysSecondarySexWellDeveloped = $input['sys_secondarysex_welldeveloped']:$sysSecondarySexWellDeveloped="";
	    	(!empty($input['sys_secondarysex_welldeveloped_other']))?$sysSecondarySexWellDevelopedOther = $input['sys_secondarysex_welldeveloped_other']:$sysSecondarySexWellDevelopedOther="";
	    	(!empty($input['sys_secondarysex_hair']))?$sysSecondarySexHair = $input['sys_secondarysex_hair']:$sysSecondarySexHair="";
	    	(!empty($input['sys_secondarysex_hair_other']))?$sysSecondarySexHairOther = $input['sys_secondarysex_hair_other']:$sysSecondarySexHairOther ="";
	    	(!empty($input['sys_secondarysex_acne']))?$sysSecondarySexAcne = $input['sys_secondarysex_acne']:$sysSecondarySexAcne ="";
	    	(!empty($input['sys_secondarysex_acne_other']))?$sysSecondarySexAcneOther = $input['sys_secondarysex_acne_other']:$sysSecondarySexAcneOther ="";
	    	(!empty($input['sys_secondarysex_other']))?$sysSecondarySexOther = $input['sys_secondarysex_other']:$sysSecondarySexOther ="";
	    	(!empty($input['sys_secondarysex_other_other']))?$sysSecondarySexOtherOther = $input['sys_secondarysex_other_other']:$sysSecondarySexOtherOther ="";
	    	(!empty($input['sys_pelvic_cervix_healthy']))?$sysPelvicCervixHealthy = $input['sys_pelvic_cervix_healthy']:$sysPelvicCervixHealthy ="";
	    	(!empty($input['sys_pelvic_cervix_healthy_other']))?$sysPelvicCervixHealthyOther = $input['sys_pelvic_cervix_healthy_other']:$sysPelvicCervixHealthyOther ="";
	    	(!empty($input['sys_pelvic_cervix_bleeding']))?$sysPelvicCervixBleeding = $input['sys_pelvic_cervix_bleeding']:$sysPelvicCervixBleeding ="";
	    	(!empty($input['sys_pelvic_cervix_bleeding_other']))?$sysPelvicCervixBleedingOther= $input['sys_pelvic_cervix_bleeding_other']:$sysPelvicCervixBleedingOther ="";
	    	(!empty($input['sys_pelvic_cervix_lbc']))?$sysPelvicCervixLbc= $input['sys_pelvic_cervix_lbc']:$sysPelvicCervixLbc ="";
	    	(!empty($input['sys_pelvic_cervix_lbc_other']))?$sysPelvicCervixLbcOther= $input['sys_pelvic_cervix_lbc_other']:$sysPelvicCervixLbcOther ="";
	    	(!empty($input['sys_pelvic_avaf']))?$sysPelvicAvaf= $input['sys_pelvic_avaf']:$sysPelvicAvaf ="";
	    	(!empty($input['sys_pelvic_rvrf']))?$sysPelvicRvrf= $input['sys_pelvic_rvrf']:$sysPelvicRvrf ="";
	    	(!empty($input['sys_pelvic_other']))?$sysPelvicOther= $input['sys_pelvic_other']:$sysPelvicOther ="";
	    	
	    	

	    	if(!empty($systemicExamExist)){
	    		//echo "update";
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
				    											->where('diag_reference','=',$referenceId)
				    											->update($systemicUpdateData);

				    	if($systemicUpdate){
	    					array_push($responseFlag,1);
	    				}

		    	}
	    	}
	    	else{
	    		//echo "insert";
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

		    		if($systemicSave){
	    				array_push($responseFlag,2);
	    			}

		    	}
		    }	
	    	
	    	if(in_array(1, $responseFlag)){
	    		return Redirect::to('patientexamination')->with(array('success'=>"Data updated successfully"));
	    	}
	    	elseif (in_array(2, $responseFlag)) {
	    		return Redirect::to('patientexamination')->with(array('success'=>"Data saved successfully"));
	    	}
	    	else
	    	{
	    		return Redirect::to('patientexamination')->with(array('success'=>"Data saved successfully"));
	    	}
		    
	    	
        }
        else{
        	return Redirect::to('patientexamination')->with(array('error'=>"Please save patient personal information"));
        }

    	
    	
    }

    public function addPatientDiagnosis(){
    	
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
		    		return Redirect::to('patientdiagnosis')->with(array('error'=>"Failed to update data. Please fill the empty fields"));	
		    	}
		    	else{
		    		$diagUpdate = DB::table('diagnosis')
		    		                            ->where('id_patient','=',$patientId)
		    		                            ->where('diag_reference','=',$referenceId)
		    		                            ->update($diagData);
		    		
		    		if($diagUpdate){
		    			
		    			return Redirect::to('patientdiagnosis')->with(array('success'=>"Data updated successfully",'newSymptoms'=>$symptoms));	
		    		}
		    		else{
		    		//echo "dises nsss ok";
		    			return Redirect::to('patientdiagnosis')->with(array('error'=>"Failed to update data."));	
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
		    		return Redirect::to('patientdiagnosis')->with(array('error'=>"Failed to save data. Please fill the empty fields"));	
		    	}
		    	else{
		    		$diagSave = DB::table('diagnosis')->insert($diagData);
		    		if($diagSave){
		    			return Redirect::to('patientdiagnosis')->with(array('success'=>"Data saved successfully"));	
		    		}
		    		else{
		    		//echo "dises nsss ok";
		    			return Redirect::to('patientdiagnosis')->with(array('error'=>"Failed to save data."));	
		    		}
		    	}



	    	}		

        }
        else{
        	return Redirect::to('patientdiagnosis')->with(array('error'=>"Please save patient personal data "));	
        }	

    								

    	

    
    }
	
	public function addPatientPrescManagement(){
		$input = Request::all();
		$patientId = Session::get('patientId');
		$doctorId = Session::get('doctorId');
		$referenceId = Session::get('referenceId');
		$createdDate = date('Y-m-d');
		//var_dump($input);

		$patientExistCheck = DB::table('patients')->where('id_patient','=',$patientId)->count();

		if($patientExistCheck>0){

			$prescGynDataExist = DB::table('prescription_gynaecology')
    											->where('id_patient','=',$patientId)
			    								->where('created_date','=',$createdDate)
			    								->where('presc_gyn_reference','=',$referenceId)
			    								->get();

			(!empty($input['presc_line_of_treatment']))?$prescLineOfTreatment= $input['presc_line_of_treatment']:$prescLineOfTreatment ="";
			(!empty($input['presc_line_of_treatment_other']))?$prescLineOfTreatmentOther= $input['presc_line_of_treatment_other']:$prescLineOfTreatmentOther ="";
			(!empty($input['presc_general_exercise']))?$prescGeneralExercise= $input['presc_general_exercise']:$prescGeneralExercise ="";
			(!empty($input['presc_exercise_other']))?$prescGeneralExerciseOther= $input['presc_exercise_other']:$prescGeneralExerciseOther ="";
			(!empty($input['presc_diet']))?$prescDiet= $input['presc_diet']:$prescDiet =[""];
			(!empty($input['presc_diet_other']))?$prescDietOther= $input['presc_diet_other']:$prescDietOther ="";
			(!empty($input['exercise']))?$exercise= $input['exercise']:$exercise ="";

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
					return Redirect::to('patientprescmanagement')->with(array('success'=>'Data updated successfully'));
				}
				else{
					return Redirect::to('patientprescmanagement')->with(array('error'=>"No data for update"));
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
					return Redirect::to('patientprescmanagement')->with(array('success'=>'Data saved successfully'));

				}
				else{
					return Redirect::to('patientprescmanagement')->with(array('error'=>"Failed to save data"));
				}

			}

			/*return Redirect::to('patientprescmanagement')->with(array('success'=>'Data saved successfully'));*/
		}
		else{
			return Redirect::to('patientpersonalinformation')->with(array('error'=>'Please save patient personal information'));
		}
	}




	public function addPatientPrescMedicine(){
    	$input = Request::all();
    	$patientId 		= Session::get('patientId');
    	$doctorId 		= Session::get('doctorId');
    	$referenceId 	= Session::get('referenceId');
    	$createdDate 	= date('Y-m-d H:i:s');
		$defaultCount 	= $input['default-div-count'];
    	$extraCount   	= $input['prev-drug-count'];
		//dd("extra : ".$extraCount."=="."Default :".$defaultCount);

		
		$patientExistCheck = PatientsModel::where('id_patient','=',$patientId)->first();
		$prescExist = PrescriptionModel::where('id_patient','=',$patientId)->where('presc_ref_id','=',$referenceId)->get();
		
		

    	$idSharePrescription = DBUtils:: id_share_prescription(6);


    	
    	
    	$flagArray 		= array();
    	$printData 	  	= $input['print-data'];
    	
    	
    	

    	$insertValue = array();
    	$multi = array();	
    	
    	

    	
    			if(!empty($patientExistCheck)){
    		
    				for($i=1;$i<=$defaultCount;$i++){
    					//echo "Enter into loop";

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
			    		(isset($input["treatment"]))?$treatment   =  $input["treatment"]:$treatment   =  "";
			    		

			    		if(	!empty($drugName)){
			    			//echo "Enter into not empty drugname";

			    			$insertValue = array(	'drug_name'		 	=> $drugName,
			    									'dosage' 			=> $dosage,
			    									'dosage_unit' 		=> $dosageUnit,
			    									'duration' 			=> $duration,
			    									'duration_unit' 	=> $durationUnit,
			    									'morning' 			=> $morning,
			    									'noon' 				=> $noon,
			    									'night' 			=> $night,
			    									'start_date' 		=>$startDate,
			    									'instruction' 		=> $instruction,
			    									'food_status' 		=> $foodStatus,
			    									'follow_up_date' 	=> $followUpDate,
			    									'treatment' 		=> $treatment,
			    									'id_patient' 		=> $patientId,
			    									'id_doctor' 		=>$doctorId,
			    									'id_share_prescription' 	=> $idSharePrescription,
			    									'presc_ref_id' 		=>$referenceId,
			    									'created_date' 		=> $createdDate
			    									);
			    			//var_dump($insertValue);
			    			array_push($multi,$insertValue);
			    			array_push($flagArray ,1);
			    		}
			    		else{
			    			array_push($flagArray ,0);

			    		}

			    	}

			    	if(count($prescExist)>0){
			    		$prescExistDataDelete = PrescriptionModel::where('id_patient','=',$patientId)->where('presc_ref_id','=',$referenceId)->delete();

			    		if($prescExistDataDelete){
			    			if(in_array(1, $flagArray)){
			    				 PrescriptionModel::insert($multi);
			    				return Redirect::to('patientprescmedicine')->with(array('success'=>'Data updated successfully'));
			    			}
			    		}
			    	}
			    	else{
			    		if(in_array(1, $flagArray)){
			    				$prescSave = PrescriptionModel::insert($multi);
			    				if($prescSave){
			    					return Redirect::to('patientprescmedicine')->with(array('success'=>'Data saved successfully'));
			    				}
			    		}
			    	}
			    	


			    	/*if($printData=="printTrue"){
			    		if(in_array(1, $flagArray)){
				    		if($defaultCount>$extraCount){
				    			
				    			$prescriptionSave = DB::table('prescription')->insert($multi);
				    			//var_dump($prescriptionSave);
				    			$pdfFileName = $this->patientPrescPrint();
				    			//echo $pdfFileName;
				    			$prescSharedId = $idSharePrescription;
				    			$dataArray = array('pdfFileName'=>$pdfFileName,'prescSharedId'=>$prescSharedId);
				    			return $dataArray;
				    			//return '1';
				    		}
				    		else{
				    			//echo "Default<extra";
				    			$pdfFileName = $this->patientPrescPrint();
				    			$prescSharedId = $idSharePrescription;
				    			$dataArray = array('pdfFileName'=>$pdfFileName,'prescSharedId'=>$prescSharedId);
				    			return $dataArray;
				    		}
			    		
			    		
				    	}
				    	else{
				    		return Redirect::to('patientprescmedicine')->with(array('error'=>'Failed to save data'));
				    		//return "failed";
				    	}
			    	}
			    	else{
			    		if(in_array(1, $flagArray)){

				    		$prescriptionSave = DB::table('prescription')->insert($multi);
				    		if($prescriptionSave){
				    			//echo "Saved";
				    			return Redirect::to('patientprescmedicine')->with(array('success'=>'Data saved successfully'));
				    		}
				    		else{
				    			//echo "Not Saved";
				    			return Redirect::to('patientprescmedicine')->with(array('error'=>'Failed to save data'));
				    		}
				    	}
				    	else{
				    		//echo "Failed Save";
				    		return Redirect::to('patientprescmedicine')->with(array('error'=>'Failed to save data'));
				    	}

			    	}*/
			    

			    	

			    	
		    	}
		    	else{
		    		//$status = array('status'=>"Error",'message'=>'Invalid patient ID');
			    	//$result = $status;
			    	return Redirect::to('patientpersonalinformation')->with(array('error'=>'Please save patient personal information'));
			    	//return response()->json($result);	
		    	}
		    	
    	


    }

   

	public function patientPrescPrint(){
	
		//echo "Reached print data";

		$specialization = Session::get('doctorSpecialization');;
		$patientId 		= Session::get('patientId');
		$doctorId 		= Session::get('doctorId');

		$todayDate 		= date('Y-m-d');
		$splitDate 		= explode('-',$todayDate);

		$pdfFileName 	= $patientId."_".$splitDate[0].$splitDate[1].$splitDate[2];

		

		$doctorPersonalData  = DB::table('doctors As d')
                                            ->leftJoin('specialization As s','d.specialization','=','s.id_specialization')
		                                     ->where('d.id_doctor','=',$doctorId)->first();
		
		$patientPersonalData = DB::table('patients')
		                                   ->where('patients.id_patient','=',$patientId)->first();
		            
		$vitalsData = DB::table('vitals')
		                            ->where('id_vitals', DB::raw("(select max(`id_vitals`) from vitals where id_patient='$patientId')"))
		                            ->where('id_patient','=',$patientId)
		                            ->first();

		$diagnosisData = DB::table('diagnosis')
		                            ->where('id_diagnosis', DB::raw("(select max(`id_diagnosis`) from diagnosis where id_patient='$patientId')"))
		                            ->where('id_patient','=',$patientId)
		                            ->first();

		$prescriptionData    = DB::table('prescription')
											->where('created_date', DB::raw("(select max(`created_date`) from prescription where id_patient='$patientId')"))
		                            ->where('id_patient','=',$patientId)
		                            ->get();

		$medicalHistoryData =  DB::table('medical_history_present_past_more')
									->where('id_patient','=',$patientId)
		                            ->get();

		$mHistory = DB::table('medical_history_present_past_more')
									
		                            ->get();
		/*$medicalHistoryData =  MedicalHistoryModel::
									where('id_patient','=',$patientId)
		                            ->get();*/

		$printData = DB::table('print_settings')->where('id_doctor','=',$doctorId)->first();

		   

		$parametersArray = array('doctorPersonalData'=>$doctorPersonalData,
								 'patientPersonalData'=>$patientPersonalData,
								 'vitalsData'=>$vitalsData,
								 'diagnosisData'=>$diagnosisData,
								 'prescriptionData'=>$prescriptionData,
								 'medicalHistoryData'=>$medicalHistoryData,
								 'printData'=>$printData,
								 'mHistory'=>$mHistory);

		//var_dump($printData);

		switch ($specialization) {
			case '1':
				$pdf = App::make('dompdf.wrapper');
		        //$pdf->loadHTML('<h1>Test</h1>');
		        $view =  View::make('gynprecriptionformat',$parametersArray)->render();

		       
		        
		        $pdf->loadHTML($view)->setWarnings(false)->save('storage/pdf/'.$pdfFileName.'.'.'pdf');

		        // add the header
				
				

		        return $pdfFileName;
		        
		    	//return $pdf->stream($pdfFileName.'.'.'pdf');
		    	//return $pdf->inline();
				break;

			case '2':
				$pdf = App::make('dompdf.wrapper');
		        //$pdf->loadHTML('<h1>Test</h1>');
		        $view =  View::make('gynprecriptionformat',$parametersArray)->render();
		         $pdf->loadHTML($view)->save('storage/pdf/'.$pdfFileName.'.'.'pdf');

		        return $pdfFileName;
		        
		    	//return $pdf->stream($pdfFileName.'.'.'pdf');
		    	//return $pdf->inline();
				break;
			
			default:
				# code...
				break;
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

								DB::table('sp_gynaecology_obs_preg')->insert($pregData);
								
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

							DB::table('prescription')->insert($insertValue);
							
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
