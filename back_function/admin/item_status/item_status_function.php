<?php 
include_once("item_status.php");

$items_status = new item_status();

if(isset($_POST["load_items_status"]))
{
    $items_status->load_item_status();
}
else if(isset($_POST["chng_id"]) && isset($_POST["change_cost"]) && isset($_POST["chng_qty"]) && isset($_POST["option_number"]) && isset($_POST["current_qty"]))
{
    $items_status->change_quanity($_POST["chng_id"],$_POST["change_cost"],$_POST["chng_qty"],$_POST["option_number"],$_POST["current_qty"]);
}
else if(isset($_POST["chng_leter_id"]) && isset($_POST["change_leater_cost"]) && isset($_POST["chng_leater_qty"]) && isset($_POST["option_leater_number"]) && isset($_POST["current_leater_qty"]))
{
    $items_status->change_leater_quanity($_POST["chng_leter_id"],$_POST["change_leater_cost"],$_POST["chng_leater_qty"],$_POST["option_leater_number"],$_POST["current_leater_qty"]);
}
?>