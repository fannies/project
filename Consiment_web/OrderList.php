<?php

session_start();
	// Create connection to Oracle
	$conn = oci_connect("system", "Dom546275", "//localhost/XE");
	if (!$conn) {
		$m = oci_error();
		echo $m['message'], "\n";
		exit;
	}
	
?>

<?php

if(isset($_POST['Edit'])){
$_SESSION['state'] = array();
$_SESSION['no'] = array();

$statusChange = array();
$subData = array();
	
	for($j=0;$j<count($_POST["status"]);$j++){

		if(trim($_POST["status"][$j]) != " "){
			$subData = explode(",", $_POST["status"][$j]);
			$_SESSION['no'][$j] = $subData[0];
			$_SESSION['state'][$j] = $subData[3]; // get status
			
			//echo $subData[0]."  ".$subData[3];
			//echo $_POST["status"][$j].'<br>';
			//echo $subData[0].','.$subData[1].'<br>';
		}
	}
echo "<a href='orderlist_change.php'>Confirm status change</a><br>";
echo "<a href='OrderList.php'>Cancel status change</a><br>";
}
?>



<?php

$query = "SELECT *
		FROM DB_ORDER
		ORDER BY STATUS, NO asc";

$parseRequest = oci_parse($conn, $query);

oci_execute($parseRequest);
$no = array();
$mname = array();
$c_id = array();
$num = array();
$status = array();

$index = 0;

	while ($row = oci_fetch_array($parseRequest, OCI_RETURN_NULLS+OCI_ASSOC)) {
	 $index = oci_num_rows($parseRequest);
	 $no{$index-1} = $row['NO'];
	 $mname{$index-1} = $row['MNAME'];
	 $c_id{$index-1} = $row['C_ID'];
	 $num{$index-1} = $row['NUM'];
	 $status{$index-1} = $row['STATUS'];
	}
oci_close($conn);
?>

<form action='OrderList.php' method='post'>
	<h1>Order List</h1>
<table border="1" style="width:45%">
	<tr>
	<td><center>order sequence</center></td>
    <td><center>MENU</center></td>
    <td><center>Customer_ID</center></td>
    <td><center>Number</center></td>
	<td><center>Status</center></td>
	<td><center>Accept</center></td>
    <td><center>Denied</center></td>
	<td><center>Sent</center></td>
	
  </tr>
  
<?php
 for($j=0;$j<count($mname);$j++){
 echo '<tr>
<td>'.$no[$j].'</td>'.
'<td>'.$mname[$j].'</td>'.
'<td>'.$c_id[$j].'</td>'.
'<td>'.$num[$j].'</td>';
	switch($status[$j]){
		case 0:
		{
			echo '<td>Request</td>';
		}
		break;
		case 1:
		{
			echo '<td>Accepted</td>';
		}
		break;
		case 2:
		{
			echo '<td>Sent</td>';
		}
		break;
		case 3:
		{
			echo '<td>Denied</td>';
		}
		break;
		case 4:
		{
			echo '<td>Check Bill</td>';
		}
		break;
	}
echo '<td><input type="checkbox" name="status[]" value='.$no[$j].','.$c_id[$j].','.$mname[$j].',1>Accept</input></td>'.
'<td><input type="checkbox" name="status[]" value='.$no[$j].','.$c_id[$j].','.$mname[$j].',3>Denied</input></td>'.
'<td><input type="checkbox" name="status[]" value='.$no[$j].','.$c_id[$j].','.$mname[$j].',2>Sent</input></td>
</tr>';
 }
     ?>
 </table>
<input type="submit" name="Edit" value="Update"/>

<?php
if(isset($_POST['confirm'])){

echo "<script language=\"JavaScript\">";
echo "alert('totalPrice')";
echo "</script>";
echo '<script>window.location = "Order.php";</script>';
}
?>

</form>