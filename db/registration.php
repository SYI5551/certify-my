<?php
    //error_reporting(0);
    require 'config.php';
    try{
   
            $fname=$_POST['firstname'];
            $lname=$_POST['lastname'];
            $cname=$_POST['companyname'];
            $email=$_POST['emailid'];
            $phonenum=$_POST['phonenum'];
            //md5 = message diggest algorithm, The MD5 algorithm is used as an encryption or fingerprint function for a file.
            $password = md5($_POST['password']);

            $sql = "INSERT INTO registration(firstname, lastname, companyname, email, phonenum, password) 
                    VALUES(:fname, :lname, :cname, :email, :phonenum, :password)";

            $query = $dbh->prepare($sql);
            $query->bindParam(':fname',$fname,PDO::PARAM_STR);
            $query->bindParam(':lname',$lname,PDO::PARAM_STR);
            $query->bindParam(':cname',$cname,PDO::PARAM_STR);
            $query->bindParam(':email',$email,PDO::PARAM_STR);
            $query->bindParam(':phonenum',$phonenum,PDO::PARAM_STR);
            $query->bindParam(':password',$password,PDO::PARAM_STR);
            $query->execute();
            $lastInsertId = $dbh->lastInsertId();

            $data = array(
                "status" => "success",
            );
            echo json_encode($data);
          
        } catch (PDOException $e) {
            $data = array(
                "status" => "fail"
            );
            echo json_encode($data);
            echo $e;
        }
?>

