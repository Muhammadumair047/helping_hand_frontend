<?php

include '../Components/_connect.php';
include '../Components/session.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ./Components/login.php");
    exit();
}

// Retrieve user ID from the URL
$user_id = $_GET['id'] ?? null;

// Validate and sanitize the user ID to prevent any potential security issues
$user_id = intval($user_id);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" 
    crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../styles.css">
    <script src="script.js" defer></script>
</head>
<body>
  
  
    <div class="container-fluid">
      
    <div class="row">
      <div class="col-3 sidebar">
      <div class="side-content p-3">
       
        <h6>Helping Hand</h6>
<hr class="line" style=" border:2px solid">
      <dl >
      <dd class="side-links text-center "> <a href="../index.php">Home</a></dd>   
        <dd class="side-links text-center "> <a href="../NGO.php">View NGO</a></dd>
         <dd class="side-links text-center"><a href="addreview.php">Add Review</a></dd>
          <dd class="side-links text-center"><a href="../Components/logout.php">Logout</a></dd>
          
</dl>
    </div> 
    </div>
  
    
    <div class="col-9">
<div class="row">
<section>
  <div class="container-fluid">
    <div class="text-center text-primary mt-2">
        <h2><i>Welcome to Helping Hand   </i> </h2> 
        <h3 >Donate to Serve Humanity</h3>
    </div>
    <form action="" method="post">
        <div class="row d-flex justify-content-center mt-4">
            <div class="col-6">
                <div class="form-group">
                    <input type="text" name="search" class="form-control" placeholder="Search" required>
                </div>
                <div class="form-group">
                    <label>Search By:</label>
                    <select name="search_by" class="form-control">
                        <option value="name">Name</option>
                        <option value="address">Location</option>
                        <option value="category">Category</option>
                    </select>
                </div>
                <div class="row d-flex justify-content-center">
                    <div class="col-2">
                        <br>
                        <button type="submit" name="search_btn" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </div>
        </div>  
        </form>
        
        <div class="table-responsive">
        <?php
        if (isset($_POST['search_btn'])) {
            $search_data = $_POST['search'];
            $search_by = $_POST['search_by'];

            // Validate and sanitize input to prevent SQL injection
            $search_data = mysqli_real_escape_string($con, $search_data);

            $query = "SELECT * FROM ngoreg WHERE `$search_by` LIKE '%$search_data%'";
            $query_run = mysqli_query($con, $query);

            if (mysqli_num_rows($query_run) > 0) {
                while ($row = mysqli_fetch_assoc($query_run)) {
                    $id = $row['id'];
                    $name = $row['name'];
                    $contact = $row['contact'];
                    $address = $row['address'];
                    $category = $row['category'];
                    $discreption = $row['Discreption'];
                    $shortDescription = substr($discreption, 0, 100);

                    echo '
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col">
                                <div class="card m-3">
                                    <div class="card-body">
                                        <h5 class="card-title"><b>' . $name . '</b></h5>
                                        <p class="card-text">' . $address . '</p>
                                        <p class="card-text">' . $category . '</p>
                                        <p class="card-text">' . $contact . '</p>
                                        <h5>Description</h5>
                                        <p class="card-text more-text" id="moreText' . $id . '">' . $shortDescription . '</p>
                                       
                                       <div class="text-center">
                                         <button class="btn btn-primary" ><a style="text-decoration:none" href="../stripe/index.php? updateid='.$id.'" class="text-light">Donate Online</a></button>
                                        <br>
                                        
                                        <button class="btn btn-link readMoreBtn" data-target="moreText' . $id . '" data-full-text="' . $discreption . '">Read more</button>
                                        
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>';
                }
            } else {
                echo "<b>Data Not found</b>";
            }
        }
        ?>
    </div>
    </section>
</div> 
 
  
  

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.7.2/dist/js/bootstrap.min.js"></script>

</body>
</html>