<?php
include "../s3.php";
include "../db.php";
session_start();

$currentId=$_SESSION['userId'];

$username=$headshot=$birthday=$phonenumber=$workplace=$description="";
$_SESSION['phoneError']= $_SESSION['typeError']=$_SESSION['usernameError']=$_SESSION['birthdayError']="";
$date = date('Y-m-d');
$error=0;

//set upload path
$target_dir="img/";
$headshot = $target_dir . basename($_FILES["headshot"]["name"]);


$uploadOk = 1;

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $username=$_POST["username"];
    $birthday=$_POST["birthday"];
    $phonenumber=$_POST["phone"];
    $workplace=$_POST["workplace"];
    $description=$_POST["description"];


    // php validation 

     if(!empty(basename($_FILES["headshot"]["name"]))){
            //check the uploaded picture
            $check = getimagesize($_FILES["headshot"]["tmp_name"]);
            if($check !== false) {
                $uploadOk = 1;
            } else {
                $error++;
                $_SESSION['typeError']="this is not a real image";
                $uploadOk = 0;
                
            }

            // Check if file already exists
            if (file_exists($headshot)) {
                $error++;
                $_SESSION['typeError']="file already exists";
               
                $uploadOk = 0;
            }
        }
    
    // check file type
    /*这个不能用
    不知为啥不能识别file type
    我加上后全部变成type invalid了
    */

    /*
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
         $error++;
        $_SESSION['typeError']="image invalid";
        $uploadOk = 0;
    }
    */


    if(preg_match('/[^a-z_\-0-9]/i', $username) && !empty($_POST["username"])){
        $error++;
        $_SESSION['usernameError']="username only contains alphanumeric";
        
    }

    if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$birthday) && !empty($_POST["birthday"])){
        $error++;
        $_SESSION['birthdayError']="your date format is invalid";
        
    }
    else if($date<=$birthday){
        $error++;
        $_SESSION['birthdayError']="your date is invalid";
        
    }
   

    if(!preg_match('/^\d{3}-\d{3}-\d{4}$/', $phonenumber) && !empty($_POST["phone"])){      
        $error++;
        $_SESSION['phoneError']="phone format is invalid";
        
    }



  
  /*check if there is any error
  if error detected, return edit profile page
  
    if($error>0){
            $url = "profile.php";  
            echo "<script type='text/javascript'>";  
            echo "window.location.href='$url'";  
            echo "</script>"; 
            exit;  
    } else{

        */

        /*if no error detected, check whether input is empty
        update into database if input is not empty;
        */
        if(!empty($username)){
            $sql="UPDATE  Users SET DisplayName='$username' WHERE User_Id='$currentId'";
            $result=mysqli_query($conn, $sql);
            
        }
 


        if(!empty(basename($_FILES["headshot"]["name"]))){

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk != 0) {
            
                try{
                //upload to S3
                    $result = $client->putObject(array(
                        'Bucket' => $bucket,
                        'Key'    => $headshot,
                        'Body' => fopen($_FILES['headshot']['tmp_name'], 'r+'),
                     ));

                 } catch (Exception $e) {

                    exit($e->getMessage());
                 }
         
         //upload to local folder
         /*
         if (move_uploaded_file($_FILES["headshot"]["tmp_name"], $headshot)) {
             echo "The file ". basename( $_FILES["headshot"]["name"]). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
        */
        }


             //save the image path to database
            $targetPath="https://s3-us-west-2.amazonaws.com/minisocial/".$headshot;
            $sql="UPDATE  Users SET ProfilePhoto='$targetPath' WHERE User_Id='$currentId'";
            $result=mysqli_query($conn, $sql);
            //echo "<br>$targetPath";
            
        }



        if(!empty($phonenumber)){
            $sql="UPDATE  Users SET PhoneNumber='$phonenumber' WHERE User_Id='$currentId'";
            $result=mysqli_query($conn, $sql);
            
        }

        if(!empty($description)){
            $sql="UPDATE  Users SET Description='$description' WHERE User_Id='$currentId'";
            $result=mysqli_query($conn, $sql);
            
        }

        if(!empty($workplace)){
            $sql="UPDATE  Users SET SchoolOrWork='$workplace' WHERE User_Id='$currentId'";
            $result=mysqli_query($conn, $sql);
            
        }

        if(!empty($birthday)){
            $sql="UPDATE  Users SET Birthday='$birthday' WHERE User_Id='$currentId'";
            $result=mysqli_query($conn, $sql);
            
        }
        
        mysqli_close($conn);
       

}

 header("Location: ../profile.php");

?>


