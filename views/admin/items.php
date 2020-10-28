<?php include_once("../header.php"); ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <div class="card">
            <div class="card-body">

            <div class="row">    
                        <div class="col-md-12">
                            <div id="item_error_msg" style="display: none;"></div>
                        </div>


                        <div class="col-md-4">

                                <div class="col-md-12">
                                    <lable class="small" style="font-size: 0%;">.</lable>
                                    <select class="form-control form-control-sm new_item_category"></select>
                                </div>
                                <div class="col-md-12">
                                    <lable class="small" style="font-size: 0%;">.</lable>
                                    <input class="form-control form-control-sm" id="new_item" type="text" placeholder="Add Item Name">
                                </div>
                                <div class="col-md-12">
                                    <lable class="small" style="font-size: 0%;">.</lable>
                                    <input class="form-control form-control-sm" id="new_item_code" type="text" placeholder="Add Item Code">
                                </div>

                                <div class="col-md-12">
                                    <br>
                                    <div class="row">
                                        <div class='col-md-6'>
                                            <label class="form-check-label">Item</label>
                                            <input type="checkbox" class="form-control new_item_type" value="item" id="new_normal_item">
                                        </div>
                                     
                                        <div class='col-md-6'>
                                            <label class="form-check-label">Empty Item</label>
                                            <input type="checkbox" class="form-control new_item_type" value="eitem" id="new_empty_item">
                                        </div>
                                    </div>
                                </div>
                               
                                <div class="col-md-12">
                                    <lable class="small" style="font-size: 0%;">.</lable>
                                    <button class="btn btn-primary  btn-block" id="add_new_item_btn">Add this Item</button>
                                </div>

                        </div> 
                        <div class="col-md-8">
                                <lable class="small" style="font-size: 0%;">.</lable>
                                <input class="form-control" id="Items_input" type="text" placeholder="Search..">
                                <div class="tableFixHead">
                                <lable class="small" style="font-size: 0%;">.</lable>
                                    <table class=' table table-bordered table-sm'>
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Status</th>
                                                <th>Type</th>
                                                <th>Discount</th>
                                                <th>Edit</th>
                                                <th>Drop</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table_items_list"></tbody>
                                    </table>
                            </div>
                        </div>
                </div> 
            </div>
        </div>
    </div>    

    <!-- The Modal for change discount -->
    <div class="modal dis_manage" data-keyboard="false" data-backdrop="static" >
        <div class="modal-dialog modal-dialog-centered modal-lg" >
            <div class="modal-content">
            
                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                
                <div id="dis_id_of_item" data-id=""></div>
                <div id="dis_id_of_item_loader" data-id="">
                    <div class="container-fluid">

                        <div id="dis_chnger_error"></div>
                            <table class="table table-sm table-bordered">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Discount [%]</th>
                                        <th>Change</th>
                                    </tr>
                                </thead>
                                <tbody id="discount_list"></tbody>
                            </table>
                        
                       
                    </div>
                </div>
                
                <!-- Modal body -->
                <div class="modal-body" id="dis_id_of_item_content" style="display: none;"></div>
            </div>
        </div>
    </div>            
                        

    <!-- The Modal for change item -->
    <div class="modal item_manage" data-keyboard="false" data-backdrop="static" >
            <div class="modal-dialog modal-dialog-centered modal-lg" >
                <div class="modal-content">
                
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    
                    <div id="of_item" data-id=""></div>
                    
                    <!-- Modal body -->
                    <div class="modal-body">
                            <!-- Status Manage -->
                            <div class='col=md-12' id="item_change_loading_content" style="text-align: center;">
                                <img src="../../asset/images/icon8/search.gif" class="img-fluid">    
                            </div>
                            <div class='col=md-12' id="item_change_content" style="display: none;">

                                <div class='row'>

                                    <div class='col-md-12'>
                                        <img src="../../asset/images/other/category.png" class="img-fluid" style="width: 35px; height: 35px;">
                                        <label class="form-check-label">*Handle Related Category In Below</label> 
                                    </div>
                                    <div class='col-md-12'><hr></div>
                                    <div class='col-md-6'>
                                        <label class="form-check-label">Item</label>
                                        <input type="checkbox" class="form-control change_item_type" id="c_item" value="item">
                                    </div>
                                   
                                    <div class='col-md-6'>
                                        <label class="form-check-label">Empty</label>
                                        <input type="checkbox" class="form-control change_item_type" id="c_eitem" value="eitem">
                                    </div>

                                    <div class='col-md-12'><hr></div>

                                    <div class='col-md-12'>
                                        <img src="../../asset/images/icon8/down-arrow.gif" class="img-fluid" style="width: 35px; height: 35px;">
                                        <label class="form-check-label">*Handle basic information below</label>
                                    </div>

                                    <div class='col-md-6'>
                                        <label class="form-check-label">Active</label>
                                        <input type="checkbox" class="form-control change_item_activater" id="change_active" value="active">
                                        
                                    </div>
                                    <div class='col-md-6'>
                                            <label class="form-check-label">Deactive</label>
                                            <input type="checkbox" class="form-control change_item_activater" id="change_deactive" value="deactive">
                                    </div>
                                    <div class='col-md-4'>
                                        <label class="form-check-label">Item Name</label>
                                        <input type="text" class="form-control" id="chng_item_name">
                                    </div>
                                    <div class='col-md-4'>
                                        <label class="form-check-label">Item Code</label>
                                        <input type="text" class="form-control" id="chng_item_code">
                                    </div>
                                    <div class='col-md-4'>
                                        <lable class="small">Select Category</lable>
                                        <select class="form-control new_item_category" id="chng_item_category"></select>
                                    </div>    

                                    <div class='col-md-12' style="text-align: center;">
                                        <hr>
                                        <div id="item_change_error"></div>
                                    </div>

                                    <div class='col-md-6'>
                                        <label class="form-check-label">Reorder Level[L]</label>
                                        <input type="number" class="form-control" id="reorder_level">
                                    </div>
                                    <div class='col-md-6'>
                                        <label class="form-check-label">Remake level[UNIT]</label>
                                        <input type="number" class="form-control" id="remake_level">
                                    </div>
                                    <div class='col-md-4'>
                                        <label class="form-check-label">Cost for Unit</label>
                                        <input type="number" class="form-control" id="chng_item_cost">
                                    </div>
                                    <div class='col-md-4'>
                                        <label class="form-check-label">Retails Price</label>
                                        <input type="number" class="form-control" id="chng_item_retails_price">
                                    </div>
                                    <div class='col-md-4'>
                                        <label class="form-check-label">Whole Sales Price</label>
                                        <input type="number" class="form-control" id="whole_sales_price">
                                    </div>

                                    <div class='col-md-4'>
                                        <label class="form-check-label">Bulk Cost-1L</label>
                                        <input type="number" class="form-control" id="chng_item_bulk_cost">
                                    </div>
                                    
                                   
                                    <div class='col-md-4'>
                                        <label class="form-check-label">Bulk Retail Price For One leter</label>
                                        <input type="number" class="form-control" id="bulk_sales_price">
                                    </div>

                                    <div class='col-md-4'>
                                        <label class="form-check-label">Bulk whole Price For One leter</label>
                                        <input type="number" class="form-control" id="bulk_sales_price_whole">
                                    </div>

                                    <div class='col-md-12'><hr></div>
                                    <div class='col-md-4'>
                                        <label class="form-check-label">*Need A Empty</label>
                                        <input type="checkbox" class="form-control" id="need_empty_chker">
                                    </div>

                                    <div class='col-md-8'>
                                        <label class="form-check-label">Select a Empty</label>
                                        <select type="number" class="form-control" id="empty_selection"></select>
                                    </div>

                                    <div class='col-md-4'>
                                        <label class="form-check-label">*Need Free Issue</label>
                                        <input type="checkbox" class="form-control" id="free_chker" value="yes">
                                    </div>
                                    <div class='col-md-4'>
                                        <label class="form-check-label">What is the limit of free issue?</label>
                                        <input type="number" class="form-control" id="free_limit">
                                    </div>
                                    <div class='col-md-4'>
                                        <label class="form-check-label">What is the quantity of the free issue?</label>
                                        <input type="number" class="form-control" id="free_qty">
                                    </div>

                                    <div class='col-md-12'><hr></div>

                                    <div class='col-md-12'>
                                        <a href="#" class="btn btn-primary  btn-icon-split btn-block" id="change_item">
                                            <span class="icon text-white-50"><i class="fas fa-check"></i>
                                            </span>
                                            <span class="text" style="color: white;">Save Changes</span>
                                        </span></a>
                                    </div>
                                    
                                </div>
                            </div>
                            <!-- Status Manage -->
                    </div>

                </div>
            </div> 
</div>           

<?php include_once("../footer.php"); ?>

<script src="../../functions/admin/add_item.js"></script>
<!-- Disabled Auto Complete -->
<script>
    $(".form-control").attr("autocomplete", "off");
</script>
</body>

</html>