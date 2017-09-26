<?php
include "db.php";
session_start();
$currentId=$_SESSION['userId'];


//post comment
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if(!empty($_POST['comment']) ){
     $message = $_POST['comment'];
      $id= $_POST['postId'];
      $sql_insert = "insert into Comments (Content,User_Id,Post_Id) values ('$message','$currentId','$id');";
       //ob_start();
      $result = mysqli_query($conn, $sql_insert);
      if($result==false){
          echo "error upload comments<br>";
        }
     else{
         header("location:comment.php?Post_Id=$id&User_Id=$currentId");
    exit;
     }
  }
}

//delete a post in user page
if(!empty($_GET['delete'])){
    $id=$_GET['delete'];
    echo "$id";
    $sql = "DELETE FROM Post WHERE Post_Id='$id'";
    $result=mysqli_query($conn, $sql);
        if($result==false){
            echo "error delete photo post<br>";
        }
    //header("location:userPage.php");
    //exit;

  }

//delete friend
if(!empty($_GET['unfriend'])){

  $friendId=$_GET['unfriend'];

  $deleteFromUser="DELETE FROM FriendsList WHERE User_Id='$currentId' AND Friend_Id='$friendId' ";
  $deleteFromFriend="DELETE FROM FriendsList WHERE User_Id='$friendId' AND Friend_Id='$currentId' ";

  $resultUser=mysqli_query($conn, $deleteFromUser);
  $resultFriend=mysqli_query($conn, $deleteFromFriend);

  if($resultUser==false || $resultFriend==false){
        echo "cannot delete friend<br>";
    }
  
    //header("location: friend_page.php?userId=$friendId");

}

//send friend request in friend page
if(!empty($_GET['addFriend'])){

  $friendId=$_GET['addFriend'];

  //check whether user already send request to this person, or user has been sent request from this person
  $check=mysqli_query($conn, "SELECT * FROM Request WHERE Sender_Id='$currentId' AND Receiver_Id='$friendId';");
  //reverse check
  $checkRvs=mysqli_query($conn, "SELECT * FROM Request WHERE Sender_Id='$friendId' AND Receiver_Id='$currentId';");

  if(empty(mysqli_fetch_assoc($check)) && empty(mysqli_fetch_assoc($checkRvs))){

    $query="INSERT INTO Request (Sender_Id, Receiver_Id, Status) VALUES ('$currentId','$friendId', 'sendRequest')";
    $result=mysqli_query($conn, $query);
  }

  //header("Location: friend_page.php?userId=$friendId");
}


//user accept request from others
if(!empty($_GET['agreeAdd'])){
  $friendId=$_GET['agreeAdd'];
  $deleteResult=mysqli_query($conn, "DELETE FROM Request WHERE Sender_Id='$friendId' AND Receiver_Id='$currentId';");

  //add friend in two ways
  $addFriendResult=mysqli_query($conn, "INSERT INTO FriendsList (User_Id, Friend_Id) VALUES ('$currentId', '$friendId')");
  $addFriendRvsResult=mysqli_query($conn, "INSERT INTO FriendsList (User_Id, Friend_Id) VALUES ('$friendId', '$currentId')");
}



//user does not accept request and delete the request
if(!empty($_GET['deleteRqst'])){
  $friendId=$_GET['deleteRqst'];
  $deleteResult=mysqli_query($conn, "DELETE FROM Request WHERE Sender_Id='$friendId' AND Receiver_Id='$currentId';");
}


?>
