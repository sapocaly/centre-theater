<?php
require_once('../src/ye_DAL.php');

$d = new DAL();
$patterns = $d->query_for_all_pattern_options();
$types = $d->query_for_all_type_options();
$colors = $d->query_for_all_color_options();
$materials = $d->query_for_all_material_options();

?>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h2 class="sub-header">Add Costume</h2>

    <div class="container">
        <form action="#" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-5">
                    <div class="row">
                        <img id="current_photo" class="thumbnail" src="photos/white.jpg"
                             style="width: 105%;">
                    </div>
                    <div class="row" style="padding-top: -20px">
                        <div class="col-md-2">
                            <img class="thumbnail" src="photos/white.jpg" style="width: 135%;"
                                 data-toggle="modal"
                                 data-target="#md1">
                            <!-- Modal -->
                            <div class="modal fade" id="md1" role="dialog">
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
                            Browse&hellip; <input type="file" id="img1" name="img1">
                        </span>
                        </span>
                                                        <input type="text" id="txt1" class="form-control" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">
                                                        Upload
                                                    </button>
                                                    <button type="button" onclick="reset('#txt1', '#img1')"
                                                            class="btn btn-default" data-dismiss="modal">Close
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <img class="thumbnail" src="photos/white.jpg" style="width: 135%;"
                                 data-toggle="modal"
                                 data-target="#md2">
                            <!-- Modal -->
                            <div class="modal fade" id="md2" role="dialog">
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
                            Browse&hellip; <input type="file" id="img2" name="img1">
                        </span>
                        </span>
                                                        <input type="text" id="txt2" class="form-control" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">
                                                        Upload
                                                    </button>
                                                    <button type="button" onclick="reset('#txt2', '#img2')"
                                                            class="btn btn-default" data-dismiss="modal">Close
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <img class="thumbnail" src="photos/white.jpg" style="width: 135%;"
                                 data-toggle="modal"
                                 data-target="#md3">
                            <!-- Modal -->
                            <div class="modal fade" id="md3" role="dialog">
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
                            Browse&hellip; <input type="file" id="img3" name="img3">
                        </span>
                        </span>
                                                        <input type="text" id="txt3" class="form-control" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">
                                                        Upload
                                                    </button>
                                                    <button type="button" onclick="reset('#txt3', '#img3')"
                                                            class="btn btn-default" data-dismiss="modal">Close
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <img class="thumbnail" src="photos/white.jpg" style="width: 135%;"
                                 data-toggle="modal"
                                 data-target="#md4">
                            <!-- Modal -->
                            <div class="modal fade" id="md4" role="dialog">
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
                            Browse&hellip; <input type="file" id="img4" name="img4">
                        </span>
                        </span>
                                                        <input type="text" id="txt4" class="form-control" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">
                                                        Upload
                                                    </button>
                                                    <button type="button" onclick="reset('#txt4', '#img4')"
                                                            class="btn btn-default" data-dismiss="modal">Close
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <img class="thumbnail" src="photos/white.jpg" style="width: 135%;"
                                 data-toggle="modal"
                                 data-target="#md5">
                            <!-- Modal -->
                            <div class="modal fade" id="md5" role="dialog">
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
                            Browse&hellip; <input type="file" id="img5" name="img5">
                        </span>
                        </span>
                                                        <input type="text" id="txt5" class="form-control" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">
                                                        Upload
                                                    </button>
                                                    <button type="button" onclick="reset('#txt5', '#img5')"
                                                            class="btn btn-default" data-dismiss="modal">Close
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <img class="thumbnail" src="photos/white.jpg" style="width: 135%;"
                                 data-toggle="modal"
                                 data-target="#md6">
                            <!-- Modal -->
                            <div class="modal fade" id="md6" role="dialog">
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
                            Browse&hellip; <input type="file" id="img6" name="img6">
                        </span>
                        </span>
                                                        <input type="text" id="txt6" class="form-control" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">
                                                        Upload
                                                    </button>
                                                    <button type="button" onclick="reset('#txt6', '#img6')"
                                                            class="btn btn-default" data-dismiss="modal">Close
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5" style="padding-left: 10%;font-family: Georgia, Times, Serif;line-height:
                3.2rem;font-size:14px;font-weight: 100">
                    <h2>THIS WILL BE TITLE</h2>
                    <br>
                    <textarea class="form-control" name="description" rows="5" id="description"
                              placeholder="WRITE DESCRIPTION HERE"></textarea>

                    <div class="row" style="padding-top: 30px">
                        <div class="form-group">
                            <label for="size" class="col-md-4 control-label">SIZE</label>

                            <div class="col-md-8">
                                <input type="text" name="size" class="form-control" id="size" placeholder="size">
                            </div>
                        </div>
                    </div>
                    <div class="row" style="padding-top: 10px">
                        <div class="form-group">
                            <label for="pattern" class="col-md-4 control-label">PATTERN</label>

                            <div class="col-md-8">
                                <select class="form-control" name="pattern" id="pattern">
                                    <?php
                                    foreach ($patterns as $pattern){
                                        echo '<option>'.$pattern->value.'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="padding-top: 10px">
                        <div class="form-group">
                            <label for="year" class="col-md-4 control-label">YEAR</label>

                            <div class="col-md-8">
                                <input type="number" name="year" class="form-control" id="year" placeholder="year">
                            </div>
                        </div>
                    </div>
                    <div class="row" style="padding-top: 10px">
                        <div class="form-group">
                            <label for="gender" class="col-md-4 control-label">GENDER</label>

                            <div class="col-md-8">
                                <select class="form-control" name="gender" id="gender">
                                    <option>Female</option>
                                    <option>Male</option>
                                    <option>Unisex</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="padding-top: 10px">
                        <div class="form-group">
                            <label for="location" class="col-md-4 control-label">LOCATION</label>

                            <div class="col-md-8">
                                <input type="text" name="location" class="form-control" id="location"
                                       placeholder="location">
                            </div>
                        </div>
                    </div>
                    <div class="row" style="padding-top: 10px">
                        <div class="form-group">
                            <label for="material" class="col-md-4 control-label">MATERIAL</label>

                            <div class="col-md-8">
                                <select class="form-control" name="material" id="material">
                                    <?php
                                    foreach ($materials as $material){
                                        echo '<option>'.$material->value.'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="padding-top: 10px">
                        <div class="form-group">
                            <label for="type" class="col-md-4 control-label">TYPE</label>

                            <div class="col-md-8">
                                <select class="form-control" name="type" id="type">
                                    <?php
                                    foreach ($types as $type){
                                        echo '<option>'.$type->value.'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="padding-top: 10px">
                        <div class="form-group">
                            <label for="play" class="col-md-4 control-label">PLAY</label>

                            <div class="col-md-8">
                                <input type="text" name="play" class="form-control" id="play" placeholder="play">
                            </div>
                        </div>
                    </div>
                    <div class="row" style="padding-top: 10px">
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="color-multiselect">COLOR</label>

                            <div class="col-md-4">
                                <select class="form-control" name="color[]" id="color-multiselect" multiple="multiple">
                                    <?php
                                    foreach ($colors as $color){
                                        echo '<option value="'.$color->value.'">'.$color->value.'</option>';
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
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">
                                                        Close
                                                    </button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>

                    <br>
                </div>
                <div class="col-md-1">
                </div>
            </div>
        </form>
    </div>
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
        $(img).replaceWith($(img).clone(true));
        $(txt).val('');
    }
    $(document).ready(function () {
        $('#color-multiselect').multiselect();
    });
</script>