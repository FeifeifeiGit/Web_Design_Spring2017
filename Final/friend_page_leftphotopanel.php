<?php
    $sql_serchphoto="SELECT * FROM Post WHERE User_Id='$friend_id' Order BY Post_Id DESC";
    $result_photo=mysqli_query($conn, $sql_serchphoto);
    $count = 6;
     while ($row = mysqli_fetch_assoc($result_photo)) {
        if ($count > 0) {
          $image = $row['Photo_Path']; ?>
    <div class='col-md-4 item'>
        <div class='thumbnail'>
            <a data-toggle="modal" data-target="#myModel_small"><img src='<?php echo $image; ?>' class='image getSrc_small'id="friend_photo_small"/></a>
        </div>
    </div>
    <?php
        $count--;
         }
    }?>
