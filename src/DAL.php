<?php

/**
 * Created by PhpStorm.
 * User: Sapocaly
 * Date: 11/26/15
 * Time: 6:14 PM
 */

// Include DAL
require_once(dirname(dirname(__FILE__)) . '/conf/config.php');

class DAL
{

    public function __construct()
    {
    }

    private function dbconnect()
    {
        //$dbconn = pg_connect("host=" . DB_HOST . " dbname=" . DB_DB . " user=" . DB_USER . " password=" . DB_PASSWORD)
        //or die('<br>Could not connect: ' . pg_last_error());
        $dbconn = pg_connect("host=turing.centre.edu dbname=theaterDB user=visitorDrama password=Costumes4All")
        or die('Could not connect: ' . pg_last_error());
        return $dbconn;
    }

    private function query($sql, $class_name)
    {

        $this->dbconnect();
        $res = pg_query($sql) or die('Query failed: ' . pg_last_error());
        if ($res) {
            if (strpos($sql, 'SELECT') === false) {
                return true;
            }
        } else {
            if (strpos($sql, 'SELECT') === false) {
                return false;
            } else {
                return null;
            }
        }

        $results = array();

        while ($row = pg_fetch_array($res, null, PGSQL_ASSOC)) {
            $result = new $class_name($row);
            $results[] = $result;
        }
        return $results;
    }

    public function query_for_all_costume()
    {
        $sql = 'SELECT * FROM costume';
        $results = $this->query($sql, 'Costume');
        return $results;
    }


    //
     public function insert(array $column,$table)
     {
        $schema = '';
        $values = '';
        while($e = current($column))
        {
            $k = key($column);
            if(!(strcmp($k,"costumeid")==0 || strcmp($k,"year")==0))
            {
                $e = "'".$e."'";
            };
            $schema = $schema.$k.',';
            $values = $values.$e.',';
            next($column);
        }

        $schema = rtrim($schema,',');
        $values = rtrim($values,',');
        $sql = "INSERT INTO " . $table ."(".$schema.") VALUES(".$values.");";
        $this -> query($sql);
     }
     public function query_for_all_options()
     {
        $sql = 'SELECT * FROM option';
        $results = $this->query($sql,'Option');
        return $results;
     }


    public function ftc_subquery($text)
    {
        return "SELECT costumeid FROM search_index WHERE document @@ plainto_tsquery('".$text."')ORDER BY ts_rank(document,plainto_tsquery('english','".$text."'))";
    }
    public function full_text_search($text)
    {
        $sql = "SELECT * FROM costume WHERE costumeid in (SELECT costumeid FROM search_index WHERE document @@ plainto_tsquery('".$text."')ORDER BY ts_rank(document,plainto_tsquery('english','".$text."')));";
        $results = $this->query($sql,'Costume');
        return $results;
    }


}

class DALQueryResult
{

    private $_results = array();

    public function __construct()
    {
    }

    public function __set($var, $val)
    {
        $this->_results[$var] = $val;
    }

    public function __get($var)
    {
        if (isset($this->_results[$var])) {
            return $this->_results[$var];
        } else {
            return null;
        }
    }
}

//all data access object class starts here
class Costume
{
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
    var $secphoto;
    var $play;

    public function __construct(array $cfg)
    {
        foreach ($cfg as $k => $v) {
            $this->{$k} = $v;
        }
    }
}

class Option
{
    var $field_name;
    var $value;

    public function __construct(array $cfg)
    {
        foreach ($cfg as $k => $v) {
            $this->{$k} = $v;
        }
    }
}

class Photo
{
    var $costumeid;
    var $filename;
    var $priority;

    public function __construct(array $cfg)
    {
        foreach ($cfg as $k => $v) {
            $this->{$k} = $v;
        }
    }
}

class UserAccount
{
    var $email;
    var $password;
    var $wrongcount;
    var $name;
    var $lastlogin;
    var $usergroup;

    public function __construct(array $cfg)
    {
        foreach ($cfg as $k => $v) {
            $this->{$k} = $v;
        }
    }
}


//$d = new DAL();
//echo "HI";
//echo $d->insert(array("pattern"=>"SQUARE","year"=>"1900","gender"=>"Female","season"=>"Summer","description"=>"Test2","location"=>"1st floor","size"=>"XL","material"=>"wool","type"=>"jacket","memo"=>"hehe","color"=>"white","mainphoto"=>"2_1.jpg","secphoto"=>"2_2.jpg","play"=>"godKnows"),"costume");
//foreach ($d->query_for_all_options() as $k){
//    echo $k->field_name;
//}
//}
/*
foreach($d->full_text_search("tshirt") as $k)
        {

            echo $k->costumeid;
        }


*/
?>
