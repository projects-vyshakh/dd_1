<?php

if(!empty($patientData)){
	$patientName = strtoupper($patientData->first_name." ".$patientData->last_name);
}
else{
	$patientName = Session::get('patientName');
}



?>
@section('head')

	{!!Html::style('assets/plugins/datepicker/css/datepicker.css')!!}
    {!!Html::style('assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css')!!}
    {!!Html::style('assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css')!!}
    {!!Html::style('assets/plugins/select2/select2.css')!!}
    <!-- {!!Html::style('assets/plugins/DataTables/media/css/DT_bootstrap.css')!!} -->
    {!!Html::style('assets/plugins/bootstrap-fileupload/bootstrap-fileupload.min.css')!!}
    {!!Html::style('assets/plugins/bootstrap-social-buttons/social-buttons-3.css')!!}
   	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
  <!-- DataTable (Bootstrap) -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.1.0/css/responsive.bootstrap.min.css">

  
@stop
@extends('layouts.master')
@section('main')

	<div class="row">
		<div class="col-sm-12">
			<div class="page-header" style="margin-bottom: 55px">
				<h1>Dashboard <small></small></h1>
			</div>
		</div>
	</div>
	

	<!-- start: PAGE CONTENT -->
	<div class="row">
		<div class="col-sm-12">
			<div class="tabbable">
				<div class="row">
					<div class="col-sm-12">
						<div class="form-group dd_patient_dd">
							<div class="col-sm-2">
								<div class="user-image">
									<div class="fileupload-new thumbnail">
										<!-- <img src="assets/images/avatar-1-xl.jpg" alt=""> -->
										<!-- <img src="assets/images/patient_profile_L.jpg" alt=""> -->
										<div style="background-image: url(../assets/images/patients/{{$patientData->profile_image_large}});height: 150px;width: 150px;background-size: cover;">
										</div>
										<!-- <img src="assets/images/patients/{{$patientData->profile_image_large}}" alt="" height="150px" width="150px"> -->
									</div>
									
									
								</div>
							</div>
							
							<div class="col-sm-10 dd_patient_add_pd_left">
								<div class="table table-condensed table-hover">
									<div class="dd_personal">
										<div class="dd_personal_main">
											<!-- <td>Name :</td> -->
											<div class="dd_personal_name"><font color="#005a7e">{{$patientName}} </div>
											<!-- <div class="dd_personal_id dd_personal_mg_top_Id">{{$patientData->id_patient}}</div> -->
										</div>
										<div class="dd_personal_id dd_personal_mg_top_Id" ><strong>Patient ID: <font color="#005a7e">{{$patientData->id_patient}}</font></strong></div>
										<div class="dd_personal_main dd_personal_mg_top">
											@if(!empty($patientData->phone))
											<div class="dd_personal_phone"><i class="fa fa-phone-square" aria-hidden="true"></i>
												{{$patientData->phone}}
											</div>
											@endif
											@if(!empty($patientData->email))
											<div class="dd_personal_phone"><i class="fa fa-envelope" aria-hidden="true"></i>
												{{$patientData->email}}
											</div>
											@endif
										</div>
										<div class="col-sm-12 dd_mg_personal_15px dd_personal_mg_top">
											<div class="dd_personal_add"> <i class="fa fa-map-marker" aria-hidden="true"></i>
												@if(!empty($patientData->house_name)) {{$patientData->house_name}}, @else {{" "}} @endif
												@if(!empty($patientData->city)) {{$patientData->city}},  @else {{" "}} @endif
												@if(!empty($patientData->state)) {{$patientData->state}},  @else {{" "}} @endif @if(!empty($patientData->country_name)) {{$patientData->country_name}} @else {{" "}} @endif 
												@if(!empty($patientData->pincode)) -{{$patientData->pincode}} @else {{" "}} @endif 
											</div>
										</div>
										<div class="col-sm-12 dd_mg_personal_15px dd_personal_mg_top">
											<div class="dd_personal_gender">Gender: {{$patientData->gender}}</div>
											<div class="dd_personal_gender">Age: {{$patientData->age}}</div>
											<div class="dd_personal_gender">Maritial Status: {{$patientData->maritial_status}}</div>
										</div>
									</div>
								</div>
							</div>

							<div class="dd_clear"></div>
						</div>	
					</div> 
					<div class="form-group">
						<div class="col-sm-2"></div>
					</div> 
				</div>					
			</div>
		</div>	
	</div>
	<hr>
	<!-- <div class="row">
		<div class="col-sm-12">
			<div class="col-sm-12">
				<h3>Consultant</h3>
				<div class="panel dd_panel_default">
					<div class="panel-body dd_panel_body">
						<table class="table table-striped table-bordered table-hover table-full-width" id="doctor_list">
							<thead>
								<tr>
									<th>Name</th>
									<th>Department</th>
									<th> Hospital</th>
									<th>Phone</th>
									<th>Email</th>
									
								</tr>
							</thead>
							<tbody>
								@foreach($doctorDetails as $index=>$doctorVal)
								<tr>
									<td>{{"Dr"." ".$doctorVal->first_name." ".$doctorVal->last_name}}</td>
									<td class="hidden-xs">{{$doctorVal->specialization_name}}</td>
									<td>Free</td>
									<td class="hidden-xs">{{$doctorVal->phone}}</td>
									<td>{{$doctorVal->email}}</td>
									
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div> -->	
	<div class="row">
		<div class="col-sm-12">
			<div class="col-sm-12">
				<h3>Consultation Details</h3>
				
			</div>
		</div>
	</div>
	<!-- start: PAGE CONTENT -->
	

	<div class="row">
		<div class="col-md-12">
			
			<!-- start: RESPONSIVE TABLE PANEL -->
			<div class="panel panel-default">
				
				<div class="panel-body">
					<div class="">
						<table class="table table-bordered table-hover  dataTable no-footer" id="sample-table-1">
							<thead>
								<tr>
								
									<th>Name</th>
									<th>Department</th>
									<th>Hospital</th>
									<th>Phone</th>
									<th>Email</th>
									
								</tr>
							</thead>
							<tbody>
								@foreach($doctorDetails as $index=>$doctorVal)
								<tr>
									<td>{{"Dr"." ".$doctorVal->first_name." ".$doctorVal->last_name}}</td>
									<td>{{$doctorVal->specialization_name}}</td>
									<td>{{$doctorVal->organization}}</td>
									<td>{{$doctorVal->phone}}</td>
									<td>{{$doctorVal->email}}</td>
									
								</tr>
								@endforeach
								
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- end: RESPONSIVE TABLE PANEL -->
		</div>
	</div>


	<!-- end: PAGE CONTENT-->



	<hr>

	<div class="row">
		<div class="col-sm-12">
			<div class="col-sm-12">
				<h3>Treatment Details</h3>
				
			</div>
		</div>
	</div>
	<!-- start: PAGE CONTENT -->
	<div class="row">
		<div class="col-md-12">
			
			<!-- start: RESPONSIVE TABLE PANEL -->
			<div class="panel panel-default">
				
				<div class="panel-body">
					<div class="">
						<table class="table table-bordered table-hover  dataTable no-footer" id="doctor_list">
							<thead>
								<tr>
								
									<th>Consult Date</th>
									<th>Consultant</th>
									<th>Department</th>
									<th><i class="fa fa-time"></i> Follow Up Date </th>
									
								</tr>
							</thead>
							<tbody>
								@foreach($treatmentHistory as $index=>$treatmentHistoryVal)
								<?php
									$followupDate = $treatmentHistoryVal->follow_up_date;
									$consultDate = $treatmentHistoryVal->created_date;
									if(!empty($followupDate) || $followupDate!="0000-00-00"){
										$followupDate = date('d M Y',strtotime($followupDate));
									}
									else{
										$followupDate = "";
									}
									if(!empty($consultDate) || $consultDate!="0000-00-00"){
										$consultDate = date('d M Y',strtotime($consultDate));
									}
									else{
										$consultDate = "";
									}

									
								?>
								<tr>
									
									<td>{{$consultDate}}</td>
									<td>{{"Dr"." ".$treatmentHistoryVal->first_name." ".$treatmentHistoryVal->last_name}}</td>
									<td>{{$treatmentHistoryVal->specialization_name}}</td>
									<td>{{$followupDate}}</td>
									
								</tr>
								@endforeach
								
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- end: RESPONSIVE TABLE PANEL -->
		</div>
	</div>
	<!-- end: PAGE CONTENT-->


					

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
		
		
		
		{!!Html::script('assets/plugins/jquery-validation/dist/jquery.validate.min.js')!!}
		{!!Html::script('assets/js/patient-personal-information.js')!!}
        {!!Html::style('assets/css/dd-responsive.css')!!}

        {!!Html::script('assets/plugins/bootbox/bootbox.min.js')!!}
        {!!Html::script('assets/plugins/jquery-mockjax/jquery.mockjax.js')!!}
        {!!Html::script('assets/plugins/select2/select2.min.js')!!}
        {!!Html::script('assets/plugins/DataTables/media/js/jquery.dataTables.min.js')!!}
        {!!Html::script('assets/plugins/DataTables/media/js/DT_bootstrap.js')!!}
        {!!Html::script('assets/js/table-data.js')!!}
     	
     	{!!Html::script('assets/plugins/bootstrap-fileupload/bootstrap-fileupload.min.js')!!}
     	{!!Html::script('assets/plugins/jquery.pulsate/jquery.pulsate.min.js')!!}
     	{!!Html::script('assets/js/pages-user-profile.js')!!}
     
     	
     	<script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
		  <!-- DataTable (Bootstrap) -->
		<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.1.0/js/dataTables.responsive.min.js"></script>
     	
		
	<script>
		$(document).ready(function() {
			Main.init();
			patientElements.init();
			TableData.init();
			PagesUserProfile.init();

		
						
            /*Dynamically adding state responding to country and also keeping selected value of state*/
			var stateHidden = $('#state-hidden').val();
          	var countryId  = $( "#country option:selected" ).val();
            //alert(country);
            $.ajax({
                type: "POST",
                url: "getState",
                data: "country_id="+ countryId ,
                success: function(data){
                    $('#state').empty();
                    for(var s=0;s<data.length;s++){

                        $('#state').append('<option>'+data[s].state_name+'</option>');
                        $('#state').val(stateHidden).attr("selected", "selected");

                    }
                }
            });









			
	
	 	});
	</script>
@stop	