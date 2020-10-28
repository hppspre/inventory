<?php include_once("../../index.php");

class donation extends data_base_connection
{
    public function load_items()
    {
        $this->connection->beginTransaction();
        try
        {
            
            $list_of_items=$this->connection->query("SELECT * FROM `items` WHERE `status`='yes'")->fetchALL(PDO::FETCH_ASSOC);
            echo json_encode($list_of_items,true);

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
    public function save_new_customer($name,$address,$phone)
    {
        $this->connection->beginTransaction();
        try
        {
            $sql = "INSERT INTO `donation_customers` (`customer_name`,`customer_address`,`customer_phone`) VALUES ('".$name."','".$address."','".$phone."')";
            $stmt=  $this->connection->prepare($sql)->execute();
            echo 'done'; 

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
    public function edit_customer($name,$address,$phone,$id)
    {
        $this->connection->beginTransaction();
        try
        {
            if($name!="")
            {
                $sql = "UPDATE `donation_customers` SET `customer_name`='".$name."' WHERE `id`=".$id."";
                $stmt= $this->connection->prepare($sql);
                $stmt->execute();
                echo "done";     
            }
            if($address!="")
            {
                $sql = "UPDATE `donation_customers` SET `customer_address`='".$address."' WHERE `id`=".$id."";
                $stmt= $this->connection->prepare($sql);
                $stmt->execute();
                echo "done"; 
            }
            if($phone!="")
            {
                $sql = "UPDATE `donation_customers` SET `customer_phone`='".$phone."' WHERE `id`=".$id."";
                $stmt= $this->connection->prepare($sql);
                $stmt->execute();
                echo "done"; 
            }
  

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
    public function load_customers()
    {
        $this->connection->beginTransaction();
        try
        {
            
            $list_of_customers=$this->connection->query("SELECT * FROM `donation_customers`")->fetchALL(PDO::FETCH_ASSOC);
            echo json_encode($list_of_customers,true);

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

    public function load_donation()
    {
        $this->connection->beginTransaction();
        try
        {
            
            $list_of_customers=$this->connection->query("SELECT `expenditure_donation`.`id`,`expenditure_donation`.`cost`,`expenditure_donation`.`status`,`expenditure_donation`.`donatedby`,`expenditure_donation`.`completedby`,`expenditure_donation`.`date_make_donation`,`expenditure_donation`.`date_complete_donation`,`donation_customers`.`customer_name`,`donation_customers`.`customer_address`,`donation_customers`.`customer_phone`
            FROM expenditure_donation
            INNER JOIN donation_customers ON `expenditure_donation`.`donate_customer_id`=`donation_customers`.`id` WHERE `status`<>'canceled' ORDER BY `id` DESC")->fetchALL(PDO::FETCH_ASSOC);
            echo json_encode($list_of_customers,true);

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

    public function donate_saver($info,$id,$final_cost)
    {
        $this->connection->beginTransaction();
        try
        {
            $data=json_decode($info,true);
            $time=date("Y-m-d");

            //------Save Donation Details----------------------

            $sql = "INSERT INTO `expenditure_donation`(`discription`,`cost`,`donation_data`,`status`,`donatedby`,`date_make_donation`,`donate_customer_id`) VALUES ('donation',".$final_cost.",'".$info."','pending','admin','".$time."',".$id.")";
            $stmt=  $this->connection->prepare($sql)->execute();
            
            //------Save Donation Details----------------------


            //------Reduse_quantityis--------------------------

            foreach($data as $key => $value)
            {

               if($value["method"]=="unit")
               {
                    $sql = "UPDATE `items` SET `qty`=".($value["unit_qty"]-$value["unit_selected_qty"])." WHERE `id`=".$value["item_id"]."";
                    $stmt= $this->connection->prepare($sql);
                    $stmt->execute();
               }
               else
               {
                    $sql = "UPDATE `items` SET `leters_quantity`=".($value["bulk_qty"]-$value["bulk_selected_qty"])." WHERE `id`=".$value["item_id"]."";
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

    public function drop_donation($id)
    {
        $this->connection->beginTransaction();
        try
        {
            $sql = "UPDATE `expenditure_donation` SET `status`='canceled' WHERE `id`=".$id."";
            $stmt= $this->connection->prepare($sql);
            $stmt->execute();
        
            $donated_details=$this->connection->query("SELECT `donation_data` FROM `expenditure_donation` WHERE `id`=".$id."")->fetchALL(PDO::FETCH_ASSOC);
            $json_data="";

            foreach($donated_details as $key=>$value)
            {
               $json_data=$value["donation_data"];
            }
            
            $json_data=json_decode($json_data,true); 
   
            foreach($json_data as $key => $value)
            {
               if($value["method"]=="unit")
               {
                    $qty=$this->connection->query("SELECT `qty` FROM `items` WHERE `id`=".$value["item_id"]."")->fetchColumn();
                    $sql = "UPDATE `items` SET `qty`=".($qty+$value["unit_selected_qty"])." WHERE `id`=".$value["item_id"]."";
                    $stmt= $this->connection->prepare($sql);
                    $stmt->execute();
               }
               else
               {
                    $qty=$this->connection->query("SELECT `leters_quantity` FROM `items` WHERE `id`=".$value["item_id"]."")->fetchColumn();
                    $sql = "UPDATE `items` SET `leters_quantity`=".($qty+$value["bulk_selected_qty"])." WHERE `id`=".$value["item_id"]."";
                    $stmt= $this->connection->prepare($sql);
                    $stmt->execute();
               }
            }

            echo "ok";
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

    public function load_a_donation($id)
    {
        $this->connection->beginTransaction();
        try
        {
            $donated_details=$this->connection->query("SELECT `donation_data` FROM `expenditure_donation` WHERE `id`=".$id."")->fetchALL(PDO::FETCH_ASSOC);
            echo json_encode($donated_details,true);
            

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
    public function load_new_donation()
    {
        $this->connection->beginTransaction();
        try
        {
            $donated_details=$this->connection->query("SELECT `expenditure_donation`.`id`,`expenditure_donation`.`date_make_donation`,`donation_customers`.`customer_name`,`donation_customers`.`customer_address`,`donation_customers`.`customer_phone`
            FROM expenditure_donation
            INNER JOIN donation_customers ON `expenditure_donation`.`donate_customer_id`=`donation_customers`.`id` WHERE `status`='pending'  ORDER BY `id` DESC")->fetchALL(PDO::FETCH_ASSOC);
            echo json_encode($donated_details,true);
    
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
    public function donation_complete($id)
    {
        $this->connection->beginTransaction();
        try
        {
            $time=date("Y-m-d");
        
             
            $sql = "UPDATE `expenditure_donation` SET `status`='ok',`completedby`='".$_SESSION["user"]."',`date_complete_donation`='".$time."' WHERE `id`=".$id."";
            $stmt= $this->connection->prepare($sql);
            $stmt->execute();

            echo "ok";
            
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
    
}