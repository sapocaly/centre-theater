<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    <title>Centre Theater Amdin</title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link href="css/theater-base.css" rel="stylesheet">
    <link href="css/theater-admin.css" rel="stylesheet">
    <?php
    $section = 'overview';
    if (!empty($_GET['section'])){
        $section = $_GET['section'];
    }


    function select_section($section, $current_section){
        if ($section == $current_section) {
            echo 'class="active"';
        }
    }

    function render_user(){
        echo '  <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                    <h2 class="sub-header">Users</h2>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Account</th>
                                    <th>UserGroup</th>
                                    <th>Create Time</th>
                                    <th>Last Login</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>ye.sheng@centre.edu</td>
                                    <td>SUPERUSER</td>
                                    <td>2015-11-11 11:11:11</td>
                                    <td>2015-11-15 15:15:15</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>';
    }

    function render_costume(){
        echo '  <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                    <h2 class="sub-header">Costumes</h2>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Gender</th>
                                    <th>Color</th>
                                    <th>Type</th>
                                    <th>Material</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>2</td>
                                    <td>M</td>
                                    <td>crimson</td>
                                    <td>suits</td>
                                    <td>cotton</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>';
    }
    function render_overview(){
        echo '  <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                    <h2 class="sub-header">Overview</h2>
                </div>';
    }
    function render_schema(){
        echo '  <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                    <h2 class="sub-header">Manage Schema</h2>
                    <p>manage schema here</p>
                </div>';
    }
    function render_addcos(){
        echo '  <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                    <h2 class="sub-header">Add Costume</h2>
                    <p>add costume here</p>
                </div>';
    }
    function render_adduser(){
        echo '  <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                    <h2 class="sub-header">Add User</h2>
                    <p>SUPERUSER can add user here</p>
                </div>';
    }
    function render_batch(){
        echo    '<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                    <h2 class="sub-header">Barch Upload</h2>
                    <p>you can upload text file here</p>
                </div>';
    }
    ?>
</head>

<body>
    <script>
    $(function() {
        $("#navigation_content").load("template/navigation.html");
    });
    </script>
    <div id="navigation_content"></div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3 col-md-2 sidebar">
                <ul class="nav nav-sidebar">
                    <li <?php select_section($section, "overview"); ?>><a href="admin.php?section=overview">Overview <span class="sr-only">(current)</span></a></li>
                    <li <?php select_section($section, "schema"); ?>><a href="admin.php?section=schema">Attributes Schema</a></li>
                </ul>
                <ul class="nav nav-sidebar">
                    <li <?php select_section($section, "costume"); ?>><a href="admin.php?section=costume">Costumes</a></li>
                    <li <?php select_section($section, "addcos"); ?>><a href="admin.php?section=addcos">Add Costume</a></li>
                    <li <?php select_section($section, "batch"); ?>><a href="admin.php?section=batch">Batch Upload</a></li>
                </ul>
                <ul class="nav nav-sidebar">
                    <li <?php select_section($section, "user"); ?>><a href="admin.php?section=user">Users</a></li>
                    <li <?php select_section($section, "adduser"); ?>><a href="admin.php?section=adduser">Add Users</a></li>
                </ul>
            </div>
            <!-- content -->
            <?php $func = 'render_'.$section; $func(); ?>
        </div>
    </div>
    <!-- -->
</body>

</html>
