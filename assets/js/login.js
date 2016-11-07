var Login = function () {
    var runLoginButtons = function () {
        /*$('.forgot').bind('click', function () {
            $('.box-login').hide();
            $('.box-forgot').show();
        });
        $('.register').bind('click', function () {
            $('.box-login').hide();
            $('.box-register').show();
        });
        $('.go-back').click(function () {
            $('.box-login').show();
            $('.box-forgot').hide();
            $('.box-register').hide();
        });*/
       
       var el = $('.box-login');
        if (getParameterByName('box').length) {
            switch(getParameterByName('box')) {
                case "register" :
                    el = $('.box-register');
                    break;
                case "forgot" :
                    el = $('.box-forgot');
                    break;
                default :
                    el = $('.box-login');
                    break;
            }
        }
        el.show();
       
       
       
       
    };
    var runSetDefaultValidation = function () {
        $.validator.setDefaults({
            errorElement: "span", // contain the error msg in a small tag
            errorClass: 'help-block',
            errorPlacement: function (error, element) { // render error placement for each input type
                if (element.attr("type") == "radio" || element.attr("type") == "checkbox") { // for chosen elements, need to insert the error after the chosen container
                    error.insertAfter($(element).closest('.form-group').children('div').children().last());
                } else if (element.attr("name") == "card_expiry_mm" || element.attr("name") == "card_expiry_yyyy") {
                    error.appendTo($(element).closest('.form-group').children('div'));
                } else {
                    error.insertAfter(element);
                    // for other inputs, just perform default behavior
                }
            },
            ignore: ':hidden',
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
                $(element).closest('.form-group').removeClass('has-error');
            },
            highlight: function (element) {
                $(element).closest('.help-block').removeClass('valid');
                // display OK icon
                $(element).closest('.form-group').addClass('has-error');
                // add the Bootstrap error class to the control group
            },
            unhighlight: function (element) { // revert the change done by hightlight
                $(element).closest('.form-group').removeClass('has-error');
                // set error class to the control group
            }
        });
    };
    var runLoginValidator = function () {
        var form = $('#login');
        var errorHandler = $('.errorHandler', form);
 

        form.validate({
            rules: {
                email: {
                    required: true,
                    email :true
                },
                password: {
                    //minlength: 6,
                    required: true
                },
                id_patient : {
                    required : true,
                    //minlength : 3
                },
                mobile : {
                    required : true,
                    number : true,
                    minlength : 10
                },
                otp_code : {
                    required : true,
                    minlength : 4,
                    maxlenght : 4
                },
                cpassword : {
                    required : true,
                    equalTo : "#password1",
                    //minlength: 6,
                }
            },
            messages: {
                email : "Please type a valid email",
                password  : "Please type a valid password",
                cpassword : {
                    required : "Please type a valid confirm password",
                    equalTo : "Password must be same as above",
                },
                id_patient : "Please type valid Patient ID",
                mobile : "Please type a valid mobile number",
                otp_code : "Please type a valid OTP",
                //cpassword : "Please specify correct password",
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
   
    var runRegisterValidator = function () {
        var form3 = $('.form-register');
        var errorHandler3 = $('.errorHandler', form3);
        form3.validate({
            rules: {
                full_name: {
                    minlength: 2,
                    required: true
                },
                address: {
                    minlength: 2,
                    required: true
                },
                city: {
                    minlength: 2,
                    required: true
                },
                gender: {
                    required: true
                },
                email: {
                    required: true
                },
                password: {
                    minlength: 6,
                    required: true
                },
                password_again: {
                    required: true,
                    minlength: 5,
                    equalTo: "#password"
                },
                agree: {
                    minlength: 1,
                    required: true
                }
            },
            submitHandler: function (form) {
                errorHandler3.hide();
                form3.submit();
            },
            invalidHandler: function (event, validator) { //display error alert on form submit
                errorHandler3.show();
            }
        });
    };
    
    //function to return the querystring parameter with a given name.
    var getParameterByName = function(name) {
        name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
        var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"), results = regex.exec(location.search);
        return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
    };



    var runDoctorSignUpValidator = function () {

        $( "#country option:selected" ).val('101').text('India');
        /*Dynamically adding state responding to country and also keeping selected value of state*/
            var stateHidden = $('#state-hidden').val();
            var countryId  = $( "#country option:selected" ).val();
            
            $.ajax({
                type: "POST",
                url: "getState",
                data: "country_id="+ countryId ,
                success: function(data){
                    $('#state').empty();
                    $('#state').append('<option value="0"></option>');
                    for(var s=0;s<data.length;s++){

                        $('#state').append('<option value='+data[s].state_name+'>'+data[s].state_name+'</option>');
                        //$('#state').val(data[0].state_name).prop("selected", true);

                    }
                }
            });

            $( "#country").change(function(){
                var countryId  = $( "#country option:selected" ).val();
                $.ajax({
                type: "POST",
                url: "getState",
                data: "country_id="+ countryId ,
                success: function(data){
                    $('#state').empty();
                    $('#state').append('<option value="0"></option>');
                    for(var s=0;s<data.length;s++){

                        $('#state').append('<option value='+data[s].state_name+'>'+data[s].state_name+'</option>');
                        //$('#state').val("Uttar Pradhesh").attr("selected", "selected");
                        
                       
                    }
                }
            });
            })


        var form = $('#doctor-signup');
        var errorHandler = $('.errorHandler', form);
 
        $.validator.addMethod("stateNotEquals", function(value, element, arg){
            
          return arg!= value;
        }, "Please select a state");

        form.validate({
            rules: {
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
                first_name : {
                    required : true,
                    //minlength : 3
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
            runLoginButtons();
            runSetDefaultValidation();
            runLoginValidator();
            runDoctorSignUpValidator();
            
        }
    };
}();