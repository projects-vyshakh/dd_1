var patientPrescMedicine = function () {
	var runPrescriptionData = function(){

		var formData = $('#addPatientPrescMedicine').serializeArray();
		console.log(formData);

		$('.presc-save').click(function(e){
			e.preventDefault();
		})
		
			 /*$.ajax({
                type: "POST",
                url: "fetchprintsetupdata",
                data: "" ,
                dataType: "json",
                success: function(data){
                   
						
					}

					
                }
            });*/
			
			

			

			

		
	};
	


	return {
		//main function to initiate template pages
		init: function () {
		   runPrescriptionData();
		   
		}
    };
}();