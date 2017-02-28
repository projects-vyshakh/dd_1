var patientPrevElements = function () {
    var runPrevTreatment = function(){

      var defaultYearSelected = $('#year option:selected').val();
      //alert(defaultYearSelected);

        $.ajax({
            type: "POST",
            url: "patientprofileprevtreatmentextended",
            data: 'year='+defaultYearSelected,
            success: function(data) {
               console.log(data);
               runPrevTreatmentData(data);
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
                   console.log(data.originalCreatedDateDup);
                   runPrevTreatmentData(data);
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
                                                            '<div class="col-sm-12">'+
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
                    console.log(data.originalCreatedDateDup.length)
                    for(i=0;i<data.originalCreatedDateDup.length;i++){
                        
                        $('#myTab3').append('<li class="">'+
                                                '<a href="#panel_tab4_example1'+i+'" data-toggle="tab">'+
                                                    data.originalCreatedDateDup[i]+
                                                '</a>'+
                                            '</li>');

                        $('.prev-contents').append('<div class="tab-pane" id="panel_tab4_example1'+i+'">'+
                                                       '<p>'+ 
                                                            '<div class="row">'+
                                                                '<div class="col-sm-12">'+
                                                                    '<div class="tabbable">'+
                                                                        '<ul id="myTab" class="nav nav-tabs tab-bricky dd_sidetab">'+
                                                                            '<li class="active">'+
                                                                                '<a href="#vitals'+i+'" data-toggle="tab">'+
                                                                                    '<i class="green fa fa-home"></i> Vitals'+
                                                                                '</a>'+
                                                                            '</li>'+
                                                                            '<li class="">'+
                                                                                '<a href="#diagnosis'+i+'" data-toggle="tab">'+
                                                                                    '<i class="green fa fa-home"></i> Diagnosis'+
                                                                                '</a>'+
                                                                            '</li>'+
                                                                            '<li class="">'+
                                                                                '<a href="#prescription'+i+'" data-toggle="tab">'+
                                                                                    '<i class="green fa fa-home"></i> Prescription'+ 
                                                                                '</a>'+
                                                                            '</li>'+
                                                                            '<li class="">'+
                                                                                '<a href="#obstetrics'+i+'" data-toggle="tab">'+
                                                                                    '<i class="green fa fa-home"></i> Obstetrics History'+ 
                                                                                '</a>'+
                                                                            '</li>'+
                                                                            '<li class="">'+
                                                                                '<a href="#menstrual'+i+'" data-toggle="tab">'+
                                                                                    '<i class="green fa fa-home"></i> Menstrual History'+ 
                                                                                '</a>'+
                                                                            '</li>'+

                                                                            '<li class="dropdown">'+
                                                                                '<a href="#" class="dropdown-toggle" data-toggle="dropdown" style="font-weight:bold">'+
                                                                                    '+Add More &nbsp; <i class="fa fa-caret-down width-auto"></i>'+
                                                                                '</a>'+
                                                                                '<ul class="dropdown-menu dropdown-info">'+
                                                                                    
                                                                                    '<li>'+
                                                                                        '<a href="#pregnancy'+i+'" data-toggle="tab">'+
                                                                                            'Pregnancy History'+  
                                                                                        '</a>'+
                                                                                    '</li>'+
                                                                                '</ul>'+
                                                                            '</li>'+
                                                                        '</ul>'+
                                                                        '<div class="tab-content prev-inner-content">'+
                                                                            '<div class="tab-pane in active" id="vitals'+i+'">'+
                                                                            '</div>'+
                                                                            '<div class="tab-pane" id="diagnosis'+i+'">'+
                                                                            '</div>'+
                                                                            '<div class="tab-pane" id="prescription'+i+'">'+
                                                                                '<div class="panel-body">'+
                                                                                    '<div class="col-sm-12">'+
                                                                                        '<div class="form-group form-horizontal">'+
                                                                                            '<div class="form-group ">'+
                                                                                               '<div class="col-sm-3">DrugName</div>'+
                                                                                               '<div class="col-sm-2">Dosage</div>'+
                                                                                               '<div class="col-sm-6">Frequency</div>'+
                                                                                               '<div class="col-sm-1">Duration</div>'+
                                                                                            '</div>'+
                                                                                            '<div class="form-group ">'+
                                                                                                '<hr>'+
                                                                                            '</div>'+
                                                                                            '<div id="presc-content'+i+'">'+
                                                                                               
                                                                                            '</div>'+
                                                                                        '</div>'+
                                                                                    '</div>'+
                                                                                '</div>'+
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
                                                                        '<label class="col-sm-2" for="weight">Weight:</label>'+
                                                                            '<div class="col-sm-2">'+
                                                                                '<span>'+
                                                                                    '<label class="col-sm-2" for="weight">'+data.vitalsData[v].weight+'Kg'+'</label>'+
                                                                                '</span>'+
                                                                            '</div>'+
                                                                        '<label class="col-sm-2" for="height">Height:</label>'+
                                                                            '<div class="col-sm-2">'+
                                                                                '<span>'+
                                                                                    '<label class="col-sm-2" for="height">'+data.vitalsData[v].height+'cm'+'</label>'+
                                                                                '</span>'+
                                                                            '</div>'+
                                                                        '<label class="col-sm-2" for="bmi">BMI:</label>'+
                                                                            '<div class="col-sm-2">'+
                                                                                '<span>'+
                                                                                    '<label class="col-sm-2" for="bmi">'+data.vitalsData[v].height+'bmi'+'</label>'+
                                                                                '</span>'+
                                                                            '</div>'+
                                                                    '</div>'+ 
                                                                    '<div class="form-group ">'+
                                                                        '<label class="col-sm-2" for="Pulse ">Pulse:</label>'+
                                                                            '<div class="col-sm-2">'+
                                                                                '<span>'+
                                                                                    '<label class="col-sm-2" for="weight">'+data.vitalsData[v].pulse+'beats/min'+'</label>'+
                                                                                '</span>'+
                                                                            '</div>'+
                                                                        '<label class="col-sm-2" for="resipiratory">Respiratory Rate :</label>'+
                                                                            '<div class="col-sm-2">'+
                                                                                '<span>'+
                                                                                    '<label class="col-sm-2" for="resipiratory">'+data.vitalsData[v].respiratoryrate+'breathes/min'+'</label>'+
                                                                                '</span>'+
                                                                            '</div>'+
                                                                        '<label class="col-sm-2" for="temperature">Temperature:</label>'+
                                                                            '<div class="col-sm-2">'+
                                                                                '<span>'+
                                                                                    '<label class="col-sm-2" for="temperature">'+data.vitalsData[v].temperature+'Fahrenheit'+'</label>'+
                                                                                '</span>'+
                                                                            '</div>'+
                                                                    '</div>'+ 
                                                                    '<div class="form-group ">'+
                                                                        '<label class="col-sm-2" for="spo2 ">SPO2:</label>'+
                                                                            '<div class="col-sm-2">'+
                                                                                '<span>'+
                                                                                    '<label class="col-sm-2" for="spo2">'+data.vitalsData[v].sp+'%'+'</label>'+
                                                                                '</span>'+
                                                                            '</div>'+
                                                                        '<label class="col-sm-2" for="blood_group">Blood Group :</label>'+
                                                                            '<div class="col-sm-2">'+
                                                                                '<span>'+
                                                                                    '<label class="col-sm-2" for="blood_group">'+data.vitalsData[v].blood_group+'</label>'+
                                                                                '</span>'+
                                                                            '</div>'+
                                                                        '<label class="col-sm-2" for="bp">Blood Pressure(Systolic/Diastolic):</label>'+
                                                                            '<div class="col-sm-2">'+
                                                                                '<span>'+
                                                                                    '<label class="col-sm-2" for="temperature">'+data.vitalsData[v].systolic_pressure+'/'+data.vitalsData[v].diastolic_pressure+'mm/Hg'+'</label>'+
                                                                                '</span>'+
                                                                            '</div>'+
                                                                    '</div>'+       
                                                                '</div>'+
                                                            '</div>'+
                                                          '</div>'      
                                                        );
                                
                                       

                                }
                            } 
                        }    
                           
                       
                        /*Diagnosis Data*/
                        if(data.diagnosisData!=""){
                            //console.log("-->"+data.diagnosisData.length);
                            for(d=0;d<data.diagnosisData.length;d++){
                                var t = data.diagnosisData[d].created_date.split(/[- :]/);
                                var date = new Date(Date.UTC(t[0], t[1]-1, t[2], t[3], t[4], t[5]));
                                year = String(date.getFullYear());
                                month = String(date.getMonth()+1);
                                day = String(date.getDate());

                                if(month.length==1){  month = "0" + month; }
                                if(day.length==1){  day = "0" + day; }

                                var createdDate = year+'-'+month+'-'+day; 
                                if(createdDate==data.originalCreatedDateDup[i]){
                                    $('#diagnosis'+i).append('<div class="panel-body">'+
                                                                '<div class="col-sm-12">'+
                                                                    '<div class="form-group form-horizontal">'+
                                                                        '<div class="form-group ">'+
                                                                             '<label class="col-sm-2" for="symptoms">Symptoms:</label>'+
                                                                                '<div class="col-sm-10">'+
                                                                                    '<span class="symptoms" id="symptoms">'+
                                                                                        '<select name="symptoms" class = "tokenize-sample"  id => "tokenize'+d+'" multiple => "multiple">'+
                                                                

                                                                                        '</select>'+
                                                                                    '</span>'+
                                                                                '</div>'+    
                                                                        '</div>'+
                                                                    '</div>'+
                                                                '</div>'+
                                                            '</div>'

                                                            );


                                    var str = data.diagnosisData[d].diag_symptoms;
                                    var res = $.parseJSON(str);//JSON.parse("[" + str + "]");
                                   

                                 
                                    for(sym=0;sym<=data.diagnosisData[d].diag_symptoms.length;sym++){
                                        //console.log(sym);
                                        $('.tokenize-sample').append('<option>'+data.diagnosisData[d].diag_symptoms+'</option>') ;  
                                      
                                      
                                    }

                                    $('.tokenize-sample').tokenize();


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
                                                                            '<label class="col-sm-2" for="gravida">Gravida :</label>'+
                                                                                '<div class="col-sm-2">'+
                                                                                    '<span>'+
                                                                                        '<label class="col-sm-2" for="gravida">'+data.obsData[o].gravida+'</label>'+
                                                                                    '</span>'+
                                                                                '</div>'+  
                                                                            '<label class="col-sm-2" for="para">Para :</label>'+
                                                                                '<div class="col-sm-2">'+
                                                                                    '<span>'+
                                                                                        '<label class="col-sm-2" for="para">'+data.obsData[o].para+'</label>'+
                                                                                    '</span>'+
                                                                                '</div>'+ 
                                                                            '<label class="col-sm-2" for="living">Living :</label>'+
                                                                                '<div class="col-sm-2">'+
                                                                                    '<span>'+
                                                                                        '<label class="col-sm-2" for="living">'+data.obsData[o].living+'</label>'+
                                                                                    '</span>'+
                                                                                '</div>'+           
                                                                        '</div>'+
                                                                        '<div class="form-group ">'+
                                                                            '<label class="col-sm-2" for="marriedlife">Married Life :</label>'+
                                                                                '<div class="col-sm-2">'+
                                                                                    '<span>'+
                                                                                        '<label class="col-sm-2" for="marriedlife">'+data.obsData[o].married_life+'</label>'+
                                                                                    '</span>'+
                                                                                '</div>'+ 
                                                                            '<label class="col-sm-2" for="bloodgroup">Blood Group :</label>'+
                                                                                '<div class="col-sm-2">'+
                                                                                    '<span>'+
                                                                                        '<label class="col-sm-2" for="bloodgroup">'+data.obsData[o].husband_blood_group+'</label>'+
                                                                                    '</span>'+
                                                                                '</div>'+ 
                                                                            '<label class="col-sm-2" for="gestationalage">Gestational Age :</label>'+
                                                                                '<div class="col-sm-2">'+
                                                                                    '<span>'+
                                                                                        '<label class="col-sm-2" for="gestationalage">'+data.obsData[o].obs_gestational_age+'</label>'+
                                                                                    '</span>'+
                                                                                '</div>'+         
                                                                        '</div>'+ 
                                                                        '<div class="form-group ">'+
                                                                            '<label class="col-sm-3" for="lastdeliverydate">Last Delivery Date :</label>'+
                                                                                '<div class="col-sm-2">'+
                                                                                    '<span>'+
                                                                                        '<label class="" for="lastdeliverydate">'+data.obsData[o].obs_last_delivery_date+'</label>'+
                                                                                    '</span>'+
                                                                                '</div>'+
                                                                            '<label class="col-sm-4" for="expecteddeliverydate">Expected Delivery Date :</label>'+
                                                                                '<div class="col-sm-3">'+
                                                                                    '<span>'+
                                                                                        '<label class="" for="lastdeliverydate">'+data.obsData[o].obs_expected_delivery_date+'</label>'+
                                                                                    '</span>'+
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
                                                                            '<label class="col-sm-2" for="lmpdate">LMP :</label>'+
                                                                                '<div class="col-sm-2">'+
                                                                                    '<span>'+
                                                                                        '<label class="col-sm-2" for="lmpdate">'+data.obsData[o].obs_lmp_date+'</label>'+
                                                                                    '</span>'+
                                                                                '</div>'+
                                                                            '<label class="col-sm-2" for="lmpflow">Lmp Flow :</label>'+
                                                                                '<div class="col-sm-2">'+
                                                                                    '<span>'+
                                                                                        '<label class="col-sm-2" for="lmpflow">'+data.obsData[o].obs_lmp_flow+'</label>'+
                                                                                    '</span>'+
                                                                                '</div>'+
                                                                            '<label class="col-sm-2" for="lmpdysmenorrhea">Dysmenorrhea:</label>'+
                                                                                '<div class="col-sm-2">'+
                                                                                    '<span>'+
                                                                                        '<label class="col-sm-2" for="lmpdysmenorrhea">'+data.obsData[o].obs_lmp_dysmenorrhea+'</label>'+
                                                                                    '</span>'+
                                                                                '</div>'+
                                                                        '</div>'+
                                                                        '<div class="form-group ">'+
                                                                            '<label class="col-sm-2" for="days">Days :</label>'+
                                                                                '<div class="col-sm-2">'+
                                                                                    '<span>'+
                                                                                        '<label class="col-sm-2" for="days">'+data.obsData[o].obs_lmp_days+'</label>'+
                                                                                    '</span>'+
                                                                                '</div>'+
                                                                            '<label class="col-sm-2" for="cycle">Cycle :</label>'+
                                                                                '<div class="col-sm-2">'+
                                                                                    '<span>'+
                                                                                        '<label class="col-sm-2" for="cycle">'+data.obsData[o].obs_lmp_cycle+'</label>'+
                                                                                    '</span>'+
                                                                                '</div>'+
                                                                            '<label class="col-sm-2" for="menstrualtype">Menstrual Type:</label>'+
                                                                                '<div class="col-sm-2">'+
                                                                                    '<span>'+
                                                                                        '<label class="col-sm-2" for="menstrualtype">'+data.obsData[o].obs_menstrual_type+'</label>'+
                                                                                    '</span>'+
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
                                    
                                    $('#presc-content'+dup).append('<div class="form-group">'+
                                                                        
                                                                        '<div class="col-sm-3">'+
                                                                            data.prescMedicineData[p].drug_name+
                                                                        '</div>'+
                                                                        '<div class="col-sm-2">'+
                                                                           data.prescMedicineData[p].dosage+
                                                                        '</div>'+
                                                                        '<div class="col-sm-2">Morning :'+data.prescMedicineData[p].morning+'</div>'+
                                                                        '<div class="col-sm-2">Noon :'+data.prescMedicineData[p].noon+'</div>'+
                                                                        '<div class="col-sm-2">Night :'+data.prescMedicineData[p].night+'</div>'+
                                                                        '<div class="col-sm-1">'+
                                                                            data.prescMedicineData[p].duration+
                                                                        '</div>'+
                                                                    '</div>' +
                                                                    '<div class="form-group">'+
                                                                        '<div class="col-sm-2">Instruction : '+
                                                                        '</div>'+
                                                                        '<div class="col-sm-10">'+data.prescMedicineData[p].instruction+
                                                                        '</div>'+
                                                                    '</div>'+
                                                                    '<div class="form-group">'+
                                                                        '<hr>'+
                                                                    '</div>'    

                                                            ); 



                                    
                                }
                            }
                           
                            
                           
     
                        }
                        /*$('.prev-inner-content').append('<input type=""button" name="print" value="Print" class="btn btn-primary">');*/
                    }
                  
                    /*Prescription Data ends*/


                    /*Pregnancy Data*/
                    if(data.pregData!=""){
                        for(p=0;p<data.pregData.length;p++){
                            
                            var createdDate = createdDateConvert(data.pregData[p].created_date);
                            for(dup=0;dup<data.originalCreatedDateDup.length;dup++){
                                

                                if(createdDate==data.originalCreatedDateDup[dup]){
                                    
                                    $('#pregnancy'+dup).append('<div class="form-group">'+
                                                                    '<label class="col-sm-3" for="pk">Pregnancy Kind :</label>'+
                                                                        '<div class="col-sm-2">'+
                                                                            '<span>'+
                                                                                '<label class="" for="pk">'+data.pregData[p].obs_preg_kind+'</label>'+
                                                                            '</span>'+
                                                                        '</div>'+    
                                                                    '<label class="col-sm-3" for="pt">Pregnancy Type :</label>'+
                                                                        '<div class="col-sm-2">'+
                                                                            '<span>'+
                                                                                '<label class="" for="pk">'+data.pregData[p].obs_preg_type+'</label>'+
                                                                            '</span>'+
                                                                        '</div>'+
                                                                '</div>'+
                                                                '<div class="form-group">'+
                                                                    '<label class="col-sm-3" for="term">Term :</label>'+
                                                                        '<div class="col-sm-2">'+
                                                                            '<span>'+
                                                                                '<label class="" for="term">'+data.pregData[p].obs_preg_term+'</label>'+
                                                                            '</span>'+
                                                                        '</div>'+    
                                                                        
                                                                   
                                                                    '<label class="col-sm-3" for="abortiontype">Type of Abortion :</label>'+
                                                                        '<div class="col-sm-2">'+
                                                                            '<span>'+
                                                                                '<label class="" for="term">'+data.pregData[p].obs_preg_abortion+'</label>'+
                                                                            '</span>'+
                                                                        '</div>'+    
                                                                        
                                                                   
                                                                   
                                                                '</div>'+
                                                                '<div class="form-group">'+
                                                                    '<label class="col-sm-3" for="health">Health :</label>'+
                                                                        '<div class="col-sm-2">'+
                                                                            '<span>'+
                                                                                '<label class="" for="health">'+data.pregData[p].obs_preg_health+'</label>'+
                                                                            '</span>'+
                                                                        '</div>'+    
                                                                        
                                                                   
                                                                    '<label class="col-sm-3" for="age">Age :</label>'+
                                                                        '<div class="col-sm-4">'+
                                                                            '<span>'+
                                                                                '<label class="" for="year">'+data.pregData[p].obs_preg_years+'Years'+data.pregData[p].obs_preg_weeks+'Weeks'+'</label>'+
                                                                            '</span>'+
                                                                        '</div>'+ 
                                                                          
                                                                '</div>'+         
                                                                '<div class="form-group">'+   
                                                                    '<label class="col-sm-3" for="gender">Gender :</label>'+
                                                                        '<div class="">'+
                                                                            '<span>'+
                                                                                '<label class="" for="gender">'+data.pregData[p].obs_preg_gender+'</label>'+
                                                                            '</span>'+
                                                                        '</div>'+  
                                                                   
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