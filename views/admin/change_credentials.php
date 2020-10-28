<?php include_once("../header.php"); ?>

        <!-- Begin Page Content -->
        <div class="container-fluid d-flex h-100">
            <div class="col-md-12">
                <div class="row justify-content-center align-self-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-header">
                                    
                                    <div class='col-md-12'>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div id="error_msg_chng_credentials" style="display: none;"></div>
                                            </div>
                                                
                                            <div class="col-md-12">
                                                <label>New user Name</label>
                                                <input type="text" class="form-control" id="user_name">     
                                            </div>
                                            <div class="col-md-6">
                                                <label>Privious Password</label>
                                                <input type="password" class="form-control" id="previous_password">  
                                            </div>
                                            <div class="col-md-6">
                                                <label>New Password</label>
                                                <input type="password" class="form-control" id="new_password">  
                                            </div>
                                            <div class="col-md-12">
                                                <hr>
                                                <button type="button" class="btn btn-primary btn-block" id="chnge_credentials">Change my Credentials</button>   
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
                                             
        </div>


<?php include_once("../footer.php"); ?>
<script src="../../functions/admin/chg_credentials.js"></script>

<!-- Disabled Auto Complete -->
<script>
    $(".form-control").attr("autocomplete", "off");
</script>
</body>

</html>