<!DOCTYPE html>
<!-- Template Name: Clip-One - Responsive Admin Template build with Twitter Bootstrap 3.x Version: 1.4 Author: ClipTheme -->
<!--[if IE 8]><html class="ie8 no-js" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9 no-js" lang="en"><![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">

	<!--<![endif]-->
	<!-- start: HEAD -->
	<head>

		<title>Disease Atlas</title>
		<!-- start: META -->
		<meta charset="utf-8" />
		<!--[if IE]><meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1" /><![endif]-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta content="" name="description" />
		<meta content="" name="author" />
		<link rel="shortcut icon" href="assets/images/logo-mob.png" type="image/x-icon">
		
		<!-- end: META -->
		<!-- start: MAIN CSS -->
		{!!Html::style('assets/plugins/bootstrap/css/bootstrap.min.css')!!}
	    {!!Html::style('assets/plugins/font-awesome/css/font-awesome.min.css')!!}
	    {!!Html::style('assets/fonts/style.css')!!}
	    
	    {!!Html::style('assets/css/main.css')!!}
	    {!!Html::style('assets/css/disease_main.css')!!}
	    {!!Html::style('assets/css/main-responsive.css')!!}
	    {!!Html::style('assets/plugins/iCheck/skins/all.css')!!}
	    {!!Html::style('assets/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css')!!}
	    {!!Html::style('assets/plugins/perfect-scrollbar/src/perfect-scrollbar.css')!!}
	    
	    {!!Html::style('assets/css/print.css',array('media' => 'print')) !!}

	   
	     {!!Html::style('assets/css/dd-responsive.css')!!}

	     {!!Html::style('assets/plugins/Swiper-master/dist/css/swiper.min.css')!!}

		

		{!!Html::style('assets/plugins/ajax-loader/src/jquery.mloading.css')!!}
	
		<!-- <script src="http://www.jqueryscript.net/demo/Input-Based-Table-Data-Filter-With-jQuery-multifilter/multifilter.js"></script> -->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script src='assets/plugins/multifilter/multifilter.js'></script>

	</head>
	<!-- end: HEAD -->
	<!-- start: BODY -->
	<?php
		$currentPath = Route::getCurrentRoute()->getPath();
		//echo $currentPath;
	?>
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
	<body style="background-color:#f9f9f9">
		<div class="loader"></div>
		<div class="navbar-fixed-top resize-login dd_login_header disease_dd_login_header_2 "><!-- navbar-fixed-top -->
			<div class="map_inner_wrapper_2">
				<div class="container dd_pd_0">
	        		<div class="row dd_mg_0">
	        		 	<div class="col-sm-12 dd_pd_0">
	        		 		<div class="logo_div_a">
	    		 			   <a class="navbar-brand dd_logo_img_2" href="http://www.doctorsdiary.co">
								</a>
							</div>
							
							<div class="login_div_b">
								<div class="doctorlogin_main">
									<!-- <span class="doctor_login"><img src="assets/images/doctor_icon.png"></span> -->
									<a href="doctor/login" >Doctor Login</a>&nbsp;  &nbsp;
								</div>
		        		 		<div class="patientlogin_main">
		        		 		 	<a href="patient/login">
		        		 		 		Patient Login
		        		 		 	</a>
		        		 		</div>
	        		 		</div>
	        		 		<div class="disease_heading">
							<img src="assets/images/Disease/main_logo.png">
								<!-- DISEASE ATLAS -->
							</div>
	        		 	</div>
	        		</div>
	        	</div>
	        </div>
        </div>
         <div class="map_inner_wrapper_3 ">
         <div class="disease-dd_drlogin_responsive">
         <div class="map_logo_div">
	    		 			 <div class="disease_dd_logo_responsive">
			        	<a href="http://www.doctorsdiary.co" class="navbar-brand-disease disease_logo_img_2">
								</a>
			        		
			        </div>
								<div class="disease_heading2">
								<img src="assets/images/Disease/main_logo.png">
							</div>	
							</div>
			        	<div class="disease-login_div2">
							<div class="disease-doctorlogin_main2">								
								<a href="doctor/login"><b>Doctor Login</b></a>&nbsp; / &nbsp;
							</div>
	        		 		<div class="disease-patientlogin_main2"> 							        		 		       	
	        		 		 	<a href="patient/login">
	        		 		 		<b>Patient Login</b>
	        		 		 	</a>
	        		 		</div>
        		 		</div> 	
		        	</div>
		        	</div>
       <!-- Swiper -->

       	<!-- <dir></dir> -->
		<?php
		/*echo '<pre>';print_r($mapData);exit;*/
		if(empty($mapData)){
			echo '<div class="alert in fade alert-danger"><center>No Data Found!!</center><a style="cursor:pointer" class="close" data-dismiss="alert">*</a></div>';
		}
		?>
		
			<link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.3/dist/leaflet.css" />

  <div id="mapid"></div>
 <script src="https://unpkg.com/leaflet@1.0.3/dist/leaflet.js"></script>
  
  <style type="text/css">
  	#mapid { height: 640px; }
  	.custom .leaflet-popup-tip,
