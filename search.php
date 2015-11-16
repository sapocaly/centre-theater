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
    <script src="js/jquery.js"></script>
    <script src="js/theater.js"></script>
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
            <div class="thumbnail">
                <div class="caption">
                    <h4>Thumbnail Headline</h4>
                    <p>short thumbnail description</p>
                    <p><a href="" class="label label-danger" rel="tooltip" title="Zoom">Zoom</a>
                    <a href="" class="label label-default" rel="tooltip" title="Download now">Download</a></p>
                </div>
                <img src="'.$path.'" alt="...">
            </div>
      </div>';
}
?>
</head>

<body>
    <?php
//default form values to be NULL
$pattern = $year = $gender = $season = $size = $material = $type = $color = NULL;

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
}

//get 
$query = select_sql($dict);

//$costumes = array();
//$dbconn = pg_connect("host=turing.centre.edu dbname=theaterDB user=visitorDrama password=Costumes4All")
//                or die('Could not connect: ' . pg_last_error());

//1.query
//$result = pg_query($query) or die('Query failed: ' . pg_last_error());
//2.convert to objects
//while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
//    $costumes[] = new Costume($line);
//}
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
                                    <label class="filter-col" style="margin-right:0;" for="pref-perpage">Rows per page:</label>
                                    <select name="numrow" id="pref-perpage" class="form-control">
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option selected="selected" value="10">10</option>
                                        <option value="15">15</option>
                                        <option value="20">20</option>
                                        <option value="30">30</option>
                                        <option value="40">40</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                        <option value="200">200</option>
                                        <option value="300">300</option>
                                        <option value="400">400</option>
                                        <option value="500">500</option>
                                        <option value="1000">1000</option>
                                    </select>
                                </div>
                                <!-- form group [rows] -->
                                <div class="form-group">
                                    <label class="filter-col" style="margin-right:0;" for="pref-perpage"> Filter:</label>
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
                                                        <li>
                                                            <input type="checkbox" name="pattern[]" value="pt1" />pt1</li>
                                                        <li>
                                                            <input type="checkbox" name="pattern[]" value="pt2" />pt2</li>
                                                        <li>
                                                            <input type="checkbox" name="pattern[]" value="pt3" />pt3</li>
                                                        <li>
                                                            <input type="checkbox" name="pattern[]" value="pt4" />pt4</li>
                                                        <li>
                                                            <input type="checkbox" name="pattern[]" value="pt5" />pt5</li>
                                                        <li>
                                                            <input type="checkbox" name="pattern[]" value="pt6" />pt6</li>
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
                                                        <li>
                                                            <input type="checkbox" name="season[]" value="spring" />spring</li>
                                                        <li>
                                                            <input type="checkbox" name="season[]" value="summer" />summer</li>
                                                        <li>
                                                            <input type="checkbox" name="season[]" value="fall" />fall</li>
                                                        <li>
                                                            <input type="checkbox" name="season[]" value="winter" />winter</li>
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
                                                        <li>
                                                            <input type="checkbox" name="type[]" value="typ1" />typ1</li>
                                                        <li>
                                                            <input type="checkbox" name="type[]" value="typ2" />typ2</li>
                                                        <li>
                                                            <input type="checkbox" name="type[]" value="typ3" />typ3</li>
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
                                                        <li>
                                                            <input type="checkbox" name="color[]" value="color1" />color1</li>
                                                        <li>
                                                            <input type="checkbox" name="color[]" value="color2" />color2</li>
                                                        <li>
                                                            <input type="checkbox" name="color[]" value="color3" />color3</li>
                                                        <li>
                                                            <input type="checkbox" name="color[]" value="color4" />color4</li>
                                                        <li>
                                                            <input type="checkbox" name="color[]" value="color5" />color5</li>
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
                                                        <li>
                                                            <input type="checkbox" name="size[]" value="1" />1</li>
                                                        <li>
                                                            <input type="checkbox" name="size[]" value="2" />2</li>
                                                        <li>
                                                            <input type="checkbox" name="size[]" value="3" />3</li>
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
                                                        <li>
                                                            <input type="checkbox" name="material[]" value="250" />2</li>
                                                        <li>
                                                            <input type="checkbox" name="material[]" value="3" />3</li>
                                                        <li>
                                                            <input type="checkbox" name="material[]" value="4" />4</li>
                                                    </ul>
                                                </div>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                                <input type="text" name="gender[]" value="male" style="display:none">
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
            //if (empty($costumes)){
            //    echo '<div class="alert alert-warning">
            //            <strong>Warning!</strong> Indicates a warning that might need attention.
            //        </div>';
            //} 
            ?>
                </div>
                <?php
            //if (! empty($costumes)){
            //    foreach((array)$costumes as $c) {
            //        $img_path = "photos/{$c->mainphoto}";
            //        $desc = "Type:{$c->type} Year:{$c->year} Size:{$c->size}";
            //        echo render_html_for_thumbnail($img_path, $desc);
            //    }
            //}   
            ?>
                    <!-- test code -->
                    <?php 
            echo "<h1>";
            echo $query;
            echo "</h1>";
            $keys = array('pattern', 'season', 'type', 'color', 'size', 'material','gender');
            foreach ($keys as $key) {
                if(!empty($_POST[$key])) {
                    echo $key;
                    echo '<br>';
                    foreach($_POST[$key] as $check) {
                            echo $check; //echoes the value set in the HTML form for each checked checkbox.
                                         //so, if I were to check 1, 3, and 5 it would echo value 1, value 3, value 5.
                                         //in your case, it would echo whatever $row['Report ID'] is equivalent to.
                    }
                    echo '<br>';
                }
            }
            ?>
            </div>
            <hr>
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
</body>

</html>
