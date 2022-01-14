
 
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Sign In</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="row">
        <div class="login_wrap">
        <div class="col-md-12 col-sm-6">
            <form method="post" id="loginForm">
                <div class="form-group">
                    <input type="email" class="form-control" name="email" placeholder="Email address*" required="required">
                </div>
                <br>
                <div class="form-group">
                  <input type="password" class="form-control" name="password" placeholder="Password*"required="required">
                </div>
                <br>
                <div class="form-group">
                 <button type="submit" name="login" value="Login"class="btn btn-primary">Sign In</button><br><br>
                 <p><a href="#myModal" data-bs-toggle="modal" data-dismiss="modal">Forgot Password ?</a></p> 
                </div>
            </form>
        </div>

        </div>
        </div>
      </div>
      <div class="modal-footer">
            <p>Don't have an account? <a href="#signupform" data-bs-toggle="modal" data-dismiss="modal">Signup Here</a></p>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function (event)  
{
   $("#loginForm").submit(function(e){
            e.preventDefault();
            var formData = $(this).serialize();
              $.ajax({
                type: "POST",
              url: "includes/loginControl.php",
              data:formData,
              success:function(data){
                const obj = JSON.parse(data);
                if ((obj.status) == "Success") {
                  alert("Successfully Login");
                  window.location.href = "homepage.php";
                } else {
                  alert("Wrong username or password");
                }
              
              },
              error:function (xhr, status, error){
                alert("error " + xhr +", "+ status +", "+ error);
              }
              });
            
          
          });
    });
</script>