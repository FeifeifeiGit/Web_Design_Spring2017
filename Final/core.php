<?php 
require_once 'template/vendor/autoload.php';


	$twig=new Twig_Environment($loader);
	$twig->addGlobal('session', $_SESSION);

 ?>