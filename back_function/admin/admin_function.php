<?php 
include_once("admin_class.php");

$admin = new admin_class();

if(isset($_POST["user_name"]) && isset($_POST["passowrd"]))
{
    $admin->check_admin_credentials($_POST["user_name"],$_POST["passowrd"]);
}

?>