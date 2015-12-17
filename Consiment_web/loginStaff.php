<?PHP
	session_start();
	// Create connection to Oracle
	$conn = oci_connect("system", "Dom546275", "//localhost/XE", "al32utf8");

	if (!$conn) {
		$m = oci_error();
		echo $m['message'], "\n";
		exit;
	} 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>


	<!-- General meta information -->
	<title>Login Form by Oussama Afellad</title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<meta name="robots" content="index, follow" />
	<meta charset="utf-8" />
	<!-- // General meta information -->
	
	
	<!-- Load Javascript -->
	<script type="text/javascript" src="./js/jquery.js"></script>
	<script type="text/javascript" src="./js/jquery.query-2.1.7.js"></script>
	<script type="text/javascript" src="./js/rainbows.js"></script>
	
	<link rel="icon" href="images/favicon.ico">
<link rel="shortcut icon" href="images/favicon.ico">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/slider.css">
<script src="js/jquery-migrate-1.1.1.js"></script>
<script src="js/superfish.js"></script>
<script src="js/jquery.easing.1.3.js"></script>
<script src="js/sForm.js"></script>
<script src="js/jquery.carouFredSel-6.1.0-packed.js"></script>
<script src="js/tms-0.4.1.js"></script>
	<!-- // Load Javascipt -->

	<!-- Load stylesheets -->
	<link type="text/css" rel="stylesheet" href="css/style1.css" media="screen" />
	<!-- // Load stylesheets -->
	
<script>


	$(document).ready(function(){
 
	$("#submit1").hover(
	function() {
	$(this).animate({"opacity": "0"}, "slow");
	},
	function() {
	$(this).animate({"opacity": "1"}, "slow");
	});
 	});


</script>
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
</head>
<body>
<form action='loginStaff.php' method='post'>
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
  </div>
	<div id="wrapper">
		<div id="wrappertop"></div>

		<div id="wrappermiddle">

			<h2>Login Staff</h2>
			<div id="username_input">

		<div id="username_inputleft"></div>
		<div id="username_inputmiddle">
			<input type="text" name="username" id="url" value="Your Account" onclick="this.value = ''">	
			<img id="url_user" src="./images/mailicon.png" alt="">
		</div>
		<div id="username_inputright"></div>
		</div>
		
		<div id='password_input'>
		<div id="password_inputleft"></div>
		<div id="password_inputmiddle">
			<input type="password" name="password" id="url" value="Password" onclick="this.value = ''">
			<img id="url_password" src="./images/passicon.png" alt="">	
		</div>
		<div id="password_inputright"></div>
		
		</div>

		<form>
		<input name='submit' type="submit" id="submit" value="Sign In">
		</form>
	<?PHP
 
	if(isset($_POST['submit'])){
		$username = trim($_POST['username']);
		$password = trim($_POST['password']);
		$query = "SELECT * FROM DB_HUMAN, DB_STAFF WHERE USERNAME='$username' and PASSWORD='$password' and S_ID=H_ID ";
		$parseRequest = oci_parse($conn, $query);
		oci_execute($parseRequest);
		// Fetch each row in an associative array
		$row = oci_fetch_array($parseRequest, OCI_RETURN_NULLS+OCI_ASSOC);
		if($row && $row['TYPE'] == 'S'){
			
			$_SESSION['H_ID'] = $row['H_ID'];
			$_SESSION['F_NAME'] = $row['F_NAME'];
			$_SESSION['S_NAME'] = $row['S_NAME'];
			$_SESSION['USERNAME'] = $row['USERNAME'];
			$_SESSION['PASSWORD'] = $row['PASSWORD'];
			$_SESSION['ROLE'] = $row['ROLE'];
			$_SESSION['SALARY'] = $row['SALARY'];
			$_SESSION['EXP'] = $row['EXP'];
			$hislog = "INSERT INTO DB_STAFF_HIS_LOG (S_ID, HISTORY_LOG)
			VALUES ('".$_SESSION['H_ID']."', sysdate)";
			$parseHis = oci_parse($conn, $hislog);
			oci_execute($parseHis);
			echo '<script>window.location = "StaffPage.php";</script>';
		}else{
			echo "<div style='font:21px Arial,tahoma,sans-serif;color:red'> Login Fail. </div>";
		}
	};
?>
	</div><br>
<center><fieldset>
<footer>
  <div>
    <div> Faculty of Engineering Chiang Mai University</div>
  </div>
</footer>
</fieldset></center>
</form>
</body>
</html>