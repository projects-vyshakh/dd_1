var patientPrescMedicine = function () {
	var runOnPageLoad = function(){
		
		
	}
	var runPrescriptionDatePickers = function(){
			var today = new Date();
			var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
			console.log(date)
			
			$('.start_date').Zebra_DatePicker({
				direction: true,
   				icon_position : 'left',
   				inside : true,
   				show_icon : false,
   				minDate:'0',
   				
			});
			
			$('.follow_up_date').Zebra_DatePicker({
				direction: true,
   				icon_position : 'left',
   				inside : true,
   				show_icon : false
			});
	};	
	var runPrescriptionData = function(	){
		var dataString = "No";
				$.ajax({
				    	type: "POST",
				   		 url: '../showPatientPrescMedicineAjax',
				   		 data: dataString,
				    	success: function(data)
				    	{
				    		

				    		//console.log(data.prescMedicine[0].food_status)

				    		// Enabling/Disabling print,share button on success after save
				    		var success = $('.success-status').val();
				    		if(success== null || success==''){
								$('.pdfopen').attr('disabled','disabled');
								$('.share-prescription').attr('disabled','disabled');
								//alert('success null');
							}
							else{
								//alert('success not null');
								for(var i=1;i<=data.prescMedicine.length;i++){
									var instructionText = data.prescMedicine[i-1].treatment;
									if(instructionText!=""){
										$('#add-instruction-btn'+i).hide();
										$('#remove-instruction-btn'+i).show();
									}

									$('.default-div-count').val(i);
								}
								$('.pdfopen').attr('disabled',false);
								$('.share-prescription').attr('disabled',false);
								
							}
							// -----------------------------------------------------------------



				    	 	
		       				$('.presc-add-more').click(function(e){
		       					runDrugAddMore(e,data);
   								//Calling medicine autocomplete
								runMedicineListAutoComplete();	
								//Initiating start date after add more
								runPrescriptionDatePickers();

								runDrugRemove(data);
				   				

							});
				       				
				       				
				       		//Load Previous Drug Click
		       				$('.present-drug-btn').click(function(e){

		       					$('.success-status').val(''); // Success is keeping null on clicking load prev else clicking on share works twice
		       					$('.present-drug-btn').attr('disabled',true);
	       						var prescMedicine = data.prescMedicine;
	       						var defaultDivCountRemove =$('.default-div-count').val();
		       					$('.prev-drug-load-status').val(1);
								var clickStatus = "loadDrug";
								//alert(JSON.stringify(prescMedicine));	 
											
								if(prescMedicine!="")
								{
									
									counter = prescMedicine.length;
									$('.pdfopen').attr('disabled',false);
									$('.share-prescription').attr('disabled',false);

									// Removing  existing all tables on load prev click
									for(i=1;i<=defaultDivCountRemove;i++)
									{
										var drugElement 	= $('#drug_name'+i);
										var tableElement 	= drugElement.closest('.presc-inner');
														
							   				if(i>=1){
							   					tableElement.remove();	
							   				}
											var newDefaultCount = defaultDivCountRemove - parseInt(i);
							   				if(newDefaultCount==0){
							   					$('.default-div-count').val(1);
							   				}
									}

									for(var i=0;i<data.prescMedicine.length;i++)
									{

										var counter = i+1;
										var drugName 			 = prescMedicine[i].drug_name;
										var dosage   			 = prescMedicine[i].dosage;
										var dosageUnitDefault 	 = prescMedicine[i].dosage_unit;
										var duration 			 = prescMedicine[i].duration;
										var durationUnitDefault	 = prescMedicine[i].duration_unit;
										var morning 			 = prescMedicine[i].morning;
										var noon 				 = prescMedicine[i].noon;
										var night 				 = prescMedicine[i].night;
										var instruction 		 = prescMedicine[i].instruction;
										var startDate 			 = prescMedicine[i].start_date;				 
										var followUpDate 		 = prescMedicine[i].follow_up_date;
										var prescSharedId        = prescMedicine[i].id_share_prescription;
										var foodStatus 			 = prescMedicine[i].food_status;
										var treatment			 = prescMedicine[i].treatment;

										(dosage==0)?dosage='':dosage = dosage;
										(duration==0)?duration='':duration = duration;
										(morning==0)?morning='':morning = morning;
										(noon==0)?noon='':noon = noon;
										(night==0)?night='':night = night;

										//Checking  start date and follow up dates
										if(startDate!=null){
											(startDate=='0000-00-00')?startDate = '':startDate=startDate;
										}
										else{
											startDate = '';
										}

										if(followUpDate!=null){
											(followUpDate=='0000-00-00')?followUpDate = '':followUpDate=followUpDate;
										}
										else{
											followUpDate = '';
										}
										
										
									

										$('.presc-medicine').append(
											'<div class="presc-inner contaner dd_border_table">'+
												'<table class="table table-bordered  presc-table" id="sample-table-1">'+
			                                        '<thead>'+
			                                            '<tr class="drugs_row_hd" >'+
			                                                '<th width="16%">Drug Name</th>'+
			                                                '<th width="30%">Strength</th>'+
			                                                '<th width="18%">Duration</th>'+
			                                                '<th width="1%">Morning</th>'+
			                                                '<th width="1%">Noon </th>'+
			                                                '<th width="29%">Night</th>'+
			                                                '<th width="9%"></th>'+
			                                            '</tr>'+
			                                        '</thead>'+
			                                        '<tbody>'+
	                               	 				 	'<tr class="drugs_row">'+
		                                                    '<td class="dd_presc_medicin">'+
		                                                    	'<div id="bloodhound">'+
		                                                        	'<input type="text" name="drug_name'+counter+'" class="dd_input_mini drug_name typeahead" id="drug_name'+counter+'" value="'+drugName+'">'+
		                                                    	'</div>'+
		                                                    '</td>'+
		                                                    '<td>'+
		                                                        '<div class="dd_dosage1_text">'+
		                                                            '<input type="text" name="dosage'+counter+'" maxlength="4" class="input-mini ng-pristine dd_remove_padding ng-valid dosage" id="dosage'+i+'" value='+dosage+' >'+
		                              									'<select class="dosage_unit" name="dosage_unit'+counter+'" id="dosage_unit'+counter+'">'+
		                              										'<option value='+dosageUnitDefault+'>'+dosageUnitDefault+'</option>'+
																		'</select>'+
		                                                        '</div>'+
		                                                    '</td>'+
		                                                    '<td >'+
																'<div class="dd_dosage1_text">'+
																	'<input type="text" name="duration'+counter+'" class="input-mini ng-pristine ng-valid duration" id="duration'+i+'" value='+duration+'>'+
																		'<select class="duration_unit" name="duration_unit'+counter+'" id="duration_unit'+counter+'">'+
																			'<option value='+durationUnitDefault+'>'+durationUnitDefault+'</option>'+
																		'</select>'+
																'</div>'+
															'</td>'+
															'<td>'+
																'<input type="text" name="morning'+counter+'" class="col-sm-8 morning"  id="morning'+counter+'" value='+morning+'>'+
															'</td>'+
															'<td>'+
																'<input type="text" name="noon'+counter+'" class="col-sm-8 noon"  id="noon'+counter+'" value='+noon+'>'+
															'</td>'+
															'<td>'+
																'<input type="text" name="night'+counter+'" class="col-sm-8 night" id="night'+counter+'" value='+night+'>'+
															'</td>'+
															'<td>'+
																'<input type="button" id="drugmore-remove'+counter+'"  name="drugmore-remove" class="dd_X_btn btn btn-bricky pull-right drugmore-remove" value="X" ' +
															'</td>'+
													  	'</tr>'+
													  	'<tr class="drugs_row dd_relative">'+
															'<td colspan="1" >'+
																'<input type="button" onclick="return addInstruction(this);" name="add-instruction-btn" class="btn btn-default  dd_instruction  btn-xs add-instruction-btn" value="+ Add Instruction" id="add-instruction-btn'+counter+'">' +
																'<input type="button" onclick="return removeInstruction(this);" name="remove-instruction-btn" class="btn btn-default dd_dosage1_text dd_instruction  btn-xs remove-instruction-btn" value="- Remove Instruction" style="display:none" id="remove-instruction-btn'+counter+'">' +
															'</td>'+
															'<td colspan="2" style="vertical-align: top;">'+
																'<div class="dd_dosage1_text_3 dd_Date pull-left">Start Date</div>'+		
																	'<div class="dd_dosage1_text_2 pull-left">'+
						  												'<span class="dd_instruction"> '+
																			'<input type="text" name="start_date'+counter+'" class="form-control date-picker start_date" id="start_date'+i+'" value="'+startDate+'" data-date-format="dd-mm-yyyy">'+
																		'</span>'+
																'</div>'+
															'</td>'+
															'<td colspan="2"  class="dd_relative" style="vertical-align: top;">'+
															    '<div class="dd_beforfood">'+
																	'<label class="dd_beforfood_pd" >'+
																		'<input type="radio" class="before_food food_status" id="food_status_before'+counter+'" name="food_status'+counter+'" value="Before Food">Before Food'+
																	'</label>'+
																	'<label class="dd_beforfood_pd">'+
																		'<input type="radio" class="after_food food_status" id="food_status_after'+counter+'" name="food_status'+counter+'" value="After Food">After Food'+
																	'</label>'+
																'</div>'+
															'</td>'+
														'</tr>'+
												 	'</tbody>'+
												'</table>'+
												'<div class="instruction-div" id="instruction-div'+counter+'"></div>'+
												'<div class="error_msg"></div>'+
											'</div>'
			                            );
										
										

										if(foodStatus=="Before Food"){
											$("#food_status_before"+counter).prop("checked","checked")
										}
										else{
											$("#food_status_after"+counter).prop("checked","checked")
										}
										
										$('#treatment').text(treatment);
										$('#follow_up_date').val(followUpDate);

										//Appending dosage and duration 
										for( dosageUnitVal in data.dosageUnit){
											if(dosageUnitDefault!=dosageUnitVal){
												$('#dosage_unit'+counter).append('<option value='+dosageUnitVal+'>'+data.dosageUnit[dosageUnitVal]+'</option>');
											}
											
									  	}
										for(durationUnitVal in data.drugDurationUnit){
											if(durationUnitDefault!=durationUnitVal){
												$('#duration_unit'+counter).append('<option value='+durationUnitVal+'>'+data.drugDurationUnit[durationUnitVal]+'</option>');
											}
											
										}

										if(instruction!=''){
											$('#instruction-div'+counter).append('<textarea name="instruction'+counter+'" cols="30" class=" form-control instruction" id="instruction'+counter+'">'+instruction+'</textarea>')
											$('#add-instruction-btn'+counter).hide();
											$('#remove-instruction-btn'+counter).show();
										}

									}
									//Ending forloop

									
									
													 
								 	$('.default-div-count').val(counter);


								}
								else
								{
									$(this).attr('disabled',false); //Enabling Load Pev if no data is there
									$('.pdfopen').attr('disabled',true);
									$('.share-prescription').attr('disabled',true);
								}	

								//Calling Medicine autocomplete
								runMedicineListAutoComplete();
								//Initiating start date after add more
								runPrescriptionDatePickers();
				   				
								runDrugRemove(data);
								

				       		});		


							for(var i=0;i<data.prescMedicine.length;i++)
							{
								var prescSharedId = data.prescMedicine[0].id_share_prescription
							}
							$('.share-prescription').click(function(e){
								e.preventDefault();	
								runSharePrescriprion(prescSharedId);
								
							});
							



						}
				           //Ajax ends
       
				  });


			
	};

	var runDrugAddMore = function(e,data){
		$('.pdfopen').attr('disabled','disabled');							//disabling print button on add more click
		$('.share-prescription').attr('disabled','disabled');	//disabling share  button on add more click
		$('.present-drug-btn').attr('disabled',false); 				//enabling the load prev button
		$('.success-status').val('');
		var extraPrescCounter = $('.extra-presc-count').val();
		extraPrescCounter = parseInt(extraPrescCounter) + 1;
		$('.extra-presc-count').val(extraPrescCounter);
			var counter	=	$('.default-div-count').val();
			console.log('counter'+counter++);
			e.preventDefault();
			$('.presc-medicine').append(
				'<div class="presc-inner contaner dd_border_table">'+
				'<table class="table table-bordered  presc-table" id="sample-table-1">'+
						'<thead>'+
                        '<tr class="drugs_row_hd" >'+
                                '<th width="16%">Drug Name</th>'+
                                '<th width="30%">Strength</th>'+
                                '<th width="18%">Duration</th>'+
                                '<th width="1%">Morning</th>'+
                                '<th width="1%">Noon </th>'+
                                '<th width="29%">Night</th>'+
                                '<th width="9%"></th>'+
						 '</tr>'+
						'</thead>'+
               		'<tbody>'+
						'<tr class="drugs_row">'+
                            '<td class="dd_presc_medicin">'+
                            		
                                	'<input type="text" name="drug_name'+counter+'" class="dd_input_mini drug_name " id="drug_name'+counter+'">'+
                            		
                            '</td>'+
                            '<td>'+
                                '<div class="dd_dosage1_text">'+
                                     	'<input type="text" name="dosage'+counter+'" maxlength="4" class="input-mini ng-pristine ng-valid dd_remove_padding dosage" id="dosage'+counter+'">'+
      									'<select class="dosage_unit" name="dosage_unit'+counter+'" id="dosage_unit'+counter+'">'+
										 '</select>'+
                             	 '</div>'+
                            '</td>'+
                            '<td >'+
								'<div class="dd_dosage1_text">'+
									'<input type="text" name="duration'+counter+'" class="input-mini ng-pristine ng-valid duration" id="duration'+counter+'" >'+
									'<select class="duration_unit" name="duration_unit'+counter+'" id="duration_unit'+counter+'">'+
									 '</select>'+
								'</div>'+
							'</td>'+
							'<td>'+
									'<input type="text" name="morning'+counter+'" class="col-sm-8 morning" id="morning'+counter+'"  >'+
							'</td>'+
							'<td>'+
									'<input type="text" name="noon'+counter+'" class="col-sm-8 noon" id="noon'+counter+'"  >'+
							'</td>'+
							'<td>'+
									'<input type="text" name="night'+counter+'" class="col-sm-8 night" id="night'+counter+'" >'+
							'</td>'+
							'<td>'+
								'<input type="button" id="drugmore-remove'+counter+'"  name="drugmore-remove" class=" dd_X_btn btn btn-bricky pull-right drugmore-remove" value="X" ' +
							'</td>'+
					 	'</tr>'+
						'<tr class="drugs_row dd_relative">'+

							'<td colspan="1" >'+
									'<input type="button" onclick="return addInstruction(this);" name="add-instruction-btn" class="btn btn-default  dd_instruction  btn-xs add-instruction-btn" value="+ Add Instruction" >' +
									'<input type="button" onclick="return removeInstruction(this);" name="remove-instruction-btn" class="btn btn-default dd_dosage1_text dd_instruction  btn-xs remove-instruction-btn" value="- Remove Instruction" style="display:none" >' +
							'</td>'+
							'<td colspan="2" style="vertical-align: top;" >'+
								'<div class="dd_dosage1_text_3 dd_Date pull-left">Start Date</div>'+		
									'<div class="dd_dosage1_text_2 pull-left">'+
											'<span class="dd_instruction"> '+
											'<input type="text" name="start_date'+counter+'" class="form-control  start_date" id="start_date'+counter+'" data-date-format="dd-mm-yyyy">'+
										'</span>'+
									'</div>'+
								'</div>'+
							'</td>'+
							'<td colspan="2" class="dd_relative" style="vertical-align: top;">'+
									'<div class="dd_beforfood ">'+
									'<label class="dd_beforfood_pd" >'+
										'<input type="radio"  class="before_food food_status" id="food_status_before'+counter+'" name="food_status'+counter+'" value="Before Food" >Before Food'+
									'</label>'+
									'<label class="dd_beforfood_pd">'+
										'<input type="radio" class="after_food food_status" id="food_status_after'+counter+'" name="food_status'+counter+'" value="After Food">After Food'+
									'</label>'+
								'</div>'+
							'</td>'+
						'</tr>'+
						'<tr></tr>'+
					'</tbody>' +
        		'</table>'+

        		'<div class="instruction-div" ></div>'+
        		'<div class="error_msg" ></div>'+
     		'</div>'
		);
		
		
		

		for( dosageUnitVal in data.dosageUnit){
			$('#dosage_unit'+counter).append('<option value='+dosageUnitVal+'>'+data.dosageUnit[dosageUnitVal]+'</option>');
		}
		for(durationUnitVal in data.drugDurationUnit){
			$('#duration_unit'+counter).append('<option value='+durationUnitVal+'>'+data.drugDurationUnit[durationUnitVal]+'</option>');
		}
			 
	 	$('.morning').tooltip({'trigger':'focus', 'title': 'Morning medicine count'});
		$('.noon').tooltip({'trigger':'focus', 'title': 'Noon medicine count'}); 
		$('.night').tooltip({'trigger':'focus', 'title': 'Night medicine count'}); 
	 	$('.default-div-count').val(counter++);

							 	
	}

	var runDrugRemove = function(data){
		//e.preventDefault();
		$('.drugmore-remove').unbind().click(function(){
			//$(this).closest('.presc-inner').remove();
			$('.share-prescription').attr('disabled','disabled');
			$('.pdfopen').attr('disabled','disabled');

			var divCount = $('.default-div-count').val(); 


			var elements = $(this).closest('.presc-inner');
		    var removedPrescTable = elements.find('.drugs_row');
		    var removedId = removedPrescTable.find('.dd_input_mini').attr('id');
		    var removedId = parseInt(removedId.replace(/[^0-9\.]/g, ''), 10);
		   	elements.remove();

		    var newDefaultDivCount = parseInt(divCount) - parseInt(1);
		    

		    $('.default-div-count').val(newDefaultDivCount);
		    for (i = 1; i <= newDefaultDivCount; i++) {
		        var nextDivId = parseInt(i) + parseInt(1);
		        if (nextDivId > removedId) {
		            var decrementDivId = nextDivId - 1;
		            var selected1 = $('.presc-table').find('.drugs_row').find('#drug_name' + nextDivId);
		            var selected2 = $('.presc-table').find('.drugs_row').find('#dosage' + nextDivId);
		            var selected3 = $('.presc-table').find('.drugs_row').find('#dosage_unit' + nextDivId);
		            var selected4 = $('.presc-table').find('.drugs_row').find('#duration' + nextDivId);
		            var selected5 = $('.presc-table').find('.drugs_row').find('#duration_unit' + nextDivId);
		            var selected6 = $('.presc-table').find('.drugs_row').find('#morning' + nextDivId);
		            var selected7 = $('.presc-table').find('.drugs_row').find('#noon' + nextDivId);
		            var selected8 = $('.presc-table').find('.drugs_row').find('#night' + nextDivId);
		            var selected9 = $('.presc-inner').find('#instruction' + nextDivId);
		            console.log(selected9);
		            var selected10 = $('.presc-table').find('.drugs_row').find('#start_date' + nextDivId);
		            var selected11 = $('.presc-table').find('.drugs_row').find('#food_status_before' + nextDivId);
		            var selected12 = $('.presc-table').find('.drugs_row').find('#food_status_after' + nextDivId);
		            selected1.attr({
		                'name': 'drug_name' + decrementDivId,
		                'id': 'drug_name' + decrementDivId
		            });
		            selected2.attr({
		                'name': 'dosage' + decrementDivId,
		                'id': 'dosage' + decrementDivId
		            });
		            selected3.attr({
		                'name': 'dosage_unit' + decrementDivId,
		                'id': 'dosage_unit' + decrementDivId
		            });
		            selected4.attr({
		                'name': 'duration' + decrementDivId,
		                'id': 'duration' + decrementDivId
		            });
		            selected5.attr({
		                'name': 'duration_unit' + decrementDivId,
		                'id': 'duration_unit' + decrementDivId
		            });
		            selected6.attr({
		                'name': 'morning' + decrementDivId,
		                'id': 'morning' + decrementDivId
		            });
		            selected7.attr({
		                'name': 'noon' + decrementDivId,
		                'id': 'noon' + decrementDivId
		            });
		            selected8.attr({
		                'name': 'night' + decrementDivId,
		                'id': 'night' + decrementDivId
		            });
		            selected9.attr({
		                'name': 'instruction' + decrementDivId,
		                'id': 'instruction' + decrementDivId
		            });
		            selected10.attr({
		                'name': 'start_date' + decrementDivId,
		                'id': 'start_date' + decrementDivId
		            });
		            selected11.attr({
		                'name': 'food_status' + decrementDivId,
		                'id': 'food_status' + decrementDivId
		            });
		            selected12.attr({
		                'name': 'food_status' + decrementDivId,
		                'id': 'food_status' + decrementDivId
		            })
		        }
		        $('.default-div-count').val(newDefaultDivCount)
		    }


		    //if removes all drug details and clicking on last drug removes and appends a fresh presc-medicine
		    if(divCount==1){
				var counter = divCount;
				$('.presc-medicine').append(
					'<div class="presc-inner contaner dd_border_table">'+
					'<table class="table table-bordered  presc-table" id="sample-table-1">'+
							'<thead>'+
	                        '<tr class="drugs_row_hd" >'+
	                                '<th width="16%">Drug Name</th>'+
	                                '<th width="30%">Strength</th>'+
	                                '<th width="18%">Duration</th>'+
	                                '<th width="1%">Morning</th>'+
	                                '<th width="1%">Noon </th>'+
	                                '<th width="29%">Night</th>'+
	                                '<th width="9%"></th>'+
							 '</tr>'+
							'</thead>'+
	               		'<tbody>'+
							'<tr class="drugs_row">'+
	                            '<td class="dd_presc_medicin">'+
	                            		
	                                	'<input type="text" name="drug_name'+counter+'" class="dd_input_mini drug_name " id="drug_name'+counter+'">'+
	                            		
	                            '</td>'+
	                            '<td>'+
	                                '<div class="dd_dosage1_text">'+
	                                     	'<input type="text" name="dosage'+counter+'" maxlength="4" class="input-mini ng-pristine ng-valid dd_remove_padding dosage" id="dosage'+counter+'">'+
	      									'<select class="dosage_unit" name="dosage_unit'+counter+'" id="dosage_unit'+counter+'">'+
											 '</select>'+
	                             	 '</div>'+
	                            '</td>'+
	                            '<td >'+
									'<div class="dd_dosage1_text">'+
										'<input type="text" name="duration'+counter+'" class="input-mini ng-pristine ng-valid duration" id="duration'+counter+'" >'+
										'<select class="duration_unit" name="duration_unit'+counter+'" id="duration_unit'+counter+'">'+
										 '</select>'+
									'</div>'+
								'</td>'+
								'<td>'+
										'<input type="text" name="morning'+counter+'" class="col-sm-8 morning" id="morning'+counter+'"  >'+
								'</td>'+
								'<td>'+
										'<input type="text" name="noon'+counter+'" class="col-sm-8 noon" id="noon'+counter+'"  >'+
								'</td>'+
								'<td>'+
										'<input type="text" name="night'+counter+'" class="col-sm-8 night" id="night'+counter+'" >'+
								'</td>'+
						 	'</tr>'+
							'<tr class="drugs_row dd_relative">'+

								'<td colspan="1" >'+
										'<input type="button" onclick="return addInstruction(this);" name="add-instruction-btn" class="btn btn-default  dd_instruction  btn-xs add-instruction-btn" value="+ Add Instruction" >' +
										'<input type="button" onclick="return removeInstruction(this);" name="remove-instruction-btn" class="btn btn-default dd_dosage1_text dd_instruction  btn-xs remove-instruction-btn" value="- Remove Instruction" style="display:none" >' +
								'</td>'+
								'<td colspan="2" style="vertical-align: top;" >'+
									'<div class="dd_dosage1_text_3 dd_Date pull-left">Start Date</div>'+		
										'<div class="dd_dosage1_text_2 pull-left">'+
												'<span class="dd_instruction"> '+
												'<input type="text" name="start_date'+counter+'" class="form-control  start_date" id="start_date'+counter+'" data-date-format="dd-mm-yyyy">'+
											'</span>'+
										'</div>'+
									'</div>'+
								'</td>'+
								'<td colspan="2" class="dd_relative" style="vertical-align: top;">'+
										'<div class="dd_beforfood ">'+
										'<label class="dd_beforfood_pd" >'+
											'<input type="radio"  class="before_food food_status" id="food_status_before'+counter+'" name="food_status'+counter+'" value="Before Food" >Before Food'+
										'</label>'+
										'<label class="dd_beforfood_pd">'+
											'<input type="radio" class="after_food food_status" id="food_status_after'+counter+'" name="food_status'+counter+'" value="After Food">After Food'+
										'</label>'+
									'</div>'+
								'</td>'+
							'</tr>'+
							'<tr></tr>'+
						'</tbody>' +
	        		'</table>'+

	        		'<div class="instruction-div" ></div>'+
	        		'<div class="error_msg" ></div>'+
	     		'</div>'
			);
			
			for( dosageUnitVal in data.dosageUnit){
				$('#dosage_unit'+counter).append('<option value='+dosageUnitVal+'>'+data.dosageUnit[dosageUnitVal]+'</option>');
			}
			for(durationUnitVal in data.drugDurationUnit){
				$('#duration_unit'+counter).append('<option value='+durationUnitVal+'>'+data.drugDurationUnit[durationUnitVal]+'</option>');
			}
				 
		 	$('.morning').tooltip({'trigger':'focus', 'title': 'Morning medicine count'});
			$('.noon').tooltip({'trigger':'focus', 'title': 'Noon medicine count'}); 
			$('.night').tooltip({'trigger':'focus', 'title': 'Night medicine count'}); 
		 	$('.default-div-count').val(counter++);

			}


			runMedicineListAutoComplete();
			//Initiating start date after add more
			runPrescriptionDatePickers();


		});
		
	}
	
	var runSharePrescriprion = function(prescSharedId){
		
		
				// var arrNumber = new Array();
				// 	$('.drug_name').each(function(){
				//     arrNumber.push($(this).val());
				// });
				// runSharePrescriprion(data.prescMedicine[0].id_share_prescription);
				var currentUrl = window.location.href;
				var shareLink  = currentUrl+"/shared/"+prescSharedId;
				bootbox.dialog({
					message		: '<h6 style="margin-top:34px; font-size:16px; color:#333; ">Copy and share link through email.</h6>'+'<input type="text" value="'+ shareLink+'"  id="post-shortlink"  style="margin-top:25px; margin-bottom:20px;" class="form-control post-shorlink"/><button class="button btn btn-info btn-default copy-button dd_btn_share" id="copy-button" data-clipboard-target="#post-shortlink" style="margin-top:10px;float:right; background:#335bbd; color:#fff;">Copy link and close</button><button class="button btn btn-info btn-default btn-cancel dd_btn_share"  data-clipboard-target="#post-shortlink" style="margin-top:10px;float:left">Cancel</button>',
					title 		: '<h4 style="font-weight:bold;">Share Prescription Link</h4>',
						
				});
		
				var copyCode = new Clipboard('.copy-button', {
				    target: function(trigger) {
				    	bootbox.hideAll();
				    	  return trigger.previousElementSibling;
				    }
				});
				$('.btn-cancel').click(function(){
					bootbox.hideAll();
				})
				
				
					
					
	};
	var runPatientPrescMedicineValidator = function () {
        var form2           = $('#addPatientPrescMedicine');
        var errorHandler2   = $('.errorHandler', form2);
        var successHandler2 = $('.successHandler', form2);

       /* $.validator.addClassRules("morning", {
             number : true 
        });
        $.validator.addClassRules("noon", {
             number : true 
        });
        $.validator.addClassRules("night", {
             number : true 
        });*/
        /*$.validator.addClassRules("drug_name", {
             required : true 
        });
       */
       	/*$.validator.addClassRules("dosage", {
             number : true 
        });*/
        /*$.validator.addClassRules("duration", {
             number : true 
        });
       */
        jQuery.validator.addClassRules({
        	drug_name: {
		        required : true,
		        
		    },
		    dosage: {
		        digits : true,
		        maxlength : 4
		        
		    },
		    duration: {
		        digits : true,
		        
		    },
		    morning: {
		        digits : true,
		        
		    },
		    noon: {
		        digits : true,
		        
		    },
		    night: {
		        digits : true,
		        
		    },
		   
		});


        form2.validate({
            errorElement: "span", // contain the error msg in a small tag
            errorClass: 'help-block',
            errorPlacement: function (error, element) { // render error placement for each input type
                if (element.attr("type") == "text" || element.attr("type") == "radio" || element.attr("type") == "checkbox") { // for chosen elements, need to insert the error after the chosen container
                    //error.insertAfter($(element).closest('.form-group').children('div').children().last());
                	
                	var clickedElement = $(element).closest('.presc-inner');
    				var errorDiv = clickedElement.find('.error_msg'); 
    				error.insertAfter(errorDiv).last();
                	//console.log(instructionDiv);
                } else if (element.hasClass("ckeditor")) {
                    error.appendTo($(element).closest('.form-group'));
                } else {
                    error.insertAfter(element);
                    // for other inputs, just perform default behavior
                }
            },

          


            ignore: "",
            rules: {
               
              
                  
                
                
            },
            
            messages: {
               
                
                 
               
            },
            invalidHandler: function (event, validator) { //display error alert on form submit
                successHandler2.hide();
                errorHandler2.show();
            },
            highlight: function (element) {
                $(element).closest('.help-block').removeClass('valid');
                // display OK icon
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error').find('.symbol').removeClass('ok').addClass('required');
                // add the Bootstrap error class to the control group
            },
            unhighlight: function (element) { // revert the change done by hightlight
                //$(element).closest('.form-group').removeClass('has-error');
                // set error class to the control group
            },
           
            submitHandler: function (form) {
                successHandler2.show();
                errorHandler2.hide();
                   // alert('REgsiter');
                   ("#form2" ).submit(function( event ) {
                      //alert( "Handler for .submit() called." );
                      event.preventDefault();
                      //alert('sdsdsdss');
                });
                    
               
            }
        });

	};

	var runPrescPrintManagement = function(){
		$('.pdfopen').click(function(){
			$("body").mLoading({ });
			$.ajax({
                type	: "POST",
                url 	: "../patientPrescPrint",
                //data 	: dataString,
                success : function(data) {
                	console.log("Data"+data);
                	if(data!="")
                	{
	            		console.log(data);
	            		//location.href = "patientprescmedicine";
	            		if(data!=""){
	            			$('.success-status').val('Data saved successfully');
	            		}
	            		
	            		$("body").mLoading('hide');
	            		$('#myModal3').modal('show');
	                		
	                		$('iframe').remove();
	                		$('.pdf_print').append('<iframe src="../storage/pdf/'+data+'.pdf" style="width:100%; height:500px;" id="iFrame"></iframe>');
	                		//$('.pdf_print').load('storage/pdf/'+data+'.pdf');
	                		//$("#modal-body embed").attr("storage","x007_20161116.pdf");
	                		$('.print-data').val('saveTrue');
	                		var src = "../storage/pdf/'+data.pdfFileName+'.pdf";
	                		//console.log(src);

	                	//Refreshing the iframe and showing latest data
	            		/*var currSrc = $("#iFrame").attr("src");
						$("#iFrame").attr("src", currSrc);*/

		                    		
				    }
             	
                },
	        });
		});
	};

	var runMedicineListAutoComplete = function(counter){

			/*var options = {
				url: "getMedicineList",

				getValue: "name",

				minCharNumber: 0,

				list: {
					match: {
						enabled: true
					},
					maxNumberOfElements: 10,

					hideOnEmptyPhrase: true,


				},

				requestDelay: 100,

				theme: "plate-dark",

			};

			$(".drug_name").typeahead(options);*/
			
			
 			$('.drug_name').typeahead({
                    ajax: {
                        url: '../getMedicineList',
                        method: 'post',
                        triggerLength: 1
                    }
                    
            });
			
		 	
 			//$('.typeahead').addClass('test')

		
		


		/*$.ajax({
                type	: "POST",
                url 	: "getMedicineList",
                //data 	: dataString,
                dataType : "JSON",
                success : function(medicineName) {
                	//console.log(medicineName);

                	// constructs the suggestion engine
					var medicineName = new Bloodhound({
					  datumTokenizer: Bloodhound.tokenizers.whitespace,
					  queryTokenizer: Bloodhound.tokenizers.whitespace,
					  // `states` is an array of state names defined in "The Basics"
					  local: medicineName
					});

					$('.typeahead').typeahead({
					  hint: true,
					  highlight: true,
					  minLength: 1
					},
					{
					  name: 'medicineName',
					  source: medicineName
					});



                }
        });*/


		/*var states = ['Alabama', 'Alaska', 'Arizona', 'Arkansas', 'California',
				  'Colorado', 'Connecticut', 'Delaware', 'Florida', 'Georgia', 'Hawaii',
				  'Idaho', 'Illinois', 'Indiana', 'Iowa', 'Kansas', 'Kentucky', 'Louisiana',
				  'Maine', 'Maryland', 'Massachusetts', 'Michigan', 'Minnesota',
				  'Mississippi', 'Missouri', 'Montana', 'Nebraska', 'Nevada', 'New Hampshire',
				  'New Jersey', 'New Mexico', 'New York', 'North Carolina', 'North Dakota',
				  'Ohio', 'Oklahoma', 'Oregon', 'Pennsylvania', 'Rhode Island',
				  'South Carolina', 'South Dakota', 'Tennessee', 'Texas', 'Utah', 'Vermont',
				  'Virginia', 'Washington', 'West Virginia', 'Wisconsin', 'Wyoming'
				];*/

			
	};
	return {
		//main function to initiate template pages
		init: function () {
			runOnPageLoad();
		   runPrescriptionData();
		   runPrescriptionDatePickers();
		   runPatientPrescMedicineValidator();
		   runPrescPrintManagement();
		   runMedicineListAutoComplete(counter=0);
		   
		}
    };
}();