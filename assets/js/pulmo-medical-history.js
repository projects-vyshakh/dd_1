var pulmoMedicalHistoryElements = function (dosageUnit) {
	var runMedicalHistoryValidator =	 function () 
    {
    			var form2          			= $('#addPatientMedicalHistory');
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
    	            
    	        });*/
    	

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
    		               
    		                /*'surgery[]': {
    		                    required : true,
    		                },
    		                'medication-drug-allergy[]':{
    		                	required : true,	
    		                }*/
    			               
    			             
    			              
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

    var runIllnessAddMore = function(){
    	$('#btn-addmore-illness').click(function(e) {

    		e.preventDefault();
			
			var counter = $('.present-past-div-count').val();
			counter++;
			
			$('#presentPastDiv').append('<div class="form-group ">' + '<div class="col-sm-2">' + '<input type="text" name="illness_name' + counter + '" id="illness_name' + counter + '" class="form-control illness_name" />' + '</div>' + '<div class="col-sm-2">' + '<label class="radio-inline">' + '<input type="radio" value="Current" name="illness_status' + counter + '" class="present-past-current radioValidation illness_status" id="illness_status_current' + counter + '">' + 'Current' + '</label>' + '</div>' + '<div class="col-sm-2">' + '<label class="radio-inline col-sm-2">' + '<input type="radio" value="Past" name="illness_status' + counter + '"class="present-past-past radioValidation illness_status" id="illness_status_past' + counter + '">' + 'Past' + '</label>' + '</div>' + '<div class="col-sm-2">' + '<label class="radio-inline">' + '<input type="radio" value="NA" name="illness_status' + counter + '"class="present-past-na pp-dynamic-na radioValidation illness_status" id="illness_status_na' + counter + '">' + 'N/A' + '</label>' + '</div>' + '<div class="dd_col_size">' + '<div class="col-sm-3">' + '<input type="text" name="illness_medication' + counter + '" id="medication_present_past' + counter + '" class="form-control present-past-medication-empty ilness_medication",placeholder="Medication" />' + '</div>' + '</div>' + '<div class="dd_col_size">' + '<div class="col-sm-1">' + '<button name="btn-ppmore-remove" onclick="return illnessRemove(this);" class="btn btn-danger btn-ppmore-remove dd_right dd_mg_Medication_10 " id="btn-ppmore-remove">x</button' + '</div>' + '</div>' + '</div>');
			
			//Assigning new value to illnessDivCount
			$('.present-past-div-count').val(counter);
			$('#noPresentPast').attr('checked',false);
			runPresentPastNotApplicableExtended();
		});


    };
    var runotherAddMore = function(){
    	$('#btn-addmore-others').click(function(e) {

    		e.preventDefault();
			
			var counter = $('.other-history-div-count').val();
			counter++;
			
			$('#otherHistoryDiv').append('<div class="form-group">' + '<div class="col-sm-2">' + '<input type="text" name="other_history_name' + counter + '" id="other_history_name' + counter + '" class="form-control other_history_name" />' + '</div>' + '<div class="col-sm-2">' + '<label class="radio-inline">' + '<input class="other-history-normal" type="radio" value="Normal" name="other_history_status' + counter + '"  id="other_history_status_normal' + counter + '">' + 'Normal' + '</label>' + '</div>' + '<div class="dd_col_size">' + '<div class="col-sm-3">' + '<input type="text" name="other_history_comments' + counter + '" id="comments_other_history' + counter + '" class="form-control other-history-comments-empty other_history_comments" />' + '</div>' + '</div>' + '<div class="dd_col_size">' + '<div class="col-sm-1">' + '<button name="btn-otherhistory-remove" onclick="return otherRemove(this);" class="btn btn-danger btn-otherhistory-remove dd_right" id="btn-othershistory-remove">x</button' + '</div>' + '</div>' + '</div>');
			
			//Assigning new value to illnessDivCount
			$('.other-history-div-count').val(counter);
			$('#noOtherHistory').attr('checked',false);
			runOtherHistoryNotApplicableExtended();
		});


    };
    
    var runPresentPastNotApplicable = function(){
    	runPresentPastNotApplicableExtended();
        $('#noPresentPast').click(function()
        {
        	runPresentPastNotApplicableExtended();
            
        });
        
    };
    var runPresentPastNotApplicableExtended = function(){
    	
    	if($('#noPresentPast').is(':checked'))
        {
        	
         	$('#present-past-check-value').val('NA');
           	$('.illness_name').attr('disabled',true);
           	//$('.present-past-na').filter('[value="NA"]').prop('checked', true);
           	$('.illness_name').attr('disabled',true);
           	$('.present-past-na').attr('disabled',true);
           	$('.present-past-current').attr('disabled',true);
           	$('.present-past-past').attr('disabled',true);
           	$('.present-past-medication-empty').attr('disabled',true);
        }
     	else
     	{
     		
           	$('#present-past-check-value').val('');
            $('.illness_name').attr('disabled',false);
            //$('.present-past-na').filter('[value="NA"]').prop('checked', false);
            $('.present-past-na').attr('disabled',false);
            $('.present-past-current').attr('disabled',false);
            $('.present-past-past').attr('disabled',false);
            $('.present-past-medication-empty').attr('disabled',false);
        }
    };
    
    var runOtherHistoryNotApplicable = function(){

    	runOtherHistoryNotApplicableExtended();
        $('#noOtherHistory').click(function()
        {
        	runOtherHistoryNotApplicableExtended();
            
        });
        
    };
    var runOtherHistoryNotApplicableExtended = function(){
    	
    	if($('#noOtherHistory').is(':checked'))
        {
        	/*console.log('hi');*/
         	$('#other-check-value').val('NA');
           	$('.other_history_name').attr('disabled',true);
           	$('.other-history-normal').attr('disabled',true);
           	$('.other-history-comments-empty').attr('disabled',true);
        }
     	else
     	{
     		
           	$('#other-check-value').val('');
            $('.other_history_name').attr('disabled',false);
            //$('.present-past-na').filter('[value="NA"]').prop('checked', false);
            $('.other-history-normal').attr('disabled',false);
            $('.other-history-comments-empty').attr('disabled',false);
        }
    };
    var runFamilyHistoryNotApplicable = function()
    {
    	
    	
    	
    	runFamilyHistoryNotApplicableExtended();
        $('#noFamilyHistory').click(function()
        {	
           runFamilyHistoryNotApplicableExtended(); 
	    });
           
    };
    var runFamilyHistoryNotApplicableExtended = function()
    {

    	//Looping through other and checking whether it is clicked or not,if clicke enables other text
    	$('.family-other').each(function(){
    		if($(this).is(':checked')){
    			
    			var clicked = $(this).closest('.form-group').find('.other-medical-history').prop('disabled',false);
    			console.log(clicked);
    		}
    		else{
    			var clicked = $(this).closest('.form-group').find('.other-medical-history').prop('disabled',true);
    			console.log(clicked);
    			
    		}
    	})

    	if($('#noFamilyHistory').is(':checked'))
        {
        	$('#family-check-value').val('NA');
        	$('.family-hypertension').prop('disabled',true);
            $('.family-diabetes').prop('disabled',true);
            $('.family-cancer').prop('disabled',true);
            $('.family-other').prop('disabled',true);
            $('.other-medical-history').prop('disabled',true);
            $('.family-history-na').prop('disabled',true);
        }
        else
        {
    		$('#family-check-value').val('');
        	$('.family-hypertension').prop('disabled',false); 
            $('.family-diabetes').prop('disabled',false);
            $('.family-cancer').prop('disabled',false);
            $('.family-other').prop('disabled',false);
            //$('.other-medical-history').prop('disabled',false);
            $('.family-history-na').prop('disabled',false);
        }

        // Enabling/Disbling on clicking other check box
        $('.family-other').click(function(){
            var closestElements  = $(this).closest('.form-group');
		    if(closestElements.find('.family-other'). prop("checked") == true)
		    {
		        closestElements.find('.other-medical-history').prop('disabled', false);
            }
         	else
         	{
             	closestElements.find('.other-medical-history').prop('disabled', true);
            }    
        }); 


        $('.family-history-na').click(function()
        {

             var closestElements  = $(this).closest('.form-group');
                
            if($(this). prop("checked") == true)
         	{
                //alert("checked");
               
                //closestElements.find('.family-hypertension').prop('checked', false);
                closestElements.find('.family-hypertension').prop('disabled', true);

                //closestElements.find('.family-diabetes').prop('checked', false);
                closestElements.find('.family-diabetes').prop('disabled', true);
                //closestElements.find('.family-cancer').prop('checked', false);
                closestElements.find('.family-cancer').prop('disabled', true);
                //closestElements.find('.family-other').prop('checked', false);
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
       

    };
	
	var runSurgicalHistoryNotApplicable = function(){
		runSurgicalHistoryNotApplicableExtended();
        $('#noSurgicalHistory').click(function()
        {
		      runSurgicalHistoryNotApplicableExtended();     
        });
    };
    var runSurgicalHistoryNotApplicableExtended = function(){
    	($('#noSurgicalHistory').is(':checked'))?$('.surgicalhistory').prop('disabled', true):$('.surgicalhistory').prop('disabled', false);
    }
    var runGeneralAllergyHistoryNotApplicable = function(){
    	runGeneralAllergyHistoryNotApplicableExtend();
    	$('#noAllergyHistory').click(function(){
    		runGeneralAllergyHistoryNotApplicableExtend();
    	});
    };
    var runGeneralAllergyHistoryNotApplicableExtend = function(){
    	if($('#noAllergyHistory').is(':checked')){
	        $('#generalallergy-check-value').val('NA');   		
	        $('.allergy_general').attr('disabled', 'disabled');
	    }
	    else{
	    	$('#generalallergy-check-value').val(''); 	
	        $('.allergy_general').prop('disabled', false);
	    }
    };
    var runDrugAllergyHistoryNotApplicable = function(){
    	runDrugAllergyHistoryNotApplicableExtend();
    	$('#noDrugAllergy').click(function()
        {
        	runDrugAllergyHistoryNotApplicableExtend();

        });
    }
    var runDrugAllergyHistoryNotApplicableExtend = function(){
    	if($('#noDrugAllergy').is(':checked')){
    		$('.drugallergy-check-value').val('NA');
            $('.medication-drug-allergy').prop('disabled', true);
           	$('.reaction-drug-allergy').prop('disabled', true);
        }
        else
        {
        	$('.drugallergy-check-value').val('');
           	$('.medication-drug-allergy').prop('disabled', false); 
           	$('.reaction-drug-allergy').prop('disabled', false);
        }
    }
	
	var runSurgeryAddMore = function () {

        $('.btn-add-surgery').click(function(e){
            e.preventDefault();
            
            $('#noSurgicalHistory').attr('checked',false);
            $('.surgicalhistory').attr('disabled',false);
        	/*$('.surgicalhistory').each(function(){
        		if($('.surgicalhistory').val().length>0){
        			$('.surgicalhistory').attr('disabled',false);
        		}
        		
        	});
			*/
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

            //No known unchecking
            //drug medication enabling
            //drug reaction enabling
            $('#noDrugAllergy').attr('checked',false);
            $('.medication-drug-allergy').attr('disabled',false);
            $('.reaction-drug-allergy').attr('disabled',false);
	                
	       	$('#allergy').append(
	       		'<div class="form-group dd_Social_History">' +
	                '<div class="col-sm-6">'+
	                    '<div class="dd_top_mt">Medication</div>'+
				   			'<span class="">' +
	                            '<input type="text" name="medication-drug-allergy[]" class="form-control medication-drug-allergy",placeholder = "Medication" />' +
	                        '</span>' +
	                    '</div>'    +
	                    '<div class="dd_col_size">'+
	                        '<div class="col-sm-5">'+
	                            '<div class="dd_top_mt">Reaction</div>'+
                                    '<span class="">' +
                                        '<input type="text" name="reaction-drug-allergy[]" class="form-control reaction-drug-allergy",placeholder = "Reaction" />' +
                                    '</span>' +
	                            '</div>'    +
	                        '</div>'    +
	                        '<div class="dd_col_size">'+
	                            '<div class="col-sm-1">'+
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
    
     
    
    
    
    
    
    var runSocialHistoryNotApplicable = function(){
    	runSocialHistoryNotApplicableExtended();
        $('#noSocialHistory').click(function(){
            runSocialHistoryNotApplicableExtended();
		});
    };
    var runSocialHistoryNotApplicableExtended = function(){
    	if($('#noSocialHistory').is(':checked')){
    		$('.social-check-value').val('NA');
           	$('.social-history').prop('disabled', true);
           	$('.social-history-na').prop('disabled', true);
        }
        else
        {	$('.social-check-value').val('');
            $('.social-history').prop('disabled', false);
            $('.social-history-na').prop('disabled', false);
        }
    };

    
    
	return {
        //main function to initiate template pages
        init: function () {
         
            
            	runMedicalHistoryValidator();
            	runPresentPastNotApplicable();
            	runFamilyHistoryNotApplicable();
            	runSurgicalHistoryNotApplicable();
            	runGeneralAllergyHistoryNotApplicable();
            	runDrugAllergyHistoryNotApplicable();
            	runSocialHistoryNotApplicable();
            	runSurgeryAddMore();
        		runAllergyAddMore();
				runotherAddMore();
				//runFamilyHistoryDetails();
    			runIllnessAddMore();
    			runOtherHistoryNotApplicable();
				//runremoveradio();
    
           
        }
    };
}();
