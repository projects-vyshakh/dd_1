@section('head')

	{!!Html::style('assets/plugins/datepicker/css/datepicker.css')!!}
    {!!Html::style('assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css')!!}
    {!!Html::style('assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css')!!}
    

@stop
@extends('layouts.master')

@section('main')
	<div class="page-header">
		<h1>Patient Personal Information <small></small></h1>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<!-- start: TEXT FIELDS PANEL -->
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-external-link-square"></i>
					 Patient Id : <b>HOS102030</b>
					<div class="panel-tools">
						Date : <b> <?php echo date('d-M-Y'); ?> </b>
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
					<!-- <div class="form-group">
						{!! Form::label('patient_id', 'Patient Id : ', $attributes = array('class'=>'col-sm-2 control-label'));  !!}
						<div class="col-sm-4">
							<span class="input-icon">
								{!! Form::text('patient_id', 'null', $attributes = array('class'=>'form-control', 'readonly' => 'readonly'));  !!}
								<i class="fa fa-user"></i> 
							</span>
						</div>
						{!! Form::label('patient_name', 'Patient Name : ', $attributes = array('class'=>'col-sm-2 control-label'));  !!}
						<div class="col-sm-4">
							
							<span class="input-icon">
								{!! Form::text('patient_name', 'null', $attributes = array('class'=>'form-control', 'readonly' => 'readonly'));  !!}
								<i class="fa fa-user"></i> 
							</span>
						</div>
					</div>
					<hr> -->
					<div class="form-group">
					    <!-- {!! Form::label('first_name', 'First Name', $attributes = array('class'=>'col-sm-2 control-label'));  !!} -->		
						<div class="col-sm-4">
							<span class="input-icon">
								{!! Form::text('first_name', null, $attributes = array('class'=>'form-control','placeholder' => 'First Name'));  !!}
								<i class="fa fa-user"></i> 
							</span>
						</div>
						<!-- {!! Form::label('first_name', 'First Name', $attributes = array('class'=>'col-sm-2 control-label'));  !!} -->	
						<div class="col-sm-4">
							<span class="input-icon">
								{!! Form::text('middle_name', null, $attributes = array('class'=>'form-control','placeholder' => 'Middle Name'));  !!}
								<i class="fa fa-quote-left"></i> </span>
						</div>
						<div class="col-sm-4">
							<span class="input-icon">
								{!! Form::text('last_name', null, $attributes = array('class'=>'form-control','placeholder' => 'Last Name'));  !!}
								<i class="fa fa-quote-left"></i> </span>
						</div>
					</div>
					<hr>
					<div class="form-group">
					    {!! Form::label('aadhar_no', 'Aadhar / Id No.', $attributes = array('class'=>'col-sm-2 control-label'));  !!}		
						<div class="col-sm-4">
							<span class="input-icon">
								{!! Form::text('aadhar_no', 'Aadhar / Id No', $attributes = array('class'=>'form-control'));  !!}
								<i class="fa fa-user"></i> 
							</span>
						</div>
						{!! Form::label('gender', 'Gender', $attributes = array('class'=>'col-sm-2 control-label'));  !!}
						<div class="col-sm-4">
							<span class="input-icon">
								
								 {!! Form::select('gender', $gender, null, $attributes = array('class' => 'form-control')); !!}
								
							</span>
						</div>
					</div>	
					<div class="form-group">
						{!! Form::label('dob', 'Date Of Birth.', $attributes = array('class'=>'col-sm-2 control-label'));  !!}		
						<div class="col-sm-2">
							<span class="input-icon">
								{!! Form::text('dob', Input::old('dob'), $attributes = array('class' => 'form-control date-picker', 'placeholder'=>'Select date','data-date-viewmode'=>'years','data-date-format'=>'dd/mm/yyyy')); !!}
								<i class="fa fa-user"></i> 
								
							</span>
						</div>
						{!! Form::label('age', 'Age', $attributes = array('class'=>'control-label col-sm-1'));  !!}	
						<div class="col-sm-1">
							<span class="input-icon">
								{!! Form::text('age', Input::old('age'), $attributes = array('class' => 'form-control ', 'id' => 'age')); !!}
								<!-- <i class="fa fa-user"></i>  -->
							</span>
						</div>

						{!! Form::label('maritial_status', 'Maritial Status', $attributes = array('class'=>'col-sm-2 control-label'));  !!}		
						<div class="col-sm-4">
							<span class="input-icon">
								{!! Form::select('maritial_status', $maritialStatus, null, $attributes = array('class' => 'form-control')); !!}
							<!-- 	{!! Form::text('maritial_status', Input::old('maritial_status'), $attributes = array('class' => 'form-control')); !!} -->
								<i class="fa fa-user"></i> 
								
							</span>
						</div>
					</div>
					<hr>
					<div class="form-group">
						{!! Form::label('house', 'House No / Name', $attributes = array('class'=>'col-sm-2 control-label'));  !!}		
						<div class="col-sm-4">
							<span class="input-icon">
								{!! Form::text('house', Input::old('house'), $attributes = array('class'=>'form-control', 'placeholder' => 'House No / Name'));  !!}
								<i class="fa fa-user"></i> 
							</span>
						</div>
						{!! Form::label('street', 'Street Name', $attributes = array('class'=>'col-sm-2 control-label'));  !!}		
						<div class="col-sm-4">
							<span class="input-icon">
								{!! Form::text('street', Input::old('street'), $attributes = array('class'=>'form-control', 'placeholder' => 'Street Name'));  !!}
								<i class="fa fa-user"></i> 
							</span>
						</div>
					</div>
					<div class="form-group">
						{!! Form::label('country', 'Country', $attributes = array('class'=>'col-sm-2 control-label'));  !!}		
						<div class="col-sm-4">
							<span class="input-icon">
								<!-- {!! Form::select('country', $country, $attributes = array('class'=>'form-control', 'placeholder' => 'City Name'));  !!} -->
								{!! Form::select('country', $country, null, $attributes = array('class' => 'form-control')); !!}
								<!-- <i class="fa fa-user"></i>  -->
							</span>
						</div>
						{!! Form::label('state', 'State', $attributes = array('class'=>'col-sm-2 control-label'));  !!}		
						<div class="col-sm-4">
							<span class="input-icon">
								{!! Form::select('state', $state, null, $attributes = array('class' => 'form-control')); !!}
								
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
								{!! Form::text('city', Input::old('city'), $attributes = array('class' => 'form-control', 'placeholder' => 'City')); !!}
								<!-- <i class="fa fa-user"></i>  -->
							</span>
						</div>
						{!! Form::label('pincode', 'Pincode', $attributes = array('class'=>'col-sm-2 control-label'));  !!}		
						<div class="col-sm-4">
							<span class="input-icon">
								<!-- {!! Form::select('country', $country, $attributes = array('class'=>'form-control', 'placeholder' => 'City Name'));  !!} -->
								{!! Form::text('pincode', Input::old('pincode'), $attributes = array('class' => 'form-control', 'placeholder' => 'Pincode')); !!}
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
								{!! Form::text('phone', Input::old('phone'), $attributes = array('class' => 'form-control', 'placeholder' => 'Phone Number')); !!}
								<!-- <i class="fa fa-user"></i>  -->
							</span>
						</div>
						{!! Form::label('email', 'Email', $attributes = array('class'=>'col-sm-2 control-label'));  !!}		
						<div class="col-sm-4">
							<span class="input-icon">
								<!-- {!! Form::select('country', $country, $attributes = array('class'=>'form-control', 'placeholder' => 'City Name'));  !!} -->
								{!! Form::text('email', Input::old('email'), $attributes = array('class' => 'form-control', 'placeholder' => 'Email')); !!}
								<!-- <i class="fa fa-user"></i>  -->
							</span>
						</div>
					</div>	
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
	
	 	});
	</script>
@stop	