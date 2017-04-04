<?php
require 'vendor/autoload.php';

use Aws\S3\S3Client ;
use Aws\S3\Exception\S3Exception;


try{
    $client = S3Client::factory(array(
        'credentials' => array(
            'key'    => 'AKIAIWVQZB2VOE5J4LJQ',
            'secret' => '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',
         ),
        'version' => '2006-03-01',
        'region' => 'us-west-2'
    ));
    } catch(Exception $e) {
     exit($e->getMessage());
} 

//S3 bucket name
$bucket = 'minisocial';

?>