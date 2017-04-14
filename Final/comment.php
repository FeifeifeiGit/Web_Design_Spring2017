<?php
include "db.php";
$id_post = $_GET['User_Id'];
$sql_comment = "SELECT * FROM Comments JOIN Users on Comments.User_Id = Users.User_Id
WHERE Post_Id='$id_post' ORDER BY Comment_Id DESC";
$result_comment = mysqli_query($conn, $sql_comment);
while ($row_comment = mysqli_fetch_array($result_comment)) {

echo "<p>";
if ($row_comment['Content'] != '') {
    echo "<a href='#'><img src=" . $row_comment['ProfilePhoto'] . " width='30px' height='30px' /></a>" . " " . $row_comment['DisplayName']. " : ";
    echo $row_comment['Content'] . "<br />";
}
echo "</p>";
} ?>
