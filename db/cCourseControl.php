<?php
include('../db/connect.php');


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
                $position=$_POST['position'];
                $date=$_POST['date'];
                $email=$_SESSION['login'];

                $sql = "INSERT INTO createcourse (coursename, email, date, position) 
                VALUES(:coursename, :email, :date, :position)";


                $query = $dbh->prepare($sql);
                $query->bindParam(':email',$email,PDO::PARAM_STR);
                $query->bindParam(':coursename',$coursename,PDO::PARAM_STR);
                $query->bindParam(':date',$date,PDO::PARAM_STR);
                $query->bindParam(':position',$position,PDO::PARAM_STR);
                $query->execute();
                $msg=" Create course has been created successfully.";
                echo "<script>alert('Create course has been created successfully.');
                window.location.href= '../view/cCourse.php';
                </script>";
                
            }
                else
                    {
                        $msg=" Create course has not been created successfully.";
                        echo "<script>alert('Create course has not been created successfully.');
                        window.location.href= '../view/cCourse.php';</script>";
                    }
    }

?>