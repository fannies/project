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
<div style = "width: 400px; margin: auto; background: rgba(200,200,200,0.4);">
<form action='Memreg.php' method='post'>
	<br><H2><center>Member Registrations</center></H2><hr><br>
	<H3>
	&nbsp &nbsp &nbsp &nbsp First Name : <input name='fname' type='input' required><br><br> 
	&nbsp &nbsp &nbsp &nbsp Last Name : <input name='lname' type='input' required><br><br>
	&nbsp &nbsp &nbsp &nbsp Username : <input name='username' type='input' required><br><br>
	&nbsp &nbsp &nbsp &nbsp Password : <input name='password' type='password' required><br><br>
	&nbsp &nbsp &nbsp &nbsp Confirm Password : <input name='Cpassword' type='password' required><br><br>
	&nbsp &nbsp &nbsp &nbsp Birth date : <input type='date' name='bd' required><br><br>
	&nbsp &nbsp &nbsp &nbsp Address : <input name='addr' type='input' required><br><br>
	<center><input name='submit' type='submit' value='Confirm'><br><br>	</center></H3>
<?PHP
 
	if(isset($_POST['submit'])){
		$fname = trim($_POST['fname']);
		$lname = trim($_POST['lname']);
		$username = trim($_POST['username']);
		$password = trim($_POST['password']);
		$Cpassword = trim($_POST['Cpassword']);
		$bd = trim($_POST['bd']);
		$addr = trim($_POST['addr']);
		$strSQL = "SELECT * FROM DB_HUMAN WHERE USERNAME = '".trim($_POST["username"])."' ";
		$objQuery = oci_parse($conn, $strSQL);
		oci_execute($objQuery);
		$row = oci_fetch_array($objQuery, OCI_RETURN_NULLS+OCI_ASSOC);
		if($row == 0)
		{
			if($password == $Cpassword && $fname != NULL && $lname != NULL){
				
				$query = "INSERT INTO DB_HUMAN(H_ID, USERNAME, PASSWORD, F_NAME, S_NAME, BD, ADDR, TYPE) 
				VALUES (seq_id.nextval,'$username' ,'$password','$fname','$lname','$bd','$addr', 'M')";
				$parseRequest = oci_parse($conn, $query);
				oci_execute($parseRequest);
				$query2 = "INSERT INTO DB_CUSTOMER(C_ID, PAYTOREG, REMPOINT) 
				VALUES (seq_id.currval,'0','0')";
				$parseRequest2 = oci_parse($conn, $query2);
				oci_execute($parseRequest2);
				$query3 = "INSERT INTO DB_CUSTOMER_HIS_LOG(C_ID, HISTORY_LOG) 
				VALUES (seq_id.currval,sysdate)";
				$parseRequest3 = oci_parse($conn, $query3);
				oci_execute($parseRequest3);
				echo "<div style='font:21px Arial,tahoma,sans-serif;color:#424642;'> Successful! </div>";
			}
			else{
				echo "<div style='font:21px Arial,tahoma,sans-serif;color:red'> Wrong Password! </div>";
			}
		}
		else
		{
			echo "<div style='font:21px Arial,tahoma,sans-serif;color:red;'> *ไอดีซ้ำ </div>";
			
		}
	};
	oci_close($conn);
?>
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




