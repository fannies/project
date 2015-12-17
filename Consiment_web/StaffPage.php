<?PHP
	session_start();	
	$conn = oci_connect("system", "Dom546275", "//localhost/XE", "al32utf8");

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
<form>
<div style = "width: 400px; height: 760px; margin: auto; background: rgba(200,200,200,0.4);">

<?PHP

	echo "<br><center><H2><br> Profile ".$_SESSION['USERNAME']."<br></H2><hr></center>";
	echo "&nbsp &nbsp &nbsp &nbsp ID : ".$_SESSION['H_ID']."<br>";
	echo "&nbsp &nbsp &nbsp &nbsp NAME : ".$_SESSION['F_NAME']."<br>";
	echo "&nbsp &nbsp &nbsp &nbsp SURNAME : ".$_SESSION['S_NAME']."<br>";
	echo "&nbsp &nbsp &nbsp &nbsp Role : ".$_SESSION['ROLE']."<br>";
	echo "&nbsp &nbsp &nbsp &nbsp Exp : ".$_SESSION['EXP']."<br>";
	echo "&nbsp &nbsp &nbsp &nbsp Salary : ".$_SESSION['SALARY']."<br>";
	echo "&nbsp &nbsp &nbsp &nbsp <a href='EditProfile.php'>Edit Profile</a>"."<br>";
	echo "&nbsp &nbsp &nbsp &nbsp <a href='ChangePass.php'>Change Password</a>"."<br><br><br>";
	
	echo "<center><H2><a href='Receiption.php'>Receipt</a>"."</H2></center>";
	//echo "<a href='Logout.php'><img src='images/Log_out.png'></a>";
	echo "<br><br><div class=container_12>
				&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
				<a href='OrderList.php'>
				<img src='images/OrderList1.jpg'></a>
				&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
				<a href='Logout.php'>
				<img src='images/Log_out.png'></a>
		</div>";
?>
</fieldset>
</form>
</div>
  
</div>
<fieldset>
<footer>
  <div class="container_12">
    <div class="grid_12"> Faculty of Engineering Chiang Mai University</a> </div>
    <div class="clear"></div>
  </div>
</footer>
</fieldset>
</body>
</html>