.custom .leaflet-popup-content-wrapper {
    background: #e93434;
    color: #ffffff;
}
  </style>
   <script type="text/javascript">

 var mymap = L.map('mapid', {attributionControl: false}).setView([51.505, -0.09], 3);
 /*mapbox://styles/mapbox/light-v9*/
	L.tileLayer('https://api.mapbox.com/styles/v1/mapbox/light-v9/tiles/256/{z}/{x}/{y}?access_token=pk.eyJ1IjoicmFoZWVzIiwiYSI6ImNpemk5dGoxZDAxeGUyd293OXY2YzRoNWUifQ.2uJAA9oJ1Wle3OURY6DGgg', {
    /*attributionControl: false,*/
    maxZoom: 18
    
}).addTo(mymap);

	/*L.tileLayer('https://api.mapbox.com/styles/v1/mapbox/outdoors-v10/tiles/256/{z}/{x}/{y}?access_token=pk.eyJ1IjoicmFoZWVzIiwiYSI6ImNpemk5dGoxZDAxeGUyd293OXY2YzRoNWUifQ.2uJAA9oJ1Wle3OURY6DGgg', {
    attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://mapbox.com">Mapbox</a>',
    maxZoom: 15,
    
}).addTo(mymap);*/
	/*apikey: 'pk.eyJ1IjoicmFoZWVzIiwiYSI6ImNpemk5dGoxZDAxeGUyd293OXY2YzRoNWUifQ.2uJAA9oJ1Wle3OURY6DGgg',*/
    

var circle = {};
			
			<?php
