<?php
include "s3.php";
include "db.php";

$imagename="";
$target_dir="postdata/";
$imagename = $target_dir . basename($_FILES["uploadimage"]["name"]);

if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(!empty( basename($_FILES["uploadimage"]["name"]))){
       
        try{
            
            //upload to S3
            $result = $client->putObject(array(
                'Bucket' => $bucket,
                'Key'    => $imagename,
                'Body' => fopen($_FILES['uploadimage']['tmp_name'], 'r+'),
                'options' => [
                        'scheme' => 'http',
                ],

            ));

         } catch (Exception $e) {

            exit($e->getMessage());
        }

        $targetPath="https://s3-us-west-2.amazonaws.com/minisocial/".$imagename;
        $sql="INSERT INTO Post (Photo_Path, User_Id) VALUES ('$targetPath', 1)";
        $result=mysqli_query($conn, $sql);
        if($result==false){
            echo "error upload image<br>";
        }
        
    }

    header("Location: photo.php");
    exit; 
}

//delete photo
if($_GET['delete']){
    $id=$_GET['delete'];
    
    $sql = "DELETE FROM Post WHERE Post_Id='$id'";
    $result=mysqli_query($conn, $sql);
        if($result==false){
            echo "error delete photo post<br>";
        }
  
    header("Location: photo.php");
    exit; 

  }

//add post to user like list
if($_GET['addToLike']){
    $id=$_GET['addToLike'];
    $sql="INSERT INTO UserLike (User_Id, Post_Id) VALUES (1, '$id')";
    $result=mysqli_query($conn, $sql);
    if($result==false){
        echo "error add to like<br>";
    }
    header("Location: photo.php");
    exit; 
  }

//remove post from user like list
if ($_GET['removeLike']) {
    $id=$_GET['removeLike'];
    $sql="DELETE FROM UserLike WHERE Post_Id=$id and User_Id=1";
    $result=mysqli_query($conn, $sql);
    if($result==false){
        echo "cannot remove from like list<br>";
    }
    header("Location: photo.php");
    exit; 
}

?>