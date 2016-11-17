<?php
$currentDate = date('d-M-Y');


if(!empty($doctorPersonalData)){
	$doctorName 	= ucfirst($doctorPersonalData->first_name)." ".ucfirst($doctorPersonalData->last_name);
	$qualification 	= json_decode($doctorPersonalData->qualification);
	$specialization = strtoupper($doctorPersonalData->specialization_name);
	$organization 	= strtoupper($doctorPersonalData->organization);
	$registrationNo = $doctorPersonalData->doctor_registration_no;

}
else{
	$doctorName 	= "";
	$qualification 	= "";
	$specialization = "";
	$organization 	= "";
	$registrationNo = "";

}

if(!empty($patientPersonalData)){
	$patientName = ucfirst($patientPersonalData->first_name)." ".ucfirst($patientPersonalData->last_name);
	$patientId   = $patientPersonalData->id_patient;
	$gender      = $patientPersonalData->gender;
	$age         = $patientPersonalData->age;
	$mobile		 = $patientPersonalData->phone;
 	

}
else{
	$patientName 	= "";
	$patientId 		= "";
	$gender   		="";
	$age 			="";
	$mobile  		= "";
	
}





/*if(!empty($vitalsData)){
	$weight = $vitalsData->weight;
	$bloodGroup  = $vitalsData->blood_group;
	$systolic = $vitalsData->systolic_pressure;
	$diastolic = $vitalsData->diastolic_pressure;
	$pulse = $vitalsData->pulse;
	$respiratoryRate = $vitalsData->respiratoryrate;
	$sp = $vitalsData->sp;
	$temp = $vitalsData->temperature; 
}
else{
	$weight = "";
	$bloodGroup = "";
	$systolic = "";
	$diastolic = "";
	$pulse = "";
	$respiratoryRate = "";
	$sp = "";
	$temp = "";
}

if(!empty($diagnosisData)){
	$symptoms = json_decode($diagnosisData->diag_symptoms);
	$diseases = json_decode($diagnosisData->diag_suspected_diseases);
	$syndroms = $diagnosisData->diag_syndromes;
	$comments = $diagnosisData->diag_comment;
}
else{
	$symptoms = "";
	$diseases = "";
	$syndroms = "";
	$comments = "";
}*/

if(!empty($printData)){
	$marginTop 		= $printData->margin_top;
	$marginBottom 	= $printData->margin_bottom;
	$marginLeft 	= $printData->margin_left;
	$marginRight 	= $printData->margin_right;
	

}
else{
	$marginTop 		= 0;
	$marginBottom 	= 0;
	$marginLeft 	= 0;
	$marginRight 	= 0;
}


?>


