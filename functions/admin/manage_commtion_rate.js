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
                var desigantions="";

                $("#discount_manage_list").html("");
                $(".select_designation_to_change").html("");

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

            },error:function(error)
            {
                console.log(error);
                location.reload();
            }

        });
    }

    // to get commission rates again
    load_designation();



    //Here going to manage commission rate of sales designation
    $(document).on("click",".discounter_chg_btn",function(){

        $("#msg_error_commission").html("");
        var val=parseInt($(".discounter"+$(this).attr("data-id")).val());
        if(isNaN(val))
        {
            $("#msg_error_commission").html("<i class='fas fa-exclamation-triangle'></i><small>&nbsp;Need a Commtion Rate</small>");
        }
        else if(val>100)
        {
            $("#msg_error_commission").html("<i class='fas fa-exclamation-triangle'></i><small>&nbsp;The commission should be less than 100%.</small>");
        }
        else if(val==null || val==undefined)
        {
            $("#msg_error_commission").html("<i class='fas fa-exclamation-triangle'></i><small>&nbsp;Need a Commission Rate.</small>");
        }
        else
        {
            $(".discounter_chg_btn").prop("disabled",true);
            $.ajax({
                type:"post",
                url:"../../back_function/admin/employee/employee_function.php",
                data:{"chng_commission":val,"commission_id":$(this).attr("data-id")},
                cache:false,
                success:function(data)
                {
                    $(".discounter_chg_btn").prop("disabled",false);
                    if(data=="done")
                    {
                        load_designation();
                        $("#msg_error_commission").html("").html("<i class='fas fa-heart'></i><small style='color:green'>&nbsp;Changed :) ..!</small>");
                    }

                },error:function(error)
                {
                    console.log(error);
                }

            });
        }
    });
    //End of the manage commission rate 
});