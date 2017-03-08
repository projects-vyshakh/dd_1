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
use App\Models\PathologyModel;

class PathologyController extends Controller {
	public function __construct()
	{
	}

	public function showPathologyPersonalInformation(){
		$patientId	= Session::get('patientId');
		$doctorId	= Session::get('doctorId');

		if(!empty($doctorId)){
			if(!empty($patientId)){ 
				$gender = DB::table('business_key_details')->where('business_key', '=', 'GENDER')->orderBy('business_value')->lists('business_value', 'business_value');
		
				$maritialStatus = DB::table('business_key_details')->where('business_key', '=', 'MARITIAL_STATUS')->lists('business_value', 'business_value');
				
				$country =  DB::table('countries')->select('country_name','sortname','id')->orderBy('country_name', 'asc')->lists('country_name', 'id'); 	

				$doctorsList = DB::table('doctors')->select('first_name','last_name','id_doctor')->orderBy('first_name', 'asc')->lists('first_name', 'id_doctor'); 	

				$city =  DB::table('cities')->select('city_name','state_id')->orderBy('city_name', 'asc')->lists('city_name', 'city_name'); 	

				$patientData 	= PatientsModel::where('id_patient','=',$patientId)->first();

				$doctorData 	= DoctorsModel::where('id_doctor','=',$doctorId)->first();
				    	

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

				    $parametersArray = array('gender' => $gender,
				    						 'maritialStatus'=>$maritialStatus,
				    						 'country' => $country,  
				    						 'city' => $city,
				    						 'patientId'=>$patientId, 
				    						 'patientData'=>$patientData,
				    						 'doctorData'=>$doctorData,
				    						 'doctorsList'=>$doctorsList);

				    return view('pathologypersonalinformation',$parametersArray);
				   
			}
			else{
				return Redirect::to('doctor/home')->with(array('error'=>"You are not authorised to view the page"));
			}
		}
		else{
			return Redirect::to('doctor/logout');
		}


		return view('pathologypersonalinformation');
	}

