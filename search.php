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
    <link href="css/theater-base.css" rel="stylesheet">
    <link href="css/theater-search.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?php
    //classes and functions defined here

    //Data access obejects

    //DAO for costume
    class Costume{
        var $costumeid;
        var $pattern;
        var $year;
        var $gender;
        var $season;
        var $description;
        var $location;
        var $size;
        var $material;
        var $type;
        var $memo;
        var $color;
        var $mainphoto;

        public function __construct( array $cfg){
            foreach($cfg as $k=>$v){
                $this->{$k}=$v;
            }
        }
    }


    //select query builder, naive version
    //TODO: add more features to fit for more complex selections
    function select_sql($dict) {
        if ( empty($dict)){
            $sql_string = "select * from costume";
        }
        else{
            $sql_string = "select * from costume where ";
            foreach ($dict as $k => $v) {
                $data_type = gettype($v);
                if ($data_type == "string"){
                    $v = "'{$v}'";
                }
                elseif ($data_type == "integer" or $data_type == "double") {
                    $v = (string) $v;
                }
                $sql_string = "{$sql_string}{$k} = {$v} and ";
            }
            $sql_string = substr($sql_string, 0, -5);
        }
        return $sql_string;
    }

    //thumbnail html render 
    function render_html_for_thumbnail($path, $desc){
        return '<div class="col-md-3">           
                <div class="thumbnail" style="border-style:hidden">
                    <img  class="main" src="'.$path.'" alt="...">
                    <img  class="alt" src="'.substr($path, 0, -4).'-1.jpg"style="display:none">
                </div>
                <p style="font-size:12px;padding-left:15px;padding-top:-20px">'.$desc.'</p>
                </div>';
    }

    function query_for($query){
        $dbconn = pg_connect("host=turing.centre.edu dbname=theaterDB user=visitorDrama password=Costumes4All")
                        or die('Could not connect: ' . pg_last_error());
        $result = pg_query($query) or die('Query failed: ' . pg_last_error());
        return $result;
    }

    function parse_result_for_value($result, $key){
        $answer = array();
        while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
            $answer[] = $line[$key];
        }    
        return $answer;    
    }

    function parse_for_filter($big_type){
        $answer = array();
        $size_query = "select distinct size from costume where type in (select distinct value from filter where type='".$big_type."')";
        $size_result = query_for($size_query);
        $size_option = parse_result_for_value($size_result, 'size');
        $answer['size'] = $size_option; 
        $other_options = array("pattern", "season", $big_type, "color", "material");
        foreach ($other_options as $option) {
            $option_query = "select value from filter where type = '".$option."'";
            $option_result = query_for($option_query);
            $options = parse_result_for_value($option_result, 'value');
            $answer[$option] = $options;    
        }
        return $answer;
    }
    ?>
</head>

