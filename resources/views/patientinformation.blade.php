@section('head')
@stop
@extends('layouts.master')


@section('main')
	<div class="page-header" id="patient-personal-info-div">
		<h1>Patient Personal Information <small></small></h1>
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