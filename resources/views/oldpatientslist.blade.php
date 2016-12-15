
@section('head')

	{!!Html::style('assets/plugins/datepicker/css/datepicker.css')!!}
    {!!Html::style('assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css')!!}
    {!!Html::style('assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css')!!}

@stop
<?php
	
	
	$patientName = "";
?>
@extends('layouts.master',['userName'=>$userName,'userId'=>$userId,'patientName'=>$patientName])
<style>
	.loader 
	{
        position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background: url('assets/images/page_loading.gif') 50% 50% no-repeat rgb(249,249,249);
    }
</style>
@section('main')



	<div class="page-header">
		<h1>Migration Details <small></small></h1>
	</div>
	<div class="row">
		<div class="col-sm-12">
			@foreach($oldPatientsData as $index=>$oldPatientVal)
				<?php
					$patientId = $oldPatientVal->id_patient;
					echo "</br>";
					//var_dump($oldPatientVal->history_family_father);
					echo "</br>";
					
					//Father History
						$fatherHistoryArray = array();
						$fatherHistory 	 	= explode('"',$oldPatientVal->history_family_father);
						
						for($i=0;$i<sizeof($fatherHistory);$i++){
							
							if($i%2!=0){
								array_push($fatherHistoryArray,$fatherHistory[$i]);
							}
							
						}
							//XOOOOO1
						
						//var_dump(sizeof($fatherHistoryArray));
						$fatherHistoryFinal = array();
						if(!empty($fatherHistoryArray)){
							for($i=0;$i<sizeof($fatherHistoryArray);$i++){
								if(isset($fatherHistoryArray[$i])){
									if($fatherHistoryArray[$i]=="N\/A" || $fatherHistoryArray[$i]=="Nil"){
										array_push($fatherHistoryFinal,"");
									}
									else{
										array_push($fatherHistoryFinal,$fatherHistoryArray[$i]);
									}
								}
							}
						}
						else{
							array_push($fatherHistoryFinal,"");
						}
					//--------------------------------------------------------------------------------
					
					//Mother History
						$motherHistoryArray = array();
						$motherHistory 	 	= explode('"',$oldPatientVal->history_family_mother);
						
						for($i=0;$i<sizeof($motherHistory);$i++){
							
							if($i%2!=0){
								array_push($motherHistoryArray,$motherHistory[$i]);
							}
							
						}
							//XOOOOO1
						
						//var_dump(sizeof($fatherHistoryArray));
						$motherHistoryFinal = array();
						if(!empty($motherHistoryArray)){
							for($i=0;$i<sizeof($motherHistoryArray);$i++){
								if(isset($motherHistoryArray[$i])){
									if($motherHistoryArray[$i]=="N\/A" || $motherHistoryArray[$i]=="Nil"){
										array_push($motherHistoryFinal,"");
									}
									else{
										array_push($motherHistoryFinal,$motherHistoryArray[$i]);
									}
								}
							}
						}
						else{
							array_push($motherHistoryFinal,"");
						}
					//--------------------------------------------------------------------------------
					
					//Sibling History
						$siblingHistoryArray = array();
						$siblingHistory 	 = explode('"',$oldPatientVal->history_family_sibling);
						
						for($i=0;$i<sizeof($siblingHistory);$i++){
							
							if($i%2!=0){
								array_push($siblingHistoryArray,$siblingHistory[$i]);
							}
							
						}
							//XOOOOO1
						
						//var_dump(sizeof($fatherHistoryArray));
						$siblingHistoryFinal = array();
						if(!empty($siblingHistoryArray)){
							for($i=0;$i<sizeof($siblingHistoryArray);$i++){
								if(isset($siblingHistoryArray[$i])){
									if($siblingHistoryArray[$i]=="N\/A" || $siblingHistoryArray[$i]=="Nil"){
										array_push($siblingHistoryFinal,"");
									}
									else{
										array_push($siblingHistoryFinal,$siblingHistoryArray[$i]);
									}
								}
							}
						}
						else{
							array_push($siblingHistoryFinal,"");
						}
					//--------------------------------------------------------------------------------

					//Grandfather History
						$grandfatherHistoryArray = array();
						$grandfatherHistory 	 = explode('"',$oldPatientVal->history_family_grandfather);
						
						for($i=0;$i<sizeof($grandfatherHistory);$i++){
							
							if($i%2!=0){
								array_push($grandfatherHistoryArray,$grandfatherHistory[$i]);
							}
							
						}
							//XOOOOO1
						
						//var_dump(sizeof($fatherHistoryArray));
						$grandfatherHistoryFinal = array();
						if(!empty($grandfatherHistoryArray)){
							for($i=0;$i<sizeof($grandfatherHistoryArray);$i++){
								if(isset($grandfatherHistoryArray[$i])){
									if($grandfatherHistoryArray[$i]=="N\/A" || $grandfatherHistoryArray[$i]=="Nil"){
										array_push($grandfatherHistoryFinal,"");
									}
									else{
										array_push($grandfatherHistoryFinal,$grandfatherHistoryArray[$i]);
									}
								}
							}
						}
						else{
							array_push($grandfatherHistoryFinal,"");
						}
					//--------------------------------------------------------------------------------

					//Grandmother History
						$grandmotherHistoryArray = array();
						$grandmotherHistory 	 = explode('"',$oldPatientVal->history_family_grandmother);
						
						for($i=0;$i<sizeof($grandmotherHistory);$i++){
							
							if($i%2!=0){
								array_push($grandmotherHistoryArray,$grandmotherHistory[$i]);
							}
							
						}
							//XOOOOO1
						
						//var_dump(sizeof($fatherHistoryArray));
						$grandmotherHistoryFinal = array();
						if(!empty($grandmotherHistoryArray)){
							for($i=0;$i<sizeof($grandmotherHistoryArray);$i++){
								if(isset($grandmotherHistoryArray[$i])){
									if($grandmotherHistoryArray[$i]=="N\/A" || $grandmotherHistoryArray[$i]=="Nil"){
										array_push($grandmotherHistoryFinal,"");
									}
									else{
										array_push($grandmotherHistoryFinal,$grandmotherHistoryArray[$i]);
									}
								}
							}
						}
						else{
							array_push($grandmotherHistoryFinal,"");
						}
					//--------------------------------------------------------------------------------	
	
							$data = array('history_family_father'=>json_encode($fatherHistoryFinal),
										  'history_family_mother'=>json_encode($motherHistoryFinal),
										  'history_family_sibling'=>json_encode($siblingHistoryFinal),
										  'history_family_grandfather'=>json_encode($grandfatherHistoryFinal),
										  'history_family_grandmother'=>json_encode($grandmotherHistoryFinal));
							$historyFatherUpdate = DB::table('medical_history')->where('id_patient','=',$patientId)->update($data);
						

							var_dump($data);

							
							echo "</br>";
							echo "-----------------------------------------------------------";
							echo "</br>";
						
						
						
				?>

			@endforeach
			
		
		</div>
	</div>
			

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
        {!!Html::style('assets/css/dd-responsive.css')!!}

		
		
	<script>
		$(document).ready(function() {
			Main.init();
			

			
           	
            
			
	
	 	});
	</script>
@stop	