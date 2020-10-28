<?php include_once("../../index.php");

class admin_credentials extends data_base_connection
{

    function change_admin_credentials($name,$password,$new_password)
    {
            $this->connection->beginTransaction();
            try
            {
                $nrow_name=$this->connection->query("SELECT COUNT(*) FROM `users` WHERE `user_name`='".$name."'")->fetchColumn();
              
                if($nrow_name==0)
                {
                    $hpwd=$this->connection->query("SELECT `admin_password` FROM `admin` WHERE `id`=2")->fetchColumn();

                   
             
                    if(password_verify($password,$hpwd)==$password)
                    {
                        $hash=password_hash($new_password, PASSWORD_DEFAULT);
                        $sql = "UPDATE `admin` SET `admin_user_name`='".$name."' , `admin_password`='".$hash."' WHERE `id`=2";
                        $stmt= $this->connection->prepare($sql);
                        $stmt->execute();
                        echo "done";
                    }
                    else
                    {
                        echo "wrong_privious";
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