<?php
include '..\Components\_connect.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Review</title>
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
                        $name = mysqli_real_escape_string($con, $_POST['name']);
                        $review = mysqli_real_escape_string($con, $_POST['review']);

                        // Insert review into the database
                        $insert_query = "INSERT INTO `reviews` (name, review) VALUES ('$name', '$review')";
                        $insert_result = mysqli_query($con, $insert_query);

                        if ($insert_result) {
                            echo '<div class="alert alert-success" role="alert">Review added successfully!</div>';
                        } else {
                            echo '<div class="alert alert-danger" role="alert">Error: ' . mysqli_error($con) . '</div>';
                        }
                    }
                    ?>

                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="name" class="form-label">Your Name:</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="review" class="form-label">Your Review:</label>
                            <textarea name="review" class="form-control" rows="4" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit Review</button>
                        <button class="btn btn-primary "><a class=" text-light" style="text-decoration:none" href="userDashboard.php">Return to Dashboard</a>
    </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
crossorigin="anonymous"></script>
</body>
</html>
