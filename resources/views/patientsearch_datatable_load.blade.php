
@section('head')
	 {!!Html::style('assets/plugins/bootstrap-multiselect/css/bootstrap-multiselect.css')!!}
	 {!!Html::style('assets/plugins/select2/select2.css')!!} 

	 {!!Html::style('assets/plugins/tokenizemultiselect/jquery.tokenize.css')!!}
	 <!-- {!!Html::style('assets/plugins/autocomplete/easy-autocomplete.themes.min.css')!!} -->

	 {!!Html::style('assets/plugins/DataTables/media/css/demo_page.css')!!}
	 {!!Html::style('assets/plugins/DataTables/media/css/demo_table.css')!!}
	 {!!Html::style('https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css')!!}
	 

@stop
@extends('layouts.master',['userName'=>$userName,'userId'=>$userId,])
@section('main')
<div class="page-header">
	<h1>Search Patients <small></small></h1>
</div>
<?php
//var_dump($patientsLists);
?>

<div class="row">
	<div class="col-sm-12">
		
	
	<table id="employee-grid"  cellpadding="0" cellspacing="0" border="0" class="display" width="100%">
					<thead>
						<tr>
							<th>Employee name</th>
							<th>Salary</th>
							<!-- <th>EmpId</th> -->
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th><input type="text" name="search_engine" value="Search engines" class="search_init" /></th>
							<th><input type="text" name="search_browser" value="Search browsers" class="search_init" /></th>
							<!-- <th><input type="text" name="search_platform" value="Search platforms" class="search_init" /></th>
							<th><input type="text" name="search_version" value="Search versions" class="search_init" /></th>
							<th><input type="text" name="search_grade" value="Search grades" class="search_init" /></th> -->
						</tr>
					</tfoot>
			</table>
		
		
	
	

		
	
	</div>
</div>
	
		


@stop
	

	   
@section('scripts')
	@parent
		{!!Html::script('assets/plugins/DataTables/media/js/jquery.js')!!}
		{!!Html::script('assets/plugins/DataTables/media/js/jquery.dataTables.js')!!}
		
		<!-- {!!Html::script('https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js')!!} -->
		
	<!-- 	{!!Html::script('https://cdn.datatables.net/scroller/1.4.2/js/dataTables.scroller.min.js')!!} -->

	
		
				

	<script>

		var asInitVals = new Array();
		jQuery(document).ready(function() {

				var dataTable = $('#employee-grid').DataTable( {
					"oLanguage": {
						"sSearch": "Search all columns:"
					},
					"bserverSide": true,

					"bProcessing": true,
                 "sAjaxSource": "getPatientList",
                 "aoColumns": [
                        { mData: 'id' } ,
                        { mData: 'title' }
                        
                ]
				} );
			
				/*var oTable = $('#example').dataTable( {
					"oLanguage": {
						"sSearch": "Search all columns:"
					}
				} );*/
				
				$("tfoot input").keyup( function () {
					 //Filter on the column (the index) of this element 
					dataTable.fnFilter( this.value, $("tfoot input").index(this) );
				} );
				
				
				
				/*
				 * Support functions to provide a little bit of 'user friendlyness' to the textboxes in 
				 * the footer
				 */
				$("tfoot input").each( function (i) {
					asInitVals[i] = this.value;
				} );
				
				$("tfoot input").focus( function () {
					if ( this.className == "search_init" )
					{
						this.className = "";
						this.value = "";
					}
				} );
				
				$("tfoot input").blur( function (i) {
					if ( this.value == "" )
					{
						this.className = "search_init";
						this.value = asInitVals[$("tfoot input").index(this)];
					}
				} );
						
		});
	</script>
	 		

@stop	
