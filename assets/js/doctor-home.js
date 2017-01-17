var doctorHome = function () {

	var runOnPageLoad = function(){
      
     
		  var pathname = window.location.pathname;
     
      var rest = pathname.substring(0, pathname.lastIndexOf("/") + 1);
      var last = pathname.substring(pathname.lastIndexOf("/") + 1, pathname.length);
      


		  if (window.history && window.history.pushState) {
          window.history.pushState('', null, ''+last);
          $(window).on('popstate', function() {
               //alert('Back button was pressed.');

              $.ajax({
                type: "POST",
                url: "flushAllSessions",
                dataType :"JSON",
                success: function(data) {
                  
                   //console.log(data)
                   if(data==1){
                      document.location.href = 'doctorlogin';
                   }
                   
                },
              });

              //document.location.href = 'doctorlogin';

          });
      }
    	$('#id_city_new').keyup(function(){
    		var cityLength = $('#id_city_new').val().length;
    		var cityUpper  = $('#id_city_new').val().toUpperCase();
    		$('#id_city_new').val(cityUpper);
	        if(this.value.length==$(this).attr("maxlength")){

	            $(this).next().focus();
	        }
	    });
	    $('#id_doctor_new').keyup(function(){
    		var doctorLength = $('#id_doctor_new').val().length;
    		var doctorUpper  = $('#id_doctor_new').val().toUpperCase();
    		$('#id_doctor_new').val(doctorUpper);
	        if(this.value.length==$(this).attr("maxlength")){

	            $(this).next().focus();
	        }
	    });
	    $('#id_city_old').keyup(function(){

    		var cityLength = $('#id_city_old').val().length;
    		var cityUpper  = $('#id_city_old').val().toUpperCase();
    		$('#id_city_old').val(cityUpper);
	        if(this.value.length==$(this).attr("maxlength")){

	            $(this).next().focus();
	        }
	    });
	    $('#id_doctor_old').keyup(function(){ 
    		var doctorLength = $('#id_doctor_old').val().length;
    		var doctorUpper  = $('#id_doctor_old').val().toUpperCase();
    		$('#id_doctor_old').val(doctorUpper);
	        if(this.value.length==$(this).attr("maxlength")){

	            $(this).next().focus();
	        }
	    });

      $('#id_doctor_new').keyup(function(e){
        if(e.keyCode == 8){
           var doctorCodeLength = $('#id_doctor_new').val().length;
           
          if(doctorCodeLength==0){
            $(this).prev().focus();
          }
        }
      }); 
      $('#id_patient_new').keyup(function(e){
        if(e.keyCode == 8){
           var patientCodeLength = $('#id_patient_new').val().length;
           
          if(patientCodeLength==0){
            $(this).prev().focus();
          }
        }
      }); 
      $('#id_doctor_old').keyup(function(e){
        if(e.keyCode == 8){
           var doctorCodeLength = $('#id_doctor_old').val().length;
           
          if(doctorCodeLength==0){
            $(this).prev().focus();
          }
        }
      }); 
      $('#id_patient_old').keyup(function(e){
        if(e.keyCode == 8){
           var patientCodeLength = $('#id_patient_old').val().length;
           
          if(patientCodeLength==0){
            $(this).prev().focus();
          }
        }
      }); 

	};

	var handleNewPatientIdValidation = function () {
        var form2           = $('#handleNewPatientId');
        var errorHandler2   = $('.errorHandler', form2);
        var successHandler2 = $('.successHandler', form2);
       

        $.validator.addMethod("regex",function(value,element,regexp){
                var re= new RegExp(regexp);
                return this.optional(element) || re.test(value);
        },"Please enter only characters from A-z");

       
        form2.validate({
            errorElement: "span", // contain the error msg in a small tag
            errorClass: 'help-block',
            errorPlacement: function (error, element) { // render error placement for each input type
                if (element.attr("type") == "text" || element.attr("type") == "checkbox" || element.attr("type") == "radio") { // for chosen elements, need to insert the error after the chosen container
                    error.insertAfter($(element).closest('.form-group').children('div').children('.error_msg_div').last());
                } else if (element.hasClass("ckeditor")) {
                    error.appendTo($(element).closest('.form-group'));
                } else {
                    error.insertAfter(element);
                    // for other inputs, just perform default behavior
                }
            },
            ignore: "",
            rules: {
               id_city : {
               		minlength: 3,
                  required: true,
                  regex:"^[a-zA-Z- ]+$",
                  maxlength : 3

               },
               id_doctor : {
               		minlength: 3,
                  required: true,
                  regex:"^[a-zA-Z- ]+$"
               },
               id_patient : {
                  minlength: 7,
               		required : true,
               		number : true,
               		maxlength : 7

               },
            },
            messages: {
              
                id_doctor : {
               		required : "Required Doctor code",
               		minlength : "Please type a valid Doctor code(3 characters required).",
                },
                id_patient : {
               		required : "Required Patient code",
               		number   : "Please type a valid patient code",
               		minlength : "Please type a valid Patient code (7 characters required).",
                },
                id_city : {
               		required : "Required City code",
               		minlength : "Please type a valid City code (3 characters required).",
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
    var handleOldPatientIdValidation = function () {
        var form2           = $('#handleOldPatientId');
        var errorHandler2   = $('.errorHandler', form2);
        var successHandler2 = $('.successHandler', form2);
       

        $.validator.addMethod("regex",function(value,element,regexp){
                var re= new RegExp(regexp);
                return this.optional(element) || re.test(value);
        },"Please enter only characters from A-z");

       
        form2.validate({
            errorElement: "span", // contain the error msg in a small tag
            errorClass: 'help-block',
            errorPlacement: function (error, element) { // render error placement for each input type
                if (element.attr("type") == "text" || element.attr("type") == "checkbox" || element.attr("type") == "radio") { // for chosen elements, need to insert the error after the chosen container
                    error.insertAfter($(element).closest('.form-group').children('div').children('.error_msg_div').last());
                } else if (element.hasClass("ckeditor")) {
                    error.appendTo($(element).closest('.form-group'));
                } else {
                    error.insertAfter(element);
                    // for other inputs, just perform default behavior
                }
            },
            ignore: "",
           rules: {
               id_city : {
                  minlength: 3,
                  required: true,
                  regex:"^[a-zA-Z- ]+$",
                  maxlength : 3

               },
               id_doctor : {
                  minlength: 3,
                  required: true,
                  regex:"^[a-zA-Z- ]+$"
               },
               id_patient : {
                  minlength: 7,
                  required : true,
                  number : true,
                  maxlength : 7

               },
            },
            messages: {
              
                id_doctor : {
                  required : "Required Doctor code",
                  minlength : "Please type a valid Doctor code(3 characters required).",
                },
                id_patient : {
                  required : "Required Patient code",
                  number   : "Please type a valid patient code",
                  minlength : "Please type a valid Patient code (7 characters required).",
                },
                id_city : {
                  required : "Required City code",
                  minlength : "Please type a valid City code (3 characters required).",
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
            handleNewPatientIdValidation();
           	handleOldPatientIdValidation();
        }
    };
}(); 

