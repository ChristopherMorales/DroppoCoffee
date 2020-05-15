<!DOCTYPE html>
<?php

include "conection.php";
session_start();

?>

<html lang="en">
  <head>
    <title>Cart</title>
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
  <body class="bg-light">

<?php
    require_once ('php/header.php');
?>

<div class="container-fluid">
    <div class="row px-5">
        <div class="col-md-7">
            <div class="shopping-cart">

<form action="checkout.php" method="post" class="clearfix">

                <?php
					if(!isset($_SESSION['customer_id'])){
						echo "<script>alert('You must log-in to checkout!')</script>";
						echo "<script>window.open('./Login_v14/index.php','_self')</script>";
					}
					?>

             

            <div class="col-md-12">
						<div class="order-summary clearfix">
							<div class="section-title">
								<h3 class="title">Order Review</h3>
							</div><div id="content_area">
			<div id="products_box">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 col-md-10 col-md-offset-1">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Quantity</th>
                                            <th></th>
                                            <th class="text-center">Price</th>
                                            <th class="text-center">Tax</th>
                                            <th class="text-center">Total</th>
                                            <th> </th>
                                            <th> </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                

                <?php
                /////////////////////////
                // ADDING ITEM TO CART//
                ///////////////////////
                if(isset($_POST['cart_pid'])){
                    echo "Entre al cart_pid";
                    $item_id = $_POST['cart_pid'];
                    $wasFound = False;
                    $i = 0;
                    // if there is no cart session or if the cart is empty 
                    if(!isset($_SESSION["cart_array"]) || count($_SESSION["cart_array"]) < 1) 
                    {
                        $_SESSION["cart_array"] = array(0 => array("item_id" => $item_id,"quantity" => 1 ));
                    }
                    else{
                        // if the cart is not empty
                        foreach ($_SESSION["cart_array"] as $each_item) {
                            $i++;
                            while (list($key, $value) = each($each_item)){
                                if ($key == "item_id" && $value == $item_id){
                                    // Item is in cart so update the quantity
                                    array_splice($_SESSION["cart_array"], $i-1, 1, array(array("item_id" => $item_id, "quantity" => $each_item["quantity"] + 1)));
                                    $wasFound = true;
                                }
                            }
                        }
                        if ($wasFound == false){
                            array_push($_SESSION["cart_array"], array("item_id" => $item_id, "quantity" => 1));
                        }
                        }
                     echo "<script> location.replace('cartPrueba.php'); </script> ";
            }
                ?>

            
            <?php
            
            // EMPTY THE SHOPPING CART //
            if(isset($_GET['cmd']) && $_GET['cmd'] == "emptycart"){
                unset($_SESSION["cart_array"]);
            }
            ?>

        <?php
         
         // REMOVE ITEM FROM CART //

         if (isset($_POST['remove_item'])) {
             $id_to_remove = $_POST['remove_item'];
             if (count($_SESSION["cart_array"]) <= 0) {
                 unset($_SESSION["cart_array"]);
             }
             else{
                 unset($_SESSION['cart_array']["$id_to_remove"]);
                 sort($_SESSION['cart_array']);
             }

         }
         
         ?>





