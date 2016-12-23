var obstetricsElements = function () {

	

	var runObsDatePickers = function () {

        $('#obs_lmp_date').Zebra_DatePicker({
   				direction: -1,
	   				icon_position : 'left',
	   				inside : true,
	   				show_icon : false
   		});

   		$('#last_delivery_date').Zebra_DatePicker({
   				direction: -1,
   				icon_position : 'left',
   				inside : true,
   				show_icon : false
   		});  

   		/*$('#expected_delivery_date').Zebra_DatePicker({
            icon_position : 'left',inside : true
        });*/
    };

    var runDeliveryDateAutoGenerate = function(){


    	$('.auto-generate-deliverydate').click(function(e){
    		e.preventDefault();
    		var lmpDate = $('#obs_lmp_date').val();

    		if(lmpDate==null || lmpDate==''){
    			bootbox.dialog({
						message		: "Lmp date is empty. Please fill lmp date",
						title 		: "Warning",
						buttons 	: 
						{
							success : 
							{
								label 		: "Ok",
								className	: "btn-success",
								callback 	: function() 
								{
									$('#obs_lmp_date').focus();
									//$('#obs_lmp_date').css({"border":"1px solid red"});
								}
							}
						}
				});
    		}
    		else{
    			runDeliveryDateAutoGenerateExtended();
               	
    		}	
    		
    	});

    };

    var runDeliveryDateAutoGenerateExtended = function(){

    	var lmpDate 				=  $('#obs_lmp_date').val();

    	if(lmpDate==null || lmpDate==''){
    		$('#expected_delivery_date').val('');
    	}
    	
    	else{
    		var lmpDateFormatted  		= new Date(lmpDate);
			var setExpectedDate 		= lmpDateFormatted.setDate(lmpDateFormatted.getDate()+280); 
		   	var expectedDateFormatted 	= new Date(setExpectedDate);
		   	//alert(newEdd)
		   	var day 	= expectedDateFormatted.getDate();
		    var month 	= expectedDateFormatted.getMonth() + 1;
		    var year  	= expectedDateFormatted.getFullYear();
		    var newDate = day+"-"+month+"-"+year;

		   	var expectedDeliveryDate = moment(newDate, "DD/MM/YYYY").format("YYYY-MM-DD");
		   	$('#expected_delivery_date').val(expectedDeliveryDate);
		}
    		
	   	

    };

   


    var runGynObstetricsValidation = function () {
	        	var form2 							= $('#addPatientObstetricsHistory');
		        var errorHandler2 		= $('.errorHandler', form2);
		        var successHandler2 = $('.successHandler', form2);
		        
		         form2.validate({
		         	 errorElement	: "span", // contain the error msg in a small tag
            			 errorClass	: 'help-block',
            			 errorPlacement: function (error, element) 
            		 { // render error placement for each input type
				                if (element.attr("type") == "radio" || element.attr("type") == "checkbox") { // for chosen elements, need to insert the error after the chosen container
				                    error.insertAfter($(element).closest('.form-group').children('div').children().last());
				                } else if (element.hasClass("ckeditor")) {
				                    error.appendTo($(element).closest('.form-group'));
				                } else {
				                    error.insertAfter(element);
				                    // for other inputs, just perform default behavior
				                }
            		 },
            		 	 rules	: 
            		 	 {
			            	married_life  :   
			               		{ 
			                    	number : true,
			                    		range : [1,99],
			               		 },
			               		 gravida : { 
				                    number : true,
				                   		  range : [1,99],
				                },
				                 living : { 
				                    number : true,
				                    	 range : [1,99],
				                },
				                abortion : { 
				                    	number : true,
				                    		range : [1,99],
				                },
				                obs_lmp_days : {
				                	number : true,
				                   		 range: [1,99],
				                },
				                obs_lmp_cycle: {
				                	number : true,
				                    	range: [1,99],
				                },
				                'years[]' : {
				                	number : true,
				                    	range: [1,99],
				                },
				                'months[]' : {
				                	number : true,
				                    	range: [1,12],
				                },
					             'weeks[]' : {
					                	number : true,
					                  	   range: [1,99],
					                }
			              },
			              messages: {
						      married_life    : 
				                {
				                    number : "Please type a valid number",
				                    	   range  : "Please type married life between 1 - 99",
				                },
				                 gravida : 
				                {
				                    number : "Please type a valid number",
				                    		range  : "Please type gravida between 1 - 99",
				                },
				                living          : 
				                {
				                     number : "Please type a valid number",
				                    		range  : "Please type living between 1 - 99",
				                },
				                abortion        : 
				                {
				                    number : "Please type a valid number",
				                    		range  : "Please type abortion between 1 - 99",
				                },
				                obs_lmp_cycle: 
				                {
				                		number : "Please type a valid number",
				                			range  : "Please type cycle between 1 - 99",
				                },
				                obs_lmp_days: 
				                {
				                	number : "Please type a valid number",
				                		range  : "Please type days between 1 - 99",
				                },
				                'years[]' : {
				                	number : "Please type a valid number",
				                		range  : "Please type year between 0 - 99",
				                },
				                'months[]' : {
				                	number : "Please type a valid number",
				                		range  : "Please type month between 1 - 12",
				                },
				                'weeks[]' : {
				                	number : "Please type a valid number",
				                		range  : "Please type week between 0 - 99",
				                }
						   },
						   submitHandler: function (form) {
				                //successHandler2.show();
				               		//errorHandler2.hide();
				                // submit form
				                	("#form2" ).submit(function( event ) {
					                      //alert( "Handler for .submit() called." );
					                      //event.preventDefault();
					                });
				            }
					});

        
   };

    var runAddMorePregnancy = function(){

   		$.ajax({
            type: "POST",
            url: "patientObstetricsDataAjax",
           
            dataType: "JSON",
            success: function(data) {
            	//console.log(data);

            	var lmpFlow 		= data.lmpFlow;
            	var lmpDysmenohrrea = data.lmpDysmenohrrea;
            	var lmpMensusType 	= data.lmpMensusType;
            	var pregKind 		= data.pregKind;
            	var pregType 		= data.pregType;
            	var pregTerm 		= data.pregTerm;
            	var pregHealth 		= data.pregChildHealth;
            	var pregGender 		= data.gender;

            	//console.log(pregGender);

            	//add more pregnancies
            	var counter = 1;

            	$('.btn-addmore-preg').click(function(e){
					e.preventDefault();
					counter ++;
	            	$('#pregnancy').append(
	            		'<div id="dynamic-preg" class="dynamic-preg">' +
			         		'<div class="form-group">' +
			                    '<div class="col-sm-4"></div>' +
			                '</div>' +
			                '<div class="form-group">' +
			                    '<label class="col-sm-2 ">Pregnancy Kind</label>' +
			                        '<div class="col-sm-4">' +
	                                    '<span class="">' +
	                                        '<select name="preg_kind[]" class="form-control preg_kind" id="preg_kind'+counter+'">' +
	                                            
	                                        '</select>' +
	                                    '</span>' +
	                                '</div>' +
			                    '<label class="col-sm-2 ">Pregnancy Type</label>' +
			                        '<div class="col-sm-4">' +
			                            '<span class="">' +
	                                        '<select name="preg_type[]" class="form-control preg_type" id="preg_type'+counter+'">' +
	                                            
	                                        '</select>' +
			                            '</span>' +
			                        '</div>' +
			             	'</div>' +          
	                     	'<div class="form-group">' +
	                            '<label class="col-sm-2 ">Pregnancy Term</label>' +
	                            	'<div class="col-sm-4">' +
		                                '<span class="">' +
		                                    '<select name="preg_term[]" class="form-control preg_term" id="preg_term'+counter+'">' +
		                                        
		                                    '</select>' +
		                                '</span>' +
	                            	'</div>' +
	                            '<label class="col-sm-2 ">Type of abortion</label>' +
	                            	'<div class="col-sm-4">' +
		                                '<span class="">' +
		                                    '<input type="text" name="type_of_abortion[]" id="type_of_abortion'+counter+'" class="form-control type_of_abortion" />' +
		                                '</span>' +
	                            	'</div>' +
	                     	'</div>' +
	                     	'<div class="form-group">' +
	                            '<label  class="col-sm-2 ">Health</label>' +
	                               '<div class="col-sm-4">' +
		                                '<span class="">' +
		                                    '<select name="preg_health[]" class="form-control preg_health" id="preg_health'+counter+'">' +
		                                        
		                                    '</select>' +
		                                '</span>' +
		                            '</div>' +
	                            '<label  class="col-sm-2 ">Gender</label>' +
	                               '<div class="col-sm-4">' +
			                            '<span class="">' +
			                                '<select name="gender[]" class="form-control gender" id="gender'+counter+'">' +
			                                    
			                                '</select>' +
			                            '</span>' +
			                        '</div>' +
	                        '</div>' +
			                '<div class="form-group">' +
			                    '<label  class="col-sm-2 ">Baby-Age</label>' +
			                       	'<div class="col-sm-4 dd_babyage_col">' +
										'<div class="col-sm-4">' +
	                                        '<span class="">' +
	                                            '<input type="text" name="weeks[]" id="weeks'+counter+'" class="form-control weeks" placeholder="Weeks"/>' +
	                                        '</span>' +
			                            '</div>' +
	                                    '<div class="col-sm-4">' +
	                                        '<span class="">' +
	                                            '<input type="text" name="months[]" id="months'+counter+'" class="form-control months" placeholder="Months"/>' +
	                                        '</span>' +
	                                    '</div>' +
		                                '<div class="col-sm-4">' +
		                                    '<span class="">' +
		                                        '<input type="text" name="years[]" id="years'+counter+'" class="form-control years" placeholder="Years"/>' +
		                                    '</span>' +
		                            	'</div>' +
		                            '</div>'+
			                '</div>' +           

			                '<div class="form-group">' +
			                    '<div class="col-sm-10"></div>' +
			                        '<div class="col-sm-12">' +
			                            '<input type="button" name="btn-preg-delete" id="btn-preg-delete'+counter+'" class="btn btn-danger  btn-preg-delete pull-right" value="x" />' +
			                        '</div>' +
			                    '</div>' + 
			                '</div>' 	
			                            
			        );
					

					//Disabling abortion on loading
					$('#type_of_abortion'+counter).attr('disabled',true);

					// Enabling abortion on selecting abrotion preg term
					$('#preg_term'+counter).change(function(){
						var pregTermSelected = $('#preg_term'+counter).val();
						if(pregTermSelected=="Abortion"){
							$('#type_of_abortion'+counter).attr('disabled',false);
						}
					})

					$('#preg_kind'+counter).empty();
		            for (var key in pregKind) {
					  if (pregKind.hasOwnProperty(key)) {
					    //alert(key + " -> " + lmpFlow[key]);
					   $('#preg_kind'+counter).append($("<option></option>").val(key).html(pregKind[key]));
					  }
					}
					$('#preg_type'+counter).empty();
		            for (var key in pregType) {
					  if (pregType.hasOwnProperty(key)) {
					    //alert(key + " -> " + lmpFlow[key]);
					   $('#preg_type'+counter).append($("<option></option>").val(key).html(pregType[key]));
					  }
					}
					$('#preg_term'+counter).empty();
		            for (var key in pregTerm) {
					  if (pregTerm.hasOwnProperty(key)) {
					    //alert(key + " -> " + lmpFlow[key]);
					   $('#preg_term'+counter).append($("<option></option>").val(key).html(pregTerm[key]));
					  }
					}
					$('#preg_health'+counter).empty();
		            for (var key in pregHealth) {
					  if (pregHealth.hasOwnProperty(key)) {
					    //alert(key + " -> " + lmpFlow[key]);
					   $('#preg_health'+counter).append($("<option></option>").val(key).html(pregHealth[key]));
					  }
					}
					$('#gender'+counter).empty();
		            for (var key in pregGender) {
					  if (pregGender.hasOwnProperty(key)) {
					    //alert(key + " -> " + lmpFlow[key]);
					   $('#gender'+counter).append($("<option></option>").val(key).html(pregGender[key]));
					  }
					}

					//Removing dynamically added preg 
					$('.btn-preg-delete').click(function(){
				
						var row = $(this).closest('.dynamic-preg');
						//console.log(row);
						row.remove();
					});

				}); //Addmore button clicks ends

            } //Ajax success ends
        }); //ajax ends here
    };



	return {
        //main function to initiate template pages
        init: function () {
         runObsDatePickers();
            runDeliveryDateAutoGenerate();
            runGynObstetricsValidation();
            runDeliveryDateAutoGenerateExtended();
            runAddMorePregnancy();
        }
    };
}();



