<?php

session_start();
if ($_SESSION['usergroup'] == "") {
    header('Location: noauth.html');
}

?>
<!DOCTYPE html>
<!--Author: Ye.Sheng, Yuchen Liu, Jacob A. Winkler,John Scelzi -->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="">
    <title>Centre Theater Amdin</title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link href="css/theater-base.css" rel="stylesheet">
    <link href="css/theater-admin.css" rel="stylesheet">
    <script type="text/javascript" src="js/bootstrap-multiselect.js"></script>
    <link rel="stylesheet" href="css/bootstrap-multiselect.css" type="text/css"/>
    <?php
    $section = 'overview';
    if (!empty($_GET['section'])) {
        $section = $_GET['section'];
    }


    function select_section($section, $current_section)
    {
        if ($section == $current_section) {
            echo 'class="active"';
        }
    }

    function new_select_section($section, $current_section)
    {
        if ($section == $current_section) {
            return 'class="active"';
        }
    }

    function render_user()
    {
        echo '  <script>
                    $(function () {
                        $("#list_user").load("template/list_user.php");
                    });
                </script>
                <div id="list_user"></div>';
    }

    function render_costume()
    {
        echo '  <script>
                    $(function () {
                        $("#list_costume").load("template/list_costume.php");
                    });
                </script>
                <div id="list_costume"></div>';
    }


    function render_schema()
    {
        echo '  <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                    <h2 class="sub-header">Manage Schema</h2>
                    <p>manage schema here</p>
                </div>';
    }

    function render_addcos()
    {
        echo '  <script>
                    $(function () {
                        $("#add_costume").load("template/add_costume.php");
                    });
                </script>
                <div id="add_costume"></div>';
    }

    function render_adduser()
    {
        echo '  <script>
                    $(function () {
                        $("#add_user").load("template/add_user.php");
                    });
                </script>
                <div id="add_user"></div>';
    }


    ?>
</head>

<body>
<?php
$script = '';
if ($_GET["result"] == 'success') {
    $script = '<script>
    window.alert("Upload Success");
</script>';
} elseif ($_GET["result"] == 'fail') {
    $script = '<script>
    window.alert("Upload Fail");
</script>';
}
echo $script;
?>
<?php
if (!$_GET['msg'] == '') {
    echo '
    <script>
        window.alert("' . $_GET['msg'] . '");
    </script>
    ';
}
?>
<script>
    $(function () {
        $("#navigation_content").load("template/navigation.php");
    });
</script>
<div id="navigation_content"></div>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">

            <ul class="nav nav-sidebar">
                <li <?php select_section($section, "costume"); ?>><a href="admin.php?section=costume">Costumes</a></li>
                <li <?php select_section($section, "addcos"); ?>><a href="admin.php?section=addcos">Add Costume</a></li>
            </ul>
            <?php
            if ($_SESSION['usergroup'] == "admin") {
                echo '            <ul class="nav nav-sidebar">
                <li ' . new_select_section($section, "user") . '><a href="admin.php?section=user">Users</a></li>
                <li ' . new_select_section($section, "adduser") . '><a href="admin.php?section=adduser">Add Users</a></li>
            </ul>';
            }
            ?>

        </div>
        <!-- content -->
        <?php $func = 'render_' . $section;
        $func(); ?>
    </div>

</div>
<!-- -->

</body>

</html>
