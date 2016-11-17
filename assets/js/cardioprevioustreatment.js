var patientPrevElements = function () {
    var runPrevTreatment = function(){

      var defaultYearSelected = $('#year option:selected').val();
      //alert(defaultYearSelected);
        $("body").mLoading({ });
                
     
                       
        $.ajax({
            type: "POST",
            url: "cardioprevioustreatmentextended",
            data: 'year='+defaultYearSelected,
            success: function(data) {
               console.log(data);
               if(data!==""){
                    $("body").mLoading('hide');
                    runPrevTreatmentData(data);
               }
               if(data.originalCreatedDate==""){
                    $('.prev-contents').append( '<div class="row">'+
                                                    '<div class="col-sm-12 dd_no_previous">'+
                                                        '<div class="dd_no_prev_img"></div>'+  
                                                    '</div>'+
                                                '</div>'
                                                );
                }
               
            },
        });

        $('#year').change(function(){
            var defaultYearSelected = $('#year option:selected').val();
        // alert(defaultYearSelected);

            $.ajax({
                type: "POST",
                url: "cardioprevioustreatmentextended",
                data: 'year='+defaultYearSelected,
                success: function(data) {
                    if(data!==""){
                        $("body").mLoading('hide');
                        runPrevTreatmentData(data);
                    }
                    if(data.originalCreatedDate==""){
                        $('.prev-contents').append( '<div class="row">'+
                                                        '<div class="col-sm-12">'+
                                                            '<div class="dd_no_prev_img"></div>'+  
                                                        '</div>'+
                                                    '</div>'
                                                    );
                    }

                },
            });
        });
   

    };

    var createdDateConvert = function(createdDate){
        var t = createdDate.split(/[- :]/);
        var date = new Date(Date.UTC(t[0], t[1]-1, t[2], t[3], t[4], t[5]));
        year = String(date.getFullYear());
        month = String(date.getMonth()+1);
        day = String(date.getDate());

        if(month.length==1){  month = "0" + month; }
        if(day.length==1){  day = "0" + day; }

        var  createdDate = year+'-'+month+'-'+day; 
        return createdDate

    }
    var runPrevTreatmentData = function(data){
        $('#prev-data-div-inner').remove();


        var prescStatusArray = new Array();

        $('.prev-data-div').append( '<div class="prev-data-div-inner" id="prev-data-div-inner">'+

                                        '<div class="row">'+
                                            '<div class="col-sm-12">'+
                                                '<div class="">'+
                                                    '<div class="">' +
                                                        '<div class="row">'+
                                                            '<div class="col-sm-12 dd_pd_30">'+
                                                                '<div class="tabbable tabs-left">'+
                                                                    '<ul id="myTab3" class="nav nav-tabs tab-green dd_sidetab ">'+
                                                                    '</ul>'+
                                                                    '<div class="tab-content prev-contents" style="height:500px">'+
                                                                        
                                                                    '</div>'+
                                                                '</div>'+
                                                            '</div>'+
                                                        '</div>'+    
                                                    '</div>'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'               
                                );
                    

                    /*Side date tab loop*/ 
                    /*----------------------------------------------------------------------------------*/
                    var originalDateArray =[];
                    console.log(data.originalCreatedDateDup)
                    for(i=0;i<data.originalCreatedDateDup.length;i++){
                        
                        $('#myTab3').append('<li class="">'+
                                                '<a href="#panel_tab4_example1'+i+'" data-toggle="tab">'+
                                                    data.originalCreatedDateDup[i]+
                                                '</a>'+
                                            '</li>');

                        $('.prev-contents').append('<div class="tab-pane" id="panel_tab4_example1'+i+'">'+
                                                    '<input type="hidden" name="created-date" class="created-date" value="'+data.originalCreatedDateDup[i]+'">'+
                                                       '<p>'+ 
                                                            '<div class="dd_prev_margine">'+
                                                                '<div class="col-sm-12 dd_prev_hd_mg">'+
                                                                    '<div class="tabbable">'+
                                                                        '<ul id="myTab" class="nav nav-tabs tab-bricky dd_sidetab">'+
                                                                            '<li class="active">'+
                                                                                '<a href="#vitals'+i+'" data-toggle="tab">'+
                                                                                    '<i class="green fa fa-male"></i> Vitals'+
                                                                                '</a>'+
                                                                            '</li>'+
                                                                            '<li class="">'+
                                                                                '<a href="#diagnosis'+i+'" data-toggle="tab">'+
                                                                                    '<i class="green fa fa-heart"></i> Diagnosis'+
                                                                                '</a>'+
                                                                            '</li>'+
                                                                            '<li class="">'+
                                                                                '<a href="#prescription'+i+'" data-toggle="tab">'+
                                                                                    '<i class="green fa fa-pencil-square-o"></i> Prescription'+ 
                                                                                '</a>'+
                                                                            '</li>'+
                                                                        '</ul>'+
                                                                        '<div class="tab-content prev-inner-content dd_pd_0">'+
                                                                            '<div class="tab-pane in active" id="vitals'+i+'">'+
                                                                            '</div>'+
                                                                            '<div class="tab-pane" id="diagnosis'+i+'">'+
                                                                                
                                                                            '</div>'+
                                                                            '<div class="tab-pane" id="prescription'+i+'">'+
                                                                                '<div id="presc-content'+i+'" class="presc-content">'+
                                                                                               
                                                                                '</div>'+
                                                                               
                                                                                '<div class="created-date-div" id="created-date-div">'+
                                                                                '</div>'+
                                                                                /*'<input type="button" value="Print" class="btn btn-primary presc-print">'+*/
                                                                                /*'<a class="btn btn-primary  pdfopen"> Print </a>'+*/

                                                                            '</div>'+
                                                                        '</div>'+    
                                                                    '</div>'+    
                                                                '</div>'+
                                                            '</div>'+    
                                                   '</div>'
                                                  );
                        
                       
                        if(data.vitalsData!=''){
                            for(v=0;v<data.vitalsData.length;v++){
                                var t = data.vitalsData[v].created_date.split(/[- :]/);
                                var d = new Date(Date.UTC(t[0], t[1]-1, t[2], t[3], t[4], t[5]));
                                year = String(d.getFullYear());
                                month = String(d.getMonth()+1);
                                day = String(d.getDate());

                                if(month.length==1){  month = "0" + month; }
                                if(day.length==1){  day = "0" + day; }

                                var createdDate = year+'-'+month+'-'+day; 
                                if(createdDate==data.originalCreatedDateDup[i]){
                                    $('#vitals'+i).append('<div class="panel-body">'+
                                                            '<div class="col-sm-12">'+
                                                                '<div class="form-group form-horizontal">'+
                                                                    '<div class="form-group ">'+

                                                                    '<div class="col-sm-4 ">'+

                                                                      '<label class="pull-left col-sm-6 dd_pd_0" for="weight">Weight:</label>'+
                                                                            
                                                                                    '<div class="dd_prev_color pull-left col-sm-6 dd_pd_0" for="weight">'+data.vitalsData[v].weight+' '+'Kg'+'</div>'+
                                                                    

                                                                    '<div class="dd_clear">'+'</div>'+
                                                                    '</div>'+
                                                                      
                                                                        '<div class="col-sm-4 ">'+
                                                                        '<label class="pull-left col-sm-6 dd_pd_0" for="height">Height:</label>'+
                                                                        
                                                                        '<div class="dd_prev_color pull-left col-sm-6 dd_pd_0" for="height">'+data.vitalsData[v].height+' '+'cm'+'</div>'+
                                                                            '<div class="dd_clear">'+'</div>'+   
                                                                            '</div>'+


                                                                        '<div class="col-sm-4 ">'+   
                                                                        '<label class=" col-sm-6 dd_pd_0" for="bmi">BMI:</label>'+
                                                                            
                                                                            '<div class="dd_prev_color  col-sm-6 dd_pd_0" for="bmi">'+data.vitalsData[v].height+' '+'bmi'+'</div>'+
                                                                            '<div class="dd_clear">'+'</div>'+  
                                                                            '</div>'+
                                                                    '</div>'+


                                                                    '<div class="form-group ">'+

                                                                    '<div class="col-sm-4 ">'+  
                                                                       /* '<label class="pull-left" for="bmi">BMI:</label>'+*/
                                                                        '<label class="col-sm-6 dd_pd_0" for="Pulse ">Pulse:</label>'+
                                                                            
                                                                        '<div class="dd_prev_color col-sm-6 dd_pd_0" for="weight">'+data.vitalsData[v].pulse+' '+'beats / min'+'</div>'+
                                                                         '<div class="dd_clear">'+'</div>'+         
                                                                        '</div>'+


                                                                    '<div class="col-sm-4 ">'+         
                                                                        '<label class="col-sm-6 dd_pd_0" for="resipiratory">Respiratory Rate :</label>'+
                                                                        
                                                                        '<div class="dd_prev_color col-sm-6 dd_pd_0" for="resipiratory">'+data.vitalsData[v].respiratoryrate+' '+'breathes/min'+'</div>'+
                                                                        '<div class="dd_clear">'+'</div>'+   
                                                                        '</div>'+

                                                                        '<div class="col-sm-4 ">'+ 
                                                                        '<label class="col-sm-6 dd_pd_0" for="temperature">Temperature:</label>'+
                                                                          
                                                                        '<div class="dd_prev_color col-sm-6 dd_pd_0" for="temperature">'+data.vitalsData[v].temperature+' '+'Fahrenheit'+'</div>'+
                                                                        '<div class="dd_clear">'+'</div>'+        
                                                                         '</div>'+
                                                                    '</div>'+ 


                                                                    '<div class="form-group ">'+

                                                                    '<div class="col-sm-4 ">'+ 
                                                                        '<label class="col-sm-6 dd_pd_0" for="spo2 ">SPO2:</label>'+
                                                           
                                                                            '<div class="dd_prev_color col-sm-6 dd_pd_0" for="spo2">'+data.vitalsData[v].sp+'%'+'</div>'+
                                                                            '<div class="dd_clear">'+'</div>'+     
                                                                    '</div>'+

                                                                    '<div class="col-sm-4 ">'+ 
                                                                        '<label class="col-sm-6 dd_pd_0" for="blood_group">Blood Group :</label>'+
                                                                         
                                                                            '<div class="dd_prev_color col-sm-6 dd_pd_0" for="blood_group">'+data.vitalsData[v].blood_group+'</div>'+
                                                                            '<div class="dd_clear">'+'</div>'+  
                                                                    '</div>'+


                                                                    '<div class="col-sm-4 ">'+ 
                                                                        '<label class="pull-left col-sm-6 dd_pd_0" for="bp">Blood Pressure(Systolic/Diastolic):</label>'+
                                                                          
                                                                                    '<div class="dd_prev_color col-sm-6 dd_pd_0" for="temperature">'+data.vitalsData[v].systolic_pressure+'/'+data.vitalsData[v].diastolic_pressure+' '+'mm/Hg'+'</div>'+
                                                                               
                                                                            '</div>'+
                                                                    '</div>'+       
                                                                '</div>'+
                                                            '</div>'+
                                                          '</div>'      
                                                        );
                                
                                       

                                }
                            } 
                        }    
                           
                        
                        if(data.diagnosisData!=""){
                            for(d=0;d<data.diagnosisData.length;d++){
                                
                                var createdDate = createdDateConvert(data.diagnosisData[d].created_date);
                               
                                var str = data.diagnosisData[d].diag_symptoms;

                                if(createdDate==data.originalCreatedDateDup[i]){
                                    //var str = data.diagnosisData[d].diag_symptoms;
                                    //var res = JSON.parse(str);//JSON.parse("[" + str + "]");

                                     $('#diagnosis'+i).append('<div class="panel-body">'+
                                                                    '<div class="col-sm-12">'+
                                                                        '<div class="form-group form-horizontal">'+
                                                                            '<div class="form-group ">'+
                                                                                '<div class="col-sm-2">'+
                                                                                    '<label class="pull-left dd_pd_0" for="weight">CVS :</label>'+
                                                                                '</div>'+
                                                                                '<div class="col-sm-10">'+ 
                                                                                    '<div class="dd_prev_color pull-left dd_pd_0" for="cvs">'+data.diagnosisData[d].cvs_status+'</div>'+  
                                                                                '</div>'+
                                                                            '</div>'+
                                                                            '<div class="form-group ">'+
                                                                                '<div class="col-sm-2">'+
                                                                                     '<label class="pull-left dd_pd_0" for="comments">Comments :</label>'+
                                                                                '</div>'+
                                                                                '<div class="col-sm-10">'+
                                                                                    '<div class="dd_prev_color pull-left dd_pd_0" for="cvs">'+data.diagnosisData[d].cvs_comments+'</div>'+  
                                                                                '</div>'+ 
                                                                            '</div>'+
                                                                        '</div>'+
                                                                        '<hr>'+
                                                                        '<div class="form-group form-horizontal">'+
                                                                            '<div class="form-group ">'+
                                                                                '<div class="col-sm-2">'+
                                                                                    '<label class="pull-left dd_pd_0" for="weight">LUNGS :</label>'+
                                                                                '</div>'+
                                                                                '<div class="col-sm-10">'+ 
                                                                                    '<div class="dd_prev_color pull-left dd_pd_0" for="cvs">'+data.diagnosisData[d].lungs_status+'</div>'+  
                                                                                '</div>'+
                                                                            '</div>'+
                                                                            '<div class="form-group ">'+
                                                                                '<div class="col-sm-2">'+
                                                                                     '<label class="pull-left dd_pd_0" for="comments">Comments :</label>'+
                                                                                '</div>'+
                                                                                '<div class="col-sm-10">'+
                                                                                    '<div class="dd_prev_color pull-left dd_pd_0" for="cvs">'+data.diagnosisData[d].lungs_comments+'</div>'+  
                                                                                '</div>'+ 
                                                                            '</div>'+
                                                                        '</div>'+
                                                                        '<hr>'+
                                                                        '<div class="form-group form-horizontal">'+
                                                                            '<div class="form-group ">'+
                                                                                '<div class="col-sm-2">'+
                                                                                    '<label class="pull-left dd_pd_0" for="weight">Abdomen :</label>'+
                                                                                '</div>'+
                                                                                '<div class="col-sm-10">'+ 
                                                                                    '<div class="dd_prev_color pull-left dd_pd_0" for="cvs">'+data.diagnosisData[d].abdomen_status+'</div>'+  
                                                                                '</div>'+
                                                                            '</div>'+
                                                                            '<div class="form-group ">'+
                                                                                '<div class="col-sm-2">'+
                                                                                     '<label class="pull-left dd_pd_0" for="comments">Comments :</label>'+
                                                                                '</div>'+
                                                                                '<div class="col-sm-10">'+
                                                                                    '<div class="dd_prev_color pull-left dd_pd_0" for="cvs">'+data.diagnosisData[d].abdomen_comments+'</div>'+  
                                                                                '</div>'+ 
                                                                            '</div>'+
                                                                        '</div>'+
                                                                        '<hr>'+
                                                                        '<div class="form-group form-horizontal">'+
                                                                            '<div class="form-group ">'+
                                                                                '<div class="col-sm-2">'+
                                                                                    '<label class="pull-left dd_pd_0" for="weight">ECG :</label>'+
                                                                                '</div>'+
                                                                                '<div class="col-sm-10">'+ 
                                                                                    '<div class="dd_prev_color pull-left dd_pd_0" for="cvs">'+data.diagnosisData[d].ecg_status+'</div>'+  
                                                                                '</div>'+
                                                                            '</div>'+
                                                                            '<div class="form-group ">'+
                                                                                '<div class="col-sm-2">'+
                                                                                     '<label class="pull-left dd_pd_0" for="comments">Comments :</label>'+
                                                                                '</div>'+
                                                                                '<div class="col-sm-10">'+
                                                                                    '<div class="dd_prev_color pull-left dd_pd_0" for="cvs">'+data.diagnosisData[d].ecg_comments+'</div>'+  
                                                                                '</div>'+ 
                                                                            '</div>'+
                                                                        '</div>'+
                                                                     '</div>'+
                                                                 '</div>'               




                                                                                        );

                                    
                                                
                                    

                          
                                }    




                            }
                        }
                       
                       
   

   


                    }


        

                                
                               

                

                    /*Prescription Data*/
                    if(data.prescMedicineData!=""){
                        for(p=0;p<data.prescMedicineData.length;p++){
                            var createdDate = createdDateConvert(data.prescMedicineData[p].created_date);
                            
                            
                            
                            for(dup=0;dup<data.originalCreatedDateDup.length;dup++){
                                

                                if(createdDate==data.originalCreatedDateDup[dup]){

                                    //$('.presc-print').show();
                                    //console.log($('#prescription'+dup).show());

                                    $('.pdfopen').show();
                                    $('#presc-content'+dup).append('<div class="panel-body">'+
                                                                        '<div class="col-sm-12">'+
                                                                            '<div class="form-group form-horizontal">'+
                                                                                '<div class="form-group ">'+
                                                                                    '<div class="col-sm-2">'+
                                                                                        '<label class="pull-left" for="drugname">DrugName :</label>'+
                                                                                        '<div class="dd_clear">'+ '</div>'+       
                                                                                    '</div>'+
                                                                                    '<div class="col-sm-2">'+
                                                                                        '<label class="pull-left" for="drugname"><span class="dd_prev_color">'+data.prescMedicineData[p].drug_name+'</span></label>'+
                                                                                        '<div class="dd_clear">'+ '</div>'+       
                                                                                    '</div>'+
                                                                                    '<div class="col-sm-2">'+
                                                                                        '<label class="pull-left" for="dosage">Dosage :</label>'+
                                                                                        '<div class="dd_clear">'+ '</div>'+       
                                                                                    '</div>'+
                                                                                    '<div class="col-sm-2">'+
                                                                                        '<label class="pull-left" for="dosage"><span class="dd_prev_color">'+data.prescMedicineData[p].dosage+' '+data.prescMedicineData[p].dosage_unit+'</span></label>'+
                                                                                        '<div class="dd_clear">'+ '</div>'+       
                                                                                    '</div>'+
                                                                                    '<div class="col-sm-2">'+
                                                                                        '<label class="pull-left" for="duration">Duration :</label>'+
                                                                                        '<div class="dd_clear">'+ '</div>'+       
                                                                                    '</div>'+
                                                                                    '<div class="col-sm-2">'+
                                                                                        '<label class="pull-left" for="duration"><span class="dd_prev_color">'+data.prescMedicineData[p].duration+' '+data.prescMedicineData[p].duration_unit+'</span></label>'+
                                                                                        '<div class="dd_clear">'+ '</div>'+       
                                                                                    '</div>'+
                                                                                '</div>'+
                                                                                '<div class="form-group ">'+
                                                                                    '<div class="col-sm-2">'+
                                                                                        '<label class="pull-left" for="morning">Morning :</label>'+
                                                                                        '<div class="dd_clear">'+ '</div>'+       
                                                                                    '</div>'+
                                                                                    '<div class="col-sm-2">'+
                                                                                        '<label class="pull-left" for="morning"><span class="dd_prev_color">'+data.prescMedicineData[p].morning+'</span></label>'+
                                                                                        '<div class="dd_clear">'+ '</div>'+       
                                                                                    '</div>'+
                                                                                    '<div class="col-sm-2">'+
                                                                                        '<label class="pull-left" for="noon">Noon :</label>'+
                                                                                        '<div class="dd_clear">'+ '</div>'+       
                                                                                    '</div>'+
                                                                                    '<div class="col-sm-2">'+
                                                                                        '<label class="pull-left" for="noon"><span class="dd_prev_color">'+data.prescMedicineData[p].noon+'</span></label>'+
                                                                                        '<div class="dd_clear">'+ '</div>'+       
                                                                                    '</div>'+
                                                                                    '<div class="col-sm-2">'+
                                                                                        '<label class="pull-left" for="night">Night :</label>'+
                                                                                        '<div class="dd_clear">'+ '</div>'+       
                                                                                    '</div>'+
                                                                                    '<div class="col-sm-2">'+
                                                                                        '<label class="pull-left" for="night"><span class="dd_prev_color">'+data.prescMedicineData[p].night+'</span></label>'+
                                                                                        '<div class="dd_clear">'+ '</div>'+       
                                                                                    '</div>'+
                                                                                '</div>'+ 
                                                                                '<div class="form-group ">'+
                                                                                    '<div class="col-sm-2">'+
                                                                                        '<label class="pull-left" for="instruction">Instruction :</label>'+
                                                                                        '<div class="dd_clear">'+ '</div>'+       
                                                                                    '</div>'+
                                                                                    '<div class="col-sm-10">'+
                                                                                        '<label class="pull-left" for="morning"><span class="dd_prev_color">'+data.prescMedicineData[p].instruction+'</span></label>'+
                                                                                        '<div class="dd_clear">'+ '</div>'+       
                                                                                    '</div>'+
                                                                                '</div>'+       
                                                                            '</div>'+
                                                                        '</div>'+ 
                                                                    '</div>'+
                                                                    '<div class="form-group dd_prev_pre_bt_line"></div>'
                                                                    
                                                                    );          
                                                                        
                                       
                                
                                }

                               
                               
                            }
                            
                            
                           
                            
                           
     
                        }
                        $('#presc-content0').append('<a class="btn btn-primary  pdfopen"> Print </a>');  
                        
                    }

                   
                    /*Prescription Data ends*/

                    //Printing in prescription
                    $('.pdfopen').click(function(){
                       var createdDate = $(this).closest('.prev-contents').find('.active').find('.created-date').val();
                       console.log(createdDate);
                        $("body").mLoading({
                
     
                        });
                        $.ajax({
                            type: "POST",
                            url: "patientprevioustreatmentprint",
                            data: 'created_date='+createdDate,
                            success: function(data) {
                               console.log(data);
                               if(data!=""){
                                    $("body").mLoading('hide');
                                    $('#myModal3').modal('show');
                                    $('iframe').remove();
                                    $('.pdf_print').append('<iframe src="storage/pdf/'+data+'.pdf" style="width:780px;height:500px;"></iframe>');
                               }
                               
                            },
                        });

                    })
                    //Printing in prescription ends

                    


                   
    }
  
    return {
        //main function to initiate template pages
        init: function () {
           runPrevTreatment();
           
        }
    };
}();