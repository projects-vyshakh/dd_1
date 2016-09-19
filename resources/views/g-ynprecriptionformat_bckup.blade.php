<?php
$currentDate = date('d-M-Y');


if(!empty($doctorPersonalData)){
	$doctorName = ucfirst($doctorPersonalData->first_name)." ".ucfirst($doctorPersonalData->last_name);
	$qualification = json_decode($doctorPersonalData->qualification);
	$specialization = strtoupper($doctorPersonalData->specialization_name);
	$organization = strtoupper($doctorPersonalData->organization);
	$registrationNo = $doctorPersonalData->doctor_registration_no;

}
else{
	$doctorName = "";
	$qualification = "";
	$specialization = "";
	$organization = "";
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
	$patientName = "";
	$patientId = "";
	$gender   ="";
	$age ="";
	$mobile  = "";
	
}





if(!empty($vitalsData)){
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
}




?>


<!DOCTYPE html>
<html>
	<title> Patient Prescripton Copy</title>
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
				padding: 10px;
				color: #323232;
				text-transform: uppercase;
				font-family: 'Roboto', sans-serif;
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
				p{
					padding: -5px 0;
					margin: 0 ;
				}


		</style>
		
	</head>
	
	<body>
		
		<table cellpadding="5px" cellspacing="0">
			<tr>
				<td colspan="4">
					<div class="invoice" >
						<h1>{{$organization}}</h1>
					</div>
				</td>
				<td class="amount">Phone Number : </td>
				<td class="amount">{{$mobile}} </td>
			</tr>
		</table>

		<div class="pd_abs"></div>
			<table class="pd_mg_30_t">
				<tr >
					<td >
						<h2>Dr. {{strtoupper($doctorName)}} </h2>
						
					</td>
					<td></td>
					<td>
					 	<h2 class="pd_mg_5_t" style="color:#686868">Patient ID  : &nbsp; {{$patientId}}</h2>
					</td>
				</tr>
				<tr>
					<td style="line-height:1px">
						@foreach($qualification as $index=>$qualificationVal) {{$qualification[$index]}} @if($index!=count($qualification)-1) , @endif @endforeach 
					</td>
					<td></td>
					<td >
					 	<h2 class="pd_mg_5_t" style="color:#686868">Patient Name  : &nbsp; {{$patientName}}</h2>
					</td>
				</tr>
				<tr>
					<td >{{$specialization}}</td>
					<td></td>
					<td>
						<h2 class="pd_mg_5_t" style="color:#686868">Age  : &nbsp; {{$age}}</h2>
					</td>
				</tr>
				<tr>
					<td>Reg No : {{$registrationNo}}</td>
					<td></td>
					<td>
						<h2 class="pd_mg_5_t" style="color:#686868">Blood Group  : &nbsp; {{$bloodGroup}}</h2>
					</td>
				</tr>
			
			</table>
			<br>
			<div class="pd_abs pd_mg_20_t "></div>

			 	<table class="pd_mg_30_t"  >

					<tr>
						<td><h3>Vitals: </h3></td>
						<td colspan="2"></td>
						<td> </td>
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
				</table>

				<div class="pd_abs pd_mg_30_t"></div>

				<table class="pd_mg_30_t"><tr><td><h3>Prescription: </h3></td></tr></table>
					<table class="pd_mg_10_t pd_style" >


						<tr class="bold" style="background-color:#e5e6e6; padding:10px;">
							
							<th width="20%" class="pd_text_L">Drugs</th>
							<th width="20%" class="pd_text_L">Dosage</th>
							<th width="40%" class="pd_text_L">Frequency </th>
							<th width="20%" class="pd_text_L">Duration </th>
							<!-- <th>Duvadilan tab </th> -->
						</tr>
						
						@if(!empty($prescriptionData))
							@foreach($prescriptionData as $index=>$precriptionDataVal)
							<tr>
								<td>{{$index+1}}. {{$precriptionDataVal->drug_name}}</td>
								<td>{{$precriptionDataVal->dosage}} {{$precriptionDataVal->dosage_unit}}</td>
								<td>Morning :{{$precriptionDataVal->morning}}, Noon : {{$precriptionDataVal->noon}}, Night : {{$precriptionDataVal->night}}</td>
								<td>{{$precriptionDataVal->duration}} {{$precriptionDataVal->duration_unit}}</td>

								

							</tr>
							@endforeach
						@else
							<h4 style="text-align:center; margin-bottom:30px;">No drug details available</h4	>
						@endif	
				</table>

				<div class="pd_abs pd_mg_30_t"></div>

				<table class="pd_mg_30_t" style="margin-bottom:30px;" >
					<tr>
						<th style="text-align:left; width:60%"><h5>Symptoms</h5></th>
						<th style="text-align:left;"><h5>Syndormes</h5></th>	
					</tr>
					<tr>
						<td>
							@if(!empty($symptoms))
								@foreach($symptoms as $index=>$symptomsVal)<br>
									@if($index%2==0)
										{{$index+1}}) {{$symptoms[$index]}}
									@else
										{{$index+1}}) {{$symptoms[$index]}}
									@endif

								@endforeach
							@else
								<h4 style="text-align:center">No data available</h4	>
							@endif	

						</td>
						<td>
							@if(!empty($syndroms)) {{$syndroms}} @else <h4 style="text-align:center">No data available @endif</h4	>
							
						</td>
					</tr>
				</table>

				<div class="pd_abs pd_mg_30_t"></div>

				<br>
				<table class="pd_mg_20_t">
					<tr>
						<th style="text-align:left; width:60%"><h5>Diseases</h5></th>
						<th style="text-align:left;"><h5>Additional Comments</h5></th>	
					</tr>
					<tr>
						<td>
							@if(!empty($diseases))
							@foreach($diseases as $index=>$diseasesVal)<br>
								@if($index%2==0)
								<p>{{$index+1}}) {{$diseases[$index]}}</p>
								@else
									<p>{{$index+1}}) {{$diseases[$index]}}</p>
								@endif

							@endforeach
							@else
								<h4 style="text-align:center">No data available
							@endif
						</td>
						<td>
							@if(!empty($comments)){{$comments}} @else <h4 style="text-align:center">No data available @endif</h4	>
						</td>
					</tr>
				</table>
				<div class="pd_abs pd_mg_30_t"></div>
				
				<?php
				//var_dump($prescriptionData);
					if(!empty($prescriptionData)){
						$count = count($prescriptionData);
						$treatment = $prescriptionData[$count-1]->treatment;
						$followupDate = $prescriptionData[$count-1]->follow_up_date;

					}
					

				?>
				<br><br>


				<table>
					<tr>
						<th style="text-align:left"><h5>Treatment</h5></th>
						<th style="text-align:right"><h5>Followup Date</h5></th>
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
						
					
					<!-- <tr >
						
						<th colspan="3" class="bordered">DESCRIPTION</th>
						<th class="bordered">AMOUNT</th>
					</tr>
					<tr >
						<td class="bordered-sides" colspan="3"> Package </td>
						<td class="bordered-sides"></td>
					</tr>
					
					<tr>
						<td class="bordered-sides" colspan="3">Total Amount </td>
						<td class="bordered-sides amount"></td>
					</tr>
					
					
							
					<tr>
						<td class="bordered-sides" colspan="3">Advance Amount </td>
						<td class="bordered-sides amount"></td>
					</tr>
					
					
					
					
					
					<tr>
						<td class="bordered-sides" colspan="3">Balance Amount  </td>
						<td class="bordered-sides amount"></td>
					</tr>
					
					
					<tr class="bold">
						<td class="bordered-left-bottom" colspan="2"></td>
						<td class="bordered">Total Amount Received</td>
						<td class="bordered amount">
							
						</td>
					
					</tr>
					<tr>
						<td colspan="4" class="address-col">Amount received in words : </td>
					</tr>
					<tr>
						<td colspan="4">Make all DD payable to <b>Esteem Holidays Pvt Ltd</b></td>
					</tr>
					<tr>
						<td colspan="4">Online payment (NEFT/RTGS) details as below </td>
					</tr>
					<tr>
						<td colspan="2">Account Number</td>
						<td colspan="2" class="bold">50200004750712</td>
					</tr>
					<tr>
						<td colspan="2">Account Name</td>
						<td colspan="2" class="bold">Esteem Holidays Pvt Ltd</td>
					</tr>
					<tr>
						<td colspan="2">Account Type</td>
						<td colspan="2">Current</td>
					</tr>
					<tr>
						<td colspan="2">Bank &amp; Branch</td>
						<td colspan="2">HDFC Bank, Kakkanad, Ernakulam</td>
					</tr>
					<tr>
						<td colspan="2">IFSC Code</td>
						<td colspan="2" class="bold">HDFC0000684</td>
					</tr>
					
				</table> -->
				
			  </div>
	
		
	</body>
	
</html>	
		
