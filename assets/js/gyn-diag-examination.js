var gynDiagExamination = function () {	
	var runOnPageLoad = function () {
		$(window).load(function() {
				$(".loader").fadeOut("slow");
				
			});
	}
	var runBmiCalculation = function () {
		var weight = $('#weight').val();
        var height = $('#height').val();

        $('#weight,#height').on('input',function() {
            var weight = $('#weight').val();
            var height = $('#height').val();
            if(weight=='' || height==''){
                //alert('s')
                $('#bmi').val('');
            }
            else{
                var heightSquare = Math.pow(parseInt(height)*0.01,2);
                var bmi = Math.round(parseInt(weight)/heightSquare);
                $('#bmi').val(bmi);
            }
            
            
        }) ;

    };

    var runExaminationValidation = function () {
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
               
               
                weight  :   { number : true ,range:[10,635]},
                height  : { number : true ,range:[10,272]},
                systolic_pressure    : { number : true, range:[40,200] },
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
               
                weight  :{
                    number : "Please type a valid number",
                    range  : "Please type weight between 10 and 635"
                } ,
                height :{
                    number : "Please type a valid number",
                    range  : "Please type weight between 10 and 272"
                } ,
                para : "Please type a valid number",
                living : "Please type a valid number",
                abortion : "Please type a valid number",
                'days[]' : "Please type a valid number",
                'cycle[]' : "Please type a valid number",
                'years[]' : "Please type a valid number",
                'weeks[]' : "Please type a valid number",
                 gestational_age : "Please type a valid number",
               
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
	};

	return {
        //main function to initiate template pages
        init: function () {
        	runOnPageLoad();
         	runBmiCalculation();
         	runExaminationValidation();
            
           
           
        }
    };
}(); 
