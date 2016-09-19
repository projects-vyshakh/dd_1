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


?>
@section('head')
	 {!!Html::style('assets/plugins/bootstrap-multiselect/css/bootstrap-multiselect.css')!!}
	 {!!Html::style('assets/plugins/select2/select2.css')!!}
@stop
@extends('layouts.master', ['patientName' =>$patientName])
@section('main')


	<div class="page-header">
		<h1>Prescription Management <small></small></h1>
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
		
	</div>
	
	<div class="panel-body">
		{!! Form::open(array('route' => 'addPatientPrescManagement', 'role'=>'form', 'id'=>'addPatientPrescManagement', 'class'=>'form-horizontal','novalidate'=>'novalidate')) !!}	
			<div class="form-group">
	            <div class="col-sm-12">
					<h3>Line of Treatment</h3>
				</div>
				<div class="col-sm-12">
					<div class="form-group">
						<!-- <div class="col-sm-2">
							{!! Form::label('line_of_treatment', '1. Line of Treatment', $attributes = array('class'=>""));  !!}
						</div>
 -->

						@if(!empty($prescGynData))
							<div class="col-sm-2">
								<label class="radio-inline">
									<input type="radio" value="Conservation" name="presc_line_of_treatment" class="presc_line_of_treatment_conservation"  
									@if($prescGynData->line_of_treatment=="Conservation") checked="checked" @endif
									>
									Conservation
								</label>
							</div>
							<div class="col-sm-2">
								<label class="radio-inline">
									<input type="radio" value="Surgical" name="presc_line_of_treatment" class="presc_line_of_treatment_surgical"
									@if($prescGynData->line_of_treatment=="Surgical") checked="checked" @endif
									 >
									Surgical
								</label>
							
							</div>
							<div class="col-sm-10"></div>
							<div class="col-sm-8">
								<span>
									{!! Form::text('presc_line_of_treatment_other',$prescGynData->line_of_treatment_detail,['class'=>'form-control','placeholder'=>'Other']) !!}
								</span>
							</div>
						@else
							<div class="col-sm-2">
								<label class="radio-inline">
									<input type="radio" value="Conservation" name="presc_line_of_treatment" class="presc_line_of_treatment_conservation" >
									Conservation
								</label>
							
							</div>
							<div class="col-sm-2">
								<label class="radio-inline">
									<input type="radio" value="Surgical" name="presc_line_of_treatment" class="presc_line_of_treatment_surgical" >
									Surgical
								</label>
							
							</div>
							<div class="col-sm-10"></div>
								<div class="col-sm-8">
									<span>
										{!! Form::text('presc_line_of_treatment_other',null,['class'=>'form-control','placeholder'=>'Other']) !!}
									</span>
							</div>
						@endif
					</div>
					<hr>

					<div class=""><h3>General</h3></div>
					@if(!empty($prescGynData))
						<div class="form-group">
							<div class="dd_col">
								{!! Form::label('exercise_general', 'Exercise', $attributes = array('class'=>"col-sm-2"));  !!}
								<div class="col-sm-2">
									<label class="radio-inline">
										<input type="radio" value="Physical" name="presc_general_exercise" class="presc_general_exercise" 
										@if($prescGynData->presc_general_exercise=="Physical")checked="checked" @endif)
										>
										Physical
									</label>
								
								</div>
								<div class="col-sm-2">
									<label class="radio-inline">
										<input type="radio" value="Pelvic" name="presc_general_exercise" class="presc_general_exercise" 
										@if($prescGynData->presc_general_exercise=="Pelvic") checked="checked" @endif
										>
										Pelvic
									</label>
								</div>
								<div class="col-sm-6"></div>
								<div class="col-sm-8">
									<span>
										{!! Form::text('presc_exercise_other',$prescGynData->presc_general_exercise_detail,['class'=>'form-control','placeholder'=>'Other']) !!}
									</span>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="dd_col">
								{!! Form::label('diet_general', 'Diet', $attributes = array('class'=>"col-sm-2"));  !!}
									<!-- <div class="col-sm-"> -->
								<div class=" col-sm-2">	
									<label class="checkbox-inline">
										<input type="checkbox" value="Salt" class="presc_diet_salt" name="presc_diet[]" 
										@if(!empty($prescGynData->presc_general_diet))
										@if(in_array("Salt",json_decode($prescGynData->presc_general_diet))) checked="checked" @endif
										@endif
										>
										Salt
									</label>
								</div>
								<div class=" col-sm-2">		
									<label class="checkbox-inline">
										<input type="checkbox" value="Sugar" class="presc_diet_sugar" name="presc_diet[]"
										@if(!empty($prescGynData->presc_general_diet))
										@if(in_array("Sugar",json_decode($prescGynData->presc_general_diet))) checked="checked" @endif
										@endif
										>
										Sugar
									</label>
								</div>
								<div class=" col-sm-2">		
									<label class="checkbox-inline">
										<input type="checkbox" value="High Protein" class="presc_protein" name="presc_diet[]"
										@if(!empty($prescGynData->presc_general_diet))
										@if(in_array("High Protein",json_decode($prescGynData->presc_general_diet))) checked="checked" @endif
										@endif
										>
										High Protein
									</label>
								</div>	
								<div class="col-sm-4"></div>
								<div class="col-sm-8">
									<span>
										{!! Form::text('presc_diet_other',$prescGynData->presc_general_diet_detail,['class'=>'form-control','placeholder'=>'Other']) !!}
									</span>
								</div>
							</div>
						</div>	
					@else
						<div class="form-group">
							<div class="dd_col">
								{!! Form::label('exercise_general', 'Exercise', $attributes = array('class'=>"col-sm-2"));  !!}
								<div class="col-sm-2">
									<label class="radio-inline">
										<input type="radio" value="Physical" name="presc_general_exercise" class="presc_general_exercise" >
										Physical
									</label>
								
								</div>
								<div class="col-sm-2">
									<label class="radio-inline">
										<input type="radio" value="Pelvic" name="presc_general_exercise" class="presc_general_exercise" >
										Pelvic
									</label>
								
								</div>
								<div class="col-sm-6"></div>
								<div class="col-sm-8">
									<span>
										{!! Form::text('presc_exercise_other',null,['class'=>'form-control','placeholder'=>'']) !!}
									</span>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-12">
								{!! Form::label('diet_general', 'Diet', $attributes = array('class'=>"col-sm-2"));  !!}
									<!-- <div class="col-sm-"> -->
								<div class=" col-sm-2">	
									<label class="checkbox-inline">
										<input type="checkbox" value="Salt" class="presc_diet_salt" name="presc_diet[]" >
										Salt
									</label>
								</div>
								<div class=" col-sm-2">		
									<label class="checkbox-inline">
										<input type="checkbox" value="Sugar" class="presc_diet_sugar" name="presc_diet[]">
										Sugar
									</label>
								</div>
								<div class=" col-sm-2">		
									<label class="checkbox-inline">
										<input type="checkbox" value="High Protein" class="presc_protein" name="presc_diet[]">
										High Protein
									</label>
								</div>	
								<div class="col-sm-4">
									
								</div>
								<div class="col-sm-8">
									<span>
										{!! Form::text('presc_diet_other',null,['class'=>'form-control','placeholder'=>'']) !!}
									</span>
								</div>
							</div>
						</div>
					@endif	
					
					<hr class="dd_exercise_hr">
					
					
					<div class="col-sm-12"><h3>Exercise</h3></div>
					@if(!empty($prescGynData))
						<div class="col-sm-12">
							<div class="form-group">
								<div class="col-sm-12">
									{!! Form::textarea('exercise',$prescGynData->presc_exercise,['class'=>'form-control', 'rows' => 4, 'cols' => 40]) !!}
								</div>
							</div>
						</div>
					@else
						<div class="col-sm-12">
							<div class="form-group">
								<div class="col-sm-12">
									{!! Form::textarea('exercise',null,['class'=>'form-control', 'rows' => 4, 'cols' => 40]) !!}
								</div>
							</div>
						</div>
					@endif
					
					<hr>

					<div class="form-group dd_fromgroup_MG_0 ">
						<div class="col-sm-12">
							<button type="submit" class="btn btn-primary btn-block dd_btn_center"><i class="fa fa-floppy-o" aria-hidden="true"></i>
							Save</button>
						</div>
					</div>
				</div>
			</div>

		{!! Form::close() !!}
	</div>
	
@stop
	

	   
@section('scripts')
	@parent
		
	 	<!-- {!!Html::script('assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js')!!}
	 	{!!Html::script('assets/plugins/bootstrap-colorpicker/js/commits.js')!!} -->
	 		
	<script>

		jQuery(document).ready(function() {
				//patientElements.init();
			   
			   
	 	});
	</script>
@stop	