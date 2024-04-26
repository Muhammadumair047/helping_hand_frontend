<?php
// session_start.php

session_start();

// Check if the user is logged in
if (isset($_SESSION['id'])) {
        $user_type = $_SESSION['user_type'];

    
    if ($user_type === 'user') {
        header("Location: userDashboard.php");
        exit();
    } elseif ($user_type === 'admin') {
        header("Location: admin.php");
        exit();
    }
   
}

?>
