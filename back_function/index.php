<?php session_start();

class data_base_connection{

    public $connection="";

    function build_a_connection()
    {
        try
        {
            $this->connection=new pdo("mysql:host=localhost;dbname=wintry_process;charset=utf8","root","");
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }
    function close_connection()
    {
        try
        {
            $this->connection=NULL;
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }
    function __construct()
    {
        date_default_timezone_set("Asia/Colombo"); //set sri lankan time Zone
        $this->build_a_connection();
    }

}

?>