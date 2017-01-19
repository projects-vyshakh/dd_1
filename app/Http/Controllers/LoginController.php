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


class LoginController extends Controller {

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
    
	public function showDoctorLogin()
	{
		return view('doctorlogin');
	}
	public function showPatientLogin(){
		//Session::flush();
		return view('patientlogin');
	}
	public function showLogout(){
		Session::flush();
		return Redirect::to('doctorlogin');
	}
	public function handleDoctorLogin()
	{
		//return view('login');
		$email 		= Input::get('email');
		$password 	= Input::get('password');

		

		$checkLoginCredentials = DB::table('doctors')->where('email','=',$email)->where('status','=','1')->first();
		
		
		
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
				Session::put('doctorId',$checkLoginCredentials->id_doctor);
				Session::put('doctorSpecialization',$checkLoginCredentials->specialization);
				return Redirect::to('doctorhome');
			}
			else{
				return Redirect::to('doctorlogin')->withInput()->with(array('error'=>"Login failed! Incorrect email or password."));
			}
		}
		else{

			!empty($status)?$checkLoginCredentials->status:$status=1;
			if($status==0){
				//echo "enter into else 0";
				return Redirect::to('doctorlogin')->with(array('error'=>"Your account is not verified. Please contact administrator"));
			}
			else{
				//echo "enter into 0 else ";
				return Redirect::to('doctorlogin')->with(array('error'=>"Login failed! Incorrect email or password."));
			}

			
		}	
	

		
	}
	public function handlePatientLogin(){
		$input = Request::all();
		$patientId = $input['id_patient'];
		$password  = $input['password'];




		$checkLoginCredentials = DB::table('patients')->where('id_patient','=',$patientId)->first();
		
	
		if(!empty($checkLoginCredentials))
		{
			
			
			$passwordEncrypted = $checkLoginCredentials->password;
			//$passwordEncrypted = "ns8nqYKWONCYH2B4qU60HP9ntcSzYCeiCvV1b++32CQ=";
			//Decrypt
			if(!empty($passwordEncrypted)){

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
					if($checkLoginCredentials->registration_status=='1'){
						
						Session::put('id_patient',$checkLoginCredentials->id_patient);
						$patientName = $checkLoginCredentials->first_name." ".$checkLoginCredentials->last_name;
						Session::put('patientName',$patientName);
						
						return Redirect::to('patientprofilemanagement');
					}
					else{
						return Redirect::to('patientlogin')->with(array('error'=>"Please activate your account before login"));
					}
					
				}
				else{
					return Redirect::to('patientlogin')->with(array('error'=>"Login failed!!! Incorrect id or password"));
				}
				

			}
			else{
				return Redirect::to('patientlogin')->with(array('error'=>"Your password is not set. Please activate your account"));
			}
			
		}
		else{

			
				return Redirect::to('patientlogin')->with(array('error'=>"Login failed!!! Incorrect id or password"));
			

			
		}


	}

	public function handlePatientLogout(){
		Session::flush();
		return Redirect::to('patientlogin');
	}


	public function showDoctorForgetPassword(){
		return View('doctorforgetpassword');
	}

	public function handleDoctorForgetPassword(){
		$input 		= Input::get('email_mobile');
		
		$otpCode 	= DBUtils::generate_otp_forgetpassword();
		$doctorData = DB::table('doctors')
									->where('email','=',$input)
									->where('registration_status','=',"1")
									->where('status','=',"1")
									->first();

									

		if(!empty($doctorData)){
			Session::put('otpCheckTrue','true');
			$to      = $input;
			$subject = 'OTP for password change';
			$message = 'OTP :'.$otpCode;
			$headers = 'From: cipher.infos@gmail.com' . "\r\n" .
			'Reply-To: vyshakhps1988@gmail.com' . "\r\n" .
			    'X-Mailer: PHP/' . phpversion();

			if(mail($to, $subject, $message, $headers))
			{
				DB::table('doctors')->where('email','=',$input)->update(array('otp'=>$otpCode));
				
				return Redirect::to('doctorotpcheck')->with(array('success'=>'An OTP has sent to your mobile number. Please check your messages'));

			}
			else{
				return Redirect::to('doctorforgetpassword')->with(array('error'=>'Failed to send OTP'));
			}	
		}
		else{
			return Redirect::to('doctorforgetpassword')->with(array('error'=>'Either invalid doctor or doctor not registered'));
		}


	}




	public function showPatientForgetPassword(){
		return View('patientforgetpassword');
	}

	public function handlePatientForgetPassword(){
		$input = Input::get('email_mobile');
		//$currentPath = "doctorlogin";
		$otpCode = DBUtils::generate_otp_forgetpassword();
		
		$patientData 	= DB::table('patients')->where('phone','=',$input)->first();
		
										
								



		if(!empty($patientData)){
			$registrationStatus = $patientData->registration_status;
			if($registrationStatus>0){
				$authKey = "117220A1EZexOee4576b74bc";

				//Multiple mobiles numbers separated by comma
				$mobileNumber = $input;

				//Sender ID,While using route4 sender id should be 6 characters long.
				$senderId = "DDIARY";

				//Your message to send, Add URL encoding here.
				$message = urlencode("Doctors Diary - Your OTP is"." ".$otpCode);
				
				
				//Define route 
				$route = "route4"; //if route1 is used then msg will send as promotional
				//Prepare you post parameters
				$postData = array(
				    'authkey' 	=> $authKey,
				    'mobiles' 	=> $mobileNumber,
				    'message' 	=> $message,
				    'sender' 	=> $senderId,
				    'route' 	=> $route
				);

				//API URL
				$url="https://control.msg91.com/api/sendhttp.php";

				// init the resource
				$ch = curl_init();
				curl_setopt_array($ch, array(
				    CURLOPT_URL => $url,
				    CURLOPT_RETURNTRANSFER => true,
				    CURLOPT_POST => true,
				    CURLOPT_POSTFIELDS => $postData
				    //,CURLOPT_FOLLOWLOCATION => true
				));


				//Ignore SSL certificate verification
				curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);


				//get response
				$output = curl_exec($ch);

				//Print error if any
				if(curl_errno($ch))
				{
				    echo 'error:' . curl_error($ch);
				}

				curl_close($ch);

				Session::put('patientOtpCheckTrue','true');
				
				DB::table('patients')->where('phone','=',$input)->update(array('otp_generated'=>$otpCode));
				
				return Redirect::to('patientotpcheck')->with(array('success'=>'An OTP has sent to your mobile number. Please check your messages'));	

			}
			else{
				return Redirect::to('patientforgetpassword')->with(array('error'=>'Invalid patient or patient not activated'));
			}
				
				
			
		}
		else{
			return Redirect::to('patientforgetpassword')->with(array('error'=>'Mobile number not registered'));
		}

	
	}


	
	public function showDoctorOtpCheck(){
		$doctorForgetPasswordStatus = Session::get('otpCheckTrue');

		if(!empty($doctorForgetPasswordStatus)){
			return view('doctorotpcheck');
		}
		else{
			return Redirect::to('doctorlogin');
		}
		
	}
	public function handleDoctorForgetOtpCheck(){
		

		Session::put('addnewPasswordTrue','true');

		/*if(!empty($doctorForgetPasswordStatus)){

		}*/
		$otpCode = Input::get('doctor_otp');
		
		
		//echo $otpCode;
		$doctorOtpExistCheck = DB::table('doctors')->where('otp','=',$otpCode)->first();
		//var_dump($doctorOtpExistCheck);
		//die();

		if(!empty($doctorOtpExistCheck)){
			//return view('addnewpassword',array('doctorData'=>$doctorOtpExistCheck));
			$patientData = "";
			return Redirect::to('doctoraddnewpassword')->with(array('doctorData'=>$doctorOtpExistCheck,'patientData'=>$patientData));

		}
		else{
			
			return Redirect::to('doctorotpcheck')->with(array('error'=>"Invalid OTP"));
		}
	}

	public function showPatientOtpCheck()
	{
		$patentOtpCheckTrue = Session::get('patientOtpCheckTrue');

		if(!empty($patientOtpCheckTrue)){
			return view('patientotpcheck');
		}
		else{
			return Redirect::to('patientlogin');
		}
		
	}

	public function handlePatientForgetOtpCheck(){
		$otpCode = Input::get('patient_otp');
		
		Session::put('patientAddnewPasswordTrue','true');

		if(!empty($otpCode)){
			//OTP exist check
			$patientOtpExistCheck = DB::table('patients')->where('otp_generated','=',$otpCode)->first();

			//var_dump($otpExistCheck);
			if(!empty($patientOtpExistCheck)){
				Session::flush('patientOtpCheckTrue');
				$doctorData = "";
				return Redirect::to('patientaddnewpassword')->with(array('doctorData'=>$doctorData,'patientData'=>$patientOtpExistCheck));
			}
			else{
				return Redirect::to('patientotpcheck')->with(array('error'=>"Invalid OTP"));
			}

			
			
		}
		else{
			return Redirect::to('patientotpcheck')->with(array('error'=>"Invalid OTP"));
		}
	}



	public function showDoctorAddNewPassword(){
		$doctorForgetNewPasswordStatus = Session::get('addnewPasswordTrue');

		if(!empty($doctorForgetPasswordStatus)){

			return view('doctoraddnewpassword');
		}
		else{
			return Redirect::to('doctorlogin');
		}
	}
	public function handleDoctorAddNewPassword(){
		
			$password 			= Input::get('password');
			$cPassword 			= Input::get('cpassword');
			$doctorPatientId 	= Input::get('doctor_patient_id');

			//echo $doctorPatientId;

			//$doctorEmail = Session::get('doctorEmail');

			$doctorData = DB::table('doctors')
										->where('id_doctor','=',$doctorPatientId)
										->where('registration_status','=',"1")
										->where('status','=',"1")
										->first();

										

			
			if(!empty($doctorData)){
				$currentUser = "doctor";
				

				if($password==$cPassword){
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


					$passwordUpdate = DB::table('doctors')->where('id_doctor','=',$doctorPatientId)->update(array('password'=>$encrypted));
					if($passwordUpdate){
						Session::flush('addnewPasswordTrue');
						DB::table('doctors')->where('id_doctor','=',$doctorPatientId)->update(array('otp'=>''));
						
						return Redirect::to('doctorlogin')->with(array('success'=>"Successfully changed the password. Please login here"));
					}
					else{
						return Redirect::to('doctorforgetpassword')->with(array('error'=>"Failed to update the password"));
						
					}
				}


				
			}
			
		
		
	}

	public function showPatientAddNewPassword(){
		$patientAddNewPasswordStatus = Session::get('pateintAddnewPasswordTrue');

		if(!empty($patientAddNewPasswordStatus)){
			return view('patientaddnewpassword');
		}
		else{
			return Redirect::to('patientlogin');
		}
		
	}
	public function handlePatientAddNewPassword(){
		
			$password 			= Input::get('password');
			$cPassword 			= Input::get('cpassword');
			$doctorPatientId 	= Input::get('doctor_patient_id');

		
			

										

			$patientData = DB::table('patients')
										->where('id_patient','=',$doctorPatientId)
										->where('registration_status','=',"1")
										->first();

			
			if(!empty($patientData)){
				

				if($password==$cPassword){
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


					$passwordUpdate = DB::table('patients')->where('id_patient','=',$doctorPatientId)->update(array('password'=>$encrypted));
					

					if($passwordUpdate){
						DB::table('patients')->where('id_patient','=',$doctorPatientId)->update(array('otp_generated'=>''));
						
						return Redirect::to('patientlogin')->with(array('success'=>"Successfully changed the password. Please login here"));
					}
					else{
						return Redirect::to('patientforgetpassword')->with(array('error'=>"Failed to update the password"));
						
						
					}
				}


				
			}
			
		
		
	}




	

	public function showDoctorRegister(){
		//echo "Regsiter page";
		$gender = DB::table('business_key_details')->where('business_key', '=', 'GENDER')->lists('business_value', 'business_value');
		
		$maritialStatus = DB::table('business_key_details')->where('business_key', '=', 'MARITIAL_STATUS')->lists('business_value', 'business_value');
		
		$country =  DB::table('countries')->select('country_name','sortname','id')->orderBy('country_name', 'asc')->lists('country_name', 'id'); 	
		
		$state =  DB::table('states')->select('state_name','country_id')->orderBy('state_name', 'asc')->lists('state_name', 'state_name'); 	
		
		$city =  DB::table('cities')->select('city_name','state_id')->orderBy('city_name', 'asc')->lists('city_name', 'city_name'); 	

		$qualification =  DB::table('qualification')->select('qualification','id_qualification')->orderBy('qualification', 'asc')->lists('qualification', 'qualification'); 



		$specialization =  DB::table('specialization')->select('specialization_name','id_specialization')->orderBy('specialization_name', 'asc')->lists('specialization_name', 'id_specialization'); 	

	
		    	

		   /* if(!in_array('', $gender)){
		     	 array_unshift($gender, '');
		    }	
		    if(!in_array('', $maritialStatus)){
		     	 array_unshift($maritialStatus, '');
		    } */
		    /*if(!in_array('', $country)){
		     	 array_unshift($country, '');
		    } 
		    
		    if(!in_array('', $city)){
		     	 array_unshift($city, '');
		    }	  	*/	

		return view('doctorsignup',array('gender' => $gender,'maritialStatus'=>$maritialStatus,'country' => $country, 'state' => $state, 'city' => $city,'qualification' => $qualification,'specialization' => $specialization));
		//return view('register');
	}
	public function handleDoctorSignUp(){


		$input = Request::all();
 
 		

		//$signUpParam = $input['signup_parameter'];

		
			$email 		= $input['email'];
			$password 	= $input['password'];
			$cPassword 	= $input['cpassword'];
			Session::put('doctorEmail',$email);

			$emailExistCheck = DB::table('doctors')->where('email','=',$email)->first();
			
			if(!empty($emailExistCheck)){
				return Redirect::to('doctorsignup')->with(array('error'=>"Email already registered."));
			}
			else{
				$firstName 	= $input['first_name'];
				$middleName = $input['middle_name'];
				$lastName 	= $input['last_name'];
				$email 		= $input['email'];
				$password 	= $input['password'];
				$phone 		= $input['phone'];
				$gender 	= $input['gender'];
				$marritialStatus = $input['maritial_status'];
				$street 	= $input['street'];
				$country 	= $input['country'];
				!empty($input['state'])?$state = $input['state']:$state="";
				$city 		= $input['city'];
				$pincode 	= $input['pincode'];
				!empty($input['qualification'])?$qualification = $input['qualification']:$qualification="";
				$specialization = $input['specialization'];
				!empty($input['super_specialization'])?$superSpecialization = $input['super_specialization']:$superSpecialization="";
				$accredition = $input['accredition'];
				$imaRegisterNo = $input['register_no'];
				$createdDate = date('Y-m-d H:i:m');
				
				
				
				
				
				

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
									'middle_name' => $middleName,
									'last_name' => $lastName,
									'password' =>$encrypted,
									'gender' => $gender,
									'maritial_status' => $marritialStatus,
									
									'street' => $street,
									'country' => $country,
									'state' => $state,
									'city' => $city,
									'pincode' => $pincode,
									'phone' => $phone,
									'email' => $email,
									
									'qualification' => json_encode($qualification),
									'specialization' => $specialization,
									'super_specialization' => $superSpecialization,
									'accredition' => $accredition,
									'doctor_registration_no' => $imaRegisterNo,
									'registration_status'=>0,
									'status'=>1,
									'created_date' => $createdDate,
									);

				$doctorRegistration = DB::table('doctors')->insert($regsiterValues);
				

				if($doctorRegistration){
					return Redirect::to('doctorlogin')->with(array('success'=>"Doctor registered successfully. Please wait for administrator authorization"));
				}
				else{
					return Redirect::to('doctorsignup')->with(array('error'=>"Failed to register doctor"));
				}


			}

			
			

	
	}

	public function showPatientIdCheckForActivate(){
		return view('patientregistercheckid');
	}

	public function handlePatientIdCheckForActivate(){
		$patientId 	= Input::get('id_patient');
		$mobile 	= Input::get('mobile');

		

		if(!empty($patientId) && !empty($mobile)){

			//Check for patient exist or not
			$patientExistCheck = DB::table('patients')->where('id_patient','=',$patientId)->first();
			if(!empty($patientExistCheck)){
				 Session::put('patientIdActivate',$patientId);
				if($patientExistCheck->registration_status==0){
					
						if($patientExistCheck->phone==$mobile){
							//Your authentication key
							$otpCode = DBUtils::sendOtp($mobile);
							//$otpCode = "1234";

							if(!empty($otpCode)){
								$otpUpdate = DB::table('patients')->where('id_patient','=',$patientId)->update(array('otp_generated'=>$otpCode));
							}
						}
						else{
							return Redirect::to('patientregistercheckid')->with(array('error'=>'The mobile number'." ".$mobile." ".'is not registered with patient ID :.'.$patientId));
						}
					
				}
				else{
					return Redirect::to('patientlogin')->with(array('error'=>"Patient ID :"." ".$patientId. " ". "is already registerd. Please login here"));
				}
			}
			else{
				return Redirect::to('patientregistercheckid')->with(array('error'=>"Invalid patient ID"));
			}
			
		
		}
		else{
			return Redirect::to('patientregistercheckid')->with(array('error'=>"Please fill the empty fields"));
		}
		
		return Redirect::to('patientotpcheck')->with(array('success'=>"An OTP has sent to your registered mobile. Please specify the OTP in below box"));
	}


	public function showPatientSetNewPassword(){
		return view('patientsetnewpassword');
	}

	public function handlePatientSetnewPassword(){
		$password = Input::get('password');
		$cPassword = Input::get('cpassword');
		$otpCode = Session::get('otpCode');



		if(!empty($password) && !empty($cPassword)){
			if($password==$cPassword){

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

				if(!empty($encrypted)){
					$otpExistCheck = DB::table('patients')->where('otp_generated','=',$otpCode)->first();
					if(!empty($otpExistCheck)){
						if($otpExistCheck->registration_status==0){
							$data = array('registration_status'=>1,'password'=>$encrypted);
							$passwordUpdate = DB::table('patients')->where('otp_generated','=',$otpCode)->update($data);
							if($passwordUpdate){
								Session::forget('otpCode');
								Session::forget('patientIdActivate'); 
								return Redirect::to('patientlogin')->with(array('success'=>"Your account is activated. Please login"));
							}
							else{
								return Redirect::to('patientsetnewpassword')->with(array('error'=>"Failed to save password. Please check"));
							}
						}
						else{
							return Redirect::to('patientotpcheck')->with(array('error'=>"Patient already registered with this OTP"));
						}
					}
					else{
						return Redirect::to('patientotpcheck')->with(array('error'=>"Invalid OTP"));
					}
								
				}
				else{
					return Redirect::to('patientsetnewpassword')->with(array('error'=>"Failed to save new password"));
				}

			}
			else{
				return Redirect::to('patientsetnewpassword')->with(array('error'=>"Password doesn't matches"));
			}
		}
		else{
			return Redirect::to('patientsetnewpassword')->with(array('error'=>"Please fill the empty fields"));
		}
	}

}
