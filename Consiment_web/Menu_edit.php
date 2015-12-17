<?php

session_start();
	// Create connection to Oracle
	$conn = oci_connect("system", "Dom546275", "//localhost/XE");
	if(empty($_SESSION['H_ID']) || empty($_SESSION['F_NAME']) || empty($_SESSION['S_NAME'])){
		echo '<script>window.location = "loginMember.php";</script>';
	}
	if (!$conn) {
		$m = oci_error();
		echo $m['message'], "\n";
		exit;
	} 
	if(empty($_SESSION['searchName'])){
		echo "";
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Clever Restaurant</title>
<meta charset="utf-8">
<link rel="icon" href="images/favicon.ico">
<link rel="shortcut icon" href="images/favicon.ico">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/slider.css">
<script src="js/jquery.js"></script>
<script src="js/jquery-migrate-1.1.1.js"></script>
<script src="js/superfish.js"></script>
<script src="js/jquery.easing.1.3.js"></script>
<script src="js/sForm.js"></script>
<script src="js/jquery.carouFredSel-6.1.0-packed.js"></script>
<script src="js/tms-0.4.1.js"></script>
<script>
$(window).load(function () {
    $('.slider')._TMS({
        show: 0,
        pauseOnHover: false,
        prevBu: '.prev',
        nextBu: '.next',
        playBu: false,
        duration: 800,
        preset: 'fade',
        pagination: true, //'.pagination',true,'<ul></ul>'
        pagNums: false,
        slideshow: 8000,
        numStatus: false,
        banners: false,
        waitBannerAnimation: false,
        progressBar: false
    })
});
$(window).load(function () {
    $('.carousel1').carouFredSel({
        auto: false,
        prev: '.prev',
        next: '.next',
        width: 960,
        items: {
            visible: {
                min: 1,
                max: 4
            },
            height: 'auto',
            width: 240,
        },
        responsive: false,
        scroll: 1,
        mousewheel: false,
        swipe: {
            onMouse: false,
            onTouch: false
        }
    });
});
</script>
<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<link rel="stylesheet" media="screen" href="css/ie.css">
<![endif]-->
</head>
<body style="background: #4B9A43;">
<div class="main">
  <header>
    <div class="container_12">
      <div class="grid_12">
        <h1><a href="index.html"><img src="images/logo.png" alt=""></a></h1>
        <div class="menu_block">
          <nav>
            <ul class="sf-menu">
              <li class="current"><a href="index.html">Home</a></li>
              <li class="with_ul"><a href="#">Register</a>
                <ul>
                  <li><a href="Memreg.php">Member</a></li>
                </ul>
              </li>
              <li class="with_ul"><a href="#">login</a>
				<ul>
				  <li><a href="GuestPage.php">Guest</a></li>
                  <li><a href="loginMember.php">Member</a></li>
                  <li><a href="loginStaff.php">Staff</a></li>
				  <li><a href="loginAdmin.php">Admin</a></li>
                </ul>
			  </li>
              <li class="with_ul"><a href="Menu.php">Menu</a></li>
              <li><a href="Promotion.html">Promotion</a></li>
            </ul>
          </nav>
          <div class="clear"></div>
        </div>
        <div class="clear"></div>
      </div>
    </div>
  </header>
  <br><br>

<fieldset style='margin: 0px auto; width: 1000px; height: auto;'>
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

	 //$data{$index-1}{0} = $row['M_NAME'];
	 //$data{$index-1}{1} = $row['PRICE'];
	

	}
	
	//echo $data[0][0] . "PRICE :    " . $data[0][1] . "<br>";
	//echo $data[1][0] . "PRICE :    " . $data[1][1]. "<br>";
	//echo $data[2][0] . "PRICE :    " . $data[2][1]. "<br>";

//oci_close($conn);
?>

<form action='Menu_edit.php' method='post'>
	<h1>EDIT MENU</h1>
	<hr>
	Search menu 
	<input name='searchName' type='input'>
	<input type="submit" name="search" value="Search"/><br><br>
<table border="1" style="width:50%">
	<tr>
    <td><H1>MENU</H1></td>
    <td><H1>PRICE</H1></td>		
    <td><H1>GETPOINT</H1></td>
  </tr>
  <tr>
<?php  
 for($j=0;$j<count($menu);$j++)
 echo '<tr>
<td><input type="radio" name="menu" value='.$menu[$j].','.$price[$j].','.$getpoint[$j].'>'.$menu[$j].'</input></td>'.
'<td>'.$price[$j].'</td>'.
'<td>'.$getpoint[$j].'</td>'.

'</tr>';
     ?>
 </table><br>
<input type="submit" name="edit" value="EDIT_CHECK"/>
<input type="submit" name="delete" value="DELETE_CHECK"/>
<input type="submit" name="log" value="Log Out" />



<?php

$_SESSION = array();
$subMenu = array();
$totalPrice = 0;

if(isset($_POST['edit'])) {

			echo  $_POST["menu"]."<br>";
			$_SESSION['selectMenu'] = $_POST['menu'];
			echo '<script>window.location = "edit_confirm.php"</script>';

			

};
if(isset($_POST['delete'])) {

 

			echo  $_POST["menu"]."<br>";
			$_SESSION['selectMenu'] = $_POST["menu"];
			echo '<script>window.location = "delete_confirm.php"</script>';






};
if(isset($_POST['log'])) {

 

			
			echo '<script>window.location = "loginAdmin.php";</script>';




};
if(isset($_POST['search'])) {

  			
			echo  $_POST["searchName"]."<br>";
			$_SESSION['searchName'] = $_POST["searchName"];
			$keyword = $_POST["searchName"];
			echo '<script>window.location = "Menu_edit.php";</script>';
			

};
	oci_close($conn);
?>
<p id="demo"></p>
</form>