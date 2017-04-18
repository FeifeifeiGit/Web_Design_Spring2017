<?php
include "../s3.php";
include "../db.php";

session_start();
$currentId=$_SESSION['userId'];

$imagename="";
$target_dir="postdata/";

$friendId="";

if(!empty($_GET['friendId'])){
    $friendId=$_GET['friendId'];
}

//upload photo from user's photo page
if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(!empty( basename($_FILES["uploadimage"]["name"]))){
      $imagename = $target_dir . basename($_FILES["uploadimage"]["name"]); 
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
        $sql="INSERT INTO Post (Photo_Path, User_Id) VALUES ('$targetPath', '$currentId')";
        $result=mysqli_query($conn, $sql);
        if($result==false){
            echo "error upload image<br>";
        }       
    }
    header("Location: ../photo.php#photowall");
    exit; 
}

//delete photo
if(!empty($_GET['delete'])){
    $id=$_GET['delete'];
    
    $sql = "DELETE FROM Post WHERE Post_Id='$id'";
    $result=mysqli_query($conn, $sql);
        if($result==false){
            echo "error delete photo post<br>";
        }  
    header("Location: ../photo.php#photowall");
    exit; 

  }

//add post to user like list
if(!empty($_GET['addToLike'])){
    $id=$_GET['addToLike'];
    $sql="INSERT INTO UserLike (User_Id, Post_Id) VALUES ('$currentId', '$id')";
    $result=mysqli_query($conn, $sql);
    if($result==false){
        echo "error add to like<br>";
    }
    header("Location: ../photo.php#photowall");
    exit; 
  }

//add to like from friend page
if(!empty($_GET['friendAddToLike'])){
    $id=$_GET['friendAddToLike'];
    $sql="INSERT INTO UserLike (User_Id, Post_Id) VALUES ('$currentId', '$id')";
    $result=mysqli_query($conn, $sql);
    if($result==false){
        echo "error add to like<br>";
    }
    header("Location: ../friendPhoto.php?friendId=$friendId");
    exit; 
  }

  //add to like from friend page
if(!empty($_GET['friendAddToLikeTab'])){
    $id=$_GET['friendAddToLikeTab'];
    $sql="INSERT INTO UserLike (User_Id, Post_Id) VALUES ('$currentId', '$id')";
    $result=mysqli_query($conn, $sql);
    if($result==false){
        echo "error add to like<br>";
    }
    header("Location: ../friendPhoto.php?friendId=$friendId#like");
    exit; 
  }


//remove post from user like list
if (!empty($_GET['removeLike'])) {
    $id=$_GET['removeLike'];
    $sql="DELETE FROM UserLike WHERE Post_Id=$id and User_Id='$currentId'";
    $result=mysqli_query($conn, $sql);
    if($result==false){
        echo "cannot remove from like list<br>";
    }
    
    header("Location: ../photo.php#photowall");
    exit; 
}


if(!empty($_GET['removeLikeTab'])) {
    $id=$_GET['removeLikeTab'];
    $sql="DELETE FROM UserLike WHERE Post_Id=$id and User_Id='$currentId'";
    $result=mysqli_query($conn, $sql);
    if($result==false){
        echo "cannot remove from like list<br>";
    }
    
    header("Location: ../photo.php#like");
    exit; 
}

//remove post from user like list in friend photo page
if (!empty($_GET['friendRemoveLike'])) {
    $id=$_GET['friendRemoveLike'];
    $sql="DELETE FROM UserLike WHERE Post_Id=$id and User_Id='$currentId'";
    $result=mysqli_query($conn, $sql);
    if($result==false){
        echo "cannot remove from like list<br>";
    }   
    header("Location: ../friendPhoto.php?friendId=$friendId");
    exit; 
}


if(!empty($_GET['friendRemoveLikeTab'])) {
    $id=$_GET['friendRemoveLikeTab'];
    $sql="DELETE FROM UserLike WHERE Post_Id=$id and User_Id='$currentId'";
    $result=mysqli_query($conn, $sql);
    if($result==false){
        echo "cannot remove from like list<br>";
    }    
    header("Location: ../friendPhoto.php?friendId=$friendId#like");
    exit; 
}

?>