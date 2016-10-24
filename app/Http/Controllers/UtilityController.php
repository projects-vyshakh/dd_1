<?php namespace App\Http\Controllers;
use DB;
use Log;
use Input;
use App\Quotation;


class UtilityController extends Controller {

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
	
	public function getState(){
		$postData = Input::all();
		$countryId = $postData['country_id'];
		
		$state = DB::table('states')->where('country_id','=',$countryId)->get();
		Log::info("states",array($state));

		return $state;
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
  


  
	
	

}
