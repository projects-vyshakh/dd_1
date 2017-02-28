<?php
require_once './dbconnect.php';
$name = $_POST['q'];
$db = new Phonebook;
$result = $db->search($name);
echo '<div class="col-lg-12">';
echo '<div class="panel panel-default">';
echo '<div class="panel-heading">';
echo "Result";
echo '</div>';
echo '<div class="panel-body">';
if(count($result) > 0) {
echo '<div class="table-responsive">';
echo '<table class="table table-hover">';
echo '<thead>';
echo '<tr>';
echo '<th>#</th>';
echo '<th>Patient ID</th>';
echo '<th>Name</th>';
echo '<th>Sex</th>';
echo '<th>State</th>';
echo '</tr>';
echo "</thead>";
echo "<tbody>";
$count = 0;
for($i=0; $i<count($result); $i++){
	$object = $result[$i];
	echo '<tr>';
	echo '<td>'.($i+1).'</td>';
	echo '<td>'.$object->get('patientID').'</td>';
	echo '<td>'.$object->get('firstName').'</td>';
	echo '<td>'.$object->get('sex').'</td>';
	echo '<td>'.$object->get('state').'</td>';
	echo '</tr>';
}
echo '</tbody>';
echo "</table>";
echo '</div>';
}else {
	echo "No records found";
}
echo '</div>';
echo '</div>';
echo '</div>';
unset($result);

?>
