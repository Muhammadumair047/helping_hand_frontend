
<?php

include 'session.php';
include  '_connect.php';


if (isset($_POST['submit'])) {
  $gmail = $_POST['gmail'];
  $password = $_POST['password'];

  $query = mysqli_query($con, "SELECT * FROM user_reg WHERE gmail = '$gmail'");
  $user = mysqli_fetch_assoc($query);


if ($user) {
  // Verify password
  if (password_verify($password, $user['password'])) {
      session_start();
      $_SESSION['user_logged_in'] = true;
      $_SESSION['user_id'] = $user['id']; 

      if ($user['user_type'] === 'admin') {
          $_SESSION['admin_logged_in'] = true;
          header("location:../admin/admin.php?id=" . $user['id']); // Redirect to admin dashboard with admin ID
          exit();
      } else {
          header("location: ../Users/userDashboard.php?id=" . $user['id']); // Redirect to user dashboard with user ID
          exit();
      }
  } else {
      echo '<script>alert("Email and Password are Incorrect")</script>';
  }
} else {
  echo '<script>alert("Email and Password are Incorrect")</script>';
}


}





?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
     crossorigin="anonymous">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
      crossorigin="anonymous"></script>
      <script src="./script.js" defer></script>
     
    
</head>
<body>
    <section  style="background-color: #9A616D;">
        <div class="container  h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-10">
              <div class="card" style="border-radius: 1rem;">
                <div class="row ">
                  <div class="col-md-6 col-lg-5 d-none d-md-block">
                    <img src="../images/login_helping_hand.jpg"
                      alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                  </div>
                  <div class="col-md-6 col-lg-7 d-flex align-items-center">
                    <div class="card-body p-4 p-lg-5 text-black">
      
                      <form method= "POST">
      
                        <div class="mb-2 text-center pb-1">
                          <span class="h1 fw-bold ">Login</span>
                        </div>
      
                        
                        <div class="form-outline mb-4">
                            <label class="form-label" for="gmail">Email address</label>
                          <input type="email" name= "gmail"class="form-control form-control-lg" />
                          
                        </div>
      
                        <div class="form-outline mb-4">
                            <label class="form-label" for="password">Password</label>
                          <input type="password" name="password" class="form-control form-control-lg" />
                          
                        </div>
      
                        <div class="pt-1 mb-4">
                          <button class="btn btn-dark btn-lg btn-block" name = "submit" type="submit">Login</button>
                        </div>
      
                        <a class="small text-muted" href="#!">Forgot password?</a>
                        <p class="mb-5 pb-lg-2" style="color: #393f81;">Don't have an account? <a href="signup.php"
                            style="color: #393f81;">Register here</a></p>
                        
                        
                      </form>
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
</body>
</html>