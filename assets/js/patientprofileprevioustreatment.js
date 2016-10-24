var patientPrevElements = function () {
    var runPrevTreatment = function(){

      var defaultYearSelected = $('#year option:selected').val();
      //alert(defaultYearSelected);
        $("body").mLoading({ });
                
     
                       
        $.ajax({
            type: "POST",
            url: "patientprofileprevtreatmentextended",
            data: 'year='+defaultYearSelected,
            success: function(data) {
               console.log(data);
               if(data!==""){
                    $("body").mLoading('hide');
                    runPrevTreatmentData(data);
               }
               
            },
        });

        $('#year').change(function(){
            var defaultYearSelected = $('#year option:selected').val();
        // alert(defaultYearSelected);

            $.ajax({
                type: "POST",
                url: "patientprofileprevtreatmentextended",
                data: 'year='+defaultYearSelected,
                success: function(data) {
                    if(data!==""){
                        $("body").mLoading('hide');
                        runPrevTreatmentData(data);
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

        $('.prev-data-div').append( '<div class="prev-data-div-inner" id="prev-data-div-inner">'+

                                        '<div class="row">'+
                                            '<div class="col-sm-12">'+
                                                '<div class="panel panel-default">'+
                                                    '<div class="panel-body">' +
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
                                                            '<div class="row">'+
                                                                '<div class="col-sm-12">'+
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
                                                                            '<li class="">'+
                                                                                '<a href="#obstetrics'+i+'" data-toggle="tab">'+
                                                                                    '<i class="green fa fa-child"></i> Obstetrics History'+ 
                                                                                '</a>'+
                                                                            '</li>'+
                                                                            '<li class="">'+
                                                                                '<a href="#menstrual'+i+'" data-toggle="tab">'+
                                                                                    '<i class="green fa fa-user-md"></i> Menstrual History'+ 
                                                                                '</a>'+
                                                                            '</li>'+
                                                                            

                                                                            '<li class="dropdown">'+
                                                                                '<a href="#" class="dropdown-toggle" data-toggle="dropdown">'+
                                                                                    '<span class="dd_plus_font">+</span>More &nbsp; <i class="fa fa-caret-down width-auto"></i>'+
                                                                                '<ul class="dropdown-menu dropdown-info">'+
                                                                                    '<li>'+
                                                                                        '<a href="#pregnancy'+i+'" data-toggle="tab">'+
                                                                                            '<i class="green fa fa-user-md"></i>Pregnancy History'+  
                                                                                        '</a>'+
                                                                                    '</li>'+
                                                                                    
                                                                                '</ul>'+
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
                                                                                '<a class="btn btn-primary  pdfopen"> Print </a>'+

                                                                            '</div>'+
                                                                            '<div class="tab-pane" id="obstetrics'+i+'">'+
                                                                            '</div>'+
                                                                            '<div class="tab-pane" id="menstrual'+i+'">'+
                                                                            '</div>'+
                                                                            '<div class="tab-pane" id="pregnancy'+i+'">'+
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
                               
                               

                                if(createdDate==data.originalCreatedDateDup[i]){
                                    var str = data.diagnosisData[d].diag_symptoms;
                                    var res = JSON.parse(str);//JSON.parse("[" + str + "]");

                                     $('#diagnosis'+i).append('<div class="panel-body">'+
                                                                    '<div class="col-sm-12">'+
                                                                        '<div class="form-group form-horizontal">'+
                                                                            '<div class="form-group ">'+
                                                                                '<label class="col-sm-12 dd_diag_hd" for="symptoms">Symptoms:</label>'+
                                                                                    '<div class="col-sm-12">'+
                                                                                        '<span id="sym-data'+d+'">'+
                                                                                            
                                                                                        '</span>'+
                                                                                    '</div>'+
                                                                            '</div>'+
                                                                            '<div class="form-group ">'+
                                                                                '<label class="col-sm-12 dd_diag_hd" for="syndromes">Syndromes:</label>'+
                                                                                    '<div class="col-sm-12">'+
                                                                                        '<span id="synd-data'+d+'">'+
                                                                                            '<label class="col-sm-10" for="syndrome">'+data.diagnosisData[d].diag_syndromes+'</label>'+
                                                                                        '</span>'+
                                                                                    '</div>'+
                                                                            '</div>'+
                                                                            '<div class="form-group ">'+
                                                                                '<label class="col-sm-12 dd_diag_hd" for="diseases">Suspected Diseases:</label>'+
                                                                                    '<div class="col-sm-12">'+
                                                                                        '<span id="dis-data'+d+'">'+
                                                                                            
                                                                                        '</span>'+
                                                                                    '</div>'+
                                                                            '</div>'+
                                                                            '<div class="form-group ">'+
                                                                                '<label class="col-sm-12 dd_diag_hd" for="additional-comments">Additional Comments:</label>'+
                                                                                    '<div class="col-sm-12">'+
                                                                                        '<span id="comment-data'+d+'">'+
                                                                                            '<label class="col-sm-10" for="diseases">'+data.diagnosisData[d].diag_comment+'</label>'+
                                                                                        '</span>'+
                                                                                    '</div>'+
                                                                            '</div>'+
                                                                        '</div>'+
                                                                    '</div>'+
                                                              '</div>');

                                    
                                    //appending symptoms
                                    for(r=0;r<res.length;r++){
                                        var index = r+1;
                                        $('#sym-data'+d).append('<label class="col-sm-10" for="sym">'+index+'. '+res[r]+'</label>')
                                    } 
                                               

                                    
                                    //appending diseases
                                    var diseaseStr = data.diagnosisData[d].diag_suspected_diseases;
                                    var diseaseRes = JSON.parse(diseaseStr);//JSON.parse("[" + str + "]");
                                    var array = diseaseRes.toString().split(",");
                                    
                                    for(dis=0;dis<array.length;dis++){
                                        var index = dis+1;
                                        console.log("D--"+array[dis]);
                                        $('#dis-data'+d).append('<label class="col-sm-10" for="diseases">'+index+'. '+array[dis]+'</label>')
                                    }

                                    

                          
                                }    




                            }
                        }
                       
                       

                        /*Obstetrics Data*/

                        if(data.obsData!=""){
                            for(o=0;o<data.obsData.length;o++){
                                 var createdDate = createdDateConvert(data.obsData[o].created_date);
                                 if(createdDate==data.originalCreatedDateDup[i]){



                                    $('#obstetrics'+i).append('<div class="panel-body">'+
                                                                '<div class="col-sm-12">'+
                                                                    '<div class="form-group form-horizontal">'+
                                                                        '<div class="form-group ">'+

                                                                            '<div class="col-sm-4 ">'+
                                                                            '<label class=" col-sm-6 dd_pd_0" for="gravida">Gravida :</label>'+
                                                                                
                                                                                        '<div class="dd_prev_color  col-sm-6 dd_pd_0" for="gravida">'+data.obsData[o].gravida+'</div>'+
                                                                                 
                                                                            

                                                                                '<div class="dd_clear">'+'</div>'+
                                                                                '</div>'+ 


                                                                         '<div class="col-sm-4 ">'+
                                                                            '<label class=" col-sm-6 dd_pd_0" for="para">Para :</label>'+
                                                                             
                                                                                        '<div class="dd_prev_color  col-sm-6 dd_pd_0" for="para">'+data.obsData[o].para+'</div>'+
                                                               

                                                                                '<div class="dd_clear">'+'</div>'+
                                                                          '</div>'+ 


                                                                            '<div class="col-sm-4 ">'+
                                                                               '<label class=" col-sm-6 dd_pd_0" for="living">Living :</label>'+
                                                                                  
                                                                                        '<div class="dd_prev_color  col-sm-6 dd_pd_0" for="living">'+data.obsData[o].living+'</div>'+
                                                                          
                                                                                '<div class="dd_clear">'+'</div>'+ 
                                                                            '</div>'+ 
                                                                        '</div>'+


                                                                        '<div class="form-group ">'+
                                                                            '<div class="col-sm-4 ">'+
                                                                                 '<label class=" col-sm-6 dd_pd_0" for="marriedlife">Married Life :</label>'+
                                                                               
                                                                                 '<div class="dd_prev_color  col-sm-6 dd_pd_0" for="marriedlife">'+data.obsData[o].married_life+'</div>'+
                                                                    
                                                                                '<div class="dd_clear">'+'</div>'+ 
                                                                                 '</div>'+

                                                                           
                                                                           '<div class="col-sm-4 ">'+
                                                                            '<label class=" col-sm-6 dd_pd_0" for="bloodgroup">Blood Group :</label>'+
                                                                               
                                                                                        '<div class=" col-sm-6 dd_pd_0 dd_prev_color" for="bloodgroup">'+data.obsData[o].husband_blood_group+'</div>'+
                                                                                        '<div class="dd_clear">'+'</div>'+
                                                                                '</div>'+ 

                                                                        '<div class="col-sm-4 ">'+
                                                                            '<label class=" col-sm-6 dd_pd_0" for="gestationalage">Gestational Age :</label>'+
                                                                               
                                                                                        '<div class=" col-sm-6 dd_pd_0 dd_prev_color" for="gestationalage">'+data.obsData[o].obs_gestational_age+'</div>'+
                                                                                  
                                                                                '</div>'+ 
                                                                                 '<div class="dd_clear">'+'</div>'+          
                                                                        '</div>'+ 
                                                                        '<div class="form-group ">'+


                                                                        '<div class="col-sm-4 ">'+
                                                                            '<label class=" col-sm-6 dd_pd_0" for="lastdeliverydate">Last Delivery Date :</label>'+
                                                                               
                                                                                        '<div class=" col-sm-6 dd_pd_0 dd_prev_color" for="lastdeliverydate">'+data.obsData[o].obs_last_delivery_date+'</div>'+
                                                                                   '<div class="dd_clear">'+'</div>'+  
                                                                                '</div>'+


                                                                        '<div class="col-sm-4 ">'+        
                                                                            '<label class=" col-sm-6 dd_pd_0" for="expecteddeliverydate">Expected Delivery Date :</label>'+
                                                                            
                                                                                        '<div class=" col-sm-6 dd_pd_0 dd_prev_color" pull-left dd_prev_colorfor="lastdeliverydate">'+data.obsData[o].obs_expected_delivery_date+'</div>'+
                                                                                 '<div class="dd_clear">'+'</div>'+    
                                                                                '</div>'+      
                                                                         '</div>'+                
                                                                    '</div>'+ 
                                                                '</div>'+ 
                                                             '</div>'                   
                                                        );
                                   
                                    
                                }
                            }
                        }
                        /*Obstetrics Data ends*/ 

                       

                       if(data.obsData!=""){
                            for(o=0;o<data.obsData.length;o++){
                                 var createdDate = createdDateConvert(data.obsData[o].created_date);
                                 if(createdDate==data.originalCreatedDateDup[i]){
                                    $('#menstrual'+i).append('<div class="panel-body">'+
                                                                '<div class="col-sm-12">'+
                                                                    '<div class="form-group form-horizontal">'+
                                                                        '<div class="form-group ">'+

                                                                        '<div class="col-sm-4">'+
                                                                            '<label class="pull-left" for="lmpdate">LMP :</label>'+
                                                                           '<div class="dd_prev_color pull-left" for="lmpdate">'+'&nbsp;'+data.obsData[o].obs_lmp_date+'</div>'+
                                                                            '<div class="dd_clear">'+ '</div>'+       
                                                                        '</div>'+

                                                                        '<div class="col-sm-4">'+
                                                                            '<label class="pull-left" for="lmpflow">Lmp Flow : '+' '+'</label>'+
                                                                        
                                                                            '<div class="dd_prev_color pull-left" for="lmpflow">'+'&nbsp;'+data.obsData[o].obs_lmp_flow+'</div>'+
                                                                        '<div class="dd_clear">'+ '</div>'+
                                                                        '</div>'+


                                                                        '<div class="col-sm-4">'+
                                                                            '<label class="pull-left" for="lmpdysmenorrhea">Dysmenorrhea: '+' '+'</label>'+
                                                                            '<div class="dd_prev_color pull-left" for="lmpdysmenorrhea">'+'&nbsp;'+data.obsData[o].obs_lmp_dysmenorrhea+'</div>'+
                                                                            '<div class="dd_clear">'+ '</div>'+       
                                                                            '</div>'+
                                                                        '</div>'+
                                                                        '<div class="form-group ">'+

                                                                        '<div class="col-sm-4">'+
                                                                            '<label class="pull-left" for="days">Days : '+' '+'</label>'+
                                                                               
                                                                                '<div class="dd_prev_color pull-left" for="days">'+'&nbsp;'+data.obsData[o].obs_lmp_days+'</div>'+
                                                                                '<div class="dd_clear">'+ '</div>'+       
                                                                                    
                                                                        '</div>'+

                                                                        '<div class="col-sm-4">'+
                                                                            '<label class="pull-left" for="cycle">Cycle : '+' '+'</label>'+
                                                                             
                                                                            '<div class="dd_prev_color pull-left" for="cycle">'+'&nbsp;'+data.obsData[o].obs_lmp_cycle+'</div>'+
                                                                            '<div class="dd_clear">'+ '</div>'+             
                                                                        '</div>'+


                                                                        '<div class="col-sm-4">'+
                                                                            '<label class="pull-left" for="menstrualtype">Menstrual Type: '+' '+'</label>'+
                                                                                
                                                                                        '<div class="dd_prev_color pull-left" for="menstrualtype">'+'&nbsp;'+data.obsData[o].obs_menstrual_type+'</div>'+
                                                                                  '<div class="dd_clear">'+ '</div>'+  
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
                        
                    }

                    /*Prescription Data ends*/

                    //Printing in prescription
                    $('.pdfopen').click(function(){
                       var createdDate = $(this).closest('.prev-contents').find('.active').find('.created-date').val();
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

                    


                    /*Pregnancy Data*/
                    if(data.pregData!=""){
                        for(p=0;p<data.pregData.length;p++){
                            
                            var createdDate = createdDateConvert(data.pregData[p].created_date);
                            for(dup=0;dup<data.originalCreatedDateDup.length;dup++){
                                

                                if(createdDate==data.originalCreatedDateDup[dup]){
                                    
                                    $('#pregnancy'+dup).append(


                                                        '<div class="form-group dd_mg_top_30">'+

                                                                '<div class="col-sm-4 ">'+    
                                                                    '<label class="pull-left" for="pk">Pregnancy Kind :</label>'+
                                                                               '<div class="dd_prev_color pull-left" for="pk">'+data.pregData[p].obs_preg_kind+'</div>'+
                                                                        '<div class="dd_clear">'+'</div>'+   
                                                                '</div>'+ 

                                                                '<div class="col-sm-4 ">'+ 
                                                                    '<label class="pull-left" for="pt">Pregnancy Type :</label>'+
                                                                       
                                                                        '<div class="dd_prev_color pull-left" for="pk">'+data.pregData[p].obs_preg_type+'</div>'+
                                                                        '<div class="dd_clear">'+'</div>'+ 
                                                                        '</div>'+

                                                                        '<div class="col-sm-4 ">'+ 
                                                                    '<label class="pull-left" for="term">Term :</label>'+
                                                                         '<div class="dd_prev_color pull-left" for="term">'+data.pregData[p].obs_preg_term+'</div>'+
                                                                        '<div class="dd_clear">'+'</div>'+    
                                                                        '</div>'+  

                                                                        '<div class="dd_clear">'+'</div>'+  
                                                                '</div>'+


                                                                '<div class="form-group">'+

                                                                  
                                                                        
                                                                   '<div class="col-sm-4 ">'+
                                                                    '<label class="pull-left" for="abortiontype">Type of Abortion :</label>'+
                                                                               '<div class="dd_prev_color pull-left" for="term">'+data.pregData[p].obs_preg_abortion+'</div>'+
                                                                               '<div class="dd_clear">'+'</div>'+ 
                                                                      '</div>'+    
                                                                        
                                                                   
                                                                   
                                                                '</div>'+

                                                                '<div class="form-group">'+
                                                                    '<div class="col-sm-4 ">'+ 
                                                                        '<label class="pull-left" for="health">Health :</label>'+
                                                                       
                                                                                '<div class="dd_prev_color pull-left" for="health">'+data.pregData[p].obs_preg_health+'</div>'+
                                                                                '<div class="dd_clear">'+'</div>'+ 
                                                                        '</div>'+    
                                                                        
                                                                   '<div class="col-sm-4 ">'+ 
                                                                    '<label class="pull-left" for="age">Age :</label>'+
                                                                    '<div class="dd_prev_color pull-left" for="year">'+data.pregData[p].obs_preg_years+'Years'+' | '+data.pregData[p].obs_preg_weeks+''+'Weeks'+'</div>'+
                                                                    '<div class="dd_clear">'+'</div>'+ 
                                                                    '</div>'+ 

                                                                 '<div class="dd_clear">'+'</div>'+           
                                                                '</div>'+         
                                                                '<div class="form-group">'+

                                                                 '<div class="col-sm-4 ">'+    
                                                                    '<label class="pull-left" for="gender">Gender :</label>'+
                                                                               '<div class="dd_prev_color pull-left" for="gender">'+data.pregData[p].obs_preg_gender+'</div>'+
                                                                         '<div class="dd_clear">'+'</div>'+  
                                                                        '</div>'+  
                                                                 '<div class="dd_clear">'+'</div>'+    
                                                                '</div>'



                                                            ); 



                                    
                                }
                            }
                           
                            
                           
     
                        }
                        /*$('.prev-inner-content').append('<input type=""button" name="print" value="Print" class="btn btn-primary">');*/
                    }
                  
                    /*Pegnancy Data ends*/

                   
    }
  
    return {
        //main function to initiate template pages
        init: function () {
           runPrevTreatment();
           
        }
    };
}();