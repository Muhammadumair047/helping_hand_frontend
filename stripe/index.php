<?php
include "../Components/_connect.php";


if (isset($_GET['updateid'])) {
    $id = $_GET['updateid'];

    // Fetch the specific row based on the provided ID
    $sql = "SELECT * FROM `ngoreg` WHERE id = $id";
    $result = mysqli_query($con, $sql);

    if (!$result) {
        die(mysqli_error($con));
    }

    $row = mysqli_fetch_assoc($result);
    $name = $row['name'];}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donation Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
     crossorigin="anonymous">

    <link rel="stylesheet" href="../styles.css">
    <style>
        
    </style>
</head>
<body>

    <div class="container ">
        <h3 class="text-center">Make a Donation</h3>
        <form  role="form" action="stripe_payment.php" method="POST" name="cardpayment" id="payment-form">
            <label for="name">Donor Full Name:</label>
            <input  class="mb-0" type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input  class="mb-0" type="email" id="email" name="email" required>

            <label for="name">NGO Name</label>
            <input  class="mb-0" type="text" name="ngoname" placeholder="NGO Name" class="form-control "value="<?php echo $name; ?>">
       

            <label for="amount">Donation Amount (Rs):</label>
            <input  class="mb-0" type="number" id="amount" name="amount" min="1" required>

            <div class="row">
                                    <div class="col-xs-12">
                                        <div class="form-group">
                                            <label  class="mb-0" for="cardNumber">CARD NUMBER</label>
                                            <div class="input-group">

                                                <input  class="mb-0" type="text" class="form-control" name="card_number" placeholder="Valid Card Number" autocomplete="cc-number" id="card_number" maxlength="16" data-stripe="number" required />
                                                <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                                            </div>
                                        </div>                            
                                    </div>
                                </div>
                                <div    class="row">

                                    <div class="col-xs-4 col-md-4">
                                        <div class="form-group">
                                            <label class="mb-0" for="cardExpiry"><span class="visible-xs-inline">MON</span></label>
                                            <select name="card_exp_month" id="card_exp_month" class="form-control" data-stripe="exp_month" required>
                                                <option>MON</option>
                                                <option value="01">01 ( JAN )</option>
                                                <option value="02">02 ( FEB )</option>
                                                <option value="03">03 ( MAR )</option>
                                                <option value="04">04 ( APR )</option>
                                                <option value="05">05 ( MAY )</option>
                                                <option value="06">06 ( JUN )</option>
                                                <option value="07">07 ( JUL )</option>
                                                <option value="08">08 ( AUG )</option>
                                                <option value="09">09 ( SEP )</option>
                                                <option value="10">10 ( OCT )</option>
                                                <option value="11">11 ( NOV )</option>
                                                <option value="12">12 ( DEC )</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-xs-4 col-md-4">
                                        <div class="form-group">
                                            <label for="cardExpiry"><span class="visible-xs-inline">YEAR</span></label>
                                            <select name="card_exp_year" id="card_exp_year" class="form-control" data-stripe="exp_year">
                                                <option>Year</option>
                                                <option value="20">2020</option>
                                                <option value="21">2021</option>
                                                <option value="22">2022</option>
                                                <option value="23">2023</option>
                                                <option value="24">2024</option>
                                                <option value="25">2025</option>
                                                <option value="26">2026</option>
                                                <option value="27">2027</option>
                                                <option value="28">2028</option>
                                                <option value="29">2029</option>
                                                <option value="30">2030</option>
                                                <option value="31">2031</option>
                                                <option value="32">2032</option>
                                                <option value="33">2033</option>
                                                <option value="34">2034</option>
                                                <option value="35">2035</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-4 col-md-4 pull-right">
                                        <div class="form-group">
                                            <label for="cardCVC">CV CODE</label>
                                            <input type="password" class="form-control" name="card_cvc" placeholder="CVC" autocomplete="cc-csc" id="card_cvc" required />
                                        </div>
                                    </div>
                                </div>
                             


            </select>
            <input class="btn btn-success" id="payBtn" type="submit" value="Donate">
            <button class="btn btn-primary "><a class=" text-light" style="text-decoration:none" href="../Users/userDashboard.php">Return to Dashboard</a>
    </button>
        </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script src="https://js.stripe.com/v2/"></script>


    <script>
        // Set your publishable key
        Stripe.setPublishableKey('pk_test_51OKLIXEFMi0doFoUFFEh7UQ3aEIcz5ssfGadQ49QIzKHCDNXwTmL1O3khKb1zbEzn1sd2RnyIFfmnTzTUgQNUWiL00AK1I0eFO');

       
        // Callback to handle the response from stripe
        function stripeResponseHandler(status, response) {
            if (response.error) {
                // Enable the submit button
                $('#payBtn').removeAttr("disabled");
                // Display the errors on the form
                $(".payment-status").html('<p>'+response.error.message+'</p>');
            } else {
                var form$ = $("#payment-form");
                // Get token id
                var token = response.id;
                // Insert the token into the form
                form$.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
                // Submit form to the server
                form$.get(0).submit();
            }
        }

        $(document).ready(function() {
            // On form submit
            $("#payment-form").submit(function() {
                // Disable the submit button to prevent repeated clicks
                $('#payBtn').attr("disabled", "disabled");
                
                // Create single-use token to charge the user
                Stripe.createToken({
                    number: $('#card_number').val(),
                    exp_month: $('#card_exp_month').val(),
                    exp_year: $('#card_exp_year').val(),
                    cvc: $('#card_cvc').val()
                }, stripeResponseHandler);
                
                // Submit from callback
                return false;
            });
        });
</script>

</body>
</html>
