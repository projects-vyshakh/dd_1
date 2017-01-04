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
use App\Models\PediaPatientsModel;
use App\Models\PatientsModel;
use App\Models\CardioMedicalHistoryPresentPastModel;
use App\Models\SurgeryHistoryModel;
use App\Models\DrugAllergyHistoryModel;

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
			return Redirect::to('logout');
		}
		else{
			$gender = DB::table('business_key_details')->where('business_key', '=', 'GENDER')->orderBy('business_value')->lists('business_value', 'business_value');
		
			$maritialStatus = DB::table('business_key_details')->where('business_key', '=', 'MARITIAL_STATUS')->lists('business_value', 'business_value');
			
			$country =  DB::table('countries')->select('country_name','sortname','id')->orderBy('country_name', 'asc')->lists('country_name', 'id'); 	

			$doctorsList = DB::table('doctors')->select('first_name','last_name','id_doctor')->orderBy('first_name', 'asc')->lists('first_name', 'id_doctor'); 	
			
			
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
			   

			    $patientId = Session::get('patientId');  		
			    $patientData = DB::table('patients')
			    						 ->where('id_patient','=',$patientId)->get();

			    $doctorData = DB::table('doctors')
			    						 ->where('id_doctor','=',$doctorId)->first();
			    						 
			//Log::info("Patientdata",array($patientData));

			return view('pediapatientpersonalinformation',array('gender' => $gender,'maritialStatus'=>$maritialStatus,'country' => $country,  'city' => $city,'patientId'=>$patientId, 'patientData'=>$patientData,'doctorData'=>$doctorData,'doctorsList'=>$doctorsList));
		}
		
	}

	function addPediaPersonalInformation(){
		$input = Request::all();
		
		$patientId = Session::get('patientId');
		$doctorId  = Session::get('doctorId');
		$referenceId = Session::get('referenceId');
		$patientExist = PatientsModel::where('id_patient','=',$patientId)->first();
		$createdDate = date('Y-m-d H:i:s');							  
		
		//echo $referenceId;
		if(!empty($doctorId)){

			if(count($patientExist)>0){
				echo "PatientExist";
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
											   'phone'                  =>$input['stud_mobile'],
											   'edited_date'            =>$createdDate
											   );
					$pediaPersonalInformation = DB::table('patients')
													->where('id_patient','=',$patientId)
													->update($pediaPersonalData);

					if($pediaPersonalInformation){
						return Redirect::to('pediapersonalinformation')->with(array('success'=>'Data updated successfully'));
					}
					
				}
				
					
				
			}
			else{
				
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
											   'phone'=>$input['stud_mobile'],
											   'created_date'=>$createdDate

											   );

					$pediaPersonalInformation = PatientsModel::insert($pediaPersonalData);
					
					if($pediaPersonalInformation){

						return Redirect::to('pediapersonalinformation')->with(array('success'=>'Data saved successfully'));
					}
					
			}
		}
		else{
			return Redirect::to('doctorlogin');
		}
	}
}
