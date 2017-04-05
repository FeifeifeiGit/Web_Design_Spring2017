<!DOCTYPE html>
<html>

<head>
	<title>Friend Page</title>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<link href="http://cdn.phpoll.com/css/animate.css" rel="stylesheet">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/3/w3.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<link rel="icon" href="img/logo.png" type="image/x-icon">
	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"/>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"/>-->
</head>
<style>
	.cover {
		background-image: url("img/cover.jpg");
		background-color: red;
		height: 360px;
		width: 900px;
		margin: auto;
		top: -20px;
		position: relative;
	}

	.cover_button {
		margin-top: 300px;
		margin-left: 130px;
		margin-bottom: 20px;
	}

	#friend_status:hover .dropdown-menu {
		display: block;
	}

	#follow_status:hover .dropdown-menu {
		display: block;
	}

	#more_options:hover .dropdown-menu {
		display: block;
	}

	.dropdown-menu {
		display: none;
		position: absolute;
		background-color: #f9f9f9;
		min-width: 100px;
		box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
		z-index: 1;
	}


	.nav.navbar-nav.navbar-right li a {
		font-weight: bold;
		color: #e62e00;
	}

	.profile_photo {
		width: 150px;
		height: 150px;
		margin-left: 20px;
		bottom: -380px;
		position: absolute;
		z-index: 1;
		border: solid 5px white;
	}

	h1 {
		color: white;
		bottom: -350px;
		position: absolute;
		margin-left: 50px;
		z-index: 1;
	}

	.container {
		width: 930px;
		margin: auto;
	}

	.panel>.panel-heading {
		color: #e62e00;
	}



	.affix {
		top: 0;
		width: 280px;
	}

	.comment{
		width:100%;
	}

	.comment_div{
		color: black;
	}

	#about, #friends, #photos{
		display: none;
	}
</style>
<script type="text/javascript">
	$(document).ready(function(){
		$("#about_link").click(function(){
			$("#about").show();
			$("#home").hide();
			$("#friends").hide();
			$("#photos").hide();
		});
		$("#home_link").click(function(){
			$("#home").show();
			$("#about").hide();
			$("#friends").hide();
			$("#photos").hide();
		});
		$("#friend_link").click(function(){
			$("#friends").show();
			$("#about").hide();
			$("#home").hide();
			$("#photos").hide();
		});
		$("#photo_link").click(function(){
			$("#photos").show();
			$("#about").hide();
			$("#home").hide();
			$("#friends").hide();
		});

		$('form').submit(function () {
			var comment = $.trim($('#comment').val());
			if (comment  === '') {
			//alert('Text-field is empty.');
			$("#comment").attr("placeholder", "Please Enter Something...").placeholder();
			return false;
			}
		});

		$("#comment").blur(function(){
    	$("#comment").attr("placeholder", "Enter your comment").placeholder();
		});

		$("form input").keypress(function(event) {
    if (event.which == 13) {
        event.preventDefault();
        $("form").submit();
    }
	 });

		$( "#comment_link" ).click(function() {
			//e.preventDefault();
			$( "#comment" ).focus();
			return false;
		});

	})

</script>
<body>
<?php
    session_start();
    ob_start();
    include 'db.php';
    $sql = 'select * from comments';
    $result = mysqli_query($link, $sql);
    $num_rows = mysqli_num_rows($result);

