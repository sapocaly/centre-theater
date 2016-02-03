<!doctype html>
<!--Author: Ye.Sheng,Boting Li, Jacob A. Winkler,John Scelzi -->
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
    <link rel="stylesheet" href="css/bootstrap-multiselect.css" type="text/css"/>
    <script type="text/javascript" src="js/bootstrap-multiselect.js"></script>
    <link href="css/theater-admin.css" rel="stylesheet">
    <style>
        .modal-dialog {
            position: absolute;
            left: 30%;
        / / this same situation is with height - example height : 500 px;
            top: 50%;
            margin-top: -250px;
        }
    </style>
</head>
<body>
<script>
    $(function () {
        $("#navigation_content").load("template/navigation.php");
    });
</script>
<div id="navigation_content"></div>
<?php
require_once('src/DAL.php');
$id = $_GET['id'];

$d = new DAL();
$cos = $d->query_for_costume_by_id($id);
$photos = $d->query_for_photos_by_id($id);
$photo_paths = array();
foreach ($photos as $photo) {
    $photo_paths[] = $photo->filename;
}
for ($i = 1; $i <= 5; $i++) {
    $photo_paths[] = 'white.jpg';
}

$patterns = $d->query_for_all_pattern_options();
$types = $d->query_for_all_type_options();
$colors = $d->query_for_all_color_options();
$materials = $d->query_for_all_material_options();



?>
<br>
<br>
<br>


