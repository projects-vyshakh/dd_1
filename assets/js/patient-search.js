var patientSearch = function () {
	var runOnPageLoad = function(){

	}
	var searchPatient = function(){
			
			$('#search').click(function(e){
				e.preventDefault();
			

				$('#search_patient_table').show();

		        $('#search_patient_table').dataTable({
	                 "bProcessing": true,
	                 "sAjaxSource":"handleSearchPatient",
	                 "bDestroy": true,
	                 "fnServerParams": function (aoData) {
					    //var date = getDate();
					    var patientId   = $('.searchby_id').val();
					    var patientName = $('.searchby_name').val();
					    aoData.push({ "name": "searchby_id", "value": patientId },
					    			{ "name": "searchby_name", "value": patientName });
					  },
										   
	                 "aoColumns": [
	                        { mData: 'id_patient' } ,
	                        { mData: 'first_name' },
	                        { mData: 'middle_name' },
	                        { mData: 'gender' },
	                        { mData: 'age' },
	                        { mData: 'phone' },
	                        { mData: 'email' }
	                ]
	       		});

		        


			});

	        




		
	}
	return {
		//main function to initiate template pages
		init: function () {
			runOnPageLoad();
			searchPatient();
		   
		   
		}
    };
}(); 
