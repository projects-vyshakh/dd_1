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

              	@if(empty($patientPersonalData))
	                <div class="alert alert-danger display-none" style="display: block;">
	                  	<a class="close" aria-hidden="true" href="#" data-dismiss="alert">×</a>
	                        {{"Please save patient personal information."}}
	                </div>
            	@endif

		</div>
		<div class="col-sm-8">
			<h3 class="dd_h3_Pd_t_0">General Examination</h3>
		</div>
	</div>
	<div class="dd_model"> 
		{!! Form::open(array('route' => 'addPatientExamination', 'role'=>'form', 'id'=>'addPatientExamination', 'class'=>'form-horizontal','novalidate'=>'novalidate')) !!}	
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
						{!! Form::text('bmi',  $vitalExist->bmi, $attributes = array('class'=>'form-control','readonly'=>'readonly'));  !!}
												
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
					{!! Form::label('temperature', 'Temperature (Fahrenheit)', $attributes = array('class'=>"col-sm-2"));  !!} 
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
						{!! Form::text('bmi',  Input::old('bmi'), $attributes = array('class'=>'form-control','readonly'=>'readonly'));  !!}
												
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

					{!! Form::label('temperature', 'Temperature (Fahrenheit)', $attributes = array('class'=>"col-sm-2"));  !!} 
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
				<div class="form-group">
					<div class="col-sm-8">
						<h3 class="dd_h3_Pd_t_0">Systemic Examination</h3>
					</div>
				</div>

				<!-- External Genetalia -->
			@if(!empty($diagExam))	
				<div class="form-group">
					<div class="col-sm-3 dd_font_bold">
						<h5>{!! Form::label('ext_genetalia', 'External Genetalia', $attributes = array('class'=>""));  !!}</h5>
					</div>
					<div class="col-sm-4">
						<span>
							<label class="dd_beforfood_pd" >
								@if($diagExam->diag_systemic_external_genetalia=="Normal")
									<input type="radio"  class="before_food" name="ext_genetalia" value="Normal" checked="checked">Normal
								@else
									<input type="radio"  class="before_food" name="ext_genetalia" value="Normal" >Normal
								@endif
							</label>
							<label class="dd_beforfood_pd">
								@if($diagExam->diag_systemic_external_genetalia=="Abnormal") 
									<input type="radio"  class="after_food" name="ext_genetalia" value="Abnormal" checked="checked" >Abnormal
								@else
									<input type="radio"  class="after_food" name="ext_genetalia" value="Abnormal" >Abnormal
								@endif
							</label>
						</span>
					</div>
					<div class="col-sm-4">
						<span>
						{!! Form::text('ext_genetalia_other',  $diagExam->diag_systemic_external_genetalia_detail, $attributes = array('class'=>'form-control','placeholder' => ''));  !!}
						</span>
					</div>
					
				</div>
			@else
				<div class="form-group">
					<div class="col-sm-3 dd_font_bold">
						{!! Form::label('ext_genetalia', 'External Genetalia', $attributes = array('class'=>"stemic Examination</h3>
					</div>
						dd_font_bold"));  !!}
					</div>
					<div class="col-sm-4">
						<span>
							<label class="dd_beforfood_pd" >
								<input type="radio"  class="before_food" name="ext_genetalia" value="Normal">Normal
							</label>
							<label class="dd_beforfood_pd">
								<input type="radio"  class="after_food" name="ext_genetalia" value="Abnormal">Abnormal
							</label>
						</span>
					</div>
					<div class="col-sm-4">
						<span>
						{!! Form::text('ext_genetalia_other',  Input::old('ext_genetalia_other'), $attributes = array('class'=>'form-control','placeholder' => ''));  !!}
						</span>
					</div>
					
				</div>
			@endif
				<!-- External Genetalia -->
			
				<!-- Pre Abdomen Examination -->
			@if(!empty($diagExam))		
				<div class="form-group">
					<div class="col-sm-3 dd_font_bold">
						{!! Form::label('preabdomen_examination', 'Pre Abdomen Examination', $attributes = array('class'=>""));  !!}
					</div>
					
					<div class="col-sm-4">
						<span>
							@if($diagExam->diag_systemic_preabdomen=="Normal")
								<label class="dd_beforfood_pd" >
									<input type="radio"  class="before_food" name="preabdomen_examination" value="Normal" checked="checked">Normal
								</label>
							@else
								<label class="dd_beforfood_pd" >
									<input type="radio"  class="before_food" name="preabdomen_examination" value="Normal" >Normal
								</label>
							@endif
							@if($diagExam->diag_systemic_preabdomen=="Abnormal")
								<label class="dd_beforfood_pd">
									<input type="radio"  class="after_food" name="preabdomen_examination" value="Abnormal" checked="checked">Abnormal
								</label>
							@else
								<label class="dd_beforfood_pd">
									<input type="radio"  class="after_food" name="preabdomen_examination" value="Abnormal">Abnormal
								</label>
							@endif		
						</span>
					</div>
					<div class="col-sm-4">
						<span>
						{!! Form::text('preabdomin_other',  $diagExam->diag_systemic_preabdomen_detail, $attributes = array('class'=>'form-control','placeholder' => ''));  !!}
						</span>
					</div>
					
				</div>
			@else
				<div class="form-group">
					<div class="col-sm-3 dd_font_bold">
						{!! Form::label('preabdomen_examination', 'Pre Abdomen Examination', $attributes = array('class'=>""));  !!}
					</div>
					<div class="col-sm-4">
						<span>
							<label class="dd_beforfood_pd" >
								<input type="radio"  class="before_food" name="preabdomen_examination" value="Normal">Normal
							</label>
							<label class="dd_beforfood_pd">
								<input type="radio"  class="after_food" name="preabdomen_examination" value="Abnormal">Abnormal
							</label>
						</span>	
					</div>
					<div class="col-sm-4">
						<span>
						{!! Form::text('preabdomin_other',  Input::old('preabdomin_other'), $attributes = array('class'=>'form-control','placeholder' => ''));  !!}
						</span>
					</div>
					
				</div>
			@endif	
				<!-- Pre Abdomen Examination -->

				<!-- BREAST -->
			@if(!empty($diagExam))		
				<div class="form-group">
					<div class="col-sm-3 dd_font_bold">
						{!! Form::label('sys_breast', 'Breast', $attributes = array('class'=>""));  !!}
					</div>
				</div>
				<div class="form-group">
					<div class="dd_examination">
						{!! Form::label('sys_breast_lump', 'Lump', $attributes = array('class'=>"col-sm-3 dd_mg_personal_15px_left"));  !!}
						<div class="col-sm-4">
							<span>
								@if($diagExam->diag_systemic_breast_lump=="Yes")
									<label class="dd_beforfood_pd" >
										<input type="radio"  class="before_food" name="sys_breast_lump" value="Yes" checked="checked">Yes
									</label>
								@else
									<label class="dd_beforfood_pd" >
										<input type="radio"  class="before_food" name="sys_breast_lump" value="Yes">Yes
									</label>
								@endif	
								@if($diagExam->diag_systemic_breast_lump=="No")
									<label class="dd_beforfood_pd">
										<input type="radio"  class="after_food" name="sys_breast_lump" value="No" checked="checked">No
									</label>
								@else
									<label class="dd_beforfood_pd">
										<input type="radio"  class="after_food" name="sys_breast_lump" value="No">No
									</label>
								@endif	

							</span>	
						</div>
						<div class="col-sm-4">
							<span>
							{!! Form::text('sys_breast_lump_other', $diagExam->diag_systemic_breast_detail, $attributes = array('class'=>'form-control','placeholder' => ''));  !!}
							</span>
						</div>
					</div>
				</div>	
				<div class="form-group">
					<div class="dd_examination">
						{!! Form::label('sys_breast_galactorrhea', 'Galactorrhea', $attributes = array('class'=>"col-sm-3 dd_mg_personal_15px_left"));  !!}
						<div class="col-sm-4">
							<span>
								@if($diagExam->diag_systemic_breast_galatorrhea=="Yes")
									<label class="dd_beforfood_pd" >
										<input type="radio"  class="before_food" name="sys_breast_galactorrhea" value="Yes" checked="checked">Yes
									</label>
								@else
									<label class="dd_beforfood_pd" >
										<input type="radio"  class="before_food" name="sys_breast_galactorrhea" value="Yes" >Yes
									</label>
								@endif	
								@if($diagExam->diag_systemic_breast_galatorrhea=="No")
									<label class="dd_beforfood_pd" >
										<input type="radio"  class="before_food" name="sys_breast_galactorrhea" value="No" checked="checked">No
									</label>
								@else
									<label class="dd_beforfood_pd" >
										<input type="radio"  class="before_food" name="sys_breast_galactorrhea" value="No" >No
									</label>
								@endif

							</span>	
						</div>
						<div class="col-sm-4">
							<span>
							{!! Form::text('sys_breast_galactorrhea_other',  $diagExam->diag_systemic_breast_galatorrhea_detail, $attributes = array('class'=>'form-control','placeholder' => ''));  !!}
							</span>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="dd_examination">
							{!! Form::label('sys_breast_other', 'Other', $attributes = array('class'=>"col-sm-3 dd_mg_personal_15px_left "));  !!}
							<div class="col-sm-4">
								@if($diagExam->diag_systemic_breast_other=="Yes")
									<label class="dd_beforfood_pd" >
										<input type="radio"  class="before_food" name="sys_breast_other" value="Yes" checked="checked">Yes
									</label>
								@else
									<label class="dd_beforfood_pd" >
										<input type="radio"  class="before_food" name="sys_breast_other" value="Yes" >Yes
									</label>
								@endif	
								@if($diagExam->diag_systemic_breast_other=="No")
									<label class="dd_beforfood_pd" >
										<input type="radio"  class="before_food" name="sys_breast_other" value="No" checked="checked">No
									</label>
								@else
									<label class="dd_beforfood_pd" >
										<input type="radio"  class="before_food" name="sys_breast_other" value="No" >No
									</label>
								@endif
							</div>
							<div class="col-sm-4">
								<span>
								{!! Form::text('sys_breast_other_other',  $diagExam->diag_systemic_breast_other_detail, $attributes = array('class'=>'form-control','placeholder' => ''));  !!}
								</span>
							</div>
					</div>
				</div>
			@else
				<div class="form-group">
					<div class="col-sm-3 dd_font_bold">
						{!! Form::label('sys_breast', 'Breast', $attributes = array('class'=>""));  !!}
					</div>
				</div>
				<div class="form-group">
					<div class="dd_examination">
						{!! Form::label('sys_breast_lump', 'Lump', $attributes = array('class'=>"col-sm-3 dd_mg_personal_15px_left"));  !!}
						<div class="col-sm-4">
							<span>
								<label class="dd_beforfood_pd" >
									<input type="radio"  class="before_food" name="sys_breast_lump" value="Yes" >Yes
								</label>
							
								<label class="dd_beforfood_pd" >
									<input type="radio"  class="before_food" name="sys_breast_lump" value="No">No
								</label>
							</span>
						</div>
						<div class="col-sm-4">
							<span>
							{!! Form::text('sys_breast_lump_other',  Input::old('sys_breast_lump_other'), $attributes = array('class'=>'form-control','placeholder' => ''));  !!}
							</span>
						</div>
					</div>
				</div>	
				<div class="form-group">
					<div class="dd_examination">
						{!! Form::label('sys_breast_galactorrhea', 'Galactorrhea', $attributes = array('class'=>"col-sm-3 dd_mg_personal_15px_left"));  !!}
						<div class="col-sm-4">
							<span>

								<label class="dd_beforfood_pd" >
									<input type="radio"  class="before_food" name="sys_breast_galactorrhea" value="Yes" >Yes
								</label>
								
								<label class="dd_beforfood_pd" >
									<input type="radio"  class="before_food" name="sys_breast_galactorrhea" value="No" >No
								</label>

							</span>
						</div>
						<div class="col-sm-4">
							<span>
							{!! Form::text('sys_breast_galactorrhea_other',  Input::old('sys_breast_galactorrhea_other'), $attributes = array('class'=>'form-control','placeholder' => ''));  !!}
							</span>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="dd_examination">
							{!! Form::label('sys_breast_other', 'Other', $attributes = array('class'=>"col-sm-3 dd_mg_personal_15px_left"));  !!}
							<div class="col-sm-4">
								<span>
									<label class="dd_beforfood_pd" >
										<input type="radio"  class="before_food" name="sys_breast_other" value="Yes" >Yes
									</label>
								
									<label class="dd_beforfood_pd" >
										<input type="radio"  class="before_food" name="sys_breast_other" value="No" >No
									</label>
								
								</span>
							</div>
							<div class="col-sm-4">
								<span>
								{!! Form::text('sys_breast_other_other',  Input::old('sys_breast_other_other'), $attributes = array('class'=>'form-control','placeholder' => ''));  !!}
								</span>
							</div>
					</div>
				</div>
			@endif	
				
				<!-- BREAST -->

				<!-- Secondary Sex -->
			@if(!empty($diagExam))	
				<div class="form-group">
					<div class="col-sm-3 dd_font_bold">
						{!! Form::label('sys_breast', 'Secondary Sex', $attributes = array('class'=>""));  !!}
					</div>
				</div>
				<div class="form-group">
					<div class="dd_examination">
							{!! Form::label('sys_secondarysex_welldeveloped', 'Well Developed', $attributes = array('class'=>"col-sm-3 dd_mg_personal_15px_left"));  !!}
							<div class="col-sm-4">
								<span>
									@if($diagExam->diag_systemic_secondarysex_welldeveloped=="Yes")
										<label class="dd_beforfood_pd" >
											<input type="radio"  class="before_food" name="sys_secondarysex_welldeveloped" value="Yes" checked="checked">Yes
										</label>
									@else
										<label class="dd_beforfood_pd" >
											<input type="radio"  class="before_food" name="sys_secondarysex_welldeveloped" value="Yes" >Yes
										</label>
									@endif	
									@if($diagExam->diag_systemic_secondarysex_welldeveloped=="No")
										<label class="dd_beforfood_pd" >
											<input type="radio"  class="before_food" name="sys_secondarysex_welldeveloped" value="No" checked="checked">No
										</label>
									@else
										<label class="dd_beforfood_pd" >
											<input type="radio"  class="before_food" name="sys_secondarysex_welldeveloped" value="No" >No
										</label>
									@endif
								</span>
							</div>
							<div class="col-sm-4">
								<span>
								{!! Form::text('sys_secondarysex_welldeveloped_other',  $diagExam->diag_systemic_secondarysex_welldeveloped_detail, $attributes = array('class'=>'form-control','placeholder' => ''));  !!}
								</span>
							</div>
					</div>
				</div>	
				<div class="form-group">	
					<div class="dd_examination">
							{!! Form::label('sys_secondarysex_hair', 'Hair', $attributes = array('class'=>"col-sm-3 dd_mg_personal_15px_left"));  !!}
							<div class="col-sm-4">
								<span>
									@if($diagExam->diag_systemic_secondarysex_hair=="Yes")
										<label class="dd_beforfood_pd" >
											<input type="radio"  class="before_food" name="sys_secondarysex_hair" value="Yes" checked="checked">Yes
										</label>
									@else
										<label class="dd_beforfood_pd" >
											<input type="radio"  class="before_food" name="sys_secondarysex_hair" value="Yes" >Yes
										</label>
									@endif	
									@if($diagExam->diag_systemic_secondarysex_hair=="No")
										<label class="dd_beforfood_pd" >
											<input type="radio"  class="before_food" name="sys_secondarysex_hair" value="No" checked="checked">No
										</label>
									@else
										<label class="dd_beforfood_pd" >
											<input type="radio"  class="before_food" name="sys_secondarysex_hair" value="No" >No
										</label>
									@endif
								</span>
							</div>
							<div class="col-sm-4">
								<span>
								{!! Form::text('sys_secondarysex_hair_other',  $diagExam->diag_systemic_secondarysex_hair_detail, $attributes = array('class'=>'form-control','placeholder' => ''));  !!}
								</span>
							</div>
					</div>
				</div>
				<div class="form-group">	
					<div class="dd_examination">
							{!! Form::label('sys_secondarysex_acne', 'Acne', $attributes = array('class'=>"col-sm-3 dd_mg_personal_15px_left"));  !!}
							<div class="col-sm-4">
								<span>
									@if($diagExam->diag_systemic_secondarysex_acne=="Yes")
										<label class="dd_beforfood_pd" >
											<input type="radio"  class="before_food" name="sys_secondarysex_acne" value="Yes" checked="checked">Yes
										</label>
									@else
										<label class="dd_beforfood_pd" >
											<input type="radio"  class="before_food" name="sys_secondarysex_acne" value="Yes" >Yes
										</label>
									@endif	
									@if($diagExam->diag_systemic_secondarysex_acne=="No")
										<label class="dd_beforfood_pd" >
											<input type="radio"  class="before_food" name="sys_secondarysex_acne" value="No" checked="checked">No
										</label>
									@else
										<label class="dd_beforfood_pd" >
											<input type="radio"  class="before_food" name="sys_secondarysex_acne" value="No" >No
										</label>
									@endif
								</span>
							</div>
							<div class="col-sm-4">
								<span>
								{!! Form::text('sys_secondarysex_acne_other',  $diagExam->diag_systemic_secondarysex_acne_detail, $attributes = array('class'=>'form-control','placeholder' => ''));  !!}
								</span>
							</div>
					</div>
				</div>
				<div class="form-group">	
					<div class="dd_examination">
							{!! Form::label('sys_secondarysex_other', 'Other', $attributes = array('class'=>"col-sm-3 dd_mg_personal_15px_left"));  !!}
							<div class="col-sm-4">
								<span>
									@if($diagExam->diag_systemic_secondarysex_other=="Yes")
										<label class="dd_beforfood_pd" >
											<input type="radio"  class="before_food" name="sys_secondarysex_other" value="Yes" checked="checked">Yes
										</label>
									@else
										<label class="dd_beforfood_pd" >
											<input type="radio"  class="before_food" name="sys_secondarysex_other" value="Yes" >Yes
										</label>
									@endif	
									@if($diagExam->diag_systemic_secondarysex_other=="No")
										<label class="dd_beforfood_pd" >
											<input type="radio"  class="before_food" name="sys_secondarysex_other" value="No" checked="checked">No
										</label>
									@else
										<label class="dd_beforfood_pd" >
											<input type="radio"  class="before_food" name="sys_secondarysex_other" value="No" >No
										</label>
									@endif
								</span>
							</div>
							<div class="col-sm-4">
								<span>
								{!! Form::text('sys_secondarysex_other_other',  $diagExam->diag_systemic_secondarysex_other_detail, $attributes = array('class'=>'form-control','placeholder' => ''));  !!}
								</span>
							</div>
					</div>
				</div>
			@else
				<div class="form-group">
					<div class="col-sm-3 dd_font_bold ">
						{!! Form::label('sys_breast', 'Secondary Sex', $attributes = array('class'=>""));  !!}
					</div>
				</div>
				<div class="form-group">
					<div class="dd_examination">
							{!! Form::label('sys_secondarysex_welldeveloped', ' Well Developed', $attributes = array('class'=>"col-sm-3 "));  !!}
							<div class="col-sm-4">
								<span>
									<label class="dd_beforfood_pd" >
											<input type="radio"  class="before_food" name="sys_secondarysex_welldeveloped" value="Yes" >Yes
										</label>
									
									<label class="dd_beforfood_pd" >
										<input type="radio"  class="before_food" name="sys_secondarysex_welldeveloped" value="No" >No
									</label>
								</span>
							</div>
							<div class="col-sm-4">
								<span>
								{!! Form::text('sys_secondarysex_welldeveloped_other',  Input::old('sys_secondarysex_welldeveloped'), $attributes = array('class'=>'form-control','placeholder' => ''));  !!}
								</span>
							</div>
					</div>
				</div>	
				<div class="form-group">	
					<div class="dd_examination">
							{!! Form::label('sys_secondarysex_hair', 'Hair', $attributes = array('class'=>"col-sm-3 dd_mg_personal_15px_left"));  !!}
							<div class="col-sm-4">
								<span>
									<label class="dd_beforfood_pd" >
											<input type="radio"  class="before_food" name="sys_secondarysex_hair" value="Yes" >Yes
										</label>
									
									<label class="dd_beforfood_pd" >
										<input type="radio"  class="before_food" name="sys_secondarysex_hair" value="No" >No
									</label>
								
								</span>
							</div>
							<div class="col-sm-4">
								<span>
								{!! Form::text('sys_secondarysex_hair_other',  Input::old('sys_secondarysex_hair_other'), $attributes = array('class'=>'form-control','placeholder' => ''));  !!}
								</span>
							</div>
					</div>
				</div>
				<div class="form-group">	
					<div class="dd_examination">
							{!! Form::label('sys_secondarysex_acne', 'Acne', $attributes = array('class'=>"col-sm-3 dd_mg_personal_15px_left"));  !!}
							<div class="col-sm-4">
								<span>
									<label class="dd_beforfood_pd" >
											<input type="radio"  class="before_food" name="sys_secondarysex_acne" value="Yes" >Yes
									</label>
								
									<label class="dd_beforfood_pd" >
										<input type="radio"  class="before_food" name="sys_secondarysex_acne" value="No" >No
									</label>
								
								</span>
							</div>
							<div class="col-sm-4">
								<span>
								{!! Form::text('sys_secondarysex_acne_other',  Input::old('sys_secondarysex_acne_other'), $attributes = array('class'=>'form-control','placeholder' => ''));  !!}
								</span>
							</div>
					</div>
				</div>
				<div class="form-group">	
					<div class="dd_examination">
							{!! Form::label('sys_secondarysex_other', 'Other', $attributes = array('class'=>"col-sm-3 dd_mg_personal_15px_left"));  !!}
							<div class="col-sm-4">
								<span>
									<label class="dd_beforfood_pd" >
											<input type="radio"  class="before_food" name="sys_secondarysex_other" value="Yes" >Yes
									</label>
								
									<label class="dd_beforfood_pd" >
										<input type="radio"  class="before_food" name="sys_secondarysex_other" value="No" >No
									</label>
								
								</span>
							</div>
							<div class="col-sm-4">
								<span>
								{!! Form::text('sys_secondarysex_other_other',  Input::old('sys_secondarysex_other_other'), $attributes = array('class'=>'form-control','placeholder' => ''));  !!}
								</span>
							</div>
					</div>
				</div>
			@endif	
				<!-- Secondary Sex -->

				<hr>
				<!-- Pelvic Examination -->
			@if(!empty($diagExam))	
				<div class="form-group">
					<div class="col-sm-8">
						<h3 class="dd_h3_Pd_t_0">Pelvic Examination</h3>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-12 dd_font_bold">
						{!! Form::label('sys_pelvic_cervix', 'Per Speculum (P/S) Examination: Cervix', $attributes = array('class'=>""));  !!}
					</div>
				</div>
				<div class="form-group">	
					<div class="dd_examination">
							{!! Form::label('sys_pelvic_cervix_healthy', 'Healthy', $attributes = array('class'=>"col-sm-3 dd_mg_personal_15px_left"));  !!}
							<div class="col-sm-4">
								<span>
									@if($diagExam->diag_pelvic_perspeculum_healthy=="Yes")
										<label class="dd_beforfood_pd" >
											<input type="radio"  class="before_food" name="sys_pelvic_cervix_healthy" value="Yes" checked="checked">Yes
										</label>
									@else
										<label class="dd_beforfood_pd" >
											<input type="radio"  class="before_food" name="sys_pelvic_cervix_healthy" value="Yes" >Yes
										</label>
									@endif	
									@if($diagExam->diag_pelvic_perspeculum_healthy=="No")
										<label class="dd_beforfood_pd" >
											<input type="radio"  class="before_food" name="sys_pelvic_cervix_healthy" value="No" checked="checked">No
										</label>
									@else
										<label class="dd_beforfood_pd" >
											<input type="radio"  class="before_food" name="sys_pelvic_cervix_healthy" value="No" >No
										</label>
									@endif
								</span>
								<!-- <span>
								{!! Form::select('sys_pelvic_cervix_healthy', $diagYesNo, $diagExam->diag_pelvic_perspeculum_healthy, $attributes = array('class' => 'form-control')); !!}
								</span> -->
							</div>
							<div class="col-sm-4">
								<span>
								{!! Form::text('sys_pelvic_cervix_healthy_other',  $diagExam->diag_pelvic_perspeculum_healthy_detail, $attributes = array('class'=>'form-control','placeholder' => ''));  !!}
								</span>
							</div>
					</div>
				</div>
				<div class="form-group">	
					<div class="dd_examination">
							{!! Form::label('sys_pelvic_cervix_bleeding', 'Bleeding', $attributes = array('class'=>"col-sm-3 dd_mg_personal_15px_left"));  !!}
							<div class="col-sm-4">
								<span>
									@if($diagExam->diag_pelvic_perspeculum_bleeding=="Yes")
										<label class="dd_beforfood_pd" >
											<input type="radio"  class="before_food" name="sys_pelvic_cervix_bleeding" value="Yes" checked="checked">Yes
										</label>
									@else
										<label class="dd_beforfood_pd" >
											<input type="radio"  class="before_food" name="sys_pelvic_cervix_bleeding" value="Yes" >Yes
										</label>
									@endif	
									@if($diagExam->diag_pelvic_perspeculum_bleeding=="No")
										<label class="dd_beforfood_pd" >
											<input type="radio"  class="before_food" name="sys_pelvic_cervix_bleeding" value="No" checked="checked">No
										</label>
									@else
										<label class="dd_beforfood_pd" >
											<input type="radio"  class="before_food" name="sys_pelvic_cervix_bleeding" value="No" >No
										</label>
									@endif
								</span>
							</div>
							<div class="col-sm-4">
								<span>
								{!! Form::text('sys_pelvic_cervix_bleeding_other',  $diagExam->diag_pelvic_perspeculum_bleeding_detail, $attributes = array('class'=>'form-control','placeholder' => ''));  !!}
								</span>
							</div>
					</div>
				</div>
				<div class="form-group">	
					<div class="dd_examination">
							{!! Form::label('sys_pelvic_cervix_lbc', 'LBC', $attributes = array('class'=>"col-sm-3 dd_mg_personal_15px_left"));  !!}
							<div class="col-sm-4">
								<span>
									@if($diagExam->diag_pelvic_perspeculum_lbc=="Yes")
											<label class="dd_beforfood_pd" >
												<input type="radio"  class="before_food" name="sys_pelvic_cervix_lbc" value="Yes" checked="checked">Yes
											</label>
										@else
											<label class="dd_beforfood_pd" >
												<input type="radio"  class="before_food" name="sys_pelvic_cervix_lbc" value="Yes" >Yes
											</label>
									@endif	
									@if($diagExam->diag_pelvic_perspeculum_lbc=="No")
										<label class="dd_beforfood_pd" >
											<input type="radio"  class="before_food" name="sys_pelvic_cervix_lbc" value="No" checked="checked">No
										</label>
									@else
										<label class="dd_beforfood_pd" >
											<input type="radio"  class="before_food" name="sys_pelvic_cervix_lbc" value="No" >No
										</label>
									@endif
								</span>
							</div>
							<div class="col-sm-4">
								<span>
								{!! Form::text('sys_pelvic_cervix_lbc_other',  $diagExam->diag_pelvic_perspeculum_lbc_detail, $attributes = array('class'=>'form-control','placeholder' => ''));  !!}
								</span>
							</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-12 dd_font_bold">
						{!! Form::label('sys_pelvic_uterus', 'Per Vagina (P/V) Examination: Uterus', $attributes = array('class'=>""));  !!}
					</div>
				</div>
				<div class="form-group">	
					<div class="dd_examination">
							{!! Form::label('sys_pelvic_avaf', 'AVAF', $attributes = array('class'=>"col-sm-3 dd_mg_personal_15px_left"));  !!}
							<div class="col-sm-4">
								<span>
								{!! Form::select('sys_pelvic_avaf', $diagAvafRvrf, $diagExam->diag_pelvic_pervaginal_avaf, $attributes = array('class' => 'form-control')); !!}
								</span>
							</div>
							
					</div>
				</div>	
				<div class="form-group">
					<div class="dd_examination">
							{!! Form::label('sys_pelvic_rvrf', 'RVRF', $attributes = array('class'=>"col-sm-3 dd_mg_personal_15px_left"));  !!}
							<div class="col-sm-4">
								<span>
								{!! Form::select('sys_pelvic_rvrf', $diagAvafRvrf, $diagExam->diag_pelvic_pervaginal_rfrf, $attributes = array('class' => 'form-control')); !!}
								</span>
							</div>
					</div>
				</div>
				<div class="form-group">	
					<div class="dd_examination">
							{!! Form::label('sys_pelvic_other', 'Others', $attributes = array('class'=>"col-sm-3 dd_mg_personal_15px_left"));  !!}
							<div class="col-sm-4">
								<span>
								{!! Form::text('sys_pelvic_other',  $diagExam->diag_pelvic_pervaginal_others, $attributes = array('class'=>'form-control','placeholder' => ''));  !!}
								</span>
							</div>
					</div>
				</div>
			@else
				<div class="form-group">
					<div class="col-sm-8">
						<h3 class="dd_h3_Pd_t_0">Pelvic Examination</h3>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-12 dd_font_bold">
						{!! Form::label('sys_pelvic_cervix', 'Per Speculum (P/S) Examination: Cervix', $attributes = array('class'=>""));  !!}
					</div>
				</div>
				<div class="form-group">	
					<div class="dd_examination">
							{!! Form::label('sys_pelvic_cervix_healthy', 'Healthy', $attributes = array('class'=>"col-sm-3 dd_mg_personal_15px_left"));  !!}
							<div class="col-sm-4">
								<span>
									<label class="dd_beforfood_pd" >
											<input type="radio"  class="before_food" name="sys_pelvic_cervix_healthy" value="Yes" >Yes
									</label>
								
									<label class="dd_beforfood_pd" >
										<input type="radio"  class="before_food" name="sys_pelvic_cervix_healthy" value="No" >No
									</label>
								
								</span>
							</div>
							<div class="col-sm-4">
								<span>
								{!! Form::text('sys_pelvic_cervix_healthy_other',  Input::old('sys_pelvic_cervix_healthy_other'), $attributes = array('class'=>'form-control','placeholder' => ''));  !!}
								</span>
							</div>
					</div>
				</div>
				<div class="form-group">	
					<div class="dd_examination">
							{!! Form::label('sys_pelvic_cervix_bleeding', 'Bleeding', $attributes = array('class'=>"col-sm-3 dd_mg_personal_15px_left"));  !!}
							<div class="col-sm-4">
								<span>
									<label class="dd_beforfood_pd" >
											<input type="radio"  class="before_food" name="sys_pelvic_cervix_bleeding" value="Yes" >Yes
									</label>
								
									<label class="dd_beforfood_pd" >
										<input type="radio"  class="before_food" name="sys_pelvic_cervix_bleeding" value="No" >No
									</label>
								
								</span>
							</div>
							<div class="col-sm-4">
								<span>
								{!! Form::text('sys_pelvic_cervix_bleeding_other',  Input::old('sys_pelvic_cervix_bleeding_other'), $attributes = array('class'=>'form-control','placeholder' => ''));  !!}
								</span>
							</div>
					</div>
				</div>
				<div class="form-group">	
					<div class="dd_examination">
							{!! Form::label('sys_pelvic_cervix_lbc', 'LBC', $attributes = array('class'=>"col-sm-3 dd_mg_personal_15px_left"));  !!}
							<div class="col-sm-4">
								<span>
									<label class="dd_beforfood_pd" >
											<input type="radio"  class="before_food" name="sys_pelvic_cervix_lbc" value="Yes" >Yes
										</label>
									
										<label class="dd_beforfood_pd" >
											<input type="radio"  class="before_food" name="sys_pelvic_cervix_lbc" value="No" >No
										</label>
								
								</span>
							</div>
							<div class="col-sm-4">
								<span>
								{!! Form::text('sys_pelvic_cervix_lbc_other',  Input::old('sys_pelvic_cervix_bleeding_other'), $attributes = array('class'=>'form-control','placeholder' => ''));  !!}
								</span>
							</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-12 dd_font_bold">
						{!! Form::label('sys_pelvic_uterus', 'Per Vagina (P/V) Examination: Uterus', $attributes = array('class'=>""));  !!}
					</div>
				</div>
				<div class="form-group">	
					<div class="dd_examination">
							{!! Form::label('sys_pelvic_avaf', 'AVAF', $attributes = array('class'=>"col-sm-3 dd_mg_personal_15px_left"));  !!}
							<div class="col-sm-4">
								<span>
								{!! Form::select('sys_pelvic_avaf', $diagAvafRvrf, null, $attributes = array('class' => 'form-control')); !!}
								</span>
							</div>
							
					</div>
				</div>	
				<div class="form-group">
					<div class="dd_examination">
							{!! Form::label('sys_pelvic_rvrf', 'RVRF', $attributes = array('class'=>"col-sm-3 dd_mg_personal_15px_left"));  !!}
							<div class="col-sm-4">
								<span>
								{!! Form::select('sys_pelvic_rvrf', $diagAvafRvrf, null, $attributes = array('class' => 'form-control')); !!}
								</span>
							</div>
					</div>
				</div>
				<div class="form-group">	
					<div class="dd_examination">
							{!! Form::label('sys_pelvic_other', 'Others', $attributes = array('class'=>"col-sm-3 dd_mg_personal_15px_left"));  !!}
							<div class="col-sm-4">
								<span>
								{!! Form::text('sys_pelvic_other',  Input::old('sys_pelvic_other'), $attributes = array('class'=>'form-control','placeholder' => ''));  !!}
								</span>
							</div>
					</div>
				</div>
			@endif	
				<!-- Pelvic Examination -->
				<hr>
				@if(!empty($patientPersonalData))
					<div class="form-group">
						<div class="col-sm-10"></div>
						<div class="col-sm-12">
							<button type="submit" class="btn btn-primary btn-block dd_save "><!-- <i class="fa fa-floppy-o"></i> --> Save</button>
						</div>
					</div>
				@else
					<div class="form-group">
						<div class="col-sm-10"></div>
						<div class="col-sm-12">
							<button type="submit" class="btn btn-primary btn-block dd_save " disabled="disabled"><!-- <i class="fa fa-floppy-o"></i> --> Save
							</button>
						</div>
					</div>
				@endif
			</div>
				
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
		{!!Html::script('assets/js/gyn-diag-examination.js')!!}

		{!!Html::script('assets/plugins/tooltip-validation/jquery-validate.bootstrap-tooltip.js')!!}
	<script>
		$(document).ready(function() {
			Main.init();
			gynDiagExamination.init();
	
	 	});
	</script>
@stop	