<?php
//var_dump($patientData);
$nowDate = date('d-M-Y');

if(!empty($patientData)){
	//echo "ss";

	foreach ($patientData as $key => $value) {
		$patientId 	     			= $value->id_patient;
		$firstName 	     			= $value->first_name;
		$middleName      			= $value->middle_name;
		$lastName        			= $value->last_name;
		$aadharNo        			= $value->id_aadhar;
		$patientGender   			= $value->gender;
		$patientDob      			= $value->dob;
		$age             			= $value->age;
		$patientMaritialStatus  	= $value->maritial_status;
		$house           			= $value->house_name;
		$patientStreet          	= $value->street;
		$patientCity            	= $value->city;
		$patientState           	= $value->state;
		$patientCountry         	= $value->country;
		$pincode         			= $value->pincode;
		$phone           			= $value->phone;
		$email           			= $value->email;
		//echo $patientDob;
	}
	$patientName = $firstName." ".$lastName;
}
else{
	$newPatientId = Session::get('patientId'); 
	$patientName = "";
}

if(!empty($doctorData)){
	$doctorSpecialization = $doctorData->specialization;
	$doctorName = $doctorData->first_name." ".$doctorData->last_name;
}
else{
	$doctorName = "";
}

if(!empty($printData)){
	$unit = $printData->unit;
	switch($unit){
		case 'cm':
			$marginTop 		= ceil($printData->margin_top/36);
			$marginBottom 	= ceil($printData->margin_bottom/36);
			$marginLeft 	= ceil($printData->margin_left/36);
			$marginRight	= ceil($printData->margin_right/36);
		break;
		case 'inches':
			$marginTop 		= ceil($printData->margin_top/96);
			$marginBottom 	= ceil($printData->margin_bottom/96);
			$marginLeft 	= ceil($printData->margin_left/96);
			$marginRight	= ceil($printData->margin_right/96);

			
		break;
		case 'mm':
			$marginTop 		= ceil($printData->margin_top/4);
			$marginBottom 	= ceil($printData->margin_bottom/4);
			$marginLeft 	= ceil($printData->margin_left/4);
			$marginRight	= ceil($printData->margin_right/4);

			
		break;
		default:
	}
}
else{
	$marginTop = 0;
	$marginBottom  = 0;
	$marginLeft = 0;
	$marginRight = 0;
}


?>
@section('head')

	{!!Html::style('assets/plugins/datepicker/css/datepicker.css')!!}
    {!!Html::style('assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css')!!}
    {!!Html::style('assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css')!!}

@stop
@extends('layouts.master', ['specialization'=>$doctorSpecialization,'patientName'=>$patientName,'doctorName'=>$doctorName])
<style>

