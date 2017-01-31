
@section('head')
	 


	{!!Html::style('assets/plugins/bootstrap-modal/css/bootstrap-modal.css')!!}

	{!!Html::style('http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css')!!}
<style>
	.btn-danger 
	{
	    background-color: #d9534f;
	    border-color: #d43f3a;
	    color: #fff;
	    border-radius: 4px
	}
</style>	 

@stop
@extends('layouts.master',['userName'=>$userName,'userId'=>$userId,])
@section('main')
 <div class="page-header">
	<h1> Doctor's Authorization <small></small></h1>
</div>


<!-- start: PAGE CONTENT -->
<div class="row">
	<div class="col-md-12">
		<!-- <div class="alert alert-info">
			Please try to re-size your browser window in order to see the tables in responsive mode.
		</div> -->
		<!-- start: RESPONSIVE TABLE PANEL -->
		<div id="doctor_list_div">
		@if(!empty($doctorAuthorizePending))
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-external-link-square"></i>
					Doctor's List
					
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-bordered table-hover" id="doctor_authorize">
							<thead>
								<tr>
									<th>SL.No</th>
									<th>Doctor Name</th>
									<th>Speciaization</th>
									<th>Mobile</th>
									<th>Email</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>
								@foreach($doctorAuthorizePending as $index=>$pendingValue)
									<tr>
										<td>{{$index+1}}</td>
										<td>Dr. {{$pendingValue->first_name}} {{$pendingValue->last_name}}</td>
										<td>{{$pendingValue->specialization_name}}</td>
										<td>{{$pendingValue->phone}}</td>
										<td>{{$pendingValue->email}}</td>
										<td>
											<!-- <a href=""><span class="label label-sm label-danger authorize_btn">Pending</span></a> -->
											<input type="hidden" value="{{$pendingValue->id_doctor}}" class="id_doctor">
											<div class="success_authorize_div"></div>
											<input type="submit" class="btn btn-sm btn-warning authorize_btn" value="Pending" />
										</td>
									</tr>
								@endforeach
								
								<!-- <tr>
									
									
									<td>$35</td>
									<td>3,330</td>
									<td>Feb 18</td>
									<td></td>
									<td><span class="label label-sm label-success">Registered</span></td>
								</tr> -->
							</tbody>
						</table>
					</div>
				</div>
			</div>
		@else
			{{"No pending authorization"}}
		@endif
		</div>
		<!-- end: RESPONSIVE TABLE PANEL -->
	</div>
</div>
<!-- end: PAGE CONTENT-->


@stop
	

	   
@section('scripts')
	@parent
		
		
		{!!Html::script('assets/js/doctor-authorize.js')!!}
		{!!Html::script('assets/plugins/bootstrap/js/bootstrap.min.js')!!}
		{!!Html::script('assets/plugins/iCheck/jquery.icheck.min.js')!!}
		{!!Html::script('assets/plugins/perfect-scrollbar/src/perfect-scrollbar.js')!!}
		{!!Html::script('assets/plugins/jquery-cookie/jquery.cookie.js')!!}
		{!!Html::script('assets/js/main.js')!!}
		{!!Html::script('assets/plugins/bootstrap-modal/js/bootstrap-modal.js')!!}
		{!!Html::script('assets/plugins/bootstrap-modal/js/bootstrap-modalmanager.js')!!}
		{!!Html::script('assets/js/ui-modals.js')!!}
		{!!Html::script('assets/plugins/bootbox/bootbox.min.js')!!}


	<script>

		
		jQuery(document).ready(function() {
			Main.init();
			doctorAuthorize.init();
			
					
						
		});
	</script>
	 		

@stop	
