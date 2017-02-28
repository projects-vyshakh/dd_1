var pediaPatientPersonalInformation = function () { 

	var pageLoadImage = function(){
		$(window).load(function() {
			$(".loader").fadeOut("slow");
		});
	};

	var pediaPersonalInformationValidator = function () {
        var form2          			= $('#addPediaPersonalInformation');
		var errorHandler2  		 	= $('.errorHandler', form2);
		var successHandler2 		= $('.successHandler', form2);

        /*$.validator.addClassRules('illness_name', {
            required: true ,
    	});*/
			    	
			    	
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
				                school_name: {
				                    required : true
				                },
				                school_address :{
				                	 required : true
				                },
				                first_name: {
				                    required : true
				                },
				                last_name: {
				                    required : true
				                },
				               	stud_class: {
				                    required : true
				                },
				                /*stud_section: {
				                    required : true
				                },*/
				                stud_dob: {
				                    required : true,
				                    //number   : true,
				                },
				                stud_age: {
				                    required : true,
				                    number   : true,
				                    range    : [1,16],
				                },
				                stud_mobile: {
				                    required : true,
				                    number   : true,
				                    maxlength : 15,
				                    minlength : 10
				                },
					              
				         	},
				            messages: {
				                school_name: {
				                    required : "Please type the school/kindergarten name"
				                },
				                school_address :{
				                	 required : "Please type the address of the school/kindergarten"
				                },
				                first_name: {
				                    required : "Please type a first name"
				                },
				                last_name: {
				                    required : "Please type a last name"
				                },
				                stud_class: {
				                    required : "Please type a class"
				                },
				                /*stud_section: {
				                    required : "Please type a section"
				                },*/
				                stud_dob: {
				                    required : "Please type date of birth",
				                    //number   : "Please type a valid date of birth",
				                },
				                stud_age: {
				                    required : "Please type a valid age",
				                    number   : "Please type a valid age",
				                    range    : "Invalid age[Age must between 1 - 16]",
				                },
				                stud_mobile: {
				                    required : "Please type mobile number",
				                    number   : "Please type a valid mobile number",
				                    maxlength : "Invalid mobile number",
				                    minlength : "Invalid mobile number"
				                },
					             
				              		  
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

    var runScriptsOnPageLoad = function(){
    	
    }

    var ageCalculation = function(){
    	$('#stud_dob').Zebra_DatePicker({
   			direction		: ['2000-01-01',false],
   			//format 			: 'd-m-Y',
   			startYear       : '2000',
   			view			: 'years',
	   		icon_position 	: 'left',
	   		inside 			: true,
	   		show_icon 		: false,
			onSelect: function() { 
		        var dob 		= $('#stud_dob').val();
		        var birthYear 	= new Date(dob).getFullYear();
		       	var currentYear = new Date().getFullYear();
		       	var age 		= currentYear-birthYear;

		       	$('#stud_age').val(age);

		        
		    }
   		});
    }

	return {
        //main function to initiate template pages
        init: function () {
        	runScriptsOnPageLoad();
            pageLoadImage();
            pediaPersonalInformationValidator();
            ageCalculation();
        }
    };
}();