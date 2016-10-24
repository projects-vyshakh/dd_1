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
    public function showDoctorSignupInformation(){

    	$email = Session::get('doctorEmail');
    	

    	$gender = DB::table('business_key_details')->where('business_key', '=', 'GENDER')->lists('business_value', 'business_value');
		
		$maritialStatus = DB::table('business_key_details')->where('business_key', '=', 'MARITIAL_STATUS')->lists('business_value', 'business_value');
		
		$country =  DB::table('countries')->select('country_name','sortname','id')->orderBy('country_name', 'asc')->lists('country_name', 'id'); 	
		
		$state =  DB::table('states')->select('state_name','country_id')->orderBy('state_name', 'asc')->lists('state_name', 'state_name'); 	
		
		$city =  DB::table('cities')->select('city_name','state_id')->orderBy('city_name', 'asc')->lists('city_name', 'city_name'); 	

		$qualification =  DB::table('qualification')->select('qualification','id_qualification')->orderBy('qualification', 'asc')->lists('qualification', 'qualification'); 

		$specialization =  DB::table('specialization')->select('id_specialization','specialization_name')->orderBy('specialization_name', 'asc')->lists('specialization_name', 'id_specialization'); 	

		if(!empty($email)){
			$signupBasicData = DB::table('doctors')->where('email','=',$email)->first();
		}
		else{
			$signupBasicData = "";
		}
		
		    	

		   /* if(!in_array('', $gender)){
		     	 array_unshift($gender, '');
		    }	
		    if(!in_array('', $maritialStatus)){
		     	 array_unshift($maritialStatus, '');
		    } */
		    /*if(!in_array('', $country)){
		     	 array_unshift($country, '');
		    } 
		    if(!in_array('', $state)){
		     	 array_unshift($state, '');
		    } 
		    if(!in_array('', $city)){
		     	 array_unshift($city, '');
		    }	  	*/	

		return view('doctorsignupinformation',array('gender' => $gender,'maritialStatus'=>$maritialStatus,'country' => $country, 'state' => $state, 'city' => $city,'qualification' => $qualification,'specialization' => $specialization,'signupBasicData'=>$signupBasicData));
			
	}
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
				return Redirect::to('doctorlogin')->withInput()->with(array('error'=>"Login failed!!! Incorrect email or password"));
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
				return Redirect::to('doctorlogin')->with(array('error'=>"Login failed!!! Incorrect email or password"));
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
					if($checkLoginCredentials->registration_status==1){
						
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

	public function showForgetPassword(){
		return View('forgetpassword');
	}

	public function handleForgetPassword(){
		$email = Input::get('email');
		$currentPath = Session::get('currentPath');

		if($currentPath=="doctorlogin"){
			$doctorData = DB::table('doctors')->where('email','=',$email)->first();
			if(!empty($doctorData)){
				Session::put('doctorEmail',$email);
				//return Redirect::to('addnewpassword');
				$otpCode = DBUtils::generate_random_password();
				
				
				$to      = 'vyshakhps1988@gmail.com';
				$subject = 'OTP for password change';
				$message = 'OTP :'.$otpCode;
				$headers = 'From: cipher.infos@gmail.com' . "\r\n" .
				'Reply-To: vyshakhps1988@gmail.com' . "\r\n" .
				    'X-Mailer: PHP/' . phpversion();

				if(mail($to, $subject, $message, $headers))
				{
					DB::table('doctors')->where('email','=',$email)->update(array('otp'=>$otpCode));
					return Redirect::to('showdoctorotpcheck')->with(array('success'=>'An OTP has sent to you email. Please check your email'));
				}
				else{
				}
				Session::flush('currentPath');
				
			}
			else{
				return Redirect::to('forgetpassword')->withInput()->with(array('error'=>'Invalid email id'));
			}

		}
		elseif ($currentPath=="patientlogin") {
			$patientData = DB::table('patients')->where('email','=',$email)->first();
			if(!empty($patientData)){
				Session::put('patientEmail',$email);
				//return Redirect::to('addnewpassword');
				$otpCode = DBUtils::generate_random_password();
				
				
				$to      = 'vyshakhps1988@gmail.com';
				$subject = 'OTP for password change';
				$message = 'OTP :'.$otpCode;
				$headers = 'From: cipher.infos@gmail.com' . "\r\n" .
				'Reply-To: vyshakhps1988@gmail.com' . "\r\n" .
				    'X-Mailer: PHP/' . phpversion();

				/*if(mail($to, $subject, $message, $headers))
				{*/
					DB::table('patients')->where('email','=',$email)->update(array('otp'=>$otpCode));
					return Redirect::to('showdoctorotpcheck')->with(array('success'=>'An OTP has sent to you email. Please check your email'));
				/*}
				else{
				}*/
				Session::flush('currentPath');
			}
			else{
				return Redirect::to('forgetpassword')->withInput()->with(array('error'=>'Invalid email id'));
			}
		}

		
		
		

	}
	public function showDoctorOtpCheck(){
		
		return view('showdoctorotpcheck');
	}
	public function handleDoctorOtpCheck(){
		$otpCode = Input::get('otp');
		
		$otpExistCheck = DB::table('doctors')->where('otp','=',$otpCode)->first();

		if(!empty($otpExistCheck)){
			Session::put('otp',$otpCode);
			return Redirect::to('addnewpassword');
		}
		else{
			return Redirect::to('showdoctorotpcheck')->with(array('error'=>"Invalid OTP"));
		}
	}
	public function showAddNewPassword(){
		return view('addnewpassword');
	}
	public function handleAddNewPassword(){
		
			$password = Input::get('password');
			$cPassword = Input::get('cpassword');
			$doctorEmail = Session::get('doctorEmail');

			$doctorData = DB::table('doctors')->where('email','=',$doctorEmail)->first();

			if(!empty($doctorData)){
				if(($password==$cPassword) && !empty($doctorEmail)){
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

							$passwordUpdate = DB::table('doctors')->where('email','=',$doctorEmail)->update(array('password'=>$encrypted));
							if($passwordUpdate){
								DB::table('doctors')->where('email','=',$doctorEmail)->update(array('otp'=>''));
								Session::flush('doctorEmail');
								Session::flush('otp');
								return Redirect::to('doctorlogin')->with(array('success'=>"Successfully changed the password. Please login here"));
							}
							else{
								return Redirect::to('forgetpassword')->with(array('error'=>"Failed to update your new password"));
							}
				}
				else{
					return Redirect::to('addnewpassword')->with(array('error'=>"Either password do not match or invalid email"));
				}
			}
			else{
				return Redirect::to('addnewpassword')->with(array('error'=>"No doctors exist with".$doctorEmail));
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

		$specialization =  DB::table('specialization')->select('specialization_name','id_specialization')->orderBy('specialization_name', 'asc')->lists('specialization_name', 'specialization_name'); 	
		    	

		   /* if(!in_array('', $gender)){
		     	 array_unshift($gender, '');
		    }	
		    if(!in_array('', $maritialStatus)){
		     	 array_unshift($maritialStatus, '');
		    } */
		    /*if(!in_array('', $country)){
		     	 array_unshift($country, '');
		    } 
		    if(!in_array('', $state)){
		     	 array_unshift($state, '');
		    } 
		    if(!in_array('', $city)){
		     	 array_unshift($city, '');
		    }	  	*/	

		return view('doctorsignup',array('gender' => $gender,'maritialStatus'=>$maritialStatus,'country' => $country, 'state' => $state, 'city' => $city,'qualification' => $qualification,'specialization' => $specialization));
		//return view('register');
	}
	public function handleDoctorSignUp(){


		$input = Request::all();

		$signUpParam = $input['signup_parameter'];

		if($signUpParam=="signup1"){
			$email 		= $input['email'];
			$password 	= $input['password'];
			$cPassword 	= $input['cpassword'];
			Session::put('doctorEmail',$email);

			$emailExistCheck = DB::table('doctors')->where('email','=',$email)->first();
			
			
			if(!empty($emailExistCheck)){
				if($emailExistCheck->registration_status==0){
					if(($password==$cPassword) && !empty($email)){
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

						$passwordUpdate = DB::table('doctors')->where('email','=',$email)->update(array('password'=>$encrypted));
						if($passwordUpdate){
							return Redirect::to('doctorsignupinformation');
						}
						else{
							return Redirect::to('doctorsignup')->with(array('error'=>"Failed to update your new password"));
						}
						
					}
					
				}
				else{
					return Redirect::to('doctorsignup')->with(array('error'=>"This email already registered. Please login to continue!!!"));
				}
				
			}
			else{
				if(($password==$cPassword) && !empty($email)){

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


					$insertArray = array('email'=>$email,'password'=>$encrypted,'status'=>0);
					$signupInitialSave = DB::table('doctors')->insert($insertArray);
					if($signupInitialSave){
						
						return Redirect::to('doctorsignupinformation');
					}
					else{
						return Redirect::to('doctorsignup')->with(array('error'=>"Error in processing"));
						
					}
				}

			}

			
		}
		else{
			$firstName = $input['first_name'];
			$middleName = $input['middle_name'];
			$lastName = $input['last_name'];
			//$aadharNo = $input['aadhar_no'];
			$gender = $input['gender'];
			//$maritialStatus = $input['maritial_status'];
			//$house = $input['house'];
			$street = $input['street'];
			$country = $input['country'];
			!empty($input['state'])?$state = $input['state']:$state="";
			$city = $input['city'];
			$pincode = $input['pincode'];
			$phone = $input['phone'];
			$email = $input['email'];
			//$password = $input['password'];
			!empty($input['qualification'])?$qualification = $input['qualification']:$qualification="";
			$specialization = $input['specialization'];
			!empty($input['super_specialization'])?$superSpecialization = $input['super_specialization']:$superSpecialization="";
			$accredition = $input['accredition'];
			$imaRegisterNo = $input['register_no'];
			$createdDate = date('Y-m-d H:i:m');

			$regsiterValues = array('first_name' => $firstName,
								'middle_name' => $middleName,
								'last_name' => $lastName,
								
								'gender' => $gender,
								
								
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
								'registration_status'=>1,
								'created_date' => $createdDate,
								);

			$emailExistCheck = DB::table('doctors')->where('email','=',$email)->count();


			if($emailExistCheck>0){
				$doctorDataUpdate = DB::table('doctors')->where('email','=',$email)->update($regsiterValues);
				if($doctorDataUpdate){
					return Redirect::to('doctorlogin')->with(array('success'=>"Registerd successfully!!! Please wait for administrator authorization"));
				}
			}
			else{
				return Redirect::to('doctorsignup')->with(array('error'=>"Please enter your email and password before saving information"));
			}

		}
		

		//$input = Request::all();
		/*var_dump($input);
		var_dump(json_encode($input['qualification']));*/
		//die();

		/*$firstName = $input['first_name'];
		$middleName = $input['middle_name'];
		$lastName = $input['last_name'];
		$aadharNo = $input['aadhar_no'];
		$gender = $input['gender'];
		$maritialStatus = $input['maritial_status'];
		$house = $input['house'];
		$street = $input['street'];
		$country = $input['country'];
		$state = $input['state'];
		$city = $input['city'];
		$pincode = $input['pincode'];
		$phone = $input['phone'];
		$email = $input['email'];
		$password = $input['password'];
		$qualification = $input['qualification'];
		$specialization = $input['specialization'];
		$superSpecialization = $input['super_specialization'];
		$accredition = $input['accredition'];
		$imaRegisterNo = $input['register_no'];
		$createdDate = date('Y-m-d');*/

		/*$key = 'n1C5DE6oc63KDV4A4kZ0gc51QK24ke6o';

		
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
*/
		
		
	

		
/*
		$regsiterValues = array('first_name' => $firstName,
								'middle_name' => $middleName,
								'last_name' => $lastName,
								'id_no' => $aadharNo,
								'gender' => $gender,
								'maritial_status' => $maritialStatus,
								'house' =>$house,
								'street' => $street,
								'country' => $country,
								'state' => $state,
								'city' => $city,
								'pincode' => $pincode,
								'phone' => $phone,
								'email' => $email,
								'password' => $encrypted,
								'qualification' => json_encode($qualification),
								'specialization' => $specialization,
								'super_specialization' => $superSpecialization,
								'accredition' => $accredition,
								'doctor_registration_no' => $imaRegisterNo,
								'created_date' => $createdDate,
								);
*/

		/*$registerDoctor = DB::table('doctors')->insert($regsiterValues);
		if($registerDoctor){
			return Redirect::to('doctorsignup')->with(array('success'=>"Doctor registered successfully. Please wait till administrator approves"));
		}*/

		return Redirect::to('doctorsignupinformation');	
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

	public function showPatientOtpCheck()
	{
		return view('patientotpcheck');
	}

	public function handlePatientOtpCheck(){
		$otpCode = Input::get('otp_code');
		

		if(!empty($otpCode)){
			//OTP exist check
			$otpExistCheck = DB::table('patients')->where('otp_generated','=',$otpCode)->first();
			if(!empty($otpExistCheck)){
				Session::put('otpCode',$otpCode);
				if(($otpExistCheck->otp_generated==$otpCode) && $otpExistCheck->registration_status==0){
					return Redirect::to('patientsetnewpassword');
					
				}
				else{
					return Redirect::to('patientotpcheck')->with(array('error'=>"Invalid OTP / OTP already used"));
				}
			}
			else{
				return Redirect::to('patientotpcheck')->with(array('error'=>"Invalid OTP"));
			}
			
		}
		else{
			return Redirect::to('patientotpcheck')->with(array('error'=>"Please fill the empty field"));
		}
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
