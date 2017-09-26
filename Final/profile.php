<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edit Profile</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
     <link href="css/userHome.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.js"></script>
    <style>
        body {
            background-color: #edeff2;
        }
        
        .container {
            width: 80%;
            
            padding-bottom: 50px;
            background-color: white;
        }
        
        .div-divider {
            padding-top: 40px;
            margin-bottom: 20px;
            border-bottom: 1px solid lightgray
        }
        
        .form-group .form-error{
            font-family: Monaco;
        }

        .error{
            font-family: Monaco;
        }

        
    </style>

</head>

<body>

<?php 
include "checkLogin.php";
include "navBar.php";
?>
    <main>
        <div class="container">

            <div class="row">
                <form method="post" action="controller/profile-action.php" class="form-horizontal" enctype="multipart/form-data">
                    <div class="col-lg-8 col-lg-offset-2 ">

                        <div class="div-divider col-lg-10 col-lg-offset-1">
                            <div class="panel panel-default">
                                <div class="panel-heading"> <a data-toggle="collapse" href="#collapse1"><b><span class="glyphicon glyphicon-edit"></span> Username:</b> <?php echo $displayName; ?></a></div>
                                <div id="collapse1" class="panel-collapse collapse">
                                    <div class="panel-body">

                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="username"> edit:</label>
                                            <div class="col-sm-8">
                                                <input type="text" pattern="^[a-zA-Z0-9_]*$" name="username" class="form-control" placeholder="new username" data-validation-error-msg="username must only contains alphanumeric" />
                                            </div>
                                            <div class="error col-sm-8 col-sm-offset-2">
                                            <?php 
                                            if(!empty($_SESSION['usernameError'])){
                                                echo $_SESSION['usernameError']; 
                                            }
                                                
                                            ?>
                                               
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						
                        <div class="div-divider col-lg-10 col-lg-offset-1">
                            <div class="panel panel-default">
                                <div class="panel-heading"><a data-toggle="collapse" href="#collapse2"><b><span class="glyphicon glyphicon-edit"></span> Headshot:</b> <img src="<?php echo $avatar; ?>" class="avatar img-responsive"></a></div>
                                <div id="collapse2" class="panel-collapse collapse">
                                    <div class="panel-body">

                                        <div class="form-group">

                                            <div class="col-sm-offset-2">
                                                <input type="file" name="headshot" data-validation="mime" data-validation-allowing="jpg, png, gif" />
                                            </div>
                                            <div class="error col-sm-8 col-sm-offset-2">
                                            <?php
                                            if(!empty($_SESSION['typeError'])){
                                                echo $_SESSION['typeError']; 
                                            }
                                            ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="div-divider col-lg-10 col-lg-offset-1">
                            <div class="panel panel-default">

                                <div class="panel-heading"><a data-toggle="collapse" href="#collapse3"><b><span class="glyphicon glyphicon-edit"></span> Birthday:</b> <?php echo $row['Birthday']; ?></a></div>
                                <div id="collapse3" class="panel-collapse collapse">
                                    <div class="panel-body">

                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="birthday"> edit:</label>
                                            <div class="col-sm-8">
                                                <input id="datefield" type="date" name="birthday" min="1900-01-01" max="2017-04-22" class="form-control" placeholder="yyyy-mm-dd" data-validation="birthdate" />
                                            </div>
                                            <div class="error col-sm-8 col-sm-offset-2">
                                            <?php 
                                            if (!empty($_SESSION['birthdayError'])) {
                                                echo $_SESSION['birthdayError']; 
                                            }
                                            
                                            ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="div-divider col-lg-10 col-lg-offset-1">
                            <div class="panel panel-default">
                                <div class="panel-heading"><a data-toggle="collapse" href="#collapse4"><b><span class="glyphicon glyphicon-edit"></span> Phone Number:</b>  <?php echo $row['PhoneNumber']; ?></a></div>
                                <div id="collapse4" class="panel-collapse collapse">
                                    <div class="panel-body">

                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="phone"> edit:</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="phone" class="form-control" placeholder="xxx-xxx-xxxx" pattern="^\d{3}-\d{3}-\d{4}$" data-validation-error-msg="phone number should be in right format" />
                                            </div>
                                            <div class="error col-sm-8 col-sm-offset-2">

                                            <?php 
                                            if(!empty($_SESSION['phoneError'])){
                                                echo $_SESSION['phoneError']; 
                                            }
                                            ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="div-divider col-lg-10 col-lg-offset-1">
                            <div class="panel panel-default">
                                <div class="panel-heading"> <a data-toggle="collapse" href="#collapse5"><b><span class="glyphicon glyphicon-edit"></span>School/ Company:</b>  <?php echo $row['SchoolOrWork']; ?></a></div>
                                <div id="collapse5" class="panel-collapse collapse">
                                    <div class="panel-body">

                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="workplace"> edit:</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="workplace" class="form-control" placeholder="new workplace" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="div-divider col-lg-10 col-lg-offset-1">
                            <div class="panel panel-default">
                                <div class="panel-heading"><a data-toggle="collapse" href="#collapse6"><b><span class="glyphicon glyphicon-edit"></span> Bio: </b><?php echo $row['Description']; ?></a></div>
                                <div id="collapse6" class="panel-collapse collapse">
                                    <div class="panel-body">

                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="description"> edit: </label>
                                            <div class="col-sm-10">
                                                <textarea type="text" name="description" class="form-control" placeholder="your description"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-8 col-lg-offset-5">
                        <input type="Submit" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script type="text/javascript">
        $.validate({
            modules: 'html5, date, file',

        });

        $("input").rules("remove", "required");
        
    </script>
    <script type="text/javascript">
    //set birthday no later than today
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth() + 1; 
        var yyyy = today.getFullYear();
        if (dd < 10) {
            dd = '0' + dd;
        }
        if (mm < 10) {
            mm = '0' + mm ;
        }

        today = yyyy + '-' + mm + '-' + dd;
        document.getElementById("datefield").setAttribute("max", today);
    </script>

    <?php
    unset($_SESSION["usernameError"]);
    unset($_SESSION["birthdayError"]);
    unset($_SESSION["phoneError"]);
    unset($_SESSION["typeError"]);
    ?>

</body>

</html>