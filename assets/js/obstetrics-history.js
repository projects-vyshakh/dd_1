var obstetricsElements = function () {

	

	var runObsDatePickers = function () {

        $('#obs_lmp_date').Zebra_DatePicker({
   				direction: -1,
   				icon_position : 'left',
   				inside : true,
   				show_icon : false
   		});

   		$('#last_delivery_date').Zebra_DatePicker({
   				direction: -1,
   				icon_position : 'left',
   				inside : true,
   				show_icon : false
   		});  

   		/*$('#expected_delivery_date').Zebra_DatePicker({
            icon_position : 'left',inside : true
        });*/
    };

    var runDeliveryDateAutoGenerate = function(){

    	$('.auto-generate-deliverydate').click(function(e){
    		e.preventDefault();
    		var lmpDate = $('#obs_lmp_date').val();

    		if(lmpDate==null || lmpDate==''){
    			bootbox.dialog({
						message		: "Lmp date is empty. Please fill lmp date",
						title 		: "Warning",
						buttons 	: 
						{
							success : 
							{
								label 		: "Ok",
								className	: "btn-success",
								callback 	: function() 
								{
									$('#obs_lmp_date').focus();
									//$('#obs_lmp_date').css({"border":"1px solid red"});
								}
							}
						}
				});
    		}
    		else{

    			var lmpDate 				=  $('#obs_lmp_date').val();
               	var lmpDateFormatted  		= new Date(lmpDate);
				var setExpectedDate 		= lmpDateFormatted.setDate(lmpDateFormatted.getDate()+280); 
               	var expectedDateFormatted 	= new Date(setExpectedDate);
               	//alert(newEdd)
               	var day 	= expectedDateFormatted.getDate();
                var month 	= expectedDateFormatted.getMonth() + 1;
                var year  	= expectedDateFormatted.getFullYear();
                var newDate = day+"-"+month+"-"+year;

               	var expectedDeliveryDate = moment(newDate, "DD/MM/YYYY").format("YYYY-MM-DD");
               	$('#expected_delivery_date').val(expectedDeliveryDate);
               	
    		}	
    		
    	});

    };

   var runMenstrualHistoryValidation = function () {
   	
       var form2 			= $('#addPatientObstetricsHistory');
        var errorHandler2 	= $('.errorHandler', form2);
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
            	married_life  :   
                { 
                    number : true,
                    range : [1,99],
                },
                gravida : { 
                    number : true,
                    range : [1,99],
                },
                /*para : { number : true },*/
                living : { 
                    number : true,
                    range : [1,99],
                },
                abortion : { 
                    number : true,
                    range : [1,99],
                },
                obs_lmp_days : {
                	number : true,
                    range: [1,99],
                },
                obs_lmp_cycle: {
                	number : true,
                    range: [1,99],
                },
                /*'years[]' : {
                	number : true,
                    range: [1,99],
                },
                'months[]' : {
                	number : true,
                    range: [1,12],
                },
                'weeks[]' : {
                	number : true,
                    range: [1,99],
                }*/
            },
            messages: {
            	married_life    : 
                {
                    number : "Please type a valid number",
                    range  : "Please type married life between 1 - 99",
                },
                gravida : 
                {
                    number : "Please type a valid number",
                    range  : "Please type gravida between 1 - 99",
                },
                /*para : "Please type a valid number",*/
                living          : 
                {
                    number : "Please type a valid number",
                    range  : "Please type living between 1 - 99",
                },
                abortion        : 
                {
                    number : "Please type a valid number",
                    range  : "Please type abortion between 1 - 99",
                },
                obs_lmp_cycle: 
                {
                	number : "Please type a valid number",
                	range  : "Please type cycle between 1 - 99",
                },
                obs_lmp_days: 
                {
                	number : "Please type a valid number",
                	range  : "Please type days between 1 - 99",
                },
                /*'years[]' : {
                	number : "Please type a valid number",
                	range  : "Please type year between 0 - 99",
                },
                'months[]' : {
                	number : "Please type a valid number",
                	range  : "Please type month between 1 - 12",
                },
                'weeks[]' : {
                	number : "Please type a valid number",
                	range  : "Please type week between 0 - 99",
                }*/
                
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
                form2.submit();
            }
        });
        
    };


	return {
        //main function to initiate template pages
        init: function () {
            runObsDatePickers();
            runDeliveryDateAutoGenerate();
            runMenstrualHistoryValidation();
            //runAddMorePregnancy();
        }
    };
}();



