<!DOCTYPE html>
<?php

include "conection.php";


session_start();

require_once ('php/CreateDb.php');
require_once ('./php/component.php');


?>

<html lang="en">
  <head>
    <title>View Product Info</title>
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
<!--Nav-->
<?php require_once ("php/header.php"); ?>
	<!--Nav end-->


	<section class="ftco-section">
    <h2 class="mb-4">View Product Info</h2>

    <div class="container ">
        <div class="row"> 
        <?php
                #database connection, query
      global $con;
        if (isset($_GET['item_id'])){
            $items_ID = $_GET['item_id'];
            $get_items = "SELECT product_id, brand_name, description, weight_oz, grain_type, sale_price, quantity_stock, available, image_url  FROM product p, brand b, weight w, grain g
            WHERE (p.brand_id = b.brand_id) AND (p.weight_id = w.weight_id) AND (p.grain_id = g.grain_id) AND available = 1 AND product_id = '$items_ID'";
        
           
        $run_items = mysqli_query($con, $get_items);
    
        while($row_items=mysqli_fetch_array($run_items)){
    
   
            $item_description = $row_items['description'];


            $item_id = $row_items['product_id'];
            $item_name = $row_items['brand_name'];
            $item_price = $row_items['sale_price'];
            $item_pic = $row_items['image_url'];
            $item_remain = $row_items['quantity_stock'];
            $item_weight = $row_items['weight_oz'];
    if($item_remain < 1){
    echo "

	<div class='section'>
		<!-- container -->
		<div class='container'>
			<!-- row -->
			<div class='row'>
				<!--  Product Details -->
				<div class='product product-details clearfix'>
					<div class='col-md-6'>
						<div id='product-main-view'>
							<div class='product-view'>
								<img src='$item_pic' alt=''>
							</div>
						</div>
					</div>
					<div class='col-md-10'>
						<div class='product-body'>
							
							<h3 class='product-name'><a href='product-single.php?item_id=$item_id'>$item_name, $item_weight oz</a></h3>
							<h3 class='product-price'><p>Price: $$item_price<p></h3>
							
							<p><strong>$item_remain</strong> In Stock</p>
							<p><strong>Brand:</strong> $item_name</p>
							<p>$item_description</p>
							
							<div class='product-btns'>
								<div class='qty-input'>
								<div class='btn-group cart'>
						<form action='product-single.php?item_id=$item_id' method='post'>
                            <input type='hidden' name='cart_pid' id='cart_pid' value='$item_id'/>
                            <button type='button' class='btn btn-danger'><i class='fa fa-shopping-cart'></i> Out of Stock</button>
                        </form>
                        <button input type='hidden' type='button' >
                            <a href='shop.php'> Continue Shopping </a>
                        </button></td>
					</div>
						</div>
					</div>

				</div>
				<!-- /Product Details -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
    ";}
        else{
            echo "
	<div class='section'>
		<!-- container -->
		<div class='container'>
			<!-- row -->
			<div class='row'>
				<!--  Product Details -->
				<div class='product product-details clearfix'>
					<div class='col-md-6'>
						<div id='product-main-view'>
							<div class='product-view'>
								<img src='$item_pic' alt=''>
							</div>
						</div>
					</div>
					<div class='col-md-10'>
						<div class='product-body'>
							
							<h3 class='product-name'><a href='product-single.php?item_id=$item_id'>$item_name, $item_weight oz</a></h3>
							<h3 class='product-price'><p>Price: $$item_price<p></h3>
							
							<p><strong>$item_remain</strong> In Stock</p>
							<p><strong>Brand:</strong> $item_name</p>
							<p>$item_description</p>
							
							<div class='product-btns'>
								<div class='qty-input'>
								<div class='btn-group cart'>
                        <form action='cart.php' method='post'>
                        <div class=\"input-group \">
                        <span class=\"input-group-btn\">
                           <button type=\"button\" class=\"quantity-left-minus btn\"  data-type=\"minus\" data-field=\"\">
                          <i class=\"ion-ios-remove\"></i>
                           </button>
                           </span>
                        <input type=\"text\" id=\"quantity\" name=\"quantity\" class=\"form-control input-number\" value=\"1\" min=\"1\" max=\"100\">
                        <span class=\"input-group-btn\">
                           <button type=\"button\" class=\"quantity-right-plus btn\" data-type=\"plus\" data-field=\"\">
                            <i class=\"ion-ios-add\"></i>
                        </button>
                        </span>
                     
                            <input type='hidden' name='cart_pid' id='cart_pid' value='$item_id'/>
                                <button type='submit' ><strong> Add To Cart</button></strong>
                            </form>
                            <button type=' button' input type = 'hidden'>
                                <a href='shop.php'> Continue Shopping </a>
                                <button input type='hidden' type='button'>
                            </button></td>
					    </div>
						</div>
					</div>
                </div>
				</div>
				<!-- /Product Details -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
    ";}
        }    
        }
        
        
        
        
        
        ?>
                </div>
                </div>
                </div>
          </div>
         </div>
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
