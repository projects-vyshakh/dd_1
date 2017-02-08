var pediaDiagExamination = function () {

    var runOnPageLoad = function () {
        $(window).load(function() {
                $(".loader").fadeOut("slow");
                
            });
        
    }
    /*var runExaminationValidation2 =function() {
        $.validator.addMethod('teeths', function(value) {
    return $('.teeths:checked').size() > 0;
}, 'Please check at least one box.');

var checkboxes = $('.teeths');
var checkbox_names = $.map(checkboxes, function(e, i) {
    return $(e).attr("name")
}).join(" ");

$("#teeths").validate({
    groups: {
        checks: checkbox_names
    },
    errorPlacement: function(error, element) {
       alert('hi');
         if (element.attr("name") == "upperright[]") error.insertBefore(checkboxes.first());
        else error.insertAfter(element);
    }
        
});
    }*/

    var runExaminationValidation = function () {
        
        var form2           = $('#addPediaExamination');
        var errorHandler2   = $('.errorHandler', form2);
        var successHandler2 = $('.successHandler', form2);
        var amiChecked="Notchecked";
        /*$.validator.addMethod("checkedOrNot",function(value,element){
                alert(value);
                alert(element)
                ///alert(checkedOrNot)
        },"Enter only characters from A-z");*/
        

        $.validator.addMethod("Check", function(value, element){
       if (!$("#plaqueyes:checked").val()) {
          $(".panel-hide").hide();
          $('div.test').hide();
          amiChecked="checked";
           return true;
   
}
else{
  $(".teeths").each(function(){

             if($(this).is(':checked')){
                amiChecked="checked";
                return true;
            }
         });
    }

           
           if(amiChecked=="checked"){
             console.log('amiChecked');
             return true;
            }
            else
            { 
                $('div.test').show();
               console.log('Not checked');
                return false;
            }
        },"You must select at least one!");

        form2.validate({
            errorElement: "span", // contain the error msg in a small tag
            errorClass: 'help-block',
            errorPlacement: function (error, element) { 
            // render error placement for each input type
             if (element.attr("name") == "test") { // for chosen elements, need to insert the error after the chosen container
                 
                  error.insertBefore(element);
                }
                else if (element.attr("type") == "radio" || element.attr("type") == "checkbox") { // for chosen elements, need to insert the error after the chosen container
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

                weight  :   { number : true ,range:[0,200]},
                height  : { number : true ,range:[10,272]},
                heartrate : { number : true ,range:[40,220]},
                respiratory_rate : { number:true, range:[12,50]},
                temperature : { number:true, range:[75,111.2]},
                pallor : { },
                clubbing :{ },
                /*"upperleft[]":{
                    checkedOrNot : "checked"
                }*/
                /* test : {
                    Check : 0
                },
                */
                test: "Check",
               /* "upperleft[]":"Check",
                "upperright[]":"Check",
                "lowerright[]":"Check",
                "lowerleft[]":"Check",*/
            /*teeths:{
                $('.teeths').each(function(){
            
            if($(this).is(':checked')){
                validate="checked";
                console.log(validate);
            }
            required: true,
            minlength: 1 
        }
        },*/
       
            },
            messages: {
               
                weight  :{
                    number : "Please type a valid number",
                    range  : "Please type weight between 0 and 200"
                } ,
                height :{
                    number : "Please type a valid number",
                    range  : "Please type height between 10 and 272"
                } ,
                heartrate :{
                    number : "Please type a valid number",
                    range  : "Please type pulse between 40 and 220"
                } ,
                respiratory_rate :{
                    number : "Please type a valid number",
                    range  : "Please type weight between 12 and 50"
                } ,
                temperature :{
                    number : "Please type a valid number",
                    range  : "Please type weight between 75 and 111.2"
                },
              /*teeths:{ 
                    required : "Please select at least one teeth"
                }    */     

               
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

    var runPlaqueyesExtended = function(){  
       $('#plaqueyes').click(function()
       {
            $(".panel-hide").show();
           $('.teeths').attr('disabled',false);
          
       });
       $('#plaqueno').click(function()
       {
             $('.teeths').attr('disabled',true);
             $(".panel-hide").hide();
          
       });
        
    };

    var runCheckboxValidation= function() {

        $('.teeths').change(function(){
             var amiChecked="";
           //  alert('hi');
            $(".teeths").each(function(){
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
    $('#plaqueno').click(function() {
          //   alert('No checked');
            if($(this).is(':checked'))
            {
               $('div.test').hide();
              var  amiChecked="checked";
                  return true;
            }
        });
    $('#plaqueyes').click(function() {
           //  alert('Yes checked');
            if($(this).is(':checked'))
            {
                var amiChecked="";
                $(".teeths").each(function(){
                if($(this).is(':checked')){
                amiChecked="checked";
                
            }
         });
       if(amiChecked=="checked") {
        //alert('hi');
            $('div.test').hide();
            //return true;
       } else {
           $('div.test').show();
            //return false;
       }
            }
        });
     
     


if (!$("#plaqueyes:checked").val()) {
    if (!$("#plaqueno:checked").val()){
        // alert('Nothing is checked!');
          $(".panel-hide").hide();
          $('div.test').hide();
    }
    else
    {
      //  alert('No is checked!');
         $(".panel-hide").hide();
    }
   
}
else{
  //  alert('Yes is checked!');
     $(".panel-hide").show();
    }
  
    
}
  

    return {
        //main function to initiate template pages
        init: function () {
            runOnPageLoad();
            //runBmiCalculation();
            runExaminationValidation();
            runPlaqueyesExtended();
           // runExaminationValidation2();
           runCheckboxValidation();
           
           
        }
    };
}(); 
