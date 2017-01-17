var doctorLogin = function () {
	var runOnPageLoadDoctorLogin = function(){
		var pathname = window.location.pathname;
     
	    var rest = pathname.substring(0, pathname.lastIndexOf("/") + 1);
	    var last = pathname.substring(pathname.lastIndexOf("/") + 1, pathname.length);
	    


		if (window.history && window.history.pushState) {
	      window.history.pushState('', null, ''+last);
	      $(window).on('popstate', function() {
	           //alert('Back button was pressed.');
	          document.location.href = 'doctorlogin';

	      });
	    }
	}
	return {
		//main function to initiate template pages
		init: function () {
			runOnPageLoadDoctorLogin();
		   
		}
    };
}(); 
