var doctorSearch = function () {
	var runOnPageLoad = function(){

	}
	
	var searchPatient = function(){
			
			$('#search').click(function(e){
				e.preventDefault();
			

				$('#patient_list_div').show();


			var oTable =  $('#search_patient_table').dataTable({
	        	"responsive": true,
	        	"bPaginate" : true,
	        	"bFilter": true,
	        	"bInfo": true,
	        	"bProcessing": true,
	            "sAjaxSource":"handleSearchDoctor",
	            "bDestroy": true,
	            /*"iDisplayLength": 10,*/
	            "bLengthChange": true,
	            "bAutoWidth": false,
	            
				
	            "fnServerParams": function (aoData) {
				    //var date = getDate();
				    var patientId   = $('.searchby_id').val();
				    var patientName = $('.searchby_name').val();
				    aoData.push({ "name": "searchby_id", "value": patientId },
				    			{ "name": "searchby_name", "value": patientName });
				},
            	"fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
			        if(aData['8'] >= 100 ) {
			          $(nRow).css('color', 'blue').css('font-weight', 'bold');
			        } 
			        else if(aData['8'] <= -100 ) {
			          $(nRow).css('color', 'Red').css('font-weight', 'bold');
			        }
				},
				"aoColumnDefs": [{
               	 	"aTargets": [0]
            	}],
				"aoColumns": [
	                       { mData: 'id_doctor' } ,
	                        { mData: 'first_name' },
	                        { mData: 'middle_name' },
	                        { mData: 'gender' },
	                        { mData: 'specialization_name' },
	                        { mData: 'phone' },
	                        { mData: 'email' }
	            ],
       		});

			

				/*$('#search_patient_table').show();

		        $('#search_patient_table').dataTable({
	                 "bProcessing": true,
	                 "sAjaxSource":"handleSearchDoctor",
	                 "bDestroy": true,
	                 "fnServerParams": function (aoData) {
					    //var date = getDate();
					    var doctorId   = $('.searchby_id').val();
					    var doctorName = $('.searchby_name').val();
					    aoData.push({ "name": "searchby_id", "value": doctorId },
					    			{ "name": "searchby_name", "value": doctorName });
					  },
										   
	                 "aoColumns": [
	                        { mData: 'id_doctor' } ,
	                        { mData: 'first_name' },
	                        { mData: 'middle_name' },
	                        { mData: 'gender' },
	                        { mData: 'specialization_name' },
	                        { mData: 'phone' },
	                        { mData: 'email' }
	                ]
	       		});*/

		        


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
