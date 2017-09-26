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
    <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
    <link href="http://cdn.phpoll.com/css/animate.css" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/3/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> -->

    <link rel="icon" href="img/logo.png" type="image/x-icon">
    <link href="css/userHome.css" rel="stylesheet">
    <script src="css/userHome.js"></script>
    <link href="css/friend_page.css" rel="stylesheet">
    <script src="css/friend_page.js"></script>
</head>
<style>
@media screen and (max-width:768px){
#friend_name {
  bottom: -350px;
  margin-left: -40%;
}

}
@media screen and (max-width:1024px){
#friend_name {
  bottom: -350px;
  margin-left: -40%;
}

}
</style>

<body>
    <?php

    include 'db.php';
    include "navBar.php";
    include "pageFunction.php";
    //include "checkLogin.php";
    ?>
    <div class="container">
        <!-- Cover -->
        <div class="cover">
            <div class="row">
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-lg-4 col-xs-6">
                            <?php

                            $friend_id=$_GET['userId'];
                            $sql_friend="SELECT * FROM Users where User_Id = '$friend_id'";
                            $result_friend=mysqli_query($conn, $sql_friend);
                            $row_friend = mysqli_fetch_assoc($result_friend);
                            $display_name = $row_friend['DisplayName'];
                            $profile_photo = $row_friend['ProfilePhoto'];
                            $birthday = $row_friend['Birthday'];
                            $gender = $row_friend['Gender'];
                            $email = $row_friend['Email'];
                            $description = $row_friend['Description'];
                            $schoolOrwork = $row_friend['SchoolOrWork'];
                            ?>
                            <img class="profile_photo" src="<?php echo $profile_photo; ?>" />
                        </div>
                        <div class="profile_name col-lg-8 col-xs-6">

                            <h1 id='friend_name'><?php echo $display_name; ?></h1>
                        </div>
                    </div>
                </div>

                <div class="cover_button">
                    <div class="btn-group">
                        <?php
                        if(!empty($_SESSION['userId'])){
                            if(requestAlreadySent($friend_id, $currentId)){
                               ?>
                               <button type="button" class="btn btn-default">Request send</button>

                               <?php
                           }
                           else if(isFriend($friend_id, $currentId)){
                            ?>

                            <button type="button" class="btn btn-danger deleteFriend" id="<?php echo $friend_id ?>">Unfriend</button>
                            <?php
                            ;
                        }
                        else {
                            ?>
                            <button type="button" class="btn btn-primary addFriend" id="<?php echo $friend_id ?>">add to friend</button>
                            <?php
                            ;
                        }
                    }
                    ?>

                </div>
            </div>
        </div>

        <div class="cover_menu">
            <nav class="navbar navbar-default">
                <div id="cover_menu" class="container-fluid">
                    <ul class="nav navbar-nav navbar-right" id="active">
                        <li class="active"><a href="#" id="home_link">Timeline</a></li>
                        <li><a href="#" id="about_link">About</a></li>
                        <li><a href="#" class="friend_link">Friends</a></li>
                        <li><a href="#" id="photo_link">Photos</a></li>
                        <li><a href="#"><span>More &nbsp<i class="fa fa-sort-desc" aria-hidden="true"></i></span></a></li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>

    <div class="container-fluid headwrap">
        <div class="mycontainer">
            <br><br>
            <!--"Home" div-->
            <div id="home">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="left_menu" data-spy="affix" data-offset-top="400">

                            <!--Left Photo Panel-->
                            <div class="panel panel-default">
                                <div class="panel-heading"><b>Photos</b></div>
                                <div class="panel-body">
                                    <div class="modal fade text-center" id="myModel_small" tabindex="-1" aria-labelledby="myModelLabel" area-hidden="true">
                                        <div class="modal-dialog modal-lg" style="display: inline-block; width: auto;">
                                            <div class="modal-content">
                                                <img src="" class="showPic_small" width=700px>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="photos">
                                     <?php
                                     include "friend_page_leftphotopanel.php";
                                     ?>
                                 </div>

                             </div>
                             <div class="panel-footer">
                             </div>
                         </div>

                         <!--Left Friend Panel-->
                         <div class="panel panel-default">
                            <div class="panel-heading"><b>Friends<a href="#" class="friend_link"><span style="float:right">More</span></a></b></div>
                            <div class="panel-body">
                                <div class="friends">
                                    <?php
                                    include "friend_page_leftfriendpanel.php";
                                    ?>

                                </div>
                            </div>
                            <div class="panel-footer">

                            </div>
                        </div>
                    </div>

                </div>

                <!-- middle friend zone-->
                <div class="col-lg-7">

                    <?php
                    include "friend_page_postdiv.php"
                    ?>

                </div>
            </div>
        </div>

        <!-- "About" div-->
        <div id="about">
            <div class="panel panel-default">
                <div class="panel-heading"><b>About</b></div>
                <div class="panel-body">
                    <div class="about">
                        <ul class="nav nav-pills nav-stacked col-lg-3">
                            <li class="active"><a href="#tab_a" data-toggle="pill">Overview</a></li>
                            <li><a href="#tab_b" data-toggle="pill">School and Work</a></li>
                            <li><a href="#tab_c" data-toggle="pill">Contant Information</a></li>
                        </ul>

                        <div class="tab-content col-lg-9">
                            <div class="tab-pane active" id="tab_a">
                             <p>
                                <?php echo $description; ?>
                            </p>
                        </div>
                        <div class="tab-pane" id="tab_b">
                            <p><?php echo $schoolOrwork; ?></p>
                        </div>
                        <div class="tab-pane" id="tab_c">
                            <table class="tg" style="undefined;table-layout: fixed; width: 485px">
                                <colgroup>
                                <col style="width: 109.2px">
                                <col style="width: 500px">
                            </colgroup>

                            <tr>
                                <td>Birthday</td>
                                <td>
                                    <?php echo $birthday; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Gender</td>
                                <td>
                                    <?php echo $gender; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>
                                    <?php echo $email; ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-footer">
        </div>
    </div>
</div>



<!--"Friends" div-->
<div id="friends">

  <?php include "friend_page_friendsdiv.php"; ?>
</div>


<!--"Photos" div-->
<div id="photos">
    <div class="panel panel-default">
        <div class="panel-heading"><b>Photos &nbsp
        <?php if(!empty($_SESSION['userId'])){ ?>
        <a href="friendPhoto.php?friendId=<?php echo $friend_id;?>" style="float:right">Photo Wall</a>
        <?php } ?>
        </b></div>
        <div class="panel-body">
            <div class="modal fade text-center" id="myModel" tabindex="-1" aria-labelledby="myModelLabel" area-hidden="true">
                <div class="modal-dialog modal-lg" style="display: inline-block; width: auto;">
                    <div class="modal-content">

                        <img src="" class="showPic" width=700px>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                        </div>
                    </div>
                </div>
            </div>
            <div class="photos">
                <?php
                include "friend_page_photodiv.php";
                ?>
            </div>
        </div>
        <div class="panel-footer">
                            <!--<a href="#"> <span class="glyphicon glyphicon-chevron-left"></span></a>
                            <a href="#"> <span class="glyphicon glyphicon-chevron-right"></span></a>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
