<?php
session_start();

include "s3.php";
include "db.php";
 //change to $sesson("");

 //$currentId =  $_SESSION["userId"];

$currentId =$_SESSION['userId'];
 //$currentId =1;

$getUserQuery="SELECT * FROM Users WHERE User_Id= '$currentId' ";
$userResult=mysqli_query($conn, $getUserQuery);
$row = mysqli_fetch_assoc($userResult);
//get user infor
$displayName = $row['DisplayName'];
$avatar = "";
if($row['ProfilePhoto']==null){
	$avatar ="https://s3-us-west-2.amazonaws.com/minisocial/img/default.png" ;
}else{
	$avatar = $row['ProfilePhoto'];
}
//if include nav, can access to these variable directly
//$_SESSION['userName'] = $displayName;
//$_SESSION['avatar'] =  $avatar ;
?>
<!DOCTYPE html>
<html>
<head>
	<title>
		user home page
	</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<style>
	.dropdown-menu {
		width:426px;
		padding-left: 10px;
		padding-right: 10px;
		padding-bottom: 10px;
	}
	.request_button{
		margin-top:5px;
	}
</style>
<script>
//add request person friendlist
$(document).on('click', '.add_link', function(e) {
	//keep drop down menu not close
	e.stopPropagation();

	var id=$(this).attr("id");
	$.ajax({
		type: 'GET',
		url: "friend_page-action.php",
		data: 'agreeAdd='+id,
		cache: false,
		success:function(html){
			$("#request"+id).fadeOut('fast');
			//reload friend list in userHome,其他页面的friend list可能也要reload，现在只加上了主页面
			$(".usePage-friend-list").load("userHome.php .usePage-friend-list");
		}

	});
});

//not agree to add，delete request
$(document).on('click', '.delete_link', function(e) {
	//keep drop down menu not close
	e.stopPropagation();

	var id=$(this).attr("id");
	$.ajax({
		type: 'GET',
		url: "friend_page-action.php",
		data: 'deleteRqst='+id,
		cache: false,
		success:function(html){
			$("#request"+id).fadeOut('fast');
		}

	});
});

</script>
<body>
	<!-- Navigation bar-->
	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<span class="nav navbar-brand navbar-left" id="brandname">Find Your Group</span>
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav navbar-left">
					<li ><form class="navbar-form">
						<div class="input-group">
							<input type="text" class="form-control" placeholder="Search">
							<div class="input-group-btn">
								<button type="submit" class="btn btn-default" >
									<i class="glyphicon glyphicon-search"></i>
								</button>
							</div>
						</div>
					</form></li>
				</ul>
				<ul class="nav navbar-nav navbar-left">
					<li id="user-infor">
						<a href="userPage.php?User_Id=<?php echo $currentId ;?>"><img  src="<?php echo $avatar ; ?>" class="avatar img-responsive img-circle" style="display:inline-block;" width="20" height="20" alt="Avatar"/><span style="padding-left:0.7em;"><?php echo $displayName; ?></span></a>
					</li>
					<li><a href="userHome.php">Home</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span></a>
						<div class="dropdown-menu" role="menu">
							<span><b>Friend Request</b></span>
							<hr />
							<div class="request_content">
								<?php
								$sql_request = "SELECT * FROM Request JOIN Users ON Request.Sender_Id = Users.User_Id WHERE Request.Receiver_Id = '$currentId'";
								$result_request = mysqli_query($conn, $sql_request);
								while($row2 = mysqli_fetch_assoc($result_request)){
									$profile_photo = $row2['ProfilePhoto'];
									$first = $row2['FirstName'];
									$last = $row2['LastName'];
									$send_id = $row2['Sender_Id'];?>

									<div class="request row" id="request<?php echo $send_id ;?>">
										<div class="col-lg-6">
											<a class="request-left" href="friend_page.php?userId=<?php echo $send_id ;?>">
												<img src="<?php echo $profile_photo ?>" alt="profile_photo" width="40", height="40">&nbsp
												<span><?php echo $first . " " .$last ?></span>
											</a>
										</div>
										<div class="col-lg-6">
											<div class="request_button">
												<button type="button" class="add_agree btn btn-primary btn-xs"><a class="add_link" href="#" id="<?php echo $send_id ;?>"><b><span style="color:white">Confirm</span></b></a></button>&nbsp&nbsp
												<button type="button" class="deleteRqst btn btn-default btn-xs"><a class="delete_link" href="#" id="<?php echo $send_id ;?>"><b>Delete Request</b></a></button>
											</div>
										</div>
									</div>
									<?php
								}
								?>
							</div>
						</div>
					</li>
					<li ><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>Logout<span class="sr-only">(log out)</span></a></li>
				</ul>
			</div>
		</div>
	</nav>
</body>
</html>
