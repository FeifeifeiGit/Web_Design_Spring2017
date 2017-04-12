<?php


// Initiate Server
$servername = "webdesignfinal.ccxaerxt39bn.us-west-2.rds.amazonaws.com:3306";
$username = "webteam";
$password = "12345678";
$dbname = "findCircle";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


// Set up attributes
$messageError = array();

$firstName = $lastName = $displayName = $gender = $email = $password = $birthday = $desc = $schoolOrWork = "";
$profilePhoto = null;

$firstName = $_POST["firstName"];
$lastName = $_POST["lastName"];
$displayName = $_POST["displayName"];
$gender = $_POST["gender"];
$email = $_POST["email"];
$password = $_POST["password"];
$birthday = $_POST["birthday"];
$desc = $_POST["desc"];
$schoolOrWork = $_POST["schoolOrWork"];

// PHP validate form
if ($firstName== "") { $messageError = "Please input correct First Name".$firstName; }
if ($lastName== "")  { $messageError = "Please input correct Last Name".$lastName; }
if ($displayName== "") { $messageError = "Please input correct Display Name".$displayName; }
if ($gender== "") { $messageError = "Please input gender".$gender; }
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { $messageError = "Please input correct email".$email; }
if ($password== "") { $messageError = "Please input correct password".$password; }



    

// SQL for register users
$sql="INSERT INTO Users (FirstName,LastName,DisplayName,Gender,Email,Password,Birthday,ProfilePhoto,Description,SchoolOrWork)"
    . " VALUES('$firstName','$lastName','$displayName','$gender','$email','$password','$birthday',NULL,'$desc','$schoolOrWork')";
$result=mysqli_query($conn, $sql);
if($result==false){
    echo "error update<br>";
} else {
    echo "Registration Succeed<br>";
    header('Location: login.php');
}


// Print Error Msg
echo "<p><font color=\"red\">";
foreach($messageError as $value)
{
    echo "<b>List of the Errors:</b><br/>";
	echo "$value <br/>";
    
}
echo "<a href=\"register.php\" >Go Back</a></p>";
?>