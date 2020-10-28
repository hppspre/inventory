<?php include_once("categories_class.php");

$category= new categories();

if(isset($_POST["cat_name"]))
{
    $category->add_category($_POST["cat_name"]);
}
else if(isset($_POST["get_categories"]))
{
    $category->get_categories($_POST["get_categories"]);
}
else if(isset($_POST["chng_category_name"]) && isset($_POST["change_cat_id"]))
{
    $category->chng_category_name($_POST["chng_category_name"],$_POST["change_cat_id"]); 
}

?>