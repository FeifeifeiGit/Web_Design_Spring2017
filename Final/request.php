<?php
  include "db.php";
  $currentId = $_GET['userId'];
  $sql_request = "SELECT * FROM Request JOIN Users ON Request.Sender_Id = Users.User_Id WHERE Request.Receiver_Id = '$currentId'";
  $result_request = mysqli_query($conn, $sql_request);
  while($row = mysqli_fetch_assoc($result_request)){
    $profile_photo = $row['ProfilePhoto'];
    $first = $row['FirstName'];
    $last = $row['LastName'];
    $send_id = $row['Sender_Id'];?>

<div class="request row">
  <div class="col-lg-6">
    <a class="request-left" href="friend_page.php?userId=<?php echo $send_id ;?>">
      <img src="<?php echo $profile_photo ?>" alt="profile_photo" width="40", height="40">&nbsp
      <span><?php echo $first . " " .$last ?></span>
    </a>
  </div>
  <div class="col-lg-6">
    <div class="request_button">
      <button type="button" class="agreeAdd btn btn-primary btn-xs"><a class="add_link" id="<?php echo $send_id ;?>" href="#"><b><span style="color:white">Confirm</span></b></a></button>&nbsp&nbsp
      <button type="button" class="deleteRqst btn btn-default btn-xs"><a class="delete_link" href="friend_page-action.php?deleteRqst=<?php echo $send_id ;?>"><b>Delete Request</b></a></button>
    </div>
  </div>
</div>
<?php
    }
 ?>
