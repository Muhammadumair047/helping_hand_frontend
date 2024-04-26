<?php
include '.\Components\_connect.php';
include '.\Components\_nav.php'
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NGOs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
     rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" 
    crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
     integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
     crossorigin="anonymous"></script>
     <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
     <script src="script.js" defer></script>

</head>
<body>
<div class="container-fluid">
<div class="col-12">
<div class="row">
<section>
  <div class="container-fluid">
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
        
       
    </section>
</div> 
    </div> 
<section>


<div class="container-fluid">
        <div class="row">
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
                            $shortDescription = substr($discreption, 0, 100); echo '
                        <div class="col-4">
                            <div class="card m-3">
                                <div class="card-body ">
                                    <h5 class="card-title"><b>'.$name.'</b></h5>
                                    <p class="card-text">'.$address.'</p>
                                    <p class="card-text">'.$category.'</p>
                                    <p class="card-text">'.$contact.'</p>
                                    <h5>Discreption</h5>
                                    <p class="card-text more-text" id="moreText'.$id.'">'.$shortDescription.'</p>
                                <div class="text-center">
                                    <button class="btn btn-primary" ><a style="text-decoration:none" href="./Components/login.php? updateid='.$id.'" class="text-light">Donate Online</a></button>
                                <br>
                                    <button class="btn btn-link readMoreBtn" data-target="moreText'.$id.'" data-full-text="'.$discreption.'">Read more</button>
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
    </div>
</section>

</body>
</html>
