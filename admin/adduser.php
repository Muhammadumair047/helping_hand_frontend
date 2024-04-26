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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
    crossorigin="anonymous">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <?php
                    
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        // Collect user input
                        $username = mysqli_real_escape_string($con, $_POST['username']);
                        $contact = mysqli_real_escape_string($con, $_POST['contact']);
                        $email = mysqli_real_escape_string($con, $_POST['email']);
                        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
                        $confirmPassword = $_POST['confirm_password'];
                    
                        // Check if the email is already registered
                        $check_query = "SELECT * FROM `user_reg` WHERE gmail = '$email'";
                        $check_result = mysqli_query($con, $check_query);
                    
                        if (mysqli_num_rows($check_result) > 0) {
                            echo '<div class="alert alert-danger" role="alert">Email is already registered. Please use another email.</div>';
                        } else {
                            // Validate password length
                            if (strlen($_POST['password']) < 8) {
                                echo '<div class="alert alert-danger" role="alert">Password should contain at least 8 characters.</div>';
                            } else {
                                // Validate password and confirm password match
                                if ($_POST['password'] !== $confirmPassword) {
                                    echo '<div class="alert alert-danger" role="alert">Password and Confirm Password do not match.</div>';
                                } else {
                                    // Insert user into the database
                                    $insert_query = "INSERT INTO `user_reg` (username, gmail, contact, password) VALUES ('$username',  '$email','$contact', '$password')";
                                    $insert_result = mysqli_query($con, $insert_query);
                            
                                    if ($insert_result) {
                                        echo '<div class="alert alert-success" role="alert">User added successfully!</div>';
                                    } else {
                                        echo '<div class="alert alert-danger" role="alert">Error: ' . mysqli_error($con) . '</div>';
                                    }
                                }
                            }
                        }
                    }
                    ?>

                    <form action="" method="post" onsubmit="return validateForm()">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username:</label>
                            <input type="text" name="username" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="contact" class="form-label">Contact:</label>
                            <input type="text" name="contact" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password:</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                            <small class="text-muted">Password should contain at least 8 characters.</small>
                        </div>

                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Confirm Password:</label>
                            <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary" name="submit">Add User</button>
                        <a href="admin.php" class="btn btn-primary">Return Dashboard</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
crossorigin="anonymous"></script>

<script>
    function validateForm() {
        var password = document.getElementById("password").value;
        var confirmPassword = document.getElementById("confirm_password").value;

        if (password.length < 8) {
            alert("Password should contain at least 8 characters.");
            return false;
        }

        if (password !== confirmPassword) {
            alert("Password and Confirm Password do not match.");
            return false;
        }

        return true;
    }
</script>
</body>
</html>
