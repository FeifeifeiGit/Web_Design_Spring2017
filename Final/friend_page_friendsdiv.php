<?php
$sql_friend_friends = "SELECT * FROM FriendsList JOIN Users on FriendsList.Friend_Id = Users.User_Id WHERE FriendsList.User_Id = '$friend_id'";
$result_friend_friends = mysqli_query($conn, $sql_friend_friends);
while ($row = mysqli_fetch_assoc($result_friend_friends)) {
$image = $row['ProfilePhoto'];
$friend_name = $row['DisplayName'];
$friend_first = $row['FirstName'];
$friend_last = $row['LastName'];
$description = $row['Description'];
$friendId=$row['User_Id'];
if($currentId != $friendId){

?>
    <div class='col-md-4 item'>
        <div class="panel panel-default">
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
                <a href="#"> <span class="glyphicon glyphicon-chevron">Follow</span></a>
            </div>

        </div>

    </div>
    <?php
  }
}
  ?>
