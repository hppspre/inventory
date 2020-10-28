<?php

include_once("routs_class.php");

$routs=new routs();

if(isset($_POST["Rout_name"]) && isset($_POST["gkm"]))
{
    $routs->add_new_routs($_POST["Rout_name"],$_POST["gkm"]);
}
else if(isset($_POST["load_routs"]))
{
    $routs->load_routs();
}
else if(isset($_POST["chn_description"]) && isset($_POST["chn_genaral_kms"])  && isset($_POST["chn_rout_id"]))
{
    $routs->change_rout_details($_POST["chn_rout_id"],$_POST["chn_description"],$_POST["chn_genaral_kms"]);
}

?>