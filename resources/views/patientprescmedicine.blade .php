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
{!!Html::style('assets/plugins/datepicker/css/datepicker.css')!!}
{!!Html::style('assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css')!!}
{!!Html::style('assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css')!!}
{!!Html::style('assets/plugins/bootstrap-multiselect/css/bootstrap-multiselect.css')!!}
{!!Html::style('assets/plugins/select2/select2.css')!!}

@stop
@extends('layouts.master', ['specialization'=>$doctorSpecialization,'patientName'=>$patientName])


@section('main')
<div class="page-header">
	<h1>Prescription Medicine <small></small></h1>
</div>


<div class="row">
	<div class="col-md-12">
		<?php 
			$error = Session::get('error');
			$success = Session::get('success');
			Session::forget('error');
			Session::forget('success');
			$success = "d";

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

		
		@if(!empty($success))
			<div class="panel">
				<div class="panel-body">
					{!! Form::open(array('route' => 'addPatientPrescMedicine', 'role'=>'form', 'id'=>'addPatientPrescMedicine', 'class'=>'form-horizontal','novalidate'=>'novalidate')) !!}
						{!! Form::hidden('presc_exist', "0", $attributes = array('class'=>'form-control drugs'));  !!}
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<div class="col-sm-12 dd_relative">
										<button class="btn btn-orange pull-right present-drug-btn dd_Present_mg"><i class="fa fa-plus "></i>List Drugs</button>
									</div>
								</div>
							</div>
						</div>

					{!! Form::close() !!}
				</div>
			</div>

		@endif









		<div class="panel">
			{{$success}}
			<div class="panel-body">
				{!! Form::open(array('route' => 'addPatientPrescMedicine', 'role'=>'form', 'id'=>'addPatientPrescMedicine', 'class'=>'form-horizontal','novalidate'=>'novalidate')) !!}

				<div class="row">
					<div class="col-md-12">
						
						{!! Form::hidden('presc_exist', "0", $attributes = array('class'=>'form-control drugs'));  !!}

						<div class="form-group">
							<div class="col-sm-12 dd_relative">
								<button class="btn btn-orange pull-right present-drug-btn dd_Present_mg"><i class="fa fa-plus "></i>List Drugs</button>
							</div>
						</div>
						<div id="medicine" class="medicine">
							{!! Form::text('default_medicine_div_count',null, $attributes = array('class'=>'form-control default_medicine_div'));  !!}
							{!! Form::text('dynamic_medicine_div_count',null, $attributes = array('class'=>'form-control dynamic_medicine_div'));  !!}
							<!-- {!! Form::text('total_div_count',null, $attributes = array('class'=>'form-control total_div_count'));  !!} -->
							<div id="medicineClone" class="medicineClone">
								<?php 
								$counter = 1;
								$frequencyText = 'frequency';

								$frequencyArray = array();
											//$frequencyCounter = ; 


								?>
								@if(!empty($prescMedicine))
								@foreach($prescMedicine as $index => $prescMedicineVal)
								<?php 
								array_push($frequencyArray,$frequencyText.$counter);
								?>
								<div class="form-group">
									<div class="col-sm-3">
										<div class="dd_top_mt dd_rs_mg">Drugs</div>
										{!! Form::text('drugs[]',$prescMedicineVal->drug_name, $attributes = array('class'=>'form-control drugs','placeholder' => 'Drugs'));  !!}
									</div>
									<div class="col-sm-1">
										<div class="dd_top_mt dd_rs_mg">Dosage</div>
										{!! Form::text('dosage[]', $prescMedicineVal->drug_dose, $attributes = array('class'=>'form-control','placeholder' => 'Dosage'));  !!}

									</div>
									<div class="col-sm-2">
										<?php
										$startDate = $prescMedicineVal->drug_start_date;
										$startDate = date('d-m-Y',strtotime($startDate));
										?>
										<div class="dd_top_mt dd_rs_mg">Start Date</div>
										{!! Form::text('start_date[]',$startDate , $attributes = array('class'=>'form-control  date-picker start-date','placeholder' => 'Start Date','data-date-viewmode'=>'years','data-date-format'=>'dd-mm-yyyy' ));  !!}

									</div>
									<div class="col-sm-1">
										<div class="dd_top_mt dd_rs_mg">Duration</div>
										{!! Form::text('duration[]',$prescMedicineVal->drug_duration, $attributes = array('class'=>'form-control','placeholder' => 'Duration'));  !!}
									</div>
									<div class="col-sm-2">
										<?php $drugFrequencyVal = json_decode($prescMedicineVal->drug_frequency); ?>
										<span>
											<div class="dd_top_mt dd_rs_mg">Frequency</div>
											{!! Form::select($frequencyText.$counter.'[]', $drugFrequency, $drugFrequencyVal, $attributes = array('class' => 'form-control dd_input quali','id'=>$frequencyText.$counter,'multiple' => 'multiple')); !!}

										</span>
									</div>
									<div class="col-sm-2" style="margin-top:23px;margin-left:20px">
										<a href="" class="btn btn-bricky default-drug-remove"><i class="fa fa-times fa fa-white"></i></a>

									</div>	
								</div>
								<?php $counter++; ?>
								@endforeach
								@else
								<div class="form-group">
									<div class="col-sm-2">
										<div class="dd_top_mt dd_rs_mg">Drugs</div>
										{!! Form::text('drugs[]', Input::old('drugs'), $attributes = array('class'=>'form-control drugs','placeholder' => 'Drugs'));  !!}
									</div>
									<div class="col-sm-2">
										<div class="dd_top_mt dd_rs_mg">Dosage</div>
										{!! Form::text('dosage[]', Input::old('dosage'), $attributes = array('class'=>'form-control','placeholder' => 'Dosage'));  !!}

									</div>
									<div class="col-sm-2">
										<div class="dd_top_mt dd_rs_mg">Start Date</div>
										{!! Form::text('start_date[]', Input::old('start_date'), $attributes = array('class'=>'form-control  date-picker','placeholder' => 'Start Date','data-date-viewmode'=>'years','data-date-format'=>'dd-mm-yyyy' ));  !!}

									</div>
									<div class="col-sm-2">
										<div class="dd_top_mt dd_rs_mg">Duration</div>
										{!! Form::text('duration[]', Input::old('duration'), $attributes = array('class'=>'form-control','placeholder' => 'Duration'));  !!}
									</div>
									<div class="col-sm-3">
										<span>
											<div class="dd_top_mt dd_rs_mg">Frequency</div>
											{!! Form::select('frequency1[]', $drugFrequency, Input::old('frequency'), $attributes = array('class' => 'form-control dd_input quali','id'=>'frequency1','multiple' => 'multiple')); !!}

										</span>
									</div>	
								</div>	
								@endif
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
								{!! Form::textarea('additional_comment',$prescMedicineVal->treatment,['class'=>'form-control dd_hd_mg_t', 'rows' => 4, 'cols' => 40]) !!}
							</div>
							<div class="col-sm-3 dd_mg_10">
								<span class=""> 
									<?php
									$followupDate = $prescMedicineVal->followup_date;
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
		var drugFrequency = <?php echo json_encode($drugFrequency); ?>;
		var prescMedicine = <?php echo json_encode($prescMedicine); ?>;
			//console.log(prescMedicine);
			$('.prescMedicineShowHide').hide();	
			$('body').on('focus',".date-picker", function(){
				$(this).datepicker();
			});

			$('#frequency1').multiselect();
			
		// This is for creating dynamic frequencies for exisiting cases
		var frequencyArray = <?php echo json_encode($frequencyArray); ?>;

		for(var i=0;i<frequencyArray.length;i++){
				//console.log(frequencyArray[i]);
				$('#'+frequencyArray[i]).multiselect();
			}
		//Ends here	


		if(frequencyArray.length==0 || frequencyArray.length==''  ){
				//setting counter for non existing
				var counter = frequencyArray.length+1;
			}
			else{
				//setting counter for existing
				var counter = frequencyArray.length;
			}

			

			$('.medicine').each(function(index){
				var defaultMedicineDiv = $(this).find('.form-group').length	;
				$('.default_medicine_div').val(defaultMedicineDiv);
			}) ;
			
			var dynamicDivCounter = parseInt($('.default_medicine_div').val()) + parseInt(1);
			$('.btn-add-drug').click(function(e){



	   			//alert(dynamicDivCounter);
	   			$('.total_div_count').val(dynamicDivCounter);
	   			e.preventDefault();
	   			counter++;
	   			$('#medicine').append('<div class="drugDynamic">'+
	   				'<input type="hidden" name="dynamic_medicine_div_counter" value="'+dynamicDivCounter+'"> '+
	   				'<div class="form-group">' +
	   				'<div class="col-sm-2">' + 
	   				'<div class="dd_top_mt dd_rs_mg"></div>'+
	   				'<Input type="text" name="drugs[]" class="form-control drugs" placeholder="Drugs" id="drug">'+
	   				'</div>' +
	   				'<div class="col-sm-2">' +
	   				'<div class="dd_top_mt dd_rs_mg"></div>'+
	   				'<Input type="text" name="dosage[]" class="form-control "'+'placeholder="Dosage" >'+ 
	   				'</div>' +

	   				'<div class="col-sm-2">' + 
	   				'<div class="dd_top_mt dd_rs_mg"></div>'+
	   				'<Input type="text" name="start_date[]" class="form-control date-picker" placeholder="Start Date"data-date-viewmode="years" data-date-format="dd-mm-yyyy">'+
	   				'</div>' +
	   				'<div class="col-sm-2">' +
	   				'<div class="dd_top_mt dd_rs_mg"></div>'+
	   				'<Input type="text" name="duration[]" class="form-control "'+'placeholder="Duration" >'+ 
	   				'</div>' +
	   				'<div class="col-sm-2">' +
	   				'<div class="dd_top_mt dd_rs_mg"></div>'+
	   				'<div class="frequencyDiv">'+
	   				'<select name="frequency'+dynamicDivCounter+'[]" class="form-control search-select frequency" id="frequency'+dynamicDivCounter+'"  multiple ="multiple">' +
	   				'</select>'	+
	   				'</div>'+	
	   				'</div>' +
	   				'<div class="col-sm-2">' +
	   				'<button name="btn-drugmore-remove" class="btn btn-danger btn-drugmore-remove  dd_medicine_remove pull-right" id="btn-drugmore-remove'+dynamicDivCounter+'">Remove</button' +
	   				'</div>' +
	   				'</div>' +

	   				'</div>'


	   				);


	   			for(ind in drugFrequency){
										//console.log("ind"+ind);
										//console.log("dFre"+drugFrequency[ind]);
										$('#frequency'+counter).append('<option value='+ind+'>'+drugFrequency[ind]+'</option>');
									}
									$('#frequency'+counter).multiselect();


									$('#btn-drugmore-remove'+counter).click(function(e){
										
										e.preventDefault();
										var elements = $(this).closest('.drugDynamic').remove();
										var dynamicDivAppendCounter = $('.dynamic_medicine_div').val();
										$('.dynamic_medicine_div').val(dynamicDivAppendCounter - 1);
										
									});
									dynamicDivCounter++;		

									$('.medicine').each(function(index){
										var dynamicTotalCount = $(this).find('.drugDynamic').length;
										$('.dynamic_medicine_div').val(dynamicTotalCount);
									}) ;


								});


			$('#btn-drugmore-remove'+counter).click(function(e){

				e.preventDefault();
				var elements = $(this).closest('.drugDynamic').remove();



			});			

			$('.present-drug-btn').click(function(e){
				e.preventDefault();
				$('.prescMedicineShowHide').show();
			})


			$('.default-drug-remove').click(function(e){
				e.preventDefault();
				var elements = $(this).closest('.form-group').remove();
				var defaultMedicineCount = $('.default_medicine_div').val();
				$('.default_medicine_div').val(defaultMedicineCount-1);
   					//console.log(elements);
   				})



		});

	</script>

	@stop	