$(document).ready(function(){

     $(document).on("click","#add_new_categories_btn",function(){

        $("#cat_error_msg").css("display","none");

        if($("#new_categories").val()=="")
        {
            $("#cat_error_msg").css("display","block");
            $("#cat_error_msg").html("<img src='../../asset/images/imoji/angry.gif' class='img-fluid' style='width:60px;height:60px;'><small>&nbsp;*Need a Category Name..!</small>");     
        }
        else
        {
            $("#cat_error_msg").css("display","block");
            $("#cat_error_msg").html("<img src='../../asset/images/imoji/waitingemoji.gif' class='img-fluid' style='width:60px;height:60px;'><small>&nbsp;*Ok Please Wait..!</small>");     
            
            $('.btn').css( 'pointer-events', 'none' );

            $.ajax({
                type:"POST",
                url:"../../back_function/admin/categories/categories_function.php",
                data:{"cat_name":$("#new_categories").val()},
                cache:false,
                success:function(data)
                {
                    $('.btn').css( 'pointer-events','auto');

                    if(data=="already_have")
                    {
                        $("#cat_error_msg").css("display","block");
                        $("#cat_error_msg").html("<img src='../../asset/images/imoji/tenor.gif' class='img-fluid' style='width:60px;height:60px;'><small>&nbsp;*Already Exits..!</small>");       
                    }
                    else if(data=="ok")
                    {
                        $("#cat_error_msg").css("display","block");
                        $("#cat_error_msg").html("<img src='../../asset/images/imoji/imoji1.gif' class='img-fluid' style='width:60px;height:60px;'><small>&nbsp;*Good :)..!</small>");       
                        load_categories_name();
                    }

                },error:function(error)
                {
                    $('.btn').css( 'pointer-events','auto');
                    console.log(error)
                }
            });
        }
     }); 

    //  Load Existing Categories
    function load_categories_name()
    {

        $('.btn').css( 'pointer-events','none');

        $.ajax({
            type:"POST",
            url:"../../back_function/admin/categories/categories_function.php",
            data:{"get_categories":""},
            cache:false,
            success:function(data)
            {
                data=JSON.parse(data);
                $("#category_names_list").html("");
                
                var category_list="";
                for(var i=0;i<data.length;i++){
                 
                    category_list+="<tr>";
                    category_list+="<td><input type='text' class='btn-block cat_change"+data[i]["id"]+"' value="+data[i]["categories_name"]+"></td>";
                    category_list+="<td><button class='btn btn-success chn_cat_btn btn-block' data-id="+data[i]["id"]+">Edit</button></td>";
                    category_list+="</tr>";
  
                }
                $('.btn').css( 'pointer-events','auto');
                $("#category_names_list").html(category_list);

            },error:function(error)
            {
                $('.btn').css('pointer-events','auto');
                console.log(error);
            }
    
        });
    }
    load_categories_name();

    // edit category name
    $(document).on("click",".chn_cat_btn",function(){

        var id=$(this).attr("data-id");

        $("#cat_error_msg").css("display","none");    

        if($(".cat_change"+id).val()=="")
        {
            $("#cat_error_msg").css("display","block");
            $("#cat_error_msg").html("<img src='../../asset/images/imoji/angry.gif' class='img-fluid' style='width:60px;height:60px;'><small>&nbsp;*Enter a Category Name..!</small>");       
        
        }
        else
        {
            $("#cat_error_msg").css("display","block");
            $("#cat_error_msg").html("<img src='../../asset/images/imoji/waitingemoji.gif' class='img-fluid' style='width:60px;height:60px;'><small>&nbsp;*Ok Please Wait..!</small>");       
            $('.btn').css( 'pointer-events','none');
            
            $.ajax({
                type:"POST",
                url:"../../back_function/admin/categories/categories_function.php",
                data:{"chng_category_name":$(".cat_change"+id).val(),"change_cat_id":id},
                cache:false,
                success:function(data)
                {
                  
                    $('.btn').css( 'pointer-events','auto');
                    if(data=="already_have")
                    {
                        $("#cat_error_msg").css("display","block");
                        $("#cat_error_msg").html("<img src='../../asset/images/imoji/tenor.gif' class='img-fluid' style='width:60px;height:60px;'><small>&nbsp;*Already Exits..!</small>");       
                        
                    }
                    else if(data=="done")
                    {
                        $("#cat_error_msg").css("display","block");
                        $("#cat_error_msg").html("<img src='../../asset/images/imoji/imoji1.gif' class='img-fluid' style='width:60px;height:60px;'><small></small>");       
                        load_categories_name();
                    }

                },error:function(error){

                    $('.btn').css( 'pointer-events','auto');
                    console.log(error);
                }
            });
        }

    });


});