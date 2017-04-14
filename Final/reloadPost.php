<?php
session_start();
include "db.php"; //include config file
//sanitize post value
$page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
$item_per_page = 1;//same as the userHome part 
$offset = (($page_number-1)*$item_per_page);
$currentId = 22;
//$currentId =  $_SESSION["userId"];
//throw HTTP error if page number is not valid
if(!is_numeric($page_number)){
    header('HTTP/1.1 500 Invalid page number!');
    exit();
}

//get current starting point of records
$reloadPostQuery = "SELECT * FROM Post 
Join Users on Users.User_Id=Post.User_Id
WHERE Post.User_Id in (SELECT Friend_Id FROM FriendsList WHERE FriendsList.User_Id='$currentId') 
ORDER BY Post.Post_Time desc 
LIMIT $offset, $item_per_page ";
$reloadPostResult = mysqli_query($conn, $reloadPostQuery);

	while($row = mysqli_fetch_assoc($reloadPostResult)){
            $postOwner = $row['DisplayName'];
            $ownerId = $row['User_Id'];
            $ownerAvarta = $row['ProfilePhoto'];
            $postTimeOrigin = $row['Post_Time'];
            $tempTime = strtotime($postTimeOrigin);
            $postTime = date("D M d Y H:i", $tempTime);
            $postText = $row['Content'];
            $postImage = $row['Photo_Path'];
     //create the loaded post format
      echo "<div class='single-post'><div class='post-owner'><div class='post-avatar'><img src=' ";
      echo  $ownerAvarta;
      echo "'alt='post-owner image' width='30px' height='30px'/></div>";

      echo "<div class='post-infor'><a href='friend_page.php?userId=";
      echo $ownerId;
      echo "'>".$postOwner."</a><p>".$postTime."<span class='glyphicon glyphicon-globe'></span></p></div><span class='closebtn' onclick='this.parentElement.parentElement.style.display='none''>&times;</span></div>";

      echo "<div class='post-body'><div class='post-text'><p>".$postText."</p></div>";
      if(($postImage==null)||($postImage=='')){}
      else{
        echo "<div class='post-pic'><img class='img-responsive' src='".$postImage."' alt='post image icon' width='500' height='450' /></div>";
        }

        echo "</div><hr><div class='post-footer feedback-section'><a href='#like'><span class='glyphicon glyphicon-thumbs-up'></span>Like</a><a href='#comment'><span class='glyphicon glyphicon-comment'></span>Comment</a><a href='#share'><span class='glyphicon glyphicon-share-alt'></span>Share</a>
                        </div></div>";
						
    }

?>