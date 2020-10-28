$(document).ready(function(){


    $(document).on("click",".btn",function(){
        $("#chnge_msg_error").css("display","none");
        $("#chnge_msg_error").html("<i class='fas fa-exclamation-triangle'></i><small>&nbsp;Details Not Enough </small>");
    });

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
              
                var emp_data=JSON.parse(data);

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



    // load_employers();
    $(document).on("click",".chng_emp",function(){

        $("#change_emp_area").css("display","none");
        $("#load_change_emp_area").css("display","block");

        var emp_id=$(this).attr("data-id");

        $.ajax({
           type:"post",
           url:"../../back_function/admin/employee/employee_function.php",
           data:{"get_specific_emp":emp_id},
           cache:false,
           success:function(data)
           {
                data=JSON.parse(data);
                $("#change_emp_area").css("display","block");
                $("#load_change_emp_area").css("display","none");

                $("#chn_name").val(data[0]["name"]);
                $("#chn_mail").val(data[0]["mail"]);
                $("#chn_teli").val(data[0]["tp"]);
                $("#chn_address").val(data[0]["address"]);
                $("#chn_nic").val(data[0]["nic"]);
                $("#chn_epf").val(data[0]["epf_number"]);
                $("#chnge_user_id").val(emp_id);
                $("#chn_designation option[value="+data[0]["designation_list_id"]+"]").attr('selected','selected');

           },error:function(error)
           {
                console.log(error);
                location.reload();
           }
        });
    });

    //change_user_values
    $(document).on("click","#chng_employee_btn",function(){

        $("#chnge_msg_error").css("display","none");
        $("#chnge_msg_error").html("<i class='fas fa-exclamation-triangle'></i><small>&nbsp;Details Not Enough </small>");

        if($("#chn_epf").val()=="" || $("#chn_designation").val()=="" || $("#chn_designation").val()==null || $("#chn_designation").val()==undefined || $("#chn_name").val()=="" || $("#chn_mail").val()=="" || $("#chn_teli").val()=="" || $("#chn_nic").val()=="" || $("#chn_address").val()=="")
        {
            $("#chnge_msg_error").css("display","block");
        }
        else
        {
            var chn_data=JSON.stringify($("#chn_emp_forms").serializeArray());

            $(".btn").css({pointerEvents: "none"});
            $(".waiter_emp_change").html("<i class='fas fa-cog fa-spin'></i>");

            $.ajax({
                type:"POST",
                url:"../../back_function/admin/employee/employee_function.php",
                data:{"chg_emp_data":chn_data},
                cache:false,
                success:function(data)
                {
                    console.log(data);
                    $(".btn").css({pointerEvents: "auto"});
                    $(".waiter_emp_change").html("<i class='fas fa-check'></i>");

                    if(data=="have")
                    {
                        $("#chnge_msg_error").css("display","block");
                        $("#chnge_msg_error").html("<i class='fas fa-exclamation-triangle'></i><small>&nbsp;Given Name alredy exits.!</small>");
                    }
                    else if(data=="done")
                    {
                        $("#chnge_msg_error").css("display","block");
                        $("#chnge_msg_error").html("<img src='../../asset/images/imoji/imoji1.gif' class='img-fluid' style='width:60px;height:60px;'>"); 
                    }

                    load_employers();

                },error:function(error)
                {
                    $(".btn").css({pointerEvents: "auto"});
                    $(".waiter_emp_change").html("<i class='fas fa-check'></i>");

                    console.log(error);
                }
            });
        }
    });

    //End of change_user_values
    $(document).on("click","#chng_employee_btn_user_and_pwd",function(){

        $("#chnge_msg_error").css("display","none");
        $("#chnge_msg_error").html("<i class='fas fa-exclamation-triangle'></i><small>&nbsp;Details Not Enough </small>");


        if(($("#chn_user").val()!="" && $("#chn_pwd").val()=="") || ($("#chn_user").val()=="" && $("#chn_pwd").val()!=""))
        {
            $("#chnge_msg_error").css("display","block");
            $("#chnge_msg_error").html("<i class='fas fa-exclamation-triangle'></i><small>&nbsp;Need to Provide Both user name and password</small>");
        }
        else
        {
            $(".btn").css({pointerEvents: "none"});
            $.ajax({
                type:"POST",
                url:"../../back_function/admin/employee/employee_function.php",
                data:{"chng_user_name":$("#chn_user").val(),"chng_password":$("#chn_pwd").val(),"chng_user_and_password_id":$("#chnge_user_id").val()},
                cache:false,
                success:function(data)
                {
                    if(data=="done")
                    {
                        $("#chnge_msg_error").css("display","block");
                        $("#chnge_msg_error").html("<img src='../../asset/images/imoji/imoji1.gif' class='img-fluid' style='width:60px;height:60px;'>"); 
                    }
                    else 
                    {
                        $("#chnge_msg_error").css("display","block");
                        $("#chnge_msg_error").html("<img src='../../asset/images/imoji/tenor.gif' class='img-fluid' style='width:60px;height:60px;'><small>&nbsp;You Entered User Name Already Exits.!</small>"); 
                    }
                    $(".btn").css({pointerEvents: "auto"});


                },error:function(error)
                {
                    $(".btn").css({pointerEvents: "auto"});
                    console.log(error);
                }
            });
        }
    });

    $(document).on("click",".de_activation_emp",function(){

        var id=$(this).attr("data-id");
        $(".btn").css({pointerEvents: "none"});

        $.ajax({
            type:"POST",
            url:"../../back_function/admin/employee/employee_function.php",
            data:{"deactivate_user":id},
            cache:false,
            success:function(data)
            {
                if(data=="done")
                {
                    load_employers();
                }

                $(".btn").css({pointerEvents: "auto"});

            },error:function(error)
            {
                $(".btn").css({pointerEvents: "auto"});
                console.log(error);
            }
        });
    });

    $(document).on("click",".activation_emp",function(){


        var id=$(this).attr("data-id");
        $(".btn").css({pointerEvents: "none"});

        $.ajax({
            type:"POST",
            url:"../../back_function/admin/employee/employee_function.php",
            data:{"activate_user":id},
            cache:false,
            success:function(data)
            {
            
                if(data=="done")
                {
                    load_employers();
                }
                $(".btn").css({pointerEvents: "auto"});

            },error:function(error)
            {
                $(".btn").css({pointerEvents: "auto"});
                console.log(error);
            }
        });
    });

    // Drop Employers
    $(document).on("click",".drop_emp",function(){

        var id=$(this).attr("data-id");
      
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this Action!",
            type: "input",
            showCancelButton: true,
            closeOnConfirm: false,
            inputPlaceholder: "Write something"
          }, function (inputValue) {
            if (inputValue === false) return false;
            if (inputValue === "") {
              swal.showInputError("You need to write Reason!");
              return false
            }
            else
            {
                $.ajax({
                    type:"POST",
                    url:"../../back_function/admin/employee/employee_function.php",
                    data:{"drop_this_users":id,"reason":inputValue},
                    cache:false,
                    success:function(data)
                    {   
                        if(data=="done")
                        {
                            load_employers();
                            swal("Deleted!", "User has been deleted.", "success");
                        }
                        $(".btn").css({pointerEvents: "auto"});
        
                    },error:function(error)
                    {
                        $(".btn").css({pointerEvents: "auto"});
                        console.log(error);
                    }
                }); 
             }
          });      
    });

    //Get Employees Details

    $(document).on("click",".find_emp",function(){

        if($("#find_emp").val()=="")
        {
            swal("Fail!", "Need a employee number!", "error")
        }
        else
        {
            $(".btn").css({pointerEvents: "none"});
            $("#get_emp_info").modal("show");
            $(".emp_details_loader").css("display","block");
            $(".emp_details").css("display","none");

            $.ajax({
                type:"post",
                url:"../../back_function/admin/employee/employee_function.php",
                data:{'get_emp_info':$("#find_emp").val()},
                cache:false,
                success:function(data)
                {
                    $(".btn").css({pointerEvents: "auto"});
                    $(".emp_details_loader").css("display","none");
                    $(".emp_details").css("display","block");
                    
                    data=JSON.parse(data);

                    console.log(data);
                    $("#emp_infomation").html("");
                    $("#emp_infomation").append("<tr><td>Name</td><td>:</td><td>"+data[0]["name"]+"</td></tr>");
                    $("#emp_infomation").append("<tr><td>Employee Number</td><td>:</td><td>"+data[0]["emp_number"]+"</td></tr>");
                    $("#emp_infomation").append("<tr><td>Designation</td><td>:</td><td>"+data[0]["designtion__name"]+"</td></tr>");
                    $("#emp_infomation").append("<tr><td>NIC Number</td><td>:</td><td>"+data[0]["nic"]+"</td></tr>");
                    $("#emp_infomation").append("<tr><td>Address</td><td>:</td><td>"+data[0]["address"]+"</td></tr>");
                    $("#emp_infomation").append("<tr><td>Teli-Phone Number</td><td>:</td><td>"+data[0]["tp"]+"</td></tr>");
                    $("#emp_infomation").append("<tr><td>E-Mail</td><td>:</td><td>"+data[0]["mail"]+"</td></tr>");
                    $("#emp_infomation").append("<tr><td>EPF-Number</td><td>:</td><td>"+data[0]["epf_number"]+"</td></tr>");
                    $("#emp_infomation").append("<tr><td>Profile</td><td>:</td><td>"+data[0]["profile"]+"</td></tr>");
                    $("#emp_infomation").append("<tr><td>Accessible DEPT List</td><td>:</td><td>"+data[0]["dept_list"]+"</td></tr>");
                    $("#emp_infomation").append("<tr><td>Started Date</td><td>:</td><td>"+data[0]["added_date"]+"</td></tr>");

                    if(data[0]["resignation_date"]==null || data[0]["resignation_date"]==undefined)
                    {
                        $("#emp_infomation").append("<tr><td>Resigned Date</td><td>:</td><td>Not yet resigned.</td></tr>");
                    }
                    else
                    {
                        $("#emp_infomation").append("<tr><td>Resigned Date</td><td>:</td><td>"+data[0]["resignation_date"]+"</td></tr>");
                        $("#emp_infomation").append("<tr><td>Resigned Reason</td><td>:</td><td>"+data[0]["resignation_reason"]+"</td></tr>");
                    }
                   
                },error:function(error)
                {
                    $(".btn").css({pointerEvents: "auto"});
                    $("#get_emp_info").modal("hide");
                }
            });
        }
    });


    //--click event for get emp_number
    $(document).on("click",".emp_info_click",function(){

        $("#find_emp").val($(this).text());

    });

});