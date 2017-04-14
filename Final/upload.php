<?php
session_start();
define("s3path", "https://s3-us-west-2.amazonaws.com/minisocial/", true);
include "s3.php";
include "db.php";

$currentId = $_SESSION['userId'];
// Check if image file is a actual image or fake image
$target_dir = "post/"; 
$baseName = basename($_FILES["fileToUpload"]["name"]);
error_log($baseName );
$baseName = preg_replace("/[^A-Z0-9._-]/i", "_", $baseName);
$randomNumber = mt_rand();
$parts = pathInfo($baseName);
$baseName = $parts["filename"]."_".$randomNumber.".".$parts["extension"];
$target_file = $target_dir .$baseName ;


$uploadOk = 1;
$postContent="";

if(!empty($_FILES["fileToUpload"])) {
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);  
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
}

 
  //error_log("postContent is $postContent");

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        if(!empty($_FILES["fileToUpload"]["name"]) && !isset($_FILES["fileToUpload"])){
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    /*
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    
        $url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
            // Check for a trailing slash.
            if ((substr($url, -1) == '/') OR (substr($url, -1) == '\\') ) {
                $url = substr ($url, 0, -1); // Chop off the slash.
            }
            // Add the page.
           $url .= '/userHome.php';
            $url.="?image=$target_file";
           // header("location : http://project:8888/upload.php" );
           // echo "<br>url is $url";
            header("Location: $url");
           // header("location:".$url);
            exit();
        
          //  echo "file is stored in".$target_file;
        */
        
            // Check if $uploadOk is set to 0 by an error
        

                    if(!empty(basename($_FILES["fileToUpload"]["name"]))){
                        try{
                        //upload to S3
                            $result = $client->putObject(array(
                                'Bucket' => $bucket,
                                'Key'    => $target_file,
                                'Body' => fopen($_FILES['fileToUpload']['tmp_name'], 'r+'),
                             ));
                             } catch (Exception $e) {
                                exit($e->getMessage());
                             }
                        
                     //save the postpath to 
                     try{
                        $targetPath=s3path.$target_file;
                        $postContent = trim($_POST["postContent"]);
                        $sql = "INSERT INTO Post (Content,Photo_Path,User_Id)
                            VALUES ('".$postContent."','$targetPath','$currentId')";
                        $result = mysqli_query($conn, $sql);
                        if($result==false){
                                echo "insert failed<br> targetPath is ".$targetPath;
                            }
                             else {
                                echo "successfully publish a new post! $postContent";
                            }
                     }
                     catch(Exception $e){
                            exit($e->getMessage());
                     }
                 }else if(empty(trim($_POST["postContent"]))){
                    echo "Cannot send empty post!!!";
                    exit;
                 }
                 else{
                    //if no image,just insert the content.
                     try{
                        $targetPath=s3path.$target_file;
                        $postContent = trim($_POST["postContent"]);
                        $result1 = mysqli_query($conn, $sql);
                        $sql = "INSERT INTO Post (Content,User_Id)
                            VALUES ('".$postContent."','$currentId')";
                        $result = mysqli_query($conn, $sql);
                        if($result==false){
                                echo "insert failed<br> targetPath is ".$targetPath;
                            }
                             else {
                                echo "successfully publish a new post without image! $postContent";
                            }
                     }
                     catch(Exception $e){
                            exit($e->getMessage());
                     }
                 }
        }


?>
