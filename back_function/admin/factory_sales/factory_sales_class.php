<?php include_once("../../index.php");

class factory_sales extends data_base_connection
{
    public function add_new_factory_sales_customer($data)
    {
        $customer_data=json_decode($data,true);


        $this->connection->beginTransaction();
        try
        {
            $nrow_new_fs_customer=$this->connection->query("SELECT COUNT(*) FROM `customers_factory_sales` WHERE `customer_name`='".$customer_data[0]."'")->fetchColumn();
            if($nrow_new_fs_customer==0)
            {
                $time=date("Y-m-d");

                $sql = "INSERT INTO `customers_factory_sales` 
                (`customer_name`,`customer_address`,`customer_phone`,`added_date`,`added_by`,`status`) VALUES (?,?,?,?,?,?)";
                $stmt= $this->connection->prepare($sql);
                $stmt->execute([$customer_data[0],$customer_data[1],$customer_data[2],$time,"admin","fresh"]);

                echo "ok";
            }
            else
            {
                echo "already";
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

    public function load_fs_customer()
    {
     
        $this->connection->beginTransaction();
        try
        {
            $fs_customers_list=$this->connection->query("SELECT * FROM `customers_factory_sales` WHERE `status`='fresh'")->fetchALL(PDO::FETCH_ASSOC);
            echo json_encode($fs_customers_list);

            $this->connection->commit();
            $this->close_connection(); 

        }
        catch(PDOException $e)
        {
            $this->connection->rollBack();
            echo $e->getMessage();
        }
    }

    public function drop_fs_customer($id)
    {
        $this->connection->beginTransaction();
        try
        {
            $sql = "UPDATE `customers_factory_sales` SET `status`='no' WHERE `id`=".$id."";
            $stmt= $this->connection->prepare($sql);
            $stmt->execute();
            echo "done";    

            $this->connection->commit();
            $this->close_connection(); 

        }
        catch(PDOException $e)
        {
            $this->connection->rollBack();
            echo $e->getMessage();
        }
    }
    public function change_customer_details($data,$id)
    {
        $this->connection->beginTransaction();
        try
        {
            $data=json_decode($data,true);

            $sql = "UPDATE `customers_factory_sales` SET `customer_name`='".$data[0]."',`customer_address`='".$data[1]."',`customer_phone`='".$data[2]."',`discount_satatus`=".$data[3].",`special_offers`=".$data[4]." WHERE `id`=".$id."";
            $stmt= $this->connection->prepare($sql);
            $stmt->execute();
            echo "done";    

            $this->connection->commit();
            $this->close_connection(); 

        }
        catch(PDOException $e)
        {
            $this->connection->rollBack();
            echo $e->getMessage();
        }
    }
    public function get_factory_sales_details($date)
    {
        $this->connection->beginTransaction();
        try
        {
            
            $order_details=$this->connection->query("SELECT `id`,`ordered_by`,`order_description`,`order_prices_description`,`price` FROM `sales_factory` WHERE `ordered_date` LIKE  '".$date."' ")->fetchALL(PDO::FETCH_ASSOC);
            echo json_encode($order_details);

            $this->connection->commit();
            $this->close_connection(); 
            
        }
        catch(PDOException $e)
        {
            $this->connection->rollBack();
            echo $e->getMessage();
        }
    }

    public function load_returned_data($date)
    {
        $this->connection->beginTransaction();
        try
        {
            $returned_details=$this->connection->query("SELECT `id`,`invoice_id`,`returned_description`,`repaid_amount`,`date_returned`,`returned_status` FROM `sales_factory_returned` WHERE `date_returned` LIKE  '".$date."' ")->fetchALL(PDO::FETCH_ASSOC);
            echo json_encode($returned_details);

            $this->connection->commit();
            $this->close_connection(); 
            
        }
        catch(PDOException $e)
        {
            $this->connection->rollBack();
            echo $e->getMessage();
        }
    }
    
    public function make_check_returned($date)
    {
        $this->connection->beginTransaction();
        try
        {
            $sql = "UPDATE `sales_factory_returned` SET `returned_status`='ok' WHERE `id`=".$date."";
            $stmt= $this->connection->prepare($sql);
            $stmt->execute();
            echo "done"; 

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

?>