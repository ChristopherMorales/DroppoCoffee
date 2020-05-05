<?php
include 'conection.php';
session_start();

?>
<?php 

///////////////////////////////
// VERIFY PURCHASE QUANTITY //
/////////////////////////////
foreach ($_SESSION["cart_array"] as $each_item)
{
	$error_output = "";
	$cart_items = $each_item['quantity'];
	$item_id = $each_item["item_id"];

	$get_qty = "select brand_name,quantity_stock from product p, brand b where product_id='$item_id' AND (p.product_id = b.brand_id)";
    $run_qty = mysqli_query($con,$get_qty);
	$row_qty = mysqli_fetch_array($run_qty);
	
	$item_table_qty = $row_qty["quantity_stock"];
	$item_name = $row_qty["brand_name"];

	 if (($cart_items > $item_table_qty) and $item_table_qty > 0){
		echo "<script>alert('The amount of coffee in the order is not available. Please adjust the quantity of $item_name, which has $item_table_qty coffee left')</script>";
		echo "<script>window.open('../shopProbar.php','_self')</script>";
	}

}


//////////////////////////////
/// CUSTOMER SESSION INFO ///
////////////////////////////

/* $user = $_SESSION['email'];

$get_cust = "select First_Name,Middle_Name,Last_Name,Email,Customer_ID, Street_Name,Apt_Number,City,State,Zip,Address_Type from Customer where Email='$user'";

$run_cust = mysqli_query($con,$get_cust);

$row_cust = mysqli_fetch_array($run_cust);

$cust_id = $row_cust['Customer_ID'];

$cust_first = $row_cust['First_Name'];
$cust_init = $row_cust['Middle_Name'];
$cust_last = $row_cust['Last_Name'];
$cust_email = $row_cust['Email'];
 */



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
                

/* $cust_email = $_SESSION['email'];
$get_cust = "select Customer_ID from Customer where Email='$cust_email'";
$run_cust = mysqli_query($con, $get_cust);
$row_cust = mysqli_fetch_array($run_cust);
$cust_id = $row_cust['Customer_ID']; */
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
/* $payment_type = $_POST['payment_type'];
$paypal_mail = $_POST['email'];
$cc_number = $_POST['cc_num'];
$cvv = $_POST['Cvv'];
$cust_street = $_POST['streetname'];
$cust_apt = $_POST['apt'];
$cust_city =  $_POST['city'];
$cust_state = $_POST['state'];
$cust_zip = $_POST['zip']; */

foreach($_SESSION["cart_array"]as $each_item) {
    $item_id = $each_item["item_id"];
    $get_item = "select brand_name,quantity_stock,sale_price from product p, brand b where product_id='$item_id' AND (p.product_id = b.brand_id)";
    $run_item = mysqli_query($con,$get_item);
    

    while($row_item=mysqli_fetch_array($run_item)){
        $item_name = $row_item['brand_name'];
        $item_price = $row_item['sale_price'];
    }
    
    
    
    $total_item= 0;
    $total_item = $total_item + $each_item['quantity'];

    $total_price = $item_price * $each_item['quantity'];
    $cart_total = $total_price + $cart_total;
    $qty_item = $each_item['quantity'];
    $qty_total += $qty_item;
    

    //Arreglar
    // customer_id
    //"" shipping_address
    // paymentMethod
    //items

     $insert_order = "insert into orders (order_id,customer_id,track_number,status,order_date,shipping_address, 
                                           payment_method, tax, total_items, items, total_sale, total_cost, refund ) 
                            values('$order_num','1','$track_num', '1', '$my_date', '2', '2', '1.50', '$total_item', '0', '$cart_total', '0', '0' )";

    /* echo "order_num: $order_num \n";
    echo "track_num: $track_num \n";
    echo "my_date: $my_date \n";
    echo "total_item: $total_item \n";
    echo "qty_total: $qty_total \n";
    echo "cart_total: $cart_total \n";
 */





    
    
    $run_insert_orders = mysqli_query ($con, $insert_order);
                
    if($run_insert_orders){
					echo "<script>alert('Your order has been successfully made, Thanks!')</script>";
					echo "<script>window.open('recibo.php?Order_num=$order_num','_self')</script>";
				}
    
}
//$insert_payment = "insert into Payment_info (Order_Num,Payment_Type,Total)   values('$order_num','$payment_type','$cart_total')";
//$run_insert_payment = mysqli_query ($con, $insert_payment);
           $cart_total = 0;
                                    foreach ($_SESSION["cart_array"] as $each_item) {
                                        $item_id = $each_item["item_id"];
                                        $get_item = "select brand_name,quantity_stock,sale_price from product p, brand b where product_id='$item_id' AND (p.product_id = b.brand_id)";
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

                                        $get_qty = "select brand_name,quantity_stock,sale_price from product p, brand b where product_id='$item_id' AND (p.product_id = b.brand_id)";
                                        $run_qty = mysqli_query($con,$get_qty);
                                        $row_qty = mysqli_fetch_array($run_qty);

                                        // echo $row_qty;

                                        $prev_qty = $row_qty["quantity_stock"];
                                        //echo $prev_qty;

                                        $updated_qty = $prev_qty - $qty_item;
                                        //echo $updated_qty;

                                        $cap_update =  "update product p , brand b set quantity_stock = '$updated_qty' where product_id = '$item_id' AND (p.product_id = b.brand_id)";
                                        $run_cap_update = mysqli_query($con,$cap_update);
                                    }
                                        ?>