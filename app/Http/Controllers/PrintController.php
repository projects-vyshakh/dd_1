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
//use Illuminate\Support\Collection::sortBy();
use Illuminate\Database\Eloquent\ModelNotFoundException;

//Models
use App\Models\PatientsModel;
use App\Models\DoctorsModel;
use App\Models\MedicalHistoryPresentPastModel;
use App\Models\SurgeryHistoryModel;
use App\Models\DrugAllergyHistoryModel;
use App\Models\VitalsModel;

class PrintController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//$this->middleware('guest');
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function patientPrescPrint(){
	

		$specialization = Session::get('doctorSpecialization');;
		$patientId 		= Session::get('patientId');
		$doctorId 		= Session::get('doctorId');

		$todayDate 		= date('Y-m-d');
		$splitDate 		= explode('-',$todayDate);

		$pdfFileName 	= $patientId."_".$splitDate[0].$splitDate[1].$splitDate[2];

		
		

		$doctorPersonalData  = DB::table('doctors As d')
                                            ->leftJoin('specialization As s','d.specialization','=','s.id_specialization')
		                                     ->where('d.id_doctor','=',$doctorId)->first();
		
		$patientPersonalData = PatientsModel::where('patients.id_patient','=',$patientId)->first();
		                                 
		
		$vitalsData = VitalsModel::where('id_vitals', DB::raw("(select max(`id_vitals`) from vitals where id_patient='$patientId')"))->where('id_patient','=',$patientId)
		                            ->first();
		                           //var_dump($vitalsData); die();
		$diagnosisData = DB::table('diagnosis')
		                            ->where('id_diagnosis', DB::raw("(select max(`id_diagnosis`) from diagnosis where id_patient='$patientId')"))
		                            ->where('id_patient','=',$patientId)
		                            ->first();

		                            
		$prescriptionData    = DB::table('prescription')
									->where('created_date', DB::raw("(select max(`created_date`) from prescription where id_patient='$patientId')"))
		                            ->where('id_patient','=',$patientId)
		                            ->get();

		$medicalHistoryData =  DB::table('cardiac_medical_history_present_past_more')
									->where('created_date', DB::raw("(select max(`created_date`) from cardiac_medical_history_present_past_more where id_patient='$patientId')"))
									->where('id_patient','=',$patientId)
		                            ->get();

		$printData = DB::table('print_settings')->where('id_doctor','=',$doctorId)->first();

		   

		$parametersArray = array('doctorPersonalData'=>$doctorPersonalData,'patientPersonalData'=>$patientPersonalData,'vitalsData'=>$vitalsData,'diagnosisData'=>$diagnosisData,'prescriptionData'=>$prescriptionData,'medicalHistoryData'=>$medicalHistoryData,'printData'=>$printData);

		


		switch ($specialization) {
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
		        $view =  View::make('cardioprescriptionformat',$parametersArray)->render();
		         $pdf->loadHTML($view)->save('storage/pdf/'.$pdfFileName.'.'.'pdf');

		        return $pdfFileName;
		        
		    	//return $pdf->stream($pdfFileName.'.'.'pdf');
		    	//return $pdf->inline();
				break;
			
			default:
				# code...
				break;
		}

		//return view('gynprecriptionformat');

		
	}

}
