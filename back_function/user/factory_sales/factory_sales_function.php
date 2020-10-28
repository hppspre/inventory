<?php include_once("factory_sales_class.php");

$fs = new factory_sales();

if(isset($_POST["factory_sales_customers_load"]))
{
    $fs->load_factory_sales_customers();
}
else if(isset($_POST["load_next_invoice_id"]))
{
    $fs->load_next_invoice_id();
}
else if(isset($_POST["sales_items"]) && isset($_POST["other_sales_data"]) && isset($_POST["returned_obj"]))
{
    $fs->save_factory_sales($_POST["sales_items"],$_POST["other_sales_data"],$_POST["returned_obj"]);
}
else if(isset($_POST["load_privious_invoice"]))
{
    $fs->load_privious_invoice($_POST["load_privious_invoice"]);
}
else if(isset($_POST["returned_data"]) && isset($_POST["invoice_id"]) && isset($_POST["total_returned_price"]))
{
    $fs->save_factory_sales_returned($_POST["returned_data"],$_POST["invoice_id"],$_POST["total_returned_price"]);
}

?>