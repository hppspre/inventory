<?php include_once("../header.php"); ?>

        
        <!-- Begin Page Content -->
        <div class="afterloader container-fluid">
        
                <div class='col-md-12'>
                        <input class="form-control" id="find_items" type="text" placeholder="Search..">
                        <hr>

                        <table class='table table-bordered table-sm'>
                                <tr>
                                    <td>Good level</td>
                                    <td class="table-secondary">Reorder Level</td>
                                    <td class="table-warning">Remake level</td>
                                    <td class="table-danger">Reorder and remake level</td>
                                </tr>
                        </table>        
                        <table class="table table-bordered">
                                <thead>
                                        <tr>
                                             <td>Item Name</td>   
                                             <td>Item Code</td>   
                                             <td>Type</td>   
                                             <td>Reorder Level</td>   
                                             <td>Remake Level</td>
                                             <td>Unit Quantity</td>   
                                             <td>Quantity-[ML]</td>
                                        </tr>
                                </thead>
                                <tbody id='list_item_status'></tbody>
                        </table>        
                </div>
        </div>
        <!-- /.container-fluid -->

          <!-- The Modal for change_quantities -->
          <div class="modal" id="change_leters_qty" data-keyboard="false" data-backdrop="static" >
                <div class="modal-dialog modal-dialog-centered modal-lg" >
                        <div class="modal-content">
                        
                                <!-- Modal Header -->
                                <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        
                                </div>
                                
                                <!-- Modal body -->
                                <div class="modal-body">
                                        <div id="leater_qty_chng_error"></div>

                                        <input type="hidden" id="id_of_leters_item">
                                        <input type='hidden' id="item_change_leter_cost">
                                        <div class="col-md-12">
                                                <div class="row">
                                                        <div class="col-md-12">
                                                            <a href="https://www.unitconverters.net/volume/l-to-ml.htm" target="_blank"><lable class="small">Online Converter-></lable> </a>
                                                        </div>
                                                        <div class="col-md-4">
                                                                <lable class="small">Options</lable>
                                                                <select class="form-control form-control-sm" id="item_change_leater_status">
                                                                        <option value='1'>ADD</option>
                                                                        <option value='2'>REMOVE</option>
                                                                        <option value='3'>REMOVE-DAMAGED</option>
                                                                </select>
                                                        </div>

                                                        <div class="col-md-8">
                                                                <lable class="small">Milliliters</lable>
                                                                <input type='number' data-placeholder="" class="form-control form-control-sm" id="item_leater_qty">
                                                        </div>
                                                        
                                                        <div class="col-md-12">
                                                                <hr>
                                                                <button class="btn btn-block btn-primary save_changed_leater_qty">Change</button>
                                                        </div>
                                                </div>
                                        </div>   
                                </div>
                        </div>
                </div>
        </div> 

        <!-- The Modal for change_quantities -->
        <div class="modal" id="change_qty" data-keyboard="false" data-backdrop="static" >
                <div class="modal-dialog modal-dialog-centered modal-lg" >
                        <div class="modal-content">
                        
                                <!-- Modal Header -->
                                <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        
                                </div>
                                
                                <!-- Modal body -->
                                <div class="modal-body">
                                        <div id="qty_chng_error"></div>

                                        <input type="hidden" id="id_of_item">
                                        <input type='hidden' id="item_change_cost">
                                        <div class="col-md-12">
                                                <div class="row">

                                                        <div class="col-md-4">
                                                                <select class="form-control form-control-sm" id="item_change_status">
                                                                        <option value='1'>ADD</option>
                                                                        <option value='2'>REMOVE</option>
                                                                        <option value='3'>REMOVE-DAMAGED</option>
                                                                </select>
                                                        </div>
                                                        <div class="col-md-8">
                                                                <input type='number' data-placeholder="" class="form-control form-control-sm" id="item_qty">
                                                        </div>
                                                        
                                                        <div class="col-md-12">
                                                                <hr>
                                                                <button class="btn btn-block btn-primary save_changed_qty">Change</button>
                                                        </div>
                                                </div>
                                        </div>
                                        
                                       
                                        
                                </div>
                        </div>
                </div>
        </div>             


<?php include_once("../footer.php"); ?>
<script src="../../functions/admin/item_status/item_status.js"></script>

        <!-- Disabled Auto Complete -->
        <script>
                $(".form-control").attr("autocomplete", "off");
        </script>
    </body>
</html>