<?php include_once("factory_sales_class.php");

$factory_sales=new factory_sales();

if(isset($_POST["customer_details"]))
{
    $factory_sales->add_new_factory_sales_customer($_POST["customer_details"]); 
}
else if(isset($_POST["load_customers"]))
{
    $factory_sales->load_fs_customer($_POST["load_customers"]); 
}
else if(isset($_POST["fs_customer"]))
{
    $factory_sales->drop_fs_customer($_POST["fs_customer"]); 
}
else if(isset($_POST["save_customer_details"]) && isset($_POST["id"]))
{
    $factory_sales->change_customer_details($_POST["save_customer_details"],$_POST["id"]); 
}
else if(isset($_POST["get_factory_sales_details"]))
{
    $factory_sales->get_factory_sales_details($_POST["get_factory_sales_details"]);
}
else if(isset($_POST["load_returned_data"]))
{
    $factory_sales->load_returned_data($_POST["load_returned_data"]);
}
else if(isset($_POST["returned_id"]))
{
    $factory_sales->make_check_returned($_POST["returned_id"]);
}

?>