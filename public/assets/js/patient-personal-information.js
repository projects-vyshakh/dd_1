var patientElements = function () {
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
       $('#dob').change(function(){
           var dob = $('#dob').val();
           var now  = new Date();
           var past = new Date(dob);
           var nowYear = now.getFullYear();
           var pastYear = past.getFullYear();
           var age = nowYear - pastYear;
           console.log(age + 1);
           $('#age').val(age + 1);
       }); 
    };
    // function to initiate Validation Sample 2
    var runValidator2 = function () {
        var form2 = $('#addPatientPersonalInformation');
        var errorHandler2 = $('.errorHandler', form2);
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
        $.validator.addMethod("valueNotEquals", function(value, element, arg){
          return arg != value;
        }, "Please specify gender");
        $.validator.addMethod("countryNotEquals", function(value, element, arg){
          return arg != value;
        }, "Please specify country");
        $.validator.addMethod("stateNotEquals", function(value, element, arg){
          return arg != value;
        }, "Please specify state");
        $.validator.addMethod("cityNotEquals", function(value, element, arg){
          return arg != value;
        }, "Please specify city");
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
                    required: true
                },
                last_name: {
                    
                    required: true
                },
                gender : {
                    valueNotEquals : 0
                },
                dob: {
                    required: true
                },
                age: {
                    required: true
                },
                house: {
                    required: true
                },
                street: {
                    required: true
                },
                country : {
                    countryNotEquals : 0
                },
                state : {
                    stateNotEquals : 0
                },
                city : {
                    cityNotEquals : 0
                },
                phone: {
                    required : true,
                    number : true
                },
                email: {
                    required : true,
                    email : true
                },
                
            },
            messages: {
                first_name  : "Please specify first name",
                last_name   : "Please specify last name",
                dob         : "Please specify date of birth",
                age         : "Please specify age",
                house       : "Please specify house name/no",
                street      : "Please specify street",
                country     : "Please specify country",
                state       : "Please specify state",
                city        : "Please specify city",
                phone       : "Please specify phone number",
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
    var runCountryCityState = function(){
        
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

                         console.log(data[s].state_name);


                        $('#state').append('<option>'+data[s].state_name+'</option>');


                    }
                }
            });
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
            runDatePicker();
            runTimePicker();
            runDateRangePicker();
            //runColorPicker();
            //runColorPalette();
            //runTagsInput();
            //runSummerNote();
           // runCKEditor();
            runAge();
            runValidator2();
            runCountryCityState();
        }
    };
}();