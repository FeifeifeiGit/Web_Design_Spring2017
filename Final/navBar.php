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
	          			<li ><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>Logout<span class="sr-only">(log out)</span></a></li>
		       		</ul>
		       	</div>	
			</div>	
		</nav>
</body>
</html>