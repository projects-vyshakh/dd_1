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
use App\classes\DOMPDF;
use Carbon\Carbon;
use App\classes\DBAuth;
use App;
use PDF;
use View;

use App\Models\PrescriptionModel;

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
  	
  	public function handleSharedPrescription($sharedId){
  		$prescriptionData = DB::table('prescription')->where('id_share_prescription',$sharedId)->get();
  		

  		if(empty($prescriptionData)){
  			return Redirect::to('error');
  		}
  		else{

				foreach($prescriptionData as $prescriptionDataVal){
					//var_dump(json_encode($prescriptionDataVal));
				}

				$patientId 		= $prescriptionDataVal->id_patient;
				$doctorId		= $prescriptionDataVal->id_doctor;
				$todayDate 		= date('Y-m-d');
				$splitDate 		= explode('-',$todayDate);

				$pdfFileName 	= $patientId."_".$splitDate[0].$splitDate[1].$splitDate[2];

				$doctorPersonalData  = DB::table('doctors As d')
		                                            ->leftJoin('specialization As s','d.specialization','=','s.id_specialization')
				                                     ->where('d.id_doctor','=',$doctorId)->first();

				$patientPersonalData = DB::table('patients')
				                                   ->where('patients.id_patient','=',$patientId)->first();

				
				
				
				            
				$vitalsData = DB::table('vitals')
				                            ->where('id_vitals', DB::raw("(select max(`id_vitals`) from vitals where id_patient='$patientId')"))
				                            ->where('id_patient','=',$patientId)
				                            ->first();

				$diagnosisData = DB::table('diagnosis')
				                            ->where('id_diagnosis', DB::raw("(select max(`id_diagnosis`) from diagnosis where id_patient='$patientId')"))
				                            ->where('id_patient','=',$patientId)
				                            ->first();

				/*$prescriptionData    = DB::table('prescription')
													->where('created_date', DB::raw("(select max(`created_date`) from prescription where id_patient='$patientId')"))
				                            ->where('id_patient','=',$patientId)
				                            ->get();*/

				$medicalHistoryData =  DB::table('medical_history_present_past_more')
											->where('id_patient','=',$patientId)
				                            ->get();

				$printData = DB::table('print_settings')->where('id_doctor','=',$doctorId)->first();

				   
				$parametersArray = array('doctorPersonalData'=>$doctorPersonalData,'patientPersonalData'=>$patientPersonalData,'vitalsData'=>$vitalsData,'diagnosisData'=>$diagnosisData,'prescriptionData'=>$prescriptionData,'medicalHistoryData'=>$medicalHistoryData,'printData'=>$printData);


				/*$parametersArray = array('printData'=>$printData,'prescriptionData'=>$prescriptionData,'doctorPersonalData'=>$doctorPersonalData,'patientPersonalData'=>$patientPersonalData);*/


					$pdf 		= App::make('dompdf.wrapper');
				 	$view 		=  View::make('gynprecriptionformat',$parametersArray)->render();
				 	$pdf->loadHTML($view);
				 	//$pdf->stream();
				 	return $pdf->stream();;

				/*switch ($specialization) {
					case '1':
						$pdf = App::make('dompdf.wrapper');
				        //$pdf->loadHTML('<h1>Test</h1>');
				        $view =  View::make('gynprecriptionformat',$parametersArray)->render();

				       
				        
				        $pdf->loadHTML($view)->setWarnings(false)->save('storage/pdf/'.$pdfFileName.'.'.'pdf');

				        // add the header
						
						

				        return $pdfFileName;
				        
				    	//return $pdf->stream($pdfFileName.'.'.'pdf');
				    	//return $pdf->inline();
						break;

					case '2':
						$pdf = App::make('dompdf.wrapper');
				        //$pdf->loadHTML('<h1>Test</h1>');
				        $view =  View::make('gynprecriptionformat',$parametersArray)->render();
				         $pdf->loadHTML($view)->save('storage/pdf/'.$pdfFileName.'.'.'pdf');

				        return $pdfFileName;
				        
				    	//return $pdf->stream($pdfFileName.'.'.'pdf');
				    	//return $pdf->inline();
						break;
					
					default:
						# code...
						break;
				}
		*/
	  }

  	}

  	public function showErrorPage(){
  		return view('error');
  	}

  
	
	

}