<div class="container">
    <form action="editItem.php" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-5">
                <div class="row">
                    <img id="current_photo" class="thumbnail" src="photos/<?php echo $photos[0]->filename; ?>"
                         style="width: 105%;border-style: hidden">
                </div>
                <div class="row" style="padding-top: -20px">
                    <?php
                    for ($i = 0; $i <= 5; $i++) {
                        $c = $i + 1;
                        $modal = '';
                        if ($photo_paths[$i] != 'white.jpg'){
                            $modal = '<div class="modal fade" id="md'.$c.'" role="dialog">
                        <div class="modal-dialog" style="top: 50%;">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">WARNING</h4>
                                </div>
                                <div class="modal-body">
                                    <p>Do you really want to delete this photo?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" onclick="location.href = "" class="btn btn-default" data-dismiss="modal">Yes</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>

                        </div>
                    </div>';
                        }
                        else{
                            $modal = '<div class="modal fade" id="md'.$c.'" role="dialog">
                            <div class="modal-dialog" style="top: 50%;">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">UPLOAD PHOTO</h4>
                                    </div>

                                    <div class="modal-footer">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="input-group">
                        <span class="input-group-btn">
                        <span class="btn btn-primary btn-file">
                            Browse&hellip; <input type="file" id="img'.$c.'" name="img'.$c.'">
                        </span>
                        </span>
                                                    <input type="text" id="txt'.$c.'" class="form-control" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">
                                                    Upload
                                                </button>
                                                <button type="button" onclick="reset(\'#txt'.$c.'\', \'#img'.$c.'\')"
                                                        class="btn btn-default" data-dismiss="modal">Close
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>';
                        }

                        echo '<div class="col-md-2">
                        <img class="thumbnail" src="photos/'.$photo_paths[$i].'"
                             style="width: 135%"
                             data-toggle="modal"
                             data-target="#md'.$c.'">
                        <!-- Modal -->
                        '.$modal.'
                    </div>';
                    }
                    ?>

                </div>
            </div>
            <div class="col-md-5" style="padding-left: 10%;font-family: Georgia, Times, Serif;line-height:
                3.2rem;font-size:14px;font-weight: 100">
                <h2 style="text-transform: uppercase;"><?php
                    echo $cos->gender.'\'s '.$cos->material.' '.$cos->type;
                    ?>
                </h2>
                    <textarea class="form-control" name="description" rows="5" id="description"
                              placeholder="WRITE DESCRIPTION HERE"><?php  echo $cos->description; ?></textarea>

                <div class="row" style="padding-top: 30px">
                    <div class="form-group">
                        <div class="col-md-4">SIZE</div>
                        <div class="col-md-8">
                            <input type="text" name="size" class="form-control" id="size" value="<?php  echo $cos->size; ?>">
                        </div>
                    </div>
                </div>
                <div class="row" style="padding-top: 10px">
                    <div class="form-group">
                        <div class="col-md-4">PATTERN</div>

                        <div class="col-md-8">
                            <select class="form-control" name="pattern" id="pattern">
                                <?php
                                    foreach ($patterns as $pattern){
                                        if ($pattern->value != $cos->pattern){
                                            echo '<option>'.$pattern->value.'</option>';
                                        }
                                        else{
                                            echo '<option selected="selected">'.$pattern->value.'</option>';
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row" style="padding-top: 10px">
                    <div class="form-group">
                        <div class="col-md-4">YEAR</div>

                        <div class="col-md-8">
                            <input type="number" name="year" class="form-control" id="year" placeholder="year" value="<?php  echo $cos->year; ?>">
                        </div>
                    </div>
                </div>
                <div class="row" style="padding-top: 10px">
                    <div class="form-group">
                        <div class="col-md-4">GENDER</div>

                        <div class="col-md-8">
                            <select class="form-control" name="gender" id="gender">
                                <?php
                                    $genders = array('Female', 'Male', 'Unisex');
                                    foreach ($genders as $gender){
                                        if ($gender != $cos->gender){
                                            echo '<option>'.$gender.'</option>';
                                        }
                                        else{
                                            echo '<option selected="selected">'.$gender.'</option>';
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row" style="padding-top: 10px">
                    <div class="form-group">
                        <div class="col-md-4">LOCATION</div>

                        <div class="col-md-8">
                            <input type="text" name="location" class="form-control" id="location"
                                   placeholder="location" value="<?php  echo $cos->location; ?>">
                        </div>
                    </div>
                </div>
                <div class="row" style="padding-top: 10px">
                    <div class="form-group">
                        <div class="col-md-4">MATERIAL</div>

                        <div class="col-md-8">
                            <select class="form-control" name="material" id="material">
                                <?php
                                foreach ($materials as $material){
                                    if ($material->value != $cos->material){
                                        echo '<option>'.$material->value.'</option>';
                                    }
                                    else{
                                        echo '<option selected="selected">'.$material->value.'</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row" style="padding-top: 10px">
                    <div class="form-group">
                        <div class="col-md-4">TYPE</div>

                        <div class="col-md-8">
                            <select class="form-control" name="type" id="type">
                                <?php
                                foreach ($types as $type){
                                    if ($type->value != $cos->type){
                                        echo '<option>'.$type->value.'</option>';
                                    }
                                    else{
                                        echo '<option selected="selected">'.$type->value.'</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row" style="padding-top: 10px">
                    <div class="form-group">
                        <div class="col-md-4">PLAY</div>

                        <div class="col-md-8">
                            <input type="text" name="play" class="form-control" id="play" placeholder="play" value="<?php  echo $cos->play; ?>">
                        </div>
                    </div>
                </div>
                <div class="row" style="padding-top: 10px">
                    <div class="form-group">
                        <div class="col-md-4">COLOR</div>
                        <div class="col-md-4">
                            <select class="form-control" name="color[]" id="color-multiselect" multiple="multiple">
                                <?php
                                    $color_str = $cos->color;
                                    foreach ($colors as $color){
                                        if (strpos($color_str,$color->value) !== false){
                                            echo '<option value="'.$color->value.'" selected="selected">'.$color->value.'</option>';
                                        }
                                        else{
                                            echo '<option value="'.$color->value.'">'.$color->value.'</option>';
                                        }
                                    }
                                ?>

                            </select>

                        </div>
                        <div class="col-md-4">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-primary btn-md" data-toggle="modal"
                                        data-target="#myModal">
                                    SUBMIT
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="myModal" role="dialog">
                                    <div class="modal-dialog" style="top: 50%;">

                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close"
                                                        data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">WARNING</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>Do you really want to add this costume?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-default">UPLOAD
                                                </button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close
                                                </button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="text" name="id" value="<?php echo $_GET['id']; ?>" style="display:none">
                <br>
            </div>
            <div class="col-md-1">
            </div>
        </div>
    </form>
</div>
<script>
    $(document).on('change', '.btn-file :file', function () {
        var input = $(this),
            numFiles = input.get(0).files ? input.get(0).files.length : 1,
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [numFiles, label]);
    });

    $(document).ready(function () {
        $('.btn-file :file').on('fileselect', function (event, numFiles, label) {

            var input = $(this).parents('.input-group').find(':text'),
                log = numFiles > 1 ? numFiles + ' files selected' : label;

            if (input.length) {
                input.val(log);
            } else {
                if (log) alert(log);
            }

        });
    });
    function reset(txt, img) {
        window.alert('ss');
        $(img).replaceWith($(img).clone(true));
        $(txt).val('');
    }
    $(document).ready(function () {
        $('#color-multiselect').multiselect();
    });
</script>
</body>
</html>
