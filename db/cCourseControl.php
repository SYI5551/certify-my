<?php
session_start();
include('db/config.php');
error_reporting(0);

//dia boleh create course only when the user is logged in
if(strlen($_SESSION['login'])==0)
      {
        header('location:../homepage.php');
      }
      else
        {
            if(isset($_POST['createcourse']))
            {
                $coursename=$_POST['coursename'];
                $cname=$_POST['companyname'];
                $position=$_POST['position']);
                $email=$_SESSION['login'];

                $sql = "INSERT INTO createcourse (coursename, companyname, email, position) 
                VALUES(:coursename, :companyname, :email, :position)";


                $query = $dbh->prepare($sql);
                $query->bindParam(':email',$email,PDO::PARAM_STR);
                $query->bindParam(':coursename',$coursename,PDO::PARAM_STR);
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