<?php
             $tax = 0;
             $total_tax = 0;
             $cart_total = 0;
             $final_price = 0;
                
                // SHOPPING CART OUTPUT //

                if(!isset($_SESSION["cart_array"]) || count($_SESSION["cart_array"]) < 1) {
                    echo "Your shopping cart is empty.";
                }
                else {               

                    $cart_total = 0;
                    $i = 0;
                    foreach ($_SESSION["cart_array"] as $each_item) 
                    {
                        $item_id = $each_item["item_id"];
                        $get_item = "
                            SELECT product_id, brand_name, description, weight_oz, grain_type, sale_price, quantity_stock, available, image_url  
                            FROM product p NATURAL JOIN brand b NATURAL JOIN weight w NATURAL JOIN grain g 
                            WHERE product_id ='$item_id' AND (p.brand_id = b.brand_id) AND (p.weight_id = w.weight_id) AND (p.grain_id = g.grain_id) AND available = 1 AND image_url IS NOT NULL";
                        $run_item = mysqli_query($con,$get_item);

                        while($row_item=mysqli_fetch_array($run_item)){
                            $item_name = $row_item['brand_name'];
                            $item_pic = $row_item['image_url'];
                            $item_price = $row_item['sale_price'];
                            $remaining = $row_item['quantity_stock'];

                        }
                        $total_price = $item_price * $each_item['quantity'];
                        $cart_total = $total_price + $cart_total;
                        $qty_item = $each_item['quantity'];

                        //Calcula tax in Order Review Table
                        $tax = $total_price * 0.115;
                        $tax = round($tax,2);
                        $total_tax += $tax;



                /*         $value = isset($_POST['item']) ? $_POST['item'] : 1; //to be displayed
                        if(isset($_POST['incqty']))
                        {
                        $qty_item += 1;
                        }

                        if(isset($_POST['decqty']))
                        {
                        $qty_item -= 1;                                            
                        } */


                        
                    echo "<tr>
                    <td class='col-sm-8 col-md-6'>
                    <div class='media'>
                        <a class='thumbnail pull-left' href='shopProbar.php?item_id=$item_id'> <img class='media-object' src='$item_pic' style='width: 72px; height: 72px;'> </a>
                        <div class='media-body'>
                            <h4 class='media-heading'><a href='product-single.php?item_id=$item_id'>$item_name</a></h4>
                            <span>Items remaining: </span><span class='text-success'><strong>$remaining</strong></span>
                        </div>
                    </div></td>
                    <td class='col-sm-1 col-md-1' style='text-align: center'>
                        <input type='text' class='form-control' id='qty' value='$qty_item'>
                    </form>
  
                    </td>
                    <td></td>
                    <td class='col-sm-1 col-md-1 text-center'><strong>$$item_price</strong></td>
                    <td class='col-sm-1 col-md-1 text-center'><strong>$ $tax </strong></td>
                    <td class='col-sm-1 col-md-1 text-center'><strong>$$total_price</strong></td>
                    <td class='col-sm-1 col-md-1'>

                
                    <form action='cartPrueba.php' method='post'>

                        <input type='hidden' name='remove_item' id='remove_item' value='$i'/>
                        <input name='deleteBtn' . $item_id . '' type='submit' value='X' />

                    </form></td>

                    </tr>
                    <tr>
                    <tr>
                                
                    </tr>
                                   
                    ";
                    $i++;
    
                    }
                    
                }
                ?>
             </tbody>

             <tr>
                                        <td>   </td>
                                        <td>   </td>
                                        <td>   </td>

                                        
                                        <?php 
                                        
                                        $final_price = $cart_total + $total_tax;

                                        $total = round($final_price,2);

                                        echo"<td><h3>Total</h3></td>
                                        <td class='text-right'><h3><strong> $$total </strong></h3></td>"?>

                                        <td>
                                        <button type="button" class="btn btn-danger">
                                        <a style="text-decoration:none;color:white;" href="cartPrueba.php?cmd=emptycart">
                                             Empty Cart</a>
                                        </button></td>
                                        <td>
                                        <button type="button" class="btn btn-info">
                                        <a style="text-decoration:none;color:white;" href="shopProbar.php">
                                            Continue Shopping </a>
                                        </button></td>
                                        <td>
                                            <div span 4><center><button type="submit" class="registerbtn" name="Checkout" value="Checkout">Checkout</button></center></div></td>
                                           
            </div>
         

        </div>

    </div>
</div>


    <div class="card">
        <div class="card-header">
            <strong>Checkout</strong>
            <small> Form</small>
        </div>
        <div class="card-body card-block">
            <div class="form-group">
                <label for="street" class=" form-control-label">Street</label>
                <input type="text" id="adr" name="streetname" value="" required><br>
            </div>
            <div class="form-group">
                <label for="apartment" class=" form-control-label">Apt Number</label>
                <input type="text" id="adr" name="apt" value="" required><br>
            </div>
            <div class="form-group">
                <label for="city" class=" form-control-label">City</label>
                <input type="text" id="city" name="city" value="" required> <br>
            </div>
            <div class="row form-group">
                <div class="col-8">
                    <div class="form-group">
                        <label for="state" class=" form-control-label">State</label>
                        <input type="text" id="state" name="state" value="" required><br>
                    </div>
                </div>
                <div class="col-8">
                    <div class="form-group">
                        <label for="zip-code" class=" form-control-label">Zip Code</label>
                        <input type="text" id="zip" name="zip" value="" required><br>
                    </div>
                </div>
            </div>
            <div class="form-group">
            
            <label>Payment Type</label><select name="payment_type" id="payment_type" required>
                <option value="" selected="selected">Select a Payment type: </option>
                <option value="Paypal">Paypal</option>
                <option value="CC">Credit Card</option>


            </div>
        </div>
    </div>



</form>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>