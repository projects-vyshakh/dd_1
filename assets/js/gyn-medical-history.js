var patientMedicalHistoryElements = function (dosageUnit) {
		 var runMedicalHistoryValidator =	 function () 
		 {
        			var form2          					= $('#addPatientMedicalHistory');
			        var errorHandler2  		 	= $('.errorHandler', form2);
			        var successHandler2 		= $('.successHandler', form2);

			        $.validator.addClassRules('illness_name', {
			            required: true ,
			    	});
			    	
			    	
			        /*$.validator.addClassRules('surgicalhistory', {
			            required: true ,
			           
			        });
			
			        $.validator.addClassRules('medication-drug-allergy', {
			            required: true ,
			            
			        });
			        $.validator.addClassRules('reaction-drug-allergy', {
			            required: true ,
			            
			        });
			*/
       
		        form2.validate({
		           	errorElement			: "span", // contain the error msg in a small tag
		            	errorClass					: 'help-block',
		           		 errorPlacement		: function (error, element) { // render error placement for each input type
				                if (element.attr("type") == "radio" || element.attr("type") == "checkbox") { // for chosen elements, need to insert the error after the chosen container
				                    error.insertAfter($(element).closest('.form-group').children('div').children().last());
				                } else if (element.hasClass("ckeditor")) {
				                    error.appendTo($(element).closest('.form-group'));
				                } else {
				                    error.insertAfter(element);
				                    // for other inputs, just perform default behavior
				                }
		            	},
				            ignore: "",
				            rules: {
				                menarche: {
				                    number : true
				                },
					                menopause: {
					                    number : true,
					                },
					               ' surgery[]' : {
					                	required : true,
					             },
					              
				         	},
				            messages: {
				                menarche    : "Please type a valid number",
				              		  menopause   : "Please type a valid number",
				              		  
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
				                $(element).closest('.form-group').removeClass('has-error');
				                // set error class to the control group
				            },
				            success: function (label, element) {
				                label.addClass('help-block valid');
				                // mark the current input as valid and display OK icon
				                $(element).closest('.form-group').removeClass('has-error').addClass('has-success').find('.symbol').removeClass('required').addClass('ok');
				            },
				            submitHandler: function (form) {
				                successHandler2.show();
				                errorHandler2.hide();
				                // submit form
				                  
				                ("#form2" ).submit(function( event ) { });
				            }
		        });
    };
    
    
    var runPresentPastNotApplicable = function(){
        	$('#noPresentPast').click(function()
        	{
            if($('#noPresentPast').is(':checked'))
            {
             	  $('#present-past-check-value').val('NA');
		               $('.illness_name').attr('disabled',true);
		               $('.present-past-na').filter('[value="NA"]').prop('checked', true);
		               $('.present-past-current').attr('disabled',true);
		               $('.present-past-past').attr('disabled',true);
		               $('.present-past-medication-empty').attr('disabled',true);
	            }
	         else
	         {
	               $('#present-past-check-value').val('');
		                $('.illness_name').attr('disabled',false);
		                $('.present-past-na').filter('[value="NA"]').prop('checked', false);
		                $('.present-past-current').attr('disabled',false);
		                $('.present-past-past').attr('disabled',false);
		                $('.present-past-medication-empty').attr('disabled',false);
	            }
        });
    };
    
     var runFamilyHistoryNotApplicable = function()
    {
         $('#noFamilyHistory').click(function()
         	{
		            if($('#noFamilyHistory').is(':checked'))
		            {
		                	$('.family-hypertension').prop('disabled',true);
				                $('.family-diabetes').prop('disabled',true);
				                $('.family-cancer').prop('disabled',true);
				                $('.family-other').prop('disabled',true);
				                $('.other-medical-history').prop('disabled',true);
				                $('.family-history-na').prop('checked',true);
		            	}
		            else{
		                	$('.family-hypertension').prop('disabled',false); 
				                $('.family-diabetes').prop('disabled',false);
				                $('.family-cancer').prop('disabled',false);
				                $('.family-other').prop('disabled',false);
				                $('.other-medical-history').prop('disabled',false);
				                $('.family-history-na').prop('checked',false);
		            	}
	        });
           
    };
	 var runSurgicalHistoryNotApplicable = function(){
        $('#noSurgicalHistory').click(function()
        {
		            if($('#noSurgicalHistory').is(':checked'))
		            {
		                $('.surgicalhistory').prop('disabled', true);
		            	 }
			            else{
			                $('.surgicalhistory').prop('disabled', false);
			            }
        });
    };
	
	var runSurgeryAddMore = function () {

            $('.btn-add-surgery').click(function(e){
                	e.preventDefault();
		                $('#surgery').append('<div class="form-group dd_col_size">' + 
		                                        '<div class="col-sm-11">' +
		                                            '<span class="">' +
		                                                '<input type="text" name="surgery[]" class="form-control surgicalhistory" placeholder="Surgery">' +
		                                                '' +
		                                            '</span>' +
		                                        '</div>'+
		                                        '<div class="col-sm-1">' +
		                                            '<button name="btn-surgery-remove" class="btn btn-danger btn-surgery-remove dd_right " id="btn-surgery-remove">x</button' +
		                                        '</div>' +  
		                                     '</div>'
		
		                );
					 $('.btn-surgery-remove').click(function(e){
	                    e.preventDefault();
	                    		var clickedElements = $(this).closest('.form-group');
	                    		clickedElements.remove();   
	                });

            });
    };
    
      var runAllergyAddMore = function(){
        $('.btn-add-allergies').click(function(e){
                e.preventDefault();
                //counter ++;
	                $('#allergy').append('<div class="form-group">' +
	                                        '<div class="col-sm-6">'+
	                                        '<div class="dd_top_mt">Medication</div>'+
	
	                                                '<span class="">' +
	                                                    '<input type="text" name="medication-drug-allergy[]" class="form-control medication-drug-allergy",placeholder = "Medication" />' +
	                                                '</span>' +
	                                            '</div>'    +
	                                             ' <div class="dd_col_size">'+
	                                            ' <div class="col-sm-5">'+
	                                            '<div class="dd_top_mt">Reaction</div>'+
	                                                    '<span class="">' +
	                                                        '<input type="text" name="reaction-drug-allergy[]" class="form-control reaction-drug-allergy",placeholder = "Reaction" />' +
	                                                    '</span>' +
	                                            '</div>'    +
	                                             '</div>'    +
	                                             ' <div class="dd_col_size">'+
	                                            ' <div class="col-sm-1">'+
	                                                '<button class="btn btn-danger btn-allergy-remove dd_right dd_mg_25 ">x</button>'+
	                                            '</div>' +
	                                             '</div>' +
	                                    '</div>'
	
	                            );
								$('.btn-allergy-remove').click(function(e){
						                    e.preventDefault();
						                   		 var clickedElements = $(this).closest('.form-group');
							                    //console.log(clickedElements);
							                    clickedElements.remove();   
						                });
						          });
    };
    
     var runFamilyHistoryDetails = function()
    {
			   $('.other-medical-history').prop('disabled', true);
		        $('.other-allergy-text').prop('disabled', true);

		        $('.family-other').click(function(){
		            	var closestElements  = $(this).closest('.form-group');
				            if(closestElements.find('.family-other'). prop("checked") == true){
				                closestElements.find('.other-medical-history').prop('disabled', false);
				            }
				         else
				         {
				             closestElements.find('.other-medical-history').prop('disabled', true);
				            }    
		        }); 

        			var clicked  = $('.family-other').closest('.form-group');
            		clicked.find('.family-other').each(function(index)
            	{
                			 if ($(this).prop('checked')==true){ 
		               		clicked.find('.other-medical-history').prop('disabled', false);
		                	 }
		                else
		                {
		                  	clicked.find('.other-medical-history').prop('disabled', true);
		               		 }
        			});  
     
       	$('.family-history-na').each(function (index) 
      {
      		var clickedElements = $(this).closest('.form-group');
        
           		if(clickedElements.find('.family-history-na'). prop("checked") == true)
           	{
	            	 	clickedElements.find('.family-hypertension').prop('checked', false);
	                		clickedElements.find('.family-hypertension').prop('disabled', true);
							clickedElements.find('.family-diabetes').prop('checked', false);
			                clickedElements.find('.family-diabetes').prop('disabled', true);
			                clickedElements.find('.family-cancer').prop('checked', false);
			                clickedElements.find('.family-cancer').prop('disabled', true);
			                clickedElements.find('.family-other').prop('checked', false);
			                clickedElements.find('.family-other').prop('disabled', true);
			                clickedElements.find('.other-medical-history').prop('disabled',true);
		           }
		         else
		        {
		                clickedElements.find('.family-hypertension').prop('disabled', false);
			                clickedElements.find('.family-diabetes').prop('disabled', false);
			                clickedElements.find('.family-cancer').prop('disabled', false);
			                clickedElements.find('.family-other').prop('disabled', false);
			                clickedElements.find('.other-medical-history').prop('disabled',false);
		           }
        });

        $('.family-history-na').click(function(){

             var closestElements  = $(this).closest('.form-group');
                
            if($(this). prop("checked") == true)
         {
                //alert("checked");
               
                closestElements.find('.family-hypertension').prop('checked', false);
                closestElements.find('.family-hypertension').prop('disabled', true);

                closestElements.find('.family-diabetes').prop('checked', false);
                closestElements.find('.family-diabetes').prop('disabled', true);
                closestElements.find('.family-cancer').prop('checked', false);
                closestElements.find('.family-cancer').prop('disabled', true);
                closestElements.find('.family-other').prop('checked', false);
                closestElements.find('.family-other').prop('disabled', true);
                closestElements.find('.other-medical-history').prop('disabled',true);
            }
            else{
                //alert("not checked");
                
                closestElements.find('.family-hypertension').prop('disabled', false);
                closestElements.find('.family-diabetes').prop('disabled', false);
                closestElements.find('.family-cancer').prop('disabled', false);
                closestElements.find('.family-other').prop('disabled', false);
                closestElements.find('.other-medical-history').prop('disabled',true);
            }    
            //console.log();
            
        });

       /* $('.other-allergy').click(function(){
            var closestElements  = $(this).closest('.form-group');
                console.log(closestElements);
            if($('.other-allergy').is(':checked')){
                
                closestElements.find('.other-allergy-text').prop('disabled', false);
            }
            else{
                closestElements.find('.other-allergy-text').prop('disabled', true);
            }    
        });*/
        

        

    }; 
    
    
    
    
    
    
    var runAllergyHistoryDetails = function(){
        	$('#noDrugAllergy').click(function()
        	{
		           if($('#noDrugAllergy').is(':checked')){
		                	$('.medication-drug-allergy').prop('disabled', true);
		                		$('.reaction-drug-allergy').prop('disabled', true);
		            	}
		            else
		            {
		               	$('.medication-drug-allergy').prop('disabled', false); 
		               			$('.reaction-drug-allergy').prop('disabled', false);
		            	}
			});

         $('#noAllergyHistory').click(function(){
	            if($('#noAllergyHistory').is(':checked')){
	            	
	                $('.allergy_general').attr('disabled', 'disabled');
	                }
		        else{
		        		
		                $('.allergy_general').prop('disabled', false);
		            }
			});
    };

    var runSocialHistoryDetails = function(){
        $('#noSocialHistory').click(function(){
	            if($('#noSocialHistory').is(':checked')){
	                	$('.social-history').prop('disabled', true);
	                		$('.social-history-na').prop('checked', true);
	           		 }
	            else
	            {
	                	$('.social-history').prop('disabled', false);
	                		$('.social-history-na').prop('checked', false);
	            	}
			});
    };
	
	
	return {
        //main function to initiate template pages
        init: function () {
         
            
            runMedicalHistoryValidator();
            	runPresentPastNotApplicable();
            	runFamilyHistoryNotApplicable();
            	runSurgicalHistoryNotApplicable();
            	runSurgeryAddMore();
        		runAllergyAddMore();
				runAllergyHistoryDetails();
				runSocialHistoryDetails();
				runFamilyHistoryDetails();
    
           
        }
    };
}();
