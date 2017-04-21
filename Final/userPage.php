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
@media screen and (max-width:687px){

 #user_name {
  color: white;
  bottom: -350px;
  position: absolute;
  margin-left: 3%;
  z-index: 1;
}

}
</style>
<body>
    <?php
    include 'db.php';
    include "navBar.php";
    include "pageFunction.php";
    include "checkLogin.php";
    ?>
    <!-- Cover -->
    <div class="container">
    <div class="cover">
        <div class="row">
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-4 col-xs-6">
                        <?php
                        $sql_friend="SELECT * FROM Users where User_Id = '$currentId'";
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

                        <h1 id='user_name'><?php echo $display_name; ?></h1>
                    </div>
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
                    <div class="col-lg-5 col-sm-3">
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
                                        $sql_serchphoto="SELECT * FROM Post WHERE User_Id='$currentId' Order BY Post_Id DESC";
                                        $result_photo=mysqli_query($conn, $sql_serchphoto);
                                        $count = 6;
                                        $count_div = 3;
                                        while ($row = mysqli_fetch_assoc($result_photo)) {
                                            if ($count > 0) {
                                              $image = $row['Photo_Path'];
                                              if($image != ''){
                                                ?>
                                                <div class='col-md-4 item'>
                                                    <div class='thumbnail'>
                                                        <a data-toggle="modal" data-target="#myModel_small"><img src='<?php echo $image; ?>' class='image getSrc_small'id="friend_photo_small"/></a>
                                                        <?php if ($count_div == 1){
                                                          echo "<br />";
                                                          $count_div = 3;
                                                      }?>
                                                  </div>
                                              </div>
                                              <?php
                                              $count--;
                                              $count_div--;
                                          }}
                                      }?>
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
                                    $sql_friend_friends = "SELECT * FROM FriendsList JOIN Users on FriendsList.Friend_Id = Users.User_Id WHERE FriendsList.User_Id = '$currentId'";
                                    $result_friend_friends = mysqli_query($conn, $sql_friend_friends);
                                    $count_friend = 6;
                                    $count_div_friend = 3;
                                    while ($row = mysqli_fetch_assoc($result_friend_friends)) {
                                        if ($count_friend > 0) {
                                            $image = $row['ProfilePhoto'];
                                            $friend_name = $row['DisplayName'];
                                            $friendId=$row['User_Id'];
                                            ?>
                                            <div class='col-md-4 item'>
                                                <div class='thumbnail'>
                                                    <a href="friend_page.php?userId=<?php echo $friendId ;?>"><img src='<?php echo $image; ?>' class='friend_friends' id="friend_friends"/></a>
                                                </div>
                                                <div class="friend_name">
                                                    <p>
                                                        <?php echo $friend_name; ?>
                                                    </p>
                                                </div>
                                                <?php if($count_div_friend == 1){
                                                  echo "<br />";

                                                  $count_div_friend = 3;
                                              } ?>
                                          </div>
                                          <?php
                                          $count_friend--;
                                          $count_div_friend--;
                                      }
                                  }
                                  ?>

                              </div>
                          </div>
                          <div class="panel-footer">

                          </div>
                      </div>
                  </div>

              </div>

              <!-- middle friend zone-->
              <div class="col-lg-7 col-xs-12">

                <?php
                $sql_post = "SELECT * FROM Post WHERE User_Id='$currentId' ORDER BY Post_Id DESC";
                $result_post=mysqli_query($conn, $sql_post);
                while ($row_post = mysqli_fetch_assoc($result_post)) {
                    $image_post = $row_post['Photo_Path'];
                    $comment_post = $row_post['Content'];
                    $time_post = $row_post['Post_Time'];
                    $comment_post = $row_post['Content'];
                    $id_post = $row_post['Post_Id']; ?>


                    <div class="panel panel-default" id="userPost<?php echo $id_post?>">
                      <div class="panel-heading">
                          <a href="#"><img src="<?php echo $profile_photo; ?>" width="30px" height="30px" /></a> &nbsp&nbsp
                          <b><?php echo $display_name; ?>`s Moments</b><span class="post_time_small"><br \ /><?php echo $time_post; ?>
                          <a href="#" class="deletePost" id="<?php echo $id_post; ?>" style="float: right;"><span class="glyphicon glyphicon-trash"></span>&nbsp delete</a></span>
                          <span class="post_time" style="float:right"><?php echo $time_post; ?></span></div>
                            <div class="panel-body">

                                <p>
                                    <?php echo $comment_post; ?>
                                </p>
                                <img class="post_photo img-responsive center-block" src="<?php echo $image_post; ?>" />
                                <!--embed video from youtube-->
                                        <!-- <div class="embed-responsive embed-responsive-16by9">
                                        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/OrWjjOOYxhI"></iframe>
                                    </div> -->
                                </div>
                                <div class="panel-footer">
                                    <a href="#"> <span class="glyphicon glyphicon-thumbs-up"></span>&nbsp Like</a>&nbsp
                                    <a href="#" class="comment_link"> <span class="glyphicon glyphicon glyphicon-share-alt"></span>&nbsp Comment</a>&nbsp
                                    <a href="#"> <span class="glyphicon glyphicon-share"></span>&nbsp Share</a>
                                    <span class="delete_span"><a href="#" class="deletePost" id="<?php echo $id_post; ?>" style="float: right;"><span class="glyphicon glyphicon-trash"></span>&nbsp delete</a></span>
                                    <br />
                                    <hr />

                                    <!--"Comment" div-->
                                    <div class="comment_div" id="comment_div">
                                        <div class="comment_area">
                                            <?php
                                            $sql_comment = "SELECT * FROM Comments JOIN Users on Comments.User_Id = Users.User_Id
                                            WHERE Post_Id='$id_post' ORDER BY Comment_Id DESC";
                                            $result_comment = mysqli_query($conn, $sql_comment);
                                            while ($row_comment = mysqli_fetch_array($result_comment)) {
                                              $post_user_id = $row_comment['User_Id'];
                                              echo "<p>";
                                              if ($row_comment['Content'] != '') {
                                                if($post_user_id == $currentId){
                                                  echo "<a href='userPage.php'><img src=" . $row_comment['ProfilePhoto'] . " width='30px' height='30px' /></a>" . " " . $row_comment['DisplayName']. " : ";

                                              }else{
                                                  echo "<a href='friend_page.php?userId=$post_user_id'><img src=" . $row_comment['ProfilePhoto'] . " width='30px' height='30px' /></a>" . " " . $row_comment['DisplayName']. " : ";
                                                  //echo $row_comment['User_Id'];
                                              }
                                              //echo "<a href='#'><img src=" . $row_comment['ProfilePhoto'] . " width='30px' height='30px' /></a>" . " " . $row_comment['DisplayName']. " : ";
                                              echo $row_comment['Content'] . "<br />";
                                          }
                                          echo "</p>";
                                      } ?>
                                  </div>
                                  <form class="comment_form" id="comment_form" method="post" action="friend_page-action.php?>">
                                    <input type="text" name="comment" class="comment" id="<?php echo $id_post?>" placeholder="Enter your comment" />
                                    <input type="hidden" name="postId" value="<?php echo $id_post?>" />
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php
                } ?>

            </div>
        </div>
    </div>

    <!-- "About" div-->
    <div id="about">
        <div class="panel panel-default">
            <div class="panel-heading"><b>About<a href="profile.php"><span style="float:right">Update</span></a></b></div>
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

    <?php
    $sql_friend_friends = "SELECT * FROM FriendsList JOIN Users on FriendsList.Friend_Id = Users.User_Id WHERE FriendsList.User_Id = '$currentId'";
    $result_friend_friends = mysqli_query($conn, $sql_friend_friends);
    while ($row = mysqli_fetch_assoc($result_friend_friends)) {
        $image = $row['ProfilePhoto'];
        $friend_name = $row['DisplayName'];
        $friend_first = $row['FirstName'];
        $friend_last = $row['LastName'];
        $friendId=$row['User_Id'];
        $description = $row['Description'];?>
        <div class='col-md-4 item'>
            <div class="panel panel-default" id="deleteThisFriend<?php echo $friendId ;?>">
                <div class="panel-heading">
                    <div class="friend_name">
                        <p>
                            <?php echo $friend_first . " " . $friend_last . " (" . $friend_name . ")"; ?>
                        </p>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="about">
                        <div class="row">
                            <div class="col-sm-5">
                             <a href="friend_page.php?userId=<?php echo $friendId ;?>"><img src='<?php echo $image; ?>' class='friend_friends img-circle' id="friend_friends"/></a>
                         </div>
                         <div class="col-sm-7">
                            <p>
                                <?php echo $description; ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <a href="#" class="deleteFriendInUserPage" id="<?php echo $friendId ;?>"> <span class="glyphicon glyphicon-chevron" >Unfollow</span></a>
            </div>

        </div>

    </div>
    <?php
}
?>
</div>


<!--"Photos" div-->
<div id="photos">
    <div class="panel panel-default">
        <div class="panel-heading"><b>Photos &nbsp<a href="photo.php" style="float:right">Photo Wall</a></b></div>
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
                $sql_serchphoto="SELECT * FROM Post WHERE User_Id='$currentId' ORDER BY Post_Id";
                $result_photo=mysqli_query($conn, $sql_serchphoto);
                $count_photos = 6;
                while ($row = mysqli_fetch_assoc($result_photo)) {
                    $image = $row['Photo_Path'];
                    if($image != ''){?>
                    <div class='col-xs-offset-0 col-xs-6 col-sm-offset-0 col-sm-4 col-md-3 col-lg-2 col-lg-offset-0 item'>
                        <div class='thumbnail'>
                            <a data-toggle="modal" data-target="#myModel"><img src='<?php echo $image; ?>' class='image getSrc'id="friend_photo"/></a>
                            <?php if($count_photos == 1){
                              echo "<br />";
                              $count_photos = 6;
                          } ?>
                      </div>
                  </div>
                  <?php
                  $count_photos--;
              }}
              ?>
          </div>
      </div>
      </div>
    </body>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.deletePost').click(function(){
                var id=$(this).attr("id");
                $.ajax({
                    type:"GET",
                    url: "friend_page-action.php",
                    data: 'delete='+id,
                    cache: false,
                    success:function(html){
                        $("#userPost"+id).fadeOut('slow');

                    }
                });

            });
        });

    </script>

    </html>