<body>


    <?php
    //default form values to be NULL
    $pattern = $big_type = $year = $gender = $season = $size = $material = $type = $color = NULL;

    //filter dict
    $dict = array();

    //for post method, update all variables
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (! empty($_POST["pattern"])) {
            $pattern = $_POST["pattern"];
            $dict["pattern"] = $pattern; 
        }
        if (! empty($_POST["year"])) {
            $year = (int)$_POST["year"];
            $dict["year"] = $year; 
        }
        //index
        if (! empty($_POST["gender"])) {
            $gender = $_POST["gender"];
            $dict["gender"] = $gender;       
        }
        if (! empty($_POST["season"])) {
            $season = $_POST["season"];
            $dict["season"] = $season; 
        }
        if (! empty($_POST["size"])) {
            $size = $_POST["size"];
            $dict["size"] = $size; 
        }
        if (! empty($_POST["material"])) {
            $material = $_POST["material"];
            $dict["material"] = $material; 
        }
        if (! empty($_POST["type"])) {
            $type = $_POST["type"];
            $dict["type"] = $type; 
        }
        if (! empty($_POST["color"])) {
            $color = $_POST["color"];
            $dict["color"] = $color; 
        }
        //index
        if (! empty($_POST["big_type"])) {
            $big_type = $_POST["big_type"];
            //generate small type
        }
    }


    //get 
    //$query = select_sql($dict);
    $query = "select * from costume";
    $costumes = array();
    $result = query_for($query);
    while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
         $costumes[] = new Costume($line);
    }
    $filter_dict = parse_for_filter($big_type);
    ?>


    <!-- Navigation -->
    <script> 
    $(function(){
      $("#navigation_content").load("template/navigation.html"); 
    });
    </script> 
    <div id="navigation_content"></div>
        <!-- Page Content -->
        <div class="container">
            <br>
            <div class="row" style="padding-left: 30px">
                <div id="filter-panel" class="collapse filter-panel">
                    <div class="panel panel-default" style="border-style: hidden">
                        <div class="panel-body">
                            <form class="form-inline" role="form" action="search.php" method="post">
                                <div class="form-group">
                                    <input type="number" min="1" max="10000" name="minyear" class="form-control" size="8" placeholder="FROM">
                                    <input type="number" min="1" max="10000" name="maxyear" class="form-control" placeholder="TO">
                                </div>
                                <!-- form group [rows] -->
                                <div class="form-group">
                                    <div class="form-control">
                                        <dl class="dropdown">
                                            <dt>
                                                <a href="#">
                                                    <span class="hida">Pattern</span>
                                                    <p class="multiSel"></p>
                                                </a>
                                            </dt>
                                            <dd>
                                                <div class="mutliSelect">
                                                    <ul>
                                                        <?php
                                                        foreach ($filter_dict['pattern'] as $option) {
                                                            echo '<li><input type="checkbox" name="pattern[]" value="'.$option.'" />'.$option.'</li>';
                                                        } 
                                                        ?>
                                                    </ul>
                                                </div>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-control">
                                        <dl class="dropdown">
                                            <dt>
                                                <a href="#">
                                                    <span class="hida">Season</span>
                                                    <p class="multiSel"></p>
                                                </a>
                                            </dt>
                                            <dd>
                                                <div class="mutliSelect">
                                                    <ul>
                                                        <?php
                                                        foreach ($filter_dict['season'] as $option) {
                                                            echo '<li><input type="checkbox" name="season[]" value="'.$option.'" />'.$option.'</li>';
                                                        } 
                                                        ?>
                                                    </ul>
                                                </div>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-control">
                                        <dl class="dropdown">
                                            <dt>
                                                <a href="#">
                                                    <span class="hida">Type</span>
                                                    <p class="multiSel"></p>
                                                </a>
                                            </dt>
                                            <dd>
                                                <div class="mutliSelect">
                                                    <ul>
                                                        <?php
                                                        foreach ($filter_dict[$big_type] as $option) {
                                                            echo '<li><input type="checkbox" name="type[]" value="'.$option.'" />'.$option.'</li>';
                                                        } 
                                                        ?>
                                                    </ul>
                                                </div>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-control">
                                        <dl class="dropdown">
                                            <dt>
                                                <a href="#">
                                                    <span class="hida">Color</span>
                                                    <p class="multiSel"></p>
                                                </a>
                                            </dt>
                                            <dd>
                                                <div class="mutliSelect">
                                                    <ul>
                                                        <?php
                                                        foreach ($filter_dict['color'] as $option) {
                                                            echo '<li><input type="checkbox" name="color[]" value="'.$option.'" />'.$option.'</li>';
                                                        } 
                                                        ?>
                                                    </ul>
                                                </div>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-control">
                                        <dl class="dropdown">
                                            <dt>
                                                <a href="#">
                                                    <span class="hida">Size</span>
                                                    <p class="multiSel"></p>
                                                </a>
                                            </dt>
                                            <dd>
                                                <div class="mutliSelect">
                                                    <ul>
                                                        <?php
                                                        foreach ($filter_dict['size'] as $option) {
                                                            echo '<li><input type="checkbox" name="size[]" value="'.$option.'" />'.$option.'</li>';
                                                        } 
                                                        ?>
                                                    </ul>
                                                </div>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-control">
                                        <dl class="dropdown">
                                            <dt>
                                                <a href="#">
                                                    <span class="hida">Material</span>
                                                    <p class="multiSel"></p>
                                                </a>
                                            </dt>
                                            <dd>
                                                <div class="mutliSelect">
                                                    <ul>
                                                        <?php
                                                        foreach ($filter_dict['material'] as $option) {
                                                            echo '<li><input type="checkbox" name="material[]" value="'.$option.'" />'.$option.'</li>';
                                                        } 
                                                        ?>
                                                    </ul>
                                                </div>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                                <input type="text" name="gender" value="<?php echo $_POST['gender'];?>" style="display:none">
                                <input type="text" name="big_type" value="<?php echo $_POST['big_type'];?>" style="display:none">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-default filter-col"> <span class="glyphicon glyphicon-record"></span>Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#filter-panel"> <span class="glyphicon glyphicon-cog"></span> Advanced Search </button>
            </div>
            <!-- filter starts here -->
            <div>
                <!-- filter ends here -->
                <div class="col-lg-12">
                    <h3 class="page-header">Search Results</h3>
                    <?php
                    if (empty($costumes)){
                        echo '<div class="alert alert-warning">
                                <strong>Warning!</strong> Empty result
                            </div>';
                    } 
                    ?>
                </div>

                <!-- render for thumbnails -->
                 <?php
                if (! empty($costumes)){
                    foreach((array)$costumes as $c) {
                        $img_path = "photos/{$c->mainphoto}";
                        $desc = "{$c->gender} {$c->type} {$c->size}<br>{$c->year}";
                       //echo $desc;
                        //$img_path = "http://cache.mrporter.com/images/products/635947/635947_mrp_in_l.jpg";
                        echo render_html_for_thumbnail($img_path, $desc);
                    }
                }   
                ?>

<!--                 <div class="col-lg-12">
                <h2>test results</h2>
                <?php 
                echo "gender: ".$_POST['gender'].'<br>';
                echo "big_type: ".$_POST['big_type'].'<br>';
                echo "minyear: ".$_POST['minyear'].'<br>';
                echo "maxyear: ".$_POST['maxyear'].'<br>';
                $keys = array('numrow','pattern', 'season', 'type', 'color', 'size', 'material');
                foreach ($keys as $key) {
                    echo $key.': ';
                    foreach($_POST[$key] as $check) {
                        echo $check.', ';
                    }
                    echo '<br>';
                }
                echo '<br><h3>filter dict</h3><br>';
                foreach ($filter_dict as $key => $value) {
                    echo $key.": ";
                    foreach ($value as $v) {
                        echo $v.",";
                    }
                    echo "<br>";
                }
                ?>
                </div>-->
            </div>

            <hr>
            <br>
            <br>
            <!-- Footer -->
            <footer>
                <div class="row">
                    <div class="col-lg-12">
                        <p>Copyright &copy; Centre College 2015</p>
                    </div>
                </div>
            </footer>
        </div>
        <!-- /.container -->
        <script src="js/theater.js"></script>

</body>

</html>
