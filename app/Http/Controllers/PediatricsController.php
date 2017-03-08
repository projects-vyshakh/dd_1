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
use App\Models\VitalsModel;
use App\Models\PediatricExaminationModel;

class PediatricsController extends Controller {

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
		
		
	}

	//Cardio
	//-------------------------------------------------------------------

	public function showPediaPersonalInformation(){

		$patientId = Session::get('patientId');
		$doctorId  = Session::get('doctorId');
		
		if(empty($doctorId)){
			//header('location:doctorlogin');
			return Redirect::to('doctor/logout');
		}
		else{
			$gender = DB::table('business_key_details')->where('business_key', '=', 'GENDER')->orderBy('business_value')->lists('business_value', 'business_value');
		
			$maritialStatus = DB::table('business_key_details')->where('business_key', '=', 'MARITIAL_STATUS')->lists('business_value', 'business_value');
			
			$country =  DB::table('countries')->select('country_name','sortname','id')->orderBy('country_name', 'asc')->lists('country_name', 'id'); 	

			$doctorsList = DoctorsModel::select('first_name','last_name','id_doctor')->orderBy('first_name', 'asc')->lists('first_name', 'id_doctor'); 	
			
			
			/*$state =  DB::table('states')->select('id','state_name','country_id')->orderBy('state_name', 'asc')->lists('state_name', 'state_name'); 	*/
			
			$city =  DB::table('cities')->select('city_name','state_id')->orderBy('city_name', 'asc')->lists('city_name', 'city_name'); 	
			    	

			    if(in_array('', $gender)){
			     	 array_unshift($gender, '');
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

			    
			    $patientData 	= PatientsModel::where('id_patient','=',$patientId)->first();
			 	$doctorData 	= DoctorsModel::where('id_doctor','=',$doctorId)->first();
			    						 
			//Log::info("Patientdata",array($patientData));

			return view('pediapersonalinformation',array('gender' => $gender,'maritialStatus'=>$maritialStatus,'country' => $country,  'city' => $city,'patientId'=>$patientId, 'patientData'=>$patientData,'doctorData'=>$doctorData,'doctorsList'=>$doctorsList));
		}
		
	}

	function addPediaPersonalInformation(){
		$input = Request::all();
		
		$patientId 		= Session::get('patientId');
		$doctorId  		= Session::get('doctorId');
		$referenceId 	= Session::get('referenceId');
		$mobile 		=	$input['stud_mobile'];
		$patientExist 	= PatientsModel::where('id_patient','=',$patientId)->first();
		$createdDate 	= date('Y-m-d H:i:s');							  
		
		//echo $referenceId;
		if(!empty($doctorId)){

			if(count($patientExist)>0){
				//echo "PatientExist";
				if(!empty($input['school_name']) ||
				   !empty($input['school_address']) ||
				   !empty($input['first_name']) ||
				   !empty($input['last_name']) ||
				   !empty($input['stud_class'])     ||
				   !empty($input['stud_section'])   ||
				   !empty($input['stud_gender'])    ||
				   !empty($input['stud_dob'])       ||
				   !empty($input['stud_age'])       ||
				   !empty($input['stud_occupation'])||
				   !empty($input['stud_mobile']))
				{

					//echo "inside empty check";
					$pediaPersonalData = array('id_doctor'			    =>$doctorId,
											   'school_name'		    =>$input['school_name'],
											   'school_address'		    =>$input['school_address'],
											   'first_name'			    =>$input['first_name'],
											   'last_name'			    =>$input['last_name'],
											   'stud_class' 		    =>$input['stud_class'],
											   'stud_section'           =>$input['stud_section'],
											   'gender' 		        =>$input['stud_gender'],
											   'stud_dob'               =>$input['stud_dob'],
											   'age' 			        =>$input['stud_age'],
											   'stud_parent_occupation' =>$input['stud_occupation'],
											   'phone'                  =>$mobile,
											   'edited_date'            =>$createdDate
											   );
					$pediaPersonalInformation = PatientsModel::where('id_patient','=',$patientId)
						->update($pediaPersonalData);
					return Redirect::to('doctor/pediapersonalinformation')->with(array('success'=>'Data updated successfully'));

					/*if($pediaPersonalInformation){
						//echo "Saved pedia";
						
					}
					else{
						return Redirect::to('pediapersonalinformation')->with(array('error'=>''));
					}*/
				}
			}
			else{

				$otpGenerated 	 	= DBUtils::generate_otp(4);

				$message    =  "Welcome to Doctor's Diary!\nClick here "."-".
				"http://www.doctorsdiary.co/patient/signup.\nOTP for registration: Use ".$otpGenerated;

				$pediaPersonalData = array('id_patient' => $patientId,
											   'id_doctor'=>$doctorId,
											   'school_name'=>$input['school_name'],
											   'school_address'=>$input['school_address'],
											    'first_name'	=>$input['first_name'],
											   'last_name'	=>$input['last_name'],
											   'stud_class' => $input['stud_class'],
											   'stud_section'=>$input['stud_section'],
											   'gender' => $input['stud_gender'],
											   'stud_dob' => $input['stud_dob'],
											   'age' => $input['stud_age'],
											   'stud_parent_occupation' => $input['stud_occupation'],
											   'otp_generated' => $otpGenerated,
											   'phone'=>$mobile,
											   'created_date'=>$createdDate

											   );

					$pediaPersonalInformation = PatientsModel::insert($pediaPersonalData);
					
					if($pediaPersonalInformation){
						$otpSendToMobile 	= DBUtils::otpSendToMobile($mobile,$message,$otpGenerated);
						return Redirect::to('doctor/pediapersonalinformation')->with(array('success'=>'Data saved successfully'));
					}
					
			}
		}
		else{
			return Redirect::to('doctor/login');
		}
	}
	public function showPediaExamination(){
    	$patientId = Session::get('patientId');
    	$doctorId = Session::get('doctorId');

    	if(!empty($doctorId)){
			if(!empty($patientId)){
				$patientPersonalData  = PatientsModel::where('id_patient','=',$patientId)->first();

				$doctorData  = DoctorsModel::where('id_doctor','=',$doctorId)->first();

		        
				$bloodGroup = DB::table('business_key_details')->where('business_key', '=', 'BLOOD_GROUP')->lists('business_value', 'business_value');

				$vitalExist = VitalsModel::where('id_patient','=',$patientId)
							->where('id_vitals', DB::raw("(select max(`id_vitals`) from vitals where id_patient = '$patientId')"))
							->first();

				$pediatricExamData = PediatricExaminationModel::where('id_patient','=',$patientId)
								->where('id_pediatric_examination', DB::raw("(select max(`id_pediatric_examination`) from pediatric_examination where id_patient='$patientId')"))
								->first();

				
				if(!in_array('', $bloodGroup)){
				     	 array_unshift($bloodGroup, '');
				}
				
				return view('pediaexamination',array('bloodGroup'=>$bloodGroup,'vitalExist'=>$vitalExist,'patientPersonalData'=>$patientPersonalData,'doctorData'=>$doctorData,'pediatricExamData'=>$pediatricExamData));
			}
			else{
				return Redirect::to('doctor/home')->with(array('error'=>"You are not authorised to view the page"));
			}
		}
		else{
			return Redirect::to('doctor/logout');
		}
    }
     public function addPediaExamination(){
    	$input = Request::all();
    	//var_dump($input);

    	$patientId 		= Session::get('patientId');
    	$doctorId 		= Session::get('doctorId');
    	$referenceId 	= Session::get('referenceId');
    	$createdDate 	= date('Y-m-d H:i:s');
    	$responseFlag  = array();
    	//Vitals Insert and Update
    	$vitalExist = VitalsModel::where('id_patient','=',$patientId)
    				->where('vitals_reference','=',$referenceId)
    				->first();
    //var_dump($vitalExist);

    	$pediatricExamData = PediatricExaminationModel::where('id_patient','=',$patientId)
	    			->where('pediatric_reference','=',$referenceId)
	    			->first();

    	$patientExistCheck 	= PatientsModel::where('id_patient','=',$patientId)->count();

    	if($patientExistCheck>0){
		//echo "PatientExist";
    		//Vitals Data
        	(!empty($input['weight']))?$weight = $input['weight']:$weight="";

	    	(!empty($input['height']))?$height = $input['height']:$height="";
	    	
	    	(!empty($input['heartrate']))?$heartRate = $input['heartrate']:$heartRate="";

	    	(!empty($input['respiratory_rate']))?$respiratoryRate = $input['respiratory_rate']:$respiratoryRate="";

	    	(!empty($input['temperature']))?$temperature = $input['temperature']:$temperature="";

	    	(!empty($input['pallor']))?$pallor = $input['pallor']:$pallor="";

	    	(!empty($input['clubbing']))?$clubbing = $input['clubbing']:$clubbing="";

	    	(!empty($input['vaccination_history']))?$vaccination_history = $input['vaccination_history']:$vaccination_history="";

	    	(!empty($input['significant_history']))?$significant_history = $input['significant_history']:$significant_history="";

	    	if(!empty($vitalExist)){
	    	//	echo "invital exist";
		    		$vitalsData = array('weight' => $weight,
			    						'height' => $height,
			    						'heart_rate' => $heartRate,
			    						'respiratoryrate' => $respiratoryRate,
			    						'temperature' => $temperature,
			    						'pallor' => $pallor,
			    						'clubbing'=> $clubbing,
			    						'vaccination_history' => $vaccination_history,
			    						'significant_history' =>$significant_history,
			    						'edited_date' => $createdDate);

	    				$vitalsUpdate = VitalsModel::where('id_patient','=',$patientId)
	    								->where('id_doctor','=',$doctorId)
	    								->where('vitals_reference','=',$referenceId)
	    								->update($vitalsData);

	    				if($vitalsUpdate){
	    					array_push($responseFlag,1);
	    				}
	    	}
	    	else{
		    		$vitalsData = array('weight' => $weight,
		    							'height' => $height,
			    						'heart_rate' => $heartRate,
			    						'respiratoryrate' => $respiratoryRate,
			    						'temperature' => $temperature,
			    						'pallor' => $pallor,
			    						'clubbing'=> $clubbing,
			    						'vaccination_history' => $vaccination_history,
			    						'significant_history' =>$significant_history,
			    						'id_patient' => $patientId,
			    						'id_doctor'=>$doctorId,
			    						'vitals_reference'=>$referenceId,
			    						'created_date' => $createdDate);
		    		$vitalsSave = VitalsModel::insert($vitalsData);
		    		if($vitalsSave){
	    					array_push($responseFlag,2);
	    			}
	    	}
	    	//-------------------------------------------------------------------------------------------------

	    	//Pedia examination

	    	/*(!empty($input['skin_lice']))?$skin_lice = $input['skin_lice']:$skin_lice="";
	    	(!empty($input['skin_scabies']))?$skin_scabies = $input['skin_scabies']:$skin_scabies="";
	    	(!empty($input['skin_spots']))?$skin_spots = $input['skin_spots']:$skin_spots="";
	    	(!empty($input['skin_eczema']))?$skin_eczema = $input['skin_eczema']:$skin_eczema="";
	    	(!empty($input['skin_allergy']))?$skin_allergy = $input['skin_allergy']:$skin_allergy="";*/
	    	(!empty($input['skin_remarks']))?$skin_remarks = $input['skin_remarks']:$skin_remarks="";
	    	(!empty($input['ent_remarks']))?$ent_remarks = $input['ent_remarks']:$ent_remarks="";
	    	(!empty($input['eye_remarks']))?$eye_remarks = $input['eye_remarks']:$eye_remarks="";
	    	(!empty($input['dental_extraoral']))?$dental_extraoral = $input['dental_extraoral']:$dental_extraoral="";
	    	(!empty($input['dental_intraoral']))?$dental_intraoral = $input['dental_intraoral']:$dental_intraoral="";
	    	(!empty($input['dental_toothcavity']))?$dental_toothcavity = $input['dental_toothcavity']:$dental_toothcavity="";
	    	(!empty($input['dental_gum_inflammattion']))?$dental_gum_inflammattion = $input['dental_gum_inflammattion']:$dental_gum_inflammattion="";
	    	(!empty($input['dental_calculus']))?$dental_calculus = $input['dental_calculus']:$dental_calculus="";
	    	(!empty($input['dental_stains']))?$dental_stains = $input['dental_stains']:$dental_stains="";
	    	(!empty($input['dental_tartar']))?$dental_tartar = $input['dental_tartar']:$dental_tartar="";
	    	(!empty($input['dental_bad_breath']))?$dental_bad_breath = $input['dental_bad_breath']:$dental_bad_breath="";
	    	(!empty($input['dental_gum_bleeding']))?$dental_gum_bleeding = $input['dental_gum_bleeding']:$dental_gum_bleeding="";
	    	(!empty($input['dental_plaque']))?$dental_plaque = $input['dental_plaque']:$dental_plaque="";
	    	(!empty($input['upperleft']))?$upperleft = $input['upperleft']:$upperleft=[""];
	    	(!empty($input['upperright']))?$upperright = $input['upperright']:$upperright=[""];
	    	(!empty($input['lowerleft']))?$lowerleft = $input['lowerleft']:$lowerleft=[""];
	    	(!empty($input['lowerright']))?$lowerright = $input['lowerright']:$lowerright=[""];
	    	(!empty($input['dental_tongue']))?$dental_tongue = $input['dental_tongue']:$dental_tongue="";
	    	(!empty($input['dental_remarks']))?$dental_remarks = $input['dental_remarks']:$dental_remarks="";
	    	(!empty($input['systemic_examination_tongue']))?$systemic_examination_tongue = $input['systemic_examination_tongue']:$systemic_examination_tongue="";
	    	(!empty($input['systemic_examination_chest']))?$systemic_examination_chest = $input['systemic_examination_chest']:$systemic_examination_chest="";
	    	(!empty($input['systemic_examination_pa']))?$systemic_examination_pa = $input['systemic_examination_pa']:$systemic_examination_pa="";	

    		$upperleft = array_filter($upperleft);
	    	$upperright = array_filter($upperright);
	    	$lowerleft = array_filter($lowerleft);
	    	$lowerright = array_filter($lowerright);

	    if(!empty($pediatricExamData)){
	    		$pediatricExam = array(/*'skin_lice'=>$skin_lice,
	    			'skin_scabies'=>$skin_scabies,
	    			'skin_spots_and_molluscum'=>$skin_spots,
	    			'skin_eczema'=>$skin_eczema,
	    			'skin_allergy'=>$skin_allergy,*/
	    			'skin_remarks'=>$skin_remarks,
	    			'ent_remarks'=>$ent_remarks,
	    			'eye_remarks'=>$eye_remarks,
	    			'dental_extra_oral'=>$dental_extraoral,
	    			'dental_intra_oral'=>$dental_intraoral,
	    			'dental_tooth_cavity'=>$dental_toothcavity,
	    			'dental_gum_inflammattion'=>$dental_gum_inflammattion,
	    			'dental_calculus'=>$dental_calculus,
	    			'dental_stains'=>$dental_stains,
	    			'dental_tartar'=>$dental_tartar,
	    			'dental_bad_breath'=>$dental_bad_breath,
	    			'dental_gum_bleeding'=>$dental_gum_bleeding,
	    			'dental_plaque'=>$dental_plaque,
	    			'dental_upper_left'=>json_encode($upperleft),
	    			'dental_upper_right'=>json_encode($upperright),
	    			'dental_lower_left'=>json_encode($lowerleft),
	    			'dental_lower_right'=>json_encode($lowerright),
	    			'dental_tongue'=>$dental_tongue,
	    			'dental_remarks'=>$dental_remarks,
	    			'systemic_tongue'=>$systemic_examination_tongue,
	    			'systemic_chest'=>$systemic_examination_chest,
	    			'systemic_pa'=>$systemic_examination_pa,
	    			'id_doctor'=>$doctorId,
	    			'edited_date'=>$createdDate);

	    		$pediatricExamUpdate = PediatricExaminationModel::
	    						where('id_patient','=',$patientId)
	    						->where('pediatric_reference','=',$referenceId)
	    						->update($pediatricExam);

	    			if($pediatricExamUpdate){
	    					array_push($responseFlag,1);
	    			}
	    		}
	    	else{
	    		$pediatricExam = array(/*'skin_lice'=>$skin_lice,
	    								'skin_scabies'=>$skin_scabies,
	    								'skin_spots_and_molluscum'=>$skin_spots,
	    								'skin_eczema'=>$skin_eczema,
	    								'skin_allergy'=>$skin_allergy,*/
	    								'skin_remarks'=>$skin_remarks,
	    								'ent_remarks'=>$ent_remarks,
	    								'eye_remarks'=>$eye_remarks,
	    								'dental_extra_oral'=>$dental_extraoral,
	    								'dental_intra_oral'=>$dental_intraoral,
	    								'dental_tooth_cavity'=>$dental_toothcavity,
	    								'dental_gum_inflammattion'=>$dental_gum_inflammattion,
	    								'dental_calculus'=>$dental_calculus,
	    								'dental_stains'=>$dental_stains,
	    								'dental_tartar'=>$dental_tartar,
	    								 'dental_bad_breath'=>$dental_bad_breath,
	    								'dental_gum_bleeding'=>$dental_gum_bleeding,
	    								'dental_plaque'=>$dental_plaque,
	    								'dental_upper_left'=>json_encode($upperleft),
	    								'dental_upper_right'=>json_encode($upperright),
	    								'dental_lower_left'=>json_encode($lowerleft),
	    								'dental_lower_right'=>json_encode($lowerright),
	    								'dental_tongue'=>$dental_tongue,
	    								'dental_remarks'=>$dental_remarks,
	    								'systemic_tongue'=>$systemic_examination_tongue,
	    								'systemic_chest'=>$systemic_examination_chest,
	    								'systemic_pa'=>$systemic_examination_pa,
	    								'id_doctor'=>$doctorId,
	    								'id_patient'=>$patientId,
	    								'pediatric_reference'=>$referenceId,
	    								'created_date'=>$createdDate);

	    			$pediatricExamSave = PediatricExaminationModel::insert($pediatricExam);
	    			if($pediatricExamSave){
	    					array_push($responseFlag,2);
	    			}	
	    		}
	    	//-----------------------------------------------------------------------------------------------

	    	if(in_array(1, $responseFlag)){
	    		return Redirect::to('doctor/pediaexamination')->with(array('success'=>"Data updated successfully"));
	    	}
	    	elseif (in_array(2, $responseFlag)) {
	    		return Redirect::to('doctor/pediaexamination')->with(array('success'=>"Data saved successfully"));
	    	}
	    	else
	    	{
	    		return Redirect::to('pediaexamination')->with(array('success'=>"Data saved successfully"));
	    	}
	    }
	    else{	
			return Redirect::to('doctor/pediapersonalinformation')->with(array('error'=>'Please save patient personal information'));
			    	
		}
	}

}
