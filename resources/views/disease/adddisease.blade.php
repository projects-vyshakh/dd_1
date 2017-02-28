
@section('head')

	{!!Html::style('assets/plugins/datepicker/css/datepicker.css')!!}
    {!!Html::style('assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css')!!}
    {!!Html::style('assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css')!!}

@stop
<?php
	
	 $userName 	= Session::get('user_name');
	 $AdminId		= Session::get('AdminId');
	//$patientName = "";
?>
@extends('layouts.master',['userName'=>$userName,'AdminId'=>$AdminId])
 <style>
	/*.loader 
	{
        position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background: url('assets/images/page_loading.gif') 50% 50% no-repeat rgb(249,249,249);
    }*/
    .choosefile
    {
    	height: 32px;
    	width: 100%;
    }
    .sample {
    	margin-top: 5px;
    }
</style> 
@section('main')



	<div class="loader"></div>
	<div class="page-header">
		<h1>Import Disease<small></small></h1>
	</div>
	<div class="form-group">
		<div class="col-sm-12">
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
              	
		</div>
		
		</div>
	<div class="row">
		<div class="col-sm-12">
		<div class="row  dd_color">
		<div class="col-md-6 col-sm-6 col-xs-12">
		
		{!! Form::open(array('route' => 'importdiseaserecord', 'role'=>'form', 'id'=>'importdiseaserecord', 'class'=>'form-horizontal','novalidate'=>'novalidate', 'files' => true)) !!}
		{!! Form::hidden('AdminId',$AdminId, $attributes = array('class'=>'form-control'));  !!}
                       <div class="input-group margin form-control">
                        
                           <input type="file" name="file" id="file" class="choosefile" placeholder="Choose a file to upload">
                        
                           <span class="input-group-btn">
                           <input class="btn btn-info btn-flat" name="finish" type="submit" value="Upload" style="border-radius: 3px;">
                           </span>
                      
                        </div>
                     <div class="format-error">
					  <span> </span>
					</div>
                     <!-- /.info-box-content -->
                     <!-- /.info-box -->
                  </div>
                  <!-- /.col -->
                  <!-- fix for small devices only -->
                  <div class="col-md-6 col-sm-6 col-xs-12">
				  <div class="input-group margin form-control">
				  
				  
                     <p class="sample">

                     <a href="../../assets/images/Disease/template.csv"><b>Click here </b></a>&nbsp;to download the sample file</p>
					 
					 
					
             
			   </div></div> </div>
						 <!-- <div class="col-sm-6 dd_PDR_40">
							<div class="form-group dd_fromgroup_MG_0">
								<div class="col-sm-12 dd_PDB_10">
								<form method="post" action="#" enctype="multipart/form-data">
								
                        <div class="input-group margin">
                        <div class="col-sm-8">
                           <input type="file" name="file" class="form-control" placeholder="Choose a file to upload">
                           
                        </div>
                    
								<div class="col-sm-4">
									<span class="input-group-btn">
                           <input class="btn btn-info btn-flat"  name="finish" type="submit">
                           </span>
							 	</div>

											
										</div>	
										
										 </form>
								</div>
						</div>
						</div>
							
						<div class="col-sm-6 dd_PDL_40"> 
							<div class="form-group dd_fromgroup_MG_0">
								 <div class="col-sm-12 dd_PDB_10">
								 <div class="form-control">
								 
									<div class="col-sm-8">
										<span class="">
                     Download the sample file from

										</span>
									</div>
									<div class="col-sm-4">
									<label for="house" class="col-sm-4">
									<a href="files/test_template.csv" class="btn btn-info btn-flat" "="" style="margin-top: -7px;"> here </a></label>
									</div>
								</div>
								</div>
								</div>
								</div>
							
						</div>
 -->	


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
		
		{!!Html::style('assets/css/dd-responsive.css')!!}
			
		
		{!!Html::script('assets/plugins/jquery-validation/dist/jquery.validate.min.js')!!}
		{!!Html::script('assets/js/admin-add-disease.js')!!}
       

		
		
	<script>
		$(document).ready(function() {
			Main.init();
			adminAddDisease.init();
	
	 	});
	</script>
@stop	