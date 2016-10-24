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


?>
@section('head')

<style>
	.pressure{
		font-size: 18px;
	    position: absolute;
	    right: 84px;
	    top: 5px;
	}
	.sys_dia_pressure input{
		padding: 5px;
		text-align: center;
	}
	.cvs-comments{
		resize: none;
	}
	.lungs-comments{
		resize: none;
	}
	.abdomen-comments{
		resize: none;
	}
	.ecg-comments{
		resize: none;
	}
</style>


@stop
@extends('layouts.master', ['specialization'=>$doctorSpecialization,'patientName'=>$patientName])
@section('main')
<div class="loader"></div>
	<div class="page-header">
		<h1>Diagnosis Examination <small></small></h1>
	</div>
	<div class="form-group">
		<div class="col-sm-12">
			<?php $error = Session::get('error');
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
		</div>
		<div class="col-sm-8">
			<h3 class="dd_h3_Pd_t_0">General Examination</h3>
		</div>
	</div>
	<div class="dd_model"> 
		{!! Form::open(array('route' => 'addCardiacExamination', 'role'=>'form', 'id'=>'addCardiacExamination', 'class'=>'form-horizontal','novalidate'=>'novalidate')) !!}	
		<div class="">
			<div class="col-sm-12 dd_mg_top_10 ">
			@if(!empty($vitalExist))
				<div class="form-group ">
					 {!! Form::label('weight', 'Weight (kg)', $attributes = array('class'=>"col-sm-2"));  !!} 
					<div class="col-sm-2">
					

						<span>
						{!! Form::text('weight', $vitalExist->weight, $attributes = array('class'=>'form-control','data-validetta'=>"required,minLength[2],maxLength[3]"));  !!}
						</span>
					</div>
				 {!! Form::label('height', 'Height (cm)', $attributes = array('class'=>"col-sm-2"));  !!} 
					<div class="col-sm-2">
						<span>
						{!! Form::text('height', $vitalExist->height, $attributes = array('class'=>'form-control','data-validetta'=>"required,minLength[2],maxLength[3]"));  !!}
												
						</span>
					</div>
					 {!! Form::label('bmi', 'BMI', $attributes = array('class'=>"col-sm-2"));  !!} 
					<div class="col-sm-2">
						<span>
						{!! Form::text('bmi',  $vitalExist->bmi, $attributes = array('class'=>'form-control'));  !!}
												
						</span>
					</div>
				</div>
			
				<div class="form-group">
					{!! Form::label('pulse', 'Pulse (beats/min)', $attributes = array('class'=>"col-sm-2"));  !!} 
					<div class="col-sm-2">
						<span>
						{!! Form::text('pulse',  $vitalExist->pulse, $attributes = array('class'=>'form-control'));  !!}
						</span>
					</div>
					 {!! Form::label('respiratory_rate', 'Respiratory rate (breathes/min)', $attributes = array('class'=>"col-sm-2"));  !!} 
					<div class="col-sm-2">
						<span>
						{!! Form::text('respiratory_rate',  $vitalExist->respiratoryrate, $attributes = array('class'=>'form-control dd_ellips'));  !!}
												
						</span>
					</div>
					{!! Form::label('bmi', 'Temperature (Fahrenheit)', $attributes = array('class'=>"col-sm-2"));  !!} 
					<div class="col-sm-2">
						<span>
						{!! Form::text('temperature',  $vitalExist->temperature, $attributes = array('class'=>'form-control'));  !!}
												
						</span>
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('spo2', 'SPO2 (%)', $attributes = array('class'=>"col-sm-2"));  !!} 

					<div class="col-sm-2">
						<span>
						{!! Form::text('spo2',  $vitalExist->sp, $attributes = array('class'=>'form-control'));  !!}
												
						</span>
					</div>

					{!! Form::label('bloodgroup', 'Blood Group', $attributes = array('class'=>"col-sm-2"));  !!} 
					<div class="col-sm-2">
						<span>
						<!-- {!! Form::select('bloodgroup', $bloodGroup,$vitalExist->blood_group, $attributes = array('class' => 'form-control')); !!} -->
						@if(!empty($vitalExist->blood_group))
							{!! Form::text('bloodgroup', $vitalExist->blood_group, $attributes = array('class'=>'form-control','readonly'=>'readonly'));  !!}
						@else
							{!! Form::select('bloodgroup', $bloodGroup,null, $attributes = array('class' => 'form-control')); !!} 
						@endif	
						</span>
					</div>

					<div class="dd_relative"> 
					 {!! Form::label('pressure', 'Blood Pressure (Systolic / Diastolic [mm/Hg])', $attributes = array('class'=>"col-sm-2"));  !!} 
					<div class="col-sm-1">
						<span class="sys_dia_pressure">
						{!! Form::text('systolic_pressure', $vitalExist->systolic_pressure, $attributes = array('class'=>'form-control dd_ellips '));  !!}
												
						</span>
					</div>
					<!--  {!! Form::label('diastolic_pressure', 'Blood Pressure (Diastolic [mm/Hg])', $attributes = array('class'=>"col-sm-2"));  !!}  -->

					<div class="col-sm-1">
						<span class="sys_dia_pressure">
						{!! Form::text('diastolic_pressure', $vitalExist->diastolic_pressure, $attributes = array('class'=>'form-control dd_ellips '));  !!}
												
						</span>
					</div>
					<div class="pressure">/</div>
					</div>

				</div>
				
			@else
				<div class="form-group">
					{!! Form::label('weight', 'Weight (kg)', $attributes = array('class'=>"col-sm-2"));  !!} 
					<div class="col-sm-2">
					
						<span>
						{!! Form::text('weight', Input::old('weight'), $attributes = array('class'=>'form-control'));  !!}
						</span>
					</div>
				
					{!! Form::label('height', 'Height (cm)', $attributes = array('class'=>"col-sm-2"));  !!} 
					<div class="col-sm-2">
					
						<span>
						{!! Form::text('height',  Input::old('height'), $attributes = array('class'=>'form-control'));  !!}
												
						</span>
					</div>
					 {!! Form::label('bmi', 'BMI', $attributes = array('class'=>"col-sm-2"));  !!} 
					<div class="col-sm-2">
					
						<span>
						{!! Form::text('bmi',  Input::old('bmi'), $attributes = array('class'=>'form-control'));  !!}
												
						</span>
					</div>
				</div>
				
				<div class="form-group">
					 {!! Form::label('pulse', 'Pulse (beats/min)', $attributes = array('class'=>"col-sm-2"));  !!} 
					<div class="col-sm-2">
					
						<span>
						{!! Form::text('pulse',  Input::old('pulse'), $attributes = array('class'=>'form-control'));  !!}
						</span>
					</div>
					{!! Form::label('height', 'Respiratory Rate (breathes/min)', $attributes = array('class'=>"col-sm-2"));  !!}
					<div class="col-sm-2">
					
						<span>
						{!! Form::text('respiratory_rate',  Input::old('respiratory_rate'), $attributes = array('class'=>'form-control dd_ellips'));  !!}
												
						</span>
					</div>

					{!! Form::label('bmi', 'Temperature (Fahrenheit)', $attributes = array('class'=>"col-sm-2"));  !!} 
					<div class="col-sm-2">
				
						<span>
						{!! Form::text('temperature',  Input::old('temperature'), $attributes = array('class'=>'form-control'));  !!}
												
						</span>
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('spo2', 'SP O2 (%)', $attributes = array('class'=>"col-sm-2"));  !!} 
					<div class="col-sm-2">
					
						<span>
						{!! Form::text('spo2',  Input::old('spo2'), $attributes = array('class'=>'form-control'));  !!}
												
						</span>
					</div>
					{!! Form::label('bloodgroup', 'Blood Group', $attributes = array('class'=>"col-sm-2"));  !!} 
					<div class="col-sm-2">
				
						<span>
						{!! Form::select('bloodgroup', $bloodGroup, null, $attributes = array('class' => 'form-control')); !!}
						</span>
					</div>
					
					<div class="dd_relative"> 
					 {!! Form::label('pressure', 'Blood Pressure (Systolic / Diastolic [mm/Hg])', $attributes = array('class'=>"col-sm-2"));  !!} 
					<div class="col-sm-1">
						<span class="sys_dia_pressure">
						{!! Form::text('systolic_pressure',null, $attributes = array('class'=>'form-control dd_ellips '));  !!}
												
						</span>
					</div>
					<!--  {!! Form::label('diastolic_pressure', 'Blood Pressure (Diastolic [mm/Hg])', $attributes = array('class'=>"col-sm-2"));  !!}  -->

					<div class="col-sm-1">
						<span class="sys_dia_pressure">
						{!! Form::text('diastolic_pressure', null, $attributes = array('class'=>'form-control dd_ellips '));  !!}
												
						</span>
					</div>
					<div class="pressure">/</div>
					</div>


				</div>
				
			@endif	
			<hr>
			
			@if(!empty($cardioExamData))
				<div class="row">
					<div class="col-md-3">
						<div class="panel panel-default">
							<div class="panel-heading">
								CVS
							</div>
							<div class="panel-body">
								<div class="form-group">
									   
									<div class="col-sm-6">
										<label class="radio-inline">
											@if(!empty($cardioExamData->cvs_status) && $cardioExamData->cvs_status=="Normal")
												{!! Form::radio('cvs', 'Normal', true, ['class' => 'cvs-normal'])  !!}
											@else		
												{!! Form::radio('cvs', 'Normal', null, ['class' => 'cvs-normal']) !!}
											@endif	
											Normal
										</label>
									</div>
									<div class="col-sm-6">
										<label class="radio-inline">
											@if(!empty($cardioExamData->cvs_status) && $cardioExamData->cvs_status=="Abnormal")
												{!! Form::radio('cvs', 'Abnormal', true, ['class' => 'cvs-normal']) !!}
											@else
												{!! Form::radio('cvs', 'Abnormal', null, ['class' => 'cvs-normal']) !!}
											@endif
											Abnormal
										</label>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-12">
										{!! Form::textarea('cvs_comments',$cardioExamData->cvs_comments,['class'=>'form-control cvs-comments','placeholder'=>"Comments"]) !!}
									</div>
								</div>		
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="panel panel-default">
							<div class="panel-heading">
								LUNGS
							</div>
							<div class="panel-body">
								<div class="form-group">
									<div class="col-sm-6">
										<label class="radio-inline">
											@if(!empty($cardioExamData->lungs_status) && $cardioExamData->lungs_status=="Normal")
												{!! Form::radio('lungs', 'Normal', true, ['class' => 'lungs_normal']) !!}
											@else
												{!! Form::radio('lungs', 'Normal', null, ['class' => 'lungs_normal']) !!}
											@endif	
											Normal
										</label>
									</div>
									<div class="col-sm-6">
										<label class="radio-inline">
											@if(!empty($cardioExamData->lungs_status) && $cardioExamData->lungs_status=="Abnormal")
												{!! Form::radio('lungs', 'Abnormal', true, ['class' => 'lungs_normal']) !!}
											@else
												{!! Form::radio('lungs', 'Abnormal', null, ['class' => 'lungs_normal']) !!}
											@endif	
											Abnormal
										</label>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-12">
										{!! Form::textarea('lungs_comments',$cardioExamData->lungs_comments,['class'=>'form-control lungs-comments','placeholder'=>"Comments"]) !!}
									</div>
								</div>		
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="panel panel-default">
							<div class="panel-heading">
								ABDOMEN
							</div>
							<div class="panel-body">
								<div class="form-group">
									<div class="col-sm-6">
										<label class="radio-inline">
											@if(!empty($cardioExamData->abdomen_status) && $cardioExamData->abdomen_status=="Normal")
												{!! Form::radio('abdomen', 'Normal', true, ['class' => 'abdomen_normal']) !!}
											@else
												{!! Form::radio('abdomen', 'Normal', null, ['class' => 'abdomen_normal']) !!}
											@endif
											Normal
										</label>
									</div>
									<div class="col-sm-6">
										<label class="radio-inline">
											@if(!empty($cardioExamData->abdomen_status) && $cardioExamData->abdomen_status=="Abnormal")
												{!! Form::radio('abdomen', 'Abnormal', true, ['class' => 'abdomen_normal']) !!}
											@else
												{!! Form::radio('abdomen', 'Abnormal', null, ['class' => 'abdomen_normal']) !!}
											@endif
											Abnormal
										</label>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-12">
										{!! Form::textarea('abdomen_comments',$cardioExamData->abdomen_comments,['class'=>'form-control abdomen-comments', 'placeholder'=>"Comments"]) !!}
									</div>
								</div>		
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="panel panel-default">
							<div class="panel-heading">
								ECG
							</div>
							<div class="panel-body">
								<div class="form-group">
									<div class="col-sm-6">
										<label class="radio-inline">
											@if(!empty($cardioExamData->abdomen_status) && $cardioExamData->ecg_status=="Normal")
												{!! Form::radio('ecg', 'Normal', true, ['class' => 'ecg_normal']) !!}
											@else
												{!! Form::radio('ecg', 'Normal', null, ['class' => 'ecg_normal']) !!}
											@endif
											Normal
										</label>
									</div>
									<div class="col-sm-6">
										<label class="radio-inline">
											@if(!empty($cardioExamData->abdomen_status) && $cardioExamData->ecg_status=="Abnormal")
												{!! Form::radio('ecg', 'Abnormal', true, ['class' => 'ecg_normal']) !!}
											@else
												{!! Form::radio('ecg', 'Abnormal', null, ['class' => 'ecg_normal']) !!}
											@endif
											Abnormal
										</label>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-12">
										{!! Form::textarea('ecg_comments',$cardioExamData->ecg_comments,['class'=>'form-control ecg 	-comments', 'placeholder'=>"Comments"]) !!}
									</div>
								</div>		
							</div>
						</div>
					</div>
					<div class="form-group dd_fromgroup_MG_0">
							 	<div class="col-sm-12 ">
									<div class="col-sm-12">
										<button type="submit" class="btn btn-primary btn-block dd_btn_center">
										<i class="fa fa-floppy-o" aria-hidden="true"></i>
										Save</button>
									</div>
								</div>
							</div>
				</div>			
			@else

				<div class="row">
					<div class="col-md-3">
						<div class="panel panel-default">
							<div class="panel-heading">
								CVS
							</div>
							<div class="panel-body">
								<div class="form-group">
									<div class="col-sm-6">
										<label class="radio-inline">
											{!! Form::radio('cvs', 'Normal', null, ['class' => 'cvs-normal']) !!}
											Normal
										</label>
									</div>
									<div class="col-sm-6">
										<label class="radio-inline">
											{!! Form::radio('cvs', 'Abnormal', null, ['class' => 'cvs-normal']) !!}
											Abnormal
										</label>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-12">
										{!! Form::textarea('cvs_comments','',['class'=>'form-control cvs-comments', 'rows' => 2, 'cols' => 40,'placeholder'=>"Comments"]) !!}
									</div>
								</div>		
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="panel panel-default">
							<div class="panel-heading">
								LUNGS
							</div>
							<div class="panel-body">
								<div class="form-group">
									<div class="col-sm-6">
										<label class="radio-inline">
											{!! Form::radio('lungs', 'Normal', null, ['class' => 'lungs_normal']) !!}
											Normal
										</label>
									</div>
									<div class="col-sm-6">
										<label class="radio-inline">
											{!! Form::radio('lungs', 'Abnormal', null, ['class' => 'lungs_normal']) !!}
											Abnormal
										</label>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-12">
										{!! Form::textarea('lungs_comments','',['class'=>'form-control lungs-comments', 'rows' => 2, 'cols' => 40,'placeholder'=>"Comments"]) !!}
									</div>
								</div>		
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="panel panel-default">
							<div class="panel-heading">
								ABDOMEN
							</div>
							<div class="panel-body">
								<div class="form-group">
									<div class="col-sm-6">
										<label class="radio-inline">
											{!! Form::radio('abdomen', 'Normal', null, ['class' => 'abdomen_normal']) !!}
											Normal
										</label>
									</div>
									<div class="col-sm-6">
										<label class="radio-inline">
											{!! Form::radio('abdomen', 'Abnormal', null, ['class' => 'abdomen_normal']) !!}
											Abnormal
										</label>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-12">
										{!! Form::textarea('abdomen_comments','',['class'=>'form-control abdomen-comments', 'rows' => 2, 'cols' => 40,'placeholder'=>"Comments"]) !!}
									</div>
								</div>		
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="panel panel-default">
							<div class="panel-heading">
								ECG
							</div>
							<div class="panel-body">
								<div class="form-group">
									<div class="col-sm-6">
										<label class="radio-inline">
											{!! Form::radio('ecg', 'Normal', null, ['class' => 'ecg_normal']) !!}
											Normal
										</label>
									</div>
									<div class="col-sm-6">
										<label class="radio-inline">
											{!! Form::radio('ecg', 'Abnormal', null, ['class' => 'ecg_normal']) !!}
											Abnormal
										</label>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-12">
										{!! Form::textarea('ecg_comments','',['class'=>'form-control ecg 	-comments', 'rows' => 2, 'cols' => 40,'placeholder'=>"Comments"]) !!}
									</div>
								</div>		
							</div>
						</div>
					</div>
					<div class="form-group dd_fromgroup_MG_0">
							 	<div class="col-sm-12 ">
									<div class="col-sm-12">
										<button type="submit" class="btn btn-primary btn-block dd_btn_center">
										<i class="fa fa-floppy-o" aria-hidden="true"></i>
										Save</button>
									</div>
								</div>
							</div>
				</div>			
			@endif
				
		</div>
	{!! Form::close() !!}
	</div> <!-- Panel body ends -->
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
		{!!Html::script('assets/js/patient-personal-information.js')!!}

		{!!Html::script('assets/plugins/tooltip-validation/jquery-validate.bootstrap-tooltip.js')!!}
	<script>
		$(document).ready(function() {
			Main.init();
			patientElements.init();

			$(window).load(function() {
				$(".loader").fadeOut("slow");
				
			});


			$('.tooltip tooltip-inner').css("background-color","red"); 

    $("#addPatientExamination").validate({
    	rules: {
           weight: { digits:true },
           height: { digits:true },
           systolic_pressure: 
           					{ 
           						digits:true, 
           						required: true,
           						range:[57,200]
           					},
           	diastolic_pressure: 
           					{ 
           						digits:true, 
           						required: true,
           						range:[40,120]
           					},
           	
           	pulse : { number:true, range:[40,220]},
            respiratory_rate : { number:true, range:[12,50]},
            temperature : { number:true, range:[75,111.2]},
            spo2 : { number:true, range:[55,100]},
           
            
        },
        tooltip_options: {
           weight: { placement: 'top' },
           weight: { placement: 'top' },
           systolic_pressure: { placement: 'bottom' },
           diastolic_pressure: { placement: 'bottom' },
           pulse : { placement: 'top' },
           temperature : { placement: 'left' },
           spo2: { placement: 'bottom' },
        }
        /*rules: {
            height: { required: true},
            weight: {required: true}
        },
        messages: {
            example5: "Just check the box<h5 class='text-danger'>You aren't going to read the EULA</h5>"
        },
        tooltip_options: {
            height: {trigger:'focus'},
            weight: {placement:'left',html:true}
        },*/
    });





		
			

	 	});
	</script>
@stop	