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
    <title>Registered NGOs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
     crossorigin="anonymous">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
      crossorigin="anonymous"></script>
      <link rel="stylesheet" type="" href="../styles.css">
      <script src="../script.js" defer></script>
</head>
<body>
  <div class="text-center">
    <button class="btn btn-primary  m-1" type="button">
    <a style="text-decoration:none" class="text-white" href="admin.php"> Return Dashboard</a>
    </button>
</div>
    <div class="container-fluid">
        <div class="row">
            <?php
                $sql = "SELECT * FROM `ngoreg`";
                $result = mysqli_query($con, $sql);
                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row['id'];
                        $name = $row['name'];
                        $contact = $row['contact'];
                        $address = $row['address'];
                        $category = $row['category'];
                        $discreption = $row['Discreption'];
                        $shortDescription = substr($discreption, 0, 100); // Display the first 100 characters initially
                        echo '
                        <div class="col-6">
                            <div class="card w-100 mt-3 mb-3">
                                <div class="card-body  ">
                                    <h5 class="card-title"><b>'.$name.'</b></h5>
                                    <p class="card-text">'.$address.'</p>
                                    <p class="card-text">'.$category.'</p>
                                    <p class="card-text">'.$contact.'</p>
                                    <h5>Discreption</h5>
                                    <p class="card-text more-text" id="moreText'.$id.'">'.$shortDescription.'</p>
                                    <button class="btn btn-link readMoreBtn" data-target="moreText'.$id.'" data-full-text="'.$discreption.'">Read more</button>
                                    </div>
                                   <div class="text-center mb-2 "> <button class="btn btn-primary" ><a style="text-decoration:none" href="update.php? updateid='.$id.'" class="text-light">Update</a></button>
                                     
                                    <button class="btn btn-danger"><a style="text-decoration:none" href="delete.php? deleteid='.$id.'" class="text-light">Delete</a></button>
                                  </div>
                            </div>
                        </div>';
                    }
                }
            ?>
        </div>
              </div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.7.2/dist/js/bootstrap.min.js"></script>


    

</body>
</html>
