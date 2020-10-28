$(document).ready(function(){

    //use to keep empty item
    var selected_empty="not_yet";

    function load_existing_cat_list()
    {
        $(".btn").css('pointer-events','none');

        $.ajax({
            type:"POST",
            url:"../../back_function/admin/items/item_function.php",
            data:{"load_existing_categories":""},
            cache:false,
            success:function(data)
            {
                // console.log(data);
                data=JSON.parse(data);
               

                $(".new_item_category").html("");
                for(var i=0;i<data.length;i++)
                {
                    $(".new_item_category").append("<option value="+data[i]["id"]+">"+data[i]["categories_name"]+"</option>");
                }
                $(".btn").css('pointer-events','auto');

            },error:function(error)
            {
                $(".btn").css('pointer-events','auto');
                console.log(error);
            }

        });
    }

    load_existing_cat_list();


    // Load Existing _items
    function loading_items()
    {
        $(".btn").css('pointer-events','none');
        $.ajax({
            type:"POST",
            url:"../../back_function/admin/items/item_function.php",
            data:{"load_items":""},
            cache:false,
            success:function(data)
            {
                $(".table_items_list").html("");
                var item_content="";

                data=JSON.parse(data);

                for(var i=0;i<data.length;i++)
                {
                    item_content+="<tr>";
                    item_content+="<td>"+data[i]["items_name"]+"</td>";
                    if(data[i]["status"]=="fresh")
                    {
                        item_content+="<td>Not Active</td>";
                    }
                    else if(data[i]["status"]=="yes")
                    {
                        item_content+="<td>Active</td>";
                    }

                    if(data[i]["item_type"]=="item")
                    {
                        item_content+="<td>Item</td>";
                        item_content+="<td><button class='btn btn-block btn-light change_dis_btn' data-id="+data[i]["id"]+" data-toggle='modal' data-target='.dis_manage'>Discount</button></td>";

                    }
                    else if(data[i]["item_type"]=="eitem")
                    {
                        item_content+="<td>Empty Item</td>";
                        item_content+="<td><button  class='btn btn-block btn-light disabled'>Discount</button></td>";

                    }
                  

                    item_content+="<td><button class='btn btn-block btn-success change_item_btn' data-id="+data[i]["id"]+" data-toggle='modal' data-target='.item_manage'>Edit</button></td>";
                    item_content+="<td><button class='btn btn-block btn-danger drop_items' data-id="+data[i]["id"]+">Drop</button></td>";
                    item_content+="</tr>";
                }   

                $(".table_items_list").html(item_content);
                $(".btn").css('pointer-events','auto');

                // load empties
                load_empty_list();
                
            },error:function(error)
            {
                console.log(error);
                $(".btn").css('pointer-events','auto');

            }

        });
    }

    function load_empty_list()
    {
        $(".btn").css('pointer-events','none');
        $.ajax({
            type:"POST",
            url:"../../back_function/admin/items/item_function.php",
            data:{"load_empties":""},
            cache:false,
            success:function(data)
            {   
                data=JSON.parse(data);
                $("#empty_selection").html("");
                for(var i=0;i<data.length;i++)
                {
                    $("#empty_selection").append("<option value="+data[i]["id"]+">"+data[i]["items_name"]+"</div>");
                }   
                $(".btn").css('pointer-events','auto');

                if(selected_empty!="not_yet")
                {
                    $('#empty_selection option[value='+selected_empty+']').prop('selected', true);   
                }

            },error:function(error)
            {
                $(".btn").css('pointer-events','auto');
                console.log(error);
            }
        });

    }
    


    loading_items();
    var checked_item_type="";
    $(document).on("click",".new_item_type",function(){

      $(".new_item_type").prop("checked",false);
      $(this).prop("checked",true);
      checked_item_type=$(this).val();   
     
    });

    $(document).on("click","#add_new_item_btn",function(){

      $("#item_error_msg").css("display","none");


      if(checked_item_type=="" || $("#new_item_code").val()=="" || $("#new_item").val()=="" || $(".new_item_category").val()=="" || $(".new_item_category").val()==undefined || $(".new_item_category").val()==null)  
      {
         $("#item_error_msg").css("display","block");$("#item_error_msg").fadeOut(6000);
        $("#item_error_msg").html("<img src='../../asset/images/imoji/angry.gif' class='img-fluid' style='width:60px;height:60px;'><small>&nbsp;*Details Be Need..!</small>");       

      }
      else 
      {
        //   add new item name
        $(".btn").css('pointer-events','none');
        $.ajax({
            type:"POST",
            url:"../../back_function/admin/items/item_function.php",
            data:{"new_type":checked_item_type,"new_item_code":$("#new_item_code").val(),"new_item_name":$("#new_item").val(),"cat_id":$(".new_item_category").val()},
            cache:false,
            success:function(data)
            {
                
                if(data=="already")
                {
                    $("#item_error_msg").css("display","block");$("#item_error_msg").fadeOut(6000);
                    $("#item_error_msg").html("<img src='../../asset/images/imoji/tenor.gif' class='img-fluid' style='width:60px;height:60px;'><small>&nbsp;*Already Exits..!</small>");       
                }
                else if(data=="ok")
                {
                    $("#item_error_msg").css("display","block");$("#item_error_msg").fadeOut(6000);
                    $("#item_error_msg").html("<img src='../../asset/images/imoji/imoji1.gif' class='img-fluid' style='width:60px;height:60px;'><small>&nbsp;</small>");        
                    loading_items();
                }
                $(".btn").css('pointer-events','auto');
     
            },error:function(error)
            {
                console.log(error);
                $(".btn").css('pointer-events','auto');

            }
        });
      }
    });

    $(document).on("click",".drop_items",function(){

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

                $(".btn").css('pointer-events','none');

                $.ajax({
                    type:"POST",
                    url:"../../back_function/admin/items/item_function.php",
                    data:{"drop_items_id":id},
                    cache:false,
                    success:function(data)
                    {
                        swal("Deleted!", "Item has been deleted.", "success");
                        loading_items();
                        $(".btn").css('pointer-events','auto');
             
                    },error:function(error)
                    {
                        console.log(error);
                        $(".btn").css('pointer-events','auto');
        
                    }
                });
            } else {

              $(".btn").css('pointer-events','auto');
              swal("Cancelled", "Your item is safe :)", "error");
            }
          });
    });

   
    $(document).on("change","#empty_selection",function(){
        selected_empty=$("#empty_selection").val();
    });

    $(document).on("click",".change_item_btn",function(){
        
        $("#item_change_error").css("display","none");
        $("#of_item").attr("data-id",$(this).attr("data-id"));
        $(".btn").css('pointer-events','none');

        $("#need_empty_chker").prop("disabled",false);
        $("#free_chker").prop("disabled",false);
        $("#empty_selection").prop("disabled",false);

        selected_empty="not_yet";

        var id=$(this).attr("data-id");

        $.ajax({
            type:"post",
            url:"../../back_function/admin/items/item_function.php",
            data:{"change_item_load":id},
            cache:false,
            success:function(data)
            {
                $("#item_change_loading_content").css('display',"none");
                $("#item_change_content").css('display',"block");
                $(".btn").css('pointer-events','auto');

                data=JSON.parse(data);
                console.log(data);

                if(data[0]["item_type"]=="item")
                {
                    $("#c_item").prop("checked",true);
                    $("#c_eitem").prop("checked",false);

                    $("#whole_sales_price").prop("readonly",false);
                    $("#bulk_sales_price").prop("readonly",false);
                    $("#bulk_sales_price_whole").prop("readonly",false);
                    $("#remake_level").prop("readonly",false);

                    //Empty Chker
                    if(data[0]["need_a_empty"]=="no")
                    {
                        $("#need_empty_chker").prop("checked",false);
                    }
                    else if(data[0]["need_a_empty"]!="no")
                    {
                        $("#need_empty_chker").prop("checked",true);
                        $('#empty_selection option[value='+data[0]["empty_item_id"]+']').prop('selected', true);
                    } 

                    //free chker
                    if(data[0]["have_free"]=="no")
                    {
                        $("#free_limit").prop("readonly",true);
                        $("#free_qty").prop("readonly",true);
                        $("#free_chker").prop("checked",false);
                    }
                    else if(data[0]["have_free"]=="yes")
                    {
                        $("#free_limit").prop("readonly",false);
                        $("#free_qty").prop("readonly",false);
                        $("#free_chker").prop("checked",true);
                    }

                }
                else if(data[0]["item_type"]=="eitem")
                {
                    $("#c_item").prop("checked",false);
                    $("#c_eitem").prop("checked",true);

                    $("#whole_sales_price").prop("readonly",true);
                    $("#bulk_sales_price").prop("readonly",true);
                    $("#bulk_sales_price_whole").prop("readonly",true);

                    $("#remake_level").prop("readonly",true);

                    $("#need_empty_chker").prop("disabled",true);
                    $("#empty_selection").prop("disabled",true);

                    $("#free_limit").prop("readonly",true);
                    $("#free_qty").prop("readonly",true);
                    $("#chng_item_bulk_cost").prop("readonly",true);
                    $("#free_chker").prop("disabled",true);
                    
                }
             
                //status checker
                if(data[0]["status"]=="fresh")
                {
                    $("#change_active").prop("checked",false);
                    $("#change_deactive").prop("checked",true);
                }
                else if(data[0]["status"]=="yes")
                {
                    $("#change_active").prop("checked",true);
                    $("#change_deactive").prop("checked",false);
                }

                $("#chng_item_name").val(data[0]["items_name"]);
                $("#chng_item_code").val(data[0]["item_code"]);
                $("#chng_item_cost").val(data[0]["items_cost"]);
                $("#chng_item_retails_price").val(data[0]["items_retails_price"]);
                $("#whole_sales_price").val(data[0]["items_whole_sales_price"]);
                $("#bulk_sales_price").val(data[0]["bulk_price"]);
                $("#bulk_sales_price_whole").val(data[0]["bulk_whole_price"]);
                $("#free_limit").val(data[0]["free_for"]);
                $("#free_qty").val(data[0]["free_qty"]);
                $("#reorder_level").val(data[0]["reorder_level"]);
                $("#remake_level").val(data[0]["remake_level"]);
                $("#chng_item_bulk_cost").val(data[0]["bulk_cost"]);

                //select given category
                $('#chng_item_category option[value='+data[0]["categories_id"]+']').prop('selected', true);
                
            },error:function(error)
            {
                console.log(error);
                $(".btn").css('pointer-events','auto');

            }
        });
    });

    // handle type
    $(document).on("click",".change_item_type",function(){

        $(".change_item_type").prop("checked",false);
        $(this).prop("checked",true);
        change_item_type=$(this).val();


        if($(this).val()=="eitem")
        {
            $("#whole_sales_price").prop("readonly",true);
            $("#bulk_sales_price").prop("readonly",true);
            $("#bulk_sales_price_whole").prop("readonly",true);
            $("#chng_item_bulk_cost").prop("readonly",true);
            $("#remake_level").prop("readonly",true);

            $("#need_empty_chker").prop("disabled",true);
            $("#empty_selection").prop("disabled",true);
            $("#free_limit").prop("readonly",true);
            $("#free_qty").prop("readonly",true);
            $("#free_chker").prop("disabled",true); 

        }
        else
        {
            $("#whole_sales_price").prop("readonly",false);
            $("#bulk_sales_price").prop("readonly",false);
            $("#bulk_sales_price_whole").prop("readonly",false);
            $("#chng_item_bulk_cost").prop("readonly",false);
            $("#need_empty_chker").prop("disabled",false);
            $("#empty_selection").prop("disabled",false);
            $("#free_limit").prop("readonly",false);
            $("#free_qty").prop("readonly",false);
            $("#free_chker").prop("disabled",false); 
            $("#remake_level").prop("readonly",false);

        }

    });

    // handle status
    $(document).on("click",".change_item_activater",function(){

        $(".change_item_activater").prop("checked",false);
        $(this).prop("checked",true);

    });

    // handle free issue
    $(document).on("click","#free_chker",function(){

        if($(this).prop("checked")==true)
        {
            $("#free_limit").prop("readonly",false);
            $("#free_qty").prop("readonly",false);
        }
        else
        {
            $("#free_limit").prop("readonly",true);
            $("#free_qty").prop("readonly",true);
        }
        
    });

    //  Below function for send changed data
    function send_chnage_item_details(array_data)
    {

        $(".btn").css('pointer-events','auto');
        selected_empty=$("#empty_selection").val();

        $.ajax({
            type:"POST",
            url:"../../back_function/admin/items/item_function.php",
            data:{"change_data":array_data,"change_item_id":$("#of_item").attr("data-id"),"reorder_level":$("#reorder_level").val(),"bulk_cost":$("#chng_item_bulk_cost").val(),"remake_level":$("#remake_level").val(),"bulk_whole_price":$("#bulk_sales_price_whole").val()},
            cache:false,
            success:function(data)
            {
                $(".btn").css('pointer-events','auto');
                if(data=="done")
                {
                    loading_items();
                    
                    $("#item_change_error").css("display","block");
                    $("#item_change_error").html("<img src='../../asset/images/imoji/imoji1.gif' class='img-fluid' style='width:50px;height:50px;'><small>&nbsp;</small><hr>"); 
                }
                else if(data=="already")
                {
                    $("#item_change_error").css("display","block");
                    $("#item_change_error").html("<img src='../../asset/images/imoji/tenor.gif' class='img-fluid' style='width:35px;height:35px;'><small>&nbsp;Already Exits.!</small><hr>"); 
               
                }
                else if(data=="try")
                {
                    $("#item_change_error").css("display","block");
                    $("#item_change_error").html("<img src='../../asset/images/imoji/tenor.gif' class='img-fluid' style='width:35px;height:35px;'><small>&nbsp;Try Again.!</small><hr>");  
                    loading_items();
                }

            },error:function(error)
            {
                $(".btn").css('pointer-events','auto');
                console.log(error);
            }
        });
    }


    $(document).on("click","#change_item",function(){

        $("#item_change_error").html("");
        var chnage_item_details = new Array();
        chnage_item_details=[];

        var array_to_send= new Array();
        array_to_send=[];

        $("#item_change_error").css("display","none");

        if($("#c_item").prop("checked")==true)
        {
            chnage_item_details[0]="item";
        }
        else if($("#c_eitem").prop("checked")==true)
        {
            chnage_item_details[0]="eitem";
        }

        if($("#change_active").prop("checked")==true)
        {
            chnage_item_details[1]="yes";
        }
        else if($("#change_deactive").prop("checked")==true)
        {
            chnage_item_details[1]="fresh";
        }

        if($("#need_empty_chker").prop("checked")==true)
        {
            chnage_item_details[2]=$("#empty_selection").val();
        }
        else if($("#need_empty_chker").prop("checked")==false)
        {
            chnage_item_details[2]="no";
        }

        if($("#free_chker").prop("checked")==true)
        {
            chnage_item_details[3]="yes";
            chnage_item_details[4]=$("#free_limit").val();
            chnage_item_details[5]=$("#free_qty").val();
        }
        else if($("#free_chker").prop("checked")==false)
        {
            chnage_item_details[3]="no";
            chnage_item_details[4]="no";
            chnage_item_details[5]="no";
        }


        chnage_item_details[6]=$("#chng_item_name").val();
        chnage_item_details[7]=$("#chng_item_code").val();
        chnage_item_details[8]=$("#chng_item_category").val();
        chnage_item_details[9]=$("#chng_item_cost").val();
        chnage_item_details[10]=$("#chng_item_retails_price").val();
        chnage_item_details[11]=$("#whole_sales_price").val();
        chnage_item_details[12]=$("#bulk_sales_price").val();

       
            if(chnage_item_details[0]=="item")
            {
                var flag=0;

                array_to_send[0]=chnage_item_details[1];  //act or diact 
                array_to_send[1]=chnage_item_details[6];  //name  
                array_to_send[2]=chnage_item_details[7];  //code 
                array_to_send[3]=chnage_item_details[8];  //category
                array_to_send[4]=(parseInt(chnage_item_details[9]));  //cost
                array_to_send[5]=(parseInt(chnage_item_details[10])); //retail price  
                array_to_send[6]=chnage_item_details[11]; //whole price  
                array_to_send[7]=chnage_item_details[12]; //bulk price 
                
                if(chnage_item_details[2]!="no")
                {
                    array_to_send[8]=chnage_item_details[2]; //empty needs
                }
                else 
                {
                    array_to_send[8]="no"; //empty needs
                }

                if(chnage_item_details[3]=="yes")
                {
                    if($("#free_limit").val()!="" && $("#free_qty").val()!="")
                    {
                        array_to_send[9]=(parseInt($("#free_limit").val())); //free limit
                        array_to_send[10]=(parseInt($("#free_qty").val()));  //free qty 
    
                        if(array_to_send[10]>array_to_send[9])
                        {
                            flag=2;  //2 for free limit
                        }
                    }  
                }
                else 
                {
                    array_to_send[9]="no"; //free limit
                    array_to_send[10]="no"; //free qty 
                }
                
                array_to_send[11]=chnage_item_details[0]; //type 
                
                if((isNaN(array_to_send[4])==false) &&  (isNaN(array_to_send[4])==false))
                {
                    if(array_to_send[4]<=array_to_send[5])
                    {
                        for(var i=0;i<array_to_send.length;i++)
                        {
                       
                                if(array_to_send[i]==="" || array_to_send[i]==null || array_to_send[i]==undefined)
                                {
                                     flag=1;
                                    
                                     $("#item_change_error").css("display","block");
                                     $("#item_change_error").html("<img src='../../asset/images/imoji/angry.gif' class='img-fluid' style='width:35px;height:35px;'><small>&nbsp;Need To Provide All Details1.!</small><hr>"); 
                                     break;
                                }
                        }
                    }
                    else
                    {
                        flag=1;
                        $("#item_change_error").css("display","block");
                        $("#item_change_error").html("<img src='../../asset/images/imoji/tenor.gif' class='img-fluid' style='width:35px;height:35px;'><small>&nbsp;The cost is greater than the price.!</small><hr>"); 
            
                    }
                }
                else
                {
                         flag=1;
                         $("#item_change_error").css("display","block");
                         $("#item_change_error").html("<img src='../../asset/images/imoji/angry.gif' class='img-fluid' style='width:35px;height:35px;'><small>&nbsp;Need To Provide All Details2.!</small><hr>"); 
                }
                if(flag==0)
                { 
                    console.log($("#reorder_level").val());
                    if($("#reorder_level").val()=="")
                    {
               
                        $("#item_change_error").css("display","block");
                        $("#item_change_error").html("<img src='../../asset/images/imoji/tenor.gif' class='img-fluid' style='width:35px;height:35px;'><small>&nbsp;Need A Reorder level.!</small><hr>"); 
                    
                    }
                    else if($("#chng_item_bulk_cost").val()=="")
                    {
                        $("#item_change_error").css("display","block");
                        $("#item_change_error").html("<img src='../../asset/images/imoji/tenor.gif' class='img-fluid' style='width:35px;height:35px;'><small>&nbsp;Need A Bulk Cost.!</small><hr>"); 
                    
                    }
                    else if($("#remake_level").val()=="")
                    {

                        $("#item_change_error").css("display","block");
                        $("#item_change_error").html("<img src='../../asset/images/imoji/tenor.gif' class='img-fluid' style='width:35px;height:35px;'><small>&nbsp;Need A Remake Level.!</small><hr>"); 
                   
                    }
                    else if($("#bulk_sales_price_whole").val()=="")
                    {

                        $("#item_change_error").css("display","block");
                        $("#item_change_error").html("<img src='../../asset/images/imoji/tenor.gif' class='img-fluid' style='width:35px;height:35px;'><small>&nbsp;Need A Bulk Whole price.!</small><hr>"); 
                   
                    }
                    else
                    {
                        send_chnage_item_details(JSON.stringify(array_to_send)); 
                    } 
                }
                else if(flag==2)
                {
                    $("#item_change_error").css("display","block");
                    $("#item_change_error").html("<img src='../../asset/images/imoji/tenor.gif' class='img-fluid' style='width:35px;height:35px;'><small>&nbsp;Free quantity greater than the free limit.!</small><hr>"); 
                }
            }
            else 
            {
                array_to_send[0]=chnage_item_details[6];  //name  
                array_to_send[1]=chnage_item_details[8];  //category  
                array_to_send[2]=chnage_item_details[7];  //code 
                array_to_send[3]=(parseInt(chnage_item_details[9]));  //cost 
                array_to_send[4]=(parseInt(chnage_item_details[10]));  //retail
                array_to_send[5]=chnage_item_details[1]; //active or deactive
                
                var flag=0;
                if((isNaN(array_to_send[3])==false) &&  (isNaN(array_to_send[4])==false))
                {
                    if(array_to_send[3]<=array_to_send[4])
                    {
                        for(var i=0;i<array_to_send.length;i++)
                        {
                                if(array_to_send[i]==="" || array_to_send[i]==null || array_to_send[i]==undefined)
                                {
                                     flag=1;
                                    
                                     $("#item_change_error").css("display","block");
                                     $("#item_change_error").html("<img src='../../asset/images/imoji/angry.gif' class='img-fluid' style='width:35px;height:35px;'><small>&nbsp;Need To Provide All Details.!</small><hr>"); 
                                     break;
                                }
                        }
                    }
                    else
                    {
                        flag=1;
                        $("#item_change_error").css("display","block");
                        $("#item_change_error").html("<img src='../../asset/images/imoji/tenor.gif' class='img-fluid' style='width:35px;height:35px;'><small>&nbsp;The cost is greater than the price.!</small><hr>"); 
                    }
                }
                else
                {
                        flag=1;
                        $("#item_change_error").css("display","block");
                        $("#item_change_error").html("<img src='../../asset/images/imoji/angry.gif' class='img-fluid' style='width:35px;height:35px;'><small>&nbsp;Need To Provide All Details.!</small><hr>"); 
                }
                if(flag==0)
                { 
                    // console.log($("#reorder_level").val());

                    if($("#reorder_level").val()=="")
                    {
               
                        $("#item_change_error").css("display","block");
                        $("#item_change_error").html("<img src='../../asset/images/imoji/tenor.gif' class='img-fluid' style='width:35px;height:35px;'><small>&nbsp;Need A Reorder level.!</small><hr>"); 
                    
                    }
                    else
                    {
                        send_chnage_item_details(JSON.stringify(array_to_send)); 
                    }
                }
            }
    });

    // manage discount

    function load_coulms_and_data(id)
    {
        $("#dis_id_of_item").attr("data-id",id);
        $("#dis_id_of_item_loader").css("display","block");      
        $("#dis_id_of_item_content").css("display","none"); 
        $(".btn").css('pointer-events','none');

        $.ajax({
            type:"post",
            url:"../../back_function/admin/items/item_function.php",
            data:{"load_columns":""},
            cache:false,
            success:function(data)
            {
                data=JSON.parse(data);

                

                $.ajax({
                    type:"post",
                    url:"../../back_function/admin/items/item_function.php",
                    data:{"load_columns_data":id},
                    cache:false,
                    success:function(data_of_colums)
                    {

                            $("#dis_id_of_item_loader").css("display","block");      
                            $("#dis_id_of_item_content").css("display","none"); 
                            $(".btn").css('pointer-events','auto');

                            data_of_colums=JSON.parse(data_of_colums);
                            // make content of discount
                            var content="";
                            for(var i=0;i<data.length;i++)
                            {
                                if(!data[i]["Field"].includes("price"))
                                {
                                    if(data[i]["Field"].includes("sales"))
                                    {
                                        content+="<tr>";
                                        content+="<td>"+data[i]["Field"]+"</td>";
                                        content+="<td><input type='number' value="+data_of_colums[0][data[i]["Field"]]+" class='form-control form-control-sm' id='dis"+i+"'></td>";
                                        content+="<td><button class='btn btn-success btn-sm btn-block chng_dis_btn' data-name="+data[i]["Field"]+" data-id='dis"+i+"'>Change</button></td>";
                                        content+="</tr>";
                                    }
                                }
                            }   
                            $("#discount_list").html(content);

                    },error:function(error)
                    {
                        $(".dis_manage").modal("hide");
                        $("#dis_id_of_item_loader").css("display","block");      
                        $("#dis_id_of_item_content").css("display","none"); 
                        $(".btn").css('pointer-events','auto');
                    }
                });
                
            },error:function(error)
            {
                console.log(error);
                $(".dis_manage").modal("hide");
                $("#dis_id_of_item_loader").css("display","block");      
                $("#dis_id_of_item_content").css("display","none"); 
                $(".btn").css('pointer-events','auto');
            }
        });
    }

    $(document).on("click",".change_dis_btn",function(){
        var id=$(this).attr("data-id");
        load_coulms_and_data(id);
    });

    // change_discount
    $(document).on("click",".chng_dis_btn",function(){

        $("#dis_chnger_error").css("display","none");

        if($("#"+$(this).attr("data-id")).val()=="")
        {
            $("#dis_chnger_error").css("display","block");
            $("#dis_chnger_error").html("<img src='../../asset/images/imoji/angry.gif' class='img-fluid' style='width:45px;height:45px;'><small>&nbsp;Need To Provide All Details.!</small><hr>"); 
        }
        else if(((parseInt($("#"+$(this).attr("data-id")).val())) <= 100))
        {
            var column_name=$(this).attr("data-name");
            var valueof_dis=$("#"+$(this).attr("data-id")).val();
            
            $(".btn").css('pointer-events','none');

            $.ajax({
                type:"post",
                url:"../../back_function/admin/items/item_function.php",
                data:{"column_name":column_name,"discount_value":valueof_dis,"discount_change_id":$("#dis_id_of_item").attr("data-id")},
                cache:false,
                success:function(data)
                {
                    if(data=="done")
                    {
                        $("#dis_chnger_error").css("display","block");
                        $("#dis_chnger_error").html("<img src='../../asset/images/imoji/imoji1.gif' class='img-fluid' style='width:50px;height:50px;'><small></small><hr>"); 

                    }
                    $(".btn").css('pointer-events','auto');

                },error:function(error)
                {
                    console.log(error);
                    $(".btn").css('pointer-events','auto');

                }
            });

        }
        else
        {
            $("#dis_chnger_error").css("display","block");
            $("#dis_chnger_error").html("<img src='../../asset/images/imoji/tenor.gif' class='img-fluid' style='width:35px;height:35px;'><small>*Can't Use this discount Range.!</small><hr>"); 
        }

    });


    $("#Items_input").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $(".table_items_list tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
     });

   

});