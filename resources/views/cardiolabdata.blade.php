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
	 {!!Html::style('assets/plugins/bootstrap-multiselect/css/bootstrap-multiselect.css')!!}
	 {!!Html::style('assets/plugins/select2/select2.css')!!} 

	 {!!Html::style('assets/plugins/tokenizemultiselect/jquery.tokenize.css')!!}
	 <!-- {!!Html::style('assets/plugins/autocomplete/easy-autocomplete.themes.min.css')!!} -->



@stop
@extends('layouts.master', ['specialization'=>$doctorSpecialization,'patientName'=>$patientName])
@section('main')

	<body class="error-full-page">
		<div id="sound" style="z-index: -1;"></div>
		<img id="background" src="" />
		
		<!-- start: PAGE -->
		<div class="container">
			<div class="row">
				<div id="cholder">
			<canvas id="canvas"></canvas>
		</div>
				<!-- start: 404 -->
				<div class="col-sm-12 page-error">
					<!-- <div class="error-number teal">
						Coming Soon
					</div> -->
					<div class="error-details col-sm-6 col-sm-offset-3">
						<h3>Coming Soon</h3>
						<p>
							
							<hr>
							<a href="cardioexamination" class="btn btn-primary">Back</a>
						</p>
					<!-- 	<form action="#">
							<div class="input-group">
								<input type="text" placeholder="keyword..." size="16" class="form-control">
								<span class="input-group-btn">
									<button class="btn btn-teal">
										Search
									</button> </span>
							</div>
						</form> -->
					</div>
				</div>
				<!-- end: 404 -->
			</div>
		</div>

		<!-- end: PAGE -->
		<!-- start: MAIN JAVASCRIPTS -->
		<!--[if lt IE 9]>
		<script src="assets/plugins/respond.min.js"></script>
		<script src="assets/plugins/excanvas.min.js"></script>
		<script type="text/javascript" src="assets/plugins/jQuery-lib/1.10.2/jquery.min.js"></script>
		<![endif]-->
		<!--[if gte IE 9]><!-->
		


@stop
	

	   
@section('scripts')
	@parent
		{!!Html::script('assets/plugins/bootstrap-multiselect/js/bootstrap-multiselect.js')!!}
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
	 	{!!Html::script('assets/plugins/rainyday/rainyday.js')!!}
	 	{!!Html::script('assets/js/utility-error404.js')!!}

			

		<script>
			jQuery(document).ready(function() {
				Main.init();
				Error404.init();				
			});
		</script>
	 		

@stop	
<!DOCTYPE html>
<!-- Template Name: Clip-One - Responsive Admin Template build with Twitter Bootstrap 3.x Version: 1.4 Author: ClipTheme -->
<!--[if IE 8]><html class="ie8 no-js" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9 no-js" lang="en"><![endif]-->
<!--[if !IE]><!-->
