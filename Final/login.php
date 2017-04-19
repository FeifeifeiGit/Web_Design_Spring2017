<!DOCTYPE html>
<?php
session_start();
if (!isset($_SESSION["message"])){
    $_SESSION["message"] = "Please Login ";
}
    
if (isset($_SESSION["username"])) {
        $usernameHandler = $_SESSION["username"];
} else {
    $usernameHandler = "";
}
?>
<html>
<head>
    <title> Login </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.0.min.js"></script>
    <style>
.colorgraph {
  height: 5px;
  border-top: 0;
  background: #c4e17f;
  border-radius: 5px;
  background-image: -webkit-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
  background-image: -moz-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
  background-image: -o-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
  background-image: linear-gradient(to right, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
}
    </style>
</head>
<body>
    
    
<div class="container">
    <div class="row">
        <div class="hidden-xs col-sm-6 col-md-6" style="padding-top: 20px">
            <div class="well well-sm">
                <h1>Connect with friends and the world around you.</h1>
            </div>
            <div class="well well-lg">
                <p>See photos and updates</p> 
            </div>
            <div class="well well-lg">
                <p>Share what's new</p> 
            </div>
            <div class="well well-lg">
                <p>Find More</p> 
            </div>
        </div>
        
        
        <div class="col-xs-12 col-sm-6 col-md-6">
            <form method="post" role="form" action="login-action.php" enctype="multipart/form-data">
                <h2><?php echo $_SESSION["message"]; ?> <small>Start your social network here.</small></h2>
                <hr class="colorgraph">
                <div class="form-group">
                    <input type="email" name="email" class="form-control input-lg" placeholder="Email Address" value="<?php echo $usernameHandler;?>" required>
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control input-lg" placeholder="Password" required>
                </div>
                <hr class="colorgraph">
                <div class="row">
                    <div class="col-xs-12 col-md-6"><input type="submit" value="Sign In" class="btn btn-success btn-block btn-lg"></div>
                    <div class="col-xs-12 col-md-6"><a href="register.php" class="btn btn-primary btn-block btn-lg">Register</a></div>
                </div>
            </form>
        </div>
    </div>

</div>
</body>
    
</html>