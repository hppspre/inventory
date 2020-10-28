<?php include_once("header.php"); ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">
            <div class="col-md-12">

                
                    <div class='row'>
                        <div class='col-md-4'>
                            <button class="btn btn-success empty_map_list">Get Empty Map List</button><hr>
                        </div>
                        <div class='col-md-4'>
                           <input type='text' class="form-control form-control-sm invoice_id">
                           <span id="error_invoice_empty_id"></span> 
                        </div>

                        <div class='col-md-2'>
                            <button class="btn btn-success btn-block get_invoice">Print Invoice</button>
                        </div>

                        <div class='col-md-2'>
                            <button class="btn btn-success btn-block return_invoice">Make Returned</button>
                        </div>
                    </div>
            
                
                <div class="row">        
                        <div class="col-md-4">
                            <input class="form-control form-control-sm" id="item_searcher" type="text" placeholder="Search Items..">
                            <hr>
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
                            <h3 id="invoice_id"></h3><hr>
                            <div id="donte_items"></div>
                            <div id="finalized_section" style="display: none;">
                                <div class="card">
                                    <div class="card-body">
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>Price</label>
                                                <input type="number" class="form-control final_prices" readonly id="final_price">
                                            </div>
                                            <div class="col-md-3">
                                                <label>Discount</label>
                                                <input type="number" class="form-control final_prices" readonly id="final_discount">
                                            </div>
                                            <div class="col-md-3">
                                                <label>Offer</label>
                                                <input type="number" class="form-control final_prices" readonly id="final_offer">
                                            </div>
                                            <div class="col-md-3">
                                                <label>Total</label>
                                                <input type="number" class="form-control final_prices" readonly id="final_total">
                                            </div>
                                            <div class="col-md-6">
                                                <label>.</label>
                                                <button class="btn btn-block btn-success print_out">Get a print out</button>
                                            </div>
                                            <div class="col-md-6">
                                                <label>.</label>
                                                <button class="btn btn-block btn-success complete_without_print">Complete</button>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>


                            <!-- Printered Content -->

                            <div class="row" id="print_area" style="height: 3px;display: none;">

                                <table  style="border: none; width: 100%;height: 3px;">
                                    <tr>
                                        <th style="border: none;text-align: center;width: 33.33%;font-size: 20px;">FACTORY SALES</th>
                                        <th style="border: none;text-align: center;width: 33.33%;font-size: 20px;">&nbsp;INVOICE</th>
                                        <th style="border: none;text-align: center;width: 33.33%;font-size: 20px;" id="next_invoice_id"></th>
                                    </tr>
                                    <tr>
                                        <td style="border: none;width: 33.33%;text-align: center;">
                                            <img src="../../asset/images/logos/wintrylogo.png" class="img-fluid" style="width: 152px; height: 57px; display: block;">
                                        </td>
                                        <td  style="border: none;font-size: 13px;width: 33.33%;text-align: center;">
                                            Manufacturers Of Automobile Industrial & Household Chemicals
                                            No 20, River View Park, Nelundeniya Road, Wariyagoda, Alawwa
                                            Alawwa 60280
                                            Sri Lanka
                                        </td>
                                        <td  style="border: none;font-size: 13px;width: 33.33%;text-align: center;">
                                            Hot Line:037-5784182<br>
                                            Moblie  :037-5784182<br>
                                            Fax&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:037-2278782<br>
                                            E-mail:wintrychem@gmail.com
                                            FB:https://www.facebook.com/wintrychemical
                                        </td>
                                    </tr>
                                </table>
                                <hr>
                                <table  style="border: none; width: 100%;">
                                    <tr>
                                        <th  style="border: none;text-align: left;width: 33.33%;font-size: 17px;" id="customer_name"></th>
                                        <th  style="border: none;text-align: left;width: 33.33%;font-size: 17px;" id="customer_address"></th>
                                        <th  style="border: none;text-align: left;width: 33.33%;font-size: 17px;" id="customer_phone"></th>
                                    </tr>
                                </table>
                                <hr>
                                <div id="final_table" style="width: 100%;"></div><hr>
                            
                                <table style="width: 100%;">
                                    <tr>
                                        <th>TOTAL PRICE [LKR]</th>
                                        <th>DISCOUNT [LKR]</th>
                                        <th>SPECIAL OFFERS [LKR]</th>
                                        <th>PAYABLE AMOUNT [LKR]</th>
                                    </tr>
                                    <tr>
                                        <th id="total_price"></th>
                                        <th id="total_discount"></th>
                                        <th id="total_offer"></th>
                                        <th id="total_payable_amount"></th>
                                    </tr>
                                </table>



                                <div class="col-md-12"><hr></div>
                                <table class="table table-bordered" id="footer_table" style="border: none;">
                                    <tr style="width: 100%;" style="border: none;">
                                        <td style="width: 20%;border: none;">
                                             <img src="../../asset/images/logos/Award.png" class="img-fluid" style="width: 110px; height: 70px;display: block;">
                                        </td>
                                        <td style="width: 20%;border: none;">
                                            <img src="../../asset/images/logos/PUM.png" class="img-fluid" style="width: 110px; height: 70px;display: block;">
                                       </td>
                                       <td style="width: 20%;border: none;">
                                            <img src="../../asset/images/logos/EPL.png" class="img-fluid" style="width: 110px; height: 70px;display: block;">
                                       </td>
                                       <td style="width: 20%;border: none;">
                                            <img src="../../asset/images/logos/ITI.png" class="img-fluid" style="width: 110px; height: 70px;display: block;">
                                       </td>
                                       <td style="width: 20%;border: none;">
                                            <img src="../../asset/images/logos/precusor-contro-authority.png" class="img-fluid" style="width: 110px; height: 70px;display: block;">
                                       </td>
                                    </tr>
                                </table>
                               
                            </div>

                            <!-- Printered Content -->

                        </div>
                    </div>
                </div>
        </div>

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


         <!----- Modal For success -->
         <div class="modal" id="completed_factory_sales" data-keyboard="false" data-backdrop="static" >
            <div class="modal-dialog modal-dialog-centered modal-lg" >
                <div class="modal-content" style="background-color: #fff0;">
                    <div class="modal-header" style="display: block;text-align: center;">
                        <button type="button" class="btn btn-success" data-dismiss="modal">Okay...!</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class='col-md-12'>
                                <div style="text-align: center;">
                                      <img src="../../asset/images/loader/loading.gif" class="img-fluid">  
                                      <br>   
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>   
        </div> 


          <!----- Modal For edit Donate item -->
        <div class="modal" id="add_customer_modal" data-keyboard="false" data-backdrop="static">
            <div class="modal-dialog modal-dialog-centered modal-lg" >
                <div class="modal-content">
                
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div id="custmer_error"></div>

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
                                    <button type="button" class="btn btn-block btn-success" id="customer_btn">Add New</button>                                        
                                </div>
                            </div>
                        </div>    
                    </div>
                </div>
            </div>
        </div>  
        <!--  -->

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
       
        <!-- This ifram use to get print out -->
        <iframe id="print_iframe" style="height: 0px;"></iframe>  

        <!-- This modal use to make returned -->
        <div class="modal" id="factory_sales_returned" data-keyboard="false" data-backdrop="static">
            <div class="modal-dialog modal-dialog-centered modal-lg" >
                <div class="modal-content">
                    
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div id="returned_errors"></div>

                        <div class="row">

                        
                            <div class="col-md-12">
                                <table class="table table-bordered table-sm">
                                    <thead>
                                        <tr>
                                            <td>Customer Name</td>
                                            <td>Address</td>
                                            <td>Phone Number</td>
                                            <td>Discount[%]</td>
                                            <td>Offer[%]</td>
                                        </tr>
                                    </thead>
                                    <tbody id="customer_info"></tbody>
                                </table>
                            </div> 


                            <div class="col-md-6">
                                    <input class="form-control" id="returned_item_finder" type="text" placeholder="Search..">
                                    <table class="table table-bordered">
                                        <tr>
                                            <td>Name</td>
                                            <td>Quantity</td>
                                            <td>Action</td>
                                        </tr>
                                        <tbody id="returned_items_list"></tbody>
                                    </table>
                            </div>


                            <div class="col-md-6">

                                    <table class="table table-bordered">
                                        <tr>
                                            <td>Name</td>
                                            <td>Method</td>
                                            <td>Quantity</td>
                                        </tr>
                                        <tbody id="returned_items_maked_list"></tbody>
                                    </table>
                                    <button class="btn btn-primary btn-block make_complete_return">Complete</button>
                                    <br>
                                    <div id="repaid"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
        <!-- This modal use to make returned -->

        <!-- This modal use to get items Map List -->
        <div class="modal" id="items_list_modal" data-keyboard="false" data-backdrop="static">
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
                                <input class="form-control" id="items_list" type="text" placeholder="Search..">
                                <table class="table table-bordered">
                                    <tr>
                                        <td>Item Name</td>
                                        <td>Item Code</td>
                                        <td>Empty Item Name</td>
                                        <td>Empty Item Code</td>
                                    </tr>
                                    <tbody id="list_table_items"></tbody>
                                </table>
                            </div>
                            </div>    
                        </div>
                    </div>
                </div>
        </div>  
        <!-- This modal use to get items List -->

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
<script src="../../functions/users/factory_sales.js"></script>
<script src="../../functions/admin_and_user_public.js"></script>
