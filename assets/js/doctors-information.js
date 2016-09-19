var doctorElements = function () {
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
   
   
    //function to initiate bootstrap-datepicker
    var runDatePicker = function () {
        $('.date-picker').datepicker({
            autoclose: true
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
    var runAge = function (){
        $('#dob').on('input',function() {
       //$('#dob').change(function(){
           var pastYear = $('#dob').val(); 
           var now  = new Date();
           var nowYear = now.getFullYear();
           var age = nowYear - pastYear; 
           
           $('#age').val(age);
           //alert(age);
       }); 
    };
    
    //Doctors Home Validation
    var runNewPatientValidator = function () {
        var form = $('.form-newpatient');
        var errorHandler = $('.errorHandler', form);
        form.validate({
            rules: {
                patient_id: {
                   
                    required: true,
                    //email :true
                }
                
            },
            messages: {
                patient_id : "Please specify patient ID",
               
            },    
            submitHandler: function (form) {
                errorHandler.hide();
                form.submit();
                //alert('hh');
            },
            invalidHandler: function (event, validator) { //display error alert on form submit
                errorHandler.show();
            }
        });
    };
    var runExistPatientValidator = function () {
        var form = $('.form-existpatient');
        var errorHandler = $('.errorHandler', form);
        form.validate({
            rules: {
                patient_id: {
                    //minlength: 3,
                    required: true,
                    //email :true
                }
                
            },
            messages: {
                patient_id : "Please specify patient ID",
               
            },    
            submitHandler: function (form) {
                errorHandler.hide();
                form.submit();
                //alert('hh');
            },
            invalidHandler: function (event, validator) { //display error alert on form submit
                errorHandler.show();
            }
        });
    };
    var runDoctorsHomeValidator = function () {
        var form2           = $('#addNewPatientPersonalInformation');
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
                patient_id: {
                  
                    required: true
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
                      event.preventDefault();
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

     var runDoctorsHomeOldIdValidator = function () {
        var form2           = $('#patientIdSubmit');
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
               
                old_patient: {
                    
                    required: true
                },
               
                
            },
            messages: {
               
                old_patient   : "Please specify a valid patientID",
               
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
                //alert('old');
                // submit form
             /*   ("#form2" ).submit(function( event ) {
                      //alert( "Handler for .submit() called." );
                      event.preventDefault();
                      alert('sdsdsdss');
                });*/
            }
        });


        
    }  
     
   
    var runCountryCityState = function(){
        
        var countryId = $('#country').val();
        getState(countryId);
        function getState(countryId){
            $.ajax({
                type: "POST",
                url: "getState",
                data: "country_id="+ countryId ,
                success: function(data){
                    $('#state').empty();
                    for(var s=0;s<data.length;s++){

                         console.log(data[s].state_name);


                        $('#state').append('<option>'+data[s].state_name+'</option>');


                    }
                }
            });
        }


            
        $('#country').change(function(){
            var countryId = $('#country').val();
            getState(countryId);
        });
        


        

    };
    
   


    return {
        //main function to initiate template pages
        init: function () {
            runInputLimiter();
            runAutosize();
            
            //runSelect2();
            //runMaskInput();
            //runMaskMoney();
            //runDatePicker();
            //runTimePicker();
            //unDateRangePicker();
            //runColorPicker();
            //runColorPalette();
            //runTagsInput();
            //runSummerNote();
           // runCKEditor();
            //runAge();
            // runValidator2();
            //runValidator3();
            //runCountryCityState();
            //runAddMoreFunctions();
            //runDoctorsHomeValidator();
            //runDoctorsHomeOldIdValidator();
            runCountryCityState();
            //runDoctorsRegisterValidator();  
            runNewPatientValidator();
            runExistPatientValidator();
        }
    };
}();