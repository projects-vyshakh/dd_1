var doctorSignup = function () {



	var runDoctorSignupValidations = function(){
		var form2           = $('#doctor-signup');
        var errorHandler2   = $('.errorHandler', form2);
        var successHandler2 = $('.successHandler', form2);

        // $.validator.addClassRules("morning", {
        //      number : true 
        // });
        // $.validator.addClassRules("noon", {
        //      number : true 
        // });
        // $.validator.addClassRules("night", {
        //      number : true 
        // });
        // $.validator.addClassRules("drug_name", {
        //      required : true 
        // });
       
       	 $.validator.addMethod("stateNotEquals", function(value, element, arg){
            
          return arg!= value;
        }, "Please select a state");
        $.validator.addMethod("needsSelection", function (value, element) {
                    var count = $(element).find('option:selected').length;
                    return count > 1;
                });
        
        form2.validate({
            errorElement: "span", // contain the error msg in a small tag
            errorClass: 'help-block',
            errorPlacement: function (error, element) { // render error placement for each input type
                if (element.attr("type") == "radio" || element.attr("type") == "checkbox") { // for chosen elements, need to insert the error after the chosen container
                    error.insertAfter($(element).closest('.form-group').children('div').children().last());
                    console.log($(element).closest('.form-group').children('div').children().last());
                } else if (element.hasClass("ckeditor")) {
                    error.appendTo($(element).closest('.form-group'));
                } else {
                    error.insertAfter(element);
                    // for other inputs, just perform default behavior
                }
            },

          


            ignore: "",
            rules: {
               first_name : { required:true},
               email: {
                    required: true,
                    email :true
                },
                password: {
                    //minlength: 6,
                    required: true
                },
                cpassword: {
                    //minlength: 6,
                    required: true,
                    equalTo : "#password",
                },
                last_name : {
                    required : true,
                    //minlength : 3
                },
                phone : {
                    required : true,
                    number : true,
                },
                state : {
                    stateNotEquals : 0 ,
                },
                qualification  :   { needsSelection: false, required:true },
               	services : {
               		required :true,
               	}
                
                
            },
            
            messages: {
                email : "Please type a valid email",
                password  : "Please type a valid password",
                cpassword : {
                    required : "Please type a valid confirm password",
                    equalTo : "Password must be same as above",
                },
                first_name : {
                    required : "Please type your first name",
                    //minlength : 3
                },
                last_name : {
                    required : "Please type your last name",
                    //minlength : 3
                },
                phone : {
                    required : "Please type a valid mobile number",
                    number : "Please type a valid mobile number",
                },
               services : {
               	required : "Please agree the terms and conditiions",
               }
                 
               
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
                   // alert('REgsiter');
                   ("#form2" ).submit(function( event ) {
                      //alert( "Handler for .submit() called." );
                      event.preventDefault();
                      //alert('sdsdsdss');
                });
                    
               
            }
        });
	};

	return {
		//main function to initiate template pages
		init: function () {
		  runDoctorSignupValidations();
		}
    };
}(); 
