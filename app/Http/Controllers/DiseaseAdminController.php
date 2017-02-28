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
use App\Models\AtlasDiseaseModel;
use App\Models\AtlasDiseaseRecordModel;


class DiseaseAdminController extends Controller {

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
    public function showDiseaseIndex(){
    	$sql = AtlasDiseaseModel::
           		select('id_disease', 'color','name')->where('status', '=',1)->get();
         foreach($sql as $qdrow){
         	$diseaseVals[$qdrow->id_disease]=trim($qdrow->color)."__".$qdrow->name;
         }
        $dRows = AtlasDiseaseRecordModel::select('id_disease')->distinct()->get();
        foreach ($dRows as $dRow) {
         	$dbid=$dRow->id_disease;
         	/*echo $dbid;
         	die();*/
         	$latlongRows = AtlasDiseaseRecordModel::select('latitude','longitude')->where('id_disease', '=',$dbid)->distinct()->orderBy('cases', 'asc')->get();
           foreach ($latlongRows as $latlongRow) {
           		$latitude=$latlongRow->latitude;
           		$longitude=$latlongRow->longitude;

           		$dupRows = AtlasDiseaseRecordModel::selectRaw('country_name, sum(cases) as sumcases,count(*) as count,state_name,city_name')
           	       ->where('id_disease', '=',$dbid)
           	       ->where('latitude', '=',$latitude)
           	       ->where('longitude', '=',$longitude)
           	       ->where('disease_status', '=',1)
           	       ->where('disease_approval_status', '=',1)
           	       ->get();
           		 foreach ($dupRows as $dupRow) {
           		 	$locationValue=$dupRow->country_name;
           		 	$caseValue=$dupRow->sumcases;
           		 }
           		
           		//$caseValue=$dupRows['sumcases'];
               // $locationValue=$dupRows['country_name'];
                $latlong=trim($latitude)."#".trim($longitude);
                $countryDisease[$diseaseVals[$dbid]][$latlong][$locationValue]=$caseValue;
                /*print_r($countryDisease);
                echo "<br>";*/
           	}
       
         }
         $return=$countryDisease;
         $diseaseRows= AtlasDiseaseModel::where('status', '=',1)->get();
           	//print_r($diseaseRows);
         foreach ($diseaseRows as $diseaseRow => $value) {
       $id_disease= $value->id_disease;
       $cases = AtlasDiseaseRecordModel::select(DB::raw("SUM(cases) as sumcases"))
           		->where('id_disease', '=',$id_disease)->first();
         $totalcases=$cases->sumcases;
         /*print_r($totalcases);
         echo "<br>";*/
         if($totalcases>0)
         {
         	$diseasenumRows[]=$value;
         	/*print_r($value);
         	echo "<br>";*/
         }
          
       }
       return view('disease.index',array('mapData'=>$return,'diseaseRows'=>$diseasenumRows));
    }
    public function SearchDiseaseIndex(){
    	$id_disease = Input::get('id_disease');
    	 $id_disease=(int)$id_disease;
    	if($id_disease=="")
    	{
    		return Redirect::to('diseaseatlas');
    	}
    	else
    	{
    	$countryDisease=array();
    	$sql = AtlasDiseaseModel::where('status', '=',1)
           		->where('id_disease','=',$id_disease)
           		->get();
         foreach($sql as $qdrow){
         	$diseaseVals[$qdrow->id_disease]=trim($qdrow->color)."__".$qdrow->name;
         }
        
        foreach ($sql as $dRow) {
         	$dbid=$dRow->id_disease;
         	
         	$latlongRows = AtlasDiseaseRecordModel::select('latitude','longitude')->where('id_disease', '=',$dbid)->distinct()->orderBy('cases', 'asc')->get();
           foreach ($latlongRows as $latlongRow) {
           		$latitude=$latlongRow->latitude;
           		$longitude=$latlongRow->longitude;

           		$dupRows = AtlasDiseaseRecordModel::selectRaw('country_name, sum(cases) as sumcases,count(*) as count,state_name,city_name')
           	       ->where('id_disease', '=',$dbid)
           	       ->where('latitude', '=',$latitude)
           	       ->where('longitude', '=',$longitude)
           	       ->where('disease_status', '=',1)
           	       ->where('disease_approval_status', '=',1)
           	       ->get();
           		 foreach ($dupRows as $dupRow) {
           		 	$locationValue=$dupRow->country_name;
           		 	$caseValue=$dupRow->sumcases;
           		 }
           		
           		//$caseValue=$dupRows['sumcases'];
               // $locationValue=$dupRows['country_name'];
                $latlong=trim($latitude)."#".trim($longitude);
                if($caseValue>0)
                {
                   $countryDisease[$diseaseVals[$dbid]][$latlong][$locationValue]=$caseValue;
                }
                
                //$countryDisease[$diseaseVals[$dbid]][$latlong][$locationValue]=$caseValue;
                /*print_r($countryDisease);
                echo "<br>";*/
           	}
         }
         $return=$countryDisease;
         $diseasenumRows=array();
         /*print_r($return);
         die();*/
         $diseaseRows= AtlasDiseaseModel::
           		where('status', '=',1)->get();
          foreach ($diseaseRows as $diseaseRow => $value) {
       $id_disease= $value->id_disease;
       $cases = AtlasDiseaseRecordModel::select(DB::raw("SUM(cases) as sumcases"))
           		->where('id_disease', '=',$id_disease)->first();
         $totalcases=$cases->sumcases;
         /*print_r($totalcases);
         echo "<br>";*/
         if($totalcases>0)
         {
         	$diseasenumRows[]=$value;
         	/*print_r($value);
         	echo "<br>";*/
         }
          
       }
      // print_r($diseasenumRows);
      // die();
       return view('disease.index',array('mapData'=>$return,'diseaseRows'=>$diseasenumRows));
       }
    } 
//die();
//$mapData=$countryDisease;

    
    public function showAdminLogin(){
    	return view('disease.adminlogin');

    }
    public function handleDiseaseAdminLogin(){
     	$email 		= Input::get('email');
		$password 	= Input::get('password');	
		//$passwordEncrypted = DBUtils::passwordEncrypt($password);
		
		$checkLoginCredentials = DB::table('users')->where('email','=',$email)->where('status','=','1')->where('user_type','=','2_admin')->first();
		

		if(!empty($checkLoginCredentials))
		{
			$passwordEncrypted = $checkLoginCredentials->password;

			$decrypted = DBUtils::passwordDecrypt($passwordEncrypted);
			
			if($password==$decrypted){
				$userName = $checkLoginCredentials->first_name;
				/*$userName = $checkLoginCredentials->first_name." ".$checkLoginCredentials->last_name;*/
				$AdminId = $checkLoginCredentials->id_user;
				Session::flush();
				Session::set('AdminId',$AdminId);
				Session::set('user_name',$userName);
				/*Session::set('user_type',$checkLoginCredentials->user_type);*/

				//$userData = array('userName'=$userName,'userId'=>$userId);
				/*return Redirect::to('diseaseatlas/adminhome')->with(array('user_name'=>$userName,'AdminId'=>$AdminId));*/
				return Redirect::to('diseaseatlas/admin/home');
			}
			else{
				return Redirect::to('diseaseatlas/admin')->with(array('error'=>"Login failed!!! Please check the Username or Password"));
			}
		}
		else{

			!empty($status)?$checkLoginCredentials->status:$status=1;
			if($status==0){
				//echo "enter into else 0";
				return Redirect::to('diseaseatlas/admin')->with(array('error'=>"Your account is not verified. Please contact administrator"));
			}
			else{
				//echo "enter into 0 else ";
				return Redirect::to('diseaseatlas/admin')->with(array('error'=>$email." "."is Denied or Not Exist"));
			}

			
		}	
	
    }
    public function showDiseaseAdminhome(){
    	$userName = Session::get('user_name');
    	$AdminId   = Session::get('AdminId');
    	//echo $AdminId;
    	
    	if(!empty($AdminId)){
    	return view('disease.adminhome',array('userName'=>$userName,'AdminId'=>$AdminId));
    }
    else
    {
    	return Redirect::to('diseaseatlas/admin/logout');
    }
    }
   

