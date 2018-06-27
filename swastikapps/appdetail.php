<?php
session_start();

include 'functions.php';

include 'header.html';

if(!$_GET["app"]){
echo "select app";
$appid = "unitconverter";
//header("Location:index.php");
}
$appid = $_GET["app"];

$connection = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
if ($connection->connect_error) die($connection->connect_error);
//mysql_query("SET NAMES 'utf-8'");
$query = "SELECT * FROM `appsdetails` WHERE `id`='".$appid."'";
//$query = "SELECT * FROM `appsdetails` WHERE `id`=1";
//$query = "SELECT * FROM `appsdetails` WHERE `name`='Password'";
$result = $connection->query($query);

if (mysqli_num_rows($result) > 0) {
	$row = mysqli_fetch_array($result);
	$name=$row[1];
	$brief=$row[2];
	$description=str_replace("\n", "<br/>", $row[3]);
	$downloads=$row[4];
	$rating=$row[5];
	$size=$row[6];
	$icon=$row[7];
	$screenshots=explode(";",$row[8]);
	$links=explode(";;;",$row[9]);
}

if($appid==psychrometricairpropertycalculator || $appid==petrolexpense){
$playstoreid = "com.swastic.".$appid;
}else{
$playstoreid = "com.swastik.".$appid;
}

echo <<<_END
<html lang="en">

<head>
	<meta charset=utf-8>
	<meta name="viewport" content="width=device-width,initial-scale=1.0"/>
	<title>$name</title>
	<script>document.cookie='resolution='+Math.max(screen.width,screen.
	height)+'; path=/';</script>
	<link href="css/main.css" rel="stylesheet" />
</head>

<body>
<div id="wrapper">


<div id="content">
	
	<div id="app_name_and_logo">
                 <div class="theme_select">
			<ul>
				<li>Theme:</li>
				<li><a href="appdetail.php?app=$appid&theme=light&changetheme=y" class="light_button">Light</a></li>
				<li><a href="appdetail.php?app=$appid&theme=dark&changetheme=y" class="dark_button">Dark</a></li>
			</ul>						
		</div>

			<div class="appicon">
			<br>
				<center>
					<img src="images/appicon/$icon" alt="$name"/>
				</center>
			</div>
			
			<div class="app_name_and_brief">
				<ul>
					<li class="appname">$name</li>
					<li class="appbrief">$brief</li>
				</ul>
			</div>
	</div>

	<br><br><br>
	
		<div class="app_feature">
			<center>
				<div class="feature_brief">
					<img class="feature_icon" src="images/icon/downloads.png" alt="Downloads"/>$downloads
				</div>
			</center>
		</div>
		
		
		<div class="app_feature">
			<center>
				<div class="feature_brief">
					<img class="feature_icon" src="images/icon/rating.png" alt="Rating"/>$rating
				</div>
			</center>
		</div>
		
		
		<div class="app_feature">
			<center>
				<div class="feature_brief">
					<img class="feature_icon" src="images/icon/size.png" alt="Size"/>$size
				</div>
			</center>
		</div>
		
			<a class="main_link_download" href="https://play.google.com/store/apps/details?id=$playstoreid" target="_blank"><img class="contact_icon" src="images/icon/download.png" alt="Download"/>Download</a>
		<br><br><br><br>

		<h4 class="subheading">Screenshots:</h4>
	<div class="app_screenshots">
		<center>

_END;

foreach ($screenshots as $screenshot) {
echo <<<_END
	<img src="images/screenshots/$screenshot" alt="$name - $screenshot"/>
_END;
};
	
echo <<<_END

		</center>
		<br><br>
	</div>
	
	
	<h4 class="subheading">Description:</h4>
	<div class="app_description">
		<p>$description
	</div>
	
	<br><br>
_END;

foreach ($links as $link) {
if($link!=""){
$linkdata=explode("@@@",$link);
echo <<<_END
	<a class="main_link" href="$linkdata[1]">$linkdata[0]</a>
_END;
}
};
	
echo <<<_END
<br><br><br>
</div>

</div>

</body>
</html>
_END;


//include 'appdetail.html';

include 'footer.html';

set_theme();
?>