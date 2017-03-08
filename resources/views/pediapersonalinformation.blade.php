<?php
//var_dump($patientData);
$nowDate = date('d-M-Y');

if(!empty($patientData)){
	//echo "ss";
	$patientId 	     			= $patientData->id_patient;
	$firstName 	     			= $patientData->first_name;
	$middleName      			= $patientData->middle_name;
	$lastName        			= $patientData->last_name;
	$aadharNo        			= $patientData->id_aadhar;
	$patientGender   			= $patientData->gender;
	$patientDob      			= $patientData->dob;
	$age             			= $patientData->age;
	$patientMaritialStatus  	= $patientData->maritial_status;
	$house           			= $patientData->house_name;
	$patientStreet          	= $patientData->street;
	$patientCity            	= $patientData->city;
	$patientState           	= $patientData->state;
	$patientCountry         	= $patientData->country;
	$pincode         			= $patientData->pincode;
	$phone           			= $patientData->phone;
	$email           			= $patientData->email;
	$refferedBy 				= $patientData->reffered_by;

	$patientName = $firstName." ".$lastName;
}
else{
	$newPatientId = Session::get('patientId'); 
	$patientName = "";
	$firstName 	     			= "";
	$middleName      			= "";
	$lastName        			= "";
	$aadharNo        			= "";
	$patientGender   			= "";
	$patientDob      			= "";
	$age             			= "";
	$patientMaritialStatus  	= "";
	$house           			= "";
	$patientStreet          	= "";
	$patientCity            	= "";
	$patientState           	= "";
	$patientCountry         	= "101";
	$pincode         			= "";
	$phone           			= "";
	$email           			= "";
	$refferedBy 				= "";
}

if(!empty($doctorData)){
	$doctorSpecialization = $doctorData->specialization;
}
else{
	$doctorSpecialization = "";
}


?>
@section('head')

	

    <!-- This page only -->
    {!!Html::style('assets/css/dd-responsive.css')!!}
    {!!Html::style('assets/plugins/zebra-datepicker/css/default.css')!!}
    {!!Html::style('assets/plugins/zebra-datepicker/css/style.css')!!}

@stop
@extends('layouts.master', ['specialization'=>$doctorSpecialization,'patientName'=>$patientName])
<style>
	.loader 
	{
        position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background: url('../assets/images/page_loading.gif') 50% 50% no-repeat rgb(249,249,249);
    }
    textarea{
    	resize: none;
    }
</style>
@section('main')
<div class="loader"></div>

