<?PHP
	session_start();
		$conn = oci_connect("system", "Dom546275", "//localhost/XE");
	if (!$conn) {
		$m = oci_error();
		echo $m['message'], "\n";
		exit;
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
  <fieldset style='height: 400px; margin: 0px auto; width: 750px;'>
<form action='Menu_add.php' method='post'>
<h2>Add new menu</h2>
<hr>

	Menu name :
	<input name='new_name' type='input'>
	Price :
	<input name='new_price' type='input'>
	Getpoint : 
	<input name='new_getpoint' type='input'>

<input type="submit" name="submit" value="ADD"><br><br>
<a href='Menu_edit.php'>back to main menu</a><br>
</form>

</body>
</head>


<?php

if(isset($_POST['submit'])) {
$addName = trim($_POST['new_name']);
$addPrice = trim($_POST['new_price']);
$addGetpoint = trim($_POST['new_getpoint']);
echo "you just add ";
echo "Menu : ".$addName." Price : ".$addPrice." Getpoint : ".$addGetpoint;
	
$query = "INSERT INTO DB_MENU (MNAME, PRICE, GETPOINT)
		VALUES ('$addName', '$addPrice', '$addGetpoint')";
$parseRequest = oci_parse($conn, $query);
oci_execute($parseRequest);


oci_close($conn);
}
?>