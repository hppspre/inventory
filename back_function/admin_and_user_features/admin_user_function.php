<?php include_once("admin_user_class.php"); 

$admin_user=new admin_user();

if(isset($_POST["items_map_details"]))
{
    $admin_user->get_maping_details();
}
else if(isset($_POST["get_items_list"]))
{
    $admin_user->get_items_list();
}
else if(isset($_POST["get_discount_list"]))
{
    $admin_user->get_discount_list($_POST["get_discount_list"]);
}


?>