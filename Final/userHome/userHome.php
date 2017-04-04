<?php
//start session, get the username/id in this session
 session_start();
 //change to $sesson("");
 $currentUser ="Fei";
 $currentAvatar = "img/avatar.png";
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
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="css/userHome.css" rel="stylesheet">
	<script src="css/userHome.js"></script>
	<link href="https://afeld.github.io/emoji-css/emoji.css" rel="stylesheet">
</head>
<body>
<?php include "navBar.php";?>

       <div class="main-wrapper container-fluid text-left">
			<div class="row">

				<div class="col-sm-8 col-sm-push-2">
				   <div class="new-post">
				   		<div class="new-post-header">
				   			<a href="#newpost"><span class="glyphicon  glyphicon-pencil"></span>what is in your mind?</a>
				   		</div>
				   		<div class="new-post-body">
				   		 	<div style="margin-bottom:30px;">
				   		 		<a href="#userPage"><img src="img/avatar.png" class="avatar img-responsive" width="30" height="20" alt="Avatar"/></a>
				   		 	</div>
				   			<div>
								<textarea rows="3" cols="90" data-toggle="modal" data-target="#postModal">
									post body here
								</textarea>
							</div>
						</div>
						<div class="new-post-footer">
							<a class="btn"><span><img src="img/images-icon.png" width="30px" height="25px" /></span>Photos
							</a>
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
							             contentEdible Content
							        </div>
							    </div>
						      	<div class="modal-footer">
						     		<form action="upload.php" method="post" enctype="multipart/form-data">
							      		<a class="btn pull-left" onclick="document.getElementById('fileToUpload').click();"><span><img src="img/images-icon.png" width="30px" height="25px" /></span>Photos
							      		</a>
							      		<input type="file" name="fileToUpload" id="fileToUpload">
							      		<a class="btn pull-left"><i class="em em-angry"></i>Feeling/Mood</a>
							      		<input type="submit" name ="submit" value="Create" class="btn btn-danger">  
							      	</form>
									
						      	</div>
						    </div>
						</div>
					</div>

					<div class="single-post">
						<div class="post-owner">
							<div class="post-avatar">
								<img src="img/avatar-1.jpg" alt="post-owner image" width="30px" height="30px"/>
							</div>
							<div class="post-infor">
								<a href="#poster's page">poster name</a>
								<p>Apr.03 2017<span class="glyphicon glyphicon-globe"></span></p>
							</div>
							<span class="closebtn" onclick="this.parentElement.parentElement.style.display='none'">&times;</span>
						</div>
						<div class="post-body">
							<div class="post-text">
							   <p>
							 		I just post a new picture!!!!
							 		image is <?php echo $_GET["image"] ;?>. 
							 		<?php var_dump($_GET)?>
							   </p>
							   <p>
							   	 great music for commute:<a href=" https://www.youtube.com/watch?v=HdzI-191xhU&list=PLa8jvpZUJc5R9a-TH4mCaEocJbPzyDeET ">youtube playlist</a>
							   </p>
							</div>
							<div class="post-pic">
								<img class="img-responsive" src="<?php echo $_GET["image"] ;?>" alt="post image icon" width="500" height="450" />
							</div>
						</div>
						<hr>
						<div class="post-footer feedback-section">
								<a href="#like"><span class="glyphicon glyphicon-thumbs-up"></span>Like</a>
								<a href="#comment"><span class="glyphicon glyphicon-comment"></span>Comment</a>
								<a href="#share"><span class="glyphicon glyphicon-share-alt"></span>Share</a>
						</div>
					</div>

					<div class="single-post">
						<div class="post-owner">
							<div class="post-avatar">
								<img src="img/avatar-1.jpg" alt="post-owner image" width="30px" height="30px"/>
							</div>
							<div class="post-infor">
								<a href="#poster's page">poster name</a>
								<p>Mar.27 2017<span class="glyphicon glyphicon-globe"></span></p>
							</div>
							<span class="closebtn" onclick="this.parentElement.parentElement.style.display='none'">&times;</span>
						</div>
						<div class="post-body">
							<div class="post-text">
							   <p>
							 		nightmire traffic in the morning.
							   </p>
							   <p>
							   	 great music for commute:<a href=" https://www.youtube.com/watch?v=HdzI-191xhU&list=PLa8jvpZUJc5R9a-TH4mCaEocJbPzyDeET ">youtube playlist</a>
							   </p>
							</div>
							<div class="post-pic">
								<img class="img-responsive" src="img/postExample-1.jpeg" alt="post image icon" width="500" height="450" />
							</div>
						</div>
						<hr>
						<div class="post-footer feedback-section">
								<a href="#like"><span class="glyphicon glyphicon-thumbs-up"></span>Like</a>
								<a href="#comment"><span class="glyphicon glyphicon-comment"></span>Comment</a>
								<a href="#share"><span class="glyphicon glyphicon-share-alt"></span>Share</a>
						</div>
					</div>

