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
  	
  	public static function generate_otp($length = 4) {
	    $length = 4;
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

}

?>
