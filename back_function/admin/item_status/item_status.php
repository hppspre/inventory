<?php 
include_once("../../index.php");
class item_status extends data_base_connection
{

    public function load_item_status()
    {
        $this->connection->beginTransaction();
        try
        {
            $data=$this->connection->query("SELECT `id`,`item_code`,`items_name`,`qty`,`reorder_level`,`items_cost`,`remake_level`,`leters_quantity`,`item_type`,`bulk_cost` FROM `items` WHERE `status`='yes' ")->fetchALL(PDO::FETCH_ASSOC);  
            echo json_encode($data,TRUE);

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
    public function change_quanity($id,$cost,$qty,$option,$current_qty)
    {
        $this->connection->beginTransaction();
        try
        {
            $time=date("Y-m-d");

            if($option==1)
            {
                $sql = "UPDATE `items` SET `qty`=".($qty+$current_qty)." WHERE `id`=".$id."";
                $stmt= $this->connection->prepare($sql);
                $stmt->execute(); 
                echo "done";
            }
            else if($option==2)
            {
                $sql = "UPDATE `items` SET `qty`=".($current_qty-$qty)." WHERE `id`=".$id."";
                $stmt= $this->connection->prepare($sql);
                $stmt->execute(); 
                echo "done";
            }
            else if($option==3)
            {
                $sql = "UPDATE `items` SET `qty`=".($current_qty-$qty)." WHERE `id`=".$id."";
                $stmt= $this->connection->prepare($sql);
                $stmt->execute(); 

                $sql = "INSERT INTO `expenditures_stock` (`discription`,`date`,`qty`,`cost`,`added_by`) VALUES (?,?,?,?,?)";
                $stmt=  $this->connection->prepare($sql);
                $stmt->execute(["damaged_stock",$time,$qty,($cost*$qty),"admin"]);
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

    public function change_leater_quanity($id,$cost,$qty,$option,$current_qty)
    {
        $this->connection->beginTransaction();
        try
        {
            $time=date("Y-m-d");

            if($option==1)
            {
                $sql = "UPDATE `items` SET `leters_quantity`=".($qty+$current_qty)." WHERE `id`=".$id."";
                $stmt= $this->connection->prepare($sql);
                $stmt->execute(); 
                echo "done";
            }
            else if($option==2)
            {
                $sql = "UPDATE `items` SET `leters_quantity`=".($current_qty-$qty)." WHERE `id`=".$id."";
                $stmt= $this->connection->prepare($sql);
                $stmt->execute(); 
                echo "done";
            }
            else if($option==3)
            {
                $sql = "UPDATE `items` SET `leters_quantity`=".($current_qty-$qty)." WHERE `id`=".$id."";
                $stmt= $this->connection->prepare($sql);
                $stmt->execute(); 

                $cal_cost=($cost/1000)*$qty;

                $sql = "INSERT INTO `expenditures_stock` (`discription`,`date`,`leaters_qty`,`cost`,`added_by`) VALUES (?,?,?,?,?)";
                $stmt=  $this->connection->prepare($sql);
                $stmt->execute(["damaged_stock",$time,$qty,$cal_cost,"admin"]);
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

}

?>