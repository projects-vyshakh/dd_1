@section('head')
	{!!Html::style('assets/plugins/datepicker/css/datepicker.css')!!}
    {!!Html::style('assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css')!!}
    {!!Html::style('assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css')!!}

@stop
@extends('layouts.master')

@section('main')
	<div class="page-header">
		<h1>Obstetrics History <small></small></h1>
	</div>
<!-- 	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-external-link-square"></i>
					Patient Id : <b>KL100200</b>
					<div class="panel-tools">
						Date : <b> <?php echo $nowDate = date('d-M-Y'); ?> </b>
					</div>
					<div class="panel-body">
					
				
					</div>	
				</div>
			</div>		
		</div>
	</div> -->
	<div class="row">
		<div class="col-md-12">
		
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-external-link-square"></i>
					Patient Id : <b>KL100200</b>
					<div class="panel-tools">
						Date : <b> <?php echo $nowDate = date('d-M-Y'); ?> </b>
					</div>
				</div>
				<div class="panel-body">
					{!! Form::open(array('route' => 'addPatientPersonalInformation', 'role'=>'form', 'id'=>'addPatientPersonalInformation', 'class'=>'form-horizontal','novalidate'=>'novalidate')) !!}
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
							    	{!! Form::label('married_life', 'Married Life', $attributes = array('class'=>'col-sm-2 control-label'));  !!}		
									<div class="col-sm-4">
										<span class="input-icon">
											{!! Form::text('married_life', null, $attributes = array('class'=>'form-control','placeholder' => 'Married Life'));  !!}
											<i class="fa fa-user"></i> 
										</span>
									</div>
									{!! Form::label('hus_bloodgroup', 'Husband Blood Group', $attributes = array('class'=>'col-sm-2 control-label'));  !!}
									<div class="col-sm-4">
										<span class="input-icon">
											{!! Form::text('hus_bloodgroup', Input::old('hus_bloodgroup'), $attributes = array('class'=>'form-control','placeholder' => 'Husband Blood Group'));  !!}
											<i class="fa fa-quote-left"></i> </span>
									</div>
							
								</div>
								<div class="form-group">
							    	{!! Form::label('gravida', 'Gravida', $attributes = array('class'=>'col-sm-2 control-label'));  !!}		
									<div class="col-sm-4">
										<span class="input-icon">
											{!! Form::text('gravida', null, $attributes = array('class'=>'form-control','placeholder' => 'Gravida'));  !!}
											<i class="fa fa-user"></i> 
										</span>
									</div>
									{!! Form::label('para', 'Para', $attributes = array('class'=>'col-sm-2 control-label'));  !!}
									<div class="col-sm-4">
										<span class="input-icon">
											{!! Form::text('para', Input::old('para'), $attributes = array('class'=>'form-control','placeholder' => 'Para'));  !!}
											<i class="fa fa-quote-left"></i> </span>
									</div>
								
								</div>
								<div class="form-group">
							    	{!! Form::label('living', 'Living', $attributes = array('class'=>'col-sm-2 control-label'));  !!}		
									<div class="col-sm-4">
										<span class="input-icon">
											{!! Form::text('living', null, $attributes = array('class'=>'form-control','placeholder' => 'Living'));  !!}
											<i class="fa fa-user"></i> 
										</span>
									</div>
									{!! Form::label('abortion', 'Abortion', $attributes = array('class'=>'col-sm-2 control-label'));  !!}
									<div class="col-sm-4">
										<span class="input-icon">
											{!! Form::text('abortion', Input::old('abortion'), $attributes = array('class'=>'form-control','placeholder' => 'Aborition'));  !!}
											<i class="fa fa-quote-left"></i> </span>
									</div>
								
								</div>
								<hr>

								<div class="form-group">
									<div class="col-sm-4">
										<!-- <i class="fa fa-pencil-square teal"></i> -->
										<h3>Last-Menstrual Period[LMP]</h3>
									</div>
									
										
								</div>
								<div class="form-group">
									{!! Form::label('last_mensus_date', 'Date', $attributes = array('class'=>'col-sm-2 control-label'));  !!}
									<div class="col-sm-4">
										<span class="input-icon">
											{!! Form::text('last_mensus_date',Input::old('last_mensus_date'), $attributes = array('class' => 'form-control date-picker', 'placeholder'=>'Select date','data-date-viewmode'=>'years','data-date-format'=>'dd/mm/yyyy')); !!}
											<i class="fa fa-user"></i> 
											
										</span>
									</div>
									{!! Form::label('flow', 'Flow', $attributes = array('class'=>'col-sm-2 control-label'));  !!}
									<div class="col-sm-4">
										<span class="input-icon">
											{!! Form::text('abortion', Input::old('abortion'), $attributes = array('class'=>'form-control','placeholder' => 'Aborition'));  !!}
											<i class="fa fa-quote-left"></i> </span>
									</div>
								</div>
								<div class="form-group">
									{!! Form::label('dysmenorrhea', 'Dysmenorrhea', $attributes = array('class'=>'col-sm-2 control-label'));  !!}
									<div class="col-sm-4">
										<span class="input-icon">
											{!! Form::text('dysmenorrhea', Input::old('abortion'), $attributes = array('class'=>'form-control','placeholder' => 'Aborition'));  !!}
											<i class="fa fa-quote-left"></i> </span>
									</div>
									{!! Form::label('days', 'Days', $attributes = array('class'=>'col-sm-2 control-label'));  !!}
									<div class="col-sm-4">
										<span class="input-icon">
											{!! Form::text('days', Input::old('days'), $attributes = array('class'=>'form-control','placeholder' => 'Days'));  !!}
											<i class="fa fa-quote-left"></i> </span>
									</div>
								</div>
								<div class="form-group">
									{!! Form::label('cycle', 'Cycle', $attributes = array('class'=>'col-sm-2 control-label'));  !!}
									<div class="col-sm-4">
										<span class="input-icon">
											{!! Form::text('cycle', Input::old('cycle'), $attributes = array('class'=>'form-control','placeholder' => 'Cycle'));  !!}
											<i class="fa fa-quote-left"></i> </span>
									</div>
									{!! Form::label('mensus_type', 'Menstrual Type', $attributes = array('class'=>'col-sm-2 control-label'));  !!}
									<div class="col-sm-4">
										<label class="radio-inline">
											<input type="radio" class="grey" value="" name="mensus_type" id="regular">
											Regular
										</label>
										<label class="radio-inline">
											<input type="radio" class="grey" value="" name="mensus_type"  id="irregular">
											Irregular
										</label>
									</div>
									
								</div>
								<div class="form-group">
									
									<div class="col-sm-2">
										<button type="submit" class="btn btn-default"><i class="fa fa-plus-circle "></i> Add More LMP</button>
									</div>
								</div>
								<hr>
								<div class="form-group">
									<div class="col-sm-4">
										<!-- <i class="fa fa-pencil-square teal"></i> -->
										<h3>Pregnancy</h3>
									</div>
									
										
								</div>
								<div class="form-group">
									{!! Form::label('preg_kind', 'Pregnancy Kind', $attributes = array('class'=>'col-sm-2 control-label'));  !!}
									<div class="col-sm-4">
										<label class="radio-inline">
											<input type="radio" class="grey" value="" name="preg_kind" id="preg_vaginal">
											Vaginal
										</label>
										<label class="radio-inline">
											<input type="radio" class="grey" value="" name="preg_kind"  id="preg_cesarean">
											Cesarean
										</label>
									</div>
									{!! Form::label('pregnancy_type', 'Pregnancy Type', $attributes = array('class'=>'col-sm-2 control-label'));  !!}
									<div class="col-sm-4">
										<label class="radio-inline">
											<input type="radio" class="grey" value="" name="mensus_type" id="regular">
											Normal
										</label>
										<label class="radio-inline">
											<input type="radio" class="grey" value="" name="mensus_type"  id="irregular">
											Forceps
										</label>
										<label class="radio-inline">
											<input type="radio" class="grey" value="" name="mensus_type"  id="irregular">
											Vaccum
										</label>
									</div>
									
								</div>
								<div class="form-group">
									{!! Form::label('term', 'Term', $attributes = array('class'=>'col-sm-2 control-label'));  !!}
									<div class="col-sm-4">
										<span class="input-icon">
											{!! Form::text('dysmenorrhea', Input::old('abortion'), $attributes = array('class'=>'form-control','placeholder' => 'Aborition'));  !!}
											<i class="fa fa-quote-left"></i> </span>
									</div>
									{!! Form::label('type_of_abortion', 'Type of abortion', $attributes = array('class'=>'col-sm-2 control-label'));  !!}
									<div class="col-sm-4">
										<span class="input-icon">
											{!! Form::text('type_of_abortion', Input::old('type_of_abortion'), $attributes = array('class'=>'form-control','placeholder' => 'Type of abortion'));  !!}
											<i class="fa fa-quote-left"></i> </span>
									</div>
								</div>
								<div class="form-group">
									{!! Form::label('health', 'Health', $attributes = array('class'=>'col-sm-2 control-label'));  !!}
									<div class="col-sm-4">
										<span class="input-icon">
											{!! Form::text('dysmenorrhea', Input::old('abortion'), $attributes = array('class'=>'form-control','placeholder' => 'Aborition'));  !!}
											<i class="fa fa-quote-left"></i> </span>
									</div>
									{!! Form::label('age', 'Age', $attributes = array('class'=>'col-sm-2 control-label'));  !!}
									<div class="col-sm-2">
										<span class="input-icon">
											{!! Form::text('years', Input::old('years'), $attributes = array('class'=>'form-control','placeholder' => 'Years'));  !!}
											<i class="fa fa-quote-left"></i> </span>
									</div>
									
									<div class="col-sm-2">
										<span class="input-icon">
											{!! Form::text('weeks', Input::old('weeks'), $attributes = array('class'=>'form-control','placeholder' => 'Weeks'));  !!}
											<i class="fa fa-quote-left"></i> </span>
									</div>
									
								</div>
								<div class="form-group">
									{!! Form::label('gender', 'Gender', $attributes = array('class'=>'col-sm-2 control-label'));  !!}
									<div class="col-sm-4">
										<label class="radio-inline">
											<input type="radio" class="grey" value="" name="gender" id="gender_female">
											Female
										</label>
										<label class="radio-inline">
											<input type="radio" class="grey" value="" name="gender"  id="gender_male">
											Male
										</label>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-2">
										<button type="submit" class="btn btn-default"><i class="fa fa-plus-circle "></i> Add More Pregnancy</button>
									</div>
								</div>
								<hr>
								<div class="form-group">
									{!! Form::label('last_delvery_date', 'Last Delivery Date(LDD)', $attributes = array('class'=>'col-sm-2 control-label'));  !!}
									<div class="col-sm-4">
										<span class="input-icon">
											{!! Form::text('last_delvery_date',Input::old('last_delvery_date'), $attributes = array('class' => 'form-control date-picker', 'placeholder'=>'Select date','data-date-viewmode'=>'years','data-date-format'=>'dd/mm/yyyy')); !!}
											<i class="fa fa-user"></i> 
											
										</span>
									</div>
									{!! Form::label('expected_delvery_date', 'Expected Delivery Date(EDD)', $attributes = array('class'=>'col-sm-2 control-label'));  !!}
									<div class="col-sm-4">
										<span class="input-icon">
											{!! Form::text('expected_delvery_date',Input::old('expected_delvery_date'), $attributes = array('class' => 'form-control date-picker', 'placeholder'=>'Select date','data-date-viewmode'=>'years','data-date-format'=>'dd/mm/yyyy')); !!}
											<i class="fa fa-user"></i> 
											
										</span>
									</div>
								</div>
								<div class="form-group">
									{!! Form::label('gestational_age', 'Gestational Age', $attributes = array('class'=>'col-sm-2 control-label'));  !!}
									<div class="col-sm-4">
										<span class="input-icon">
											{!! Form::text('gestational_age', Input::old('gestational_age'), $attributes = array('class'=>'form-control','placeholder' => 'Gestational Age'));  !!}
											<i class="fa fa-quote-left"></i> </span>
									</div>
								</div>	
								<div class="form-group">
									<div class="col-sm-10"></div>
									<div class="col-sm-2">
										<button type="submit" class="btn btn-primary btn-block"><i class="fa fa-arrow-circle-right "></i> Save</button>
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

	<script>
		$(document).ready(function() {
			//Main.init();
			/*//screenValidator.init();
			$('#diagnosis-side-menu').hide();
			$('#patient-menu').click(function(){
				//alert('vyshakh');
				//$('.main-navigation-menu').toggle();
				$('#patient-side-menu').show();
				$('#diagnosis-side-menu').hide();
				$('#patient-top-menu-li').addClass('active open');
				$('#diagnosis-top-menu-li').removeClass('active open');


			});
			$('#diagnosis-menu').click(function(){
				//alert('vyshakh');
				//$('.main-navigation-menu').toggle();
				$('#patient-side-menu').hide();
				$('#diagnosis-side-menu').show();
				$('#patient-top-menu-li').removeClass('active open');
				$('#diagnosis-top-menu-li').addClass('active open');


			});*/

	 	});
	</script>
@stop	