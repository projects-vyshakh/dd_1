@section('head')

	{!!Html::style('assets/plugins/datepicker/css/datepicker.css')!!}
    {!!Html::style('assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css')!!}
    {!!Html::style('assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css')!!}
    
    <style>
    	.other-textbox{
    		padding-left: 0px;
    		margin-top: 8px;
    	}
    </style>

@stop
@extends('layouts.master')

@section('main')

<?php
$newPatientId = Session::get('patientId'); 

//var_dump($medicalHistoryPresentPastMore);
//var_dump($medicalHistory);
if(!empty($medicalHistory)){
	foreach($medicalHistory as $medicalHistoryVal){
		$menarche 					= $medicalHistoryVal->menstrual_menarche;
		$menopause 					= $medicalHistoryVal->menstrual_menopause;
		$hypertension 				= $medicalHistoryVal ->history_present_past_hypertension; 
		$hypertensionMedication 	= $medicalHistoryVal ->history_present_past_hypertension_medication;
		$diabetes 					= $medicalHistoryVal ->history_present_past_diabetes;
		$diabetesMedication 		= $medicalHistoryVal ->history_present_past_diabetes_medication;
		$hypothyroidism 			= $medicalHistoryVal->history_present_past_hypothyroidism;
		$hypothyroidismMedication 	= $medicalHistoryVal->history_present_past_hypothyroidism_medication;
		$hyperthyroidism 			= $medicalHistoryVal->history_present_past_hyperthyroidism;
		$hyperthyroidismMedication 	= $medicalHistoryVal->history_present_past_hyperthyroidism_medication;
		$cyst 						= $medicalHistoryVal->history_present_past_cyst;
		$cystMedication 			= $medicalHistoryVal->history_present_past_cyst_medication;
		$endometriosis 				= $medicalHistoryVal->history_present_past_endometriosis;
		$endometriosisMedication 	= $medicalHistoryVal->history_present_past_endometriosis_medication;
		$uterineFibroids 			= $medicalHistoryVal->history_present_past_uterinefiberoids;
		$uterineFibroidsMedication 	= $medicalHistoryVal->history_present_past_uterinefiberoids_medication;
		$uti 						= $medicalHistoryVal->history_present_past_uti;
		$utiMedication 				= $medicalHistoryVal->history_present_past_uti_medication;
		$cancer 					= $medicalHistoryVal->history_present_past_cancer;
		$cancerMedication 			= $medicalHistoryVal->history_present_past_cancer_medication;


		$fatherHistory =  json_decode($medicalHistoryVal->history_family_father);
		$motherHistory =  json_decode($medicalHistoryVal->history_family_mother);
		$siblingHistory = json_decode($medicalHistoryVal->history_family_sibling);
		$grandfatherHistory   = json_decode($medicalHistoryVal->history_family_grandfather);
		$grandmotherHistory = json_decode($medicalHistoryVal->history_family_grandmother);

		$generalAllergyHistory = json_decode($medicalHistoryVal->history_allergy_general);

		$alcohol = $medicalHistoryVal->history_social_alcohol;
		$tobacoSmoke = $medicalHistoryVal->history_social_tobacco_smoke;
		$tobacoChew = $medicalHistoryVal->history_social_tobacco_chew;
		$otherSocial = $medicalHistoryVal->history_social_other;

		$otherHistory = $medicalHistoryVal->history_other;

	}	

}


