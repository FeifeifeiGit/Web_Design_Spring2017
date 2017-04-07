<!DOCTYPE html>
<html>
<?php include "userHome/navBar.php";?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>my photo</title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    
    <script src="https://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.js"></script>
    <title>my photo</title>

    <style>
        body{
            background-image: url("img/background5.jpg");
            /*background-repeat: no-repeat;*/
            background-attachment: fixed;
        }

        .container{
            background-color: white;
            padding: 40px;
        }
        
        #photonav {
            font-family: Papyrus;
        }
        
        .grid {
            margin-top: 40px;
        }
        
        .thumbnail:hover .image {
            opacity: 0.8;
        }

        #addnew:hover {
            color: black;
        }
        
       
        .container{
            margin-top: 150px;
        }
    </style>
</head>
<?php include "db.php"; ?>




<body>



    <main>

        <div class="container">
            <ul class="nav nav-tabs" id="photonav">
                <li class="active"><a data-toggle="tab" href="#photowall">Photo Wall</a></li>
                <li><a data-toggle="tab" href="#like">My Like</a></li>
                <li class="pull-right"><button class="btn btn-danger" data-toggle="modal" data-target="#addphoto" id="addnew">add new</button></li>
            </ul>

        <form method="post" action="photo-action.php" enctype="multipart/form-data">
            <div class="modal fade text-center" id="addphoto" tabindex="-1" aria-labelledby="addphotoLabel" area-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                       
                            <div class="modal-header">
                                <h4 class="modal-title" id="addphotoLabel">add new photo</h4>
                            </div>
                            <div class="modal-body">

                                <div class="form-group">
                                    <div class="col-sm-8">
                                        <input type="file" name="uploadimage" size="50" id="uploadimage" />
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <input type="submit" class="btn btn-primary"/>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                       
                    </div>
                </div>
            </div>
        </form>

            <div class="tab-content">
                <div id="photowall" class="tab-pane fade in  active">
                    <div class="modal fade text-center" id="myModel" tabindex="-1" aria-labelledby="myModelLabel" area-hidden="true">
                        <div class="modal-dialog modal-lg" style="display: inline-block; width: auto;">
                            <div class="modal-content">

                                <img src="" class="showPic" width=700px>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                                </div>
                            </div>
                        </div>



                    </div>


                    <div class="row">
                        <div class="grid">
                            
                                <?php
                                    $sql="SELECT image FROM post";
                                    $result=mysqli_query($conn, $sql);
                                    
                                    while($row = mysqli_fetch_assoc($result)){
                                        $image = $row['image'];
                                ?>
                                    <div class='col-xs-offset-0 col-xs-12 col-sm-offset-0 col-sm-6 col-md-4 col-lg-3 col-lg-offset-0 item'>
                                        <div class='thumbnail'>
                                             <a data-toggle="modal" data-target="#myModel"><img src='<?php echo $image; ?>' class='image getSrc'/></a>
                                        </div>
                                    </div>

                                <?php
                                    }
                                ?>
                                

                        </div>
                    </div>
                </div>

                <div id="like" class="tab-pane fade">
                    <h3>seems you haven't choose any liked photo!</h3>
                </div>
            </div>
        </div>

    </main>

    <footer class="text-center">
        <a class="up-arrow" href="#" title="TO TOP"> <span class="glyphicon glyphicon-chevron-up"></span></a><br> <br>
        <p>&copy;Web Design Final</p>
    </footer>

    <script type="text/javascript">
        $(function() {
            $('.thumbnail img').load(function() {
                $('.grid').masonry({
                    itemSelector: '.item',
                    layoutMode: 'fitRows'
                });
            });
        });
        $(function() {
            $('.grid').masonry({
                // options
                itemSelector: '.item',
                layoutMode: 'fitRows'

            });

        });
    </script>

    <script>
    $('.getSrc').click(function(){
        var src = $(this).attr('src'); 
        $('.showPic').attr('src', src);
    });
    </script>
</body>

</html>