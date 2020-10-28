$(document).ready(function(){
    // -------------------------------------In Here used donation functions--------------------------------------------------------------
    
    function customer_reseter()
    {
        $(".fsc_info").prop("readonly",false);
        $(".list_of_customers").prop("disabled",true);
        $(".fsc_info").val("");
        $("#customer_checker").prop("checked",false);
    }

   
    var make_counter="";

    for(var i=0;i<=100;i++)
    {
        make_counter+="<option value="+i+">"+i+"</option>";
    }

    var customers_list="";
    function load_existing_customer() {
      
        $("#loader_donation").modal("show");
        // load cutomers list
        $.ajax({
            type:"POST",
            url:"../../back_function/admin/factory_sales/factory_sales_function.php",
            data:{"load_customers":""},
            cache:false,
            success:function(data)
            {
                $("#loader_donation").modal("hide");
                data=JSON.parse(data);
            
                for(var i=0;i<data.length;i++)
                {
                    customers_list+="<option value="+data[i]["customer_name"]+" data-id="+data[i]["id"]+" data-discount_offers="+data[i]["special_offers"]+" data-discount_rate="+data[i]["discount_satatus"]+" data-phone="+data[i]["customer_phone"]+" data-address="+data[i]["customer_address"]+" data-name="+data[i]["customer_name"]+">"+data[i]["customer_name"]+"</option>";
                }    

            },error:function(error)
            {
                console.log(error);
                $("#loader_donation").modal("hide");
            }
        });
    }

    load_existing_customer();

    function load_next_invoice_id()
    {
        $.ajax({
            type:"POST",
            url:"../../back_function/user/factory_sales/factory_sales_function.php",
            data:{"load_next_invoice_id":""},
            cache:false,
            success:function(data)
            {   
                $("#invoice_id").text(data);

            },error:function(error)
            {
                console.log(error);
            }
        });
    }


    load_next_invoice_id();

   

    // ------------------------------------------------------------------------------------------------------------------------------------------

    $("#loader_donation").modal("show");

    function load_items_for_donation()
    {
        $.ajax({
            type:"POST",
            url:"../../back_function/admin/donations/donation_function.php",
            data:{"load_items":""},
            cache:false,
            success:function(data)
            {
                data=JSON.parse(data);
                
                // Make Content
                var content="";
                var classes_list=new Array("bg-success","bg-primary","bg-warning","bg-dark");
                var counter=0;

                for(var i=0;i<data.length;i++)
                {
                    content+="<tr style='cursor:crosshair;' class='select_donation_item' id='item_no"+i+"' data-qty="+data[i]["qty"]+" data-bulk_qty="+data[i]["leters_quantity"]+"  data-bulk_cost="+data[i]["bulk_cost"]+" data-item_type="+data[i]["item_type"]+" data-qty="+data[i]["qty"]+" data-cost="+data[i]["items_cost"]+"  data_item_id="+data[i]["id"]+" data_object-id="+i+" data-item_name="+data[i]["items_name"]+" data-unit_price="+data[i]["items_retails_price"]+" data-bulk_price="+data[i]["bulk_price"]+">";
                    content+="<td>";
                    content+="<div class='icon-circle "+classes_list[counter]+"'><span class='badge badge-light'>"+data[i]["qty"]+"</span></div></td>";
                    
                    if(data[i]["item_type"]=="item")
                    {
                        content+="<td><div class='icon-circle "+classes_list[counter]+"'><span class='badge badge-light'>"+data[i]["leters_quantity"]+"</span></div></td>";
                    }
                    else
                    {
                        content+="<td><div class='icon-circle "+classes_list[counter]+"'><span class='badge badge-light'>EMPTY</span></div></td>";
                    }

                    content+="<td><div class='icon-circle'>"+data[i]["items_name"]+"<br>"+data[i]["item_code"]+"</div></td>";
                    content+="</tr>";

                    counter++;
                    if(counter==4)
                    {
                        counter=0;
                    }
                }

                $("#loader_donation").modal("hide");
                $("#items_lister").html(content);

            },error:function(error)
            {
                console.log(error);
                $("#loader_donation").modal("hide");
            }

        });
    }

    load_items_for_donation();

  

    var selected_items=new Array();



    function make_table(selected_items)
    {
        customer_reseter(); //-----------------Clear Customer Details............
        $("#donte_items").html("");
        $("#finalized_section").css("display","none");
       
        var custermer_content="<div class='card'><div class='card-body'><div class='row'><div class='col-md-12'><div class='row'><div class='col-md-10'><input list='list_of_customers' class='form-control fsc_info list_of_customers' autocomplete='none' disabled><datalist id='list_of_customers'></datalist></div><div class='col-md-2'> <input type='checkbox' class='form-control' id='customer_checker'></div></div></div>";
        custermer_content+="<div class='col-md-12'><input type='hidden' id='fc_customer_id'></div><div class='col-md-12'><lable class='small'>Customer Name</lable><input type='text' class='form-control fsc_info' id='fc_customer_name' ></div>";
        custermer_content+="<div class='col-md-12'><lable class='small'>Customer Address</lable><input type='text' class='form-control fsc_info' id='fc_customer_address' ></div>";
        custermer_content+="<div class='col-md-12'><lable class='small'>Customer Phone</lable><input type='text' class='form-control fsc_info' id='fc_customer_phone' ><hr></div>";
        custermer_content+="<div class='col-md-6'><lable class='small'>Discount Rate[%]</lable><select class='form-control fsc_info' id='fc_customer_discount'></select></div>";
        custermer_content+="<div class='col-md-6'><lable class='small'>Special Offer Rate[%]</lable><select class='form-control fsc_info' id='fc_customer_special_offers'></select></div></div></div></div>";

        // --Make Table 
        var seleted_content="";

        for(var i=0;i<selected_items.length;i++)
        {
            seleted_content+="<tr>";
            seleted_content+="<td>";
            seleted_content+=selected_items[i]["item_name"];
            seleted_content+="</td>";

            seleted_content+="<td>";
            seleted_content+=selected_items[i]["unit_selected_qty"];
            seleted_content+="</td>";

            seleted_content+="<td>";
            seleted_content+=selected_items[i]["bulk_selected_qty"];
            seleted_content+="</td>";

            seleted_content+="<td>";
            seleted_content+=selected_items[i]["price"];
            seleted_content+="</td>";

            seleted_content+="<td>";
            seleted_content+=selected_items[i]["status"];
            seleted_content+="</td>";

            seleted_content+="<td>";
            seleted_content+="<button class='btn  btn-success btn-block edit' data-mbqty="+selected_items[i]["bulk_qty"]+" data-mqty="+selected_items[i]["unit_qty"]+" data-type="+selected_items[i]["type"]+" data-id="+i+">Edit</button>";
            seleted_content+="</td>";

            seleted_content+="<td>";
            seleted_content+="<button class='btn  btn-danger btn-block drop' data-id="+i+" data-previous_obj="+selected_items[i]["object_id"]+">Drop</button>";
            seleted_content+="</td>";
            seleted_content+="</tr>";
        }

        $("#donte_items").html("<div class='card'><div class='card-body'><table class='table table-bordered table-sm'><tr><td>Name</td><td>Unit Qty</td><td>Bulk Qty[ML]</td><td>Price</td><td>Status</td><td>Edit</td><td>Drop</td></tr><tbody>"+seleted_content+"</tbody></table></div></div>"+custermer_content+"<hr><div id='error_of_saver'></div><div class='card'><div class='card-body'><button class='btn btn-block btn-primary' id='save_factory_sales'>Check Above Details...!</button</div></div>");  
        $("#list_of_customers").html(customers_list);
        $("#fc_customer_discount").html(make_counter);
        $("#fc_customer_special_offers").html(make_counter);
    }


    $(document).on("click",".select_donation_item",function(){


        var object_id=$(this).attr("data_object-id");
        var items_id=$(this).attr("data_item_id");
        var item_name=$(this).attr("data-item_name");

        var unit_cost=$(this).attr("data-cost");
        var bulk_cost=$(this).attr("data-bulk_cost");

        var unit_price=$(this).attr("data-unit_price");
        var bulk_price=$(this).attr("data-bulk_price");

        var unit_quantity=$(this).attr("data-qty");
        var bulk_quantity=$(this).attr("data-bulk_qty");
        var item_type=$(this).attr("data-item_type");

        
        //---Insert a Object
        selected_items.push({"object_id":object_id,"item_id":items_id,"item_name":item_name,"unit_cost":unit_cost,"bulk_cost":bulk_cost,"unit_qty":unit_quantity,"unit_price":unit_price,"bulk_price":bulk_price,"bulk_qty":bulk_quantity,"unit_selected_qty":0,"bulk_selected_qty":0,"type":item_type,"status":"Not_Confirm","price":0,"cost":0,"methode":"not","return_qty":0});
        
        //disable related_row
        $("#item_no"+object_id).css('pointer-events','none');
        $("#item_no"+object_id).css('cursor', 'not-allowed');

        make_table(selected_items);
    });

    $(document).on("click",".drop",function(){

        $("#item_no"+$(this).attr("data-previous_obj")).css('pointer-events','auto');
        $("#item_no"+$(this).attr("data-previous_obj")).css('cursor', 'crosshair');

        selected_items.splice($(this).attr("data-id"),1);
        make_table(selected_items);

        if(selected_items.length==0)
        {
            $("#donte_items").html("");
            $("#error_of_confirmation").html("");
            $("#finalized_section").css("display","none");
        }
    });

    function make_item_manager_content()
    {
        $("#dontate_qty").val("");
        $("#dontate_bulk_qty").val("");

        $("#dontate_qty").prop("readonly",false);
        $("#dontate_bulk_qty").prop("readonly",true);

        $("#unit_bulk").prop("selectedIndex",0);
    }


    var id_of_array="";
   

    $(document).on("click",".edit",function(){

        $("#error_of_confirmation").css("display","none");
        
        id_of_array=$(this).attr("data-id");
        make_item_manager_content();

        if($(this).attr("data-type")=="item")
        {
            $("#unit_bulk").prop("disabled",false);
        }   
        else if($(this).attr("data-type")=="eitem")
        {
            $("#unit_bulk").prop("disabled",true);
        }

        $("#dontate_qty").attr("placeholder",$(this).attr("data-mqty"));        
        $("#dontate_bulk_qty").attr("placeholder",$(this).attr("data-mbqty"));
        $("#edit_object").modal("show");
        
    });

    $(document).on("change","#unit_bulk",function(){

            $("#dontate_qty").val("");
            $("#dontate_bulk_qty").val("");

            if($(this).val()=="unit")
            {
                $("#dontate_qty").prop("readonly",false);
                $("#dontate_bulk_qty").prop("readonly",true);
            }
            else
            {
                $("#dontate_qty").prop("readonly",true);
                $("#dontate_bulk_qty").prop("readonly",false);
            }
    });

    $(document).on("keyup","#dontate_qty",function(){
         if((parseInt($(this).val()))>(parseInt($(this).attr("placeholder"))))
         {
            $(this).val("");
         }   
    });

    $(document).on("keyup","#dontate_bulk_qty",function(){

        if((parseInt($(this).val()))>(parseInt($(this).attr("placeholder"))))
        {
           $(this).val("");
        }   
    });

    //-------Confirm Item-----------------------------

    $(document).on("click",".confirm_item",function(){

        $("#donate_error").css("display","none");
    
        if($("#unit_bulk").val()=="unit")
        {
            if($("#dontate_qty").val()=="")
            {

                $("#donate_error").css("display","block");
                $("#donate_error").html("<img src='../../asset/images/imoji/angry.gif' class='img-fluid' style='width:50px;height:50px;'><small>&nbsp;Need Quantity</small><hr>"); 
                
            }
            else
            {
                selected_items[id_of_array]["unit_selected_qty"]=0;
                selected_items[id_of_array]["bulk_selected_qty"]=0;
                selected_items[id_of_array]["price"]=0;
                selected_items[id_of_array]["cost"]=0;

                selected_items[id_of_array]["unit_selected_qty"]=$("#dontate_qty").val();
                selected_items[id_of_array]["status"]="confirmed";
                selected_items[id_of_array]["methode"]="unit";

                selected_items[id_of_array]["price"]=(parseInt(selected_items[id_of_array]["unit_selected_qty"])*parseInt(selected_items[id_of_array]["unit_price"]));
                selected_items[id_of_array]["cost"]=(parseInt(selected_items[id_of_array]["unit_selected_qty"])*parseInt(selected_items[id_of_array]["unit_cost"]));

                make_table(selected_items);

                $("#donate_error").css("display","block");
                $("#donate_error").html("<img src='../../asset/images/imoji/imoji1.gif' class='img-fluid' style='width:50px;height:50px;'><small>&nbsp;</small><hr>"); 
            
            }
        }
        else
        {
            if($("#dontate_bulk_qty").val()=="")
            {
                $("#donate_error").css("display","block");
                $("#donate_error").html("<img src='../../asset/images/imoji/angry.gif' class='img-fluid' style='width:50px;height:50px;'><small>&nbsp;Need Quantity</small><hr>"); 
            
            }
            else
            {
                selected_items[id_of_array]["unit_selected_qty"]=0;
                selected_items[id_of_array]["bulk_selected_qty"]=0;
                selected_items[id_of_array]["price"]=0;
                selected_items[id_of_array]["cost"]=0;


                selected_items[id_of_array]["bulk_selected_qty"]=$("#dontate_bulk_qty").val();
                selected_items[id_of_array]["status"]="confirmed";
                selected_items[id_of_array]["methode"]="bulk";

                selected_items[id_of_array]["price"]=((parseInt(selected_items[id_of_array]["bulk_price"]))/1000)*(parseInt(selected_items[id_of_array]["bulk_selected_qty"]));
                selected_items[id_of_array]["cost"]=((parseInt(selected_items[id_of_array]["bulk_cost"]))/1000)*(parseInt(selected_items[id_of_array]["bulk_selected_qty"]));


                make_table(selected_items);

                $("#donate_error").css("display","block");
                $("#donate_error").html("<img src='../../asset/images/imoji/imoji1.gif' class='img-fluid' style='width:50px;height:50px;'><small>&nbsp;</small><hr>"); 
            
            }
        }
    });

    // ----------------Here going to manage factory sales customers----------------------------------------


    // ----------------Customer Checker--------------------------------------------------------------------

   

    $(document).on("click","#customer_checker",function(){

        $("#finalized_section").css("display","none");
        $(".final_prices").val("");

        if($("#customer_checker").prop("checked")==true)
        {
            customer_reseter();
            $(".fsc_info").prop("disabled",true);
            $("#customer_checker").prop("checked",true);
            $(".list_of_customers").prop("disabled",false);
        }
        else
        {
            customer_reseter();
            $(".fsc_info").prop("disabled",false);
            $(".list_of_customers").prop("disabled",true);
            $("#customer_checker").prop("checked",false);
        }
    });


    //-----------------Select special customer--------------------------------------------------------------

    $(document).on("change",".list_of_customers",function(){

        $(".final_prices").val("");
        $("#finalized_section").css("display","none");


        var id=$("#list_of_customers [value='"+$(".list_of_customers").val()+"']").data("id");
        var name=$("#list_of_customers [value='"+$(this).val()+"']").data("name");
        var address=$("#list_of_customers [value='"+$(this).val()+"']").data("address");
        var phone=$("#list_of_customers [value='"+$(this).val()+"']").data("phone");
        var discount_rate=$("#list_of_customers [value="+$(this).val()+"]").data("discount_rate");
        var offer=$("#list_of_customers [value="+$(this).val()+"]").data("discount_offers");

        

        $("#fc_customer_id").val(id);
        $("#fc_customer_name").val(name);
        $("#fc_customer_address").val(address);
        $("#fc_customer_phone").val(phone);
        $("#fc_customer_discount").val(discount_rate);
        $("#fc_customer_special_offers").val(offer);

    });

    // ----------------Here going to manage factory sales customers----------------------------------------


    // ----------------Finalized Factory Sales-------------------------------------------------------------

    var finalized_data=new Array();

   

    $(document).on("click","#save_factory_sales",function(){
  
        $("#error_of_saver").css("display","none");

        var flag=0;

        finalized_data=[]; //clear data
        finalized_data[0]=$("#fc_customer_id").val();//customer_id
        finalized_data[1]=$("#fc_customer_name").val();//customer_name
        finalized_data[2]=$("#fc_customer_address").val();//customer_address
        finalized_data[3]=$("#fc_customer_phone").val();//customer_phone
        finalized_data[4]=$("#fc_customer_discount").val();//customer_discount
        finalized_data[5]=$("#fc_customer_special_offers").val();//customer_offer
        finalized_data[6]=0;
        finalized_data[7]=0;

        for(var i=0;i<selected_items.length;i++)
        {
            if(selected_items[i]["status"]=="Not_Confirm")
            {
                $("#error_of_saver").css("display","block");
                $("#error_of_saver").html("<img src='../../asset/images/imoji/tenor.gif' class='img-fluid' style='width:50px;height:50px;'><small>&nbsp;Confirm items you forgot,Or Drop that Items...Please...</small><hr>"); 
                
                flag=1;
                break;
            }
            else
            {
                 finalized_data[6]+=parseInt(selected_items[i]["cost"])  //------------Cost------------------------
                 finalized_data[7]+=parseInt(selected_items[i]["price"])  //------------price------------------------
            }
        }

        if($("#customer_checker").prop("checked")==false)
        {
            finalized_data[0]="no";
        }


        for(var i=0;i<finalized_data.length;i++)
        {
            if((finalized_data[i].toString())=="")
            {
                $("#error_of_saver").css("display","block");
                $("#error_of_saver").html("<img src='../../asset/images/imoji/tenor.gif' class='img-fluid' style='width:50px;height:50px;'><small>&nbsp;Be Need Complete information..!</small><hr>");    
               
                flag=1;
                break;
            }

        }

        // console.log(finalized_data);

        if(flag==0)
        {
            $("#finalized_section").css("display","block");
            
            // remaker_discount
            finalized_data[8]=(parseInt(finalized_data[4])/100)*(parseInt(finalized_data[7]));
            //remake offer
            finalized_data[9]=(parseInt(finalized_data[5])/100)*(parseInt(finalized_data[7]));
            //final price
            finalized_data[10]=(parseInt(finalized_data[7]))-((parseInt(finalized_data[8]))+(parseInt(finalized_data[9]))); 

            $("#final_price").val(finalized_data[7]);
            $("#final_discount").val(finalized_data[8]);
            $("#final_offer").val(finalized_data[9]);
            $("#final_total").val(finalized_data[10]);
        }

    });

    function final_reseter()
    {
        load_next_invoice_id();
        load_items_for_donation();
        customer_reseter();
        $("#donte_items").html("");
        $("#finalized_section").css("display","none");
        selected_items=[];
        finalized_data=[];
        id_of_array="";
    }

    //------------------Get a Print Out--------------------------------------------------------

    function incoice_print(selected_items1,finalized_data1,next_invoice_id,method)
    {

        $("#next_invoice_id").text(next_invoice_id);

        var invoice_content="";
        invoice_content+="<table style='width:100%'>";
        invoice_content+="<tr>";
            invoice_content+="<td style='width:20%'>Item Name</td>";
            invoice_content+="<td style='width:20%'>Method</td>";
            invoice_content+="<td style='width:20%'>Quantity</td>";
            invoice_content+="<td style='width:20%'>Unit Price[LKR]</td>";
            invoice_content+="<td style='width:20%'>TOT Price[LKR]</td>";
        invoice_content+="</tr>";

        for(var i=0;i<selected_items1.length;i++)
        {
            if(selected_items1[i]["methode"]=="unit")
            {
                invoice_content+="<tr>";
                invoice_content+="<td style='width:20%'>"+selected_items1[i]["item_name"]+"</td>";
                invoice_content+="<td style='width:20%'>UNIT</td>";
                invoice_content+="<td style='width:20%'>"+selected_items1[i]["unit_selected_qty"]+"</td>";
                invoice_content+="<td style='width:20%'>"+selected_items1[i]["unit_price"]+"</td>";
                invoice_content+="<td style='width:20%'>"+((parseInt(selected_items1[i]["unit_selected_qty"]))*(parseInt(selected_items1[i]["unit_price"])))+"</td>";
                invoice_content+="</tr>";
            }
            else
            {
                invoice_content+="<tr>";
                invoice_content+="<td style='width:20%'>"+selected_items1[i]["item_name"]+"</td>";
                invoice_content+="<td style='width:20%'>BULK</td>";
                invoice_content+="<td style='width:20%'>"+selected_items1[i]["bulk_selected_qty"]+".ML</td>";
                invoice_content+="<td style='width:20%'>"+selected_items1[i]["bulk_price"]+"-1L</td>";
                invoice_content+="<td style='width:20%'>"+(((parseInt(selected_items1[i]["bulk_price"]))/1000)*(parseInt(selected_items1[i]["bulk_selected_qty"])))+"</td>";
                invoice_content+="</tr>";
            }
        }

        invoice_content+="</table>";

        $("#final_table").html(invoice_content); //--make table
        // make_printed_content
        $("#total_price").text(finalized_data1[7]);
        $("#total_discount").text(finalized_data1[8]);
        $("#total_offer").text(finalized_data1[9]);
        $("#total_payable_amount").text(finalized_data1[10]);

        $("#customer_name").html("Customer Name:<br>"+finalized_data1[1]);
        $("#customer_address").html("Customer Address<br>"+finalized_data1[2]);
        $("#customer_phone").html("Customer Phone<br>"+finalized_data1[3]);


        if(method=="yes")
        {
            if($("#fc_customer_name").val()=="" || $("#fc_customer_address").val()=="" || $("#fc_customer_phone").val()=="")
            {
                $("#error_of_saver").css("display","block");
                $("#error_of_saver").html("<img src='../../asset/images/imoji/tenor.gif' class='img-fluid' style='width:50px;height:50px;'><small>&nbsp;Need To Check Above Details..!</small><hr>");    
            }
            else if($("#final_prices").val()=="" || $("#final_discount").val()=="" || $("#final_offer").val()=="" || $("#final_total").val()=="")
            {
                $("#error_of_saver").css("display","block");
                $("#error_of_saver").html("<img src='../../asset/images/imoji/tenor.gif' class='img-fluid' style='width:50px;height:50px;'><small>&nbsp;Need To Check Above Details..!</small><hr>");    
            }
            else
            {
                $("#print_iframe").contents().find('head').html("");
                $("#print_iframe").contents().find('body').html("");
        
                $("#print_iframe").contents().find('head').append("<style>small{text-align:left}body{text-align: center; paddin:5px;}table{width:100%;}table, th, td {border: 1px dotted black;border-collapse:collapse;padding: 10px;text-align: left;}table.center { margin-left:auto; margin-right:auto; }img{display: block !important; @media print{img{display: block !important;}} </style>");
                $("#print_iframe").contents().find('body').append($("#print_area").html());
                $("#print_iframe").contents().find('#footer_table').css({"border":"none","position": "fixed","left": "0","bottom": "0","width": "100%","color": "white"});
          
                setTimeout(function() {
                    document.getElementById("print_iframe").contentWindow.print(); 
                }, 250);
            }
        }
        else 
        {
            $("#print_iframe").contents().find('head').html("");
                $("#print_iframe").contents().find('body').html("");
        
                $("#print_iframe").contents().find('head').append("<style>small{text-align:left}body{text-align: center; paddin:5px;}table{width:100%;}table, th, td {border: 1px dotted black;border-collapse:collapse;padding: 10px;text-align: left;}table.center { margin-left:auto; margin-right:auto; }img{display: block !important; @media print{img{display: block !important;}} </style>");
                $("#print_iframe").contents().find('body').append($("#print_area").html());
                $("#print_iframe").contents().find('#footer_table').css({"border":"none","position": "fixed","left": "0","bottom": "0","width": "100%","color": "white"});
          
                setTimeout(function() {
                    document.getElementById("print_iframe").contentWindow.print(); 
                }, 250);
        }
    }


    $(document).on("click",".print_out",function(){

        var flag=0;

        $("#error_of_saver").css("display","none");

        for(var i=0;i<finalized_data.length;i++)
        {
            if((finalized_data[i].toString())=="" || (finalized_data[i].toString())==undefined || (finalized_data[i].toString())==null)
            {
                flag=1;
                $("#error_of_saver").css("display","block");
                $("#error_of_saver").html("<img src='../../asset/images/imoji/tenor.gif' class='img-fluid' style='width:50px;height:50px;'><small>&nbsp;Need To Complete information..!</small><hr>");    
                break;
            }
        }

        if(flag==0)
        {
            var next_invoice_id=$("#invoice_id").text();
            incoice_print(selected_items,finalized_data,next_invoice_id,"yes");
            //----Here YES is flag get invoice or print Invoice---------------
        }
    });


    // -------------------------Complete Factory Sales----------------------------------------

    $(document).on("click",".complete_without_print",function(){

        var flag=0;
        $("#error_of_saver").css("display","none");
        
        for(var i=0;i<finalized_data.length;i++)
        {

            if((finalized_data[i].toString())=="" || (finalized_data[i].toString())==undefined || (finalized_data[i].toString())==null)
            {
                flag=1;
                $("#error_of_saver").css("display","block");
                $("#error_of_saver").html("<img src='../../asset/images/imoji/tenor.gif' class='img-fluid' style='width:50px;height:50px;'><small>&nbsp;Need To Complete information..!</small><hr>");    
                break;
            }
        }

  
        if(flag==0)
        {
            if($("#fc_customer_name").val()=="" || $("#fc_customer_address").val()=="" || $("#fc_customer_phone").val()=="")
            {   
                $("#error_of_saver").css("display","block");
                $("#error_of_saver").html("<img src='../../asset/images/imoji/tenor.gif' class='img-fluid' style='width:50px;height:50px;'><small>&nbsp;Need To Check Above Details..!</small><hr>");    
            }
            else if($("#final_prices").val()=="" || $("#final_discount").val()=="" || $("#final_offer").val()=="" || $("#final_total").val()=="")
            {
                $("#error_of_saver").css("display","block");
                $("#error_of_saver").html("<img src='../../asset/images/imoji/tenor.gif' class='img-fluid' style='width:50px;height:50px;'><small>&nbsp;Need To Check Above Details..!</small><hr>");    
            }
            else
            {
               
                $("#loader_donation").modal("show");

                var returned_object=new Array();
                
                // ---------------------Complete------------------------------------------
                $.ajax({
                    type:"POST",
                    url:"../../back_function/user/factory_sales/factory_sales_function.php",
                    data:{"sales_items":JSON.stringify(selected_items),"other_sales_data":JSON.stringify(finalized_data),"returned_obj":JSON.stringify(returned_object)},
                    cache:false,
                    success:function(data)
                    {
                        if(data=="ok")
                        {
                            final_reseter(); 
                            $("#completed_factory_sales").modal("show");  
                        }
                        
                        $("#loader_donation").modal("hide");

                    },error:function(error)
                    {
                        console.log(error);
                        $("#loader_donation").modal("hide");

                    }
                });

            }
        }
    });
    
    // -------------------------End of factory Sales-------------------------------------------


    //--------------------------Privoious Invoice print----------------------------------------

    $(document).on("click",".get_invoice",function(){

        $("#error_invoice_empty_id").html("");

        if($(".invoice_id").val()=="")
        {
            $("#error_invoice_empty_id").html("");
            $("#error_invoice_empty_id").html("<img src='../../asset/images/imoji/tenor.gif' class='img-fluid' style='width:20px;height:20px;'><small></small><hr>");         
        }
        else
        {
            $("#completed_factory_sales").modal("show");
            $.ajax({
                type:"POST",
                url:"../../back_function/user/factory_sales/factory_sales_function.php",
                data:{"load_privious_invoice":$(".invoice_id").val()},
                cache:false,
                success:function(data)
                {
                    $("#completed_factory_sales").modal("hide");

                    if(data=="already")
                    {
                        $("#error_invoice_empty_id").html("");
                        $("#error_invoice_empty_id").html("<img src='../../asset/images/imoji/tenor.gif' class='img-fluid' style='width:20px;height:20px;'><small>Wrong Invoice ID</small><hr>");         
                    }
                    else
                    {   
                        data=JSON.parse(data);

                        var id=data[0]["id"];
                        var oder_items=JSON.parse(data[0]["order_description"]);
                        var oder_prices=JSON.parse(data[0]["order_prices_description"]);

                        incoice_print(oder_items,oder_prices,id,"no");
                        //----Here YES is flag get invoice or print Invoice---------------
                    }
                },error:function(error)
                {
                    console.log(error);
                }
            });
        }
    });

    //--------------------------Privoious Invoice print----------------------------------------


    // -------------------------Factory Sales Returned-----------------------------------------

    var returned_customer_data=new Array();
    var returned_items_data=new Array();
    var make_returned_list=new Array();

    var returned_invoice_id="";

    $(document).on("click",".return_invoice",function(){

        returned_customer_data=[];
        returned_items_data=[];
        make_returned_list=[];

        returned_invoice_id=0;

        $("#repaid").text(0);

        $("#error_invoice_empty_id").html("");

        if($(".invoice_id").val()=="")
        {
            $("#error_invoice_empty_id").html("");
            $("#error_invoice_empty_id").html("<img src='../../asset/images/imoji/tenor.gif' class='img-fluid' style='width:20px;height:20px;'><small></small><hr>");         
        }
        else
        {
            $("#completed_factory_sales").modal("show");
            $("#factory_sales_returned").modal("show");

            $.ajax({
                type:"POST",
                url:"../../back_function/user/factory_sales/factory_sales_function.php",
                data:{"load_privious_invoice":$(".invoice_id").val()},
                cache:false,
                success:function(data)
                {
                    $("#completed_factory_sales").modal("hide");

                    if(data!="already")
                    {
                        data=JSON.parse(data);
                        returned_customer_data=JSON.parse(data[0]["order_prices_description"]);
                        returned_items_data=JSON.parse(data[0]["order_description"]);
    
    
                        var content_customer="";
                        content_customer+="<tr>";
                            content_customer+="<td>"+returned_customer_data[1]+"</td>";
                            content_customer+="<td>"+returned_customer_data[2]+"</td>";
                            content_customer+="<td>"+returned_customer_data[3]+"</td>";
                            content_customer+="<td>"+returned_customer_data[4]+"</td>";
                            content_customer+="<td>"+returned_customer_data[5]+"</td>";
                        content_customer+="</tr>";
    
                        returned_invoice_id=data[0]["id"];
    
                        // Append Customer Details
                        $("#customer_info").html(content_customer);

                        var make_content_change_returned="";
    
                        for(var i=0;i<returned_items_data.length;i++)
                        {
                            if(returned_items_data[i]["methode"]=="unit")
                            {
                                make_returned_list.push({"obj_id":i,"item_id":returned_items_data[i]["item_id"],"item_name":returned_items_data[i]["item_name"],"item_method":returned_items_data[i]["methode"],"returned_qty":0,"returned_price":0,"returned_cost":0,"unit_cost":returned_items_data[i]["unit_cost"],"unit_price":returned_items_data[i]["unit_price"],"object_checked":"no","admin_check":"not","discount":returned_customer_data[4],"offer":returned_customer_data[5]});
                                make_content_change_returned+="<tr>";
                                    make_content_change_returned+="<td>"+returned_items_data[i]["item_name"]+"</td>";
                                    make_content_change_returned+="<td><input type='number' class='form-control form-control-sm btn-block returned' placeholder='unit' id='returned_id"+i+"' data-qty="+returned_items_data[i]["unit_selected_qty"]+"></td>";
                                    make_content_change_returned+="<td><button class='btn btn-success returned_btn btn-block' data-id="+i+" data-method='unit'>Return</button></td>";
                                    make_content_change_returned+="<td><button class='btn btn-danger returned_drop btn-block' data-id="+i+">X</button></td>";
                                make_content_change_returned+="</tr>";
                             
                            }
                            else
                            {
                                make_returned_list.push({"obj_id":i,"item_id":returned_items_data[i]["item_id"],"item_name":returned_items_data[i]["item_name"],"item_method":returned_items_data[i]["methode"],"returned_qty":0,"returned_price":0,"returned_cost":0,"bulk_cost":returned_items_data[i]["bulk_cost"],"bulk_price":returned_items_data[i]["bulk_price"],"object_checked":"no","admin_check":"not","discount":returned_customer_data[4],"offer":returned_customer_data[5]});
                                make_content_change_returned+="<tr>";
                                    make_content_change_returned+="<td>"+returned_items_data[i]["item_name"]+"</td>";
                                    make_content_change_returned+="<td><input type='number' class='form-control form-control-sm btn-block returned' placeholder='bulk' id='returned_id"+i+"' data-qty="+returned_items_data[i]["unit_selected_qty"]+"></td>";
                                    make_content_change_returned+="<td><button class='btn btn-success returned_btn btn-block' data-id="+i+" data-method='bulk'>Return</button></td>";
                                    make_content_change_returned+="<td><button class='btn btn-danger returned_drop btn-block' data-id="+i+">X</button></td>";
                                make_content_change_returned+="</tr>";
                            }
                        }
                        $("#returned_items_list").html(make_content_change_returned);
                    }
                    else
                    {
                        $("#error_invoice_empty_id").html("");
                        $("#error_invoice_empty_id").html("<img src='../../asset/images/imoji/tenor.gif' class='img-fluid' style='width:20px;height:20px;'><small>Wrong Invoice ID</small><hr>");         
        
                    }
                    

                },error:function(error)
                {
                    console.log(error);
                    $("#completed_factory_sales").modal("hide");
                    $("#factory_sales_returned").modal("hide");
                }
            });
        }
    });


    // -----------------------Make return Content--------------------------------------------
    var total_returned_price=0;

    function make_return_object()
    {
        $("#returned_errors").html("");
        var returned_content="";
        total_returned_price=0;

        for(var i=0;i<make_returned_list.length;i++)
        {
            if(make_returned_list[i]["object_checked"]=="yes")
            {
                if(make_returned_list[i]["item_method"]=="unit")
                {
                    returned_content+="<tr>";
                        returned_content+="<td>"+make_returned_list[i]["item_name"]+"</td>";
                        returned_content+="<td>unit</td>";
                        returned_content+="<td>"+make_returned_list[i]["returned_qty"]+"</td>";
                    returned_content+="</tr>";

                    total_returned_price+=(parseInt(make_returned_list[i]["returned_price"]));

                }
                else
                {
                    returned_content+="<tr>";
                        returned_content+="<td>"+make_returned_list[i]["item_name"]+"</td>";
                        returned_content+="<td>unit</td>";
                        returned_content+="<td>"+make_returned_list[i]["returned_qty"]+"</td>";
                    returned_content+="</tr>";

                    total_returned_price+=(parseInt(make_returned_list[i]["returned_price"]));
                }
                
            }
        }

        total_returned_price=total_returned_price-(((parseInt(returned_customer_data[4]))/100)*total_returned_price);
        total_returned_price=total_returned_price-(((parseInt(returned_customer_data[5]))/100)*total_returned_price);

        $("#repaid").text("Amount to be repaid - LKR:"+total_returned_price);
        $("#returned_items_maked_list").html(returned_content);
    }

    
    $(document).on("click",".make_complete_return",function(){

        $("#returned_errors").html("");
        var returned_obj=new Array();

        for(var i=0;i<make_returned_list.length;i++)
        {
            if(make_returned_list[i]["object_checked"]=="yes")
            {
                returned_obj.push(make_returned_list[i]);
            }
        }

        if(returned_obj.length==0)
        {
            $("#returned_errors").html("");
            $("#returned_errors").html("<img src='../../asset/images/imoji/tenor.gif' class='img-fluid' style='width:25px;height:25px;'><small>Did you add return details..!</small><hr>");         
        }
        else if(total_returned_price>0)
        {
            console.log(returned_obj,returned_invoice_id,total_returned_price);

            $("#completed_factory_sales").modal("show");

            $.ajax({
                type:"POST",
                url:"../../back_function/user/factory_sales/factory_sales_function.php",
                data:{"returned_data":JSON.stringify(returned_obj),"invoice_id":returned_invoice_id,"total_returned_price":total_returned_price},
                cache:false,
                success:function(data)
                {
                
                    // console.log(data);
                    if(data=="ok")
                    {
                        $("#completed_factory_sales").modal("show");
                        $("#factory_sales_returned").modal("hide");
                    }

                },error:function(error)
                {
                    console.log(error);
                }
            });
        }
        else
        {
            $("#returned_errors").html("");
            $("#returned_errors").html("<img src='../../asset/images/imoji/tenor.gif' class='img-fluid' style='width:25px;height:25px;'><small>You Can't Process this</small><hr>");         
        }
    });



    //--------------------------Changed_object----------------------------------------------- 
    $(document).on("click",".returned_btn",function(){
        
        var object_id=$(this).attr("data-id");
        var returned_value=$("#returned_id"+object_id).val();
        var method=$(this).attr("data-method");

        if(method=="unit")
        {
            make_returned_list[object_id]["returned_cost"]=((parseInt(returned_value))*(parseInt(make_returned_list[object_id]["unit_cost"])));
            make_returned_list[object_id]["returned_price"]=((parseInt(returned_value))*(parseInt(make_returned_list[object_id]["unit_price"])));
            make_returned_list[object_id]["object_checked"]="yes";
            make_returned_list[object_id]["returned_qty"]=returned_value;
        }
        else
        {
            make_returned_list[object_id]["returned_cost"]=((parseInt(make_returned_list[object_id]["bulk_cost"])/1000)*(parseInt(returned_value)));
            make_returned_list[object_id]["returned_price"]=((parseInt(make_returned_list[object_id]["bulk_price"])/1000)*(parseInt(returned_value)));
            make_returned_list[object_id]["object_checked"]="yes";
            make_returned_list[object_id]["returned_qty"]=returned_value;        
        }

        make_return_object();

    });

    // ---------------------------------make returned_content------------------------------------------------------------

    $(document).on("click",".returned_drop",function(){

        var object_id=$(this).attr("data-id");

        make_returned_list[object_id]["object_checked"]="no";
        make_returned_list[object_id]["returned_qty"]=0;   
        make_returned_list[object_id]["returned_cost"]=0;
        make_returned_list[object_id]["returned_price"]=0;

        make_return_object();
    });

    // -------------------------Factory Sales Returned-----------------------------------------
    $("#item_searcher").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#items_lister tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    $("#returned_item_finder").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#returned_items_list tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    $(document).on("click",".close",function(){
        $('.modal').css({"overflow-x":"hidden","overflow-y":"auto"});
    });

 
});