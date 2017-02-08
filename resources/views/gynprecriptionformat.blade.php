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
    	

		.clearfix:after {
		  content: "";
		  display: table;
		  clear: both;
		}

		a {
		  color: #0087C3;
		  text-decoration: none;
		}

		body {
		  
		  height: 29.7cm; 
		  margin: 0 auto; 
		  color: #555555;
		  background: #FFFFFF; 
		  font-family: Arial, sans-serif; 
		  font-size: 14px; 
		  /*font-family: SourceSansPro;*/
		}
		li{
			/*padding: 5px 0;*/
			margin: 5px 0;
		}

		header {
		  padding: 10px 0;
		  margin-bottom: 20px;
		  border-bottom: 1px solid #AAAAAA;
		}

		#logo {
		  float: left;
		  margin-top: 8px;
		}

		#logo img {
		  height: 70px;
		}

		#company {
		  float: right;
		  text-align: right;
		}
	.css/{

	}
			
	


		#details {
		  margin-bottom: 50px;
		}

		#client {
		  padding-left: 6px;
		  border-left: 6px solid #0087C3;
		  float: left;
		}

		#client .to {
		  color: #777777;
		}

		h2.name {
		  font-size: 1.4em;
		  font-weight: normal;
		  margin: 0;
		}

		#invoice {
		  float: right;
		  text-align: right;
		}

		#invoice h1 {
		  color: #0087C3;
		  font-size: 2.4em;
		  line-height: 1em;
		  font-weight: normal;
		  margin: 0  0 10px 0;
		}

		#invoice .date {
		  font-size: 1.1em;
		  color: #777777;
		}

		table {
		  width: 100%;
		  border-collapse: collapse;
		  border-spacing: 0;
		  margin-bottom: 20px;
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
		  color: #57B223;
		  font-size: 1.2em;
		  font-weight: normal;
		  margin: 0 0 0.2em 0;
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

		#thanks{
		  font-size: 2em;
		  margin-bottom: 50px;
		}

		#notices{
		  padding-left: 6px;
		  border-left: 6px solid #0087C3;  
		}

		#notices .notice {
		  font-size: 1.2em;
		}

		footer {
		  color: #777777;
		  width: 100%;
		  height: 30px;
		  position: absolute;
		  bottom: 0;
		  border-top: 1px solid #AAAAAA;
		  padding: 8px 0;
		  text-align: center;
		}

		.clear{ clear: both; }
		.medical-history{
			padding-top: 100px;
		}
		.vitals { padding-top: 50px; margin-bottom: 100px}
		.column-left{ float: left; width: 33%;  }
		.column-right{ float: right; width: 33%; }
		.column-center{ float: left;display: inline-block; width: 33%; }
		.medical-hisotry-inner{ font-size: 16px }
		.space{ margin-bottom: 50px }
		.vitals-content{ float:left; width: 16.6%;}

		.diag-column-left
		{ 
			/*float: left; */
			display: inline-block;
			width: 50%;
			
		}
		.diag-column-right
		{ 
			/*float: right; */
			display: inline-block;
			width: 50%;
			
		}
		.symptoms-div{
			/*margin-left: 20px;*/
		}
		.diseases-column-left{
			float:left;
			width : 50%;
		}
		.presc-margin{
			
			padding-top: 80px;
		}
		.set-width{
			width: 100%;
			height: auto;
		}
		.presc-drugs{
			float : left;
			width: 30%;
		}
		.presc-duration{
			float : left;
			width: 20%
		}
		.presc-dosage{
			float : left;
			width: 20%
		}
		.presc-frequency{
			float : left;
			width: 30%
		}

		.ta6 {
			border: 1px solid #CCCCCC;
			width : auto;
			height: 60px;
			padding: 10px;
		}
		.treatment-inner-div{
			width: 50%;
		}
		.followup-inner-div{
			width: 50%;
		}
		.print_pd_0{
			
			margin-left: 15px;
		}

		.full_cover{
			margin-top: 	<?php echo $marginTop."px"; ?> ;
			margin-bottom: 	<?php echo $marginBottom."px"; ?> ;
			margin-left:	<?php echo $marginLeft."px"; ?> ;
			margin-right:	<?php echo $marginRight."px"; ?> ;

		}
		.dd_100_width{
			width: 100%;
		}


    </style>
  </head>
  <body>
  	<div class="full_cover">
  		@if(!empty($printData))
  			@if($printData->header_settings=="Yes")
		    	@if(!empty($patientPersonalData))
			    	<?php
			    		$patientName = $patientPersonalData->first_name." ".$patientPersonalData->last_name;
			    		$age = $patientPersonalData->age;
			    		$gender = $patientPersonalData->gender;


			    	?>
				    <div id="company">
				        <div><div class="name" style="font-size: 20px; margin-bottom: 5px;">Name:	{{$patientName}} </div> </div>
				        <div><div class="name" style="font-size: 16px; margin-bottom: 5px;">Age:	{{$age}}</div> </div>
				        <div><div class="name" style="font-size: 16px; margin-bottom: 5px;">Sex:	{{$gender}}</div> </div>
				    </div>
				@else
					<div id="company">
				        <div><div class="name" style="font-size: 20px; margin-bottom: 5px;">Name: </div> </div>
				        <div><div class="name" style="font-size: 16px; margin-bottom: 5px;">Age:</div> </div>
				        <div><div class="name" style="font-size: 16px; margin-bottom: 5px;">Sex:</div> </div>
				    </div>
				@endif
			@endif

    	

    		<!-- Doctor personal Data -->
    	
		
	    	@if(!empty($doctorPersonalData))
		      	<?php
		      	
		      		$doctorName = $doctorPersonalData->first_name." ".$doctorPersonalData->last_name;
		      		$qualification 		= json_decode($doctorPersonalData->qualification);
		      		$qualificationCount = sizeof($qualification);
		      		$specializationName = $doctorPersonalData->specialization_name;
		      		$mobile = $doctorPersonalData->phone;

		      	?>
			    <div id="details" class="clearfix">
			        <div id="client">
			          <div class="to"></div>
			          <h2 class="name" style="margin-bottom: 5px;">Dr.{{$doctorName}}</h2>
			          <div class="address" style="margin-bottom: 5px;">
			          	@foreach($qualification  as $index=>$qualificationVal)
			          		<!-- if condition for putting comma dynamically -->
			          		@if($index>=0 && $index<$qualificationCount-1)
			          			{{$qualificationVal.","}}
			          		@else
			          			{{$qualificationVal}}
			          		@endif
			          	@endforeach	
			          </div>
			          <div class="address" style="margin-bottom: 8px;">{{$specializationName}}</div>
			          <div class="email" style="margin-bottom: 5px;"><a>{{$mobile}}</a></div>
			        </div>
			    </div>
			@else
				<div id="details" class="clearfix">
			        <div id="client">
			          <div class="to"></div>
			          <h2  class="name" style="margin-bottom: 5px;"></h2>
			          <div class="address" style="margin-bottom: 5px;"></div>
			          <div class="address" style="margin-bottom: 8px;"></div>
			          <div class="email" style="margin-bottom: 5px;"><a></a></div>
			        </div>
			    </div>

			@endif
	
		@endif
	

	    <!-- Doctor personal Data -->


      	<!-- Medical History -->
      	<?php 
      		$hyperValue = "";
      		$diabValue = "";
      		$cancerValue = "";
      		if(!empty($medicalHistoryData)){
      			foreach($medicalHistoryData as $index=>$medicalHistoryDataVal){
	      			if($medicalHistoryDataVal->illness_name=="Hypertension"){
	      				$hyperIllnessStatus = $medicalHistoryDataVal->illness_status;
	      				
	      				if($hyperIllnessStatus=="Current" || $hyperIllnessStatus=="Past"){
	      					$hyperValue = "Yes/".$hyperIllnessStatus;
	      				}
	      				else{
	      					$hyperValue = "No";
	      				}

	      			} 
	      			if($medicalHistoryDataVal->illness_name=="Diabetes"){
	      				$diabIllnessStatus = $medicalHistoryDataVal->illness_status;
	      				
	      				if($diabIllnessStatus=="Current" || $diabIllnessStatus=="Past"){
	      					$diabValue = "Yes/".$diabIllnessStatus;
	      				}
	      				else{
	      					$diabValue  = "No";
	      				}
	      			} 
	      			if($medicalHistoryDataVal->illness_name=="Cancer"){
	      				$cancerIllnessStatus = $medicalHistoryDataVal->illness_status;
	      				
	      				if($cancerIllnessStatus=="Current" || $cancerIllnessStatus=="Past"){
	      					$cancerValue = "Yes/".$cancerIllnessStatus;
	      				}
	      				else{
	      					$cancerValue = "No";
	      				}
	      			} 
	      		}
      		}
      		
      		
      	?>
       	<div  class="medical-history" >
       		@if(!empty($printData) && $printData->header_settings=="Yes")
       			<hr class="space">
       		@endif
       		<h2>Medical History</h2>
       		<div class="medical-hisotry-inner">
				<div class="column-left">Hypertension: {{$hyperValue}}</div>
			   	<div class="column-center">Diabetes: {{$diabValue}}</div>
			    <div class="column-right">Cancer: {{$cancerValue}}</div>
			</div>
	    </div>
	    <!-- Medical History -->


	    <!-- Vitals History -->
	    <?php

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
	    
	    ?>
	    <div class="vitals" >
       		<h2>Vitals</h2>
       		<div class="medical-hisotry-inner">
				<div class="vitals-content">
					<img width="40px" height="40px" src="assets/images/weight.png">
					<div style="margin-top: 7px;">{{$weight}} @if(!empty($weight)) {{"Kg"}} @else {{""}} @endif</div>
				</div>
			   	<div class="vitals-content">
			   		<img width="40px" height="40px" src="assets/images/bloodpressure.png">
			   		<div  style="margin-top: 7px;">{{$pressure}} @if(!empty($pressure)) {{"mmHg"}} @else {{""}} @endif</div>
			   	</div>
			    <div class="vitals-content">
			    	<img width="40px" height="40px" src="assets/images/pulse.png">
			    	<div  style="margin-top: 7px;">{{$pulse}} @if(!empty($pulse)) {{"bpm"}} @else {{""}} @endif</div>
			    </div>
			    <div class="vitals-content">
			    	<img width="40px" height="40px" src="assets/images/respiratoryrate.png">
			    	<div  style="margin-top: 7px;">
			    		{{$respiratoryrate}} @if(!empty($respiratoryrate)) {{"breathes/min"}} @else {{""}} @endif
			    	</div>
			    </div>
			    <div class="vitals-content">
			    	<img width="40px" height="40px" src="assets/images/spo2.png">
			    	<div  style="margin-top: 7px;">{{$spo2}} @if(!empty($spo2)) {{"%"}} @else {{" "}} @endif</div>
			    </div>
			    <div class="vitals-content">
			    	<img width="40px" height="40px" src="assets/images/temperature.png">
			    	<div  style="margin-top: 7px;">{{$temperature}} @if(!empty($temperature)) &deg;F @else {{""}} @endif</div>
			    </div>
			   
			</div>
	    </div>

	   
	    <div  class="" >
       		<h2>Diagnosis</h2>
	       		<div class="medical-hisotry-inner ">

		       		
       				<div class="print_dummy">
       					<div class="dd_100_width">
       						<h4>Symptoms</h4>
							<div class="symptoms-div print_pd_0">
								<?php 
								//var_dump($diagnosisData);
									if(!empty($diagnosisData)){

										$symptoms = array_filter(json_decode($diagnosisData->diag_symptoms));
										
										if(!empty($symptoms)){
											for($i=0;$i<count($symptoms);$i++){
												echo "<li>".$symptoms[$i]."</li>";
												echo "</br>";
											}
										}
										else{
											echo "<li>No Symptoms entered</li>";
											echo "</br>";
										}
										
									}
									else{
										$symptoms = "";
										echo "<li>No Symptoms entered</li>";
										echo "</br>";
									}
									
								?>
							</div>
       					</div>
       					<div class="dd_100_width">
       						<h4>Syndrome</h4>
							<div class="symptoms-div print_pd_0">
								<?php 
									if(!empty($diagnosisData)){
										$syndrome = $diagnosisData->diag_syndromes;
										if(!empty($syndrome)){
											echo "<li>".$syndrome."</li>";
											
										}
										else{
											echo "<li>No Syndromes entered</li>";
											echo "</br>";
										}
									}
									else{
										$syndrome = "";
										echo "<li>No Syndromes entered</li>";
										
									}	
									
								?>
							</div>
       					</div>

       					<div class="clear"></div>
       				</div>

       				<div class="print_dummy"> 

					   <div class="dd_100_width">
							<h4>Diseases</h4>
							<div class="symptoms-div print_pd_0">
								<?php 

									if(!empty($diagnosisData)){
										
										$diseases = array_filter(json_decode($diagnosisData->diag_suspected_diseases));
										
										if(!empty($diseases)){
											for($i=0;$i<count($diseases);$i++){
												echo "<li>".$diseases[$i]."</li>";
												echo "</br>";
											}
										}
										else{
											echo "<li>No Diseases entered</li>";
											echo "</br>";
										}
										
									}
									else{
										$diseases = "";
										echo "<li>No Diseases entered</li>";
									}
									
								?>
							</div>
						</div>
						<div class="dd_100_width">
					    	<h4>Additional Comments</h4>
							<div class="symptoms-div print_pd_0">
								<?php 

									if(!empty($diagnosisData)){
										$comments = $diagnosisData->diag_comment;
										if(!empty($comments)){
											echo "<li>".$comments."</li>";
											echo "</br>";
										}
										else{
											echo "<li>No Comments entered</li>";
										}
										
									}
									else{
										echo "<li>No Comments entered</li>";
									}
									
								?>
							</div>
					    </div>
					    <div class="clear"></div>
					</div>
					 
				</div>
			<div class="clear"></div>
		</div>


		<!-- Prescription Data -->
		<div  class=""  style="margin-top: 10px;">
	       	<h2>Prescription</h2>
       		<table>
       			<thead>
	       			<td><h4 style="text-transform: uppercase;">Drugs</h4></td>
	       			<td><h4 style="text-transform: uppercase;">Dosage</h4></td>
	       			<td><h4 style="text-transform: uppercase;">Duration</h4></td>
	       			<td><h4 style="text-transform: uppercase;">Frequency</h4></td>
       			</thead>

       			<tbody>
       				@if(!empty($prescriptionData))
	       				@foreach($prescriptionData as $index=>$prescriptionDataVal)
		       				<tr>
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

			       					{{$prescriptionDataVal->morning}}
									- {{$prescriptionDataVal->noon}}
									- {{$prescriptionDataVal->night}}
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
		</div>
		<!-- Prescription Data -->
		<div class="clear"></div> 


		<div  class="" >
			<div class="treatment-inner-div" style="margin-top: 20px;">
				<h2>Treatment</h2>
				@if(!empty($prescriptionData))
					@foreach($prescriptionData as $index=>$prescriptionDataVal)
						<?php 
							$treatment = $prescriptionDataVal->treatment; 
							$followUpDate = $prescriptionDataVal->follow_up_date; 
						?>
					@endforeach
		       		<textarea class="ta6">{{$treatment}}</textarea>
		       	@else
		       		<textarea class="ta6"></textarea>
		       	@endif
			</div>
	       	<div class="followup-inner-div" style="margin-top: 30px;">
	        	<h2>Follow up Date: </h2>
	        	<div>
	        		@if(!empty($followUpDate) && $followUpDate!="0000-00-00") 
	        			{{$followUpDate}}
	        		@endif
	        	</div>
	        </div>	       
	    </div>
    </div>	
     	
       	
   
    
  </body>
</html>