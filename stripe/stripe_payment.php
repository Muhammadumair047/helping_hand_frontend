<?php 
	include "../Components/_connect.php";


	$payment_id = $statusMsg = ''; 
	$ordStatus = 'error';
	$id = '';

	// Check whether stripe token is not empty

	if(!empty($_POST['stripeToken'])){

		// Get Token, Card and User Info from Form
		$token = $_POST['stripeToken'];
		$name = $_POST['name'];
		$email = $_POST['email'];
		$ngoname = $_POST['ngoname'];
		$price = $_POST['amount'];
		$card_no = $_POST['card_number'];
		$card_cvc = $_POST['card_cvc'];
		$card_exp_month = $_POST['card_exp_month'];
		$card_exp_year = $_POST['card_exp_year'];
		

		
		// Include STRIPE PHP Library
		require_once('stripe-php/init.php');

		// set API Key
		$stripe = array(
		"SecretKey"=>"sk_test_51OKLIXEFMi0doFoUoVqY9iazaKGhfz461QE4kfqZlw3yJAyx5swhtZfFaLCmTuL8AmFO73myvsZbtABd6zeo0DTC00ayXkKOYZ",
		"PublishableKey"=>"pk_test_51OKLIXEFMi0doFoUFFEh7UQ3aEIcz5ssfGadQ49QIzKHCDNXwTmL1O3khKb1zbEzn1sd2RnyIFfmnTzTUgQNUWiL00AK1I0eFO"
		);

		
		\Stripe\Stripe::setApiKey($stripe['SecretKey']);

		// Add customer to stripe 
	    $customer = \Stripe\Customer::create(array( 
	        'email' => $email, 
	        'source'  => $token,
	        'name' => $name,
	        'description'=>$ngoname
	    ));

	    // Generate Unique order ID 
	    $orderID = strtoupper(str_replace('.','',uniqid('', true)));
	     
	    // Convert price to cents 
	    $itemPrice = ($price*100);
	    $currency = "usd";
	    
	    // Charge a credit or a debit card 
	    $charge = \Stripe\Charge::create(array( 
	        'customer' => $customer->id, 
	        'amount'   => $itemPrice, 
	        'currency' => $currency, 
	        'description' => $ngoname, 
	        'metadata' => array( 
	            'order_id' => $orderID 
	        ) 
	    ));

	    // Retrieve charge details 
    	$chargeJson = $charge->jsonSerialize();

    	// Check whether the charge is successful 
    	if($chargeJson['amount_refunded'] == 0 && empty($chargeJson['failure_code']) && $chargeJson['paid'] == 1 && $chargeJson['captured'] == 1){ 

	        // Order details 
	        $transactionID = $chargeJson['balance_transaction']; 
	        $paidAmount = $chargeJson['amount']; 
	        $paidCurrency = $chargeJson['currency']; 
	        $payment_status = $chargeJson['status'];
	        $payment_date = date("Y-m-d H:i:s");
	        $dt_tm = date('Y-m-d H:i:s');

	        // Insert tansaction data into the database 

			$sql = "INSERT INTO `donations`(`Donor_Name`,`Email`,`NGO_Name`,`Donation_Amount`,`Card_Number`,`Card_Expiry_Month`,`Card_Expiry_Year`,`Status`,`Transaction_Id`,`added_date`) 
			VALUES ('".$name."','".$email."','".$ngoname."','".$price."','".$card_no."','".$card_exp_month."','".$card_exp_year."','".$payment_status."','".$transactionID."','".$dt_tm."')";
			 mysqli_query($con,$sql) or die("Mysql Error Stripe-Charge(SQL)".mysqli_error($con));

    	

	        // If the order is successful 
	        if($payment_status == 'succeeded'){ 
	            $ordStatus = 'success'; 
	            $statusMsg = 'Your Payment has been Successful!'; 
	    	} else{ 
	            $statusMsg = "Your Payment has Failed!"; 
	        } 
	    } else{ 
	      
	        $statusMsg = "Transaction has been failed!"; 
	    } 
	} else{ 
	    $statusMsg = "Error on form submission."; 
	} 
	
?>

<!DOCTYPE html>
<html>
	<head>
        <title> Stripe Payment Gateway Integration in PHP </title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="css/stripe.css">
		<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.3"></script>
    </head>
<body>
    <div class="container">
        <h2 style="text-align: center; color: blue;">Stripe Payment Gateway </h2>
        <h4 style="text-align: center;">This is - Stripe Payment Success URL </h4>
        <br>
        <div class="row">
	        <div class="col-lg-12">
				<div class="status">
					<h1 class="<?php echo $ordStatus; ?>"><?php echo $statusMsg; ?></h1>
				
					<h4 class="heading">Payment Information - </h4>
					<br>
					<p><b>Transaction ID:</b> <?php echo $transactionID; ?></p>
					<p><b>Paid Amount:</b> <?php echo $paidAmount.' '.$paidCurrency; ?> ($<?php echo $price;?>.00)</p>
					<p><b>Payment Status:</b> <?php echo $payment_status; ?></p>
					<h4 class="heading">Donation Info - </h4>
					<br>
					<p><b>NGO Name:</b> <?php echo $ngoname; ?></p>
					<p><b>Dontaion:</b> <?php echo $price.' '.$currency; ?> ($<?php echo $price;?>.00)</p>
				</div>
				
			</div>
			<div>
            <button class="btn btn-primary "><a class=" text-light" style="text-decoration:none"
			 href="../Users/userDashboard.php">User Dashboard</a> </button>
				<button class="btn btn-success" onclick="shareOnFacebook()">Share on Facebook</button>
</div>
		</div>
	</div>
	<script>
    // Function to open the Facebook sharing dialog
    function shareOnFacebook() {
        FB.ui({
            method: 'share',
            href: 'http://localhost/helping-hand/', // Replace with the URL you want to share
        }, function(response){});
    }
</script>


</body>
	</html>