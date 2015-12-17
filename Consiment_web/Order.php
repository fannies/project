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

<?php

if(isset($_POST['submit'])) {
//$_SESSION = array();
$subMenu = array();
$_SESSION['menu'] = array();
$_SESSION['count'] = array();
$totalPrice = "0";
$totalPoint = "0";


 echo "<h2>Orderlist</h2>"; 
   for($j=0;$j<count($_POST["menu"]);$j++){


		if(trim($_POST["menu"][$j]) != " "){


			//echo  $_POST["menu"][$j] . $_POST["num"][$j] ."<br>";

			$subData = explode(",", $_POST["menu"][$j]);
			
			$_SESSION['menu'][$j] = $subData[1];
			$_SESSION['count'][$j] = $_POST["num"][$subData[0]];

			echo $subData[1]." Price : ". $subData[2]." x".$_POST["num"][$subData[0]]." ".$subData[2]*$_POST["num"][$subData[0]]." BATH Point :".
			$subData[4]*$_POST["num"][$subData[0]]."<br>" ; // price x dishn_number and getpoint x dish
			$totalPrice += $subData[2]*$_POST["num"][$subData[0]];
			$totalPoint += $subData[4]*$_POST["num"][$subData[0]]; 

			
			
		}


	}
	
	echo "Total Price : ".$totalPrice." BATH"."<br>";
	echo "Total Getpoint : ".$totalPoint." Point"."<br>";
	

	if($totalPrice == 0){
echo "<script language=\"JavaScript\">";
echo "alert('Please enter dish number')";
echo "</script>";
echo '<script>window.location = "Order.php";</script>';
	
}

//echo '<button name="confirm" type="submit">confirm</button>';
//echo '<button name="cancel" type="submit">cancel</button>';
echo "<a href='Order_confrim.php'>Confirm Order</a><br>";
echo "<a href='Order.php'>Cancel Order</a><br>";
}

if(isset($_POST['confirm'])) {
echo "hi";
echo "<script language=\"JavaScript\">";	
echo "alert('totalPrice')";
echo "</script>";
echo '<script>window.location = "Order_confrim.php";</script>';
}

if(isset($_POST['cancel'])) {
echo "hi";
echo "<script language=\"JavaScript\">";	
echo "alert('totalPrice')";
echo "</script>";
echo '<script>window.location = "Order_confrim.php";</script>';
}
	echo $_SESSION['H_ID'];
?>



<?php

$keyword = "";

if(isset($_POST['search'])) {

  
			//echo  $_POST["searchName"]."<br>";
			$_SESSION['searchName'] = $_POST["searchName"];
			$keyword = $_POST["searchName"];
			//echo '<script>window.location = "Order.php";</script>';
			

}

$query = "SELECT * FROM DB_MENU WHERE MNAME LIKE"." '%".$keyword."%'";

$parseRequest = oci_parse($conn, $query);

oci_execute($parseRequest);

$menu = array();
$price = array();
$point = array();
$num = array();

$index = 0;


	while ($row = oci_fetch_array($parseRequest, OCI_RETURN_NULLS+OCI_ASSOC)) {

	$index = oci_num_rows($parseRequest);
	 $menu{$index-1} = $row['MNAME'];
	 $price{$index-1} = $row['PRICE'];
	 $point{$index-1} = $row['GETPOINT'];
	 $num{$index-1} = '0';
	

	 /*$data{$index-1}{0} = $row['M_NAME'];
	 $data{$index-1}{1} = $row['PRICE'];*/
	
	}
	
	/*echo $data[0][0] . "PRICE :    " . $data[0][1] . "<br>";
	echo $data[1][0] . "PRICE :    " . $data[1][1]. "<br>";
	echo $data[2][0] . "PRICE :    " . $data[2][1]. "<br>";*/

?>

<form action='Order.php' method='post'>

	<h1>Order</h1>
	<hr>
	Search menu 
	<input name='searchName' type='input'>
	<input type="submit" name="search" value="Search"/>
<table border="1" style="width:45%">
	<tr>
    <td>MENU</td>
    <td>PRICE</td>
    <td>Point</td>	
    <td>Number</td>		
   
  </tr>
  <tr>
<?php  

 for($j=0;$j<count($menu);$j++)
 echo '<tr>
<td><input type="checkbox" name="menu[]" value='.$j.','.$menu[$j].','.$price[$j].','.$num[$j].','.$point[$j].'>'.$menu[$j].'</input></td>'.
'<td>'.$price[$j].'</td>'.
'<td>'.$point[$j].'</td>'.
'<td><input name="num[]" type="input" value='.'><br></td>
</tr>';

     ?>

 </table>
<input type="submit" name="submit" value="Order"/>

</form>

<?php if(isset($_POST['confirm'])){
echo "hi";
echo "<script language=\"JavaScript\">";	
echo "alert('totalPrice')";
echo "</script>";
echo '<script>window.location = "Order_confrim.php";</script>';
}
?>

