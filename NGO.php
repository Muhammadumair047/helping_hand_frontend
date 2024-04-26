<?php
    include 'components/_connect.php';
   
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
      <link rel="stylesheet" type="" href="styles.css">
      <script src="script.js" defer></script>
</head>
<body>
    <div class="text-center" >
        <button class="btn btn-primary mt-3"><a class=" text-light" style="text-decoration:none" href="./Users/userDashboard.php">Return to Dashboard</a>
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
                        $shortDescription = substr($discreption, 0, 100); // Display the first 35 characters initially
                        echo '
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
                                    <button class="btn btn-primary" ><a style="text-decoration:none" href="./stripe/index.php? updateid='.$id.'" class="text-light">Donate Online</a></button>
                                <br>
                                    <button class="btn btn-link readMoreBtn" data-target="moreText'.$id.'" data-full-text="'.$discreption.'">Read more</button>
                                    </div>
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
