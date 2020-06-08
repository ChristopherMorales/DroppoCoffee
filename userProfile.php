<!DOCTYPE html>
<?php

include "conection.php";
require_once ('./php/component.php');
session_start();
error_reporting(E_ERROR | E_PARSE);

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
else{
        //query customer
       $customer = $_SESSION['customer_id'];//Save Customer ID
                                        //Query Search Customer
        $query_customer =  "SELECT *
                            FROM customer
                            WHERE customer_id = '$customer'";
        $r = mysqli_query($con,$query_customer);//Make the Query
        $row = mysqli_fetch_array($r);//Save Query Result
}
?>

<div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">


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
        
         <!-- USER DATA-->
         <div class="user-data m-b-30">
                    <h2 class="mb-4">View Order History</h2>

                                    <h5 class="title-3 m-b-30">Recent Orders</h5>
                                    <div class="table-data">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <td>Order ID</td>
                                                    <td>Track #</td>
                                                    <td>Status</td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                 <?php
                                                    //Query Search Order
                                                    $query_orders = "SELECT order_id, track_number, status_name
                                                                        FROM orders o, STATUS s
                                                                        WHERE o.status_id = s.status_id AND refund = 0 AND customer_id = $customer
                                                                        ORDER BY YEAR(order_date), MONTH(order_date), DAY(order_date) DESC
                                                                        LIMIT 5;";

                                                    if($r_orders = mysqli_query($con, $query_orders))//Save & Validate Query Results
                                                    {
                                                        while($row_orders=mysqli_fetch_array($r_orders))//Present Users
                                                        {
                                                            print "
                                                            <tr>
                                                                <td class='text-center'>$row_orders[order_id]</td>
                                                                <td class='text-center'>$row_orders[track_number]</td>
                                                                <td class='text-center'>$row_orders[status_name]</td>
                                                               
                                                                <td>
                                                                    <a href='./single_order_customer.php?order_id={$row_orders['order_id']}' class='btn btn-secondary btn-sm'>Details<a>
                                                                </td>
                                                                <td>
                                                                <form method = 'POST' action = ''>
                                                                <button type = 'submit' name = 'refund' class='btn btn-secondary btn-sm'>Refund</button>
                                                                 <input type ='hidden' name='order_id' value='".$row_orders[order_id]."'>
                                                                </form>
                                                            </td>
                                                            </tr> ";
                                     

                                                            }
                                                        }
                                                        if(isset($_POST['refund']))
                                                        {
                                                            $id= $_POST['order_id'];
                                                            $query_update = "UPDATE orders SET refund = 1 WHERE order_id = $id  ";

                                                            if(mysqli_query($con, $query_update))
                                                            {
                                                                echo "<script>alert('Your order is being refunded. The admin will be in touch with you for the next steps. Please refresh the page. ')</script>";

                                                            }
                                                    }
                                                    else
                                                        print'<p style="color:red">NO SE PUEDE MOSTRAR RECORD PORQUE:'.mysqli_error($con).'.</P>';
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- END USER DATA-->
                     
                            </div>
                            </div>
                            </div>
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