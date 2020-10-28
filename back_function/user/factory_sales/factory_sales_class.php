<?php include_once("../../index.php");

class factory_sales extends data_base_connection
{
    public function load_factory_sales_customers()
    {
        $factory_sales=$this->connection->query("SELECT `id`,`customer_name` FROM `customers_factory_sales`")->fetchALL(PDO::FETCH_ASSOC);
        echo json_encode($factory_sales,true);
    }

    public function load_next_invoice_id()
    {
        $this->connection->beginTransaction();
        try
        {
            $sql = $this->connection->query("SHOW TABLE STATUS LIKE 'sales_factory'");
            $next = $sql->fetch(PDO::FETCH_ASSOC);
            echo $next["Auto_increment"];

            $this->connection->commit();
            $this->close_connection();

        }
        catch(PDOException $e)
        {
            $this->connection->rollBack();
            echo $e->getMessage();
        }
    }

    public function save_factory_sales($sales_data,$other_data,$returned)
    {
        $this->connection->beginTransaction();
        try
        {
            $sales_data_decoder=json_decode($sales_data);
            $other_data_decoder=json_decode($other_data);
            $time=date("Y-m-d");

            //------Save Donation Details----------------------


            //------Here I used 1(id) customer for not registered customer [TABLE:customers_factory_sales]
            if($other_data_decoder[0]=='no')
            {
                $sql = "INSERT INTO `sales_factory`(`ordered_date`,`ordered_by`,`order_description`,`order_prices_description`,`cost`,`price`,`discount`,`offres`,`discount_rate`,`discount_offer`,`customer_id`) 
                VALUES ('".$time."','".$_SESSION["user"]."','".$sales_data."','".$other_data."',".$other_data_decoder[6].",".$other_data_decoder[7].",".$other_data_decoder[8].",".$other_data_decoder[9].",".$other_data_decoder[4].",".$other_data_decoder[5].",1)";
                $stmt=  $this->connection->prepare($sql)->execute();
            }
            else
            {
                $sql = "INSERT INTO `sales_factory`(`ordered_date`,`ordered_by`,`order_description`,`order_prices_description`,`cost`,`price`,`discount`,`offres`,`discount_rate`,`discount_offer`,`customer_id`) 
                VALUES ('".$time."','".$_SESSION["user"]."','".$sales_data."','".$other_data."',".$other_data_decoder[6].",".$other_data_decoder[7].",".$other_data_decoder[8].",".$other_data_decoder[9].",".$other_data_decoder[4].",".$other_data_decoder[5].",".$other_data_decoder[0].")";
                $stmt=  $this->connection->prepare($sql)->execute();
            }

            //------Save Donation Details----------------------




            //------Reduse_quantityis--------------------------
            foreach($sales_data_decoder as $key=>$value)
            {
               if($value->methode=="unit")
               {
                    $sql = "UPDATE `items` SET `qty`=".(($value->unit_qty)-($value->unit_selected_qty))." WHERE `id`=".$value->item_id."";
                    $stmt= $this->connection->prepare($sql);
                    $stmt->execute();
               }
               else
               {
                    $sql = "UPDATE `items` SET `leters_quantity`=".(($value->bulk_qty)-($value->bulk_selected_qty))." WHERE `id`=".$value->item_id."";
                    $stmt= $this->connection->prepare($sql);
                    $stmt->execute();
               }
            }

            echo 'ok'; 
             
            //------Reduse_quantityis--------------------------
            $this->connection->commit();
            $this->close_connection();
            
        }
        catch(PDOException $e)
        {
            $this->connection->rollBack();
            $this->close_connection();

            echo $e->getMessage();
        }
    }

    // ------------------------Load Privios Invoice--------------------------------

    public function load_privious_invoice($id)
    {
        $this->connection->beginTransaction();
        try
        {
            // first check the invoice number
            $nrow=$this->connection->query("SELECT COUNT(*) FROM `sales_factory` WHERE `id`=".$id."")->fetchColumn();
            if($nrow==0)
            {
                echo "already";
            }
            else
            {
                $factory_sales=$this->connection->query("SELECT `id`,`order_description`,`order_prices_description`,`discount_rate`,`discount_offer` FROM `sales_factory` WHERE `id`=".$id."")->fetchALL(PDO::FETCH_ASSOC);
                echo json_encode($factory_sales,true);
            }

            $this->connection->commit();
            $this->close_connection();
        }
        catch(PDOException $e)
        {
            $this->connection->rollBack();
            echo $e->getMessage();
        }
    }

    // ------------------------Save factory sales returned data---------------

    public function save_factory_sales_returned($sales_data,$id,$price)
    {
        $this->connection->beginTransaction();
        try
        {
            $time=date("Y-m-d");

            $sql = "INSERT INTO `sales_factory_returned`(`returned_description`,`repaid_amount`,`date_returned`,`returned_status`,`invoice_id`) 
            VALUES ('".$sales_data."',".$price.",'".$time."','fresh',".$id.")";

            $stmt=$this->connection->prepare($sql)->execute();

            echo "ok";

            $this->connection->commit();
            $this->close_connection();
        }
        catch(PDOException $e)
        {
            $this->connection->rollBack();
            echo $e->getMessage();
        }
    }
}