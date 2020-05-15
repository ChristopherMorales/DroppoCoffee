<?php
include 'conection.php';
session_start();
 



//////////////////////////////
///// CART SESSION INFO /////
////////////////////////////
$total_items = 0;
$cart_items = 0;
foreach ($_SESSION["cart_array"] as $each_item)
{
	$cart_items = $each_item['quantity'];
	$total_items = $total_items + $cart_items;
}
$cart_qty = $total_items;



///////////////////////////////
// VERIFY PURCHASE QUANTITY //
/////////////////////////////
$DoNotProcess = true;
foreach ($_SESSION["cart_array"] as $each_item)
{
	$error_output = "";
	$cart_items = $each_item['quantity'];
	$item_id = $each_item["item_id"];

	$get_qty = "select brand_name,quantity_stock from product NATURAL JOIN brand where product_id='$item_id'";
    $run_qty = mysqli_query($con,$get_qty);
	$row_qty = mysqli_fetch_array($run_qty);
	
	$item_table_qty = $row_qty["quantity_stock"];
	$item_name = $row_qty["brand_name"];

	 if (($cart_items > $item_table_qty) and $item_table_qty > 0 AND $DoNotProcess == true){
		echo "<script>alert('The amount of coffee in the order is not available. Please adjust the quantity of $item_name, which has $item_table_qty coffee left')</script>";
		echo "<script>window.open('shopProbar.php','_self')</script>";
    }
    else if($cart_qty == 0)
    {
        echo "<script>alert('Cart is Empty, please take a look to our products! )</script>";
		echo "<script>window.open('shopProbar.php','_self')</script>";
    }
    else
    {
        $DoNotProcess = false;
    }

}


//////////////////////////////
/// CUSTOMER SESSION INFO ///
////////////////////////////

 $user = $_SESSION['customer_id'];

$get_cust = "SELECT customer_id,name,lastname,email, address_id, city, country, state, street1, street2, zip, payment_id 
FROM customer NATURAL JOIN shipping_address NATURAL JOIN payment_method
WHERE customer_id = '$user'";

$run_cust = mysqli_query($con,$get_cust);

$row_cust = mysqli_fetch_array($run_cust);

$cust_id = $row_cust['customer_id'];

$cust_first = $row_cust['name'];
$cust_last = $row_cust['lastname'];
$cust_email = $row_cust['email'];
$cust_paymentID = $row_cust['payment_id'];
$cust_addressID = $row_cust['address_id'];

 




//echo "Cart Total Item: $cart_qty";
                


///////////////////////////
////Order Information/////
/////////////////////////

$cart_total = 0;
$qty_total = 0;
$order_num = rand(11111111,9999999);

$track_num =  rand(1111111111,getrandmax());
date_default_timezone_set('Atlantic/Bermuda');
$my_date = date("Y-m-d H:i:s");

//echo "$my_date\n"; 

