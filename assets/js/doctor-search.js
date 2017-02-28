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
	            "sAjaxSource":"../handleSearchDoctor",
	            "bDestroy": true,
	            /*"iDisplayLength": 10,*/
	            "bLengthChange": true,
	            "bAutoWidth": false,
	            
				
	            "fnServerParams": function (aoData) {
				    //var date = getDate();
				    var doctorId   = $('.searchby_id').val();
				    var doctorName = $('.searchby_name').val();
				    var doctorIma  = $('.searchby_ima').val();
				    var doctorSpec = $('.searchby_spec').val();
				    aoData.push({ "name": "searchby_id", "value": doctorId },
				    			{ "name": "searchby_name", "value": doctorName },
				    			{ "name": "searchby_ima", "value": doctorIma },
				    			{ "name": "searchby_spec", "value": doctorSpec });
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
	                        { mData: 'specialization_name' },
	                        { mData: 'phone' },
	                        { mData: 'email' },
	                        { mData: 'status' }
	                        
	            ],
	            "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
	            	
	            	var statusDisplay = '';
	            	var doctorId = aData.id_doctor;

	            	if(aData.status=="1"){

	            		statusDisplay = '<div class="active_success"><span class="label label-success active">Online</label></div>';
	            		
	            	}
	            	else{
	            		statusDisplay = '<div class="active_success"><span class="label label-danger inactive">Offline</label></div>';
	            	}

	            	$('td:eq(6)', nRow).html('<a href="">'+statusDisplay + '</a>');

	            	$('td:eq(6)', nRow).unbind().click(function(e){
	            		//alert($(this).text());
	            		var element = $(this);
	            		 e.preventDefault();

	            		 var statusText = $(this).text();

	            		if(statusText=="Online"){
	            			var msg = "Are you sure you want to make offline?";
	            		}
	            		else{
	            			var msg = "Are you sure you want to make online?";
	            		}

	            			//$('#doctor_enable_disable').modal('show');
            			//console.log(msg)
	            		
            			doctorStatusChange(doctorId,statusText,msg,element);
            		
	            		


	            	})

	            	
		            /*$('td:eq(6)', nRow).html('<a href="doctorsearch/doctorstatuschange/' + aData.id_doctor + '">' +
		                statusDisplay + '</a>');*/



		            //$('td:eq(6)', nRow).html('<a href="">'+statusDisplay + '</a>');
		                
		            //return nRow;
		        },
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
	var doctorStatusChange = function(doctorId,statusText,msg,element){
		bootbox.confirm({
	        message: msg,
	        buttons: {
	            confirm: {
	                label: 'Yes',
	                className: 'btn-success yes dd_dr_serch_btn'
	            },
	            cancel: {
	                label: 'No',
	                className: 'btn-danger cancel dd_dr_serch_btn'
	            }
	        },
	        callback: function (result) {

	        	//alert(result)

	        	if(result==true){
	        		$.ajax({
			            type: "POST",
			            url: "../handleDoctorStatusChange",
			            data: 'id_doctor='+doctorId+'&status_text='+statusText,
			            
			            success: function(data) {
			            	//alert(data)
			            	if(data=="disabled"){
			            		console.log('d');
			            		element.find($('.active_success')).append('<span class="label label-danger inactive">Offline</label>');
			            		element.find($('.active_success')).find('.active').remove();
			            	}
			            	else{
			            		console.log('e');
			            		element.find($('.active_success')).append('<span class="label label-success active">Online</label>');
			            		element.find($('.active_success')).find('.inactive').remove();
			            	}
			         	}
			        });
	        	}
	        	 
	        }
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
