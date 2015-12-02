<!doctype html>
<html class="no-js" lang="en">
<head>
    <!-- Theme Made By www.w3schools.com - No Copyright -->
    <title>Centre Theater</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link href="css/theater-base.css" rel="stylesheet">
</head>
<body>
<?php
require_once('src/ye_DAL.php');
$id = $_GET['id'];

$d = new DAL();
$cos = $d->query_for_costume_by_id($id);
$photos = $d->query_for_photos_by_id($id);
?>
<script>
    $(function () {
        $("#navigation_content").load("template/navigation.html");
    });
</script>
<div id="navigation_content"></div>

<br>
<br>
<br>

<div class="container">
    <div class="row">
        <div class="col-md-1">
        </div>
        <div class="col-md-5">
            <div class="row">
                <img id="current_photo" class="thumbnail" src="photos/<?php echo $photos[0]->filename; ?>" style="width: 105%;border-style: hidden">
            </div>
            <div class="row" style="padding-top: -20px">
                <?php
                    foreach ($photos as $photo){
                        echo '<div class="col-md-2">
                    <img class="thumbnail" src="photos/'.$photo->filename.'" style="width: 135%;border-style: hidden">
                </div>';
                    }
                ?>
            </div>
        </div>
        <div class="col-md-5">
            <div
                style="padding-left: 20%;font-family: Georgia, Times, Serif;line-height: 3.2rem;font-size:14px;font-weight: 100">
                <h2 style="text-transform: uppercase;"><?php
                        echo $cos->gender.'\'s '.$cos->material.' '.$cos->type;
                    ?>
                </h2>
                <p>
                    <?php  echo $cos->description; ?>
                </p>
                <br>
                <div class="row">
                    <div class="col-md-4">SIZE:</div><div class="col-md-8"><?php  echo $cos->size; ?></div>
                </div>
                <hr style="BORDER-TOP: #cccccc 1px solid;margin: 0em">
                <div class="row">
                    <div class="col-md-4">PATTERN:</div><div class="col-md-8"><?php  echo $cos->pattern; ?></div>
                </div>
                <hr style="BORDER-TOP: #cccccc 1px solid;margin: 0em">
                <div class="row">
                    <div class="col-md-4">YEAR:</div><div class="col-md-8"><?php  echo $cos->year; ?></div>
                </div>
                <hr style="BORDER-TOP: #cccccc 1px solid;margin: 0em">
                <div class="row">
                    <div class="col-md-4">GENDER:</div><div class="col-md-8"><?php  echo $cos->gender; ?></div>
                </div>
                <hr style="BORDER-TOP: #cccccc 1px solid;margin: 0em">
                <div class="row">
                    <div class="col-md-4">LOCATION:</div><div class="col-md-8"><?php  echo $cos->location; ?></div>
                </div>
                <hr style="BORDER-TOP: #cccccc 1px solid;margin: 0em">
                <div class="row">
                    <div class="col-md-4">MATERIAL:</div><div class="col-md-8"><?php  echo $cos->material; ?></div>
                </div>
                <hr style="BORDER-TOP: #cccccc 1px solid;margin: 0em">
                <div class="row">
                    <div class="col-md-4">TYPE:</div><div class="col-md-8"><?php  echo $cos->type; ?></div>
                </div>
                <hr style="BORDER-TOP: #cccccc 1px solid;margin: 0em">
                <div class="row">
                    <div class="col-md-4">COLOR:</div><div class="col-md-8"><?php  echo $cos->color; ?></div>
                </div>
                <hr style="BORDER-TOP: #cccccc 1px solid;margin: 0em">
                <div class="row">
                    <div class="col-md-4">PLAY:</div><div class="col-md-8"><?php  echo $cos->play; ?></div>
                </div>
                <hr style="BORDER-TOP: #cccccc 1px solid;margin: 0em">
                <div class="row">
                    <div class="col-md-4">MEMO:</div><div class="col-md-8"><?php  echo $cos->memo; ?></div>
                </div>
                <hr style="BORDER-TOP: #cccccc 1px solid;margin: 0em">
                <div class="row">
                    <div class="col-md-10"></div><div class="col-md-2"><button type="button" class="btn btn-primary btn-sm " style="border-radius: 0;background-color: black">Edit</button></div>
                </div>
            </div>
        </div>
        <div class="col-md-1">

        </div>
    </div>
</div>
<script src="js/costume.js"></script>
</body>
</html>
