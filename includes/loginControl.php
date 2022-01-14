<?php

require 'config.php';
    try
        {
            $email=$_POST['email'];
            $password=md5($_POST['password']);
            $sql ="SELECT firstname, email, password FROM registration WHERE email=:email and password=:password";
            $query= $dbh -> prepare($sql);
            $query-> bindParam(':email', $email, PDO::PARAM_STR);
            $query-> bindParam(':password', $password, PDO::PARAM_STR);
            $query-> execute();
            $results=$query->fetch(PDO::FETCH_OBJ);

            if($query->rowCount() > 0)
                {
                    $_SESSION['login']=$_POST['email'];
                    $_SESSION['fname']=$results->firstname;
                    $data = array(
                        "status" => "Success",
                    );
                    echo json_encode($data);
                } 
            else
                    {
                        $data = array(
                            "status" => "Fail"
                        );
                        echo json_encode($data);
                    }
                   
                  
        } catch (PDOException $e) {
                    $data = array(
                        "status" => "Fail"
                    );
                    echo json_encode($data);
                    //echo $e;
        }

        
?>