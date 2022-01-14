<?php

session_start();
include('includes/config.php');
error_reporting(0);

    if(isset($_POST['update']))
        {
            $email = $_POST['email'];
            $phonenum = $_POST['phonenum'];
            $newpassword = md5($_POST['newpassword']);
            $sql = "SELECT email FROM registration WHERE email=:email and phonenum=:phonenum";
            $query = $dbh -> prepare($sql);
            $query-> bindParam(':email', $email, PDO::PARAM_STR);
            $query-> bindParam(':phonenum', $phonenum, PDO::PARAM_STR);
            $query-> execute();
            $results = $query -> fetchAll(PDO::FETCH_OBJ);
            
            if($query -> rowCount() > 0)
                {
                    $con="update registration set password=:newpassword where email=:email and phonenum=:phonenum";
                    $chngpwd1 = $dbh->prepare($con);
                    $chngpwd1-> bindParam(':email', $email, PDO::PARAM_STR);
                    $chngpwd1-> bindParam(':phonenum', $phonenum, PDO::PARAM_STR);
                    $chngpwd1-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
                    $chngpwd1-> execute();
                    echo "<script>alert('Your Password has been succesfully changed.');</script>";
                }
                else 
                    {
                        echo "<script>alert('Email or Phone Number is invalid.');</script>";
                    }
        }
?>

<script type="text/javascript">
    function fpValidation()
        {
            if(document.chngpwd.newpassword.value!= document.chngpwd.confirmpassword.value)
                {
                    alert("New Password and Confirm Password do not match! Please re-enter!");
                    document.chngpwd.confirmpassword.focus();
                    return false;
                }
        return true;
        }
</script>

<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Password Recovery</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="row">
        <div class="forgotpassword_wrap">
        <div class="col-md-12 col-sm-6">
            <form method="post">
                <div class="form-group" method="post" onSubmit="return fpValidation();">
                    <input type="email" class="form-control" name="email" placeholder="Email Address*" required="required">
                </div>
                <br>
                <div class="form-group">
                  <input type="text" name="phonenum" class="form-control" placeholder="Phone Number*" required="">
                </div>
                <br>
                <div class="form-group">
                  <input type="password" class="form-control" name="newpassword" placeholder="New Password*" required="required">
                </div>
                <br>
                <div class="form-group">
                  <input type="password" class="form-control" name="confirmpassword" placeholder="Confirm Password*" required="required">
                </div>
                <br>
                <div class="form-group">
                <p class="gray_text"><i>For security reason, we don't store your password. Your password will be reset and a new one will be send.</i></p>
                 <button type="submit" name="update" value="Reset My Password"class="btn btn-primary">Reset Password</button><br><br>
                 <p><a href="#exampleModal" data-bs-toggle="modal" data-dismiss="modal">Back to Log In</a></p> 
                </div>
            </form>
        </div>

        </div>
        </div>
      </div>
      <!-- <div class="modal-footer">
            <p>Don't have an account? <a href="#signupform" data-bs-toggle="modal" data-dismiss="modal">Signup Here</a></p>
      </div> -->
    </div>
  </div>
</div>