<?php 
include "db.php";

 //get all user's posts
$sql="SELECT Photo_Path, Post_Id FROM Post WHERE User_Id='$currentId' ";
$result=mysqli_query($conn, $sql);
$postList=[];

//display all post
while($row = mysqli_fetch_assoc($result)){
	//$image = $row['Photo_Path'];
	//$postId = $row['Post_Id'];
	if($row['Photo_Path']!=null){
		array_push($postList, $row);
	}
}



//get user liked posts
$likedList=[];
$likedSql="SELECT Photo_Path, Post_Id FROM Post WHERE Post_Id in (SELECT Post_Id FROM UserLike WHERE User_Id='$currentId')";
$likedResult=mysqli_query($conn, $likedSql);
while($row = mysqli_fetch_assoc($likedResult)){
	//$image = $row['Photo_Path'];
	//$id= $row['Post_Id'];
	if($row['Photo_Path']!=null){
		array_push($likedList, $row);
	}
}

if(!empty($friendId)){
	//get all friend's posts
	$friendSql="SELECT Photo_Path, Post_Id FROM Post WHERE User_Id='$friendId' ";
	$friendResult=mysqli_query($conn, $friendSql);
	$friendPostList=[];

//display all post
	while($row = mysqli_fetch_assoc($friendResult)){
	//$image = $row['Photo_Path'];
	//$postId = $row['Post_Id'];
		if($row['Photo_Path']!=null){
			array_push($friendPostList, $row);
		}
	}



//get friend's liked posts
	$friendLikedList=[];
	$friendLikedSql="SELECT Photo_Path, Post_Id FROM Post WHERE Post_Id in (SELECT Post_Id FROM UserLike WHERE User_Id='$friendId')";
	$friendLikedResult=mysqli_query($conn, $friendLikedSql);
	while($row = mysqli_fetch_assoc($friendLikedResult)){
	//$image = $row['Photo_Path'];
	//$id= $row['Post_Id'];
		if($row['Photo_Path']!=null){
			array_push($friendLikedList, $row);
		}
	}
}

$postquery="SELECT Post_Id FROM UserLike WHERE User_Id='$currentId'";
$likedresult=mysqli_query($conn, $postquery);
$likedPost=Array();
while($row = mysqli_fetch_assoc($likedresult)){
	array_push($likedPost, $row['Post_Id']);
	
}




?>