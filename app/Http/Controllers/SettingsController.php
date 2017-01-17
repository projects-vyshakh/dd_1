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

class SettingsController extends Controller {

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
		
		

		$printData = DB::table('print_settings')->where('id_doctor','=',$doctorId)->first();

		   
		

		//var_dump($medicalHistoryData);


		switch ($specialization) {
			case '1':
				$medicalHistoryData =  DB::table('medical_history_present_past_more')
									->where('created_date', DB::raw("(select max(`created_date`) from medical_history_present_past_more where id_patient='$patientId')"))
									->where('id_patient','=',$patientId)
		                            ->get();

				$parametersArray = array('doctorPersonalData'=>$doctorPersonalData,'patientPersonalData'=>$patientPersonalData,'vitalsData'=>$vitalsData,'diagnosisData'=>$diagnosisData,'prescriptionData'=>$prescriptionData,'medicalHistoryData'=>$medicalHistoryData,'printData'=>$printData);

				try
			    {
			        $pdf = App::make('dompdf.wrapper');
		        	//$pdf->loadHTML('<h1>Test</h1>');
		        	$view =  View::make('gynprecriptionformat',$parametersArray)->render();

		       
		        
		        	$pdf->loadHTML($view)->setWarnings(false)->save('storage/pdf/'.$pdfFileName.'.'.'pdf');

		        	// add the header
				
				

		        	return $pdfFileName;
			    }
			    catch (\Exception $e)
			    {
			        session(['message' => [ 'danger' => 'Error: ' . $e->getMessage() ]]);
			        return back();
			    }
				
				
		        
		    	//return $pdf->stream($pdfFileName.'.'.'pdf');
		    	//return $pdf->inline();
				break;

			case '2':
				$medicalHistoryData =  DB::table('cardiac_medical_history_present_past_more')
									->where('created_date', DB::raw("(select max(`created_date`) from cardiac_medical_history_present_past_more where id_patient='$patientId')"))
									->where('id_patient','=',$patientId)
		                            ->get();

		         $parametersArray = array('doctorPersonalData'=>$doctorPersonalData,'patientPersonalData'=>$patientPersonalData,'vitalsData'=>$vitalsData,'diagnosisData'=>$diagnosisData,'prescriptionData'=>$prescriptionData,'medicalHistoryData'=>$medicalHistoryData,'printData'=>$printData);

				try
			    {
			      	$pdf = App::make('dompdf.wrapper');
		        	//$pdf->loadHTML('<h1>Test</h1>');
		        	$view =  View::make('cardioprescriptionformat',$parametersArray)->render();
		         	$pdf->loadHTML($view)->save('storage/pdf/'.$pdfFileName.'.'.'pdf');

		        	return $pdfFileName;  
			    }
			    catch (\Exception $e)
			    {
			        session(['message' => [ 'danger' => 'Error: ' . $e->getMessage() ]]);
			        return back();
			    }

				
		        
		    	//return $pdf->stream($pdfFileName.'.'.'pdf');
		    	//return $pdf->inline();
				break;
			
			default:
				# code...
				break;
		}