    public function showAddDisease(){

    	$userName = Session::get('user_name');
    	$AdminId  = Session::get('AdminId');

    	if(!empty($AdminId)){
    	return view('disease.adddisease');
    }
    else
    {
    	return Redirect::to('diseaseatlas/admin/logout');
    }
    	
    }
    public function handleImportDiseaseRecord(){
    	$input 			= Request::all();
    //	$file = array('file' => Input::file('file'));
    	$path = Request::file('file')->getRealPath();
    	/*echo $path;
    	die();*/
    	  $fileD = fopen($path,"r");

    	 /*$column=fgetcsv($fileD);
    	 while(!feof($fileD)){
         $rowData[]=fgetcsv($fileD);
         print_r($rowData);
         echo "<br>";
        }*/
        $row=0;
        $flag=0;
        while (($filesop = fgetcsv($fileD, 10000, ",")) !== false)
            {
            	if($row=="0")
            	{
            		$row++;
            	}
            	else
            	{

	            	$city=$state=$country="";
	            	$alertid 	=$filesop[0];
	            	$issue_date =$filesop[1];
	            	$disease   	=$filesop[2];
	            	$latitude   =$filesop[3];
	            	$longitude  =$filesop[4];
	            	$location    =$filesop[5];
	            	$cases    	=$filesop[6];
	            	$deaths    	=$filesop[7];
	            	$risk    	=$filesop[8];
	            	if (strpos($location, ',') !== false)
	             	{
	             		list($city, $states) = explode(",", $location, 2);
	             		if (strpos($states, ',') !== false)
		            	{
		             		list($state, $country) = explode(",", $states, 2);
		             
		             		if (strpos($country, ',') !== false)
		            		{
		            			$city =$city." ".$state;
		            			list($state, $country) = explode(",", $country, 2);
		            		
		            		}
		            	}
		            	else
		            	{
		            		$country=$states;
		            		$state=$city;
		            		$city="";
		            	}

	             	}
	            	else
	            	{
	            		$country=$location;
	            	}
	            	
	            	//$disease = preg_replace('/\s+/', '', $disease);
		            $country = preg_replace('/\s+/', '', $country);
		            $state = preg_replace('/\s+/', '', $state);
	            	$city = preg_replace('/\s+/', '', $city);
	            	$latitude = preg_replace('/\s+/', '', $latitude);
	            	$longitude = preg_replace('/\s+/', '', $longitude);


	            	$country_id = DB::table('countries')
	           			->select('id')->where('country_name', '=',$country)->first();
	           		$id_country= $country_id->id;
	           		if($state!=""){
	           			$state_id = DB::table('states')
	           			->select('id')->where('state_name', '=',$state)->where('country_id', '=',$id_country)->first();
	           			if(!empty($state_id))
	           			{
	           				$id_state=$state_id->id;
	           				$city_id= DB::table('cities')
	           				->select('id')
	           				->where('city_name', '=',$city)
	           				->where('state_id', '=',$id_state)
	           				->first();
	           				if(!empty($city_id))
	           				{
	           					$id_city=$city_id->id;
	           				}
	           				else
	           				{
	           					$id_city=0;
	           				}
	           			
	           			}
	           			else
	           			{
	           				$id_state=$id_city=0;
	           			}
	           		}
	           		else{
	           			$id_state=0;
	           			$id_city=0;
	           		}
	           		$disease_id= AtlasDiseaseModel::select('id_disease')
	           				->where('name','=',$disease)
	           				->first();
	           		
	           		if(!empty($disease_id))
	           		{
	           			$id_disease=$disease_id->id_disease;
	           			//echo $id_disease."<br>";
	           			/*For future needs */
				        $species="";
				        $date_created=date('Y-m-d', strtotime($issue_date));
				        $source="";
				        $source_details=1;
				        $disease_approval_status=1;
				        $disease_status=1;
				        $date_approved=date('Y-m-d', strtotime($issue_date));
				        $info_date=$issue_date;
				        $summary="";
				        $id_sender=1;
				        $id_species=1;
				        $approval_status=1;
				        $id_source=1;
				        $sender_name="";
				        $state_name=$state;
				        $country_name=$country;
				        $city_name=$city;
				        $disease_name=$disease;
				        $date_modified=date('Y-m-d', strtotime($issue_date));
				        $record_by_admin=1;
				        $DiseaseadminData = array('id_country' => $id_country,
				        	'id_state'=> $id_state,
				        	'id_city'=> $id_city,
				        	'id_disease'=> $id_disease,
				        	'species'=> $species,
				        	'cases'	=> $cases,
				        	'deaths' => $deaths,
				        	'risk'=> $risk,
				        	'date_created' => $date_created,
				        	'source' => $source,
				        	'source_details' => $source_details,
				        	'disease_approval_status' => $disease_approval_status,
				        	'disease_status'=> $disease_status,
				        	'date_approved'=> $date_approved,
				        	'info_date'=> $info_date,
				        	'summary'=> $summary,
				        	'id_sender'=> $id_sender,
				        	'id_species'=> $id_species,
				        	'approval_status'=> $approval_status,
				        	'id_source'=> $id_source,
				        	'sender_name'=> $sender_name,
				        	'state_name'=> $state_name,
				        	'country_name'=> $country_name,
				        	'city_name'=> $city_name,
				        	'disease_name'=> $disease_name,
				        	'date_modified'=> $date_modified,
				        	'record_by_admin'=> $record_by_admin,
				        	'latitude'=> $latitude,
				        	'longitude'=> $longitude);
					   /*print_r($DiseaseadminData);
					    echo "<br>";*/
						$DiseaseatlasRecord = AtlasDiseaseRecordModel::insert($DiseaseadminData);
						if($DiseaseatlasRecord){
							$flag++;
						}
	           		}
	            }

            }
            if($flag>0)
            {
            	return Redirect::to('diseaseatlas/admin/adddisease')->with(array('success'=> $flag.'rows imported successfully'));
            }
            else{
				return Redirect::to('diseaseatlas/admin/adddisease')->with(array('error'=>"Failed to import data. Please check the sample file"));
			}
         
                   
    	/*$patientId 		= $input['searchby_id'];
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
*/
    	

    }

    public function showLogout(){
		Session::flush();
		return Redirect::to('diseaseatlas/admin');
	}
    
}