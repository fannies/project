<?PHP
	session_start();
		$conn = oci_connect("system", "Dom546275", "//localhost/XE");	
	if (!$conn) {
		$m = oci_error();
		echo $m['message'], "\n";
		exit;
	} 

	if(empty($_SESSION['selectStaff'])){
		echo '<script>window.location = "Staff_edit.php";</script>';
	}
?>
<h2>Edit page</h2>
<hr>
<?PHP
	echo " <H3>Staff : ".$_SESSION['selectStaff']."</H3>";
	$subData = explode(",",$_SESSION['selectStaff']);
	
			$prevRole = $subData[1];
			$prevSalary = $subData[2];
			//echo $subMenu." ".$subPrice." ".$subGetpoint;

?>

<form action='staff_confirm.php' method='post'>
	Role :
	<input name='role' type='input' value="<?php echo $prevRole ?>">
	Salary :
	<input name='salary' type='input' value="<?php echo $prevSalary ?>"><br><br>

<input type="submit" name="submit" value="OK">
<input type="submit" name="cancel" value="Cancel">
<br><a href='Staff_edit.php'>back to main menu</a><br>

</form>

<?php

if(isset($_POST['submit'])) {
	$SID = $subData[0];
$role = trim($_POST['role']);
$salary = trim($_POST['salary']);
	
$query = "UPDATE DB_STAFF SET ROLE='$role', SALARY='$salary' WHERE S_ID = $SID";
$parseRequest = oci_parse($conn, $query);
oci_execute($parseRequest);

echo "<script language=\"JavaScript\">";
echo "alert('Edit Success!')";
echo "</script>";
echo '<script>window.location = "Staff_edit.php";</script>';
}

if(isset($_POST['cancel'])) {

echo '<script>window.location = "Staff_edit.php";</script>';
};
oci_close($conn);
?>