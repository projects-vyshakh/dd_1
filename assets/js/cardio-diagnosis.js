var cardioDiagnosisElements = function (dosageUnit) {
	
    
    var runCardioDiagnosisValidation = function(){

    	$("#addCardiacExamination").validate({
	    	rules: {
	          	weight: 
	          	{ 
	          		digits:true,
	          		maxlength : 3
	          	},
	           	height: { digits:true },
	            systolic_pressure: 
				{ 
					digits:true, 
					required: true,
					range:[57,200]
				},
	           	diastolic_pressure: 
				{ 
					digits:true, 
					required: true,
					range:[40,120]
				},
	           	
	           	pulse : { number:true, range:[40,220]},
	            respiratory_rate : { number:true, range:[12,50]},
	            temperature : { number:true, range:[75,111.2]},
	            spo2 : { number:true, range:[55,100]},
	           
	            
	        },
	        tooltip_options: {
	           	weight: 
	           	{ 
	           		placement: 'top' ,

	           	},
	           	height: 
	           	{
	           		 placement: 'top' 
	           	},
	           systolic_pressure: { placement: 'bottom' },
	           diastolic_pressure: { placement: 'bottom' },
	           pulse : { placement: 'top' },
	           temperature : { placement: 'left' },
	           spo2: { placement: 'bottom' },
	        },
	        messages: {
	            weight: 
	           	{ 
	           		maxlength : "Not exceeds more than 3 numbers"

	           	},
	           	height: 
	           	{ 
	           		maxlength : "Not exceeds more than 3 numbers"

	           	},
	        },
	        /*rules: {
	            height: { required: true},
	            weight: {required: true}
	        },
	        messages: {
	            example5: "Just check the box<h5 class='text-danger'>You aren't going to read the EULA</h5>"
	        },
	        tooltip_options: {
	            height: {trigger:'focus'},
	            weight: {placement:'left',html:true}
	        },*/
	    });

	};

   
	
	
	return {
        //main function to initiate template pages
        init: function () {
         
            runCardioDiagnosisValidation();
    		
           
        }
    };
}();
