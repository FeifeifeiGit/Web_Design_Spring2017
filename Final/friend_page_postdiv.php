<?php
        $sql_post = "SELECT * FROM Post WHERE User_Id='$friend_id' ORDER BY Post_Id DESC";
        $result_post=mysqli_query($conn, $sql_post);
        while ($row_post = mysqli_fetch_assoc($result_post)) {
            $image_post = $row_post['Photo_Path'];
            $comment_post = $row_post['Content'];
            $time_post = $row_post['Post_Time'];
            $comment_post = $row_post['Content'];
            $id_post = $row_post['Post_Id']; ?>


    <div class="panel panel-default">
        <div class="panel-heading">
            <a href="#"><img src="<?php echo $profile_photo; ?>" width="30px" height="30px" /></a> &nbsp&nbsp
            <b><?php echo $display_name; ?>`s Moments</b>
            <span style="float:right"><?php echo $time_post; ?></span></div>
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

            <br />
            <hr />

            <!--"Comment" div-->
            <div class="comment_div">
<div class="comment_area">
<?php
$sql_comment = "SELECT * FROM Comments JOIN Users on Comments.User_Id = Users.User_Id
WHERE Post_Id='$id_post' ORDER BY Comment_Id DESC";
$result_comment = mysqli_query($conn, $sql_comment);
while ($row_comment = mysqli_fetch_array($result_comment)) {

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
