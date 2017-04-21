<!DOCTYPE html>
<?php
include "navBar.php";
    
$search = $_SESSION["search"];

$sql="SELECT * FROM Users WHERE FirstName LIKE '$search' OR LastName LIKE '$search' OR DisplayName LIKE '$search' OR SchoolOrWork LIKE '$search'";

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$fields_num = mysqli_num_fields($result);
if(!$result) {
    die("Query to show fields from table failed");
}
?>

<html>
<head>
    <title> Search Results </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
    <link href="css/userHome.css" rel="stylesheet">
    <style>
@import "http://fonts.googleapis.com/css?family=Roboto:300,400,500,700";

.container { margin-top: 20px; }
.mb20 { margin-bottom: 20px; } 

hgroup { padding-left: 15px; border-bottom: 1px solid #ccc; }
hgroup h1 { font: 500 normal 1.625em "Roboto",Arial,Verdana,sans-serif; color: #2a3644; margin-top: 0; line-height: 1.15; }
hgroup h2.lead { font: normal normal 1.125em "Roboto",Arial,Verdana,sans-serif; color: #2a3644; margin: 0; padding-bottom: 10px; }

.search-result .thumbnail { border-radius: 0 !important; }
.search-result:first-child { margin-top: 0 !important; }
.search-result { margin-top: 20px; }
.search-result .col-md-2 { border-right: 1px dotted #ccc; min-height: 140px; }
.search-result ul { padding-left: 0 !important; list-style: none;  }
.search-result ul li { font: 400 normal .85em "Roboto",Arial,Verdana,sans-serif;  line-height: 30px; }
.search-result ul li i { padding-right: 5px; }
.search-result .col-md-7 { position: relative; }
.search-result h3 { font: 500 normal 1.375em "Roboto",Arial,Verdana,sans-serif; margin-top: 0 !important; margin-bottom: 10px !important; }
.search-result h3 > a, .search-result i { color: #248dc1 !important; }
.search-result p { font: normal normal 1.125em "Roboto",Arial,Verdana,sans-serif; } 
.search-result span.plus { position: absolute; right: 0; top: 126px; }
.search-result span.plus a { background-color: #248dc1; padding: 5px 5px 3px 5px; }
.search-result span.plus a:hover { background-color: #414141; }
.search-result span.plus a i { color: #fff !important; }
.search-result span.border { display: block; width: 97%; margin: 0 15px; border-bottom: 1px dotted #ccc; }
    </style>

</head>
<body>

    
<div class="container">

    <hgroup class="mb20">
		<h1>Search Results</h1>
		<h2 class="lead"><strong class="text-danger"></strong>Results were found for the search for <strong class="text-danger"><?php echo str_replace("%", "", $search);?></strong></h2>								
	</hgroup>

    <?php 
        do {
            echo "<section class='col-xs-12 col-sm-6 col-md-12'><article class='search-result row'>";

            echo "<div class='col-xs-12 col-sm-12 col-md-3'><a>";
            if ($row['ProfilePhoto'] == null || $row['ProfilePhoto'] == "") {
                echo "<img src='https://justatic.com/v/20160506a/shared/images/icons/placeholders/profile.png' style='width:100%' class='img-responsive img-thumbnail'></a></div>";
                
            } else {
                echo "<img src=".$row['ProfilePhoto']." style='width:100%' class='img-responsive img-thumbnail'></a></div>";
            }
            

            echo "<div class='col-xs-12 col-sm-12 col-md-2'><ul class='meta-search'>";
            echo "<li><i class='glyphicon glyphicon-user'></i><span>".$row['Gender']."</span></li>";
            echo "<li><i class='glyphicon glyphicon-envelope'></i> <span>".$row['Email']."</span></li>";
            echo "<li><i class='glyphicon glyphicon-home'></i><span>".$row['SchoolOrWork']."</span></li></ul></div>";

            echo "<div class='col-xs-12 col-sm-12 col-md-7 excerpet'>";
            
            
            if ($_SESSION["userID"] == $row['User_Id']) {
                echo "<h3><a href='userPage.php?userId=".$row['User_Id']."'>".$row['FirstName']." ".$row['LastName']."  (".$row['DisplayName'].")</a></h3>";
            } else {
                echo "<h3><a href='friend_page.php?userId=".$row['User_Id']."'>".$row['FirstName']." ".$row['LastName']."  (".$row['DisplayName'].")</a></h3>";
            }
            
            
            
            echo "<p>".$row['Description']."</p></div>";

            echo "<span class='clearfix borda'></span></article></section>";

        } while($row = mysqli_fetch_assoc($result))
    ?>
</div>
</body>
    
</html>