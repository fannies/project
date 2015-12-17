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
<h1>Edit page</h1>
<hr>
<?PHP
	echo "MENULIST : ".$_SESSION['selectMenu']."<br>";
	
	$subData = explode(",",$_SESSION['selectMenu']);
			$prevMenu = $subData[0];
			$prevPrice = $subData[1];
			$prevGetpoint = $subData[2];
			//echo $subMenu." ".$subPrice." ".$subGetpoint;

?>

<form action='edit_confirm.php' method='post'>
	Menu name :
	<input name='new_name' type='input' value="<?php echo $prevMenu ?>">
	Price :
	<input name='new_price' type='input' value="<?php echo $prevPrice ?>">
	Getpoint : 
	<input name='new_getpoint' type='input' value="<?php echo $prevGetpoint ?>"><br>

<input type="submit" name="submit" value="OK">
<input type="submit" name="cancel" value="Cancel">
<a href='Menu_edit.php'>back to main menu</a><br>

</form>

<?php

if(isset($_POST['submit'])) {
$newName = trim($_POST['new_name']);
$newPrice = trim($_POST['new_price']);
$newGetpoint = trim($_POST['new_getpoint']);

echo $newName." ".$newPrice." ".$newGetpoint;
	
$query = "UPDATE DB_MENU SET MNAME='$newName', PRICE='$newPrice', GETPOINT='$newGetpoint' WHERE MNAME='$prevMenu'";
$parseRequest = oci_parse($conn, $query);
oci_execute($parseRequest);

echo "<script language=\"JavaScript\">";
echo "alert('Edit Success!')";
echo "</script>";
echo '<script>window.location = "Menu_edit.php";</script>';
}

if(isset($_POST['cancel'])) {

echo '<script>window.location = "Menu_edit.php";</script>';
};
oci_close($conn);
?>