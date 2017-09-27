# Find Your Group
_This is a mini social project. You can add friends, edit personal profile, upload image, post your daily life, comment to posts, search users, and check whether friend is online_

__NOTICE:__ This project using remote database (RDS) and AWS S3 for images store. If you want to run in local, you must configure some files.

# Demo
* login, browse posts, view friend's page, photo wall display
![image](https://github.com/FeifeifeiGit/Web_Design_Spring2017/blob/master/Final/img/longin.gif)



* create new post, manage hoome page, edit profile
![image](https://github.com/FeifeifeiGit/Web_Design_Spring2017/blob/master/Final/img/newPost.gif)


## Configure local database and store pictures locally. 

* change __db.php__ file, modify `$servername`, `$username`, `$password` and `$dbname` according to your own database.
* change __controller/photo-action__ file, modify `$target_dir="img/"` to set all pictures stored in __img__ folder. __delete__ following code:

	```php
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
	```


	and __replace it__ with  
	
	```php
	move_uploaded_file($_FILES['uploadimage']['tmp_name'], $imagename);
	```
 	modify`$targetPath` to `$targetPath=$imagename`
* change __controller/profile-action.php__ file, delete the following code: 
  
	```php
	try{
  	 //upload to S3
		$result = $client->putObject(array(
			'Bucket' => $bucket,
			'Key'    => $headshot,
			'Body' => fopen($_FILES['headshot']['tmp_name'], 'r+'),
			));

	} catch (Exception $e) {

	exit($e->getMessage());
	}
	```  
and __uncomment__ the following code block. modify`$targetPath` to `$targetPath=$headshot`. 

  

## Configure RDS and S3  
If you have your own AWS account and want to deploy RDS and S3, you still need to configure some files.  
### configure RDS
* if you want to connect RDS to your phpmyadmin, edit php configuration file __bin/phpMyAdmin/config.inc.php__. Add following code and __your own RDS URL__ in `server(s) configuration` block:

 ```php
$i++;
$cfg['Servers'][$i]['host'] = 'your own RDS URL';
$cfg['Servers'][$i]['port'] = '3306';
$cfg['Servers'][$i]['connect_type'] = 'tcp';
$cfg['Servers'][$i]['extension'] = 'mysql';
$cfg['Servers'][$i]['compress'] = TRUE;
 ```
Restart PHP server after configuration.  
* change __db.php__, modify `$servername`, `$username`, `$password` and `$dbname` according to your own RDS.



### configure S3

* I strongly recommand to configure aws credential file to store your access key instead of hard code.
For crediential file, refer to http://docs.aws.amazon.com/aws-sdk-php/v2/guide/credentials.html#credential-profiles. If you currently do not have aws hidden folder, you can create it in computer's home folder (c:\\ for Windows, Macintosh HD for MAC) yourself. In addition, according to __S3.php__, the access key should be placed under __[project1]__ section in credentials file. 

* On the other hand, if you want to connect to S3 with hard code, you can replace code in __s3.php__ with following code and paste access key in it:

  ```php
	<?php
	require 'aws/vendor/autoload.php';
	use Aws\S3\S3Client ;
	use Aws\S3\Exception\S3Exception;
	try{
    $client = S3Client::factory(array(
        'credentials' => array(
            'key'    => 'your access key ID',
            'secret' => 'your access secret key',
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
  ```   
* In S3, a bucket named __minisocial__ should be created for storing, if you want to create bucket in another name, edit `$bucket` in S3.php file. Besides, According your S3 URL and bucket name, edit `$targetPath` in __controller/profile-action.php, controller/photo-action.php, register-action.php__, and  `"s3path"` in __upload.php__.
* For folder used to stored pictures in AWS S3 bucket, create __/img__ for saving user headshot and __/postdata__ for saving post picture.  
