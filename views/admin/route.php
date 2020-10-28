<?php include_once("../header.php"); ?>

        <!-- Begin Page Content -->
        <div class="afterloader container-fluid">

            <div class="col-md-12">
                <div class="row">
                    <div class='col-md-12'>
                        <div id="error_of_route"></div>
                    </div>
                    
                    <div class='col-md-4'>
                        <div class="form-group">
                                <label for="usr">Rout Discription:</label>
                                <input type="text" class="form-control" id="rout_description">
                                <label for="usr">Genaral No.KM:</label>
                                <input type="number" class="form-control" id="genaral_km">
                                <hr>
                                <button class="btn btn-block btn-primary rout_saver">Save</button>
                        </div>
                    </div>
                    <div class='col-md-8'>
                        <label for="usr">:</label>
                        <table class='table table-bordered table-sm'>
                            <thead>
                                <tr>
                                    <td>Description</td>
                                    <td>NO. KM</td>
                                    <td>Edit</td>
                                </tr>
                            </thead>
                            <tbody id='route_lister'></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->


        <!-- The Modal for change item -->
        <div class="modal" id="chng_routs" data-keyboard="false" data-backdrop="static" >
            <div class="modal-dialog modal-dialog-centered modal-lg" >
                <div class="modal-content">
                
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    
                
                    
                    <!-- Modal body -->
                    <div class="modal-body">

                        <div class="col-md-12">
                            <div class="row">
                                <div class='col-md-12'>
                                    <div id="change_error_of_route"></div>
                                </div>
                                
                                <div class='col-md-12'>
                                    <div class="form-group">
                                            <label for="usr">Change Rout Discription:</label>
                                            <input type="text" class="form-control" id="change_rout_description">
                                            <label for="usr">Change Genaral No.KM:</label>
                                            <input type="number" class="form-control" id="change_genaral_km">
                                            <hr>
                                            <button class="btn btn-block btn-primary rout_changer" data-id="">Save</button>
                                    </div>
                                </div>
                         
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>            

<?php include_once("../footer.php"); ?>
<script src="../../functions/admin/routs/rout.js"></script>
