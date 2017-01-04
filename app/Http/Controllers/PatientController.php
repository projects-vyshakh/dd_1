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


//Models
use App\Models\PatientsModel;
use App\Models\DoctorsModel;
use App\Models\MedicalHistoryModel;
use App\Models\MedicalHistoryPresentPastModel;
use App\Models\SurgeryHistoryModel;
use App\Models\DrugAllergyHistoryModel;
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

			   /* $treatmentHistory = DB::table('prescription As p')
			    								->leftJoin('doctors As d','p.id_doctor','=','d.id_doctor')
			    								->select(DB::Raw('p.*,d.*,p.created_date As pCreatedDate'))
												->where('p.created_date', DB::raw("(select max(`created_date`) from prescription where id_patient='$patientId')"))
												->where('p.id_patient','=',$patientId)

												->get();*/

				
												
				$treatmentHistory = DB::table('doctors As d')
												->leftJoin('prescription As p','d.id_doctor','=','p.id_doctor')
												->leftJoin('specialization As s','s.id_specialization','=','d.specialization')
												->orderBy('p.follow_up_date','DESC')
												->where('p.id_patient','=',$patientId)
												
												->get();								
												
			//Log::info("Patientdata",array($patientData));

				$doctorDetails = DB::table('prescription As p')
												->leftJoin('doctors As d','p.id_doctor','=','d.id_doctor')
												->leftJoin('specialization As s','s.id_specialization','=','d.specialization')
												->distinct()
												->select(DB::Raw('p.*,d.*,s.*,p.created_date As pCreatedDate'))
												/*->where('p.created_date', DB::raw("(select max(`created_date`) from prescription where id_patient='$patientId')"))*/
												->where('p.id_patient','=',$patientId)

												->groupBy('d.id_doctor')

												->get();
												
											//die();
											

			return view('patientprofilemanagement',array('gender' => $gender,'maritialStatus'=>$maritialStatus,'country' => $country, 'state' => $state, 'city' => $city,'patientId'=>$patientId, 'patientData'=>$patientData,'doctors'=>$doctors,'treatmentHistory'=>$treatmentHistory,'doctorDetails'=>$doctorDetails));
		}
		else{
			return Redirect::to('patientlogin');
		}
		
	}

	public function showPatientProfilePrevTreatment(){
		$patientId 	= Session::get('id_patient');
		$doctorId 	= Session::get('doctorId');
		
		
		

		if(!empty($patientId)){
			$patientPersonalData 	= DB::table('patients')->where('id_patient','=',$patientId)->first();
			$doctorData 	= DB::table('doctors')->where('id_doctor','=',$doctorId)->first();

		
			return view('patientprofileprevtreatment',array('patientPersonalData'=>$patientPersonalData,'doctorData'=>$doctorData,'patientData'=>$patientPersonalData));
		}
		else{
			return Redirect::to('patientlogin');
		}	
	}
		

	public function patientProfilePreviousTreatmentExtended(){
		$year = Input::get('year');
		
		//$year = $input['year'];
		$patientId 				= Session::get('id_patient');
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
											
											
		$lmpData = DB::table('sp_gynaecology_obs_lmp')
											->whereIn('created_date', $originalCreatedDate)
											->where('created_date','LIKE','%'.$year.'%')
											->where('id_patient','=',$patientId)
											//->where('id_doctor','=',$doctorId)
											->get();	

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

									
		return array('obsData' => $obsData,'lmpData' => $lmpData,'pregData' => $pregData,'vitalsData'=>$vitalsData,'originalCreatedDate'=>$originalCreatedDate,'bloodGroup'=>$bloodGroup,'diagnosisData'=>$diagnosisData,'diseases'=>$diseases,'prescMedicineData'=>$prescMedicineData,'drugFrequency'=>$drugFrequency,'originalCreatedDateDup'=>$originalCreatedDateDup,'symptoms'=>$symptoms,'patientPersonalData'=>$patientPersonalData,'doctorData'=>$doctorData,'dosageUnit'=>$dosageUnit,'drugDurationUnit'=>$drugDurationUnit);
	}


	public function showPatientProfileEdit(){
		$patientId = Session::get('id_patient');

		if(!empty($patientId)){
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
		else{
			return Redirect::to('patientlogin');
		}	
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
		(!empty($input['photo']))?$photo 					= $input['photo']:$photo = "";	
        
		
		if($patientExistCheck>0){
			//return Redirect::to('patientpersonalinformation')->
			//echo "existing patient";
		 	if(!empty($firstName) || !empty($lastName) || !empty($gender) || !empty($dob) || !empty($age) || 
           	   !empty($house) || !empty($street) || !empty($country) || !empty($state) || !empty($pincode) ||
           	   !empty($phone) || !empty($email) ){

           	   	$size    = 300;
				$dir =   'assets/images/patients/';
				$newdir= 'assets/images/patients/';

				$img = $this->photoUpload($patientId);

				if($img=="error"){
					return Redirect::to('patientprofileedit')->with(array('error'=>"Invalid file uploads"));
				}
				else{


				

           	   	$editedDate = date('Y-m-d');
           	   	if(!empty($img)){
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
									'profile_image_large' => $img,
									'edited_date' 		=> $editedDate);
           	   	}
           	   	else{
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
           	   	}
		 		



		 			$patientPersonalInfoUpdate = DB::table('patients')->where('id_patient','=',$patientId)->update($inputValue);

		 			if($patientPersonalInfoUpdate){
		 				return Redirect::to('patientprofileedit')->with(array('success'=>"Data updated successfully"));	
		 			}
		 			else{
		 				return Redirect::to('patientprofileedit')->with(array('error'=>"No changes to update"));
		 			}
		 		}	
			}
			else{
				
				return Redirect::to('patientprofileedit')->with(array('error'=>'Failed to update'));
			}

		}
		

	}

	public function photoUpload($patientId){
		$path = 'assets/images/patients/';
		$file_ext   = array('jpg','png','gif','bmp','JPG');
		$post_ext_split = explode('.',$_FILES['photo']['name']);
		$post_ext   = end($post_ext_split);
		$photo_name = $_FILES['photo']['name'];
		$photo_type = $_FILES['photo']['type'];
		$photo_size = $_FILES['photo']['size'];
		$photo_tmp  = $_FILES['photo']['tmp_name'];
		//echo $photo_tmp;
		$photo_error= $_FILES['photo']['error'];
		//move_uploaded_file($photo_tmp,"uploads/".$photo_name);
		if((($photo_type == 'image/jpeg') || ($photo_type == 'image/gif')   ||
		   ($photo_type == 'image/png') || ($photo_type == 'image/pjpeg')) &&
		   ($photo_size < 2000000) && in_array($post_ext,$file_ext)){
			if($photo_error > 0 ){
				//echo 'Error '.$photo_error;
				exit;
			}else{
				//echo $photo_name.' Uploaded !';
			}
			if(file_exists($path.$photo_name)){
				//echo 'There is '.$photo_name;
				return "photoexist";
			}else{
				//new photo name and encryption
				$new_name = explode('.',$photo_name);
				$photo_name = $patientId.'.'.$new_name[1];

				/*var_dump($new_name);
				echo $photo_tmp;
				echo $path.$photo_name;
				die();*/
				//move to directory
				if(move_uploaded_file($photo_tmp,$path.$photo_name)){

					return $photo_name;
				}
			}
		}
		else{
			//echo 'The uploaded file has invalid rules';
			if(!empty($photo_name)){
				return  "error";
			}
			
		}
	}

	/*public function resizejpeg($dir, $newdir, $img, $max_w, $max_h, $th_w, $th_h){
	    // set destination directory
	    if (!$newdir) $newdir = $dir;

	    // get original images width and height
	    list($or_w, $or_h, $or_t) = getimagesize($dir.$img);

	    // make sure image is a jpeg
	    if ($or_t == 2) {

	        // obtain the image's ratio
	        $ratio = ($or_h / $or_w);

	        // original image
	        $or_image = imagecreatefromjpeg($dir.$img);

	        // resize image?
	        if ($or_w > $max_w || $or_h > $max_h) {

	            // resize by height, then width (height dominant)
	            if ($max_h < $max_w) {
	                $rs_h = $max_h;
	                $rs_w = $rs_h / $ratio;
	            }
	            // resize by width, then height (width dominant)
	            else {
	                $rs_w = $max_w;
	                $rs_h = $ratio * $rs_w;
	            }

	            // copy old image to new image
	            $rs_image = imagecreatetruecolor($rs_w, $rs_h);
	            imagecopyresampled($rs_image, $or_image, 0, 0, 0, 0, $rs_w, $rs_h, $or_w, $or_h);
	        }
	        // image requires no resizing
	        else {
	            $rs_w = $or_w;
	            $rs_h = $or_h;

	            $rs_image = $or_image;
	        }

	        // generate resized image
	        imagejpeg($rs_image, $newdir.$img, 100);

	        $th_image = imagecreatetruecolor($th_w, $th_h);

	        // cut out a rectangle from the resized image and store in thumbnail
	        $new_w = (($rs_w / 2) - ($th_w / 2));
	        $new_h = (($rs_h / 2) - ($th_h / 2));

	        imagecopyresized($th_image, $rs_image, 0, 0, $new_w, $new_h, $rs_w, $rs_h, $rs_w, $rs_h);

	        // generate thumbnail
	        imagejpeg($th_image, $newdir.'thumb_'.$img, 100);

	        return true;
	    } 

	    // Image type was not jpeg!
	    else {
	        return false;
	    }
    }

    public function dumpPhoto($thumb,$dir){
  		$thumb = 'thumb_'.$thumb;
		$img   = $dir.$thumb;
		$dump  = "<img src=$img />";
		return $dump;
	}
*/
	public function showPatientChangePassword(){
		$patientId = Session::get('id_patient');

		if(!empty($patientId)){
			
			$patientPersonalData 	= DB::table('patients')->where('id_patient','=',$patientId)->first();
			return view('patientchangepassword',array('patientData'=>$patientPersonalData));
		}
		else{
			return Redirect::to('patientlogin');
		}
	}
	public function handlePatientChangePassword(){
		$input = Request::all();
		
		$oldPassword = $input['old_password'];
		$newPassword = $input['new_password'];
		$cNewPassword = $input['cnew_password'];

		$patientId = Session::get('id_patient');

		if(!empty($patientId)){
			$pateintData = DB::table('patients')->where('id_patient','=',$patientId)->first();
			$passwordEncrypted = $pateintData->password;
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

			if($oldPassword==$decrypted){
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
				       	$newPassword,
				        MCRYPT_MODE_CBC,
				        $iv
				    )
				);

				$passwordUpdated = DB::table('patients')->where('id_patient','=',$patientId)->update(array('password'=>$encrypted));

				if($passwordUpdated){
					return Redirect::to('patientchangepassword')->with(array('success'=>"Password changed successfully"));
					
				}
				else{
					return Redirect::to('patientchangepassword')->with(array('error'=>"Failed to change password"));
					
				}
			
			}
			else{
				return Redirect::to('patientchangepassword')->with(array('error'=>"Wrong old password"));
			}
		}
		else{
			return Redirect::to('patientlogin');
		}  

		
	}


}
