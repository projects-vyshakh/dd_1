var doctorAuthorize = function () {
	var runOnPageLoad = function(){

	}
	
	var doctorAuthorizeTable = function(){
				//$('#search_patient_table').show();



        $('#search_patient_table').dataTable({
             "bProcessing": true,
             "sAjaxSource":"handleDoctorAuthorize",
             "bDestroy": true,
             "bPaginate": true,
             "bAutoWidth": true,
             "select" : true,
             /*"fnServerParams": function (aoData) {
			    //var date = getDate();
			    var doctorId   = $('.searchby_id').val();
			    var doctorName = $('.searchby_name').val();
			    aoData.push({ "name": "searchby_id", "value": doctorId },
			    			{ "name": "searchby_name", "value": doctorName });
			  },*/
								   
             "aoColumns": [
                    { mData: 'id_doctor' } ,
                    { mData: 'first_name' },
                    { mData: 'middle_name' },
                    { mData: 'specialization_name' },
                    { mData: 'phone' },
                    { mData: 'email' },
                    { mData: 'registration_status' }
            ],
            
   		});

       
		
	}
	return {
		//main function to initiate template pages
		init: function () {
			runOnPageLoad();

			doctorAuthorizeTable();
		   
		   
		}
    };
}(); 
