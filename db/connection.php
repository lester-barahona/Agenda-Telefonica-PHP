<?php
class Connection{

    var $con;    
    var $settings;

    function __construct()
    {
        $this->settings=array(
            'host'=>'localhost',
            'user'=>'root',
            'password'=>'',
            'db'=>'db_contacts'
        );    
    }

    function connect(){
        extract($this->settings);
        $this->con=mysqli_connect($host,$user,$password,$db) or die ("Connection Failure");
    }

    function disconnect(){
        mysqli_close($this->con);
    }

    function execute($sql){
        $this->connect();
        $result=mysqli_query($this->con,$sql);
        $error=false;
        if(!$result){
            $error=mysqli_error($this->con);
        }
        $this->disconnect();
        return array('result'=>$result,'error'=>$error);
    }

    function query($sql){
        $result=$this->execute($sql);
        extract($result);
        $rows= array();
        if($result){
            $rows=mysqli_fetch_all($result,MYSQLI_ASSOC);
        }
        return $rows;
    }

}

?>