	public function addPathologyPersonalInformation(){
		$input 			= Request::all();
		$doctorId 		= Session::get('doctorId');
		$patientId 		= Session::get('patientId');
		$createdDate 	= date('Y-m-d H:i:s');

		
		$patientExistCheck = DB::table('patients')->where('id_patient','=',$patientId)->first();

		

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

        
        if(count($patientExistCheck)>0){
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
		 				return Redirect::to('doctor/pathologypersonalinformation')->with(array('success'=>"Data updated successfully"));	
		 			}
		 			else{
		 				return Redirect::to('doctor/pathologypersonalinformation')->with(array('error'=>"No changes to update"));
		 			}
			}
			else{
				
				return Redirect::to('doctor/pathologypersonalinformation')->with(array('success'=>'Data saved successfully'));
			}

        }
        else{
			//echo "new patient";
			if(!empty($firstName) || !empty($lastName) || !empty($gender) || !empty($dob) || !empty($age) || 
	           !empty($house) || !empty($street) || !empty($country) || !empty($state) || !empty($pincode) ||
	           !empty($phone) || !empty($email) )
			{
				
				$otpGenerated 	 	= DBUtils::generate_otp(4);

				$message    =  "Welcome to Doctor's Diary!\nClick here to register"."-".
				"http://www.doctorsdiary.co/patient/signup.\nOTP for registration: Use ".$otpGenerated;
				
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
									'otp_generated' => $otpGenerated,
									'id_doctor' => $doctorId,
									'created_date' => $createdDate);
									
				$patientPersonalInfoSave = DB::table('patients')->insert($inputValue);
				if($patientPersonalInfoSave){
					$otpSendToMobile 	= DBUtils::otpSendToMobile($phone,$message,$otpGenerated);
					return Redirect::to('doctor/pathologypersonalinformation')->with(array('success'=>'Data saved successfully'));
				}
			}
			else{
				return Redirect::to('doctor/pathologypersonalinformation')->with(array('success'=>'Data saved successfully'));
			}

		}

	}

	public function showPathologyReportUpload(){
		$patientId	= Session::get('patientId');
		$doctorId	= Session::get('doctorId');

		

		$testName = DB::table('test_name')->select('test_name','id_test')->orderBy('test_name', 'asc')->lists('test_name', 'test_name'); 
		//var_dump($testName);
		//die();
		$pathologyData = PathologyModel::where('id_patient','=',$patientId);

		

	    if(!in_array('', $testName)){
	     	 array_unshift($testName, '');
	    }

	    //var_dump($testName);
	   // die();

		if(!empty($doctorId)){
			if(!empty($patientId)){ 
				$patientData 	= PatientsModel::where('id_patient','=',$patientId)->first();

				$doctorData 	= DoctorsModel::where('id_doctor','=',$doctorId)->first();
				    	

				   

				    $parametersArray = array('patientData'=>$patientData,
				    						 'doctorData'=>$doctorData,
				    						 'testName' => $testName,
				    						 'pathologyData'=>$pathologyData);
				    						

				    return view('pathologyreportupload',$parametersArray);
				   
			}
			else{
				return Redirect::to('doctor/home')->with(array('error'=>"You are not authorised to view the page"));
			}
		}
		else{
			return Redirect::to('doctor/logout');
		}
	
	}

	public function addPathologyReportUpload(){
		$input = Request::all();
		/*var_dump($input);
		echo $_FILES['foto']['name'];
*/
    	$referenceId = Session::get('referenceId');
	    $patientId   = Session::get('patientId');
	    $doctorId    = Session::get('doctorId');
	    $createdDate = date('Y-m-d H:i:s');
	    $specializationText = Session::get('doctorSpecialization');

	    //If you want Day,Date with time
	    $nowdt = date("Ymdg:i");
	    $patientExistCheck = PatientsModel::where('id_patient','=',$patientId)->count();



	    if($patientExistCheck>0)
	    {	

	    
	    	$path = 'assets/pdf/Pathology_report/'.$patientId;
			
			if(!file_exists($path)){
				mkdir($path, 0777, true);
			}

	    	if(!empty($_FILES['report_file']['name']))
	    	{
	    		
			    (!empty($input['pathology_name']))?$pathologyName = $input['pathology_name']:$pathologyName = [''];
			    	$file_name	= 	$_FILES['report_file']['name'];
					$file_tmp 	=	$_FILES['report_file']['tmp_name'];
				if(!empty($file_tmp))
				{
					list($file, $ext) = explode(".", $file_name);

					$file_ext = strtolower(substr(strrchr($file_name, '.'), 1));
					$newname=$file.$nowdt.".".$file_ext;
					$photo=$newname;
					if (file_exists($path."/".$newname))
					{
						unlink($path."/".$newname);
						move_uploaded_file($file_tmp,$path."/".$newname);
					}
					else
					{
						move_uploaded_file($file_tmp,$path."/".$newname);
					}
					    		$dataArray = array(
					    					   'id_patient' => $patientId,
					    					   'id_doctor' => $doctorId,
					    					   'test_name' => $pathologyName,
					    					   'file_name' => $photo,
					    					   'pathology_reference' => $referenceId,
					    					   'created_date' => $createdDate);

		    				$dataInsert = DB::table('pathology_report')->insert($dataArray);
			    		

			    		return Redirect::to('doctor/pathologyreportupload')->with(array('success'=>"Data saved successfully"));

			    	}
			}

		}

	    else{
	    	return Redirect::to('doctor/pathologyreportupload')->with(array('error'=>"Please save patient personal information"));
	    }	


	}

	public function showPathlabHistory(){

		$patientId	= Session::get('patientId');
		$doctorId	= Session::get('doctorId');

		return view('patientlabdata');

		if(!empty($doctorData)){
			$patientExistCheck = PatientsModel::where('id_patient','=',$patientId)->first();

			if(count($patientExistCheck)>0){

			}
		}

		

	}

	
}