<!--second post -->
					<div class="single-post">
						<div class="post-owner">
							<div class="post-avatar">
								<img src="img/avatar-2.jpeg" alt="post-owner image" width="30px" height="30px"/>
							</div>
							<div class="post-infor">
								<a href="#poster's page">poster name</a>
								<p>Mar.27 2017<span class="glyphicon glyphicon-globe"></span></p>
							</div>
						</div>
						<div class="post-body">
							<div class="post-text">
							   <p>
							 		blizzard in boston 2017!!!!
							   </p>
							   <p>
							   	  wheather warning : avoid any unnecessary traffic. School cancaled.....
							   </p>
							</div>
							<div class="post-pic">
								<img class="img-responsive" src="img/postExample-2.jpeg" alt="post image icon" width="500" height="450" />
							</div>
						</div>
						<hr>
						<div class="post-footer feedback-section">
								<a href="#like"><span class="glyphicon glyphicon-thumbs-up"></span>Like</a>
								<a href="#comment"><span class="glyphicon glyphicon-comment"></span>Comment</a>
								<a href="#share"><span class="glyphicon glyphicon-share-alt"></span>Share</a>
						</div>
					</div>
<!--second post end -->	
<!--third post -->
					<div class="single-post">
						<div class="post-owner">
							<div class="post-avatar">
								<img src="img/avatar-3.jpeg" alt="post-owner image" width="30px" height="30px"/>
							</div>
							<div class="post-infor">
								<a href="#poster's page">poster name</a>
								<p>Mar.27 2017<span class="glyphicon glyphicon-globe"></span></p>
							</div>
						</div>
						<div class="post-body">
							<div class="post-text">
							   <p>
							 		Spring in the air Finally!!! Kidding
							   </p>
							   <p>
							   	  low quality picture to show the post effect on my post page.
							   </p>
							</div>
							<div class="post-pic">
								<img class="img-responsive" src="img/postExample-3.jpeg" alt="post image icon" width="500" height="450" />
							</div>
						</div>
						<hr>
						<div class="post-footer feedback-section">
								<a href="#like"><span class="glyphicon glyphicon-thumbs-up"></span>Like</a>
								<a href="#comment"><span class="glyphicon glyphicon-comment"></span>Comment</a>
								<a href="#share"><span class="glyphicon glyphicon-share-alt"></span>Share</a>
						</div>
					</div>
<!--third post end -->	
				</div>
<!--left side bar -->
				<div class="col-sm-2 col-sm-pull-8 leftSideBar">
					<div class="left-wrapper">
						<div class="profile-shortcut">
							<a href="#userPage"><img src="img/avatar.png" alt="avatar" width="20" height="20"/> User Name
								<a class="edit-icon" href="#editProfile"><span class="glyphicon glyphicon-edit"></span></a>
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
<!--right side bar -->
				<div class="col-sm-2 rightSideBar">

					<div class="usePage-friend-list">
<!-- Friend list end-->
						<div class="friend-item">
							<a href="#userPage"><img src="img/avatar.png" alt="avatar" width="24" height="24"/><span>User D</span></a>
							<span class="online-icon fa fa-circle"></span></a>
						</div>

						<div class="friend-item">
							<a href="#userPage"><img src="img/avatar-1.jpg" alt="avatar" width="24" height="24"/><span>User A</span></a>
							<span class="online-icon fa fa-circle"></span></a>
						</div>

						<div class="friend-item">
							<a href="#userPage"><img src="img/avatar-2.jpeg" alt="avatar" width="24" height="24"/><span>User B</span></a>
							<span class="online-icon fa fa-circle"></span></a>
						</div>

						<div class="friend-item">
							<a href="#userPage"><img src="img/avatar-3.jpeg" alt="avatar" width="24" height="24"/> <span>User C</span></a>
							<span class="online-icon fa fa-circle"></span></a>
						</div>
<!-- Friend list end-->
						<div class="rightSideBar-footer">
	    	           		<button type="submit" onclick="myFunction()">
	    	           			 <i class="glyphicon glyphicon-search"></i>
	    	           		</button><input type="text" onkeyup="myFunction()" placeholder="Search"><button>
	    	           			 <i class="glyphicon glyphicon-cog"></i>
	    	           		</button>
						</div>

					</div>
				</div>
<!--right side bar end -->
			</div>
		</div>


</body>
</html>