<?php

if(!empty($patientData)){
	$patientName = strtoupper($patientData->first_name." ".$patientData->last_name);
}
else{
	$patientName = Session::get('patientName');
}



?>
@section('head')

	{!!Html::style('assets/plugins/datepicker/css/datepicker.css')!!}
    {!!Html::style('assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css')!!}
    {!!Html::style('assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css')!!}
    {!!Html::style('assets/plugins/select2/select2.css')!!}
    <!-- {!!Html::style('assets/plugins/DataTables/media/css/DT_bootstrap.css')!!} -->
    {!!Html::style('assets/plugins/bootstrap-fileupload/bootstrap-fileupload.min.css')!!}
    {!!Html::style('assets/plugins/bootstrap-social-buttons/social-buttons-3.css')!!}
   

  
@stop
@extends('layouts.master')
@section('main')

	<div class="row">
		<div class="col-sm-12">
			<div class="page-header" style="margin-bottom: 55px">
				<h1>Password Change <small></small></h1>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
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
			<div class="panel">
				<div class="panel-body">
					{!! Form::open(array('route' => 'handlePatientChangePassword', 'role'=>'form', 'id'=>'patientChangePassword', 'class'=>'form-horizontal patientChangePassword','novalidate'=>'novalidate')) !!}
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								{!! Form::label('old_password', 'Old Password', $attributes = array('class'=>'col-sm-2 '));  !!}		
									<div class="col-sm-4">
										<span class="">
											{!! Form::password('old_password', Input::old('old_password'), $attributes = array('class'=>'form-control','placeholder' => ''));  !!}
											<!-- <i class=""></i>  -->
										</span>
									</div>
							</div>
							<div class="form-group">
								{!! Form::label('new_password', 'New Password', $attributes = array('class'=>'col-sm-2 '));  !!}		
									<div class="col-sm-4">
										<span class="">
											{!! Form::password('new_password', Input::old('new_password'), $attributes = array('class'=>'form-control','placeholder' => ''));  !!}
											<!-- <i class=""></i>  -->
										</span>
									</div>
							</div>
							<div class="form-group">
								{!! Form::label('cnew_password', 'Confirm New Password', $attributes = array('class'=>'col-sm-2 '));  !!}		
									<div class="col-sm-4">
										<span class="">
											{!! Form::password('cnew_password', Input::old('cnew_password'), $attributes = array('class'=>'form-control','placeholder' => ''));  !!}
											<!-- <i class=""></i>  -->
										</span>
									</div>
							</div>
							<div class="form-group">
								<div class="col-sm-8">
									<button type="submit" class="btn btn-primary btn-block dd_save "><!-- <i class="fa fa-floppy-o"></i> --> Change</button>
								</div>
								
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
		
		{!!Html::script('assets/js/patient-personal-information.js')!!}
		
		{!!Html::script('assets/plugins/jquery-validation/dist/jquery.validate.min.js')!!}
		{!!Html::script('assets/js/patient-personal-information.js')!!}
        {!!Html::style('assets/css/dd-responsive.css')!!}

        {!!Html::script('assets/plugins/bootbox/bootbox.min.js')!!}
        {!!Html::script('assets/plugins/jquery-mockjax/jquery.mockjax.js')!!}
        {!!Html::script('assets/plugins/select2/select2.min.js')!!}
        {!!Html::script('assets/plugins/DataTables/media/js/jquery.dataTables.min.js')!!}
        {!!Html::script('assets/plugins/DataTables/media/js/DT_bootstrap.js')!!}
        {!!Html::script('assets/js/table-data.js')!!}
     	
     	<!-- {!!Html::script('assets/plugins/tooltip-validation/jquery-validate.bootstrap-tooltip.js')!!} -->
     
     
     	
		
	<script>
		$(document).ready(function() {
			Main.init();
			patientElements.init();
		
			
	
	 	});
	</script>
@stop	