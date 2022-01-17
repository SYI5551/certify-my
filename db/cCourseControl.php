<?php
session_start();
include('db/config.php');
error_reporting(0);

//dia boleh create course only when the user is logged in
if(strlen($_SESSION['login'])==0)
      {
        header('location:homepage.php');
      }
      else
        {
            if(isset($_POST['createcourse']))
            {
                $email=$_POST['email'];
                $password=md5($_POST['password'];
                $ccourse=$_POST['createcourse'];
                $cname=$_POST['companyname'];
                $position=$_POST['position']);

                $email=$_SESSION['login'];

                $sql = "update createcourse set createcourse:=createcourse, companyname:=companyname, position:=position where email:=email";

                $query = $dbh->prepare($sql);
                $query->bindParam(':email',$email,PDO::PARAM_STR);
                $query->bindParam(':password',$password,PDO::PARAM_STR);
                $query->bindParam(':ccourse',$ccourse,PDO::PARAM_STR);
                $query->bindParam(':cname',$cname,PDO::PARAM_STR);
                $query->bindParam(':position',$position,PDO::PARAM_STR);
                $query->execute();
                $msg=" Create course has been created successfully.";
            }
                else
                    {
                        $msg=" Create course has not been created successfully.";
                    }
    }

?>