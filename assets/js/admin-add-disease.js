var adminAddDisease = function () {

    var runOnPageLoad = function () {
        $(window).load(function() {
                $(".loader").fadeOut("slow");
                
            });   
    }
    var runDiseaseValidation = function () {
        
        var form2           = $('#importdiseaserecord');
        var errorHandler2   = $('.errorHandler', form2);
        var successHandler2 = $('.successHandler', form2);
        
        $.validator.addMethod("formatcheck", function(value, element, arg){
            
            ext = $('#file').val().split('.').pop().toLowerCase();
          if(ext=="csv")
          {
            
            return true;
          }
          else
          {
            
             return false;
          } 
        }, "Please select csv files only!");
        /*$.validator.addMethod("formatcheck", function(value, element){
            var ext="";
       $('#file').change(function(){

            // var amiChecked="";
        ext = $('#file').val().split('.').pop().toLowerCase();
           console.log(ext);
           });
          if(ext=="csv")
          {
            console.log("success");
            return true;
          }
          else
          {
             console.log("failer");
             return false;
          }
        },"Please select csv files only!");*/

        form2.validate({
            errorElement: "span", // contain the error msg in a small tag
            errorClass: 'help-block',
            errorPlacement: function (error, element) { 
            // render error placement for each input type
             if (element.attr("type") == "file" ) { // for chosen elements, need to insert the error after the chosen container
                    error.appendTo('.format-error');
                } else if (element.hasClass("ckeditor")) {
                    error.appendTo($(element).closest('.form-group'));
                } else {
                    error.insertAfter(element);
                    // for other inputs, just perform default behavior
                }
            }, 
            ignore: "",

            rules: {
                file  : "formatcheck",
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

    /*var runfileformatValidation= function() {

        $('#file').change(function(){
             var amiChecked="";
           var ext = $('#file').val().split('.').pop().toLowerCase();
          if(ext=="csv")
          {
            return true;
          }
          else
          {
            $(".panel-hide").hide();
          }*/
           /* $(".teeths").each(function(){
             if($(this).is(':checked')){
                amiChecked="checked";
                
            }
         });
       if(amiChecked=="checked") {
        //alert('hi');
            $('div.test').hide();
            return true;
       } else {
            $('div.test').show();
            return false;
       }
    });
    }*/
    


    return {
        //main function to initiate template pages
        init: function () {
            runOnPageLoad();
            
            runDiseaseValidation();
          //  runfileformatValidation();
           
           
        }
    };
}(); 
