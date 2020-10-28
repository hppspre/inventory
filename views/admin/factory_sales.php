<?php include_once("../header.php"); ?>

        

        <!-- Begin Page Content -->
        <div class="afterloader container-fluid">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Customers List</label>
                                <select class="form-control form-control-sm" id="fs_customers_list"></select>
                            </div>
                            <div class="col-md-2">
                                <label>.</label>
                                <button class="btn btn-success btn-block btn-light" id="new_factory_sales">New</button>
                            </div>
                            <div class="col-md-2">
                                <label>.</label>
                                <button class="btn btn-success btn-block customer_editer">Edit</button>
                            </div>
                            <div class="col-md-2">
                                <label>.</label>
                                <button class="btn btn-danger btn-block customer_droper">Drop </button>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="row">

                            <div class='col-md-3'>
                                <hr>
                                <input type="date" class="form-control date_selecter" value="<?php echo date('Y-m-d')?>" max="<?php echo date('Y-m-d')?>" onkeydown="return false">
                            </div>
                            <div class='col-md-9' style="text-transform: uppercase; font-size: 20px;background: url(../../asset/images/loader/fireforks.gif) 50%,50%;-webkit-text-fill-color: transparent;-webkit-background-clip: text;text-shadow: 0 5px 5px rgba(1,1,1,0.2);">
                                <hr>TOTAL SALES : LKR <span id="total_sum"></span>
                            </div>

                            <div class="col-md-12">
                             
                                    <table class="table table-bordered">
                                        <thead style="font-size: 10px;">
                                            <tr>
                                                <td>NO</td>
                                                <td>Name</td>
                                                <td>Address</td>
                                                <td>Phone Number</td>
                                                <td>Total Price</td>
                                                <td>Discount</td>
                                                <td>Offer</td>
                                                <td>Paid Amount</td>
                                                <td>Order Maked By</td>
                                                <td>Get Details</td>
                                            </tr>
                                            <tbody id="sales_content"></tbody>
                                        </thead>
                                    </table>
                           
                                
                            </div>
 
                            <div class="col-md-12">
                                <hr>
                                <div class="row">
                                    <div class="col-md-3">
                                        <input class="form-control" id="return_item_finder" type="text" placeholder="Search..">
                                    </div>
                                    <div class="col-md-9" style="text-transform: uppercase; font-size: 20px;background: url(../../asset/images/loader/fireforks.gif) 50%,50%;-webkit-text-fill-color: transparent;-webkit-background-clip: text;text-shadow: 0 5px 5px rgba(1,1,1,0.2);">
                                        TOTAL REPAID AMOUNT : LKR <span id="total_repaid_sum"></span>
                                    </div>
                                </div>
                                
                                
                                <table class="table table-bordered">
                                    <thead style="font-size: 10px;">
                                        <tr>
                                            <th>Invoice Number</th>
                                            <th>Returned Date</th>
                                            <th>Repaid Amount</th>
                                            <th>Status</th>
                                            <th>Get Details</th>
                                        </tr>
                                        <tbody id="sales_returned_content"></tbody>
                                    </thead>
                                </table>    
                             

                            </div>

                        </div>
                    </div>

                    <div class="col-md-4">
                        <br>
                        <div id="change_customer_error"></div>
                     
                        <label>Change Name</label>
                        <input type="text" class="form-control edit_fsc" id="edit_customer_name">

                        <label>Change Address</label>
                        <input type="text" class="form-control edit_fsc" id="edit_customer_address">

                        <label>Change Phone Number</label>
                        <input type="text" class="form-control edit_fsc" id="edit_phone_number">

                        <label>Change Discount Rate</label>
                        <input type="number" class="form-control edit_fsc" id="edit_discount_rate">

                        <label>Change Special Offer Rate</label>
                        <input type="number" class="form-control edit_fsc" id="edit_special">
                        <br><hr>

                        <button class="btn btn-block btn-primary " id="save_changed_customer_data">Save Changed Details</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- The Modal -  -->
        <div class="modal" id="new_cutomer" data-keyboard="false" data-backdrop="static">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    
                    <!-- Modal body -->
                    <div class="modal-body">
                    <div id="new_customer_list_error"></div>

                        <div class="col-md-12">

                            <div class="row">

                                <div class="col-md-12">
                                    <label>Customer Name</label>
                                    <input type="text" class="form-control values_fs" id="new_customer_name">
                                </div>

                                <div class="col-md-12">
                                    <label>Customer Address</label>
                                    <input type="text" class="form-control values_fs" id="new_customer_address">
                                </div>

                                <div class="col-md-4">
                                    <label>Customer Phone</label>
                                    <input type="text" class="form-control values_fs" id="new_customer_phone">
                                </div>

                                <div class="col-md-4">
                                    <label>Customer Discount</label>
                                    <input type="number" class="form-control values_fs" id="new_customer_discount" value="20">
                                </div>

                                <div class="col-md-4">
                                    <label>Customer Special Offers</label>
                                    <input type="text" class="form-control values_fs" id="new_customer_special_offers" value="0">
                                </div>
                            
                                <div class="col-md-12">
                                    <hr>
                                    <button class="btn btn-block btn-success add_this_customer_btn">Add This Customer</button>
                                </div>

                            </div>
                        </div>
                        
                    </div>

                    
                </div>
            </div>
        </div>  


        <!----- Modal For more info -->
        <div class="modal" id="factory_sales_info" data-keyboard="false" data-backdrop="static" >
            <div class="modal-dialog modal-dialog-centered modal-lg" >
                <div class="modal-content" style="background-color: #fff0;">
                    <!-- Modal header -->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class='col-md-12'>
                              <div class="container">
                                  <table class="table table-bordered">
                                     
                                      <tr>
                                            <th>Item Name</th>
                                            <th>Item type</th>
                                            <th>Method</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Total Price</th>
                                      </tr>
                                      <tbody id="factory_sales_info_table" style="color: white;"></tbody>
                                  </table>
                              </div>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>   
        </div> 


        <!----- Modal For more info -->
        <div class="modal" id="returned_sales_info" data-keyboard="false" data-backdrop="static" >
            <div class="modal-dialog modal-dialog-centered modal-lg" >
                <div class="modal-content" style="background-color: #fff0;">
                    <!-- Modal header -->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class='col-md-12'>
                              <div class="container">
                                  <table class="table table-bordered">
                                     
                                      <tr>
                                            <th>Item Name</th>
                                            <th>Method</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                      </tr>

                                      <tbody id="returned_sales_info_table" style="color: white;"></tbody>


                                  </table>
                              </div>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>   
        </div> 

         <!----- Modal For loader -->
         <div class="modal" id="loader_factory_sales" data-keyboard="false" data-backdrop="static" >
            <div class="modal-dialog modal-dialog-centered modal-lg" >
                <div class="modal-content" style="background-color: #fff0;">
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class='col-md-12'>
                                <div style="text-align: center;">
                                      <img src="../../asset/images/loader/loading.gif" class="img-fluid">  
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>   
        </div> 
     

<?php include_once("../footer.php"); ?>
<script src="../../functions/admin/factory_sales/factory_sales.js"></script>
