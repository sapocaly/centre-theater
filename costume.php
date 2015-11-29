<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Centre College Theatre</title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link href="css/theater-base.css" rel="stylesheet">
    <link href="css/theater-search.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<?php
$img_path = $_GET['name'];
?>

<!-- Navigation -->
<br>
<br>
<script>
    $(function () {
        $("#navigation_content").load("template/navigation.html");
    });
</script>
<div id="navigation_content"></div>
<!-- Page Content -->
<div class="container">
    <div class="col-md-5" style="padding-left: 10%">
        <p class="lead">Costume Name</p>

        <div class="list-group" style="font-size: 18px">
            <li>
                Pattern:
            </li>
            <li>
                Year:
            </li>
            <li>
                Gender:
            </li>
            <li>
                Size:
            </li>
            <li>
                Color:
            </li>
            <li>
                Description:
            </li>
        </div>
    </div>
    <div class="col-md-7">
        <div class="row carousel-holder">
            <div class="col-md-9">
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" style="">
                    <ol class="carousel-indicators">
                        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="item active">
                            <img class="slide-image" src="<?php echo $img_path; ?>" alt="">
                        </div>
                        <div class="item">
                            <img class="slide-image" src="<?php echo substr($img_path, 0, -4) . '-1.jpg'; ?>" alt="">
                        </div>
                    </div>
                    <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <br>
        <br>
        <br>
        <hr>
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Centre College 2015</p>
                </div>
            </div>
        </footer>
    </div>
</div>
<!-- /.container -->
<!-- jQuery -->
<script src="js/jquery.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
</body>

</html>
