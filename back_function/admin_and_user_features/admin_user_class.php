<?php 
include_once("../index.php");
class admin_user extends data_base_connection{

    public function get_maping_details()
    {
        $this->connection->beginTransaction();
        try
        {
            
            $data=$this->connection->query("SELECT `id`,`items_name`,`item_code`,`empty_item_id`,`need_a_empty` FROM `items` WHERE `status`='yes'")->fetchALL(PDO::FETCH_ASSOC);  
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
    public function get_items_list()
    {
        $this->connection->beginTransaction();
        try
        {
            $data=$this->connection->query("SELECT `id`,`items_name`,`item_code`,`items_retails_price`,`items_whole_sales_price`,`bulk_price`,`bulk_whole_price`,`item_type` FROM `items` WHERE `status`='yes'")->fetchALL(PDO::FETCH_ASSOC);  
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

    // public function get_discount_list($id)
    // {
    //     $this->connection->beginTransaction();
    //     try
    //     {
    //         $data=$this->connection->query("SELECT * FROM `items` WHERE `id`=".$id."")->fetchALL(PDO::FETCH_ASSOC);  
    //         echo json_encode($data,TRUE);

    //         $this->connection->commit();
    //         $this->close_connection();

    //     }
    //     catch(PDOException $e)
    //     {
    //         $this->connection->rollBack();
    //         $this->close_connection();

    //         echo $e->getMessage();
    //     }
    // }

}