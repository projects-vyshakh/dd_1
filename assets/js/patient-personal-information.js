var patientElements = function () {

    var runOnPageLoad = function(){
        $(window).load(function() {
            $(".loader").fadeOut("slow");
        });

    }



    //function to initiate jquery.inputlimiter
    var runInputLimiter = function () {
        $('.limited').inputlimiter({
            remText: 'You only have %n character%s remaining...',
            remFullText: 'Stop typing! You\'re not allowed any more characters!',
            limitText: 'You\'re allowed to input %n character%s into this field.'
        });
    };
    //function to initiate query.autosize    
    var runAutosize = function () {
        $("textarea.autosize").autosize();
    };
    //function to initiate Select2
    var runSelect2 = function () {
        $(".search-select").select2({
            placeholder: "Select an option",
            allowClear: true
        });
    };

 
  
    //function to initiate bootstrap-datepicker
    var runDatePicker = function () {
        
        $('.date-picker').datepicker({
            autoclose: true,
            //endDate : date
            //maxDate : date
           
        });

       
       
       

          
    };

  
    //function to initiate bootstrap-timepicker
    var runTimePicker = function () {
        $('.time-picker').timepicker();
    };
    //function to initiate daterangepicker
    var runDateRangePicker = function () {
        $('.date-range').daterangepicker();
        $('.date-time-range').daterangepicker({
            timePicker: true,
            timePickerIncrement: 15,
            format: 'MM/DD/YYYY h:mm A'
        });
    };
    //function to initiate bootstrap-colorpicker
    var runColorPicker = function () {
        $('.color-picker').colorpicker({
            format: 'hex'
        });
        $('.color-picker-rgba').colorpicker({
            format: 'rgba'
        });
        $('.colorpicker-component').colorpicker();
    };
    //function to initiate bootstrap-colorpalette
    var runColorPalette = function () {
        $('.color-palette').colorPalette()
            .on('selectColor', function (e) {
                $('#selected-color1').val(e.color);
            });
    };
    //function to initiate jquery.tagsinput
    var runTagsInput = function () {
        $('#tags_1').tagsInput({
            width: 'auto'
        });
    };
    //function to initiate summernote
    var runSummerNote = function () {
        $('.summernote').summernote({
            height: 300,
            tabsize: 2
        });
    };
    //function to initiate ckeditor
    var runCKEditor = function () {
        CKEDITOR.disableAutoInline = true;
        $('textarea.ckeditor').ckeditor();
    };
    
    var runTrimmedPatientPersonalInformation = function(){
        $('#first_name,#middle_name,#last_name,#aadhar_no,#dob,#age,#city').on('input',function() {
            var firstName = $('#first_name').val();
            var middleName = $('#middle_name').val();
            var lastName = $('#last_name').val();
            var aadharNo = $('#aadhar_no').val();
            var dob = $('#dob').val();
            var age = $('#age').val();
            var city = $('#city').val();

            var trimmedFirstName = $.trim(firstName);
            var trimmedMiddleName = $.trim(middleName);
            var trimmedLastName = $.trim(lastName);
            var trimmedAadharNo = $.trim(aadharNo);
            var trimmedDob = $.trim(dob);
            var trimmedAge = $.trim(age);
            var trimmedCity= $.trim(city);

            $('#first_name').val(trimmedFirstName);
            $('#middle_name').val(trimmedMiddleName);
            $('#last_name').val(trimmedLastName);
            $('#aadhar_no').val(trimmedAadharNo);
            $('#dob').val(trimmedDob);
            $('#age').val(trimmedAge);
            $('#city').val(trimmedCity);

        });

    };
    
    // function to initiate Validation Sample 2
    var runValidator2 = function () {
        var form2           = $('#addPatientPersonalInformation');
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
                ("#form2" ).submit(function( event ) {
                      //alert( "Handler for .submit() called." );
                      //event.preventDefault();
                });
            }
        });
       /* $('.summernote').summernote({
            height: 300,
            tabsize: 2
        });*/
        /*CKEDITOR.disableAutoInline = true;
        $('textarea.ckeditor').ckeditor();*/
    };

   
   
    var runPatientDiagnosisValidator = function () {
        var form2           = $('#addPatientDiagnosis');
        var errorHandler2   = $('.errorHandler', form2);
        var successHandler2 = $('.successHandler', form2);

        
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
               
               
                'diseases[]'   :   { needsSelection: true, required:true },
                'symptoms[]'   :   { needsSelection: true, required:true }
                
                
            },
            messages: {
                'symptoms[]'   : "Please choose atleast one value",  
                'diseases[]'   : "Please choose atleast one value"
                
               
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

    }  

    var runPatientDiagnosisValidator2 = function () {
        var form2           = $('#addPatientDiagnosis');
        var errorHandler2   = $('.errorHandler', form2);
        var successHandler2 = $('.successHandler', form2);

        
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
               
               
                'diseases[]'   :   { needsSelection: true, required:true },
                //'symptoms[]'   :   { needsSelection: true, required:true },
                
                
            },
            messages: {
                //'symptoms[]'   : "Please choose atleast one symptoms",  
                'diseases[]'   : "Please choose atleast one disease",  
                
               
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

    }  


    var runPatientObstetricsHistoryValidation = function () {
        var form2           = $('');
        var errorHandler2   = $('.errorHandler', form2);
        var successHandler2 = $('.successHandler', form2);

       /*$.validator.addMethod("checkEmptyLmpFlow", function(value, element, arg){
            console.log("Arg"+arg);
            console.log("Val"+value);
          //if(arg=='' && dateVal==)
           var dateVal = $("#last_mensus_date").val();

           if(arg==''){

                return false;
           }
        }, "Please type lmp flow");   
*/
       /* $.validator.addMethod("checkEmptyLmpFlow", function(value, element, arg){
            console.log("Arg"+arg);
            console.log("Val"+value);
          //if(arg=='' && dateVal==)
           var dateVal = $("#last_mensus_date").val();

           if(arg==''){
                return true;
           }
        }, "Please type lmp flow");  */
       

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
               
               
                
                /*lmp_flow : { checkEmptyLmpFlow :function(){
                           return( $("#last_mensus_date").val());
                }

                 },*/
               
                'days[]'    : { number : true, },
                'cycle[]'   : { number : true },
                'years[]'   : { number : true },
                'weeks[]'   : { number : true },
                
                
            },
            messages: {
               
              

                'days[]' : "Please type a valid number",
                'cycle[]' : "Please type a valid number",
                'years[]' : "Please type a valid number",
                'weeks[]' : "Please type a valid number",
                
               
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

                   //("#form2" ).submit();
                    
               
            }
        });

    } 


  

   




   

   




    var runPatientChangePasswordValidation = function () {
        var form2           = $('#patientChangePassword');
        var errorHandler2   = $('.errorHandler', form2);
        var successHandler2 = $('.successHandler', form2);

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
                old_password: {
                    
                    required: true
                },
                new_password: {
                    
                    required: true
                },
                cnew_password : {
                    required : true,
                    equalTo : "#new_password",
                    
                }
               
                
            },
            messages: {
                old_password  : "Please type old password",
                new_password   : "Please type new password",
                dob         : "Please type date of birth",
                age         : "Please type age",
               /* house       : "Please type house name/no",
                street      : "Please type street",*/
                country     : "Please type country",
                state       : "Please type state",
                city        : "Please type city",
                phone       : "Please type phone number",
                email   : {
                    email: "Your email address must be in the format of name@domain.com"
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
                $(element).tooltipster('hide');
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
    var runPrintSetup = function () {
        var form2           = $('#addPrintSettings');
        var errorHandler2   = $('.errorHandler', form2);
        var successHandler2 = $('.successHandler', form2);

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
                top: {
                    
                    number: true
                },
                bottom: {
                    
                    number: true
                },
                left: {
                    
                    number: true
                },
                right: {
                    
                    number: true
                },
                
            },
            messages: {
                old_password  : "Please type old password",
                new_password   : "Please type new password",
                dob         : "Please type date of birth",
                age         : "Please type age",
               /* house       : "Please type house name/no",
                street      : "Please type street",*/
                country     : "Please type country",
                state       : "Please type state",
                city        : "Please type city",
                phone       : "Please type phone number",
                email   : {
                    email: "Your email address must be in the format of name@domain.com"
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
                $(element).tooltipster('hide');
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
            runAutosize();
            runSelect2();
           
            //runMaskInput();
            //runMaskMoney();
            runDatePicker();
            
            runTimePicker();
            runDateRangePicker();
            //runColorPicker();
            //runColorPalette();
            //runTagsInput();
            //runSummerNote();
           // runCKEditor();
           
            runTrimmedPatientPersonalInformation();
            runValidator2();
            runPatientObstetricsHistoryValidation();
            
           
                
            runPatientDiagnosisValidator();
            runPatientDiagnosisValidator2();
           
        
            runPatientChangePasswordValidation();
            runPrintSetup();
			
			
           
        }
    };
}();