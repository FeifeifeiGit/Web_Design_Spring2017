<?php
// Start Session
session_start();

include "s3.php";

include "db.php";


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
//$password = hash("sha256", $password);
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


// Set up profile image upload
$imagename="";
$target_dir="img/";
$imagename = $target_dir . basename($_FILES["uploadimage"]["name"]);
if(!empty( basename($_FILES["uploadimage"]["name"]))){
    $result = $client->putObject(array( 
        'Bucket' => $bucket,
        'Key'    => $imagename,
        'Body' => fopen($_FILES['uploadimage']['tmp_name'], 'r+'),
        'options' => ['scheme' => 'http',],
    ));
    $targetPath="https://s3-us-west-2.amazonaws.com/minisocial/".$imagename;
} else {
    $targetPath = null;
}

    

// SQL for register users
$sql="INSERT INTO Users (FirstName,LastName,DisplayName,Gender,Email,Password,Birthday,ProfilePhoto,Description,SchoolOrWork)"
    . " VALUES('$firstName','$lastName','$displayName','$gender','$email','$password','$birthday','$targetPath','$desc','$schoolOrWork')";
$result=mysqli_query($conn, $sql);
if($result==false){
    header('Location: register.php');
} else {
 
    // Finished Registration direct to Login
    $_SESSION["username"] = $email;
    $_SESSION["message"] = "Registration Succeed";
    
    header('Location: login.php');
}
    
?>