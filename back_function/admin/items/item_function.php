<?php 
include_once("item_class.php");

$items = new item();

if(isset($_POST["new_item_name"]) && isset($_POST["cat_id"]) && isset($_POST["new_item_code"]) && isset($_POST["new_type"]))
{
    $items->add_new_item($_POST["new_item_name"],$_POST["cat_id"],$_POST["new_item_code"],$_POST["new_type"]);
}
else if(isset($_POST["load_existing_categories"]))
{
    $items->load_existing_categories();
}
else if(isset($_POST["load_items"]))
{
    $items->load_items();
}
else if(isset($_POST["drop_items_id"]))
{
    $items->drop_item($_POST["drop_items_id"]);
}
else if(isset($_POST["change_item_load"]))
{
    $items->change_item_load($_POST["change_item_load"]);
}
else if(isset($_POST["load_empties"]))
{
    $items->load_empties($_POST["load_empties"]);
}
else if(isset($_POST["change_data"]) && isset($_POST["change_item_id"]) && isset($_POST["reorder_level"]) && isset($_POST["bulk_cost"]) && isset($_POST["remake_level"]) && isset($_POST["bulk_whole_price"]))
{
    $items->change_data($_POST["change_data"],$_POST["change_item_id"],$_POST["reorder_level"],$_POST["bulk_cost"],$_POST["remake_level"],$_POST["bulk_whole_price"]);
}
else if(isset($_POST["load_columns"]))
{
    $items->load_coulmn_list();
}
else if(isset($_POST["load_columns_data"]))
{
    $items->load_columns_data($_POST["load_columns_data"]);
}
else if(isset($_POST["column_name"]) && isset($_POST["discount_value"]) && isset($_POST["discount_change_id"]))
{
    $items->change_discount($_POST["column_name"],$_POST["discount_value"],$_POST["discount_change_id"]);
}
?>