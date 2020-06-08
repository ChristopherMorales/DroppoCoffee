<!DOCTYPE html>
<?php
session_start();

include "conection.php";

?>
<html lang="en">
  <head>
    <title>Browse Products</title>
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
  <body>
<!--Nav-->
<?php require_once ("php/header.php"); ?>
	<!--Nav end-->
	
    <div class="hero-wrap hero-bread" style="background-image: url('https://www.incimages.com/uploaded_files/image/970x450/getty_938993594_401542.jpg');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.php"></a></span> <span></span></p>
            <h1 class="mb-0 bread">Browse Products</h1>
          </div>
        </div>
      </div>
    </div>


    <section class="ftco-section">
      <div class="row justify-content-center">
    		<div class="col-md-10 mb-5 text-center">
    			<ul class="product-category">
<!--               #Aqui es el search bar
 -->              <form action = "search.php" method = "POST">

                <input type="text" name = "search" placeholder="Search">
                <button type = "submit" name = "submit-search"> Search </button>

              </form>

                <li><a href="view_category.php?id=AllProducts" class="active">All Products </a></li>
                <li><a href="view_category.php?id=Crema" class="active">Crema </a></li>
                <li><a href="view_category.php?id=Lareno" class="active">Lareño </a></li>
                <li><a href="view_category.php?id=Oro" class="active">Oro </a></li>
                <li><a href="view_category.php? id=Yaucono" class="active">Yaucono </a></li>
    				</ul>
    			</div>
    		</div>
      
				<div id="main" class="col-md-9">
    
			
					<div class="store-filter clearfix">
						<div class="pull-left">
							<div class="row-filter">
								<a href="#"><i class="fa fa-th-large"></i></a>
								<a href="#" class="active"><i class="fa fa-bars"></i></a>
							</div>
			<form action="" method="post" name="sort">
                <select name="sortList" id="sortList" value = "highest">
                    <option value='highest'>Price: Highest First</option>
                    <option value='lowest'>Price: Lowest First</option> 
                    <option value='AtoZ'>Brand: A to Z</option> 
                    <option value='ZtoA'>Brand: Z to A</option> 

                </select>
                <input type="submit" value="sort" name ="sortBtn"/>
            </form> 
            
        
    	<div class="container">
    		<div class="row">
          <?php 
          
    //Sort Query
			if(isset($_POST['sortBtn']))
			{
        $selected = $_POST['sortList'];

				if ($selected == 'highest')
				{
          $get_items = "
          SELECT product_id, brand_name, description, weight_oz, grain_type, sale_price, quantity_stock, available, image_url  FROM product p, brand b, weight w, grain g
WHERE (p.brand_id = b.brand_id) AND (p.brand_id = b.brand_id) AND (p.weight_id = w.weight_id) AND (p.grain_id = g.grain_id) AND available = 1 AND image_url IS NOT NULL
ORDER BY `p`.`sale_price`  DESC";
				}
				else if ($selected == 'lowest')
				{
					$get_items = "
          SELECT product_id, brand_name, description, weight_oz, grain_type, sale_price, quantity_stock, available, image_url  FROM product p, brand b, weight w, grain g
WHERE (p.brand_id = b.brand_id) AND (p.brand_id = b.brand_id) AND (p.weight_id = w.weight_id) AND (p.grain_id = g.grain_id) AND available = 1 AND image_url IS NOT NULL
ORDER BY `p`.`sale_price` ASC";
        }
        else if($selected == 'AtoZ')
        {
          $get_items = "
          SELECT product_id, brand_name, description, weight_oz, grain_type, sale_price, quantity_stock, available, image_url  FROM product p, brand b, weight w, grain g
WHERE (p.brand_id = b.brand_id) AND (p.brand_id = b.brand_id) AND (p.weight_id = w.weight_id) AND (p.grain_id = g.grain_id) AND available = 1 AND image_url IS NOT NULL
ORDER BY b.brand_name ASC";
        }
        else if($selected == 'ZtoA')
        {
          $get_items = "
          SELECT product_id, brand_name, description, weight_oz, grain_type, sale_price, quantity_stock, available, image_url  FROM product p, brand b, weight w, grain g
WHERE (p.brand_id = b.brand_id) AND (p.brand_id = b.brand_id) AND (p.weight_id = w.weight_id) AND (p.grain_id = g.grain_id) AND available = 1 AND image_url IS NOT NULL
ORDER BY b.brand_name DESC";
        }
 
              $run_items = mysqli_query($con, $get_items);
				while($row_items=mysqli_fetch_array($run_items))
				{
    
          $item_id = $row_items['product_id'];
					$item_name = $row_items['brand_name'];
					$item_price = $row_items['sale_price'];
          $item_pic = $row_items['image_url'];
          $item_remain = $row_items['quantity_stock'];
          $item_weight = $row_items['weight_oz'];
          $item_description = $row_items['description'];

      if($item_remain < 1)
      {
      
					echo "
							<div class='col-md-4 col-sm-6 col-xs-6'>
										<div class='product product-single'>
											<div class='product-thumb'>
												
												
												<img width='50%' height='200px' src='$item_pic' alt=''>
											</div>
											<div class='product-body'>
												<h3 class='product-price'>Price: $$item_price</h3>
												<h3 class='product-name'><a href='product-single.php?item_id=$item_id'>$item_name, $item_weight oz</a></h3>
												<div class='product-btns'>
													<form action='product-single.php?item_id=$item_id' method='post'>
						<input type='hidden' name='cart_pid' id='cart_pid' value='$item_id'/>
						<button type='submit' class='btn btn-danger'><i class='fa fa-shopping-cart'></i> Out of Stock</button>
						</form>
												</div>
											</div>
										</div>
									</div>
							
						";}
					else {
            
            echo "
							<div class='col-md-4 col-sm-6 col-xs-6'>
										<div class='product product-single'>
											<div class='product-thumb'>
										
												
												<img width='50%' height='200px' src='$item_pic' alt=''>
											</div>
											<div class='product-body'>
												<h3 class='product-price'>Price: $$item_price</h3>
												<h3 class='product-name'><a href='product-single.php?item_id=$item_id'>$item_name, $item_weight oz</a></h3>
												<div class='product-btns'>
													<form action='cart.php' method='post'>
                            <input type='hidden' name='cart_pid' id='cart_pid' value='$item_id'/>
                            <button type='submit' class='btn btn-primary'><i class='fa fa-shopping-cart'></i> Add To Cart</button>
						            </form>
												</div>
											</div>
										</div>
									</div>
							
						";
						
					}
						
      }
    }
    else{

      $get_items = "
      SELECT product_id, brand_name, description, weight_oz, grain_type, sale_price, quantity_stock, available, image_url  FROM product p, brand b, weight w, grain g
WHERE (p.brand_id = b.brand_id) AND (p.brand_id = b.brand_id) AND (p.weight_id = w.weight_id) AND (p.grain_id = g.grain_id) AND available = 1 AND image_url IS NOT NULL";

      $run_items = mysqli_query($con, $get_items);
      while($row_items=mysqli_fetch_array($run_items))
      {
  
        $item_id = $row_items['product_id'];
					$item_name = $row_items['brand_name'];
					$item_price = $row_items['sale_price'];
          $item_pic = $row_items['image_url'];
          $item_remain = $row_items['quantity_stock'];
          $item_weight = $row_items['weight_oz'];


    if($item_remain < 1){
    
        echo "
            <div class='col-md-4 col-sm-6 col-xs-6'>
                  <div class='product product-single'>
                    <div class='product-thumb'>
                      
                      
                      <img width='50%' height='200px' src='$item_pic' alt=''>
                    </div>
                    <div class='product-body'>
                      <h3 class='product-price'>Price: $$item_price</h3>
                      <h2 class='product-name'><a href='product-single.php?item_id=$item_id'>$item_name, $item_weight oz</a></h2>
                      <div class='product-btns'>
                        <form action='product-single.php?item_id=$item_id' method='post'>
          <input type='hidden' name='cart_pid' id='cart_pid' value='$item_id'/>
          <button type='submit' class='btn btn-danger'><i class='fa fa-shopping-cart'></i> Out of Stock</button>
          </form>
                      </div>
                    </div>
                  </div>
                </div>
            
          ";}
        else {echo "
            <div class='col-md-4 col-sm-6 col-xs-6'>
                  <div class='product product-single'>
                    <div class='product-thumb'>
                  
                      
                      <img width='50%' height='200px' src='$item_pic' alt=''>
                    </div>
                    <div class='product-body'>
                      <h3 class='product-price'>Price: $$item_price</h3>
                      <h2 class='product-name'><a href='product-single.php?item_id=$item_id'>$item_name, $item_weight oz</a></h2>
                      <div class='product-btns'>
                        <form action='cart.php' method='post'>
          <input type='hidden' name='cart_pid' id='cart_pid' value='$item_id'/>
          <button type='submit' class='btn btn-primary'><i class='fa fa-shopping-cart'></i> Add To Cart</button>
          </form>
                      </div>
                    </div>
                  </div>
                </div>
            
          ";
          
        }
          
    }


    }
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