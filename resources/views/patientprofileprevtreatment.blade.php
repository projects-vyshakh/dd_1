<?php

if(!empty($patientPersonalData)){
	$firstName 	     			= $patientPersonalData->first_name;
	$lastName        			= $patientPersonalData->last_name;

	$patientName = $firstName." ".$lastName;
}
else{
	$newPatientId = Session::get('patientId'); 
	$patientName = "";
}

if(!empty($doctorData)){
	$doctorSpecialization = $doctorData->specialization;
}
else{
	$doctorSpecialization = "";
}




?>
@section('head')
	{!!Html::style('assets/plugins/bootstrap-multiselect/css/bootstrap-multiselect.css')!!}
	{!!Html::style('assets/plugins/select2/select2.css')!!}
	{!!Html::style('assets/plugins/tokenizemultiselect/jquery.tokenize.css')!!}


	{!!Html::style('assets/plugins/ajax-loader/src/jquery.mloading.css')!!}
	
	

	<style>
	.night{
		display: none;
	}
	hr {
    -moz-border-bottom-colors: none;
    -moz-border-left-colors: none;
    -moz-border-right-colors: none;
    -moz-border-top-colors: none;
    border-color: #eee -moz-use-text-color -moz-use-text-color;
    border-image: none;
    border-style: solid none none;
    border-width: 1px 0 0;
    margin-bottom: 20px;
    margin-top: 20px;
}

	</style>

@stop
@extends('layouts.master', ['specialization'=>$doctorSpecialization,'patientName'=>$patientName])

@section('main')
<div class="loader"></div>
<?php
//ar_dump($createdDateArray);
//var_dump(json_encode($obsData));

//foreach($lmpData)
/*$lmpCounter = 10;
$obsCounter = 0;
$pregCounter = 0;
$ObstetricsCounter = 0;
$vitalsCounter = 0;
$diagnosisCounter = 0;
$prescMedicineCounter = 0;*/
//var_dump($obsData);

$yearArray = array();
$startYear = date("Y");
$endYear = "2012";
for($startYear;$startYear>=$endYear;$startYear--){
	$yearArray[$startYear] = $startYear;

}


?>

	<div class="modal fade " id="myModal3" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content" style="width:800px;height:580px">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
						&times;
					</button>
					<h4 class="modal-title">Drug Alert</h4>
				</div>
				<div class="modal-body">
					<p class="pdf_print">
						
					</p>	
	
				</div>
				<!-- <div class="modal-footer">
					<button class="btn btn-default printBtnOk" data-dismiss="modal">
						OK
					</button>
				</div> -->
			</div>
		</div>
	</div>

		<div class="page-header">
			<h1>Patient Previous Treatments <small></small></h1>
		</div>
		
		<div class="dd_dummy_year" style="margin-bottom:20px;">
			<div class=" dd_year">
				{!! Form::select('year', $yearArray, null , $attributes = array('class' => 'form-control year ','id'=>'year')); !!}
				<!-- <i class="fa fa-sort-desc" aria-hidden="true"></i> -->
			</div>
		</div>	
		
		<div class="prev-data-div" id="prev-data-div">

		</div>
		
		<?php
			
		?>

@stop

@section('scripts')
	@parent
		{!!Html::script('assets/plugins/jquery-inputlimiter/jquery.inputlimiter.1.3.1.min.js')!!}
		{!!Html::script('assets/plugins/autosize/jquery.autosize.min.js')!!}
		{!!Html::script('assets/plugins/select2/select2.min.js')!!}
		{!!Html::script('assets/plugins/jquery.maskedinput/src/jquery.maskedinput.js')!!}
		{!!Html::script('assets/plugins/jquery-maskmoney/jquery.maskMoney.js')!!}

		{!!Html::script('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')!!}
		{!!Html::script('assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js')!!}
		{!!Html::script('assets/plugins/bootstrap-daterangepicker/moment.min.js')!!}
		{!!Html::script('assets/plugins/bootstrap-daterangepicker/daterangepicker.js')!!}
	 	
	 	{!!Html::script('assets/plugins/jquery-validation/dist/jquery.validate.min.js')!!}
	 	{!!Html::script('assets/js/patientprofileprevioustreatment.js')!!}
	 	{!!Html::script('assets/plugins/bootstrap-multiselect/js/bootstrap-multiselect.js')!!}

	 	{!!Html::script('assets/plugins/tokenizemultiselect/jquery.tokenize.js')!!}

	 	{!!Html::script('assets/plugins/ajax-loader/src/jquery.mloading.js')!!}

	 	


	<script>
		$(document).ready(function() {
			Main.init();
			patientPrevElements.init();
			
			
			
   	
		
			
	 	});
	</script>
@stop	