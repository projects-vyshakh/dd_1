


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
					margin-top: 	<?php echo $printData->margin_top."px"; ?> ;
					margin-bottom: 	<?php echo $printData->margin_bottom."px"; ?> ;
					margin-left:	<?php echo $printData->margin_left."px"; ?> ;
					margin-right:	<?php echo $printData->margin_right."px"; ?> ;

				}


		</style>
		
	</head>
	
	<body>
		
		
		
	<div class="full-cover">
				
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
		
