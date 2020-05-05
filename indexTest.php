<!DOCTYPE html>
<?php


include "conection.php";

session_start();
require_once ('./php/component.php');

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
  </head>
  <body class="goto-here">

<!--Nav-->
	<?php require_once ("php/header.php"); ?>
	<!--Nav end-->
	
    <section class="ftco-section">
    	<div class="container">
				<div class="row justify-content-center mb-3 pb-3">
          <div class="col-md-12 heading-section text-center ftco-animate">
          	<span class="subheading">Welcome!</span>
            <h2 class="mb-4">Our Products</h2>
            <p>Our current selection</p>
          </div>
        </div>   		
		</div>
		
    	<div class="container">
    		<div class="row">
        <?php

          //Query Products
           $query = "SELECT product_id, brand_name, description, weight_oz, grain_type, sale_price, quantity_stock, avaible, image_url
            FROM product p, brand b, weight w, grain g
            WHERE (p.brand_id = b.brand_id) AND (p.weight_id = w.weight_id) AND (p.grain_id = g.grain_id) AND avaible = 1
            ORDER BY brand_name";


                                            
            if($r = mysqli_query($con, $query))//Save & Validate Query Result
            {
                    $x=1;
                  while($row=mysqli_fetch_array($r) AND $x<=4)//Present Products
                  {
                    $item_id = $row['product_id'];
                    $item_name = $row['brand_name'];
                    $item_price = $row['sale_price'];
                    $item_pic = $row['image_url'];
                    $item_remain = $row['quantity_stock'];
                    $item_description = $row['description'];

                  print "
                  <div class='col-md-4 col-sm-6 col-xs-6'>
										<div class='product product-single'>
											<div class='product-thumb'>
										
												
												<img width='50%' height='200px' src='$item_pic' alt=''>
											</div>
											<div class='product-body'>
												<h3 class='product-price'>Price: $$item_price</h3>
												<h3 class='product-name'><a href='product-single.php?item_id=$item_id'>$item_name</a></h3>
												<div>
												  <button><a href='product-single.php?item_id=$item_id'> View Product </a></button>
												</div>
											</div>
										</div>
									</div>
							
						";
                $x++;
                  }
              }
               else
               print'<p style="color:red">NO SE PUEDE MOSTRAR RECORD PORQUE:'.mysqli_error($con).'.</P>';
              mysqli_close($con);
          ?>
		

    		</div>
		</div>
    </section>
    
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