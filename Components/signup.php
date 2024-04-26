

<?php
 include '_connect.php';
 if (isset($_POST['submit'])) {
  $email = $_POST['gmail'];
  $username = $_POST['username'];
  $contact = $_POST['contact'];
  $password = $_POST['password'];
  $cpassword = $_POST['cpassword'];

  // Hash the password before storing it in the database
  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

  $query = "SELECT * FROM `user_reg` WHERE gmail = '$email'";
  $run = mysqli_query($con, $query);

  if (mysqli_num_rows($run) > 0) {
      echo '<div class="alert alert-danger" role="alert">Email is already registered!</div>';
  } else {
      if ($password === $cpassword) {
          $sql = "INSERT INTO `user_reg` (username, gmail, contact, password) VALUES ('$username', '$email', '$contact', '$hashedPassword')";
          $run = mysqli_query($con, $sql);

          if ($run) {
              echo header("location:login.php");
          } else {
              echo '<div class="alert alert-danger" role="alert">Error inserting data into the database</div>';
          }
      } else {
          echo '<div class="alert alert-danger" role="alert">Password Mismatch!</div>';
      }
  }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
     crossorigin="anonymous">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
      crossorigin="anonymous"></script>
      <script src="./script.js" defer></script>
      
</head>
<body>



    <section style="background-color: #9A616D;">
        <div class="container ">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-11">
              <div class="card text-black" style="border-radius: 25px;">
                <div class="card-body p-md-5">
                  <div class="row justify-content-center">
                    <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
      
                      <p class="text-center h1 fw-bold mb-2 mx-1 mx-md-4 mt-4">Sign up</p>
      
                      <form class="mx-1 mx-md-4" role="form" action="" method="post"   onsubmit ="return verifyPassword()">
      
                        <div class="d-flex flex-row align-items-center mb-2">
                            
                          <div class="form-outline flex-fill mb-0">
                            <label class="form-label" for="username">Your Name</label>
                            <input type="text" name="username"  class="form-control" required />
                          </div>
                        </div>
      
                        <div class="d-flex flex-row align-items-center mb-2">
                          <div class="form-outline flex-fill mb-0">
                            <label class="form-label" for="gmail">Your Email</label>
                            <input type="email" name="gmail"  class="form-control"  required/>
                          </div>
                        </div>
                        <div class="d-flex flex-row align-items-center mb-2">
                          <div class="form-outline flex-fill mb-0">
                            <label class="form-label" for="contact">Contact</label>
                            <input type="tel" name="contact" class="form-control" required/>
                          </div>
                        </div>
      
                        <div class="d-flex flex-row align-items-center mb-2">
                          <div class="form-outline flex-fill mb-0">
                            
                            <label class="form-label" for="password">Password</label>
                            <input type="password" name="password" id = "pswd1" value = "" class="form-control"/>
                            <span id = "message" style="color:red"> </span>
                          </div>
                        </div>
      
                        <div class="d-flex flex-row align-items-center mb-4">
                          <div class="form-outline flex-fill mb-0">
                            <label class="form-label" for="cpassword">Repeat your password</label>
                            <input type="password"  id = "pswd2" value = "" class="form-control" name="cpassword" required/>
                            </div>
                        </div>

      
                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-0">
                        <button type="submit" class="btn btn-primary btn-lg" name="submit">Register</button>
                        
                        </div>
      
                      </form>
                      
      
                    </div>
                    <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
      
                      <img src="../images/signup_helping_hand.jpg"
                        class="img-fluid" alt="Sample image">
      
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