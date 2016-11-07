
@section('head')

	{!!Html::style('assets/plugins/datepicker/css/datepicker.css')!!}
    {!!Html::style('assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css')!!}
    {!!Html::style('assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css')!!}

@stop
@extends('layouts.master')
<style>
	.loader 
	{
        position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background: url('assets/images/page_loading.gif') 50% 50% no-repeat rgb(249,249,249);
    }
</style>
@section('main')
<div class="loader"></div>


	<div class="page-header">
		<h1>Import <small></small></h1>
	</div>
	<div class="row">
		<div class="col-sm-12">
			{!! Form::open(array('route' => 'handleDiagnosisDataMigration', 'role'=>'form', 'id'=>'handleDiagnosisDataMigration', 'class'=>'form-horizontal','novalidate'=>'novalidate','enctype'=>'multipart/form-data')) !!}
				<div class="form-group">
					<div class="col-sm-4">
						{!! Form::label('diagnosis_json', 'Upload Diagnosis Data', $attributes = array('class'=>''));  !!}	
					</div>
					<div class="col-sm-4">
						{!! Form::file('diagnosis_json', Input::old('diagnosis_json'), $attributes = array('class'=>'form-control', 'value'=>'Browse'));  !!}
					</div>
					<div class="col-sm-2">
						<button type="submit" class="btn btn-primary btn-block dd_btn_center"><i class="fa fa-arrow-circle-right "></i>Migrate</button>
					</div>
				</div>
			{!! Form::close() !!}

			{!! Form::open(array('route' => 'handleMedicalDataMigration', 'role'=>'form', 'id'=>'handleDiagnosisDataMigration', 'class'=>'form-horizontal','novalidate'=>'novalidate','enctype'=>'multipart/form-data')) !!}
				<div class="form-group">
					<div class="col-sm-4">
						{!! Form::label('medical_json', 'Upload Medical Data', $attributes = array('class'=>''));  !!}	
					</div>
					<div class="col-sm-4">
						{!! Form::file('medical_json', Input::old('medical_json'), $attributes = array('class'=>'form-control', 'value'=>'Browse'));  !!}
					</div>
					<div class="col-sm-2">
						<button type="submit" class="btn btn-primary btn-block dd_btn_center"><i class="fa fa-arrow-circle-right "></i>Migrate</button>
					</div>
				</div>
			{!! Form::close() !!}

			{!! Form::open(array('route' => 'handleUserDataMigration', 'role'=>'form', 'id'=>'handleUserDataMigration', 'class'=>'form-horizontal','novalidate'=>'novalidate','enctype'=>'multipart/form-data')) !!}
				<div class="form-group">
					<div class="col-sm-4">
						{!! Form::label('doctors_json', 'Upload Doctors Data', $attributes = array('class'=>''));  !!}	
					</div>
					<div class="col-sm-4">
						{!! Form::file('doctors_json', Input::old('doctors_json'), $attributes = array('class'=>'form-control', 'value'=>'Browse'));  !!}
					</div>
					<div class="col-sm-2">
						<button type="submit" class="btn btn-primary btn-block dd_btn_center"><i class="fa fa-arrow-circle-right "></i>Migrate</button>
					</div>
				</div>
			{!! Form::close() !!}

			{!! Form::open(array('route' => 'handlePatientsDataMigration', 'role'=>'form', 'id'=>'handleDiagnosisDataMigration', 'class'=>'form-horizontal','novalidate'=>'novalidate','enctype'=>'multipart/form-data')) !!}
				<div class="form-group">
					<div class="col-sm-4">
						{!! Form::label('patients_json', 'Upload Patients Data', $attributes = array('class'=>''));  !!}	
					</div>
					<div class="col-sm-4">
						{!! Form::file('patients_json', Input::old('patients_json'), $attributes = array('class'=>'form-control', 'value'=>'Browse'));  !!}
					</div>
					<div class="col-sm-2">
						<button type="submit" class="btn btn-primary btn-block dd_btn_center"><i class="fa fa-arrow-circle-right "></i>Migrate</button>
					</div>
				</div>
				
			{!! Form::close() !!}
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

		
		
	<script>
		$(document).ready(function() {
			Main.init();
			

			
           	
            
			
	
	 	});
	</script>
@stop	