</style>
@section('main')


	
	<div class="page-header">
		<h1>Print Setup <small></small></h1>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<?php 
				$error = Session::get('error');
	            $success = Session::get('success');
                Session::forget('error');
                Session::forget('success');
        
	        ?>
          	@if(!empty($error))
	            <div class="alert alert-danger display-none" style="display: block;">
	              <a class="close" aria-hidden="true" href="#" data-dismiss="alert">×</a>
	                {{$error}}
	            </div>
          	@elseif(!empty($success))
	            <div class="alert alert-success display-none" style="display: block;">
	              <a class="close" aria-hidden="true" href="#" data-dismiss="alert">×</a>
	                {{$success}}
	            </div>
          	@endif

			
			<div class="panel-body">
				{!! Form::open(array('route' => 'addPrintSettings', 'role'=>'form', 'id'=>'addPrintSettings', 'class'=>'form-horizontal addPrintSettings','novalidate'=>'novalidate')) !!}
					<div class="form-group">
						<div class="col-sm-2">
							{!! Form::label('unit', 'Unit', $attributes = array('class'=>'control-label'));  !!}
						</div> 
						<div class="col-sm-3">
							@if(!empty($printData))
								{!! Form::hidden('hidden-unit', $printData->unit, $attributes = array('class'=>'form-control default-unit','placeholder' => '','id'=>'default-unit'));  !!}

								{!! Form::select('unit', $printUnits, (!empty($printData->unit))?$printData->unit:Input::old('unit'), $attributes = array('class' => 'form-control','id'=>'unit')); !!}
							@else
								{!! Form::select('unit', $printUnits, Input::old('unit'), $attributes = array('class' => 'form-control','id'=>'unit')); !!}
							@endif
								
						</div>

					</div>
					<div class="unit-loader" id="unit-loader"></div>
					<div class="unit-values" id="unit-values" >
						<div class="form-group">
							<div class="col-sm-2">
								{!! Form::label('top', 'Top', $attributes = array('class'=>'control-label'));  !!}
								(<span id="top-unit" class="print-unit"></span>)
							</div>
							<div class="col-sm-3">
								@if(!empty($printData))
									{!! Form::text('top', $marginTop, $attributes = array('class'=>'form-control top','placeholder' => '','id'=>'top'));  !!}
								@else
									{!! Form::text('top', Input::old('top'), $attributes = array('class'=>'form-control top','placeholder' => '','id'=>'top'));  !!}
								@endif
									
							</div>
							


						</div>
						<div class="form-group">
							<div class="col-sm-2">
								{!! Form::label('bottom', 'Bottom', $attributes = array('class'=>'control-label'));  !!}
								(<span id="bottom-unit" class="print-unit"></span>)
							</div>
							<div class="col-sm-3">
								@if(!empty($printData))
									{!! Form::text('bottom', $marginBottom, $attributes = array('class'=>'form-control bottom','placeholder' => '','id'=>'bottom'));  !!}
								@else
									{!! Form::text('bottom', Input::old('bottom'), $attributes = array('class'=>'form-control bottom','placeholder' => '','id'=>'bottom'));  !!}
								@endif
								
									
							</div>

						</div>
						<div class="form-group">
							<div class="col-sm-2">
								{!! Form::label('left', 'Left', $attributes = array('class'=>'control-label'));  !!}
								(<span id="left-unit" class="print-unit"></span>)
							</div>
							<div class="col-sm-3">
								@if(!empty($printData))
									{!! Form::text('left', $marginLeft, $attributes = array('class'=>'form-control left','placeholder' => '','id'=>'left'));  !!}
								@else
									{!! Form::text('left', Input::old('left'), $attributes = array('class'=>'form-control left','placeholder' => '','id'=>'left'));  !!}
								@endif
									
									
							</div>

						</div>
						<div class="form-group">
							<div class="col-sm-2">
								{!! Form::label('right', 'Right', $attributes = array('class'=>'control-label'));  !!}
								(<span id="right-unit" class="print-unit"></span>)
							</div>
							<div class="col-sm-3">
								@if(!empty($printData))
									{!! Form::text('right', $marginRight, $attributes = array('class'=>'form-control right','placeholder' => '','id'=>'right'));  !!}
								@else
									{!! Form::text('right', Input::old('right'), $attributes = array('class'=>'form-control right','placeholder' => '','id'=>'right'));  !!}
								@endif
									
									
							</div>

						</div>
						<div class="form-group">
							<div class="col-sm-5">
								<button type="submit" class="btn btn-primary dd_save  pull-right ">
								<!-- <i class="fa fa-floppy-o" aria-hidden="true"></i> -->
								Save
							</button>
							</div>
							
						</div>
					</div>
					
				{!! Form::close() !!}
			</div>
		</div>
	</div>
			

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
		
		{!!Html::script('assets/js/patient-personal-information.js')!!}
		{!!Html::script('assets/js/settings.js')!!}
		
		{!!Html::script('assets/plugins/jquery-validation/dist/jquery.validate.min.js')!!}
		{!!Html::script('assets/js/patient-personal-information.js')!!}
        {!!Html::style('assets/css/dd-responsive.css')!!}

		
		
	<script>
		$(document).ready(function() {
			Main.init();
			//patientElements.init();
			generalSettings.init();
			

			
			
	
	 	});
	</script>
@stop	