<?php include_once("../header.php"); ?>


        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800">

                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm get_designation" data-toggle="modal" data-target="#new_employee">
                    <i class="fas fa-download fa-sm text-white-50"></i> Add New Employee
                </a>

                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" data-toggle="modal" data-target="#new_designation">
                    <i class="far fa-address-card fa-sm text-white-50"></i> Add New Designation
                </a>  
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" data-toggle="modal" data-target="#manage_discount">
                    <i class="fas fa-percent"></i> Change Commission Rate
                </a>  
            </h1>

            <!-- EMP LIST -->
            <div class="row">
                    <div class="col-md-8">
                        <input class="form-control form-control-sm" id="find_emp" type="text" placeholder="Search.." style="text-transform: uppercase;">
                    </div>
                    <div class="col-md-4">
                        <button class='btn btn-block btn-light find_emp'>Get Info</button>
                    </div>
            </div>
                
        
            <br>
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>EMP Name</th>
                    <th>Designation</th>
                    <th>Emp Number</th>
                    <th>Change</th>
                    <th>Activation</th>
                    <th>Drop</th>
                </tr>
                </thead>
                <tbody id="emp_list" class="emp_list"></tbody>
            </table>
        </div>

        <!-- /.container-fluid -->

        <!-- This modal use to get_employee_details -->
        <div class="modal" id="get_emp_info" data-keyboard="false" data-backdrop="static">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="container-fluid emp_details_loader" style="text-align: center;"></div>
                        <div class="container-fluid emp_details" style="display: none;">
                            <table class="table table-bordered table-sm">
                                <tbody id="emp_infomation"></tbody>
                            </table>
                        </div>
                    </div>
                </div>    
            </div>
        </div>

        <!-- This modal use to change_employee_details -->
        <div class="modal" id="chnge_emp" data-keyboard="false" data-backdrop="static">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    
                    <!-- Modal body -->
                        <div class="modal-body">
                            <div class='col-md-12' id="load_change_emp_area" style="text-align: center;">
                                <img src='../../asset/images/icon8/search.gif' class="img-fluid" style="width: 100px; height: 100px;">
                            </div>
                            

                            <div class='col-md-12' id="change_emp_area">
                                
                                    
                                    <form id="chn_emp_forms">
                                        <div class='row'>
                                                
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="usr" class='small'>Name:</label>
                                                        <input type="text" name="name" class="form-control" id="chn_name">
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="usr" class='small'>E-Mail:</label>
                                                        <input type="text" name="mail"  class="form-control" id="chn_mail">
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="usr" class='small'>Teli Phone:</label>
                                                        <input type="text" name="teli" class="form-control" id="chn_teli">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="usr" class='small'>NIC:</label>
                                                        <input type="text" name="nic"  class="form-control" id="chn_nic">
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <label for="usr" class='small'>Address:</label>
                                                        <input type="text" name="address"  class="form-control" id="chn_address">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="usr" class='small'>Designation:</label>
                                                        <select class="form-control select_designation" name="chn_designation" id="chn_designation"></select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="usr" class='small'>EPF Number:</label>
                                                        <input type="text" name="epf_number"  class="form-control" id="chn_epf">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group" style="text-align: center;">
                                                        <hr>
                                                        <div id="chnge_msg_error" style="color: red;display: none;"><i class="fas fa-exclamation-triangle"></i><small>&nbsp;Details Not Enough </small></div>
                                                        <hr>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="chnge_user_id" id="chnge_user_id">
                                            
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="usr" class='small'>:</label>
                                                        <a href="#" class="btn btn-danger btn-icon-split btn-block btn-sm" id="chng_employee_btn">
                                                            <span class="icon text-white-50">
                                                                <span class="icon text-white-50 waiter_emp_change">
                                                                <i class="fas fa-check"></i>
                                                            </span>
                                                            <span class="text" style="color: white;">Change This Employee Details</span>
                                                        </a>
                                                    </div>
                                                </div>
                                        </div>
                                    </form>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="usr" class='small'>User Name:</label>
                                                <input type="text" class="form-control" id="chn_user">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="usr" class='small'>Password:</label>
                                                <input type="password" class="form-control" id="chn_pwd">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="usr" class='small'>:</label>
                                                <a href="#" class="btn btn-danger btn-icon-split btn-block btn-sm" id="chng_employee_btn_user_and_pwd">
                                                    <span class="icon text-white-50">
                                                        <span class="icon text-white-50 waiter1">
                                                        <i class="fas fa-check"></i>
                                                    </span>
                                                    <span class="text" style="color: white;">Change This Employee User Name and password</span>
                                                </a>
                                            </div>
                                        </div>

                                    </div>
                                   <hr>
                            </div>
                        </div>
                </div>
            </div>
        </div>    
        <!-- This modal use to change_employee_details -->


        <!-- The Modal -->
         <div class="modal" id="new_designation" data-keyboard="false" data-backdrop="static">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="col-md-12">
                            <div id="designation_error" style="color: red;display: none;"><i class="fas fa-exclamation-triangle"></i><small>&nbsp;Details Not Enough </small></div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="usr" class='small' style="color: #4e73df;"><img src="../../asset/images/icon8/down-arrow.gif" class="img-fluid" style="width: 35px; height: 35px;">&nbsp;Select Departments:</label>
                                        <div class="container-fluid">
                                            <div class="row" style="font-size: 10px;" id="dept_list">

                                                <div class="col-md-3 deprtment_cat" data-id="production_dept">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" value="production" id="production_dept">
                                                        <label class="form-check-label" for="inlineCheckbox1">Production</label>
                                                      </div>
                                                </div>
                                                <div class="col-md-3 deprtment_cat" data-id="Purchasing_dept">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" value="purchasing" id="Purchasing_dept">
                                                        <label class="form-check-label" for="inlineCheckbox1">Purchasing</label>
                                                      </div>
                                                </div>
                                                <div class="col-md-3 deprtment_cat" data-id="hr_dept">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" value="HR" id="hr_dept">
                                                        <label class="form-check-label" for="inlineCheckbox1">HR Managment</label>
                                                      </div>
                                                </div>
                                                <div class="col-md-3 deprtment_cat" data-id="finance_dept">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" value="finance" id="finance_dept">
                                                        <label class="form-check-label" for="inlineCheckbox1">Finance.</label>
                                                      </div>
                                                </div>

                                                <div class="col-md-3 deprtment_cat" data-id="telemarketer">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" value="Telemarketer" id="telemarketer">
                                                        <label class="form-check-label" for="inlineCheckbox1">Telemarketer.</label>
                                                      </div>
                                                </div>

                                                <div class="col-md-3 deprtment_cat" data-id="sales_manager">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" value="Sales_manager" id="sales_manager">
                                                        <label class="form-check-label" for="inlineCheckbox1">Sales Manager.</label>
                                                    </div>
                                                </div>

                                                <div class="col-md-3 deprtment_cat" data-id="sales_person">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" value="Sales_person" id="sales_person">
                                                        <label class="form-check-label" for="inlineCheckbox1">Sales Person.</label>
                                                    </div>
                                                </div>

                                                <div class="col-md-3 deprtment_cat" data-id="sales_officer">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" value="sales_officer" id="sales_officer">
                                                        <label class="form-check-label" for="inlineCheckbox1">Sales Officer.</label>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="usr" class='small'>Name of the Designation:</label>
                                        <input type="text" name="name" class="form-control" id="desigantion">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="usr" class='small'>Sales Designation:</label>
                                        <input type="text" name="name" class="form-control" id="sales_designtion">
                                    </div>
                                </div>
                                <hr>
                                <div class="col-md-6">
                                    <a href="#" class="btn btn-success btn-icon-split btn-block btn-sm" id="add_designation_btn">
                                        <span class="icon text-white-50"  style="background: rgb(28 200 138);">
                                            <span class="icon text-white-50 waiter2"  style="background: rgb(28 200 138);">
                                            <i class="fas fa-check"></i>
                                        </span>
                                        <span class="text" style="color: white;">Add This Designation</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div id="designation_error" style="color: red;display: none;"><i class="fas fa-exclamation-triangle"></i><small>&nbsp;Details Not Enough </small></div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="usr" class='small' style="color: #4e73df;">&nbsp;*If you want to change Privilages, select it below:</label>
                                        <hr>
                                        <div class="container-fluid">
                                            <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="usr" class='small' style="text-align: left;">Select the Designation:</label>
                                                        <select class="form-control select_designation_to_change"></select>
                                                    </div>
                                            </div>     
                                            <div class="row" style="font-size: 10px;" id="change_dept_list">
                                                <div class="col-md-3 deprtment_cat" data-id="production_chk">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" value="production" id="production_chk">
                                                        <label class="form-check-label" for="inlineCheckbox1">Production</label>
                                                      </div>
                                                </div>
                                                <div class="col-md-3 deprtment_cat" data-id="purchasing_chk">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" value="purchasing" id="purchasing_chk">
                                                        <label class="form-check-label" for="inlineCheckbox1">Purchasing</label>
                                                      </div>
                                                </div>
                                                <div class="col-md-3 deprtment_cat" data-id="HR_chk">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" value="HR" id="HR_chk">
                                                        <label class="form-check-label" for="inlineCheckbox1">HR Managment</label>
                                                      </div>
                                                </div>
                                                <div class="col-md-3 deprtment_cat" data-id="finance_chk">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" value="finance" id="finance_chk">
                                                        <label class="form-check-label" for="inlineCheckbox1">Finance.</label>
                                                      </div>
                                                </div>

                                                <div class="col-md-3 deprtment_cat" data-id="telemarketer_chk">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" value="Telemarketer" id="telemarketer_chk">
                                                        <label class="form-check-label" for="inlineCheckbox1">Telemarketer.</label>
                                                      </div>
                                                </div>

                                                <div class="col-md-3 deprtment_cat" data-id="sales_manager_chk">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" value="Sales_manager" id="sales_manager_chk">
                                                        <label class="form-check-label" for="inlineCheckbox1">Sales Manager.</label>
                                                    </div>
                                                </div>

                                                <div class="col-md-3 deprtment_cat" data-id="sales_person_chk">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" value="Sales_person" id="sales_person_chk">
                                                        <label class="form-check-label" for="inlineCheckbox1">Sales Person.</label>
                                                    </div>
                                                </div>

                                                <div class="col-md-3 deprtment_cat" data-id="sales_officer_chk">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" value="sales_officer" id="sales_officer_chk">
                                                        <label class="form-check-label" for="inlineCheckbox1">Sales Officer.</label>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>

