<?php
session_start();
if((!isset($_SESSION['userId'])) || empty($_SESSION['userId'])){
   // exit( "<div style='color:blue;margin-top:100px;'><h2>Please login first &nbsp<a href='login.php'>login</a></h2><h3>Don's have an account &nbsp <a href='register.php'>Register Here</a></h3></div>");  
	header('Location: login.php');
}
?>