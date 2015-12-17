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

<form action='ChangePass.php' method='post'>
<br><br><div style = "width: 300px; margin: 0px auto; background: rgba(200,200,200,0.4);"><br><br>
&nbsp Password  <br>&nbsp &nbsp <input name='password' type='password'><br><br>
&nbsp New Password  <br>&nbsp &nbsp <input name='newpassword' type='password'><br><br>
&nbsp Confirm Password  <br>&nbsp &nbsp <input name='confpassword' type='password'><br><br>
<center><input name='submit' type='submit' value='Confirm'></center><br><br>
	<li><a href='MemberPage.php'>Back</a></li>
	<?PHP
 
	if(isset($_POST['submit'])){
		$newpass = trim($_POST['newpassword']);
		$confpass = trim($_POST['confpassword']);
		$password = trim($_POST['password']);
		
		// Fetch each row in an associative array
		//$row = oci_fetch_array($parseRequest, OCI_RETURN_NULLS+OCI_ASSOC);
		
		/*echo $_SESSION['PASSWORD']."<br>";
		echo "ID : ".$_SESSION['ID']."<br>";
		echo "NAME : ".$_SESSION['NAME']."<br>";
		echo "SURNAME : ".$_SESSION['SURNAME']."<br>";*/
	
		if($newpass == $confpass && $newpass != NULL && $password == $_SESSION['PASSWORD']){			
			$query = "UPDATE DB_HUMAN SET PASSWORD='$newpass' WHERE USERNAME = '".$_SESSION['USERNAME']."' and PASSWORD = '$password'";
			$_SESSION['PASSWORD'] = $newpass;
			$parseRequest = oci_parse($conn, $query);
			oci_execute($parseRequest);
			//echo $_SESSION['PASSWORD'];
			echo 'Success!!';		
		}
		else{
			echo 'Error!!';
		}
	};
	oci_close($conn);
?>
</fieldset>
</form>
</body>
</html>


