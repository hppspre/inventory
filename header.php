<?php session_start(); 

if(isset($_SESSION["type"]))
{
  if($_SESSION["type"]=="admin")
  {
    ?><script>  window.location.href = 'views/admin/index.php';  </script><?php
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="stylesheet" href="asset\boostrap_css\bootstrap.min.css">
    <link rel="stylesheet" href="asset\boostrap_css\sweetalert.css">
