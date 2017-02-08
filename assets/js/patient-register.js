var patientRegister = function () {
	var runOnPageLoad = function(){
		$('.id_patient').keyup(function(){
            var str = $(this).val();
            var res = str.toUpperCase();
            $(this).val(res); 
            
        });
	};

	var patientRegisterOtpValidator = function () {
        

        var form = $('#handlePatientRegisterOtpCheck');
        var errorHandler = $('.errorHandler', form);
 
       
       
        form.validate({
            rules: {
                id_patient: {
                    required: true,
                    maxlength : 13,
                    minlength : 13,
                },
                otp: {
                    required: true,
                    
                },
               
            },
            messages: {
                id_patient :{
                	required  : "Please type a valid Patient ID",
                	maxlength : "Patient ID is no more than 13 characters",
                	minlength : "Patient ID must be 13 characters",
                }, 

                otp: {
                    required: "Please type a valid Otp Code",
                    
                },
               
               
            },    
            submitHandler: function (form) {
                errorHandler.hide();
                form.submit();
            },
            invalidHandler: function (event, validator) { //display error alert on form submit
                errorHandler.show();
            }
        });
    };

    var patientRegisterPasswordValidator = function () {
        

        var form = $('#handlePatientRegisterPassword');
        var errorHandler = $('.errorHandler', form);
 
       
       
        form.validate({
            rules: {
                reg_password : {
                	required : true,
                },
                c_password : {
                	required : true,
                	equalTo : "#reg_password",
                },
               
            },
            messages: {
                reg_password :{
                	required  : "Please type a valid password",
                }, 

                c_password: {
                    required : "Please type a valid confirm password",
                    equalTo : "Password must be same as above",
                    
                },
               
               
            },    
            submitHandler: function (form) {
                errorHandler.hide();
                form.submit();
            },
            invalidHandler: function (event, validator) { //display error alert on form submit
                errorHandler.show();
            }
        });
    };

   	return {
        //main function to initiate template pages
        init: function () {
            runOnPageLoad();
            patientRegisterOtpValidator();
            patientRegisterPasswordValidator();
            
        }
    };
}(); 
