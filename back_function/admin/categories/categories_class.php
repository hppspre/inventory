<?php include_once("../../index.php");

class categories extends data_base_connection
{
    public function add_category($category_name)
    {
        $this->connection->beginTransaction();
        try
        {
            
            $nrow_name=$this->connection->query("SELECT COUNT(*) FROM `categories` WHERE `categories_name`='".$category_name."'")->fetchColumn();
            if($nrow_name!=0)
            {
                echo "already_have";
            }
            else
            {
                $sql = "INSERT INTO `categories` (`categories_name`) VALUES ('".$category_name."')";
                $stmt=  $this->connection->prepare($sql)->execute();
                echo 'ok' ; 
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
    public function get_categories()
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
    public function chng_category_name($name,$id)
    {

        $this->connection->beginTransaction();
        try
        {

            $nrow_name=$this->connection->query("SELECT COUNT(*) FROM `categories` WHERE `categories_name`='".$name."' AND `id`<>".$id."")->fetchColumn();
            if($nrow_name!=0)
            {
                echo "already_have";
            }
            else
            {
                $data=$this->connection->query("SELECT * FROM `categories`")->fetchALL(PDO::FETCH_ASSOC);
                
                $sql = "UPDATE `categories` SET `categories_name`='".$name."' WHERE `id`=".$id."";
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
}


?>