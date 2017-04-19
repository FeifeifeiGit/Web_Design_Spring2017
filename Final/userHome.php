<?php
 //include "checkLogin.php"; 
include "s3.php";
include "db.php";
include "checkLogin.php";
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html>
<head>
	<title>
	  user home page
	</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
	  integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
	  crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="css/userHome.css" rel="stylesheet">
	<script src="css/userHome.js?v=3"></script>
	<script src="css/newPost.js"></script>
	<link href="https://afeld.github.io/emoji-css/emoji.css" rel="stylesheet">
</head>
<body>
<?php include "navBar.php";?>

       <div class="main-wrapper container-fluid text-left">
			<div class="row">

				<div class="col-sm-8 col-sm-push-2 " id="center-col">
				   <div class="new-post">
				   		<div class="new-post-header">
				   			<a href="#newpost"><span class="glyphicon  glyphicon-pencil"></span>what is in your mind?</a>
				   		</div>
				   		
					   	<div class="new-post-body">	
				   		 	<div style="margin-bottom:30px;">
				   		 		<a href="friend_page.php?userId=<?php echo $currentId ;?>"><img  src="<?php echo $avatar ; ?>" class="avatar img-responsive" width="30" height="20" alt="Avatar"/></a>
				   		 	</div>
				   			<div style="text-align:center">
								 <textarea rows="3" cols="80" data-toggle="modal" data-target="#postModal">
								</textarea>
							</div>	
						</div>

						<div class="new-post-footer">
							<a class="btn" data-toggle="modal" data-target="#postModal"><span><img src="img/images-icon.png" width="30px" height="25px" /></span>Photos
							</a>
							<span id="posting-feedback"> post test here </span>
						</div>
					</div>

					<!-- Modal -->
					<div id="postModal" class="modal fade" role="dialog">
						 <div class="modal-dialog">
						   <!-- Modal content-->
						    <div class="modal-content">
						        <div class="modal-header">
							       <span class="glyphicon glyphicon-pencil"></span>create a new post
						        </div>
							    <div class="modal-body">
							        <div id="postContent" contenteditable="true" >
							             <div>
							             	<img id="preview-img" height="50" alt=""/>
							             </div>
							        </div>
							    </div>
						      	<div class="modal-footer">
						     		<form action="upload.php" method="post" enctype="multipart/form-data">
							      		<a class="btn pull-left" onclick="document.getElementById('fileToUpload').click();"><span><img src="img/images-icon.png" width="30px" height="25px" /></span>Photos
							      		</a>
							      		<input type="file" name="fileToUpload" id="fileToUpload"
							      		onchange="previewFile()">
							      		<a class="btn pull-left"><i class="em em-angry"></i>Feeling/Mood</a>
							      		<input type="button" name ="submit" id="submit" value="Create" class="btn btn-danger">
							      	</form>

						      	</div>
						    </div>
						</div>
					</div>

