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

$query = "SELECT * FROM DB_STAFF";

$parseRequest = oci_parse($conn, $query);

oci_execute($parseRequest);

$SID = array();
$ROLE = array();
$SALARY = array();
$EXP =  array();
$index = 0;


	while ($row = oci_fetch_array($parseRequest, OCI_RETURN_NULLS+OCI_ASSOC)) {

	$index = oci_num_rows($parseRequest);
	 $SID{$index-1} = $row['S_ID'];
	 $ROLE{$index-1} = $row['ROLE'];
	 $SALARY{$index-1} = $row['SALARY'];
	 $EXP{$index-1} = $row['EXP'];
	 //$data{$index-1}{0} = $row['M_NAME'];
	 //$data{$index-1}{1} = $row['PRICE'];
	

	}
	
	//echo $data[0][0] . "PRICE :    " . $data[0][1] . "<br>";
	//echo $data[1][0] . "PRICE :    " . $data[1][1]. "<br>";
	//echo $data[2][0] . "PRICE :    " . $data[2][1]. "<br>";

oci_close($conn);
?>

<form action='Staff_edit.php' method='post'>
	<h1>Staff</h1>
	<hr>
<table border="1" style="width:50%">
	<tr>
    <td><H1>S_ID</H1></td>
    <td><H1>ROLE</H1></td>		
    <td><H1>SALARY</H1></td>
	<td><H1>EXP</H1></td>
  </tr>
  <?php

 for($j=0;$j<count($SID);$j++)
 echo '<tr>
<td><input type="radio" name="staff" value='.$SID[$j].','.$ROLE[$j].','.$SALARY[$j].','.$EXP[$j].'>'.$SID[$j].'</input></td>
<td>'.$ROLE[$j].'</td>
<td>'.$SALARY[$j].'</td>
<td>'.$EXP[$j].'</td>
</tr>';
     ?>
	 
 </table><br>
<input type="submit" name="edit" value="EDIT_CHECK"/>
<input type="submit" name="delete" value="DELETE_CHECK"/>


<?php

//$_SESSION = array();
$subMenu = array();
$totalPrice = 0;

if(isset($_POST['edit'])) {

			echo  $_POST["staff"]."<br>";
			$_SESSION['selectStaff'] = $_POST['staff'];
			echo '<script>window.location = "staff_confirm.php"</script>';

			

}
if(isset($_POST['delete'])) {

 

			echo  $_POST["staff"]."<br>";
			$_SESSION['selectStaff'] = $_POST["staff"];
			echo '<script>window.location = "staff_delete.php"</script>';



}

 for($j=0;$j<count($SID);$j++)
 echo '<tr>
<td>'.$SID[$j].'</td>'.
'<td>'.$ROLE[$j].'</td>'.
'<td>'.$SALARY[$j].'</td>'.
'<td>'.$EXP[$j].'</td>'.'</tr>';
?>
 </table><br>
</form>