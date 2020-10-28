$(document).ready(function(){


    function load_pending_orders()
    {
        $("#new_donation_list").html("");
        $("#loader_donation").modal("hide");

        $.ajax({
            type:"POST",
            url:"../../back_function/admin/donations/donation_function.php",
            data:{"load_new_donation":""},
            cache:false,
            success:function(data)
            {
                data=JSON.parse(data);
                $("#new_donation_list").html("");
                for(var i=0;i<data.length;i++)
                {
                    $("#new_donation_list").append("<tr>");
                    $("#new_donation_list").append("<td>"+data[i]['date_make_donation']+"</td>");
                    $("#new_donation_list").append("<td><button class='btn btn-success donate_info' data-id="+data[i]["id"]+" data-cus_name="+data[i]["customer_name"]+" data-cus_address="+data[i]["customer_address"]+" data-cus_phone="+data[i]["customer_phone"]+">GET INFO</button></td>");
                    $("#new_donation_list").append("</tr>");
                }
            
            },error:function(error)
            {
                
                console.log(error);
            }
        });
    }
    
    load_pending_orders();
    
    setInterval(load_pending_orders,5000);

    $(document).on("click",".donate_info",function(){

        var id=$(this).attr("data-id");

        var customer_name=$(this).attr("data-cus_name");
        var customer_address=$(this).attr("data-cus_address");
        var customer_phone=$(this).attr("data-cus_phone");

        $(".complete_with_a_print").attr("data-id",id);
        $(".complete_without_a_print").attr("data-id",id);
    
        $("#loader_donation").modal("show");

        $.ajax({
            type:"POST",
            url:"../../back_function/admin/donations/donation_function.php",
            data:{"load_a_donation":id},
            cache:false,
            success:function(data)
            {
                data=JSON.parse(data);
                data=JSON.parse(data[0]["donation_data"]);

                $("#loader_donation").modal("hide");
                $("#donation_details").html("");
                

                var table_content="";
               
                table_content="<div style='text-align:left;'>Donate For</div>";
                table_content+="<table class='table table-bordered' style='border:none;text-align:left;'>";
             
                table_content+="<tr style='border:none;text-align:left;'>";
                    table_content+="<td style='border:none;text-align:left;'>";
                    table_content+=customer_name;
                    table_content+="</td>";
                    table_content+="<td style='border:none;text-align:left;'>";
                    table_content+=customer_address;
                    table_content+="</td>";
                    table_content+="<td style='border:none;text-align:left;'>";
                    table_content+=customer_phone;
                    table_content+="</td>";
                table_content+="</tr>";
                table_content+="</table>";
                table_content+="<hr>";
                

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
                        table_content+="<td>"+data[i]["bulk_selected_qty"]+".ML"+"</td>";
                    }
                    
                    table_content+="</tr>"; 
                }
                $("#donation_details").html(table_content);
                $(".print_option").css("display","block");


            },error:function(error)
            {
                console.log(error);
                $("#loader_donation").modal("hide");

            }
          });
    });


    // Completed
    $(document).on("click",".complete_with_a_print",function(){

        $("#print_iframe").contents().find('head').html("");
        $("#print_iframe").contents().find('body').html("");

        $("#print_iframe").contents().find('head').append("<style>small{text-align:left}body{text-align: center; paddin:5px;}table{width:100%;}table, th, td {border: 1px dotted black;border-collapse:collapse;padding: 10px;text-align: left;}table.center { margin-left:auto; margin-right:auto; }img{display: block !important; @media print{img{display: block !important;}} </style>");
        $("#print_iframe").contents().find('body').append($("#print_area").html());
        $("#print_iframe").contents().find('#footer_table').css({"border":"none","position": "fixed","left": "0","bottom": "0","width": "100%","color": "white"});
  
        setTimeout(function() {
            document.getElementById("print_iframe").contentWindow.print(); 
        }, 250);

    });

    $(document).on("click",".complete_without_a_print",function(){


        var id=$(this).attr("data-id");
        $("#loader_donation").modal("show");

        $.ajax({
            type:"POST",
            url:"../../back_function/admin/donations/donation_function.php",
            data:{"donate_completetion_id":id},
            cache:false,
            success:function(data)
            {
                if(data=="ok")
                {
                    $("#loader_donation").modal("hide");
                    $("#complete_modal").modal("show");

                    $("#donation_details").html("");
                    $(".print_option").css("display","none");
                    load_pending_orders();
                }
          
            },error:function(error)
            {
                $("#loader_donation").modal("hide");
                $("#complete_modal").modal("hide");

                $("#donation_details").html("");
                $(".print_option").css("display","none");

                console.log(error);
            }

        });
        
    });

});