<?php
require_once './dbconnect.php';
$db = new Phonebook;
$table = $_POST['id'];
$result = $db->specificTable($table);
echo '<div class="col-lg-12">';
echo '<div class="panel panel-default">';
echo '<div class="panel-heading">';
echo "Registered Users";
echo '</div>';
echo '<div class="panel-body">';
echo '<div class="table-responsive">';
echo '<table class="table table-hover">';
echo '<thead>';
echo '<tr>';
echo '<th>#</th>';
echo '<th>Table</th>';
echo '<th>Name</th>';
echo '<th>Phone</th>';
echo '<th>Amount</th>';
echo '</tr>';
echo "</thead>";
echo "<tbody>";
$totalAmount = 0;
$temp = array();
$count = 0;
$reg = 0;
for($i=0; $i<count($result); $i++){
	$object = $result[$i];
	if($object->get('registeredFlag') == true){
    echo '<tr class="success">';
		$reg += 1;
  } else {
    echo '<tr>';
  }
	echo '<td>'.($i+1).'</td>';
	echo '<td>'.$object->get('Table').'</td>';
	echo '<td>'.$object->get('Name').'</td>';
	echo '<td>'.$object->get('Mobile').'</td>';
	echo '<td>'.$object->get('amountPaid').'</td>';
	echo '</tr>';
	if(!isset($temp[$object->get('Table')])){
		$count++;
		$temp[$object->get('Table')] = 1;
	}
	$totalAmount += $object->get('amountPaid');
}
echo '</tbody>';
echo "</table>";
echo '<input type="hidden" value="'.$totalAmount.'" id="totalAmount" >';
echo '<input type="hidden" value="'.$reg.'" id="total" >';
echo '<input type="hidden" value="'.$count.'" id="totalTables" >';
echo '<input type="hidden" value="'.$object->get('Table').'" id="tableName" >';
unset($result);
?>
