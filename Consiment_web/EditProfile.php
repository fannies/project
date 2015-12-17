<?PHP
	session_start();	
	$conn = oci_connect("system", "Dom546275", "//localhost/XE", "al32utf8");
	
	if(empty($_SESSION['H_ID']) || empty($_SESSION['F_NAME']) || empty($_SESSION['S_NAME'])){
		echo '<script>window.location = "loginMember.php";</script>';
	}
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
              <li class="with_ul"><a href="Menu.html">Menu</a></li>
              <li><a href="Promotion.html">Promotion</a></li>
            </ul>
          </nav>
          <div class="clear"></div>
        </div>
        <div class="clear"></div>
      </div>
    </div>
  </header>
</body>
</head>
</html>

<div style = "width: 400px; height: 400px; margin: auto; background: rgba(200,200,200,0.4);">
<form action='EditProfile.php' method='post'>
<br>
	<center><H2>Profile</H2></center>
	<hr>
	<H3><br>
	&nbsp &nbsp &nbsp &nbsp First Name : <input name='fname' type='input' value='<?PHP echo $_SESSION['F_NAME'] ?>' /><br><br> 
	&nbsp &nbsp &nbsp &nbsp Last Name : <input name='lname' type='input' value='<?PHP echo $_SESSION['S_NAME'] ?>' /><br><br>
	&nbsp &nbsp &nbsp &nbsp Birth date : <input type='date' name='bd' value='<?PHP echo $_SESSION['BD'] ?>' /><br><br>
	&nbsp &nbsp &nbsp &nbsp Address : <input name='addr' type='input' value='<?PHP echo $_SESSION['ADDR'] ?>' /><br><br>
	<center><input name='submit' type='submit' value='Confirm'><br><br>	</center>
	<center><input name='back' type='submit' value='Back'></center>
	
<?PHP
	if(isset($_POST['submit'])){
	$fname = trim($_POST['fname']);
	$lname = trim($_POST['lname']);
	$bd = trim($_POST['bd']);
	$addr = trim($_POST['addr']);
	$query = "UPDATE DB_HUMAN SET F_NAME='$fname', S_NAME='$lname', BD='$bd', ADDR='$addr' WHERE USERNAME='".$_SESSION["USERNAME"]."' ";
	$parse = oci_parse($conn, $query);
	oci_execute($parse);
	$_SESSION['F_NAME'] = $fname;
	$_SESSION['S_NAME'] = $lname;
	$_SESSION['BD'] = $bd;
	$_SESSION['ADDR'] = $addr;
	echo '<script>window.location = "EditProfile.php";</script>';
	};
	if(isset($_POST['back'])){
	echo '<script>window.location = "MemberPage.php";</script>'; 
	};
	oci_close($conn);
?>

</form>
</fieldset>
<br>
<footer>
    <center>Faculty of Engineering Chiang Mai University</center>
    <div class="clear"></div>
</footer>

</body>
</html>