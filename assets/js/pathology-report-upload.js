var reportUploadElements = function () {

	var reportUpload = function(){

    $('.fileinput-upload-button').hide();
    //$('.fileinput-remove-button').hide();
		
		$('.fileinput-upload').click(function(e){
			e.preventDefault();
			//console.log('sds')
			//alert('ds');

		});
		

	};
	var runreportValidation = function () {
        
        var form2           = $('#addPathologyReportUpload');
        var errorHandler2   = $('.errorHandler', form2);
        var successHandler2 = $('.successHandler', form2);
        
        $.validator.addMethod("formatcheck", function(value, element, arg){
            
          ext = $('#report_file').val().split('.').pop().toLowerCase();
          if(ext=="pdf")
          {
            
            return true;
          }
          else
          {
            
             return false;
          } 
        }, "Please select pdf files only!");
        
        $.validator.addMethod("testNotEquals", function(value, element, arg){
          return arg != value;
        }, "Please choose a test name");

        form2.validate({
            errorElement: "span", // contain the error msg in a small tag
            errorClass: 'help-block',
            errorPlacement: function (error, element) { 
            // render error placement for each input type
             if (element.attr("type") == "file" ) { // for chosen elements, need to insert the error after the chosen container
                    error.appendTo('.file-input');
                } else if (element.hasClass("ckeditor")) {
                    error.appendTo($(element).closest('.form-group'));
                } else {
                    error.insertAfter(element);
                    // for other inputs, just perform default behavior
                }
            }, 
            ignore: "",

            rules: {
                report_file  : "formatcheck",
                pathology_name : {
                    testNotEquals : 0
                },
                /*file  :   {"formatcheck",   required: true},*/
            },
            messages: {
               
                file  :{
                    /*required : "Please select a file to upload",*/
                } ,
               
               
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

                   ("#form2" ).submit();
                  /* ("#form2" ).submit(function( event ) {
                      //alert( "Handler for .submit() called." );
                      event.preventDefault(); 
                      //alert('sdsdsdss');
                }); */
                    
               
            }
        });
    };

    return {
        //main function to initiate template pages
        init: function () {
           reportUpload();
			runreportValidation();
           
        }
    };
}(); 
