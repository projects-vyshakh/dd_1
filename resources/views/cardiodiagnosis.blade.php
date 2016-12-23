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
	 {!!Html::style('assets/plugins/bootstrap-multiselect/css/bootstrap-multiselect.css')!!}
	 {!!Html::style('assets/plugins/select2/select2.css')!!} 

	 {!!Html::style('assets/plugins/tokenizemultiselect/jquery.tokenize.css')!!}
	 <!-- {!!Html::style('assets/plugins/autocomplete/easy-autocomplete.themes.min.css')!!} -->

 {!!Html::style('assets/plugins/magicsuggest/magicsuggest-min.css')!!}


@stop
@extends('layouts.master', ['specialization'=>$doctorSpecialization,'patientName'=>$patientName])
@section('main')
<div class="loader"></div>

	<div class="page-header">
		<h1>Diagnosis Examination <small></small></h1>
	</div>
	
	<div class="form-group">
		<div class="col-sm-12">
			<?php 
					$error = Session::get('error');
	                $success = Session::get('success');
	                Session::forget('error');
	                Session::forget('success');
					
					// $newSymptomsArray = Session::get('newSymptoms');
					// var_dump($newSymptomsArray);
// 					
					// $symptoms = array_unique( array_merge( $newSymptomsArray , $symptoms ) );

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
		
	</div>
	
	<div class="panel-body"> 
		{!! Form::open(array('route' => 'addCardioDiagnosis', 'role'=>'form', 'id'=>'addCardioDiagnosis', 'class'=>'form-horizontal','novalidate'=>'novalidate')) !!}	
		<div class="for-group">
			<div class="col-sm-12 dd_dignosis_dummy">
					@if(!empty($diag))
							<div class="form-group">
										{!! Form::label('symptoms', 'Symptom / Chief Complaints', $attributes = array('class'=>"col-sm-2"));  !!}
										<div class="col-sm-10">
												<?php	$diagSymptoms = json_decode($diag->diag_symptoms); ?>
												<span>
														{!! Form::select('symptoms[]', $symptoms, $diagSymptoms, $attributes = array('class' => 'tokenize-sample','id'=>'symptoms','multiple' => 'multiple','name'=>'symptoms[]')); !!}
												</span>
										</div>
							</div>
							<div class="form-group">
									{!! Form::label('syndromes', 'Syndromes', $attributes = array('class'=>"col-sm-2"));  !!}
									<div class="col-sm-10">
											<span>
													{!! Form::textarea('syndromes',$diag->diag_syndromes,['class'=>'form-control', 'rows' => 4, 'cols' => 40]) !!}
											</span>
									</div>
							</div>
							<div class="form-group">
									{!! Form::label('suspected_disease', 'Suspected Disease', $attributes = array('class'=>"col-sm-2"));  !!}
									<?php $diagDiseases = json_decode($diag->diag_suspected_diseases); ?>
									<div class="col-sm-10">
											<span>
													{!! Form::select('diseases[]', $diseases, $diagDiseases , $attributes = array('class' => 'tokenize-sample','id'=>'diseases','multiple' => 'multiple','name'=>'diseases[]')); !!}
											</span>
									</div>
							</div>
							<div class="form-group">
									{!! Form::label('additional_comment', 'Additional Comment', $attributes = array('class'=>"col-sm-2"));  !!}
									<div class="col-sm-10">
											{!! Form::textarea('additional_comment',$diag->diag_comment,['class'=>'form-control', 'rows' => 4, 'cols' => 40]) !!}
									</div>
							</div>
				@else
						<div class="form-group">
								{!! Form::label('symptoms', 'Symptom / Chief Complaints', $attributes = array('class'=>"col-sm-2"));  !!}
								<div class="col-sm-10">
									<span>
											{!! Form::select('symptoms[]', $symptoms, Input::old('symptoms'), $attributes = array('class' => 'tokenize-sample','id'=>'symptoms','multiple' => 'multiple','name'=>'symptoms[]')); !!}
									</span>
								</div>
						</div>
						<div class="form-group">
								{!! Form::label('syndromes', 'Syndromes', $attributes = array('class'=>"col-sm-2"));  !!}
								<div class="col-sm-10">
									<span>
											{!! Form::textarea('syndromes',Input::old('syndromes'),['class'=>'form-control', 'rows' => 4, 'cols' => 40]) !!}
									</span>
								</div>
						</div>
						<div class="form-group">
								{!! Form::label('suspected_disease', 'Suspected Disease', $attributes = array('class'=>"col-sm-2"));  !!}
								<div class="col-sm-10">
										<span>
												{!! Form::select('diseases[]', $diseases, Input::old('diseases'), $attributes = array('class' => 'tokenize-sample','id'=>'diseases','multiple' => 'multiple','name'=>'diseases[]')); !!}
										</span>
								</div>
						</div>
						<div class="form-group">
								{!! Form::label('additional_comment', 'Additional Comment', $attributes = array('class'=>"col-sm-2"));  !!}
								<div class="col-sm-10">
									{!! Form::textarea('additional_comment',Input::old('additional_comment'),['class'=>'form-control', 'rows' => 4, 'cols' => 40]) !!}
								</div>
						</div>
				@endif
					
					<hr>
					<div class="form-group ">
							<div class="col-sm-12">
										<button type="submit" class="btn btn-primary btn-block dd_btn_center"><!-- <i class="fa fa-floppy-o" aria-hidden="true"></i> -->Save</button>
							</div>
					</div>
			</div>
		</div>
		<hr>
	{!! Form::close() !!}
	</div> <!-- Panel body ends -->
@stop
	

	   
@section('scripts')
	@parent
		{!!Html::script('assets/plugins/bootstrap-multiselect/js/bootstrap-multiselect.js')!!}
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


		{!!Html::script('assets/js/form-elements.js')!!}

		<!-- {!!Html::script('assets/plugins/autocomplete/jquery.easy-autocomplete.min.js')!!} -->

		{!!Html::script('assets/plugins/tokenizemultiselect/jquery.tokenize.js')!!}

		{!!Html::script('assets/plugins/magicsuggest/magicsuggest-min.js')!!}
	 	<!-- {!!Html::script('assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js')!!}
	 	{!!Html::script('assets/plugins/bootstrap-colorpicker/js/commits.js')!!} -->
	 		
	<script>

		jQuery(document).ready(function() {
				patientElements.init();
			   
			$(window).load(function() {
				$(".loader").fadeOut("slow");
				
			});

			$('#symptoms').magicSuggest({
        			allowFreeEntries: true,
        			maxSelection: 100,
        			
    		});
    		$('#diseases').magicSuggest({
        			allowFreeEntries: true,
        			maxSelection: 100
    		});
			/*var options = {
				data: ["blue", "green", "pink", "red", "yellow"]
			};*/

			var options = <?php echo json_encode($symptoms); ?>;
			console.log(options);



			



   
	 	});
	</script>
@stop	