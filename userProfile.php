<!DOCTYPE html>
<?php

include "conection.php";
require_once ('./php/component.php');
session_start();

if (isset($_POST['add'])){
    if(isset($_SESSION['cart'])){

        $item_array_id = array_column($_SESSION['cart'], "product_id");

        if(in_array($_POST['product_id'], $item_array_id)){
            echo "<script>alert('Product is already added in the cart..!')</script>";
            echo "<script>window.location = 'index.php'</script>";
        }else{

            $count = count($_SESSION['cart']);
            $item_array = array(
                'product_id' => $_POST['product_id']
            );

            $_SESSION['cart'][$count] = $item_array;
        }

    }else{

        $item_array = array(
                'product_id' => $_POST['product_id']
        );

        // Create new session variable
        $_SESSION['cart'][0] = $item_array;
        print_r($_SESSION['cart']);
    }
}
?>

<html lang="en">
  <head>
    <title>Coffee Shop</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/ionicons.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">

    
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/profile.style.css">
  </head>
  <body class="goto-here">

<!--Nav-->
	<?php require_once ("php/header.php"); ?>
	<!--Nav end-->
<?php

if(!isset($_SESSION['customer_id'])){
    echo "<script>alert('You must log-in to see Profile!')</script>";
    echo "<script>window.open('./Login_v14/index.php','_self')</script>";
}

        //query customer
       $customer = $_SESSION['customer_id'];//Save Customer ID
                                        //Query Search Customer
        $query_customer =  "SELECT *
                            FROM customer
                            WHERE customer_id = '$customer'";
        $r = mysqli_query($con,$query_customer);//Make the Query
        $row = mysqli_fetch_array($r);//Save Query Result
?>

		<div class="profile-card">
			<div class="image-container">
				<div class="title">
					<h2><?php echo $row['name'];echo (" "); echo $row['lastname']; ?></h2>
				</div>
            </div>
            <?php
            //Query Address
            $query_address = "SELECT *
                         FROM shipping_address
                         WHERE customer_id = '$customer'";
            $r2 = mysqli_query($con,$query_address);//Make the Query
            $row2 = mysqli_fetch_array($r2);//Save Query Result
            ?>
			<div class="main-container">
                <p>ID: <?php echo $_SESSION['customer_id'];?></p>
                <p>Street1: <?php echo $row2['street1'];?></p>
                <p>Street2: <?php echo $row2['street2'];?></p>
                <p>City: <?php echo $row2['city'];?></p>
                <p>State: <?php echo $row2['state'];?></p>
                <p>Zip: <?php echo $row2['zip'];?></p>
                <p>Country: <?php echo $row2['country'];?></p>
				<p>Email: <?php echo $row['email']; ?></p>
				
			</div>
            <form method = "post" action='editProfile.php'>
            <button type="submit" name="customer_id" value= $custumer_id >Edit Profile</button>
            </form>
		</div>
	

    
  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/bootstrap-datepicker.js"></script>
  <script src="js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="js/google-map.js"></script>
  <script src="js/main.js"></script>
    
  </body>
</html>