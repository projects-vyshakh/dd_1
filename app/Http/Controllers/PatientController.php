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
use Carbon\Carbon;
//use Illuminate\Support\Collection::sortBy();

class PatientController extends Controller {

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

	public function showPatientProfileManagement(){
		$patientId = Session::get('id_patient');


		if(!empty($patientId)){
			$gender = DB::table('business_key_details')->where('business_key', '=', 'GENDER')->lists('business_value', 'business_value');
		
			$maritialStatus = DB::table('business_key_details')->where('business_key', '=', 'MARITIAL_STATUS')->lists('business_value', 'business_value');
			
			$country =  DB::table('countries')->select('country_name','sortname','id')->orderBy('country_name', 'asc')->lists('country_name', 'id'); 	
			
			$state =  DB::table('states')->select('id','state_name','country_id')->orderBy('state_name', 'asc')->lists('state_name', 'state_name'); 	
			
			$city =  DB::table('cities')->select('city_name','state_id')->orderBy('city_name', 'asc')->lists('city_name', 'city_name'); 	
			$doctors = DB::table('doctors')->where('status','=',1)->orderBy('first_name','asc')->get();


			//$prevTreatment = DB::table('')

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


			    $patientId = Session::get('id_patient');  		
			    $patientData = DB::table('patients')
			    						->leftJoin('countries','patients.country','=','countries.id')
			    						->where('id_patient','=',"$patientId")->first();

			    $treatmentHistory = DB::table('prescription As p')
			    								->leftJoin('doctors As d','p.id_doctor','=','d.id_doctor')
			    								->select(DB::Raw('p.*,d.*,p.created_date As pCreatedDate'))
												->where('p.created_date', DB::raw("(select max(`created_date`) from 						prescription where id_patient='$patientId')"))
												->where('p.id_patient','=',$patientId)
												->get();
												//var_dump(json_encode($treatmentHistory));
												//die();
			//Log::info("Patientdata",array($patientData));

				$doctorDetails = DB::table('prescription As p')
												->leftJoin('doctors As d','p.id_doctor','=','d.id_doctor')
												->leftJoin('specialization As s','s.id_specialization','=','d.specialization')
												->distinct()
												->select(DB::Raw('p.*,d.*,s.*,p.created_date As pCreatedDate'))
												->where('p.created_date', DB::raw("(select max(`created_date`) from 						prescription where id_patient='$patientId')"))
												->where('p.id_patient','=',$patientId)

												->groupBy('d.id_doctor')

												->get();
											

			return view('patientprofilemanagement',array('gender' => $gender,'maritialStatus'=>$maritialStatus,'country' => $country, 'state' => $state, 'city' => $city,'patientId'=>$patientId, 'patientData'=>$patientData,'doctors'=>$doctors,'treatmentHistory'=>$treatmentHistory,'doctorDetails'=>$doctorDetails));
		}
		else{
			return Redirect::to('patientlogin');
		}
		
	}

	public function showPatientProfilePrevTreatment(){


		$patientId = Session::get('id_patient');
			
		$doctorId = Session::get('doctorId');
		$patientPersonalData 	= DB::table('patients')->where('id_patient','=',$patientId)->first();
		$doctorData 	= DB::table('doctors')->where('id_doctor','=',$doctorId)->first();

		
		return view('patientprofileprevtreatment',array('patientPersonalData'=>$patientPersonalData,'doctorData'=>$doctorData));
	}	

	public function patientProfilePreviousTreatmentExtended(){
		$year = Input::get('year');
		
		//$year = $input['year'];
		$patientId = Session::get('id_patient');
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
											
											
		$lmpData = DB::table('sp_gynaecology_obs_lmp')
											->whereIn('created_date', $originalCreatedDate)
											->where('created_date','LIKE','%'.$year.'%')
											->where('id_patient','=',$patientId)
											->get();	

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

									
		return array('obsData' => $obsData,'lmpData' => $lmpData,'pregData' => $pregData,'vitalsData'=>$vitalsData,'originalCreatedDate'=>$originalCreatedDate,'bloodGroup'=>$bloodGroup,'diagnosisData'=>$diagnosisData,'diseases'=>$diseases,'prescMedicineData'=>$prescMedicineData,'drugFrequency'=>$drugFrequency,'originalCreatedDateDup'=>$originalCreatedDateDup,'symptoms'=>$symptoms,'patientPersonalData'=>$patientPersonalData,'doctorData'=>$doctorData,'dosageUnit'=>$dosageUnit,'drugDurationUnit'=>$drugDurationUnit);
		//die();

		//return view('patientprevioustreatment',array('obsData' => $obsData,'lmpData' => $lmpData,'pregData' => $pregData,'vitalsData'=>$vitalsData,'originalCreatedDate'=>$originalCreatedDate,'bloodGroup'=>$bloodGroup,'diagnosisData'=>$diagnosisData,'diseases'=>$diseases,'prescMedicineData'=>$prescMedicineData,'drugFrequency'=>$drugFrequency,'originalCreatedDateDup'=>$originalCreatedDateDup,'symptoms'=>$symptoms,'patientPersonalData'=>$patientPersonalData,'doctorData'=>$doctorData,'dosageUnit'=>$dosageUnit,'drugDurationUnit'=>$drugDurationUnit));
	}


	public function showPatientProfileEdit(){
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


		    $patientId = Session::get('id_patient');  		
		    $patientData = DB::table('patients')
		    						 ->where('id_patient','=',$patientId)->first();
		//Log::info("Patientdata",array($patientData));

		return view('patientprofileedit',array('gender' => $gender,'maritialStatus'=>$maritialStatus,'country' => $country, 'state' => $state, 'city' => $city,'patientId'=>$patientId, 'patientData'=>$patientData));
	}

	public function patientProfileEdit(){
		$input 		= Request::all();
		$patientId 	= Session::get('id_patient');
		
		//var_dump($input);
		//die();

		$patientExistCheck = DB::table('patients')->where('id_patient','=',$patientId)->first();
		$doctorId = $patientExistCheck->id_doctor;
		$patientExistCheck = count($patientExistCheck);
		

		

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
									'house_name' 		=> 	$house,
									'street' 			=> 	$street,
									'city' 				=> 	$city,
									'state'   			=> 	$state,
									'pincode'	 		=> 	$pincode,
									'country' 			=> 	$country,
									'phone' 			=> 	$phone,
									'email' 			=> 	$email,
									'id_doctor' 		=> 	$doctorId,
									'edited_date' 		=> $editedDate);



		 			$patientPersonalInfoUpdate = DB::table('patients')->where('id_patient','=',$patientId)->update($inputValue);

		 			if($patientPersonalInfoUpdate){
		 				return Redirect::to('patientprofileedit')->with(array('success'=>"Data updated successfully"));	
		 			}
		 			else{
		 				return Redirect::to('patientprofileedit')->with(array('error'=>"No changes to update"));
		 			}
			}
			else{
				
				return Redirect::to('patientprofileedit')->with(array('error'=>'Failed to update'));
			}

		}
		

	}
	


}
