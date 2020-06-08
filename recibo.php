<?php
include "conection.php";
session_start();

$user = $_SESSION['customer_id'];

$get_order = "Select customer_id,street1,street2,city,state,zip, country, email From shipping_address NATURAL JOIN customer WHERE customer_id='$user'";
$run_ordernum = mysqli_query($con,$get_order);
$row_num = mysqli_fetch_array($run_ordernum);

$order_street1 = $row_num['street1'];
$order_street2 = $row_num['street2'];
$order_city = $row_num['city'];
$order_state = $row_num['state'];
$order_zip = $row_num['zip'];
$order_country = $row_num['country'];
$order_email = $row_num['email'];


$get_order = "Select order_id,track_number,order_date from orders Group By order_date DESC LIMIT 1";
$run_order = mysqli_query($con,$get_order);
$row_order = mysqli_fetch_array($run_order);

$order_num = $row_order['order_id'];
$trackNum= $row_order['track_number'];
$orderDate = $row_order['order_date'];
 

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

$order_payment = $order_street1 . " " . $order_street2 . " " . $order_city . " " . $order_state . " " . $order_zip . " " . $order_country ;

$cart_total = 0;
$qty_total = 0;
foreach($_SESSION["cart_array"] as $each_item) 
{
    $item_id = $each_item["item_id"];
    $get_item = "select brand_name,sale_price from product NATURAL JOIN brand  where product_id='$item_id'";
    $run_item = mysqli_query($con,$get_item);

    while($row_item=mysqli_fetch_array($run_item))
    {
        $item_name = $row_item['brand_name'];
        $item_price = $row_item['sale_price'];
    }

    $total_price = $item_price * $each_item['quantity'];
    $cart_total = $total_price + $cart_total;
    $qty_item = $each_item['quantity'];
    $qty_total += $qty_item; 
}

?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Order Receipt for Droppo' Coffee</title>
    
    <style>
    .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }
    
    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
    }
    
    .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }
    
    .invoice-box table tr td:nth-child(2) {
        text-align: right;
    }
    
    .invoice-box table tr.top table td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #333;
    }
    
    .invoice-box table tr.information table td {
        padding-bottom: 40px;
    }
    
    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }
    
    .invoice-box table tr.details td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.item td{
        border-bottom: 1px solid #eee;
    }
    
    .invoice-box table tr.item.last td {
        border-bottom: none;
    }
    
    .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }
    
    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }
        
        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
    }
    
    /** RTL **/
    .rtl {
        direction: rtl;
        font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }
    
    .rtl table {
        text-align: right;
    }
    
    .rtl table tr td:nth-child(2) {
        text-align: left;
    }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                               <h4> Order Receipt </h4>
                            </td>
                            
                            <td>
                                Order #: <strong><?php echo $order_num ?></strong><br>
                                Traking Number: <?php echo $trackNum ?><br>
                                Order Date: <?php echo $orderDate ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                <?php //echo "$street,$apt"; ?><br>
                                <?php //echo $city; ?><br>
                                <?php //echo "$state,$zip"; ?>
                            </td>
                            
                            <td>
                                <?php //echo" $order_Name, $order_LastN"; ?><br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="heading">
                <td>
                    Ship To: 
                </td>
                
            </tr>
            
            <tr class="details">
                <td>

                <strong><?php echo $cust_first ?> <?php echo $cust_last ?></strong><br>
                <?php echo $order_street1 ?> , <?php echo $order_street2 ?><br>
                <?php echo $order_city ?>, <?php echo $order_state ?>, <?php echo $order_zip ?>, <?php echo $order_country ?>
                              
                </td>
                
                
            </tr>
            
            <tr class="heading">
                <td>
                    Item
                </td>
                 <td>
                   Price
                </td>
                <td>
                    <center>
                   Amount
                        </center>
                </td>
               
                
                
            </tr>
            
            <tr class="item">
                <?php 
                        $cart_total = 0;
                        
                        foreach ($_SESSION["cart_array"] as $each_item) {
                        $item_id = $each_item["item_id"];
                        $get_item = "
                        SELECT product_id, brand_name, weight_oz, grain_type, sale_price, quantity_stock, available, image_url  FROM product p, brand b, weight w, grain g
                        WHERE (p.brand_id = b.brand_id) AND (p.brand_id = b.brand_id) AND (p.weight_id = w.weight_id) AND (p.grain_id = g.grain_id) AND available = 1 AND image_url IS NOT NULL AND product_id='$item_id'";
                        $run_item = mysqli_query($con,$get_item);

                        while($row_item=mysqli_fetch_array($run_item))
                        {
                            $item_name = $row_item['brand_name'];
                            $item_pic = $row_item['image_url'];
                            $item_price = $row_item['sale_price'];
                            $remaining = $row_item['quantity_stock'];
                            $weight = $row_item['weight_oz'];
                        }
                        $total_price = $item_price * $each_item['quantity'];
                        $cart_total = $total_price + $cart_total;
                        $qty_item = $each_item['quantity'];

                        
                

                        
                    echo "
                    <tr>
                    <td class='col-sm-8 col-md-6'>
                    <div class='media'>
                        <a class='thumbnail pull-left' href='shop.php?item_id=$item_id'> <img class='media-object' src='$item_pic' style='width: 72px; height: 72px;'> </a>
                        <div class='media-body'>
                            <h4 class='media-heading'><a href='product-single.php?item_id=$item_id'>$item_name, $weight oz</a></h4>
                        </div>
                    </div></td>
                    <td class='col-sm-1 col-md-1 text-center'><strong>$$item_price</strong></td>
                    <td class='col-sm-1 col-md-1' style='text-align: center'>$qty_item
                    </td>
                    <td class='col-sm-1 col-md-1'>
                    </tr>
                    <tr>
                   
                                   
                    ";
                                        
                                        $get_qty = "select quantity_stock from product where product_id='$item_id'";
                                        $run_qty = mysqli_query($con,$get_qty);
                                        $row_qty = mysqli_fetch_array($run_qty);

                                        // echo $row_qty;
                                        unset($_SESSION["cart_array"]);

                                    }
                                    ?>
                
                
            </tr>
          
            
            <tr class="total">
                <td></td>
                
                <td>
                    Free Shipping <br>
                   
                </td>
                <td>
                    <center>
                     $<?php 
                     
                     $tax = $cart_total * 0.115;
                     $cart_total = $cart_total + $tax;
                     echo (round($cart_total, 2))
                     
                     ?>
                        </center>
                </td>
                
            </tr>
        </table>
    </div>
</body>
</html>