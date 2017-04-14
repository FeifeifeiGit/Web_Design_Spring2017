<?php 

function isFriend($friendId, $currentId){
	
	include "db.php";
	$friendlist=$userlist=[];

	//get checked friend's friends, inorder to find whether in the friend list
	$getUserQuery="SELECT User_Id FROM FriendsList WHERE Friend_Id= '$friendId'";
	$getUserResult=mysqli_query($conn, $getUserQuery);
	while ($row= mysqli_fetch_assoc($getUserResult)) {
		array_push($userlist, $row['User_Id']);
	}

	//get current user's friends list, to check wheter this person in list
	$getFriendQuery="SELECT Friend_Id FROM FriendsList WHERE User_Id= '$currentId'";
	$getFriendResult=mysqli_query($conn, $getFriendQuery);
	while ($row= mysqli_fetch_assoc($getFriendResult)) {
		array_push($friendlist, $row['Friend_Id']);
	}


	if(in_array($currentId, $userlist) && in_array($friendId, $friendlist)) return true;
	else return false;


}


 ?>