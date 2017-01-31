var patientSearch = function () {
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
	            "sAjaxSource":"handleSearchPatient",
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
	                        { mData: 'id_patient' } ,
	                        { mData: 'first_name' },
	                        { mData: 'middle_name' },
	                        { mData: 'gender' },
	                        { mData: 'age' },
	                        { mData: 'phone' },
	                        { mData: 'email' }
	            ],
       		});






		        /*$('#search_patient_table').dataTable({
		        	"responsive": true,
		        	"bPaginate" : true,
		        	"bFilter": true,
		        	"bInfo": true,
	                 "bProcessing": true,
	                 "sAjaxSource":"handleSearchPatient",
	                 "bDestroy": true,
	                 "bAutoWidth": false,
            

		            "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
							        if(aData['8'] >= 100 ) {
							          $(nRow).css('color', 'blue').css('font-weight', 'bold');
							        } else if(aData['8'] <= -100 ) {
							          $(nRow).css('color', 'Red').css('font-weight', 'bold');
							        }
							  },
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
