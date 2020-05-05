<?php
include "conection.php";
session_start();

//$ship_address = $_POST['firstname'] . " " . $_POST['address'] . " " . $_POST['city'] . " " . $_POST['state'] . " " . $_POST['zip'];

/* $user = $_SESSION['email'];

$get_cust = "select First_Name,Middle_Name,Last_Name,Email,customer_id, Street_Name,Apt_Number,City,State,Zip,Address_Type from Customer where Email='$user'";

$run_cust = mysqli_query($con,$get_cust);

$row_cust = mysqli_fetch_array($run_cust); */

//$cust_id = $row_cust['customer_id'];
//$order_Name= $row_cust['First_Name'];
/* $order_LastN = $row_cust['Last_Name'];

$get_order = "Select Order_Num,Payment_Type From order WHERE customer_id='$cust_id' Group By Order_Date DESC LIMIT 1";
$run_ordernum = mysqli_query($con,$get_order);
$row_num = mysqli_fetch_array($run_ordernum);

$order_num = $row_num['Order_Num'];
$order_payment = $row_num['Payment_Type'];

$get_address = "Select Street_Name,Apt_Number,City,State,Zip from Orders WHERE Order_Num='$order_num' Group By Order_Date DESC LIMIT 1";
$run_address = mysqli_query($con,$get_address);
$row_address = mysqli_fetch_array($run_address);

$street = $row_address['Street_Name'];
$apt= $row_address['Apt_Number'];
$city = $row_address['City'];
$state = $row_address['State'];
$zip = $row_address['Zip'];
 */

foreach($_SESSION["cart_array"] as $each_item) 
{
    $item_id = $each_item["item_id"];
    $get_item = "select brand_name,sale_price from product p, brand b where product_id='$item_id' AND (p.product_id = b.brand_id)";
    $run_item = mysqli_query($con,$get_item);

    while($row_item=mysqli_fetch_array($run_item))
    {
        $item_name = $row_item['brand_name'];
        $item_price = $row_item['sale_price'];
       // echo "Lo que está en item_price: $item_price";
        //echo "Lo que está en item_name: $item_name";

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
                               <!--  <img width="50px" src="img/Pop-logo.png"> -->
                            </td>
                            
                            <td>
                                Order #: <?php $order_num; ?><br>
                                Date: <?php //echo date("F j, Y");?><br>
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
                    Payment Method
                </td>
                
            </tr>
            
            <tr class="details">
                <td>
                        <?php //echo $order_payment; ?>
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
                        SELECT product_id, brand_name, description, weight_oz, grain_type, sale_price, quantity_stock, avaible, image_url  FROM product p, brand b, weight w, grain g
                        WHERE (p.brand_id = b.brand_id) AND (p.brand_id = b.brand_id) AND (p.weight_id = w.weight_id) AND (p.grain_id = g.grain_id) AND avaible = 1 AND image_url IS NOT NULL AND product_id='$item_id'";
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
                        
                    echo "
                    <tr>
                    <td class='col-sm-8 col-md-6'>
                    <div class='media'>
                        <a class='thumbnail pull-left' href='shopProbar.php?item_id=$item_id'> <img class='media-object' src='$item_pic' style='width: 72px; height: 72px;'> </a>
                        <div class='media-body'>
                            <h4 class='media-heading'><a href='product-single.php?item_id=$item_id'>$item_name</a></h4>
                            <span>Items remaining: </span><span class='text-success'><strong>$remaining</strong></span>
                        </div>
                    </div></td>
                    <td class='col-sm-1 col-md-1 text-center'><strong>$item_price</strong></td>
                    <td class='col-sm-1 col-md-1' style='text-align: center'>$qty_item
                    </td>
                    <td class='col-sm-1 col-md-1'>
                    </tr>
                    <tr>
                   
                                   
                    ";
                                        
                                        $get_qty = "select quantity_stock from product p, brand b where product_id='$item_id' AND (p.product_id = b.brand_id)";
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
                     <?php echo $cart_total?>
                        </center>
                </td>
                
            </tr>
        </table>
    </div>
</body>
</html>