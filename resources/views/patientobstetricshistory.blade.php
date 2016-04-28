@section('head')
	{!!Html::style('assets/plugins/datepicker/css/datepicker.css')!!}
    {!!Html::style('assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css')!!}
    {!!Html::style('assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css')!!}

@stop
@extends('layouts.master')

@section('main')
	<div class="page-header">
		<h1>Obstetrics History <small></small></h1>
	</div>

<!-- start: MODAL PANEL -->
	
			<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
								&times;
							</button>
							<h4 class="modal-title">Confirm Remove</h4>
						</div>
						<div class="modal-body">
							<p>
								Are you sure you want to remove?
							</p>
						</div>
						<div class="modal-footer">
							<button aria-hidden="true" data-dismiss="modal" class="btn btn-default">
								Cancel
							</button>
							<button class="btn btn-default btn-lmp-remove" data-dismiss="modal">
								Ok
							</button>
						</div>
					</div>
				</div>
			</div>
	
	<!-- end: MODAL PANEL -->

	
	<div class="row">
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
	                     
			<div class="panel panel-default">
				<div class="panel-heading">

					<i class="fa fa-external-link-square"></i>
					Patient Id : <b>@if(!empty($patientPersonalData)) {{$patientPersonalData->id_patient}} @else {{Session::get('patientId')}} @endif</b>
					<div class="panel-tools">
						Date : <b> <?php echo $nowDate = date('d-M-Y'); ?> </b>
					</div>
				</div> 
				
				<div class="panel-body">
					{!! Form::open(array('route' => 'addPatientObstetricsHistory', 'role'=>'form', 'id'=>'addPatientObstetricsHistory', 'class'=>'form-horizontal','novalidate'=>'novalidate')) !!}
						<div class="row">
							<div class="col-md-12">

								<div class="form-group">
							    	{!! Form::label('married_life', 'Married Life', $attributes = array('class'=>'col-sm-2 control-label'));  !!}		
									<div class="col-sm-4">
										<span class="input-icon">
											{!! Form::text('married_life', (!empty($patientGynObsData)?$patientGynObsData->married_life:Input::old('married_life')), $attributes = array('class'=>'form-control','placeholder' => 'Married Life'));  !!}
											<i class="fa fa-user"></i> 
										</span>
									</div>
									{!! Form::label('hus_bloodgroup', 'Husband Blood Group', $attributes = array('class'=>'col-sm-2 control-label'));  !!}
									<div class="col-sm-4">
										<span class="input-icon">
											{!! Form::text('hus_bloodgroup', (!empty($patientGynObsData))?$patientGynObsData->husband_blood_group:Input::old('hus_bloodgroup'), $attributes = array('class'=>'form-control','placeholder' => 'Husband Blood Group'));  !!}
											<i class="fa fa-quote-left"></i> </span>
									</div>
							
								</div>
								<div class="form-group">
							    	{!! Form::label('gravida', 'Gravida', $attributes = array('class'=>'col-sm-2 control-label'));  !!}		
									<div class="col-sm-4">
										<span class="input-icon">
											{!! Form::text('gravida', (!empty($patientGynObsData))?$patientGynObsData->gravida:Input::old('gravida'), $attributes = array('class'=>'form-control','placeholder' => 'Gravida'));  !!}
											<i class="fa fa-user"></i> 
										</span>
									</div>
									{!! Form::label('para', 'Para', $attributes = array('class'=>'col-sm-2 control-label'));  !!}
									<div class="col-sm-4">
										<span class="input-icon">
											{!! Form::text('para', (!empty($patientGynObsData))?$patientGynObsData->para:Input::old('para'), $attributes = array('class'=>'form-control','placeholder' => 'Para'));  !!}
											<i class="fa fa-quote-left"></i> </span>
									</div>
								
								</div>
								<div class="form-group">
							    	{!! Form::label('living', 'Living', $attributes = array('class'=>'col-sm-2 control-label'));  !!}		
									<div class="col-sm-4">
										<span class="input-icon">
											{!! Form::text('living', (!empty($patientGynObsData))?$patientGynObsData->living:Input::old('living'), $attributes = array('class'=>'form-control','placeholder' => 'Living'));  !!}
											<i class="fa fa-user"></i> 
										</span>
									</div>
									{!! Form::label('abortion', 'Abortion', $attributes = array('class'=>'col-sm-2 control-label'));  !!}
									<div class="col-sm-4">
										<span class="input-icon">
											{!! Form::text('abortion', (!empty($patientGynObsData))?$patientGynObsData->abortion:Input::old('abortion'), $attributes = array('class'=>'form-control','placeholder' => 'Aborition'));  !!}
											<i class="fa fa-quote-left"></i> </span>
									</div>
								
								</div>
								<hr>

								<div class="form-group">
									<div class="col-sm-4">
										<h3>Last-Menstrual Period[LMP]</h3>
									</div>
									
										
								</div>
							
								@if(!empty($patientGynObsLmpData))
									<div id="lmp" class="col-sm-12 lmp" style="padding-top:30px"> 
								 		<input type="hidden" name="lmp_count" id="lmp-count" class="lmp-count">
								 	@foreach($patientGynObsLmpData as $value)
								 		<?php
								 			$date1  		 		= str_replace('/', '-', $value->obs_lmp_date);
											$obsLmpDate 			= date('d/m/Y', strtotime($date1));
								 		?>
										<div class="form-group">
								
											{!! Form::label('last_mensus_date', 'Date', $attributes = array('class'=>'col-sm-2 control-label'));  !!}
											<div class="col-sm-4">
												<span class="input-icon">
													{!! Form::text('last_mensus_date[]',(!empty($patientGynObsLmpData))?$obsLmpDate : input::old('last_mensus_date') , $attributes = array('class' => 'form-control ', 'placeholder'=>'Select date','data-date-viewmode'=>'years','data-date-format'=>'dd/mm/yyyy', 'disabled' => 'disabled')); !!}
													<i class="fa fa-user"></i> 
													
												</span>
											</div>
											{!! Form::label('lmp_flow', 'Flow', $attributes = array('class'=>'col-sm-2 control-label'));  !!}
											<div class="col-sm-4">
												<span class="input-icon">
													<!-- {!! Form::select('lmp_flow[]', $lmpFlow, "null", $attributes = array('class' => 'form-control', 'disabled' => 'disabled')); !!} -->
													{!! Form::text('lmp_flow[]', (!empty($patientGynObsLmpData))?$value->obs_lmp_flow : Input::get('lmp_flow') , $attributes = array('class' => 'form-control', 'disabled' => 'disabled')); !!}
												</span>
											</div>
										</div>
										<div class="form-group">
											<!-- {!! Form::label('dysmenorrhea', 'Dysmenorrhea', $attributes = array('class'=>'col-sm-2 control-label'));  !!}
											<div class="col-sm-4">
												<span class="input-icon">
													{!! Form::select('lmp_dysmenorrhea[]', $lmpDysmenohrrea, null, $attributes = array('class' => 'form-control')); !!}
												</span>
											</div> -->
											{!! Form::label('lmp_dysmenorrhea', 'Dysmenorrhea', $attributes = array('class'=>'col-sm-2 control-label'));  !!}
											<div class="col-sm-4">
												<span class="input-icon">
													<!-- {!! Form::select('lmp_dysmenorrhea[]', $lmpDysmenohrrea, null, $attributes = array('class' => 'form-control')); !!} -->
													{!! Form::text('lmp_dysmenorrhea[]', (!empty($patientGynObsLmpData))?$value->obs_lmp_dysmenorrhea : Input::get('lmp_dysmenorrhea') , $attributes = array('class' => 'form-control', 'disabled' => 'disabled')); !!}
													
												</span>
											</div>
											{!! Form::label('days', 'Days', $attributes = array('class'=>'col-sm-2 control-label'));  !!}
											<div class="col-sm-4">
												<span class="input-icon">
													{!! Form::text('days[]', (!empty($patientGynObsLmpData))?$value->obs_lmp_days : Input::get('days'), $attributes = array('class'=>'form-control','placeholder' => 'Days', 'disabled' => 'disabled'));  !!}
													<i class="fa fa-quote-left"></i> </span>
											</div>
										</div>
										<div class="form-group">
											{!! Form::label('cycle', 'Cycle', $attributes = array('class'=>'col-sm-2 control-label'));  !!}
											<div class="col-sm-4">
												<span class="input-icon">
													{!! Form::text('cycle[]', (!empty($patientGynObsLmpData))?$value->obs_lmp_cycle : Input::get('cycle'), $attributes = array('class'=>'form-control','placeholder' => 'Cycle', 'disabled' => 'disabled'));  !!}
													<i class="fa fa-quote-left"></i> </span>
											</div>
											{!! Form::label('lmp_mensus_type', 'Menstrual Type', $attributes = array('class'=>'col-sm-2 control-label'));  !!}
											<!-- <div class="col-sm-4">
												<label class="radio-inline">
													<input type="radio" class="grey" value="Regular" name="mensus_type[]" id="regular">
													Regular
												</label>
												<label class="radio-inline">
													<input type="radio" class="grey" value="Irregular" name="mensus_type[]"  id="irregular">
													Irregular
												</label>
											</div> -->
											<div class="col-sm-4">
												<span class="input-icon">
													<!-- {!! Form::select('lmp_mensus_type[]', $lmpMensusType, null, $attributes = array('class' => 'form-control')); !!} -->
													{!! Form::text('lmp_mensus_type[]', (!empty($patientGynObsLmpData))?$value->obs_menstrual_type : Input::get('lmp_mensus_type'), $attributes = array('class'=>'form-control', 'disabled' => 'disabled'));  !!}
													
												</span>
											</div>	
										</div>	
										<div style="border-bottom: 1px solid #999;margin-bottom: 20px"></div>
									@endforeach
									</div> 
								@else
									<div id="lmp" class="col-sm-12 lmp" style="padding-top:30px"> 
									 <input type="hidden" name="lmp_count" id="lmp-count" class="lmp-count">
										<div class="form-group">
										
											{!! Form::label('last_mensus_date', 'Date', $attributes = array('class'=>'col-sm-2 control-label'));  !!}
											<div class="col-sm-4">
												<span class="input-icon">
													{!! Form::text('last_mensus_date[]',Input::old('last_mensus_date'), $attributes = array('class' => 'form-control date-picker', 'placeholder'=>'Select date','data-date-viewmode'=>'years','data-date-format'=>'mm/dd/yyyy')); !!}
													<i class="fa fa-user"></i> 
													
												</span>
											</div>
											{!! Form::label('lmp_flow', 'Flow', $attributes = array('class'=>'col-sm-2 control-label'));  !!}
											<div class="col-sm-4">
												<span class="input-icon">
													{!! Form::select('lmp_flow[]', $lmpFlow, null, $attributes = array('class' => 'form-control')); !!}
													
												</span>
											</div>
										</div>
										<div class="form-group">
											<!-- {!! Form::label('dysmenorrhea', 'Dysmenorrhea', $attributes = array('class'=>'col-sm-2 control-label'));  !!}
											<div class="col-sm-4">
												<span class="input-icon">
													{!! Form::select('lmp_dysmenorrhea[]', $lmpDysmenohrrea, null, $attributes = array('class' => 'form-control')); !!}
												</span>
											</div> -->
											{!! Form::label('lmp_dysmenorrhea', 'Dysmenorrhea', $attributes = array('class'=>'col-sm-2 control-label'));  !!}
											<div class="col-sm-4">
												<span class="input-icon">
													{!! Form::select('lmp_dysmenorrhea[]', $lmpDysmenohrrea, null, $attributes = array('class' => 'form-control')); !!}
													
												</span>
											</div>
											{!! Form::label('days', 'Days', $attributes = array('class'=>'col-sm-2 control-label'));  !!}
											<div class="col-sm-4">
												<span class="input-icon">
													{!! Form::text('days[]', Input::old('days'), $attributes = array('class'=>'form-control','placeholder' => 'Days'));  !!}
													<i class="fa fa-quote-left"></i> </span>
											</div>
										</div>
										<div class="form-group">
											{!! Form::label('cycle', 'Cycle', $attributes = array('class'=>'col-sm-2 control-label'));  !!}
											<div class="col-sm-4">
												<span class="input-icon">
													{!! Form::text('cycle[]', Input::old('cycle'), $attributes = array('class'=>'form-control','placeholder' => 'Cycle'));  !!}
													<i class="fa fa-quote-left"></i> </span>
											</div>
											{!! Form::label('lmp_mensus_type', 'Menstrual Type', $attributes = array('class'=>'col-sm-2 control-label'));  !!}
											<!-- <div class="col-sm-4">
												<label class="radio-inline">
													<input type="radio" class="grey" value="Regular" name="mensus_type[]" id="regular">
													Regular
												</label>
												<label class="radio-inline">
													<input type="radio" class="grey" value="Irregular" name="mensus_type[]"  id="irregular">
													Irregular
												</label>
											</div> -->
											<div class="col-sm-4">
												<span class="input-icon">
													{!! Form::select('lmp_mensus_type[]', $lmpMensusType, null, $attributes = array('class' => 'form-control')); !!}
													
												</span>
											</div>	
										</div>	
									</div>
								@endif
								
								<div class="form-group">
									
									<div class="col-sm-12">
										<button type="submit" class="btn btn-default btn-addmore-lmp" id="btn-addmore-lmp" style="margin-top: 10px"><i class="fa fa-plus-circle "></i> Add More LMP</button>
									</div>
								</div>
								<hr>
								<div class="form-group">
									<div class="col-sm-4">
										<!-- <i class="fa fa-pencil-square teal"></i> -->
										<h3>Pregnancy</h3>
									</div>
								</div>
								<div class="pregnancy" id="pregnancy">
								@if(!empty($patientGynObsPregData))
									@foreach($patientGynObsPregData as $pregDataValue)
										<div class="form-group">
											{!! Form::label('preg_kind', 'Pregnancy Kind', $attributes = array('class'=>'col-sm-2 control-label'));  !!}
											<div class="col-sm-4">
												<!-- <label class="radio-inline">
													<input type="radio" class="grey" value="" name="preg_kind" id="preg_vaginal">
													Vaginal
												</label>
												<label class="radio-inline">
													<input type="radio" class="grey" value="" name="preg_kind"  id="preg_cesarean">
													Cesarean
												</label> -->
												<span class="input-icon">
													<!-- {!! Form::select('preg_kind[]', $pregKind, null, $attributes = array('class' => 'form-control')); !!} -->
													{!! Form::text('preg_kind[]', (!empty($patientGynObsPregData))?$pregDataValue->obs_preg_kind: Input::old('cycle'), $attributes = array('class'=>'form-control', 'disabled' => 'disabled'));  !!}
													<i class="fa fa-quote-left"></i> 

													
												</span>
											</div>
											{!! Form::label('pregnancy_type', 'Pregnancy Type', $attributes = array('class'=>'col-sm-2 control-label'));  !!}
											<div class="col-sm-4">
												<!-- <label class="radio-inline">
													<input type="radio" class="grey" value="" name="" id="">
													Normal
												</label>
												<label class="radio-inline">
													<input type="radio" class="grey" value="" name=""  id="">
													Forceps
												</label>
												<label class="radio-inline">
													<input type="radio" class="grey" value="" name=""  id="">
													Vaccum
												</label> -->
												<span class="input-icon">
													<!-- {!! Form::select('preg_type[]', $pregType, null, $attributes = array('class' => 'form-control')); !!} -->
													{!! Form::text('preg_type[]', (!empty($patientGynObsPregData))?$pregDataValue->obs_preg_type: Input::old('pregnancy_type'), $attributes = array('class'=>'form-control', 'disabled' => 'disabled'));  !!}
													
												</span>
											</div>
											
										</div>
										<div class="form-group">
											{!! Form::label('term', 'Term', $attributes = array('class'=>'col-sm-2 control-label'));  !!}
											<div class="col-sm-4">
												<span class="input-icon">
													<!-- {!! Form::select('preg_term[]', $pregTerm, null, $attributes = array('class' => 'form-control')); !!} -->
													{!! Form::text('preg_term[]', (!empty($patientGynObsPregData))?$pregDataValue->obs_preg_term: Input::old('term'), $attributes = array('class'=>'form-control', 'disabled' => 'disabled'));  !!}
													
												</span>
											</div>
											{!! Form::label('type_of_abortion', 'Type of abortion', $attributes = array('class'=>'col-sm-2 control-label'));  !!}
											<div class="col-sm-4">
												<span class="input-icon">
													{!! Form::text('type_of_abortion[]', (!empty($patientGynObsPregData))?$pregDataValue->obs_preg_abortion: Input::old('type_of_abortion'), $attributes = array('class'=>'form-control', 'disabled' => 'disabled'));  !!}
													<i class="fa fa-quote-left"></i> </span>
											</div>
										</div>
										<div class="form-group">
											{!! Form::label('preg_health', 'Health', $attributes = array('class'=>'col-sm-2 control-label'));  !!}
											<div class="col-sm-4">
												<span class="input-icon">
													<!-- {!! Form::select('preg_health[]', $pregChildHealth, null, $attributes = array('class' => 'form-control')); !!} -->
													{!! Form::text('preg_health[]', (!empty($patientGynObsPregData))?$pregDataValue->obs_preg_health: Input::old('preg_health'), $attributes = array('class'=>'form-control', 'disabled' => 'disabled'));  !!}
													
												</span>
											</div>
											{!! Form::label('age', 'Age', $attributes = array('class'=>'col-sm-2 control-label'));  !!}
											<div class="col-sm-2">
												<span class="input-icon">
													{!! Form::text('years[]', (!empty($patientGynObsPregData))?$pregDataValue->obs_preg_years: Input::old('years'), $attributes = array('class'=>'form-control','disabled' => 'disabled'));  !!}
													<i class="fa fa-quote-left"></i> </span>
											</div>
											
											<div class="col-sm-2">
												<span class="input-icon">
													{!! Form::text('weeks[]', (!empty($patientGynObsPregData))?$pregDataValue->obs_preg_weeks: Input::old('weeks'), $attributes = array('class'=>'form-control','disabled' => 'disabled'));  !!}
													<i class="fa fa-quote-left"></i> </span>
											</div>
											
										</div>
										<div class="form-group">
											{!! Form::label('gender', 'Gender', $attributes = array('class'=>'col-sm-2 control-label'));  !!}
											<div class="col-sm-4">
												<!-- <label class="radio-inline">
													<input type="radio" class="grey" value="" name="gender" id="gender_female">
													Female
												</label>
												<label class="radio-inline">
													<input type="radio" class="grey" value="" name="gender"  id="gender_male">
													Male
												</label> -->
												<span class="input-icon">
													<!-- {!! Form::select('gender[]', $gender, null, $attributes = array('class' => 'form-control')); !!} -->
													{!! Form::text('gender[]', (!empty($patientGynObsPregData))?$pregDataValue->obs_preg_gender: Input::old('gender'), $attributes = array('class'=>'form-control','disabled' => 'disabled'));  !!}
													
												</span>
											</div>
										</div>
									
										<div style="border-bottom: 1px solid #999;margin-bottom: 20px"></div>
									@endforeach
								</div>
								@else
									<div class="form-group">
											{!! Form::label('preg_kind', 'Pregnancy Kind', $attributes = array('class'=>'col-sm-2 control-label'));  !!}
											<div class="col-sm-4">
												<!-- <label class="radio-inline">
													<input type="radio" class="grey" value="" name="preg_kind" id="preg_vaginal">
													Vaginal
												</label>
												<label class="radio-inline">
													<input type="radio" class="grey" value="" name="preg_kind"  id="preg_cesarean">
													Cesarean
												</label> -->
												<span class="input-icon">
													{!! Form::select('preg_kind[]', $pregKind, null, $attributes = array('class' => 'form-control')); !!}
												</span>
											</div>
											{!! Form::label('pregnancy_type', 'Pregnancy Type', $attributes = array('class'=>'col-sm-2 control-label'));  !!}
											<div class="col-sm-4">
												<!-- <label class="radio-inline">
													<input type="radio" class="grey" value="" name="" id="">
													Normal
												</label>
												<label class="radio-inline">
													<input type="radio" class="grey" value="" name=""  id="">
													Forceps
												</label>
												<label class="radio-inline">
													<input type="radio" class="grey" value="" name=""  id="">
													Vaccum
												</label> -->
												<span class="input-icon">
													{!! Form::select('preg_type[]', $pregType, null, $attributes = array('class' => 'form-control')); !!}
												</span>
											</div>
											
										</div>
										<div class="form-group">
											{!! Form::label('term', 'Term', $attributes = array('class'=>'col-sm-2 control-label'));  !!}
											<div class="col-sm-4">
												<span class="input-icon">
													{!! Form::select('preg_term[]', $pregTerm, null, $attributes = array('class' => 'form-control')); !!}
												</span>
											</div>
											{!! Form::label('type_of_abortion', 'Type of abortion', $attributes = array('class'=>'col-sm-2 control-label'));  !!}
											<div class="col-sm-4">
												<span class="input-icon">
													{!! Form::text('type_of_abortion[]', Input::old('type_of_abortion'), $attributes = array('class'=>'form-control'));  !!}
													<i class="fa fa-quote-left"></i> </span>
											</div>
										</div>
										<div class="form-group">
											{!! Form::label('preg_health', 'Health', $attributes = array('class'=>'col-sm-2 control-label'));  !!}
											<div class="col-sm-4">
												<span class="input-icon">
													{!! Form::select('preg_health[]', $pregChildHealth, null, $attributes = array('class' => 'form-control')); !!}
												</span>
											</div>
											{!! Form::label('age', 'Age', $attributes = array('class'=>'col-sm-2 control-label'));  !!}
											<div class="col-sm-2">
												<span class="input-icon">
													{!! Form::text('years[]', Input::old('years'), $attributes = array('class'=>'form-control'));  !!}
											</div>
											
											<div class="col-sm-2">
												<span class="input-icon">
													{!! Form::text('weeks[]', Input::old('weeks'), $attributes = array('class'=>'form-control','disabled' => 'disabled'));  !!}
											</div>
											
										</div>
										<div class="form-group">
											{!! Form::label('gender', 'Gender', $attributes = array('class'=>'col-sm-2 control-label'));  !!}
											<div class="col-sm-4">
												<!-- <label class="radio-inline">
													<input type="radio" class="grey" value="" name="gender" id="gender_female">
													Female
												</label>
												<label class="radio-inline">
													<input type="radio" class="grey" value="" name="gender"  id="gender_male">
													Male
												</label> -->
												<span class="input-icon">
													{!! Form::select('gender[]', $gender, null, $attributes = array('class' => 'form-control')); !!}
												</span>
											</div>
										</div>
								</div>
								@endif
								<div class="form-group">
									<div class="col-sm-2">
										<button type="submit" class="btn btn-default btn-addmore-preg"><i class="fa fa-plus-circle "></i> Add More Pregnancy</button>
									</div>
								</div>
								<hr>
								<div class="form-group">
									<?php

										$lastDeliveryDate = (!empty($patientGynObsData)?$patientGynObsData->obs_last_delivery_date:null);
										$expectedDeliveryDate = (!empty($patientGynObsData)?$patientGynObsData->obs_expected_delivery_date:null);
										$date1  = str_replace('/', '-', $lastDeliveryDate);
										$lastDeliveryDate = date('d/m/Y', strtotime($date1));

										$date2  = str_replace('/', '-', $expectedDeliveryDate);
										$expectedDeliveryDate = date('d/m/Y', strtotime($date2));

									?>
									{!! Form::label('last_delvery_date', 'Last Delivery Date(LDD)', $attributes = array('class'=>'col-sm-2 control-label'));  !!}
									<div class="col-sm-4">
										<span class="input-icon">
											{!! Form::text('last_delvery_date',(!empty($patientGynObsData))?$lastDeliveryDate:Input::old('last_delivery_date'), $attributes = array('class' => 'form-control date-picker', 'placeholder'=>'Select date','data-date-viewmode'=>'years','data-date-format'=>'dd/mm/yyyy')); !!}
											<i class="fa fa-user"></i> 
											
										</span>
									</div>
									{!! Form::label('expected_delvery_date', 'Expected Delivery Date(EDD)', $attributes = array('class'=>'col-sm-2 control-label'));  !!}
									<div class="col-sm-4">
										<span class="input-icon">
											{!! Form::text('expected_delvery_date',(!empty($patientGynObsData))?$expectedDeliveryDate:Input::old('expected_delivery_date'), $attributes = array('class' => 'form-control date-picker', 'placeholder'=>'Select date','data-date-viewmode'=>'years','data-date-format'=>'dd/mm/yyyy')); !!}
											<i class="fa fa-user"></i> 
											
										</span>
									</div>
								</div>
								<div class="form-group">
									{!! Form::label('gestational_age', 'Gestational Age', $attributes = array('class'=>'col-sm-2 control-label'));  !!}
									<div class="col-sm-4">
										<span class="input-icon">
											{!! Form::text('gestational_age', (!empty($patientGynObsData))?$patientGynObsData->obs_gestational_age:Input::old('obs_gestational_age'), $attributes = array('class'=>'form-control','placeholder' => 'Gestational Age'));  !!}
											<i class="fa fa-quote-left"></i> </span>
									</div>
								</div>	
								<div class="form-group">
									<div class="col-sm-10"></div>
									<div class="col-sm-2">
										<button type="submit" class="btn btn-primary btn-block"><i class="fa fa-arrow-circle-right "></i> Save</button>
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
            console.log(pregHealth);
            //alert(lmpDysmenohrrea);
			Main.init();
			patientElements.init();


			$('body').on('focus',".date-picker", function(){
					$(this).datepicker();
   			});
   			var counter = 1;

   			$('#btn-addmore-lmp').click(function(e){
		            e.preventDefault();
		            counter ++;
		           
		           
		            $('#lmp-count').val(counter);
		            $('#lmp').append('<div id="dynamic-lmp" class="dynamic-lmp">' +
		            					
		            					'<div class="form-group">' +
		                                    '<div class="col-sm-4">' +
		                                    '</div>' +
		                              '</div>' +
		                              '<div class="form-group">' +
		                                    '<label for="date" class="col-sm-2 control-label">' +
		                                        'Date' +
		                                    '</label>' +
		                                    '<div class="col-sm-4">' +
		                                        '<span class="input-icon">' +
		                                            '<input type="text" name="last_mensus_date[]" id="last_mensus_date'+counter+'" class="form-control date-picker" placeholder="Select date" data-date-viewmode = "years", data-date-format="dd/mm/yyyy"/>' +
		                                        '</span>' +
		                                    '</div>' +
		                                    '<label class="col-sm-2 control-label">' +
		                                        'Flow' +
		                                    '</label>' +
		                                    '<div class="col-sm-4">' +
		                                        '<span class="input-icon">' +
		                                            '<select name="lmp_flow[]" class="form-control lmp_flow" id="lmp_flow'+counter+'">' +
		                                                
		                                            '</select>' +
		                                        '</span>' +
		                                    '</div>' +
		                             '</div>' +
		                             '<div class="form-group">' +
		                                    '<label  class="col-sm-2 control-label">' +
		                                        'Dysmenorrhea' +
		                                    '</label>' +
		                                    '<div class="col-sm-4">' +
		                                        '<span class="input-icon">' +
		                                            '<select name="lmp_dysmenorrhea[]" id="lmp_dysmenorrhea'+counter+'" class="form-control lmp_dysmenorrhea">' +
		                                            '</select>' +
		                                        '</span>' +
		                                    '</div>' +
		                                    '<label for="days" class="col-sm-2 control-label">' +
		                                        'Days' +
		                                    '</label>' +
		                                    '<div class="col-sm-4">' +
		                                        '<span class="input-icon">' +
		                                            '<input type="text" name="days[]" id="days'+counter+'" class="form-control" />' +
		                                        '</span>' +
		                                    '</div>' +
		                             '</div>' +
		                             '<div class="form-group">' +
		                                    '<label for="cycle" class="col-sm-2 control-label">' +
		                                        'Cycle' +
		                                    '</label>' +
		                                    '<div class="col-sm-4">' +
		                                        '<span class="input-icon">' +
		                                            '<input type="text" name="cycle[]" id="cycle'+counter+'" class="form-control" />' +
		                                        '</span>' +
		                                    '</div>' +
		                                    '<label  class="col-sm-2 control-label">' +
		                                        'Menstrual Type' +
		                                    '</label>' +
		                                    '<div class="col-sm-4">' +
		                                        '<span class="input-icon">' +
		                                            '<select name="lmp_mensus_type[]" id="lmp_mensus_type'+counter+'" class="form-control lmp_mensus_type">' +
		                                            '</select>' +
		                                        '</span>' +
		                                    '</div>' +
		                             '</div>' +
		                             '<div class="form-group">' +
		                                    '<div class="col-sm-10">' +
		                                    '</div>' +
		                                     '<div class="col-sm-2">' +
		                                        '<span class="input-icon">' +
		                                            '<input type="button" name="btn-addmore-delete" id="btn-addmore-delete'+counter+'" class="btn btn-danger btn-block" value="Remove" data-toggle="modal"  href="#myModal3"/>' +
		                                        '</span>' +
		                                    '</div>' +
		                             '</div>' + 
		                             '<div style="border-bottom: 1px solid #999;margin-bottom: 20px"></div>'+
		                             '</div>' 	
		                            
		                            );

		                    
		          	$('#lmp_flow'+counter).empty();
		            for (var key in lmpFlow) {
					  if (lmpFlow.hasOwnProperty(key)) {
					    //alert(key + " -> " + lmpFlow[key]);
					   $('#lmp_flow'+counter).append($("<option></option>").val(key).html(lmpFlow[key]));
					  }
					}

					$('#lmp_dysmenorrhea'+counter).empty();
		            for (var lmpDysmenohrreaKey in lmpDysmenohrrea) {
					  if (lmpDysmenohrrea.hasOwnProperty(lmpDysmenohrreaKey)) {
					    //alert(key + " -> " + lmpFlow[key]);
					    $('#lmp_dysmenorrhea'+counter).append($("<option></option>").val(lmpDysmenohrreaKey).html(lmpDysmenohrrea[lmpDysmenohrreaKey]));
					  }
					}

					$('#lmp_mensus_type'+counter).empty();
					for (var lmpMensusTypeKey in lmpMensusType) {
					  if (lmpMensusType.hasOwnProperty(lmpMensusTypeKey)) {
					    //alert(key + " -> " + lmpFlow[key]);
					    $('#lmp_mensus_type'+counter).append($("<option></option>").val(lmpMensusTypeKey).html(lmpMensusType[lmpMensusTypeKey]));
					  }
					} 
					

					
		   			
			});
			$('.btn-lmp-remove').click(function(){
				/*alert("deleted");
				//console.log($(this).parent('.form-group'))	;
				//$(this).find('.dynamic-lmp').remove();
				console.log($(this));
				$('.dynamic-lmp').each(function(index){
		            //$(this).text( index + 1 );
		            alert(index);
		            console.log($(this).find('.dynamic-lmp').remove());
		        })*/
			});
			
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
		                                    '<label class="col-sm-2 control-label">' +
		                                        'Pregnancy Kind' +
		                                    '</label>' +
		                                    '<div class="col-sm-4">' +
		                                        '<span class="input-icon">' +
		                                            '<select name="preg_kind[]" class="form-control preg_kind" id="preg_kind'+counter+'">' +
		                                                
		                                            '</select>' +
		                                        '</span>' +
		                                    '</div>' +
		                                    '<label class="col-sm-2 control-label">' +
		                                        'Pregnancy Type' +
		                                    '</label>' +
		                                    '<div class="col-sm-4">' +
		                                        '<span class="input-icon">' +
		                                            '<select name="preg_type[]" class="form-control preg_type" id="preg_type'+counter+'">' +
		                                                
		                                            '</select>' +
		                                        '</span>' +
		                                    '</div>' +
		                             '</div>' +
		                             '<div class="form-group">' +
		                                    '<label class="col-sm-2 control-label">' +
		                                        'Pregnancy Term' +
		                                    '</label>' +
		                                    '<div class="col-sm-4">' +
		                                        '<span class="input-icon">' +
		                                            '<select name="preg_term[]" class="form-control preg_term" id="preg_term'+counter+'">' +
		                                                
		                                            '</select>' +
		                                        '</span>' +
		                                    '</div>' +
		                                    '<label class="col-sm-2 control-label">' +
		                                        'Type of abortion' +
		                                    '</label>' +
		                                    '<div class="col-sm-4">' +
		                                        '<span class="input-icon">' +
		                                            '<input type="text" name="type_of_abortion[]" id="type_of_abortion'+counter+'" class="form-control type_of_abortion" placeholder="Type of abortion"/>' +
		                                        '</span>' +
		                                    '</div>' +
		                             '</div>' +
		                             '<div class="form-group">' +
		                                    '<label  class="col-sm-2 control-label">' +
		                                        'Health' +
		                                    '</label>' +
		                                   '<div class="col-sm-4">' +
		                                        '<span class="input-icon">' +
		                                            '<select name="preg_health[]" class="form-control preg_health" id="preg_health'+counter+'">' +
		                                                
		                                            '</select>' +
		                                        '</span>' +
		                                    '</div>' +
		                                    '<label  class="col-sm-2 control-label">' +
		                                        'Age' +
		                                    '</label>' +
		                                    '<div class="col-sm-2">' +
		                                        '<span class="input-icon">' +
		                                            '<input type="text" name="years[]" id="years'+counter+'" class="form-control years" placeholder="Years"/>' +
		                                        '</span>' +
		                                    '</div>' +
		                                    '<div class="col-sm-2">' +
		                                        '<span class="input-icon">' +
		                                            '<input type="text" name="weeks[]" id="weeks'+counter+'" class="form-control weeks" placeholder="Weeks"/>' +
		                                        '</span>' +
		                                    '</div>' +
		                             '</div>' +
		                               '<div class="form-group">' +
		                                    '<label  class="col-sm-2 control-label">' +
		                                        'Gender' +
		                                    '</label>' +
		                                   '<div class="col-sm-4">' +
		                                        '<span class="input-icon">' +
		                                            '<select name="gender[]" class="form-control gender" id="gender'+counter+'">' +
		                                                
		                                            '</select>' +
		                                        '</span>' +
		                                    '</div>' +
		                                '</div>' +    
		                             '<div class="form-group">' +
		                                    '<div class="col-sm-10">' +
		                                    '</div>' +
		                                     '<div class="col-sm-2">' +
		                                        '<span class="input-icon">' +
		                                            '<input type="button" name="btn-addmore-delete" id="btn-addmore-delete'+counter+'" class="btn btn-danger btn-block" value="Remove" data-toggle="modal"  href="#myModal3"/>' +
		                                        '</span>' +
		                                    '</div>' +
		                             '</div>' + 
		                             '<div style="border-bottom: 1px solid #999;margin-bottom: 20px"></div>'+
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



			});
			


        });
      
	</script>
@stop	