?>

	<!------- Nav Bar------->
	<div>
		<nav class="navbar navbar-default">
			<div id="cover_menu" class="container-fluid">
				<ul class="nav navbar-nav navbar-right">
					<li class="active"><a href="#">Home</a></li>
					<li><a href="#">About</a></li>
					<li><a href="#">Friends</a></li>
					<li><a href="#">Photos</a></li>
					<li><a href="#"><span>More &nbsp<i class="fa fa-sort-desc" aria-hidden="true"></i></span></a></li>
				</ul>
			</div>
		</nav>
	</div>

	<!------- Cover ------->
	<div class="cover">
		<div class="row">
			<div class="col-lg-6">
				<div class="row">
					<div class="col-lg-4">
						<img class="profile_photo" src="img/profile_photo.png" />
					</div>
					<div class="profile_name col-lg-8">
						<h1>Scarlett Johansson</h1>
					</div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="cover_button">
					<div class="btn-group">
						<button type="button" id="friend_status" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><span>Connected &nbsp<i class="fa fa-sort-desc" aria-hidden="true"></i></span>
								<ul class="dropdown-menu">
									<li><a href="#">Close Friends</a></li>
									<li><a href="#">Unfriend</a></li>
								</ul>
							</button>
						<button type="button" id="follow_status" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><span>Following &nbsp<i class="fa fa-sort-desc" aria-hidden="true"></i></span>
								<ul class="dropdown-menu">
									<li><a href="#">Unfollowed</a></li>
									<li><a href="#">F2</a></li>
								</ul>
							</button>
						<button type="button" id="more_options" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><span><i class="fa fa-bars" aria-hidden="true"></i></span>
								<ul class="dropdown-menu">
									<li><a href="#">Report</a></li>
									<li><a href="#">Block</a></li>
								</ul>
							</button>
					</div>
				</div>
			</div>
		</div>
		<div class="cover_menu">
			<nav class="navbar navbar-default">
				<div id="cover_menu" class="container-fluid">
					<ul class="nav navbar-nav navbar-right">
						<li class="active"><a href="#" id="home_link">Home</a></li>
						<li><a href="#" id="about_link">About</a></li>
						<li><a href="#" id="friend_link">Friends</a></li>
						<li><a href="#" id="photo_link">Photos</a></li>
						<li><a href="#"><span>More &nbsp<i class="fa fa-sort-desc" aria-hidden="true"></i></span></a></li>
					</ul>
				</div>
			</nav>
		</div>
	</div>

	<div class="container-fluid headwrap">
		<div class="container">
			<br><br>
			<div id="home">
				<div class="row">
					<div class="col-lg-4">
						<div class="left_menu" data-spy="affix" data-offset-top="10">
							<div class="panel panel-default">
								<div class="panel-heading"><b>Photos</b></div>
								<div class="panel-body">
									<div class="photos">

									</div>
								</div>
								<div class="panel-footer">
									<a href="#"> <span class="glyphicon glyphicon-chevron-left"></span></a>
									<a href="#"> <span class="glyphicon glyphicon-chevron-right"></span></a>
								</div>
							</div>
							<div class="panel panel-default" data-spy="affix" data-offset-top="10">
								<div class="panel-heading"><b>Friends</b></div>
								<div class="panel-body">
									<div class="friends">

									</div>
								</div>
								<div class="panel-footer">
									<a href="#"> <span class="glyphicon glyphicon-chevron-left"></span></a>
									<a href="#"> <span class="glyphicon glyphicon-chevron-right"></span></a>
								</div>
							</div>
						</div>

					</div>

					<!-- middle friend zone-->
					<div class="col-lg-8">
						<!--friend1-->
						<div class="panel panel-default">
							<div class="panel-heading"><b>Leave a comment</b></div>
							<div class="panel-body">
								<textarea class="mood" rows="5" style="width:100%;border:none" placeholder="TYPE YOUR MOOD HERE"></textarea>
							</div>
							<div class="panel-footer"><a href="#">Post <span class="glyphicon glyphicon-check"></span></a></div>
						</div>
						<div class="panel panel-default">
							<div class="panel-heading">
								<a href="#"><img src="image/friend1.png" width="30px" height="30px" /></a>
								&nbsp&nbsp<b>Joey`s Moments</b></div>
							<div class="panel-body">
								<p>Had a blast! Happy Halloween Y'll! It's freaking awesome to be yourself! This is our anniversary! It was her who pulled me out of whatever that was a year ago! I love her!!! My 凝姐！</p>
								<img class="img-responsive center-block" src="image/friend1_photo.png" width="500px" height="550px" />
							</div>
							<div class="panel-footer">
								<a href="#"> <span class="glyphicon glyphicon-thumbs-up"></span>&nbsp Like</a>&nbsp
								<a href="#" id="comment_link"> <span class="glyphicon glyphicon glyphicon-share-alt"></span>&nbsp Comment</a>&nbsp
								<a href="#"> <span class="glyphicon glyphicon-share"></span>&nbsp Share</a>

								<br /><hr />
								<div class="commnet_div">
								<?php
                                    while ($row = mysqli_fetch_array($result)) {
                                        echo "<p>";
                                        echo $row["message"] . "<br />";
                                        echo "</p>";
                                    }
                                ?>
								<form method="post">
								<input type="text" name="comment" class="comment" id="comment" placeholder="Enter you comment"/>

								<?php

                                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                        $message = $_POST['comment'];
                                        $sql_insert = "insert into comments (message) values ('$message');";
                                        $result = mysqli_query($link, $sql_insert);
                                        header("location:".$_SERVER['PHP_SELF']);
                                        exit;
                                    }
                                    mysqli_close($link);

                                    ob_end_flush();
                                ?>
								</form>
							</div>
							</div>
						</div>



						<div class="panel panel-default">
							<div class="panel-heading">
								<a href="#"><img src="image/friend2.png" width="30px" height="30px" /></a>
								&nbsp&nbsp<b>Rebecca`s Moments</b></div>
							<div class="panel-body">
								<p>Like this movie a lot! Any volunteer to the movie with me again!</p>

								<!--embed video from youtube-->
								<div class="embed-responsive embed-responsive-16by9">
									<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/OrWjjOOYxhI"></iframe>
								</div>
							</div>
							<div class="panel-footer">
								<a href="#"> <span class="glyphicon glyphicon-thumbs-up"></span>&nbsp Like</a>&nbsp
								<a href="#"> <span class="glyphicon glyphicon glyphicon-share-alt"></span>&nbsp Comment</a>&nbsp
								<a href="#"> <span class="glyphicon glyphicon-share"></span>&nbsp Share</a>
							</div>
						</div>
					</div>

				</div>
			</div>
			<div id="about">
				<div class="panel panel-default">
					<div class="panel-heading"><b>About</b></div>
					<div class="panel-body">
						<div class="about">

						</div>
					</div>
					<div class="panel-footer">
						<a href="#"> <span class="glyphicon glyphicon-chevron-left"></span></a>
						<a href="#"> <span class="glyphicon glyphicon-chevron-right"></span></a>
					</div>
				</div>
			</div>
			<div id="friends">

				<div class="panel panel-default">
					<div class="panel-heading"><b>Friends</b></div>
					<div class="panel-body">
						<div class="about">

						</div>
					</div>
					<div class="panel-footer">
						<a href="#"> <span class="glyphicon glyphicon-chevron-left"></span></a>
						<a href="#"> <span class="glyphicon glyphicon-chevron-right"></span></a>
					</div>
				</div>
			</div>
			<div id="photos">

				<div class="panel panel-default">
					<div class="panel-heading"><b>Photos</b></div>
					<div class="panel-body">
						<div class="photos">

						</div>
					</div>
					<div class="panel-footer">
						<a href="#"> <span class="glyphicon glyphicon-chevron-left"></span></a>
						<a href="#"> <span class="glyphicon glyphicon-chevron-right"></span></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

</html>
