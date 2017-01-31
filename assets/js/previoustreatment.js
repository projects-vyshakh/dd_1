var patientPrevElements = function () {
    var runPrevTreatment = function(){

      var defaultYearSelected = $('#year option:selected').val();
      //alert(defaultYearSelected);
        $("body").mLoading({ });
                
     
                       
        $.ajax({
            type: "POST",
            url: "patientprevioustreatmentextended",
            data: 'year='+defaultYearSelected,
            dataType :"JSON",
            success: function(data) {
               //console.log(data.vitalsData[0].id_vitals);
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
            $("body").mLoading({ });
                
            $.ajax({
                type: "POST",
                url: "patientprevioustreatmentextended",
                data: 'year='+defaultYearSelected,
                dataType :"JSON",
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

        if(day<10){ day = '0'+day;  } else { day = day; } //assigning 0 before day
        if(month<10){ month = '0'+month;  } else { month = month; } //assigning 0 before months

        var  createdDate = year+'-'+month+'-'+day; 
        return createdDate

    }
    var runPrevTreatmentData = function(data){
        
        $('#prev-data-div-inner').remove();

        var prescStatusArray = new Array();
        var prescTitleArray  = [];

        $('.prev-data-div').append( 
            '<div class="prev-data-div-inner" id="prev-data-div-inner">'+
                '<div class="row">'+
                    '<div class="col-sm-12">'+
                        '<div class="">'+
                            '<div class="">' +
                                '<div class="row">'+
                                    '<div class="col-sm-12 dd_pd_30">'+
                                        '<div class="tabbable tabs-left">'+
                                            '<ul id="myTab3" class="nav nav-tabs tab-green dd_sidetab mCustomScrollbar  ">'+
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



        if(data.obsData=='' && data.lmpData=='' && data.pregData=='' && data.prescMedicineData=='' &&
           data.vitalsData=='' && data.diagnosisData==''){
            $('#myTab3').hide();
        }
        else{
            $('#myTab3').show();
        }
        
        //This is for hiding dugname,dosage etc if there is no data for prescritpion
        var prescDateArray = [];
        for(k=0;k<data.prescMedicineData.length;k++){
            var dateObj = createdDateConvert(data.prescMedicineData[k].created_date );
            
            prescDateArray.push(dateObj);
        }   


        /*Side date tab loop*/ 
        /*----------------------------------------------------------------------------------*/
        var originalDateArray =[];
        var createdDateArray  =[];
        //console.log(data.originalCreatedDateDup)
        for(i=0;i<data.originalCreatedDateDup.length;i++){
            if(data.originalCreatedDateDup[i]!=null){
                var dateObj = new Date(data.originalCreatedDateDup[i]);
                var month = dateObj.getUTCMonth() + 1; //months from 1-12
                var day = dateObj.getUTCDate();
                var year = dateObj.getUTCFullYear();
                if(day<10){ day = '0'+day;  } else { day = day; } //assigning 0 before day
                if(month<10){ month = '0'+month;  } else { month = month; } //assigning 0 before months
                var formattedDate = day+"-"+month+"-"+year;
            }
            else{
                var formattedDate = null;
            }
            
            //console.log("FormattedDate--"+formattedDate);
            $('#myTab3').append(
                '<li class="content">'+
                    '<a href="#panel_tab4_example1'+i+'" data-toggle="tab">'+formattedDate+'</a>'+
                '</li>'
            );
    
           $('.prev-contents').append(
                '<div class="tab-pane" id="panel_tab4_example1'+i+'">'+
                    '<input type="hidden" name="created_date_hidden" class="created_date_hidden" value="'+data.originalCreatedDateDup[i]+'">'+
                   /* '<p>'+*/
                    '<div class=" dd_prev_margine">'+
                        '<div class="col-sm-12 dd_prev_hd_mg">'+
                            '<div class="tabbable">'+
                                '<ul id="myTab" class="nav nav-tabs tab-bricky dd_sidetab" style="border:0;">'+
                                    '<li class="active" id="dummy">'+
                                        '<a href="#patient'+i+'" data-toggle="tab">'+
                                            '<i class="icon pricon icon-pr-patient2" ng-show="navOption.key"></i> Patient'+
                                        '</a>'+
                                    '</li>'+
                                    '<li class="" id="dummy">'+
                                        '<a href="#diagnosis'+i+'" data-toggle="tab">'+
                                            '<i class="icon pricon icon-pr-Diagnosis2" ng-show="navOption.key"></i> Diagnosis'+
                                        '</a>'+
                                    '</li>'+
                                    '<li class="" id="dummy">'+
                                        '<a href="#prescription'+i+'" data-toggle="tab">'+
                                            '<i class="icon pricon icon-pr-prescriptions2" ng-show="navOption.key"></i> Prescription'+ 
                                        '</a>'+
                                    '</li>'+
                                '</ul>'+
                                '<div class="tab-content prev-inner-content dd_pd_0" style="border:0px;">'+
                                    '<div class="tab-pane in active" id="patient'+i+'">'+
                                        '<div class="tab-pane" id="obs_general'+i+'"></div>'+
                                        '<div class="tab-pane" id="obs_lmp'+i+'"></div>'+
                                        '<div class="tab-pane" id="obs_preg'+i+'"></div>'+
                                    '</div>'+
                                    '<div class="tab-pane" id="diagnosis'+i+'">'+
                                        '<div class="tab-pane" id="diag_vitals'+i+'"></div>'+
                                        '<div class="tab-pane" id="diag_sym'+i+'"></div>'+
                                    '</div>'+
                                    '<div class="tab-pane" id="prescription'+i+'">'+
                                        '<div class="tab-pane " id="presc_title'+i+'">'+
                                            '<div class="panel-body " style="padding-bottom:5px; padding-top:30px;">'+
                                                '<div class="col-sm-12 presc_title">'+
                                                    '<div class="form-group form-horizontal">'+
                                                        '<div class="form-group dd_presc_dummy dd_panel_body_font">'+
                                                            '<div class="col-sm-4">Drug Name'+
                                                            '</div>'+
                                                            '<div class="col-sm-2">Dosage'+
                                                            '</div>'+
                                                            '<div class="col-sm-2">Duration'+
                                                            '</div>'+
                                                            '<div class="col-sm-2">Frequency'+
                                                            '</div>'+
                                                            '<div class="col-sm-2">Start Date'+
                                                            '</div>'+
                                                        '</div>'+
                                                    '</div>'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>'+

                                        

                                        '<div class="tab-pane" id="presc_content'+i+'"></div>'+

                                        '<div class="tab-pane" id="presc_follow'+i+'">'+
                                            '<div class="followup_date" >'+
                                                '<div class="form-horizontal">'+
                                                    '<div class="col-sm-12" style="margin-bottom: 20px">'+
                                                        '<div class="">'+
                                                            '<div class="col-sm-4">Followup Date:'+
                                                            '</div>'+
                                                            '<div class="col-sm-3" id="followup_date'+i+'">'+
                                                            '</div>'+
                                                        '</div>'+
                                                    '</div>'+
                                                '</div>'+
                                        '</div>'+
                                        '<div class="tab-pane" id="presc_treatment'+i+'">'+
                                            '<div class="treatment" >'+
                                                '<div class="form-horizontal">'+
                                                    '<div class="col-sm-12 style="margin-bottom: 20px">'+
                                                        '<div class="">'+
                                                            '<div class="col-sm-4">Treatment:'+
                                                            '</div>'+
                                                            '<div class="col-sm-4" id="treatment_content'+i+'">'+
                                                            '</div>'+
                                                        '</div>'+
                                                    '</div>'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>'+

                                        '<div id="presc_print_btn'+i+'" class="dd_prev_print_btn presc_print_btn" style="margin-top: 20px"></div>'+

                                    '</div>'+

                                '</div>'+    
                            '</div>'+    
                        '</div>'+
                    '</div>'+    
                '</div>'
            );
            //alert('i='+i)
           
            //This is for hiding dugname,dosage etc if there is no data for prescritpion
            if($.inArray(data.originalCreatedDateDup[i],prescDateArray)!==-1){
                $('#presc_follow'+i).show();
                $('#presc_title'+i).show();
                $('#presc_treatment'+i).show();
                $('#presc_print_btn'+i).append('<a style="margin-top:20px" class="btn btn-primary  pdfopen print_width"> Print </a>');
            }
            else{
                $('#presc_title'+i).hide();
                $('#presc_follow'+i).hide();
                $('#presc_treatment'+i).hide();
            }

          

            //General Obs Data

             /*Obstetrics Data*/

            if(data.obsData!=""){
                for(o=0;o<data.obsData.length;o++){
                     var createdDate = createdDateConvert(data.obsData[o].created_date);
                     if(createdDate==data.originalCreatedDateDup[i])
                     {
                        //array.push(createdDateArray,createdDate);
                        //array.push(originalDateArray,data.originalCreatedDateDup[i])
                        var gravida                 = data.obsData[o].gravida;
                        var para                    = data.obsData[o].para;
                        var living                  = data.obsData[o].living;
                        var marriedLife             = data.obsData[o].married_life;
                        var bloodGroup              = data.obsData[o].husband_blood_group;
                        var gestationalAge          = data.obsData[o].obs_gestational_age;
                        var lastDeliveryDate        = data.obsData[o].obs_last_delivery_date;
                        var expectedDeliveryDate    = data.obsData[o].obs_expected_delivery_date;

                        console.log(marriedLife);
                        if(gravida==null || gravida==''){
                            
                            gravida = '';
                        }
                        else{
                            gravida = data.obsData[o].gravida;
                        }
                        if(para==null || para==''){
                            
                            para = '';
                        }
                        else{
                            para = data.obsData[o].para;
                        }
                        if(living==null || living==''){
                            
                            living = '';
                        }
                        else{
                            living = data.obsData[o].living;
                        }
                        if(marriedLife==null || marriedLife==''){
                            
                            marriedLife = '';
                        }
                        else{
                            marriedLife = data.obsData[o].married_life+' '+'Years';
                        }
                        if(bloodGroup==null || bloodGroup==''){
                            
                            bloodGroup = '';
                        }
                        else{
                            bloodGroup = data.obsData[o].husband_blood_group;
                        }
                        if(gestationalAge==null || gestationalAge==''){
                            
                            gestationalAge = '';
                        }
                        else{
                            gestationalAge = data.obsData[o].obs_gestational_age;
                        }
                        if(lastDeliveryDate==null || lastDeliveryDate=='0000-00-00' || lastDeliveryDate==''){
                            
                            lastDeliveryDate = '';
                        }
                        else{
                                lastDeliveryDate = data.obsData[o].obs_last_delivery_date;
                                var dateObj = new Date(lastDeliveryDate);
                                var month   = dateObj.getUTCMonth() + 1; //months from 1-12
                                var day     = dateObj.getUTCDate();
                                var year    = dateObj.getUTCFullYear();
                                var lastDeliveryDate = day+"-"+month+"-"+year;
                        }
                        if(expectedDeliveryDate==null || expectedDeliveryDate=='0000-00-00' || expectedDeliveryDate==''){
                            
                            expectedDeliveryDate = '';
                        }
                        else{
                                expectedDeliveryDate = data.obsData[o].obs_expected_delivery_date;
                                var dateObj = new Date(expectedDeliveryDate);
                                var month   = dateObj.getUTCMonth() + 1; //months from 1-12
                                var day     = dateObj.getUTCDate();
                                var year    = dateObj.getUTCFullYear();
                                var expectedDeliveryDate = day+"-"+month+"-"+year;
                        }
                        //console.log("s"+lastDeliveryDate);

                        if(gravida!=null || para!=null || living!=null || marriedLife!=null || bloodGroup!=null || gestationalAge!=null || lastDeliveryDate!=null || expectedDeliveryDate!=null)
                        {
                            $('#obs_general'+i).append(
                                '<div class="panel-body" style="padding-top:35px;">'+
                                    '<div class="col-sm-12">'+
                                    '<h6>Obstetrics History</h6>'+
                                        '<div class="form-group form-horizontal" style="margin-top:-10px;">'+
                                            '<div class=" ">'+
                                                '<div class="col-sm-12 dd_prev_pd_2 dd_prev_mg_main">'+
                                                '<label class=" pull-left col-sm-4 dd_pd_0 dd_font_left " for="gravida">Gravida</label>'+
                                                    '<div class="dd_prev_color pull-left col-sm-3 dd_pd_0 dd_font_left" for="gravida">: '+gravida+'</div>'+
                                                    '<div class="dd_clear">'+'</div>'+
                                                    '</div>'+ 
                                            '</div>'+
                                            '<div class=" ">'+
                                                '<div class="col-sm-12 dd_prev_pd_2">'+
                                                   '<label class="  pull-left col-sm-3 dd_pd_0 dd_font_left " for="para">Para</label>'+
                                                        '<div class="dd_prev_color pull-left col-sm-3 dd_pd_0 dd_font_left" for="para">: '+para+'</div>'+
                                                        '<div class="dd_clear">'+'</div>'+
                                                '</div>'+ 
                                            '</div>'+ 
                                            '<div class=" ">'+
                                                '<div class="col-sm-12 dd_prev_pd_2">'+
                                                   '<label class="  pull-left col-sm-3 dd_pd_0 dd_font_left " for="living">Living</label>'+
                                                        '<div class="dd_prev_color pull-left col-sm-3 dd_pd_0 dd_font_left" for="living">: '+living+'</div>'+
                                                    '<div class="dd_clear">'+'</div>'+ 
                                                '</div>'+ 
                                            '</div>'+
                                            '<div class=" ">'+
                                                '<div class="col-sm-12 dd_prev_pd_2">'+
                                                    '<label class="  pull-left col-sm-3 dd_pd_0 dd_font_left" for="marriedlife">Married Life</label>'+
                                                        '<div class="dd_prev_color pull-left col-sm-3 dd_pd_0 dd_font_left" for="marriedlife">: '+marriedLife+'</div>'+
                                                        '<div class="dd_clear">'+'</div>'+ 
                                                '</div>'+
                                            '</div>'+
                                            '<div class=" ">'+
                                                '<div class="col-sm-12 dd_prev_pd_2">'+
                                                    '<label class="  pull-left col-sm-3 dd_pd_0 dd_font_left " for="bloodgroup">Blood Group</label>'+
                                                        '<div class="dd_prev_color pull-left col-sm-3 dd_pd_0 dd_font_left" for="bloodgroup">: '+bloodGroup+'</div>'+
                                                        '<div class="dd_clear">'+'</div>'+
                                                '</div>'+ 
                                            '</div>'+
                                            '<div class=" ">'+
                                                '<div class="col-sm-12 dd_prev_pd_2">'+
                                                    '<label class="  pull-left col-sm-3 dd_pd_0 dd_font_left " for="gestationalage">Gestational Age</label>'+
                                                        '<div class=" dd_prev_color pull-left col-sm-3 dd_pd_0 dd_font_left" for="gestationalage">: '+gestationalAge+'</div>'+
                                                '</div>'+ 
                                                '<div class="dd_clear">'+'</div>'+          
                                            '</div>'+ 
                                            '<div class="" >'+
                                                '<div class="col-sm-12 dd_prev_pd_2">'+
                                                    '<label class="  pull-left col-sm-3 dd_pd_0 dd_font_left " for="lastdeliverydate">Last Delivery Date</label>'+
                                                        '<div class=" dd_prev_color pull-left col-sm-3 dd_pd_0 dd_font_left" for="lastdeliverydate">: '+lastDeliveryDate+'</div>'+
                                                        '<div class="dd_clear">'+'</div>'+  
                                                '</div>'+
                                            '</div>'+
                                            '<div class=" ">'+
                                                '<div class="col-sm-12 dd_prev_pd_2">'+        
                                                    '<label class="  pull-left col-sm-3 dd_pd_0 dd_font_left " for="expecteddeliverydate">Expected Delivery Date</label>'+
                                                        '<div class=" dd_prev_color pull-left col-sm-3 dd_pd_0 dd_font_left" pull-left dd_prev_colorfor="lastdeliverydate">: '+expectedDeliveryDate+'</div>'+
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
            }
            /*Obstetrics Data ends*/ 

            // Menstrual History
            if(data.obsData!=""){
                for(o=0;o<data.obsData.length;o++){
                    var createdDate = createdDateConvert(data.obsData[o].created_date);
                        if(createdDate==data.originalCreatedDateDup[i])
                        {
                            if(data.obsData[o].obs_lmp_date==null || data.obsData[o].obs_lmp_date=='0000-00-00'){
                                lmpDate = '';
                            }
                            else{
                                var dateObj = new Date(data.obsData[o].obs_lmp_date);
                                var month   = dateObj.getUTCMonth() + 1; //months from 1-12
                                var day     = dateObj.getUTCDate();
                                var year    = dateObj.getUTCFullYear();
                                var lmpDate = day+"-"+month+"-"+year;
                            }

                            $('#obs_lmp'+i).append(
                                '<div class="panel-body" style="padding-top:15px;">'+
                                    '<div class="col-sm-12">'+
                                        '<h6>Menstrual History</h6>'+
                                        '<div class="form-group form-horizontal" style="margin-top:-10px;">'+
                                            '<div class="">'+
                                                '<div class="col-sm-12 dd_prev_pd_2 dd_prev_mg_main">'+
                                                    '<label class="pull-left col-sm-3 dd_pd_0 dd_font_left " for="lmpdate">LMP </label>'+
                                                        '<div class="dd_prev_color pull-left col-sm-3 dd_pd_0 dd_font_left" for="lmpdate">:'+'&nbsp;'+lmpDate+'</div>'+
                                                            '<div class="dd_clear">'+ '</div>'+       
                                                '</div>'+
                                            '</div>'+

                                            '<div class="">'+
                                                '<div class="col-sm-12 dd_prev_pd_2">'+
                                                    '<label class="pull-left col-sm-3 dd_pd_0 dd_font_left " for="lmpflow">Lmp Flow  '+' '+'</label>'+
                                                        '<div class="dd_prev_color pull-left col-sm-3 dd_pd_0 dd_font_left" for="lmpflow">:'+'&nbsp;'+data.obsData[o].obs_lmp_flow+'</div>'+
                                                            '<div class="dd_clear">'+ '</div>'+
                                                '</div>'+
                                            '</div>'+

                                            '<div class="">'+
                                                '<div class="col-sm-12 dd_prev_pd_2">'+
                                                    '<label class="pull-left col-sm-3 dd_pd_0 dd_font_left " for="lmpdysmenorrhea">Dysmenorrhea '+' '+'</label>'+
                                                        '<div class="dd_prev_color pull-left col-sm-3 dd_pd_0 dd_font_left" for="lmpdysmenorrhea">:'+'&nbsp;'+data.obsData[o].obs_lmp_dysmenorrhea+'</div>'+
                                                            '<div class="dd_clear">'+ '</div>'+       
                                                '</div>'+
                                            '</div>'+

                                            '<div class="">'+
                                                '<div class="col-sm-12 dd_prev_pd_2">'+
                                                    '<label class="pull-left col-sm-3 dd_pd_0 dd_font_left " for="days">Days  '+' '+'</label>'+
                                                        '<div class="dd_prev_color pull-left col-sm-3 dd_pd_0 dd_font_left" for="days">:'+'&nbsp;'+data.obsData[o].obs_lmp_days+'</div>'+
                                                            '<div class="dd_clear">'+ '</div>'+       
                                                '</div>'+  
                                            '</div>'+

                                            '<div class="">'+
                                                '<div class="col-sm-12 dd_prev_pd_2">'+
                                                    '<label class="pull-left col-sm-3 dd_pd_0 dd_font_left " for="cycle">Cycle  '+' '+'</label>'+
                                                        '<div class="dd_prev_color pull-left col-sm-3 dd_pd_0 dd_font_left" for="cycle">:'+'&nbsp;'+data.obsData[o].obs_lmp_cycle+'</div>'+
                                                            '<div class="dd_clear">'+ '</div>'+  
                                                '</div>'+           
                                            '</div>'+

                                            '<div class="">'+
                                                '<div class="col-sm-12 dd_prev_pd_2">'+
                                                    '<label class="pull-left col-sm-3 dd_pd_0 dd_font_left " for="menstrualtype">Menstrual Type '+' '+'</label>'+
                                                        '<div class="dd_prev_color pull-left col-sm-3 dd_pd_0 dd_font_left" for="menstrualtype">:'+'&nbsp;'+data.obsData[o].obs_menstrual_type+'</div>'+
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

            // Menstrual History ends


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
                        $('#diag_vitals'+i).append(
                            '<div class="panel-body" style="padding-top:35px;">'+
                                '<div class="col-sm-12">'+
                                    '<h6>Vitals</h6>'+
                                    '<div class="form-group form-horizontal" style="margin-top:-10px;">'+
                                        '<div class=" ">'+
                                            '<div class="col-sm-12 dd_prev_pd_2  dd_prev_mg_main">'+
                                               '<label class="pull-left col-sm-4 dd_pd_0 dd_font_left " for="weight">Weight</label>'+
                                                    '<div class="dd_prev_color pull-left col-sm-4 dd_pd_0 dd_font_left" for="weight">: '+data.vitalsData[v].weight+' '+'Kg'+'</div>'+
                                                        '<div class="dd_clear">'+'</div>'+
                                            '</div>'+
                                          
                                            '<div class="col-sm-12 dd_prev_pd_2">'+
                                            '<label class="pull-left col-sm-4 dd_pd_0 dd_font_left " for="height">Height</label>'+
                                            
                                            '<div class="dd_prev_color pull-left col-sm-4 dd_pd_0 dd_font_left" for="height"> : '+data.vitalsData[v].height+' '+'cm'+'</div>'+
                                                '<div class="dd_clear">'+'</div>'+   
                                                '</div>'+


                                            '<div class="col-sm-12 dd_prev_pd_2 ">'+   
                                            '<label class=" pull-left col-sm-4 dd_pd_0 dd_font_left " fdd_font_leftor="bmi">BMI</label>'+
                                                
                                                '<div class="dd_prev_color  col-sm-4 dd_pd_0 dd_font_left" for="bmi"> : '+data.vitalsData[v].bmi+' '+'bmi'+'</div>'+
                                                '<div class="dd_clear">'+'</div>'+  
                                                '</div>'+
                                        '</div>'+


                                        '<div class="">'+

                                        '<div class="col-sm-12 dd_prev_pd_2 ">'+  
                                           /* '<label class="pull-left" for="bmi">BMI:</label>'+*/
                                            '<label class="pull-left col-sm-4 dd_pd_0 dd_font_left 0" for="Pulse ">Pulse </label>'+
                                                
                                            '<div class="dd_prev_color col-sm-4 dd_pd_0 dd_font_left " for="weight"> : '+data.vitalsData[v].pulse+' '+'beats / min'+'</div>'+
                                             '<div class="dd_clear">'+'</div>'+         
                                            '</div>'+


                                        '<div class="col-sm-12 dd_prev_pd_2 ">'+         
                                            '<label class="pull-left col-sm-4 dd_pd_0 dd_font_left 0" for="resipiratory">Respiratory Rate </label>'+
                                            
                                            '<div class="dd_prev_color col-sm-4 dd_pd_0 dd_font_left" for="resipiratory"> : '+data.vitalsData[v].respiratoryrate+' '+'breathes/min'+'</div>'+
                                            '<div class="dd_clear">'+'</div>'+   
                                            '</div>'+

                                            '<div class="col-sm-12 dd_prev_pd_2">'+ 
                                            '<label class=" pull-left col-sm-4 dd_pd_0 dd_font_left 0" for="temperature">Temperature</label>'+
                                              
                                            '<div class="dd_prev_color col-sm-4 dd_pd_0 dd_font_left" for="temperature"> : '+data.vitalsData[v].temperature+' '+'Fahrenheit'+'</div>'+
                                            '<div class="dd_graclear">'+'</div>'+        
                                             '</div>'+
                                        '</div>'+ 


                                        '<div class="">'+

                                        '<div class="col-sm-12 dd_prev_pd_2 ">'+ 
                                            '<label class="pull-left col-sm-4 dd_pd_0 dd_font_left 0" for="spo2 ">SPO2</label>'+
                               
                                                '<div class="dd_prev_color col-sm-4 dd_pd_0 dd_font_left" for="spo2"> : '+data.vitalsData[v].sp+'%'+'</div>'+
                                                '<div class="dd_clear">'+'</div>'+     
                                        '</div>'+

                                        '<div class="col-sm-12 dd_prev_pd_2 ">'+ 
                                            '<label class="pull-left col-sm-4 dd_pd_0 dd_font_left 0" for="blood_group">Blood Group </label>'+
                                             
                                                '<div class="dd_prev_color col-sm-4 dd_pd_0 dd_font_left" for="blood_group"> : '+data.vitalsData[v].blood_group+'</div>'+
                                                '<div class="dd_clear">'+'</div>'+  
                                        '</div>'+


                                        '<div class="col-sm-12 dd_prev_pd_2">'+ 
                                            '<label class="pull-left pull-left col-sm-4 dd_pd_0 dd_font_left 0 " for="bp">Blood Pressure(Systolic/Diastolic)</label>'+
                                              
                                                        '<div class="dd_prev_color col-sm-4 dd_pd_0 dd_font_left" for="temperature"> : '+data.vitalsData[v].systolic_pressure+'/'+data.vitalsData[v].diastolic_pressure+' '+'mm/Hg'+'</div>'+
                                                   
                                                '</div>'+
                                        '</div>'+       
                                    '</div>'+
                                '</div>'+
                            '</div>'      
                        );
                   
                    }
                } 
            }    
            // Vitals ends 

            if(data.diagnosisData!=""){
                for(d=0;d<data.diagnosisData.length;d++){
                    
                    var createdDate = createdDateConvert(data.diagnosisData[d].created_date);
                   
                   
                    if(createdDate==data.originalCreatedDateDup[i]){
                        var str = data.diagnosisData[d].diag_symptoms;
                        var res = JSON.parse(str);//JSON.parse("[" + str + "]");

                        $('#diag_sym'+i).append(
                            '<div class="panel-body" style="padding-top:15px;">'+
                                '<div class="col-sm-12">'+
                                    '<h6>Symptoms & Suspected Diseases</h6>'+
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
                          '</div>'
                        );

                        
                        //appending symptoms
                        if(res!=null){
                            for(r=0;r<res.length;r++){
                                var index = r+1;
                                $('#sym-data'+d).append('<label class="col-sm-10 " for="sym">'+index+'. '+res[r]+'</label>')
                            } 
                        }
                        
                                   

                        
                        //appending diseases
                        var diseaseStr = data.diagnosisData[d].diag_suspected_diseases;
                        var diseaseRes = JSON.parse(diseaseStr);//JSON.parse("[" + str + "]");
                        var array = diseaseRes.toString().split(",");
                        
                        for(dis=0;dis<array.length;dis++){
                            var index = dis+1;
                            
                            $('#dis-data'+d).append('<label class="col-sm-10" for="diseases">'+index+'. '+array[dis]+'</label>')
                        }

                        

              
                    }    




                }
            }             

            /*if(data.prescMedicineData!=null){
                console.log(prescTitleArray);
                $('#presc_title'+i).append(
                    '<div class="panel-body ">'+
                        '<div class="col-sm-12">'+
                            '<div class="form-group form-horizontal">'+
                                '<div class="form-group dd_presc_dummy dd_panel_body_font">'+
                                    '<div class="col-sm-4">DrugName'+
                                    '</div>'+
                                    '<div class="col-sm-2">Dosage'+
                                    '</div>'+
                                    '<div class="col-sm-2">Duration'+
                                    '</div>'+
                                    '<div class="col-sm-4">Frequecy'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                    '</div>'
                );
            }*/

        }



        /*Pregnancy Data*/
        
        if(data.pregData!=""){
            for(p=0;p<data.pregData.length;p++){
                
                var createdDate = createdDateConvert(data.pregData[p].created_date);
                for(dup=0;dup<data.originalCreatedDateDup.length;dup++){
                    

                    if(createdDate==data.originalCreatedDateDup[dup]){
                        
                        $('#obs_preg'+dup).append(
                            '<div class="panel-body"style="padding-top:15px;">'+
                                '<div class="col-sm-12">'+
                                '<h6>Pregnancy History</h6>'+
                                    '<div class="form-group form-horizontal" style="margin-top:-10px;">'+
                                        '<div class=" ">'+
                                            '<div class="col-sm-12 dd_prev_pd_2 dd_prev_mg_main">'+
                                            '<label class=" pull-left col-sm-3 dd_pd_0 dd_font_left " for="pk">Pregnancy Kind:</label>'+
                                                '<div class="dd_prev_color pull-left col-sm-3 dd_pd_0 dd_font_left" for="pk">: '+data.pregData[p].obs_preg_kind+'</div>'+
                                                '<div class="dd_clear">'+'</div>'+
                                                '</div>'+ 
                                        '</div>'+
                                        '<div class=" ">'+
                                            '<div class="col-sm-12 dd_prev_pd_2">'+
                                               '<label class="  pull-left col-sm-3 dd_pd_0 dd_font_left " for="pt">Pregnancy Type:</label>'+
                                                    '<div class="dd_prev_color pull-left col-sm-3 dd_pd_0 dd_font_left" for="pt">: '+data.pregData[p].obs_preg_type+'</div>'+
                                                    '<div class="dd_clear">'+'</div>'+
                                            '</div>'+ 
                                        '</div>'+ 
                                        '<div class=" ">'+
                                            '<div class="col-sm-12 dd_prev_pd_2">'+
                                               '<label class="  pull-left col-sm-3 dd_pd_0 dd_font_left " for="term">Term:</label>'+
                                                    '<div class="dd_prev_color pull-left col-sm-3 dd_pd_0 dd_font_left" for="term">: '+data.pregData[p].obs_preg_term+'</div>'+
                                                '<div class="dd_clear">'+'</div>'+ 
                                            '</div>'+ 
                                        '</div>'+
                                        '<div class=" ">'+
                                            '<div class="col-sm-12 dd_prev_pd_2">'+
                                                '<label class="  pull-left col-sm-3 dd_pd_0 dd_font_left " for="ta">Type of Abortion:</label>'+
                                                    '<div class="dd_prev_color pull-left col-sm-3 dd_pd_0 dd_font_left" for="ta">: '+data.pregData[p].obs_preg_abortion+'</div>'+
                                                    '<div class="dd_clear">'+'</div>'+ 
                                            '</div>'+
                                        '</div>'+
                                        '<div class=" ">'+
                                            '<div class="col-sm-12 dd_prev_pd_2">'+
                                                '<label class="  pull-left col-sm-3 dd_pd_0 dd_font_left " for="health">Health:</label>'+
                                                    '<div class="dd_prev_color pull-left col-sm-3 dd_pd_0 dd_font_left" for="health">: '+data.pregData[p].obs_preg_health+'</div>'+
                                                    '<div class="dd_clear">'+'</div>'+
                                            '</div>'+ 
                                        '</div>'+
                                        '<div class=" ">'+
                                            '<div class="col-sm-12 dd_prev_pd_2">'+
                                                '<label class="  pull-left col-sm-3 dd_pd_0 dd_font_left " for="age">Age:</label>'+
                                                    '<div class=" dd_prev_color pull-left col-sm-3 dd_pd_0 dd_font_left" for="age">: '+data.pregData[p].obs_preg_years+'Years'+' | '+data.pregData[p].obs_preg_weeks+''+'Weeks'+'</div>'+
                                            '</div>'+ 
                                            '<div class="dd_clear">'+'</div>'+          
                                        '</div>'+ 
                                    '</div>'+ 
                                '</div>'+ 
                            '</div>'

                          

                        ); 

                    }
                    else{
                        /*$('#obs_preg'+dup).append(
                            '<div class="panel-body">'+
                                '<div class="col-sm-12">'+
                                    '<h3>Pregnancy History</h3>'+
                                
                                    '<div class="form-group form-horizontal">'+
                                        'No pregnancy data entered.'+
                                    '</div>'+
                                '</div>'+
                            '</div>'
                        );*/
                    }
                }
            }
            
        }

      
        /*Pegnancy Data ends*/


        /*Prescription Data*/
        if(data.prescMedicineData!=null){
           
            //alert(JSON.stringify(data.prescMedicineData));

            var followUpDateArray = new Array();
            
            for(p=0;p<data.prescMedicineData.length;p++){
                var createdDate  = createdDateConvert(data.prescMedicineData[p].created_date);
               
                var followUpDate = data.prescMedicineData[p].follow_up_date;
                var treatment    = data.prescMedicineData[p].treatment;
                //alert(treatment)
                //alert(createdDate)
                //alert(JSON.stringify( treatment));
               

                if(followUpDate=='0000-00-00' || followUpDate==null){
                    followUpDate = " ";
                }
                else{
                    var dateObj = new Date(followUpDate);
                    var month   = dateObj.getUTCMonth() + 1; //months from 1-12
                    var day     = dateObj.getUTCDate();
                    var year    = dateObj.getUTCFullYear();
                    
                    (day<10)?day = '0'+day:day=day;
                    (month<10)?month = '0'+month:month=month;

                     followUpDate = day+"-"+month+"-"+year;
                }
                


                
                for(dup=0;dup<data.originalCreatedDateDup.length;dup++){
                     
                    if(createdDate==data.originalCreatedDateDup[dup]){
                        
                        
                        
                       
                        if(data.prescMedicineData[p].dosage=='' || data.prescMedicineData[p].dosage==0){
                            var dosage = '--';
                        }
                        else{
                            var dosage = data.prescMedicineData[p].dosage+' '+data.prescMedicineData[p].dosage_unit;
                        }

                        if(data.prescMedicineData[p].duration=='' || data.prescMedicineData[p].duration==0){
                            var duration = '--';
                        }
                        else{
                            var duration = data.prescMedicineData[p].duration+' '+data.prescMedicineData[p].duration_unit;
                        }

                        if(data.prescMedicineData[p].morning=='' || data.prescMedicineData[p].morning==0){
                            var morning = '--';
                        }
                        else{
                            var morning = data.prescMedicineData[p].morning;
                        }
                        if(data.prescMedicineData[p].noon=='' || data.prescMedicineData[p].noon==0){
                            var noon = '--';
                        }
                        else{
                            var noon = data.prescMedicineData[p].noon;
                        }
                        if(data.prescMedicineData[p].night=='' || data.prescMedicineData[p].night==0){
                            var night = '--';
                        }
                        else{
                            var night = data.prescMedicineData[p].night;
                        }

                        if(data.prescMedicineData[p].start_date=='' || data.prescMedicineData[p].start_date=='0000-00-00'){
                            var startDate = '--';
                        }
                        else{
                            
                            var dateObj = new Date(data.prescMedicineData[p].start_date);
                            var month   = dateObj.getUTCMonth() + 1; //months from 1-12
                            var day     = dateObj.getUTCDate();
                            var year    = dateObj.getUTCFullYear();

                            (day<10)?day = '0'+day:day=day;
                            (month<10)?month = '0'+month:month=month;

                            var startDate = day+"-"+month+"-"+year;
                        }


                         
                        $('#presc_content'+dup).append(
                            '<div class="panel-body dd_panel_body_pd">'+
                                '<div class="col-sm-12">'+
                                    '<div class="form-group form-horizontal">'+
                                        '<div class="form-group  dd_panel_body_font">'+
                                            '<div class="col-sm-4"><li class="dd_drug_name_li">'+
                                                data.prescMedicineData[p].drug_name+
                                            '</li></div>'+
                                            '<div class="col-sm-2">'+
                                                dosage+
                                            '</div>'+
                                            '<div class="col-sm-2">'+
                                               duration+
                                            '</div>'+
                                            '<div class="col-sm-2">'+
                                              
                                                morning+' - '+
                                                noon+' - '+
                                                night+
                                               
                                            '</div>'+
                                            '<div class="col-sm-2">'+
                                                startDate+
                                            '</div>'+
                                        '</div>'+

                                    '</div>'+
                                '</div>'+
                            '</div>'



                            
          


                        );


                        //followUpDateArray.push(followUpDate);




                        $('#followup_date'+dup).append(
                            '<div class="followup_date_data" id="followup_date_data'+dup+'">'+followUpDate+'</div>'
                        );

                        $('#treatment_content'+dup).append(
                            '<div class="treatment_data" id="treatment_data'+dup+'">'+treatment+'</div>'
                        );

                    }
                    
                }

               
                
            }
            var divFollowUpDateFind = $('.followup_date').find('.followup_date_data').hide( );
            var divTreatmentFind    = $('.treatment').find('.treatment_data').hide( );
            
            $.each(divFollowUpDateFind,function(index){
                $('.followup_date').find('#followup_date_data'+index).show();
               
                //followUpDateArray.push(index)
            });

            $.each(divTreatmentFind,function(index){
                $('.treatment').find('#treatment_data'+index).show();
               
                //followUpDateArray.push(index)
            })
            

        }

        $('.pdfopen').click(function(){
            var createdDate = $(this).closest('.prev-contents').find('.active').find('.created_date_hidden').val();
            //console.log(createdDate);
            $("body").mLoading({  });

            $.ajax({
                type: "POST",
                url: "patientprevioustreatmentprint",
                data: 'created_date='+createdDate,
                success: function(data) {
                  
                   if(data!=""){
                    
                        $("body").mLoading('hide');
                        $('#myModal3').modal('show');
                        $('iframe').remove();
                        $('.pdf_print').append('<iframe src="storage/pdf/'+data+'.pdf" style="width:780px;height:500px;"></iframe>');
                   }
                   
                },
            });
    

           
        });
                

                   
    }
  
    return {
        //main function to initiate template pages
        init: function () {
           runPrevTreatment();
           
        }
    };
}();