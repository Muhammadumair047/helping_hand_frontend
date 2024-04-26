<?php

include '_connect.php';


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>body</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
     integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
     <link rel="stylesheet" href="style.css">

     <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
     

</head>
<body>
    <section>
    <div class="container-fluid con1-bg">
        <div class="row   align-items-center">
            <div class=" col-lg-6 col-md-6 col-sm-6 col-xs-6 banner">
                <div><h3>Give hope through our donation website</h3></div>
              <div> <p> “Join us in making a positive impact: Donate today!”
                 “Be a part of the change: Give generously!”</p> </div>
                 <button type="button" class="btn btn-danger"><a href="./Components/login.php">Donate Now</a></button>
            </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 d-flex justify-content-center">
                    <img class= "banner-img"  src="./images/donation-02.webp" alt="donation-2">    
        </div> 

    </div>
</div>

<section>
<div class="container-fluid  section2 ">
        <div id="NGOs" class="row text-center ">
            <div class="col-lg-12 col-md-6 col-sm-12 col-xs-12 ">
            <div ><h2 class="h3">
                Registered NGOs
            </h2></div> 
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
                                    <button class="btn btn-primary" ><a style="text-decoration:none" href="./Components/login.php? updateid='.$id.'" class="text-light">Donate Online</a></button>
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


</section>

<section>

<div class="container section2">
    <div class="row  ">
                <div class="col-lg-12 col-md-6 col-sm-12 col-xs-12">
                <div ><h2 class="h3">
                    Donors Reviews
                </h2></div> 
        <!-- Bootstrap Carousel -->
        <div id="userReviewsCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">

                <?php
              
                // Fetch user reviews from the database
                $query = "SELECT * FROM reviews";
                $result = mysqli_query($con, $query);

                // Check if there are reviews
                if (mysqli_num_rows($result) > 0) {
                    $firstItem = true;
                    while ($row = mysqli_fetch_assoc($result)) {
                        $userName = $row['name'];
                        $review = $row['review'];

                        // Display user reviews on the home page
                        echo "<div class='carousel-item" . ($firstItem ? " active" : "") . "'>
                                <p><strong>$userName</strong></p>
                                <p>$review</p>
                              </div>";

                        $firstItem = false;
                    }
                } else {
                    echo "<p>No reviews available.</p>";
                }

               
                ?>

            </div>

            <!-- Previous and Next buttons -->
            <button class="carousel-control-prev" type="button" data-bs-target="#userReviewsCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#userReviewsCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

