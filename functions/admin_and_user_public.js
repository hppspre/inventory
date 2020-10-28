$(document).ready(function(){

    function load_maping_details()
    {
        $.ajax({
            type:"POST",
            url:"../../back_function/admin_and_user_features/admin_user_function.php",
            data:{"items_map_details":""},
            cache:false,
            success:function(data)
            {
                data=JSON.parse(data);
    
                // ----Remake Object-----------------------
                var empty_map_array=new Array()
                empty_map_array=[];

                for(var i=0;i<data.length;i++)
                {
                    if(data[i]["need_a_empty"]=="yes")
                    {
                        for(var y=0;y<data.length;y++)
                        {
                            if(data[i]["empty_item_id"]==data[y]["id"])
                            {
                                empty_map_array.push({"item_name":data[i]["items_name"],"item_code":data[i]["item_code"],"empty_name":data[y]["items_name"],"item_code2":data[y]["item_code"]});
                                break;
                            }
                        }
                    }
                    
                }

                var contents="";
                for(var i=0;i<empty_map_array.length;i++)
                {
                    contents+="<tr>";
                        contents+="<td>"+empty_map_array[i]["item_name"]+"</td>";
                        contents+="<td>"+empty_map_array[i]["item_code"]+"</td>";
                        contents+="<td>"+empty_map_array[i]["empty_name"]+"</td>";
                        contents+="<td>"+empty_map_array[i]["item_code2"]+"</td>";
                    contents+="</tr>";
                }

                //----------------Make a table----------------------------
                $("#list_of_items").html(contents);

            },error:function(error)
            {
                console.log(error);
            }
        });
    }

    load_maping_details();

    $(document).on("click",".empty_map_list",function(){
        $("#empty_map_list").modal("show");
    });

    $("#empty_list").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#list_of_items tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });




    // ---------------------------Get Items List as in Details--------------------------------------

    $(document).on("click","#Items_list",function(){

       $("#items_list_modal").modal("show");
       
       $(".btn").prop("disabled",true); 
       $.ajax({
            type:"POST",
            url:"../../back_function/admin_and_user_features/admin_user_function.php",
            data:{"get_items_list":""},
            cache:false,
            success:function(data)
            {   
                $(".btn").prop("disabled",false); 
                data=JSON.parse(data);

                var content=0;
                for(var i=0;i<data.length;i++)
                {
                    content+="<tr>";
                        content+="<td>"+data[i]["items_name"]+"</td>";
                        content+="<td>"+data[i]["item_code"]+"</td>";
                        content+="<td>"+data[i]["items_retails_price"]+"</td>";

                        if(data[i]["item_type"]=="item")
                        {
                            content+="<td>"+data[i]["items_whole_sales_price"]+"</td>";
                            content+="<td>"+data[i]["bulk_price"]+"</td>";
                            content+="<td>"+data[i]["bulk_whole_price"]+"</td>";
                        }
                        else
                        {
                            content+="<td>EMPTY</td>";
                            content+="<td>EMPTY</td>";
                            content+="<td>EMPTY</td>";
                        }

                        content+="<td><button class='btn btn-block btn-success discount_getter' data-id="+data[i]["id"]+">Discount</button></td>";

                       
                    content+="</tr>";
                }

                $("#list_table_items").html(content);

            },error:function(error)
            {
                $(".btn").prop("disabled",false); 
                $("#items_list_modal").modal("hide");
                console.log(error);
            }
       });

    });

    $(document).on("click",".discount_getter",function(){

        var id=$(this).attr("data-id");
        $(".btn").prop("disabled",true);
        $(".btn").prop("disabled",false);

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
                                        content+="<td>"+data[i]["Field"]+":<br>"+data_of_colums[0][data[i]["Field"]]+"%</td>";
                                        content+="</tr>";
                                    }
                                }
                            }   
                            $("#discount_list").html(content);

                    },error:function(error)
                    {
                        console.log(error);
                    }
                });
                
            },error:function(error)
            {
                console.log(error);

            }
        });

    });

});