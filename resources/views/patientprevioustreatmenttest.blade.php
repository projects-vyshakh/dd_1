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
$lmpCounter = 10;
$obsCounter = 0;
$pregCounter = 0;
$ObstetricsCounter = 0;
$vitalsCounter = 0;
$diagnosisCounter = 0;
$prescMedicineCounter = 0;
//var_dump($obsData);

$yearArray = array();
$startYear = date("Y");
$endYear = "2012";
for($startYear;$startYear>=$endYear;$startYear--){
	$yearArray[$startYear] = $startYear;

}


?>
		<div class="page-header">
			<h1>Patient Previous Treatments <small></small></h1>
		</div>

		<div class="row">
			<div class="col-sm-2">
				{!! Form::select('year', $yearArray, null , $attributes = array('class' => 'form-control year','id'=>'year')); !!}
			</div>
		</div>	
		
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="row">
							<div class="col-sm-12">
								
								<div class="tabbable tabs-left">
								
									<ul id="myTab3" class="nav nav-tabs tab-green ">
										@foreach($originalCreatedDateDup as $index=>$originalCreatedDateVal)
										<?php $prevAvailableDate = date('d-M-Y',strtotime($originalCreatedDateVal)); ?>
										<li @if($index==0) class="active" @endif>
											<a href="#panel_tab4_example1{{$index}}" data-toggle="tab">
												{{$prevAvailableDate}}
											</a>
										</li>
										@endforeach
										
									</ul>
									<div class="tab-content">
										@foreach($originalCreatedDateDup as $key=>$originalCreatedDateVal)
											<?php

												$obsHeadingStatusArray = array();
												$lmpHeadingStatusArray = array();
												$pregHeadingStatusArray = array();
												$vitalsHeadingStatusArray = array();
												$diagHeadingStatusArray = array();
												$prescHeadingStatusArray = array();
												$followupDateArray = array();

											?>

											<div @if($key==0) class="tab-pane active" @else class="tab-pane" @endif id="panel_tab4_example1{{$key}}">
												<p> 
													<div class="row">
														<div class="col-sm-12">
															<div class="tabbable">
																<ul id="myTab" class="nav nav-tabs tab-bricky">
																	<li class="active">
																		<a href="#vitals{{$key}}" data-toggle="tab">
																			<i class="green fa fa-home"></i> Vitals
																		</a>
																	</li>
																	<li class="">
																		<a href="#diagnosis{{$key}}" data-toggle="tab">
																			<i class="green fa fa-home"></i> Diagnosis
																		</a>
																	</li>
																	<li class="">
																		<a href="#prescription{{$key}}" data-toggle="tab">
																			<i class="green fa fa-home"></i> Prescription 
																		</a>
																	</li>
																	<li class="">
																		<a href="#obstetrics{{$key}}" data-toggle="tab">
																			<i class="green fa fa-home"></i> Obstetrics History 
																		</a>
																	</li>
																
																	<li class="dropdown">
																		<a href="#" class="dropdown-toggle" data-toggle="dropdown">
																			Dropdown &nbsp; <i class="fa fa-caret-down width-auto"></i>
																		</a>
																		<ul class="dropdown-menu dropdown-info">
																			<li>
																				<a href="#menstrual{{$key}}" data-toggle="tab">
																					Menstrual History
																				</a>
																			</li>
																			<li>
																				<a href="#pregnancy{{$key}}" data-toggle="tab">
																					Pregnancy History	
																				</a>
																			</li>
																		</ul>
																	</li>
																<!-- 	<li>
																		<a href="#panel_tab2_example2" data-toggle="tab">
																			Tab 2 <span class="badge badge-danger">4</span>
																		</a>
																	</li> -->
																<!-- <li class="dropdown">
																		<a href="#" class="dropdown-toggle" data-toggle="dropdown">
																			Dropdown &nbsp; <i class="fa fa-caret-down width-auto"></i>
																		</a>
																		<ul class="dropdown-menu dropdown-info">
																			<li>
																				<a href="#panel_tab2_example3" data-toggle="tab">
																					Dropdown 1
																				</a>
																			</li>
																			<li>
																				<a href="#panel_tab2_example4" data-toggle="tab">
																					Dropdown 2
																				</a>
																			</li>
																		</ul>
																	</li> -->
																</ul>
																<div class="tab-content">

																	<!-- Vitals -->
																	<div class="tab-pane in active" id="vitals{{$key}}">
																		<p>
																			@if(!empty($vitalsData))
																				
																			<div class="panel-group accordion-custom accordion-teal" id="accordion_vitals">
																				@foreach($vitalsData as $key=>$vitalsDataVal)

																					@if($originalCreatedDateVal==date('Y-m-d',strtotime($vitalsDataVal->created_date)))
																						<div class="panel panel-default">
																							<div class="panel-heading">
																								<h4 class="panel-title">
																								<a class="accordion-toggle collapsed in" data-toggle="collapse" data-parent="#accordion_vitals" href="#collapseVitals{{$vitalsCounter}}">
																									<i class="icon-arrow"></i>
																								</a></h4>
																							</div>
																							<div id="collapseVitals{{$vitalsCounter}}" class="panel-collapse collapse">
																								<div class="panel-body">
																								 	<div class="col-sm-12">
																										<div class="form-group form-horizontal">
																											<div class="form-group ">
																												 {!! Form::label('weight', 'Weight (kg)', $attributes = array('class'=>"col-sm-2"));  !!} 
																												<div class="col-sm-2">
																												

																													<span>
																													{!! Form::text('weight', $vitalsDataVal->weight, $attributes = array('class'=>'form-control','data-validetta'=>"required,minLength[2],maxLength[3]"));  !!}
																													</span>
																												</div>
																											 {!! Form::label('height', 'Height (cm)', $attributes = array('class'=>"col-sm-2"));  !!} 
																												<div class="col-sm-2">
																													<span>
																													{!! Form::text('height', $vitalsDataVal->height, $attributes = array('class'=>'form-control','data-validetta'=>"required,minLength[2],maxLength[3]"));  !!}
																																			
																													</span>
																												</div>
																												 {!! Form::label('bmi', 'BMI', $attributes = array('class'=>"col-sm-2"));  !!} 
																												<div class="col-sm-2">
																													<span>
																													{!! Form::text('bmi',  $vitalsDataVal->bmi, $attributes = array('class'=>'form-control'));  !!}
																																			
																													</span>
																												</div>
																											</div>
																										
																											<div class="form-group">
																												{!! Form::label('pulse', 'Pulse (beats/min)', $attributes = array('class'=>"col-sm-2"));  !!} 
																												<div class="col-sm-2">
																													<span>
																													{!! Form::text('pulse',  $vitalsDataVal->pulse, $attributes = array('class'=>'form-control'));  !!}
																													</span>
																												</div>
																												 {!! Form::label('respiratory_rate', 'Respiratory rate (breathes/min)', $attributes = array('class'=>"col-sm-2"));  !!} 
																												<div class="col-sm-2">
																													<span>
																													{!! Form::text('respiratory_rate',  $vitalsDataVal->respiratoryrate, $attributes = array('class'=>'form-control dd_ellips'));  !!}
																																			
																													</span>
																												</div>
																												{!! Form::label('bmi', 'Temperature (Fahrenheit)', $attributes = array('class'=>"col-sm-2"));  !!} 
																												<div class="col-sm-2">
																													<span>
																													{!! Form::text('temperature',  $vitalsDataVal->temperature, $attributes = array('class'=>'form-control'));  !!}
																																			
																													</span>
																												</div>
																											</div>
																											<div class="form-group">
																												{!! Form::label('spo2', 'SPO2 (%)', $attributes = array('class'=>"col-sm-2"));  !!} 

																												<div class="col-sm-2">
																													<span>
																													{!! Form::text('spo2',  $vitalsDataVal->sp, $attributes = array('class'=>'form-control'));  !!}
																																			
																													</span>
																												</div>

																												{!! Form::label('bloodgroup', 'Blood Group', $attributes = array('class'=>"col-sm-2"));  !!} 
																												<div class="col-sm-2">
																													<span>
																													
																													@if(!empty($vitalsDataVal->blood_group))
																														{!! Form::text('bloodgroup', $vitalsDataVal->blood_group, $attributes = array('class'=>'form-control','readonly'=>'readonly'));  !!}
																													@else
																														{!! Form::select('bloodgroup', $bloodGroup,null, $attributes = array('class' => 'form-control')); !!} 
																													@endif	
																													</span>
																												</div>
																											</div>
																											<div class="form-group">
																												<div class="dd_relative"> 
																													 {!! Form::label('pressure', 'Blood Pressure (Systolic / Diastolic [mm/Hg])', $attributes = array('class'=>"col-sm-2"));  !!} 
																													<div class="col-sm-1">
																														<span class="sys_dia_pressure">
																														{!! Form::text('systolic_pressure', $vitalsDataVal->systolic_pressure, $attributes = array('class'=>'form-control dd_ellips '));  !!}
																																				
																														</span>
																													</div>
																													<!--  {!! Form::label('diastolic_pressure', 'Blood Pressure (Diastolic [mm/Hg])', $attributes = array('class'=>"col-sm-2"));  !!}  -->

																													<div class="col-sm-1">
																														<span class="sys_dia_pressure">
																														{!! Form::text('diastolic_pressure', $vitalsDataVal->diastolic_pressure, $attributes = array('class'=>'form-control dd_ellips '));  !!}
																																				
																														</span>
																													</div>
																													<div class="pressure">/</div>
																												</div>

																											</div>
																										</div>										
																									</div>
																								</div>			
																							</div>
																						</div>	
																						<?php array_push($vitalsHeadingStatusArray,1); ?>
																					@else
																						<?php array_push($vitalsHeadingStatusArray,0); ?>	
																					@endif
																					
																						<?php $vitalsCounter++; ?>
																				@endforeach	
																			</div>	
																			@else
														
																			@endif	
																			@if(in_array('1',$vitalsHeadingStatusArray))
													
																			@else
																				<h5 class="dd_h5_nodata btn btn-default">No Vitals history data to display</h5>
																			@endif
																		
																		</p>
																		
																	</div>
																	<!-- Vitals Ends -->

																	<!-- start: Diagnosis Accordian PANEL -->

																	<div class="tab-pane" id="diagnosis{{$key}}">
																		<p>
																				<!-- start: Diagnosis Accordian PANEL -->
																				<div class="panel">
																					<div class=""> <!-- class="panel-body" -->
																						<!-- <h3>Diagnosis History</h3> -->
																							<div class="panel-group accordion-custom accordion-teal" id="accordion_vitals">
																								@if(!empty($diagnosisData))
																							
																									@foreach($diagnosisData as $index=>$diagnosisDataVal)
																										@if($originalCreatedDateVal==date('Y-m-d',strtotime($diagnosisDataVal->created_date)))
																											<div class="panel panel-default">
																												<div class="panel-heading">
																													<h4 class="panel-title">
																														<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion_diagnosis" href="#collapseDiagnosis{{$diagnosisCounter}}">
																															<i class="icon-arrow"></i>
																														</a>
																													</h4>
																												</div>
																												<div id="collapseDiagnosis{{$diagnosisCounter}}" class="panel-collapse collapse in">
																													<div class="panel-body">
																													 	<div class="col-sm-12">
																															<div class="form-group form-horizontal">
																																<div class="form-group">
																																	{!! Form::label('symptoms', 'Symptoms', $attributes = array('class'=>"col-sm-2"));  !!}
																																	<div class="col-sm-10">
																																		<span>
																																		<?php $diagSymptoms = json_decode($diagnosisDataVal->diag_symptoms) ;
																																		?>	

																																			
																																			{!! Form::select('symptoms[]', $symptoms, $diagSymptoms, $attributes = array('class' => 'tokenize-sample','id'=>'tokenize','multiple' => 'multiple','name'=>'symptoms[]')); !!}
																																			<!-- {!! Form::select('symptoms[]',[], $diagSymptoms, $attributes = array('class' => 'form-control search-select search-symptoms','id'=>'form-field-select-4','multiple' => 'multiple')); !!} -->
																																		</span>
																																	</div>
																																	{!! Form::label('syndromes', 'Syndromes', $attributes = array('class'=>"col-sm-2"));  !!}
																																	<div class="col-sm-10">
																																		<span>
																																		{!! Form::textarea('syndromes',$diagnosisDataVal->diag_syndromes,['class'=>'form-control', 'rows' => 4, 'cols' => 20]) !!}
																																		</span>
																																	</div>
																																</div>
																																<div class="form-group">
																																	{!! Form::label('suspected_disease', 'Suspected Disease', $attributes = array('class'=>"col-sm-2"));  !!}
																																	<div class="col-sm-10">
																																		<span>
																																		<?php $diagDisease = json_decode($diagnosisDataVal->diag_suspected_diseases);

																																			
																																		 ?>


																																		<!-- {!! Form::select('diseases[]', [$diseases], $diagDisease, $attributes = array('class' => 'form-control search-select','id'=>'form-field-select-4','multiple' => 'multiple')); !!} -->
																																		{!! Form::select('diseases[]', $diseases, $diagDisease, $attributes = array('class' => 'tokenize-sample tokenize-disease','id'=>'tokenize1','multiple' => 'multiple','name'=>'diseases[]')); !!}
																																		</span>
																																	</div>
																																</div>
																																<div class="form-group">
																																	{!! Form::label('additional_comment', 'Additional Comment', $attributes = array('class'=>"col-sm-2"));  !!}
																																	<div class="col-sm-10">
																																		{!! Form::textarea('additional_comment',$diagnosisDataVal->diag_comment,['class'=>'form-control', 'rows' => 4, 'cols' => 40]) !!}
																																	</div>
																																	
																																</div>
																																
																															</div>										
																														</div>
																													</div>			
																												</div>
																											</div>
																											<?php array_push($diagHeadingStatusArray,1); ?>
																										@else
																											<?php array_push($diagHeadingStatusArray,0); ?>
																										@endif
																										<?php $diagnosisCounter++; ?>
																									@endforeach
																								@endif	
																						</div>
																						@if(in_array('1',$diagHeadingStatusArray))
																							
																						@else
																							<h5 class="dd_h5_nodata btn btn-default">No Diagnosis history data to display</h5>
																						@endif	
																					</div>
																				</div>	
																				<!-- ends: Diagnosis Accordian PANEL -->
																				
																		</p>
																		
																	</div>
																	<!-- ends: Diagnosis Accordian PANEL -->


																	<div class="tab-pane" id="prescription{{$key}}">
																		<p>
																			<!-- start: Prescription Accordian PANEL -->
																			<div class="panel">
																				<div class=""> <!-- class="panel-body" -->
																				<!-- <h3>PRESCRIPTION HISTORY</h3> -->
																				
																				
																				</div>

																				<div style="float:left;width:1000px;overflow-y: auto;height: 800px;:"> 

																				@if(!empty($prescMedicineData))
																					@foreach($prescMedicineData as $index=>$prescMedicineDataVal)
																						@if($originalCreatedDateVal==date('Y-m-d',strtotime($prescMedicineDataVal->created_date)))
																						<div class="presc-inner contaner dd_border_table" style="padding-bottom:25px;">
																							<table class="table table-bordered  presc-table" id="sample-table-1">
																								<thead>
																									<tr class="drugs_row_hd" >
																										<th width="20%">Drug Name</th>
																										<th width="30%">Strength</th>
																										<th width="20%" >Duration</th>
																										<th width="10%">Morning</th>
																										<th width="10%">Noon </th>
																										<th width="10%">Night</th>
																									
																									</tr>
																								</thead>
																								<tbody>
																									<tr class="drugs_row">
																										<td class="dd_presc_medicin">
																											{!! Form::text('drug_name1', $prescMedicineDataVal->drug_name, $attributes = array('class'=>'dd_input_mini','id'=>'drug_name1'));  !!}
																										</td>
																										<td >
																										    <div class="dd_dosage1_text">
																										    	{!! Form::text('dosage1', $prescMedicineDataVal->dosage, $attributes = array('class'=>'input-mini ng-pristine ng-valid'));  !!}

																										    	{!! Form::select('dosage_unit1', $dosageUnit,$prescMedicineDataVal->dosage_unit, $attributes = array('class'=>''));  !!}
																											</div>
																										</td>
																										<td >
																											<div class="dd_dosage1_text">
																												{!! Form::text('duration1', $prescMedicineDataVal->duration, $attributes = array('class'=>'input-mini ng-pristine ng-valid'));  !!}
																													
																												{!! Form::select('duration_unit1', $drugDurationUnit,$prescMedicineDataVal->duration_unit, $attributes = array('class'=>''));  !!}
																											</div>
																										</td>
																										<td>
																											{!! Form::text('morning1', $prescMedicineDataVal->morning, $attributes = array('class'=>'col-sm-8'));  !!}
																										</td>
																										<td>
																											{!! Form::text('noon1', $prescMedicineDataVal->noon, $attributes = array('class'=>'col-sm-8'));  !!}
																										</td>
																										<td>
																											{!! Form::text('night1', Input::old('night1'), $attributes = array('class'=>'night col-sm-8',));  !!}

																											{!! Form::text('noon1', $prescMedicineDataVal->night, $attributes = array('class'=>'col-sm-8'));  !!}
																										</td>
																										<td></td>
																										<td></td>
																										<!-- <td><span class="label label-sm label-warning">Expiring</span></td> -->
																									</tr>

																									<tr class="drugs_row dd_relative">
																										<!-- <td class="dd_presc_medicin"></td> -->
																										<td >
																											@if(empty($prescMedicineDataVal->instruction))
																											<input type="button" class="btn btn-default dd_instruction  btn-xs add-instruction-btn1" id="add-instruction-btn1" value="+ Add Instruction" />
																											@else
																											<input type="button" class="btn btn-default dd_dosage1_text dd_instruction  btn-xs remove-instruction-btn1" id="remove-instruction-btn1" value="- Remove Instruction"  />
																											@endif
																											<!-- <div class="instruction-div1"></div> -->
																											
																										</td>
																										<td width="30%" style="vertical-align: top;" >	
																											<div class="dd_dosage1_text_3 dd_Date pull-left">Start Date	</div>	
																											<div class="dd_dosage1_text_2 pull-left">
																											  	<?php
																											  		if(!empty($prescMedicineDataVal->start_date)){
																											  			$startDate = date('d-M-Y',strtotime($prescMedicineDataVal->start_date));
																											  		}
																											  		else
																											  		{
																											  			$startDate = '';
																											  		}
																											  		


																											  	?>					    	
																												<span class="dd_instruction"> 
																													{!! Form::text('start_date1', $startDate , $attributes = array('class' => 'form-control')); !!}
																												</span>
																												
																											</div>
																										</td>
																										
																										<td class="dd_relative" style="vertical-align: top;">
																										    <div class="dd_beforfood">
																												<label class="dd_beforfood_pd" >
																													<input type="radio"  class="before_food" name="food_status{{$index}}" value="Before Food" @if($prescMedicineDataVal->food_status=="Before Food") checked="checked" @endif>Before Food
																												</label>
																												<label class="dd_beforfood_pd">
																													<input type="radio"  class="after_food" name="food_status2" value="After Food" @if($prescMedicineDataVal->food_status=="After Food") checked="checked" @endif>After Food
																												</label>
																											</div>
																										</td>
																											<!-- <td><span class="label label-sm label-warning">Expiring</span></td> -->
																									</tr>
																									<tr>
																								</tr>
																								</tbody>
																							</table>
																							@if(!empty($prescMedicineDataVal->instruction))
																							<div id="instruction-div" class="instruction-div dd_instruction1">
																							<textarea class="form-control instruction1" style="width:98%;">{{$prescMedicineDataVal->instruction}}</textarea>
																							 </div>
																							@endif
																							</div>


																							<?php 
																							array_push($prescHeadingStatusArray,1);
																							array_push($followupDateArray,1); ?>
																						@else
																							<?php 
																							array_push($prescHeadingStatusArray,0); 
																							array_push($followupDateArray,0);?>	
																						@endif
																					@endforeach	
																				@endif

																				@if(in_array(1,$prescHeadingStatusArray))

																					<?php
																				  		if(empty($prescMedicineDataVal->follow_up_date) || $prescMedicineDataVal->follow_up_date=="0000-00-00"){
																				  			$followUpDate = '';

																				  			
																				  		}
																				  		else
																				  		{
																				  			$followUpDate = date('d-M-Y',strtotime($prescMedicineDataVal->follow_up_date));
																				  		}
																				  		
																				  		//echo $followUpDate;

																				  	?>

																					<div class="form-group">
																						{!! Form::label('symptoms', 'Follow-up Date', $attributes = array('class'=>"col-sm-2"));  !!}
																						{!! Form::text('start_date1', $followUpDate , $attributes = array('class' => 'col-sm-4')); !!}
																					</div>
																					<div class="form-group">
																						{!! Form::label('symptoms', 'Treatment', $attributes = array('class'=>"col-sm-2"));  !!}
																						{!! Form::textarea('start_date1', $prescMedicineDataVal->treatment , $attributes = array('class' => 'col-sm-4','cols'=>10,'rows'=>5)); !!}
																					</div>
																					
																				@else
																					<h5 class="dd_h5_nodata btn btn-default">No Prescription history data to display</h5>
																				@endif
																				</div>
																			</div>
																			<!-- start: Prescription Accordian PANEL -->
																		</p>
																		
																	</div>
																	<!-- start: Prescription Accordian PANEL -->

																	<!-- Obs History starts -->
																	<div class="tab-pane" id="obstetrics{{$key}}">
																		<p>
																			<!-- Obs History starts -->
																			<div class="panel">
																				<div class=""> <!-- class="panel-body" -->
																				<!-- <h3>Obstetrics History</h3> -->
																				
																					<div class="panel-group accordion-custom accordion-teal" id="accordion_obs">
																						@if(!empty($obsData))
																							@foreach($obsData as $index=>$obsDataVal)

																								@if($originalCreatedDateVal==date('Y-m-d',strtotime($obsDataVal->created_date)))
																								
																									<?php
																										$lastDeliveryDate = $obsDataVal->obs_last_delivery_date;
																										$expectedDeliveryDate = $obsDataVal->obs_expected_delivery_date;

																										if($lastDeliveryDate=="0000-00-00" || empty($lastDeliveryDate)) {
																											$lastDeliveryDate = "";
																										}
																										else{
																											$lastDeliveryDate = $lastDeliveryDate = date('d-M-Y', strtotime($lastDeliveryDate));
																										}

																										if($expectedDeliveryDate=="0000-00-00" || empty($expectedDeliveryDate)) {
																											$expectedDeliveryDate = "";
																										}
																										else{
																											$expectedDeliveryDate = $$expectedDeliveryDate = date('d-M-Y', strtotime($expectedDeliveryDate));
																										}

																											
																										
																										

																									?>
																										<div class="panel panel-default">
																											<div class="panel-heading">
																												<h4 class="panel-title">
																													<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion_obs" href="#collapseObs{{$obsCounter}}">
																														<i class="icon-arrow"></i>
																														Last Delivery Date :  {{$lastDeliveryDate}}
																													</a>
																												</h4>

																											</div>
																											<div id="collapseObs{{$obsCounter}}" class="panel-collapse collapse">
																												<div class="panel-body">
																												 	<div class="col-sm-12 dd_mg_25">
																												 		<div class="form-group form-horizontal row dd_prev_input ">
																															<label class="col-sm-2">Gravida</label>
																															<div class="col-sm-4">
																																{!! Form::text('gravida', $obsDataVal->gravida, $attributes = array('class'=>'form-control','placeholder' => 'Gravida'));  !!}
																															</div>
																															<label class="col-sm-2">Para</label>
																															<div class="col-sm-4">
																																{!! Form::text('para', $obsDataVal->para, $attributes = array('class'=>'form-control','placeholder' => 'Para'));  !!}
																															</div>
																														</div>
																														<div class="form-group form-horizontal row dd_prev_input ">	
																															<label class="col-sm-2">Living</label>
																															<div class="col-sm-4">
																																{!! Form::text('living', $obsDataVal->living, $attributes = array('class'=>'form-control','placeholder' => 'Living'));  !!}
																															</div>
																													
																														
																															<label class="col-sm-2">Married Life</label>
																															<div class="col-sm-4">
																																{!! Form::text('married_life', $obsDataVal->married_life, $attributes = array('class'=>'form-control','placeholder' => 'Married Life'));  !!}
																															</div>
																														</div>
																														<div class="form-group form-horizontal row dd_prev_input ">	
																															<label class="col-sm-2">Blood Group</label>
																															<div class="col-sm-4">
																																{!! Form::text('blood_group', $obsDataVal->husband_blood_group, $attributes = array('class'=>'form-control','placeholder' => 'Blood Group'));  !!}
																															</div>
																														
																														
																															
																															<label class="col-sm-2">Last Delivery Date</label>
																															<div class="col-sm-4">
																																{!! Form::text('last_delivery_date', $lastDeliveryDate, $attributes = array('class'=>'form-control','placeholder' => 'Last Delivery Data'));  !!}
																															</div>
																														</div>
																														<div class="form-group form-horizontal row dd_prev_input ">	
																															<label class="col-sm-2">Expected Delivery Date</label>
																															<div class="col-sm-4">
																																{!! Form::text('expected_delivery_date', $expectedDeliveryDate, $attributes = array('class'=>'form-control','placeholder' => 'Expected Delviery Date'));  !!}
																															</div>
																														
																															<label class="col-sm-2">Gestational Age</label>
																															<div class="col-sm-4">
																																{!! Form::text('gestational_age', null, $attributes = array('class'=>'form-control','placeholder' => 'Gestational Age'));  !!}
																															</div>

																														</div>
																														
																												 	</div>
																												</div>
																											</div>	 	
																										</div>
																										<?php array_push($obsHeadingStatusArray,1); ?>
																								@else
																									<?php array_push($obsHeadingStatusArray,0); ?>
																								@endif
																								<?php $obsCounter++ ; ?>
																							@endforeach	
																						@else
																					
																							<?php array_push($obsHeadingStatusArray,0); ?>	
																					
																						@endif		
																					</div>
																					
																					@if(in_array('1',$obsHeadingStatusArray))
																						
																					@else
																						<h5 class="dd_h5_nodata btn btn-default">No Obstetrics history data to display</h5>
																					@endif	
																					
																				</div>
																			</div>	

																			<!-- Obs History ends -->
																		</p>
																		
																	</div>
																	<!-- Obs History starts -->

																	<div class="tab-pane" id="menstrual{{$key}}">
																		<p>
																			<!-- LMP starts -->

																			<div class="panel">
																				<div class=""> <!-- class="panel-body" -->
																				<!-- <h3>Menstrual History</h3> -->
																					<div class="panel-group accordion-custom accordion-teal" id="accordion_lmp">
																						@if(!empty($obsData))	
																							@foreach($obsData as $index=>$lmpDataVal)
																								@if($originalCreatedDateVal==date('Y-m-d',strtotime($lmpDataVal->created_date)))
																									<div class="panel panel-default">
																										<div class="panel-heading">
																											<h4 class="panel-title">
																											<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion_lmp" href="#collapseLmp{{$lmpCounter}}">
																												<i class="icon-arrow"></i>
																												<?php
																													$lmpDate = $lmpDataVal->obs_lmp_date;
																													if($lmpDate=="0000-00-00" || empty($lmpDate)) {
																														$lmpDate = "";
																													}
																													else{
																														$lmpDate = date('d-M-Y',strtotime($lmpDate));
																													}
																												?>
																												LMP Date : {{$lmpDate   }}
																											</a></h4>
																										</div>
																										<div id="collapseLmp{{$lmpCounter}}" class="panel-collapse collapse">
																											<div class="panel-body">
																												<div class="col-sm-12">
																													<div class="form-group row">
																														<label class="control-label col-sm-3">Flow</label>
																														<div class="col-sm-6">
																															{!! Form::text('lmp_flow', $lmpDataVal->obs_lmp_flow, $attributes = array('class'=>'form-control','placeholder' => 'Flow'));  !!}
																														</div>
																													</div>
																													<div class="form-group row">	
																														<label class="control-label col-sm-3">Dysmenorrhea</label>
																														<div class="col-sm-6">
																																{!! Form::text('dysmenorrhea', $lmpDataVal->obs_lmp_dysmenorrhea, $attributes = array('class'=>'form-control','placeholder' => 'Dysmenorrhea'));  !!}
																															</div>
																													</div>
																													<div class="form-group row">	
																														<label class="control-label col-sm-3">Days</label>
																														<div class="col-sm-6">
																																{!! Form::text('lmp_days', $lmpDataVal->obs_lmp_days, $attributes = array('class'=>'form-control','placeholder' => 'Days'));  !!}
																															</div>
																													</div>
																													<div class="form-group row">	
																														<label class="control-label col-sm-3">Cycle</label>
																														<div class="col-sm-6">
																																{!! Form::text('lmp_cycle', $lmpDataVal->obs_lmp_cycle, $attributes = array('class'=>'form-control','placeholder' => 'Cycle'));  !!}
																														</div>
																													</div>
																													<div class="form-group row">	
																														<label class="control-label col-sm-3">Menstrual Type</label>
																														<div class="col-sm-6">
																																{!! Form::text('menstrual_type', $lmpDataVal->obs_menstrual_type, $attributes = array('class'=>'form-control','placeholder' => 'Menstrual Type'));  !!}
																														</div>
																													</div>	
																												</div>	
																											</div>		
																										</div>
																									</div>
																									<?php array_push($lmpHeadingStatusArray,1); ?>
																								@else
																									<?php array_push($lmpHeadingStatusArray,0); ?>
																								@endif
																								<?php $lmpCounter++; ?>
																							@endforeach
																						@else
																							<?php array_push($lmpHeadingStatusArray,0); ?>		
																						@endif		
																					</div>
																					
																					@if(in_array("1",$lmpHeadingStatusArray))
																					@else
																						<h5 class=" dd_h5_nodata btn btn-default"">No menstrual history to display</h5>
																					@endif
																				</div>
																			</div>		
																			<!-- LMP ends -->
																		</p>
																		
																	</div>
																	<div class="tab-pane" id="pregnancy{{$key}}">
																		<p>
																			Pregnancy
																		</p>
																		
																	</div>
																</div>
																
															</div>
														</div>
													</div>
												
												</p>
												
											</div>
										@endforeach
									</div>	
									
								
									
								</div>
								
							</div>
					
						</div>
					</div>
				</div>
			</div> <!-- Col-sm-12 -->
		</div>	<!-- Row class ends -->
		<?php
			//var_dump($obsData);
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
	 	{!!Html::script('assets/js/previoustreatment.js')!!}
	 	{!!Html::script('assets/plugins/bootstrap-multiselect/js/bootstrap-multiselect.js')!!}

	 	{!!Html::script('assets/plugins/tokenizemultiselect/jquery.tokenize.js')!!}

	 	

	 	


	<script>
		$(document).ready(function() {
			//patientPrevElements.init();
			Main.init();
			

      var defaultYearSelected = $('#year option:selected').val();
      	//alert(defaultYearSelected);

        var defaultYearSelected = $('#year option:selected').val();
      alert(defaultYearSelected);

        $.ajax({
            type: "POST",
            url: "patientprevioustreatmenttest",
            data: 'year='+defaultYearSelected,
            success: function(data) {
              // console.log(data.originalCreatedDateDup);
               //runPrevTreatmentData(data);
               console.log("default");
            },
        });
      //var defaultYearSelected = $('#year option:selected').val();
      $('#year').change(function(){
            var defaultYearSelected = $('#year option:selected').val();
        // alert(defaultYearSelected);

            $.ajax({
                type: "POST",
                url: "showPatientPreviousTreatmentTest",
                data: 'year='+defaultYearSelected,
                success: function(data) {
                  // console.log(data.originalCreatedDateDup);
                   ///runPrevTreatmentData(data);
                   console.log("changed");
                },
            });
        });
   
			$(window).load(function() {
				$(".loader").fadeOut("slow");
				
			});

			$('.quali').multiselect(); //Used class here instead of id
			
			$('.tokenize-sample').tokenize();
			$('.tokenize-disease').tokenize();
			
	 	});
	</script>
@stop	