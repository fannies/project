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
<h1>order page</h1>
<hr>

<?PHP

for($j=0;$j<count($_SESSION['menu']);$j++){

echo $_SESSION['menu'][$j]." x".$_SESSION['count'][$j]."<br>";
$query =  "INSERT INTO DB_ORDER (NO, MNAME, C_ID, NUM, STATUS) VALUES (menu_seq.nextval, '".$_SESSION['menu'][$j]."', '".$_SESSION['H_ID']. "', '".$_SESSION['count'][$j]."', '0')";
echo "<br>";
echo $query;

 //  "INSERT INTO DB_MENU (MNAME, PRICE, GETPOINT) VALUES ('$addName', '$addPrice', '$addGetpoint')"
$parseRequest = oci_parse($conn, $query);
oci_execute($parseRequest);


}
echo "order success";
	
?>