<!-- ======= Header ======= -->
<header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center">

    <h1 class="logo me-auto"><a href="homepage.php">Certify.My</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="../homepage.php">Home</a></li>
          <li><a class="nav-link scrollto" href="#about">About Us</a></li>
          <li><a class="nav-link scrollto" href="../view/cCourse.php">Create Course</a></li>
          <li><a class="nav-link scrollto" href="#">Record</a></li>
          <li><a class="nav-link scrollto" href="#">Verify Certificate</a></li>
        </ul>
      </nav>

    <!--<?php   
                if(strlen($_SESSION['login'])==0)
	                {
            ?>
                <div class="login_btn"> <a href="#loginform" class="btn btn-xs uppercase" data-toggle="modal" data-dismiss="modal">Login / Register</a> </div>
                <?php }
                    else
                        {
                            echo "Welcome To Certify.my.";
                        } 
                ?> -->
    </div>

<!-- Navigation -->
    <nav id="navigation_bar" class="navbar navbar-default">
        <div class="container">
        <div class="header_wrap">
            <div class="user_login">
            <ul>
                <?php if($_SESSION['login'])
                    {?>
                        <li class="dropdown"> <a href="" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user-circle" aria-hidden="true"></i>
                    <?php } 
                        else 
                            { 
                    ?>
                    <li class="dropdown"> <a href="#exampleModal" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user-circle" aria-hidden="true"></i>Get Started
                <?php } ?>
    <?php
        $email=$_SESSION['login'];
        $sql ="SELECT firstname FROM registration WHERE email=:email ";
        $query= $dbh -> prepare($sql);
        $query-> bindParam(':email', $email, PDO::PARAM_STR);
        $query-> execute();
        $results=$query->fetchAll(PDO::FETCH_OBJ);

    if($query->rowCount() > 0)
        {
            foreach($results as $result)
                {
                    echo htmlentities($result->firstname);  }}?><i class="fa fa-angle-down" aria-hidden="true"></i></a>
        
                <ul class="dropdown-menu">
                    <?php if($_SESSION['login']){?>
                    <li><a href="myProfile.php">My Profile</a></li>
                    <li><a href="updatePassword.php">Update Password</a></li>
                    <li><a href="db/logout.php">Sign Out</a></li>
                    <?php } 
                        else 
                            { 
                    ?>
                        <li><a href="#exampleModal" data-bs-toggle="modal" data-dismiss="modal">Sign In</a></li>
                        <li><a href="#signupform" data-bs-toggle="modal" data-dismiss="modal">Register</a></li>
                    <?php } ?>
                </ul>
            </ul>
            </div>

        </div>
        </div>
  </header>