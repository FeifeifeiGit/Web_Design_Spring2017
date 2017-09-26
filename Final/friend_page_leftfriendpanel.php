<?php
    $sql_friend_friends = "SELECT * FROM FriendsList JOIN Users on FriendsList.Friend_Id = Users.User_Id WHERE FriendsList.User_Id = '$friend_id'";
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
        <?php if($currentId!=$friendId) { ?>
        <div class='thumbnail'>
            <a href="friend_page.php?userId=<?php echo $friendId ;?>"><img src='<?php echo $image; ?>' class='friend_friends' id="friend_friends"/></a>
        </div>
        <?php
            ;
        }
        ?>
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