<?php
$item_per_page = 1;
$homePostQuery = "SELECT * FROM Post
Join Users on Users.User_Id=Post.User_Id
WHERE Post.User_Id in (SELECT Friend_Id FROM FriendsList WHERE FriendsList.User_Id='$currentId')
ORDER BY Post.Post_Time desc
LIMIT $item_per_page";
$homePostResult = mysqli_query($conn, $homePostQuery);
				while($row = mysqli_fetch_assoc($homePostResult)){
                        $postOwner = $row['DisplayName'];
                        $ownerId = $row['User_Id'];
                        $ownerAvarta = $row['ProfilePhoto'];
                        $postTimeOrigin = $row['Post_Time'];
                        $tempTime = strtotime($postTimeOrigin);
                        $postTime = date("D M d Y H:i", $tempTime);
                        $postText = $row['Content'];
                        $postImage = $row['Photo_Path'];
                        $liked_num = $row['Liked_num'];
 ?>
					<div class="single-post">
						<div class="post-owner">
							<div class="post-avatar">
								<img src="<?php echo $ownerAvarta; ?>" alt="post-owner image" width="30px" height="30px"/>
							</div>
							<div class="post-infor">
								<a href="friend_page.php?userId=<?php echo $ownerId;?>"><?php echo $postOwner;?></a>
								<p><?php echo $postTime;?><span class="glyphicon glyphicon-globe"></span></p>
							</div>
							<span class="closebtn" onclick="this.parentElement.parentElement.style.display='none'">&times;</span>
						</div>
						<div class="post-body">
							<div class="post-text">
							   <p>
							 		<?php echo $postText;?>
							   </p>
							</div>
						<?php
						   if(($postImage==null)||($postImage=="")){}
						   else{
						?>
							<div class="post-pic">
								<img class="img-responsive" src="<?php echo $postImage;?>" alt="post image icon" width="500" height="450" />
							</div>

						<?php
							}
						 ?>
						</div>
						<hr>
						<div class="post-footer feedback-section">
								<a href="#like"><span class="glyphicon glyphicon-thumbs-up"></span>Like
								<a href="#comment"><span class="glyphicon glyphicon-comment"></span>Comment</a>
								<a href="#share"><span class="glyphicon glyphicon-share-alt"></span>Share</a>
						</div>
					</div>
						<?php
                                }
                        ?>
<!-- post end -->
					<div class="loading-info"><img src="img/ajax-loader.gif" /></div>

				</div>
<!--left side bar -->
				<div class="col-sm-2 col-sm-pull-8 leftSideBar">
					<div class="left-wrapper">
						<div class="profile-shortcut">
							<a href="friend_page.php?userId=<?php echo $currentId ;?>"><img  src="<?php echo $avatar ; ?>"  alt="avatar" width="20" height="20"/> <?php echo $displayName; ?>
								<a class="edit-icon" href="profile.php"><span class="glyphicon glyphicon-edit"></span></a>
							</a>
						</div>
						<div class="calender">
						 	<img src="img/calender.jpg" alt="calender"/>
						</div>
						<div class="comming-event">
							<div class="side-title">Upcomming event</div>
							<li>NU student contest</li>
							<li>Networking lightround</li>
							<li>NU student contest</li>
							<li>Networking lightround</li>
						</div>
					</div>
				</div>

<!--left side bar end -->

				<div class="col-sm-2 rightSideBar">

					<div class="usePage-friend-list">
<!-- Friend list end-->
<?php
$Firends_number = 10;
$friendListQuery = "SELECT * FROM Users WHERE User_Id in (SELECT Friend_Id FROM FriendsList WHERE User_Id='$currentId') ORDER BY Users.online LIMIT $Firends_number";
$fListResult = mysqli_query($conn, $friendListQuery);
				while($row = mysqli_fetch_assoc($fListResult)){
                        $friendAvarta = $row['ProfilePhoto'];
                        $friendId= $row['User_Id'];
                        $friendName = $row['DisplayName'];
                        $online = $row['Online'];
 ?>
						<div class="friend-item">
							<a href="friend_page.php?userId=<?php echo $friendId ;?>"><img src="<?php echo $friendAvarta; ?>" alt="avatar" width="24" height="24"/><span><?php echo $friendName; ?></span></a>
							
							<?php
							  if ($online==1){
							  	echo "<span class='online-icon fa fa-circle'></span></a>";
							  }else{
							  	echo "<span class='offline-icon fa fa-circle'></span></a>";
							  	}
							 ?>
						</div>
						<?php
                                }
                        ?>

<!-- Friend list end-->
						<div class="rightSideBar-footer">
	    	           		<button type="submit" onclick="myFunction()">
	    	           			 <i class="glyphicon glyphicon-search"></i>
	    	           		</button>
	    	           		<input type="text" onkeyup="myFunction()" placeholder="Search"><button>
	    	           			 <i class="glyphicon glyphicon-cog"></i>
	    	           		</button>
						</div>

					</div>
				</div>
<!--right side bar end -->
			</div>
		</div>
				
<script src="css/postSubmit.js?v=3"></script>
<script src="css/reloadPost.js?v=1"></script>
</body>
</html>
