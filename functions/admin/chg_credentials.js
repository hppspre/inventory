$(document).ready(function(){
        
  $(document).on("click","#chnge_credentials",function(){

    if($("#user_name").val()=="" || $("#previous_password").val()=="" || $("#new_password").val()=="")
    {
        
        $("#error_msg_chng_credentials").css("display","block");
        $("#error_msg_chng_credentials").html("<img src='../../asset/images/imoji/angry.gif' class='img-fluid' style='width:60px;height:60px;'>&nbsp;&nbsp;<small style='color:red'> Details Need..!</small>");    
    }
    else
    {
       
            $("#error_msg_chng_credentials").css("display","block");
            $("#error_msg_chng_credentials").html("<img src='../../asset/images/imoji/waitingemoji.gif' class='img-fluid' style='width:60px;height:60px;'>&nbsp;&nbsp;<small style='color:black'> Ok Wait..!</small>");    
            $(".btn").css( 'pointer-events','none');
            $.ajax({
                type:"POST",
                url:"../../back_function/admin/admin_credentials/admin_credentials_function.php",
                data:{"user_name":$("#user_name").val(),"privious_password":$("#previous_password").val(),"new_password":$("#new_password").val()},
                cache:false,
                success:function(data)
                {
                    $(".btn").css('pointer-events','auto');

                    if(data=="already")
                    {
                        $("#error_msg_chng_credentials").css("display","block");
                        $("#error_msg_chng_credentials").html("<img src='../../asset/images/imoji/tenor.gif' class='img-fluid' style='width:60px;height:60px;'>&nbsp;&nbsp;<small style='color:black'> Ok Wait..!</small>");    
                    }
                    else if(data=="wrong_privious")
                    {
                        $("#error_msg_chng_credentials").css("display","block");
                        $("#error_msg_chng_credentials").html("<img src='../../asset/images/imoji/angry.gif' class='img-fluid' style='width:60px;height:60px;'>&nbsp;&nbsp;<small style='color:black'>I can't do without the previous password>!</small>");    
                   
                    }
                    else if(data=="done")
                    {
                        $("#error_msg_chng_credentials").css("display","block");
                        $("#error_msg_chng_credentials").html("<img src='../../asset/images/imoji/imoji1.gif' class='img-fluid' style='width:60px;height:60px;'>&nbsp;&nbsp;<small style='color:black'></small>");    
                    }
    
                },error:function(error)
                {
                    $(".btn").css('pointer-events','auto');
                    console.log(error);
                }
            });
   
    }


  });

});