		//return view('gynprecriptionformat');

		
	}
	public function showPrintSetup(){
		$patientId = Session::get('patientId');
		$doctorId  = Session::get('doctorId');

		if(empty($patientId)){
			//header('location:doctorlogin');
			return Redirect::to('logout');
		}
		else{
			    $patientData 	= DB::table('patients')->where('id_patient','=',$patientId)->get();
			    $doctorData 	= DB::table('doctors')->where('id_doctor','=',$doctorId)->first();
			   	$printData 		= DB::table('print_settings')->where('id_doctor','=',$doctorId)->first();
				

				$printUnits = DB::table('business_key_details')->where('business_key', '=', 'PRINT_UNITS')->orderBy('business_value')->lists('business_value', 'business_value');

				$diagYesNo = DB::table('business_key_details')->where('business_key', '=', 'GENERAL_YES_NO')->lists('business_value', 'business_value');

				
		

			return view('printsetup',array('patientId'=>$patientId, 'patientData'=>$patientData,'doctorData'=>$doctorData,'printData'=>$printData,'printUnits'=>$printUnits,'diagYesNo'=>$diagYesNo));
		}
	}
	
	public function addPrintSettings(){
		$input 				= Request::all();
		$patientId 			= Session::get('patientId');
		$specialization 	= Session::get('doctorSpecialization');
		$doctorId 			= Session::get('doctorId');
		$referenceId 		= Session::get('referenceId');
		$createdDate        = date('Y-m-d H:m:s');
		$doctorExistCheck 	= DB::table('doctors')->where('id_doctor','=',$doctorId)->first();
		

		!empty($input['print_header'])?$printHeader   = $input['print_header'] : $printHeader = '';
		!empty($input['unit'])?$unit 			= $input['unit'] : $unit 			= '';
		!empty($input['top'])?$marginTop 		= $input['top'] : $marginTop 		= '';
		!empty($input['bottom'])?$marginBottom 	= $input['bottom'] : $marginBottom 	= '';
		!empty($input['left'])?$marginLeft 		= $input['left'] : $marginLeft 		= '';
		!empty($input['right'])?$marginRight 	= $input['right'] : $marginRight 	= '';

		if(!empty($doctorExistCheck)){

			if(!empty($unit) && !empty($printHeader)){
				switch($unit){
					case 'cm':
						$marginTop 		= 36*$marginTop;
						$marginBottom 	= 36*$marginBottom;
						$marginLeft 	= 36*$marginLeft;
						$marginRight	= 36*$marginRight;
						$status 		= $this->saveUpdatePrintSetup($specialization, $doctorId, $referenceId, $createdDate, $printHeader, $unit, $marginTop, $marginBottom, $marginLeft, $marginRight);

						if($status=="update"){
							return Redirect::to('printsetup')->with(array('success'=>'Data updated successfully'));
						}
						if($status=="save"){
							return Redirect::to('printsetup')->with(array('success'=>'Data saved successfully'));
						}
					break;

					case 'inches':
						$marginTop 		= 96*$marginTop;
						$marginBottom 	= 96*$marginBottom;
						$marginLeft 	= 96*$marginLeft;
						$marginRight	= 96*$marginRight;

						$status 		= $this->saveUpdatePrintSetup($specialization, $doctorId, $referenceId, $createdDate, $printHeader, $unit, $marginTop, $marginBottom, $marginLeft, $marginRight);

						if($status=="update"){
							return Redirect::to('printsetup')->with(array('success'=>'Data updated successfully'));
						}
						if($status=="save"){
							return Redirect::to('printsetup')->with(array('success'=>'Data saved successfully'));
						}
					break;
					case 'mm':
						$marginTop 		= 4*$marginTop;
						$marginBottom 	= 4*$marginBottom;
						$marginLeft 	= 4*$marginLeft;
						$marginRight	= 4*$marginRight;

						$status 		= $this->saveUpdatePrintSetup($specialization, $doctorId, $referenceId, $createdDate, $printHeader, $unit, $marginTop, $marginBottom, $marginLeft, $marginRight);

						if($status=="update"){
							return Redirect::to('printsetup')->with(array('success'=>'Data updated successfully'));
						}
						if($status=="save"){
							return Redirect::to('printsetup')->with(array('success'=>'Data saved successfully'));
						}
					break;

					default :
				}

			}
			else{
				return Redirect::to('printsetup')->with(array('error'=>'Please enter correct unit'));
			}
			
		}
		else{
			return Redirect::to('printsetup')->with(array('error'=>'Invalid doctor'));
		}
	}

	public function saveUpdatePrintSetup($specialization, $doctorId, $referenceId, $createdDate, $printHeader, $unit, $marginTop, $marginBottom, $marginLeft, $marginRight){

		$printSettingsExists = DB::table('print_settings')->where('id_doctor','=',$doctorId)->first();
			if(!empty($printSettingsExists)){
				$printData = array('margin_top'=>$marginTop,
								   'margin_bottom'=>$marginBottom,
								   'margin_left'=>$marginLeft,
								   'margin_right'=>$marginRight,
								   'id_reference_settings'=>$referenceId,
								   'header_settings'=>$printHeader,
								   'unit'=>$unit,
								   'edited_date'=>$createdDate);	

				$printDataUpdate = DB::table('print_settings')->where('id_doctor','=',$doctorId)->update($printData);
				return "update";
				
			}
			else{
				$printData = array('margin_top'=>$marginTop,
								   'margin_bottom'=>$marginBottom,
								   'margin_left'=>$marginLeft,
								   'margin_right'=>$marginRight,
								   'id_doctor'=>$doctorId,
								   'id_reference_settings'=>$referenceId,
								   'id_specialization'=>$specialization ,
								   'header_settings'=>$printHeader,
								   'unit'=>$unit,
								   'created_date'=>$createdDate);
				$printInsert = DB::table('print_settings')->insert($printData);
				return "save";
			}
	}

	public function fetchPrintSetupData(){
		$doctorId 			= Session::get('doctorId');

		$printData = DB::table('print_settings')->where('id_doctor','=',$doctorId)->first();

		return json_encode($printData);
	}

}
