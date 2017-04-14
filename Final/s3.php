<?php
require 'aws/vendor/autoload.php';

use Aws\S3\S3Client ;
use Aws\S3\Exception\S3Exception;


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
