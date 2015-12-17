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

	
<?PHP
$mname = array();
$c_id = array();
$num = array();
$status = array();
$price = array();

if(isset($_POST['List'])){
$set = $_POST["inputVal"][0];
$query = "SELECT C_ID,NUM,STATUS,PRICE
		FROM DB_ORDER o1, DB_MENU m1
		WHERE STATUS='2' and C_ID='$set' and o1.mname=m1.mname
		ORDER BY NO";

$parseRequest = oci_parse($conn, $query);
oci_execute($parseRequest);
$index = 0;

	while ($row = oci_fetch_array($parseRequest, OCI_RETURN_NULLS+OCI_ASSOC)) {
	 $index = oci_num_rows($parseRequest);
	 $c_id{$index-1} = $row['C_ID'];
	 $num{$index-1} = $row['NUM'];
	 $status{$index-1} = $row['STATUS'];
	 $price{$index-1} = $row['PRICE'];
	}
$query = "SELECT MNAME
		FROM DB_ORDER
		WHERE STATUS='2' and C_ID='$set'
		ORDER BY NO";

$parseRequest = oci_parse($conn, $query);
oci_execute($parseRequest);
$index = 0;

	while ($row = oci_fetch_array($parseRequest, OCI_RETURN_NULLS+OCI_ASSOC)) {
	 $index = oci_num_rows($parseRequest);
	 $mname{$index-1} = $row['MNAME'];
	}
}
?>

<form action='Receiption.php' method='post'>
	<h1>Pay List</h1>
<table border="1" style="width:10%">
	<tr>
    <td><center>Customer_ID</center></td>
  </tr>
  
<?php
 echo '<tr>
<td><input type="input" name="inputVal[]"></input></td>'.'
</tr>';

     ?>
 </table>
 
<input type="submit" name="List" value="List"/>
<table border="1" style="width:45%">
	<tr>
    <td><center>MENU</center></td>
    <td><center>Customer_ID</center></td>
    <td><center>Number</center></td>
	<td><center>Status</center></td>
	<td><center>Price</center></td>
  </tr>
  
<?php
$summation = 0;
 for($j=0;$j<count($mname);$j++){
 echo '<tr>
<td>'.$mname[$j].'</td>'.
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
$summation += $price[$j]*$num[$j];
 echo '<td>'.$price[$j]*$num[$j].'</td></tr>';
 }
     ?>
 </table>
 <input type="submit" name="Pay" value="Pay"/>
<?php
if(isset($_POST['confirm'])){

echo "<script language=\"JavaScript\">";
echo "alert('totalPrice')";
echo "</script>";
echo '<script>window.location = "Order.php";</script>';
}
?>

<?php
if(isset($_POST['Pay'])){

 $query = "INSERT INTO DB_RECEIPT (R_ID, TOTAL, DATETIME, C_ID) VALUES (r_id.nextval,'$summation',sysdate,)";
 echo $query;
 $parseRequest = oci_parse($conn, $query);
oci_execute($parseRequest);
oci_close($conn);



}

?>
</form>