<!DOCTYPE html>
<html>
	<title> Patient Prescriton Copy</title>
	<head>
		<style>
			body
			{
				font-family: 'Roboto', sans-serif;
				font-size: 10pt;
				color: #252525;
				
			}
			table{
				width: 100%;
				table-layout: fixed;
				border-collapse: collapse;
				

			}
			tr{
				border : 1px solic black;
			}
			td{
				padding: 5px;
			}
			th{
				font-weight: bold;
				text-align: center;
			}
			img{
				
			}
			.pd_text_L{
				text-align: left;
				padding: 15px;
				color: #323232;
				text-transform: uppercase;
				font-family: 'Roboto', sans-serif;
			}
				.pd_text_L_2{
				text-align: left;
				padding: 15px;
				color: #525252;
				font-family: 'Roboto', sans-serif;
				font-size: 13px;
			}
			
			.amount{
				text-align: right;
			}
			.invoice
			{
				
				font-weight: bold;
			}
			.bold
			{
				font-weight: bold;
			}
			.fontweight_normal
			{
				font-weight: normal;
			}
			.size_20{
				font-size: 20px;
			}
			.address-col{
				height : 100px;
				vertical-align: top;
			}
			.bordered
			{
				border : 1px solid black;
				
			}
			.bordered-left{
				border-left : 1px solid black;
			}
			.bordered-right{
				border-right : 1px solid black;
			}
			.bordered-sides{
				border-left : 1px solid black;
				border-right : 1px solid black;
			}
			.bordered-left-bottom{
				border-left : 1px solid black;
				border-bottom: 	1px solid black;
			}
			.pd_mg_5{
				margin: 5px 0;
			}
			.pd_mg_7{
				margin: 7px 0;
			}
			.pd_mg_10{
				margin: 10px 0;
			}
			.pd_mg_15{
				margin: 15px 0;
			}
			.pd_mg_20{
				margin: 20px 0;
			}
			.pd_mg_5_t{
				margin-top: 5px;
			}
			.pd_mg_7_t{
				margin-top: 7px ;
			}
			.pd_mg_10_t{
				margin-top: 10px ;
			}
			.pd_mg_15_t{
				margin-top: 15px ;
			}
			.pd_mg_20_t{
				margin-top: 20px ;
			}
			.pd_mg_30_t{
				margin-top: 30px ;
			}
				.pd_mg_40_t{
				margin-top: 40px ;
			}

			.pd_mg_50_t{
				margin-top: 50px ;
			}
			h1{
				color: #005a7e;
				font-size: 26px;
			line-height: 30px;
			margin: 0;
			padding: 0;
			text-transform: uppercase;
			}
			h2{
			color: #4c4d4d;
			font-size: 14px;
			line-height: 20px;
			margin: 0;
			padding: 0;
			/*text-transform: uppercase;*/
			}
			h3{
			color: #4c4d4d;
			font-size: 18px;
			line-height: 30px;
			margin: 0;
			padding: 0;
			text-transform: uppercase;
			}
			h4{
			color: #4c4d4d;
			font-size: 14px;
			line-height: 30px;
			margin: 0;
			padding: 0;
			
			}
				h5{
			color: #323232;
			font-size: 14px;
			line-height: 16px;
			margin: 0;
			padding: 0;
			text-transform: uppercase;
			font-weight: 500;
			
			}
					h6{
			color: #262626;
			font-size: 13px;
			line-height: 16px;
			margin: 0;
			padding: 0;
			text-transform: uppercase;
			font-weight: 700;
			
			}
			.pd_f_U{
				/*text-transform: uppercase;*/
			}
			.pd_style{
				border:1px solid #acacac;
				
			}
			.pd_pd{
				padding: 20px;

			}
			.well {
				    background-color: #f5f5f5;
				    border: 1px solid #e3e3e3;
				    border-radius: 8px;
				    box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05) inset;
				    margin-bottom: 20px;
				    min-height: 20px;
				    padding: 19px;
				}
				.pd_abs{
					border:0.1px solid #7f7f7f; 
			

				}
				.pd_abs_2{
					border:0.1px solid black; 

					

				}
				.pd_mg_mn{
					margin-top: -4px;

				}
				.pd_mg_MIn_20{
					margin-top: -20px;
				}
				.pd_mg_30_b{
					margin-bottom: 30px;
				}
				p{
					margin: 0;
					padding:-2px 0;
				}
				
				.full-cover{
					margin-top: 	<?php echo $marginTop."px"; ?> ;
					margin-bottom: 	<?php echo $marginBottom."px"; ?> ;
					margin-left:	<?php echo $marginLeft."px"; ?> ;
					margin-right:	<?php echo $marginRight."px"; ?> ;

				}

		</style>
		
	</head>
	
	<body>
		
		<!-- Organization & Mobile number -->
