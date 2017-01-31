var masterElements = function () {
    var runTopmenuResp = function(){
        $('#patient-menu-div').hide();
        $('#diagnosis-menu-div').hide();
        $('#prescription-menu-div').hide();

        $('#patient-menu').click(function(e){
            var screenWidth = $( document ).width();
            if(screenWidth<=768){
                e.preventDefault();
                $('#diagnosis-menu-div').hide();
                $('#prescription-menu-div').hide();
                $('#patient-menu-div').toggle();

            }
            else{
                window.href="patientpersonalinformation";
            }

        });
        
        $('#diagnosis-menu').click(function(e){
            var screenWidth = $( document ).width();
            if(screenWidth<=768){
                e.preventDefault();
                $('#patient-menu-div').hide();
                $('#prescription-menu-div').hide();
                $('#diagnosis-menu-div').toggle();

            }
            else{
                window.href="patientexamination";
            }

        });

        $('#prescription-menu').click(function(e){

            
                var screenWidth = $( document ).width();
                if(screenWidth<=800){
                    e.preventDefault();
                    $('#patient-menu-div').hide();
                    $('#diagnosis-menu-div').hide();
            
                    $('#prescription-menu-div').toggle();


                }
                else{
                    $('.sub-menu').css({ display: "none" });
                    window.href="patientprescmanagement";
                }

            

        });
      
   

    };

    var runUserMenuResponse = function(){
        //$('#user_respo_home_menu').hide();
        var screenWidth = $( document ).width();
            
            if(screenWidth<768){
                $('#user_respo_menu').show();
            }
            else{
                //$('#user_respo_home_menu').hide();
            }

    };
    

   
    return {
        //main function to initiate template pages
        init: function () {
           runTopmenuResp();
           runUserMenuResponse();
        }
    };
}();