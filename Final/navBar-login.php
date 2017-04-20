<!DOCTYPE html>
<html>
<head>
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
				<ul class="nav navbar-nav navbar-left nav-search">
					<li ><form method="post" role="form" class="navbar-form" action="search-action.php">
						<div class="input-group">
							<input type="text" class="form-control" placeholder="Search" name="searchInput">
							<div class="input-group-btn">
								<button type="submit" class="btn btn-default" >
									<i class="glyphicon glyphicon-search"></i>
								</button>
							</div>
						</div>
					</form></li>
				</ul>
				
			</div>
		</div>
	</nav>
</body>
</html>
