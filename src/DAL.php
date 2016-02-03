<?php

/**
 * Database access layer
 * Author: Ye Sheng, Yifan Li
 */

//

class DAL
{

    public function __construct(){}

    private function dbconnect()
    {
        //$dbconn = pg_connect("host=" . DB_HOST . " dbname=" . DB_DB . " user=" . DB_USER . " password=" . DB_PASSWORD)
        //or die('<br>Could not connect: ' . pg_last_error());
        $dbconn = pg_connect("host=turing.centre.edu dbname=theaterDB user=visitorDrama password=Costumes4All")
        or die('Could not connect: ' . pg_last_error());
        return $dbconn;
    }
    /**
    *query
    *@param (Srting)$sql: sql command
    *@param (String)&classname: name of data asscess object class
    *@return array of data asscess objects
    */
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
    //@return list of all costumes;
    public function query_for_all_costume()
    {
        $sql = 'SELECT * FROM costume ORDER BY costumeid ASC';
        $results = $this->query($sql, 'Costume');
        return $results;
    }
    public function query_for_costume_by_id($id){
        $sql = 'SELECT * FROM costume where costumeid = '.$id;
        $results = $this->query($sql, 'Costume');
        return $results[0];
    }

    public function query_for_photos_by_id($id){
        $sql = 'SELECT * FROM photo WHERE costumeid='.$id.' ORDER BY priority ASC';
        $results = $this->query($sql, 'Photo');
        return $results;

    }

    public function delete_photos_by_id($id){
        $sql = 'DELETE FROM photo WHERE costumeid='.$id;
        $results = $this->query($sql, 'DALQueryResult');
        return $results;

    }

    public function delete_costume_by_id($id){
        $sql = 'DELETE FROM costume WHERE costumeid='.$id;
        $results = $this->query($sql, 'DALQueryResult');
        return $results;

    }

    public function delete_user_by_email($email){
        $sql = "DELETE FROM useraccount WHERE email='".$email."'";
        $results = $this->query($sql, 'DALQueryResult');
        return $results;

    }

    public function query_for_all_users(){
        $sql = 'SELECT * FROM useraccount';
        $results = $this->query($sql, 'UserAccount');
        return $results;
    }
    public function query_for_all_options()
    {
        $sql = 'SELECT * FROM option';
        $results = $this->query($sql,'Option');
        return $results;
    }
    public function query_for_all_type_options()
    {
        $sql = "SELECT * FROM option WHERE field_name in ('clothing', 'shoes', 'accessories')";
        $results = $this->query($sql,'Option');
        return $results;
    }
    //
    public function query_for_all_pattern_options()
    {
        $sql = "SELECT * FROM option WHERE  field_name = 'pattern'";
        $results = $this->query($sql,'Option');
        return $results;
    }

    public function query_for_all_color_options()
    {
        $sql = "SELECT * FROM option WHERE  field_name = 'color'";
        $results = $this->query($sql,'Option');
        return $results;
    }

    public function query_for_all_material_options()
    {
        $sql = "SELECT * FROM option WHERE  field_name = 'material'";
        $results = $this->query($sql,'Option');
        return $results;
    }
    public function query_for_available_options($option,$subquery)
    {
        $sql = "SELECT DISTINCT ".$option." FROM costume WHERE costumeid IN ".$subquery;
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

            $results[] = current($row);
        }
        return $results;
    }
    //$text:     input from home page
    //$filters:  return value of parse_for_query() in new_search.php
    //return array of Costume objects
    public function query_for_search($text,$filters)
    {
        $strings = array();
        $options = array("pattern", "season", "type",  "size", "material","gender");
        foreach($options as $s)
        {   
            $str = array();
            foreach($filters[$s] as $e)
            {
                if($e!=null)
                {
                    $str[] = "'".$e."'";
                }
            }
            if(!empty($str))
            {
                $strings[] = $s." IN (".implode(",",$str).") ";
            }
        }
        $color = array();
        foreach($filters["color"] as $e)
        {
            if($e!=null)
            {
                $color[] = "color LIKE '%".$e."%' ";
            }
        }
        if(!empty($color))
        {
            $strings[] = "(".implode(" OR ",$color).")";
        }
        if(!empty($filters["minyear"]))
        {
            $strings[] = " year >= ".$filters["minyear"]." ";
        }
        if(!empty($filters["maxyear"]))
        {
            $strings[] = " year <= ".$filters["maxyear"]." ";
        }
        if(!empty($strings))
        {
           $strings = implode(" AND ", $strings); 
           $strings =  " WHERE ".$strings;
        }
        else
        {
            $strings = "";
        }
        if(str_replace(" ","",$text)!="")
        {
            $sql = "SELECT * FROM (SELECT * FROM costume WHERE costumeid in (SELECT costumeid FROM search_index WHERE document @@ plainto_tsquery('".$text."')ORDER BY ts_rank(document,plainto_tsquery('english','".$text."')))) AS R".$strings;
        }
        else
        {
            $sql = "SELECT * FROM costume ".$strings;
        }
        $results = $this->query($sql,'Costume');
        //echo $sql;
        return $results;
    }

    /**
     * Insert Into Database
     *@param (array)$column: array with format ( attribute => value), attributes need to match with the corresponding table
     *@param (String)$table: name of table    
     */
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
        $this -> update_DB_index();
     }
    /**
     *Update table
     *@param (array)$column: array with format ( attribute => value), attributes need to match with the corresponding table
     *@param (String)$table: name of table    
     *@param (String)$pkey: name of primary key for table
     *@param $pkeyvalue: value of the key
     */
     public function update(array $column,$table,$pkey,$pkeyvalue)
     {
        $s = '';
        while($e = current($column))
        {
            $k = key($column);
            if(!(strcmp($k,"costumeid")==0 || strcmp($k,"year")==0))
            {
                $e = "'".$e."'";
            };
            $s = $s.$k.' = '.$e.',';
            next($column);
        }

        $s = rtrim($s,',');
        $sql = "UPDATE " .$table." SET ".$s." WHERE ".$pkey." = ".$pkeyvalue;
        //echo $sql;
        $this -> query($sql);
        $this -> update_DB_index();
     }

     //rebuild search Index
     public function update_DB_index()
     {
        $this -> query("REFRESH MATERIALIZED VIEW search_index;");
     }
    //@param ()
    //@return (String) subquery that select costumeid with full text search accroding to the input text.
    public function fts_subquery($text)
    {
        return "(SELECT costumeid FROM search_index WHERE document @@ plainto_tsquery('".$text."')ORDER BY ts_rank(document,plainto_tsquery('english','".$text."')));";
    }
    //@return (Costume) return array of costume objects by full text search
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
foreach($d->full_text_search("tshirt") as $qk)
        {

            echo $k->costumeid;
        }


*/
//$d -> update(array("pattern" => "houndstooth"),"costume","costumeid",29)
?>
