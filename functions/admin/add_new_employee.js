$(document).ready(function(){
    function load_exits_desigantion()
    {
        $(".btn").prop("disabled",true);
        $.ajax({
            type:"post",
            url:"../../back_function/admin/employee/employee_function.php",
            data:{"get_emp_designation":""},
            cache:false,
            success:function(data)
            {
                var data_list=JSON.parse(data);

                $(".select_designation").html("");
                for(var i=0;i<data_list.length;i++)
                {
                    $(".select_designation").append("<option value="+data_list[i]["id"]+">"+data_list[i]["designtion__name"]+"</option>");
                }
                get_next_emp_number();
                $(".btn").prop("disabled",false);

            },error:function(error)
            {
                console.log(error);
                location.reload();
            }

        });
    }

    load_exits_desigantion();

    $(document).on("click",".get_designation",function(){
        load_exits_desigantion();
    });

    //Get next employee_number

    function get_next_emp_number()
    {
        $(".btn").prop("disabled",true);
        $.ajax({
            type:"post",
            url:"../../back_function/admin/employee/employee_function.php",
            data:{"get_next_auto_emp":"next"},
            cache:false,
            success:function(data)
            {
                $(".btn").prop("disabled",false);
                $("#emp_number").val("WINTRY-EMP-"+data);

            },error:function(error)
            {
                console.log(error);
                location.reload();
            }
        });
    }
    get_next_emp_number();


    // ......Load existing employers...............................................................................

    function load_employers()
    {
        $(".btn").prop("disabled",true);
        $.ajax({
            type:"post",
            url:"../../back_function/admin/employee/employee_function.php",
            data:{"get_emp_list":""},
            cache:false,
            success:function(data)
            {
                $(".btn").prop("disabled",false);
                get_next_emp_number();

                var emp_data=JSON.parse(data);
                console.log(emp_data);

                $("#emp_list").html("");

                var html_data_list_of_emp="";

                for(var i=0;i<emp_data.length;i++)
                {
                    html_data_list_of_emp+="<tr>";  
                    html_data_list_of_emp+="<td>"+emp_data[i]["name"]+"</td>";  
                    html_data_list_of_emp+="<td>"+emp_data[i]["designtion__name"]+"</td>";  
                    html_data_list_of_emp+="<td class='emp_info_click'>"+emp_data[i]["emp_number"]+"</td>";  
                    html_data_list_of_emp+="<td><button data-toggle='modal' data-target='#chnge_emp' class='btn btn-light btn-sm chng_emp' data-id="+emp_data[i]["id"]+">Change</td>";  

                    if(emp_data[i]["status"]=='active')
                    {
                        html_data_list_of_emp+="<td><button  class='btn btn-light btn-sm de_activation_emp' data-id="+emp_data[i]["id"]+">Deactivate</td>";  
                    }
                    else if(emp_data[i]["status"]=='not_active')
                    {
                        html_data_list_of_emp+="<td><button  class='btn btn-success btn-sm activation_emp' data-id="+emp_data[i]["id"]+">Activate</td>";  
                    }
                    html_data_list_of_emp+="<td><button  class='btn btn-danger btn-sm drop_emp' data-id="+emp_data[i]["id"]+">Drop</td>";  
                    html_data_list_of_emp+="</tr>";  
                }

                $("#emp_list").html(html_data_list_of_emp);

            },error:function(error)
            {
                console.log(error);
                location.reload();
            }
        });
    }
    load_employers();

    // ......End of Load existing employers...............................................................................

    $(document).on("click","#add_employee_btn",function(){

        var new_employee_data=$("#new_employee_form").serializeArray();
        var flag=0;
        for(var i=0;i<new_employee_data.length;i++)
        { 
            
            if((new_employee_data[i]["name"]!="user_name") && (new_employee_data[i]["name"]!="password"))
            {
                if(new_employee_data[i]["value"]=="")
                {
                    $("#msg_error").css("color","red");
                    $("#msg_error").html("").html("<i class='fas fa-exclamation-triangle'></i><small>&nbsp;Details Not Enough </small>");
                    $("#msg_error").css("display","block");
                    flag=1;
                    break;
                }
            }
            
        }

        if(($("#user_name").val()!="" && $("#user_password").val()=="") || ($("#user_name").val()=="" && $("#user_password").val()!=""))
        {
            $("#msg_error").css("display","block");
            $("#msg_error").html("").html("<i class='fas fa-exclamation-triangle'></i><small>&nbsp;User Name and password Be Need.! </small>");

        }
        else if(flag==0)
        {
            $("#add_employee_btn").css({pointerEvents: "none"});
            $(".waiter1").html("<i class='fas fa-cog fa-spin'></i>");

            $.ajax({
                type:"post",
                url:"../../back_function/admin/employee/employee_function.php",
                data:{"new_employee":JSON.stringify(new_employee_data)},
                cache:false,
                success:function(data)
                {
                    load_employers();
                    console.log(data);
                    $("#new_employee_form")[0].reset();
                    $("#add_employee_btn").css({pointerEvents: "auto"});
                    $(".waiter1").html("<i class='fas fa-check'></i>");

                    if(data=="ok")
                    {
                        $("#msg_error").css("display","block");
                        $("#msg_error").html("<img src='../../asset/images/imoji/imoji1.gif' class='img-fluid' style='width:60px;height:60px;'>"); 
                    }
                    else 
                    {
                        $("#msg_error").css("display","block");
                        $("#msg_error").html("<img src='../../asset/images/imoji/tenor.gif' class='img-fluid' style='width:60px;height:60px;'><small>&nbsp;You Entered User Name or EMP Name Already Exits.!</small>"); 
                    }
                },error:function(error)
                {
                    console.log(error);
                }
            });
        }
    });


    $(".btn").click(function(){

        $("#msg_error").css("color","red");
        $("#msg_error").css("display","none");
        $("#add_employee_btn").css({pointerEvents: "auto"});
        $(".waiter1").html("<i class='fas fa-check'></i>");
        $("#msg_error").html("").html("<i class='fas fa-exclamation-triangle'></i><small>&nbsp;Details Not Enough </small>");
        
    });


    // search Employees
    $(document).on("keyup","#find_emp",function() {
        var value = $(this).val().toLowerCase();
        $(".emp_list tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

  

});