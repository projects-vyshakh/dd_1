var generalSettings = function () {
	var runPrintSettings = function(){
		var defaultUnit = $('#unit').val();
		$('.print-unit').text(defaultUnit);
		$('#unit-loader').show();
		$('#unit').change(function(){
			$('#unit-values').hide();
			//$('#unit-loader').show();
			//$('#unit-loader').html("loading ...");
			$('#unit-loader').append('<img id="theImg" src="assets/images/db_fetch_loader.gif" />');
			 $.ajax({
                type: "POST",
                url: "fetchprintsetupdata",
                data: "" ,
                dataType: "json",
                success: function(data){
                    //console.log(data.id_reference_settings)
                    if(data!=""){
                    	//$('#unit-loader').hide();
                    	$('#theImg').remove();
                    	$('#unit-values').show();
                    }
                    var changedUnit = $('#unit').val();
					var defaultHiddenUnit = $('#default-unit').val();
					$('.print-unit').html(changedUnit);

					var marginTop 		= $('#top').val();
					var marginBottom 	= $('#bottom').val();
					var marginLeft 		= $('#left').val();
					var marginRight 	= $('#right').val();
					//alert(marginBottom);

					var marginTopDefault	= data.margin_top;//$('#top').val();
					var marginBottomDefault	= data.margin_bottom;//$('#bottom').val();
					var marginLeftDefault 	= data.margin_left;//$('#left').val();
					var marginRightDefault	= data.margin_right;//$('#right').val();

					switch(data.unit){
						case 'cm':
							marginTopDefault	= data.margin_top/36;
							marginBottomDefault	= data.margin_bottom/36;//$('#bottom').val();
							marginLeftDefault 	= data.margin_left/36;//$('#left').val();
							marginRightDefault	= data.margin_right/36;//$('#right').val();
						break;
						case 'inches':
							marginTopDefault	= data.margin_top/96;
							marginBottomDefault	= data.margin_bottom/96;//$('#bottom').val();
							marginLeftDefault 	= data.margin_left/96;//$('#left').val();
							marginRightDefault	= data.margin_right/96;//$('#right').val();
						break;
						case 'mm':
							marginTopDefault	= data.margin_top/4;
							marginBottomDefault	= data.margin_bottom/4;//$('#bottom').val();
							marginLeftDefault 	= data.margin_left/4;//$('#left').val();
							marginRightDefault	= data.margin_right/4;//$('#right').val();
						break;
						
					}

					unitConversion(defaultHiddenUnit,changedUnit,marginTop,marginBottom,marginLeft,marginRight,marginTopDefault,marginBottomDefault,marginLeftDefault,marginRightDefault);
                }
            });
			
			

			

			

		
		})
	};
	var unitConversion = function(defaultHiddenUnit,changedUnit,marginTop,marginBottom,marginLeft,marginRight,marginTopDefault,marginBottomDefault,marginLeftDefault,marginRightDefault){
		
		switch(defaultHiddenUnit){
			case 'cm':
				if(changedUnit=="cm"){

					$('#top').val(marginTopDefault);
					$('#bottom').val(marginBottomDefault);
					$('#left').val(marginLeftDefault);
					$('#right').val(marginRightDefault);
				}
				if(changedUnit=="mm"){
					marginTop 		=  Math.round(marginTopDefault*10);
					marginBottom 	=  Math.round(marginBottomDefault*10);
					marginLeft 		=  Math.round(marginLeftDefault*10);
					marginRight 	=  Math.round(marginRightDefault*10);
					//alert(marginBottom);
					$('#top').val(marginTop);
					$('#bottom').val(marginBottom);
					$('#left').val(marginLeft);
					$('#right').val(marginRight);
				}
				if(changedUnit=="inches"){
					marginTop 		=  Math.round(marginTopDefault*0.4);
					marginBottom 	=  Math.round(marginBottomDefault*0.4);
					marginLeft 		=  Math.round(marginLeftDefault*0.4);
					marginRight 	=  Math.round(marginRightDefault*0.4);

					$('#top').val(marginTop);
					$('#bottom').val(marginBottom);
					$('#left').val(marginLeft);
					$('#right').val(marginRight);
				}

			break;
			case 'mm':
				if(changedUnit=="cm"){
					marginTop 		=  Math.round(marginTopDefault*(1/10));
					marginBottom 	=  Math.round(marginBottomDefault*(1/10));
					marginLeft 		=  Math.round(marginLeftDefault*(1/10));
					marginRight 	=  Math.round(marginRightDefault*(1/10));

					$('#top').val(marginTop);
					$('#bottom').val(marginBottom);
					$('#left').val(marginLeft);
					$('#right').val(marginRight);
				}
				if(changedUnit=="inches"){
					marginTop 		=  Math.round(marginTopDefault*0.04);
					marginBottom 	=  Math.round(marginBottomDefault*0.04);
					marginLeft 		=  Math.round(marginLeftDefault*0.04);
					marginRight 	=  Math.round(marginRightDefault*0.04);

					$('#top').val(marginTop);
					$('#bottom').val(marginBottom);
					$('#left').val(marginLeft);
					$('#right').val(marginRight);
				}
				if(changedUnit=="mm"){
					
					$('#top').val(marginTopDefault);
					$('#bottom').val(marginBottomDefault);
					$('#left').val(marginLeftDefault);
					$('#right').val(marginRightDefault);
				}
				


			break;
			case 'inches':
				if(changedUnit=="cm"){
					marginTop 		=  Math.round(marginTopDefault*2.54);
					marginBottom 	=  Math.round(marginBottomDefault*2.54);
					marginLeft 		=  Math.round(marginLeftDefault*2.54);
					marginRight 	=  Math.round(marginRightDefault*2.54);

					$('#top').val(marginTop);
					$('#bottom').val(marginBottom);
					$('#left').val(marginLeft);
					$('#right').val(marginRight);
				}
				if(changedUnit=="mm"){
					
					marginTop 		=  Math.round(marginTopDefault*25.4);
					marginBottom 	=  Math.round(marginBottomDefault*25.4);
					marginLeft 		=  Math.round(marginLeftDefault*25.4);
					marginRight 	=  Math.round(marginRightDefault*25.4);

					$('#top').val(marginTop);
					$('#bottom').val(marginBottom);
					$('#left').val(marginLeft);
					$('#right').val(marginRight);
				}
				if(changedUnit=="inches"){
					$('#top').val(marginTopDefault);
					$('#bottom').val(marginBottomDefault);
					$('#left').val(marginLeftDefault);
					$('#right').val(marginRightDefault);
				}


			break;
		}
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
   
    var handlePrintSettingsValidations = function () {
        var form2           = $('#addPrintSettings');
        var errorHandler2   = $('.errorHandler', form2);
        var successHandler2 = $('.successHandler', form2);
       

        
       
        form2.validate({
            errorElement: "span", // contain the error msg in a small tag
            errorClass: 'help-block',
            errorPlacement: function (error, element) { // render error placement for each input type
                if (element.attr("type") == "checkbox" || element.attr("type") == "radio") { // for chosen elements, need to insert the error after the chosen container
                    error.insertAfter($(element).closest('.form-group').find('.error_div').last());
                } else if (element.hasClass("ckeditor")) {
                    error.appendTo($(element).closest('.form-group'));
                } else {
                    error.insertAfter(element);
                    // for other inputs, just perform default behavior
                }
            },
            ignore: "",
            rules: {
             	print_header : { 
             		required : true,
             	}
            },
            messages: {
              	print_header : { 
             		required : "Please choose an option",
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
     
    };

	return {
		//main function to initiate template pages
		init: function () {
		   runPrintSettings();
		   handlePrintSettingsValidations();
		   
		}
    };
}();