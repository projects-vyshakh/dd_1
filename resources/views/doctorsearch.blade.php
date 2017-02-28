
@section('head')
	 {!!Html::style('assets/plugins/bootstrap-multiselect/css/bootstrap-multiselect.css')!!}
	 {!!Html::style('assets/plugins/select2/select2.css')!!} 

	 {!!Html::style('assets/plugins/tokenizemultiselect/jquery.tokenize.css')!!}
	 <!-- {!!Html::style('assets/plugins/bootstrap-modal/css/bootstrap-modal.css')!!} -->
	 
	 {!!Html::style('https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css')!!}
	 <!-- {!!Html::style('https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css')!!} -->
	 {!!Html::style('https://cdn.datatables.net/responsive/2.1.0/css/responsive.bootstrap.min.css')!!}


@stop
@extends('layouts.master',['userName'=>$userName,'userId'=>$userId,])
@section('main')

<!-- <div class="modal fade" id="doctor_enable_disable" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					&times;
				</button>
				<h4 class="modal-title"></h4>
			</div>
			<div class="modal-body">
				<p>
					No previous drugs to display
				</p>
			</div>
			<div class="modal-footer">
				<button class="btn btn-danger " data-dismiss="modal">
					No
				</button>
				<button class="btn btn-success" data-dismiss="modal">
					Yes
				</button>
			</div>
		</div>
	</div>
</div> -->

<div class="page-header">
	<h1>Search Doctors <small></small></h1>
</div>


<div class="row">
	<div class="col-sm-12 dd_Search_pd">
		<h3>Search By <small></small></h3>
		{!! Form::open(array('route' => 'handleSearchDoctor', 'role'=>'form', 'id'=>'handleSearchDoctor', 'class'=>'form-horizontal','novalidate'=>'novalidate')) !!}	
			<div class="form-group">
				<div class="col-sm-3">
					{!! Form::text('searchby_id', '', $attributes = array('class'=>'form-control searchby_id','placeholder'=>'Doctor ID'));  !!}
				</div>
			</div>

			<div class="form-group">
				<div class="col-sm-3">
					{!! Form::text('searchby_name', '', $attributes = array('class'=>'form-control searchby_name','placeholder'=>'Doctor Name'));  !!}
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-3">
					{!! Form::text('searchby_ima', '', $attributes = array('class'=>'form-control searchby_ima','placeholder'=>'IMA Registration Number'));  !!}
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-3">
					{!! Form::select('searchby_spec', $specializationKey, null , $attributes = array('class' => 'form-control  searchby_spec','id'=>'searchby_spec','name'=>'searchby_spec')); !!}

				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-3">
					<button type="submit" class="btn btn_243 btn-primary search" id="search">
						Search
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
	                <th>Specialization</th>
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
							<thead>
					            <tr class="dd_search_tr">
					           
					                <th>Doctor Id</th>
					                <th>First Name</th>
					                <th>Last Name</th>
					                <th>Specialization</th>
					                <th>Phone</th>
					                <th>Email</th>
					                <th>Status</th>
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
		{!!Html::script('assets/js/doctor-search.js')!!}
		{!!Html::script('assets/plugins/bootstrap/js/bootstrap.min.js')!!}

		<!-- !!Html::script('assets/plugins/bootstrap-modal/js/bootstrap-modal.js')!!}
		{!!Html::script('assets/plugins/bootstrap-modal/js/bootstrap-modalmanager.js')!!}
		{!!Html::script('assets/js/ui-modals.js')!!} -->
		
		{!!Html::script('assets/plugins/perfect-scrollbar/src/perfect-scrollbar.js')!!}
		{!!Html::script('assets/plugins/jquery-cookie/jquery.cookie.js')!!}
		{!!Html::script('assets/plugins/bootbox/bootbox.min.js')!!}
		{!!Html::script('assets/js/main.js')!!}

		<script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
		  <!-- DataTable (Bootstrap) -->
		<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.1.0/js/dataTables.responsive.min.js"></script>
		
					

	<script>

		
		jQuery(document).ready(function() {
			Main.init();
			doctorSearch.init();
			
				
						
		});
	</script>
	 		

@stop	
