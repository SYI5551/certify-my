<!-- <?php
    //error_reporting(0);
    if(isset($_POST['register']))
        {
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

        if($lastInsertId)
            {  
                header('Location: view/register.php');
                exit();
            }
            else
                {
                    echo "<script>alert('Something went wrong. Please try again');</script>";
                }
        }
?> -->


<div class="modal fade" id="signupform">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <h3 class="modal-title">Sign Up</h3>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="signup_wrap">
            <div class="col-md-12 col-sm-6">
              <form  method="post" id="regForm"name="signup" >
                <div class="form-group">
                  <input type="text" class="form-control" name="firstname" placeholder="First Name" required="required"><br>
                </div>

                <div class="form-group">
                  <input type="text" class="form-control" name="lastname" placeholder="Last Name" required="required"><br>
                </div>

                <div class="form-group">
                  <input tabindex="3" type="text" class="form-control" name="companyname" placeholder="Company Name" required="required"><br>
                </div>
                <div class="form-group">
                  <input type="email" id="emailid" class="form-control" name="emailid" placeholder="Email Address" required="required"><br>
                   <span id="user-availability-status" style="font-size:12px;"></span>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="phonenum" placeholder="Phone Number" required="required"><br>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" name="password" placeholder="Password" required="required"><br>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" name="confirmpassword" placeholder="Confirm Password" required="required"><br>
                </div>
                <div class="form-group">
                  <button type="submit" name="register" value="Sign Up" id = "submit"  class="btn btn-primary">Register</button><br><br>
                </div>
              </form>
            </div>

          </div>
        </div>
      </div>
      <div class="modal-footer text-center">
        <p>Already got an account? <a href="#exampleModal" data-bs-toggle="modal" data-dismiss="modal">Login Here</a></p>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
    $(document).ready(function (event)  
        {
          //e.preventDefault(); - kalau ada problem, kena tambah ni. try tambah ni
          $("#emailid").change(function(){
            var email = $("#emailid").val();
            if(email.length >=3){
              $.ajax({
              url: "checkAvailability.php",
              data:'emailid='+email,
              type: "POST",
              success:function(data){
              $("#user-availability-status").html(data);
              
              },
              error:function (){}
              });
          }
          });

          $("#regForm").submit(function(e){
            e.preventDefault();
            var formData = $(this).serialize();
         
            if(rgValidation() == true)
            {
                
              $.ajax({
                type: "POST",
              url: "db/registration.php",
              data:formData,
              success:function(data){
                const obj = JSON.parse(data);
                console.log(obj.status);
                if ((obj.status) == "success") {
                  alert("Successfully add data");
                  $("#signupform").modal('hide');
                    $("#exampleModal").modal('show');
                } else {
                  alert("fail to insert, " + data.errormessage);
                }
              
              },
              error:function (xhr, status, error){
                alert("error " + xhr +", "+ status +", "+ error);
              }
              });
            
          }
          });
    });
</script>

<script type="text/javascript">
    function rgValidation()
        {
            if(document.signup.password.value!= document.signup.confirmpassword.value)
                {
                    alert("Password and Confirm Password do not match! Please re-enter!");
                    document.signup.confirmpassword.focus();
                    return false;
                }
           
            else{
            return true;
            }
        }
</script>