<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
     crossorigin="anonymous">
</head>
<body>

<nav class="navbar navbar-expand-lg  navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Helping Hand</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#about">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#services">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contact">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#NGOs">View NGO</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Search.php">Search NGO</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                <?php
        // Start or resume the session
        session_start();

        // Check if the user is already logged in
        if (isset($_SESSION['id'])) {
            $user_type = $_SESSION['user_type'];
            
            // Redirect to the appropriate dashboard based on user type
            if ($user_type === 'user') {
                echo '<a class="nav-link" href="./Users/userDashboard.php">Dashboard</a>';
            } elseif ($user_type === 'admin') {
                echo '<a class="nav-link" href="../admin/admin.php">Admin Dashboard</a>';
            }
        } else {
            // If no active session, redirect to the login page
            echo '<a class="nav-link" href="./Components/login.php">Login</a>';
        }
        ?>
                


            </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="./Components/signup.php">Sign Up</a>
                </li>
            </ul>
        </div>
    </div>
</nav>



<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.7.2/dist/js/bootstrap.min.js"></script>

</body>
</html>
