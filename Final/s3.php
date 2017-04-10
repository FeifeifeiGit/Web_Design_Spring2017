<?php
require 'aws/vendor/autoload.php';

use Aws\S3\S3Client ;
use Aws\S3\Exception\S3Exception;


try{
    $client = S3Client::factory(array(
        'profile' => 'project',
        'version' => '2006-03-01',
        'region' => 'us-west-2',
        /*
        'credentials' =>array (
        'key' => 'AKIAIGK33EOOYWITJCQA',
        'secret' => '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',
    )
    */
        
    ));
    } catch(Exception $e) {
     exit($e->getMessage());
} 

//S3 bucket name
$bucket = 'minisocial';

?>