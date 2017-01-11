var cardioPersonalInformation = function () {
	var runOnPageLoad = function(){
		$(window).load(function() {
				$(".loader").fadeOut("slow");
		});

		$( "#country option:selected" ).val('101').text('India');

			/*Dynamically adding state responding to country and also keeping selected value of state*/
			var stateHidden = $('#state-hidden').val();
          	var countryId  = $( "#country option:selected" ).val();
            //alert(country);
            $.ajax({
                type: "POST",
                url: "getState",
                data: "country_id="+ countryId ,
                success: function(data){
                    $('#state').empty();
                    for(var s=0;s<data.length;s++){

                        $('#state').append('<option>'+data[s].state_name+'</option>');
                        $('#state').val(stateHidden).attr("selected", "selected");

                    }
                }
            });


            $('#country').change(function(){
	            var countryId  = $( "#country option:selected" ).val();
	            //alert(country);
	            $.ajax({
	                type: "POST",
	                url: "getState",
	                data: "country_id="+ countryId ,
	                success: function(data){
	                    $('#state').empty();
	                    for(var s=0;s<data.length;s++){

	                         //console.log(data[s].state_name);


	                        $('#state').append('<option>'+data[s].state_name+'</option>');


	                    }
	                }
	            });
	        });
	};
	
	 var cardioPersonalInformationValidation = function () {
        var form2           = $('#addCardioPersonalInformation');
        var errorHandler2   = $('.errorHandler', form2);
        var successHandler2 = $('.successHandler', form2);
        /*$.validator.addMethod("getEditorValue", function () {
            $("#editor1").val($('.summernote').code());
            if ($("#editor1").val() != "" && $("#editor1").val() != "<br>") {
                $('#editor1').val('');
                return true;
            } else {
                return false;
            }
        }, 'This field is required.');*/
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
       /* $.validator.addMethod("stateNotEquals", function(value, element, arg){
          return arg != value;
        }, "Please type state");*/
        $.validator.addMethod("cityNotEquals", function(value, element, arg){
          return arg != value;
        }, "Please type city");

        $.validator.addMethod("regex",function(value,element,regexp){
                var re= new RegExp(regexp);
                return this.optional(element) || re.test(value);
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
                    number    : true,
                    minlength : 12,
                    maxlength : 12,
                    
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
                pincode : {
                	number : true,
                },
                phone: {
                    required : true,
                    number : true,
                    minlength :10,
                },
                email: {
                    
                    email : true
                },
                
            },
            messages: {
                first_name  : {
                                    required    : "Please type your first name",
                                    minlength   : "First name must be atleast 3 characters long",
                                    regex       : "Please type only characters"
                },
                last_name  : {
                                    required    : "Please type your last name",
                                    regex       : "Please type only characters"
                },
               
                aadhar_no   : {
                                number    : "Please type only digits",
                                minlength : "Aadhar number must be atleast 12digits",
                                maxlength : "Aadhar number do not exceeds 12digits",
                                
                },
                dob         : "Please type a valid year between 1900 -"+new Date().getFullYear().toString(),
                age         : "Please type valid age",
                maritial_status : "Please type maritial status",
               /* house       : "Please type house name/no",
                street      : "Please type street",*/
                country     : "Please choose a country",
                state       : "Please choose a state",
                city        : "Please type city",
                pincode : {
                	number : "Please type a valid pincode",
                },
                phone       : {
                    minlength : "Please enter a valid mobile",
                    number : "Please type valid phone number",
                },
                email   : {
                    email: "Please type a valid email address"
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
                ("#form2" ).submit(function( event ) {
                      //alert( "Handler for .submit() called." );
                      //event.preventDefault();
                });
            }
        });
     
    };




	return {
        //main function to initiate template pages
        init: function () {
            runOnPageLoad();
            cardioPersonalInformationValidation();
           
        }
    };
}(); 
