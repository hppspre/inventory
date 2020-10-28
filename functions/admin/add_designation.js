$(document).ready(function(){

    function load_designation()
    {
        $.ajax({
            type:"post",
            url:"../../back_function/admin/employee/employee_function.php",
            data:{"get_emp_designation":""},
            cache:false,
            success:function(data)
            {
                var data_list=JSON.parse(data);
                
                $(".select_designation_to_change").html("");
                $(".select_designation").html("");
                $("#discount_manage_list").html("");

                var desigantions="";

                for(var i=0;i<data_list.length;i++)
                {
                    desigantions+="<option value="+data_list[i]["id"]+">"+data_list[i]["designtion__name"]+"</option>"
                    
                    if(data_list[i]["is_sales_related"]=="yes")
                    {
                        $("#discount_manage_list").append("<tr>");
                        $("#discount_manage_list").append("<td>"+data_list[i]["designtion__name"]+"</td>");
                        $("#discount_manage_list").append("<td><input type='number' class='form-control discounter"+data_list[i]["id"]+"' placeholder="+data_list[i]["discount"]+"></td>");
                        $("#discount_manage_list").append("<td><button class='btn btn-block btn-primary btn-sm discounter_chg_btn' data-id="+data_list[i]["id"]+" style='font-size:10px;'>Change</button></td>");
                        $("#discount_manage_list").append("</tr>");
                    }

                }

                $(".select_designation_to_change").html(desigantions);
                $(".select_designation").html(desigantions);

            },error:function(error)
            {
                console.log(error);
                location.reload();
            }

        });
    }

  


    $(document).on("click",".btn",function(){
        $("#designation_error").css("display","none");
        $("#designation_error").html("<i class='fas fa-exclamation-triangle'></i><small>&nbsp;Details Not Enough </small>");
    
        $("#add_designation_btn").css({pointerEvents: "auto"});
        $(".waiter2").html("<i class='fas fa-check'></i>");
    });

    $(document).on("keyup",".form-control",function(){
        $("#designation_error").css("display","none");
        $("#designation_error").html("<i class='fas fa-exclamation-triangle'></i><small>&nbsp;Details Not Enough </small>");
    });

    $(document).on("click","#add_designation_btn",function(){

        //---------------
        var selected = [];
        $('#dept_list input:checked').each(function() {
            selected.push($(this).attr('value'));
        });

        if((selected.length==0 && $("#sales_designtion").val()=="") && $("#desigantion").val()!="")
        {
            $("#designation_error").css("display","block");
            $("#designation_error").html("<span style='color:#ffd337;'><i class='fas fa-frown'></i></span><small>&nbsp;Need To Select Department.</small>");
        }
        else if($("#desigantion").val()=="" && $("#sales_designtion").val()=="")
        {
            $("#designation_error").css("display","block");
        }
        else if($("#desigantion").val()!="" && $("#sales_designtion").val()!="")
        {
            $("#designation_error").css("display","block");
            $("#designation_error").html("<span style='color:#ffd337;'><i class='fas fa-frown'></i></span><small>&nbsp;Provide Only One Designation.</small>");
        }
        else
        {
            $("#add_designation_btn").css({pointerEvents: "none"});
            $(".waiter2").html("<i class='fas fa-cog fa-spin'></i>");
            $("#change_designation_btn").css({pointerEvents: "none"});
            $(".waiter2").html("<i class='fas fa-cog fa-spin'></i>");

            $.ajax({
                type:"post",
                url:"../../back_function/admin/employee/employee_function.php",
                data:{"designation":$("#desigantion").val(),"sales_designation": $("#sales_designtion").val(),"dept_list":JSON.stringify(selected)},
                cache:false,
                success:function(data)
                {
                    load_designation();

                    $("#add_designation_btn").css({pointerEvents: "auto"});
                    $("#change_designation_btn").css({pointerEvents: "auto"});
                    $(".waiter2").html("<i class='fas fa-check'></i>");
                    if(data=="both")
                    {
                        $("#designation_error").css("display","block");
                        $("#designation_error").html("<span style='color:#ffd337;'><i class='fas fa-frown'></i></span><small>&nbsp;Provide Only One.</small>"); 
                    }
                    else if(data=="have")
                    {   
                        $("#designation_error").css("display","block");
                        $("#designation_error").html("<span style='color:#ffd337;'><i class='fas fa-frown'></i></span><small>&nbsp;Already exits.</small>"); 
                    }
                    else if(data=="done")
                    {  
                        
                        $('#dept_list input:checked').each(function() {
                            selected.push($(this).prop('checked' , false));
                        }); 

                        $("#designation_error").css("display","block");
                        $("#designation_error").html("<img src='../../asset/images/imoji/imoji1.gif' class='img-fluid' style='width:60px;height:60px;'>"); 
                        $("#desigantion").val("");$("#sales_designtion").val("");
                    }
                },error:function(error)
                {
                    console.log(error);
                }
            });
        }
    });


    //change designation
    $(document).on("click","#change_designation_btn",function(){

        var selected = [];
        $('#change_dept_list input:checked').each(function() {
            selected.push($(this).attr('value'));
        });

        if($(".select_designation_to_change").val()=="" || $(".select_designation_to_change").val()==null || $(".select_designation_to_change").val()==undefined)
        {
            $("#designation_error").css("display","block");
            $("#designation_error").html("<i class='fas fa-exclamation-triangle'></i><small>&nbsp;Need to Select a Designation  </small>");
        }
        else
        {
            if(selected.length>=0)
            {
                $("#add_designation_btn").css({pointerEvents: "none"});
                $("#change_designation_btn").css({pointerEvents: "none"});
                $(".waiter3").html("<i class='fas fa-cog fa-spin></i>");
                $.ajax({

                    type:"post",
                    url:"../../back_function/admin/employee/employee_function.php",
                    data:{"designation_id":$(".select_designation_to_change").val(),"change_dept":JSON.stringify(selected)},
                    cache:false,
                    success:function(data)
                    {
                        load_designation();
                        console.log(data);
                       
                        $("#add_designation_btn").css({pointerEvents: "auto"});
                        $("#change_designation_btn").css({pointerEvents: "auto"});
                        $(".waiter3").html("<i class='fas fa-check'></i>");
                        if(data=="both")
                        {
                            $("#designation_error").css("display","block");
                            $("#designation_error").html("<span style='color:#ffd337;'><i class='fas fa-frown'></i></span><small>&nbsp;Provide Only One.</small>"); 
                        }
                        else if(data=="have")
                        {   
                            $("#designation_error").css("display","block");
                            $("#designation_error").html("<span style='color:#ffd337;'><i class='fas fa-frown'></i></span><small>&nbsp;Already exits.</small>"); 
                        }
                        else if(data=="donedone" || data=="done")
                        {   
                            $('#change_dept_list input:checked').each(function() {
                                selected.push($(this).prop('checked' , false));
                            });
                            
                            $("#designation_error").css("display","block");
                            $("#designation_error").html("<img src='../../asset/images/imoji/imoji1.gif' class='img-fluid' style='width:60px;height:60px;'>"); 
                            $("#change_designtion").val("");$("#change_sales_designtion").val("");
                            
                        }

                    },error:function(error)
                    {
                        console.log(error);
                    }
                });
            }
        }
    });
    

    $(document).on("change","#select_designation_to_change",function(){

        $('#change_dept_list input:checked').each(function() {
            selected.push($(this).prop('checked' , false));
        });

    });


    $(document).on("click",".deprtment_cat",function(){

        if($("#"+$(this).attr("data-id")).prop("checked")==true)
        {
            $("#"+$(this).attr("data-id")).prop("checked",false);
        }
        else
        {
            $("#"+$(this).attr("data-id")).prop("checked",true);
        }
    });


});