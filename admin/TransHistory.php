<?php
include "../Components/_connect.php";
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




// Fetch all data from the 'donations' table
$selectAllData = "SELECT * FROM `donations`";
$resultAllData = mysqli_query($con, $selectAllData);




if ($resultAllData) {
    // Display the table header
    echo "<h4>All Donations:</h4>";
    echo "<table  border='1'>
            <tr>
                <th>Donor Name</th>
                <th>Email</th>
                <th>NGO Name</th>
                <th>Donation Amount</th>
                <th>Card Number</th>
                <th>Card Expiry Month</th>
                <th>Card Expiry Year</th>
                <th>Status</th>
                <th>Added Date</th>
            </tr>";

    // Display each row of data
    while ($row = mysqli_fetch_assoc($resultAllData)) {
        echo "<tr>";
        echo "<td>" . $row['Donor_Name'] . "</td>";
        echo "<td>" . $row['Email'] . "</td>";
        echo "<td>" . $row['NGO_Name'] . "</td>";
        echo "<td>" . $row['Donation_Amount'] . "</td>";
        echo "<td>" . $row['Card_Number'] . "</td>";
        echo "<td>" . $row['Card_Expiry_Month'] . "</td>";
        echo "<td>" . $row['Card_Expiry_Year'] . "</td>";
        echo "<td>" . $row['Status'] . "</td>";
        echo "<td>" . $row['added_date'] . "</td>";
        echo "</tr>";
       
    }

    // Close the table
    echo "</table>";
} else {
    echo "Error fetching data from the 'donations' table: " . mysqli_error($con);
}

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


?>

