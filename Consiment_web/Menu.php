<?php

session_start();
	// Create connection to Oracle
	$conn = oci_connect("system", "Dom546275", "//localhost/XE");
	if (!$conn) {
		$m = oci_error();
		echo $m['message'], "\n";
		exit;
	} 
	if(empty($_SESSION['searchName'])){
		echo "";
	}
?>

<?php

$keyword = "";
if(isset($_POST['search'])) {

  
			//echo  $_POST["searchName"]."<br>";
			$_SESSION['searchName'] = $_POST["searchName"];
			$keyword = $_POST["searchName"];
			//echo '<script>window.location = "Menu_edit.php";</script>';
			

}


$query = "SELECT * FROM DB_MENU WHERE MNAME LIKE"." '%".$keyword."%'";

$parseRequest = oci_parse($conn, $query);

oci_execute($parseRequest);

$menu = array();
$price = array();
$getpoint =  array();

$index = 0;


	while ($row = oci_fetch_array($parseRequest, OCI_RETURN_NULLS+OCI_ASSOC)) {

	$index = oci_num_rows($parseRequest);
	 $menu{$index-1} = $row['MNAME'];
	 $price{$index-1} = $row['PRICE'];
	 $getpoint{$index-1} = $row['GETPOINT'];

	 /*$data{$index-1}{0} = $row['M_NAME'];
	 $data{$index-1}{1} = $row['PRICE'];*/
	

	}
	
	/*echo $data[0][0] . "PRICE :    " . $data[0][1] . "<br>";
	echo $data[1][0] . "PRICE :    " . $data[1][1]. "<br>";
	echo $data[2][0] . "PRICE :    " . $data[2][1]. "<br>";*/

oci_close($conn);
?>

<form action='Menu.php' method='post'>
	<h1>MENU LIST</h1>
	<hr>
	Search menu 
	<input name='searchName' type='input'>
	<input type="submit" name="search" value="Search"/>
<table border="1" style="width:50%">
	<tr>
    <td>MENU</td>
    <td>PRICE</td>		
    <td>GETPOINT</td>
  </tr>
  <tr>
<?php  
 for($j=0;$j<count($menu);$j++)
 echo '<tr>
<td>'.$menu[$j].'</td>'.
'<td>'.$price[$j].'</td>'.
'<td>'.$getpoint[$j].'</td>'.

'</tr>';


     ?>
 </table>

<?php


$subMenu = array();
$totalPrice = 0;


if(isset($_POST['search'])) {

  			
			//echo  $_POST["searchName"]."<br>";
			$_SESSION['searchName'] = $_POST["searchName"];
			$keyword = $_POST["searchName"];
			//echo '<script>window.location = "menuList.php";</script>';
			

}


?>
<p id="demo"></p>
</form>