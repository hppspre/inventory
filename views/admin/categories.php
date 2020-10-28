<?php include_once("../header.php"); ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">


        <div class='card'>
            <div class='card-body'>
                <div class="col-md-12">
                    <div class="row">

                        <div class="col-md-12">
                            <div id="cat_error_msg" style="display: none;"></div>
                        </div>

                        <div class="col-md-4">

                                <div class="col-md-12">
                                    <lable class="small" style="font-size: 0%;">.</lable>
                                    <input class="form-control form-control-sm" id="new_categories" type="text" placeholder="Add a New Categorie....">
                                </div>

                                <div class="col-md-12">
                                    <lable class="small" style="font-size: 0%;">.</lable>
                                    <button class="btn btn-primary  btn-block" id="add_new_categories_btn">Add this Category</button>
                                </div>

                        </div>  

                        <div class="col-md-8" style="height: 500px; overflow-y: auto;">
                                <lable class="small" style="font-size: 0%;">.</lable>
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Category Name</th>
                                        <th>Edit</th>
                                        
                                    </tr>
                                    </thead>
                                    <tbody id="category_names_list"></tbody>
                                </table>
                           
                        </div>
                        

                    </div>
                </div>
                
            </div>
        </div>    


            
    </div>    

<?php include_once("../footer.php"); ?>


<script src="../../functions/admin/categories.js"></script>
<!-- Disabled Auto Complete -->
<script>
    $(".form-control").attr("autocomplete", "off");
</script>
</body>

</html>