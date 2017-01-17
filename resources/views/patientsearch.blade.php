
@section('head')
	 {!!Html::style('assets/plugins/bootstrap-multiselect/css/bootstrap-multiselect.css')!!}
	 {!!Html::style('assets/plugins/select2/select2.css')!!} 

	 {!!Html::style('assets/plugins/tokenizemultiselect/jquery.tokenize.css')!!}
	 <!-- {!!Html::style('assets/plugins/autocomplete/easy-autocomplete.themes.min.css')!!} -->

	 {!!Html::style('assets/plugins/DataTables/media/css/demo_page.css')!!}
	 {!!Html::style('assets/plugins/DataTables/media/css/demo_table.css')!!}
	
	 {!!Html::style('http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css')!!}
	 

@stop
@extends('layouts.master',['userName'=>$userName,'userId'=>$userId,])
@section('main')
<div class="page-header">
	<h1>Search Patients <small></small></h1>
</div>


<div class="row">
	<div class="col-sm-12">
		<h3>Search By <small></small></h3>
		{!! Form::open(array('route' => 'handleSearchPatient', 'role'=>'form', 'id'=>'handleSearchPatient', 'class'=>'form-horizontal','novalidate'=>'novalidate')) !!}	
			<div class="form-group">
				<div class="col-sm-2">
					{!! Form::text('searchby_id', '', $attributes = array('class'=>'form-control searchby_id','placeholder'=>'Patient ID'));  !!}
				</div>
				<div class="col-sm-2">
					{!! Form::text('searchby_name', '', $attributes = array('class'=>'form-control searchby_name','placeholder'=>'Patient Name'));  !!}
				</div>
				<div class="col-sm-2">
					<button type="submit" class="btn btn-primary search" id="search">
						<i class="fa fa-plus-circle "></i> Search
					</button>
				</div>
			</div>
		{!! Form::close() !!}
	</div>
</div>
<hr>
<div class="row">
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
		


@stop
	

	   
@section('scripts')
	@parent
		{!!Html::script('http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js')!!}
		{!!Html::script('assets/plugins/DataTables/media/js/jquery.js')!!}
		{!!Html::script('assets/plugins/DataTables/media/js/jquery.dataTables.js')!!}
		{!!Html::script('assets/js/patient-search.js')!!}
		
		
		
	
		
				

	<script>

		
		jQuery(document).ready(function() {
			patientSearch.init();
			
					
						
		});
	</script>
	 		

@stop	
