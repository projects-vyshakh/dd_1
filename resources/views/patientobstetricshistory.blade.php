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

    {!!Html::style('assets/plugins/zebra-datepicker/css/default.css')!!}
    {!!Html::style('assets/plugins/zebra-datepicker/css/style.css')!!}


    
@stop
@extends('layouts.master', ['specialization'=>$doctorSpecialization,'patientName'=>$patientName])



@section('main')
	
	<div class="page-header">
		<h1>Patient Obstetrics History <small></small></h1>
	</div>

	<!-- Modal Box for showing no lmp date is entered on click of auto generate edd -->


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
								 				
								 				
								 				$obsLmpDate = date('Y-m-d', strtotime($date1));
								 			}
											
								 		?>
										<div class="form-group">
											{!! Form::label('obs_lmp_date', 'LMP', $attributes = array('class'=>'col-sm-2 dd_pdl_0 '));  !!}
											<div class="col-sm-4 ">
												<span class="input-icon">

													{!! Form::text('obs_lmp_date',(!empty($patientGynObsData))?$obsLmpDate : input::old('obs_lmp_date'), $attributes = array('class' => 'form-control obs_lmp_date  dd_relative ')); !!}
													<i class="fa fa-calendar" aria-hidden="true"></i>

													<!-- <input id="datepicker-example1" type="text"> -->
												
													
												</span>
											</div>
											{!! Form::label('obs_lmp_flow', 'Flow', $attributes = array('class'=>'col-sm-2 
											 '));  !!}
											<div class="col-sm-4">
												<span class="">
													{!! Form::select('obs_lmp_flow', $lmpFlow, (!empty($patientGynObsData))?$patientGynObsData->obs_lmp_flow : Input::get('obs_lmp_flow') , $attributes = array('class' => 'form-control lmp-flow')); !!}
													
												</span>
											</div>
											
										</div>
										<div class="form-group">
											
											{!! Form::label('obs_lmp_dysmenorrhea', 'Dysmenorrhea', $attributes = array('class'=>'col-sm-2 dd_pdl_0 '));  !!}
											<div class="col-sm-4 ">
												<span class="">
													{!! Form::select('obs_lmp_dysmenorrhea', $lmpDysmenohrrea, (!empty($patientGynObsData))?$patientGynObsData->obs_lmp_dysmenorrhea : Input::get('obs_lmp_dysmenorrhea'), $attributes = array('class' => 'form-control')); !!}
													
												</span>
											</div>
										
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
												<span class="input-icon">
													{!! Form::text('obs_lmp_date',(!empty($patientGynObsData))?$obsLmpDate : input::old('obs_lmp_date '), $attributes = array('class' => 'form-control obs_lmp_date  dd_relative ')); !!}

													<i class="fa fa-calendar" aria-hidden="true"></i>
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
								
								<div class="form-group">
									<div class="col-sm-8">
										<!-- <i class="fa fa-pencil-square teal"></i> -->
										<h3>Pregnancy</h3>
									</div>
									<div class="col-sm-3 pull-right dd_pregnancy_Count">
										<!-- <i class="fa fa-pencil-square teal"></i> -->
										<h5>
											
											@if(!empty($pregnancyCount) || $pregnancyCount>0)
												<b>( Pregnancy-Count: {{$pregnancyCount}} )</b>
											@else
												<b>( Pregnancy-Count: 0 )</b>
											@endif
										</h5>
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
											{!! Form::label('gender', 'Gender', $attributes = array('class'=>'col-sm-2 '));  !!}
											<div class="col-sm-4">
												
												<span class="">
													<!-- {!! Form::select('gender[]', $gender, null, $attributes = array('class' => 'form-control')); !!} -->
													{!! Form::text('gender[]', (!empty($patientGynObsPregData))?$pregDataValue->obs_preg_gender: Input::old('gender'), $attributes = array('class'=>'form-control','disabled' => 'disabled'));  !!}
													
												</span>
											</div>
											
										</div>


										<div class="form-group">

													{!! Form::label('age', 'Baby-Age', $attributes = array('class'=>'col-sm-2'));  !!}

													<div class="col-sm-4 dd_babyage_col">
														<div class="col-sm-4">
																<span class="">	
																	<?php $babyWeeks = $pregDataValue->obs_preg_weeks." "."Weeks"; ?>
				
																	{!! Form::text('weeks[]', $babyWeeks, $attributes = array('class'=>'form-control','disabled' => 'disabled','placeholder'=>'Weeks'));  !!}
																	<!-- <i class="fa fa-quote-left"></i> -->
																</span>
														</div>
														<div class="col-sm-4">
															<span class="">
																<?php $babyMonths = $pregDataValue->obs_preg_months." "."Months"; ?>
			
																{!! Form::text('months[]', $babyMonths , $attributes = array('class'=>'form-control','disabled' => 'disabled','placeholder'=>'Months'));  !!}
																<!-- <i class="fa fa-quote-left"></i> -->
																 </span>
														</div>
														<div class="col-sm-4">
															<span class="">
																<?php $babyYears = $pregDataValue->obs_preg_years." "."Years"; ?>
			
																{!! Form::text('years[]',$babyYears, $attributes = array('class'=>'form-control','disabled' => 'disabled','placeholder'=>'Years'));  !!}
																<!-- <i class="fa fa-quote-left"></i> -->
															</span>
														</div>
												</div> 

											
										</div>
									
										<!-- <div style="border-bottom: 1px solid #eee;  margin: 25px 0"></div> -->
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
											{!! Form::label('gender', 'Gender', $attributes = array('class'=>'col-sm-2 '));  !!}
											<div class="col-sm-4">
												<span class="">
													{!! Form::select('gender[]', $gender, null, $attributes = array('class' => 'form-control')); !!}
												</span>
											</div>
										</div>
										<div class="form-group">
												{!! Form::label('years', 'Baby-Age', $attributes = array('class'=>'col-sm-2'));  !!}

													<div class="col-sm-4 dd_babyage_col">
																<div class="col-sm-4">
																		<span class="">
																			{!! Form::text('weeks[]', Input::old('weeks'), $attributes = array('class'=>'form-control','placeholder'=>'Weeks'));  !!}
																		</span>
																</div>
																<div class="col-sm-4">
																	<span class="">
																		{!! Form::text('months[]',Input::old('months'), $attributes = array('class'=>'form-control','placeholder'=>'Months'));  !!}
																		<!-- <i class="fa fa-quote-left"></i> -->
																	</span>
																</div>
																<div class="col-sm-4">
																	<span class="">
																		{!! Form::text('years[]', Input::old('years'), $attributes = array('class'=>'form-control','placeholder'=>'Years'));  !!}
																</div>
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
									   		if($patientGynObsData->obs_last_delivery_date!='0000-00-00')
									   		{
												$lastDeliveryDate = $patientGynObsData->obs_last_delivery_date;
												$date1  		  = str_replace('/', '-', $lastDeliveryDate);
												$lastDeliveryDate = date('Y-m-d', strtotime($date1));
											}
											else{
												$lastDeliveryDate = "";
											}
										
											if($patientGynObsData->obs_expected_delivery_date!='0000-00-00')
											{
												$expectedDeliveryDate = $patientGynObsData->obs_expected_delivery_date;
												$date2  			  = str_replace('/', '-', $expectedDeliveryDate);
												$expectedDeliveryDate = date('Y-m-d', strtotime($date2));
											}
											else{
												$expectedDeliveryDate = "";
											}
									   }
										
									?>
									<div class="col-sm-4 dd_rs_mg">
										<div class="dd_top_mt">Last Delivery Date</div>
											<span class="input-icon">
												@if(!empty($patientGynObsData->obs_last_delivery_date) && ($patientGynObsData->obs_last_delivery_date!='0000-00-00'))

													{!! Form::text('last_delvery_date',$lastDeliveryDate , $attributes = array('class' => 'form-control last_delivery_date','id'=>'last_delivery_date')); !!}
													<i class="fa fa-calendar" aria-hidden="true"></i>
												@else
													{!! Form::text('last_delvery_date',Input::old('last_delivery_date'), $attributes = array('class' => 'form-control last_delivery_date','id'=>'last_delivery_date')); !!}
													<i class="fa fa-calendar" aria-hidden="true"></i>
												@endif
											
											
											</span>
									</div>
									<div class="col-sm-4 dd_rs_mg">
										<div class="dd_top_mt">Expected Delivery Date
											<a href="" class="btn btn-blue btn-xs auto-generate-deliverydate dd_Auto_Generate" >Auto Generate</a>
										</div>
										<span class="input-icon">
											@if(!empty($patientGynObsData) && ($patientGynObsData->obs_expected_delivery_date!='0000-00-00'))
												{!! Form::text('expected_delvery_date',$expectedDeliveryDate, $attributes = array('class' => 'form-control expected_delivery_date dd_relative','id'=>'expected_delivery_date','readonly'=>'readonly')); !!}
												<i class="fa fa-calendar" aria-hidden="true"></i>
											@else
												{!! Form::text('expected_delvery_date',Input::old('expected_delivery_date'), $attributes = array('class' => 'form-control expected_delivery_date dd_relative','id'=>'expected_delivery_date','readonly'=>'readonly')); !!}
												<i class="fa fa-calendar" aria-hidden="true"></i>
											@endif
										
											
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
										<button type="submit" class="btn btn-primary btn-block dd_save "><!-- <i class="fa fa-floppy-o"></i> --> Save</button>
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
		{!!Html::script('assets/js/gyn-obstetrics-history.js')!!}

		{!!Html::script('assets/js/moment.js')!!}
		
		{!!Html::script('assets/plugins/jquery-validation/dist/jquery.validate.min.js')!!}
		{!!Html::script('assets/js/patient-personal-information.js')!!}

		{!!Html::script('assets/plugins/zebra-datepicker/js/zebra_datepicker.js')!!}
		{!!Html::script('assets/plugins/zebra-datepicker/js/core.js')!!}

		{!!Html::script('assets/plugins/bootbox/bootbox.min.js')!!}

        
       

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
			//patientElements.init();
			obstetricsElements.init();


			//Page Loader closing
			$(window).load(function() {
				$(".loader").fadeOut("slow");
			})

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
		                               		'<label  class="col-sm-2 ">' +
		                                        'Baby-Age' +
		                                    '</label>' +

		                                    /*'<label  class="col-sm-1 ">' +
		                                        'Years' +
		                                    '</label>' +*/

		                                    '<div class="col-sm-4 dd_babyage_col">' +
												'<div class="col-sm-4">' +
		                                        '<span class="">' +
		                                            '<input type="text" name="weeks[]" id="weeks'+counter+'" class="form-control weeks" placeholder="Weeks"/>' +
		                                        '</span>' +
		                                    '</div>' +
		                                     '<div class="col-sm-4">' +
		                                        '<span class="">' +
		                                            '<input type="text" name="months[]" id="months'+counter+'" class="form-control months" placeholder="Months"/>' +
		                                        '</span>' +
		                                    '</div>' +
		                                        '<div class="col-sm-4">' +
		                                        '<span class="">' +
		                                            '<input type="text" name="years[]" id="years'+counter+'" class="form-control years" placeholder="Years"/>' +
		                                        '</span>' +
		                                    	'</div>' +

		                                   

		                                    


		                                    '</div>'+
		                                

		                                  /*  '<label  class="col-sm-1 ">' +
		                                        'Months' +
		                                    '</label>' +*/
		                                

		                                    /*'<label  class="col-sm-1 ">' +
		                                        'Weeks' +
		                                    '</label>' +*/
		                                    


		                                    
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
	
		

      
	</script>
@stop	