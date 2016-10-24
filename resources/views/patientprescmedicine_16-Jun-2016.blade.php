@section('head')
	{!!Html::style('assets/plugins/datepicker/css/datepicker.css')!!}
    {!!Html::style('assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css')!!}
    {!!Html::style('assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css')!!}
    {!!Html::style('assets/plugins/bootstrap-multiselect/css/bootstrap-multiselect.css')!!}
	{!!Html::style('assets/plugins/select2/select2.css')!!}

@stop
@extends('layouts.master')

<?php

foreach ($prescMedicine as $key => $prescMedicineVal) {
	$followupDate = $prescMedicineVal->followup_date;
}


?>

@section('main')
	<div class="page-header">
		<h1>Prescription Medicine <small></small></h1>
	</div>


	<div class="row">
		<div class="col-md-12">
				
	                     
			<div class="panel">
				
				<div class="panel-body">
					{!! Form::open(array('route' => 'addPatientPrescMedicine', 'role'=>'form', 'id'=>'addPatientPrescMedicine', 'class'=>'form-horizontal','novalidate'=>'novalidate')) !!}
						 {!! Form::hidden('default-div-count', null, $attributes = array('class'=>'form-control default-div-count')); !!}
						<!--{!! Form::text('dynamic_div', '0', $attributes = array('class'=>'form-control dynamic_div')); !!}
						{!! Form::text('removed_div_array', '0', $attributes = array('class'=>'form-control removed_div_array')); !!} -->
						<div class="row">
							<div class="col-md-12">
						
								{!! Form::hidden('presc_exist', "0", $attributes = array('class'=>'form-control drugs'));  !!}
								
								<div class="form-group">
									<div class="col-sm-12 dd_relative">
										<input type="button" class="btn btn-orange pull-right present-drug-btn dd_Present_mg" value="Load Previous Drugs">
										<!-- <button class="btn btn-orange pull-right present-drug-btn dd_Present_mg"><i class="fa fa-plus "></i>Load Previous Drugs</button> -->
									</div>
								</div>
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
								<div id="medicine" class="medicine">
									<div class="form-group">
										<div class="col-sm-3">
									        <div class="dd_top_mt dd_rs_mg">Drugs</div>
											{!! Form::text('drugs[]', Input::old('drugs'), $attributes = array('class'=>'form-control','placeholder' => ''));  !!}
										</div>
										<div class="col-sm-1">
								        	<div class="dd_top_mt dd_rs_mg">Dosage</div>
											{!! Form::text('dosage[]', Input::old('dosage'), $attributes = array('class'=>'form-control','placeholder' => ''));  !!}
											
										</div>
										<div class="col-sm-2">
										  	<div class="dd_top_mt dd_rs_mg">Start Date</div>
											{!! Form::text('start_date[]', Input::old('start_date'), $attributes = array('class'=>'form-control  date-picker','placeholder' => ' ','data-date-viewmode'=>'years','data-date-format'=>'dd-mm-yyyy' ));  !!}
											
										</div>
										<div class="col-sm-1">
										 	<div class="dd_top_mt dd_rs_mg">Duration</div>
											{!! Form::text('duration[]', Input::old('duration'), $attributes = array('class'=>'form-control','placeholder' => ''));  !!}
										</div>
										<div class="col-sm-4">
											<span>
											<div class="dd_top_mt dd_rs_mg">Frequency</div>
											{!! Form::select('frequency1[]', $drugFrequency, Input::old('frequency1'), $attributes = array('class' => 'form-control dd_input quali','id'=>'frequency1','multiple' => 'multiple')); !!}
										
											</span>
										</div>	
									</div>

									
								</div>	
								<div class="form-group">
									<div class="col-sm-12">
										<div class="col-sm">
											<button type="submit" class="btn btn-default btn-add-drug pull-right"><i class="fa fa-plus "></i> Add more drugs</button>
										</div>

									</div>
								</div>
								<hr>
									@if(!empty($prescMedicine))
										<div class="form-group">
											<div class="col-sm-12">
												{!! Form::label('treatment', 'Treatment / Adviced', $attributes = array('class'=>'control-label'));  !!}
												{!! Form::textarea('additional_comment',null,['class'=>'form-control dd_hd_mg_t', 'rows' => 4, 'cols' => 40]) !!}
											</div>
											<div class="col-sm-3 dd_mg_10">
												 <span class=""> 
													<?php
														//$followupDate = $prescMedicineVal[]->followup_date;
														$followupDate = date('d-m-Y',strtotime($followupDate));
													?>
													{!! Form::label('followup_date', 'Followup', $attributes = array('class'=>'control-label'));  !!}
													{!! Form::text('followup_date', $followupDate, $attributes = array('class'=>'form-control date-picker dd_hd_mg_t','placeholder' => 'Followup Date','data-date-viewmode'=>'years','data-date-format'=>'dd-mm-yyyy'));  !!}
													<!--  <i class="fa fa-calendar dd_fa_calender" aria-hidden="true"></i> -->

												 </span> 
											</div>
										</div>
									@else
										<div class="form-group">
											<div class="col-sm-12">
												{!! Form::label('treatment', 'Treatment / Adviced', $attributes = array('class'=>'control-label'));  !!}
												{!! Form::textarea('additional_comment',null,['class'=>'form-control dd_hd_mg_t', 'rows' => 4, 'cols' => 40]) !!}
											</div>
											<div class="col-sm-3 dd_mg_10">
												 <span class=""> 
												
													{!! Form::label('followup_date', 'Followup', $attributes = array('class'=>'control-label'));  !!}
													{!! Form::text('followup_date', Input::old('followup_date'), $attributes = array('class'=>'form-control date-picker dd_hd_mg_t','placeholder' => 'Followup Date','data-date-viewmode'=>'years','data-date-format'=>'dd-mm-yyyy'));  !!}
													<!--  <i class="fa fa-calendar dd_fa_calender" aria-hidden="true"></i> -->

												 </span> 
											</div>
										</div>
									@endif
									
									
								<hr>
									<div class="form-group">
										
										<div class="col-sm-12">
											<button type="submit" class="btn btn-primary btn-block dd_btn_center "><i class="fa fa-arrow-circle-right "></i> Save</button>
										</div>
									</div>
							</div>	
						</div>

					{!! Form::close() !!}
		
				</div>
			</div>
			<!-- end: FORM VALIDATION 2 PANEL -->
		</div>
	</div>
	<!-- end: PAGE CONTENT-->
	
	

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

	<script>
		$(document).ready(function() {

			Main.init();
			patientElements.init();


			$('#frequency1').multiselect();

			var drugFrequency = <?php echo json_encode($drugFrequency); ?>;
			var prescMedicine = <?php echo json_encode($prescMedicine); ?>;

			$('body').on('focus',".date-picker", function(){
					$(this).datepicker();
   			});

   		
			var defaultDivCount = 0;
			var counter = 0;
			$('.medicine').each(function(){
					var defaultDivCount = $(this).find('.form-group').length;
					$('.default-div-count').val(defaultDivCount);
			});
			
			
	   		$('.btn-add-drug').click(function(e){
	   			e.preventDefault();
	   			
	   			counter = parseInt($('.default-div-count').val());
	   			
	   			counter=counter+1;
	   			
	   			$('#medicine').append(
	   									'<input type="hidden" name="drug_counter" value="'+counter+'"> '+
	   									
	   									'<div class="form-group">' +
										'<div class="col-sm-3">' + 
										'<div class="dd_top_mt dd_rs_mg"></div>'+
											'<Input type="text" name="drugs[]" class="form-control drugs" placeholder="Drugs" id="drug">'+
										'</div>' +
										'<div class="col-sm-1">' +
										'<div class="dd_top_mt dd_rs_mg"></div>'+
											'<Input type="text" name="dosage[]" class="form-control "'+'placeholder="Dosage" >'+ 
										'</div>' +
									
										'<div class="col-sm-2">' + 
										'<div class="dd_top_mt dd_rs_mg"></div>'+
											'<Input type="text" name="start_date[]" class="form-control date-picker" placeholder="Start Date"data-date-viewmode="years" data-date-format="dd-mm-yyyy">'+
										'</div>' +
										'<div class="col-sm-1">' +
										'<div class="dd_top_mt dd_rs_mg"></div>'+
											'<Input type="text" name="duration[]" class="form-control "'+'placeholder="Duration" >'+ 
										'</div>' +
										'<div class="col-sm-4">' +
										'<div class="dd_top_mt dd_rs_mg"></div>'+
											'<div class="frequencyDiv">'+
											'<select name="frequency'+counter+'[]" class="form-control search-select frequency" id="frequency'+counter+'"  multiple ="multiple">' +
												'</select>'	+
											'</div>'+	
										'</div>' +
										'<div class="col-sm-1">' +
											'<input type="button" onclick="return drugRemove(this);" name="drugmore-remove" class="btn btn-bricky pull-right drugmore-remove" value="Remove" ' +
											
										'</div>' +
										
									
									 '</div>'


									  );

	   								for(ind in drugFrequency){
										
										$('#frequency'+counter).append('<option value='+ind+'>'+drugFrequency[ind]+'</option>');
									}
									$('#frequency'+counter).multiselect();


	   								


					$('.default-div-count').val(counter);	
									
									
					
						
			});
			
	   		$('.present-drug-btn').click(function(e){
	   			e.preventDefault();
	   			
	   			counter = parseInt($('.default-div-count').val());
	   			
	   			
	   				for(prescMedicineVal in prescMedicine){
	   					
	   					console.log(prescMedicine[prescMedicineVal]['drug_frequency']);
	   					counter=counter+1;
	   				 			$('#medicine').append(
	   									'<input type="hidden" name="drug_counter" value="'+counter+'"> '+
	   									
	   									'<div class="form-group">' +
										'<div class="col-sm-3">' + 
										'<div class="dd_top_mt dd_rs_mg"></div>'+
											'<Input type="text" name="drugs[]" value="'+prescMedicine[prescMedicineVal]['drug_name']+'" class="form-control drugs" placeholder="Drugs" id="drug">'+
										'</div>' +
										'<div class="col-sm-1">' +
										'<div class="dd_top_mt dd_rs_mg"></div>'+
											'<Input type="text" name="dosage[]" value="'+prescMedicine[prescMedicineVal]['drug_dose']+'" class="form-control "'+'placeholder="Dosage" >'+ 
										'</div>' +
									
										'<div class="col-sm-2">' + 
										'<div class="dd_top_mt dd_rs_mg"></div>'+
											'<Input type="text" name="start_date[]" value="'+prescMedicine[prescMedicineVal]['drug_start_date']+'" class="form-control date-picker" placeholder="Start Date"data-date-viewmode="years" data-date-format="dd-mm-yyyy">'+
										'</div>' +
										'<div class="col-sm-1">' +
										'<div class="dd_top_mt dd_rs_mg"></div>'+
											'<Input type="text" name="duration[]" value="'+prescMedicine[prescMedicineVal]['drug_duration']+'"  class="form-control "'+'placeholder="Duration" >'+ 
										'</div>' +
										'<div class="col-sm-4">' +
										'<div class="dd_top_mt dd_rs_mg"></div>'+
											'<div class="frequencyDiv">'+
											'<select name="frequency'+counter+'[]" class="form-control search-select frequency" id="frequency'+counter+'"   multiple ="multiple">' +
												'</select>'	+
											'</div>'+	
										'</div>' +
										'<div class="col-sm-1">' +
											'<input type="button" onclick="return drugRemove(this);" name="drugmore-remove" class="btn btn-bricky pull-right drugmore-remove" value="Remove" ' +
											
										'</div>' +
										
									
									 '</div>'


									  );

	   				 				

	   								for(ind in drugFrequency){
										
										$('#frequency'+counter).append('<option value='+ind+'>'+drugFrequency[ind]+'</option>');
									}
									$('#frequency'+counter).multiselect();


	   								


						$('.default-div-count').val(counter);
						
	   				}


	   				//$(this).prop('disabled',true);	
	   			
	  	

	   		})
			
   			
					

									
		                                       
		 });
		

		function drugRemove(e){
			//alert(event.type); 
				var elements = $(e).closest('.form-group');
				var removedFrequency = elements.find('.frequency');
				var removedId = removedFrequency.attr('id');
				elements.remove();
				//console.log(removedId);
				var removedId = parseInt(removedId.replace(/[^0-9\.]/g, ''), 10);
				
				$('.medicine').each(function(){
						var defaultDivCount = $(this).find('.form-group').length;
						//console.log(defaultDivCount);
						//alert(defaultDivCount);
						$('.default-div-count').val(defaultDivCount);
				});

				var newDefaultDivCount = $('.default-div-count').val();

				for(i=1;i<=newDefaultDivCount;i++){
					
					var nextDivId = parseInt(i) + parseInt(1);
					if(nextDivId>removedId){
						var decrementDivId = nextDivId - 1;
						console.log('decrement'+decrementDivId);
						var selected1 = $('#medicine').find('.form-group').find('#frequency'+nextDivId);
						//var selected2 = $('#medicine').find('.form-group').find('.frequency'+nextDivId);
						//selected1.attr('name','frequency'+decrementDivId+'[]');
						selected1.attr({
							  'name' : 'frequency'+decrementDivId+'[]',
							  'id': 'frequency'+decrementDivId
							});
						
						
					}
					$('.default-div-count').val(newDefaultDivCount);
					
				}

				
						
		}
      
	</script>

@stop	