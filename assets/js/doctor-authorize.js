var doctorAuthorize = function () {
	var runOnPageLoad = function(){

	}
	
	var doctorAuthorizeTable = function(){
				//$('#search_patient_table').show();



        $('#search_patient_table').dataTable({
             "bProcessing": true,
             "sAjaxSource":"../handleDoctorAuthorize",
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
				size: "small",
		        message: "<p style='padding-left:30%'>Are you sure you want to authorize?</p>",
		        buttons: {
		            confirm: {
		                label: 'Yes',
		                className: 'btn-success  yes dd_dr_serch_btn'
		            },
		            cancel: {
		                label: 'No',
		                className: 'btn-danger cancel dd_dr_serch_btn'
		            }
		        },
		        callback: function (result) {
		            //console.log('This was logged in the callback: ' + result);
		             
		            if(result){
		            	var doctorId = clickedElements.parent().find('.id_doctor').val();
		            	$.ajax({
				            type: "POST",
				            url: "../handleDoctorAuthorize",
				            data: 'id_doctor='+doctorId,
				            dataType :"JSON",
				            success: function(data) {
				               //console.log(data.vitalsData[0].id_vitals);
				               console.log(data);
					            if(data!='' || data!=null){
					                //$( "#doctor_authorize" ).load( "doctorauthorize #doctor_authorize" );
					                //$('.msg_success').show();
					                //console.log(clickedElements);
					                //clickedElements.remove();
					                //console.log(clickedElements);
					                clickedElements.hide();
					                //console.log(clickedElements.parent().find('.success_authorize_div'))
					                clickedElements.parent().find('.success_authorize_div').append('<span class="btn btn-sm btn-success">Authorized</span>');
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

	var runDoctorAuthorizeTable = function () {
        var oTable = $('#doctor_authorize_table').dataTable({
            "responsive": true,
        	"bPaginate" : true,
        	"bAutoWidth": false,
        	"bFilter": true,
        	"bInfo": false,
        });
        $('#sample_1_wrapper .dataTables_filter input').addClass("form-control input-sm").attr("placeholder", "Search");
        // modify table search input
        $('#sample_1_wrapper .dataTables_length select').addClass("m-wrap small");
        // modify table per page dropdown
        $('#sample_1_wrapper .dataTables_length select').select2();
        // initialzie select2 dropdown
        $('#sample_1_column_toggler input[type="checkbox"]').change(function () {
            /* Get the DataTables object again - this is not a recreation, just a get of the object */
            var iCol = parseInt($(this).attr("data-column"));
            var bVis = oTable.fnSettings().aoColumns[iCol].bVisible;
            oTable.fnSetColumnVis(iCol, (bVis ? false : true));
        });
    };
	return {
		//main function to initiate template pages
		init: function () {
			runOnPageLoad();
			runAuthorizeDoctor();
			runDoctorAuthorizeTable();
			//doctorAuthorizeTable();
		   
		   
		}
    };
}(); 
