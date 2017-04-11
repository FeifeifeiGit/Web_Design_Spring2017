<?php
include "db.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            //if(!empty($_POST['comment']) ){
                                        $message = $_POST['comment'];
                                        $id= $_POST['postId'];
                                        
                                        $sql_insert = "insert into Comments (Content,User_Id,Post_Id) values ('$message',2,'$id');";
                                        //ob_start();
                                        $result = mysqli_query($conn, $sql_insert);
                                        if($result==false){
                                            echo "error upload comments<br>";
                                         }
                                        else{
                                        header("location: friend_page.php");
                                        exit;
                                        }
                                   // }
                             }

?>