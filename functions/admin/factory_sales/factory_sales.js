$(document).ready(function(){

    $(document).on("click","#new_factory_sales",function(){

         $("#new_customer_list_error").html("");
         $("#new_cutomer").modal("show");
            
    });

    function load_existing_customer() {
      
        // load cutomers list
        $.ajax({

            type:"POST",
            url:"../../back_function/admin/factory_sales/factory_sales_function.php",
            data:{"load_customers":""},
            cache:false,
            success:function(data)
            {
                data=JSON.parse(data);
                $("#fs_customers_list").html("");

                for(var i=0;i<data.length;i++)
                {
                    $("#fs_customers_list").append("<option value="+data[i]["id"]+" data-discount_offers="+data[i]["special_offers"]+" data-discount_rate="+data[i]["discount_satatus"]+" data-phone="+data[i]["customer_phone"]+" data-address="+data[i]["customer_address"]+" data-name="+data[i]["customer_name"]+">"+data[i]["customer_name"]+"</option>");
                }    

            
            },error:function(error)
            {
                console.log(error);
            }
        });
    }


    // -----Loading_customer----------------------------------------------------------------------------------------------------------
    load_existing_customer();
    // -----Loading_customer----------------------------------------------------------------------------------------------------------


    $(document).on("click",".add_this_customer_btn",function(){

        $("#new_customer_list_error").css("display","none");
        if($("#new_customer_name").val()=="" || $("#new_customer_address").val()=="" || $("#new_customer_phone").val()=="" || $("#new_customer_discount").val()=="" || $("#new_customer_special_offers").val()=="")
        {
            $("#new_customer_list_error").css("display","block");
            $("#new_customer_list_error").html("<img src='../../asset/images/imoji/angry.gif' class='img-fluid' style='width:50px;height:50px;'><small>&nbsp;Details Need.!</small><hr>");  
        }
        else
        {

            $('.btn').prop("disabled",true);

            var customer_detail=new Array();
            customer_detail[0]=$("#new_customer_name").val();
            customer_detail[1]=$("#new_customer_address").val();
            customer_detail[2]=$("#new_customer_phone").val();
            customer_detail[3]=$("#new_customer_discount").val();
            customer_detail[4]=$("#new_customer_special_offers").val();


            $.ajax({
                type:"POST",
                url:"../../back_function/admin/factory_sales/factory_sales_function.php",
                data:{"customer_details":JSON.stringify(customer_detail)},
                cache:false,
                success:function(data)
                {
                    $('.btn').prop("disabled",false);

                    if(data=="ok")
                    {
                        $("#new_customer_list_error").css("display","block");
                        $("#new_customer_list_error").html("&nbsp;&nbsp;<img src='../../asset/images/imoji/imoji1.gif' class='img-fluid' style='width:50px;height:50px;'><small>&nbsp;</small><hr>");  
                        
                        $(".values_fs").val("");
                        load_existing_customer();
                    }
                    else if(data=="already")
                    {
                        $("#new_customer_list_error").css("display","block");
                        $("#new_customer_list_error").html("&nbsp;&nbsp;<img src='../../asset/images/imoji/tenor.gif' class='img-fluid' style='width:50px;height:50px;'><small>&nbsp;Already Exits.!</small><hr>");  
                    }

                },error:function(error)
                {
                    $('.btn').prop("disabled",false);
                    console.log(error);
                }
            });
        }
    });


    $(document).on("click",".customer_droper",function(){

        $(".btn").prop("disabled",true);
        var id=$("#fs_customers_list").val();

        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this Action!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel plx!",
            closeOnConfirm: false,
            closeOnCancel: false
          },
          function(isConfirm) {
            if (isConfirm) {

              
              $.ajax({
                type:"POST",
                url:"../../back_function/admin/factory_sales/factory_sales_function.php",
                data:{"fs_customer":id},
                cache:false,
                success:function(data)
                {
                    
                    swal("Deleted!", "Your action has been completed.", "success");
                    $(".btn").prop("disabled",false);
                    load_existing_customer();

                },error:function(error)
                {
                    console.log(error);
                    $(".btn").prop("disabled",false);

                }
              });
              
            } else {

              swal("Cancelled", "safe :)", "error");
              $(".btn").prop("disabled",false);

            }

          });

    });


    $(document).on("click","#save_changed_customer_data",function(){

        $("#change_customer_error").html("");

        if($("#edit_customer_name").val()=="" || $("#edit_customer_address").val()=="" || $("#edit_phone_number").val()=="" || $("#edit_discount_rate").val()=="" || $("#edit_special").val()=="" || $("#fs_customers_list").val()=="" || $("#fs_customers_list").val()==undefined || $("#fs_customers_list").val()==null)
        {
            $("#change_customer_error").html("");
            $("#change_customer_error").html("<img src='../../asset/images/imoji/angry.gif' class='img-fluid' style='width:50px;height:50px;'><small>&nbsp;Details Need.!</small><hr>");  
        }
        else
        {
            var chnged_info=new Array();

            chnged_info[0]=$("#edit_customer_name").val();
            chnged_info[1]=$("#edit_customer_address").val();
            chnged_info[2]=$("#edit_phone_number").val();
            chnged_info[3]=$("#edit_discount_rate").val();
            chnged_info[4]=$("#edit_special").val();

            $(".btn").prop("disabled",true);
            $.ajax({
                type:"POST",
                url:"../../back_function/admin/factory_sales/factory_sales_function.php",
                data:{"save_customer_details":JSON.stringify(chnged_info),"id":$("#fs_customers_list").val()},
                cache:false,
                success:function(data)
                {
                    $(".btn").prop("disabled",false);

                    if(data=="done")
                    {
                        $(".edit_fsc").val("");
                        $(".btn").prop("disabled",false);
                        load_existing_customer();
                        $("#change_customer_error").html("");
                        $("#change_customer_error").html("<img src='../../asset/images/imoji/imoji1.gif' class='img-fluid' style='width:50px;height:50px;'><small>&nbsp;Details Changed.!</small><hr>");  
                    }
                },error:function(error)
                {
                    $(".btn").prop("disabled",false);
                    console.log(error);
                }
            });
        }
    });


    // -----------------Get Return Details--------------------------------------
    function load_returned_data()
    {
        $("#loader_factory_sales").modal("show");

        $.ajax({
            type:"POST",
            url:"../../back_function/admin/factory_sales/factory_sales_function.php",
            data:{"load_returned_data":$(".date_selecter").val()},
            cache:false,
            success:function(data)
            {
                data=JSON.parse(data);
                console.log(data);
                var content="";
                var repaid_amount=0;

                for(var i=0;i<data.length;i++)
                {
                    content+="<tr>";

                        content+="<td>"+data[i]["invoice_id"]+"</td>";
                        content+="<td>"+data[i]["date_returned"]+"</td>";
                        content+="<td>"+data[i]["repaid_amount"]+"</td>";

                        if(data[i]["returned_status"]=="ok")
                        {
                            content+="<td><button class='btn btn-light btn-block'>Checked</button></td>";
                        }
                        else
                        {
                            content+="<td><button class='btn btn-primary btn-block make_check' data-id="+data[i]["id"]+">Not Check</button></td>";
                        }

                    content+="<td><button class='btn btn-success returned_info btn-block' data-item_info="+data[i]["returned_description"]+">Info</button></td>";
                    
                    content+="</tr>";
                    
                    repaid_amount+=(parseInt(data[i]["repaid_amount"]));
                }

                if(repaid_amount==0)
                {
                    $("#total_repaid_sum").text(0);
                }
                else
                {
                    $("#total_repaid_sum").text(repaid_amount);
                }

                $("#sales_returned_content").html("");
                $("#sales_returned_content").html(content);
                $("#loader_factory_sales").modal("hide");

            },error:function(error)
            {
                console.log(error);
                $("#loader_factory_sales").modal("hide");
            }
        }); 
    }
    // -----------------Get Return Details-------------------------------------------
    

    // -----------------Load Factory sales-------------------------------------------
    function load_order_details()
    {
        $("#loader_factory_sales").modal("show");

        $.ajax({
            type:"POST",
            url:"../../back_function/admin/factory_sales/factory_sales_function.php",
            data:{"get_factory_sales_details":$(".date_selecter").val()},
            cache:false,
            success:function(data)
            {
                $("#sales_content").html("");
                data=JSON.parse(data);

                var customer_details=new Array()
                var price=0;

                for(var i=0;i<data.length;i++)
                {   $("#sales_content").append("<tr>");

                    customer_details=[];
                    customer_details=JSON.parse(data[i]["order_prices_description"]);
             
                    $("#sales_content").append("<td>"+data[i]["id"]+"</td>");
                    $("#sales_content").append("<td>"+customer_details[1]+"</td>");
                    $("#sales_content").append("<td>"+customer_details[2]+"</td>");
                    $("#sales_content").append("<td>"+customer_details[3]+"</td>");
                    $("#sales_content").append("<td>"+customer_details[7]+"</td>");
                    $("#sales_content").append("<td>"+customer_details[8]+"</td>");
                    $("#sales_content").append("<td>"+customer_details[9]+"</td>");
                    $("#sales_content").append("<td>"+customer_details[10]+"</td>");
                    $("#sales_content").append("<td>"+data[i]["ordered_by"]+"</td>");
                    $("#sales_content").append("<td><button class='btn btn-success sales_details' data-items_data='"+data[i]["order_description"]+"' data-id='"+data[i]["id"]+"'>Info</td>");
                    $("#sales_content").append("</tr>");

                    price+=(parseInt(customer_details[10]));
                    $("#total_sum").text(price);
                }

                $("#loader_factory_sales").modal("hide");
                load_returned_data();

            },error:function(error)
            {
                $("#loader_factory_sales").modal("hide");
                console.log(error);
            }
        });
        $("#loader_factory_sales").modal("hide");
    }
    
    load_order_details();


    // -----------------Load Factory sales---------------------
    $(document).on("change",".date_selecter",function(){
        $("#loader_factory_sales").modal("show");
        load_order_details();
    });


    // ----------------Get Items info--------------------------
    $(document).on("click",".sales_details",function(){

        var data=JSON.parse($(this).attr("data-items_data"));

        $("#loader_factory_sales").modal("show");

        var content="";
        for(var i=0;i<data.length;i++)
        {
            content+="<tr>";
                content+="<td>"+data[i]["item_name"]+"</td>";
                if(data[i]["type"]=="item")
                {
                    content+="<td>Item</td>";
                }
                else
                {
                    content+="<td>Empty</td>";
                }

                if(data[i]["methode"]=="unit")
                {
                    content+="<td>Unit</td>";
                    content+="<td>"+data[i]["unit_selected_qty"]+"</td>";
                    content+="<td>"+(parseInt(data[i]["unit_price"]))+"</td>";
                    content+="<td>"+((parseInt(data[i]["unit_selected_qty"]))*(parseInt(data[i]["unit_price"])))+"</td>";

                }
                else
                {
                    content+="<td>Bulk</td>";
                    content+="<td>"+(parseInt(data[i]["bulk_selected_qty"]))+"-ML</td>";
                    content+="<td>"+(parseInt(data[i]["bulk_price"]))+"-L</td>";
                    content+="<td>"+((parseInt(data[i]["bulk_selected_qty"]))*((parseInt(data[i]["bulk_price"]))/1000))+"</td>";
                }

            content+="</tr>";
        }
        $("#factory_sales_info_table").html("");
        $("#factory_sales_info_table").html(content);
        $("#loader_factory_sales").modal("hide");
        $("#factory_sales_info").modal("show");
    });

    //-----------------Get returned data-----------------------
    $(document).on("click",".returned_info",function(){

        var data=JSON.parse($(this).attr("data-item_info"));
        $("#returned_sales_info").modal("show");
        $("#returned_sales_info_table").html("");

        // --------------------Maked Returned table--------------------
        for(var i=0;i<data.length;i++)
        {
            $("#returned_sales_info_table").append("<tr>");
            $("#returned_sales_info_table").append("<td>"+data[i]["item_name"]+"</td>");

            if(data[i]["item_method"]=="bulk")
            {
                $("#returned_sales_info_table").append("<td>Bulk</td>");
                $("#returned_sales_info_table").append("<td>"+data[i]["returned_qty"]+"-ML</td>");
                $("#returned_sales_info_table").append("<td>"+parseInt(data[i]["returned_price"])+"</td>");
            }
            else
            {
                $("#returned_sales_info_table").append("<td>Unit</td>");
                $("#returned_sales_info_table").append("<td>"+data[i]["returned_qty"]+"</td>");
                $("#returned_sales_info_table").append("<td>"+parseInt(data[i]["returned_price"])+"</td>");
            }

            $("#returned_sales_info_table").append("</tr>");
        }
    });
    //-----------------Get returned data-----------------------

    //-----------------Make Check------------------------------
    $(document).on("click",".make_check",function(){

        $("#loader_factory_sales").modal("show");
        var id=$(this).attr("data-id");

        $.ajax({
            type:"POST",
            url:"../../back_function/admin/factory_sales/factory_sales_function.php",
            data:{"returned_id":id},
            cache:false,
            success:function(data)
            {
                $("#loader_factory_sales").modal("hide");
                load_returned_data();

            },error:function(error)
            {
                $("#loader_factory_sales").modal("hide");
                console.log(error);
            }
        });

    });
    


    

    // ---------------Get Items info end-----------------------
    $(document).on("change","#fs_customers_list",function(){
        $(".edit_fsc").val("");
    });

    //------------------btn edit customer details-------------------------------
    $(document).on("click",".customer_editer",function(){

        var id=$("#fs_customers_list").val();
        var name=$("#fs_customers_list").find(':selected').attr('data-name');
        var address=$("#fs_customers_list").find(':selected').attr('data-address');
        var phone=$("#fs_customers_list").find(':selected').attr('data-phone');
        var discount=$("#fs_customers_list").find(':selected').attr('data-discount_rate');
        var special_offer=$("#fs_customers_list").find(':selected').attr('data-discount_offers');

        $("#change_customer_error").html("");

        $("#edit_customer_name").val(name);
        $("#edit_customer_address").val(address);
        $("#edit_phone_number").val(phone);
        $("#edit_discount_rate").val(discount);
        $("#edit_special").val(special_offer);

        // ------------------------------------------------------------------------------------------------------------------
    });

    //------------------------Search returned Items----------------------------------------------------------------------

    $("#return_item_finder").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#sales_returned_content tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });    

});