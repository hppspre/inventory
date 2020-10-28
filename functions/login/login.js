$(document).ready(function(){

    $(document).on("click","#login_btn",function(){
       
        if($("#inputEmail").val()=="" || $("#inputPassword").val()=="")
        {
           if($("#inputEmail").val()=="")
           {
                $("#inputEmail").css('border','1px solid red');
           }
           else
           {
                $("#inputPassword").css('border','1px solid red');
           }
        }
        else
        {
            $(".btn").prop("disabled",true);
            $("#login_btn").html("").text("");
            $("#login_btn").html("<img src='asset/images/loader/Gear-0.8s-200px.svg' height='30px' weight='30px'>");
            $.ajax({
               type:"POST",
               url:"back_function/admin/admin_function.php",
               data:{"user_name":$("#inputEmail").val(),"passowrd":$("#inputPassword").val()},
               cache:false,
               success:function(data)
               {
                    $(".btn").prop("disabled",false);
                    $("#login_btn").html("").text("SIGN IN");

                    if(data=="wrong_password")
                    {
                        $("#inputPassword").css('border','1px solid red');
                    }
                    else if(data=="admin_ok")
                    {
                        window.location.href = 'views/admin/index.php';      
                    }
                    else
                    {
                        window.location.href = 'views/users/index.php';      
                    }
                    
               },error:function(error)
               {
                    console.log(error);
                    $(".btn").prop("disabled",false);
               }
            });
            
        }
        $(".form-control").keyup(function(){
            $("#"+$(this).attr("id")).css('border','1px solid #21252985');
        }); 

    });

});