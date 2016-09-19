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
	{!!Html::style('assets/plugins/datepicker/css/datepicker.css')!!}
    {!!Html::style('assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css')!!}
    {!!Html::style('assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css')!!}
    {!!Html::style('assets/plugins/bootstrap-multiselect/css/bootstrap-multiselect.css')!!}
	{!!Html::style('assets/plugins/select2/select2.css')!!}

	<!-- {!!Html::style('assets/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css')!!} -->
	{!!Html::style('assets/plugins/bootstrap-modal/css/bootstrap-modal.css')!!}
	

	
<style type="text/css">
	
.input-new
{
	width:38px;
	
}

</style>
@stop
@extends('layouts.master', ['patientName' =>$patientName])


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
								<div class="col-sm-12 dd_relative">

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
									
									<!-- <a href="patientprescprint" class="btn btn-primary">Print</a> -->
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
						</div>
					</div>		
				</div>
			</div>
			<!-- end: FORM VALIDATION 2 PANEL -->
		</div>
	</div>
	<!-- end: PAGE CONTENT-->
	

	{!! Form::open(array('route' => 'addPatientPrescMedicine', 'role'=>'form', 'id'=>'addPatientPrescMedicine', 'class'=>'form-horizontal addPatientPrescMedicine','novalidate'=>'novalidate')) !!}
		{!! Form::hidden('print-data', 'saveTrue', $attributes = array('class'=>'form-control print-data')); !!}
		{!! Form::hidden('prev-drug-count', 0, $attributes = array('class'=>'form-control prev-drug-count')); !!}
		{!! Form::hidden('prev-drug-load-status', 0, $attributes = array('class'=>'form-control prev-drug-load-status')); !!}
		{!! Form::hidden('default-div-count', 1, $attributes = array('class'=>'form-control default-div-count')); !!}
	<div class="row">
		<div class="col-md-12">


			
			<!-- start: RESPONSIVE TABLE PANEL -->
			<div class="">
				
				<div class="dd_panel_presc">
					<div class="table-responsive presc-medicine">
						@if(!empty($prescMedicine))
						<div class="presc-inner contaner dd_border_table">
							
							<table class="table table-bordered  presc-table" id="sample-table-1">
								<thead>
									<tr class="drugs_row_hd" >
										<th width="16%">Drug Name</th>
										<th width="30%">Strength</th>
										<th width="18%" >Duration</th>
										<th width="9%">Morning</th>
										<th width="9%">Noon </th>
										<th width="9%">Night</th>
										<th width="9%"></th>
									</tr>
								</thead>
								<tbody>
									<tr class="drugs_row">
										<td class="dd_presc_medicin">
											{!! Form::text('drug_name1', Input::old('drug_name1'), $attributes = array('class'=>'dd_input_mini','id'=>'drug_name1'));  !!}
										</td>
										<td >
										    <div class="dd_dosage1_text">
										    	{!! Form::text('dosage1', Input::old('dosage1'), $attributes = array('class'=>'input-mini ng-pristine ng-valid'));  !!}

										    	{!! Form::select('dosage_unit1', $dosageUnit,Input::old('dosage_unit1'), $attributes = array('class'=>''));  !!}
											</div>
										</td>
										<td >
											<div class="dd_dosage1_text">
												{!! Form::text('duration1', Input::old('duration1'), $attributes = array('class'=>'input-mini ng-pristine ng-valid'));  !!}
													
												{!! Form::select('duration_unit1', $drugDurationUnit,Input::old('duration_unit1'), $attributes = array('class'=>''));  !!}
											</div>
										</td>
										<td>
											{!! Form::text('morning1', Input::old('morning1'), $attributes = array('class'=>'col-sm-8 morning'));  !!}
										</td>
										<td>
											{!! Form::text('noon1', Input::old('noon1'), $attributes = array('class'=>'col-sm-8 noon'));  !!}
										</td>
										<td>
											{!! Form::text('night1', Input::old('night1'), $attributes = array('class'=>'col-sm-8 night'));  !!}
										</td>
										<td></td>
									
										<!-- <td><span class="label label-sm label-warning">Expiring</span></td> -->
									</tr>

									<tr class="drugs_row dd_relative">
										<!-- <td class="dd_presc_medicin"></td> -->
										<td >
											<input type="button" class="btn btn-default dd_instruction  btn-xs add-instruction-btn1" id="add-instruction-btn1" value="+ Add Instruction" />
											<input type="button" class="btn btn-default dd_dosage1_text dd_instruction  btn-xs remove-instruction-btn1" id="remove-instruction-btn1" value="- Remove Instruction" style="display:none" />
											<!-- <div class="instruction-div1"></div> -->
											
										</td>
										<td width="20%" style="vertical-align: top;" >	
											<div class="dd_dosage1_text_3 dd_Date pull-left">Start Date	</div>	
											<div class="dd_dosage1_text_2 pull-left">
											  						    	
													<span class="dd_instruction"> 
														{!! Form::text('start_date1', input::old('start_date1') , $attributes = array('class' => 'form-control  start_date', 'data-date-viewmode'=>'years','data-date-format'=>'dd-mm-yyyy')); !!}
													</span>
												
											</div>
										</td>
										
										<td class="dd_relative" style="vertical-align: top;">
										    <div class="dd_beforfood">
												<label class="dd_beforfood_pd" >
													<input type="radio"  class="before_food" name="food_status1" value="Before Food">Before Food
												</label>
												<label class="dd_beforfood_pd">
													<input type="radio"  class="after_food" name="food_status1" value="After Food">After Food
												</label>
											</div>
										</td>
											<!-- <td><span class="label label-sm label-warning">Expiring</span></td> -->
									</tr>
									<tr>
										
										
										
									</tr>
								</tbody>
							</table>
							<div class="instruction-div" id="instruction-div">
							</div>
							<div class="instruction-div1 ">
								<textarea class="form-control instruction1" name="instruction1"></textarea>
							</div>	
						
						</div>	
						@else
						<div class="presc-inner contaner dd_border_table">
							<table class="table table-bordered  presc-table" id="sample-table-1">
								<thead>
									<tr class="drugs_row_hd" >
										<th width="16%">Drug Name</th>
										<th width="30%">Strength</th>
										<th width="18%" >Duration</th>
										<th width="9%">Morning</th>
										<th width="9%">Noon </th>
										<th width="9%">Night</th>
										<th width="9%"></th>
									</tr>
								</thead>
								<tbody>
									<tr class="drugs_row">
										<td class="dd_presc_medicin">
											{!! Form::text('drug_name1', Input::old('drug_name1'), $attributes = array('class'=>'dd_input_mini','id'=>'drug_name1'));  !!}
										</td>
										<td >
										    <div class="dd_dosage1_text">
										    	{!! Form::text('dosage1', Input::old('dosage1'), $attributes = array('class'=>'input-mini ng-pristine ng-valid'));  !!}

										    	{!! Form::select('dosage_unit1', $dosageUnit,Input::old('dosage_unit1'), $attributes = array('class'=>''));  !!}
											</div>
										</td>
										<td >
											<div class="dd_dosage1_text">
												{!! Form::text('duration1', Input::old('duration1'), $attributes = array('class'=>'input-mini ng-pristine ng-valid'));  !!}
													
												{!! Form::select('duration_unit1', $drugDurationUnit,Input::old('duration_unit1'), $attributes = array('class'=>''));  !!}
											</div>
										</td>
										<td>
											{!! Form::text('morning1', Input::old('morning1'), $attributes = array('class'=>'col-sm-8 morning'));  !!}
										</td>
										<td>
											{!! Form::text('noon1', Input::old('noon1'), $attributes = array('class'=>'col-sm-8 noon'));  !!}
										</td>
										<td>
											{!! Form::text('night1', Input::old('night1'), $attributes = array('class'=>'col-sm-8 night'));  !!}
										</td>
										<td></td>
										<!-- <td><span class="label label-sm label-warning">Expiring</span></td> -->
									</tr>

									<tr class="drugs_row dd_relative">
										<!-- <td class="dd_presc_medicin"></td> -->
										<td width="200px" >
											<input type="button" class="btn btn-default  dd_instruction  btn-xs add-instruction-btn1" id="add-instruction-btn1" value="+ Add Instruction" />
											<input type="button" class="btn btn-default dd_dosage1_text dd_instruction  btn-xs remove-instruction-btn1" id="remove-instruction-btn1" value="- Remove Instruction" style="display:none" />
											
										</td>
										<td width="20%" style="vertical-align: top;" >	
											<div class="dd_dosage1_text_3 dd_Date pull-left">Start Date	</div>	
											<div class="dd_dosage1_text_2 pull-left">
											  						    	
													<span class="dd_instruction"> 
														{!! Form::text('start_date1', input::old('start_date1') , $attributes = array('class' => 'form-control start_date', 'data-date-viewmode'=>'years','data-date-format'=>'dd-mm-yyyy')); !!}
													</span>
												
											</div>
										</td>
										<!-- <td></td> -->	
										<td class="dd_relative" style="vertical-align: top;">
										    <div class="dd_beforfood">
												<label class="dd_beforfood_pd" >
													<input type="radio"  class="before_food" name="food_status1" value="Before Food">Before Food
												</label>
												<label class="dd_beforfood_pd">
													<input type="radio"  class="after_food" name="food_status1" value="After Food">After Food
												</label>
											</div>
										</td>

											<!-- <td><span class="label label-sm label-warning">Expiring</span></td> -->
									</tr>
					<!-- 				<tr>
										<td></td>
										<td></td>
										<td></td>
											
											
										
									</tr> -->
								</tbody>
							</table>

							<div class="instruction-div" id="instruction-div"></div>
							<div class="instruction-div1 ">
								<textarea class="form-control instruction1" name="instruction1"></textarea>
							</div>
							
						</div>		
						@endif
					</div>
					<!-- <hr style="margin-bottom:20px; margin-top:15px;"> -->
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

							<!-- <input type="button" class="btn btn-default treatment-btn pull-right dd_praji_right_mg dd_color_light_blue"  value="+ Add Treatment">
							<input type="button" class="btn btn-default treatment-btn-remove  pull-right "  value="- Remove Treatment" style="display:none"> -->
							{!! Form::label('treatment', 'Treatment', $attributes = array('class'=>"col-sm-12  "));  !!}
							<div class="col-sm-12">
								{!! Form::textarea('treatment',null,['class'=>'form-control treament ', 'rows' => 4, 'cols' =>40 ]) !!}
							</div>
						
						</div>



						<hr style="margin-top:30px;">
						
						<div class="">
							<div class="form-group">
								<div class="col-sm-12">
								<!-- <input type="button" class="btn btn-default presc-add-more"  value="Add More"> -->
									<input type="submit" class="btn btn-primary presc-save dd_btn_center" value="Save">
								</div>
							</div>
						</div>
						
				</div>
			</div>
			<!-- end: RESPONSIVE TABLE PANEL -->
		</div>
	</div>
	{!! Form::close() !!}

	

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
		{!!Html::script('assets/plugins/bootstrap-multiselect/js/bootstrap-multiselect.js')!!}

		{!!Html::script('assets/plugins/bootstrap-modal/js/bootstrap-modal.js')!!}
		{!!Html::script('assets/plugins/bootstrap-modal/js/bootstrap-modalmanager.js')!!}
		{!!Html::script('assets/js/ui-modals.js')!!}
		{!!Html::script('assets/plugins/bootbox/bootbox.min.js')!!}
		

	<script>
		$(document).ready(function() {

			Main.init();
			patientElements.init(dosageUnit);
			UIModals.init();

			$(window).load(function() {
				$(".loader").fadeOut("slow");
				//alert('working');
			});

			$('.pdfopen').click(function(){

				$('.print-data').val('printTrue');
				
				
                var drugNameArray = [];
                var defaultDivCount = $('.default-div-count').val();
                var prevDrugStatus = $('.prev-drug-load-status').val();
                var prevDrugCount  = $('.prev-drug-count').val();
                for(var i=1;i<=defaultDivCount;i++){
                	var drugNames = $('#drug_name'+i).val();
                	if(drugNames.length>0){
                		drugNameArray.push(1) ;
                	}
                	else{
                		drugNameArray.push(0) ;
                	}

                }
                
               
               	if(jQuery.inArray(1,drugNameArray) ==-1){
				    bootbox.dialog({
					  message: "Prescription details are empty!!!",
					  title: "Prescription Details",
					  buttons: {
					   
					    danger: {
					      label: "Cancel",
					      className: "btn-danger",
					      callback: function() {
					        
					      }
					    },
					    
					  }
					});
				}
				else{

					if(prevDrugStatus>0){
						if(defaultDivCount>prevDrugCount){
							for(var i=1;i<=defaultDivCount;i++){
			                	var drugNames = $('#drug_name'+i).val();
			                	if(drugNames.length>0){
			                		drugNameArray.push(1) ;
			                	}
			                	else{
			                		drugNameArray.push(0) ;
			                	}

			                }
			                if(jQuery.inArray(1,drugNameArray) <0){

			                }
			                else{
			                	bootbox.dialog({
								  message: "Please save the data before print. Are you sure you want to save?",
								  title: "Prescription Details",
								  buttons: {
								    success: {
								      label: "Yes",
								      className: "btn-success",
								      callback: function() {
								        	var dataString = $( ".addPatientPrescMedicine" ).serializeArray();
			                				console.log(dataString);
			                				  	$.ajax({
								                    type: "POST",
								                    url: "addPatientPrescMedicine",
								                    data: dataString,
								                    success: function(data) {
								                    	if(data!=""){
								                    		console.log(data);
								                    		$('#myModal3').modal('show');
								                    		console.log(data);
								                    		$('iframe').remove();
								                    		$('.pdf_print').append('<iframe src="storage/pdf/'+data+'.pdf" style="width:780px;height:500px;"></iframe>');
										                }

										                //Refreshing the page for displaying 
										                $('.printBtnOk,.close').click(function(){
															location.href = "patientprescmedicine";
														})
								                    	
								                 	
								                    },
								                });
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


							
						}
						else{
							for(var i=1;i<=defaultDivCount;i++){
			                	var drugNames = $('#drug_name'+i).val();
			                	if(drugNames.length>0){
			                		drugNameArray.push(1) ;
			                	}
			                	else{
			                		drugNameArray.push(0) ;
			                	}

			                }
			                if(jQuery.inArray(1,drugNameArray) <0){
			                }
			                else{
			                	var dataString = $( ".addPatientPrescMedicine" ).serializeArray();
	                				console.log(dataString);
	                				  	$.ajax({
						                    type: "POST",
						                    url: "addPatientPrescMedicine",
						                    data: dataString,
						                    success: function(data) {
						                    	if(data!=' '){
						                    		$('#myModal3').modal('show');
						                    		console.log(data);
						                    		$('iframe').remove();
						                    		$('.pdf_print').append('<iframe src="storage/pdf/'+data+'.pdf" style="width:780px;height:400px;"></iframe>');
						                    	}
						                    	
						                 	
						                    },
						                });

			                }
						}
					}
					else{
						bootbox.dialog({
								  message: "Please save the data before print. Are you sure you want to save?",
								  title: "Prescription Details",
								  buttons: {
								    success: {
								      label: "Yes",
								      className: "btn-success",
								      callback: function() {
								        	var dataString = $( ".addPatientPrescMedicine" ).serializeArray();
			                				
			                				  	$.ajax({
								                    type: "POST",
								                    url: "addPatientPrescMedicine",
								                    data: dataString,
								                    success: function(data) {
								                    	if(data!=""){
								                    		//location.href = "patientprescmedicine";
								                    		
								                    		$('#myModal3').modal('show');
									                    		
									                    		$('iframe').remove();
									                    		$('.pdf_print').append('<iframe src="storage/pdf/'+data+'.pdf" style="width:780px;height:500px;" id="iFrame"></iframe>');
									                    	//Refreshing the iframe and showing latest data
								                    		var currSrc = $("#iFrame").attr("src");
															$("#iFrame").attr("src", currSrc);

								                    		
										                }

														$('.printBtnOk,.close').click(function(){
															location.href = "patientprescmedicine";
														})
								                    	
								                 	
								                    },
								                });
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


					 

				}
				               
               
              
	               


			});


			//$('[data-toggle="tooltip"]').tooltip(); 
			
			//$('[data-toggle="popover"]').tooltip(); 
			 $('.instruction1').hide();

			
			/*$('.treatment-btn').click(function(){
				$('.treament').show();
				$('.treatment-btn-remove').show();
				$('.treatment-btn').hide();
			});

			$('.treatment-btn-remove').click(function(){
				$('.treament').hide();
				$('.treatment-btn-remove').hide();
				$('.treatment-btn').show();
			});*/

			$('body').on('focus',".date-picker", function(){
					$(this).datepicker();
   			});

			var dosageUnit 		= <?php echo json_encode($dosageUnit); ?>;
			var durationUnit 	= <?php echo json_encode($drugDurationUnit); ?>;
         	var prescMedicine   = <?php echo json_encode($prescMedicine); ?>;

         	/*$('#loadDrugDiv').hide();
			$('#loadDrugDiv').find('input, textarea, button, select').attr('disabled','disabled');*/


			
			//Add more drugs
			

        	


        	$('.presc-add-more').click(function(e){
             	counter = $('.default-div-count').val();
             	counter++;
            	e.preventDefault();
            	var clickStatus = "add";
		           
            	addOrLoadDrugs(counter,dosageUnit,durationUnit,clickStatus);

	            	
                                        
        	});


			
	   		$('.present-drug-btn').click(function(e){
	   			
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


			if(clickStatus=="add"){
					$('.presc-medicine').append('<div class="presc-inner contaner dd_border_table">'+
						'<table class="table table-bordered  presc-table" id="sample-table-1">'+
		                                        '<thead>'+
		                                            '<tr class="drugs_row_hd" >'+
		                                                '<th width="16%">Drug Name</th>'+
		                                                '<th width="30%">Strength</th>'+
		                                                '<th width="18%">Duration</th>'+
		                                                '<th width="9%">Morning</th>'+
		                                                '<th width="9%">Noon </th>'+
		                                                '<th width="9%">Night</th>'+
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
															
															'<td >'+
															/*'<input type="button" class="btn btn-default dd_dosage1_text dd_instruction  btn-xs add-instruction-btn" id="add-instruction-btn" value="+ Add instruction" />'+
																*/

																'<input type="button" onclick="return addInstruction(this);" name="add-instruction-btn" class="btn btn-default  dd_instruction  btn-xs add-instruction-btn" value="+ Add Instruction" >' +
																'<input type="button" onclick="return removeInstruction(this);" name="remove-instruction-btn" class="btn btn-default dd_dosage1_text dd_instruction  btn-xs remove-instruction-btn" value="- Remove Instruction" style="display:none" >' +
																
																
															'</td>'+
															'<td width="20%" style="vertical-align: top;" >'+
															'<div class="dd_dosage1_text_3 dd_Date pull-left">Start Date</div>'+		
																'<div class="dd_dosage1_text_2 pull-left">'+
																  						  	
																		'<span class="dd_instruction"> '+
																			'<input type="text" name="start_date'+counter+'" class="form-control date-picker start_date" id="start_date'+counter+'" data-date-format="dd-mm-yyyy">'+
																		'</span>'+
																	
																'</div>'+
															'</td>'+
															/*'<td></td>'+*/	
															'<td class="dd_relative" style="vertical-align: top;">'+
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


					/*Tooltip*/

					$('.morning').tooltip({'trigger':'focus', 'title': 'Morning medicine count'});
					$('.noon').tooltip({'trigger':'focus', 'title': 'Noon medicine count'}); 
					$('.night').tooltip({'trigger':'focus', 'title': 'Night medicine count'}); 

			}
			else{
				

				for(i=1;i<=counter;i++){

					var drugName = prescMedicine[i-1].drug_name;
					var dosage   = prescMedicine[i-1].dosage;
					var dosageUnitDefault = prescMedicine[i-1].dosage_unit;
					var duration = prescMedicine[i-1].duration;
					var durationUnitDefault = prescMedicine[i-1].duration_unit;
					var morning = prescMedicine[i-1].morning;
					var noon = prescMedicine[i-1].noon;
					var night = prescMedicine[i-1].night;
					var instruction = prescMedicine[i-1].instruction;
					var startDate = prescMedicine[i-1].start_date;
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

					var foodStatus = prescMedicine[i-1].food_status;
					
					console.log(drugName);
					
					//console.log(startDate);


						$('.presc-medicine').append('<div class="presc-inner contaner dd_border_table">'+
							'<table class="table table-bordered  presc-table" id="sample-table-1">'+
		                                        '<thead>'+
		                                            '<tr class="drugs_row_hd" >'+
		                                                '<th width="16%">Drug Name</th>'+
		                                                '<th width="30%">Strength</th>'+
		                                                '<th width="18%">Duration</th>'+
		                                                '<th width="9%">Morning</th>'+
		                                                '<th width="9%">Noon </th>'+
		                                                '<th width="9%">Night</th>'+
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
															
															'<td >'+
															/*'<input type="button" class="btn btn-default dd_dosage1_text dd_instruction  btn-xs add-instruction-btn" id="add-instruction-btn" value="+ Add instruction" />'+
																*/

																'<input type="button" onclick="return addInstruction(this);" name="add-instruction-btn" class="btn btn-default  dd_instruction  btn-xs add-instruction-btn" value="+ Add Instruction" id="add-instruction-btn'+i+'">' +
																'<input type="button" onclick="return removeInstruction(this);" name="remove-instruction-btn" class="btn btn-default dd_dosage1_text dd_instruction  btn-xs remove-instruction-btn" value="- Remove Instruction" style="display:none" id="remove-instruction-btn'+i+'">' +
																
																
															'</td>'+
															'<td width="20%" style="vertical-align: top;">'+
															'<div class="dd_dosage1_text_3 dd_Date pull-left">Start Date</div>'+		
																'<div class="dd_dosage1_text_2 pull-left">'+
																  						  	
																		'<span class="dd_instruction"> '+
																			'<input type="text" name="start_date'+i+'" class="form-control date-picker start_date" id="start_date'+i+'" value="'+startDate+'" data-date-format="dd-mm-yyyy">'+
																		'</span>'+
																	
																'</div>'+
															'</td>'+
															/*'<td></td>'+	*/
															'<td class="dd_relative" style="vertical-align: top;">'+
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


				$('.default-div-count').val(counter);

				$('.morning').tooltip({'trigger':'focus', 'title': 'Morning medicine count'});
				$('.noon').tooltip({'trigger':'focus', 'title': 'Noon medicine count'}); 
				$('.night').tooltip({'trigger':'focus', 'title': 'Night medicine count'}); 


			}
			 
		}
		

		function addInstruction(e){
			
					
			           // e.preventDefault();
			                //$('#instruction-div').append('<textarea name=""> </textarea>')
			                //console.log($(this).closest('.presc-table'));
			                var clickedElement = $(e).closest('.presc-inner');
			                console.log(clickedElement);
			                var instructionDiv = clickedElement.find('.instruction-div');
			                console.log(instructionDiv);
			                
			                var drugNameInputId = clickedElement.find('.drug_name').attr('id');
			                //console.log(drugNameInputId);
			                var drugNameInputId = parseInt(drugNameInputId.replace(/[^0-9\.]/g, ''), 10);
			               
			                //var instructionCounter = $('.default-div-count').val();

			                instructionDiv.append('<textarea name="instruction'+drugNameInputId+'" cols="30" class=" form-control instruction"  id="instruction'+drugNameInputId+'"	></textarea>');

			               clickedElement.find('.add-instruction-btn').hide();
			               clickedElement.find('.remove-instruction-btn').show();
		}

		function removeInstruction(e){
			var clickedElement = $(e).closest('.presc-inner');
            //console.log(clickedElement);
            var instructionTextArea = clickedElement.find('.instruction');
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