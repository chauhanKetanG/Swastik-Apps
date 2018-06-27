<?php
define('DB_HOST','localhost');
define('DB_NAME','swastikapps');
define('DB_USER','root');
define('DB_PASSWORD','password');

function set_theme(){
if($_GET["changetheme"] && $_GET["theme"]){
$_SESSION['theme'] = $_GET["theme"];
}
if(isset($_SESSION['theme'])){
set_theme_file($_SESSION['theme']);
}
else{
set_theme_file("light");}
}

function set_theme_file($theme){
if($theme=="dark"){
echo <<<_END
<html>
<head>
<link rel='stylesheet' href='css/dark.css' type='text/css'>
<link rel='stylesheet' href='css/main.css' type='text/css'>
</head>
<body>
</body>
</html>
_END;
} 
else{
echo <<<_END
<html>
<head>
<link rel='stylesheet' href='css/light.css' type='text/css'>
<link rel='stylesheet' href='css/main.css' type='text/css'>
</head>
<body>
</body>
</html>
_END;
}
}
?>