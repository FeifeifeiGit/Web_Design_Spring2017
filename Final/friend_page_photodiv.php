<?php
        $sql_serchphoto="SELECT * FROM Post WHERE User_Id='$friend_id' ORDER BY Post_Id";
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
