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
@stop
@extends('layouts.master', ['specialization'=>$doctorSpecialization,'patientName'=>$patientName])
@section('main')
<?php 
	
	
	
	if (!empty($pediatricExamData))
	{
		$upper_left	 = json_decode($pediatricExamData->dental_upper_left);
		$upper_right = json_decode($pediatricExamData->dental_upper_right);
		$lower_left = json_decode($pediatricExamData->dental_lower_left);
		$lower_right = json_decode($pediatricExamData->dental_lower_right);
	}
		?>
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
		{!! Form::open(array('route' => 'addPediaExamination', 'role'=>'form', 'id'=>'addPediaExamination', 'class'=>'form-horizontal','novalidate'=>'novalidate')) !!}
	
			<div class="col-sm-12 dd_mg_top_10">
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
					 {!! Form::label('heartrate', 'Heart Rate', $attributes = array('class'=>"col-sm-2"));  !!} 
					<div class="col-sm-2">
						<span>
						{!! Form::text('heartrate', $vitalExist->heart_rate, $attributes = array('class'=>'form-control','data-validetta'=>"required,minLength[2],maxLength[3]"));  !!}</span>
					</div>
				</div>
				<div class="form-group">
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
					{!! Form::label('pallor', 'Pallor', $attributes = array('class'=>"col-sm-2"));  !!} 
					<div class="col-sm-2">
						<span>
						{!! Form::text('pallor',  $vitalExist->pallor, $attributes = array('class'=>'form-control'));  !!}
						</span>
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('clubbing', 'Clubbing', $attributes = array('class'=>"col-sm-2"));  !!} 
					<div class="col-sm-2">
						<span>
						{!! Form::text('clubbing',  $vitalExist->clubbing, $attributes = array('class'=>'form-control'));  !!}
						</span>
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('vaccination_history', 'Vaccination History', $attributes = array('class'=>"col-sm-2"));  !!} 
					<div class="col-sm-10">
						<span>
						{!! Form::textarea('vaccination_history',  $vitalExist->vaccination_history, $attributes = array('class'=>'form-control', 'rows' => 2, 'cols' => 30));  !!}
						</span>
					</div>
					</div>
					<div class="form-group">
					{!! Form::label('significant_history', 'Significant History', $attributes = array('class'=>"col-sm-2"));  !!} 
					<div class="col-sm-10">
					<span>
					{!! Form::textarea('significant_history',  $vitalExist->significant_history, $attributes = array('class'=>'form-control', 'rows' => 3, 'cols' => 30));  !!}
					</span>
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
					 {!! Form::label('heartrate', 'Heart Rate', $attributes = array('class'=>"col-sm-2"));  !!} 
					<div class="col-sm-2">
						<span>
						{!! Form::text('heartrate',  Input::old('heartrate'), $attributes = array('class'=>'form-control'));  !!}
						</span>
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('respiratory_rate', 'Respiratory Rate (breathes/min)', $attributes = array('class'=>"col-sm-2"));  !!}
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
					{!! Form::label('pallor', 'Pallor', $attributes = array('class'=>"col-sm-2"));  !!} 
					<div class="col-sm-2">
						<span>
						{!! Form::text('pallor',  Input::old('pallor'), $attributes = array('class'=>'form-control'));  !!}
						</span>
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('clubbing', 'Clubbing', $attributes = array('class'=>"col-sm-2"));  !!} 
					<div class="col-sm-2">
						<span>
						{!! Form::text('clubbing',  Input::old('clubbing'), $attributes = array('class'=>'form-control'));  !!}
						</span>
					</div>
					</div>
				<div class="form-group">
					{!! Form::label('vaccination_history', 'Vaccination History', $attributes = array('class'=>"col-sm-2"));  !!}
					<div class="col-sm-10">
						<span>
						{!! Form::textarea('vaccination_history','', $attributes = array('class'=>'form-control', 'rows' => 3, 'cols' => 30));  !!}
						</span>
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('significant_history', 'Significant History', $attributes = array('class'=>"col-sm-2"));  !!}
					<div class="col-sm-10">
						<span>
						{!! Form::textarea('significant_history','', $attributes = array('class'=>'form-control', 'rows' => 3, 'cols' => 30));  !!}
						</span>
					</div>
				</div>
			@endif

			<hr>
			@if(!empty($pediatricExamData))
				<div class="form-group">
					<div class="col-sm-8">
			<h3 class="dd_h3_Pd_t_0">SKIN CHECKUP</h3>
		</div>
				</div>
				<div class="form-group">
						{!! Form::label('lice', 'Lice', $attributes = array('class'=>"col-sm-3"));  !!}
						<div class="col-sm-4">
							<span>
							<div class="col-sm-4">
								<label class="radio-inline">
									<input type="radio" value="Yes" name="skin_lice" @if($pediatricExamData->skin_lice=="Yes") checked="checked" @endif />Yes
								</label>
							</div>
								<div class="col-sm-8">
									<label class="radio-inline">
										<input type="radio" value="No" name="skin_lice" @if($pediatricExamData->skin_lice=="No")checked="checked" @endif />No
									</label>
								</div>
							</span>
						</div>
				</div>
				<div class="form-group">
						{!! Form::label('scabies', 'Scabies', $attributes = array('class'=>"col-sm-3"));  !!}
						<div class="col-sm-4">
							<span>
							<div class="col-sm-4">
								<label class="radio-inline">
									<input type="radio" value="Yes" name="skin_scabies" @if($pediatricExamData->skin_scabies=="Yes")checked="checked" @endif />Yes
								</label>
							</div>
								<div class="col-sm-8">
									<label class="radio-inline">
										<input type="radio" value="No" name="skin_scabies" @if($pediatricExamData->skin_scabies=="No") checked="checked" @endif />No
									</label>
								</div>
							</span>
						</div>
				</div>
				<div class="form-group">
						{!! Form::label('spotsandmolluscum', 'Spots & Molluscum', $attributes = array('class'=>"col-sm-3"));  !!}
						<div class="col-sm-4">
							<span>
							<div class="col-sm-4">
								<label class="radio-inline">
									<input type="radio" value="Yes" name="skin_spots" @if($pediatricExamData->skin_spots_and_molluscum=="Yes") checked="checked" @endif />Yes
								</label>
							</div>
								<div class="col-sm-8">
									<label class="radio-inline">
										<input type="radio" value="No" name="skin_spots" @if($pediatricExamData->skin_spots_and_molluscum=="No") checked="checked" @endif />No
									</label>
								</div>
							</span>
						</div>
				</div>
				<div class="form-group">	
						{!! Form::label('eczema', 'Eczema', $attributes = array('class'=>"col-sm-3"));  !!}
						<div class="col-sm-4">
							<span>
							<div class="col-sm-4">
								<label class="radio-inline">
									<input type="radio" value="Yes" name="skin_eczema" @if($pediatricExamData->skin_eczema=="Yes") checked="checked" @endif />Yes
								</label>
							</div>
								<div class="col-sm-8">
									<label class="radio-inline">
										<input type="radio" value="No" name="skin_eczema" @if($pediatricExamData->skin_eczema=="No") checked="checked" @endif />No
									</label>
								</div>
							</span>
						</div>
				</div>
				<div class="form-group">
						{!! Form::label('skin_allergy', 'Skin Allergy', $attributes = array('class'=>"col-sm-3"));  !!}
						<div class="col-sm-4">
							<span>
							<div class="col-sm-4">
								<label class="radio-inline">
									<input type="radio" value="Yes" name="skin_allergy" @if($pediatricExamData->skin_allergy=="Yes") checked="checked" @endif />Yes
								</label>
							</div>
								<div class="col-sm-8">
									<label class="radio-inline">
										<input type="radio" value="No" name="skin_allergy" @if($pediatricExamData->skin_allergy=="No") checked="checked" @endif />No
									</label>
								</div>
							</span>
						</div>
				</div>
				<div class="form-group">
						{!! Form::label('remarks', 'Remarks', $attributes = array('class'=>"col-sm-3"));  !!}
						<div class="col-sm-9">
							<span>
							{!! Form::textarea('skin_remarks',$pediatricExamData->skin_remarks,['class'=>'form-control', 'rows' => 4, 'cols' => 40,'placeholder'=>"Comments"]) !!}
						</span>
						</div>
				</div>
			<hr>
				<div class="form-group">
					<div class="col-sm-8">
						<h3 class="dd_h3_Pd_t_0">ENT CHECKUP</h3>
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('ent_remarks', 'Remarks', $attributes = array('class'=>"col-sm-3"));  !!}
						<div class="col-sm-9">
							<span>
						{!! Form::textarea('ent_remarks',$pediatricExamData->ent_remarks,['class'=>'form-control', 'rows' => 4, 'cols' => 40,'placeholder'=>"Comments"]) !!}
						</span>
						</div>
				</div>
				<hr>
				<div class="form-group">
					
					<div class="col-sm-8">
			<h3 class="dd_h3_Pd_t_0">EYE CHECKUP</h3>
		</div>
						
					
				</div>
					<div class="form-group">
						{!! Form::label('eye_remarks', 'Remarks', $attributes = array('class'=>"col-sm-3"));  !!}
						<div class="col-sm-9">
							<span>
						{!! Form::textarea('eye_remarks',$pediatricExamData->eye_remarks,['class'=>'form-control', 'rows' => 4, 'cols' => 40,'placeholder'=>"Comments"]) !!}
						</span>
						</div>
				</div>
				<hr>
				<div class="form-group">
					
					<div class="col-sm-8">
			<h3 class="dd_h3_Pd_t_0">DENTAL CHECKUP</h3>
		</div>
						
					
				</div>
				<div class="form-group">
						{!! Form::label('extraoral', 'Extra Oral', $attributes = array('class'=>"col-sm-3"));  !!}
						<div class="col-sm-4">
							<span>
								<div class="col-sm-4">
									<label class="radio-inline">
										<input type="radio" value="Yes" name="dental_extraoral" @if($pediatricExamData->dental_extra_oral=="Yes") checked="checked" @endif />Yes
									</label>
								</div>
								<div class="col-sm-8">
									<input type="radio" value="No" name="dental_extraoral" @if($pediatricExamData->dental_extra_oral=="No") checked="checked" @endif />No
								</div>
							</span>	
						</div>
				</div>
				<div class="form-group">
				{!! Form::label('intraoral', 'Intra Oral', $attributes = array('class'=>"col-sm-3"));  !!}
						<div class="col-sm-4">
							<span>
								<div class="col-sm-4">
									<input type="radio" value="Yes" name="dental_intraoral" @if($pediatricExamData->dental_intra_oral=="Yes") checked="checked" @endif />Yes
								</div>
								<div class="col-sm-8">
									<input type="radio" value="No" name="dental_intraoral" @if($pediatricExamData->dental_intra_oral=="No") checked="checked" @endif />No
								</div>
							</span>	
						</div>
				</div>
				<div class="form-group">
						{!! Form::label('toothcavity', 'Tooth Cavity', $attributes = array('class'=>"col-sm-3"));  !!}
						<div class="col-sm-4">
							<span>
								<div class="col-sm-4">
								<input type="radio" value="Yes" name="dental_toothcavity" @if($pediatricExamData->dental_tooth_cavity=="Yes") checked="checked" @endif />Yes
									</div>
								<div class="col-sm-8">
								<input type="radio" value="No" name="dental_toothcavity" @if($pediatricExamData->dental_tooth_cavity=="No") checked="checked" @endif />No
									</div>

							</span>	
						</div>
				</div>
				<div class="form-group">	
						{!! Form::label('gum_inflammattion', 'Gum Imflammattion', $attributes = array('class'=>"col-sm-3"));  !!}
						<div class="col-sm-4">
							<span>
								<div class="col-sm-4">
								<input type="radio" value="Yes" name="dental_gum_inflammattion" @if($pediatricExamData->dental_gum_inflammattion=="Yes") checked="checked" @endif />Yes
								</div>
								<div class="col-sm-8">
								<input type="radio" value="No" name="dental_gum_inflammattion" @if($pediatricExamData->dental_gum_inflammattion=="No") checked="checked" @endif />No
								</div>
							</span>	
						</div>
				</div>
				<div class="form-group">
						{!! Form::label('calculus', 'Calculus', $attributes = array('class'=>"col-sm-3"));  !!}
						<div class="col-sm-4">
							<span>
								<div class="col-sm-4">
								<input type="radio" value="Yes" name="dental_calculus" @if($pediatricExamData->dental_calculus=="Yes") checked="checked" @endif />Yes
									</div>
								<div class="col-sm-8">
								<input type="radio" value="No" name="dental_calculus" @if($pediatricExamData->dental_calculus=="No") checked="checked" @endif />No
									</div>
							</span>	
						</div>
				</div>
				<div class="form-group">
						{!! Form::label('stains', 'Stains', $attributes = array('class'=>"col-sm-3"));  !!}
						<div class="col-sm-4">
							<span>
								<div class="col-sm-4">
								<input type="radio" value="Yes" name="dental_stains" @if($pediatricExamData->dental_stains=="Yes") checked="checked" @endif />Yes
									</div>
								<div class="col-sm-8">
								<input type="radio" value="No" name="dental_stains" @if($pediatricExamData->dental_stains=="No") checked="checked" @endif />No
								</div>
							</span>	
						</div>
				</div>
				<div class="form-group">
						{!! Form::label('tartar', 'Tartar', $attributes = array('class'=>"col-sm-3"));  !!}
						<div class="col-sm-4">
							<span>
								<div class="col-sm-4">
								<input type="radio" value="Yes" name="dental_tartar" @if($pediatricExamData->dental_tartar=="Yes") checked="checked" @endif />Yes
									</div>
								<div class="col-sm-8">
								<input type="radio" value="No" name="dental_tartar" @if($pediatricExamData->dental_tartar=="No") checked="checked" @endif />No
									</div>
							</span>	
						</div>
				</div>
				<div class="form-group">
						{!! Form::label('bad_breath', 'Bad Breath', $attributes = array('class'=>"col-sm-3"));  !!}
						<div class="col-sm-4">
							<span>
								<div class="col-sm-4">
								<input type="radio" value="Yes" name="dental_bad_breath" @if($pediatricExamData->dental_bad_breath=="Yes") checked="checked" @endif />Yes
									</div>
								<div class="col-sm-8">
								<input type="radio" value="No" name="dental_bad_breath" @if($pediatricExamData->dental_bad_breath=="No") checked="checked" @endif />No
								</div>
							</span>	
						</div>
				</div>
				<div class="form-group">
						{!! Form::label('gum_bleeding', 'Gum Bleeding', $attributes = array('class'=>"col-sm-3"));  !!}
						<div class="col-sm-4">
							<span>
								<div class="col-sm-4">
								<input type="radio" value="Yes" name="dental_gum_bleeding" @if($pediatricExamData->dental_gum_bleeding=="Yes") checked="checked" @endif />Yes
									</div>
								<div class="col-sm-8">
									<input type="radio" value="No" name="dental_gum_bleeding" @if($pediatricExamData->dental_gum_bleeding=="No") checked="checked" @endif />No
									</div>
							</span>	
						</div>
				</div>
				<div class="form-group">
						{!! Form::label('plaque', 'Plaque', $attributes = array('class'=>"col-sm-3"));  !!}
						<div class="col-sm-4">
							<span>
								<div class="col-sm-4">
								<input type="radio" value="Yes" class="plaqueyes" id="plaqueyes" name="dental_plaque" @if($pediatricExamData->dental_plaque=="Yes") checked="checked" @endif /> Yes
							
									</div>
								<div class="col-sm-8">
								<input type="radio" value="No" class="plaqueno" id="plaqueno" name="dental_plaque" @if($pediatricExamData->dental_plaque=="No") checked="checked" @endif /> No
								</div>
							</span>	
						</div>
				</div>
					<!-- plaque -->
					<div class="panel-hide">
					<div class="form-group">
									{!! Form::label('', '', $attributes = array('class'=>"col-sm-2"));  !!}
								<div class="col-sm-6">
								<div class="col-sm-6 dd_Plaque_pd_0">
								<div class="panel panel-default panel_me">
							        <div class="panel-body">
							        @if(!empty($upper_left))
									<div class="row">
										<div class="col-sm-12">
											<div class="form-group">
												<div class="col-sm-2">E</div>
												<div class="col-sm-2">D</div>
												<div class="col-sm-2">C</div>
												<div class="col-sm-2">B</div>
												<div class="col-sm-2">A</div>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-sm-12">
											<div class="form-group">

												<div class="col-sm-2">
											<input type="checkbox" value="upperleft1"  class="teeths" id="teeths" name="upperleft[]"  
											@if(in_array("upperleft1",$upper_left)) checked="checked" @endif></div>
												<div class="col-sm-2">
											<input type="checkbox" value="upperleft2"  class="teeths" id="teeths" name="upperleft[]"  
											@if(in_array("upperleft2",$upper_left)) checked="checked" @endif ></div>
												<div class="col-sm-2">
											<input type="checkbox" value="upperleft3"  class="teeths" id="teeths" name="upperleft[]"  
											@if(in_array("upperleft3",$upper_left)) checked="checked" @endif>
											</div>
												<div class="col-sm-2">
											<input type="checkbox" value="upperleft4"  class="teeths" id="teeths" name="upperleft[]"  
											@if(in_array("upperleft4",$upper_left)) checked="checked" @endif>
											</div>
												<div class="col-sm-2">
											<input type="checkbox" value="upperleft5"  class="teeths" id="teeths" name="upperleft[]"  
											@if(in_array("upperleft5",$upper_left)) checked="checked" @endif>
											</div>
											</div>
										</div>
									</div>

										
										@else
									<div class="row">
										<div class="col-sm-12">
											<div class="form-group">
												<div class="col-sm-2">E</div>
												<div class="col-sm-2">D</div>
												<div class="col-sm-2">C</div>
												<div class="col-sm-2">B</div>
												<div class="col-sm-2">A</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-12">
											<div class="form-group">
												<div class="col-sm-2"><input type="checkbox" value="upperleft1" id="teeths" class="teeths col-sm-2" name="upperleft[]"></div>
												<div class="col-sm-2"><input type="checkbox" value="upperleft2" id="teeths" class="teeths col-sm-2" name="upperleft[]"></div>
												<div class="col-sm-2"><input type="checkbox" value="upperleft3" id="teeths" class="teeths col-sm-2" name="upperleft[]"></div>
												<div class="col-sm-2"><input type="checkbox" value="upperleft4" id="teeths" class="teeths col-sm-2" name="upperleft[]"></div>
												<div class="col-sm-2"><input type="checkbox" value="upperleft5" id="teeths" class="teeths col-sm-2" name="upperleft[]"></div>
											</div>
										</div>
									</div>
										
									
										@endif
									</div>

									</div>
									</div>
									<div class="col-sm-6 dd_Plaque_pd_0">
									<div class="panel panel-default panel_me">
							        <div class="panel-body">
							        @if(!empty($upper_right))

							        <div class="row">
										<div class="col-sm-12">
											<div class="form-group">
												<div class="col-sm-2">A</div>
												<div class="col-sm-2">B</div>
												<div class="col-sm-2">C</div>
												<div class="col-sm-2">D</div>
												<div class="col-sm-2">E</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-12">
											<div class="form-group">
												<div class="col-sm-2">
											<input type="checkbox" value="upperright1" id="teeths" class="teeths" name="upperright[]"  
											@if(in_array("upperright1",$upper_right)) checked="checked" @endif>
											</div>
												<div class="col-sm-2">
											<input type="checkbox" value="upperright2" id="teeths" class="teeths" name="upperright[]"  
											@if(in_array("upperright2",$upper_right)) checked="checked" @endif>
											</div>
												<div class="col-sm-2">
											<input type="checkbox" value="upperright3" id="teeths" class="teeths" name="upperright[]"  
											@if(in_array("upperright3",$upper_right)) checked="checked" @endif>
											</div>
												<div class="col-sm-2">
											<input type="checkbox" value="upperright4" id="teeths" class="teeths" name="upperright[]"  
											@if(in_array("upperright4",$upper_right)) checked="checked" @endif>
											</div>
												<div class="col-sm-2">
											<input type="checkbox" value="upperright5" id="teeths" class="teeths" name="upperright[]"  
											@if(in_array("upperright5",$upper_right)) checked="checked" @endif>
											</div>
											</div>
										</div>
									</div>



							        
										@else
										<div class="row">
										<div class="col-sm-12">
											<div class="form-group">
												<div class="col-sm-2">A</div>
												<div class="col-sm-2">B</div>
												<div class="col-sm-2">C</div>
												<div class="col-sm-2">D</div>
												<div class="col-sm-2">E</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-12">
											<div class="form-group">
												<div class="col-sm-2">
											<input type="checkbox" value="upperright1" id="teeths" class="teeths" name="upperright[]">
											</div>
												<div class="col-sm-2">
											<input type="checkbox" value="upperright2" id="teeths" class="teeths" name="upperright[]">
											</div>
												<div class="col-sm-2">
											<input type="checkbox" value="upperright3" id="teeths" class="teeths" name="upperright[]">
											</div>
												<div class="col-sm-2">
											<input type="checkbox" value="upperright4" id="teeths" class="teeths" name="upperright[]">
											</div>
												<div class="col-sm-2">
											<input type="checkbox" value="upperright5" id="teeths" class="teeths" name="upperright[]">
											</div>
											</div>
										</div>
									</div>
							       
										@endif
									</div>
									</div>
									</div>
								</div>
					</div>
				</div>
				<div class="panel-hide">
					<div class="form-group">
									{!! Form::label('', '', $attributes = array('class'=>"col-sm-2"));  !!}
								<div class="col-sm-6">
								<div class="col-sm-6 dd_Plaque_pd_0">
								<div class="panel panel-default panel_me">
							        <div class="panel-body">
							         @if(!empty($lower_left))
							         
									<div class="row">
										<div class="col-sm-12">
											<div class="form-group">
												<div class="col-sm-2">
											<input type="checkbox" value="lowerleft1" id="teeths" class="teeths" name="lowerleft[]"  
											@if(in_array("lowerleft1",$lower_left)) checked="checked" @endif>
											</div>
												<div class="col-sm-2">
											<input type="checkbox" value="lowerleft2" id="teeths" class="teeths" name="lowerleft[]"  
											@if(in_array("lowerleft2",$lower_left)) checked="checked" @endif>
											</div>
												<div class="col-sm-2">
											<input type="checkbox" value="lowerleft3" id="teeths" class="teeths" name="lowerleft[]"  
											@if(in_array("lowerleft3",$lower_left)) checked="checked" @endif>
											</div>
												<div class="col-sm-2">
											<input type="checkbox" value="lowerleft4" id="teeths" class="teeths" name="lowerleft[]"  
											@if(in_array("lowerleft4",$lower_left)) checked="checked" @endif>
											</div>
												<div class="col-sm-2">
											<input type="checkbox" value="lowerleft5" id="teeths" class="teeths" name="lowerleft[]"  
											@if(in_array("lowerleft5",$lower_left)) checked="checked" @endif>
											</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-12">
											<div class="form-group">
												<div class="col-sm-2">E</div>
												<div class="col-sm-2">D</div>
												<div class="col-sm-2">C</div>
												<div class="col-sm-2">B</div>
												<div class="col-sm-2">A</div>
											</div>
										</div>
									</div>
										 @else
										 <div class="row">
										<div class="col-sm-12">
											<div class="form-group">
												<div class="col-sm-2">
											<input type="checkbox" value="lowerleft1" id="teeths" class="teeths" name="lowerleft[]">
											</div>
												<div class="col-sm-2">
											<input type="checkbox" value="lowerleft2" id="teeths" class="teeths" name="lowerleft[]">
											</div>
												<div class="col-sm-2">
											<input type="checkbox" value="lowerleft3" id="teeths" class="teeths" name="lowerleft[]">
											</div>
												<div class="col-sm-2">
											<input type="checkbox" value="lowerleft4" id="teeths" class="teeths" name="lowerleft[]">
											</div>
												<div class="col-sm-2">
											<input type="checkbox" value="lowerleft5" id="teeths" class="teeths" name="lowerleft[]">
											</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-12">
											<div class="form-group">
												<div class="col-sm-2">E</div>
												<div class="col-sm-2">D</div>
												<div class="col-sm-2">C</div>
												<div class="col-sm-2">B</div>
												<div class="col-sm-2">A</div>
											</div>
										</div>
									</div>


							       
										@endif
									</div>
									</div>
									</div>
									<div class="col-sm-6 dd_Plaque_pd_0">
									<div class="panel panel-default panel_me">
							        <div class="panel-body">
							         @if(!empty($lower_right))

							         <div class="row">
										<div class="col-sm-12">
											<div class="form-group">
												<div class="col-sm-2">
											<input type="checkbox" value="lowerright1" id="teeths" class="teeths" name="lowerright[]"  
											@if(in_array("lowerright1",$lower_right)) checked="checked" @endif>
											</div>
												<div class="col-sm-2">
											<input type="checkbox" value="lowerright2" id="teeths" class="teeths" name="lowerright[]"  
											@if(in_array("lowerright2",$lower_right)) checked="checked" @endif>
											</div>
												<div class="col-sm-2">
											<input type="checkbox" value="lowerright3" id="teeths" class="teeths" name="lowerright[]"  
											@if(in_array("lowerright3",$lower_right)) checked="checked" @endif>
											</div>
												<div class="col-sm-2">
											<input type="checkbox" value="lowerright4" id="teeths" class="teeths" name="lowerright[]"  
											@if(in_array("lowerright4",$lower_right)) checked="checked" @endif>
											</div>
												<div class="col-sm-2">
											<input type="checkbox" value="lowerright5" id="teeths" class="teeths" name="lowerright[]"  
											@if(in_array("lowerright5",$lower_right)) checked="checked" @endif>
											</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-12">
											<div class="form-group">
												<div class="col-sm-2">A</div>
												<div class="col-sm-2">B</div>
												<div class="col-sm-2">C</div>
												<div class="col-sm-2">D</div>
												<div class="col-sm-2">E</div>
											</div>
										</div>
									</div>





							       
										 @else
										 <div class="row">
										<div class="col-sm-12">
											<div class="form-group">
												<div class="col-sm-2">
											<input type="checkbox" value="lowerright1" id="teeths" class="teeths" name="lowerright[]">
											</div>
												<div class="col-sm-2">
											<input type="checkbox" value="lowerright2" id="teeths" class="teeths" name="lowerright[]">
											</div>
												<div class="col-sm-2">
											<input type="checkbox" value="lowerright3" id="teeths" class="teeths" name="lowerright[]">
											</div>
												<div class="col-sm-2">
											<input type="checkbox" value="lowerright4" id="teeths" class="teeths" name="lowerright[]">
											</div>
												<div class="col-sm-2">
											<input type="checkbox" value="lowerright5" id="teeths" class="teeths" name="lowerright[]">
											</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-12">
											<div class="form-group">
												<div class="col-sm-2">A</div>
												<div class="col-sm-2">B</div>
												<div class="col-sm-2">C</div>
												<div class="col-sm-2">D</div>
												<div class="col-sm-2">E</div>
											</div>
										</div>
									</div>


							        
										@endif
									</div>
									</div>
						</div>
					</div>
					</div>
					</div>
					<div class="form-group test">
					{!! Form::label('', '', $attributes = array('class'=>"col-sm-2"));  !!}
						<div class="col-sm-9">
						
					{!! Form::hidden('test','',['class'=>'form-control']) !!}
					
				
						</div>
				</div>
					<div class="form-group">
						{!! Form::label('tongue', 'Tongue', $attributes = array('class'=>"col-sm-2"));  !!}
						<div class="col-sm-9">
						<span>
						{!! Form::textarea('dental_tongue',$pediatricExamData->dental_tongue,['class'=>'form-control', 'rows' => 4, 'cols' => 40]) !!}
						</span>
				
						</div>
				</div>
				<div class="form-group">
						{!! Form::label('remarks', 'Remarks', $attributes = array('class'=>"col-sm-2"));  !!}
						<div class="col-sm-9">
						<span>
						{!! Form::textarea('dental_remarks',$pediatricExamData->dental_remarks,['class'=>'form-control', 'rows' => 4, 'cols' => 40]) !!}
						</span>
						</div>
				</div>
				<hr>
				<div class="form-group">
				<div class="col-sm-8">
			<h3 class="dd_h3_Pd_t_0">SYSTEMIC EXAMINATON</h3>
		</div>
						
					
				</div>
					<div class="form-group">
						{!! Form::label('tongue', 'Tongue', $attributes = array('class'=>"col-sm-2"));  !!}
						<div class="col-sm-9">
						<span>
						{!! Form::textarea('systemic_examination_tongue',$pediatricExamData->systemic_tongue,['class'=>'form-control', 'rows' => 4, 'cols' => 40]) !!}
						</span>
						</div>
				</div>
				<div class="form-group">
						{!! Form::label('chest', 'Chest', $attributes = array('class'=>"col-sm-2"));  !!}
						<div class="col-sm-9">
							<span>
							{!! Form::textarea('systemic_examination_chest',$pediatricExamData->systemic_chest,['class'=>'form-control', 'rows' => 4, 'cols' => 40]) !!}
						</span>
						</div>
				</div>
				<div class="form-group">
						{!! Form::label('p/a', 'P/A', $attributes = array('class'=>"col-sm-2"));  !!}
						<div class="col-sm-9">
							<span>
							{!! Form::textarea('systemic_examination_pa',$pediatricExamData->systemic_pa,['class'=>'form-control', 'rows' => 4, 'cols' => 40]) !!}
						</span>
						</div>
				</div>

				@else
				<div class="form-group">
					<div class="col-sm-8">
			<h3 class="dd_h3_Pd_t_0">SKIN CHECKUP</h3>
		</div>
				</div>
				<div class="form-group">
						{!! Form::label('lice', 'Lice', $attributes = array('class'=>"col-sm-3"));  !!}
						<div class="col-sm-4">
							<span>
								<div class="col-sm-4">
								{!! Form::radio('skin_lice', 'Yes'); !!}
										Yes
									</div>
								<div class="col-sm-8">
									{!! Form::radio('skin_lice', 'No'); !!}
										No
									</div>
							</span>
							</div>
						</div>
						
					
				
				<div class="form-group">
						{!! Form::label('scabies', 'Scabies', $attributes = array('class'=>"col-sm-3"));  !!}
						<div class="col-sm-4">
							<span>
									<div class="col-sm-4">
									{!! Form::radio('skin_scabies', 'Yes'); !!}
										Yes
									</div>
								<div class="col-sm-8">
									{!! Form::radio('skin_scabies', 'No'); !!}
										No
									</div>
							</span>	

						</div>
					</div>
				<div class="form-group">
						{!! Form::label('spotsandmolluscum', 'Spots & Molluscum', $attributes = array('class'=>"col-sm-3"));  !!}
						<div class="col-sm-4">
							<span>
								<div class="col-sm-4">
									{!! Form::radio('skin_spots', 'Yes'); !!}
										Yes
									</div>
								<div class="col-sm-8">
									{!! Form::radio('skin_spots', 'No'); !!}
										No
									</div>

							</span>	
						</div>
				</div>
				<div class="form-group">	
						{!! Form::label('eczema', 'Eczema', $attributes = array('class'=>"col-sm-3"));  !!}
						<div class="col-sm-4">
							<span>
								<div class="col-sm-4">
									{!! Form::radio('skin_eczema', 'Yes'); !!}
										Yes
									</div>
								<div class="col-sm-8">
									{!! Form::radio('skin_eczema', 'No'); !!}
										No
									</div>
							</span>	
						</div>
				</div>
				<div class="form-group">
						{!! Form::label('skin_allergy', 'Skin Allergy', $attributes = array('class'=>"col-sm-3"));  !!}
						<div class="col-sm-4">
							<span>
								<div class="col-sm-4">
									{!! Form::radio('skin_allergy', 'Yes'); !!}
										Yes
									</div>
								<div class="col-sm-8">
									{!! Form::radio('skin_allergy', 'No'); !!}
										No
									</div>
							</span>	
						</div>
				</div>
				<div class="form-group">
						{!! Form::label('remarks', 'Remarks', $attributes = array('class'=>"col-sm-3"));  !!}
						<div class="col-sm-9">
							<span>
						{!! Form::textarea('skin_remarks','',['class'=>'form-control', 'rows' => 4, 'cols' => 40,'placeholder'=>"Comments"]) !!}
						
						</span>
						</div>
				</div>
			<hr>
				<div class="form-group">
					
					<div class="col-sm-8">
			<h3 class="dd_h3_Pd_t_0">ENT CHECKUP</h3>
		</div>
						
					
				</div>
					<div class="form-group">
					{!! Form::label('ent_remarks', 'Remarks', $attributes = array('class'=>"col-sm-3"));  !!}
						<div class="col-sm-9">
							<span>
						{!! Form::textarea('ent_remarks','',['class'=>'form-control', 'rows' => 4, 'cols' => 40,'placeholder'=>"Comments"]) !!}
						</span>
						</div>
				</div>
				<hr>
				<div class="form-group">
					
					<div class="col-sm-8">
			<h3 class="dd_h3_Pd_t_0">EYE CHECKUP</h3>
		</div>
						
					
				</div>
					<div class="form-group">
						{!! Form::label('eye_remarks', 'Remarks', $attributes = array('class'=>"col-sm-3"));  !!}
						<div class="col-sm-9">
							<span>
						{!! Form::textarea('eye_remarks','',['class'=>'form-control', 'rows' => 4, 'cols' => 40,'placeholder'=>"Comments"]) !!}
						</span>
						</div>
				</div>
				<hr>
				<div class="form-group">
					
					<div class="col-sm-8">
			<h3 class="dd_h3_Pd_t_0">DENTAL CHECKUP</h3>
		</div>
						
					
				</div>
				<div class="form-group">
						{!! Form::label('extraoral', 'Extra Oral', $attributes = array('class'=>"col-sm-3"));  !!}
						<div class="col-sm-4">
							<span>
							<div class="col-sm-4">
									{!! Form::radio('dental_extraoral', 'Yes'); !!}
										Yes
									</div>
								<div class="col-sm-8">
									{!! Form::radio('dental_extraoral', 'No'); !!}
										No
									</div>
							</span>	
						</div>
				</div>
				<div class="form-group">
				{!! Form::label('intraoral', 'Intra Oral', $attributes = array('class'=>"col-sm-3"));  !!}
						<div class="col-sm-4">
							<span>
								<div class="col-sm-4">
									{!! Form::radio('dental_intraoral', 'Yes'); !!}
										Yes
									</div>
								<div class="col-sm-8">
									{!! Form::radio('dental_intraoral', 'No'); !!}
										No
									</div>
							</span>	
						</div>
				</div>
				<div class="form-group">
						{!! Form::label('toothcavity', 'Tooth Cavity', $attributes = array('class'=>"col-sm-3"));  !!}
						<div class="col-sm-4">
							<span>
								<div class="col-sm-4">
									{!! Form::radio('dental_toothcavity', 'Yes'); !!}
										Yes
									</div>
								<div class="col-sm-8">
									{!! Form::radio('dental_toothcavity', 'No'); !!}
										No
									</div>

							</span>	
						</div>
				</div>
				<div class="form-group">	
						{!! Form::label('gum_inflammattion', 'Gum Imflammattion', $attributes = array('class'=>"col-sm-3"));  !!}
						<div class="col-sm-4">
							<span>
								<div class="col-sm-4">
									{!! Form::radio('dental_gum_inflammattion', 'Yes'); !!}
										Yes
									</div>
								<div class="col-sm-8">
									{!! Form::radio('dental_gum_inflammattion', 'No'); !!}
										No
									</div>

							</span>	
						</div>
				</div>
				<div class="form-group">
						{!! Form::label('calculus', 'Calculus', $attributes = array('class'=>"col-sm-3"));  !!}
						<div class="col-sm-4">
							<span>
								<div class="col-sm-4">
									{!! Form::radio('dental_calculus', 'Yes'); !!}
										Yes
									</div>
								<div class="col-sm-8">
									{!! Form::radio('dental_calculus', 'No'); !!}
										No
									</div>
							</span>	
						</div>
				</div>
				<div class="form-group">
						{!! Form::label('stains', 'Stains', $attributes = array('class'=>"col-sm-3"));  !!}
						<div class="col-sm-4">
							<span>
								<div class="col-sm-4">
									{!! Form::radio('dental_stains', 'Yes'); !!}
										Yes
									</div>
								<div class="col-sm-8">
									{!! Form::radio('dental_stains', 'No'); !!}
										No
									</div>
							</span>	
						</div>
				</div>
				<div class="form-group">
						{!! Form::label('tartar', 'Tartar', $attributes = array('class'=>"col-sm-3"));  !!}
						<div class="col-sm-4">
							<span>
								<div class="col-sm-4">
									{!! Form::radio('dental_tartar', 'Yes'); !!}
										Yes
									</div>
								<div class="col-sm-8">
									{!! Form::radio('dental_tartar', 'No'); !!}
										No
									</div>
							</span>	
						</div>
				</div>

				<div class="form-group">
						{!! Form::label('bad_breath', 'Bad Breath', $attributes = array('class'=>"col-sm-3"));  !!}
						<div class="col-sm-4">
							<span>
								<div class="col-sm-4">
									{!! Form::radio('dental_bad_breath', 'Yes'); !!}
										Yes
									</div>
								<div class="col-sm-8">
									{!! Form::radio('dental_bad_breath', 'No'); !!}
										No
									</div>
							</span>	
						</div>
				</div>

				<div class="form-group">
						{!! Form::label('gum_bleeding', 'Gum Bleeding', $attributes = array('class'=>"col-sm-3"));  !!}
						<div class="col-sm-4">
							<span>
								<div class="col-sm-4">
									{!! Form::radio('dental_gum_bleeding', 'Yes'); !!}
										Yes
									</div>
								<div class="col-sm-8">
									{!! Form::radio('dental_gum_bleeding', 'No'); !!}
										No
									</div>
							</span>	
						</div>
				</div>

				<div class="form-group">
						{!! Form::label('plaque', 'Plaque', $attributes = array('class'=>"col-sm-3"));  !!}
						<div class="col-sm-4">
							<span>
								<div class="col-sm-4">
							<input type="radio" value="Yes" class="plaqueyes" name="dental_plaque" id="plaqueyes"> Yes
									</div>
								<div class="col-sm-8">
								<input type="radio" value="No" class="plaqueno" name="dental_plaque" id="plaqueno"> No
								</div>
							</span>	
						</div>
				</div>
					<!-- plaque -->
				<div class="panel-hide">
					<div class="form-group">
									{!! Form::label('', '', $attributes = array('class'=>"col-sm-2"));  !!}
								<div class="col-sm-6">
								<div class="col-sm-6 dd_Plaque_pd_0">
								<div class="panel panel-default panel_me">
							        <div class="panel-body">
							        <div class="row">
										<div class="col-sm-12">
											<div class="form-group">
												<div class="col-sm-2">E</div>
												<div class="col-sm-2">D</div>
												<div class="col-sm-2">C</div>
												<div class="col-sm-2">B</div>
												<div class="col-sm-2">A</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-12">
											<div class="form-group">
												<div class="col-sm-2">
											{!!
									Form::checkbox('upperleft[]', 'upperleft1',false,array('class' => 'teeths', 'id' => 'teeths'));  !!}
												</div>
												<div class="col-sm-2">{!!
									Form::checkbox('upperleft[]', 'upperleft2',false,array('class' => 'teeths',  'id' => 'teeths'));  !!}</div>
												<div class="col-sm-2">{!!
									Form::checkbox('upperleft[]', 'upperleft3',false,array('class' => 'teeths',  'id' => 'teeths'));  !!}</div>
												<div class="col-sm-2">{!!
									Form::checkbox('upperleft[]', 'upperleft4',false,array('class' => 'teeths',  'id' => 'teeths'));  !!}</div>
												<div class="col-sm-2">{!!
									Form::checkbox('upperleft[]', 'upperleft5',false,array('class' => 'teeths', 'id' => 'teeths'));  !!}</div>
											</div>
										</div>
									</div>
							        

									<!-- {!!
									Form::checkbox('upperleft[]', 'upperleft2',false,array('class' => 'teeths',  'id' => 'teeths'));  !!}
									{!!
									Form::checkbox('upperleft[]', 'upperleft3',false,array('class' => 'teeths',  'id' => 'teeths'));  !!}
									{!!
									Form::checkbox('upperleft[]', 'upperleft4',false,array('class' => 'teeths', 'id' => 'teeths'));  !!}
									{!!
									Form::checkbox('upperleft[]', 'upperleft5',false,array('class' => 'teeths',  'id' => 'teeths'));  !!} -->
									</div>
									</div>
									</div>
									<div class="col-sm-6 dd_Plaque_pd_0">
									<div class="panel panel-default panel_me">
							        <div class="panel-body">
							        <div class="row">
										<div class="col-sm-12">
											<div class="form-group">
												<div class="col-sm-2">A</div>
												<div class="col-sm-2">B</div>
												<div class="col-sm-2">C</div>
												<div class="col-sm-2">D</div>
												<div class="col-sm-2">E</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-12">
											<div class="form-group">
												<div class="col-sm-2">
													{!!
									Form::checkbox('upperright[]', 'upperright1',false,array('class' => 'teeths','id' => 'teeths'));  !!}
												</div>
												<div class="col-sm-2">
												{!!
									Form::checkbox('upperright[]', 'upperright2',false,array('class' => 'teeths', 'id' => 'teeths'));  !!}</div>
												<div class="col-sm-2">
													{!!
									Form::checkbox('upperright[]', 'upperright3',false,array('class' => 'teeths',  'id' => 'teeths'));  !!}
												</div>
												<div class="col-sm-2">
													{!!
									Form::checkbox('upperright[]', 'upperright4',false,array('class' => 'teeths', 'id' => 'teeths'));  !!}
												</div>
												<div class="col-sm-2">
													{!!
									Form::checkbox('upperright[]', 'upperright5',false,array('class' => 'teeths', 'id' => 'teeths'));  !!}
												</div>
											</div>
										</div>
									</div>
									
									</div>
									</div>
									</div>
								</div>
					</div>
				</div>
				<div class="panel-hide">
					<div class="form-group">
									{!! Form::label('', '', $attributes = array('class'=>"col-sm-2"));  !!}
								<div class="col-sm-6">
								<div class="col-sm-6 dd_Plaque_pd_0">
								<div class="panel panel-default panel_me">
							        <div class="panel-body">
							        <div class="row">
										<div class="col-sm-12">
											<div class="form-group">
												<div class="col-sm-2">
												{!!
									Form::checkbox('lowerleft[]', 'lowerleft1',false,array('class' => 'teeths', 'id' => 'teeths'));  !!}
									</div>
												<div class="col-sm-2">
													{!!
									Form::checkbox('lowerleft[]', 'lowerleft2',false,array('class' => 'teeths', 'id' => 'teeths'));  !!}
												</div>
												<div class="col-sm-2">
													{!!
									Form::checkbox('lowerleft[]', 'lowerleft3',false,array('class' => 'teeths', 'id' => 'teeths'));  !!}
												</div>
												<div class="col-sm-2">
													{!!
									Form::checkbox('lowerleft[]', 'lowerleft4',false,array('class' => 'teeths', 'id' => 'teeths'));  !!}
												</div>
												<div class="col-sm-2">
													{!!
									Form::checkbox('lowerleft[]', 'lowerleft5',false,array('class' => 'teeths', 'id' => 'teeths'));  !!}
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-12">
											<div class="form-group">
												<div class="col-sm-2">E</div>
												<div class="col-sm-2">D</div>
												<div class="col-sm-2">C</div>
												<div class="col-sm-2">B</div>
												<div class="col-sm-2">A</div>
											</div>
										</div>
									</div>
									
									</div>
									</div>
									</div>
									<div class="col-sm-6 dd_Plaque_pd_0">
									<div class="panel panel-default panel_me">
							        <div class="panel-body">
							        <div class="row">
										<div class="col-sm-12">
											<div class="form-group">
												<div class="col-sm-2">
												{!!
									Form::checkbox('lowerright[]', 'lowerright1',false,array('class' => 'teeths', 'id' => 'teeths'));  !!}
												</div>
												<div class="col-sm-2">
													{!!
									Form::checkbox('lowerright[]', 'lowerright2',false,array('class' => 'teeths', 'id' => 'teeths'));  !!}
												</div>
												<div class="col-sm-2">
													{!!
									Form::checkbox('lowerright[]', 'lowerright3',false,array('class' => 'teeths', 'id' => 'teeths'));  !!}
												</div>
												<div class="col-sm-2">
													{!!
									Form::checkbox('lowerright[]', 'lowerright4',false,array('class' => 'teeths', 'id' => 'teeths'));  !!}
												</div>
												<div class="col-sm-2">
													{!!
									Form::checkbox('lowerright[]', 'lowerright5',false,array('class' => 'teeths', 'id' => 'teeths'));  !!}
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-12">
											<div class="form-group">
												<div class="col-sm-2">A</div>
												<div class="col-sm-2">B</div>
												<div class="col-sm-2">C</div>
												<div class="col-sm-2">D</div>
												<div class="col-sm-2">E</div>
											</div>
										</div>
									</div>
									
									</div>
									</div>
									</div>
						</div>
					</div>
				</div>
					
					<div class="form-group test">
					{!! Form::label('', '', $attributes = array('class'=>"col-sm-2"));  !!}
						<div class="col-sm-9">
						<span>
					{!! Form::hidden('test','',['class'=>'form-control']) !!}
					</span>
				
						</div>
				</div>
					<div class="form-group">
						{!! Form::label('tongue', 'Tongue', $attributes = array('class'=>"col-sm-2"));  !!}
						<div class="col-sm-9">
							<span>
						{!! Form::textarea('dental_tongue','',['class'=>'form-control', 'rows' => 4, 'cols' => 40]) !!}
						</span>
						</div>
				</div>
				<div class="form-group">
						{!! Form::label('remarks', 'Remarks', $attributes = array('class'=>"col-sm-2"));  !!}
						<div class="col-sm-9">
							<span>
						{!! Form::textarea('dental_remarks','',['class'=>'form-control', 'rows' => 4, 'cols' => 40]) !!}
						</span>
						</div>
				</div>
				<hr>
				<div class="form-group">
				<div class="col-sm-8">
			<h3 class="dd_h3_Pd_t_0">SYSTEMIC EXAMINATON</h3>
		</div>
						
					
				</div>
					<div class="form-group">
						{!! Form::label('tongue', 'Tongue', $attributes = array('class'=>"col-sm-2"));  !!}
						<div class="col-sm-9">
						<span>
							{!! Form::textarea('systemic_examination_tongue','',['class'=>'form-control', 'rows' => 4, 'cols' => 40]) !!}
						</span>
						</div>
				</div>
				<div class="form-group">
						{!! Form::label('chest', 'Chest', $attributes = array('class'=>"col-sm-2"));  !!}
						<div class="col-sm-9">
							<span>
							{!! Form::textarea('systemic_examination_chest','',['class'=>'form-control', 'rows' => 4, 'cols' => 40]) !!}
						</span>
						</div>
				</div>
				<div class="form-group">
						{!! Form::label('p/a', 'P/A', $attributes = array('class'=>"col-sm-2"));  !!}
						<div class="col-sm-9">
							<span>
							{!! Form::textarea('systemic_examination_pa','',['class'=>'form-control', 'rows' => 4, 'cols' => 40]) !!}
						</span>
						</div>
				</div>
				@endif
				<hr>
				
				
				<div class="row">
					
					@if(!empty($patientPersonalData))
						<div class="form-group dd_fromgroup_MG_0">
						 	<div class="col-sm-12 ">
								<div class="col-sm-12">
									<button type="submit" class="btn btn-primary btn-block dd_btn_center"><!-- <i class="fa fa-floppy-o"></i> --> Save</button>
								</div>
							</div>
						</div>
					
					@else
						<div class="form-group dd_fromgroup_MG_0">
						 	<div class="col-sm-12 ">
								<div class="col-sm-12">
									<button type="submit" class="btn btn-primary btn-block dd_btn_center" " disabled="disabled"><!-- <i class="fa fa-floppy-o"></i> --> Save</button>
								</div>
							</div>
						</div>
					
					@endif
				</div>
				</div>
				</div>
	{!! Form::close() !!}
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
		{!!Html::script('assets/js/pedia-diag-examination.js')!!}
		
	 	<!-- {!!Html::script('assets/plugins/tooltip-validation/jquery-validate.bootstrap-tooltip.js')!!} -->
	<script>
		$(document).ready(function() {
			Main.init();
			pediaDiagExamination.init();

	 	});
	</script>
@stop