</section>

    <section id="about">
    <div class="container-fluid  section2 ">
        <div  class="row text-center ">
            <div class="col-lg-12 col-md-6 col-sm-12 col-xs-12 ">
            <div ><h2 class="h3">
                About Helping Hand
            </h2></div> 
                <p class="text-center">
                    Helping Hand a Platform to Donate Money to NGOs for Welfare of Society
                </p>
            </div>
        </div>
        <div>
            <div class="container-fluid ">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 d-flex justify-content-center">
                        <img class= "banner-img"  src="./images/about-img.png" alt="donation-2">    
            </div> 
                    <div class=" col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div> <p class="text-left">The Helping Hand Donation Website is like a
                         friend that helps you do good things. By using the internet,
                          it brings together people who want to make the world better. 
                          So, if you're looking for a simple way to make a big impact,
                         Helping Hand is the place to be. Let's create abrighter future
                          together!cimus provident excepturi modi dicta.</p> </div>
                    </div>
            </div>
        </div>
        </div>
    </div>
    </section>

    <section id="services">
        
        <div class="container-fluid section2">
            <div class="row  ">
                <div class="col-lg-12 col-md-6 col-sm-12 col-xs-12">
                <div ><h2 class="h3">
                    Our Services
                </h2></div> 
                    <p class="text-center">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur, incidunt!
                    </p>
                </div>
            </div>
            <div>
                <div class="container">
                    <div class="row d-flex justify-content-center">
                        <div class="card m-3" style="width: 18rem;">
                            <img src="./images/Food_donation.jpg" class="card-img-top" alt="Food_donation">
                            <div class="card-body">
                            <h5 class="card-title">RAISE FUND FOR HEALTHY FOOD</h5>
                            </div>
                        </div>
                        

                        
                        <div class="card m-3" style="width: 18rem;">
                            <img src="./images/edu_poor.webp" class="card-img-top" alt="edu_poor">
                            <div class="card-body">
                            <h5 class="card-title">EDUCATION FOR POOR CHILDREN</h5>
                            </div>
                        </div>
                        
                            
                    
                                <div class="card m-3" style="width: 18rem;">
                                <img src="./images/Children_rights.jpg" class="card-img-top" alt="Children_rights ">
                                <div class="card-body">
                                    <h5 class="card-title">PROMOTING THE RIGHTS OF CHILDREN</h5>
                                </div>
                                </div>
                                
                                
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div class="card m-3" style="width: 18rem;">
                        <img src="./images/Oldage.png" class="card-img-top"height="210px" alt="Oldage_home">
                        <div class="card-body">
                            <h5 class="card-title">OLDAGES HOMES FOR OLD PEOPLES</h5>
                        </div>
                        </div>
                        

                    
                        <div class="card m-3" style="width: 18rem;">
                        <img src="./images/animal_shelter.jpg" class="card-img-top" alt="Animal_shelter">
                        <div class="card-body">
                            <h5 class="card-title">SHELTER HOME FOR ANIMALS</h5>
                        </div>
                        </div>
                        
                        
                
                            <div class="card m-3" style="width: 18rem;">
                                <img src="./images/home_poor.jpg" class="card-img-top" height="210px" alt="home_for_poor">
                                <div class="card-body">
                                <h5 class="card-title">BUILD HOME FOR POORS </h5>
                                </div>
                            </div>
                            
                            
                </div>
            </div>
            </div>
        </div>
    </section>


    



    <section>
        
        <div class="container-fluid section2">
            <div class="row  ">
                <div class="col-lg-12 col-md-6 col-sm-12 col-xs-12">
                <div ><h2 class="h3">
                    Our Team
                </h2></div> 
                    
                </div>
            </div>
            <div>
                <div class="container">
                    <div class="row d-flex justify-content-center">
                        <div class="card m-3" style="width: 18rem;">
                            <img src="./images/icon_img.jpg" class="card-img-top" alt="Muhammad Umair">
                            <div class="card-body">
                                <h5 class="card-title">Muhammad Umair</h5>
                            <p class="card-text">Project Manager</p>
                            </div>
                        </div>
                        

                        
                        <div class="card m-3" style="width: 18rem;">
                            <img src="./images/icon_img.jpg" class="card-img-top" alt="Muhammad Umair">
                            <div class="card-body">
                            <h5 class="card-title">Muhammad Umair</h5>
                            <p class="card-text">Social Media Manger</p>
                        </div>
                        </div>
                        
                            
                    
                                <div class="card m-3" style="width: 18rem;">
                                <img src="./images/icon_img.jpg" class="card-img-top" alt="Muhammad Umair ">
                                <div class="card-body">
                                    <h5 class="card-title">Muhammad Umair</h5>
                                    <p class="card-text">Finance Manger</p>
                                </div>
                                </div>
                                
                                
                    </div>
                
            </div>
            </div>
        </div>
    </section>



<section  id="contact" class="mb-3">
    <div class="container-fluid ">
        <div class="row">
            <div class="col-lg-12 col-md-6 col-sm-12 col-xs-12">
                <div>
                   
                </div>
            </div>
        </div>
        <div>
            <div class="container-fluid">
                <div class="row justify-content-center ">
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 ">
                <!-- Addresses -->
                <div class="section2"><h3 class="h3">Our Addresses</h3></div>
                <p class="pt-5">Main Office:<br>Virtual University of <a href="C:\xampp\htdocs\Helping-Hand\Components\login.php">Pakistan</a></p>
                <p >Branch Office:<br> H Block Johar Town</p>
                <p >Contact:<br>03054082881</p>
            </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
                    <div class="section2"><h2 class="h3 ">
                        Contact Us
                    </h2>
                    </div>
                        <!-- Contact Form -->
                        <form id="contactForm" action="" method="post" onsubmit="return validateForm()">
                            <div class="form-group">
                                <label for="name">Your Name:</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Your Email:</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="message">Message:</label>
                                <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>





    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  
        

</body>
</html>