<!--                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="usr" class='small'>Designation:</label>
                                        <input type="text" name="name" class="form-control" id="change_designtion">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="usr" class='small'>Sales Designation:</label>
                                        <input type="text" name="name" class="form-control" id="change_sales_designtion">
                                    </div>
                                </div> -->
                                
                                <div class="col-md-12">
                                    <label for="usr" class='small'>.</label>
                                    <a href="#" class="btn btn-primary  btn-icon-split btn-block btn-sm" id="change_designation_btn">
                                        <span class="icon text-white-50">
                                            <span class="icon text-white-50 waiter3" >
                                            <i class="fas fa-check"></i>
                                        </span>
                                        <span class="text" style="color: white;">Change This Designation</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>    


        <!-- The Modal -->
        <div class="modal" id="manage_discount" data-keyboard="false" data-backdrop="static">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    
                    <!-- Modal body -->
                    <div class="modal-body">
                    <div id="msg_error_commission" style="color: red;display: block;"></div><hr>

                        <table class="table table-sm table-striped table-dark" style="border: white;">
                            <thead>
                              <tr>
                                <th>Designation</th>
                                <th>Commission Rate [%]</th>
                                <th>Change</th>
                              </tr>
                            </thead>
                            <tbody id="discount_manage_list"> </tbody>
                        </table>
                    </div>

                    
                </div>
            </div>
        </div>    

        <!-- The Modal -->
        <div class="modal" id="new_employee" data-keyboard="false" data-backdrop="static" >
            <div class="modal-dialog modal-dialog-centered modal-lg" >
            <div class="modal-content">
            
                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
              
                <!-- Modal body -->
                <div class="modal-body">
                    <div class='col-md-12'>
                        <form id="new_employee_form">
                        
                        <div class='row'>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="usr" class='small'>Name:</label>
                                        <input type="text" name="name" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="usr" class='small'>E-Mail:</label>
                                        <input type="text" name="mail"  class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="usr" class='small'>Teli Phone:</label>
                                        <input type="text" name="teli" class="form-control">
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="usr" class='small'>Address:</label>
                                        <input type="text" name="address"  class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="usr" class='small'>NIC:</label>
                                        <input type="text" name="nic"  class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="usr" class='small'>Designation:</label>
                                        <select class="form-control select_designation" name="designation">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="usr" class='small'>EPF-Number:</label>
                                        <input type="text" name="nic"  class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="usr" class='small'>Employee Number:</label>
                                        <input type="text" id="emp_number" name="emp_number" class="form-control" readonly>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="usr" class='small'>User Name:</label>
                                        <input type="text" id="user_name" name="user_name" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="usr" class='small'>Password:</label>
                                        <input type="password" id="user_password" name="password" class="form-control">
                                    </div>
                                </div>
                            
                        </div>
                    </form>
                        <div class="row">
                            <div class="col-md-12" style="text-align: center;">
                                <hr>
                                    <div id="msg_error" style="color: red;display: none;"><i class="fas fa-exclamation-triangle"></i><small>&nbsp;Details Not Enough </small></div>
                                <hr>
                            </div>
                            <div class="col-md-12">
                                <a href="#" class="btn btn-success btn-icon-split btn-block btn-sm" id="add_employee_btn">
                                    <span class="icon text-white-50"  style="background: rgb(28 200 138);">
                                        <span class="icon text-white-50 waiter1"  style="background: rgb(28 200 138);">
                                        <i class="fas fa-check"></i>
                                    </span>
                                    <span class="text" style="color: white;">Add This Employee</span>
                                </a>
                            </div>
                    
                        </div>
                        <hr>
                    </div>
                </div>
            
            </div>
            </div>
        </div>

<?php include_once("../footer.php"); ?>
<script src="../../functions/admin/add_new_employee.js"></script>
<script src="../../functions/admin/add_designation.js"></script>
<script src="../../functions/admin/manage_commtion_rate.js"></script>
<script src="../../functions/admin/change_employee.js"></script>

<!-- Disabled Auto Complete -->
<script>
    $(".form-control").attr("autocomplete", "off");
</script>
</body>

</html>