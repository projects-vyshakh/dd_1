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


		body {
		  
		  height: 29.7cm; 
		  margin: 0 auto; 
		  color: #555555;
		  background: #FFFFFF; 
		  font-family: 'Open Sans', sans-serif;
		  font-size: 20px; 
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
		  margin: 0 0 0.2em 0;
		  font-family: 'Open Sans', sans-serif;
		  margin-bottom: 10px;

		}

		h4{

		  font-size: 12px;
		  font-weight: bold;
		  margin: 0 0 0.1em 0;
		  font-family: 'Open Sans', sans-serif;
		  color: #555555

		}
		h6{

		  font-size: 12px;
		  font-weight: bold;
		  margin: 0 0 0.2em 0;
		  font-family: 'Open Sans', sans-serif;

		}
		hr{
			margin: 12px 0;
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
		  font-family: 'Open Sans', sans-serif;
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

		


    </style>
  </head>
  <body>




  	<div class="full_cover">
  		<!-- @if(!empty($printData))
  			@if($printData->header_settings=="Yes")
		    	@if(!empty($patientPersonalData))
			    	<?php
			    		$patientName = $patientPersonalData->first_name." ".$patientPersonalData->last_name;
			    		$age 		 = $patientPersonalData->age;
			    		$gender      = $patientPersonalData->gender;
					?>

					<table>
				  	  	<tr>
						  	<td>
						  		<tr>
						  			<td>Nkjame:	</td>
						  		</tr>
						  		<tr>
						  			<td>Name:	{{$patientName}} </td>
						  		</tr>
						  		<tr>
						  			<td>Name:	{{$patientName}} </td>
						  		</tr>
						  		<tr>
						  			<td>Name:	{{$patientName}} </td>
						  		</tr>	
						  	</td>

						  	<td></td>
						  		
						  		
					  	</tr>
					</table>
  			@else


  			@endif
				   
		@else
						
					
		@endif -->

    	

    		<!-- Doctor personal Data -->
    	
		
	    	@if(!empty($doctorPersonalData))
		      	<?php
		      	
		      		$doctorName 		= $doctorPersonalData->first_name." ".$doctorPersonalData->last_name;
		      		$qualification 		= json_decode($doctorPersonalData->qualification);
		      		$qualificationCount = sizeof($qualification);
		      		$specializationName = $doctorPersonalData->specialization_name;
		      		$mobile = $doctorPersonalData->phone;

		      	?>
			    
		@if(!empty($printData))
			<table>
				<tr>
					@if($printData->header_settings=="Yes")
						<td width="60%">
							<table>
								<tr>
									<td>
										<h6>Dr Thomas George</h6>
									</td>
								</tr>
								<tr>
									<td>
										MD
									</td>
								</tr>
								<tr>
									<td>
										1234
									</td>
								</tr>
								<tr>
									<td>
										ASDS
									</td>
								</tr>
							</table>
								
						</td>
					@else
						<td></td>
					@endif


					<td width="40%">
						<table>
							<tr>
								<td><h6>Patient Name: Riya Thomas</h6> </td>
							</tr>
							<tr>
								<td>
									MD
								</td>
							</tr>
							<tr>
								<td>
									1234
								</td>
							</tr>
							<tr>
								<td>
									ASDS
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		@else
			<table>
				<tr>
					<td width="60%">
						<table>
							<tr>
								<td>
									<h6>Dr Thomas George</h6>
								</td>
							</tr>
							<tr>
								<td>
									MD
								</td>
							</tr>
							<tr>
								<td>
									1234
								</td>
							</tr>
							<tr>
								<td>
									ASDS
								</td>
							</tr>
						</table>
							
					</td>
					

					<td width="40%">
						<table>
							<tr>
								<td><h6>Patient Name: Riya Thomas</h6> </td>
							</tr>
							<tr>
								<td>
									MD
								</td>
							</tr>
							<tr>
								<td>
									1234
								</td>
							</tr>
							<tr>
								<td>
									ASDS
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		@endif
		
		

		<hr style="color: #4f81bd;">



		<!-- //---------------------Vitasls table started--------------------------------// -->

		<table>

			<tr>
				<td><h3>Vitals</h3></td>
			</tr>

			<tr>
				<td style="text-align: center;">
				<img width="40px" height="40px" src="assets/images/weight.png">
				<div style="margin-top: 7px;">60 kg</div>
				</td>
				<td style="text-align: center;">
				<img width="40px" height="40px" src="assets/images/bloodpressure.png">
				<div style="margin-top: 7px;">120/80 mmHg</div>
				</td>
				<td style="text-align: center;">
				<img width="40px" height="40px" src="assets/images/pulse.png">
				<div style="margin-top: 7px;">72 bpm</div>
				</td>
				<td style="text-align: center;">
				<img width="40px" height="40px" src="assets/images/respiratoryrate.png">
				<div style="margin-top: 7px;">22 breaths/min </div>
				</td>
				<td style="text-align: center;">
				<img width="40px" height="40px" src="assets/images/spo2.png">
				<div style="margin-top: 7px;">99% </div>
				</td>
				<td style="text-align: center;">
				<div style="margin-top: 7px;"></div>
				<img width="40px" height="40px" src="assets/images/temperature.png">
				<div style="margin-top: 7px;">99% </div>
				</td>
			</tr>
			

		</table>

		<hr>


		<table>

			<tr>
				<td><h3>OBSTETRICS HISTORY:</h3></td>
			</tr>

			<tr>
				<td width="50%">Married Life:</td>
				<td width="50%">Husband Blood Group:</td>			
			</tr>

			<tr>
				<table>
					<tr>
						<td width="25%">Gravida:</td>
						<td width="25%">Para:</td>
						<td width="25%">Living:</td>
						<td width="25%">Abortion:</td>	
					</tr>
				</table>		
			</tr>

			<tr>
				<table>
					<tr>
						<td width="33.33%">LMP:</td>
						<td width="33.33%">Flow:</td>
						<td width="33.33%">Dysmenorrhea:</td>				
					</tr>
				</table>		
			</tr>

			<tr>
				<table>
					<tr>
						<td width="33.33%">Days:</td>
						<td width="33.33%">Cycle:</td>
						<td width="33.33%">Menstrual Type:</td>				
					</tr>
				</table>		
			</tr>

			<tr>
				<table>
					<tr>
						<td width="33.33%">Pregnancy Kind:</td>
						<td width="33.33%">Pregnancy Type:</td>
						<td width="33.33%">Term:</td>				
					</tr>
				</table>		
			</tr>
			

		</table>

		<hr>

		<table>
			
			<tr>
				<td><h3>MEDICAL HISTORY:</h3></td>
			</tr>

			<table>
			<tr>
				<td>Hypertension:</td>
				<td>Diabetes:</td>
				<td>Hyperthyroidism:</td>
				<td>Hypothyroidism:</td>
			</tr>
			</table>

			<table>
			<tr>
				<td width="25%">Cancer:</td>
				<td width="25%">UTI:</td>
				<td width="25%"></td>
				<td width="25%"></td>
			
			</tr>
			</table>

		</table>

		<hr>



		<table>
			
			<tr>
				<td><h3>DIAGNOSIS:</h3></td>
			</tr>

			<tr>

				<td width="50%">
					<table>
						
							<tr><td><h4>SYMPTOMS</h4></td></tr>
							<tr><td>Headaches </td></tr>
							<tr><td>Vomiting </td></tr>
							<tr><td>Vomiting </td></tr>
						
					
					</table>
					
				</td>
				<td width="50%">					
					<table>
						
							<tr><td><h4>SYMPTOMS</h4></td></tr>
							<tr><td>Headaches </td></tr>
							<tr><td>Vomiting </td></tr>
							<tr><td>Vomiting </td></tr>
						
					
					</table>
				</td>
					
			</tr>
			<tr>
				<td width="50%">
					<table>						
						<tr><td><h4>DISEASE</h4></td></tr>
						<tr><td>Headaches </td></tr>
						<tr><td>Vomiting </td></tr>
						<tr><td>Vomiting </td></tr>											
					</table>					
				</td>
				<td width="50%">					
					<table>
						
						<tr><td><h4>ADDITIONAL COMMENTS</h4></td></tr>
						<tr><td>Headaches sdfgdfhcn ghfjgfnfvgn fghfndfhch fhdzrhdbx xgsgsxgse dgSegSfevzsvefS asfaefszf fa </td></tr>
							
					</table>
				</td>					
			</tr>
		</table>

		<hr>


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



       		<hr>

       		<table>
       			
       			
				<tr>

					<td width="80%">
						<table>
							
								<tr><td><h3>Treatment</h3></td></tr>
								<tr><td>Headaches </td></tr>
						
							
						
						</table>
						
					</td>
					<td width="20%">					
						<table>							
								<tr><td><h5>Folowup</h3></td></tr>
								<tr><td><h4>25-5-2017</h4> </td></tr>
																		
						</table>
					</td>
						
				</tr>


       		</table>







			@else
				

			@endif
	
		@endif
	

	    <!-- Doctor personal Data -->

	     <!-- Vitals History -->
	    
     	
       	
   
    
  </body>
</html>