<?php namespace App\Http\Controllers;
use Input;
use DB;
use Log;
use App\Quotation;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Contracts\Routing\ResponseFactory;
use Session;
use Request;
use View;
use App\classes\DBUtils;
use App\Http\Controllers\Controller;
use App\Http\Manager\SubscriptionManager;


//Models
//Models
use App\Models\PatientsModel;
use App\Models\DoctorsModel;
use App\Models\MedicalHistoryPresentPastModel;
use App\Models\SurgeryHistoryModel;
use App\Models\DrugAllergyHistoryModel;
use App\Models\MedicalHistoryModel;

class UserController extends Controller {

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
    public function showUserLogin(){
    	return view('dduserlogin');

    }
    public function handleUserLogin(){
     	$email 		= Input::get('email');
		$password 	= Input::get('password');
		
		
		$checkLoginCredentials = DB::table('users')->where('email','=',$email)->where('status','=','1')->first();

		


		


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
				$userName = $checkLoginCredentials->first_name." ".$checkLoginCredentials->last_name;
				$userId = $checkLoginCredentials->id_user;
				Session::set('user_id',$checkLoginCredentials->id_user);
				Session::set('user_name',$userName);
				Session::set('user_type',$checkLoginCredentials->user_type);

				//$userData = array('userName'=>$$userName,'userId'=>$userId);
				return Redirect::to('admin/home')->with(array('userName'=>$userName,'userId'=>$userId));
			}
			else{
				return Redirect::to('admin/login')->with(array('error'=>"Login failed!!! Please check the credentials"));
			}
		}
		else{

			!empty($status)?$checkLoginCredentials->status:$status=1;
			if($status==0){
				//echo "enter into else 0";
				return Redirect::to('admin/login')->with(array('error'=>"Your account is not verified. Please contact administrator"));
			}
			else{
				//echo "enter into 0 else ";
				return Redirect::to('admin/login')->with(array('error'=>$email." "."is Denied or Not Exist"));
			}

			
		}	
	
    }
    public function showUserHome(){
    	$userName = Session::get('user_name');
    	$userId   = Session::get('user_id');



    	return view('userhome',array('userName'=>$userName,'userId'=>$userId));
    }
   

    public function showPatientSearch(){
    	$userName = Session::get('user_name');
    	$userId   = Session::get('user_id');

    	
    	return view('patientsearch',array('userName'=>$userName,'userId'=>$userId));
    	
    }

   

    public function handleSearchPatient(){
    	$input 			= Request::all();
    	$patientId 		= $input['searchby_id'];
    	$patientName 	= $input['searchby_name'];

            
            $data = PatientsModel::where('id_patient', 'like', '%'.$patientId.'%')
            		->where('first_name', 'like', '%'.$patientName.'%')
            		->orderBy('first_name', 'ASC')
            	    ->get();

                       

		    $results = array(
		            "sEcho" => 1,
		        "iTotalRecords" => count($data),
		        "iTotalDisplayRecords" => count($data),
		          "aaData"=>$data);
		

		echo json_encode($results);

		
    	
    	

    }

    public function showDoctorSearch(){
    	$userName = Session::get('user_name');
    	$userId   = Session::get('user_id');

    	$specializationKey = DB::table('specialization')->orderBy('specialization_name')->lists('specialization_name', 'id_specialization');

    	if(!in_array('Gynaecology', $specializationKey)){
	     	 array_unshift($specializationKey, '');
	    } 


    	//dd($specializationKey);
    	
    	return view('doctorsearch',array('userName'=>$userName,'userId'=>$userId,'specializationKey'=>$specializationKey));
    	
    }

    public function handleSearchDoctor(){

    	$input 			= Request::all();
    	
    	$doctorId 		= $input['searchby_id'];
    	$doctorName 	= $input['searchby_name'];
    	$doctorIma		= $input['searchby_ima'];
    	$doctorSpec 	= $input['searchby_spec'];

    	//!empty($input['searchby_id'])?$doctorId = $input['searchby_id'] : $doctorId =''; 
        
        if(!empty($doctorId) || !empty($doctorName) || !empty($doctorIma) || !empty($doctorSpec)){
        	/*$data = DB::table('doctors as d')
           			
           			->where('first_name', 'like', "%".$doctorName."%")
           			->where('id_doctor', 'LIKE' ,"%".$doctorId."%")
           			->where('doctor_registration_no', 'LIKE' ,"%".$doctorIma."%")
           			->where('specialization', 'LIKE' ,"%".$doctorSpec."%")
           			->leftJoin('specialization As s','s.id_specialization','=','d.specialization')
            		
            		->orderBy('first_name', 'ASC')
            	    ->get();*/


            	    $data = DB::table('doctors as d')
           				->where(function($query) use ($doctorName,$doctorId,$doctorIma,$doctorSpec)
			            {
			                $query->where('first_name', 'LIKE', "%".$doctorName."%")
			                      ->where('id_doctor', '=' ,$doctorId)
			           			  ->where('doctor_registration_no', 'LIKE' ,"%".$doctorIma."%")
			           			  ->where('specialization', 'LIKE' ,"%".$doctorSpec."%");
			           			
			            })
           			->leftJoin('specialization As s','s.id_specialization','=','d.specialization')
            		
            		->orderBy('first_name', 'ASC')
            	    ->get();
        }  
        else{
        	/*$data = DB::table('doctors as d')
           				->where(function($query)
			            {
			                $query->where('votes', '>', 100)
			                      ->where('first_name', 'like', "%".$doctorName."%")
			           			->where('id_doctor', 'LIKE' ,"%".$doctorId."%")
			           			->where('doctor_registration_no', 'LIKE' ,"%".$doctorIma."%")
			           			->where('specialization', 'LIKE' ,"%".$doctorSpec."%");
			            })
           			->leftJoin('specialization As s','s.id_specialization','=','d.specialization')
            		
            		->orderBy('first_name', 'ASC')
            	    ->get();*/


           	$data = DB::table('doctors as d')
           				
           			->leftJoin('specialization As s','s.id_specialization','=','d.specialization')
            		
            		->orderBy('first_name', 'ASC')
            	    ->get();
        }
           	

            	   

      

		    $results = array(
		            "sEcho" => 1,
		        "iTotalRecords" => count($data),
		        "iTotalDisplayRecords" => count($data),
		          "aaData"=>$data);
		

		echo json_encode($results);

		
    	
    	

    }

    public function showDoctorAuthorize(){
    	$userName = Session::get('user_name');
    	$userId   = Session::get('user_id');

    	$doctorAuthorizePending = DB::table('doctors as d')
    											->leftJoin('specialization as s','d.specialization','=','s.id_specialization')
    	                                        ->where('d.status','=',1)
    	                                        /*->where('d.registration_status','=',0)*/
    	                                        ->get();

    	$parametersArray = array('userName'	=>$userName,
    							 'userId'	=>$userId,
    							 'doctorAuthorizePending'=>$doctorAuthorizePending);
	
    	return view('doctorauthorize',$parametersArray);
    }
    public function handleDoctorAuthorize(){
    	$input = Request::all();
    	$doctorId = $input['id_doctor'];


    	$dataArray = array('registration_status'=>1);
    	$doctorUpdate = DoctorsModel::where('id_doctor','=',$doctorId)->update($dataArray);

    	//$doctorUpdate = DB::table('doctors')->where('id_doctor','=',$doctorId)->update($dataArray);
    	if($doctorUpdate){
    		$doctorData = DoctorsModel::where('registration_status','=',0)->where('status','=',1)->get();
    		return json_encode($doctorData);
    	}
    	else{
    		return 0;
    	}
    	
    

    }

    public function handleDoctorStatusChange(){
    	$input 			= Request::all();
    	$doctorId 		= $input['id_doctor'];
    	$statusText 	= $input['status_text'];
   		$doctorExist 	= DoctorsModel::where('id_doctor','=',$doctorId)->first();
   		

   		if(count($doctorExist)>0){
   			$doctorStatus = $doctorExist->status;

   			switch ($statusText) {
   				case 'Online':
   					$doctorStatusUpdate = DoctorsModel::where('id_doctor','=',$doctorId)->update(array('status'=>0));
   					return 'disabled';
   				break;
   				case 'Offline':
   					$doctorStatusUpdate = DoctorsModel::where('id_doctor','=',$doctorId)->update(array('status'=>1));
   					return 'enabled';
   				break;
   				
   				default:
   					# code...
   					break;
   			}


   			
   		}
   		else{
   			return Redirect::to('admin/doctorsearch')->with(array('error'=>'Invalid doctor'));
   		}

    }

    public function showUserLogout(){
    	Session::flush();
		return Redirect::to('admin/login');

    }




    

    
}