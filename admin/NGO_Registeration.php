
<?php

include '../Components/_connect.php';
include '../Components/session.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ./Components/login.php");
    exit();
}



// Retrieve user type from the database
$query = "SELECT user_type FROM user_reg WHERE id = " . $_SESSION['user_id'];
$result = mysqli_query($con, $query);

if (!$result) {
    die("Database query failed");
}

$user_data = mysqli_fetch_assoc($result);
$user_type = $user_data['user_type'];

// Check if the user is an admin
if ($user_type !== 'admin') {
    echo "Login as admin required";
    exit();
}


// Fetch categories from 'ngo-cat' table
$categoryQuery = "SELECT category FROM `ngo-cat`";
$categoryResult = mysqli_query($con, $categoryQuery);

// Check if the query was successful
if ($categoryResult) {
    // Fetch categories into an array
    $categories = mysqli_fetch_all($categoryResult, MYSQLI_ASSOC);
} else {
    // Handle the error
    die(mysqli_error($con));
}




if(isset($_POST ['submit'])){
   $name= $_POST['name'];
    $contact= $_POST['contact'];
    $address=$_POST['address'];
    $category= $_POST['category'];
    $descreption= $_POST['descreption'];

    $sql ="insert into `ngoreg` (name,contact,address,category,Discreption) values('$name','$contact',
    '$address','$category','$descreption')";    

    $result=mysqli_query($con,$sql);
    if($result){
        echo header("location:admin.php");
    }
    else{
        die(mysqli_error($con));
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NGO Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
     rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" 
    crossorigin="anonymous">
    <link rel="stylesheet" type="" href="../styles.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
     integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
     crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
<form role="form" action="" method="post" >
            <div>   
                <label for="category">Choose a Category:</label>
                <select name="category" class="form-control">
                  
                    <?php
                    // Dynamically populate categories from the 'ngo-cat' table
                    foreach ($categories as $category) {
                        echo '<option value="' . $category['category'] . '">' . $category['category'] . '</option>';
                    }
                    ?>
                    
                </select>
            </div>
              <div>
                <label  for="name">NGO Name</label>
                <input type="text" name="name" placeholder="NGO Name" class="form-control" >
              </div>
              <div>
                <label  for="contact">Contact Number</label>
                <input type="text" name="contact" placeholder="contact" class="form-control " >
              </div>
              <div>
                <label  for="address">Addres</label>
                <input type="text" name="address" placeholder="Address" class="form-control">
              </div>
              
              <div>
                <label  for="descreption">Discreption</label>
                <textarea name="descreption" placeholder="About NGO" class="form-control" rows="6"></textarea>
              </div><br>
              <button type="submit" class="btn btn-primary" name="submit">Register</button>
              <button class="btn btn-primary" type="button">
    <a style="text-decoration:none" class="text-white" href="admin.php"> Return Dashboard</a>
    </button>
             
            </form>
</div>
</body>
</html>