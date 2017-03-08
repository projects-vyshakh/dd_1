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

	{!!Html::style('assets/plugins/datepicker/css/datepicker.css')!!}
    {!!Html::style('assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css')!!}
    {!!Html::style('assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css')!!}

@stop
@extends('layouts.master', ['specialization'=>$doctorSpecialization,'patientName'=>$patientName])
<style>

</style>
@section('main')
<div class="loader"></div>

@if(!empty($patientData))
<input type="hidden" id="state-hidden" value="<?php echo $patientState; ?>">
@endif
	<div class="page-header">
		<h1>Patient Personal Information <small></small></h1>
	</div>
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

			
			<div class="panel-body">
				{!! Form::open(array('route' => 'addCardioPersonalInformation', 'role'=>'form', 'id'=>'addCardioPersonalInformation', 'class'=>'form-horizontal','novalidate'=>'novalidate')) !!}
					{!! Form::hidden('id_patient', (!empty($patientData))?$patientId : $newPatientId, $attributes = array('class'=>'form-control'));  !!}
					<div class="form-group">
						<div class="col-sm-4">
							<span class="">
								{!! Form::text('first_name', (!empty($patientData))?$firstName :Input::old('first_name'), $attributes = array('class'=>'form-control dd_rs_mg dd_phone_from_bg','placeholder' => 'First Name','id'=>'first_name'));  !!}
								<!-- <i class="fa fa-user"></i>  -->
								
							 	<span class="symbol required dd_name_abs"></span> 	
							 	
							</span>
						</div>
						<div class="col-sm-4">
							<span class="">
								{!! Form::text('middle_name', (!empty($patientData))?$middleName:Input::old('middle_name'), $attributes = array('class'=>'form-control dd_rs_mg dd_phone_from_bg','placeholder' => 'Middle Name','id'=>'middle_name'));  !!}
								<!-- <i class="fa fa-quote-left"></i> --> 
							</span>
						</div>
						<div class="col-sm-4">
							<span class="">
								{!! Form::text('last_name', (!empty($patientData))?$lastName:Input::old('last_name'), $attributes = array('class'=>'form-control dd_rs_mg dd_phone_from_bg','placeholder' => 'Last Name','id'=>'last_name'));  !!}
								<!-- <i class="fa fa-quote-left"></i> -->
								<span class="required dd_name_abs"></span> 
							</span>
						</div>
					</div>
									<hr class="dd_PDB_40_3">

					<div class="row  dd_color">
						<div class="col-sm-6 dd_PDR_40">
							<div class="form-group dd_fromgroup_MG_0">
								<div class="col-sm-12 dd_PDB_10 ">
								<div class="col-sm-4">
									Aadhar / ID No.
							 	<!-- <span class="symbol required"></span> 	 -->
							 	</div>
										<div class="col-sm-8">
											<span class="">
												{!! Form::text('aadhar_no', (!empty($patientData))?$aadharNo :Input::old('aadhar_no'), $attributes = array('class'=>'form-control','placeholder'=>'','id'=>'aadhar_no'));  !!}
											</span>
										</div>
								</div>
								<div class="col-sm-12 dd_PDB_10 ">
									<!-- {!! Form::label('gender', 'Gender', $attributes = array('class'=>'col-sm-4'));  !!} -->

								<div class="col-sm-4">
									Gender
							 	<span class="symbol required"></span> 	
							 	</div>
									<div class="col-sm-8">
										<span class="input-icon">
											{!! Form::select('gender', $gender, (!empty($patientData))?$patientGender:Input::old('gender'), $attributes = array('class' => 'form-control','id'=>'gender')); !!}
										</span>
									</div>
								</div>
							</div>
							<div class="form-group dd_fromgroup_MG_0">
								<div class="col-sm-12 dd_PDB_10 ">
								<!-- 	{!! Form::label('dob', 'Year Of Birth.', $attributes = array('class'=>'col-sm-4'));  !!} -->

								<div class="col-sm-4">
									Year of Birth
							 	<span class="symbol required"></span> 	
							 	</div>
									<div class="col-sm-8">
										<span class="">
											{!! Form::text('dob', (!empty($patientData))?$patientDob: Input::old('dob'), $attributes = array('class' => 'form-control', 'placeholder'=>'','id'=>'dob')); !!}
										</span>
									</div>
								</div>
								<div class="col-sm-12 dd_PDB_10 ">
								<!-- 	{!! Form::label('age', 'Age', $attributes = array('class'=>' col-sm-4'));  !!} -->

								<div class="col-sm-4">
									Age
							 	<span class="symbol required"></span> 	
							 	</div>
									<div class="col-sm-8">
										<span class="">
											{!! Form::text('age', (!empty($patientData))?$age:Input::old('age'), $attributes = array('class' => 'form-control ', 'id' => 'age','placeholder'=>"",'id'=>'age')); !!}
										</span>
									</div>
								</div>
								<div class="col-sm-12 dd_PDB_10 ">
									<!-- {!! Form::label('maritial_status', 'Maritial Status', $attributes = array('class'=>'col-sm-4 '));  !!} -->	


								<div class="col-sm-4">
									Maritial Status
							 	<span class="symbol required"></span> 	
							 	</div>	
									<div class="col-sm-8">
										<span class="">
											{!! Form::select('maritial_status', $maritialStatus, (!empty($patientData))?$patientMaritialStatus : Input::old('maritial_status'), $attributes = array('class' => 'form-control','id'=>'maritial_status')); !!}
										</span>
									</div>
								</div>

								<div class="col-sm-12 dd_PDB_10">
									{!! Form::label('refferedby', 'Referred By', $attributes = array('class'=>'col-sm-4 '));  !!}
									<div class="col-sm-8">
										<span class="">
											@if(!empty($refferedBy))
												{!! Form::text('refferedby',$refferedBy, $attributes = array('class'=>'form-control', 'placeholder' => ''));  !!}
											@else
												{!! Form::text('refferedby',Input::old('refferedby'), $attributes = array('class'=>'form-control', 'placeholder' => ''));  !!}
											@endif
										</span>
									</div>
								</div>
							<!-- 	<div class="col-sm-12 dd_PDB_10 ">
									<div class="col-sm-4">
										
								 		<span class="symbol required"></span> 	
								 	</div>	
									<div class="col-sm-8">
										<span class="">
											{!! Form::select('refferedby', $doctorsList,!empty($patientData)?$refferedBy:  Input::old('refferedby'), $attributes = array('class' => 'form-control','id'=>'refferedby')); !!}
											
										</span>
									</div>
								</div> -->
							</div>	
						</div>
						<div class="col-sm-6 dd_PDL_40"> 
							<div class="form-group dd_fromgroup_MG_0">
								 <div class="col-sm-12 dd_PDB_10">
									{!! Form::label('house', 'House No / Name', $attributes = array('class'=>'col-sm-4 '));  !!}
									<div class="col-sm-8">
										<span class="">
											{!! Form::text('house',(!empty($patientData))?$house: Input::old('house'), $attributes = array('class'=>'form-control', 'placeholder' => ''));  !!}
										</span>
									</div>
								</div>
								<div class="col-sm-12 dd_PDB_10">
									{!! Form::label('street', 'Street Name', $attributes = array('class'=>'col-sm-4 '));  !!}	<div class="col-sm-8">
										<span class="">
											{!! Form::text('street',(!empty($patientData))?$patientStreet: Input::old('street'), $attributes = array('class'=>'form-control', 'placeholder' => ''));  !!}
										</span>
									</div>
								</div>
					   		</div>
							<div class="form-group dd_fromgroup_MG_0 ">
								<div class="col-sm-12 dd_PDB_10">
									<!-- {!! Form::label('country', 'Country', $attributes = array('class'=>'col-sm-4 '));  !!} -->

								<div class="col-sm-4">
									Country
							 	<span class="symbol required"></span> 	
							 	</div>		
									<div class="col-sm-8">
										<span class="">
										{!! Form::select('country', $country, $patientCountry , $attributes = array('class' => 'form-control country','id'=>'country')); !!}
										</span>
									</div>
								</div>
								<div class="col-sm-12 dd_PDB_10">
									<!-- {!! Form::label('state', 'State', $attributes = array('class'=>'col-sm-4'));  !!} -->

								<div class="col-sm-4">
									State
							 	<span class="symbol required"></span> 	
							 	</div>		
									<div class="col-sm-8">
										<span class="">
											{!! Form::select('state',[], (!empty($patientData))?$patientState: Input::old('state'), $attributes = array('class' => 'form-control state','id'=>'state')); !!}
										</span>
									</div>
								</div>
							</div>
							<div class="form-group dd_fromgroup_MG_0">
							    <div class="col-sm-12 dd_PDB_10">
								<!-- 	{!! Form::label('city', 'City', $attributes = array('class'=>'col-sm-4'));  !!}	 -->

								<div class="col-sm-4">
									City
							 	<span class="symbol required"></span> 	
							 	</div>	
									<div class="col-sm-8">
										<span class="">
											{!! Form::text('city', (!empty($patientData))?$patientCity: Input::old('city'), $attributes = array('class' => 'form-control', 'placeholder' => '','id'=>'city')); !!}
										</span>
									</div>
								</div>
								<div class="col-sm-12 dd_PDB_10">
									{!! Form::label('pincode', 'Pincode', $attributes = array('class'=>'col-sm-4'));  !!}		
									<div class="col-sm-8">
										<span class="">
											{!! Form::text('pincode', (!empty($patientData))?$pincode:Input::old('pincode'), $attributes = array('class' => 'form-control', 'placeholder' => '')); !!}
										</span>
									</div>
								</div>
							</div>	
						</div>
					</div>
					<hr class="dd_PDB_40">
					<div class="row dd_mg_btn_10">
						<div class="form-group dd_fromgroup_MG_0">
							<div class="col-sm-6  dd_PDB_10 ">
								<div class="col-sm-5"></div>	
									<div class="col-sm-7">
										<span class="input-icon">
											{!! Form::text('phone', (!empty($patientData))?$phone:Input::old('phone'), $attributes = array('class' => 'form-control dd_phone_from_bg', 'placeholder' => 'Phone Number')); !!}
											<i class="fa fa-phone-square" aria-hidden="true"></i>
										</span>
									</div>
							</div>
							<div class="col-sm-6  dd_PDB_10 "> 
								<div class="col-sm-7">
									<span class="input-icon">
										{!! Form::text('email', (!empty($patientData))?$email: Input::old('email'), $attributes = array('class' => 'form-control dd_phone_from_bg', 'placeholder' => 'Email')); !!}
										<i class="fa fa-envelope" aria-hidden="true"></i>
									</span>
								</div>
								<div class="col-sm-5"></div>
							</div>
						</div>	
					</div>
					<hr>
					<div class="row dd_btn_mg_TB_10">
						{!! Form::hidden('now_date', $nowDate, $attributes = array('class'=>'form-control'));  !!}
           				<div class="form-group dd_fromgroup_MG_0">
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
		
		{!!Html::script('assets/js/cardio-personal-information.js')!!}

		{!!Html::script('assets/js/utility-common.js')!!}
		
		{!!Html::script('assets/plugins/jquery-validation/dist/jquery.validate.min.js')!!}
		
        {!!Html::style('assets/css/dd-responsive.css')!!}

		
		
	<script>
		$(document).ready(function() {
			Main.init();
			//patientElements.init();
			utilityCommonElements.init();
			cardioPersonalInformation.init();

		
	 	});
	</script>
@stop	