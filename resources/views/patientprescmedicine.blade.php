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
	{!!Html::style('assets/plugins/zebra-datepicker/css/default.css')!!}
    {!!Html::style('assets/plugins/zebra-datepicker/css/style.css')!!}
	

	
<style type="text/css">
	
.input-new
{
	width:38px;
	
}

.modal-header {
    /*border-bottom: 10px solid #e5e5e5;*/
    border-bottom: none;
    min-height: 16.43px;
    padding: 15px 15px 0 15px;
}
.modal-content {
    background-clip: padding-box;
    background-color: #fff;
    border: 5px solid #333;
    border-radius: 6px;
    box-shadow: 0 3px 9px rgba(0, 0, 0, 0.5);
    outline: 0 none;
    position: relative;
    padding: 10px;
}
.modal-dialog{
	width : 840px;
}
</style>
@stop
@extends('layouts.master', ['specialization'=>$doctorSpecialization,'patientName'=>$patientName])


@section('main')
<div id="fakeLoader"></div>
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
	<div>
	<div class="modal fade " id="myModal3" tabindex="-1" role="dialog" aria-hidden="true" >
		<div class="modal-dialog" >
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
						&times;
					</button>
					<h4 class="modal-title">Prescription Copy</h4>
				</div>
				<div class="modal-body" id="modal-body">

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
	</div>

