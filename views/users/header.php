<?php session_start(); 

if(isset($_GET["id"]))
{
  session_destroy();
  ?><script>  window.location.href = '../../index';  </script><?php
}

if(isset($_SESSION["type"]))
{
  if(($_SESSION["type"]!="user") && ($_SESSION["type"]!="admin"))
  {
    ?><script>  window.location.href = '../../index';  </script><?php
  }
}
else
{
  ?><script>  window.location.href = '../../index';  </script><?php
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Users</title>
  <!-- Custom fonts for this template-->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="../../asset/css_custom/sb-admin-2.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../../asset/boostrap_css/sweetalert.css"/>
  
  <style>
    
     @media print {
                img
                {
                    display: block !important;
                }
      }
    .form-control
    {
      border:1px solid #85879691;
      border-radius: 0px;
      box-shadow: 0 3px 6px rgba(0,0,0,0.12), 0 3px 6px rgba(0,0,0,0.15);
    }
    input, textarea, select{
      padding:5px !important;
      font-size:12px !important;
      font-family:"Nunito,-apple-system,BlinkMacSystemFont","Segoe UI","Roboto","Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji" !important;   
    }
    .btn
    {
        font-size:10px !important;
        text-transform: uppercase;
        word-wrap: break-word;
        white-space: normal;
        cursor: pointer;
        border: 0;
        border-radius: .125rem;
        -webkit-box-shadow: 0 2px 5px 0 rgba(0,0,0,0.16), 0 2px 10px 0 rgba(0,0,0,0.12);
        box-shadow: 0 2px 5px 0 rgba(0,0,0,0.16), 0 2px 10px 0 rgba(0,0,0,0.12);
        -webkit-transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,-webkit-box-shadow .15s ease-in-out;
        transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,-webkit-box-shadow .15s ease-in-out;
        transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out,-webkit-box-shadow .15s ease-in-out;

    }
    * {
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: -moz-none;
    -o-user-select: none;
    user-select: none;
    }
    .table
    {
      font-size: 12px;
    }
    .table-dark td, .table-dark th, .table-dark thead th {
      border-color: #000000 !important;
      background-color: #000000 !important;
    }
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }

    /* Firefox */
    input[type=number] {
      -moz-appearance: textfield;
    }
    label
    {
      color: #6c757d !important;
      font-size: 10px !important;
    }
    .modal-content
    {
      border: none !important;
      border-radius: 0px !important;
    }
    .card
    {
      border: none; border-radius: 0px;box-shadow: 0 2px 2px 0 rgba(0,0,0,.14), 0 3px 1px -2px rgba(0,0,0,.2), 0 1px 5px 0 rgba(0,0,0,.12);
    }
    .tableFixHead          { overflow-y: auto; height: 700px; }
    .tableFixHead thead th { position: sticky; top: 0; }

    /* Just common table stuff. Really. */
    table  { border-collapse: collapse; width: 100%; }
    th, td { padding: 8px 16px; }
    th     { background:#eee; }
    .bg-white 
    {
      border: none !important;
      border-radius: 0px !important;
      -webkit-box-shadow: 0 2px 5px 0 rgba(0,0,0,0.16), 0 2px 10px 0 rgba(0,0,0,0.12);
      box-shadow: 0 2px 5px 0 rgba(0,0,0,0.16), 0 2px 10px 0 rgba(0,0,0,0.12);

    }
    .footer_table
    {
      border: 1px dotted white; position: fixed;left: 0;bottom: 0;width: 100%;color: white;
    }
  </style>

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index">
        <div class="sidebar-brand-icon">
          <i class="fas fa-user-shield"></i>
        </div>
        <div class="sidebar-brand-text mx-3"><?php echo $_SESSION["user"];?></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">


      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
   
      <div class="sidebar-heading">
        FEATURES
      </div>

      <?php

        $dept=json_decode($_SESSION["user_option"]["permission"]);
     
        if($dept[4]=="Telemarketer" || $_SESSION["type"]=="admin")
        {
          ?>
              <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsestatus_teli" aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-arrow-right"></i>
                  <span>Telemarketer</span>
                </a>
                <div id="collapsestatus_teli" class="collapse show" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                  <div class="bg-white py-2 collapse-inner rounded" >
                      <a class="collapse-item" href="donations"><button type="button" class="btn btn-primary btn-sm btn-block">Donations&nbsp;&nbsp;<span class="badge badge-warning fs_count" style="font-size:10px; border-radius: 0px; box-shadow: 0 5px 5px rgba(0,0,0,.2);">&nbsp;&nbsp;</span></button></a>
                      <a class="collapse-item" href="factory_sales"><button type="button" class="btn btn-primary btn-sm btn-block">Factory Sales</button></a>
                  </div>
                </div>
              </li>

          <?php
        }

        if($dept[5]=="Sales_manager" || $_SESSION["type"]=="admin")
        {
          ?>

          <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsestatus_sales" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-arrow-right"></i>
              <span>Sales Manager</span>
            </a>
            <div id="collapsestatus_sales" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded" >
                  <a class="collapse-item" href="donations"><button type="button" class="btn btn-primary btn-sm btn-block">Donations&nbsp;&nbsp;<span class="badge badge-warning fs_count" style="font-size:10px; border-radius: 0px; box-shadow: 0 5px 5px rgba(0,0,0,.2);">&nbsp;&nbsp;</span></button></a>
                  <a class="collapse-item" href="#"><button type="button" class="btn btn-primary btn-sm btn-block">Factory Sales</button></a>
              </div>
            </div>
          </li>

          <?php
        }

        if($dept[6]=="Sales_person" || $_SESSION["type"]=="admin")
        {
          ?>

          <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsestatus_person" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-arrow-right"></i>
              <span>Sales Person</span>
            </a>
            <div id="collapsestatus_person" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded" >
                  <a class="collapse-item" href="donations"><button type="button" class="btn btn-primary btn-sm btn-block">Donations&nbsp;&nbsp;<span class="badge badge-warning fs_count" style="font-size:10px; border-radius: 0px; box-shadow: 0 5px 5px rgba(0,0,0,.2);">&nbsp;&nbsp;</span></button></a>
                  <a class="collapse-item" href="#"><button type="button" class="btn btn-primary btn-sm btn-block">Factory Sales</button></a>
              </div>
            </div>
          </li>

          <?php
        }

        if($dept[7]=="sales_officer" || $_SESSION["type"]=="admin")
        {
          ?>

          <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsestatus_permission" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-arrow-right"></i>
              <span>Sales Officer</span>
            </a>
            <div id="collapsestatus_permission" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded" >
                  <a class="collapse-item" href="donations"><button type="button" class="btn btn-primary btn-sm btn-block">Donations&nbsp;&nbsp;<span class="badge badge-warning fs_count" style="font-size:10px; border-radius: 0px; box-shadow: 0 5px 5px rgba(0,0,0,.2);">&nbsp;&nbsp;</span></button></a>
                  <a class="collapse-item" href="#"><button type="button" class="btn btn-primary btn-sm btn-block">Factory Sales</button></a>
              </div>
            </div>
          </li>

          <?php
        }

        

        if($dept[0]=="production" || $_SESSION["type"]=="admin")
        {
          ?>
          <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsestatus_production" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-arrow-right"></i>
              <span>Production</span>
            </a>
            <div id="collapsestatus_production" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded" >
                  <a class="collapse-item" href="donations"><button type="button" class="btn btn-primary btn-sm btn-block">Donations&nbsp;&nbsp;<span class="badge badge-warning fs_count" style="font-size:10px; border-radius: 0px; box-shadow: 0 5px 5px rgba(0,0,0,.2);">&nbsp;&nbsp;</span></button></a>
                  <a class="collapse-item" href="#"><button type="button" class="btn btn-primary btn-sm btn-block">Factory Sales</button></a>
              </div>
            </div>
          </li>
          <?php
        }
        if($dept[1]=="purchasing" || $_SESSION["type"]=="admin")
        {
          ?>
          <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsestatus_purchasing" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-arrow-right"></i>
              <span>Purchasing</span>
            </a>
            <div id="collapsestatus_purchasing" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded" >
                  <a class="collapse-item" href="donations"><button type="button" class="btn btn-primary btn-sm btn-block">Donations&nbsp;&nbsp;<span class="badge badge-warning fs_count" style="font-size:10px; border-radius: 0px; box-shadow: 0 5px 5px rgba(0,0,0,.2);">&nbsp;&nbsp;</span></button></a>
                  <a class="collapse-item" href="#"><button type="button" class="btn btn-primary btn-sm btn-block">Factory Sales</button></a>
              </div>
            </div>
          </li>
          <?php
        }
        if($dept[2]=="HR" || $_SESSION["type"]=="admin")
        {
          ?>
          <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsestatus_hr" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-arrow-right"></i>
              <span>Human resource</span>
            </a>
            <div id="collapsestatus_hr" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded" >
                  <a class="collapse-item" href="donations"><button type="button" class="btn btn-primary btn-sm btn-block">Donations&nbsp;&nbsp;<span class="badge badge-warning fs_count" style="font-size:10px; border-radius: 0px; box-shadow: 0 5px 5px rgba(0,0,0,.2);">&nbsp;&nbsp;</span></button></a>
                  <a class="collapse-item" href="#"><button type="button" class="btn btn-primary btn-sm btn-block">Factory Sales</button></a>
              </div>
            </div>
          </li>
          <?php
        }

        if($dept[3]=="finance" || $_SESSION["type"]=="admin")
        {
          ?>
          <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsestatus_finanace" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-arrow-right"></i>
              <span>Fianance</span>
            </a>
            <div id="collapsestatus_finanace" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded" >
                  <a class="collapse-item" href="donations"><button type="button" class="btn btn-primary btn-sm btn-block">Donations&nbsp;&nbsp;<span class="badge badge-warning fs_count" style="font-size:10px; border-radius: 0px; box-shadow: 0 5px 5px rgba(0,0,0,.2);">&nbsp;&nbsp;</span></button></a>
                  <a class="collapse-item" href="#"><button type="button" class="btn btn-primary btn-sm btn-block">Factory Sales</button></a>
              </div>
            </div>
          </li>
          <?php
        }

      ?>
      


      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->
          <!-- <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form> -->

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

            <!-- Nav Item - Alerts -->
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-danger badge-counter">3+</span>
              </a>
              <!-- Dropdown - Alerts -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                  Alerts Center
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-primary">
                      <i class="fas fa-file-alt text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 12, 2019</div>
                    <span class="font-weight-bold">A new monthly report is ready to download!</span>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-success">
                      <i class="fas fa-donate text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 7, 2019</div>
                    $290.29 has been deposited into your account!
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-warning">
                      <i class="fas fa-exclamation-triangle text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 2, 2019</div>
                    Spending Alert: We've noticed unusually high spending for your account.
                  </div>
                </a>
                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
              </div>
            </li>

            <!-- Nav Item - Messages -->
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-envelope fa-fw"></i>
                <!-- Counter - Messages -->
                <span class="badge badge-danger badge-counter">7</span>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                <h6 class="dropdown-header">
                  Message Center
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="https://source.unsplash.com/fn_BT9fwg_E/60x60" alt="">
                    <div class="status-indicator bg-success"></div>
                  </div>
                  <div class="font-weight-bold">
                    <div class="text-truncate">Hi there! I am wondering if you can help me with a problem I've been having.</div>
                    <div class="small text-gray-500">Emily Fowler · 58m</div>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="https://source.unsplash.com/AU4VPcFN4LE/60x60" alt="">
                    <div class="status-indicator"></div>
                  </div>
                  <div>
                    <div class="text-truncate">I have the photos that you ordered last month, how would you like them sent to you?</div>
                    <div class="small text-gray-500">Jae Chun · 1d</div>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="https://source.unsplash.com/CS2uCrpNzJY/60x60" alt="">
                    <div class="status-indicator bg-warning"></div>
                  </div>
                  <div>
                    <div class="text-truncate">Last month's report looks great, I am very happy with the progress so far, keep up the good work!</div>
                    <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" alt="">
                    <div class="status-indicator bg-success"></div>
                  </div>
                  <div>
                    <div class="text-truncate">Am I a good boy? The reason I ask is because someone told me that people say this to all dogs, even if they aren't good...</div>
                    <div class="small text-gray-500">Chicken the Dog · 2w</div>
                  </div>
                </a>
                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
              </div>
            </li>

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION["user"];?></span>
                <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="index?id='logout'" id="log_out">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>
        </nav>
        <!-- End of Topbar -->
