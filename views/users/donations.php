<?php include_once("header.php"); ?>

        

        <!-- Begin Page Content -->
        <div class="afterloader container-fluid">
            <div class='col-md-12'>
                <button class="btn btn-success empty_map_list">Get Empty Map List</button>
                <button class="btn btn-primary" id="Items_list">Items List</button>
            <hr>

                <div class="row">
                    
                    <div class="col-md-4">
                        <div style="height: 700px; overflow-y: auto;">
                            <table class="table table-bordered">
                                <thead>
                                    <tr><th>Date</th><th>Get Info</th></tr>
                                  
                                </thead>
                                <tbody id="new_donation_list"></tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="row" id="print_area">

                            <table class="table table-borderless" style="border: none;">
                                <tr style="width: 100%;border: none;">
                                    <td style="width: 33.33%;border: none;">
                                        <img src="../../asset/images/logos/wintrylogo.png" class="img-fluid" style="width: 152px; height: 57px; display: block;">
                                    </td>
                                    <td  style="width: 33.33%;border: none;">
                                        <h3 style="text-align: center;">DONATION</h3>    
                                    </td>
                                    <td  style="width: 33.33%;border: none;">
                                        <b>Manufacturers Of Automobile Industrial & Household Chemicals</b>
                                        No 20, River View Park, Nelundeniya Road, Wariyagoda, Alawwa
                                        <br>Alawwa 60280
                                        Sri Lanka
                                    </td>
                                </tr>
                            </table>
               
                            <hr>
                         
                            <div class="col-md-12"><hr>
                                <div id='donation_details'></div>
                            </div>
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
                        <div class='col-md-12' ><hr></div>

                        <div class='row'>
                                <div class='col-md-6 print_option' style="display: none;"> 
                                    <button class='btn btn-block btn-primary complete_with_a_print' data-id="">GET A PRINT OUT</button>
                                </div>

                                <div class='col-md-6 print_option' style="display: none;">
                                    <button class='btn btn-block btn-primary complete_without_a_print' data-id="">COMPLETE DONATION</button>
                                </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
  

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

        
        <div class="modal" id="complete_modal" data-keyboard="false" data-backdrop="static" >
            <div class="modal-dialog modal-dialog-centered modal-sm" >
                <div class="modal-content">
                
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class='col-md-12'>
                                <div style="text-align: center;">

                                      <img src="../../asset/images/imoji/imoji1.gif" class="img-fluid" style="height: 70px;width: 70px;"><hr>  
                                      <button class="btn btn-success" data-dismiss="modal" aria-label="Close">OKAY..!</button>
                               
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>   
        </div> 
        
        <iframe id="print_iframe" style="height: 0px;"></iframe>  

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

        <!-- This modal use to get items Map List -->
        <div class="modal" id="items_list_modal" data-keyboard="false" data-backdrop="static">
                <div class="modal-dialog modal-dialog-centered modal-lg"  style="width: 100%;">
                    <div class="modal-content">
                    
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                    
                        <!-- Modal body -->
                        <div class="modal-body">
                            <div class="col-md-12">
                            <div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <input class="form-control" id="items_list" type="text" placeholder="Search..">
                                            <table class="table table-bordered">
                                                <tr>
                                                    <td>Item Name</td>
                                                    <td>Item Code</td>
                                                    <td>R-price</td>
                                                    <td>W-Price</td>
                                                    <td>RB-Price</td>
                                                    <td>WB-Price</td>
                                                    <td>Discount</td>
                                                </tr>
                                                <tbody id="list_table_items"></tbody>
                                            </table>
                                        </div>
                                        <div class="col-md-3">
                                            <table class="table table-bordered">
                                                <tr>
                                                    <td>Designation And Rate</td>
                                                </tr>
                                                <tbody id="discount_list"></tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            </div>    
                        </div>
                    </div>
                </div>
        </div>  
        <!-- This modal use to get items List -->
    
<?php include_once("../footer.php"); ?>

<script src="../../functions/users/donation.js"></script>
<script src="../../functions/admin_and_user_public.js"></script>

<!-- Disabled Auto Complete -->
<script>
    $(".form-control").attr("autocomplete", "off");
</script>

</body>

</html>