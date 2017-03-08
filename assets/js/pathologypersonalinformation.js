var pathologyPatientPersonalInformation = function () { 

	

	var personalInformationValidator = function () {
		
        var form2          			= $('#addPathologyPersonalInformation');
		var errorHandler2  		 	= $('.errorHandler', form2);
		var successHandler2 		= $('.successHandler', form2);

        jQuery.validator.addClassRules('state', {
            required: true /*,
            other rules */
        });
        $.validator.addMethod("maritialStatusNotEquals", function(value, element, arg){
            
          return arg != value;
        }, "Please type maritial status");
        $.validator.addMethod("valueNotEquals", function(value, element, arg){
            
          return arg != value;
        }, "Please type gender");
        $.validator.addMethod("countryNotEquals", function(value, element, arg){
          return arg != value;
        }, "Please type country");
        /*$.validator.addMethod("stateNotEquals", function(value, element, arg){
          return arg != value;
        }, "Please type state");*/
        $.validator.addMethod("cityNotEquals", function(value, element, arg){
          return arg != value;
        }, "Please type city");

        $.validator.addMethod("regex",function(value,element,regexp){
                var re= new RegExp(regexp);
                return this.optional(element) || re.test(value);
               //alert(value);
        },"Enter only characters from A-z");
			
       
		form2.validate({
            errorElement: "span", // contain the error msg in a small tag
            errorClass: 'help-block',
            errorPlacement: function (error, element) { // render error placement for each input type
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
                first_name: {
                    minlength: 3,
                    required: true,
                    regex:"^[a-zA-Z- ]+$"
                },
                middle_name : {
                    regex:"^[a-zA-Z- ]+$"
                },
                last_name: {
                    
                    //required: true,
                    regex:"^[a-zA-Z- ]+$"
                },
                aadhar_no: {
                    minlength : 12,
                    maxlength : 12,
                    number    : true
                },
                gender : {
                    valueNotEquals : 0
                },
                dob: {
                    required: true,
                    number : true,
                    range: [1900, new Date().getFullYear().toString()],
                    minlength : 4,
                    maxlength : 4,
                },
                age: {
                    required: true,
                    number : true,
                    maxlength : 3
                },
                maritial_status : {
                    maritialStatusNotEquals : 0
                },
                /*house: {
                    required: true
                },
                street: {
                    required: true
                },*/
                /*country : {
                    countryNotEquals : 0
                },*/
                /*state : {
                    stateNotEquals : ''
                },*/
                city : {
                    cityNotEquals : 0
                },
                phone: {
                    required : true,
                    number : true,
                    maxlength : 15,
                    minlength : 7
                },
                email: {
                    
                    email : true
                },
                pincode :{
                    number : true
                }
                
            },
            messages: {
                first_name  : "Please type first name",
                /*last_name   : "Please type last name",*/
                aadhar_no   : "Please type valid Aadhar No (UID must be 12 digit)",
                dob         : "Please type a valid year between 1900 -"+new Date().getFullYear().toString(),
                age         : "Please type valid age",
                maritial_status : "Please type maritial status",
               /* house       : "Please type house name/no",
                street      : "Please type street",*/
                country     : "Please choose a country",
                state       : "Please choose a state",
                city        : "Please type city",
                phone       : 
                { 
                    required: "Please type valid phone number" ,
                    maxlength : "Please enter no more than 15 numbers",
                    minlength : "Please enter atleast 7 numbers",
                },
                email   : {
                    email: "Please type a valid email address"
                },
                pincode: {
                    number : "Type a valid pin code",
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
                // submit form

                ('#form2').submit(function( event ) {
                	//alert('dd')
                      //alert( "Handler for .submit() called." );
                      //event.preventDefault();
                });
            }
        });
        
    };

    
   
    

    

	return {
        //main function to initiate template pages
        init: function () {
        	
            personalInformationValidator();
            
            
        }
    };
}();