@section('head')

	{!!Html::style('assets/plugins/datepicker/css/datepicker.css')!!}
    {!!Html::style('assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css')!!}
    {!!Html::style('assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css')!!}
    

@stop
@extends('layouts.master', ['patientName' =>$patientName])

@section('main')
	<div class="page-header">
		<h1>Obstetrics History <small></small></h1>
	</div>

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