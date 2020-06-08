<?php
    $dbc = @mysqli_connect('localhost','root','','dropo_coffee_db')
        OR die('No se pudo conectar a la base de datos'.mysqli_connect_error());
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Order Details</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">
    <link href="vendor/vector-map/jqvmap.min.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/style.css" rel="stylesheet" media="all">

</head>
<body class="animsition">
<!--Nav-->
<?php require_once ("php/header.php"); ?>
	<!--Nav end-->
    <div class="page-wrapper">


        <!-- START PAGE CONTAINER -->
        <div class="page-container2">
            <!-- START HEADER DESKTOP -->
          
            <!-- END HEADER DESKTOP -->
            
            <!-- START FORM -->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-header">
                                        <strong>Order Details</strong>
                                    </div>
                                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                        <?php
                                            //Query Search Product
                                            $query = "SELECT *
                                                        FROM orders o, status s, customer c, shipping_address a, payment_method p
                                                        WHERE (order_id = {$_GET['order_id']}) AND (o.status_id = s.status_id) AND (o.customer_id = c.customer_id) AND (o.customer_id = a.customer_id) AND (o.customer_id = p.customer_id)";
                                            $r = mysqli_query($dbc,$query);//Make the Query
                                            $row = mysqli_fetch_array($r);//Save Query Result
                                        ?>
                                        <div class="card-body card-block">
                                            <!-- ORDER ID -->
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="select" class=" form-control-label">ORDER ID:</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                       <label for="select" class=" form-control-label"><?php echo $row['order_id'] ?></label>
                                                </div>
                                            </div>
                                            <!-- CUSTOMER NAME -->
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="select" class=" form-control-label">CUSTOMER NAME:</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                     <label for="select" class=" form-control-label"><?php echo "$row[name] $row[lastname]" ?></label>  
                                                </div>
                                            </div>
                                            <!-- TRACK NUMBER -->
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="select" class=" form-control-label">TRACK #:</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                       <label for="select" class=" form-control-label"><?php echo $row['track_number'] ?></label>
                                                </div>
                                            </div>
                                            <!-- STATUS -->
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="select" class=" form-control-label">STATUS:</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                       <label for="select" class=" form-control-label"><?php echo $row['status_name'] ?></label>
                                                </div>
                                            </div>
                                            <!-- ORDER DATE -->
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="select" class=" form-control-label">DATE:</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                       <label for="select" class=" form-control-label"><?php echo $row['order_date'] ?></label>
                                                </div>
                                            </div>
                                            <!-- ADDRESS -->
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="hf-password" class=" form-control-label">ADDRESS</label>
                                                </div>
                                            </div>
                                            <!-- START ADDRESS SUB CATEGORIES -->
                                            <!-- STREET 1 -->
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="hf-password" class=" form-control-label" style="text-indent : 2em;">STREET1:</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <label for="hf-email" class=" form-control-label"><?php echo $row['street1'] ?></label>
                                                </div>
                                            </div>
                                            <!-- STREET 2 -->
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="hf-password" class=" form-control-label" style="text-indent : 2em;">STREET2:</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <label for="hf-email" class=" form-control-label"><?php echo $row['street2'] ?></label>
                                                </div>
                                            </div>
                                            <!-- CITY -->
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="hf-password" class=" form-control-label" style="text-indent : 2em;">CITY:</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <label for="hf-email" class=" form-control-label"><?php echo $row['city'] ?></label>
                                                </div>
                                            </div>
                                            <!-- STATE -->
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="hf-password" class=" form-control-label" style="text-indent : 2em;">STATE:</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <label for="hf-email" class=" form-control-label"><?php echo $row['state'] ?></label>
                                                </div>
                                            </div>
                                            <!-- ZIPCODE -->
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="hf-password" class=" form-control-label" style="text-indent : 2em;">ZIPCODE:</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <label for="hf-email" class=" form-control-label"><?php echo $row['zip'] ?></label>
                                                </div>
                                            </div>
                                            <!-- COUNTRY -->
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="hf-password" class=" form-control-label" style="text-indent : 2em;">COUNTRY:</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <label for="hf-email" class=" form-control-label"><?php echo $row['country'] ?></label>
                                                </div>
                                            </div>
                                            <!-- END ADDRESS SUB CATEGORIES-->
                                            <!-- PAYMENT -->
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="hf-password" class=" form-control-label">PAYMENT INFO</label>
                                                </div>
                                            </div>
                                            <!-- START PAYMENT SUB CATEGORIES-->
                                            <!-- CARD NAME -->
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="hf-password" class=" form-control-label" style="text-indent : 2em;">CARD:</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <label for="hf-email" class=" form-control-label"><?php echo $row['card_name'] ?></label>
                                                </div>
                                            </div>
                                            <!-- CARD NUMBER -->
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="hf-password" class=" form-control-label" style="text-indent : 2em;">CARD #:</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <label for="hf-email" class=" form-control-label"><?php echo $row['card_number'] ?></label>
                                                </div>
                                            </div>
                                            <!-- EXP DATE -->
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="hf-password" class=" form-control-label" style="text-indent : 2em;">EXP DATE:</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <label for="hf-email" class=" form-control-label"><?php echo "$row[exp_month]/$row[exp_year]" ?></label>
                                                </div>
                                            </div>
                                            <!-- CCV -->
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="hf-password" class=" form-control-label" style="text-indent : 2em;">CCV:</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <label for="hf-email" class=" form-control-label"><?php echo $row['ccv'] ?></label>
                                                </div>
                                            </div>
                                            <!-- END PAYMENT SUB CATEGORIES-->
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <!-- USER DATA-->
                                <div class="user-data m-b-30">
                                    <h3 class="title-3 m-b-30">PRODUCTS</h3>
                                    <div class="table-data">
                                        <table class="table">
                                            <thead>
                                                <?php
                                                    //Select To select orders details of a specific order id

                                                    $query3 = "SELECT DISTINCT o.order_id, SUM(sale_price*product_quantity) sales, SUM(purchase_price*product_quantity) costs
                                                                FROM orders o, contain c
                                                                WHERE (o.order_id = {$_GET['order_id']}) AND (o.order_id = c.order_id)";
                                                    if($r3 = mysqli_query($dbc,$query3))//Make the Query
                                                    {
                                                        $row3 = mysqli_fetch_array($r3);//Present Users
                                                    }
                                                ?>
                                                <tr>
                                                    <td>
                                                        <div class='table-data__info'>
                                                            <h4>SALE: $<?php echo $row3['sales'] ?></h4>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class='table-data__info'>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php      
                                                    //Query Search Product
                                                    $query2 = "SELECT Distinct o.order_id, p.product_id, product_quantity, brand_name, description, weight_oz, grain_type
                                                                FROM orders o, contain c, product p, brand b, weight w, grain g
                                                                WHERE (o.order_id = {$row['order_id']}) 
                                                                        AND (o.order_id = c.order_id)
                                                                        AND (c.product_id = p.product_id)
                                                                        AND (p.brand_id = b.brand_id) 
                                                                        AND (w.weight_id = p.weight_id)
                                                                        AND (g.grain_id = p.grain_id)";
                                                    if($r2 = mysqli_query($dbc,$query2))//Make the Query
                                                    {
                                                        while($row2 = mysqli_fetch_array($r2))//Present Users
                                                        {
                                                            print "
                                                                <tr>
                                                                    <td>
                                                                        <div class='table-data__info'>
                                                                            <h4>$row2[brand_name]</h4>
                                                                            <h6>$row2[description]/$row2[weight_oz]oz./$row2[grain_type]</h6>
                                                                            <h6>Quantity: $row2[product_quantity]</h6>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <a href='product-single.php?item_id={$row2['product_id']}' class='btn btn-secondary btn-sm'><i class='fa fa-list-ul'></i>&nbsp;Details<a>
                                                                    </td>
                                                                </tr>";
                                                        }
                                                    }
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
            </div>
            <!-- END FORM -->
           
            <!-- END PAGE CONTAINER-->
        </div>
    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js">
    </script>
    <script src="vendor/vector-map/jquery.vmap.js"></script>
    <script src="vendor/vector-map/jquery.vmap.min.js"></script>
    <script src="vendor/vector-map/jquery.vmap.sampledata.js"></script>
    <script src="vendor/vector-map/jquery.vmap.world.js"></script>

    <!-- Main JS-->
    <script src="js/main.js"></script>

</body>

</html>
<!-- end document-->