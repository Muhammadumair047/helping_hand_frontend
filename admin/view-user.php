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



// Delete user if deleteid is set
if (isset($_GET['deleteid'])) {
    $delete_id = $_GET['deleteid'];
    $delete_query = "DELETE FROM user_reg WHERE id = $delete_id";
    $delete_query_run = mysqli_query($con, $delete_query);

    if (!$delete_query_run) {
        die('Error in the delete query: ' . mysqli_error($con));
    }

    // Redirect to the same page after deletion
    header("Location: view-user.php");
    exit();
}

// Fetch all registered users when the page loads
$query = "SELECT * FROM user_reg";
$query_run = mysqli_query($con, $query);

if (!$query_run) {
    die('Error in the query: ' . mysqli_error($con));
}




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registered Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
    crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
   
</head>
<body>

<div class="container-fluid">
    <div class="row mt-4">
        <div class="col-12 text-center">
            <a href="adduser.php" class="btn btn-success">Add User</a>
            
    <a  class=" btn btn-primary " href="admin.php"> Return Dashboard</a>
  
        </div>
    </div>



    <div class="table-responsive">
        <?php
        // Display all registered users
        if (mysqli_num_rows($query_run) > 0) {
            echo '<table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">UserName</th>
                            <th scope="col">Email</th>
                            <th scope="col">Contact</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>';
            while ($row = mysqli_fetch_assoc($query_run)) {
                $id = $row['id'];
                $username = $row['username'];
                $email = $row['gmail'];
                $contact = $row['contact'];

                echo '<tr>
                        <th scope="row">' . $id . '</th>
                        <td>' . $username . '</td>
                        <td>' . $email . '</td>
                        <td>' . $contact . '</td>
                        <td>
                            <a href="?deleteid=' . $id . '" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>';
            }
            echo '</tbody></table>';
        } else {
            echo "<b>No registered users found</b>";
        }
        ?>
    </div>
</div>

</body>
</html>
