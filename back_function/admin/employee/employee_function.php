<?php include_once("employee_class.php");

$emp = new employee();

if(isset($_POST["new_employee"]))
{
    $emp->add_a_new_empoyee($_POST["new_employee"]);
}
else if(isset($_POST["get_emp_designation"]))
{
    $data=$emp->get_emp_designation();
    echo json_encode($data,true);
}
else if(isset($_POST["designation"]) && isset($_POST["sales_designation"]) && isset($_POST["dept_list"]))
{
    $data=$emp->save_designation($_POST["designation"],$_POST["sales_designation"],$_POST["dept_list"]);
}
else if(isset($_POST["designation_id"]) && isset($_POST["change_dept"]))
{
    $emp->change_designation($_POST["designation_id"],$_POST["change_dept"]); 
}
else if(isset($_POST["get_commition"]))
{
    $emp->get_commition();
}
else if(isset($_POST["chng_commission"]) && isset($_POST["commission_id"]))
{
    $emp->change_commssion($_POST["chng_commission"],$_POST["commission_id"]);
}   
else if(isset($_POST["get_next_auto_emp"]))
{
    $emp->get_next_auto_emp($_POST["get_next_auto_emp"]);
}
else if(isset($_POST["get_emp_list"]))
{
    $emp->get_emp_list();
}
else if(isset($_POST["get_specific_emp"]))
{
    $emp->get_specific_emp($_POST["get_specific_emp"]);
}
else if(isset($_POST["chg_emp_data"]))
{
    $emp->change_data_employee($_POST["chg_emp_data"]);
}
else if(isset($_POST["chng_user_name"]) && isset($_POST["chng_password"]) && isset($_POST["chng_user_and_password_id"]))
{
    $emp->change_data_employee_user_name_and_pwd($_POST["chng_user_name"],$_POST["chng_password"],$_POST["chng_user_and_password_id"]);
}
else if(isset($_POST["deactivate_user"]))
{
    $emp->deativate_user($_POST["deactivate_user"]);
}
else if(isset($_POST["activate_user"]))
{
    $emp->ativate_user($_POST["activate_user"]);
}
else if(isset($_POST["drop_this_users"]) && isset($_POST["reason"]))
{
    $emp->drop_users($_POST["drop_this_users"],$_POST["reason"]);   
}
else if(isset($_POST["get_emp_info"]))
{
    $emp->get_emp_info($_POST["get_emp_info"]);   
}
?>