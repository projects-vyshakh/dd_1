<?php namespace App\classes;
class DBUtils {
	public static function generate_random_password($length = 5) {
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

  	//Used in forget password
  	public static function generate_otp_forgetpassword($length = 8) {
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
  	
  	public static function generate_otp($length) {
	    
   		$numbers = range('0','9');
	    $password = '';
	  
	    while($length--) {
	      $key = array_rand($numbers);
	      $password .= $numbers[$key];
	    }
    	return $password;
  	}

  	public static function sendOtp($mobile){
  		$authKey = "117220A1EZexOee4576b74bc";

		//Multiple mobiles numbers separated by comma
		$mobileNumber = $mobile;

		//Sender ID,While using route4 sender id should be 6 characters long.
		$senderId = "DDIARY";

		//Random OTP Code
		$otpCode = self::generate_otp(4);

		//Your message to send, Add URL encoding here.
		$message = urlencode("Doctors Diary - Your OTP is"." ".$otpCode);

		//Define route 
		$route = "route4"; //if route1 is used then msg will send as promotional
		//Prepare you post parameters
		$postData = array(
		    'authkey' => $authKey,
		    'mobiles' => $mobileNumber,
		    'message' => $message,
		    'sender' => $senderId,
		    'route' => $route
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

		return $otpCode;
  	}

  	public static function id_share_prescription($length) {
	    $alphabets 	= range('A','Z');
	    $numbers 	= range('0','9');
	    //$additional_characters = array('_','.');
	    $final_array = array_merge($alphabets,$numbers);
	         
	    $password = '';
	  
	    while($length--) {
	      $key = array_rand($final_array);
	      $password .= $final_array[$key];
	    }
  
    	return $password;
  	}


  	//This function is using as general.Dont remove this one
  	public static function otpSendToMobile($mobile,$message,$otpCode){

  		
  		$authKey = "117220A1EZexOee4576b74bc";

		//Multiple mobiles numbers separated by comma
		//$mobileNumber = $input;

		//Sender ID,While using route4 sender id should be 6 characters long.
		$senderId = "DDIARY";

		//Your message to send, Add URL encoding here.
		//$message = urlencode("Doctors Diary - Your OTP is"." ".$otpCode);
		
		
		//Define route 
		$route = "route4"; //if route1 is used then msg will send as promotional
		//Prepare you post parameters
		$postData = array(
		    'authkey' 	=> $authKey,
		    'mobiles' 	=> $mobile,
		    'message' 	=> urlencode($message),
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
		else{
			return 1;
		}

		curl_close($ch);
  	}

  	public  static function passwordEncrypt($password){
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

		return $encrypted;
				
  	}
  	public static function passwordDecrypt($password){
  		$key = 'n1C5DE6oc63KDV4A4kZ0gc51QK24ke6o';
			
			$data = base64_decode($password);
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
		return $decrypted;
  	}

}

?>
