<?php
require 'template/vendor/autoload.php';

use template\S3\S3Client ;
use template\S3\Exception\S3Exception;


try{
    $client = S3Client::factory(array(
        'profile' => 'project',
        'version' => '2006-03-01',
        'region' => 'us-west-2',
        'scheme' => 'http'
        
    ));
    } catch(Exception $e) {
     exit($e->getMessage());
} 

//S3 bucket name
$bucket = 'minisocial';

?>