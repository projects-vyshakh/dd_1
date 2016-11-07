var forgetPassword = function () {


    var runDoctorForgetPasswordValidator = function () {
        var form = $('#doctor-forget-password');
        var errorHandler = $('.errorHandler', form);
 

        form.validate({
            rules: {
                
                email_mobile: {
                    required: true,
                    email : true,
                    
                },
                
            },
            messages: {
                
                email_mobile : "Please type a valid email",
               
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
 
    var runDoctorForgetPasswordOtpValidator = function () {
        var form = $('#doctor-otp-check');
        var errorHandler = $('.errorHandler', form);
 

        form.validate({
            rules: {
                doctor_otp: {
                    required: true,
                    
                },
              
                
            },
            messages: {
                doctor_otp : "Please type a valid OTP",

                
               
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

    var runPatientForgetPasswordValidator = function () {
        var form = $('#patient-forget-password');
        var errorHandler = $('.errorHandler', form);
 

        form.validate({
            rules: {
                
                email_mobile: {
                    required: true,
                    number : true
                    
                },
                
            },
            messages: {
                
                email_mobile : {
                    required: "Please type a valid mobile number",
                    
                    number : "Please type a valid mobile number",
                }
               
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

    var runPatientForgetPasswordOtpValidator = function () {
        var form = $('#patient-otp-check');
        var errorHandler = $('.errorHandler', form);
 

        form.validate({
            rules: {
                patient_otp: {
                    required: true,
                    
                },
              
                
            },
            messages: {
                patient_otp : "Please type a valid OTP",

                
               
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
    
    var runNewPasswordValidator = function () {
        var form = $('#new-password');
        var errorHandler = $('.errorHandler', form);
 

        form.validate({
            rules: {
                password: {
                    required: true,
                    
                },
                cpassword: {
                    required: true,
                    equalTo: "#password",
                    
                },
                
                
            },
            messages: {
                password : "Please type a valid password",
                cpassword : {
                    required : "Please confirm password",
                    equalTo  : "Password must be same as above",
                }
                
               
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
            
            runDoctorForgetPasswordValidator();
            runDoctorForgetPasswordOtpValidator();

            runPatientForgetPasswordValidator();

            runPatientForgetPasswordOtpValidator();
            runNewPasswordValidator();
            
        }
    };
}();