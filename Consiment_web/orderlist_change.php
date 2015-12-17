<?php

session_start();
	// Create connection to Oracle
	$conn = oci_connect("system", "Dom546275", "//localhost/XE");
	if (!$conn) {
		$m = oci_error();
		echo $m['message'], "\n";
		exit;
	} 
	/*if(empty($_SESSION['searchName'])){
		echo '<script>window.location = "Menu_edit.php";</script>';
	}*/
?>
<h1>orderlist change page</h1>
<hr>

<?PHP

echo $_SESSION['H_ID'];
for($j=0;$j<count($_SESSION['state']);$j++){

//echo $_SESSION['state'][$j]." from order".$_SESSION['no'][$j]."<br>";
$query = "UPDATE DB_ORDER SET STATUS='".$_SESSION['state'][$j]."' WHERE NO='".$_SESSION['no'][$j]."'";
echo "<br>";
//echo $query;

 //  "INSERT INTO DB_MENU (MNAME, PRICE, GETPOINT) VALUES ('$addName', '$addPrice', '$addGetpoint')"
$parseRequest = oci_parse($conn, $query);
oci_execute($parseRequest);


}
echo "order success";

oci_close($conn);
	
?>