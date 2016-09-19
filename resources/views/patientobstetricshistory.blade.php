<?php

if(!empty($patientPersonalData)){
	$firstName 	     			= $patientPersonalData->first_name;
	$lastName        			= $patientPersonalData->last_name;

	$patientName = $firstName." ".$lastName;
}
else{
	$newPatientId = Session::get('patientId'); 
	$patientName = "";
}

if(!empty($doctorData)){
	$doctorSpecialization = $doctorData->specialization;
}


?>

@section('head')
	{!!Html::style('assets/plugins/datepicker/css/datepicker.css')!!}
    {!!Html::style('assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css')!!}
    {!!Html::style('assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css')!!}

@stop
@extends('layouts.master', ['specialization'=>$doctorSpecialization,'patientName'=>$patientName])



@section('main')
	<div class="page-header">
		<h1>Patient Obstetrics History <small></small></h1>
	</div>

	<div class="row dd_menarche">
		<div class="col-md-12">
				<?php $error = Session::get('error');
                            $success = Session::get('success');
                            Session::forget('error');
                            Session::forget('success');
                           
                          ?>
	                      @if(!empty($error))
	                        <div class="alert alert-danger display-none" style="display: block;">
	                          <a class="close" aria-hidden="true" href="#" data-dismiss="alert">×</a>
	                                  {{$error}}
	                        </div>
	                      @elseif(!empty($success))
	                        <div class="alert alert-success display-none" style="display: block;">
	                          <a class="close" aria-hidden="true" href="#" data-dismiss="alert">×</a>
	                                  {{$success}}
	                        </div>
	                      @endif
	                     
			<div class="panel">
			
				<div class="panel-body">
					{!! Form::open(array('route' => 'addPatientObstetricsHistory', 'role'=>'form', 'id'=>'addPatientObstetricsHistory', 'class'=>'form-horizontal','novalidate'=>'novalidate')) !!}
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
							    	{!! Form::label('married_life', 'Married Life', $attributes = array('class'=>'col-sm-2 '));  !!}		
									<div class="col-sm-4">
										<span class="">
											{!! Form::text('married_life', (!empty($patientGynObsData)?$patientGynObsData->married_life:Input::old('married_life')), $attributes = array('class'=>'form-control','placeholder' => ''));  !!}
											<!-- <i class=""></i>  -->
										</span>
									</div>
									{!! Form::label('hus_blood_group', 'Husband Blood Group', $attributes = array('class'=>'col-sm-2'));  !!}
									<div class="col-sm-4">
											<span class="">
											@if(!empty($patientGynObsData))
												@if(!empty($patientGynObsData->husband_blood_group))
													{!! Form::text('hus_blood_group', $patientGynObsData->husband_blood_group, $attributes = array('class'=>'form-control','placeholder' => '','readonly'=>'readonly'));  !!}
												@else
													{!! Form::select('hus_blood_group', $bloodGroup, $patientGynObsData->husband_blood_group, $attributes = array('class' => 'form-control')); !!}

													<!-- {!! Form::text('hus_bloodgroup', $patientGynObsData->husband_blood_group, $attributes = array('class'=>'form-control','placeholder' => '','readonly'=>'readonly'));  !!} -->
												@endif	

												<!-- {!! Form::select('hus_bloodgroup', $bloodGroup, $patientGynObsData->husband_blood_group, $attributes = array('class' => 'form-control')); !!} -->
											</span>
											@else
											<span class="">
												{!! Form::select('hus_blood_group', $bloodGroup, null, $attributes = array('class' => 'form-control')); !!}
											</span>	
											@endif

									</div>
							
								</div>
								<div class="form-group">
							    	{!! Form::label('gravida', 'Gravida', $attributes = array('class'=>'col-sm-2'));  !!}		
									<div class="col-sm-4">
										<span class="">
											{!! Form::text('gravida', (!empty($patientGynObsData))?$patientGynObsData->gravida:Input::old('gravida'), $attributes = array('class'=>'form-control','placeholder' => ''));  !!}
											<!-- <i class=""></i>  -->
										</span>
									</div>
									{!! Form::label('para', 'Para', $attributes = array('class'=>'col-sm-2'));  !!}
									<div class="col-sm-4">
										<span class="">
											{!! Form::text('para', (!empty($patientGynObsData))?$patientGynObsData->para:Input::old('para'), $attributes = array('class'=>'form-control','placeholder' => ''));  !!}
											<!-- <i class="fa fa-quote-left"></i>  -->
											</span>
									</div>
								
								</div>
								<div class="form-group">
							    	{!! Form::label('living', 'Living', $attributes = array('class'=>'col-sm-2'));  !!}		
									<div class="col-sm-4">
										<span class="">
											{!! Form::text('living', (!empty($patientGynObsData))?$patientGynObsData->living:Input::old('living'), $attributes = array('class'=>'form-control','placeholder' => ''));  !!}
										<!-- 	<i class=""></i>  -->
										</span>
									</div>
									{!! Form::label('abortion', 'Abortion', $attributes = array('class'=>'col-sm-2 '));  !!}
									<div class="col-sm-4">
										<span class="">
											{!! Form::text('abortion', (!empty($patientGynObsData))?$patientGynObsData->abortion:Input::old('abortion'), $attributes = array('class'=>'form-control','placeholder' => ''));  !!}
										<!-- 	<i class="fa fa-quote-left"></i>  -->
											</span>
									</div>
								
								</div>
								<hr>

								<div class="form-group">
									<div class="col-sm-12">
										<h3>Menstrual History</h3>
									</div>
								</div>
								
								@if(!empty($patientGynObsData))
									<div id="lmp" class="lmp container dd_menarche dd_Menstrual_mg"> 
								 		<input type="hidden" name="lmp_count" id="lmp-count" class="lmp-count">
								 	
								 		<?php
								 			$date1  	= str_replace('/', '-', $patientGynObsData->obs_lmp_date);
								 			//echo $date1;	
								 			if(empty($date1) || $date1=='0000-00-00'){
								 				$obsLmpDate = "";
								 			}
								 			else{
								 				
								 				
								 				$obsLmpDate = date('d-m-Y', strtotime($date1));
								 			}
											
								 		?>
										<div class="form-group">
											{!! Form::label('obs_lmp_date', 'LMP', $attributes = array('class'=>'col-sm-2 dd_pdl_0 '));  !!}
											<div class="col-sm-4 ">
												<span class="">

													{!! Form::text('obs_lmp_date',(!empty($patientGynObsData))?$obsLmpDate : input::old('obs_lmp_date'), $attributes = array('class' => 'form-control obs_lmp_date  dd_relative ', 'data-date-viewmode'=>'years','data-date-format'=>'dd-mm-yyyy')); !!}


													<!-- {!! Form::text('	',(!empty($patientGynObsData))?$obsLmpDate : input::old('obs_lmp_date') , $attributes = array('class' => 'form-control date-picker last_mensus_date', 'data-date-viewmode'=>'years','data-date-format'=>'dd-mm-yyyy')); !!} -->
													<!-- <i class=""></i>  -->
													
												</span>
											</div>
											{!! Form::label('obs_lmp_flow', 'Flow', $attributes = array('class'=>'col-sm-2 
											 '));  !!}
											<div class="col-sm-4">
												<span class="">
													{!! Form::select('obs_lmp_flow', $lmpFlow, (!empty($patientGynObsData))?$patientGynObsData->obs_lmp_flow : Input::get('obs_lmp_flow') , $attributes = array('class' => 'form-control lmp-flow')); !!}
													
												</span>
											</div>
											<!-- {!! Form::label('lmp_flow', 'Flow', $attributes = array('class'=>'col-sm-2  '));  !!}
											<div class="col-sm-4 ">
												<span class="">
													{!! Form::select('lmp_flow[]', $lmpFlow, "null", $attributes = array('class' => 'form-control', 'disabled' => 'disabled')); !!}
													{!! Form::text('lmp_flow', (!empty($patientGynObsData))?$patientGynObsData->obs_lmp_flow : Input::get('lmp_flow') , $attributes = array('class' => 'form-control')); !!}
												</span>
											</div> -->
										</div>
										<div class="form-group">
											<!-- {!! Form::label('dysmenorrhea', 'Dysmenorrhea', $attributes = array('class'=>'col-sm-2 '));  !!}
											<div class="col-sm-4">
												<span class="">
													{!! Form::select('lmp_dysmenorrhea[]', $lmpDysmenohrrea, null, $attributes = array('class' => 'form-control')); !!}
												</span>
											</div> -->
											{!! Form::label('obs_lmp_dysmenorrhea', 'Dysmenorrhea', $attributes = array('class'=>'col-sm-2 dd_pdl_0 '));  !!}
											<div class="col-sm-4 ">
												<span class="">
													{!! Form::select('obs_lmp_dysmenorrhea', $lmpDysmenohrrea, (!empty($patientGynObsData))?$patientGynObsData->obs_lmp_dysmenorrhea : Input::get('obs_lmp_dysmenorrhea'), $attributes = array('class' => 'form-control')); !!}
													
												</span>
											</div>
										<!-- 	{!! Form::label('lmp_dysmenorrhea', 'Dysmenorrhea', $attributes = array('class'=>'col-sm-2 dd_pdl_0 '));  !!}
											<div class="col-sm-4">
												<span class="">
													{!! Form::select('lmp_dysmenorrhea[]', $lmpDysmenohrrea, null, $attributes = array('class' => 'form-control')); !!}
													{!! Form::text('lmp_dysmenorrhea', (!empty($patientGynObsData))?$patientGynObsData->obs_lmp_dysmenorrhea : Input::get('lmp_dysmenorrhea') , $attributes = array('class' => 'form-control')); !!}
													
												</span>
											</div> -->
											{!! Form::label('obs_lmp_days', 'Days', $attributes = array('class'=>'col-sm-2 '));  !!}
											<div class="col-sm-4">
												<span class="">
													{!! Form::text('obs_lmp_days', (!empty($patientGynObsData))?$patientGynObsData->obs_lmp_days : Input::get('obs_lmp_days'), $attributes = array('class'=>'form-control','placeholder' => ''));  !!}
													<!-- <i class="fa fa-quote-left"></i>  -->
													</span>
											</div>
										</div>
										<div class="form-group">
											{!! Form::label('obs_lmp_cycle', 'Cycle', $attributes = array('class'=>'col-sm-2 dd_pdl_0'));  !!}
											<div class="col-sm-4">
												<span class="">
													{!! Form::text('obs_lmp_cycle', (!empty($patientGynObsData))?$patientGynObsData->obs_lmp_cycle : Input::get('obs_lmp_cycle'), $attributes = array('class'=>'form-control','placeholder' => ''));  !!}
													<!-- <i class="fa fa-quote-left"></i> --> 
													</span>
											</div>
											{!! Form::label('obs_menstrual_type', 'Menstrual Type', $attributes = array('class'=>'col-sm-2 '));  !!}
										
													<!-- {!! Form::select('lmp_mensus_type[]', $lmpMensusType, null, $attributes = array('class' => 'form-control')); !!} -->

													<div class="col-sm-4">
														<span class="">
															{!! Form::select('obs_menstrual_type', $lmpMensusType, (!empty($patientGynObsData))?$patientGynObsData->obs_menstrual_type : Input::get('obs_mentrual_type'), $attributes = array('class' => 'form-control')); !!}
															
														</span>
													</div>	
													<!-- {!! Form::text('lmp_mensus_type', (!empty($patientGynObsData))?$patientGynObsData->obs_menstrual_type : Input::get('lmp_mensus_type'), $attributes = array('class'=>'form-control'));  !!} -->
											
											
										</div>	
										<div style="border-bottom: 1px solid #eee; margin: 25px 0"></div>
									
									</div> 
								@else
									<div id="lmp" class="lmp container"> 
									 <input type="hidden" name="lmp_count" id="lmp-count" class="lmp-count">
										<div class="form-group">
										
											{!! Form::label('obs_lmp_date', 'LMP', $attributes = array('class'=>'col-sm-2 dd_pdl_0'));  !!}
											<div class="col-sm-4 ">
												<span class="">
													{!! Form::text('obs_lmp_date',(!empty($patientGynObsData))?$obsLmpDate : input::old('obs_lmp_date'), $attributes = array('class' => 'form-control obs_lmp_date  dd_relative ', 'data-date-viewmode'=>'years','data-date-format'=>'dd-mm-yyyy')); !!}

													<!-- {!! Form::text('obs_lmp_date',Input::old('obs_lmp_date'), $attributes = array('class' => 'form-control date-picker last_mensus_date', 'placeholder'=>'','data-date-viewmode'=>'years','data-date-format'=>'dd-mm-yyyy')); !!} -->
													<!-- <i class=""></i>  -->
													
												</span>
											</div>
											{!! Form::label('obs_lmp_flow', 'Flow', $attributes = array('class'=>'col-sm-2 
											 '));  !!}
											<div class="col-sm-4 dd_pdl_0">
												<span class="">
													{!! Form::select('obs_lmp_flow', $lmpFlow, null, $attributes = array('class' => 'form-control lmp-flow')); !!}
													
												</span>
											</div>
										</div>
										<div class="form-group">
											{!! Form::label('obs_lmp_dysmenorrhea', 'Dysmenorrhea', $attributes = array('class'=>'col-sm-2 dd_pdl_0 '));  !!}
											<div class="col-sm-4 ">
												<span class="">
													{!! Form::select('obs_lmp_dysmenorrhea', $lmpDysmenohrrea, null, $attributes = array('class' => 'form-control')); !!}
													
												</span>
											</div>
											{!! Form::label('obs_lmp_days', 'Days', $attributes = array('class'=>'col-sm-2 '));  !!}
											<div class="col-sm-4 dd_pdl_0">
												<span class="">
													{!! Form::text('obs_lmp_days', Input::old('days'), $attributes = array('class'=>'form-control','placeholder' => ''));  !!}
													<!-- <i class="fa fa-quote-left"></i>  -->
													</span>
											</div>
										</div>
										<div class="form-group">
											{!! Form::label('obs_lmp_cycle', 'Cycle', $attributes = array('class'=>'col-sm-2 dd_pdl_0 '));  !!}
											<div class="col-sm-4">
												<span class="">
													{!! Form::text('obs_lmp_cycle', Input::old('cycle'), $attributes = array('class'=>'form-control','placeholder' => ''));  !!}
													<!-- <i class="fa fa-quote-left"></i>  -->
													</span>
											</div>
											{!! Form::label('obs_menstrual_type', 'Menstrual Type', $attributes = array('class'=>'col-sm-2'));  !!}
											<div class="col-sm-4 dd_pdl_0">
												<span class="">
													{!! Form::select('obs_menstrual_type', $lmpMensusType, null, $attributes = array('class' => 'form-control')); !!}
													
												</span>
											</div>	
										</div>	
									</div>
								@endif
								<!-- 
								<div class="form-group">
									
									<div class="col-sm-12">
										<button type="submit" class="btn btn-default btn-addmore-lmp dd_right" id="btn-addmore-lmp" style="margin-top: 10px">
										<i class="fa fa-plus-circle "></i> Add More LMP</button>
									</div>
								</div>
								<hr> -->
								<div class="form-group">
									<div class="col-sm-4">
										<!-- <i class="fa fa-pencil-square teal"></i> -->
										<h3>Pregnancy</h3>
									</div>
								</div>
								
								@if(!empty($patientGynObsPregData))
									<div class="pregnancy" id="pregnancy">
									@foreach($patientGynObsPregData as $pregDataValue)
										<div class="form-group">
											{!! Form::label('preg_kind', 'Pregnancy Kind', $attributes = array('class'=>'col-sm-2'));  !!}
											<div class="col-sm-4">
												
												<span class="">
													<!-- {!! Form::select('preg_kind[]', $pregKind, null, $attributes = array('class' => 'form-control')); !!} -->
													{!! Form::text('preg_kind[]', (!empty($patientGynObsPregData))?$pregDataValue->obs_preg_kind: Input::old('cycle'), $attributes = array('class'=>'form-control', 'disabled' => 'disabled'));  !!}
													
												</span>
											</div>
											{!! Form::label('pregnancy_type', 'Pregnancy Type', $attributes = array('class'=>'col-sm-2'));  !!}
											<div class="col-sm-4">
												
												<span class="">
													<!-- {!! Form::select('preg_type[]', $pregType, null, $attributes = array('class' => 'form-control')); !!} -->
													{!! Form::text('preg_type[]', (!empty($patientGynObsPregData))?$pregDataValue->obs_preg_type: Input::old('pregnancy_type'), $attributes = array('class'=>'form-control', 'disabled' => 'disabled'));  !!}
													
												</span>
											</div>
											
										</div>
										<div class="form-group">
											{!! Form::label('term', 'Term', $attributes = array('class'=>'col-sm-2'));  !!}
											<div class="col-sm-4">
												<span class="">
													<!-- {!! Form::select('preg_term[]', $pregTerm, null, $attributes = array('class' => 'form-control')); !!} -->
													{!! Form::text('preg_term[]', (!empty($patientGynObsPregData))?$pregDataValue->obs_preg_term: Input::old('term'), $attributes = array('class'=>'form-control', 'disabled' => 'disabled'));  !!}
													
												</span>
											</div>
											{!! Form::label('type_of_abortion', 'Type of abortion', $attributes = array('class'=>'col-sm-2'));  !!}
											<div class="col-sm-4">
												<span class="">
													{!! Form::text('type_of_abortion[]', (!empty($patientGynObsPregData))?$pregDataValue->obs_preg_abortion: Input::old('type_of_abortion'), $attributes = array('class'=>'form-control', 'disabled' => 'disabled'));  !!}
													<!-- <i class="fa fa-quote-left"></i> -->
													 </span>
											</div>
										</div>
										<div class="form-group">
											{!! Form::label('preg_health', 'Health', $attributes = array('class'=>'col-sm-2'));  !!}
											<div class="col-sm-4">
												<span class="">
													<!-- {!! Form::select('preg_health[]', $pregChildHealth, null, $attributes = array('class' => 'form-control')); !!} -->
													{!! Form::text('preg_health[]', (!empty($patientGynObsPregData))?$pregDataValue->obs_preg_health: Input::old('preg_health'), $attributes = array('class'=>'form-control', 'disabled' => 'disabled'));  !!}
													
												</span>
											</div>
											{!! Form::label('age', 'Age', $attributes = array('class'=>'col-sm-2'));  !!}
											<div class="col-sm-2">
												<span class="">
													{!! Form::text('years[]', (!empty($patientGynObsPregData))?$pregDataValue->obs_preg_years: Input::old('years'), $attributes = array('class'=>'form-control','disabled' => 'disabled','placeholder'=>'Years'));  !!}
													<!-- <i class="fa fa-quote-left"></i> -->
													 </span>
											</div>
											
											<div class="col-sm-2">
												<span class="">
													{!! Form::text('weeks[]', (!empty($patientGynObsPregData))?$pregDataValue->obs_preg_weeks: Input::old('weeks'), $attributes = array('class'=>'form-control','disabled' => 'disabled','placeholder'=>'Weeks'));  !!}
													<!-- <i class="fa fa-quote-left"></i> -->
													 </span>
											</div>
											
										</div>
										<div class="form-group">
											{!! Form::label('gender', 'Gender', $attributes = array('class'=>'col-sm-2 '));  !!}
											<div class="col-sm-4">
												
												<span class="">
													<!-- {!! Form::select('gender[]', $gender, null, $attributes = array('class' => 'form-control')); !!} -->
													{!! Form::text('gender[]', (!empty($patientGynObsPregData))?$pregDataValue->obs_preg_gender: Input::old('gender'), $attributes = array('class'=>'form-control','disabled' => 'disabled'));  !!}
													
												</span>
											</div>
										</div>
									
										<div style="border-bottom: 1px solid #eee;  margin: 25px 0"></div>
									@endforeach
									</div>
								@else
									<div class="pregnancy" id="pregnancy">
										<div class="form-group">
											{!! Form::label('preg_kind', 'Pregnancy Kind', $attributes = array('class'=>'col-sm-2'));  !!}
											<div class="col-sm-4">
												
												<span class="">
													{!! Form::select('preg_kind[]', $pregKind, null, $attributes = array('class' => 'form-control')); !!}
												</span>
											</div>
											{!! Form::label('pregnancy_type', 'Pregnancy Type', $attributes = array('class'=>'col-sm-2 '));  !!}
											<div class="col-sm-4">
												
												<span class="">
													{!! Form::select('preg_type[]', $pregType, null, $attributes = array('class' => 'form-control')); !!}
												</span>
											</div>
											
										</div>
										<div class="form-group">
											{!! Form::label('term', 'Term', $attributes = array('class'=>'col-sm-2 '));  !!}
											<div class="col-sm-4">
												<span class="">
													{!! Form::select('preg_term[]', $pregTerm, null, $attributes = array('class' => 'form-control')); !!}
												</span>
											</div>
											{!! Form::label('type_of_abortion', 'Type of abortion', $attributes = array('class'=>'col-sm-2'));  !!}
											<div class="col-sm-4">
												<span class="">
													{!! Form::text('type_of_abortion[]', Input::old('type_of_abortion'), $attributes = array('class'=>'form-control'));  !!}
													<!-- <i class="fa fa-quote-left"></i>  -->
													</span>
											</div>
										</div>
										<div class="form-group">
											{!! Form::label('preg_health', 'Health', $attributes = array('class'=>'col-sm-2'));  !!}
											<div class="col-sm-4">
												<span class="">
													{!! Form::select('preg_health[]', $pregChildHealth, null, $attributes = array('class' => 'form-control')); !!}
												</span>
											</div>
											{!! Form::label('age', 'Age', $attributes = array('class'=>'col-sm-2 '));  !!}
											<div class="col-sm-2">
												<span class="">
													{!! Form::text('years[]', Input::old('years'), $attributes = array('class'=>'form-control','placeholder'=>'Years'));  !!}
											</div>
											
											<div class="col-sm-2">
												<span class="">
													{!! Form::text('weeks[]', Input::old('weeks'), $attributes = array('class'=>'form-control','placeholder'=>'Weeks'));  !!}
											</div>
											
										</div>
										<div class="form-group">
											{!! Form::label('gender', 'Gender', $attributes = array('class'=>'col-sm-2 '));  !!}
											<div class="col-sm-4">
												<span class="">
													{!! Form::select('gender[]', $gender, null, $attributes = array('class' => 'form-control')); !!}
												</span>
											</div>
										</div>
									</div>
								@endif
								<div class="form-group">
									<div class="col-sm-12">
										<button type="submit" class="btn btn-default dd_right btn-addmore-preg"><i class="fa fa-plus-circle " style="border:none"></i> Add More Pregnancy</button>
									</div>
								</div>
								<hr>
								<div class="form-group dd_none_mg_form">
									<?php
									   if(!empty($patientGynObsData)){
									   		if($patientGynObsData->obs_last_delivery_date!='0000-00-00'){
											$lastDeliveryDate = $patientGynObsData->obs_last_delivery_date;
											$date1  = str_replace('/', '-', $lastDeliveryDate);
											$lastDeliveryDate = date('d-m-Y', strtotime($date1));
											}
										
											if($patientGynObsData->obs_expected_delivery_date!='0000-00-00'){
												$expectedDeliveryDate = $patientGynObsData->obs_expected_delivery_date;
												$date2  = str_replace('/', '-', $expectedDeliveryDate);
												$expectedDeliveryDate = date('d-m-Y', strtotime($date2));
											}
									   }
										
									?>
									<div class="col-sm-4 dd_rs_mg">
										<div class="dd_top_mt">Last Delivery Date</div>
										<span class="input-icon">

											{!! Form::text('last_delvery_date',(!empty($patientGynObsData) && $patientGynObsData->obs_last_delivery_date!='0000-00-00')?$lastDeliveryDate:Input::old('last_delivery_date'), $attributes = array('class' => 'form-control last_delivery_date','data-date-viewmode'=>'years','data-date-format'=>'dd-mm-yyyy')); !!}
											<i class="fa fa-calendar" aria-hidden="true"></i>

											<!-- <img src="assets/images/calendre.png"> -->
											
										</span>
									</div>
									<div class="col-sm-4 dd_rs_mg">
										<div class="dd_top_mt">Expected Delivery Date<a href="" class="btn btn-blue btn-xs auto-generate-deliverydate dd_Auto_Generate" >Auto Generate</a></div>

									
										<span class="input-icon">
											<?php     

												$date = !empty($lastLmpDate)?$lastLmpDate->obs_lmp_date:"";

												if(!empty($date)){
													$date = strtotime($date);
													$date = strtotime("+281 days", $date);
													$date = date('d-m-Y', $date);
												}
													

											?>
											{!! Form::hidden('expected_delvery_date_auto',$date,$attributes = array('class' => 'form-control expected_delvery_date_auto')) !!}

											{!! Form::text('expected_delvery_date',(!empty($patientGynObsData) && $patientGynObsData->obs_expected_delivery_date!='0000-00-00')?$expectedDeliveryDate:Input::old('expected_delivery_date'), $attributes = array('class' => 'form-control date-picker expected_delivery_date dd_relative', 'data-date-viewmode'=>'years','data-date-format'=>'dd-mm-yyyy')); !!}
											<i class="fa fa-calendar dd_fa_calender" aria-hidden="true"></i>
										</span>

										
										
								</div>
									
									<div class="col-sm-4 dd_rs_mg">
										<div class="dd_top_mt">Gestational Age</div>
										<span class="">
											{!! Form::text('gestational_age', (!empty($patientGynObsData))?$patientGynObsData->obs_gestational_age:Input::old('obs_gestational_age'), $attributes = array('class'=>'form-control'));  !!}
											<!-- <i class="fa fa-list-ol dd_fa_calender" aria-hidden="true"></i> -->

										 </span>
									</div>
								</div>
							
								<hr>

								<div class="form-group">
									<div class="col-sm-10"></div>
									<div class="col-sm-12">
										<button type="submit" class="btn btn-primary btn-block dd_save "><i class="fa fa-floppy-o"></i> Save</button>
									</div>
								</div>
										
							</div>	


							{!! Form::close() !!}
		
						</div>
			</div>
			<!-- end: FORM VALIDATION 2 PANEL -->
		</div>
	</div>
	<!-- end: PAGE CONTENT-->
		

@stop

@section('scripts')
	@parent
		{!!Html::script('assets/plugins/jquery-inputlimiter/jquery.inputlimiter.1.3.1.min.js')!!}
		{!!Html::script('assets/plugins/autosize/jquery.autosize.min.js')!!}
		{!!Html::script('assets/plugins/select2/select2.min.js')!!}
		{!!Html::script('assets/plugins/jquery.maskedinput/src/jquery.maskedinput.js')!!}
		{!!Html::script('assets/plugins/jquery-maskmoney/jquery.maskMoney.js')!!}

		{!!Html::script('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')!!}
		{!!Html::script('assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js')!!}
		{!!Html::script('assets/plugins/bootstrap-daterangepicker/moment.min.js')!!}
		{!!Html::script('assets/plugins/bootstrap-daterangepicker/daterangepicker.js')!!}
		
		{!!Html::script('assets/js/patient-personal-information.js')!!}

		{!!Html::script('assets/js/moment.js')!!}
		
		{!!Html::script('assets/plugins/jquery-validation/dist/jquery.validate.min.js')!!}
		{!!Html::script('assets/js/patient-personal-information.js')!!}

	<script>
		$(document).ready(function() {

			var lmpFlow 		= <?php echo json_encode($lmpFlow); ?>;
			var lmpDysmenohrrea = <?php echo json_encode($lmpDysmenohrrea); ?>;
			var lmpMensusType 	= <?php echo json_encode($lmpMensusType); ?>;
			var pregKind 		= <?php echo json_encode($pregKind); ?>;
			var pregType 		= <?php echo json_encode($pregType); ?>;
			var pregTerm 		= <?php echo json_encode($pregTerm); ?>;
			var pregHealth 		= <?php echo json_encode($pregChildHealth); ?>;
			var pregGender 		= <?php echo json_encode($gender); ?>;
            //console.log(pregHealth);
            //alert(lmpDysmenohrrea);
			Main.init();
			patientElements.init();


			/*$('body').on('focus',".expected_delivery_date", function(){
					$(this).datepicker();
   			});*/
   			var counter = 1;


   			

			
			
			
		
			$('.btn-addmore-preg').click(function(e){
				e.preventDefault();
				//alert('hai');

				counter ++;
		           
		           
	            //$('#lmp-count').val(counter);
	             $('#pregnancy').append('<div id="dynamic-preg" class="dynamic-preg">' +
		            					
		            					'<div class="form-group">' +
		                                    '<div class="col-sm-4">' +
		                                    '</div>' +
		                              '</div>' +
		                              '<div class="form-group">' +
		                                    '<label class="col-sm-2 ">' +
		                                        'Pregnancy Kind' +
		                                    '</label>' +
		                                    '<div class="col-sm-4">' +
		                                        '<span class="">' +
		                                            '<select name="preg_kind[]" class="form-control preg_kind" id="preg_kind'+counter+'">' +
		                                                
		                                            '</select>' +
		                                        '</span>' +
		                                    '</div>' +
		                                    '<label class="col-sm-2 ">' +
		                                        'Pregnancy Type' +
		                                    '</label>' +
		                                    '<div class="col-sm-4">' +
		                                        '<span class="">' +
		                                            '<select name="preg_type[]" class="form-control preg_type" id="preg_type'+counter+'">' +
		                                                
		                                            '</select>' +
		                                        '</span>' +
		                                    '</div>' +
		                             '</div>' +
		                             '<div class="form-group">' +
		                                    '<label class="col-sm-2 ">' +
		                                        'Pregnancy Term' +
		                                    '</label>' +
		                                    '<div class="col-sm-4">' +
		                                        '<span class="">' +
		                                            '<select name="preg_term[]" class="form-control preg_term" id="preg_term'+counter+'">' +
		                                                
		                                            '</select>' +
		                                        '</span>' +
		                                    '</div>' +
		                                    '<label class="col-sm-2 ">' +
		                                        'Type of abortion' +
		                                    '</label>' +
		                                    '<div class="col-sm-4">' +
		                                        '<span class="">' +
		                                            '<input type="text" name="type_of_abortion[]" id="type_of_abortion'+counter+'" class="form-control type_of_abortion" />' +
		                                        '</span>' +
		                                    '</div>' +
		                             '</div>' +
		                             '<div class="form-group">' +
		                                    '<label  class="col-sm-2 ">' +
		                                        'Health' +
		                                    '</label>' +
		                                   '<div class="col-sm-4">' +
		                                        '<span class="">' +
		                                            '<select name="preg_health[]" class="form-control preg_health" id="preg_health'+counter+'">' +
		                                                
		                                            '</select>' +
		                                        '</span>' +
		                                    '</div>' +
		                                    '<label  class="col-sm-2 ">' +
		                                        'Age' +
		                                    '</label>' +
		                                    '<div class="col-sm-2">' +
		                                        '<span class="">' +
		                                            '<input type="text" name="years[]" id="years'+counter+'" class="form-control years" placeholder="Years"/>' +
		                                        '</span>' +
		                                    '</div>' +
		                                    '<div class="col-sm-2">' +
		                                        '<span class="">' +
		                                            '<input type="text" name="weeks[]" id="weeks'+counter+'" class="form-control weeks" placeholder="Weeks"/>' +
		                                        '</span>' +
		                                    '</div>' +
		                             '</div>' +
		                               '<div class="form-group">' +
		                                    '<label  class="col-sm-2 ">' +
		                                        'Gender' +
		                                    '</label>' +
		                                   '<div class="col-sm-4">' +
		                                        '<span class="">' +
		                                            '<select name="gender[]" class="form-control gender" id="gender'+counter+'">' +
		                                                
		                                            '</select>' +
		                                        '</span>' +
		                                    '</div>' +
		                                '</div>' +    
		                             '<div class="form-group">' +
		                                    '<div class="col-sm-10">' +
		                                    '</div>' +
		                                     '<div class="col-sm-12">' +
		                                            '<input type="button" name="btn-preg-delete" id="btn-preg-delete'+counter+'" class="btn btn-danger  btn-preg-delete pull-right" value="x" />' +
		                                    '</div>' +
		                             '</div>' + 
		                             '</div>' 	
		                            
		         					);


					$('#preg_kind'+counter).empty();
		            for (var key in pregKind) {
					  if (pregKind.hasOwnProperty(key)) {
					    //alert(key + " -> " + lmpFlow[key]);
					   $('#preg_kind'+counter).append($("<option></option>").val(key).html(pregKind[key]));
					  }
					}
					$('#preg_type'+counter).empty();
		            for (var key in pregType) {
					  if (pregType.hasOwnProperty(key)) {
					    //alert(key + " -> " + lmpFlow[key]);
					   $('#preg_type'+counter).append($("<option></option>").val(key).html(pregType[key]));
					  }
					}
					$('#preg_term'+counter).empty();
		            for (var key in pregTerm) {
					  if (pregTerm.hasOwnProperty(key)) {
					    //alert(key + " -> " + lmpFlow[key]);
					   $('#preg_term'+counter).append($("<option></option>").val(key).html(pregTerm[key]));
					  }
					}
					$('#preg_health'+counter).empty();
		            for (var key in pregHealth) {
					  if (pregHealth.hasOwnProperty(key)) {
					    //alert(key + " -> " + lmpFlow[key]);
					   $('#preg_health'+counter).append($("<option></option>").val(key).html(pregHealth[key]));
					  }
					}
					$('#gender'+counter).empty();
		            for (var key in pregGender) {
					  if (pregGender.hasOwnProperty(key)) {
					    //alert(key + " -> " + lmpFlow[key]);
					   $('#gender'+counter).append($("<option></option>").val(key).html(pregGender[key]));
					  }
					}

					//Remving dynamically added preg 
					$('.btn-preg-delete').click(function(){
				
						var row = $(this).closest('.dynamic-preg');
						//console.log(row);
						row.remove();
					});




			});
			
			
        });
	
		function expectedDeliveryDateCalculate(date2){
                date2.setDate(date2.getDate()+280); 
             
                //$('.dropoffDate').datepicker('setDate', date2);
                var day = date2.getDate();
                var month = date2.getMonth() + 1;
                var year  = date2.getFullYear();
                var newDate = day+"-"+month+"-"+year;
              
                var  lmpFormatedDate = moment(newDate, "DD/MM/YYYY").format("DD-MM-YYYY");
                $('.expected_delivery_date').val(lmpFormatedDate);
                //alert(lmpFormatedDate);
            }
            /*$('#obs_lmp_date').change(function() {
              var date2 = $('#obs_lmp_date').val(); 
              //alert(date2);
                expectedDeliveryDateCalculate(date2);
            });*/

            //var date2 = $('#obs_lmp_date').datepicker('getDate', '+1d'); 
                //expectedDeliveryDateCalculate(date2);

            $('.auto-generate-deliverydate').click(function(e){
                e.preventDefault();
                //var date = $('.expected_delvery_date_auto').val();
                //alert(date);
                //$('.expected_delivery_date').datepicker('setDate',date);
                var date2 = $('#obs_lmp_date').datepicker('getDate', '+1d');
               // alert(date2);
               expectedDeliveryDateCalculate(date2);
               // $('.expected_delivery_date').val(date);

            })

      
	</script>
@stop	