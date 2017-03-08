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
	$pid=$patientId;
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
	$pid=$newPatientId;
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
    

    {!!Html::style('assets/plugins/fileinput/css/fileinput.min.css')!!}
    <!-- {!!Html::style('assets/plugins/fileinput/themes/explorer/theme.css',array('media'=>'all'))!!} -->

 
    

    
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
		<h1>Upload Patient Report <small></small></h1>
	</div>
	<div class="page-header">
		<h4>Patient ID:</h4><h3>{{$pid}}</h3>
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
      		@if(empty($patientData))
                <div class="alert alert-danger display-none" style="display: block;">
                  <a class="close" aria-hidden="true" href="#" data-dismiss="alert">×</a>
                          {{"Please save patient personal information."}}
                </div>
            @endif

			<!-- <div class="panel-body">
				{!! Form::open(array('route' => 'addPathologyReportUpload', 'role'=>'form', 'id'=>'addPathologyReportUpload', 'class'=>'form-horizontal','novalidate'=>'novalidate')) !!}
					<div class="form-group ">
						{!! Form::label('pathology_name', 'Pathology Test Name:', $attributes = array('class'=>'col-sm-3'));  !!}
						{!! Form::text('refferedby',Input::old('refferedby'), $attributes = array('class'=>'', 'placeholder' => ''));  !!}

					</div>
				{!! Form::close() !!}
			</div> -->

			<div class="panel-body">
				{!! Form::open(array('route' => 'addPathologyReportUpload', 'role'=>'form', 'id'=>'addPathologyReportUpload', 'class'=>'form-horizontal','novalidate'=>'novalidate','enctype'=>'multipart/form-data')) !!}
					{!! Form::hidden('id_patient', (!empty($patientData))?$patientId : $newPatientId, $attributes = array('class'=>'form-control'));  !!}
					<div class="form-group">
						{!! Form::label('pathology_name', 'Pathology Test Name:', $attributes = array('class'=>'col-sm-2'));  !!}
						<div class="col-sm-3">
							<span class="">
								<!-- {!! Form::text('pathology_name', Input::old('pathology_name'), $attributes = array('class'=>'form-control dd_rs_mg dd_phone_from_bg pathology_name','placeholder' => 'Test Name','id'=>'pathology_name'));  !!} -->
								<!-- <i class="fa fa-user"></i>  -->
								
								{!! Form::select('pathology_name', $testName, '', $attributes = array('class' => 'form-control dd_rs_mg dd_phone_from_bg pathology_name','id'=>'pathology_name')); !!}
							 	
							 	
							</span>
						</div>
						
						<div class="col-sm-4 ">
							
								<span class="">
									<!-- {!! Form::file('photo', Input::old('photo'), $attributes = array('class'=>'form-control', 'value'=>'Browse'));  !!} -->

									<!-- {!! Form::file('photo', Input::old('photo'), $attributes = array('class'=>'form-control file file-caption kv-fileinput-caption"', 'value'=>'Browse','id'=>'	file-0c'));  !!}
 -->
									<input id="report_file" class="file form-control file-caption  kv-fileinput-caption" type="file" name="report_file" data-preview-file-type="text" accept=".pdf">
								</span>
							

						</div>
						
					</div>
					<div class="form-group ">
						<div class="col-sm-12 row">
						 	<div class="col-sm-6 row">
					 			<!-- <button type="submit" class="btn btn-default btn-block dd_btn_center">
								
								Add More</button> -->
									
						 	</div>
						 	@if(!empty($patientData))
								<div class="col-sm-6 row">
							 			<button type="submit" class="btn btn-primary btn-block dd_btn_center">
										<!-- <i class="fa fa-floppy-o" aria-hidden="true"></i> -->
										Save</button>
											
								 	</div>
							@else
								<div class="col-sm-6 row">
								 			<button type="submit" class="btn btn-primary btn-block dd_btn_center" disabled="disabled">
											<!-- <i class="fa fa-floppy-o" aria-hidden="true"></i> -->
											Save</button>
												
							 	</div>
						
							@endif
						 	
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
		
		{!!Html::script('assets/js/pathologypersonalinformation.js')!!}
		
		{!!Html::script('assets/plugins/jquery-validation/dist/jquery.validate.min.js')!!}
		
        {!!Html::style('assets/css/dd-responsive.css')!!}

        {!!Html::script('assets/js/utility-common.js')!!}
        
        {!!Html::script('assets/js/pathology-report-upload.js')!!}

		{!!Html::script('assets/plugins/fileinput/js/plugins/sortable.js')!!}
		{!!Html::script('assets/plugins/fileinput/js/fileinput.min.js')!!}

		
    
   


		
	<script>
		



		$(document).ready(function() {
			Main.init();

				
			utilityCommonElements.init();
			reportUploadElements.init();
			pathologyPatientPersonalInformation.init();

			$("#report_file").fileinput(
			{
				

			});

			
			
	 	});
	</script>
@stop	