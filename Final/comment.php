<?php
include "db.php";
$id_post = $_GET['Post_Id'];
$currentId = $_GET['User_Id'];
$sql_comment = "SELECT * FROM Comments JOIN Users on Comments.User_Id = Users.User_Id
WHERE Post_Id='$id_post' ORDER BY Comment_Id DESC";
$result_comment = mysqli_query($conn, $sql_comment);
while ($row_comment = mysqli_fetch_array($result_comment)) {
$post_user_id = $row_comment['User_Id'];
echo "<p>";
if ($row_comment['Content'] != '') {
if ($row_comment['Content'] != '') {
  if($post_user_id == $currentId){
    echo "<a href='userPage.php'><img src=" . $row_comment['ProfilePhoto'] . " width='30px' height='30px' /></a>" . " " . $row_comment['DisplayName']. " : ";

  }else{
    echo "<a href='friend_page.php?userId=$post_user_id'><img src=" . $row_comment['ProfilePhoto'] . " width='30px' height='30px' /></a>" . " " . $row_comment['DisplayName']. " : ";
  }
  echo $row_comment['Content'] . "<br />";
}
echo "</p>";
} ?>
