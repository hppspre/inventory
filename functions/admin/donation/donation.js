$(document).ready(function(){

    function reseter()
    {
        load_items_for_donation();
        selected_items=[];
        id_of_array="";
        $("#donte_items").html("");
    }

    function load_donation_list()
    {
        $("#loader_donation").modal("show");

        $.ajax({
            type:"post",
            url:"../../back_function/admin/donations/donation_function.php",
            data:{"load_donation":""},
            cache:false,
            success:function(data)
            {
                $("#loader_donation").modal("hide");
                data=JSON.parse(data);
 
                $("#nonated_lister").html("");
                var content="";
                for(var i=0;i<data.length;i++)
                {

                    content+="<tr>"; 
                        content+="<td>"+data[i]["customer_name"]+"</td>"; 
                        content+="<td>"+data[i]["customer_address"]+"</td>"; 
                        content+="<td>"+data[i]["customer_phone"]+"</td>"; 
                        content+="<td>"+data[i]["donatedby"]+"</td>"; 
                        content+="<td>"+data[i]["date_make_donation"]+"</td>"; 

                        if(data[i]["status"]=="pending")
                        {
                            content+="<td>"+data[i]["status"]+"<button class='btn btn-block btn-danger drop_donation' data-id="+data[i]["id"]+">Cancell</button></td>"; 
                        }
                        else if(data[i]["status"]=="ok")
                        {
                            content+="<td>COMPLETED</td>"; 
                        }

                        content+="<td>"+data[i]["completedby"]+"</td>"; 
                        
                        if(data[i]["date_complete_donation"]==null)
                        {
                            content+="<td>NOT_YET</td>"; 

                        }
                        else
                        {
                            content+="<td>"+data[i]["date_complete_donation"]+"</td>"; 

                        }
                        content+="<td><button class='btn btn-block btn-success info' data-id="+data[i]["id"]+">Info</button></td>"; 

                    content+="</tr>"; 
                }

                //Make Content------------------
                $("#nonated_lister").html(content);

            },error:function(error)
            {
                $("#loader_donation").modal("hide");
                console.log(error);
            }
        });
    }

    load_donation_list();

    $("#loader_donation").modal("show");

    function load_customers()
    {
        $("#loader_donation").modal("show");

        $.ajax({
            type:"POST",
            url:"../../back_function/admin/donations/donation_function.php",
            data:{"load_customers":""},
            cache:false,
            success:function(data_customer)
            {
                data_customer=JSON.parse(data_customer);
                $("#list_of_customers").html("");
                for(var i=0;i<data_customer.length;i++)
                {
                    $("#list_of_customers").append("<option value="+data_customer[i]["id"]+">"+data_customer[i]["customer_name"]+"</option>");  
                }

                $("#loader_donation").modal("hide");

            },error:function(error)
            {
                console.log(error);
                $("#loader_donation").modal("hide");

            }

        });
    }

    function load_items_for_donation()
    {
        $.ajax({
            type:"POST",
            url:"../../back_function/admin/donations/donation_function.php",
            data:{"load_items":""},
            cache:false,
            success:function(data)
            {
                data=JSON.parse(data);
                
                console.log(data);
                // Make Content
                var content="";
                var classes_list=new Array("bg-success","bg-primary","bg-warning","bg-dark");
                var counter=0;
                for(var i=0;i<data.length;i++)
                {
                    content+="<tr style='cursor:crosshair;' class='select_donation_item' id='item_no"+i+"' data-qty="+data[i]["qty"]+" data-bulk_qty="+data[i]["leters_quantity"]+"  data-bulk_cost="+data[i]["bulk_price"]+" data-item_type="+data[i]["item_type"]+" data-qty="+data[i]["qty"]+" data_cost="+data[i]["items_retails_price"]+"  data_item_id="+data[i]["id"]+" data_object-id="+i+" data-item_name="+data[i]["items_name"]+">";
                    content+="<td>";
                    content+="<div class='icon-circle "+classes_list[counter]+"'><span class='badge badge-light'>"+data[i]["qty"]+"</span></div></td>";
                    
                    if(data[i]["item_type"]=="item")
                    {
                        content+="<td><div class='icon-circle "+classes_list[counter]+"'><span class='badge badge-light'>"+data[i]["leters_quantity"]+"</span></div></td>";
                    }
                    else
                    {
                        content+="<td><div class='icon-circle "+classes_list[counter]+"'><span class='badge badge-light'>EMPTY</span></div></td>";
                    }

                    content+="<td><div class='icon-circle'>"+data[i]["items_name"]+"<br>"+data[i]["item_code"]+"</div></td>";
                    content+="</tr>";

                    counter++;
                    if(counter==4)
                    {
                        counter=0;
                    }

                }
                $("#loader_donation").modal("hide");
                $("#items_lister").html(content);
                load_customers();
                load_donation_list();

            },error:function(error)
            {
                console.log(error);
                $("#loader_donation").modal("hide");
            }

        });
    }

    load_items_for_donation();

    var selected_items=new Array();

    function make_table(selected_items)
    {
        $("#donte_items").html("");
        console.log(selected_items);
        // --Make Table 
        var seleted_content="";
        for(var i=0;i<selected_items.length;i++)
        {
            seleted_content+="<tr>";

            seleted_content+="<td>";
            seleted_content+=selected_items[i]["item_name"];
            seleted_content+="</td>";

            seleted_content+="<td>";
            seleted_content+=selected_items[i]["unit_selected_qty"];
            seleted_content+="</td>";

            seleted_content+="<td>";
            seleted_content+=selected_items[i]["bulk_selected_qty"];
            seleted_content+="</td>";

            seleted_content+="<td>";
            seleted_content+=selected_items[i]["price"];
            seleted_content+="</td>";

            seleted_content+="<td>";
            seleted_content+=selected_items[i]["status"];
            seleted_content+="</td>";

            seleted_content+="<td>";
            seleted_content+="<button class='btn  btn-success edit' data-mbqty="+selected_items[i]["bulk_qty"]+" data-mqty="+selected_items[i]["unit_qty"]+" data-type="+selected_items[i]["type"]+" data-id="+i+">Edit</button>";
            seleted_content+="</td>";

            seleted_content+="<td>";
            seleted_content+="<button class='btn  btn-danger drop' data-id="+i+" data-previous_obj="+selected_items[i]["object_id"]+">Drop</button>";
            seleted_content+="</td>";

            seleted_content+="</tr>";
        }

        $("#donte_items").html("<table class='table table-bordered table-sm'><tr><td>Name</td><td>Unit Qty</td><td>Bulk Qty[ML]</td><td>Price</td><td>Status</td><td>Edit</td><td>Drop</td></tr><tbody>"+seleted_content+"</tbody></table><button class='btn btn-block btn-primary' id='save_donation'>Save Doantion</button");
        
    }

    $(document).on("click",".select_donation_item",function(){

        // hear changed cost into retails price nad bulk price

        var object_id=$(this).attr("data_object-id");
        var items_id=$(this).attr("data_item_id");
        var item_name=$(this).attr("data-item_name");
        var unit_cost=$(this).attr("data_cost");
        var bulk_cost=$(this).attr("data-bulk_cost");
        var unit_quantity=$(this).attr("data-qty");
        var bulk_quantity=$(this).attr("data-bulk_qty");
        var item_type=$(this).attr("data-item_type");


        //---Insert a Object
        selected_items.push({"object_id":object_id,"item_id":items_id,"item_name":item_name,"unit_cost":unit_cost,"bulk_cost":bulk_cost,"unit_qty":unit_quantity,"bulk_qty":bulk_quantity,"unit_selected_qty":0,"bulk_selected_qty":0,"type":item_type,"status":"Not_Confirm","price":0,"methode":"not"});
        
        //disable related_row
        $("#item_no"+object_id).css('pointer-events','none');
        $("#item_no"+object_id).css('cursor', 'not-allowed');

        make_table(selected_items);
        

    });

    $(document).on("click",".drop",function(){

        $("#item_no"+$(this).attr("data-previous_obj")).css('pointer-events','auto');
        $("#item_no"+$(this).attr("data-previous_obj")).css('cursor', 'crosshair');

        selected_items.splice($(this).attr("data-id"),1);
        make_table(selected_items);

        if(selected_items.length==0)
        {
            $("#donte_items").html("");
            $("#error_of_confirmation").html("");
        }

    });

    function make_item_manager_content()
    {
        $("#dontate_qty").val("");
        $("#dontate_bulk_qty").val("");

        $("#dontate_qty").prop("readonly",false);
        $("#dontate_bulk_qty").prop("readonly",true);

        $("#unit_bulk").prop("selectedIndex",0);
    }


    var id_of_array="";


    $(document).on("click",".edit",function(){

        $("#error_of_confirmation").css("display","none");
        
        id_of_array=$(this).attr("data-id");
        make_item_manager_content();

        if($(this).attr("data-type")=="item")
        {
            $("#unit_bulk").prop("disabled",false);
        }   
        else if($(this).attr("data-type")=="eitem")
        {
            $("#unit_bulk").prop("disabled",true);
        }

        $("#dontate_qty").attr("placeholder",$(this).attr("data-mqty"));        
        $("#dontate_bulk_qty").attr("placeholder",$(this).attr("data-mbqty"));
        $("#edit_object").modal("show");
        
    });

    $(document).on("change","#unit_bulk",function(){

            $("#dontate_qty").val("");
            $("#dontate_bulk_qty").val("");

            if($(this).val()=="unit")
            {
                $("#dontate_qty").prop("readonly",false);
                $("#dontate_bulk_qty").prop("readonly",true);
            }
            else
            {
                $("#dontate_qty").prop("readonly",true);
                $("#dontate_bulk_qty").prop("readonly",false);
            }
    });

    $(document).on("keyup","#dontate_qty",function(){
         if((parseInt($(this).val()))>(parseInt($(this).attr("placeholder"))))
         {
            $(this).val("");
         }   
    });

    $(document).on("keyup","#dontate_bulk_qty",function(){

        if((parseInt($(this).val()))>(parseInt($(this).attr("placeholder"))))
        {
           $(this).val("");
        }   
    });

    //-------Confirm Item-----------------------------

    $(document).on("click",".confirm_item",function(){

        $("#donate_error").css("display","none");
    
        if($("#unit_bulk").val()=="unit")
        {
            if($("#dontate_qty").val()=="")
            {

                $("#donate_error").css("display","block");
                $("#donate_error").html("<img src='../../asset/images/imoji/angry.gif' class='img-fluid' style='width:50px;height:50px;'><small>&nbsp;Need Quantity</small><hr>"); 
                
            }
            else
            {
                selected_items[id_of_array]["unit_selected_qty"]=0;
                selected_items[id_of_array]["bulk_selected_qty"]=0;
                selected_items[id_of_array]["price"]=0;

                selected_items[id_of_array]["unit_selected_qty"]=$("#dontate_qty").val();
                selected_items[id_of_array]["status"]="confirmed";
                selected_items[id_of_array]["methode"]="unit";

                selected_items[id_of_array]["price"]=(parseInt(selected_items[id_of_array]["unit_selected_qty"])*parseInt(selected_items[id_of_array]["unit_cost"]));

                make_table(selected_items);

                $("#donate_error").css("display","block");
                $("#donate_error").html("<img src='../../asset/images/imoji/imoji1.gif' class='img-fluid' style='width:50px;height:50px;'><small>&nbsp;</small><hr>"); 
            
            }
        }
        else
        {
            if($("#dontate_bulk_qty").val()=="")
            {
                $("#donate_error").css("display","block");
                $("#donate_error").html("<img src='../../asset/images/imoji/angry.gif' class='img-fluid' style='width:50px;height:50px;'><small>&nbsp;Need Quantity</small><hr>"); 
            
            }
            else
            {
                selected_items[id_of_array]["unit_selected_qty"]=0;
                selected_items[id_of_array]["bulk_selected_qty"]=0;
                selected_items[id_of_array]["price"]=0;


                selected_items[id_of_array]["bulk_selected_qty"]=$("#dontate_bulk_qty").val();
                selected_items[id_of_array]["status"]="confirmed";
                selected_items[id_of_array]["methode"]="bulk";

                selected_items[id_of_array]["price"]=((parseInt(selected_items[id_of_array]["bulk_cost"]))/1000)*(parseInt(selected_items[id_of_array]["bulk_selected_qty"]));


                make_table(selected_items);

                $("#donate_error").css("display","block");
                $("#donate_error").html("<img src='../../asset/images/imoji/imoji1.gif' class='img-fluid' style='width:50px;height:50px;'><small>&nbsp;</small><hr>"); 
            
            }
        }
    });

    $(document).on("click",".add_new_customer",function(){
        $(".customer_info").val("");
        $("#add_new_customer_modal").modal("show");
    });

   


    $(document).on("click","#add_customer_btn",function(){

        $("#donate_custmer_error").css("display","none");
        if($("#name_of_customers").val()=="" || $("#address_of_costomers").val()=="" || $("#phon_number_of_costomers").val()=="")
        {
            $("#donate_custmer_error").css("display","block");
            $("#donate_custmer_error").html("<img src='../../asset/images/imoji/angry.gif' class='img-fluid' style='width:50px;height:50px;'><small>&nbsp;Need Details.!</small><hr>");       
        }
        else
        {   
            $(".btn").css( 'pointer-events','none');
            $.ajax({
                type:"post",
                url:"../../back_function/admin/donations/donation_function.php",
                data:{"customer_name":$("#name_of_customers").val(),"customer_address":$("#address_of_costomers").val(),"phone_number":$("#phon_number_of_costomers").val()},
                cache:false,
                success:function(data)
                {
                    $(".btn").css('pointer-events','auto');

                    if(data=="done")
                    {
                        $(".customer_info").val("");
                        $("#donate_custmer_error").css("display","block");
                        $("#donate_custmer_error").html("<img src='../../asset/images/imoji/imoji1.gif' class='img-fluid' style='width:50px;height:50px;'><small></small><hr>");       
                    }

                    load_customers();
                  
                },
                error:function(error)
                {
                    $(".btn").css('pointer-events','auto');
                    console.log(data);
                }
            });
        }

    });

    $(document).on("click",".edit_customer",function(){
        $(".customer_info").val("");
        $("#edit_customer_modal").modal("show");
    });

    $(document).on("click","#edit_customer_btn",function(){

        $("#edit_donate_custmer_error").css("display","none");

        if($("#list_of_customers").val()=="" || $("#list_of_customers").val()==null || $("#list_of_customers").val()==undefined)
        {
            $("#edit_donate_custmer_error").css("display","block");
            $("#edit_donate_custmer_error").html("<img src='../../asset/images/imoji/tenor.gif' class='img-fluid' style='width:50px;height:50px;'><small>&nbsp;Need to select a customer.!</small><hr>");       
        
        }
        else
        {
            if($("#edit_name_of_customers").val()=="" && $("#edit_address_of_costomers").val()=="" && $("#edit_phon_number_of_costomers").val()=="")
            {
                $("#edit_donate_custmer_error").css("display","block");
                $("#edit_donate_custmer_error").html("<img src='../../asset/images/imoji/angry.gif' class='img-fluid' style='width:50px;height:50px;'><small>&nbsp;Need Details.!</small><hr>");       
            }
            else
            {   
                $(".btn").css( 'pointer-events','none');
                $.ajax({
                    type:"post",
                    url:"../../back_function/admin/donations/donation_function.php",
                    data:{"edit_customer_name":$("#edit_name_of_customers").val(),"edit_customer_address":$("#edit_address_of_costomers").val(),"edit_phone_number":$("#edit_phon_number_of_costomers").val(),"customer_id":$("#list_of_customers").val()},
                    cache:false,
                    success:function(data)
                    {
                        $(".btn").css('pointer-events','auto');
                        console.log(data);
                        if(data=="done" || data=="donedone" || data=="donedonedone")
                        {
                            $(".customer_info").val("");
                            $("#edit_donate_custmer_error").css("display","block");
                            $("#edit_donate_custmer_error").html("<img src='../../asset/images/imoji/imoji1.gif' class='img-fluid' style='width:50px;height:50px;'><small></small><hr>");       
                        }
    
                        load_customers();
                      
                    },
                    error:function(error)
                    {
                        $(".btn").css('pointer-events','auto');
                        console.log(data);
                    }
                });
            }
        }
    });


    $(document).on("click","#save_donation",function(){

        var flag=0;
        var donation_details=new Array();
        donation_details=[];

        $("#loader_donation").modal("show");

        $("#error_of_confirmation").css("display","none");

        for(var i=0;i<selected_items.length;i++)
        {
            if(selected_items[i]["status"]=="Not_Confirm")
            {
                flag=1;
                $("#loader_donation").modal("hide");

                break; 
            }
        }
        if(flag==1)
        {
            $("#error_of_confirmation").css("display","block");
            $("#error_of_confirmation").html("<img src='../../asset/images/imoji/tenor.gif' class='img-fluid' style='width:50px;height:50px;'><h3>Dear Sir You have to confirm some items.!</h3><hr>");       
        
        }
        else
        {
            var final_cost=0;
            for(var di=0;di<selected_items.length;di++)
            {
                donation_details.push({"item_id":selected_items[di]["item_id"],"item_name":selected_items[di]["item_name"],"price":selected_items[di]["price"],"type":selected_items[di]["type"],"method":selected_items[di]["methode"],"unit_cost":selected_items[di]["unit_cost"],"unit_qty":selected_items[di]["unit_qty"],"unit_selected_qty":selected_items[di]["unit_selected_qty"],"bulk_cost":selected_items[di]["bulk_cost"],"bulk_qty":selected_items[di]["bulk_qty"],"bulk_selected_qty":selected_items[di]["bulk_selected_qty"]}); 
                final_cost+=(parseInt(selected_items[di]["price"]));
            }
            if($("#list_of_customers").val()=="" || $("#list_of_customers").val()==null || $("#list_of_customers").val()==undefined)
            {
                $("#edit_donate_custmer_error").css("display","block");
                $("#edit_donate_custmer_error").html("<img src='../../asset/images/imoji/tenor.gif' class='img-fluid' style='width:50px;height:50px;'><small>&nbsp;Need to select a customer.!</small><hr>");       
            
            }
            else
            {
                $.ajax({
                    type:"POST",
                    url:"../../back_function/admin/donations/donation_function.php",
                    data:{"donation_info":JSON.stringify(donation_details),"donate_for":$("#list_of_customers").val(),"final_cost":final_cost},
                    cache:false,
                    success:function(data)
                    {   
                        console.log(data);
                        if(data=="ok")
                        {
                            reseter();
                            $("#loader_donation").modal("hide");
                            $("#loader_thank").modal("show");
                        }
    
                    },error:function(error)
                    {
                        $("#loader_donation").modal("hide");
                        console.log(error);
                    }
                    
                });
            }
        }
    });


    // ------------------List of donation------------------------------//

    $(document).on("click",".load",function(){

        $("#modal_for_donation_info").modal("show");

    });

    // ------------------List of donation------------------------------//

    
    // ------------------Drop Donation--------------------------------//

    $(document).on("click",".drop_donation",function(){


        $(".btn").prop("disabled",false);
        var id=$(this).attr("data-id");
        
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this action!",
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

              $(".btn").prop("disabled",true);
              
              //--------------------------Drop related donation------------------------------   
              $.ajax({
                type:"POST",
                url:"../../back_function/admin/donations/donation_function.php",
                data:{"drop_donation_id":id},
                cache:false,
                success:function(data)
                {
                    console.log(data);

                    if(data=="ok")
                    {
                        $(".btn").prop("disabled",false);
                        load_donation_list();
                        reseter();
                    }

                    $(".btn").prop("disabled",false);
                    $('.modal').css({"overflow-x":"hidden","overflow-y":"auto"});

                },error:function(error)
                {
                    console.log(error);
                    $(".btn").prop("disabled",false);

                }
              });

              swal("Deleted!", "deleted.", "success");


            } else {

              swal("Cancelled", "safe :)", "error");
              $(".btn").prop("disabled",false);

            }
          });

    });


    // ------------------Drop Donation--------------------------------//

    // ------------------Load Donation Inforamtion-------------------//

    $(document).on("click",".info",function(){

        $(".btn").prop("disabled",false);
        var id=$(this).attr("data-id");

        $("#donation_info_modal").modal("show");

        $.ajax({
            type:"POST",
            url:"../../back_function/admin/donations/donation_function.php",
            data:{"load_a_donation":id},
            cache:false,
            success:function(data)
            {
                data=JSON.parse(data);
                data=JSON.parse(data[0]["donation_data"]);
                console.log(data);

                $(".after_load").html("");

                var table_content="";
                table_content+="<table class='table table-bordered'>";
                table_content+="<tr>";
                table_content+="<th>Item Name</th>";
                table_content+="<th>Item-Type</th>";
                table_content+="<th>Type</th>";
                table_content+="<th>Quantity</th>";
                table_content+="</tr>";

                for(var i=0;i<data.length;++i)
                {
                    table_content+="<tr>";
                    table_content+="<td>"+data[i]["item_name"]+"</td>";

                    if(data[i]["type"]=="item")
                    {
                        table_content+="<td>ITEM</td>";
                    }
                    else
                    {
                        table_content+="<td>EMPTY</td>";
                    }

                    table_content+="<td>"+data[i]["method"]+"</td>";

                    if(data[i]["method"]=="unit")
                    {
                        table_content+="<td>"+data[i]["unit_selected_qty"]+"</td>";
                    }
                    else
                    {
                        table_content+="<td>"+data[i]["bulk_selected_qty"]+"</td>";
                    }
                    
                    table_content+="</tr>"; 
                }

                $(".after_load").html(table_content);

            },error:function(error)
            {
                console.log(error);
                $(".btn").prop("disabled",false);
            }

          });
    });



    // ------------------Load Donation Inforamtion-------------------//

    $("#donation_searcher").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#nonated_lister tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    $("#item_searcher").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#items_lister tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    $(document).on("click",".close",function(){
        $('.modal').css({"overflow-x":"hidden","overflow-y":"auto"});
    });

});