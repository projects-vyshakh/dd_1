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


if(!empty($prescMedicine)){
	foreach($prescMedicine as $index=>$prescMedicineVal){

	}
}


?>
@section('head')
	{!!Html::style('assets/plugins/datepicker/css/datepicker.css')!!}
    {!!Html::style('assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css')!!}
    {!!Html::style('assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css')!!}
    {!!Html::style('assets/plugins/bootstrap-multiselect/css/bootstrap-multiselect.css')!!}
	{!!Html::style('assets/plugins/select2/select2.css')!!}

	<!-- {!!Html::style('assets/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css')!!} -->
	{!!Html::style('assets/plugins/bootstrap-modal/css/bootstrap-modal.css')!!}
	{!!Html::style('assets/plugins/ajax-loader/src/jquery.mloading.css')!!}
	

	
<style type="text/css">
	
.input-new
{
	width:38px;
	
}

</style>
@stop
@extends('layouts.master', ['specialization'=>$doctorSpecialization,'patientName'=>$patientName])


@section('main')
<div class="loader"></div>
	<div class="page-header">
		<h1>Prescription Medicine <small></small></h1>
	</div>
	<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
						&times;
					</button>
					<h4 class="modal-title">Drug Alert</h4>
				</div>
				<div class="modal-body">
					<p>
						No previous drugs to display
					</p>
				</div>
				<div class="modal-footer">
					<button class="btn btn-default" data-dismiss="modal">
						OK
					</button>
				</div>
			</div>
		</div>
	</div>
	
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
				<div class="modal-footer">
					<button class="btn btn-default printBtnOk" data-dismiss="modal">
						OK
					</button>
				</div>
			</div>
		</div>
	</div>


