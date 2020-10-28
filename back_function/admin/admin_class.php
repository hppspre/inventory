<?php 
include_once("../index.php");
class admin_class extends data_base_connection{

    function check_admin_credentials($user_name,$password)
    {
        $this->connection->beginTransaction();
        try
        {
            
            $nrows=$this->connection->query("SELECT COUNT(*) FROM `admin` WHERE `admin_user_name`='".$user_name."'")->fetchColumn();
            
            //First Chk user name is admin or not
            if($nrows==1)
            {
                $pwd=$this->connection->query("SELECT `admin_password` FROM `admin` WHERE `admin_user_name`='".$user_name."'")->fetchColumn();
                $auth=password_verify($password,$pwd);

                if($auth==$password)
                {
                    echo "admin_ok";
                    $user_details=array("name"=>'',"special_permission"=>'',"permission"=>'');

                    $_SESSION["user"]=$user_name;
                    $_SESSION["type"]="admin";
                    $_SESSION["user_option"]=$user_details;

                }
                else
                {
                    echo "wrong_password";
                }
            } //now chk users
            else
            {
                $nusersrows=$this->connection->query("SELECT COUNT(*) FROM `users` WHERE `user_name`='".$user_name."'")->fetchColumn();
                if($nusersrows==1)
                {
                    $pwd_user=$this->connection->query("SELECT `id`,`password`,`designation_list_id`,`user_name` FROM `users` WHERE `user_name`='".$user_name."'")->fetch(PDO::FETCH_ASSOC);
                    $auth_password=password_verify($password,$pwd_user["password"]);

                    // get_permission list
                    $permission=$this->connection->query("SELECT `dept_list` FROM `designation_list` WHERE `id`=".$pwd_user["designation_list_id"]."")->fetchColumn();

                    $user_details=array("name"=>$pwd_user["user_name"],"special_permission"=>$pwd_user["designation_list_id"],"permission"=>$permission);

                    if($auth_password==$password)
                    {
                        $_SESSION["user"]=$pwd_user["user_name"];
                        $_SESSION["type"]="user";
                        $_SESSION["user_option"]=$user_details;
                    }
                    else
                    {
                        echo "wrong_password";
                    }
                } 
                else
                {
                    echo "wrong_password";
                }
            }
            $this->connection->commit();
        }
        catch(PDOException $e)
        {
            $this->connection->rollBack();
            echo $e->getMessage();
        }
    }

}

?>