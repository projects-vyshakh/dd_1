<?php

require 'vendor/autoload.php';



// Add the "use" declarations where you'll be using the classes
use Parse\ParseClient;
use Parse\ParseObject;
use Parse\ParseQuery;
use Parse\ParseACL;
use Parse\ParsePush;
use Parse\ParseUser;
use Parse\ParseInstallation;
use Parse\ParseException;
use Parse\ParseAnalytics;
use Parse\ParseFile;
use Parse\ParseCloud;

// Init parse: app_id, rest_key, master_key
Parse\ParseClient::initialize('vrA1DYO8NtY4TkNCEagJshdUxLJDowGiWrBfkXwA', '4hpYvBWpIgOvraXdIi3mwsMjVYgofohogkwt0cSd', 'PHuyPN6P4gPvx4eOaVQ1mlCoe0Lrm4q6g2gFpayS');
class Phonebook {

	public function search($name){
		$query = new ParseQuery("Patients");
		$query->equalTo("patientID", $name);
		// $query->startsWith("name", $name);
		$result = $query->find();
		return $result;
	}

}




// $phone = new Phonebook;


// $phone->allData();
// echo "Search result</br>";
// $phone->search("bla");
?>