?>


	<div class="page-header">
		<h1>Patient Medical History <small></small></h1>
	</div>
	<div class="row">
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

			<!-- start: TEXT FIELDS PANEL -->
			<div class="panel">
				
				<div class="panel-body">
					{!! Form::open(array('route' => 'addPatientMedicalHistory', 'role'=>'form', 'id'=>'addPatientMedicalHistory', 'class'=>'form-horizontal','novalidate'=>'novalidate')) !!}
					<div class="form-group">
						<div class="col-sm-4">
							<h3 class="dd_h3_Pd_t_0">Menstrual History</h3>
						</div>
					</div>
								
					<div class="form-group dd_form_group_pd">
					    {!! Form::label('menarche', 'Menarche', $attributes = array('class'=>'col-sm-2'));  !!}	
					    <div class="col-sm-4">
							<span >
								<!-- {!! Form::text('menarche', Input::old('menarche'), $attributes = array('class'=>'form-control','placeholder' => 'Menarche'));  !!} -->
								@if(!empty($medicalHistory))
									{!! Form::text('menarche',$menarche, $attributes = array('class'=>'form-control','placeholder' => 'Menarche','disabled'=>'disabled'));  !!}
								@else
									{!! Form::text('menarche', Input::old('menarche'), $attributes = array('class'=>'form-control','placeholder' => 'Menarche'));  !!}
								@endif
							</span>
						</div>
						{!! Form::label('menopause', 'Menopause', $attributes = array('class'=>'col-sm-2'));  !!}	
						<div class="col-sm-4">
							<span class="input-icon">
								@if(!empty($medicalHistory))
									{!! Form::text('menopause', $menopause, $attributes = array('class'=>'form-control','placeholder' => 'Menopause','disabled'=>'disabled'));  !!}
								@else
									{!! Form::text('menopause', Input::old('menopause'), $attributes = array('class'=>'form-control','placeholder' => 'Menopause'));  !!}
								@endif
							</span>
						</div>
					</div>

					<hr>
					<div class="form-group dd_form_group_present_pd">
						<div class="col-sm-8">
							<h3 class="dd_h3_Pd_t_0">Present & Past History</h3>
						</div>
						<div class="col-sm-4 dd_Present_PD" >
							@if(!empty($medicalHistory))
								<label class="checkbox-inline col-sm-12">
									<input type="checkbox" value="NA" class="noPresentPastHistory" id="noPresentPast" disabled="disabled"   />
									<input type="hidden" name="present-past-check-value" id="present-past-check-value" class="present-past-check-value">
									No known present & past history to report
								</label>
							@else
								<label class="checkbox-inline col-sm-12">
									<input type="checkbox" value="NA" class="noPresentPastHistory" id="noPresentPast"  />
									<input type="hidden" name="present-past-check-value" id="present-past-check-value" class="present-past-check-value">
									No known present & past history to report
								</label>
							@endif
						
						</div>
					</div>
					
					<div class="presentPastDiv" id="presentPastDiv">
						<div class="form-group">
						    {!! Form::label('hypertension', '1.Hypertension', $attributes = array('class'=>'col-sm-2'));  !!}	
							<div class="col-sm-2">
								@if(!empty($medicalHistory))
									<label class="radio-inline">
										<input type="radio" value="Current" name="hypertension" class="present-past-current" disabled="disabled" @if($hypertension =="Current") checked="checked"  
										 @endif>
										Current
									</label>
								@else
									<label class="radio-inline">
										<input type="radio" value="Current" name="hypertension" class="present-past-current">
										Current
									</label>
								@endif
								
							</div>
							<div class="col-sm-2">
								@if(!empty($medicalHistory))
									<label class="radio-inline">
										<input type="radio" value="Past" name="hypertension" class="present-past-past" disabled="disabled"  @if($hypertension =="Past") checked="checked"  @endif>
										Past
									</label>
								@else
									<label class="radio-inline">
										<input type="radio" value="Past" name="hypertension" class="present-past-past">
										Past
									</label>
								@endif	
							
							</div>	
							<div class="col-sm-2">
								@if(!empty($medicalHistory))
									<label class="radio-inline">
										<input type="radio" value="NA" name="hypertension" class="present-past-na" disabled="disabled"  @if($hypertension =="NA") checked="checked" 
										@endif>
										N/A
									</label>
								@else
									<label class="radio-inline">
										<input type="radio" value="NA" name="hypertension" class="present-past-na">
										N/A
									</label>
								@endif
								
							</div>
								
							<div class="col-sm-4">
								@if(!empty($medicalHistory))
									{!! Form::text('medication_hypertension',$hypertensionMedication, $attributes = array('class'=>'form-control present-past-medication-empty','placeholder' => 'Medication', 'disabled'=>"disabled"));  !!}
								@else
									{!! Form::text('medication_hypertension', Input::old('medication_hypertension'), $attributes = array('class'=>'form-control present-past-medication-empty','placeholder' => 'Medication'));  !!}
								@endif
								
							</div>
						</div>
						<div class="form-group">
						    {!! Form::label('diabetes', '2. Diabetes', $attributes = array('class'=>'col-sm-2'));  !!}	
								<div class="col-sm-2">
									@if(!empty($medicalHistory))
										<label class="radio-inline">
											<input type="radio" value="Current" name="diabetes" class="present-past-current" disabled="disabled"  @if($diabetes =="Current") checked="checked"  @endif> Current
										</label>
									@else
										<input type="radio" value="Current" name="diabetes" class="present-past-current"> Current
									@endif
									
								</div>
								<div class="col-sm-2">
									@if(!empty($medicalHistory))
										<label class="radio-inline">
											<input type="radio" value="Past" name="diabetes" class="present-past-past" disabled="disabled"  @if($diabetes =="Past") checked="checked"  @endif >Past
										</label>
									@else
										<label class="radio-inline">
											<input type="radio" value="Past" name="diabetes" class="present-past-past"  >Past
										</label>
									@endif	
									
								</div>
								<div class="col-sm-2">
									@if(!empty($medicalHistory))
										<label class="radio-inline">
											<input type="radio" value="NA" name="diabetes" class="present-past-na"  disabled="disabled"  @if($diabetes =="NA") checked="checked"
											 @endif>N/A
										</label>
									@else
										<label class="radio-inline">
											<input type="radio" value="NA" name="diabetes" class="present-past-na">N/A
										</label>
									@endif		
								</div>	
								<div class="col-sm-4">
									@if(!empty($medicalHistory))
										{!! Form::text('medication_diabetes',$diabetesMedication, $attributes = array('class'=>'form-control present-past-medication-empty','placeholder' => 'Medication','disabled'=>'disabled'));  !!}
									@else
										{!! Form::text('medication_diabetes', Input::old('medication_diabetes'), $attributes = array('class'=>'form-control present-past-medication-empty','placeholder' => 'Medication'));  !!}
									@endif
									
								</div>
						</div>
						<div class="form-group">
						    {!! Form::label('hyperthyroidism', '3. Hyperthyroidism', $attributes = array('class'=>'col-sm-2'));  !!}	
							<div class="col-sm-2">
								@if(!empty($medicalHistory))
									<label class="radio-inline">
										<input type="radio" value="Current" name="hyperthyroidism" class="present-past-current" disabled="disabled"
										@if($hyperthyroidism =="Current") checked="checked" @endif>Current
									</label>
								@else
									<label class="radio-inline">
										<input type="radio" value="Current" name="hyperthyroidism" class="present-past-current">Current
									</label>
								@endif	
							
							</div>
							<div class="col-sm-2">	
								@if(!empty($medicalHistory))
									<label class="radio-inline">
										<input type="radio" value="Past" name="hyperthyroidism" class="present-past-past" disabled="disabled" @if($hyperthyroidism =="Past") checked="checked" @endif>Past
									</label>
								@else
									<label class="radio-inline">
										<input type="radio" value="Past" name="hyperthyroidism" class="present-past-past" >Past
									</label>
								@endif	
								
							</div>
							<div class="col-sm-2">
								@if(!empty($medicalHistory))
									<label class="radio-inline">
										<input type="radio" value="NA" name="hyperthyroidism" class="present-past-na" disabled="disabled" @if($hyperthyroidism =="NA") checked="checked" @endif> N/A
									</label>
								@else
									<label class="radio-inline">
										<input type="radio" value="NA" name="hyperthyroidism" class="present-past-na" > N/A
									</label>
								@endif		
								
							</div>
								
							<div class="col-sm-4">
								@if(!empty($medicalHistory))
									{!! Form::text('medication_hyperthyroidism', $hyperthyroidismMedication, $attributes = array('class'=>'form-control present-past-medication-empty','placeholder' => 'Medication','disabled'=>'disabled'));  !!}
								@else
									{!! Form::text('medication_hyperthyroidism', Input::old('medication_hyperthyroidism'), $attributes = array('class'=>'form-control present-past-medication-empty','placeholder' => 'Medication'));  !!}
								@endif
								
							</div>
						</div>
						<div class="form-group">
						    {!! Form::label('hypothyroidism', '4. Hypothyroidism', $attributes = array('class'=>'col-sm-2'));  !!}	
							<div class="col-sm-2">
								@if(!empty($medicalHistory))
									<label class="radio-inline">
										<input type="radio" value="Current" name="hypothyroidism" class="present-past-current" disabled="disabled" @if($hypothyroidism =="Current") checked="checked" @endif >Current
									</label>
								@else
									<label class="radio-inline">
										<input type="radio" value="Current" name="hypothyroidism" class="present-past-current"  >Current
									</label>
								@endif		
								
							</div>
							<div class="col-sm-2">
								@if(!empty($medicalHistory))
									<label class="radio-inline">
										<input type="radio" value="Past" name="hypothyroidism" class="present-past-past" disabled="disabled" @if($hypothyroidism =="Past") checked="checked" @endif>Past
									</label>
								@else
									<label class="radio-inline">
										<input type="radio" value="Past" name="hypothyroidism" class="present-past-past" >Past
									</label>
								@endif			
								
							</div>
							<div class="col-sm-2">
								@if(!empty($medicalHistory))
									<label class="radio-inline">
										<input type="radio" value="NA" name="hypothyroidism" class="present-past-na" disabled="disabled"  @if($hypothyroidism =="NA") checked="checked" 
										@endif>N/A
									</label>
								@else
									<label class="radio-inline">
										<input type="radio" value="NA" name="hypothyroidism" class="present-past-na" >N/A
									</label>
								@endif			
								
							</div>
								
							<div class="col-sm-4">
								@if(!empty($medicalHistory))
									{!! Form::text('medication_hypothyroidism', $hypothyroidismMedication, $attributes = array('class'=>'form-control present-past-medication-empty','placeholder' => 'Medication','disabled'=>'disabled'));  !!}
								@else
									{!! Form::text('medication_hypothyroidism',Input::old('medication_hypothyroidism'), $attributes = array('class'=>'form-control present-past-medication-empty','placeholder' => 'Medication'));  !!}
								@endif
								
							</div>
						</div>
						<div class="form-group">
						    {!! Form::label('cyst', '5. Cyst', $attributes = array('class'=>'col-sm-2'));  !!}	
							<div class="col-sm-2">
								@if(!empty($medicalHistory))
									<label class="radio-inline">
										<input type="radio" value="Current" name="cyst" class="present-past-current" disabled="disabled"  @if($cyst =="Current") checked="checked" 
										@endif >Current
									</label>
								@else
									<label class="radio-inline">
										<input type="radio" value="Current" name="cyst" class="present-past-current" >Current
									</label>
								@endif
								
							</div>
							<div class="col-sm-2">
								@if(!empty($medicalHistory))
									<label class="radio-inline">
										<input type="radio" value="Past" name="cyst" class="present-past-past" disabled="disabled"  @if($cyst =="Past") checked="checked"  @endif>Past
									</label>
								@else
									<label class="radio-inline">
										<input type="radio" value="Current" name="cyst" class="present-past-current" >Current
									</label>
								@endif	
								
							</div>
							<div class="col-sm-2">
								@if(!empty($medicalHistory))
									<label class="radio-inline">
										<input type="radio" value="NA" name="cyst" class="present-past-na" disabled="disabled" @if($cyst =="NA") checked="checked" @endif>N/A
									</label>
								@else
									<label class="radio-inline">
										<input type="radio" value="NA" name="cyst" class="present-past-na" >N/A
									</label>
								@endif		
								
							</div>
							<div class="col-sm-4">
								@if(!empty($medicalHistory))
									{!! Form::text('medication_cyst',$cystMedication, $attributes = array('class'=>'form-control present-past-medication-empty','placeholder' => 'Medication','disabled'=>'disabled'));  !!}
								@else
									{!! Form::text('medication_cyst', Input::old('medication_cyst'), $attributes = array('class'=>'form-control present-past-medication-empty','placeholder' => 'Medication'));  !!}
								@endif
								
							</div>
						</div>
						<div class="form-group">
						    {!! Form::label('endometriosis', '6. Endometriosis', $attributes = array('class'=>'col-sm-2'));  !!}	
							<div class="col-sm-2">
								@if(!empty($medicalHistory))
									<label class="radio-inline">
										<input type="radio" value="Current" name="endometriosis" class="present-past-current" disabled="disabled"  @if($endometriosis =="Current") checked="checked" @endif>Current
									</label>
								@else
									<label class="radio-inline">
										<input type="radio" value="Current" name="endometriosis" class="present-past-current" >Current
									</label>
								@endif	
							
							</div>
							<div class="col-sm-2">
								@if(!empty($medicalHistory))
									<label class="radio-inline">
										<input type="radio" value="Past" name="endometriosis" class="present-past-past" disabled="disabled"  @if($endometriosis =="Past") checked="checked"  @endif>Past
									</label>
								@else
									<label class="radio-inline">
										<input type="radio" value="Past" name="endometriosis" class="present-past-past" >Past
									</label>
								@endif		
								
							</div>
							<div class="col-sm-2">
								@if(!empty($medicalHistory))
									<label class="radio-inline">
										<input type="radio" value="NA" name="endometriosis" class="present-past-na" disabled="disabled" @if($endometriosis =="NA") checked="checked"    @endif>N/A
									</label>
								@else
									<label class="radio-inline">
										<input type="radio" value="NA" name="endometriosis" class="present-past-na" >N/A
									</label>
								@endif	
								
							</div>
							<div class="col-sm-4">
								@if(!empty($medicalHistory))
									{!! Form::text('medication_endometriosis',$endometriosisMedication, $attributes = array('class'=>'form-control present-past-medication-empty','placeholder' => 'Medication','disabled'=>'disabled'));  !!}
								@else
									{!! Form::text('medication_endometriosis',Input::old('medication_endometriosis '), $attributes = array('class'=>'form-control present-past-medication-empty','placeholder' => 'Medication'));  !!}
								@endif
								
							</div>
						</div>
						<div class="form-group">
						    {!! Form::label('uterinefibroids', '7. Utrine Fibroids', $attributes = array('class'=>'col-sm-2'));  !!}	
							<div class="col-sm-2">
								@if(!empty($medicalHistory))
									<label class="radio-inline">
										<input type="radio" value="Current" name="uterinefibroids" class="present-past-current" disabled="disabled" @if($uterineFibroids =="Current") checked="checked" @endif>Current
									</label>
								@else
									<label class="radio-inline">
										<input type="radio" value="Current" name="uterinefibroids" class="present-past-current" >Current
									</label>
								@endif
								
							</div>
							<div class="col-sm-2">
								@if(!empty($medicalHistory))
									<label class="radio-inline">
										<input type="radio" value="Past" name="uterinefibroids" class="present-past-past" disabled="disabled" @if($uterineFibroids =="Past") checked="checked" @endif >Past
									</label>
								@else
									<label class="radio-inline">
										<input type="radio" value="Past" name="uterinefibroids" class="present-past-past" >Past
									</label>
								@endif	
							
							</div>
							<div class="col-sm-2">
								@if(!empty($medicalHistory))
									<label class="radio-inline">
										<input type="radio" value="NA" name="uterinefibroids" class="present-past-na" disabled="disabled" @if($uterineFibroids =="NA") checked="checked" @endif> N/A
									</label>
								@else
									<label class="radio-inline">
										<input type="radio" value="NA" name="uterinefibroids" class="present-past-na"> N/A
									</label>
								@endif
								
							</div>
							<div class="col-sm-4">
								@if(!empty($medicalHistory))
									{!! Form::text('medication_uterinefibroids', $uterineFibroidsMedication, $attributes = array('class'=>'form-control present-past-medication-empty','placeholder' => 'Medication','disabled'=>'disabled'));  !!}
								@else
									{!! Form::text('medication_uterinefibroids', Input::old('medication_uterinefibroids'), $attributes = array('class'=>'form-control present-past-medication-empty','placeholder' => 'Medication'));  !!}
								@endif
							
							</div>
						</div>
						<div class="form-group">
						    {!! Form::label('uti', '8. UTI', $attributes = array('class'=>'col-sm-2'));  !!}	
							<div class="col-sm-2">
								@if(!empty($medicalHistory))
									<label class="radio-inline">
										<input type="radio" value="Current" name="uti" class="present-past-current"  disabled="disabled" @if($uti =="Current")  checked="checked" 
										@endif>Current
									</label>
								@else
									<label class="radio-inline">
										<input type="radio" value="Current" name="uti" class="present-past-current" >Current
									</label>
								@endif
							
							</div>
							<div class="col-sm-2">
								@if(!empty($medicalHistory))
									<label class="radio-inline">
										<input type="radio" value="Past" name="uti" class="present-past-past" disabled="disabled" @if($uti =="Past") checked="checked" 
										@endif >Past
									</label>
								@else
									<label class="radio-inline">
										<input type="radio" value="Past" name="uti" class="present-past-past"  >Past
									</label>
								@endif	
							
							</div>
							<div class="col-sm-2">
								@if(!empty($medicalHistory))
									<label class="radio-inline">
										<input type="radio" value="NA" name="uti" class="present-past-na" disabled="disabled"  @if($uti =="NA") checked="checked" 
										@endif>N/A
									</label>
								@else
									<label class="radio-inline">
										<input type="radio" value="NA" name="uti" class="present-past-na" >N/A
									</label>
								@endif	
								
							</div>
							<div class="col-sm-4">
								@if(!empty($medicalHistory))
									{!! Form::text('medication_uti',$utiMedication, $attributes = array('class'=>'form-control present-past-medication-empty','placeholder' => 'Medication','disabled'=>'disabled'));  !!}
								@else
									{!! Form::text('medication_uti', Input::old('medication_uti '), $attributes = array('class'=>'form-control present-past-medication-empty','placeholder' => 'Medication'));  !!}
								@endif
								
							</div>
						</div>
						<div class="form-group">
						    {!! Form::label('cancer', '9. Cancer', $attributes = array('class'=>'col-sm-2'));  !!}	
							<div class="col-sm-2">
								@if(!empty($medicalHistory))
									<label class="radio-inline">
										<input type="radio" value="Current" name="cancer" class="present-past-current" disabled="disabled" @if($cancer =="Current") checked="checked" 
										@endif >Current
									</label>
								@else
									<label class="radio-inline">
										<input type="radio" value="Current" name="cancer" class="present-past-current" >Current
									</label>
								@endif	
								
							</div>
							<div class="col-sm-2">
								@if(!empty($medicalHistory))
									<label class="radio-inline">
										<input type="radio" value="Past" name="cancer" class="present-past-past"  disabled="disabled" @if($cancer =="Past") checked="checked" 
										 @endif>Past
									</label>
								@else
									<label class="radio-inline">
										<input type="radio" value="Past" name="cancer" class="present-past-past"  >Past
									</label>
								@endif		
							
							</div>
							<div class="col-sm-2">
								@if(!empty($medicalHistory))
									<label class="radio-inline">
										<input type="radio" value="NA" name="cancer" class="present-past-na" disabled="disabled" @if($cancer =="NA") checked="checked" 
										@endif>N/A
									</label>
								@else
									<label class="radio-inline">
										<input type="radio" value="NA" name="cancer" class="present-past-na">N/A
									</label>
								@endif		
								
							</div>
							<div class="col-sm-4" >
								@if(!empty($medicalHistory))
									{!! Form::text('medication_cancer', $cancerMedication, $attributes = array('class'=>'form-control present-past-medication-empty','placeholder' => 'Medication','disabled'=>'disabled'));  !!}
								@else
									{!! Form::text('medication_cancer', Input::old('medication_cancer'), $attributes = array('class'=>'form-control present-past-medication-empty','placeholder' => 'Medication'));  !!}
								@endif
								
							</div>
						</div>
						@if(!empty($medicalHistoryPresentPastMore))
						<?php $counter = 1; ?>
						@foreach($medicalHistoryPresentPastMore as $presentPastMore)
						<?php  $counter++; ?>
						<div class="form-group">
							<div class="col-sm-2">
								<input type="text" name="illness_name[]" id="illness_name" class="form-control " value="{{$presentPastMore->illness_name}}" disabled="disabled"/>
	   						</div>
	   						<div class="col-sm-2">
	 							<label class="radio-inline">
									<input type="radio" value="Current" name="illness<?php echo $counter; ?>" class="" disabled="disabled"  @if($presentPastMore->illness_status=="Current") checked="checked" @endif>
									Current
								</label>
							</div>
							<div class="col-sm-2">	
								<label class="radio-inline col-sm-2">
									<input type="radio" value="Past" name="illness<?php echo $counter; ?>" class=""  disabled="disabled" @if($presentPastMore->illness_status=="Past") checked="checked" @endif>
									Past
								</label>
							</div>
							<div class="col-sm-2">	
								<label class="radio-inline">
									<input type="radio" value="NA" name="illness<?php echo $counter; ?>" class=" pp-dynamic-na" disabled="disabled" @if($presentPastMore->illness_status=="NA") checked="checked" @endif>
									N/A
								</label>
	   						</div>
	   						<div class="col-sm-4">
	   							<input type="text" name="illness_medication[]" id="medication_present_past'+counter+'" class="form-control",placeholder="Medication" value="{{$presentPastMore->medication}}" disabled="disabled" />
	   						</div>
	   					</div>
						@endforeach
						@endif
					</div>

					<div class="form-group dd_form_group_present_pd_2">
									
						<div class="col-sm-12">
							<button type="submit" class="btn btn-default btn-addmore-illness" id="btn-addmore-illness" style="margin-top: 10px"><i class="fa fa-plus-circle "></i> Add More illness</button>
						</div>
					</div>
					
					<hr>

					<div class="form-group">
						<div class="col-sm-8">
							<h3>Family History</h3>
						</div>
					</div>

				 	<div class="form-group">
				 		<div class="container">   
							<div class="row">
								<div class="dd_sample_F">
					    			{!! Form::label('father', '1. Father', $attributes = array('class'=>'checkbox-linline dd_sample_175' ));  !!}
					    		</div>	
					   			
					   			@if((!empty($medicalHistory)) && (!empty($fatherHistory)))
									<div class="dd_sample_L">
										<label class="checkbox-inline dd_sample_125">
											<input type="checkbox" value="Hypertension" class="family-hypertension" name="father[]" disabled="disabled" @if(in_array("Hypertension",$fatherHistory)) checked="checked" @endif>
											Hypertension
										</label>
										<label class="checkbox-inline dd_sample_125">
											<input type="checkbox" value="Diabetes" class="family-diabetes" name="father[]" disabled="disabled" @if(in_array("Diabetes",$fatherHistory)) checked="checked" @endif>
											Diabetes
										</label>
										<label class="checkbox-inline dd_sample_1252">
											<input type="checkbox" value="Cancer" class="family-cancer" name="father[]" disabled="disabled" @if(in_array("Cancer",$fatherHistory)) checked="checked" @endif>
											Cancer
										</label>
										<label class="checkbox-inline dd_sample_125">
											<input type="checkbox" value="" class="family-other" disabled="disabled" @if(count($fatherHistory)>3) checked="checked" @endif>
											Other
										</label>
									</div>		
									<div class="dd_sample_M">
										{!! Form::text('father[]',(count($fatherHistory)>3)?$fatherHistory[3]: Input::old('father'), $attributes = array('class'=>'form-control other-medical-history','placeholder' => 'Other','disabled'=>'disabled'));  !!}
									</div>
									<div class="dd_sample_R">
										<label class="checkbox-inline dd_sample_125">
											<input type="checkbox" value="" class="family-history-na" disabled="disabled" @if(in_array("NA",$fatherHistory)) checked="checked" @endif>
											N/A
										</label>
									</div>	
								@else
									<div class="dd_sample_L">
										<label class="checkbox-inline dd_sample_125">
											<input type="checkbox" value="Hypertension" class="family-hypertension" name="father[]" >
											Hypertension
										</label>
										<label class="checkbox-inline dd_sample_1252">
											<input type="checkbox" value="Diabetes" class="family-diabetes" name="father[]">
											Diabetes
										</label>
										<label class="checkbox-inline dd_sample_125">
											<input type="checkbox" value="Cancer" class="family-cancer" name="father[]">
											Cancer
										</label>
										<label class="checkbox-inline dd_sample_125">
											<input type="checkbox" value="" class="family-other">
											Other
										</label>
									</div>	
									<div class="dd_sample_M">
										{!! Form::text('father[]', Input::old('father'), $attributes = array('class'=>'form-control other-medical-history','placeholder' => 'Other'));  !!}
									</div>
									<div class="dd_sample_R">
										<label class="checkbox-inline dd_sample_125">
											<input type="checkbox" value="" class="family-history-na">
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
					    			{!! Form::label('mother', '2. Mother', $attributes = array('class'=>'checkbox-inline dd_sample_175'));  !!}
					    		</div>	
					    		@if((!empty($medicalHistory)) && (!empty($motherHistory)))		
									<div class="dd_sample_L">
										<label class="checkbox-inline dd_sample_125">
											<input type="checkbox" value="Hypertension" class="family-hypertension" name="mother[]" disabled="disabled" @if(in_array("Hypertension",$motherHistory)) checked="checked" @endif>
											Hypertension
										</label>
										<label class="checkbox-inline dd_sample_125">
											<input type="checkbox" value="Diabetes" class="family-diabetes" name="mother[]" disabled="disabled" @if(in_array("Diabetes",$motherHistory)) checked="checked" @endif>
											Diabetes
										</label>
										<label class="checkbox-inline dd_sample_125">
											<input type="checkbox" value="Cancer" class="family-cancer" name="mother[]" disabled="disabled" @if(in_array("Cancer",$motherHistory)) checked="checked" @endif>
											Cancer
										</label>
										<label class="checkbox-inline dd_sample_125">
											<input type="checkbox" value="" class="family-other" name="mother[]" disabled="disabled" @if(count($motherHistory)>3) checked="checked" @endif>
											Other
										</label>
									</div>	
									<div class="dd_sample_M">
										{!! Form::text('mother[]', (count($motherHistory)>3)?$motherHistory[3]: Input::old('mother'), $attributes = array('class'=>'form-control other-medical-history','placeholder' => 'Other'));  !!}
									</div>
									<div class="dd_sample_R">
										<label class="checkbox-inline">
											<input type="checkbox" value="" class="family-history-na" disabled="disabled" @if(in_array("NA",$motherHistory)) checked="checked" @endif>
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
											<input type="checkbox" value="" class="family-other" name="mother[]">
											Other
										</label>
									</div>	
									<div class="dd_sample_M">
										{!! Form::text('mother[]', Input::old('mother'), $attributes = array('class'=>'form-control other-medical-history','placeholder' => 'Other'));  !!}
									</div>
									<div class="dd_sample_R">
										<label class="checkbox-inline">
											<input type="checkbox" value="" class="family-history-na">
											N/A
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
					    			{!! Form::label('sibling', '3. Sibling', $attributes = array('class'=>'checkbox-inline dd_sample_175'));  !!}
					    		</div>
					    		@if((!empty($medicalHistory)) && (!empty($siblingHistory)))
									<div class="dd_sample_L">
										<label class="checkbox-inline dd_sample_125">
											<input type="checkbox" value="Hypertension" class="family-hypertension" name="sibling[]" disabled="disabled" @if(in_array("Hypertension",$siblingHistory)) checked="checked" @endif>
											Hypertension
										</label>
										<label class="checkbox-inline dd_sample_125">
											<input type="checkbox" value="Diabetes" class="family-diabetes" name="sibling[]" disabled="disabled" @if(in_array("Diabetes",$siblingHistory)) checked="checked" @endif>
											Diabetes
										</label>
										<label class="checkbox-inline dd_sample_125">
											<input type="checkbox" value="Cancer" class="family-cancer" name="sibling[]" disabled="disabled" @if(in_array("Cancer",$siblingHistory)) checked=" checked" @endif>
											Cancer
										</label>
										<label class="checkbox-inline dd_sample_125">
											<input type="checkbox" value="NA" class="family-other" disabled="disabled" @if(count($siblingHistory)>3) checked="checked" @endif>
											Other
										</label>
									</div>	
									<div class="dd_sample_M">
										{!! Form::text('sibling[]', (count($siblingHistory)>3)?$siblingHistory[3]: Input::old('sibling'), $attributes = array('class'=>'form-control other-medical-history','placeholder' => 'Other'));  !!}
									</div>
									<div class="dd_sample_R">
										<label class="checkbox-inline ">
											<input type="checkbox" value="NA" class="family-history-na" disabled="disabled" @if(in_array("NA",$siblingHistory)) checked="checked" @endif>
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
											<input type="checkbox" value="NA" class="family-other">
											Other
										</label>
									</div>	
									<div class="dd_sample_M">
										{!! Form::text('sibling[]', Input::old('sibling'), $attributes = array('class'=>'form-control other-medical-history','placeholder' => 'Other'));  !!}
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
					   			 	{!! Form::label('grandfather', '3. Grandfather', $attributes = array('class'=>'checkbox-inline dd_sample_175'));  !!}	
					   			</div>	
					   			@if((!empty($medicalHistory)) && (!empty($siblingHistory)))
									<div class="dd_sample_L">
										<label class="checkbox-inline dd_sample_125">
											<input type="checkbox" value="Hypertension" class="family-hypertension" name="grandfather[]" disabled="disabled" @if(in_array("Hypertension",$grandfatherHistory)) checked="checked" @endif>
											Hypertension
										</label>
										<label class="checkbox-inline dd_sample_125">
											<input type="checkbox" value="Diabetes" class="family-diabetes" name="grandfather[]" disabled="disabled" @if(in_array("Diabetes",$grandfatherHistory)) checked="checked" @endif>
											Diabetes
										</label>
										<label class="checkbox-inline dd_sample_125">
											<input type="checkbox" value="Cancer" class="family-cancer" name="grandfather[]" disabled="disabled" @if(in_array("Cancer",$grandfatherHistory)) checked="checked" @endif>
											Cancer
										</label>
										<label class="checkbox-inline dd_sample_125">
											<input type="checkbox" value="" class="family-other" disabled="disabled" @if(count($grandfatherHistory)>3) checked="checked" @endif>
											Other
										</label>
									</div>	
									<div class="dd_sample_M">
										{!! Form::text('grandfather[]', Input::old('grandfather'), $attributes = array('class'=>'form-control other-medical-history','placeholder' => 'Other'));  !!}
									</div>
									<div class="dd_sample_R">
										<label class="checkbox-inlinw">
											<input type="checkbox" value="" class="family-history-na" disabled="disabled" @if(in_array("NA",$grandfatherHistory)) checked="checked" @endif>
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
											<input type="checkbox" value="" class="family-other">
											Other
										</label>
									</div>	
									<div class="dd_sample_M">
										{!! Form::text('grandfather[]', Input::old('grandfather'), $attributes = array('class'=>'form-control other-medical-history','placeholder' => 'Other'));  !!}
									</div>
									<div class="dd_sample_R">
										<label class="checkbox-inline col-sm-1">
											<input type="checkbox" value="" class="family-history-na">
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
					    			{!! Form::label('grandmother', '5. Grandmother', $attributes = array('class'=>'checkbox-inline dd_sample_175'));  !!}
					    		</div>
					    		@if((!empty($medicalHistory)) && (!empty($siblingHistory)))		
									<div class="dd_sample_L">
										<label class="checkbox-inline dd_sample_125">
											<input type="checkbox" value="Hypertension" class="family-hypertension" id="hyp" name="grandmother[]" disabled="disabled" @if(in_array("Hypertension",$grandmotherHistory)) checked="checked" @endif>
											Hypertension
										</label>
										<label class="checkbox-inline dd_sample_125">
											<input type="checkbox" value="Diabetes" class="family-diabetes" name="grandmother[]" disabled="disabled" @if(in_array("Diabetes",$grandmotherHistory)) checked="checked" @endif>
											Diabetes
										</label>
										<label class="checkbox-inline dd_sample_125">
											<input type="checkbox" value="Cancer" class="family-cancer" name="grandmother[]" disabled="disabled" @if(in_array("Cancer",$grandmotherHistory)) checked="checked" @endif>
											Cancer
										</label>
										<label class="checkbox-inlinedd_sample_125">
											<input type="checkbox" value="" class="family-other" disabled="disabled">
											Other
										</label>
									</div>	
									<div class="dd_sample_M">
										{!! Form::text('grandmother[]', Input::old('grandmother'), $attributes = array('class'=>'form-control other-medical-history','placeholder' => 'Other'));  !!}
									</div>
									<div class="dd_sample_R">
										<label class="checkbox-inline">
											<input type="checkbox" value="" class="family-history-na" disabled="disabled" @if(in_array("NA",$grandmotherHistory)) checked="checked" @endif>
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
											<input type="checkbox" value="" class="family-other">
											Other
										</label>
									</div>	
									<div class="dd_sample_M">
										{!! Form::text('grandmother[]', Input::old('grandmother'), $attributes = array('class'=>'form-control other-medical-history','placeholder' => 'Other'));  !!}
									</div>
									<div class="dd_sample_R">
										<label class="checkbox-inline">
											<input type="checkbox" value="" class="family-history-na">
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
						<div class="col-sm-4">
							<label class="checkbox-inline col-sm-12">
								@if(!empty($surgeryHistory))
									<input type="checkbox" value="NA" class="noSurgicalHistory" id="noSurgicalHistory" disabled="disabled" />
									No known surgical history to reports
								@else
									<input type="checkbox" value="NA" class="noSurgicalHistory" id="noSurgicalHistory" />
									No known surgical history to reports
								@endif
							</label>
						</div>
					</div>
						
					<div class="surgery" id="surgery">
						@if(!empty($surgeryHistory))
							@foreach($surgeryHistory as $surgeryHistoryVal)			
								<div class="form-group">
								    {!! Form::label('surgery', 'Surgery', $attributes = array('class'=>'col-sm-2'));  !!}	
								    <div class="col-sm-8">
										<span>
											{!! Form::text('surgery[]',  $surgeryHistoryVal->surgery_name, $attributes = array('class'=>'form-control surgicalhistory','placeholder' => 'Surgery','disabled'=>'disabled'));  !!}
											
										</span>
									</div>
								</div>
							@endforeach
						@else
								<div class="form-group">
								    {!! Form::label('surgery', 'Surgery', $attributes = array('class'=>'col-sm-2'));  !!}	
								    <div class="col-sm-8">
										<span >
											{!! Form::text('surgery[]', Input::old('surgery'), $attributes = array('class'=>'form-control surgicalhistory','placeholder' => 'Surgery'));  !!}
											
										</span>
									</div>
								</div>
						@endif
					</div>	
					<div class="form-group">	
						<div class="col-sm-2">
							<button class="btn btn-default btn-add-surgery" style="margin-top: 10px"><i class="fa fa-plus-circle "></i>Add More Surgery</button>
						</div>
					</div>
					
					<hr>

					<div class="form-group">
						<div class="col-sm-8">
							<h3 class="dd_h3_Pd_t_0">Allergy History</h3>
						</div>
					</div>
					<div class="form-group">
						<!-- <div class="col-sm-1"></div> -->
						<div class="col-sm-8">
							<h6>General</h6>
						</div>
					</div>
					<div class="form-group">
						<!-- <div class="col-sm-1"></div> -->
						<div class="col-sm-12">
							@if(!empty($medicalHistory))
								<label class="checkbox-inline col-sm-2">
									<input type="checkbox" value="Casein" class="" name="allergy_general[]" disabled="disabled" @if(!empty($generalAllergyHistory)) @if(in_array("Casein",$generalAllergyHistory)) checked="checked" @endif @endif>
									Casein
								</label>
								<label class="checkbox-inline col-sm-2">
									<input type="checkbox" value="Egg" class="" name="allergy_general[]" disabled="disabled" @if(!empty($generalAllergyHistory)) @if(in_array("Egg",$generalAllergyHistory)) checked="checked" @endif @endif>
									Egg
								</label>
								<label class="checkbox-inline col-sm-2">
									<input type="checkbox" value="Fish" class="" name="allergy_general[]" disabled="disabled" @if(!empty($generalAllergyHistory)) @if(in_array("Fish",$generalAllergyHistory)) checked="checked" @endif @endif>
									Fish
								</label>
								<label class="checkbox-inline col-sm-2">
									<input type="checkbox" value="Milk" class="" name="allergy_general[]" disabled="disabled" @if(!empty($generalAllergyHistory)) @if(in_array("Milk",$generalAllergyHistory)) checked="checked" @endif @endif>
									Milk
								</label>
								<label class="checkbox-inline col-sm-2">
									<input type="checkbox" value="Nut" class="" name="allergy_general[]" disabled="disabled" @if(!empty($generalAllergyHistory)) @if(in_array("Nut",$generalAllergyHistory)) checked="checked" @endif @endif>
									Nut
								</label>
								<label class="checkbox-inline col-sm-2">
									<input type="checkbox" value="Shellfish" class="" name="allergy_general[]" disabled="disabled" @if(!empty($generalAllergyHistory)) @if(in_array("Shellfish",$generalAllergyHistory)) checked="checked" @endif @endif>
									Shellfish
								</label>
								<label class="checkbox-inline col-sm-2">
									<input type="checkbox" value="Sulfite" class="" name="allergy_general[]" disabled="disabled" @if(!empty($generalAllergyHistory)) @if(in_array("Sulfite",$generalAllergyHistory)) checked="checked" @endif @endif>
									Sulfite
								</label>
								<label class="checkbox-inline col-sm-2">
									<input type="checkbox" value="Soy" class="" name="allergy_general[]" disabled="disabled" @if(!empty($generalAllergyHistory)) @if(in_array("Soy",$generalAllergyHistory)) checked="checked" @endif @endif>
									Soy
								</label>
								<label class="checkbox-inline col-sm-2">
									<input type="checkbox" value="Wheat" class="" name="allergy_general[]" disabled="disabled" @if(!empty($generalAllergyHistory)) @if(in_array("Wheat",$generalAllergyHistory)) checked="checked" @endif @endif>
									Wheat
								</label>
								<label class="checkbox-inline col-sm-2">
									<input type="checkbox" value="Spring" class="" name="allergy_general[]" disabled="disabled" @if(!empty($generalAllergyHistory)) @if(in_array("Spring",$generalAllergyHistory)) checked="checked" @endif @endif>
									Spring
								</label>
								<label class="checkbox-inline col-sm-2">
									<input type="checkbox" value="Summer" class="" name="allergy_general[]"disabled="disabled" @if(!empty($generalAllergyHistory)) @if(in_array("Summer",$generalAllergyHistory)) checked="checked" @endif @endif>
									Summer
								</label>
								<label class="checkbox-inline col-sm-2">
									<input type="checkbox" value="Fall" class="" name="allergy_general[]" disabled="disabled" @if(!empty($generalAllergyHistory)) @if(in_array("Fall",$generalAllergyHistory)) checked="checked" @endif @endif>
									Fall
								</label>
								<label class="checkbox-inline col-sm-2">
									<input type="checkbox" value="Winter" class="" name="allergy_general[]" disabled="disabled" @if(!empty($generalAllergyHistory)) @if(in_array("Winter",$generalAllergyHistory)) checked="checked" @endif @endif>
									Winter
								</label>
									<label class="checkbox-inline col-sm-2">
									<input type="checkbox" value="Bee" class="" name="allergy_general[]" disabled="disabled" @if(!empty($generalAllergyHistory)) @if(in_array("Bee",$generalAllergyHistory)) checked="checked" @endif @endif>
									Bee
								</label>
								<label class="checkbox-inline col-sm-2">
									<input type="checkbox" value="Cat" class="" name="allergy_generals[]" disabled="disabled" @if(!empty($generalAllergyHistory)) @if(in_array("Cat",$generalAllergyHistory)) checked="checked" @endif @endif>
									Cat
								</label>
								<label class="checkbox-inline col-sm-2">
									<input type="checkbox" value="Dog" class="" name="allergy_general[]" disabled="disabled" @if(!empty($generalAllergyHistory)) @if(in_array("Dog",$generalAllergyHistory)) checked="checked" @endif @endif>
									Dog
								</label>
								<label class="checkbox-inline col-sm-2">
									<input type="checkbox" value="Insect" class="" name="allergy_general[]" disabled="disabled" @if(!empty($generalAllergyHistory)) @if(in_array("Insect",$generalAllergyHistory)) checked="checked" @endif @endif>
									Insect
								</label>
								<label class="checkbox-inline col-sm-2">
									<input type="checkbox" value="Dust" class="" name="allergy_general[]" disabled="disabled" @if(!empty($generalAllergyHistory)) @if(in_array("Dust",$generalAllergyHistory)) checked="checked" @endif @endif>
									Dust
								</label>
								<label class="checkbox-inline col-sm-2">
									<input type="checkbox" value="Mold" class="" name="allergy_general[]" disabled="disabled" @if(!empty($generalAllergyHistory)) @if(in_array("Mold",$generalAllergyHistory)) checked="checked" @endif @endif>
									Mold
								</label>
								<label class="checkbox-inline col-sm-2">
									<input type="checkbox" value="Plant" class="" name="allergy_general[]" disabled="disabled" @if(!empty($generalAllergyHistory)) @if(in_array("Plant",$generalAllergyHistory)) checked="checked" @endif @endif>
									Plant
								</label>
								<label class="checkbox-inline col-sm-2">
									<input type="checkbox" value="Pollen" class="" name="allergy_general[]" disabled="disabled" @if(!empty($generalAllergyHistory)) @if(in_array("Pollen",$generalAllergyHistory)) checked="checked" @endif @endif>
									Pollen
								</label>
								<label class="checkbox-inline col-sm-2">
									<input type="checkbox" value="Sun" class="" name="allergy_general[]" disabled="disabled" @if(!empty($generalAllergyHistory)) @if(in_array("Sun",$generalAllergyHistory)) checked="checked" @endif @endif>
									Sun
								</label>
								<label class="checkbox-inline col-sm-2">
									<input type="checkbox" value="NA" class="" name="allergy_general[]" disabled="disabled" @if(!empty($generalAllergyHistory)) @if(in_array("NA",$generalAllergyHistory)) checked="checked" @endif @endif>
									N/A
								</label>
							@else
								<label class="checkbox-inline col-sm-2">
									<input type="checkbox" value="Casein" class="allergy_general" name="allergy_general[]">
									Casein
								</label>
								<label class="checkbox-inline col-sm-2">
									<input type="checkbox" value="Egg" class="allergy_general" name="allergy_general[]">
									Egg
								</label>
								<label class="checkbox-inline col-sm-2">
									<input type="checkbox" value="Fish" class="allergy_general" name="allergy_general[]">
									Fish
								</label>
								<label class="checkbox-inline col-sm-2">
									<input type="checkbox" value="Milk" class="allergy_general" name="allergy_general[]">
									Milk
								</label>
								<label class="checkbox-inline col-sm-2">
									<input type="checkbox" value="Nut" class="allergy_general" name="allergy_general[]">
									Nut
								</label>
								<label class="checkbox-inline col-sm-2">
									<input type="checkbox" value="Shellfish" class="allergy_general" name="allergy_general[]">
									Shellfish
								</label>
								<label class="checkbox-inline col-sm-2">
									<input type="checkbox" value="Sulfite" class="allergy_general" name="allergy_general[]">
									Sulfite
								</label>
								<label class="checkbox-inline col-sm-2">
									<input type="checkbox" value="Soy" class="allergy_general" name="allergy_general[]">
									Soy
								</label>
								<label class="checkbox-inline col-sm-2">
									<input type="checkbox" value="Wheat" class="allergy_general" name="allergy_general[]">
									Wheat
								</label>
								<label class="checkbox-inline col-sm-2">
									<input type="checkbox" value="Spring" class="allergy_general" name="allergy_general[]">
									Spring
								</label>
								<label class="checkbox-inline col-sm-2">
									<input type="checkbox" value="Summer" class="allergy_general" name="allergy_general[]">
									Summer
								</label>
								<label class="checkbox-inline col-sm-2">
									<input type="checkbox" value="Fall" class="allergy_general" name="allergy_general[]">
									Fall
								</label>
								<label class="checkbox-inline col-sm-2">
									<input type="checkbox" value="Winter" class="allergy_general" name="allergy_general[]">
									Winter
								</label>
									<label class="checkbox-inline col-sm-2">
									<input type="checkbox" value="Bee" class="allergy_general" name="allergy_general[]">
									Bee
								</label>
								<label class="checkbox-inline col-sm-2">
									<input type="checkbox" value="Cat" class="allergy_general" name="allergy_generals[]">
									Cat
								</label>
								<label class="checkbox-inline col-sm-2">
									<input type="checkbox" value="Dog" class="allergy_general" name="allergy_general[]">
									Dog
								</label>
								<label class="checkbox-inline col-sm-2">
									<input type="checkbox" value="Insect" class="allergy_general" name="allergy_general[]">
									Insect
								</label>
								<label class="checkbox-inline col-sm-2">
									<input type="checkbox" value="Dust" class="allergy_general" name="allergy_general[]">
									Dust
								</label>
								<label class="checkbox-inline col-sm-2">
									<input type="checkbox" value="Mold" class="allergy_general" name="allergy_general[]">
									Mold
								</label>
								<label class="checkbox-inline col-sm-2">
									<input type="checkbox" value="Plant" class="allergy_general" name="allergy_general[]">
									Plant
								</label>
								<label class="checkbox-inline col-sm-2">
									<input type="checkbox" value="Pollen" class="allergy_general" name="allergy_general[]">
									Pollen
								</label>
								<label class="checkbox-inline col-sm-2">
									<input type="checkbox" value="Sun" class="allergy_general" name="allergy_general[]">
									Sun
								</label>
								<label class="checkbox-inline col-sm-2">
									<input type="checkbox" value="NA" class="allergy_general_na" name="allergy_general[]">
									N/A
								</label>
							@endif
							
						</div>	
					</div>
					
				
			
					
					<div class="form-group">
						<div class="col-sm-8">
							<h6>Drug</h6>
						</div>
						<div class="col-sm-4">
							@if(!empty($drugAllergyHistory))
								<label class="checkbox-inline col-sm-12">
									<input type="checkbox" value="NA" class="" id="noDrugAllergy" class="noDrugAllergy" disabled="disabled" checked="checked" />No known  drug allergy history to report
								</label>
							@else
								<label class="checkbox-inline col-sm-12">
									<input type="checkbox" value="NA" class="" id="noDrugAllergy" class="noDrugAllergy"  />No known  drug allergy history to report
								</label>
							@endif
						</div>
					</div>
					
					<div class="allergy" id="allergy">
						@if(!empty($drugAllergyHistory))
							@foreach($drugAllergyHistory as $drugAllergyHistoryVal)
							<div class="form-group">
							    <div class="col-sm-4">
									<span >
										{!! Form::text('medication-drug-allergy[]', $drugAllergyHistoryVal->drug_name, $attributes = array('class'=>'form-control medication-drug-allergy','placeholder' => 'Medication','disabled'=>'disabled'));  !!}
										
									</span>
								</div>
								 <!-- {!! Form::label('reaction-drug-allergy', 'Reaction', $attributes = array('class'=>'col-sm-2 '));  !!}-->
							    <div class="col-sm-4">
									<span >
										{!! Form::text('reaction-drug-allergy[]', $drugAllergyHistoryVal->reaction, $attributes = array('class'=>'form-control reaction-drug-allergy','placeholder' => 'Reaction','disabled'=>'disabled'));  !!}
										 
									</span>
								</div>
							</div>
							@endforeach
						@else
							<div class="form-group">
							    <div class="col-sm-4">
									<span class="input-icon">
										{!! Form::text('medication-drug-allergy[]', Input::old('medication-drug-allergy'), $attributes = array('class'=>'form-control medication-drug-allergy','placeholder' => 'Medication'));  !!}
										<i class="clip-user-3"></i> 
									</span>
								</div>
								 <!-- {!! Form::label('reaction-drug-allergy', 'Reaction', $attributes = array('class'=>'col-sm-2 '));  !!}-->
							    <div class="col-sm-4">
									<span class="input-icon">
										{!! Form::text('reaction-drug-allergy[]', Input::old('reaction-drug-allergy'), $attributes = array('class'=>'form-control reaction-drug-allergy','placeholder' => 'Reaction'));  !!}
										<i class="clip-user-3"></i> 
									</span>
								</div>
							</div>
						@endif
					</div>	
					<div class="form-group">
						<div class="col-sm-4">
							<button class="btn btn-default btn-add-allergies">Add More Allergies</button>
						</div>
					
					</div>
					<hr>
					<div class="form-group">
						<div class="col-sm-6">
							<h3>Social History</h3>
						</div>
					
					</div>

					@if(!empty($medicalHistory))
					<div class="form-group">
					    {!! Form::label('alcohol', '1.Alcohol', $attributes = array('class'=>'col-sm-2'));  !!}	
						<div class="col-sm-2">
							<label class="radio-inline">
								<input type="radio" value="Current" name="alcohol" class="" disabled="disabled" @if(($alcohol=="Current") && !empty($alcohol)) checked="checked" @endif>Current
							</label>
						</div>	
						<div class="col-sm-2">
							<label class="radio-inline">
								<input type="radio" value="Past" name="alcohol" class="" disabled="disabled" @if(($alcohol=="Past") && !empty($alcohol)) checked="checked" @endif>
								Past
							</label>
						</div>
						<div class="col-sm-2">
							<label class="radio-inline">
								<input type="radio" value="NA" name="alcohol" class="present-past-na" disabled="disabled" @if(($alcohol=="NA") && !empty($alcohol)) checked="checked" @endif>
								N/A
							</label>
						</div>
					</div>
					<div class="form-group">
					    {!! Form::label('tobacco', '2.Tobacco(Smoke)', $attributes = array('class'=>'col-sm-2'));  !!}	
						<div class="col-sm-2">
							<label class="radio-inline">
								<input type="radio" value="Current" name="tobaco-smoke" class="" disabled="disabled" @if(($tobacoSmoke=="Current") && !empty($tobacoSmoke)) checked="checked" @endif>
								Current
							</label>
						</div>	
						<div class="col-sm-2">
							<label class="radio-inline">
								<input type="radio" value="Past" name="tobaco-smoke" class="" disabled="disabled" @if(($tobacoSmoke=="Past") && !empty($tobacoSmoke)) checked="checked" @endif>
								Past
							</label>
						</div>
						<div class="col-sm-2">
							<label class="radio-inline">
								<input type="radio" value="NA" name="tobaco-smoke" class="present-past-na" disabled="disabled" @if(($tobacoSmoke=="NA") && !empty($tobacoSmoke)) checked="checked" @endif>
								N/A
							</label>
						</div>
					</div>
					<div class="form-group">
					    {!! Form::label('tobacco-chew', '3.Tobacco(Chewable)', $attributes = array('class'=>'col-sm-2'));  !!}	
						<div class="col-sm-2">
							<label class="radio-inline">
								<input type="radio" value="Current" name="tobaco-chew" class="" disabled="disabled" @if(($tobacoChew=="Current") && !empty($tobacoChew)) checked="checked" @endif>
								Current
							</label>
						</div>	
						<div class="col-sm-2">
							<label class="radio-inline">
								<input type="radio" value="Past" name="tobaco-chew" class="" disabled="disabled" @if(($tobacoChew=="Past") && !empty($tobacoChew)) checked="checked" @endif>
								Past
							</label>
						</div>
						<div class="col-sm-2">
							<label class="radio-inline">
								<input type="radio" value="NA" name="tobaco-chew" class="present-past-na" disabled="disabled" @if(($tobacoChew=="NA") && !empty($tobacoChew)) checked="checked" @endif>
								N/A
							</label>
						</div>
					</div>
					<div class="form-group">
					    {!! Form::label('other-social', '4.Other Substances', $attributes = array('class'=>'col-sm-2'));  !!}	
						<div class="col-sm-2">
							<label class="radio-inline">
								<input type="radio" value="Current" name="other-social-history" class="" disabled="disabled" @if(($otherSocial=="Current") && !empty($otherSocial)) checked="checked" @endif>
								Current
							</label>
						</div>	
						<div class="col-sm-2">
							<label class="radio-inline">
								<input type="radio" value="Past" name="other-social-history" class="" disabled="disabled" @if(($otherSocial=="Past") && !empty($otherSocial)) checked="checked" @endif>
								Past
							</label>
						</div>
						<div class="col-sm-2">
							<label class="radio-inline">
								<input type="radio" value="NA" name="other-social-history" class="present-past-na" disabled="disabled" @if(($otherSocial=="NA") && !empty($otherSocial)) checked="checked" @endif>
								N/A
							</label>
						</div>
					</div>
					@else
						<div class="form-group">
					    {!! Form::label('alcohol', '1.Alcohol', $attributes = array('class'=>'col-sm-2'));  !!}	
						<div class="col-sm-2">
							<label class="radio-inline">
								<input type="radio" value="Current" name="alcohol" class="">
								Current
							</label>
						</div>	
						<div class="col-sm-2">
							<label class="radio-inline">
								<input type="radio" value="Past" name="alcohol" class="">
								Past
							</label>
						</div>
						<div class="col-sm-2">
							<label class="radio-inline">
								<input type="radio" value="NA" name="alcohol" class="present-past-na">
								N/A
							</label>
						</div>
					</div>
					<div class="form-group">
					    {!! Form::label('tobacco', '2.Tobacco(Smoke)', $attributes = array('class'=>'col-sm-2'));  !!}	
						<div class="col-sm-2">
							<label class="radio-inline">
								<input type="radio" value="Current" name="tobaco-smoke" class="">
								Current
							</label>
						</div>	
						<div class="col-sm-2">
							<label class="radio-inline">
								<input type="radio" value="Past" name="tobaco-smoke" class="">
								Past
							</label>
						</div>
						<div class="col-sm-2">
							<label class="radio-inline">
								<input type="radio" value="NA" name="tobaco-smoke" class="present-past-na">
								N/A
							</label>
						</div>
					</div>
					<div class="form-group">
					    {!! Form::label('tobacco-chew', '3.Tobacco(Chewable)', $attributes = array('class'=>'col-sm-2'));  !!}	
						<div class="col-sm-2">
							<label class="radio-inline">
								<input type="radio" value="Current" name="tobaco-chew" class="">
								Current
							</label>
						</div>	
						<div class="col-sm-2">
							<label class="radio-inline">
								<input type="radio" value="Past" name="tobaco-chew" class="">
								Past
							</label>
						</div>
						<div class="col-sm-2">
							<label class="radio-inline">
								<input type="radio" value="NA" name="tobaco-chew" class="present-past-na">
								N/A
							</label>
						</div>
					</div>
					<div class="form-group">
					    {!! Form::label('other-social', '4.Other Substances', $attributes = array('class'=>'col-sm-2'));  !!}	
						<div class="col-sm-2">
							<label class="radio-inline">
								<input type="radio" value="Current" name="other-social-history" class="">
								Current
							</label>
						</div>	
						<div class="col-sm-2">
							<label class="radio-inline">
								<input type="radio" value="Past" name="other-social-history" class="">
								Past
							</label>
						</div>
						<div class="col-sm-2">
							<label class="radio-inline">
								<input type="radio" value="NA" name="other-social-history" class="present-past-na">
								N/A
							</label>
						</div>
					</div>
					@endif
					<hr>
					<div class="form-group">
						<div class="col-sm-6">
							<h3>Other History</h3>
						</div>

					</div>
					<div class="form-group">
						<div class="col-sm-12">
							@if(!empty($medicalHistory))
							<textarea name="other_medical_history" class="form-control" rows="10" cols="40" disabled="disabled" >{{$otherHistory}}</textarea>
								<!-- {!! Form::textarea('other_medical_history',(!empty($otherHistory))?$otherHistory:Input::old('other_medical_history'),['class'=>'form-control', 'rows' => 10, 'cols' => 40,'disabled' => 'disabled']) !!} -->
							@else
								{!! Form::textarea('other_medical_history',null,['class'=>'form-control', 'rows' => 10, 'cols' => 40]) !!}
								
								
							@endif
						</div>
					</div>

					<div class="form-group">
						<div class="col-sm-10"></div>
						<div class="col-sm-2">
							<button type="submit" class="btn btn-primary btn-block btn-medical-save">Save</button>
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
		
		{!!Html::script('assets/js/patient-personal-information.js')!!}
		
		{!!Html::script('assets/plugins/jquery-validation/dist/jquery.validate.min.js')!!}
		{!!Html::script('assets/js/patient-personal-information.js')!!}
		
		
	<script>
		$(document).ready(function() {
			Main.init();
			patientElements.init();

			var div 	= $('div').find('#presentPastDiv');
	   		var newDiv 	= div.find('.form-group');
	   		var medicalHistory = <?php echo json_encode($medicalHistory); ?>;
	   		console.log(medicalHistory);
			//var counter = newDiv.length;
	   		var counter = 0;
	   		$('#btn-addmore-illness').click(function(e){
	   			e.preventDefault();
	   			counter++;
	   			
					$('#presentPastDiv').append('<div class="form-group">'+
	   											'<input type="hidden" name="illness_counter" value="'+counter+'"> '+
	   											'<div class="col-sm-2">' +
	   												'<input type="text" name="illness'+counter+'[]" id="illness_name'+counter+'" class="form-control illness_name" />' +
	   											'</div>' +
	   											'<div class="col-sm-2">' +
	   												'<label class="radio-inline">' +
														'<input type="radio" value="Current" name="illness'+counter+'[]" class="present-past-current radioValidation" id="illness_status_current'+counter+'">'+
															'Current'+
														'</label>'+
												'</div>'+
												'<div class="col-sm-2">' +		
													'<label class="radio-inline col-sm-2">'+
														'<input type="radio" value="Past" name="illness'+counter+'[]" class="present-past-past radioValidation" id="illness_status_past'+counter+'">'+
															'Past'+
													'</label>'+
												'</div>'+
												'<div class="col-sm-2">' +		
													'<label class="radio-inline">'+
														'<input type="radio" value="NA" name="illness'+counter+'[]" class="present-past-na pp-dynamic-na radioValidation" id="illness_status_na'+counter+'">'+
															'N/A'+
													'</label>'+
	   											'</div>' +
	   											'<div class="col-sm-3">' +
	   												'<input type="text" name="illness'+counter+'[]" id="medication_present_past'+counter+'" class="form-control present-past-medication-empty",placeholder="Medication" />' +
	   											'</div>' +
	   											'<div class="col-sm-1" style="margin-left:-8px;padding-left:0px">' +
													'<button name="btn-ppmore-remove" class="btn btn-danger btn-ppmore-remove" id="btn-ppmore-remove">Remove</button' +
													'</div>' +	
	   										'</div>'	

	   				);

	   			/*	if($('#noPresentPast').is(':checked')){
                
		               $('.present-past-na').filter('[value="NA"]').prop('checked', true);
		               $('.illness_name').attr('disabled',true);
		               $('.present-past-current').attr('disabled',true);
		               $('.present-past-past').attr('disabled',true);
		               $('.present-past-medication-empty').attr('disabled',true);
		            }
		            else{
		                //alert('not checked');
		                $('.present-past-na').filter('[value="NA"]').prop('checked', false);
		                $('.illness_name').attr('disabled',false);
		                $('.present-past-current').attr('disabled',false);
		                $('.present-past-past').attr('disabled',false);
		                $('.present-past-medication-empty').attr('disabled',false);
		            }*/

		            //Removing present past more history
		            $('.btn-ppmore-remove').click(function(e){
		   				e.preventDefault();
		   				var clickedElements = $(this).closest('.form-group');
		   				console.log(clickedElements);
		   				clickedElements.remove();	
	   				});

		            
	   			

		      

	   		});

	   		$('.btn-add-surgery').click(function(e){
	   			e.preventDefault();
	   			//alert('vyshakh');
	   			$('#surgery').append('<div class="form-group">' + 
	   									'<input type="hidden" name="surgery_counter" value="'+counter+'"> '+
	   									'<label for="surgery" class="col-sm-2 ">Surgery</label>' +
	   									'<div class="col-sm-8">' +
											'<span class="input-icon">' +
												'<input type="text" name="surgery[]" class="form-control surgicalhistory" placeholder="Surgery">' +
												'<i class="clip-user-3"></i> ' +
											'</span>' +
										'</div>'+
										'<div class="col-sm-2">' +
											'<button name="btn-surgery-remove" class="btn btn-danger btn-surgery-remove" id="btn-surgery-remove">Remove</button' +
										'</div>' +	
	   								 '</div>'

	   				);


	   			$('.btn-surgery-remove').click(function(e){
	   				e.preventDefault();
	   				var clickedElements = $(this).closest('.form-group');
	   				console.log(clickedElements);
	   				clickedElements.remove();	
	   			})

	   		});

	   		$('.btn-add-allergies').click(function(e){
	   			e.preventDefault();
	   			counter ++;
	   			$('#allergy').append('<div class="form-group">' +
	   									'<input type="hidden" name="allergy_counter" value="'+counter+'"> '+
	   									'<div class="col-sm-4">'+
												'<span class="input-icon">' +
													'<input type="text" name="medication-drug-allergy[]" class="form-control medication-drug-allergy",placeholder = "Medication" />' +
												'</span>' +
											'</div>'	+
											' <div class="col-sm-4">'+
													'<span class="input-icon">' +
														'<input type="text" name="reaction-drug-allergy[]" class="form-control reaction-drug-allergy",placeholder = "Reaction" />' +
													'</span>' +
											'</div>'	+
											' <div class="col-sm-4">'+
												'<button class="btn btn-danger btn-allergy-remove">Remove</button>'+
											'</div>' +
	   								'</div>'

	   						);


	   			$('.btn-allergy-remove').click(function(e){
	   				e.preventDefault();
	   				var clickedElements = $(this).closest('.form-group');
	   				console.log(clickedElements);
	   				clickedElements.remove();	
	   			})
	   			

	   		});

	   		$('.allergy_general_na').click(function(){
	   			if($('.allergy_general_na').is(':checked')){
	   				$('.allergy_general').attr('disabled',true);
	   				$('.allergy_general').attr('checked',false);
				}
				else{
					$('.allergy_general').attr('disabled',false);
					$('.allergy_general').attr('checked',true);
				}

	   		});
	   		


	 		
	
	 	});
	</script>
@stop	