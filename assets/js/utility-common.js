var utilityCommonElements = function () {
    var runLoader = function(){
       
        $(window).load(function() {
                $(".loader").fadeOut("slow");
        });
    }
    var getCountryStateList = function(){
       
       /* $( "#country option:selected" ).val('101').text('India');*/

                /*Dynamically adding state responding to country and also keeping selected value of state*/
                var stateHidden = $('#state-hidden').val();
                var countryId  = $( "#country option:selected" ).val();
                //alert(country);
                $.ajax({
                    type: "POST",
                    url: "../getState",
                    data: "country_id="+ countryId ,
                    success: function(data){
                        $('#state').empty();
                        for(var s=0;s<data.length;s++){

                            $('#state').append('<option>'+data[s].state_name+'</option>');
                            $('#state').val(stateHidden).attr("selected", "selected");

                        }
                    }
                });


                $('#country').change(function(){
                    var countryId  = $( "#country option:selected" ).val();
                    //alert(country);
                    $.ajax({
                        type: "POST",
                        url: "../getState",
                        data: "country_id="+ countryId ,
                        success: function(data){
                            $('#state').empty();
                            for(var s=0;s<data.length;s++){

                                 //console.log(data[s].state_name);


                                $('#state').append('<option>'+data[s].state_name+'</option>');


                            }
                        }
                    });
                });
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

        
   
    return {
        //main function to initiate template pages
        init: function () {
            getCountryStateList();
            runLoader();
            runAge();
            
        }
    };
}();