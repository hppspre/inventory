<?php 
include_once("../../index.php");
class item extends data_base_connection{

    // add a new item
    public function add_new_item($item_name,$cat_id,$code,$type)
    {
        // Chk item already exits o r not
        $this->connection->beginTransaction();
        try
        {
            
            $nrow_name=$this->connection->query("SELECT COUNT(*) FROM `items` WHERE (`items_name`='".$item_name."' OR `item_code`='".$code."') AND (`status`='yes' OR `status`='fresh')")->fetchColumn();
            if($nrow_name==0)
            {
           
                $sql = "INSERT INTO `items` (`items_name`,`categories_id`,`status`,`item_code`,`item_type`) VALUES (?,?,?,?,?)";
                $stmt=  $this->connection->prepare($sql);
                $stmt->execute([$item_name,$cat_id,"fresh",$code,$type]);
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
            $this->close_connection();

            echo $e->getMessage();
        }
    }

    // Load Categories
    public function load_existing_categories()
    {

        $this->connection->beginTransaction();
        try
        {
            $data=$this->connection->query("SELECT * FROM `categories`")->fetchALL(PDO::FETCH_ASSOC);  
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
    //load_existing items list
    public function load_items()
    {

        $this->connection->beginTransaction();
        try
        {
            $data=$this->connection->query("SELECT * FROM `items` WHERE `status`='yes' OR `status`='fresh' ")->fetchALL(PDO::FETCH_ASSOC);  
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
    // Drop Items
    public function drop_item($id)
    {
        $this->connection->beginTransaction();
        try
        {
            $this->connection->query("UPDATE `items` SET `status`='no' WHERE `id`=".$id."");  
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

    public function change_item_load($id)
    {
        $this->connection->beginTransaction();
        try
        {
            $data=$this->connection->query("SELECT * FROM `items` WHERE `id`=".$id." ")->fetchALL(PDO::FETCH_ASSOC);  
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
    public function load_empties()
    {
        $this->connection->beginTransaction();
        try
        {
            $data=$this->connection->query("SELECT * FROM `items` WHERE `status`='yes' AND `item_type`='eitem' ")->fetchALL(PDO::FETCH_ASSOC);  
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
    public function change_data($data,$id,$reorder_level,$bulk_cost,$remake_level,$bulk_whole)
    {
        $this->connection->beginTransaction();
        try
        {
            $data=json_decode($data,TRUE);

            $nrow_name=$this->connection->query("SELECT COUNT(*) FROM `items` WHERE (`items_name`='".$data[0]."' OR `item_code`='".$data[2]."') AND (`status`='yes' OR `status`='fresh') AND `id`<>".$id."")->fetchColumn();
            if($nrow_name==0)
            {
                if(sizeof($data)==6) //Empty item  eitem
                {
                    $sql = "UPDATE `items` SET `items_name`='".$data[0]."' ,`categories_id`=".$data[1].",`item_code`='".$data[2]."',`item_type`='eitem',`items_cost`='".$data[3]."',`items_retails_price`='".$data[4]."' ,`status`='".$data[5]."',`reorder_level`=".$reorder_level." WHERE `id`=".$id."";
                    $stmt= $this->connection->prepare($sql);
                    $stmt->execute();
                    echo "done";
                }
                if(sizeof($data)==12) //items item
                {
                   
                    $sql = "UPDATE `items` SET `items_name`='".$data[1]."',`item_code`='".$data[2]."',`categories_id`=".$data[3].",`item_type`='".$data[11]."',`items_cost`=".$data[4].",`items_retails_price`=".$data[5].",`bulk_price`=".$data[7].",`items_whole_sales_price`=".$data[6].",`status`='".$data[0]."',`reorder_level`=".$reorder_level.",`bulk_cost`=".$bulk_cost.",`remake_level`=".$remake_level.",`bulk_whole_price`=".$bulk_whole." WHERE `id`=".$id."";
                    $stmt= $this->connection->prepare($sql);
                    $stmt->execute();
              
                    if($data[8]=="no")
                    {
                        $sql = "UPDATE `items` SET `need_a_empty`='no' WHERE `id`=".$id."";
                        $stmt= $this->connection->prepare($sql);
                        $stmt->execute();
                      
                    }
                    else
                    {
                        $sql = "UPDATE `items` SET `need_a_empty`='yes',`empty_item_id`=".$data[8]." WHERE `id`=".$id."";
                        $stmt= $this->connection->prepare($sql);
                        $stmt->execute();
                   
                    }

                    if($data[9]=="no")
                    {
                        $sql = "UPDATE `items` SET `have_free`='no' WHERE `id`=".$id."";
                        $stmt= $this->connection->prepare($sql);
                        $stmt->execute(); 
                    }
                    else
                    {
                        $sql = "UPDATE `items` SET `have_free`='yes',`free_for`=".$data[9].",`free_qty`=".$data[10]." WHERE `id`=".$id."";
                        $stmt= $this->connection->prepare($sql);
                        $stmt->execute();
                    }
                    echo "done"; 
                }
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
            $this->close_connection();

            echo $e->getMessage();
        }
    }
    public function load_coulmn_list()
    {
        $this->connection->beginTransaction();
        try
        {
            $data=$this->connection->query("SHOW COLUMNS FROM `items`")->fetchALL(PDO::FETCH_ASSOC);  
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
    public function load_columns_data($id)
    {
        $this->connection->beginTransaction();
        try
        {
            $data=$this->connection->query("SELECT * FROM `items` WHERE `id`=".$id." ")->fetchALL(PDO::FETCH_ASSOC);  
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
    public function change_discount($column_name,$discount_value,$id)
    {
        $this->connection->beginTransaction();
        try
        {
            $sql = "UPDATE `items` SET `".$column_name."`=".$discount_value." WHERE `id`=".$id."";
            $stmt= $this->connection->prepare($sql);
            $stmt->execute(); 

            echo "done";

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