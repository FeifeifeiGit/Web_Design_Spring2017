<?php
include "db.php";
session_start();
$currentId=$_SESSION['userId'];



if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if(!empty($_POST['comment']) ){
     $message = $_POST['comment'];
      $id= $_POST['postId'];
      $sql_insert = "insert into Comments (Content,User_Id,Post_Id) values ('$message',2,'$id');";
       //ob_start();
      $result = mysqli_query($conn, $sql_insert);
      if($result==false){
          echo "error upload comments<br>";
        }
     else{
        header("location: friend_page.php");
    exit;
     }
  }
}

if($_GET['unfriend']){

  $friendId=$_GET['unfriend'];

  $deleteFromUser="DELETE FROM FriendsList WHERE User_Id='$currentId' AND Friend_Id='$friendId' ";
  $deleteFromFriend="DELETE FROM FriendsList WHERE User_Id='$friendId' AND Friend_Id='$currentId' ";

  $resultUser=mysqli_query($conn, $deleteFromUser);
  $resultFriend=mysqli_query($conn, $deleteFromFriend);

  if($resultUser==false || $resultFriend==false){
        echo "cannot delete friend<br>";
    }
  else{
    header("location: friend_page.php?userId=$friendId");
    exit;
  }

}

?>