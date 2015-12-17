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

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}

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
$(function(){
	$("dd").css("display","none");
	$("dt:first").addClass("selected");
	$("dl dt").click(function(){
		if($("+dd",this).css("display")=="none"){
			$("dd").slideUp("slow");
			$("+dd",this).slideDown("slow");
			$("dt").removeClass("selected");
			$(this).addClass("selected");
		}
		else{
			$("dd").slideUp("slow");
			$("dt").removeClass("selected");
		}
	}).mouseover(function(){
		$(this).addClass("over");
	}).mouseout(function(){
		$(this).removeClass("over");
	});
});

</script>
<style>

{ 
    background-size: cover;	
	
	th,td
		{
		font-size:small;	
		}
	}
	dl
	{
		width:250;
	}

	tr
	{
		border-style:solid;
		vertical-align:top;
	}

	

	dt.selected
	{					
		cursor:pointer;
		color:black;
	}
	dd
	{
		background-color:d2bd77;
		font-size:18;
		font-align:left;
	}
</style>
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
 <form action='GeustPage.php' method='post'>
<div style = "width: 400px; height: 760px; margin: auto; background: rgba(200,200,200,0.4);">
<?PHP
	$query = "SELECT * FROM DB_HUMAN WHERE USERNAME='guest'";
	$parse = oci_parse($conn, $query);
	oci_execute($parse);
	$row = oci_fetch_array($parse, OCI_RETURN_NULLS+OCI_ASSOC);
	$hislog = "INSERT INTO DB_CUSTOMER_HIS_LOG (C_ID, HISTORY_LOG)
			VALUES ('".$row['H_ID']."', sysdate)";
	$parseHis = oci_parse($conn, $hislog);
	oci_execute($parseHis);
	$_SESSION['H_ID'] = $row['H_ID']; 
	echo "<center><H2><br> Profile ".$row['F_NAME']."<br></H2></center><br><hr>";
	echo "<br><center><H3>ID : ".$row['H_ID']."<br></H3></center>";
	echo "<center><H3>NAME : ".$row['F_NAME']."<br><br></H3></center>";
	//echo "<a href='Logout.php'><img src='images/Log_out.png'></a></H3>";
	echo "<br><br><div class=container_12>
				&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp 
				<a href='Orderguest.php'>
				<img src='images/Order2.png'></a>
				&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
				<a href='Logout.php'>
				<img src='images/Log_out.png'></a>
		</div>";
	oci_close($conn);
?>
</fieldset>
</form>
	</div>
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

