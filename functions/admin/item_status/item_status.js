$(document).ready(function(){
    
    //load items status
    function load_item_status()
    {
        $.ajax({
            type:"POST",
            url:"../../back_function/admin/item_status/item_status_function.php",
            data:{"load_items_status":""},
            cache:false,
            success:function(data)
            {
              
                data=JSON.parse(data);
                var content="";
                for(var i=0;i<data.length;i++)
                {
                    
                    if(data[i]["item_type"]=="eitem")
                    {
                        data[i]["item_type"]="Empty";
                    }
                    else
                    {
                        data[i]["item_type"]="Item";
                    }

                    if((parseInt(data[i]["qty"]))<(parseInt(data[i]["remake_level"])) && (parseInt(data[i]["leters_quantity"]))<(parseInt(data[i]["reorder_level"])))
                    {
                        content+="<tr class='table-danger'>";
                        content+="<td>"+data[i]["items_name"]+"</td>";
                        content+="<td>"+data[i]["item_code"]+"</td>";
                        content+="<td>"+data[i]["item_type"]+"</td>";
                        content+="<td>"+data[i]["reorder_level"]+"</td>";
                        content+="<td>"+data[i]["remake_level"]+"</td>";
                        content+="<td>"+data[i]["qty"]+"<button class='btn btn-block btn-success edit_qtyis' data-cost="+data[i]["items_cost"]+" data-qty="+data[i]["qty"]+"  data-id="+data[i]["id"]+" >Edit</button></td>";
                        
                        if(data[i]["item_type"]=="Empty")
                        {
                            content+="<td>Empty Item</td>";
                        }
                        else if(data[i]["item_type"]=="Item")
                        {
                            content+="<td>"+data[i]["leters_quantity"]+"<button class='btn btn-block btn-success edit_qtyleters' data-bulk_cost="+data[i]["bulk_cost"]+" data-bulk_qty="+data[i]["leters_quantity"]+" data-id="+data[i]["id"]+">Edit</button></td>";
                        }

                        content+="</tr>";
                    }
                    else if((parseInt(data[i]["leters_quantity"]))<(parseInt(data[i]["reorder_level"])))
                    {
                        content+="<tr class='table-secondary'>";
                        content+="<td>"+data[i]["items_name"]+"</td>";
                        content+="<td>"+data[i]["item_code"]+"</td>";
                        content+="<td>"+data[i]["item_type"]+"</td>";
                        content+="<td>"+data[i]["reorder_level"]+"</td>";
                        content+="<td>"+data[i]["remake_level"]+"</td>";
                        content+="<td>"+data[i]["qty"]+"<button class='btn btn-block btn-success edit_qtyis' data-cost="+data[i]["items_cost"]+" data-qty="+data[i]["qty"]+"  data-id="+data[i]["id"]+" >Edit</button></td>";
                        if(data[i]["item_type"]=="Empty")
                        {
                            content+="<td>Empty Item</td>";
                        }
                        else if(data[i]["item_type"]=="Item")
                        {
                            content+="<td>"+data[i]["leters_quantity"]+"<button class='btn btn-block btn-success edit_qtyleters' data-bulk_cost="+data[i]["bulk_cost"]+" data-bulk_qty="+data[i]["leters_quantity"]+" data-id="+data[i]["id"]+">Edit</button></td>";
                         }
                        content+="</tr>";
                    }
                    else if((parseInt(data[i]["qty"]))<(parseInt(data[i]["remake_level"])))
                    {
                        content+="<tr class='table-warning'>";
                        content+="<td>"+data[i]["items_name"]+"</td>";
                        content+="<td>"+data[i]["item_code"]+"</td>";
                        content+="<td>"+data[i]["item_type"]+"</td>";
                        content+="<td>"+data[i]["reorder_level"]+"</td>";
                        content+="<td>"+data[i]["remake_level"]+"</td>";
                        content+="<td>"+data[i]["qty"]+"<button class='btn btn-block btn-success edit_qtyis' data-cost="+data[i]["items_cost"]+" data-qty="+data[i]["qty"]+"  data-id="+data[i]["id"]+" >Edit</button></td>";
                        if(data[i]["item_type"]=="Empty")
                        {
                            content+="<td>Empty Item</td>";
                        }
                        else if(data[i]["item_type"]=="Item")
                        {
                            content+="<td>"+data[i]["leters_quantity"]+"<button class='btn btn-block btn-success edit_qtyleters' data-bulk_cost="+data[i]["bulk_cost"]+" data-bulk_qty="+data[i]["leters_quantity"]+" data-id="+data[i]["id"]+">Edit</button></td>";
                         }
                        content+="</tr>";
                    }
                    else
                    {
                        content+="<tr>";
                        content+="<td>"+data[i]["items_name"]+"</td>";
                        content+="<td>"+data[i]["item_code"]+"</td>";
                        content+="<td>"+data[i]["item_type"]+"</td>";
                        content+="<td>"+data[i]["reorder_level"]+"</td>";
                        content+="<td>"+data[i]["remake_level"]+"</td>";
                        content+="<td>"+data[i]["qty"]+"<button class='btn btn-block btn-success edit_qtyis' data-cost="+data[i]["items_cost"]+" data-qty="+data[i]["qty"]+"  data-id="+data[i]["id"]+" >Edit</button></td>";
                        if(data[i]["item_type"]=="Empty")
                        {
                            content+="<td>Empty Item</td>";
                        }
                        else if(data[i]["item_type"]=="Item")
                        {
                            content+="<td>"+data[i]["leters_quantity"]+"<button class='btn btn-block btn-success edit_qtyleters' data-bulk_cost="+data[i]["bulk_cost"]+" data-bulk_qty="+data[i]["leters_quantity"]+" data-id="+data[i]["id"]+">Edit</button></td>";
                        }
                        content+="</tr>";
                    }
                }
                
                $("#list_item_status").html(content);

            },error:function(error)
            {
                console.log(error);
            }
        });
    }

    load_item_status();

    $(document).on("click",".edit_qtyis",function(){

        $("#item_change_status").prop('selectedIndex',0);
        $("#qty_chng_error").css("display","none");
        $("#item_qty").val("");

        $("#id_of_item").val($(this).attr("data-id"));
        $("#item_change_cost").val($(this).attr("data-cost"));
        $("#item_qty").attr("data-placeholder",$(this).attr("data-qty"));

        $("#change_qty").modal("show");
        
    });

    $(document).on("click",".save_changed_qty",function(){

        $("#qty_chng_error").css("display","block");

        if($("#item_qty").val()=="")
        {
            $("#qty_chng_error").css("display","block");
            $("#qty_chng_error").html("<img src='../../asset/images/imoji/angry.gif' class='img-fluid' style='width:60px;height:60px;'><small>&nbsp;*Need a quantity..!</small>");     
        }
        else
        {
            // save change qty
            $('.btn').css('pointer-events','none');

            $.ajax({
               type:"POST",
               url:"../../back_function/admin/item_status/item_status_function.php",
               data:{"chng_id":$("#id_of_item").val(),"change_cost":$("#item_change_cost").val(),"chng_qty":parseInt($("#item_qty").val()),"option_number":$("#item_change_status").val(),"current_qty":parseInt($("#item_qty").attr("data-placeholder"))},
               cache:false,
               success:function(data)
               {
                    if(data=="done")
                    {
                        load_item_status();
                        swal({title: "",imageUrl: '../../asset/images/imoji/imoji1.gif' });
                        $("#change_qty").modal("hide");
                    }
                    $('.btn').css('pointer-events','auto');

               },error:function(error)
               {
                    $('.btn').css('pointer-events','auto');
                    $("#change_qty").modal("hide");

                    console.log(error);
               }

            });
        }
    });



    $(document).on("keyup","#item_qty",function(){

        $("#qty_chng_error").css("display","none");
        //chk qty with value
        if((parseInt($("#item_qty").attr("data-placeholder")))<(parseInt($("#item_qty").val())))
        {
            if($("#item_change_status").val()!=1)
            {
                $("#item_qty").val("");
            }
        }
    });


    $(document).on("change","#item_change_status",function(){
        $("#item_qty").val("");
    });



    //-----leters managed--------------

    $(document).on("click",".edit_qtyleters",function(){

        $("#id_of_leters_item").val($(this).attr("data-id"));
        $("#item_change_leter_cost").val($(this).attr("data-bulk_cost"));
        $("#item_leater_qty").attr("data-placeholder",$(this).attr("data-bulk_qty"));
        $("#change_leters_qty").modal("show");

        $("#item_change_leater_status").prop("selectedIndex",0);
        $("#item_leater_qty").val("");

    });

    $(document).on("keyup","#item_leater_qty",function(){

        $("#leater_qty_chng_error").css("display","none");
        //chk qty with value
        if((parseInt($("#item_leater_qty").attr("data-placeholder")))<(parseInt($("#item_leater_qty").val())))
        {
            if($("#item_change_leater_status").val()!=1)
            {
                $("#item_leater_qty").val("");
            }
        }
    });
    $(document).on("change","#item_change_leater_status",function(){
        $("#item_leater_qty").val("");
    });

    $(document).on("click",".save_changed_leater_qty",function(){

        $("#leater_qty_chng_error").css("display","block");

        if($("#item_leater_qty").val()=="")
        {
            $("#leater_qty_chng_error").css("display","block");
            $("#leater_qty_chng_error").html("<img src='../../asset/images/imoji/angry.gif' class='img-fluid' style='width:60px;height:60px;'><small>&nbsp;*Need a quantity..!</small>");     
        }
        else
        {
            // save change qty
            $('.btn').css('pointer-events','none');

            $.ajax({
               type:"POST",
               url:"../../back_function/admin/item_status/item_status_function.php",
               data:{"chng_leter_id":$("#id_of_leters_item").val(),"change_leater_cost":$("#item_change_leter_cost").val(),"chng_leater_qty":parseInt($("#item_leater_qty").val()),"option_leater_number":$("#item_change_leater_status").val(),"current_leater_qty":parseInt($("#item_leater_qty").attr("data-placeholder"))},
               cache:false,
               success:function(data)
               {
                console.log(data);
                    if(data=="done")
                    {
                        load_item_status();
                        swal({title: "",imageUrl: '../../asset/images/imoji/imoji1.gif' });
                        $("#change_leters_qty").modal("hide");
                    }
                    $('.btn').css('pointer-events','auto');

               },error:function(error)
               {
                    $('.btn').css('pointer-events','auto');
                    $("#change_leters_qty").modal("hide");
                    console.log(error);
               }

            });
        }
    });






    //search 
    $("#find_items").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#list_item_status tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });


    
});