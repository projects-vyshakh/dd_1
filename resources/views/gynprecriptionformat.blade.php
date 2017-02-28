<?php
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
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Prescritpion Copy</title>


    <style>
    *{
    	 font-family: verdana, 'Open Sans', sans-serif;

    }
    	

		.clearfix:after {
		  content: "";
		  display: table;
		  clear: both;
		}


		body {
		  
		  height: 29.7cm; 
		  margin: 0 auto; 
		  color: #555555;
		  background: #FFFFFF; 
		  font-family: verdana, 'Open Sans', sans-serif;
		  font-size: 12px; 
		  /*font-family: SourceSansPro;*/
		}
		
		h2.name {
		  font-size: 1.4em;
		  font-weight: normal;
		  margin: 0;
		}
		h5{
			color: red;
		  font-size: 16px;
		  font-weight: bold;
		  margin: 0 0 0 0;
		  font-family: verdana, 'Open Sans', sans-serif;
		

		}

		h4{

		  font-size: 13px;
		  font-weight: bold;
		  margin: 0 0 0.1em 0;
		  font-family: verdana, 'Open Sans', sans-serif;
		  color: #555555

		}
		h6{

		  font-size: 15px;
		  font-weight: bold;
		  margin: 0 0 0.2em 0;
		  font-family: verdana, 'Open Sans', sans-serif;

		}
		hr{
			margin: 12px 0;
			border-bottom: 0.5px solid #888
		}

		

		table {
		  width: 100%;
		  border-collapse: collapse;
		  border-spacing: 0;
		  margin-bottom: 10px;
		}

		table th,
		table td {
		 /* padding: 20px;*/
		  /*background: #EEEEEE;*/
		  text-align: center;
		  /*border-bottom: 1px solid #FFFFFF;*/
		  border: 0
		}

		table th {
		  white-space: nowrap;        
		  font-weight: normal;
		}

		table td {
		  text-align: left;
		}

		table td h3{
		  color: #0070c0;
		  font-size: 16px;
		  font-weight: bold;
		  margin: 0 0 0.2em 0;
		  font-family: verdana, 'Open Sans', sans-serif;
		}

		table .no {
		  color: #FFFFFF;
		  font-size: 1.6em;
		  background: #57B223;
		}

		table .desc {
		  text-align: left;
		}

		table .unit {
		  background: #DDDDDD;
		}

		table .qty {
		}

		table .total {
		  background: #57B223;
		  color: #FFFFFF;
		}

		table td.unit,
		table td.qty,
		table td.total {
		  font-size: 1.2em;
		}

		table tbody tr:last-child td {
		  border: none;
		}

		table tfoot td {
		  padding: 10px 20px;
		  background: #FFFFFF;
		  border-bottom: none;
		  font-size: 1.2em;
		  white-space: nowrap; 
		  border-top: 1px solid #AAAAAA; 
		}

		table tfoot tr:first-child td {
		  border-top: none; 
		}

		table tfoot tr:last-child td {
		  color: #57B223;
		  font-size: 1.4em;
		  border-top: 1px solid #57B223; 

		}

		table tfoot tr td:first-child {
		  border: none;
		}

		.full_cover{
			margin-top: 	<?php echo $marginTop."px"; ?> ;
			margin-bottom: 	<?php echo $marginBottom."px"; ?> ;
			margin-left:	<?php echo $marginLeft."px"; ?> ;
			margin-right:	<?php echo $marginRight."px"; ?> ;

		}
		.dd_not_bold{
			font-weight: normal;
		}


    </style>
  </head>
  <body>

  	<?php
  		//Doctor Personal Information
  		if(!empty($doctorPersonalData)){
  			$doctorName = "Dr"." ".$doctorPersonalData->first_name." ".ucfirst($doctorPersonalData->last_name);
  			$qualification 		= json_decode($doctorPersonalData->qualification);	
  			$qualificationCount = sizeof($qualification);
      		$specializationName = $doctorPersonalData->specialization_name;
      		$mobile 			= $doctorPersonalData->phone;
      		$imaRegNum 			= $doctorPersonalData->doctor_registration_no;
      		
  		}
  		else{
  			$doctorName 		= "";
  			$qualification 		= "";
  			$qualificationCount = "";
  			$specializationName = "";
  			$mobile 			= "";
  			$imaRegNum 			= "";
  		}

  		//Patient Personal Information
  		if(!empty($patientPersonalData)){
  			$patientName 	= $patientPersonalData->first_name." ".$patientPersonalData->last_name;
    		$age 			= $patientPersonalData->age." "."years";
    		$gender 		= $patientPersonalData->gender;
    		$pMobile 		= $patientPersonalData->phone;
    		$patientId      = $patientPersonalData->id_patient;
    		
  		}
  		else{
  			$patientName = "";
  			$age 		 = "";
  			$gender 	 = "";
  			$pMobile 	 = "";
  			$patientId   = "";
  		}

  		//Vitals history
  		if(!empty($vitalsData)){
			$weight 			= $vitalsData->weight;
	    	$pressure 			= $vitalsData->systolic_pressure."/".$vitalsData->diastolic_pressure;
	    	$pulse 				= $vitalsData->pulse;
	    	$respiratoryrate 	= $vitalsData->respiratoryrate;
	    	$spo2 				= $vitalsData->sp;
	    	$temperature 		= $vitalsData->temperature;
		}
		else{
			$weight 			= "";
	    	$pressure 			= "";
	    	$pulse 				= "";
	    	$respiratoryrate 	= "";
	    	$spo2 				= "";
	    	$temperature 		= "";
		}

		if(!empty($prescTreatmentFollowupData)){
			$followUpDate = $prescTreatmentFollowupData->follow_up_date;
			$treatment    = $prescTreatmentFollowupData->treatment;
		}
		else{
			$followUpDate = "";
			$treatment    = "";
		}

		


  	?>

  	<div class="full_cover">
  		@if(!empty($printData))
  			<table>
				<tr>
					@if($printData->header_settings=="Yes")
						<td width="60%" valign="top">
							@if(!empty($doctorPersonalData))
								<table>
									<tr>
										<td>
											<h6>{{$doctorName}}</h6>
										</td>
									</tr>
									<tr>
										<td>
											@foreach($qualification  as $index=>$qualificationVal)
								          		
								          		@if($index>=0 && $index<$qualificationCount-1)
								          			{{$qualificationVal.","." "}}
								          		@else
								          			{{$qualificationVal.","." "}}
								          		@endif
								          	@endforeach
								          	{{$specializationName}}	
										</td>
									</tr>
									<tr>
										<td>
											IMA Registration Number: {{$imaRegNum}}
										</td>
									</tr>
									<tr>
										<td>
											Phone No: {{$mobile}}
										</td>
									</tr>
								</table>
							@else

							@endif
								
						</td>
					@else
						<td></td>
					@endif

					@if(!empty($patientPersonalData))
						<td width="40%" valign="top">
							<table>
								<tr>
									<td><b style="font-size: 14px;">Patient Name:</b> {{$patientName}}</td>
								</tr>
								<tr>
									<td>
										Age: {{$age}}
									</td>
								</tr>
								<tr>
									<td>
										Gender: {{$gender}}
									</td>
								</tr>
								<tr>
									<td>
										<b style="font-size: 14px;">Patient ID:</b> {{$patientId}}
									</td>
								</tr>
							</table>
						</td>
					@else
					@endif

					
				</tr>
			</table>
  		@else
  			<table>
				<tr>
					<td width="60%">
						@if(!empty($doctorPersonalData))
							<table>
								<tr>
									<td>
										<h6>{{$doctorName}}</h6>
									</td>
								</tr>
								<tr>
									<td>
										@foreach($qualification  as $index=>$qualificationVal)
								          		
							          		@if($index>=0 && $index<$qualificationCount-1)
							          			{{$qualificationVal.","." "}}
							          		@else
							          			{{$qualificationVal.","." "}}
							          		@endif
							          	@endforeach
							          	{{$specializationName}}	
									</td>
								</tr>
								<tr>
									<td>
										IMA Registration Number: {{$imaRegNum}}
									</td>
								</tr>
								<tr>
									<td>
										Phone No: {{$mobile}}
									</td>
								</tr>
							</table>
						@else

						@endif
								
					</td>


					@if(!empty($patientPersonalData))
						<td width="40%">
							<table>
								<tr>
									<td><b style="font-size: 14px;">Patient Name:</b> {{$patientName}}</td>
								</tr>
								<tr>
									<td>
										Age: {{$age}}
									</td>
								</tr>
								<tr>
									<td>
										Gender: {{$gender}}
									</td>
								</tr>
								<tr>
									<td>
										<b style="font-size: 14px;">Patient ID:</b> {{$patientId}}
									</td>
								</tr>
							</table>
						</td>
					@else
					@endif
				</tr>
			</table>
  		@endif
			    


		

		<hr style="border-bottom: 1px solid #4f81bd">


		<!-- //---------------------Vitasls table started--------------------------------// -->

		<table>

			<tr>
				<td><h3>VITALS:</h3></td>
			</tr>

			<tr>
				<td style="text-align: center;">
					
					<table>
						<tr>
							<td style="text-align: center;" valign="top"><img width="40px" height="40px" src="assets/images/weight.png"></td>
						</tr>
					</table>
					<table>
						<tr>
							<td style="text-align: center;" valign="top">{{$weight}} @if(!empty($weight)) {{"Kg"}} @else {{""}} @endif</td>
						</tr>
					</table>
					<!-- <div style="margin-top: 7px;">
						
					</div> -->
				</td>
				<td style="text-align: center;">

					<table>
						<tr>
							<td style="text-align: center;" valign="top"><img width="40px" height="40px" src="assets/images/bloodpressure.png"></td>
						</tr>
					</table>
					<table>
						<tr>
							<td style="text-align: center;" valign="top">{{$pressure}} @if(!empty($pressure)) {{"mmHg"}} @else {{""}} @endif</td>

						</tr>
					</table>
					
					
				</td>

				<td style="text-align: center;">

					<table>
						<tr>
							<td style="text-align: center;" valign="top"><img width="40px" height="40px" src="assets/images/pulse.png"></td>
						</tr>
					</table>
					<table>
						<tr>
							<td style="text-align: center;" valign="top">{{$pulse}} @if(!empty($pulse)) {{"bpm"}} @else {{""}} @endif</td>

						</tr>
					</table>
					
					
				</td>
				<td style="text-align: center;">

					<table>
						<tr>
							<td style="text-align: center;" valign="top"><img width="40px" height="40px" src="assets/images/respiratoryrate.png"></td>
						</tr>
					</table>
					<table>
						<tr>
							<td style="text-align: center;" valign="top" >{{$respiratoryrate}} @if(!empty($respiratoryrate)) {{"breaths/min"}} @else {{""}} @endif</td>
						</tr>
					</table>

					
					
				</td>
				<td style="text-align: center;">

					<table>
						<tr>
							<td style="text-align: center;" valign="top"><img width="40px" height="40px" src="assets/images/spo2.png"></td>
						</tr>
					</table>
					<table>
						<tr>
							<td style="text-align: center;" valign="top">{{$spo2}} @if(!empty($spo2)) {{"%"}} @else {{" "}} @endif</td>
						</tr>
					</table>
					
					
				</td>
				<td style="text-align: center;">
					<table>
						<tr>
							<td style="text-align: center;" valign="top"><img width="40px" height="40px" src="assets/images/temperature.png"></td>
						</tr>
					</table>
					<table>
						<tr>
							<td style="text-align: center;" valign="top" >{{$temperature}} @if(!empty($temperature)) &deg;F @else {{""}} @endif</td>
						</tr>
					</table>

				</td>
			</tr>
			

		</table>

		<hr>

		@if($specializationName=="Gynaecology")
			<table>
			
				<tr>
					<td><h3>OBSTETRICS HISTORY:</h3></td>
				</tr>

				@if(!empty($obsHistory))
					<tr>
						<td width="50%">Married Life:
							@if(!empty($obsHistory->married_life) && $obsHistory->married_life!="0")
								{{$obsHistory->married_life}}
							@else
								{{" "}}
							@endif
						</td>
						<td width="50%">Husband Blood Group:
							@if(!empty($obsHistory->husband_blood_group) && $obsHistory->husband_blood_group!="0")
								{{$obsHistory->husband_blood_group}}
							@else
								{{" "}}
							@endif

						</td>			
					</tr>

					<tr>
						<table>
							<tr>
								<td width="25%">Gravida:
									@if(!empty($obsHistory->gravida) && $obsHistory->gravida!="0")
										{{$obsHistory->gravida}}
									@else
										{{" "}}
									@endif
								</td>
								<td width="25%">Para:
									@if(!empty($obsHistory->para) && $obsHistory->para!="0")
										{{$obsHistory->para}}
									@else
										{{" "}}
									@endif
								</td>
								<td width="25%">Living:
									@if(!empty($obsHistory->living) && $obsHistory->living!="0")
										{{$obsHistory->living}}
									@else
										{{" "}}
									@endif
								</td>
								<td width="25%">Abortion:
									@if(!empty($obsHistory->abortion) && $obsHistory->abortion!="0")
										{{$obsHistory->abortion}}
									@else
										{{" "}}
									@endif
								</td>	
							</tr>
						</table>		
					</tr>

					<tr>
						<table>
							<tr>
								<td width="33.33%">LMP:
									@if(!empty($obsHistory->obs_lmp_date) && $obsHistory->obs_lmp_date!="0000-00-00")
										{{date('d-M-Y',strtotime($obsHistory->obs_lmp_date))}}
									@else
										{{" "}}
									@endif
								</td>
								<td width="33.33%">Flow:
									@if(!empty($obsHistory->obs_lmp_flow))
										{{$obsHistory->obs_lmp_flow}}
									@else
										{{" "}}
									@endif
								</td>
								<td width="33.33%">Dysmenorrhea:
									@if(!empty($obsHistory->obs_lmp_dysmenorrhea))
										{{$obsHistory->obs_lmp_dysmenorrhea}}
									@else
										{{" "}}
									@endif
								</td>				
							</tr>
						</table>		
					</tr>

					<tr>
						<table>
							<tr>
								<td width="33.33%">Days:
									@if(!empty($obsHistory->obs_lmp_days) && $obsHistory->obs_lmp_days!="0")
										{{$obsHistory->obs_lmp_days}}
									@else
										{{" "}}
									@endif
								</td>
								<td width="33.33%">Cycle:
									@if(!empty($obsHistory->obs_lmp_cycle) && $obsHistory->obs_lmp_cycle!="0")
										{{$obsHistory->obs_lmp_cycle}}
									@else
										{{" "}}
									@endif
								</td>
								<td width="33.33%">Menstrual Type:
									@if(!empty($obsHistory->obs_menstrual_type))
										{{$obsHistory->obs_menstrual_type}}
									@else
										{{" "}}
									@endif
								</td>				
							</tr>
						</table>		
					</tr>
				@else

				@endif
					
				@if(!empty($pregHistory))
					<tr>
						<table>
							<tr>
								<td width="33.33%">Pregnancy Kind:
									@if(!empty($pregHistory->obs_preg_kind))
										{{$pregHistory->obs_preg_kind}}
									@else
										{{" "}}
									@endif
								</td>
								<td width="33.33%">Pregnancy Type:
									@if(!empty($pregHistory->obs_preg_type))
										{{$pregHistory->obs_preg_type}}
									@else
										{{" "}}
									@endif
								</td>
								<td width="33.33%">Term:
									@if(!empty($pregHistory->obs_preg_term))
										{{$pregHistory->obs_preg_term}}
									@else
										{{" "}}
									@endif
								</td>				
							</tr>
						</table>		
					</tr>
				@else

				@endif
				
				

			</table>
		<hr>
		@endif

		

		<table>
			<tr>
				<td><h3>MEDICAL HISTORY:</h3></td>
			</tr>

			<table>
			<tr>
				
				<td width="25%">Hypertension:
					@if(!empty($medicalHistoryData))
      					@foreach($medicalHistoryData as $index=>$medicalHistoryDataVal)
      						@if($medicalHistoryDataVal->illness_name=="Hypertension")
      							
      							@if($medicalHistoryDataVal->illness_status==" " ||   
      							    $medicalHistoryDataVal->illness_status==null)
      								{{"-"}}
      							@else
      								{{$medicalHistoryDataVal->illness_status}}
      							@endif
      							
      						@endif
      							
      					@endforeach
      				@endif
				</td>
				<td width="25%">Diabetes:
					@if(!empty($medicalHistoryData))
      					@foreach($medicalHistoryData as $index=>$medicalHistoryDataVal)
      						@if($medicalHistoryDataVal->illness_name=="Diabetes")
      							
      							@if($medicalHistoryDataVal->illness_status==null)
      								{{"-"}}
      							@else
      								{{$medicalHistoryDataVal->illness_status}}
      							@endif
      							
      						@endif
      							
      					@endforeach
      				@endif

				</td>
				<td width="25%">Hyperthyroidism:
					@if(!empty($medicalHistoryData))
      					@foreach($medicalHistoryData as $index=>$medicalHistoryDataVal)
      						@if($medicalHistoryDataVal->illness_name=="Hyperthyroidism")
      							
      							@if($medicalHistoryDataVal->illness_status==null)
      								{{"-"}}
      							@else
      								{{$medicalHistoryDataVal->illness_status}}
      							@endif
      							
      						@endif
      							
      					@endforeach
      				@endif
				</td>
				<td width="25%">Hypothyroidism:
					@if(!empty($medicalHistoryData))
      					@foreach($medicalHistoryData as $index=>$medicalHistoryDataVal)
      						@if($medicalHistoryDataVal->illness_name=="Hypothyroidism")
      							
      							@if($medicalHistoryDataVal->illness_status==" " )
      								{{"-"}}
      							@else
      								{{$medicalHistoryDataVal->illness_status}}
      							@endif
      							
      						@endif
      							
      					@endforeach
      				@endif
				</td>
			</tr>
			</table>

			<table>
			<tr>
				<td width="25%">Cancer:
					@if(!empty($medicalHistoryData))
      					@foreach($medicalHistoryData as $index=>$medicalHistoryDataVal)
      						@if($medicalHistoryDataVal->illness_name=="Cancer")
      							
      							@if($medicalHistoryDataVal->illness_status==" " || $medicalHistoryDataVal->illness_status==null)
      								{{"-"}}
      							@else
      								{{$medicalHistoryDataVal->illness_status}}
      							@endif
      							
      						@endif
      							
      					@endforeach
      				@endif
				</td>
				<td width="25%">UTI:
					@if(!empty($medicalHistoryData))
      					@foreach($medicalHistoryData as $index=>$medicalHistoryDataVal)
      						@if($medicalHistoryDataVal->illness_name=="UTI")
      							
      							@if($medicalHistoryDataVal->illness_status==" ")
      								{{"-"}}
      							@else
      								{{$medicalHistoryDataVal->illness_status}}
      							@endif
      							
      						@endif
      							
      					@endforeach
      				@endif
				</td>
				<td width="25%"></td>
				<td width="25%"></td>
			
			</tr>
			</table>

		</table>

		<hr>

		<!-- Symptoms & Diseases -->
		<table>
			<tr>
				<td><h3>DIAGNOSIS:</h3></td>
			</tr>

			<tr>

				<td width="50%" valign="top">
					<table>
						
							<tr><td><h4>SYMPTOMS</h4></td></tr>
							<?php
								if(!empty($diagnosisData)){
									$symptoms = array_filter(json_decode($diagnosisData->diag_symptoms));

									if(!empty($symptoms)){
										for($i=0;$i<count($symptoms);$i++){

											echo "<tr><td>".$symptoms[$i]."</td></tr>";
											
										}
									}
									else{
										echo "<tr><td>"."None"."</td></tr>";
									}
								}
								else{

									$symptoms = "";
									echo "<tr><td>"."None"."</td></tr>";
								}



							?>
							<!-- <tr><td>Headaches </td></tr>
							<tr><td>Vomiting </td></tr>
							<tr><td>Vomiting </td></tr> -->
						
					
					</table>
					
				</td>
				<td width="50%" valign="top">					
					<table>
						<?php
						if(!empty($diagnosisData)){
						?>
							<tr><td><h4>SYNDROMES</h4></td></tr>
							<tr>
								<td>
									<?php 
										
									$syndrome = $diagnosisData->diag_syndromes;
									if(!empty($syndrome)){
										echo $syndrome;
										
									}
									
									?>
								</td>
							</tr>
						<?php
						}
						else{
							$syndrome = "";
							
							
						}
						?>		
							

						
					
					</table>
				</td>
					
			</tr>
			<tr>
				<td width="50%" valign="top">
					<table>						
						<tr><td><h4>DISEASE</h4></td></tr>
						<?php
							if(!empty($diagnosisData)){
								$diseases = array_filter(json_decode($diagnosisData->diag_suspected_diseases));

								if(!empty($diseases)){
									for($i=0;$i<count($diseases);$i++){

										echo "<tr><td>".$diseases[$i]."</td></tr>";
										
									}
								}
								else{
									echo "<tr><td>"."None"."</td></tr>";
								}
							}
							else{
								$diseases = "";
								echo "<tr><td>"."None"."</td></tr>";
							}



						?>
														
					</table>					
				</td>
				<td width="50%" valign="top">					
					<table>
						@if(!empty($diagnosisData))
							<tr><td><h4>ADDITIONAL COMMENTS</h4></td></tr>
							<tr>
								<td>
									<?php 
										$comments = $diagnosisData->diag_comment;
										if(!empty($comments)){
											echo $comments;
											
										}
									?>
								</td>
							</tr>
						@else

						@endif
							
					</table>
				</td>					
			</tr>
		</table>

		<hr>

		<!-- PrescriptionDetails -->
		<table>
			<tr>
				<td><h3>PRESCRIPTION:</h3></td>
			</tr>
   			<thead>
       			<td><h4 style="text-transform: uppercase;">Drugs</h4></td>
       			<td><h4 style="text-transform: uppercase;">Dosage</h4></td>
       			<td><h4 style="text-transform: uppercase;">Duration</h4></td>
       			<td><h4 style="text-transform: uppercase;">Frequency</h4></td>
   			</thead>

   			<tbody>
   				@if(!empty($prescriptionData))
       				@foreach($prescriptionData as $index=>$prescriptionDataVal)

	       				<tr @if($index%2==0) style="background-color: #d9d9d9" @endif>
		       				<td>
		       					{{$prescriptionDataVal->drug_name}}
		       				</td>
		       				<td>
		       					@if(!empty($prescriptionDataVal->dosage))
									{{$prescriptionDataVal->dosage." ".$prescriptionDataVal->dosage_unit}}
								@else
									{{"-"}}
								@endif
		       				</td>
							<td>
								@if(!empty($prescriptionDataVal->duration))
									{{$prescriptionDataVal->duration." ".$prescriptionDataVal->duration_unit}}
								@else
									{{"-"}}
								@endif															
							</td>
							<td>
								@if(($prescriptionDataVal->morning=="0") && 
									($prescriptionDataVal->noon=="0")	&&
									($prescriptionDataVal->night=="0"))
									

									{{"-"}}

								@else
									{{$prescriptionDataVal->morning}}
									- {{$prescriptionDataVal->noon}}
									- {{$prescriptionDataVal->night}}

								@endif
		       					
		       				</td>
		       			</tr>
	       				
       				@endforeach
       			@else
       				<tr>
       					<td>No Prescription Data entered.</td>
       				</tr>

       			@endif
				
   			
   				
   			</tbody>
       	</table>

		<hr>

		<!-- Followup & Treatment -->
   		<table>
   			<tr>
   				<td width="80%" valign="top">
   					<table>
						<tr>
							<td>
								<h3>TREATMENT:</h3>
							</td>
						</tr>
						<tr>
							<td valign="top">
								@if(!empty($treatment)) 
									<table>
										<?php 
											$treatment = explode(',',$treatment);
										?>
										@foreach($treatment as $index=>$treatmentVal)
											<tr>
												<td>{{$treatment[$index]}}</td>
											</tr>
										@endforeach
										
										
									</table>
								@else

								@endif
								
							</td>

						</tr>
					</table>
   				</td>
   				<td width="20%" valign="top">
   					<table>							
						<tr>
							<td>
								<h5>FOLLOW-UP:</h5>
							</td>
						</tr>
						<tr>
							<td  valign="top"><h4 style="margin:0px; padding:0px;">
								<?php
									//echo $followUpDate;
									if(!empty($followUpDate)){
										if($followUpDate!="0000-00-00"){
											$followUpDate = date('d-M-Y',strtotime($followUpDate));
											echo $followUpDate;
										}
									}
									else{
										$followUpDate = "";
										echo "-";
									}
									

								?>
								</h4>
							</td>
						</tr>
																	
					</table>
   				</td>
   			</tr>
   		</table>
       			
       			
				

		
    </div>




			

	    <!-- Doctor personal Data -->

	     <!-- Vitals History -->
	    
     	
       	
   
    
  </body>
</html>