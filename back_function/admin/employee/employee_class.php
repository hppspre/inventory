<?php include_once("../../index.php");

class employee extends data_base_connection
{
    function add_a_new_empoyee($data)
    {
        $data=json_decode($data,TRUE);
        $this->connection->beginTransaction();
        try
        { 
            $nrow_name=$this->connection->query("SELECT COUNT(*) FROM `users` WHERE `name`='".$data[0]["value"]."'")->fetchColumn();
            $nrow_user_name=0;
            $nrow_admin_user_name=0;

            if($data[8]["value"]!="")
            {
               $nrow_user_name=$this->connection->query("SELECT COUNT(*) FROM `users` WHERE `user_name`='".$data[8]["value"]."'")->fetchColumn();
               $nrow_admin_user_name=$this->connection->query("SELECT COUNT(*) FROM `admin` WHERE `admin_user_name`='".$data[8]["value"]."'")->fetchColumn();
            }
           
            if($nrow_name==0 && $nrow_user_name==0 && $nrow_admin_user_name==0)
            {
            
                $time=date("Y-m-d");
                if($data[8]["value"]=="")
                {
                    $sql = "INSERT INTO `users` (`mail`,`nic`,`tp`,`name`,`status`,`profile`,`designation_list_id`,`address`,`epf_number`,`emp_number`,`added_date`) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
                    $stmt=  $this->connection->prepare($sql);
                    $stmt->execute([$data[1]["value"],$data[4]["value"],$data[2]["value"],$data[0]["value"],'active','no',$data[5]["value"],$data[3]["value"],$data[6]["value"],$data[7]["value"],$time]);
                    echo "ok";
                }
                else
                {
                    $hashed_password=password_hash($data[9]["value"],PASSWORD_DEFAULT);
                    $sql = "INSERT INTO `users` (`user_name`,`password`,`mail`,`nic`,`tp`,`name`,`status`,`profile`,`designation_list_id`,`address`,`epf_number`,`emp_number`,`added_date`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
                    $stmt=  $this->connection->prepare($sql);
                    $stmt->execute([$data[8]["value"],$hashed_password,$data[1]["value"],$data[4]["value"],$data[2]["value"],$data[0]["value"],'active','yes',$data[5]["value"],$data[3]["value"],$data[6]["value"],$data[7]["value"],$time]);
                    echo "ok";
                }
            }
            else
            {
                echo "not";
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
    public function get_emp_designation()
    {
        $this->connection->beginTransaction();
        try
        {
            
            $dsgntn=$this->connection->query("SELECT * FROM `designation_list`")->fetchALL(PDO::FETCH_ASSOC);
            return $dsgntn;

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
    public function save_designation($designation,$sales_designation,$dept_list)
    {
        
        $this->connection->beginTransaction();
      
        try
        {
            if($designation!="" && $sales_designation!="")
            {
                echo "both";
            }
            else
            {
                $nrow_designation=$this->connection->query("SELECT COUNT(*) FROM `designation_list` WHERE `designtion__name`='".$designation."' OR `designtion__name`='".$sales_designation."'")->fetchColumn();
                
                if($nrow_designation==0)
                {
                    if($designation!="")
                    {
                        $today = date("Y-m-d");
                        $sql = "INSERT INTO `designation_list` (`designtion__name`,`added_date`,`is_sales_related`,`dept_list`) VALUES (?,?,?,?)";
                        $stmt= $this->connection->prepare($sql);
                        $stmt->execute([$designation,$today,"no",$dept_list]);
                        echo "done";
                    }
                    else if($sales_designation!="")
                    {
                        // $sales_designation="sales".$sales_designation;
                        $nrow_designation=$this->connection->query("SELECT COUNT(*) FROM `designation_list` WHERE `designtion__name`='".'sales_'.$sales_designation."'")->fetchColumn();
                        if($nrow_designation==0)
                        {
                            $today = date("Y-m-d");
                            $sql = "INSERT INTO `designation_list` (`designtion__name`,`added_date`,`is_sales_related`,`dept_list`) VALUES (?,?,?,?)";
                            $stmt= $this->connection->prepare($sql);
                            $stmt->execute(['sales_'.$sales_designation,$today,"yes",$dept_list]);
                            $this->connection->prepare("ALTER TABLE  `items` ADD  `".'sales_'.$sales_designation."` INT  DEFAULT 0 AFTER `sales_persons_discount`")->execute();
                            echo "done";
                        }
                        else
                        {
                            echo "have";
                        }
                        
                    }
                }
                else
                {
                    echo "have";
                }
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
    public function change_designation($id,$dept_list)
    {
        $depts=json_decode($dept_list,TRUE);
        $this->connection->beginTransaction();
        try
        {

            if(sizeof($depts)>=0)
            {
                $depts=json_encode($depts,TRUE);
                $sql = "UPDATE `designation_list` SET `dept_list`='".$depts."' WHERE `id`=".$id."";
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
            echo $e->getMessage();
        }
    }

    public function change_commssion($val,$id)
    {
        
        $this->connection->beginTransaction();
      
        try
        {
            $sql = "UPDATE `designation_list` SET `discount`=".$val." WHERE `id`=".$id."";
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
    public function get_next_auto_emp()
    {
        $this->connection->beginTransaction();
      
        try
        {
           
            $next = $this->connection->query("SHOW TABLE STATUS LIKE 'users'")->fetch(PDO::FETCH_ASSOC)['Auto_increment']; 
            echo $next;

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
    public function get_emp_list()
    {
        $this->connection->beginTransaction();
      
        try
        {
            
            $emp_list=$this->connection->query("SELECT `users`.`id`, `users`.`user_name`, `users`.`mail`,`users`.`nic`,`users`.`tp`,`users`.`name`,`users`.`status`,`users`.`profile`,`users`.`address`,`users`.`epf_number`,`users`.`emp_number`,`designation_list_id`,`designtion__name`
            FROM `users`
            INNER JOIN `designation_list` ON `designation_list`.`id`=`users`.`designation_list_id` WHERE `status`<>'not';")->fetchALL(PDO::FETCH_ASSOC);

            echo json_encode($emp_list,TRUE); 
          
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
    public function get_specific_emp($id)
    {
        $this->connection->beginTransaction();
      
        try
        {
           
            $Emp_data_list=$this->connection->query("SELECT * FROM `users` WHERE `id`=".$id."")->fetchALL(PDO::FETCH_ASSOC);
            echo json_encode($Emp_data_list,TRUE); 
          
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
    public function change_data_employee($Emp_data)
    {
        
        $this->connection->beginTransaction();
        try
        {
            $data=json_decode($Emp_data,TRUE);
    
            $nrow_designation=$this->connection->query("SELECT COUNT(*) FROM `users` WHERE `name`='".$data[0]["value"]."' AND `id`<>".$data[7]["value"]." ")->fetchColumn();
            
            if($nrow_designation==0)
            {
                $sql = "UPDATE `users` SET `name`='".$data[0]["value"]."',`mail`='".$data[1]["value"]."', `nic`='".$data[3]["value"]."',`tp`='".$data[2]["value"]."',`designation_list_id`='".$data[5]["value"]."',`address`='".$data[4]["value"]."',`epf_number`='".$data[6]["value"]."' WHERE `id`=".$data[7]["value"]."";
                $stmt= $this->connection->prepare($sql);
                $stmt->execute();
                echo "done";
            }
            else
            {
                echo "have";
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
    public function change_data_employee_user_name_and_pwd($user_name,$password,$id)
    {
        $this->connection->beginTransaction();
        try
        {
            
            if($user_name=="" && $password=="")
            {
                $sql = "UPDATE `users` SET `profile`='no' WHERE `id`=".$id."";
                $stmt= $this->connection->prepare($sql);
                $stmt->execute();
                echo "done";
            }
            else
            {
                $nrow_user_name=$this->connection->query("SELECT COUNT(*) FROM `users` WHERE `user_name`='".$user_name."' AND `id`<>".$id."")->fetchColumn();
                $nrow_admin_user_name=$this->connection->query("SELECT COUNT(*) FROM `admin` WHERE `admin_user_name`='".$user_name."'")->fetchColumn();
                
                if($nrow_user_name==0 && $nrow_admin_user_name==0)
                {
                        $hashed_password=password_hash($password, PASSWORD_DEFAULT);
                        $sql = "UPDATE `users` SET `user_name`='".$user_name."' , `password`='".$hashed_password."',`profile`='yes' WHERE `id`=".$id."";
                        $stmt= $this->connection->prepare($sql);
                        $stmt->execute();
                        echo "done";
                    
                }
                else 
                {
                    echo "have";
                }
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
    public function deativate_user($id)
    {
        $this->connection->beginTransaction();

        try
        {
            $sql = "UPDATE `users` SET `status`='not_active' WHERE `id`=".$id."";
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
    public function ativate_user($id)
    {
        $this->connection->beginTransaction();

        try
        {
            $sql = "UPDATE `users` SET `status`='active' WHERE `id`=".$id."";
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
    public function drop_users($id,$reson)
    {
        $this->connection->beginTransaction();

        try
        {
            $time=date("Y-m-d");

            $sql = "UPDATE `users` SET `status`='not',`resignation_reason`='".$reson."',`resignation_date`='".$time."' WHERE `id`=".$id."";
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
    public function get_emp_info($emp_number)
    {
        $this->connection->beginTransaction();

        try
        {

            $emp_info=$this->connection->query("SELECT `designation_list`.`designtion__name`,`designation_list`.`dept_list`,`users`.`resignation_reason`,`users`.`emp_number`,`users`.`epf_number`,`users`.`address`,`users`.`profile`,`users`.`status`,`users`.`tp`,`users`.`nic`,`users`.`mail`,`users`.`name`,`users`.`added_date`,`users`.`resignation_date`
            FROM `users`
            INNER JOIN `designation_list` ON `designation_list`.`id`=`users`.`designation_list_id` WHERE `users`.`emp_number`='".$emp_number."'")->fetchALL(PDO::FETCH_ASSOC);

            echo json_encode($emp_info,TRUE);

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