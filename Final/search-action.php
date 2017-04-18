<?php
session_start();

$input = $_POST["searchInput"];

$search = str_replace("$input", "%$input%", $input);

    
$_SESSION["search"] = $search;

//echo $_SESSION["search"];

header('Location: search-result.php');
?>