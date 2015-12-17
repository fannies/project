<?PHP
	session_start();
		$conn = oci_connect("system", "Dom546275", "//localhost/XE");
	if (!$conn) {
		$m = oci_error();
		echo $m['message'], "\n";
		exit;
	} 

	if(empty($_SESSION['selectMenu'])){
		echo '<script>window.location = "Menu_edit.php";</script>';
	}
?>
<h1>Delete</h1>
<hr>
<?PHP
	echo "MENULIST : ".$_SESSION['selectMenu']."<br>";
	
	$subData = explode(",",$_SESSION['selectMenu']);
			$prevMenu = $subData[0];
			$prevPrice = $subData[1];
			$prevGetpoint = $subData[2];
			echo  "do you want to delete ".$subData[0]." from menulist";

?>

<form action='delete_confirm.php' method='post'>
	
<input type="submit" name="submit" value="Ok">
<input type="submit" name="cancel" value="Cancel">
<a href='Menu_edit.php'>back to main menu</a><br>

</form>

<?php

if(isset($_POST['submit'])) {

$query = "DELETE FROM DB_MENU WHERE Mname='$prevMenu'";
//DELETE FROM Customers WHERE Mname='$prevMenu';
$parseRequest = oci_parse($conn, $query);
oci_execute($parseRequest);


oci_close($conn);
echo "<script language=\"JavaScript\">";
echo "alert('Delete Success')";
echo "</script>";
echo '<script>window.location = "Menu_edit.php";</script>';
}

if(isset($_POST['cancel'])) {
echo '<script>window.location = "Menu_edit.php";</script>';

}

?>