<!-- 		<table>
			<tr>
				<td colspan="4">
					<div class="invoice" >
						<h1>{{$organization}}</h1>
					</div>
				</td>
				<td class="amount" style="padding-bottom:0px;">Phone Number : </td>
				<td class="amount">{{$mobile}} </td>
			</tr>
		</table> -->
		<!-- <div class="pd_abs"></div> -->
		<!-- Organization & Mobile number ends -->

		<!-- Doctor & Patient Details -->
		<!-- <table class="">
			<tr >
				<td colspan="3"><h2>Dr. {{strtoupper($doctorName)}} </h2></td>
				<td>Patient ID  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp; {{$patientId}}</td>
			</tr>
			<tr>
				<td style="padding-top:-2px" colspan="3">
					@foreach($qualification as $index=>$qualificationVal) {{$qualification[$index]}} @if($index!=count($qualification)-1) , @endif @endforeach 
				</td>
				<td style="padding-top:-2px;">Patient Name  : &nbsp; {{$patientName}}</td>
			</tr>
			<tr >
				<td style="padding-top:-2px;"  colspan="3">{{$specialization}}</td>
				<td style="padding-top:-2px;">Age &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :&nbsp; {{$age}} Years</td>
			</tr>
			<tr>
				<td  style="padding-top:-2px;"  colspan="3">Reg No : {{$registrationNo}}</td>
				<td style="padding-top:-2px;">Blood Group &nbsp; : &nbsp; {{$bloodGroup}}</td>
			</tr>
		
		</table> -->
		<!-- <div class="pd_abs"></div> -->
		<!-- Doctor & Patient Details ends -->
	<div class="full-cover">	
		<!-- Medical History -->		
		<!-- <table class="">
			<tr>
				<td><h3>Medical History :</h3></td>
			</tr>
			<tr>
				
				@foreach($medicalHistoryData as $index=>$medicalHistoryDataVal)
					@if($medicalHistoryDataVal->illness_name=="Hypertension" ||
						$medicalHistoryDataVal->illness_name=="Diabetes" ||
						$medicalHistoryDataVal->illness_name=="Cancer")
						<td >
							{{$medicalHistoryDataVal->illness_name}} : 
							@if($medicalHistoryDataVal->illness_status=="Current" ||
								$medicalHistoryDataVal->illness_status=="Past")
								Yes / {{$medicalHistoryDataVal->illness_status}}
							@else
								No 
							@endif

						</td>
					@endif		
				@endforeach
			</tr>
			

		</table> -->
		<div class="pd_abs"></div>	
		<!-- Medical History ends -->	
			
		<!-- Vitals  -->
	 	<!-- <table class="pd_mg_30_t pd_mg_30_b  pd_mg_30_t">

			<tr>
				<td colspan="2"><h3>Vitals: </h3></td>
			</tr>
			<tr>
				<td> <img width="40px" height="40px" src="assets/images/weight.png"></td>
				<td ><img width="40px" height="40px" src="assets/images/bloodpressure.png"> </td>
				<td ><img width="40px" height="40px" src="assets/images/pulse.png"></td> 
				<td ><img width="40px" height="40px" src="assets/images/respiratoryrate.png"></td>
				<td ><img width="40px" height="40px" src="assets/images/spo2.png"></td>
				<td ><img width="40px" height="40px" src="assets/images/temperature.png"></td>
			</tr>

			<tr>
				<td>{{$weight}} @if(!empty($weight)) Kg @endif </td>
				<td >
					{{$systolic}} @if(!empty($systolic) && !empty($diastolic))/@endif{{$diastolic}} @if(!empty($systolic) && !empty($diastolic)) mmHg @endif
				</td>
				<td >{{$pulse}} @if(!empty($pulse)) bpm @endif</td> 
				<td >{{$respiratoryRate}} @if(!empty($respiratoryRate)) breaths/min @endif</td>
				<td >{{$sp}}  @if(!empty($sp))% @endif</td>
				<td >{{$temp}}  @if(!empty($temp))&deg;F @endif</td>
			</tr>
		</table> -->
		<div class="pd_abs pd_mg_30_t"></div>
		<!-- Vitals  ends -->

		<!-- Diagnosis Starts -->
		<!-- <table class="">
			<tr>
				<td colspan="3"><h3>Diagnosis : </h3></td>
			</tr>
			<tr>
				<th  colspan="2" style="text-align:left">Symptoms</th>
				<th style="text-align:left">Syndromes</th>
			</tr>
			<tr>
				
				<td colspan="2">
					@if(!empty($symptoms))
						@foreach($symptoms as $index=>$symptomsVal)
							@if(!empty($symptoms[$index]))
								<p style="padding:5px 5px 5px">{{$index+1}}) {{$symptoms[$index]}} </p>
							@else
								<p><h4 style="text-align:left">No data available</h4	>  </p>

							@endif
						@endforeach

					@endif -->


					<!-- @if(!empty($symptoms))
						@foreach($symptoms as $index=>$symptomsVal)<br>
							@if($index%2==0)
								@if(!empty($symptoms[$index]))
									<p>{{$index+1}}) {{$symptoms[$index]}} </p>
								@else
									<p><h4 style="text-align:left">No data available</h4	>  </p>

								@endif
							@else
								@if(!empty($symptoms[$index]))
									<p>{{$index+1}}) {{$symptoms[$index]}} </p>
								@else
									<p><h4 style="text-align:left">No data available</h4	>  </p>

								@endif
							@endif

						@endforeach
					@else
						<h4 style="text-align:center">No data available</h4	>
					@endif -->	

				<!-- </td>
				<td class="pd_mg_10_t">
					@if(!empty($syndroms)) {{$syndroms}} @else <h4 style="text-align:center">No data available @endif</h4	>
					
				</td>
				
			</tr>
			<tr>
				<th colspan="2" style="text-align:left;">Diseases</th>
				<th style="text-align:left;">Additional Comments</th>	
			</tr>
			<tr>
				<td colspan="2">
					@if(!empty($diseases))
						@foreach($diseases as $index=>$diseasesVal)
							@if(!empty($diseases[$index]))
								<p style="padding:5px 5px 5px">{{$index+1}}) {{$diseases[$index]}} </p>
							@else
								<p><h4 style="text-align:left">No data available</h4	>  </p>

							@endif
						@endforeach

					@endif
		
				</td>
				<td>
					@if(!empty($comments)){{$comments}} @endif
				</td>
			</tr>
			
			<tr>
				<td class="pd_mg_10_t"></td>
				
			</tr>
		</table>
		<div><textarea  style="width:100%">{{$comments}}</textarea></div>

		<div class="pd_abs pd_mg_30_t"></div> -->
		<!-- Diagnosis Ends -->

				
		<!-- Prescription -->
		<table class="">
			<tr><td><h3>Prescription : </h3></td></tr>
		</table>
		<table class="pd_style" >
			<tr class="bold" style="background-color:#e5e6e6; padding:8px;">
				
				<th width="20%" class="pd_text_L">Drugs</th>
				<th width="20%" class="pd_text_L">Dosage</th>
				<th width="40%" class="pd_text_L">Frequency </th>
				<th width="20%" class="pd_text_L">Duration </th>
				<!-- <th>Duvadilan tab </th> -->
			</tr>
			
			@if(!empty($prescriptionData))
				@foreach($prescriptionData as $index=>$precriptionDataVal)
				<tr>
					<td class="pd_text_L_2">{{$index+1}}. {{$precriptionDataVal->drug_name}}</td>
					<td class="pd_text_L_2" >{{$precriptionDataVal->dosage}} {{$precriptionDataVal->dosage_unit}}</td>
					<td class="pd_text_L_2">Morning :{{$precriptionDataVal->morning}}, Noon : {{$precriptionDataVal->noon}}, Night : {{$precriptionDataVal->night}}</td>
					<td class="pd_text_L_2">{{$precriptionDataVal->duration}} {{$precriptionDataVal->duration_unit}}</td>
				</tr>
				@endforeach
			@else
				<h4 style="text-align:center; margin-bottom:30px;">No drug details available</h4	>
			@endif	
		</table>

		<?php
			if(!empty($prescriptionData)){
				$count = count($prescriptionData);
				$treatment = $prescriptionData[$count-1]->treatment;
				$followupDate = $prescriptionData[$count-1]->follow_up_date;
			}
		?>

		<table style="margin-top:50px">
			<tr>
				<th style="text-align:left">Treatment</th>
				<th style="text-align:right">Followup Date</th>
			</tr>
			<tr>
				@if(empty($treatment) && empty($followupDate))
					<h4 style="text-align:center">No data available</h4	>
				
				@else
					<td>{{$treatment}}</td>
					<td style="text-align:right">@if($followupDate!="0000-00-00") {{date('d-M-Y',strtotime($followupDate))}} @endif</td>
					
				@endif
			</tr>

		</table>

	

			
						
					
				
				
		</div>
	
		
	</body>
	
</html>	
		
