var patientElements = function (dosageUnit) {


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
        var date = new Date();
        date.setDate(date.getDate());
        $('.date-picker').datepicker({
            autoclose: true,
            startDate : date
           
        });

        $('.last_delivery_date').datepicker({
            autoclose: true,
            //startDate : date
        });
        $('.start_date').datepicker({
            autoclose: true,
            //startDate : date
        });

        $('.expected_delvery_date').datepicker({
            autoclose: true,
            startDate : date
        });
        $('.obs_lmp_date').datepicker({
            autoclose: true,
            //startDate : date
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

           if(pastYear.length<1){
                $('#age').val('');
           }else{
                 var now  = new Date();
               var nowYear = now.getFullYear();
               var age = nowYear - pastYear; 
               
               $('#age').val(age);
           }
          
           //alert(age);
       }); 
       $('#age').on('input',function() {
       //$('#dob').change(function(){
           var age = $('#age').val(); 
           if(age.length<1){
                $('#dob').val('');
           }else{
                 var now  = new Date();
                   var nowYear = now.getFullYear();
                   var dob = nowYear - age; 
                   
                   $('#dob').val(dob);
           }
          
           //alert(dob);
       }); 
      
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
    var runDoctorsHomeValidator = function () {
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
               /* house: {
                    required: true
                },
                street: {
                    required: true
                },*/
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
               /* house       : "Please specify house name/no",
                street      : "Please specify street",*/
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


        
    }    
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
        $.validator.addMethod("maritialStatusNotEquals", function(value, element, arg){
            console.log("Arg"+arg);
            console.log("Val"+value);
          return arg != value;
        }, "Please specify maritial status");
        $.validator.addMethod("valueNotEquals", function(value, element, arg){
            console.log("Arg"+arg);
            console.log("Val"+value);
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
                    
                    email : true
                },
                
            },
            messages: {
                /*first_name  : "Please specify first name",*/
                /*last_name   : "Please specify last name",*/
                aadhar_no   : "Please specify valid Aadhar No (UID must be 12 digit)",
                dob         : "Please specify a valid year between 1900 -"+new Date().getFullYear().toString(),
                age         : "Please specify valid age",
                maritial_status : "Please specify maritial status",
               /* house       : "Please specify house name/no",
                street      : "Please specify street",*/
                country     : "Please specify country",
                state       : "Please specify state",
                city        : "Please specify city",
                phone       : "Please specify valid phone number",
                email   : {
                    email: "Please specify a valid email address"
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

    var runMedicalHistoryValidator = function () {
        var form2           = $('#addPatientMedicalHistory');
        var errorHandler2   = $('.errorHandler', form2);
        var successHandler2 = $('.successHandler', form2);

        $.validator.addClassRules('illness_name', {
            required: true ,
           
        });
        /*$.validator.addClassRules('surgicalhistory', {
            required: true ,
           
        });

        $.validator.addClassRules('medication-drug-allergy', {
            required: true ,
            
        });
        $.validator.addClassRules('reaction-drug-allergy', {
            required: true ,
            
        });
*/
       
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
                menarche: {
                    number : true
                },
                menopause: {
                    number : true,
                },
                
                
               
                
            },
            messages: {
                menarche    : "Please specify a valid number",
                menopause   : "Please specify a valid number",
                
                
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
        var form2           = $('#addPatientObstetricsHistory');
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
        }, "Please specify lmp flow");   
*/
       /* $.validator.addMethod("checkEmptyLmpFlow", function(value, element, arg){
            console.log("Arg"+arg);
            console.log("Val"+value);
          //if(arg=='' && dateVal==)
           var dateVal = $("#last_mensus_date").val();

           if(arg==''){
                return true;
           }
        }, "Please specify lmp flow");  */
       

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
               
               
                married_life  :   { number : true },
                gravida : { number : true },
                /*para : { number : true },*/
                living : { number : true },
                abortion : { number : true },
                /*lmp_flow : { checkEmptyLmpFlow :function(){
                           return( $("#last_mensus_date").val());
                }

                 },*/
               
                'days[]' : { number : true },
                'cycle[]' : { number : true },
                'years[]' : { number : true },
                'weeks[]' : { number : true },
                
                
            },
            messages: {
               
                married_life  : "Please specify a valid number",
                gravida : "Please specify a valid number",
                para : "Please specify a valid number",
                living : "Please specify a valid number",
                abortion : "Please specify a valid number",
                'days[]' : "Please specify a valid number",
                'cycle[]' : "Please specify a valid number",
                'years[]' : "Please specify a valid number",
                'weeks[]' : "Please specify a valid number",
                
               
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


    var runIllnessAddMore = function () {


       
    }; 

    var runSurgeryAddMore = function () {

            $('.btn-add-surgery').click(function(e){
                e.preventDefault();
                $('#surgery').append('<div class="form-group dd_col_size">' + 
                                        '<div class="col-sm-11">' +
                                            '<span class="">' +
                                                '<input type="text" name="surgery[]" class="form-control surgicalhistory" placeholder="Surgery">' +
                                                '' +
                                            '</span>' +
                                        '</div>'+
                                        '<div class="col-sm-1">' +
                                            '<button name="btn-surgery-remove" class="btn btn-danger btn-surgery-remove dd_right " id="btn-surgery-remove">x</button' +
                                        '</div>' +  
                                     '</div>'

                );


                $('.btn-surgery-remove').click(function(e){
                    e.preventDefault();
                    var clickedElements = $(this).closest('.form-group');
                    console.log(clickedElements);
                    clickedElements.remove();   
                })

            });
    };

    var runAllergyAddMore = function(){
        $('.btn-add-allergies').click(function(e){
                e.preventDefault();
                //counter ++;
                $('#allergy').append('<div class="form-group">' +
                                        '<div class="col-sm-6">'+
                                        '<div class="dd_top_mt">Medication</div>'+

                                                '<span class="">' +
                                                    '<input type="text" name="medication-drug-allergy[]" class="form-control medication-drug-allergy",placeholder = "Medication" />' +
                                                '</span>' +
                                            '</div>'    +
                                             ' <div class="dd_col_size">'+
                                            ' <div class="col-sm-5">'+
                                            '<div class="dd_top_mt">Reaction</div>'+
                                                    '<span class="">' +
                                                        '<input type="text" name="reaction-drug-allergy[]" class="form-control reaction-drug-allergy",placeholder = "Reaction" />' +
                                                    '</span>' +
                                            '</div>'    +
                                             '</div>'    +
                                             ' <div class="dd_col_size">'+
                                            ' <div class="col-sm-1">'+
                                                '<button class="btn btn-danger btn-allergy-remove dd_right dd_mg_25 ">x</button>'+
                                            '</div>' +
                                             '</div>' +
                                    '</div>'

                            );


                $('.btn-allergy-remove').click(function(e){
                    e.preventDefault();
                    var clickedElements = $(this).closest('.form-group');
                    //console.log(clickedElements);
                    clickedElements.remove();   
                })
                

            });
    };

    var runDiagnosisExamination = function () {
        var form2           = $('#addPatientExamination');
        var errorHandler2   = $('.errorHandler', form2);
        var successHandler2 = $('.successHandler', form2);

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
               
               
                weight  :   { number : true },
                height  : { number : true },
               // systolic_pressure    : { number : true, range:[57,200] },
                //diastolic_pressure    : { number : true, range:[40,120] },
                pulse : { number:true, range:[40,220]},
                respiratory_rate : { number:true, range:[12,50]},
                temperature : { number:true, range:[75,111.2]},
                spo2 : { number:true, range:[55,100]},
                living : { number : true },
                abortion : { number : true },
                'days[]' : { number : true },
                'cycle[]' : { number : true },
                'years[]' : { number : true },
                'weeks[]' : { number : true },
                gestational_age : { number : true }
                
            },
            messages: {
               
                weight  : "Please specify a valid number",
                height : "Please specify a valid number",
                para : "Please specify a valid number",
                living : "Please specify a valid number",
                abortion : "Please specify a valid number",
                'days[]' : "Please specify a valid number",
                'cycle[]' : "Please specify a valid number",
                'years[]' : "Please specify a valid number",
                'weeks[]' : "Please specify a valid number",
                 gestational_age : "Please specify a valid number",
               
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

    var runBmiCalculation = function () {

        var weight = $('#weight').val();
        var height = $('#height').val();


      

        $('#weight,#height').on('input',function() {
            var weight = $('#weight').val();
            var height = $('#height').val();
            var heightSquare = Math.pow(parseInt(height)*0.01,2);
            var bmi = Math.round(parseInt(weight)/heightSquare);
            $('#bmi').val(bmi);
        }) ;

      /*   $('#weight,#height').keypress(function(){
            var we = $('#weight').val();
            var he = $('#height').val();
            $('#bmi').val(parseInt(we) + parseInt(he));
        }) ;*/


    };


    var runPatientPrescMedicineValidator = function () {
        var form2           = $('#addPatientPrescMedicine');
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
               
               
                /*'drugs'   :   { needsSelection: true, required:true },*/
                'drugs[]' :   {  required:true },
                'dosage[]'  :   {  required:true },
                'start_date[]'   :   {  required:true },
                'frequency1[]' :    {  required:true },
                /*'followup_date' : {  required:true },*/
                  
                
                
            },
            messages: {
               
                'drugs[]'  : "Please specify drug name", 
                'dosage[]' :   "Please specify dosage",
                'start_date[]'    :    "Please specify medicine start date",
                 'frequency1[]' : "Please choose atleast one frequency",
                 /*'followup_date' : "Please specify followup date",*/
               
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
    var runPresentPastNotApplicable = function(){
        $('#noPresentPast').click(function(){
            if($('#noPresentPast').is(':checked')){
                //alert('checked');
               //$('input:radio[name="hypertension"]').filter('[value="NA"]').prop('checked', true);hypertension
               $('#present-past-check-value').val('NA');
               $('.illness_name').attr('disabled',true);
               $('.present-past-na').filter('[value="NA"]').prop('checked', true);
               $('.present-past-current').attr('disabled',true);
               $('.present-past-past').attr('disabled',true);
               $('.present-past-medication-empty').attr('disabled',true);
            }
            else{
                //alert('not checked');
                $('#present-past-check-value').val('');
                $('.illness_name').attr('disabled',false);
                $('.present-past-na').filter('[value="NA"]').prop('checked', false);
                $('.present-past-current').attr('disabled',false);
                $('.present-past-past').attr('disabled',false);
                $('.present-past-medication-empty').attr('disabled',false);
            }
        });
    }; 



    var runNoFamilyHistoryReport = function(){
         $('#noFamilyHistory').click(function(){
            if($('#noFamilyHistory').is(':checked')){
                $('.family-hypertension').prop('disabled',true);
                $('.family-diabetes').prop('disabled',true);
                $('.family-cancer').prop('disabled',true);
                $('.family-other').prop('disabled',true);
                $('.other-medical-history').prop('disabled',true);
                $('.family-history-na').prop('checked',true);
            }
            else{
                $('.family-hypertension').prop('disabled',false); 
                $('.family-diabetes').prop('disabled',false);
                $('.family-cancer').prop('disabled',false);
                $('.family-other').prop('disabled',false);
                $('.other-medical-history').prop('disabled',false);
                $('.family-history-na').prop('checked',false);
            }
        });
           
    };

    var runFamilyHistoryDetails = function(){

        $('.other-medical-history').prop('disabled', true);
        $('.other-allergy-text').prop('disabled', true);

        $('.family-other').click(function(){
            var closestElements  = $(this).closest('.form-group');
            if(closestElements.find('.family-other'). prop("checked") == true){
                closestElements.find('.other-medical-history').prop('disabled', false);
            }
            else{
                
                closestElements.find('.other-medical-history').prop('disabled', true);
            }    
        }); 

        var clicked  = $('.family-other').closest('.form-group');
            clicked.find('.family-other').each(function(index){
                
                if ($(this).prop('checked')==true){ 
                   //alert('checked');
                    
                   clicked.find('.other-medical-history').prop('disabled', false);
                }
                else{
                   // alert('not');
                   clicked.find('.other-medical-history').prop('disabled', true);
                }
        });  
         

        

       $('.family-history-na').each(function (index) {
        //alert(index);
        var clickedElements = $(this).closest('.form-group');
        
           if(clickedElements.find('.family-history-na'). prop("checked") == true){
            
                clickedElements.find('.family-hypertension').prop('checked', false);
                clickedElements.find('.family-hypertension').prop('disabled', true);

                clickedElements.find('.family-diabetes').prop('checked', false);
                clickedElements.find('.family-diabetes').prop('disabled', true);
                clickedElements.find('.family-cancer').prop('checked', false);
                clickedElements.find('.family-cancer').prop('disabled', true);
                clickedElements.find('.family-other').prop('checked', false);
                clickedElements.find('.family-other').prop('disabled', true);
                clickedElements.find('.other-medical-history').prop('disabled',true);
           }
           else{
                clickedElements.find('.family-hypertension').prop('disabled', false);
                clickedElements.find('.family-diabetes').prop('disabled', false);
                clickedElements.find('.family-cancer').prop('disabled', false);
                clickedElements.find('.family-other').prop('disabled', false);
                clickedElements.find('.other-medical-history').prop('disabled',false);
           }
        });

        $('.family-history-na').click(function(){

             var closestElements  = $(this).closest('.form-group');
                //console.log(closestElements);
            if($(this). prop("checked") == true){
                //alert("checked");
               
                closestElements.find('.family-hypertension').prop('checked', false);
                closestElements.find('.family-hypertension').prop('disabled', true);

                closestElements.find('.family-diabetes').prop('checked', false);
                closestElements.find('.family-diabetes').prop('disabled', true);
                closestElements.find('.family-cancer').prop('checked', false);
                closestElements.find('.family-cancer').prop('disabled', true);
                closestElements.find('.family-other').prop('checked', false);
                closestElements.find('.family-other').prop('disabled', true);
                closestElements.find('.other-medical-history').prop('disabled',true);
            }
            else{
                //alert("not checked");
                
                closestElements.find('.family-hypertension').prop('disabled', false);
                closestElements.find('.family-diabetes').prop('disabled', false);
                closestElements.find('.family-cancer').prop('disabled', false);
                closestElements.find('.family-other').prop('disabled', false);
                closestElements.find('.other-medical-history').prop('disabled',true);
            }    
            //console.log();
            
        });

       /* $('.other-allergy').click(function(){
            var closestElements  = $(this).closest('.form-group');
                console.log(closestElements);
            if($('.other-allergy').is(':checked')){
                
                closestElements.find('.other-allergy-text').prop('disabled', false);
            }
            else{
                closestElements.find('.other-allergy-text').prop('disabled', true);
            }    
        });*/
        

        

    }; 
    var runSurgicalHistoryDetails = function(){
        $('#noSurgicalHistory').click(function(){
            if($('#noSurgicalHistory').is(':checked')){
                $('.surgicalhistory').prop('disabled', true);
               
            }
            else{
                $('.surgicalhistory').prop('disabled', false);
            }
        });
    } 
    var runAllergyHistoryDetails = function(){
        $('#noDrugAllergy').click(function(){
            //var closestElements  = $(this).closest('.form-group');
            //console.log(closestElements);
            if($('#noDrugAllergy').is(':checked')){
                $('.medication-drug-allergy').prop('disabled', true);
                $('.reaction-drug-allergy').prop('disabled', true);
            }
            else{
               $('.medication-drug-allergy').prop('disabled', false); 
               $('.reaction-drug-allergy').prop('disabled', false);
            }

        });

         $('#noAllergyHistory').click(function(){
            //var closestElements  = $(this).closest('.form-group');
            //console.log(closestElements);
            if($('#noAllergyHistory').is(':checked')){
                $('.allergy_general').prop('disabled', true);
                //$('.reaction-drug-allergy').prop('disabled', true);
            }
            else{
                $('.allergy_general').prop('disabled', false);
            }

        });
    };

    var runSocialHistoryDetails = function(){
        $('#noSocialHistory').click(function(){
            //var closestElements  = $(this).closest('.form-group');
            //console.log(closestElements);
            if($('#noSocialHistory').is(':checked')){
                $('.social-history').prop('disabled', true);
                $('.social-history-na').prop('checked', true);
                //$('.reaction-drug-allergy').prop('disabled', true);
            }
            else{
                $('.social-history').prop('disabled', false);
                $('.social-history-na').prop('checked', false);
            }

        });
    }; 

    var runPrescription = function(){
        //console.log($('.presc-medicine').find('.presc-table').length);
        
            var defaultDivCount = $('.presc-medicine').find('.presc-table').length;

  

     

            $('.add-instruction-btn1').click(function(e){
                e.preventDefault();


                $('.instruction1').show();
                var clickedElement = $(this).closest('.presc-table');
                console.log(clickedElement);
                clickedElement.find('.add-instruction-btn1').hide();
                clickedElement.find('.remove-instruction-btn1').show();
                        
              
            });

            $('.remove-instruction-btn1').click(function(e){
                e.preventDefault();
                
                $('.instruction1').hide();
                var clickedElement = $(this).closest('.presc-table');
                    clickedElement.find('.add-instruction-btn1').show();
                    clickedElement.find('.remove-instruction-btn1').hide();
                      
              
            });

    };

   
    return {
        //main function to initiate template pages
        init: function () {
            //runInputLimiter();
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
            runAge();
            runTrimmedPatientPersonalInformation();
            runValidator2();
            runPatientObstetricsHistoryValidation();
            runMedicalHistoryValidator();
            runIllnessAddMore();
            runSurgeryAddMore();

            runAllergyAddMore();
            runDiagnosisExamination();
            runBmiCalculation();
            //runValidator3();
            runCountryCityState();
            //runAddMoreFunctions();
            runPresentPastNotApplicable();
            runNoFamilyHistoryReport();
            runFamilyHistoryDetails();
            runSurgicalHistoryDetails();
            runAllergyHistoryDetails();
            runSocialHistoryDetails();
            runDoctorsHomeValidator();
            runPatientDiagnosisValidator();
            runPatientDiagnosisValidator2();
            runPatientPrescMedicineValidator();
            
            runPrescription();
            //runDataTable();
           
        }
    };
}();