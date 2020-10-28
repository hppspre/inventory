$(document).ready(function(){

    function get_pending_order_count()
    {
        
        $.ajax({
            type:"POST",
            url:"../../back_function/admin/donations/donation_function.php",
            data:{"load_new_donation":""},
            cache:false,
            success:function(data)
            {
                data=JSON.parse(data);
                $(".fs_count").text(data.length);

    
            },error:function(error)
            {
                console.log(error);
            }
        });
    }
    
    get_pending_order_count();
    setInterval(get_pending_order_count,5000);


});