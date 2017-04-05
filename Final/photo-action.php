<?php
include "s3.php";
include "db.php";

$imagename="";
$target_dir="postdata/";
$imagename = $target_dir . basename($_FILES["uploadimage"]["name"]);

if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(!empty( basename($_FILES["uploadimage"]["name"]))){
       
        try{
            
            //upload to S3
            $result = $client->putObject(array(
                'Bucket' => $bucket,
                'Key'    => $imagename,
                'Body' => fopen($_FILES['uploadimage']['tmp_name'], 'r+'),
                'options' => [
                        'scheme' => 'http',
                ],

            ));

         } catch (Exception $e) {

            exit($e->getMessage());
        }

        $targetPath="https://s3-us-west-2.amazonaws.com/minisocial/".$imagename;
        $sql="INSERT INTO post (image) VALUES ('$targetPath')";
        $result=mysqli_query($conn, $sql);
        if($result==false){
            echo "error update headshot<br>";
        }
        
    }

    header("Location: photo.php");
    exit; 
}


?>