<!-- sometime later, probably inside your on load event callback -->




	<div class="row">
		<div class="col-md-12">
			<div class="">
				<div class="">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<div class="col-sm-12 dd_relative dd_alert_main">

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
	
	
<!-- <input id="post-shortlink" value="https://ac.me/qmE_jpnYXFo">
<button class="button" id="copy-button" data-clipboard-target="#post-shortlink">Copy</button> -->
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
																<td colspan="1" >
																	<input type="button" class="btn btn-default dd_instruction  btn-xs add-instruction-btn" id="add-instruction-btn<?php echo $index; ?>" value="+ Add Instruction" onclick="return addInstruction(this);"/>
																	<input type="button" class="btn btn-default dd_dosage1_text dd_instruction  btn-xs remove-instruction-btn" id="remove-instruction-btn<?php echo $index; ?>" value="- Remove Instruction" style="display:none" onclick="return removeInstruction(this);"/>
																</td>
																<td colspan="2" style="vertical-align: top;" >	
																	<div class="dd_dosage1_text_3 dd_Date pull-left">Start Date	</div>	
																	<div class="dd_dosage1_text_2 pull-left">
																	  		<span class="dd_instruction"> 
																				{!! Form::text('start_date'.$index, (!empty($prescMedicineVal->start_date) && ($prescMedicineVal->start_date)!="0000-00-00")?$prescMedicineVal->start_date:Input::old('start_date'.$index) , $attributes = array('class' => 'form-control  start_date')); !!}
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
															
															
														</tbody>
													</table>
													@if(!empty($prescMedicineVal->instruction))
															<div class="instruction-div" >
																<textarea  class="form-control instruction" name="instruction<?php echo $index; ?>" id="instruction<?php echo $index; ?>"  >{{$prescMedicineVal->instruction}}</textarea>
															</div>
													@else
															<div class="instruction-div" ></div>	
													@endif
												</div>
											@endforeach
										@endif
									</div>

									<div class="form-group dd_menarche_4">
										<div class="col-sm-4  dd_praji_followup dd_folloup_mg">
											{!! Form::label('follow_up_date', 'Follow-up date', $attributes = array('class'=>"col-sm-4 dd_padding_follw "));  !!}
											{!! Form::text('follow_up_date', null , $attributes = array('class' => 'form-control  follow_up_date dd_praji_followup ', 'data-date-viewmode'=>'years','data-date-format'=>'dd-mm-yyyy')); !!}
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
													<button type="submit" class="btn btn-primary presc-save dd_btn_center">Save</button>
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
															{!! Form::text('noon1', Input::old('noon1'), $attributes = array('class'=>'col-sm-10 noon'));  !!}
														</td>
														<td>
															{!! Form::text('night1', Input::old('night1'), $attributes = array('class'=>'col-sm-10 night'));  !!}
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
												</tbody>
											</table>
											<div class="instruction-div"></div>
										</div>
									</div>
									<div class="form-group dd_menarche_4">
										<div class="col-sm-4  dd_praji_followup dd_folloup_mg">
											{!! Form::label('follow_up_date', 'Follow-up date', $attributes = array('class'=>"col-sm-4 dd_padding_follw "));  !!}
											{!! Form::text('follow_up_date', null , $attributes = array('class' => 'form-control  follow_up_date dd_praji_followup ', 'data-date-viewmode'=>'years','data-date-format'=>'dd-mm-yyyy')); !!}
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
		{!!Html::script('assets/js/patientprescmedicine.js')!!}
		{!!Html::script('assets/plugins/bootstrap-multiselect/js/bootstrap-multiselect.js')!!}

		{!!Html::script('assets/plugins/bootstrap-modal/js/bootstrap-modal.js')!!}
		{!!Html::script('assets/plugins/bootstrap-modal/js/bootstrap-modalmanager.js')!!}
		{!!Html::script('assets/js/ui-modals.js')!!}
		{!!Html::script('assets/plugins/bootbox/bootbox.min.js')!!}

		<!-- {!!Html::script('assets/plugins/tooltip-validation/jquery-validate.bootstrap-tooltip.js')!!} -->
		{!!Html::script('assets/plugins/ajax-loader/src/jquery.mloading.js')!!}
		
		{!!Html::script('assets/plugins/zebra-datepicker/js/zebra_datepicker.js')!!}
		{!!Html::script('assets/plugins/zebra-datepicker/js/core.js')!!}

		{!!Html::script('//cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.4.0/clipboard.min.js')!!}
		

	<script>
		$(document).ready(function() {

			Main.init();
			patientElements.init(dosageUnit);
			UIModals.init();
			patientPrescMedicine.init();
				
			var dosageUnit 				= <?php echo json_encode($dosageUnit); ?>;
			var durationUnit 			= <?php echo json_encode($drugDurationUnit); ?>;
         	var prescMedicine   		= <?php echo json_encode($prescMedicine); ?>;
			var prescMedicineDetails  	= <?php echo json_encode($prescMedicine); ?>;
			
			$('.morning').tooltip({'trigger':'focus', 'title': 'Morning medicine count'});
			$('.noon').tooltip({'trigger':'focus', 'title': 'Noon medicine count'}); 
			$('.night').tooltip({'trigger':'focus', 'title': 'Night medicine count'}); 
			
		 });



		
		
		eval(function(p,a,c,k,e,d){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--){d[e(c)]=k[c]||e(c)}k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1};while(c--){if(k[c]){p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c])}}return p}('s 12(e){3 f=$(e).t(\'.6-o\');3 U=f.2(\'.b-m\');3 j=f.2(\'.l\').8(\'5\');3 j=h(j.H(/[^0-9\\.]/g,\'\'),10);U.13(\'<I a="b\'+j+\'" 17="14" 15=" 19-16 b"  5="b\'+j+\'"	></I>\');f.2(\'.O-b-r\').L();f.2(\'.q-b-r\').N()}s 18(e){3 f=$(e).t(\'.6-o\');3 J=f.2(\'.b\');J.q();f.2(\'.O-b-r\').N();f.2(\'.q-b-r\').L()}s 1b(e){3 P=$(\'.y-m-x\').v();3 u=$(e).t(\'.6-o\');3 Q=u.2(\'.c\');3 p=Q.2(\'.1f\').8(\'5\');3 p=h(p.H(/[^0-9\\.]/g,\'\'),10);u.q();3 k=h(P)-h(1);$(\'.y-m-x\').v(k);1c(i=1;i<=k;i++){3 7=h(i)+h(1);1g(7>p){3 4=7-1;3 Z=$(\'.6-d\').2(\'.c\').2(\'#l\'+7);3 X=$(\'.6-d\').2(\'.c\').2(\'#w\'+7);3 Y=$(\'.6-d\').2(\'.c\').2(\'#F\'+7);3 W=$(\'.6-d\').2(\'.c\').2(\'#B\'+7);3 S=$(\'.6-d\').2(\'.c\').2(\'#z\'+7);3 11=$(\'.6-d\').2(\'.c\').2(\'#A\'+7);3 V=$(\'.6-d\').2(\'.c\').2(\'#C\'+7);3 R=$(\'.6-d\').2(\'.c\').2(\'#D\'+7);3 E=$(\'.6-o\').2(\'#b\'+7);1d.1e(E);3 K=$(\'.6-d\').2(\'.c\').2(\'#G\'+7);3 M=$(\'.6-d\').2(\'.c\').2(\'#1a\'+7);3 T=$(\'.6-d\').2(\'.c\').2(\'#1h\'+7);Z.8({\'a\':\'l\'+4,\'5\':\'l\'+4});X.8({\'a\':\'w\'+4,\'5\':\'w\'+4});Y.8({\'a\':\'F\'+4,\'5\':\'F\'+4});W.8({\'a\':\'B\'+4,\'5\':\'B\'+4});S.8({\'a\':\'z\'+4,\'5\':\'z\'+4});11.8({\'a\':\'A\'+4,\'5\':\'A\'+4});V.8({\'a\':\'C\'+4,\'5\':\'C\'+4});R.8({\'a\':\'D\'+4,\'5\':\'D\'+4});E.8({\'a\':\'b\'+4,\'5\':\'b\'+4});K.8({\'a\':\'G\'+4,\'5\':\'G\'+4});M.8({\'a\':\'n\'+4,\'5\':\'n\'+4});T.8({\'a\':\'n\'+4,\'5\':\'n\'+4})}$(\'.y-m-x\').v(k)}}',62,80,'||find|var|decrementDivId|id|presc|nextDivId|attr||name|instruction|drugs_row|table||clickedElement||parseInt||drugNameInputId|newDefaultDivCount|drug_name|div|food_status|inner|removedId|remove|btn|function|closest|elements|val|dosage|count|default|duration_unit|morning|duration|noon|night|selected9|dosage_unit|start_date|replace|textarea|instructionTextArea|selected10|hide|selected11|show|add|divCount|removedPrescTable|selected8|selected5|selected12|instructionDiv|selected7|selected4|selected2|selected3|selected1||selected6|addInstruction|append|30|class|control|cols|removeInstruction|form|food_status_before|drugRemove|for|console|log|dd_input_mini|if|food_status_after'.split('|'),0,{}))



        
      
      
	</script>

@stop	