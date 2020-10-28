$(document).ready(function(){
    function load_routs()
    {
        $.ajax({
            type:"post",
            url:"../../back_function/admin/routs/routs_function.php",
            data:{"load_routs":""},
            cache:false,
            success:function(data)
            {
                data=JSON.parse(data);
                $("#route_lister").html("");
                for(var i=0;i<data.length;i++)
                {
                    $("#route_lister").append("<tr>");
                    $("#route_lister").append("<td>"+data[i]["rout_description"]+"</td>");
                    $("#route_lister").append("<td>"+data[i]["genaral_km"]+"</td>");
                    $("#route_lister").append("<td><button class='btn btn-success btn-block rout_edid_btn' data-id="+data[i]["id"]+">EDIT</td>");
                    $("#route_lister").append("</tr>");
                }

            },error:function(error)
            {
                console.log(error);
            }
        });
    }

    load_routs();

    $(document).on("click",".rout_saver",function(){

        $("#error_of_route").css("display","none");

        if($("#rout_description").val()=="" || $("#genaral_km").val()=="")
        {
            
            $("#error_of_route").css("display","block");
            $("#error_of_route").html("<img src='../../asset/images/imoji/angry.gif' class='img-fluid' style='width:60px;height:60px;'><small>&nbsp;*Details Need..!</small>");     
        }  
        else
        {
            $('.btn').css('pointer-events','none');

            $.ajax({
                type:"POST",
                url:"../../back_function/admin/routs/routs_function.php",
                data:{"Rout_name":$("#rout_description").val(),"gkm":$("#genaral_km").val()},
                cache:false,
                success:function(data)
                {
                    $('.btn').css('pointer-events','auto');
                    $("#rout_description").val("");
                    $("#genaral_km").val("")

                    if(data=="done")
                    {
                        $("#error_of_route").css("display","block");
                        $("#error_of_route").html("<img src='../../asset/images/imoji/imoji1.gif' class='img-fluid' style='width:60px;height:60px;'><small>&nbsp;</small>");     
                        load_routs();
                    }
                    else if(data=="already")
                    {
                        $("#error_of_route").css("display","block");
                        $("#error_of_route").html("<img src='../../asset/images/imoji/tenor.gif' class='img-fluid' style='width:60px;height:60px;'><small>&nbsp;*Already Exits..!</small>");     
                    
                    }

                },error:function(error)
                {
                    console.log(error);
                    $('.btn').css('pointer-events','auto');

                }
            });
        } 
    });

    // ----------Change Route Details-----------------------------
    $(document).on("click",".rout_edid_btn",function(){

        $("#change_error_of_route").css("display","none");
        $("#error_of_route").css("display","none");

        $("#change_rout_description").val("");
        $("#change_genaral_km").val("");
        $("#chng_routs").modal("show");
        $(".rout_changer").attr("data-id",$(this).attr("data-id"));

    });

    $(document).on("click",".rout_changer",function(){


        if($("#change_rout_description").val()=="" && $("#change_genaral_km").val()=="")
        {
            $("#change_error_of_route").css("display","block");
            $("#change_error_of_route").html("<img src='../../asset/images/imoji/angry.gif' class='img-fluid' style='width:60px;height:60px;'><small>&nbsp;*Details Need..!</small>");     
        
        }
        else
        {
            $('.btn').css('pointer-events','none');

            $.ajax({
                type:"POST",
                url:"../../back_function/admin/routs/routs_function.php",
                data:{"chn_rout_id": $(".rout_changer").attr("data-id"),"chn_description":$("#change_rout_description").val(),"chn_genaral_kms":$("#change_genaral_km").val()},
                cache:false,
                success:function(data)
                {
                    console.log(data);
                    if(data=="done")
                    {
                        $("#change_error_of_route").css("display","block");
                        $("#change_error_of_route").html("<img src='../../asset/images/imoji/imoji1.gif' class='img-fluid' style='width:60px;height:60px;'><small>&nbsp;*Details Need..!</small>");     
                        load_routs();
                    }
                    else if(data=="already")
                    {
                        $("#change_error_of_route").css("display","block");
                        $("#change_error_of_route").html("<img src='../../asset/images/imoji/tenor.gif' class='img-fluid' style='width:60px;height:60px;'><small>&nbsp;*Already Exits..!</small>");     
                    }
                    $('.btn').css('pointer-events','auto');


                },error:function(error)
                {
                    console.log(error);
                    $('.btn').css('pointer-events','auto');

                }

            });
        }


    });


        
});