<?php
		$currentPath = Route::getCurrentRoute()->getPath();
		//echo $currentPath;
		$filename = Session::get('pdfFileName');
		

?>
<!DOCTYPE html>
<!-- Template Name: Clip-One - Responsive Admin Template build with Twitter Bootstrap 3.x Version: 1.4 Author: ClipTheme -->
<!--[if IE 8]><html class="ie8 no-js" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9 no-js" lang="en"><![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
	<!--<![endif]-->
	<!-- start: HEAD -->
	<head>

		<title>Doctor's Diary | Share Prescription</title>
		<!-- start: META -->
		<meta charset="utf-8" />
		<!--[if IE]><meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1" /><![endif]-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta content="" name="description" />
		<meta content="" name="author" />
		<link rel="shortcut icon" href="assets/images/logo-mob.png" type="image/x-icon">
		<style type="text/css">

	body {
        background-color: #000;
        font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
        font-size: 14px;
        color:#000;
        margin: 0;
        padding: 0;
    }
		.box {
		    background: #fff none repeat scroll 0 0;
		    /*height: 416px;*/
		    position: absolute;
		    right: 12%;
		    top: 18%;
		    width: 346px;
		    z-index: 10000;
		}
		.topmenu-active{
			color :black;
		}
		.resize-login{
			z-index: 10001;
		}
		  html, body {
        position: relative;
        height: 100%;
    }

    .swiper-container {
        width: 100%;
        height: 100%;
    }
    .swiper-slide {
        background-position: center;
        background-size: cover;
    }
		</style>
		<!-- end: META -->
		<!-- start: MAIN CSS -->
		{!!Html::style('assets/plugins/bootstrap/css/bootstrap.min.css')!!}
	    {!!Html::style('assets/plugins/font-awesome/css/font-awesome.min.css')!!}
	    {!!Html::style('assets/fonts/style.css')!!}
	    
	    {!!Html::style('assets/css/main.css')!!}
	    {!!Html::style('assets/css/main-responsive.css')!!}
	    {!!Html::style('assets/plugins/iCheck/skins/all.css')!!}
	    {!!Html::style('assets/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css')!!}
	    {!!Html::style('assets/plugins/perfect-scrollbar/src/perfect-scrollbar.css')!!}
	    
	    {!!Html::style('assets/css/print.css',array('media' => 'print')) !!}

	   
	    {!!Html::style('assets/css/dd-responsive.css')!!}

	    {!!Html::style('assets/plugins/bootstrap-multiselect/css/bootstrap-multiselect.css')!!}
		{!!Html::style('assets/plugins/select2/select2.css')!!}
		{!!Html::style('assets/plugins/tokenizemultiselect/jquery.tokenize.css')!!}


		{!!Html::style('assets/plugins/ajax-loader/src/jquery.mloading.css')!!}
		{!!Html::style('assets/plugins/bootstrap-modal/css/bootstrap-modal.css')!!}	
	
	      
	    
	    

	</head>
	<!-- end: HEAD -->
	<!-- start: BODY -->
	
	<body class="error-full-page">
		
	@if(!empty($filename))
		<div class="modal fade " id="myModal3" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content" style="width:800px;height:580px">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
							&times;
						</button>
						<h4 class="modal-title">Prescription Copy</h4>
					</div>
					<div class="modal-body">
						<p class="pdf_print">
							<iframe src="storage/pdf/{{$filename}}.pdf" style="width:780px;height:500px;" id="iFrame"></iframe>
						</p>	

		
					</div>
					<!-- <div class="modal-footer">
						<button class="btn btn-default printBtnOk" data-dismiss="modal">
							OK
						</button>
					</div> -->
				</div>
			</div>
		</div>
	@else
			<!-- start: PAGE -->
		<div class="container">
			<div class="row">
				<!-- start: 500 -->
				<div class="col-sm-12 page-error">
					<div class="error-number bricky">
						500
					</div>
					<div class="error-details col-sm-6 col-sm-offset-3">
						<!-- <h3>Oops! You are stuck at 500</h3> -->
						<p>
							Something's wrong!
							<br>
							It looks as invalid url.
							<br>
							
						</p>
					</div>
				</div>
				<!-- end: 500 -->
			</div>
		</div>

	@endif



		
		{!!Html::script('assets/plugins/jQuery-lib/2.0.3/jquery.min.js')!!}
     
	    {!!Html::script('assets/plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js')!!}
	    {!!Html::script('assets/plugins/bootstrap/js/bootstrap.min.js')!!}
	    {!!Html::script('assets/plugins/jquery-inputlimiter/jquery.inputlimiter.1.3.1.min.js')!!}
		{!!Html::script('assets/plugins/autosize/jquery.autosize.min.js')!!}
	    {!!Html::script('assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js')!!}
	    {!!Html::script('assets/plugins/blockUI/jquery.blockUI.js')!!}
	    {!!Html::script('assets/plugins/iCheck/jquery.icheck.min.js')!!}
	    {!!Html::script('assets/plugins/perfect-scrollbar/src/perfect-scrollbar.js')!!}
	    {!!Html::script('assets/plugins/perfect-scrollbar/src/jquery.mousewheel.js')!!}
	    {!!Html::script('assets/plugins/less/less-1.5.0.min.js')!!}
	    {!!Html::script('assets/plugins/jquery-cookie/jquery.cookie.js')!!}
	    {!!Html::script('assets/plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js')!!}
	   
	  	{!!Html::script('assets/plugins/bootstrap-modal/js/bootstrap-modal.js')!!}
		{!!Html::script('assets/plugins/bootstrap-modal/js/bootstrap-modalmanager.js')!!}
		{!!Html::script('assets/js/ui-modals.js')!!}
		{!!Html::script('assets/plugins/bootbox/bootbox.min.js')!!}



	   
	
		<script>
			jQuery(document).ready(function() {
				$('#myModal3').modal('show');
				
				
			});
		</script>
	</body>
	<!-- end: BODY -->
</html>