foreach ($mapData as $key => $value) {
  list($color, $disease) = explode("__", $key, 2);
   foreach ($value as $k => $v) {
    list($latitude, $longitude) = explode("#", $k, 2);
    foreach ($v as $m => $n) {
      $Country=$m;
       $cases=$n;
    if($cases>0)
    {
    	if($cases<6)
    	{
    		$radius=5;
    	}
    	else if($cases<21)
    	{
    		$radius=15;
    	}
    	else if($cases<51)
    	{
    		$radius=30;
    	}
    	else if($cases<101)
    	{
    		$radius=70;
    	}
    	else if($cases<201)
    	{
    		$radius=120;
    	}
    	else if($cases<401)
    	{
    		$radius=160;
    	}
    	else if($cases<701)
    	{
    		$radius=200;
    	}
    	else if($cases<1001)
    	{
    		$radius=230;
    	}
    	else if($cases<2001)
    	{
    		$radius=250;
    	}else if($cases<5001)
    	{
    		$radius=300;
    	}else
    	{
    		$radius=350;
    	}
      ?>
	circle["<?php echo $latitude;?>"] = L.circle(["<?php echo $latitude;?>", "<?php echo $longitude;?>"], {
	center: ["<?php echo $latitude;?>","<?php echo $longitude;?>"],
    //strokeColor: '<?php echo $color;?>',
    //strokeOpacity: 0.2,
  	weight: 0.2,
    color: '<?php echo $color;?>',
    fillColor: '<?php echo $color;?>',
    fillOpacity: 0.6,
    radius: ('<?php echo $radius;?>')*1000
    
}).addTo(mymap).bindPopup("<div id='iw-container'><div class='iw-title'><?php echo $Country;?></div><div class='iw-content'><p>Disease : <strong><?php echo $disease;?></strong><br/>Cases : <strong><?php echo $cases;?></strong></p></div><div class='iw-bottom-gradient'></div></div>");

<?php
}
}
}
} ?>
				/*function clickZoom(e) {
					const popup = this.L.popup({
  offset: L.point(120, 0)
});

    mymap.setView(e.target.getLatLng(),5.0);
}	*/
  	
			
		</script>
		
		
		<div class="home_main_div">
			<!-- <input type="hidden" name="test" id="test" value="<div class='box_color_main' >Disease : <strong style='color:green'>Cholera</strong><br/>Country : <strong style='color:green'> Agola</strong><br/>Cases : <strong style='color:green' >25000</strong></div>">
			<input type="hidden" name="test2" id="test2" value="<div class='box_color_main' >Disease : <strong style='color:blue' >Influenza</strong><br/>Country : <strong style='color:blue'>China</strong><br/>Cases : <strong style='color:blue'>15000</strong></div>"> -->

			<!-- <div id="chartdiv"></div>		 -->

			<?php
			foreach ($mapData as $key => $value) {
			  	list($color,$disease) = explode("__", $key, 2);
			   	foreach ($value as $k => $v) {
			    	list($latitude, $longitude) = explode("#", $k, 2);
			    	foreach ($v as $m => $n) {
			    		$Country=$m;
			       		$cases=$n;
			    		if($cases>0)
			    		{
			    			?>
			      			<!-- <input type="hidden"  name="<?php echo $latitude;?>" id="<?php echo $latitude;?>" value="<div id='iw-container'><div class='iw-title'><?php echo $Country;?></div><div class='iw-content'><p>Disease : <strong style='color:<?php echo $color;?>'><?php echo $disease;?></strong><br/>Cases : <strong style='color:<?php echo $color;?>'><?php echo $cases;?></strong></p></div><div class='iw-bottom-gradient'></div></div>"> -->
			    			<input type="hidden"  name="<?php echo $latitude;?>" id="<?php echo $latitude;?>" value="<div id='iw-container'><div class='iw-title'><?php echo $Country;?></div><div class='iw-content'><p>Disease : <strong><?php echo $disease;?></strong><br/>Cases : <strong><?php echo $cases;?></strong></p></div><div class='iw-bottom-gradient'></div></div>">
			    			<?php
			  			}
			  		}
				}
			}
			?>
			
		</div>
		<div class="filters_box hidden">
			<div class="btn_let-site"></div>
			<div class="filters_hide">
			 	<h3>Diseases</h3> 
			 	<div class="filter_color_boxs">
					<table class="table table-hover">
						<thead>
							<th style="display: none;">Diseases</th>
						</thead>
						<tbody >
			                <tr class='filters'>
			                    <th class='filter-container search-main'>
		                            <input autocomplete='off' class='filter search' name='Diseases' placeholder='Search'" />
		                        </th>
		                    </tr>
		                    <?php 
							$i=0;?>
							<tr>
								<td>
									<p>
										<a href="viewdisease?id_disease=">
										<span style=" background:#ea9225 " class="filter_color_box "></span>
										<span class="filter_color_content">Show all</span>
										<span class="clearfix"></span></a>
									</p>
								</td>
							</tr>
							<?php
							foreach($diseaseRows as $diseaseRow){
								/*print_r($diseaseRow->id_disease);
								die();*/
								$i++;?>
								<tr>
									<td>
										<p>
											<a href="viewdisease?id_disease=<?php echo $diseaseRow->id_disease; ?>">
											<span style=" background:<?php echo $diseaseRow->color;?>" class="filter_color_box "></span> 
											<span class="filter_color_content"><?php echo $diseaseRow->name;?></span>
											<span class="clearfix"></span></a>
										</p>
									</td>
								</tr>	
								<?php
							}
							?>
						</tbody>
					</table>
				</div>
				<!-- <p class="dt_data">05/Nov/1989 To 05/Nov/2013</p>
				<p class="disear_content">Diseases  </p> -->
			</div>
		</div>
	</body>
