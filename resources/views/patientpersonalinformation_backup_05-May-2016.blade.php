@section('head')

	{!!Html::style('assets/plugins/datepicker/css/datepicker.css')!!}
    {!!Html::style('assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css')!!}
    {!!Html::style('assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css')!!}
    


@stop
@extends('layouts.master')

@section('main')

<?php
//var_dump($patientData);
if(!empty($patientData)){
	foreach ($patientData as $key => $value) {
		$patientId 	     			= $value->id_patient;
		$firstName 	     			= $value->first_name;
		$middleName      			= $value->middle_name;
		$lastName        			= $value->last_name;
		$aadharNo        			= $value->id_aadhar;
		$patientGender   			= $value->gender;
		$patientDob      			= $value->dob;
		$age             			= $value->age;
		$patientMaritialStatus  	= $value->maritial_status;
		$house           			= $value->house_name;
		$patientStreet          	= $value->street;
		$patientCity            	= $value->city;
		$patientState           	= $value->state;
		$patientCountry         	= $value->country;
		$pincode         			= $value->pincode;
		$phone           			= $value->phone;
		$email           			= $value->email;
		//echo $patientDob;
	}
}
else{
	$newPatientId = Session::get('patientId'); 
}



?>
@if(!empty($patientData))
<input type="hidden" id="state-hidden" value="<?php echo $patientState; ?>">
@endif
	<div class="page-header">
		<h1>Patient Personal Information <small></small></h1>
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
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-external-link-square"></i>
					 Patient Id : <b>@if(!empty($patientData)) {{$patientId}} @else {{$newPatientId}} @endif</b>
					<div class="panel-tools">
						Date : <b> <?php echo $nowDate = date('d-M-Y'); ?> </b>
						<!-- <a class="btn btn-xs btn-link panel-collapse collapses" href="#">
						</a>
						<a class="btn btn-xs btn-link panel-config" href="#panel-config" data-toggle="modal">
							<i class="fa fa-wrench"></i>
						</a>
						<a class="btn btn-xs btn-link panel-refresh" href="#">
							<i class="fa fa-refresh"></i>
						</a>
						<a class="btn btn-xs btn-link panel-expand" href="#">
							<i class="fa fa-resize-full"></i>
						</a>
						<a class="btn btn-xs btn-link panel-close" href="#">
							<i class="fa fa-times"></i>
						</a> -->
					</div>
				</div>
				<div class="panel-body">
					{!! Form::open(array('route' => 'addPatientPersonalInformation', 'role'=>'form', 'id'=>'addPatientPersonalInformation', 'class'=>'form-horizontal','novalidate'=>'novalidate')) !!}
								{!! Form::hidden('id_patient', (!empty($patientData))?$patientId : $newPatientId, $attributes = array('class'=>'form-control'));  !!}
					<div class="form-group">
					    <!-- {!! Form::label('first_name', 'First Name', $attributes = array('class'=>'col-sm-2 control-label'));  !!} -->		
						<div class="col-sm-4">
							<span class="input-icon">
								{!! Form::text('first_name', (!empty($patientData))?$firstName :Input::old('first_name'), $attributes = array('class'=>'form-control','placeholder' => 'First Name'));  !!}
								<i class="clip-user-3"></i> 
							</span>
						</div>
						<div class="col-sm-4">
							<span class="input-icon">
								{!! Form::text('middle_name', (!empty($patientData))?$middleName:Input::old('middle_name'), $attributes = array('class'=>'form-control','placeholder' => 'Middle Name'));  !!}
								<i class="clip-user-3"></i>
						</div>
						<div class="col-sm-4">
							<span class="input-icon">
								{!! Form::text('last_name', (!empty($patientData))?$lastName:Input::old('last_name'), $attributes = array('class'=>'form-control','placeholder' => 'Last Name'));  !!}
								<i class="clip-user-3"></i>
						</div>
						
					</div>

					<hr>
					
					<div class="form-group">
					    {!! Form::label('aadhar_no', 'Aadhar / Id No.', $attributes = array('class'=>'col-sm-2 control-label'));  !!}		
						<div class="col-sm-4">
							<span class="input-icon">
								{!! Form::text('aadhar_no', (!empty($patientData))?$aadharNo :Input::old('aadhar_no'), $attributes = array('class'=>'form-control'));  !!}
								<i class="clip-note"></i>
							</span>
						</div>
						{!! Form::label('gender', 'Gender', $attributes = array('class'=>'col-sm-2 control-label'));  !!}
						<div class="col-sm-4">
							<span class="input-icon">
								<i class="fa fa-male"></i>
								 {!! Form::select('gender', $gender, (!empty($patientData))?$gender:Input::old('gender'), $attributes = array('class' => 'form-control')); !!}
								
							</span>
						</div>
					</div>

					<div class="form-group">

						{!! Form::label('dob', 'Year Of Birth.', $attributes = array('class'=>'col-sm-2 control-label'));  !!}
						
						<div class="col-sm-2">
							<span class="input-icon">
								<i class="clip-calendar"></i>
								{!! Form::text('dob', (!empty($patientData))?$patientDob : Input::old('dob'), $attributes = array('class'=>'form-control'));  !!}

								
								<i class="fa fa-user"></i> 
								
							</span>
						</div>
						{!! Form::label('age', 'Age', $attributes = array('class'=>'control-label col-sm-1'));  !!}	
						<div class="col-sm-1">
							<span class="input-icon">
								{!! Form::text('age', (!empty($patientData))?$age:Input::old('age'), $attributes = array('class' => 'form-control ', 'id' => 'age')); !!}
								<!-- <i class="fa fa-user"></i>  -->
							</span>
						</div>
						{!! Form::label('maritial_status', 'Maritial Status', $attributes = array('class'=>'col-sm-2 control-label'));  !!}		
						<div class="col-sm-4">
							<span class="input-icon">
								{!! Form::select('maritial_status', $maritialStatus, (!empty($patientData))?$patientMaritialStatus : Input::old('maritial_status'), $attributes = array('class' => 'form-control')); !!}
							
								<i class="fa fa-user"></i> 
								
							</span>
						</div>

					</div>	

					<hr>

					<div class="form-group">
						{!! Form::label('house', 'House No / Name', $attributes = array('class'=>'col-sm-2 control-label'));  !!}		
						<div class="col-sm-4">
							<span class="input-icon">
								{!! Form::text('house',(!empty($patientData))?$house: Input::old('house'), $attributes = array('class'=>'form-control', 'placeholder' => 'House No / Name'));  !!}
								<i class="fa fa-user"></i> 
							</span>
						</div>
						{!! Form::label('street', 'Street Name', $attributes = array('class'=>'col-sm-2 control-label'));  !!}		
						<div class="col-sm-4">
							<span class="input-icon">
								{!! Form::text('street',(!empty($patientData))?$patientStreet: Input::old('street'), $attributes = array('class'=>'form-control', 'placeholder' => 'Street Name'));  !!}
								<i class="fa fa-user"></i> 
							</span>
						</div>
					</div>

					<div class="form-group">
						{!! Form::label('country', 'Country', $attributes = array('class'=>'col-sm-2 control-label'));  !!}		
						<div class="col-sm-4">
							<span class="input-icon">
								<!-- {!! Form::select('country', $country, $attributes = array('class'=>'form-control', 'placeholder' => 'City Name'));  !!} -->
								{!! Form::select('country', $country, (!empty($patientData))?$patientCountry: Input::old('country'), $attributes = array('class' => 'form-control')); !!}
								<!-- <i class="fa fa-user"></i>  -->
							</span>
						</div>
						{!! Form::label('state', 'State', $attributes = array('class'=>'col-sm-2 control-label'));  !!}		
						<div class="col-sm-4">
							<span class="input-icon">
								{!! Form::select('state', $state, (!empty($patientData))?$patientState: Input::old('state'), $attributes = array('class' => 'form-control')); !!}
								
								<!-- <i class="fa fa-user"></i>  -->
							</span>
						</div>
					</div>

					<div class="form-group">
						{!! Form::label('city', 'City', $attributes = array('class'=>'col-sm-2 control-label'));  !!}		
						<div class="col-sm-4">
							<span class="input-icon">
								<!-- {!! Form::select('country', $country, $attributes = array('class'=>'form-control', 'placeholder' => 'City Name'));  !!} -->
								<!-- {!! Form::select('city', $city, null, $attributes = array('class' => 'form-control')); !!} -->
								{!! Form::text('city', (!empty($patientData))?$patientCity: Input::old('city'), $attributes = array('class' => 'form-control', 'placeholder' => 'City')); !!}
								<!-- <i class="fa fa-user"></i>  -->
							</span>
						</div>
						{!! Form::label('pincode', 'Pincode', $attributes = array('class'=>'col-sm-2 control-label'));  !!}		
						<div class="col-sm-4">
							<span class="input-icon">
								<!-- {!! Form::select('country', $country, $attributes = array('class'=>'form-control', 'placeholder' => 'City Name'));  !!} -->
								{!! Form::text('pincode', (!empty($patientData))?$pincode:Input::old('pincode'), $attributes = array('class' => 'form-control', 'placeholder' => 'Pincode')); !!}
								<!-- <i class="fa fa-user"></i>  -->
							</span>
						</div>
					</div>	

					<hr>

					<div class="form-group">
						{!! Form::label('phone', 'Phone No', $attributes = array('class'=>'col-sm-2 control-label'));  !!}		
						<div class="col-sm-4">
							<span class="input-icon">
								<!-- {!! Form::select('country', $country, $attributes = array('class'=>'form-control', 'placeholder' => 'City Name'));  !!} -->
								{!! Form::text('phone', (!empty($patientData))?$phone:Input::old('phone'), $attributes = array('class' => 'form-control', 'placeholder' => 'Phone Number')); !!}
								<!-- <i class="fa fa-user"></i>  -->
							</span>
						</div>
						{!! Form::label('email', 'Email', $attributes = array('class'=>'col-sm-2 control-label'));  !!}		
						<div class="col-sm-4">
							<span class="input-icon">
								<!-- {!! Form::select('country', $country, $attributes = array('class'=>'form-control', 'placeholder' => 'City Name'));  !!} -->
								{!! Form::text('email', (!empty($patientData))?$email: Input::old('email'), $attributes = array('class' => 'form-control', 'placeholder' => 'Email')); !!}
								<!-- <i class="fa fa-user"></i>  -->
							</span>
						</div>
					</div>	

					{!! Form::hidden('now_date', $nowDate, $attributes = array('class'=>'form-control','placeholder' => 'First Name'));  !!}

					<div class="form-group">
						<div class="col-sm-10"></div>
						<div class="col-sm-2">
							<button type="submit" class="btn btn-primary btn-block">Save</button>
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

			/*Dynamically adding state responding to country and also keeping selected value of state*/
			var stateHidden = $('#state-hidden').val();
          	var countryId  = $( "#country option:selected" ).val();
            //alert(country);
            $.ajax({
                type: "POST",
                url: "getState",
                data: "country_id="+ countryId ,
                success: function(data){
                    $('#state').empty();
                    for(var s=0;s<data.length;s++){

                        $('#state').append('<option>'+data[s].state_name+'</option>');
                        $('#state').val(stateHidden).attr("selected", "selected");

                    }
                }
            });

            
			
	
	 	});
	</script>
@stop	