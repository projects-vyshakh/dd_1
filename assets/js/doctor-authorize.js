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

	var runAuthorizeDoctor = function(){
		$('.authorize_btn').click(function(e){
			e.preventDefault();
			var clickedElements = $(this);
			var doctorDiv = $('#doctor_list_div').html();
			//console.log(doctorDiv);
			bootbox.confirm({
		        message: "Are you sure you want to authorize?",
		        buttons: {
		            confirm: {
		                label: 'Yes',
		                className: 'btn-success'
		            },
		            cancel: {
		                label: 'No',
		                className: 'btn-danger'
		            }
		        },
		        callback: function (result) {
		            //console.log('This was logged in the callback: ' + result);
		             
		            if(result){
		            	var doctorId = clickedElements.parent().find('.id_doctor').val();
		            	$.ajax({
				            type: "POST",
				            url: "handleDoctorAuthorize",
				            data: 'id_doctor='+doctorId,
				            dataType :"JSON",
				            success: function(data) {
				               //console.log(data.vitalsData[0].id_vitals);
				               console.log(data);
					            if(data!='' || data!=null){
					                //$( "#doctor_authorize" ).load( "doctorauthorize #doctor_authorize" );
					                //$('.msg_success').show();
					                console.log(clickedElements);
					                //clickedElements.remove();
					                console.log(clickedElements);
					                clickedElements.hide();
					                //console.log(clickedElements.parent().find('.success_authorize_div'))
					                clickedElements.parent().find('.success_authorize_div').append('<span class="btn btn-success">Authorized</span>');
					                /*clickedElements.removeClass('btn-warning');
					                clickedElements.removeClass('authorize_btn');
					                clickedElements.addClass('btn-success');
					                clickedElements.addClass('authorize_success_btn');
					                clickedElements.val('Authorized')*/
					            }
					            else{
					            	//$('#doctor_list_div').hide();
					            }
				              
				               
				            },
				        });
		            }
		            else{
		            	//alert('no')
		            }
		        }
		    });

		});

		$('.authorize_success_btn').click(function(){
			bootbox.confirm({
		        message: "Doctor already authorized",
		        buttons: {
		            confirm: {
		                label: 'Yes',
		                className: 'btn-success'
		            },
		            cancel: {
		                label: 'No',
		                className: 'btn-danger'
		            }
		        },
		    });
		})

	};
	return {
		//main function to initiate template pages
		init: function () {
			runOnPageLoad();
			runAuthorizeDoctor();
			//doctorAuthorizeTable();
		   
		   
		}
    };
}(); 
