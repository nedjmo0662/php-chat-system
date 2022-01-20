<?php

class Database 
{
    private $con;

    function __construct() 
    {
        $this->con = $this->connect();
    }

    //connect to db;
    private function connect() {

        $string = 'mysql:host='.DBHOST.';' .'dbname='.DBNAME.';';
        try{
            
            $connection = new PDO($string,DBUSER,DBPASS);
            return $connection;
        }
        catch(PDOException $e) {
            echo 'error' .$e->getmessage();
            die;
        }
        return false;
    }
    //write into data base
    public function write($query,$data_array = [])
    {

            $con = $this->connect();
            $statement = $con->prepare($query);

            $check = $statement->execute($data_array);
    
            if($check) {
                return true;
            }
    
                return false;
    }
    // read from data base
    public function read($query,$data_array = [])
    {
        $con = $this->connect();
        $statement = $con->prepare($query);
        $check = $statement->execute($data_array);

        if($check) {
            $result = $statement->fetchAll(PDO::FETCH_OBJ);
            if(is_array($result) && count($result) > 0)
            {
                return $result;
            }
            // return false;
            return false;

        }

            return false;
    }
    
    public function get_user($userid)
    {
        $con = $this->connect();
        $sql = "SELECT * from users WHERE  userid = :userid LIMIT";
        $arr['userid'] = $userid;
        $statement = $con->prepare($sql);
        $check = $statement->execute($arr);

        if($check) {
            $result = $statement->fetchAll(PDO::FETCH_OBJ);
            if(is_array($result) && count($result) > 0)
            {
                return $result[0];
            }
            // return false;
            return false;

        }

            return false;
    }

    public function generate_id($max) 
    {
        $rand_count = rand(4,$max);
        $rand = "";
        for($j=0; $j<$rand_count; $j++)
        {
            $r = rand(0,9);
            $rand .= $r;
        }

        return $rand;
    }
}