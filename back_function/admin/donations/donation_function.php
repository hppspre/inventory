<?php include_once("donation_class.php");

$donation= new donation();

if(isset($_POST["load_items"]))
{
    $donation->load_items();
}
else if(isset($_POST["customer_name"]) && isset($_POST["customer_address"]) && isset($_POST["phone_number"]))
{
    $donation->save_new_customer($_POST["customer_name"],$_POST["customer_address"],$_POST["phone_number"]); 
}
else if(isset($_POST["edit_customer_name"]) && isset($_POST["edit_customer_address"]) && isset($_POST["edit_phone_number"]) && isset($_POST["customer_id"]))
{
    $donation->edit_customer($_POST["edit_customer_name"],$_POST["edit_customer_address"],$_POST["edit_phone_number"],$_POST["customer_id"]); 
}
else if(isset($_POST["load_customers"]))
{
    $donation->load_customers(); 
}
else if(isset($_POST["donation_info"]) && isset($_POST["donate_for"]) && isset($_POST["final_cost"]))
{
    $donation->donate_saver($_POST["donation_info"],$_POST["donate_for"],$_POST["final_cost"]); 
}
else if(isset($_POST["load_donation"]))
{
    $donation->load_donation();
}  
else if(isset($_POST["drop_donation_id"]))
{
    $donation->drop_donation($_POST["drop_donation_id"]); 
} 
else if(isset($_POST["load_a_donation"]))
{
    $donation->load_a_donation($_POST["load_a_donation"]); 
} 
else if(isset($_POST["load_new_donation"]))
{
    $donation->load_new_donation($_POST["load_new_donation"]); 
} 
else if(isset($_POST["donate_completetion_id"]))
{
    $donation->donation_complete($_POST["donate_completetion_id"]); 
} 
?>