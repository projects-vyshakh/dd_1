
@section('head')
	 {!!Html::style('assets/plugins/bootstrap-multiselect/css/bootstrap-multiselect.css')!!}
	 {!!Html::style('assets/plugins/select2/select2.css')!!} 

	 {!!Html::style('assets/plugins/tokenizemultiselect/jquery.tokenize.css')!!}
	 <!-- {!!Html::style('assets/plugins/autocomplete/easy-autocomplete.themes.min.css')!!} -->

	 <!-- {!!Html::style('assets/plugins/DataTables/media/css/demo_page.css')!!}
	 {!!Html::style('assets/plugins/DataTables/media/css/demo_table.css')!!}
	
	 {!!Html::style('http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css')!!}
 -->

	 {!!Html::style('https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css')!!}
	 <!-- {!!Html::style('https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css')!!} -->
	 {!!Html::style('https://cdn.datatables.net/responsive/2.1.0/css/responsive.bootstrap.min.css')!!}

	
  	<style>
	  	div.dataTables_paginate{
	  		white-space: initial;
	  	}
  	</style>
  	
	 

@stop
@extends('layouts.master',['userName'=>$userName,'userId'=>$userId,])
@section('main')
<div class="page-header">
	<h1>Search Patients <small></small></h1>
</div>


<div class="row">
	<div class="col-sm-12 dd_Search_pd">
		<h3>Search By <small></small></h3>
		{!! Form::open(array('route' => 'handleSearchPatient', 'role'=>'form', 'id'=>'handleSearchPatient', 'class'=>'form-horizontal','novalidate'=>'novalidate')) !!}	
			<div class="form-group">
				<div class="col-sm-3">
					{!! Form::text('searchby_id', '', $attributes = array('class'=>'form-control searchby_id','placeholder'=>'Patient ID'));  !!}
				</div>

			</div>

			<div class="form-group">
				<div class="col-sm-3">
					{!! Form::text('searchby_name', '', $attributes = array('class'=>'form-control searchby_name','placeholder'=>'Patient Name'));  !!}
				</div>
			</div>

			<div class="form-group">
				<div class="col-sm-3">
					<button type="submit" class="btn btn_243 btn-primary search" id="search">
						</i> Search
					</button>
				</div>
			</div>
		{!! Form::close() !!}
	</div>
</div>
<hr class="dd_Search_pd">
<!-- <div class="row">
	<div class="col-sm-12">
		<div class="">
        <table id="search_patient_table" class="display search_patient_table" width="100%" cellspacing="0" style="display: none">
	        <thead>
	            <tr>
	                <th>Patient Id</th>
	                <th>First Name</th>
	                <th>Last Name</th>
	                <th>Gender</th>
	                <th>Age</th>
	                <th>Phone</th>
	                <th>Email</th>
	            </tr>
	        </thead>
	 
	        <tfoot>
	            <tr>
	               <th>Patient Id</th>
	                <th>First Name</th>
	                <th>Last Name</th>
	                <th>Gender</th>
	                <th>Age</th>
	                <th>Phone</th>
	                <th>Email</th>
	                
	            </tr>
	        </tfoot>
	    </table>
    </div>
	</div>
</div>	
		 -->




<!-- start: PAGE CONTENT -->
	<div class="row">
		<div class="col-md-12 dd_Search_pd" id="patient_list_div" style="display: none;">
			
			<!-- start: RESPONSIVE TABLE PANEL -->
			<div class="panel panel-default">
				
				<div class="panel-body dd_search_panel" >
					
						<table class="table table-bordered table-hover responsive dataTable no-footer dd_search_table_pd" id="search_patient_table">
							<thead >
					            <tr class="dd_search_tr">
					                <th>Patient Id</th>
					                <th>First Name</th>
					                <th>Last Name</th>
					                <th>Gender</th>
					                <th>Age</th>
					                <th>Phone</th>
					                <th>Email</th>
					            </tr>
					        </thead>
						
						</table>
					
				</div>
			</div>
			<!-- end: RESPONSIVE TABLE PANEL -->
		</div>
	</div>
	<!-- end: PAGE CONTENT-->


@stop
	

	   
@section('scripts')
	@parent
		
		
		
		{!!Html::script('assets/js/patient-search.js')!!}
		{!!Html::script('assets/plugins/bootstrap/js/bootstrap.min.js')!!}
		
		{!!Html::script('assets/plugins/perfect-scrollbar/src/perfect-scrollbar.js')!!}
		{!!Html::script('assets/plugins/jquery-cookie/jquery.cookie.js')!!}
		{!!Html::script('assets/js/main.js')!!}

		<script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
		  <!-- DataTable (Bootstrap) -->
		<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.1.0/js/dataTables.responsive.min.js"></script>
		
				

	<script>

		
		jQuery(document).ready(function() {
			Main.init();
			patientSearch.init();
			
					
						
		});
	</script>
	 		

@stop	
