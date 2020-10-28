<?php 
include_once("admin_credentials_class.php");

$credentials= new admin_credentials();

if(isset($_POST["user_name"]) && isset($_POST["privious_password"]) && isset($_POST["new_password"]))
{
    $credentials->change_admin_credentials($_POST["user_name"],$_POST["privious_password"],$_POST["new_password"]);

}

?>