/*  $payment_type = $_POST['payment_type'];
$paypal_mail = $_POST['email'];
$cc_number = $_POST['cc_num'];
$cvv = $_POST['Cvv'];
$cust_street = $_POST['streetname'];
$cust_apt = $_POST['apt'];
$cust_city =  $_POST['city'];
$cust_state = $_POST['state'];
$cust_zip = $_POST['zip'];  */



 $x = 0; 
    if($DoNotProcess == false)
    {
        foreach($_SESSION["cart_array"] as $each_item){
            $x++;
            print_r($each_item);
           // echo 'La cantidad en el cart_array"  .$_SESSION["cart_array"].';
            $item_id = $each_item["item_id"];
        
            echo "Item ID: $item_id";
            $get_item = "select quantity_stock,sale_price, purchase_price from product where product_id='$item_id'";
            $run_item = mysqli_query($con,$get_item);
            
        
            while($row_item=mysqli_fetch_array($run_item))
            {
                $item_price = $row_item['sale_price'];
                $item_purchasePrice = $row_item['purchase_price'];
            }
            
            
            
            $total_price = $item_price * $each_item['quantity'];
            //$cart_total = $total_price + $cart_total;
            $qty_item = $each_item['quantity'];
            $qty_total += $qty_item;
        
         
            //Arreglar este query, el orden de las cosas
             $insert_order = "insert into orders (order_id,customer_id,track_number,status_id,order_date,shipping_address, 
                                                   payment_method, tax, total_items, items, total_sale, total_cost, refund ) 
                                    values('$order_num','$cust_id','$track_num', '1', '$my_date', '$cust_addressID', '$cust_paymentID', '1.50', '$qty_item', '0', '$total_price', '$item_purchasePrice', '0' )";
        
            $run_insert_orders = mysqli_query ($con, $insert_order);
        
            //Query Insertar en la tabla contain
            $insert_contain = " insert into contain (order_id, product_id, quantity, price, cost, customer_id, track_number) values( '$order_num','$item_id' ,'$qty_item' ,'$total_price' ,'$item_purchasePrice', '$cust_id','$track_num' )";
            $run_insert = mysqli_query ($con, $insert_contain);
                        
            if($run_insert_orders)
            {               
                echo "Cart Total Item: $cart_qty";
                            // echo "<script>alert('Cart Total Item: $cart_qty!')</script>";
                            // echo 'La cantidad en el cart_array"  .$_SESSION["cart_array"].';
                             echo "<script>alert('Entre al foreach: $x veces!')</script>";
        
                            //echo "<script>alert('Your order has been successfully made, Thanks!')</script>";
                            echo "<script>window.open('recibo.php?Order_num=$order_num','_self')</script>";
            }
            
        } 
        
        /* foreach($_SESSION["cart_array"]as $each_item) 
            {
            $item_id = $each_item["item_id"];
            $get_item = "select brand_name,quantity_stock,sale_price,purchase_price, product_id from product p, brand b where product_id='$item_id' AND (p.product_id = b.brand_id)";
            $run_item = mysqli_query($con,$get_item);
        
        
            while($row_item=mysqli_fetch_array($run_item)){
                $item_name = $row_item['brand_name'];
                $item_price = $row_item['sale_price'];
        
            }
            $total_price = $item_price * $each_item['quantity'];
            $cart_total = $total_price + $cart_total;
            $qty_item = $each_item['quantity'];  
        
            $insert_product = " insert into contain (order_id, product_id, quantity, price, cost) values( '$order_num','$each_item['product_id']' ,'$each_item['quantity']' ,'$each_item['sale_price']' ,'$each_item['purchase_price']' )";
            $run_insert_payment = mysqli_query ($con, $insert_product);
        
            } */
        
        
                   $cart_total = 0;
                                            foreach ($_SESSION["cart_array"] as $each_item) 
                                            {
                                                $item_id = $each_item["item_id"];
                                                $get_item = "select brand_name,quantity_stock,sale_price from product NATURAL JOIN brand  where product_id='$item_id' ";
                                                $run_item = mysqli_query($con,$get_item);
                        
                                                while($row_item=mysqli_fetch_array($run_item)){
                                                    $item_name = $row_item['brand_name'];
                                                    $item_price = $row_item['sale_price'];
                        
                                                }
                                                $total_price = $item_price * $each_item['quantity'];
                                                $cart_total = $total_price + $cart_total;
                                                $qty_item = $each_item['quantity'];   
                                            
                                                echo "<tr>
                                                <td class='col-md-9'><em> $item_name</em></h4></td>
                                                <td class='col-md-1' style='text-align: center'> $qty_item </td>
                                                <td class='col-md-1 text-center'>$item_price</td>
                                                <td class='col-md-1 text-center'>$total_price</td>
                                                </tr>";
        
                                                //QUERY Restar Remaining
                                               // $get_qty = "select brand_name,quantity_stock,sale_price from product p, brand b where product_id='$item_id' AND (p.product_id = b.brand_id)";
                                                $get_qty = "select product_id, quantity_stock, quantity_sold FROM product WHERE product_id='$item_id'";
        
                                                $run_qty = mysqli_query($con,$get_qty);
                                                $row_qty = mysqli_fetch_array($run_qty);
        
                                                // echo $row_qty;
        
                                                $prev_qty = $row_qty["quantity_stock"];
                                                $prev_qty_sold = $row_qty["quantity_sold"];
        
                                                //echo $prev_qty;
        
                                                $updated_qty = $prev_qty - $qty_item;
                                                $updated_qty_sold = $prev_qty_sold + $qty_item;
        
                                                //echo $updated_qty;
        
                                                $cap_update =  "update product set quantity_stock = '$updated_qty' where product_id = '$item_id' ";
                                                $cap_update_sold =  "update product set quantity_sold = '$updated_qty_sold' where product_id = '$item_id' ";
        
                                                
                                                $run_cap_update = mysqli_query($con,$cap_update);
                                                $run_cap_update_sold = mysqli_query($con,$cap_update_sold);
        
                                            }
    }
    else{
        echo "Purchase not indicted";
        echo "<script>alert('Cart is Empty, please take a look to our products! )</script>";
		echo "<script>window.open('shopProbar.php','_self')</script>";

    }

                                        ?>