<!-- sometime later, probably inside your on load event callback -->




	<div class="row">
		<div class="col-md-12">
			<div class="">
				<div class="">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<div class="col-sm-11 dd_relative dd_alert_main">

									<!-- <input type="button" class="btn btn-orange pull-right present-drug-btn dd_Present_mg" value="Load Previous Drugs"> -->
									@if(!empty($prescMedicine))
										<a data-toggle="modal" class="btn btn-orange pull-right present-drug-btn dd_Present_mg" role="button" >Load Previous Drugs</a>
									@else
										<a data-toggle="modal" class="btn btn-orange pull-right present-drug-btn dd_Present_mg" role="button" href="#myModal2">Load Previous Drugs</a>
									@endif	

																		
									<!-- <button class="btn btn-orange pull-right present-drug-btn dd_Present_mg"><i class="fa fa-plus "></i>Load Previous Drugs</button> -->
									<!-- <a href="#myModel3" data-toggle="modal" class="btn btn-primary dd_print pdfopen">
													Print
												</a> -->
												<a class="btn btn-primary dd_print pdfopen">
													Print
												</a>

												<a class="btn btn-purple  share-prescription dd_share">
													Share
												</a>
									<!-- <a href="patientprescprint" class="btn btn-primary">Print</a> -->
									<?php $error = Session::get('error');
							                $success = Session::get('success');
							                Session::forget('error');
							                Session::forget('success');
							                //$success = "d";

						  			?>
						              @if(!empty($error))
						                <div class="alert alert-danger dd_alert  display-none" style="display: block;">
						                  <a class="close" aria-hidden="true" href="#" data-dismiss="alert">×</a>
						                          {{$error}}
						                </div>
						              @elseif(!empty($success))
						                <div class="alert alert-success dd_alert   display-none" style="display: block;">
						                  <a class="close" aria-hidden="true" href="#" data-dismiss="alert">×</a>
						                          {{$success}}
						                </div>
						              @endif
								</div>
							</div>
						</div>
					</div>		
				</div>
			</div>
			<!-- end: FORM VALIDATION 2 PANEL -->
		</div>
	</div>
	<!-- end: PAGE CONTENT-->
	

	@if(!empty($success))
		<div class="panel">
			<div class="panel-body">
				{!! Form::open(array('route' => 'addPatientPrescMedicine', 'role'=>'form', 'id'=>'addPatientPrescMedicine', 'class'=>'form-horizontal addPatientPrescMedicine','novalidate'=>'novalidate')) !!}
					{!! Form::hidden('print-data', 'saveTrue', $attributes = array('class'=>'form-control print-data')); !!}

					{!! Form::hidden('prev-drug-count', 0, $attributes = array('class'=>'form-control prev-drug-count')); !!}

					{!! Form::hidden('prev-drug-load-status', 0, $attributes = array('class'=>'form-control prev-drug-load-status')); !!}

					{!! Form::hidden('default-div-count', 1, $attributes = array('class'=>'form-control default-div-count')); !!}

					{!! Form::hidden('print-save-status', 0, $attributes = array('class'=>'form-control print-save-status')); !!}

					{!! Form::hidden('extra-presc-count', 0, $attributes = array('class'=>'form-control extra-presc-count')); !!}

					{!! Form::hidden('success-status', !empty($success)?$success : '', $attributes = array('class'=>'form-control success-status','title'=>'s')); !!}

					<!-- To check given prescription details is saved or not, clicking print btn after save n showing pdf and again click print,then needs to say already saved. By default it is 0 and clicking add more it becomes 1 -->
					<!-- {!! Form::text('prescdata-saved-status', 0, $attributes = array('class'=>'form-control prescdata-saved-status')); !!} -->
					<div class="row">
						<div class="col-md-12">
							<div class="">
								<div class="dd_panel_presc">
									<div class="table-responsive presc-medicine">
										@if(!empty($prescMedicine))
											@foreach($prescMedicine as $index=>$prescMedicineVal)
												<?php $index = $index+1; ?>
												<div class="presc-inner contaner dd_border_table">
													<table class="table table-bordered  presc-table" id="sample-table-1">
														<thead>
															<tr class="drugs_row_hd" >
																<th width="16%">Drug Name</th>
																<th width="30%">Strength</th>
																<th width="18%" >Duration</th>
																<th width="1%">Morning</th>
																<th width="1%">Noon </th>
																<th width="29%">Night</th>
																<th width="9%"></th>
															</tr>
														</thead>
														<tbody>
															<tr class="drugs_row">
																<td class="dd_presc_medicin">
																	{!! Form::text('drug_name'.$index,(!empty($prescMedicineVal->drug_name))?$prescMedicineVal->drug_name:Input::old('drug_name'.$index), $attributes = array('class'=>'dd_input_mini drug_name','id'=>'drug_name'.$index));  !!}
																</td>
																<td>
																    <div class="dd_dosage1_text">
																    	{!! Form::text('dosage'.$index, (!empty($prescMedicineVal->dosage))?$prescMedicineVal->dosage:Input::old('dosage'.$index), $attributes = array('class'=>'input-mini ng-pristine ng-valid'));  !!}

																    	{!! Form::select('dosage_unit'.$index, $dosageUnit,(!empty($prescMedicineVal->dosage_unit))?$prescMedicineVal->dosage_unit:Input::old('dosage_unit'.$index), $attributes = array('class'=>''));  !!}
																	</div>
																</td>
																<td>
																	<div class="dd_dosage1_text">
																		{!! Form::text('duration'.$index, (!empty($prescMedicineVal->duration))?$prescMedicineVal->duration:Input::old('duration'.$index), $attributes = array('class'=>'input-mini ng-pristine ng-valid'));  !!}
																			
																		{!! Form::select('duration_unit'.$index, $drugDurationUnit,(!empty($prescMedicineVal->duration_unit))?$prescMedicineVal->duration_unit:Input::old('duration_unit'.$index), $attributes = array('class'=>''));  !!}
																	</div>
																</td>
																<td>
																	{!! Form::text('morning'.$index, (!empty($prescMedicineVal->morning))?$prescMedicineVal->morning:Input::old('morning'.$index), $attributes = array('class'=>'col-sm-10 morning'));  !!}
																</td>
																<td>
																	{!! Form::text('noon'.$index, (!empty($prescMedicineVal->noon))?$prescMedicineVal->noon:Input::old('noon'.$index), $attributes = array('class'=>'col-sm-10 noon'));  !!}
																</td>
																<td>
																	{!! Form::text('night'.$index, (!empty($prescMedicineVal->night))?$prescMedicineVal->night:Input::old('night'.$index), $attributes = array('class'=>'col-sm-10 night'));  !!}
																</td>
																<td></td>
															</tr>
															<tr class="drugs_row dd_relative">
																<!-- <td class="dd_presc_medicin"></td> -->
																<td colspan="1" >
																	<input type="button" class="btn btn-default dd_instruction  btn-xs add-instruction-btn" id="add-instruction-btn<?php echo $index; ?>" value="+ Add Instruction" onclick="return addInstruction(this);"/>

																	<input type="button" class="btn btn-default dd_dosage1_text dd_instruction  btn-xs remove-instruction-btn" id="remove-instruction-btn<?php echo $index; ?>" value="- Remove Instruction" style="display:none" onclick="return removeInstruction(this);"/>
																	<!-- <div class="instruction-div1"></div> -->
																	
																</td>
																<td colspan="2" style="vertical-align: top;" >	
																	<div class="dd_dosage1_text_3 dd_Date pull-left">Start Date	</div>	
																	<div class="dd_dosage1_text_2 pull-left">
																	  		<span class="dd_instruction"> 
																				{!! Form::text('start_date'.$index, (!empty($prescMedicineVal->start_date) && ($prescMedicineVal->start_date)!="0000-00-00")?$prescMedicineVal->start_date:Input::old('start_date'.$index) , $attributes = array('class' => 'form-control  start_date', 'data-date-viewmode'=>'years','data-date-format'=>'dd-mm-yyyy')); !!}
																			</span>
																		
																	</div>
																</td>
																
																<td colspan="2" class="dd_relative" style="vertical-align: top;">
																    <div class="dd_beforfood">
																    <?php 
																    	if(($prescMedicineVal->food_status)=="Before Food"){
																    ?>
																		<label class="dd_beforfood_pd" >
																			<input type="radio"  class="before_food" name="food_status<?php echo $index; ?>" value="Before Food" checked="checked"  >Before Food
																		</label>
																	<?php
																		}
																		else{
																	?>
																			<label class="dd_beforfood_pd" >
																				<input type="radio"  class="before_food" name="food_status<?php echo $index; ?>"value="Before Food"   >Before Food
																			</label>
																	<?php } ?>
																	<?php 
																    	if(($prescMedicineVal->food_status)=="After Food"){
																    ?>
																			<label class="dd_beforfood_pd">
																				<input type="radio"  class="after_food" name="food_status<?php echo $index; ?>" value="After Food" checked="checked" >After Food
																			</label>
																	<?php 
																		}
																		else{
																	?>	
																			<label class="dd_beforfood_pd">
																				<input type="radio"  class="after_food" name="food_status<?php echo $index; ?>" value="After Food"  >After Food
																			</label>
																	<?php	} ?>

																	</div>
																</td>
															</tr>
															
															@if(!empty($prescMedicineVal->instruction))
															
																<tr>
																	<td colspan="40">
																		<div class="instruction-div1" id="instruction-div">
																			<textarea style="width: 100px" class="form-control instruction" name="instruction<?php echo $index; ?>" id="instruction<?php echo $index; ?>"  >{{$prescMedicineVal->instruction}}</textarea>
																		</div>
																	</td>
																</tr>
															@else
																<tr></tr>
															@endif
														</tbody>
													</table>
												</div>
											@endforeach
										@endif
									</div>

									<div class="form-group dd_menarche_4">
										<div class="col-sm-4  dd_praji_followup dd_folloup_mg">
											{!! Form::label('follow_up_date', 'Follow-up date', $attributes = array('class'=>"col-sm-4 dd_padding_follw "));  !!}
											{!! Form::text('follow_up_date', null , $attributes = array('class' => 'form-control date-picker follow_up_date dd_praji_followup ', 'data-date-viewmode'=>'years','data-date-format'=>'dd-mm-yyyy')); !!}
										</div>
										<div class="col-sm-8" >
											<input type="button" class="btn btn-default presc-add-more  pull-right dd_addmore_0 "  value="+ Add More Drug">
										</div>
									</div>
									<hr style="margin-top:30px; margin-bottom:20px;">
										<div class="form-group">
											{!! Form::label('treatment', 'Treatment', $attributes = array('class'=>"col-sm-12  "));  !!}
											<div class="col-sm-12">
												{!! Form::textarea('treatment',(!empty($prescMedicineVal->treatment))?$prescMedicineVal->treatment:Input::old('treatment'),['class'=>'form-control treament ', 'rows' => 4, 'cols' =>40 ]) !!}
											</div>
										</div>
									<hr style="margin-top:30px;">
										<div class="">
											<div class="form-group">
												<div class="col-sm-12">
													<button type="submit" class="btn btn-primary presc-save dd_btn_center"><i class="fa fa-floppy-o dd_pres_save_icon" aria-hidden="true"></i>Save</button>
													<!-- <input type="submit" class="btn btn-primary presc-save dd_btn_center" value="Save"> -->
												</div>
											</div>
										</div>
								</div>
							</div>
						</div>
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	@else
		<div class="panel">
			<div class="panel-body">
				{!! Form::open(array('route' => 'addPatientPrescMedicine', 'role'=>'form', 'id'=>'addPatientPrescMedicine', 'class'=>'form-horizontal addPatientPrescMedicine','novalidate'=>'novalidate')) !!}

					{!! Form::hidden('print-data', 'saveTrue', $attributes = array('class'=>'form-control print-data')); !!}

					{!! Form::hidden('prev-drug-count', 0, $attributes = array('class'=>'form-control prev-drug-count')); !!}

					{!! Form::hidden('prev-drug-load-status', 0, $attributes = array('class'=>'form-control prev-drug-load-status')); !!}

					{!! Form::hidden('default-div-count', 1, $attributes = array('class'=>'form-control default-div-count')); !!}

					{!! Form::hidden('print-save-status', 0, $attributes = array('class'=>'form-control print-save-status')); !!}

					{!! Form::hidden('extra-presc-count', 0, $attributes = array('class'=>'form-control extra-presc-count')); !!}

					{!! Form::hidden('success-status', !empty($success)?$success : '', $attributes = array('class'=>'form-control success-status','title'=>'s')); !!}
					
					<!-- To check given prescription details is saved or not, clicking print btn after save n showing pdf and again click print,then needs to say already saved. By default it is 0 and clicking add more it becomes 1 -->
					<!-- {!! Form::text('prescdata-saved-status', 0, $attributes = array('class'=>'form-control prescdata-saved-status')); !!} -->
					<div class="row">
						<div class="col-md-12">
							<div class="">
								<div class="dd_panel_presc">
									<div class="table-responsive presc-medicine">
										<div class="presc-inner contaner dd_border_table">
											<table class="table table-bordered  presc-table" id="sample-table-1">
												<thead>
													<tr class="drugs_row_hd" >
														<th width="16%">Drug Name</th>
														<th width="30%">Strength</th>
														<th width="18%" >Duration</th>
														<th width="1%">Morning</th>
														<th width="1%">Noon </th>
														<th width="29%">Night</th>
														<th width="9%"></th>
													</tr>
												</thead>
												<tbody>
													<tr class="drugs_row">
														<td class="dd_presc_medicin">
															{!! Form::text('drug_name1',Input::old('drug_name1'), $attributes = array('class'=>'dd_input_mini drug_name','id'=>'drug_name1'));  !!}
														</td>
														<td>
														    <div class="dd_dosage1_text">
														    	{!! Form::text('dosage1', Input::old('dosage1'), $attributes = array('class'=>'input-mini ng-pristine ng-valid'));  !!}

														    	{!! Form::select('dosage_unit', $dosageUnit,Input::old('dosage_unit1'), $attributes = array('class'=>''));  !!}
															</div>
														</td>
														<td>
															<div class="dd_dosage1_text">
																{!! Form::text('duration1', Input::old('duration1'), $attributes = array('class'=>'input-mini ng-pristine ng-valid'));  !!}
																	
																{!! Form::select('duration_unit1', $drugDurationUnit,Input::old('duration_unit1'), $attributes = array('class'=>''));  !!}
															</div>
														</td>
														<td>
															{!! Form::text('morning1', Input::old('morning1'), $attributes = array('class'=>'col-sm-10 morning'));  !!}
														</td>
														<td>
															{!! Form::text('noon', Input::old('noon1'), $attributes = array('class'=>'col-sm-10 noon'));  !!}
														</td>
														<td>
															{!! Form::text('night', Input::old('night1'), $attributes = array('class'=>'col-sm-10 night'));  !!}
														</td>
														<td></td>
													</tr>
													<tr class="drugs_row dd_relative">
														<!-- <td class="dd_presc_medicin"></td> -->
														<td colspan="1" >
															<input type="button" class="btn btn-default dd_instruction  btn-xs add-instruction-btn" id="add-instruction-btn1" value="+ Add Instruction" onclick="return addInstruction(this);" />

															<input type="button" class="btn btn-default dd_dosage1_text dd_instruction  btn-xs remove-instruction-btn" id="remove-instruction-btn1" value="- Remove Instruction" style="display:none" onclick="return removeInstruction(this);"/>
															<!-- <div class="instruction-div1"></div> -->
															
														</td>
														<td colspan="2" style="vertical-align: top;" >	
															<div class="dd_dosage1_text_3 dd_Date pull-left">Start Date	</div>	
															<div class="dd_dosage1_text_2 pull-left">
															  		<span class="dd_instruction"> 
																		{!! Form::text('start_date1', Input::old('start_date1') , $attributes = array('class' => 'form-control  start_date', 'data-date-viewmode'=>'years','data-date-format'=>'dd-mm-yyyy')); !!}
																	</span>
																
															</div>
														</td>
														
														<td colspan="2" class="dd_relative" style="vertical-align: top;">
														    <div class="dd_beforfood">
														    
																	<label class="dd_beforfood_pd" >
																		<input type="radio"  class="before_food" name="food_status1"value="Before Food"   >Before Food
																	</label>
																
																	<label class="dd_beforfood_pd">
																		<input type="radio"  class="after_food" name="food_status1" value="After Food"  >After Food
																	</label>
															</div>
														</td>
													</tr>
													
													<tr>
														<td colspan="40">
															
																
															</div>
														</td>
													</tr>
													
												</tbody>
											</table>
										</div>
									</div>
									<div class="form-group dd_menarche_4">
										<div class="col-sm-4  dd_praji_followup dd_folloup_mg">
											{!! Form::label('follow_up_date', 'Follow-up date', $attributes = array('class'=>"col-sm-4 dd_padding_follw "));  !!}
											{!! Form::text('follow_up_date', null , $attributes = array('class' => 'form-control date-picker follow_up_date dd_praji_followup ', 'data-date-viewmode'=>'years','data-date-format'=>'dd-mm-yyyy')); !!}
										</div>
										<div class="col-sm-8" >
											<input type="button" class="btn btn-default presc-add-more  pull-right dd_addmore_0 "  value="+ Add More Drug">
										</div>
									</div>
									<hr style="margin-top:30px; margin-bottom:20px;">
										<div class="form-group">
											{!! Form::label('treatment', 'Treatment', $attributes = array('class'=>"col-sm-12  "));  !!}
											<div class="col-sm-12">
												{!! Form::textarea('treatment',null,['class'=>'form-control treament ', 'rows' => 4, 'cols' =>40 ]) !!}
											</div>
										</div>
									<hr style="margin-top:30px;">
										<div class="">
											<div class="form-group">
												<div class="col-sm-12">
													<button type="submit" class="btn btn-primary presc-save dd_btn_center"><!-- <i class="fa fa-floppy-o dd_pres_save_icon" aria-hidden="true"></i> -->Save</button>
													<!-- <input type="submit" class="btn btn-primary presc-save dd_btn_center" value="Save"> -->
												</div>
											</div>
										</div>
								</div>
							</div>
						</div>
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	@endif



	

	

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
		<!-- {!!Html::script('assets/js/prescriptionmedicine.js')!!} -->
		{!!Html::script('assets/plugins/bootstrap-multiselect/js/bootstrap-multiselect.js')!!}

		{!!Html::script('assets/plugins/bootstrap-modal/js/bootstrap-modal.js')!!}
		{!!Html::script('assets/plugins/bootstrap-modal/js/bootstrap-modalmanager.js')!!}
		{!!Html::script('assets/js/ui-modals.js')!!}
		{!!Html::script('assets/plugins/bootbox/bootbox.min.js')!!}

		{!!Html::script('assets/plugins/tooltip-validation/jquery-validate.bootstrap-tooltip.js')!!}
		{!!Html::script('assets/plugins/ajax-loader/src/jquery.mloading.js')!!}
		

	<script>
		$(document).ready(function() {

			Main.init();
			patientElements.init(dosageUnit);
			UIModals.init();
			//patientPrescMedicine.init();


			$('body').on('focus',".date-picker", function(){
					$(this).datepicker();
   			});

   			var dosageUnit 				= <?php echo json_encode($dosageUnit); ?>;
			var durationUnit 			= <?php echo json_encode($drugDurationUnit); ?>;
         	var prescMedicine   		= <?php echo json_encode($prescMedicine); ?>;
			var prescMedicineDetails  	= <?php echo json_encode($prescMedicine); ?>;
			var success 				= $('.success-status').val();/*<?php //echo json_encode($success); ?>;*/
			
			//alert(success);	
			$('.pdfopen').attr('disabled','disabled');
			if(success== null || success==''){
				$('.pdfopen').attr('disabled','disabled');
				$('.share-prescription').attr('disabled','disabled');
				//alert('success null');
			}
			else{
				//alert('success not null');
				for(var i=1;i<=prescMedicineDetails.length;i++){
					var instructionText = prescMedicineDetails[i-1].treatment;
					if(instructionText!=""){
						$('#add-instruction-btn'+i).hide();
						$('#remove-instruction-btn'+i).show();
					}

					$('.default-div-count').val(i);
				}
				$('.pdfopen').attr('disabled',false);
				$('.share-prescription').attr('disabled',false);
				
			}
			

			



			//Printing
			//-------------------------------------------------------------------
			$('.pdfopen').click(function(){
				var loadDrugStatus = $('.prev-drug-load-status').val();
				$('.print-data').val('printTrue');
				if(success==null){
					//Previous drug loaded
					if(loadDrugStatus==1){
						var defaultCount = $('.default-div-count').val();
						if(defaultCount>prescMedicineDetails.length){
							
							printWithSaveConfirmations();
						}
						else{
							printWithoutSaveConfirmations();
						}
					}
					else{
						printWithSaveConfirmations();
					}
					
				}
				else{
					//alert("sucess not null and prints")
					var defaultCount = $('.default-div-count').val();
					console.log(defaultCount);
					console.log(prescMedicineDetails.length);
					if(defaultCount>prescMedicineDetails.length){
						
						printWithSaveConfirmations();
					}
					else{
						printWithoutSaveConfirmations();
					}
				}
           	});
			//Printing ends here
			//-----------------------------------------------------------------



			function printWithoutSaveConfirmations(){
				//Storing drug name into arrNumber array to find the empty array
			    var arrNumber = new Array();
				$('.drug_name').each(function(){
				    arrNumber.push($(this).val());
				})
				
				//Searching null value in array
				if ($.inArray('', arrNumber) != -1)
				{
				  	//alert('Please fill the empty drug name')
					bootbox.dialog({
						message		: "Please fill the empty fields",
						title 		: "Warning",
						buttons 	: 
						{
							success : 
							{
								label 		: "Ok",
								className	: "btn-success",
								callback 	: function() 
								{
								}
							}
						}
					});
				}
				else{
					var dataString = $( ".addPatientPrescMedicine" ).serializeArray();
					//console.log(dataString);
					$("body").mLoading({ });
					$.ajax({
		                    type: "POST",
		                    url: "addPatientPrescMedicine",
		                    data: dataString,
		                    success: function(data) {
		                    	if(data!=""){
		                    		//console.log(data);
		                    		//location.href = "patientprescmedicine";
		                    		if(data!=""){
		                    			$('.success-status').val('Data saved successfully');
		                    		}
		                    		
		                    		$("body").mLoading('hide');
		                    		$('#myModal3').modal('show');
			                    		
			                    		$('iframe').remove();
			                    		$('.pdf_print').append('<iframe src="storage/pdf/'+data.pdfFileName+'.pdf" style="width:780px;height:500px;" id="iFrame"></iframe>');
			                    		$('.print-data').val('saveTrue');

			                    	//Refreshing the iframe and showing latest data
		                    		/*var currSrc = $("#iFrame").attr("src");
									$("#iFrame").attr("src", currSrc);*/

		                    		
				                }

								$('.printBtnOk,.close').click(function(){
									//location.href = "patientprescmedicine";
								})
		                    	
		                 	
		                    },
			        });
				}
			}



			function printWithSaveConfirmations(){
				
					bootbox.dialog({
							message		: "Please save the data before print. Are you sure you want to save?",
							title 		: "Prescription Details",
							buttons 	: 
							{
								success : 
								{
									label 		: "Yes",
									className	: "btn-success",
									callback 	: function() 
									{
										//Storing drug name into arrNumber array to find the empty array
									    var arrNumber = new Array();
										$('.drug_name').each(function(){
										    arrNumber.push($(this).val());
										})
										
										//Searching null value in array
										if ($.inArray('', arrNumber) != -1)
										{
										  	//alert('Please fill the empty drug name')
											bootbox.dialog({
												message		: "Please fill the empty fields",
												title 		: "Warning",
												buttons 	: 
												{
													success : 
													{
														label 		: "Ok",
														className	: "btn-success",
														callback 	: function() 
														{
														}
													}
												}
											});
										}
										else{
											var dataString = $( ".addPatientPrescMedicine" ).serializeArray();
											console.log(dataString);
											$("body").mLoading({ });
											$.ajax({
								                    type: "POST",
								                    url: "addPatientPrescMedicine",
								                    data: dataString,
								                    success: function(data) {
								                    	if(data!=""){
								                    		console.log(data);
								                    		//location.href = "patientprescmedicine";
								                    		if(data!=""){
								                    			$('.success-status').val('Data saved successfully');
								                    		}

								                    		


								                    		$("body").mLoading('hide');
								                    		$('#myModal3').modal('show');
									                    		
									                    		$('iframe').remove();
									                    		$('.pdf_print').append('<iframe src="storage/pdf/'+data.pdfFileName+'.pdf" style="width:780px;height:500px;" id="iFrame"></iframe>');
									                    		$('.print-data').val('saveTrue');
									                    	//Refreshing the iframe and showing latest data
								                    		/*var currSrc = $("#iFrame").attr("src");
															$("#iFrame").attr("src", currSrc);*/

								                    		
										                }

														$('.printBtnOk,.close').click(function(){
															//location.href = "patientprescmedicine";
														})
								                    	
								                 	
								                    },
									        });
										}
									        	
									}
								},
							    danger: {
							      label: "No",
							      className: "btn-danger",
							      callback: function() {
							        		
							      }
							    },
									    
							}
						});
			}
			
			

			
			//Share Prescription
			$('.share-prescription').click(function(e){
				e.preventDefault();
				var arrNumber = new Array();
					$('.drug_name').each(function(){
				    arrNumber.push($(this).val());
				});

				//alert(arrNumber)
			})



			//Share ends
			

         

			
			//Add more drugs
			
			$('.presc-add-more').click(function(e){
             	counter = $('.default-div-count').val();

             	$('.pdfopen').attr('disabled','disabled');
             	$('.share-prescription').attr('disabled','disabled');

             	$('.success-status').val('');
             	
             	//$('.prescdata-saved-status').val(0); //setting 0 because needs save confirmation before print
             	
             	counter++;
             	
            	e.preventDefault();
            	var clickStatus = "add";
            	
		           //addDrugs(counter,dosageUnit,durationUnit,clickStatus);
            	addOrLoadDrugs(counter,dosageUnit,durationUnit,clickStatus);
			});
			
			
	   		$('.present-drug-btn').click(function(e){

	   			$('.pdfopen').attr('disabled',false);
             		$('.share-prescription').attr('disabled',false);
	   			
	   				var defaultDivCount = $('.default-div-count').val();

	   			 $('.prev-drug-load-status').val(1);

	   			//alert("default Count--"+defaultDivCount);
	   			var clickStatus = "loadDrug";
	   			
	   			//console.log(prescMedicine);
	   			if(prescMedicine!=''){
	   					for(i=1;i<=defaultDivCount;i++){
		   				var drugElement = $('#drug_name'+i);
		   				//alert(drugElement.length);
		   				//console.log(drugElement);
		   				var tableElement = drugElement.closest('.presc-inner');
		   				if(i>=1){
		   					tableElement.remove();	
		   				}
		   				
		   				var newDefaultCount = defaultDivCount - parseInt(i);
		   				if(newDefaultCount==0){
		   					$('.default-div-count').val(1);
		   				}
		   				
		   			   
		   				
		   			}
	   			}
	   			else{
	   				//bootbox.alert("No previous drugs to load"); 
	   				//$('#myModal2').modal('show');
	   				}
	   			

	   			var counter = <?php echo json_encode(count($prescMedicine)); ?>;
        		
	   				addOrLoadDrugs(counter,dosageUnit,durationUnit,clickStatus,prescMedicine);
	   			
	   			
	   			//Adding previous drug details
	   			//--------------------------------------------------------------------------------


	   			var defaultDivCount = $('.default-div-count').val();
	   			
	   			$('.prev-drug-count').val(defaultDivCount); //this is for knowing in case of print
	   			
	  			/*$('#loadDrugDiv').show();
				$('#loadDrugDiv').find('input, textarea, button, select').attr('disabled',false);

				
				$('#singleDrugTable').remove();

				var tableCount = $('.presc-medicine').find('.presc-table').length;
        		var defaultTableCount = $('.default-div-count').val(tableCount);*/

	   		})
			
   			
					
	   		$('.morning').tooltip({'trigger':'focus', 'title': 'Morning medicine count'});
				$('.noon').tooltip({'trigger':'focus', 'title': 'Noon medicine count'}); 
				$('.night').tooltip({'trigger':'focus', 'title': 'Night medicine count'}); 
									
		                                       
		 });


		function addOrLoadDrugs(counter,dosageUnit,durationUnit,clickStatus,prescMedicine){

			var extraPrescCounter = $('.extra-presc-count').val();
			extraPrescCounter = parseInt(extraPrescCounter) + 1;
			$('.extra-presc-count').val(extraPrescCounter);
			//alert(extraPrescCounter);
			//alert(clickStatus)
			if(clickStatus=="add"){
					$('.presc-medicine').append('<div class="presc-inner contaner dd_border_table">'+
						'<table class="table table-bordered  presc-table" id="sample-table-1">'+
		                                        '<thead>'+
		                                            '<tr class="drugs_row_hd" >'+
		                                                '<th width="16%">Drug Name</th>'+
		                                                '<th width="30%">Strength</th>'+
		                                                '<th width="18%">Duration</th>'+
		                                                '<th width="1%">Morning</th>'+
		                                                '<th width="1%">Noon </th>'+
		                                                '<th width="29%">Night</th>'+
		                                                '<th width="9%"></th>'+

		                                            '</tr>'+
		                                        '</thead>'+
		                                        '<tbody>'+
		                                            
		                                                '<tr class="drugs_row">'+
		                                                    '<td class="dd_presc_medicin">'+
		                                                        '<input type="text" name="drug_name'+counter+'" class="dd_input_mini drug_name" id="drug_name'+counter+'">'+
		                                                    '</td>'+
		                                                    '<td>'+
		                                                        '<div class="dd_dosage1_text">'+
		                                                             '<input type="text" name="dosage'+counter+'" class="input-mini ng-pristine ng-valid dosage" id="dosage'+counter+'">'+
		                              									'<select class="dosage_unit" name="dosage_unit'+counter+'" id="dosage_unit'+counter+'">'+
																	 '</select>'+
		                                                                                         
		                                                        '</div>'+
		                                                    '</td>'+
		                                                    '<td >'+
																'<div class="dd_dosage1_text">'+
																	'<input type="text" name="duration'+counter+'" class="input-mini ng-pristine ng-valid duration" id="duration'+counter+'" >'+
																	'<select class="duration_unit" name="duration_unit'+counter+'" id="duration_unit'+counter+'">'+
																	 '</select>'+
																		
																	
																'</div>'+
															'</td>'+
															'<td>'+
																'<input type="text" name="morning'+counter+'" class="col-sm-8 morning" id="morning'+counter+'"  >'+
															'</td>'+
															'<td>'+
																'<input type="text" name="noon'+counter+'" class="col-sm-8 noon" id="noon'+counter+'"  >'+
															'</td>'+
															'<td>'+
																'<input type="text" name="night'+counter+'" class="col-sm-8 night" id="night'+counter+'" >'+
															'</td>'+
															'<td>'+
																
																'<input type="button" id="drugmore-remove'+counter+'" onclick="return drugRemove(this);" name="drugmore-remove" class=" dd_X_btn btn btn-bricky pull-right drugmore-remove" value="X" ' +
																
															'</td>'+
										
		                                                '</tr>'+
														'<tr class="drugs_row dd_relative">'+
															
															'<td colspan="1" >'+
															/*'<input type="button" class="btn btn-default dd_dosage1_text dd_instruction  btn-xs add-instruction-btn" id="add-instruction-btn" value="+ Add instruction" />'+
																*/

																'<input type="button" onclick="return addInstruction(this);" name="add-instruction-btn" class="btn btn-default  dd_instruction  btn-xs add-instruction-btn" value="+ Add Instruction" >' +
																'<input type="button" onclick="return removeInstruction(this);" name="remove-instruction-btn" class="btn btn-default dd_dosage1_text dd_instruction  btn-xs remove-instruction-btn" value="- Remove Instruction" style="display:none" >' +
																
																
															'</td>'+
															'<td colspan="2" style="vertical-align: top;" >'+
															'<div class="dd_dosage1_text_3 dd_Date pull-left">Start Date</div>'+		
																'<div class="dd_dosage1_text_2 pull-left">'+
																  						  	
																		'<span class="dd_instruction"> '+
																			'<input type="text" name="start_date'+counter+'" class="form-control date-picker start_date" id="start_date'+counter+'" data-date-format="dd-mm-yyyy">'+
																		'</span>'+
																	
																'</div>'+
															'</td>'+
															/*'<td></td>'+*/	
															'<td colspan="2" class="dd_relative" style="vertical-align: top;">'+
															    '<div class="dd_beforfood ">'+
																	'<label class="dd_beforfood_pd" >'+
																		'<input type="radio" class="before_food food_status" id="food_status_before'+counter+'" name="food_status'+counter+'" value="Before Food">Before Food'+
																	'</label>'+
																	'<label class="dd_beforfood_pd">'+
																		'<input type="radio" class="after_food food_status" id="food_status_after'+counter+'" name="food_status'+counter+'" value="After Food">After Food'+
																	'</label>'+
																'</div>'+
															'</td>'+
																
														'</tr>'+
														'<tr>'+
															
																
															
														'</tr>'+

		                                        '</tbody>' +
		                                        '</table>'+
		                                        '<div class="instruction-div" >'+
		                                        	
												'</div>'+
		                                        '</div>'

		                                        );

		           	
		           	for(dosageUnitVal in dosageUnit){
						$('#dosage_unit'+counter).append('<option value='+dosageUnitVal+'>'+dosageUnit[dosageUnitVal]+'</option>');
					}
					for(durationUnitVal in durationUnit){
						$('#duration_unit'+counter).append('<option value='+durationUnitVal+'>'+durationUnit[durationUnitVal]+'</option>');
					}

					if(counter==1){
						$('#drugmore-remove'+counter).remove();
						
					}

					$('.default-div-count').val(counter++);
					extraPrescCounter = parseInt(extraPrescCounter) + 1;
					$('.extra-presc-count').val();
					//alert(extraPrescCounter)
					/*Tooltip*/

					$('.morning').tooltip({'trigger':'focus', 'title': 'Morning medicine count'});
					$('.noon').tooltip({'trigger':'focus', 'title': 'Noon medicine count'}); 
					$('.night').tooltip({'trigger':'focus', 'title': 'Night medicine count'}); 

			}
			else{
				

				for(i=1;i<=counter;i++){

					var drugName 			= prescMedicine[i-1].drug_name;
					var dosage   			= prescMedicine[i-1].dosage;
					var dosageUnitDefault 	= prescMedicine[i-1].dosage_unit;
					var duration 			= prescMedicine[i-1].duration;
					var durationUnitDefault = prescMedicine[i-1].duration_unit;
					var morning 			= prescMedicine[i-1].morning;
					var noon 				= prescMedicine[i-1].noon;
					var night 				= prescMedicine[i-1].night;
					var instruction 		= prescMedicine[i-1].instruction;
					var startDate 			= prescMedicine[i-1].start_date;
					var followUpDate 		= prescMedicine[i-1].follow_up_date;
					var prescSharedId       = prescMedicine[i-1].id_share_prescription;



					if(startDate=='' || startDate=='0000-00-00'){
						startDate = '';
					}
					else{
						startDate = startDate.split('-');
						var year = startDate[0];
						var month = startDate[1];
						var day = startDate[2];

						startDate = day+'-'+month+'-'+year;
					}

					if(followUpDate=='' || followUpDate=='0000-00-00'){
						followUpDate = '';
					}
					else{
						followUpDate 	= followUpDate.split('-');
						var year 		= followUpDate[0];
						var month 		= followUpDate[1];
						var day 		= followUpDate[2];

						followUpDate 		= day+'-'+month+'-'+year;

					}

					var foodStatus = prescMedicine[i-1].food_status;
					
					//console.log(drugName);
					
					//console.log(startDate);


						$('.presc-medicine').append('<div class="presc-inner contaner dd_border_table">'+
							'<table class="table table-bordered  presc-table" id="sample-table-1">'+
		                                        '<thead>'+
		                                            '<tr class="drugs_row_hd" >'+
		                                                '<th width="16%">Drug Name</th>'+
		                                                '<th width="30%">Strength</th>'+
		                                                '<th width="18%">Duration</th>'+
		                                                '<th width="1%">Morning</th>'+
		                                                '<th width="1%">Noon </th>'+
		                                                '<th width="29%">Night</th>'+
		                                                 '<th width="9%"></th>'+
		                                            '</tr>'+
		                                        '</thead>'+
		                                        '<tbody>'+
		                                            	
		                                                '<tr class="drugs_row">'+
		                                                    '<td class="dd_presc_medicin">'+
		                                                        '<input type="text" name="drug_name'+i+'" class="dd_input_mini drug_name" id="drug_name'+i+'" value="'+drugName+'">'+
		                                                    '</td>'+
		                                                    '<td>'+
		                                                        '<div class="dd_dosage1_text">'+
		                                                             '<input type="text" name="dosage'+i+'" class="input-mini ng-pristine ng-valid dosage" id="dosage'+i+'" value='+dosage+'>'+
		                              									'<select class="dosage_unit" name="dosage_unit'+i+'" id="dosage_unit'+i+'">'+
		                              									'<option value='+dosageUnitDefault+'>'+dosageUnitDefault+'</option>'+
																	 '</select>'+
		                                                                                         
		                                                        '</div>'+
		                                                    '</td>'+
		                                                    '<td >'+
																'<div class="dd_dosage1_text">'+
																	'<input type="text" name="duration'+i+'" class="input-mini ng-pristine ng-valid duration" id="duration'+i+'" value='+duration+'>'+
																	'<select class="duration_unit" name="duration_unit'+i+'" id="duration_unit'+i+'">'+
																		'<option value='+durationUnitDefault+'>'+durationUnitDefault+'</option>'+
																	 '</select>'+
																		
																	
																'</div>'+
															'</td>'+
															'<td>'+
																'<input type="text" name="morning'+i+'" class="col-sm-8 morning"  id="morning'+i+'" value='+morning+'>'+
															'</td>'+
															'<td>'+
																'<input type="text" name="noon'+i+'" class="col-sm-8 noon"  id="noon'+i+'" value='+noon+'>'+
															'</td>'+
															'<td>'+
																'<input type="text" name="night'+i+'" class="col-sm-8 night" id="night'+i+'" value='+night+'>'+
															'</td>'+
															'<td>'+
																'<input type="button" id="drugmore-remove'+i+'" onclick="return drugRemove(this);" name="drugmore-remove" class="dd_X_btn btn btn-bricky pull-right drugmore-remove" value="X" ' +
															'</td>'+
										
		                                                '</tr>'+
														'<tr class="drugs_row dd_relative">'+
															
															'<td colspan="1" >'+
															/*'<input type="button" class="btn btn-default dd_dosage1_text dd_instruction  btn-xs add-instruction-btn" id="add-instruction-btn" value="+ Add instruction" />'+
																*/

																'<input type="button" onclick="return addInstruction(this);" name="add-instruction-btn" class="btn btn-default  dd_instruction  btn-xs add-instruction-btn" value="+ Add Instruction" id="add-instruction-btn'+i+'">' +
																'<input type="button" onclick="return removeInstruction(this);" name="remove-instruction-btn" class="btn btn-default dd_dosage1_text dd_instruction  btn-xs remove-instruction-btn" value="- Remove Instruction" style="display:none" id="remove-instruction-btn'+i+'">' +
																
																
															'</td>'+
															'<td colspan="2" style="vertical-align: top;">'+
															'<div class="dd_dosage1_text_3 dd_Date pull-left">Start Date</div>'+		
																'<div class="dd_dosage1_text_2 pull-left">'+
																  						  	
																		'<span class="dd_instruction"> '+
																			'<input type="text" name="start_date'+i+'" class="form-control date-picker start_date" id="start_date'+i+'" value="'+startDate+'" data-date-format="dd-mm-yyyy">'+
																		'</span>'+
																	
																'</div>'+
															'</td>'+
															/*'<td></td>'+	*/
															'<td colspan="2"  class="dd_relative" style="vertical-align: top;">'+
															    '<div class="dd_beforfood">'+
																	'<label class="dd_beforfood_pd" >'+
																		'<input type="radio" class="before_food food_status" id="food_status_before'+i+'" name="food_status'+i+'" value="Before Food">Before Food'+
																	'</label>'+
																	'<label class="dd_beforfood_pd">'+
																		'<input type="radio" class="after_food food_status" id="food_status_after'+i+'" name="food_status'+i+'" value="After Food">After Food'+
																	'</label>'+
																'</div>'+
															'</td>'+
																
														'</tr>'+

		                                            
		                                        '</tbody>'+
		                                        '</table>'+
		                                        '<div class="instruction-div" id="instruction-div'+i+'">'+
												'</div>'+
		                                        '</div>');

		           	
		           	for(dosageUnitVal in dosageUnit){
		           		if(dosageUnitDefault!=dosageUnitVal)
		           		{
		           			$('#dosage_unit'+i).append('<option value='+dosageUnitVal+'>'+dosageUnit[dosageUnitVal]+'</option>');
		           		}
						
					}
					for(durationUnitVal in durationUnit){
						if(durationUnitDefault!=durationUnit)
		           		{
		           			$('#duration_unit'+i).append('<option value='+durationUnitVal+'>'+durationUnit[durationUnitVal]+'</option>');
		           		}
						
					}

					if(instruction!=""){
						//alert(i)
						$('#remove-instruction-btn'+i).show();
						$('#add-instruction-btn'+i).hide();

						 $('#instruction-div'+i).append('<textarea name="instruction'+i+'" cols="10" class="form-control instruction"  id="instruction'+i+'"	>'+instruction+'</textarea>');

					}
					else{
						//$('.add-instruction-btn').show();
					}

					if(foodStatus!=''){
						if(foodStatus=="Before Food"){
							$('#food_status_before'+i).attr('checked','checked');
						}
						else{
							$('#food_status_after'+i).attr('checked','checked');
						}
						
					}

					//code for removing remove button,when clikcing load prev
					if(i==1){
						$('#drugmore-remove'+i).remove();
					}

					
				}


				//Share Prescription btn click
				$('.share-prescription').click(function(){
					sharePrescription(prescSharedId)
				});
				
				$('.default-div-count').val(counter);

				$('.morning').tooltip({'trigger':'focus', 'title': 'Morning medicine count'});
				$('.noon').tooltip({'trigger':'focus', 'title': 'Noon medicine count'}); 
				$('.night').tooltip({'trigger':'focus', 'title': 'Night medicine count'}); 


			}
			 
		}
		
		function sharePrescription(prescSharedId){
			//alert(prescSharedId);
			var currentUrl = window.location.href;
			var shareLink = currentUrl+"/shared/"+prescSharedId;
			bootbox.dialog({
						message		: shareLink,
						title 		: "Share link",
						buttons 	: 
						{
							success : 
							{
								label 		: "Ok",
								className	: "btn-success",
								callback 	: function() 
								{
								}
							}
						}
			});
		}
		function addInstruction(e){
			
					
			           // e.preventDefault();
			                //$('#instruction-div').append('<textarea name=""> </textarea>')
			                //console.log($(this).closest('.presc-table'));
			                var clickedElement = $(e).closest('.presc-inner');
			                //console.log(clickedElement);
			               	var instructionDiv = clickedElement.find('.instruction-div');
			               	var instructionDiv = clickedElement.find('.presc-table');
			               	//console.log(instructionDiv);
			                
			                var drugNameInputId = clickedElement.find('.drug_name').attr('id');
			                //console.log(drugNameInputId);

			                var drugNameInputId = parseInt(drugNameInputId.replace(/[^0-9\.]/g, ''), 10);
			                //console.log(drugNameInputId);

			                //var instructionCounter = $('.default-div-count').val();

			                instructionDiv.append('<textarea name="instruction'+drugNameInputId+'" cols="30" class=" form-control instruction"  id="instruction'+drugNameInputId+'"	></textarea>');

			               clickedElement.find('.add-instruction-btn').hide();
			               clickedElement.find('.remove-instruction-btn').show();
		}

		function removeInstruction(e){
			var clickedElement = $(e).closest('.presc-inner');
            //console.log(clickedElement);

            var instructionTextArea = clickedElement.find('.instruction');
            //console.log(instructionTextArea);
            instructionTextArea.remove();
            clickedElement.find('.add-instruction-btn').show();
			clickedElement.find('.remove-instruction-btn').hide();

		}

		function drugRemove(e){
			//alert(event.type); 
				var divCount = $('.default-div-count').val();
				var elements = $(e).closest('.presc-inner');
				//console.log(elements);
				var removedPrescTable = elements.find('.drugs_row');
				//console.log(removedPrescTable);
				var removedId = removedPrescTable.find('.dd_input_mini').attr('id');
				//console.log(removedId);
				var removedId = parseInt(removedId.replace(/[^0-9\.]/g, ''), 10);
				//console.log(removedId);
				elements.remove();
				var newDefaultDivCount = parseInt(divCount)-parseInt(1);
				//console.log(newDefaultDivCount);
				$('.default-div-count').val(newDefaultDivCount);


				for(i=1;i<=newDefaultDivCount;i++){
					
					var nextDivId = parseInt(i) + parseInt(1);
					if(nextDivId>removedId){
						var decrementDivId = nextDivId - 1;
						//console.log('decrement'+decrementDivId);
						var selected1 = $('.presc-table').find('.drugs_row').find('#drug_name'+nextDivId);
						var selected2 = $('.presc-table').find('.drugs_row').find('#dosage'+nextDivId);
						
						var selected3 = $('.presc-table').find('.drugs_row').find('#dosage_unit'+nextDivId);
						
						var selected4 = $('.presc-table').find('.drugs_row').find('#duration'+nextDivId);
						var selected5 = $('.presc-table').find('.drugs_row').find('#duration_unit'+nextDivId);
						var selected6 = $('.presc-table').find('.drugs_row').find('#morning'+nextDivId);
						var selected7 = $('.presc-table').find('.drugs_row').find('#noon'+nextDivId);
						var selected8 = $('.presc-table').find('.drugs_row').find('#night'+nextDivId);
						var selected9 = $('.presc-inner').find('#instruction'+nextDivId);
						console.log(selected9);
						var selected10 = $('.presc-table').find('.drugs_row').find('#start_date'+nextDivId);
						var selected11 = $('.presc-table').find('.drugs_row').find('#food_status_before'+nextDivId);
						var selected12 = $('.presc-table').find('.drugs_row').find('#food_status_after'+nextDivId);
						//var selected2 = $('#medicine').find('.form-group').find('.frequency'+nextDivId);
						//selected1.attr('name','frequency'+decrementDivId+'[]');
						selected1.attr({
							  'name' : 'drug_name'+decrementDivId,
							  'id': 'drug_name'+decrementDivId
							});
						selected2.attr({
							  'name' : 'dosage'+decrementDivId,
							  'id': 'dosage'+decrementDivId
							});
						selected3.attr({
							  'name' : 'dosage_unit'+decrementDivId,
							   'id'  : 'dosage_unit'+decrementDivId
							});
						selected4.attr({
							  'name' : 'duration'+decrementDivId,
							  'id': 'duration'+decrementDivId
							});
						selected5.attr({
							  'name' : 'duration_unit'+decrementDivId,
							  'id'   : 'duration_unit'+decrementDivId
							  
							});
						selected6.attr({
							  'name' : 'morning'+decrementDivId,
							  'id': 'morning'+decrementDivId
							});
						selected7.attr({
							  'name' : 'noon'+decrementDivId,
							  'id': 'noon'+decrementDivId
							});
						selected8.attr({
							  'name' : 'night'+decrementDivId,
							  'id': 'night'+decrementDivId
							});
						selected9.attr({
							  'name' : 'instruction'+decrementDivId,
							  'id': 'instruction'+decrementDivId
							});
						selected10.attr({
							  'name' : 'start_date'+decrementDivId,
							  'id': 'start_date'+decrementDivId
							});
						selected11.attr({
							  'name' : 'food_status'+decrementDivId,
							  'id': 'food_status'+decrementDivId
							});
						selected12.attr({
							  'name' : 'food_status'+decrementDivId,
							  'id': 'food_status'+decrementDivId
							});

						
						
					}
					$('.default-div-count').val(newDefaultDivCount);
					
				}
				
				
						
		}


        
      
      
	</script>

@stop	