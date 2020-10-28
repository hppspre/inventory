<?php include_once("../header.php"); ?>


        <!-- Begin Page Content -->
        <div class="container-fluid">
            <div class="col-md-12">
            <button class="btn btn-success empty_map_list">Get Empty Map List</button><hr>
                <div class="row">
                    
                        <div class="col-md-4">
                            <input class="form-control" id="item_searcher" type="text" placeholder="Search Items..">
                            <hr>
                        </div>
                        <div class="col-md-2">
                            <select class="form-control" id="list_of_customers"></select>
                            <hr>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-block btn-light add_new_customer">Add New</button>
                            <hr>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-block btn-success edit_customer">Edit</button>
                            <hr>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-block btn-success load">My Donation</button>
                            <hr>
                        </div>

                        <div class="col-md-4">
                            <table class="table table-bordered table-sm">
                                <thead>
                                    <tr>
                                        <td>Unit Qty</td>
                                        <td>Leaters Qty</td>
                                        <td>Item Name</td>
                                    </tr>
                                </thead>
                                <tbody id='items_lister'></tbody>
                            </table>
                        </div>

                        <div class="col-md-8">
                            <div id="error_of_confirmation"></div>
                            <div id="donte_items"></div>
                        </div>
                    </div>
                    
                </div>
            
        </div>
        <!------container-fluid ------------------------------------------>

        <!----- Modal For donation info -->
        <div class="modal" id="modal_for_donation_info" data-keyboard="false" data-backdrop="static">
            <div class="modal-dialog modal-dialog-centered modal-lg" style="max-width: 80%;">
                <div class="modal-content">
                
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                
                    <!-- Modal body -->
                    <div class="modal-body">

                        <div class="col-md-12">
                       
                            <div class="row">
                               <div class="col-md-12">
                                    <input class="form-control" id="donation_searcher" type="text" placeholder="Search Donation.." autocomplete="off">
                                    <hr>
                               </div> 
                               <div class="col-md-12">
                               <div class="tableFixHead">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>customer_name</th>
                                            <th>customer_address</th>
                                            <th>customer_phone</th>
                                            <th>Donated By</th>
                                            <th>Donated Date</th>
                                            <th>Status</th>
                                            <th>Completed By</td>
                                            <th>Completed Date</th>
                                            <th>Order Inforamtion</th>
                                        </tr>
                                    </thead>

                                    <tbody id="nonated_lister"></tbody>

                                </table>   
                               </div>
                               </div>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>   

        <!----- Modal For load donation information -->
        <div class="modal" id="donation_info_modal" data-keyboard="false" data-backdrop="static">
            <div class="modal-dialog modal-dialog-centered modal-lg" style="max-width: 80%;">
                <div class="modal-content">
                
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="col-md-12">
                            <div class="tableFixHead after_load">
                                
                                <div style="text-align: center;">
                                    <img src="../../asset/images/imoji/waitingemoji.gif" class="img-fluid">
                                </div>

                            </table>   
                            </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>       
        


        <!----- Modal For edit Donate item -->
        <div class="modal" id="add_new_customer_modal" data-keyboard="false" data-backdrop="static">
            <div class="modal-dialog modal-dialog-centered modal-lg" >
                <div class="modal-content">
                
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div id="donate_custmer_error"></div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                   <label>Name</label>
                                   <input type="text" class="form-control customer_info" id="name_of_customers">    
                                </div>
                                <div class="col-md-12">
                                   <label>Addreess</label>
                                   <input type="text" class="form-control customer_info" id="address_of_costomers">                                        
                                </div>
                                <div class="col-md-12">
                                   <label>Phone Number</label>
                                   <input type="text" class="form-control customer_info" id="phon_number_of_costomers">                                        
                                </div>
                                <div class="col-md-12">
                                    <hr>
                                    <button type="button" class="btn btn-block btn-success" id="add_customer_btn">Add New</button>                                        
                                 </div>
                            </div>
                        </div>    
                    </div>
                </div>
            </div>
        </div>       
        
        
        <!----- Modal For edit Donate item -->
        <div class="modal" id="edit_customer_modal" data-keyboard="false" data-backdrop="static">
            <div class="modal-dialog modal-dialog-centered modal-lg" >
                <div class="modal-content">
                
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div id="edit_donate_custmer_error"></div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                   <label>Name</label>
                                   <input type="text" class="form-control customer_info" id="edit_name_of_customers">    
                                </div>
                                <div class="col-md-12">
                                   <label>Addreess</label>
                                   <input type="text" class="form-control customer_info" id="edit_address_of_costomers">                                        
                                </div>
                                <div class="col-md-12">
                                   <label>Phone Number</label>
                                   <input type="text" class="form-control customer_info" id="edit_phon_number_of_costomers">                                        
                                </div>
                                <div class="col-md-12">
                                    <hr>
                                    <button type="button" class="btn btn-block btn-success" id="edit_customer_btn">Add New</button>                                        
                                 </div>
                            </div>
                        </div>    
                    </div>
                </div>
            </div>
        </div>  
        <!--  -->

        <!----- Modal For edit Donate item -->
        <div class="modal" id="edit_object" data-keyboard="false" data-backdrop="static" >
            <div class="modal-dialog modal-dialog-centered modal-lg" >
                <div class="modal-content">
                
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class='col-md-12'>

                                <div id="donate_error"></div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Method</label>
                                        <select class="form-control" id="unit_bulk">
                                            <option value="unit">UNIT</option>
                                            <option value="bulk">BULK</option>
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <label>Unit Quantity</label>
                                        <input type="number" id="dontate_qty" placeholder="" class="form-control">
                                    </div>

                                    <div class="col-md-4">
                                        <label>Bulk Quantity[ML]</label>
                                        <input type="number" id="dontate_bulk_qty" placeholder="" class="form-control">
                                    </div>


                                    <div class="col-md-12">
                                        <hr>
                                        <button class="btn btn-block btn-success confirm_item">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>   
        </div> 


        <!----- Modal For loader -->
        <div class="modal" id="loader_donation" data-keyboard="false" data-backdrop="static" >
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

        
        <!----- Modal For thank -->
        <div class="modal" id="loader_thank" data-keyboard="false" data-backdrop="static" >
            <div class="modal-dialog modal-dialog-centered modal-lg" >
                <div class="modal-content" style="background-color: #fff0;">
                
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class='col-md-12'>
                                <div style="text-align: center;">
                                      <img src="../../asset/images/other/thankyou.gif" class="img-fluid">  
                                </div>
                                <hr>
                                <button type="button" class="btn btn-success btn-block" data-dismiss="modal">Okay..</button>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>   
        </div> 


        <!-- This modal use to get empty Map List -->
        <div class="modal" id="empty_map_list" data-keyboard="false" data-backdrop="static">
            <div class="modal-dialog modal-dialog-centered modal-lg" >
                <div class="modal-content">
                
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="col-md-12">
                           <div>
                            <input class="form-control" id="empty_list" type="text" placeholder="Search..">
                            <table class="table table-bordered">
                                   <tr>
                                       <td>Item Name</td>
                                       <td>Item Code</td>
                                       <td>Empty Item Name</td>
                                       <td>Empty Item Code</td>
                                   </tr>
                                   <tbody id="list_of_items"></tbody>
                               </table>
                           </div>
                        </div>    
                    </div>
                </div>
            </div>
        </div>  
        <!-- This modal use to get empty Map List -->

     

<?php include_once("../footer.php"); ?>
<script src="../../functions/admin/donation/donation.js"></script>
<script src="../../functions/admin_and_user_public.js"></script>

<!-- Disabled Auto Complete -->
<script>
    $(".form-control").attr("autocomplete", "off");
</script>
</body>

</html>