@if(!empty($patientData))
<input type="hidden" id="state-hidden" value="<?php echo $patientState; ?>">
@endif
	<div class="page-header">
		<h1>Patient Personal Information <small></small></h1>
	</div>

	<div class="col-sm-12"><h3>School / kindergarten</h3></div>

	<div class="row">
		<div class="col-sm-12">
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

			{!! Form::open(array('route' => 'addPediaPersonalInformation', 'role'=>'form', 'id'=>'addPediaPersonalInformation', 'class'=>'form-horizontal','novalidate'=>'novalidate')) !!}
				

				@if(!empty($patientData))
					<div class="panel-body">
						<div class="form-group">
							<div class="col-sm-1">
								{!! Form::label('school_name', 'Name', $attributes = array('class'=>"dd_kids_Name"));  !!}
								<span class="symbol required"></span>
							</div>
							<div class="col-sm-6">
								{!! Form::text('school_name', !empty($patientData->school_name)?$patientData->school_name:Input::old('school_name'), $attributes = array('class'=>'form-control school_name','placeholder' => 'School/Kindergarten','id'=>'school_name'));  !!}
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-1">
								{!! Form::label('school_address', 'Address', $attributes = array('class'=>"dd_kids_Name"));  !!}
								<span class="symbol required"></span>
							</div>
							<div class="col-sm-6">
								{!! Form::textarea('school_address', !empty($patientData->school_address)?$patientData->school_address:Input::old('school_address'),array('class'=>'form-control school_address','size'=>'49x5')) !!}
								<!-- {!! Form::textarea('school_address', Input::old('school_address'), $attributes = array('class'=>'form-control school_address','placeholder' => 'Address','id'=>'school_address','cols'=>'2'));  !!} -->
							</div>
						</div>
					</div>
				@else
					<div class="panel-body">
						<div class="form-group">
							<div class="col-sm-1">
								{!! Form::label('school_name', 'Name', $attributes = array('class'=>"dd_kids_Name"));  !!}
								<span class="symbol required"></span>
							</div>
							<div class="col-sm-6">
								{!! Form::text('school_name', Input::old('school_name'), $attributes = array('class'=>'form-control school_name','placeholder' => 'School/Kindergarten','id'=>'school_name'));  !!}
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-1">
								{!! Form::label('school_address', 'Address', $attributes = array('class'=>"dd_kids_Name"));  !!}
								<span class="symbol required"></span>
							</div>
							<div class="col-sm-6">
								{!! Form::textarea('school_address', null,array('class'=>'form-control school_address','size'=>'49x5')) !!}
								<!-- {!! Form::textarea('school_address', Input::old('school_address'), $attributes = array('class'=>'form-control school_address','placeholder' => 'Address','id'=>'school_address','cols'=>'2'));  !!} -->
							</div>
						</div>
					</div>

				@endif
				
				<hr class="dd_PDB_40_3">		
					
				<div class="dd_color">
					<div class="col-sm-12">
						<h3>Student</h3>
					</div>
				</div>	
				@if(!empty($patientData))
					<div class="panel-body">	
						<div class="row">
							<div class="col-xs-12 col-sm-3">
								<span class="input-icon">
							  	{!! Form::label('first_name', 'First Name', $attributes = array('class'=>"dd_kids_Name"));  !!}
							  	<span class="symbol required"></span>
							  	{!! Form::text('first_name', !empty($patientData->first_name)?$patientData->first_name:Input::old('first_name'), $attributes = array('class'=>'form-control first_name','placeholder' => 'First Name','id'=>'first_name'));  !!}
							  	</span>
							</div>
							<div class="col-xs-12 col-sm-3">
								<span class="input-icon">
							  	{!! Form::label('last_name', 'Last Name', $attributes = array('class'=>"dd_kids_Name"));  !!}
							  	<span class="symbol required"></span>
							  	{!! Form::text('last_name', !empty($patientData->last_name)?$patientData->last_name:Input::old('last_name'), $attributes = array('class'=>'form-control last_name','placeholder' => 'Last Name','id'=>'last_name'));  !!}
							  	</span>
							</div>
						  	<div class="col-xs-12 col-sm-2">
						  		{!! Form::label('stud_class', 'Class', $attributes = array('class'=>"dd_kids_Name"));  !!}
						  		<span class="symbol required"></span>
							  	{!! Form::text('stud_class', !empty($patientData->stud_class)?$patientData->stud_class:Input::old('stud_class'), $attributes = array('class'=>'form-control stud_class','placeholder' => 'Class','id'=>'stud_class'));  !!}
						  	</div>
						  	<div class="col-xs-12 col-sm-2">
						  		{!! Form::label('stud_section', 'Section', $attributes = array('class'=>"dd_kids_Name"));  !!}
						  		<!-- <span class="symbol required"></span> -->
							  	{!! Form::text('stud_section', !empty($patientData->stud_section)?$patientData->stud_section:Input::old('stud_section'), $attributes = array('class'=>'form-control stud_section','placeholder' => 'Section','id'=>'stud_section'));  !!}
						  	</div>
						  	<div class="col-xs-12 col-sm-2">
						  		{!! Form::label('stud_gender', 'Gender', $attributes = array('class'=>"dd_kids_Name"));  !!}
						  		<span class="symbol required"></span>
							  	<span class="input-icon">
									{!! Form::select('stud_gender', $gender, !empty($patientData->gender)?$patientData->gender:Input::old('stud_gender'), $attributes = array('class' => 'form-control stud_gender','id'=>'stud_gender')); !!}
								</span>
						  	</div>


						</div>
						<div class="dd_kids_space"></div>
						<div class="row">
							<div class="col-xs-12 col-sm-6">
							  	{!! Form::label('stud_occupation', 'Occupation(Parent)', $attributes = array('class'=>"dd_kids_Name"));  !!}
							  	
							  	{!! Form::text('stud_occupation', !empty($patientData->stud_parent_occupation)?$patientData->stud_parent_occupation:Input::old('stud_occupation'), $attributes = array('class'=>'form-control stud_occupation','placeholder' => 'Occupation','id'=>'stud_occupation'));  !!} 
							</div>
							<div class="col-xs-12 col-sm-2">
						  		{!! Form::label('stud_dob', 'Date of birth', $attributes = array('class'=>"dd_kids_Name"));  !!}
						  		<span class="symbol required"></span>
							  	{!! Form::text('stud_dob', !empty($patientData->stud_dob)?$patientData->stud_dob:Input::old('stud_dob'), $attributes = array('class'=>'form-control stud_dob','placeholder' => 'Date of birth','id'=>'stud_dob'));  !!}
						  	</div>
						  	<div class="col-xs-12 col-sm-2">
						  		{!! Form::label('stud_age', 'Age', $attributes = array('class'=>"dd_kids_Name"));  !!}
						  		<span class="symbol required"></span>
							  	{!! Form::text('stud_age', !empty($patientData->age)?$patientData->age:Input::old('stud_age'), $attributes = array('class'=>'form-control stud_age','placeholder' => 'Age','id'=>'stud_age','readonly'=>'readonly'));  !!}
						  	</div>
						  	<div class="col-xs-12 col-sm-2">
						  		{!! Form::label('stud_mobile', 'Phone', $attributes = array('class'=>"dd_kids_Name"));  !!}
						  		<span class="symbol required"></span>
							  	{!! Form::text('stud_mobile', !empty($patientData->phone)?$patientData->phone:Input::old('stud_mobile'), $attributes = array('class'=>'form-control stud_mobile','placeholder' => 'Phone','id'=>'stud_mobile'));  !!}
						  	</div>
						</div>
					</div>
				@else
					<div class="panel-body">	
						<div class="row">
							<div class="col-xs-12 col-sm-3">
								<span class="input-icon">
							  	{!! Form::label('first_name', 'First Name', $attributes = array('class'=>"dd_kids_Name"));  !!}
							  	<span class="symbol required"></span>
							  	{!! Form::text('first_name', Input::old('first_name'), $attributes = array('class'=>'form-control first_name','placeholder' => 'First Name','id'=>'first_name'));  !!}
							  	</span>
							</div>
							<div class="col-xs-12 col-sm-3">
								<span class="input-icon">
							  	{!! Form::label('last_name', 'Last Name', $attributes = array('class'=>"dd_kids_Name"));  !!}
							  	<span class="symbol required"></span>
							  	{!! Form::text('last_name', Input::old('last_name'), $attributes = array('class'=>'form-control last_name','placeholder' => 'Last Name','id'=>'last_name'));  !!}
							  	</span>
							</div>
						  	<div class="col-xs-12 col-sm-2">
						  		{!! Form::label('stud_class', 'Class', $attributes = array('class'=>"dd_kids_Name"));  !!}
						  		<span class="symbol required"></span>
							  	{!! Form::text('stud_class', Input::old('stud_class'), $attributes = array('class'=>'form-control stud_class','placeholder' => 'Class','id'=>'stud_class'));  !!}
						  	</div>
						  	<div class="col-xs-12 col-sm-2">
						  		{!! Form::label('stud_section', 'Section', $attributes = array('class'=>"dd_kids_Name"));  !!}
						  		<!-- <span class="symbol required"></span> -->
							  	{!! Form::text('stud_section', Input::old('stud_section'), $attributes = array('class'=>'form-control stud_section','placeholder' => 'Section','id'=>'stud_section'));  !!}
						  	</div>
						  	<div class="col-xs-12 col-sm-2">
						  		{!! Form::label('stud_gender', 'Gender', $attributes = array('class'=>"dd_kids_Name"));  !!}
						  		<span class="symbol required"></span>
							  	<span class="input-icon">
									{!! Form::select('stud_gender', $gender, Input::old('stud_gender'), $attributes = array('class' => 'form-control stud_gender','id'=>'stud_gender')); !!}
								</span>
						  	</div>


						</div>
						<div class="dd_kids_space"></div>
						<div class="row">
							<div class="col-xs-12 col-sm-6">
							  	{!! Form::label('stud_occupation', 'Occupation(Parent)', $attributes = array('class'=>"dd_kids_Name"));  !!}
							  	
							  	{!! Form::text('stud_occupation', Input::old('stud_occupation'), $attributes = array('class'=>'form-control stud_occupation','placeholder' => 'Occupation','id'=>'stud_occupation'));  !!} 
							</div>
							<div class="col-xs-12 col-sm-2">
						  		{!! Form::label('stud_dob', 'Date of birth', $attributes = array('class'=>"dd_kids_Name"));  !!}
						  		<span class="symbol required"></span>
							  	{!! Form::text('stud_dob', Input::old('stud_dob'), $attributes = array('class'=>'form-control stud_dob','placeholder' => 'Date of birth','id'=>'stud_dob'));  !!}
						  	</div>
						  	<div class="col-xs-12 col-sm-2">
						  		{!! Form::label('stud_age', 'Age', $attributes = array('class'=>"dd_kids_Name"));  !!}
						  		<span class="symbol required"></span>
							  	{!! Form::text('stud_age', Input::old('stud_age'), $attributes = array('class'=>'form-control stud_age','placeholder' => 'Age','id'=>'stud_age','readonly'=>'readonly'));  !!}
						  	</div>
						  	<div class="col-xs-12 col-sm-2">
						  		{!! Form::label('stud_mobile', 'Phone', $attributes = array('class'=>"dd_kids_Name"));  !!}
						  		<span class="symbol required"></span>
							  	{!! Form::text('stud_mobile', Input::old('stud_mobile'), $attributes = array('class'=>'form-control stud_mobile','placeholder' => 'Phone','id'=>'stud_mobile'));  !!}
						  	</div>
						</div>
					</div>
				@endif
				
				<hr>
				<div class="">
					<div class="form-group">
					 	<div class="col-sm-12 ">
							<div class="col-sm-12">
								<button type="submit" class="btn btn-primary btn-block dd_btn_center">
								<!-- <i class="fa fa-floppy-o" aria-hidden="true"></i> -->
								Save</button>
							</div>
						</div>
					</div>
				</div>
			{!! Form::close() !!}
		</div>
	</div>	



@stop

@section('scripts')
	@parent
		
		
		
		
		
        

		
		<!-- This page only -->
		{!!Html::script('assets/plugins/jquery-validation/dist/jquery.validate.min.js')!!}
		{!!Html::script('assets/js/pediapersonalinformation.js')!!}
		{!!Html::script('assets/plugins/zebra-datepicker/js/zebra_datepicker.js')!!}
		{!!Html::script('assets/plugins/zebra-datepicker/js/core.js')!!}
		
	<script>
		$(document).ready(function() {
			

			pediaPatientPersonalInformation.init();

           	
            
			
	
	 	});
	</script>
@stop	