</html>
		<footer>
			<div class="navbar-fixed-bottom dd_footer" style="z-index: 20000; bottom: 0;">
				<div class="container " style="height:">
					<div class="row">
						<div class="col-sm-12">
						    <div class="inner_wrapper_2">
						        <div class="footer_div footer_pd dd_left ">
						        	&copy 2016 Doctor's Diary | Powered by Brainpan <!-- Innovations.  -->
						        </div>
						        <div class="footer_div_2 dd_right">
							   		<ul class="footer_ul">
						        		<li class="footer_li">
					        		 		<a href="" class="footer_a">Terms & Conditions</a>	
								        </li>
								        <li class="footer_li">
								        	<a href="" class="footer_a">Blog</a>
								        </li>
								        <li class="footer_li">
								        	<a href="" class="footer_a">Career</a>
								        </li>
								        <li class="footer_li">
								        	<a href="" class="footer_a">About Us</a>
								        </li>
							        </ul>
						        			
						        </div>
						    </div>
						</div>
					</div>
				</div>
			</div>
		</footer>
	
	<!-- start: MAIN JAVASCRIPTS -->
	<!--[if lt IE 9]>
	<script src="assets/plugins/respond.min.js"></script>
	<script src="assets/plugins/excanvas.min.js"></script>
	<script type="text/javascript" src="assets/plugins/jQuery-lib/1.10.2/jquery.min.js"></script>
	<![endif]-->
	<!--[if gte IE 9]><!-->
	{!!Html::script('assets/plugins/jQuery-lib/2.0.3/jquery.min.js')!!}
	{!!Html::script('assets/plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js')!!}
	{!!Html::script('assets/plugins/bootstrap/js/bootstrap.min.js')!!}
	{!!Html::script('assets/plugins/jquery-inputlimiter/jquery.inputlimiter.1.3.1.min.js')!!}
	{!!Html::script('assets/plugins/autosize/jquery.autosize.min.js')!!}
	{!!Html::script('assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js')!!}
	{!!Html::script('assets/plugins/blockUI/jquery.blockUI.js')!!}
	{!!Html::script('assets/plugins/iCheck/jquery.icheck.min.js')!!}
	{!!Html::script('assets/plugins/perfect-scrollbar/src/perfect-scrollbar.js')!!}
	{!!Html::script('assets/plugins/perfect-scrollbar/src/jquery.mousewheel.js')!!}
	{!!Html::script('assets/plugins/less/less-1.5.0.min.js')!!}
	{!!Html::script('assets/plugins/jquery-cookie/jquery.cookie.js')!!}
	{!!Html::script('assets/plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js')!!}
	{!!Html::script('assets/js/main.js')!!}
	{!!Html::script('assets/plugins/jquery-validation/dist/jquery.validate.min.js')!!}

	{!!Html::script('http://www.jqueryscript.net/demo/Input-Based-Table-Data-Filter-With-jQuery-multifilter/multifilter.js')!!}
	{!!Html::script('assets/plugins/ajax-loader/src/jquery.mloading.js')!!}

	<script type="text/javascript">
       
		jQuery(document).ready(function($){
			$('.filter').multifilter();
			
			 var $window = $(window);
			 if ($window.width() < 768) {
			
            $(".filters_box").toggleClass("hidefilter");
        }
			
		    $(".btn_let-site").click(function(){
		        $(".filters_box").toggleClass("hidefilter");
		    });
		    
			$(window).on('load', function() {
				 
		   		setTimeout(function(){
		   			$(".loader").fadeOut("slow");
		    		$('.filters_box').removeClass('hidden');
		    		$('#content').fadeIn('slow');
				}, 3000);
				
			});

       

   
		});
	</script>