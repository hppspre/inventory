<?php include_once("../../index.php");

class routs extends data_base_connection{

    public function add_new_routs($Rout_name,$gkm)
    {
        $this->connection->beginTransaction();
        try
        {

            $nrow_name=$this->connection->query("SELECT COUNT(*) FROM `routs` WHERE `rout_description`='".$Rout_name."'")->fetchColumn();
        
            if($nrow_name==0)
            {
                $sql = "INSERT INTO `routs`(`rout_description`,`genaral_km`) VALUES (?,?)";
                $stmt=  $this->connection->prepare($sql);
                $stmt->execute([$Rout_name,$gkm]);  
                echo "done";
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
    public function load_routs()
    {
        $this->connection->beginTransaction();
        try
        {

            $data=$this->connection->query("SELECT * FROM `routs`")->fetchALL(PDO::FETCH_ASSOC);  
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
    public function change_rout_details($id,$disc,$kms)
    {
        $this->connection->beginTransaction();
        try
        {
            $nrow_name=$this->connection->query("SELECT COUNT(*) FROM `routs` WHERE `rout_description`='".$disc."' AND `id`<>".$id."")->fetchColumn();
            
            if($nrow_name==0)
            {
                if($disc=="")
                {
                    $this->connection->query("UPDATE `routs` SET `genaral_km`='".$kms."' WHERE `id`=".$id."");  
                    echo "done";
                }
                else if($kms=="")
                {
                    $this->connection->query("UPDATE `routs` SET `rout_description`='".$disc."' WHERE `id`=".$id."");  
                    echo "done";
                }
                else if($disc!="" && $kms!="")
                {
                    $this->connection->query("UPDATE `routs` SET `rout_description`='".$disc."',`genaral_km`='".$kms."' WHERE `id`=".$id."");  
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




}

?>