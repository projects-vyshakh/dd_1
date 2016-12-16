	<?php
	
	
	if (!empty($patientPersonalData))
	{
		$firstName 				 = $patientPersonalData -> first_name;
		$lastName				 = $patientPersonalData -> last_name;
		$patientName 		 	 = $firstName . " " . $lastName;
	} 
	else {
		$newPatientId 			= Session::get('patientId');
		$patientName 			= "";
	}
	
	if (!empty($doctorData)) 
	{
		$doctorSpecialization = $doctorData -> specialization;
	}
	?>
	@section('head')
	
	{!!Html::style('assets/plugins/datepicker/css/datepicker.css')!!}
	{!!Html::style('assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css')!!}
	{!!Html::style('assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css')!!}
	
	
	<style>
		.other-textbox {
			padding-left: 0px;
			margin-top: 8px;
		}
	</style>
	
	@stop
	@extends('layouts.master', ['specialization'=>$doctorSpecialization,'patientName'=>$patientName])
	
	@section('main')
	
	<?php 
	
	//$newPatientId = Session::get('patientId'); 
	
	
	
	if (!empty($medicalHistory))
	{
		foreach ($medicalHistory as $medicalHistoryVal) 
		{
			$menarche 		= $medicalHistoryVal -> menstrual_menarche;
			$menopause  	= $medicalHistoryVal -> menstrual_menopause;
			
			
			$fatherHistory	= json_decode($medicalHistoryVal -> history_family_father);
			$motherHistory 	= json_decode($medicalHistoryVal -> history_family_mother);
			$siblingHistory = json_decode($medicalHistoryVal -> history_family_sibling);
			$grandfatherHistory = json_decode($medicalHistoryVal -> history_family_grandfather);
			$grandmotherHistory = json_decode($medicalHistoryVal -> history_family_grandmother);
			$fatherHistoryOther	= $medicalHistoryVal -> history_family_father_other;
			$motherHistoryOther = $medicalHistoryVal -> history_family_mother_other;
			$siblingHistoryOther= $medicalHistoryVal -> history_family_sibling_other;
			$grandfatherHistoryOther = $medicalHistoryVal -> history_family_grandfather_other;
			$grandmotherHistoryOther = $medicalHistoryVal -> history_family_grandmother_other;
			
			$generalAllergyHistory = json_decode($medicalHistoryVal -> history_allergy_general);
			
			$alcohol = $medicalHistoryVal -> history_social_alcohol;
			$tobacoSmoke = $medicalHistoryVal -> history_social_tobacco_smoke;
			$tobacoChew = $medicalHistoryVal -> history_social_tobacco_chew;
			$otherSocial = $medicalHistoryVal -> history_social_other;
			$otherHistory = $medicalHistoryVal -> history_other;
			
			
			
		}
	}	
	
	

	//Present Past History
	if(!empty($medicalHistoryPresentPastMore)){
		$illnessNameArray	=	array();
		foreach($medicalHistoryPresentPastMore as $medicalHistoryPresentPastMoreVal){
			array_push($illnessNameArray, $medicalHistoryPresentPastMoreVal->illness_name);
		}
		
		for($i=0;$i<count($medicalHistoryPresentPastMore);$i++){
			$illnessName = $medicalHistoryPresentPastMore[$i]->illness_name;
			$medication	= $medicalHistoryPresentPastMore[$i]->medication;
			$illnessDataArray[$illnessName]	=[$medicalHistoryPresentPastMore[$i]->illness_status,$medicalHistoryPresentPastMore[$i]->medication];
		}
	}
	//Present Past History
	
	
	?>
	
	<div class="page-header">
		<h1>Patient Medical History <small></small></h1>
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
			
			<!-- start: TEXT FIELDS PANEL -->
			<div class="panel">
				<div class="panel-body">
					{!! Form::open(array('route' => 'addPatientMedicalHistory', 'role'=>'form', 'id'=>'addPatientMedicalHistory', 'class'=>'form-horizontal','novalidate'=>'novalidate')) !!}
					{!! Form::hidden('presentPastDivCount', "0", $attributes = array('class'=>'form-control present-past-div-count'));  !!}
					
					
					<!-- Menstrual History -->
					@if(!empty($medicalHistory))
					<div class="form-group">
						<div class="col-sm-4">
							<h3 class="dd_h3_Pd_t_0">Menstrual History</h3>
						</div>
					</div>
					<div class="form-group  ">
						{!! Form::label('menarche', 'Menarche', $attributes = array('class'=>'col-sm-1'));  !!}
						<div class="col-sm-5">
							<span class="dd_menarche"> 
								{!! Form::text('menarche',$menarche, $attributes = array('class'=>'form-control'));  !!}
							</span>
						</div>	
						{!! Form::label('menopause', 'Menopause', $attributes = array('class'=>'col-sm-1'));  !!}
						<div class="col-sm-5">
							<span class="dd_menarche"> 
								{!! Form::text('menopause', $menopause, $attributes = array('class'=>'form-control'));  !!}
							</span>
						</div>
					</div>
					@else
					<div class="form-group">
						<div class="col-sm-4">
							<h3 class="dd_h3_Pd_t_0">Menstrual History</h3>
						</div>
					</div>
					<div class="form-group  ">
						{!! Form::label('menarche', 'Menarche', $attributes = array('class'=>'col-sm-1'));  !!}
						<div class="col-sm-5">
							<span class="dd_menarche"> 
								{!! Form::text('menarche', Input::old('menarche'), $attributes = array('class'=>'form-control'));  !!}
							</span>
						</div>	
						{!! Form::label('menopause', 'Menopause', $attributes = array('class'=>'col-sm-1'));  !!}
						<div class="col-sm-5">
							<span class="dd_menarche"> 
								{!! Form::text('menopause', Input::old('menopause'), $attributes = array('class'=>'form-control'));  !!}
							</span>
						</div>
					</div>
					@endif
					<!-- Menstrual History-->
					<hr>
					
					<!-- Present Past History-->
					<div class="form-group">	
						<div class="col-sm-8">
							<h3 class="dd_h3_Pd_t_0">Present & Past History</h3>
						</div>
						<div class="col-sm-4 dd_Present_PD" >
							<label class="checkbox-inline col-sm-12">
								<input type="checkbox" value="NA" class="noPresentPastHistory" id="noPresentPast" />
								<input type="hidden" name="present-past-check-value" id="present-past-check-value" class="present-past-check-value">
								<span class="dd_past">No known present & past history to report</span> 
							</label>
						</div>
					</div>
					<div class="presentPastDiv" id="presentPastDiv">
						@if(!empty($medicalHistoryPresentPastMore) && !empty($illnessNameArray))
						<div class="form-group">
							<div class="col-sm-2">
								{!! Form::label('hypertension', 'Hypertension', $attributes = array('class'=>''));  !!}
								{!! Form::hidden('illness_name1', 'Hypertension', $attributes = array('class'=>'form-control illness_name_hypertension'));  !!}
							</div>
							<!-- Checking  illness existing in the db array -->
							@if(in_array('Hypertension',$illnessNameArray))
							@if($illnessDataArray['Hypertension'][0]=="Current")
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status1', 'Current','Current' , ['class' => 'present-past-past']) !!} Current </label>
							</div>
							@else
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status1', 'Current','' , ['class' => 'present-past-past']) !!} Current </label>
							</div>
							@endif
							@if($illnessDataArray['Hypertension'][0]=="Past")
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status1','Past', 'Past', ['class' => 'present-past-past']) !!}Past </label>
							</div>
							@else
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status1','Past', '', ['class' => 'present-past-past']) !!}Past </label>
							</div>
							@endif
							@if($illnessDataArray['Hypertension'][0]=="NA")
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status1','NA','NA' , ['class' => 'present-past-na']) !!}N/A </label>
							</div>
							@else
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status1','NA','' , ['class' => 'present-past-na']) !!}N/A </label>
							</div>
							@endif
							@if(!empty($illnessDataArray['Hypertension'][1]))
							<div class="col-sm-4">
								{!! Form::text('illness_medication1', $illnessDataArray['Hypertension'][1], $attributes = array('class'=>'form-control present-past-medication-empty medication','placeholder' => 'Medication'));  !!}
							</div>
							@else
							<div class="col-sm-4">
								{!! Form::text('illness_medication1', Input::old('medication_hypertension'), $attributes = array('class'=>'form-control present-past-medication-empty medication','placeholder' => 'Medication'));  !!}
							</div>
							@endif
							@else
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status1', 'Current','' , ['class' => 'present-past-past']) !!} Current </label>
							</div>
							
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status1','Past', '', ['class' => 'present-past-past']) !!}Past </label>
							</div>
							
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status1','NA','' , ['class' => 'present-past-na']) !!}N/A </label>
							</div>
							
							<div class="col-sm-4">
								{!! Form::text('illness_medication1', Input::old('medication_hypertension'), $attributes = array('class'=>'form-control present-past-medication-empty medication','placeholder' => 'Medication'));  !!}
							</div>
							
							@endif
						</div> 
						<div class="form-group">
							<div class="col-sm-2">
								{!! Form::label('diabetes', 'Diabetes', $attributes = array('class'=>''));  !!}
								{!! Form::hidden('illness_name2', 'Diabetes', $attributes = array('class'=>'form-control illness_name_diabetes'));  !!}
							</div>
							<!-- Checking  illness existing in the db array -->
							@if(in_array('Diabetes',@$illnessNameArray))
							@if($illnessDataArray['Diabetes'][0]=="Current")
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status2', 'Current','Current' , ['class' => 'present-past-past']) !!} Current </label>
							</div>
							@else
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status2', 'Current','' , ['class' => 'present-past-past']) !!} Current </label>
							</div>
							@endif
							@if($illnessDataArray['Diabetes'][0]=="Past")
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status2','Past', 'Past', ['class' => 'present-past-past']) !!}Past </label>
							</div>
							@else
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status2','Past', '', ['class' => 'present-past-past']) !!}Past </label>
							</div>
							@endif
							@if($illnessDataArray['Diabetes'][0]=="NA")
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status2','NA','NA' , ['class' => 'present-past-na']) !!}N/A </label>
							</div>
							@else
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status2','NA','' , ['class' => 'present-past-na']) !!}N/A </label>
							</div>
							@endif
							@if(!empty($illnessDataArray['Diabetes'][1]))
							<div class="col-sm-4">
								{!! Form::text('illness_medication2', $illnessDataArray['Diabetes'][1], $attributes = array('class'=>'form-control present-past-medication-empty','placeholder' => 'Medication'));  !!}
							</div>
							@else
							<div class="col-sm-4">
								{!! Form::text('illness_medication2', Input::old('medication_diabetes'), $attributes = array('class'=>'form-control present-past-medication-empty','placeholder' => 'Medication'));  !!}
							</div>
							@endif
							@else
							
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status2', 'Current','' , ['class' => 'present-past-past']) !!} Current </label>
							</div>
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status2','Past', '', ['class' => 'present-past-past']) !!}Past </label>
							</div>
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status2','NA','' , ['class' => 'present-past-na']) !!}N/A </label>
							</div>
							<div class="col-sm-4">
								{!! Form::text('illness_medication2', Input::old('medication_diabetes'), $attributes = array('class'=>'form-control present-past-medication-empty','placeholder' => 'Medication'));  !!}
							</div>
							
							@endif
						</div>
						<div class="form-group">
							<div class="col-sm-2">
								{!! Form::label('hyperthyroidism', 'Hyperthyroidism', $attributes = array('class'=>''));  !!}
								{!! Form::hidden('illness_name3', 'Hyperthyroidism', $attributes = array('class'=>'form-control illness_name_hyperthyroidism'));  !!}
							</div>
							@if(in_array('Hyperthyroidism',@$illnessNameArray))
							@if($illnessDataArray['Hyperthyroidism'][0]=="Current")
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status3', 'Current','Current' , ['class' => 'present-past-past']) !!} Current </label>
							</div>
							@else
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status3', 'Current','' , ['class' => 'present-past-past']) !!} Current </label>
							</div>
							@endif
							@if($illnessDataArray['Hyperthyroidism'][0]=="Past")
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status3','Past', 'Past', ['class' => 'present-past-past']) !!}Past </label>
							</div>
							@else
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status3','Past', '', ['class' => 'present-past-past']) !!}Past </label>
							</div>
							@endif
							@if($illnessDataArray['Hyperthyroidism'][0]=="NA")
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status3','NA','NA' , ['class' => 'present-past-na']) !!}N/A </label>
							</div>
							@else
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status3','NA','' , ['class' => 'present-past-na']) !!}N/A </label>
							</div>
							@endif
							@if(!empty($illnessDataArray['Hyperthyroidism'][1]))
							<div class="col-sm-4">
								{!! Form::text('illness_medication3',$illnessDataArray['Hyperthyroidism'][1], $attributes = array('class'=>'form-control present-past-medication-empty','placeholder' => 'Medication'));  !!}
							</div>
							@else
							<div class="col-sm-4">
								{!! Form::text('illness_medication3', Input::old('medication_hyperthyroidism'), $attributes = array('class'=>'form-control present-past-medication-empty','placeholder' => 'Medication'));  !!}
							</div>
							@endif
							@else
							
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status3', 'Current', null, ['class' => 'present-past-current']) !!}Current </label>
							</div>
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status3', 'Past', null, ['class' => 'present-past-past']) !!}Past </label>
							</div>
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status3', 'NA', null, ['class' => 'present-past-na']) !!}N/A </label>
							</div>
							<div class="col-sm-4">
								{!! Form::text('illness_medication3', Input::old('medication_hyperthyroidism'), $attributes = array('class'=>'form-control present-past-medication-empty','placeholder' => 'Medication'));  !!}
							</div>
							@endif
						</div>
						<div class="form-group">
							<div class="col-sm-2">
								{!! Form::label('hypothyroidism', 'Hypothyroidism', $attributes = array('class'=>''));  !!}
								{!! Form::hidden('illness_name4', 'Hypothyroidism', $attributes = array('class'=>'form-control illness_name_hypothyroidism'));  !!}
							</div>
							@if(in_array('Hypothyroidism',@$illnessNameArray))
							@if($illnessDataArray['Hypothyroidism'][0]=="Current")
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status4', 'Current','Current' , ['class' => 'present-past-past']) !!} Current </label>
							</div>
							@else
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status4', 'Current','' , ['class' => 'present-past-past']) !!} Current </label>
							</div>
							@endif
							@if($illnessDataArray['Hypothyroidism'][0]=="Past")
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status4','Past', 'Past', ['class' => 'present-past-past']) !!}Past </label>
							</div>
							@else
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status4','Past', '', ['class' => 'present-past-past']) !!}Past </label>
							</div>
							@endif
							@if($illnessDataArray['Hypothyroidism'][0]=="NA")
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status4','NA','NA' , ['class' => 'present-past-na']) !!}N/A </label>
							</div>
							@else
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status4','NA','' , ['class' => 'present-past-na']) !!}N/A </label>
							</div>
							@endif
							@if(!empty($illnessDataArray['Hyperthyroidism'][1]))
							<div class="col-sm-4">
								{!! Form::text('illness_medication4',$illnessDataArray['Hyperthyroidism'][1], $attributes = array('class'=>'form-control present-past-medication-empty','placeholder' => 'Medication'));  !!}
							</div>
							@else
							<div class="col-sm-4">
								{!! Form::text('illness_medication4',Input::old('medication_hypothyroidism'), $attributes = array('class'=>'form-control present-past-medication-empty','placeholder' => 'Medication'));  !!}
							</div>
							@endif
							@else
							
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status4', 'Current', null, ['class' => 'present-past-current']) !!}Current </label>
							</div>
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status4', 'Past', null, ['class' => 'present-past-past']) !!}Past </label>
							</div>
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status4', 'NA', null, ['class' => 'present-past-na']) !!}N/A </label>
							</div>
							<div class="col-sm-4">
								{!! Form::text('illness_medication4',Input::old('medication_hypothyroidism'), $attributes = array('class'=>'form-control present-past-medication-empty','placeholder' => 'Medication'));  !!}
							</div>
							@endif
							
						</div>
						<div class="form-group">
							<div class="col-sm-2">
								{!! Form::label('cyst', 'Cyst', $attributes = array('class'=>''));  !!}
								{!! Form::hidden('illness_name5', 'Cyst', $attributes = array('class'=>'form-control illness_name_cyst'));  !!}
							</div>
							@if(in_array('Cyst',@$illnessNameArray))
							@if($illnessDataArray['Cyst'][0]=="Current")
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status5', 'Current','Current' , ['class' => 'present-past-past']) !!} Current </label>
							</div>
							@else
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status5', 'Current','' , ['class' => 'present-past-past']) !!} Current </label>
							</div>
							@endif
							@if($illnessDataArray['Cyst'][0]=="Past")
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status5','Past', 'Past', ['class' => 'present-past-past']) !!}Past </label>
							</div>
							@else
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status5','Past', '', ['class' => 'present-past-past']) !!}Past </label>
							</div>
							@endif
							@if($illnessDataArray['Cyst'][0]=="NA")
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status5','NA','NA' , ['class' => 'present-past-na']) !!}N/A </label>
							</div>
							@else
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status5','NA','' , ['class' => 'present-past-na']) !!}N/A </label>
							</div>
							@endif
							@if(!empty($illnessDataArray['Cyst'][1]))
							<div class="col-sm-4">
								{!! Form::text('illness_medication5',$illnessDataArray['Cyst'][1], $attributes = array('class'=>'form-control present-past-medication-empty','placeholder' => 'Medication'));  !!}
							</div>
							@else
							<div class="col-sm-4">
								{!! Form::text('illness_medication5',Input::old('medication_cyst'), $attributes = array('class'=>'form-control present-past-medication-empty','placeholder' => 'Medication'));  !!}
							</div>
							@endif
							@else
							
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status5', 'Current', null, ['class' => 'present-past-current']) !!}Current </label>
							</div>
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status5', 'Past', null, ['class' => 'present-past-current']) !!}Past </label>
							</div>
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status5', 'NA', null, ['class' => 'present-past-na']) !!}N/A </label>
							</div>
							<div class="col-sm-4">
								{!! Form::text('illness_medication5', Input::old('medication_cyst'), $attributes = array('class'=>'form-control present-past-medication-empty','placeholder' => 'Medication'));  !!}
							</div>
							@endif
							
						</div>
						<div class="form-group">
							<div class="col-sm-2">
								{!! Form::label('endometriosis', 'Endometriosis', $attributes = array('class'=>''));  !!}
								{!! Form::hidden('illness_name6', 'Endometriosis', $attributes = array('class'=>'form-control illness_name_endometriosis'));  !!}
							</div>
							@if(in_array('Endometriosis',@$illnessNameArray))
							@if($illnessDataArray['Endometriosis'][0]=="Current")
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status6', 'Current','Current' , ['class' => 'present-past-past']) !!} Current </label>
							</div>
							@else
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status6', 'Current','' , ['class' => 'present-past-past']) !!} Current </label>
							</div>
							@endif
							@if($illnessDataArray['Endometriosis'][0]=="Past")
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status6','Past', 'Past', ['class' => 'present-past-past']) !!}Past </label>
							</div>
							@else
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status6','Past', '', ['class' => 'present-past-past']) !!}Past </label>
							</div>
							@endif 
							@if($illnessDataArray['Endometriosis'][0]=="NA")
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status6','NA','NA' , ['class' => 'present-past-na']) !!}N/A </label>
							</div>
							@else
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status6','NA','' , ['class' => 'present-past-na']) !!}N/A </label>
							</div>
							@endif
							@if(!empty($illnessDataArray['Endometriosis'][1]))
							<div class="col-sm-4">
								{!! Form::text('illness_medication6',$illnessDataArray['Endometriosis'][1], $attributes = array('class'=>'form-control present-past-medication-empty','placeholder' => 'Medication'));  !!}
							</div>
							@else
							<div class="col-sm-4">
								{!! Form::text('illness_medication6',Input::old('medication_endometriosis'), $attributes = array('class'=>'form-control present-past-medication-empty','placeholder' => 'Medication'));  !!}
							</div>
							@endif
							@else
							
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status6', 'Current', null, ['class' => 'present-past-current']) !!}Current </label>
							</div>
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status6', 'Past', null, ['class' => 'present-past-past']) !!}Past </label>
							</div>
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status6', 'NA', null, ['class' => 'present-past-na']) !!}N/A </label>
							</div>
							<div class="col-sm-4">
								{!! Form::text('illness_medication6',Input::old('medication_endometriosis '), $attributes = array('class'=>'form-control present-past-medication-empty','placeholder' => 'Medication'));  !!}
							</div>
							@endif
							
						</div>
						<div class="form-group">
							<div class="col-sm-2">
								{!! Form::label('uterinefibroids', 'Utrine Fibroids', $attributes = array('class'=>''));  !!}
								{!! Form::hidden('illness_name7', 'Utrine Fibroids', $attributes = array('class'=>'form-control illness_name_uterinefibroids'));  !!}
							</div>
							@if(in_array('Utrine Fibroids',@$illnessNameArray))
							@if($illnessDataArray['Utrine Fibroids'][0]=="Current")
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status7', 'Current','Current' , ['class' => 'present-past-past']) !!} Current </label>
							</div>
							@else
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status7', 'Current','' , ['class' => 'present-past-past']) !!} Current </label>
							</div>
							@endif
							@if($illnessDataArray['Utrine Fibroids'][0]=="Past")
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status7','Past', 'Past', ['class' => 'present-past-past']) !!}Past </label>
							</div>
							@else
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status7','Past', '', ['class' => 'present-past-past']) !!}Past </label>
							</div>
							@endif 
							@if($illnessDataArray['Utrine Fibroids'][0]=="NA")
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status7','NA','NA' , ['class' => 'present-past-na']) !!}N/A </label>
							</div>
							@else
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status7','NA','' , ['class' => 'present-past-na']) !!}N/A </label>
							</div>
							@endif
							@if(!empty($illnessDataArray['Utrine Fibroids'][1]))
							<div class="col-sm-4">
								{!! Form::text('illness_medication7',$illnessDataArray['Utrine Fibroids'][1], $attributes = array('class'=>'form-control present-past-medication-empty','placeholder' => 'Medication'));  !!}
							</div>
							@else
							<div class="col-sm-4">
								{!! Form::text('illness_medication7',Input::old('medication_uterinefibroids'), $attributes = array('class'=>'form-control present-past-medication-empty','placeholder' => 'Medication'));  !!}
							</div>
							@endif
							@else
							
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status7', 'Current', null, ['class' => 'present-past-current']) !!}Current </label>
							</div>
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status7', 'Past', null, ['class' => 'present-past-past']) !!}Past </label>
							</div>
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status7', 'NA', null, ['class' => 'present-past-na']) !!}N/A </label>
							</div>
							<div class="col-sm-4">
								{!! Form::text('illness_medication7', Input::old('medication_uterinefibroids'), $attributes = array('class'=>'form-control present-past-medication-empty','placeholder' => 'Medication'));  !!}
							</div>
							@endif
							
						</div>
						<div class="form-group">
							<div class="col-sm-2">
								{!! Form::label('uti', 'UTI', $attributes = array('class'=>''));  !!}
								{!! Form::hidden('illness_name8', 'UTI', $attributes = array('class'=>'form-control illness_name_uti'));  !!}
							</div>
							@if(in_array('UTI',@$illnessNameArray))
							@if($illnessDataArray['UTI'][0]=="Current")
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status8', 'Current','Current' , ['class' => 'present-past-past']) !!} Current </label>
							</div>
							@else
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status8', 'Current','' , ['class' => 'present-past-past']) !!} Current </label>
							</div>
							@endif
							@if($illnessDataArray['UTI'][0]=="Past")
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status8','Past', 'Past', ['class' => 'present-past-past']) !!}Past </label>
							</div>
							@else
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status8','Past', '', ['class' => 'present-past-past']) !!}Past </label>
							</div>
							@endif 
							@if($illnessDataArray['UTI'][0]=="NA")
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status8','NA','NA' , ['class' => 'present-past-na']) !!}N/A </label>
							</div>
							@else
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status8','NA','' , ['class' => 'present-past-na']) !!}N/A </label>
							</div>
							@endif
							@if(!empty($illnessDataArray['UTI'][1]))
							<div class="col-sm-4">
								{!! Form::text('illness_medication8',$illnessDataArray['UTI'][1], $attributes = array('class'=>'form-control present-past-medication-empty','placeholder' => 'Medication'));  !!}
							</div>
							@else
							<div class="col-sm-4">
								{!! Form::text('illness_medication8',Input::old('medication_uti'), $attributes = array('class'=>'form-control present-past-medication-empty','placeholder' => 'Medication'));  !!}
							</div>
							@endif
							@else
							
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status8', 'Current', null, ['class' => 'present-past-current']) !!}Current </label>
							</div>
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status8', 'Past', null, ['class' => 'present-past-past']) !!}	Past </label>
							</div>
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status8', 'NA', null, ['class' => 'present-past-na']) !!}N/A </label>
							</div>
							<div class="col-sm-4">
								{!! Form::text('illness_medication8', Input::old('medication_uti '), $attributes = array('class'=>'form-control present-past-medication-empty','placeholder' => 'Medication'));  !!}
							</div>
							@endif
							
						</div>
						<div class="form-group">
							<div class="col-sm-2">
								{!! Form::label('cancer', 'Cancer', $attributes = array('class'=>''));  !!}
								{!! Form::hidden('illness_name9', 'Cancer', $attributes = array('class'=>'form-control illness_name_cancer'));  !!}
							</div>
							@if(in_array('Cancer',@$illnessNameArray))
							@if($illnessDataArray['Cancer'][0]=="Current")
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status9', 'Current','Current' , ['class' => 'present-past-past']) !!} Current </label>
							</div>
							@else
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status9', 'Current','' , ['class' => 'present-past-past']) !!} Current </label>
							</div>
							@endif
							@if($illnessDataArray['Cancer'][0]=="Past")
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status9','Past', 'Past', ['class' => 'present-past-past']) !!}Past </label>
							</div>
							@else
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status9','Past', '', ['class' => 'present-past-past']) !!}Past </label>
							</div>
							@endif 
							@if($illnessDataArray['Cancer'][0]=="NA")
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status9','NA','NA' , ['class' => 'present-past-na']) !!}N/A </label>
							</div>
							@else
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status9','NA','' , ['class' => 'present-past-na']) !!}N/A </label>
							</div>
							@endif
							@if(!empty($illnessDataArray['Cancer'][1]))
							<div class="col-sm-4">
								{!! Form::text('illness_medication9',$illnessDataArray['Cancer'][1], $attributes = array('class'=>'form-control present-past-medication-empty','placeholder' => 'Medication'));  !!}
							</div>
							@else
							<div class="col-sm-4">
								{!! Form::text('illness_medication9',Input::old('medication_cancer'), $attributes = array('class'=>'form-control present-past-medication-empty','placeholder' => 'Medication'));  !!}
							</div>
							@endif
							@else
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status9', 'Current', null, ['class' => 'present-past-current']) !!}Current </label>
							</div>
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status9', 'Past', null, ['class' => 'present-past-past']) !!}Past </label>
							</div>
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status9', 'NA', null, ['class' => 'present-past-na']) !!}N/A </label>
							</div>
							<div class="col-sm-4" >
								{!! Form::text('illness_medication9', Input::old('medication_cancer'), $attributes = array('class'=>'form-control present-past-medication-empty','placeholder' => 'Medication'));  !!}
							</div>
							@endif
						</div>
						
						<!-- Addmore illness -->
						<?php $counter = 10; ?>
							@foreach($medicalHistoryPresentPastMore as $medicalHistoryPresentPastMoreVal)
							<?php
								$illnessName 	= $medicalHistoryPresentPastMoreVal->illness_name;
								$illnessStatus	= $medicalHistoryPresentPastMoreVal->illness_status;
								$illnessMedication = $medicalHistoryPresentPastMoreVal->medication;
							
							?>
							@if($illnessName=="Hypertension" || 
								$illnessName=="Diabetes" || 
								$illnessName=="Hyperthyroidism"	 || 
								$illnessName=="Hypothyroidism" ||
								$illnessName=="Cyst"	||	
								$illnessName=="Endometriosis" || 	
								$illnessName=="Utrine Fibroids" || 
								$illnessName=="UTI" || 
								$illnessName=="Cancer")
						
							@else	
								@if(!empty($illnessName))
									<div class="form-group">
										<div class="col-sm-2">
											<label>{{$illnessName}}</label>
											<input type="hidden" name="illness_name{{$counter}}" value="{{$illnessName}}" />
										</div> 
										
										@if($illnessStatus=="Current")
										
										<div class="col-sm-2">
											<label class="radio-inline">
												<input type="radio" class="present-past-current" name="illness_status{{$counter}}" value="Current" 	checked="checked" id="current{{$counter}}"/>Current
											</label>
										</div>
										<div class="col-sm-2">
											<label class="radio-inline">
												<input type="radio" class="present-past-past" name="illness_status{{$counter}}" value="Past"  />Past
											</label>
										</div>
										<div class="col-sm-2">
											<label class="radio-inline">
												<input type="radio" class="present-past-na" name="illness_status{{$counter}}" value="NA"  />N/A
											</label>
										</div>
										@endif

										@if($illnessStatus=="Past")
										<div class="col-sm-2">
											<label class="radio-inline">
												<input type="radio" class="present-past-current" name="illness_status{{$counter}}" value="Current" 	/>Current
											</label>
										</div>
										<div class="col-sm-2">
											<label class="radio-inline">
												<input type="radio" class="present-past-past" name="illness_status{{$counter}}" value="Past"   checked="checked"/>Past
											</label>
										</div>
										<div class="col-sm-2">
											<label class="radio-inline">
												<input type="radio" class="present-past-na" name="illness_status{{$counter}}" value="NA"  />N/A
											</label>
										</div>
										@endif
										@if($illnessStatus=="NA")
										<div class="col-sm-2">
											<label class="radio-inline">
												<input type="radio" class="present-past-current" name="illness_status{{$counter}}" value="Current" 	/>Current
											</label>
										</div>
										<div class="col-sm-2">
											<label class="radio-inline">
												<input type="radio" class="present-past-past" name="illness_status{{$counter}}" value="Past"   />Past
											</label>
										</div>
										<div class="col-sm-2">
											<label class="radio-inline">
												<input type="radio" class="present-past-na" name="illness_status{{$counter}}" value="NA"   checked="checked"/>N/A
											</label>
										</div>
										@endif
										<div class="col-sm-4" >
											<input type="text" name="illness_medication{{$counter}}"	value="{{$illnessMedication}}" class="form-control present-past-medication-empty"  placeholder="Medication"/>
										</div>
										
									</div>
							<?php $counter++; ?>
							@endif
							@endif	
							@endforeach					
						
						@else
						<div class="form-group">
							<div class="col-sm-2">
								{!! Form::label('hypertension', 'Hypertension', $attributes = array('class'=>''));  !!}
								{!! Form::hidden('illness_name1', 'Hypertension', $attributes = array('class'=>'form-control illness_name_hypertension'));  !!}
							</div>
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status1', 'Current','' , ['class' => 'present-past-past']) !!} Current </label>
							</div>
							
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status1','Past', '', ['class' => 'present-past-past']) !!}Past </label>
							</div>
							
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status1','NA','' , ['class' => 'present-past-na']) !!}N/A </label>
							</div>
							
							<div class="col-sm-4">
								{!! Form::text('illness_medication1', Input::old('medication_hypertension'), $attributes = array('class'=>'form-control present-past-medication-empty medication','placeholder' => 'Medication'));  !!}
							</div>
						</div> 
						<div class="form-group">
							<div class="col-sm-2">
								{!! Form::label('diabetes', 'Diabetes', $attributes = array('class'=>''));  !!}
								{!! Form::hidden('illness_name2', 'Diabetes', $attributes = array('class'=>'form-control illness_name_diabetes'));  !!}
							</div>
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status2', 'Current','' , ['class' => 'present-past-past']) !!} Current </label>
							</div>
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status2','Past', '', ['class' => 'present-past-past']) !!}Past </label>
							</div>
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status2','NA','' , ['class' => 'present-past-na']) !!}N/A </label>
							</div>
							<div class="col-sm-4">
								{!! Form::text('illness_medication2', Input::old('medication_diabetes'), $attributes = array('class'=>'form-control present-past-medication-empty','placeholder' => 'Medication'));  !!}
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-2">
								{!! Form::label('hyperthyroidism', 'Hyperthyroidism', $attributes = array('class'=>''));  !!}
								{!! Form::hidden('illness_name3', 'Hyperthyroidism', $attributes = array('class'=>'form-control illness_name_hyperthyroidism'));  !!}
							</div>
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status3', 'Current', null, ['class' => 'present-past-current']) !!}Current </label>
							</div>
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status3', 'Past', null, ['class' => 'present-past-past']) !!}Past </label>
							</div>
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status3', 'NA', null, ['class' => 'present-past-na']) !!}N/A </label>
							</div>
							<div class="col-sm-4">
								{!! Form::text('illness_medication3', Input::old('medication_hyperthyroidism'), $attributes = array('class'=>'form-control present-past-medication-empty','placeholder' => 'Medication'));  !!}
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-2">
								{!! Form::label('hypothyroidism', 'Hypothyroidism', $attributes = array('class'=>''));  !!}
								{!! Form::hidden('illness_name4', 'Hypothyroidism', $attributes = array('class'=>'form-control illness_name_hypothyroidism'));  !!}
							</div>
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status4', 'Current', null, ['class' => 'present-past-current']) !!}Current </label>
							</div>
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status4', 'Past', null, ['class' => 'present-past-past']) !!}Past </label>
							</div>
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status4', 'NA', null, ['class' => 'present-past-na']) !!}N/A </label>
							</div>
							<div class="col-sm-4">
								{!! Form::text('illness_medication4',Input::old('medication_hypothyroidism'), $attributes = array('class'=>'form-control present-past-medication-empty','placeholder' => 'Medication'));  !!}
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-2">
								{!! Form::label('cyst', 'Cyst', $attributes = array('class'=>''));  !!}
								{!! Form::hidden('illness_name5', 'Cyst', $attributes = array('class'=>'form-control illness_name_cyst'));  !!}
							</div>
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status5', 'Current', null, ['class' => 'present-past-current']) !!}Current </label>
							</div>
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status5', 'Past', null, ['class' => 'present-past-current']) !!}Past </label>
							</div>
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status5', 'NA', null, ['class' => 'present-past-na']) !!}N/A </label>
							</div>
							<div class="col-sm-4">
								{!! Form::text('illness_medication5', Input::old('medication_cyst'), $attributes = array('class'=>'form-control present-past-medication-empty','placeholder' => 'Medication'));  !!}
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-2">
								{!! Form::label('endometriosis', 'Endometriosis', $attributes = array('class'=>''));  !!}
								{!! Form::hidden('illness_name6', 'Endometriosis', $attributes = array('class'=>'form-control illness_name_endometriosis'));  !!}
							</div>
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status6', 'Current', null, ['class' => 'present-past-current']) !!}Current </label>
							</div>
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status6', 'Past', null, ['class' => 'present-past-past']) !!}Past </label>
							</div>
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status6', 'NA', null, ['class' => 'present-past-na']) !!}N/A </label>
							</div>
							<div class="col-sm-4">
								{!! Form::text('illness_medication6',Input::old('medication_endometriosis '), $attributes = array('class'=>'form-control present-past-medication-empty','placeholder' => 'Medication'));  !!}
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-2">
								{!! Form::label('uterinefibroids', 'Utrine Fibroids', $attributes = array('class'=>''));  !!}
								{!! Form::hidden('illness_name7', 'Utrine Fibroids', $attributes = array('class'=>'form-control illness_name_uterinefibroids'));  !!}
							</div>
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status7', 'Current', null, ['class' => 'present-past-current']) !!}Current </label>
							</div>
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status7', 'Past', null, ['class' => 'present-past-past']) !!}Past </label>
							</div>
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status7', 'NA', null, ['class' => 'present-past-na']) !!}N/A </label>
							</div>
							<div class="col-sm-4">
								{!! Form::text('illness_medication7', Input::old('medication_uterinefibroids'), $attributes = array('class'=>'form-control present-past-medication-empty','placeholder' => 'Medication'));  !!}
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-2">
								{!! Form::label('uti', 'UTI', $attributes = array('class'=>''));  !!}
								{!! Form::hidden('illness_name8', 'UTI', $attributes = array('class'=>'form-control illness_name_uti'));  !!}
							</div>
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status8', 'Current', null, ['class' => 'present-past-current']) !!}Current </label>
							</div>
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status8', 'Past', null, ['class' => 'present-past-past']) !!}	Past </label>
							</div>
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status8', 'NA', null, ['class' => 'present-past-na']) !!}N/A </label>
							</div>
							<div class="col-sm-4">
								{!! Form::text('illness_medication8', Input::old('medication_uti '), $attributes = array('class'=>'form-control present-past-medication-empty','placeholder' => 'Medication'));  !!}
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-2">
								{!! Form::label('cancer', 'Cancer', $attributes = array('class'=>''));  !!}
								{!! Form::hidden('illness_name9', 'Cancer', $attributes = array('class'=>'form-control illness_name_cancer'));  !!}
							</div>
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status9', 'Current', null, ['class' => 'present-past-current']) !!}Current </label>
							</div>
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status9', 'Past', null, ['class' => 'present-past-past']) !!}Past </label>
							</div>
							<div class="col-sm-2">
								<label class="radio-inline"> {!! Form::radio('illness_status9', 'NA', null, ['class' => 'present-past-na']) !!}N/A </label>
							</div>
							<div class="col-sm-4" >
								{!! Form::text('illness_medication9', Input::old('medication_cancer'), $attributes = array('class'=>'form-control present-past-medication-empty','placeholder' => 'Medication'));  !!}
							</div>
						</div>
						
						@endif
					</div>


					<div class="form-group">
						<div class="col-sm-12">
							<button type="submit" class="btn btn-default btn-addmore-illness pull-right" id="btn-addmore-illness" style="margin-top: 10px">
								<i class="fa fa-plus-circle "></i> Add More illness
							</button>
						</div>
					</div>
					<!-- Present Past History -->
					
					
					<hr>
					
					<div class="form-group">
						<div class="col-sm-8">
							<h3>Family History</h3>
						</div>
						<div class="col-sm-4 dd_Present_PD" >
							
							<label class="checkbox-inline col-sm-12">
								<input type="checkbox" value="NA" class="noFamilyHistory" id="noFamilyHistory" />
								<!-- <input type="hidden" name="noFamilyHistory" id="noFamilyHistory" class="noFamilyHistory"> --> <span class="dd_past">No known family history to report</span> </label>
								
						</div>
					</div>
						
						<div class="form-group">
							<div class="container">
								<div class="row">
									<div class="dd_sample_F">
										{!! Form::label('father', 'Father', $attributes = array('class'=>'checkbox-linline dd_sample_175' ));  !!}
									</div>
									
									@if((!empty($medicalHistory)) && (!empty($fatherHistory)))
										<div class="dd_sample_L">
											<label class="checkbox-inline dd_sample_125">
												<input type="checkbox" value="Hypertension" class="family-hypertension" name="father[]"  
												@if(in_array("Hypertension",$fatherHistory)) checked="checked" @endif>
												Hypertension 
											</label>

											<label class="checkbox-inline dd_sample_125">
												<input type="checkbox" value="Diabetes" class="family-diabetes" name="father[]"
												@if(in_array("Diabetes",$fatherHistory)) checked="checked" @endif>
												Diabetes 
											</label>
											<label class="checkbox-inline dd_sample_125">
												<input type="checkbox" value="Cancer" class="family-cancer" name="father[]"
												@if(in_array("Cancer",$fatherHistory)) checked="checked" @endif>
												Cancer 
											</label>
											<label class="checkbox-inline dd_sample_125">
												<input type="checkbox" value="Other" class="family-other" name="father[]"
												@if(in_array("Other",$fatherHistory)) checked="checked" @endif >
												Other 
											</label>
										</div>
										<div class="dd_sample_M">
											{!! Form::text('father_other', !empty($fatherHistoryOther)?$fatherHistoryOther:Input::old('father_other'), $attributes = array('class'=>'form-control other-medical-history father_other','placeholder' => 'Other','disabled'=>'disabled'));  !!}
										</div>
										<div class="dd_sample_R">
											<label class="checkbox-inline ">
												<input type="checkbox" value="NA" class="family-history-na"
												@if(in_array("NA",$fatherHistory)) checked="checked" @endif>
												N/A 
											</label>
										</div>
									@else
										<div class="dd_sample_L">
											<label class="checkbox-inline dd_sample_125">
												<input type="checkbox" value="Hypertension" class="family-hypertension" name="father[]" >
												Hypertension 
											</label>
											
											<label class="checkbox-inline dd_sample_125">
												<input type="checkbox" value="Diabetes" class="family-diabetes" name="father[]">
												Diabetes 
											</label>

											<label class="checkbox-inline dd_sample_125">
												<input type="checkbox" value="Cancer" class="family-cancer" name="father[]">
												Cancer 
											</label>
											
											<label class="checkbox-inline dd_sample_125">
												<input type="checkbox" value="Other" class="family-other" name="father[]">
												Other 
											</label>
										</div>
										<div class="dd_sample_M">
											{!! Form::text('father_other',null, $attributes = array('class'=>'form-control other-medical-history','placeholder' => 'Other'));  !!}
										</div>
										<div class="dd_sample_R">
											<label class="checkbox-inline">
												<input type="checkbox" value="NA" class="family-history-na">
												N/A 
											</label>
										</div>
									@endif
								</div>
							</div>
						</div>
																
						<!-- Mother -->
						<div class="form-group">
							<div class="container">
								<div class="row">
									<div class="dd_sample_F">
										{!! Form::label('mother', 'Mother', $attributes = array('class'=>'checkbox-inline dd_sample_175'));  !!}
									</div>
									@if((!empty($medicalHistory)) && (!empty($motherHistory)))
										<div class="dd_sample_L">
											<label class="checkbox-inline dd_sample_125">
												<input type="checkbox" value="Hypertension" class="family-hypertension" name="mother[]"  
												@if(in_array("Hypertension",$motherHistory)) checked="checked" @endif>
												Hypertension 
											</label>

											<label class="checkbox-inline dd_sample_125">
												<input type="checkbox" value="Diabetes" class="family-diabetes" name="mother[]"  
												@if(in_array("Diabetes",$motherHistory)) checked="checked" @endif>
												Diabetes 
											</label>

											<label class="checkbox-inline dd_sample_125">
												<input type="checkbox" value="Cancer" class="family-cancer" name="mother[]"  
												@if(in_array("Cancer",$motherHistory)) checked="checked" @endif>
												Cancer 
											</label>

											<label class="checkbox-inline dd_sample_125">
												<input type="checkbox" value="Other" class="family-other" name="mother[]"@if(in_array("Other",$motherHistory)) checked="checked" @endif>
												Other 
											</label>
										</div>
										
										<div class="dd_sample_M">
											{!! Form::text('mother_other', !empty($motherHistoryOther)?$motherHistoryOther:Input::old('mother_other'), $attributes = array('class'=>'form-control other-medical-history','placeholder' => 'Other'));  !!}
										</div>
										<div class="dd_sample_R">
											<label class="checkbox-inline">
												<input type="checkbox" value="NA" class="family-history-na"  @if(in_array("NA",$motherHistory)) checked="checked" @endif>
												N/A 
											</label>
										</div>
									@else
										<div class="dd_sample_L">
											<label class="checkbox-inline dd_sample_125">
												<input type="checkbox" value="Hypertension" class="family-hypertension" name="mother[]">
												Hypertension 
											</label>

											<label class="checkbox-inline dd_sample_125">
												<input type="checkbox" value="Diabetes" class="family-diabetes" name="mother[]">
												Diabetes 
											</label>
											
											<label class="checkbox-inline dd_sample_125">
												<input type="checkbox" value="Cancer" class="family-cancer" name="mother[]">
												Cancer 
											</label>
											
											<label class="checkbox-inline dd_sample_125">
												<input type="checkbox" value="Other" class="family-other" name="mother[]">
												Other 
											</label>
										</div>
										<div class="dd_sample_M">
											{!! Form::text('mother_other', null, $attributes = array('class'=>'form-control other-medical-history','placeholder' => 'Other'));  !!}
										</div>
										<div class="dd_sample_R">
											<label class="checkbox-inline">
												<input type="checkbox" value="NA" class="family-history-na">N/A 
											</label>
										</div>
									@endif
								</div>
							</div>
						</div>
																										
						<!-- Sibling -->
						<div class="form-group">
							<div class="container">
								<div class="row">
									<div class="dd_sample_F">
										{!! Form::label('sibling', 'Sibling', $attributes = array('class'=>'checkbox-inline dd_sample_175'));  !!}
									</div>
									@if((!empty($medicalHistory)) && (!empty($siblingHistory)))
										<div class="dd_sample_L">
											<label class="checkbox-inline dd_sample_125">
												<input type="checkbox" value="Hypertension" class="family-hypertension" name="sibling[]"  
												@if(in_array("Hypertension",$siblingHistory)) checked="checked" @endif>
												Hypertension 
											</label>
											
											<label class="checkbox-inline dd_sample_125">
												<input type="checkbox" value="Diabetes" class="family-diabetes" name="sibling[]"  
												@if(in_array("Diabetes",$siblingHistory)) checked="checked" @endif>
												Diabetes 
											</label>
									
											<label class="checkbox-inline dd_sample_125">
												<input type="checkbox" value="Cancer" class="family-cancer" name="sibling[]"
												@if(in_array("Cancer",$siblingHistory)) checked=" checked" @endif>
												Cancer 
											</label>
											<!-- {{$siblingHistoryOther}}
											 -->
											<label class="checkbox-inline dd_sample_125">
												<input type="checkbox" value="Other" class="family-other" name="sibling[]" @if(in_array("Other",$siblingHistory)) checked="checked" @endif>
												Other 
											</label>
										</div>
										<div class="dd_sample_M">
											{!! Form::text('sibling_other',!empty($siblingHistoryOther)?$siblingHistoryOther:Input::old('sibling_other'), $attributes = array('class'=>'form-control other-medical-history','placeholder' => 'Other'));  !!}
										</div>
										<div class="dd_sample_R">
											<label class="checkbox-inline ">
												<input type="checkbox" value="NA" class="family-history-na"
												@if(in_array("NA",$siblingHistory)) checked="checked" @endif>
												N/A 
											</label>
										</div>
									@else
										<div class="dd_sample_L">
											<label class="checkbox-inline dd_sample_125">
												<input type="checkbox" value="Hypertension" class="family-hypertension" name="sibling[]">
												Hypertension 
											</label>
										
											<label class="checkbox-inline dd_sample_125">
												<input type="checkbox" value="Diabetes" class="family-diabetes" name="sibling[]">
												Diabetes 
											</label>
											
											<label class="checkbox-inline dd_sample_125">
												<input type="checkbox" value="Cancer" class="family-cancer" name="sibling[]">
												Cancer
											</label>

											<label class="checkbox-inline dd_sample_125">
												<input type="checkbox" value="Other" class="family-other" name="sibling[]">
												Other 
											</label>
										</div>
										<div class="dd_sample_M">
											{!! Form::text('sibling_other',null, $attributes = array('class'=>'form-control other-medical-history','placeholder' => 'Other'));  !!}
										</div>
										<div class="dd_sample_R">
											<label class="checkbox-inline col-sm-1">
												<input type="checkbox" value="NA" class="family-history-na">
												N/A 
											</label>
										</div>
									@endif
								</div>
							</div>
						</div>
						
						<!-- Grandfather -->
						<div class="form-group">
							<div class="container">
								<div class="row">
									<div class="dd_sample_F">
										{!! Form::label('grandfather', 'Grandfather', $attributes = array('class'=>'checkbox-inline dd_sample_175'));  !!}
									</div>
									@if((!empty($medicalHistory)) && (!empty($siblingHistory)))
										<div class="dd_sample_L">
											<label class="checkbox-inline dd_sample_125">
												<input type="checkbox" value="Hypertension" class="family-hypertension" name="grandfather[]"  
												@if(in_array("Hypertension",$grandfatherHistory)) checked="checked" @endif>
												Hypertension 
											</label>
											
											<label class="checkbox-inline dd_sample_125">
												<input type="checkbox" value="Diabetes" class="family-diabetes" name="grandfather[]"  
												@if(in_array("Diabetes",$grandfatherHistory)) checked="checked" @endif>
												Diabetes 
											</label>
											
											<label class="checkbox-inline dd_sample_125">
												<input type="checkbox" value="Cancer" class="family-cancer" name="grandfather[]"  
												@if(in_array("Cancer",$grandfatherHistory)) checked="checked" @endif>
												Cancer 
											</label>
											
											<label class="checkbox-inline dd_sample_125">
												<input type="checkbox" value="Other" class="family-other" name="grandfather[]" 
												@if(in_array("Other",$grandfatherHistory)) checked="checked" @endif>
												Other 
											</label>
										</div>
										<div class="dd_sample_M">
											{!! Form::text('grandfather_other', !empty($grandfatherHistoryOther)?$grandfatherHistoryOther:Input::old('grandfather_other'), $attributes = array('class'=>'form-control other-medical-history','placeholder' => 'Other'));  !!}
										</div>
										<div class="dd_sample_R">
											<label class="checkbox-inline">
												<input type="checkbox" value="NA" class="family-history-na"  
												@if(in_array("NA",$grandfatherHistory)) checked="checked" @endif>
												N/A
											 </label>
										</div>
									@else
										<div class="dd_sample_L">
											<label class="checkbox-inline dd_sample_125">
												<input type="checkbox" value="Hypertension" class="family-hypertension" name="grandfather[]" >
												Hypertension 
											</label>
												
											<label class="checkbox-inline dd_sample_125">
												<input type="checkbox" value="Diabetes" class="family-diabetes" name="grandfather[]">
												Diabetes 
											</label>
											
											<label class="checkbox-inline dd_sample_125">
												<input type="checkbox" value="Cancer" class="family-cancer" name="grandfather[]">
												Cancer 
											</label>
											
											<label class="checkbox-inline dd_sample_125">
												<input type="checkbox" value="Other" class="family-other" name="grandfather[]">
												Other 
											</label>
										</div>
										<div class="dd_sample_M">
											{!! Form::text('grandfather_other', Input::old('grandfather_other'), $attributes = array('class'=>'form-control other-medical-history','placeholder' => 'Other'));  !!}
										</div>
										<div class="dd_sample_R">
											<label class="checkbox-inline col-sm-1">
												<input type="checkbox" value="NA" class="family-history-na">
												N/A 
											</label>
										</div>
									@endif
								</div>
							</div>
						</div>
						
						<!-- Grandmother -->
						<div class="form-group">
							<div class="container">
								<div class="row">
									<div class="dd_sample_F">
										{!! Form::label('grandmother', 'Grandmother', $attributes = array('class'=>'checkbox-inline dd_sample_175'));  !!}
									</div>
									@if((!empty($medicalHistory)) && (!empty($siblingHistory)))
										<div class="dd_sample_L">
											<label class="checkbox-inline dd_sample_125">
												<input type="checkbox" value="Hypertension" class="family-hypertension" id="hyp" name="grandmother[]"
												@if(in_array("Hypertension",$grandmotherHistory)) checked="checked" @endif>
												Hypertension 
											</label>
											
											<label class="checkbox-inline dd_sample_125">
												<input type="checkbox" value="Diabetes" class="family-diabetes" name="grandmother[]"  
												@if(in_array("Diabetes",$grandmotherHistory)) checked="checked" @endif>
												Diabetes 
											</label>
											
											<label class="checkbox-inline dd_sample_125">
												<input type="checkbox" value="Cancer" class="family-cancer" name="grandmother[]"  
												@if(in_array("Cancer",$grandmotherHistory)) checked="checked" @endif>
												Cancer 
											</label>
											
											<label class="checkbox-inline dd_sample_125">
												<input type="checkbox" value="Other" class="family-other" name="grandmother[]" 
												@if(in_array("Other",$grandmotherHistory)) checked="checked" @endif >
												Other 
											</label>
										</div>
										<div class="dd_sample_M">
											{!! Form::text('grandmother_other', !empty($grandmotherHistoryOther)?$grandmotherHistoryOther:Input::old('grandmother_other'), $attributes = array('class'=>'form-control other-medical-history','placeholder' => 'Other'));  !!}
										</div>
										<div class="dd_sample_R">
											<label class="checkbox-inline">
												<input type="checkbox" value="NA" class="family-history-na"
												@if(in_array("NA",$grandmotherHistory)) checked="checked" @endif>
												N/A 
											</label>
										</div>
									@else
										<div class="dd_sample_L">
											<label class="checkbox-inline dd_sample_125">
												<input type="checkbox" value="Hypertension" class="family-hypertension" id="hyp" name="grandmother[]">
												Hypertension 
											</label>
											
											<label class="checkbox-inline dd_sample_125">
												<input type="checkbox" value="Diabetes" class="family-diabetes" name="grandmother[]">
												Diabetes 
											</label>
											
											<label class="checkbox-inline dd_sample_125">
												<input type="checkbox" value="Cancer" class="family-cancer" name="grandmother[]">
												Cancer 
											</label>
											
											<label class="checkbox-inline dd_sample_125">
												<input type="checkbox" value="Other" class="family-other" name="grandmother[]">
												Other 
											</label>
										</div>
										<div class="dd_sample_M">
											{!! Form::text('grandmother_other', Input::old('grandmother_other'), $attributes = array('class'=>'form-control other-medical-history','placeholder' => 'Other'));  !!}
										</div>
										<div class="dd_sample_R">
											<label class="checkbox-inline">
												<input type="checkbox" value="NA" class="family-history-na">
												N/A 
											</label>
										</div>
									@endif
								</div>
							</div>
						</div>
																																																								
																																																								<hr>
																																																								<div class="form-group">
																																																									<div class="col-sm-8">
																																																										<h3 class="dd_h3_Pd_t_0">Surgical History</h3>
																																																									</div>
																																																									<div class="col-sm-4  dd_Present_PD">
																																																										<label class="checkbox-inline col-sm-12"> @if(!empty($surgeryHistory))
																																																											<input type="checkbox" value="NA" class="noSurgicalHistory" id="noSurgicalHistory" disabled="disabled" />
																																																											<span class="dd_past">No known surgical history to report</span> @else
																																																											<input type="checkbox" value="NA" class="noSurgicalHistory" id="noSurgicalHistory" />
																																																											<span class="dd_past">No known surgical history to reports</span> @endif </label>
																																																										</div>
																																																									</div>
																																																									
																																																									<?php    $statusArray =  array();    ?> 
																																																									<div class="surgery" id="surgery">
																																																										@if(!empty($surgeryHistory))
																																																										@foreach($surgeryHistory as $surgeryHistoryVal)
																																																										@if($surgeryHistoryVal->surgery_name=="Nil" || $surgeryHistoryVal->surgery_name=="NA"  || $surgeryHistoryVal->surgery_name=="na" || $surgeryHistoryVal->surgery_name=="nil" )
																																																										<!-- Assigning 0 to array  -->
																																																										<?php    array_push($statusArray,0);     ?>
																																																										@else
																																																										<div class="form-group">
																																																											<div class="col-sm-12">
																																																												<span>
																																																													{!! Form::text('surgery[]',  $surgeryHistoryVal->surgery_name, $attributes = array('class'=>'form-control surgicalhistory','placeholder' => '','disabled'=>'disabled'));  !!}
																																																												</span>
																																																											</div>
																																																										</div>
																																																										<?php    array_push($statusArray,1);     ?>
																																																										@endif
																																																										@endforeach
																																																										<!-- if all surgery names are NA,Nil etc then this code works -->
																																																										@if(in_array(1,$statusArray))
																																																										@else
																																																										<div class="form-group">
																																																											<div class="col-sm-12">
																																																												<span>
																																																													{!! Form::text('surgery[]','', $attributes = array('class'=>'form-control surgicalhistory','placeholder' => ''));  !!}
																																																												</span>
																																																											</div>
																																																										</div>
																																																										@endif
																																																										@else
																																																										<div class="form-group">
																																																											<!-- {!! Form::label('surgery', 'Surgery', $attributes = array('class'=>'col-sm-2'));  !!} -->
																																																											<div class="col-sm-12">
																																																												<span > {!! Form::text('surgery[]', Input::old('surgery'), $attributes = array('class'=>'form-control surgicalhistory','placeholder' => 'Surgery'));  !!} </span>
																																																											</div>
																																																										</div>
																																																										@endif
																																																										
																																																									</div>
																																																									<div class="form-group">
																																																										<div class="col-sm-12">
																																																											<button class="btn btn-default btn-add-surgery pull-right" style="margin-top: 10px">
																																																												<i class="fa fa-plus-circle "></i>Add More Surgery
																																																											</button>
																																																										</div>
																																																									</div>
																																																									
																																																									<hr>
																																																									
																																																									<div class="form-group">
																																																										<div class="col-sm-8">
																																																											<h3 class="dd_h3_Pd_t_0">Allergy History</h3>
																																																										</div>
																																																										<div class="col-sm-4  dd_Present_PD">
																																																											<label class="checkbox-inline col-sm-12"> 
																																																												@if(!empty($generalAllergyHistory))
																																																												<input type="checkbox" value="NA" class="noAllergyHistory" id="noAllergyHistory" disabled="disabled" />
																																																												<span class="dd_past">No known allergy history to report</span> 
																																																												@else
																																																												<input type="checkbox" value="NA" class="noAllergyHistory" id="noAllergyHistory" />
																																																												<span class="dd_past">No known allergy history to reports</span> 
																																																												@endif 
																																																											</label>
																																																										</div>
																																																									</div>
																																																									<div class="form-group">
																																																										<div class="col-sm-8">
																																																											<h4>General</h4>
																																																										</div>
																																																									</div>
																																																									<div class="form-group">
																																																										<div class="col-sm-12">
																																																											@if(!empty($medicalHistory))
																																																											<div class="col-sm-12 dd_genaral_mg">
																																																												<label class="checkbox-inline col-sm-2">
																																																													<input class="allergy_general" type="checkbox" value="Casein" class="" name="allergy_general[]"  @if(!empty($generalAllergyHistory)) @if(in_array("Casein",$generalAllergyHistory)) checked="checked" @endif @endif>
																																																													Casein 
																																																												</label>
																																																												<label class="checkbox-inline col-sm-2">
																																																													<input	class="allergy_general"  type="checkbox" value="Egg" class="" name="allergy_general[]"  @if(!empty($generalAllergyHistory)) @if(in_array("Egg",$generalAllergyHistory)) checked="checked" @endif @endif>
																																																													Egg 
																																																												</label>
																																																												<label class="checkbox-inline col-sm-2">
																																																													<input	class="allergy_general"	 type="checkbox" value="Fish" class="" name="allergy_general[]"  @if(!empty($generalAllergyHistory)) @if(in_array("Fish",$generalAllergyHistory)) checked="checked" @endif @endif>
																																																													Fish 
																																																												</label>
																																																												<label class="checkbox-inline col-sm-2">
																																																													<input 	class="allergy_general"	type="checkbox" value="Milk" class="" name="allergy_general[]" @if(!empty($generalAllergyHistory)) @if(in_array("Milk",$generalAllergyHistory)) checked="checked" @endif @endif>
																																																													Milk 
																																																												</label>
																																																												<label class="checkbox-inline col-sm-2">
																																																													<input 	class="allergy_general"	type="checkbox" value="Nut" class="" name="allergy_general[]" @if(!empty($generalAllergyHistory)) @if(in_array("Nut",$generalAllergyHistory)) checked="checked" @endif @endif>
																																																													Nut 
																																																												</label>
																																																												
																																																												<label class="checkbox-inline col-sm-2">
																																																													<input 	class="allergy_general"	type="checkbox" value="Shellfish" class="" name="allergy_general[]"  @if(!empty($generalAllergyHistory)) @if(in_array("Shellfish",$generalAllergyHistory)) checked="checked" @endif @endif>
																																																													Shellfish 
																																																												</label>
																																																												<label class="checkbox-inline col-sm-2">
																																																													<input 	class="allergy_general"	type="checkbox" value="Sulfite" class="" name="allergy_general[]"  @if(!empty($generalAllergyHistory)) @if(in_array("Sulfite",$generalAllergyHistory)) checked="checked" @endif @endif>
																																																													Sulfite 
																																																												</label>
																																																												<label class="checkbox-inline col-sm-2">
																																																													<input 	class="allergy_general"	type="checkbox" value="Soy" class="" name="allergy_general[]"  @if(!empty($generalAllergyHistory)) @if(in_array("Soy",$generalAllergyHistory)) checked="checked" @endif @endif>
																																																													Soy 
																																																												</label>
																																																												<label class="checkbox-inline col-sm-2">
																																																													<input 	class="allergy_general"	type="checkbox" value="Wheat" class="" name="allergy_general[]"@if(!empty($generalAllergyHistory)) @if(in_array("Wheat",$generalAllergyHistory)) checked="checked" @endif @endif>
																																																													Wheat 
																																																												</label>
																																																											</div>
																																																											
																																																											<div class="col-sm-12 dd_genaral_mg">
																																																												<label class="checkbox-inline col-sm-2">
																																																													<input 	class="allergy_general"	type="checkbox" value="Spring" class="" name="allergy_general[]"  @if(!empty($generalAllergyHistory)) @if(in_array("Spring",$generalAllergyHistory)) checked="checked" @endif @endif>
																																																													Spring 
																																																												</label>
																																																												<label class="checkbox-inline col-sm-2">
																																																													<input 	class="allergy_general"	type="checkbox" value="Summer" class="" name="allergy_general[]" @if(!empty($generalAllergyHistory)) @if(in_array("Summer",$generalAllergyHistory)) checked="checked" @endif @endif>
																																																													Summer 
																																																												</label>
																																																												<label class="checkbox-inline col-sm-2">
																																																													<input 	class="allergy_general"	type="checkbox" value="Fall" class="" name="allergy_general[]" @if(!empty($generalAllergyHistory)) @if(in_array("Fall",$generalAllergyHistory)) checked="checked" @endif @endif>
																																																													Fall 
																																																												</label>
																																																												<label class="checkbox-inline col-sm-2">
																																																													<input 	class="allergy_general"	type="checkbox" value="Winter" class="" name="allergy_general[]"  @if(!empty($generalAllergyHistory)) @if(in_array("Winter",$generalAllergyHistory)) checked="checked" @endif @endif>
																																																													Winter
																																																												</label>
																																																											</div>
																																																											<div class="col-sm-12 dd_genaral_mg">
																																																												<label class="checkbox-inline col-sm-2">
																																																													<input 	class="allergy_general"	type="checkbox" value="Bee" class="" name="allergy_general[]" @if(!empty($generalAllergyHistory)) @if(in_array("Bee",$generalAllergyHistory)) checked="checked" @endif @endif>
																																																													Bee 
																																																												</label>
																																																												<label class="checkbox-inline col-sm-2">
																																																													<input 	class="allergy_general"	type="checkbox" value="Cat" class="" name="allergy_generals[]" @if(!empty($generalAllergyHistory)) @if(in_array("Cat",$generalAllergyHistory)) checked="checked" @endif @endif>
																																																													Cat 
																																																												</label>
																																																												<label class="checkbox-inline col-sm-2">
																																																													<input class="allergy_general"	type="checkbox" value="Dog" class="" name="allergy_general[]" @if(!empty($generalAllergyHistory)) @if(in_array("Dog",$generalAllergyHistory)) checked="checked" @endif @endif>
																																																													Dog 
																																																												</label>
																																																												<label class="checkbox-inline col-sm-2">
																																																													<input 	class="allergy_general"	type="checkbox" value="Insect" class="" name="allergy_general[]" @if(!empty($generalAllergyHistory)) @if(in_array("Insect",$generalAllergyHistory)) checked="checked" @endif @endif>
																																																													Insect 
																																																												</label>
																																																											</div>
																																																											<div class="col-sm-12 dd_genaral_mg">
																																																												<label class="checkbox-inline col-sm-2">
																																																													<input 	class="allergy_general"	type="checkbox" value="Dust" class="" name="allergy_general[]" @if(!empty($generalAllergyHistory)) @if(in_array("Dust",$generalAllergyHistory)) checked="checked" @endif @endif>
																																																													Dust
																																																												</label>
																																																												<label class="checkbox-inline col-sm-2">
																																																													<input 	class="allergy_general"	type="checkbox" value="Mold" class="" name="allergy_general[]"  @if(!empty($generalAllergyHistory)) @if(in_array("Mold",$generalAllergyHistory)) checked="checked" @endif @endif>
																																																													Mold 
																																																												</label>
																																																												<label class="checkbox-inline col-sm-2">
																																																													<input 	class="allergy_general"	type="checkbox" value="Plant" class="" name="allergy_general[]" @if(!empty($generalAllergyHistory)) @if(in_array("Plant",$generalAllergyHistory)) checked="checked" @endif @endif>
																																																													Plant 
																																																												</label>
																																																												<label class="checkbox-inline col-sm-2">
																																																													<input 	class="allergy_general"	type="checkbox" value="Pollen" class="" name="allergy_general[]" @if(!empty($generalAllergyHistory)) @if(in_array("Pollen",$generalAllergyHistory)) checked="checked" @endif @endif>
																																																													Pollen 
																																																												</label>
																																																												<label class="checkbox-inline col-sm-2">
																																																													<input 	class="allergy_general"	type="checkbox" value="Sun" class="" name="allergy_general[]" @if(!empty($generalAllergyHistory)) @if(in_array("Sun",$generalAllergyHistory)) checked="checked" @endif @endif>
																																																													Sun 
																																																												</label>
																																																											</div>
																																																											@else
																																																											
																																																											<div class="col-sm-12 dd_genaral_mg">
																																																												<label class="checkbox-inline col-sm-2">
																																																													<input type="checkbox" value="Casein" class="allergy_general" name="allergy_general[]">
																																																													Casein </label>
																																																													<label class="checkbox-inline col-sm-2">
																																																														<input type="checkbox" value="Egg" class="allergy_general" name="allergy_general[]">
																																																														Egg </label>
																																																														<label class="checkbox-inline col-sm-2">
																																																															<input type="checkbox" value="Fish" class="allergy_general" name="allergy_general[]">
																																																															Fish </label>
																																																															<label class="checkbox-inline col-sm-2">
																																																																<input type="checkbox" value="Milk" class="allergy_general" name="allergy_general[]">
																																																																Milk </label>
																																																																<label class="checkbox-inline col-sm-2">
																																																																	<input type="checkbox" value="Nut" class="allergy_general" name="allergy_general[]">
																																																																	Nut </label>
																																																																	
																																																																	<label class="checkbox-inline col-sm-2">
																																																																		<input type="checkbox" value="Shellfish" class="allergy_general" name="allergy_general[]">
																																																																		Shellfish </label>
																																																																		
																																																																		<label class="checkbox-inline col-sm-2">
																																																																			<input type="checkbox" value="Sulfite" class="allergy_general" name="allergy_general[]">
																																																																			Sulfite </label>
																																																																			<label class="checkbox-inline col-sm-2">
																																																																				<input type="checkbox" value="Soy" class="allergy_general" name="allergy_general[]">
																																																																				Soy </label>
																																																																				<label class="checkbox-inline col-sm-2">
																																																																					<input type="checkbox" value="Wheat" class="allergy_general" name="allergy_general[]">
																																																																					Wheat </label>
																																																																				</div>
																																																																				<div class="col-sm-12 dd_genaral_mg">
																																																																					
																																																																					<label class="checkbox-inline col-sm-2">
																																																																						<input type="checkbox" value="Spring" class="allergy_general" name="allergy_general[]">
																																																																						Spring </label>
																																																																						<label class="checkbox-inline col-sm-2">
																																																																							<input type="checkbox" value="Summer" class="allergy_general" name="allergy_general[]">
																																																																							Summer </label>
																																																																							<label class="checkbox-inline col-sm-2">
																																																																								<input type="checkbox" value="Fall" class="allergy_general" name="allergy_general[]">
																																																																								Fall </label>
																																																																								
																																																																								<label class="checkbox-inline col-sm-2">
																																																																									<input type="checkbox" value="Winter" class="allergy_general" name="allergy_general[]">
																																																																									Winter </label>
																																																																									
																																																																								</div>
																																																																								
																																																																								<div class="col-sm-12 dd_genaral_mg">
																																																																									
																																																																									<label class="checkbox-inline col-sm-2">
																																																																										<input type="checkbox" value="Bee" class="allergy_general" name="allergy_general[]">
																																																																										Bee </label>
																																																																										<label class="checkbox-inline col-sm-2">
																																																																											<input type="checkbox" value="Cat" class="allergy_general" name="allergy_generals[]">
																																																																											Cat </label>
																																																																											<label class="checkbox-inline col-sm-2">
																																																																												<input type="checkbox" value="Dog" class="allergy_general" name="allergy_general[]">
																																																																												Dog </label>
																																																																												<label class="checkbox-inline col-sm-2">
																																																																													<input type="checkbox" value="Insect" class="allergy_general" name="allergy_general[]">
																																																																													Insect </label>
																																																																													
																																																																												</div>
																																																																												
																																																																												<div class="col-sm-12 dd_genaral_mg">
																																																																													
																																																																													<label class="checkbox-inline col-sm-2">
																																																																														<input type="checkbox" value="Dust" class="allergy_general" name="allergy_general[]">
																																																																														Dust </label>
																																																																														
																																																																														<label class="checkbox-inline col-sm-2">
																																																																															<input type="checkbox" value="Mold" class="allergy_general" name="allergy_general[]">
																																																																															Mold </label>
																																																																															<label class="checkbox-inline col-sm-2">
																																																																																<input type="checkbox" value="Plant" class="allergy_general" name="allergy_general[]">
																																																																																Plant </label>
																																																																																<label class="checkbox-inline col-sm-2">
																																																																																	<input type="checkbox" value="Pollen" class="allergy_general" name="allergy_general[]">
																																																																																	Pollen </label>
																																																																																	<label class="checkbox-inline col-sm-2">
																																																																																		<input type="checkbox" value="Sun" class="allergy_general" name="allergy_general[]">
																																																																																		Sun </label>
									<!-- 	<label class="checkbox-inline col-sm-2">
									<input type="checkbox" value="NA" class="allergy_general_na" id="allergy_general_na" name="allergy_general[]">
									N/A
								</label> -->
							</div>
							@endif
							
						</div>
					</div>
					
					<hr>
					
					<div class="form-group">
						<div class="col-sm-8">
							<h4>Drug</h4>
						</div>
						<div class="col-sm-4 dd_Present_PD">
							@if(!empty($drugAllergyHistory))
							<label class="checkbox-inline col-sm-12">
								<input type="checkbox" value="NA" class="" id="noDrugAllergy" class="noDrugAllergy" disabled="disabled" checked="checked" />
								<span class="dd_past">No known  drug allergy history to report</span> </label>
								@else
								<label class="checkbox-inline col-sm-12">
									<input type="checkbox" value="NA" class="" id="noDrugAllergy" class="noDrugAllergy"  />
									<span class="dd_past">No known  drug allergy history to report</span> @endif
								</div>
							</div>
							
							<?php $drugArray = array(); ?>
							<div class="allergy" id="allergy">
								@if(!empty($drugAllergyHistory))
								@foreach($drugAllergyHistory as $drugAllergyHistoryVal)
								
								@if( $drugAllergyHistoryVal->drug_name=="Nil" ||  $drugAllergyHistoryVal->drug_name=="NA" ||  $drugAllergyHistoryVal->drug_name=="nil" ||  $drugAllergyHistoryVal->drug_name=="na")
								<?php array_push($drugArray,0); ?>
								@else
								
								<div class="form-group">
									<div class="col-sm-6">
										<div class="dd_top_mt">
											Medication
										</div>
										<span > {!! Form::text('medication-drug-allergy[]', $drugAllergyHistoryVal->drug_name, $attributes = array('class'=>'form-control medication-drug-allergy allergy-validation-class','disabled'=>'disabled'));  !!} </span>
									</div>
									<!-- {!! Form::label('reaction-drug-allergy', 'Reaction', $attributes = array('class'=>'col-sm-2 '));  !!}-->
									<div class="col-sm-6">
										<div class="dd_top_mt">
											Reaction
										</div>
										<span > {!! Form::text('reaction-drug-allergy[]', $drugAllergyHistoryVal->reaction, $attributes = array('class'=>'form-control reaction-drug-allergy allergy-validation-class','disabled'=>'disabled'));  !!} </span>
									</div>
								</div>
								<?php array_push($drugArray,1); ?>
								@endif
								@endforeach
								
								@if(in_array(1,$drugArray))
								
								@else
								<div class="form-group">
									<div class="col-sm-6">
										<div class="dd_top_mt">
											Medication
										</div>
										<span > {!! Form::text('medication-drug-allergy[]', '', $attributes = array('class'=>'form-control medication-drug-allergy allergy-validation-class'));  !!} </span>
									</div>
									<!-- {!! Form::label('reaction-drug-allergy', 'Reaction', $attributes = array('class'=>'col-sm-2 '));  !!}-->
									<div class="col-sm-6">
										<div class="dd_top_mt">
											Reaction
										</div>
										<span > {!! Form::text('reaction-drug-allergy[]', '', $attributes = array('class'=>'form-control reaction-drug-allergy allergy-validation-class'));  !!} </span>
									</div>
								</div>
								@endif
								@else
								<div class="form-group">
									<div class="col-sm-6">
										<div class="dd_top_mt">
											Medication
										</div>
										<span class=""> {!! Form::text('medication-drug-allergy[]', Input::old('medication-drug-allergy'), $attributes = array('class'=>'form-control medication-drug-allergy allergy-validation-class'));  !!} <!-- <i class="clip-user-3"></i>  --> </span>
									</div>
									<!-- {!! Form::label('reaction-drug-allergy', 'Reaction', $attributes = array('class'=>'col-sm-2 '));  !!}-->
									<div class="col-sm-6">
										<div class="dd_top_mt">
											Reaction
										</div>
										<span class=""> {!! Form::text('reaction-drug-allergy[]', Input::old('reaction-drug-allergy'), $attributes = array('class'=>'form-control reaction-drug-allergy allergy-validation-class'));  !!} <!-- <i class="clip-user-3"></i>  --> </span>
									</div>
								</div>
								@endif
							</div>
							<div class="form-group">
								<div class="col-sm-12">
									<button class="btn btn-default btn-add-allergies pull-right">
										<i class="fa fa-plus-circle "></i>
										Add More Allergies
									</button>
								</div>
								
							</div>
							<hr>
							
							<!-- Social History -->
							<div class="form-group">
								<div class="col-sm-8">
									<h3>Social History</h3>
								</div>
								<div class="col-sm-4  dd_Present_PD">
									<label class="checkbox-inline col-sm-12">
										<input type="checkbox" value="NA" class="noSocialHistory" id="noSocialHistory" />
										<span class="dd_past">No known social history to reports</span>  
									</label>
								</div>
							</div>
							@if(!empty($medicalHistory))
							<div class="form-group dd_Social_History">
								{!! Form::label('alcohol', 'Alcohol', $attributes = array('class'=>'col-sm-2'));  !!}
								<div class="col-sm-2">
									<label class="radio-inline">
										<input type="radio" value="Current" name="alcohol" class="social-history" @if(($alcohol=="Current") && !empty($alcohol)) checked="checked" @endif />Current 
									</label>
								</div>
								<div class="col-sm-2">
									<label class="radio-inline">
										<input type="radio" value="Past" name="alcohol" class="social-history" @if(($alcohol=="Past") && !empty($alcohol)) checked="checked" @endif />Past
									</label>
								</div>
								<div class="col-sm-2">
									<label class="radio-inline">
										<input type="radio" value="NA" name="alcohol" class="social-history-na" @if(($alcohol=="NA") && !empty($alcohol)) checked="checked" @endif />N/A
									</label>
								</div>
							</div>
							<div class="form-group dd_Social_History">
								{!! Form::label('tobacco', 'Tobacco (Smoke)', $attributes = array('class'=>'col-sm-2'));  !!}
								<div class="col-sm-2">
									<label class="radio-inline">
										<input type="radio" value="Current" name="tobaco-smoke" class="social-history" @if(($tobacoSmoke=="Current") && !empty($tobacoSmoke)) checked="checked" @endif />Current
									</label>
								</div>
								<div class="col-sm-2">
									<label class="radio-inline">
										<input type="radio" value="Past" name="tobaco-smoke" class="social-history"  @if(($tobacoSmoke=="Past") && !empty($tobacoSmoke)) checked="checked" @endif />Past
									</label>
								</div>
								<div class="col-sm-2">
									<label class="radio-inline">
										<input type="radio" value="NA" name="tobaco-smoke" class="social-history-na" @if(($tobacoSmoke=="NA") && !empty($tobacoSmoke)) checked="checked" @endif />N/A
									</label>
								</div>
							</div>
							<div class="form-group dd_Social_History">
								{!! Form::label('tobacco-chew', 'Tobacco (Chewable)', $attributes = array('class'=>'col-sm-2'));  !!}
								<div class="col-sm-2">
									<label class="radio-inline">
										<input type="radio" value="Current" name="tobaco-chew" class="social-history" @if(($tobacoChew=="Current") && !empty($tobacoChew)) checked="checked" @endif />Current
									</label>
								</div>
								<div class="col-sm-2">
									<label class="radio-inline">
										<input type="radio" value="Past" name="tobaco-chew" class="social-history" @if(($tobacoChew=="Past") && !empty($tobacoChew)) checked="checked" @endif />Past
									</label>
								</div>
								<div class="col-sm-2">
									<label class="radio-inline">
										<input type="radio" value="NA" name="tobaco-chew" class="social-history-na"  @if(($tobacoChew=="NA") && !empty($tobacoChew)) checked="checked" @endif />N/A
									</label>
								</div>
							</div>
							<div class="form-group dd_Social_History">
								{!! Form::label('other-social', 'Other Substances', $attributes = array('class'=>'col-sm-2'));  !!}
								<div class="col-sm-2">
									<label class="radio-inline">
										<input type="radio" value="Current" name="other-social-history" class="social-history"  @if(($otherSocial=="Current") && !empty($otherSocial)) checked="checked" @endif/>Current
									</label>
								</div>
								<div class="col-sm-2">
									<label class="radio-inline">
										<input type="radio" value="Past" name="other-social-history" class="social-history" @if(($otherSocial=="Past") && !empty($otherSocial)) checked="checked" @endif />Past
									</label>
								</div>
								<div class="col-sm-2">
									<label class="radio-inline">
										<input type="radio" value="NA" name="other-social-history" class="social-history-na"  @if(($otherSocial=="NA") && !empty($otherSocial)) checked="checked" @endif />N/A
									</label>
								</div>
							</div>
							@else
							<div class="form-group dd_Social_History">
								{!! Form::label('alcohol', 'Alcohol', $attributes = array('class'=>'col-sm-2'));  !!}
								<div class="col-sm-2">
									<label class="radio-inline">
										<input type="radio" value="Current" name="alcohol" class="social-history" />Current
									</label>
								</div>
								<div class="col-sm-2">
									<label class="radio-inline">
										<input type="radio" value="Past" name="alcohol" class="social-history">Past
									</label>
								</div>
								<div class="col-sm-2">
									<label class="radio-inline">
										<input type="radio" value="NA" name="alcohol" class="social-history-na">N/A
									</label>
								</div>
							</div>
							<div class="form-group dd_Social_History">
								{!! Form::label('tobacco', 'Tobacco (Smoke)', $attributes = array('class'=>'col-sm-2'));  !!}
								<div class="col-sm-2">
									<label class="radio-inline">
										<input type="radio" value="Current" name="tobaco-smoke" class="social-history" />Current
									</label>
								</div>
								<div class="col-sm-2">
									<label class="radio-inline">
										<input type="radio" value="Past" name="tobaco-smoke" class="social-history" />Past
									</label>
								</div>
								<div class="col-sm-2">
									<label class="radio-inline">
										<input type="radio" value="NA" name="tobaco-smoke" class="social-history-na" />N/A
									</label>
								</div>
							</div>
							<div class="form-group dd_Social_History">
								{!! Form::label('tobacco-chew', 'Tobacco (Chewable)', $attributes = array('class'=>'col-sm-2'));  !!}
								<div class="col-sm-2">
									<label class="radio-inline">
										<input type="radio" value="Current" name="tobaco-chew" class="social-history" />Current
									</label>
								</div>
								<div class="col-sm-2">
									<label class="radio-inline">
										<input type="radio" value="Past" name="tobaco-chew" class="social-history" />Past
									</label>
								</div>
								<div class="col-sm-2">
									<label class="radio-inline">
										<input type="radio" value="NA" name="tobaco-chew" class="social-history-na" />N/A
									</label>
								</div>
							</div>
							<div class="form-group dd_Social_History">
								{!! Form::label('other-social', 'Other Substances', $attributes = array('class'=>'col-sm-2'));  !!}
								<div class="col-sm-2">
									<label class="radio-inline">
										<input type="radio" value="Current" name="other-social-history" class="social-history" />Current
									</label>
								</div>
								<div class="col-sm-2">
									<label class="radio-inline">
										<input type="radio" value="Past" name="other-social-history" class="social-history" />Past
									</label>
								</div>
								<div class="col-sm-2">
									<label class="radio-inline">
										<input type="radio" value="NA" name="other-social-history" class="social-history-na" />N/A
									</label>
								</div>
							</div>
							
							@endif
							<!-- Social History -->
							
							<hr>
							
							<div class="form-group">
								<div class="col-sm-6">
									<h3>Other History</h3>
								</div>
								
							</div>
							<div class="form-group">
								<div class="col-sm-12">
									@if(!empty($medicalHistory))
									<textarea name="other_medical_history" class="form-control" rows="10" cols="40" >{{$otherHistory}}</textarea>						
									
									@else
									{!! Form::textarea('other_medical_history',null,['class'=>'form-control', 'rows' => 10, 'cols' => 40]) !!}
									
									
									@endif
									
								</div>
							</div>
							
							<hr>
							
							<div class="form-group">
								<div class="col-sm-10"></div>
								<div class="col-sm-12">
									<button type="submit" class="btn btn-primary btn-block btn-medical-save dd_save">
										<!-- <i class="fa fa-floppy-o" aria-hidden="true"></i> -->
										Save
									</button>
								</div>
							</div>
							
							{!! Form::close() !!}
						</div>
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
			
			{!!Html::script('assets/plugins/jquery-validation/dist/jquery.validate.min.js')!!}
			{!!Html::script('assets/js/patient-personal-information.js')!!}
			{!!Html::script('assets/js/gyn-medical-history.js')!!}
			
			<script>
				$(document).ready(function() {
					Main.init();
	//patientElements.init();
	patientMedicalHistoryElements.init();
	
	var div 	= $('div').find('#presentPastDiv');
	var newDiv 	= div.find('.form-group');
	var medicalHistory = <?php echo json_encode($medicalHistory); ?>
	;
		//console.log(medicalHistory);
		//var counter = newDiv.length;
		
		var presentPastDivCount = $('.presentPastDiv').find('.form-group').length;
		$('.present-past-div-count').val(presentPastDivCount);
		
		//Illness Addmore
		
		$('#btn-addmore-illness').click(function(e) {
			e.preventDefault();
			var counter = $('.present-past-div-count').val();
			counter++;
			
			$('#presentPastDiv').append('<div class="form-group ">' + '<div class="col-sm-2">' + '<input type="text" name="illness_name' + counter + '" id="illness_name' + counter + '" class="form-control illness_name" />' + '</div>' + '<div class="col-sm-2">' + '<label class="radio-inline">' + '<input type="radio" value="Current" name="illness_status' + counter + '" class="present-past-current radioValidation illness_status" id="illness_status_current' + counter + '">' + 'Current' + '</label>' + '</div>' + '<div class="col-sm-2">' + '<label class="radio-inline col-sm-2">' + '<input type="radio" value="Past" name="illness_status' + counter + '"class="present-past-past radioValidation illness_status" id="illness_status_past' + counter + '">' + 'Past' + '</label>' + '</div>' + '<div class="col-sm-2">' + '<label class="radio-inline">' + '<input type="radio" value="NA" name="illness_status' + counter + '"class="present-past-na pp-dynamic-na radioValidation illness_status" id="illness_status_na' + counter + '">' + 'N/A' + '</label>' + '</div>' + '<div class="dd_col_size">' + '<div class="col-sm-3">' + '<input type="text" name="illness_medication' + counter + '" id="medication_present_past' + counter + '" class="form-control present-past-medication-empty ilness_medication",placeholder="Medication" />' + '</div>' + '</div>' + '<div class="dd_col_size">' + '<div class="col-sm-1">' + '<button name="btn-ppmore-remove" onclick="return illnessRemove(this);" class="btn btn-danger btn-ppmore-remove dd_right dd_mg_Medication_10 " id="btn-ppmore-remove">x</button' + '</div>' + '</div>' + '</div>');
			
						//Assigning new value to illnessDivCount
						$('.present-past-div-count').val(counter);
					});
		
	});
				
				function illnessRemove(e) {
			//alert(event.type);
			var clickedElements = $(e).closest('.form-group');
			//console.log(clickedElements);
			
			var removedRawId = clickedElements.find('.present-past-medication-empty').attr('id');
			clickedElements.remove();
			
			var removedId = parseInt(removedRawId.replace(/[^0-9\.]/g, ''), 10);
			//console.log(removedId);
			
			$('.presentPastDiv').each(function() {
				var defaultIllnessCount = $(this).find('.form-group').length;
				$('.present-past-div-count').val(defaultIllnessCount);
			});
			
			var newDefaultIllnessCount = $('.present-past-div-count').val();
			//console.log(newDefaultIllnessCount);
			
			for ( i = 1; i <= newDefaultIllnessCount; i++) {
				
				var nextIllnessId = parseInt(i) + parseInt(1);
				if (nextIllnessId > removedId) {
					var decrementIllnessId = nextIllnessId - 1;
					console.log('decrement' + decrementIllnessId);
					var selected1 = $('#presentPastDiv').find('.form-group').find('#illness_name' + nextIllnessId);
					var selected2 = $('#presentPastDiv').find('.form-group').find('#illness_status_current' + nextIllnessId);
					var selected3 = $('#presentPastDiv').find('.form-group').find('#illness_status_past' + nextIllnessId);
					var selected4 = $('#presentPastDiv').find('.form-group').find('#illness_status_na' + nextIllnessId);
					var selected5 = $('#presentPastDiv').find('.form-group').find('#medication_present_past' + nextIllnessId);
					//var selected2 = $('#medicine').find('.form-group').find('.frequency'+nextDivId);
					//selected1.attr('name','frequency'+decrementDivId+'[]');
					selected1.attr({
						'name' : 'illness_name' + decrementIllnessId,
						'id' : 'illness_name' + decrementIllnessId
					});
					selected2.attr({
						'name' : 'illness_status' + decrementIllnessId,
						'id' : 'illness_status_current' + decrementIllnessId
					});
					selected3.attr({
						'name' : 'illness_status' + decrementIllnessId,
						'id' : 'illness_status_past' + decrementIllnessId
					});
					selected4.attr({
						'name' : 'illness_status' + decrementIllnessId,
						'id' : 'illness_status_na' + decrementIllnessId
					});
					selected5.attr({
						'name' : 'illness_medication' + decrementIllnessId,
						'id' : 'medication_present_past' + decrementIllnessId
					});
					
				}
				
				$('.present-past-div-count').val(newDefaultIllnessCount);
				
			}
			
		}
		
	</script>
	@stop 