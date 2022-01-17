<?php
    session_start();
    error_reporting(0);
    include('db/config.php');
    if(isset($_POST['update']))
        {
            $password = md5($_POST['password']);
            $newpassword = md5($_POST['newpassword']);
            $email = $_SESSION['login'];
            $sql = "SELECT password FROM registration WHERE email=:email and password=:password";
            $query = $dbh -> prepare($sql);
            $query-> bindParam(':email', $email, PDO::PARAM_STR);
            $query-> bindParam(':password', $password, PDO::PARAM_STR);
            $query-> execute();
            $results = $query -> fetchAll(PDO::FETCH_OBJ);

                if($query -> rowCount() > 0)
                    {
                        $con = "update registration set password=:newpassword where email=:email";
                        $chngpwd1 = $dbh->prepare($con);
                        $chngpwd1-> bindParam(':email', $email, PDO::PARAM_STR);
                        $chngpwd1-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
                        $chngpwd1->execute();
                        $msg = " Your Password has been succesfully changed.";
                    }
                    else 
                        {
                            $error = " Your current password is wrong.";
                        }
        }
?>

<?php
  session_start();
  include('db/config.php');
  error_reporting(0);
?>

<!DOCTYPE html>
<html lang="en">

<head>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Certify.My</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <!-- =======================================================
  * Template Name: Arsha - v4.7.1
  * Template URL: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->

  <script type="text/javascript">
    function upValidation()
        {
            if(document.updatepwd.newpassword.value!= document.updatepwd.confirmpassword.value)
                {
                    alert("New Password and Confirm Password do not match! Please re-enter!");
                    document.updatepwd.confirmpassword.focus();
                    return false;
                }
        return true;
        }
</script>
</head>

<body>
<!--Header-->
<?php include('view/header.php');?>

<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <ol>
          <li><a href="homepage.php">Home</a></li>
          <li>Update Password</li>
        </ol>
        <h2>Update Password</h2>

      </div>
    </section><!-- End Breadcrumbs -->

    <section class="inner-page">
      <div class="container">
        <p>
        <?php
          $email = $_SESSION['login'];
          $sql = "SELECT * from registration where email=:email";
          $query = $dbh -> prepare($sql);
          $query -> bindParam(':email',$email, PDO::PARAM_STR);
          $query->execute();
          $results=$query->fetchAll(PDO::FETCH_OBJ);
          $cnt=1;

          if($query->rowCount() > 0)
              {
                  foreach($results as $result)
              {
        ?>

<div class="col-md-6 col-sm-8">
<div class="profile_wrap">
<form name="updatepwd" method="post" onSubmit="return upValidation();">

            <?php if($error){?><div class="errorWrap"><strong>Error </strong>:<?php echo htmlentities($error); ?> </div><?php }
            else if($msg){?><div class="succWrap"><strong>Success </strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
            <br>

            <div class="form-group">
              <label class="control-label">Current Password</label>
              <input class="form-control white_bg" id="password" name="password"  type="password" required>
            </div>
            <br>
            <div class="form-group">
              <label class="control-label">New Password</label>
              <input class="form-control white_bg" id="newpassword" type="password" name="newpassword" required>
            </div>
            <br>
            <div class="form-group">
              <label class="control-label">Confirm Password</label>
              <input class="form-control white_bg" id="confirmpassword" type="password" name="confirmpassword"  required>
            </div>
            <br>
            <br><div class="form-group">
            <button type="submit" name="update" value="Update" id = "submit" class="btn btn-primary">Update</button><br><br>
            </div>

</form>
</div>
</div>
        </p>
      </div>
    </section>

  </main><!-- End #main -->



<!--Footer -->
<?php include('view/footer.php');?>

<!--Login-Form -->
<?php include('view/login.php');?>

<!--Register-Form -->
<?php include('db/registration.php');?>

<!--Forgot-password-Form -->
<?php include('forgotpassword.php');?>

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <script>
        var myModal = document.getElementById('myModal')
        var myInput = document.getElementById('myInput')

        myModal.addEventListener('shown.bs.modal', function () {
          myInput.focus()
        })
  </script>
</body>
</html>
<?php }} ?>