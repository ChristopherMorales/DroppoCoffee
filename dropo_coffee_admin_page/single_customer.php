<?php
    include 'connection/connection.php';
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
    <title>Customer</title>

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
    <link href="css/theme.css" rel="stylesheet" media="all">

</head>
<body class="animsition">
    <div class="page-wrapper">
        <?php
            include 'sidebar.php'
        ?>

        <!-- START PAGE CONTAINER -->
        <div class="page-container2">
            <!-- START HEADER DESKTOP -->
            <header class="header-desktop2">
            </header>
            <!-- END HEADER DESKTOP ->
            
            <?php
            include 'sidebar.php'
        ?>

            <!-- START BREADCRUMB -->
            <section class="au-breadcrumb m-t-75">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="au-breadcrumb-content">
                                    <div class="au-breadcrumb-left">
                                        <span class="au-breadcrumb-span">You are here:</span>
                                        <ul class="list-unstyled list-inline au-breadcrumb__list">
                                            <li class="list-inline-item active">
                                                <a href="customers.php">Customers</a>
                                            </li>
                                            <li class="list-inline-item seprate">
                                                <span>/</span>
                                            </li>
                                            <li class="list-inline-item">Customer Details</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END BREADCRUMB -->
            
            <!-- START TABLE CONTAINER -->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-header">
                                        <strong>Customer</strong> Profile
                                    </div>
                                    <div class="card-body card-block">
                                        <form action="" method="post" class="form-horizontal">
                                            <?php
                                                $customer = $_GET['customer_id'];//Save Customer ID
                                                //Query Search Customer
                                                $query_customer = "SELECT *
                                                            FROM customer
                                                            WHERE customer_id = '$customer'";
                                                $r = mysqli_query($dbc,$query_customer);//Make the Query
                                                $row = mysqli_fetch_array($r);//Save Query Result
                                            ?>
                                            <!-- NAME -->
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="hf-email" class=" form-control-label">NAME:</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <label for="hf-email" class=" form-control-label"><?php echo $row['name'] ?></label>
                                                </div>
                                            </div>
                                            <!-- LASTNAME -->
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="hf-password" class=" form-control-label">LASTNAME:</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <label for="hf-email" class=" form-control-label"><?php echo $row['lastname'] ?></label>
                                                </div>
                                            </div>
                                            <!-- EMAIL -->
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="hf-password" class=" form-control-label">EMAIL:</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <label for="hf-email" class=" form-control-label"><?php echo $row['email'] ?></label>
                                                </div>
                                            </div>
                                            <!-- PASSWORD -->
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="hf-password" class=" form-control-label">PASSWORD:</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <label for="hf-email" class=" form-control-label"><?php echo $row['password'] ?></label>
                                                </div>
                                            </div>
                                            <?php
                                                //Query Address
                                                $query_address = "SELECT *
                                                            FROM shipping_address
                                                            WHERE customer_id = '$customer'";
                                                $r2 = mysqli_query($dbc,$query_address);//Make the Query
                                                $row2 = mysqli_fetch_array($r2);//Save Query Result
                                            ?>
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
                                                    <label for="hf-email" class=" form-control-label"><?php echo $row2['street1'] ?></label>
                                                </div>
                                            </div>
                                            <!-- STREET 2 -->
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="hf-password" class=" form-control-label" style="text-indent : 2em;">STREET2:</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <label for="hf-email" class=" form-control-label"><?php echo $row2['street2'] ?></label>
                                                </div>
                                            </div>
                                            <!-- CITY -->
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="hf-password" class=" form-control-label" style="text-indent : 2em;">CITY:</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <label for="hf-email" class=" form-control-label"><?php echo $row2['city'] ?></label>
                                                </div>
                                            </div>
                                            <!-- STATE -->
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="hf-password" class=" form-control-label" style="text-indent : 2em;">STATE:</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <label for="hf-email" class=" form-control-label"><?php echo $row2['state'] ?></label>
                                                </div>
                                            </div>
                                            <!-- ZIPCODE -->
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="hf-password" class=" form-control-label" style="text-indent : 2em;">ZIPCODE:</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <label for="hf-email" class=" form-control-label"><?php echo $row2['zip'] ?></label>
                                                </div>
                                            </div>
                                            <!-- COUNTRY -->
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="hf-password" class=" form-control-label" style="text-indent : 2em;">COUNTRY:</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <label for="hf-email" class=" form-control-label"><?php echo $row2['country'] ?></label>
                                                </div>
                                            </div>
                                            <!-- END ADDRESS SUB CATEGORIES-->
                                            <?php
                                                //Query Payment
                                                $query_card = "SELECT *
                                                        FROM payment_method
                                                        WHERE customer_id = '$customer'";
                                                $r3 = mysqli_query($dbc,$query_card);//Make the Query
                                                $row3 = mysqli_fetch_array($r3);//Save Query Result
                                            ?>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="hf-password" class=" form-control-label">PAYMENT INFO</label>
                                                </div>
                                            </div>
                                            <!-- START PAYMENT SUB CATEGORIES-->
                                            <!-- CARD NAME -->
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="hf-password" class=" form-control-label" style="text-indent : 2em;">CARD NAME:</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <label for="hf-email" class=" form-control-label"><?php echo $row3['card_name'] ?></label>
                                                </div>
                                            </div>
                                            <!-- CARD NUMBER -->
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="hf-password" class=" form-control-label" style="text-indent : 2em;">CARD NUMBER:</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <label for="hf-email" class=" form-control-label"><?php echo $row3['card_number'] ?></label>
                                                </div>
                                            </div>
                                            <!-- EXP DATE -->
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="hf-password" class=" form-control-label" style="text-indent : 2em;">EXP DATE:</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <label for="hf-email" class=" form-control-label"><?php echo $row3['exp_month'] ?>/<?php echo $row3['exp_year'] ?></label>
                                                </div>
                                            </div>
                                            <!-- CCV -->
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="hf-password" class=" form-control-label" style="text-indent : 2em;">CCV:</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <label for="hf-email" class=" form-control-label"><?php echo $row3['ccv'] ?></label>
                                                </div>
                                            </div>
                                            <!-- END PAYMENT SUB CATEGORIES-->
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <!-- USER DATA-->
                                <div class="user-data m-b-30">
                                    <h3 class="title-3 m-b-30">Orders</h3>
                                    <div class="table-responsive table-data">
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
                                                                        ORDER BY YEAR(order_date), MONTH(order_date), DAY(order_date) DESC;";

                                                    if($r_orders = mysqli_query($dbc, $query_orders))//Save & Validate Query Results
                                                    {
                                                        while($row_orders=mysqli_fetch_array($r_orders))//Present Users
                                                        {
                                                            print "
                                                            <tr>
                                                                <td class='text-center'>$row_orders[order_id]</td>
                                                                <td class='text-center'>$row_orders[track_number]</td>
                                                                <td class='text-center'>$row_orders[status_name]</td>
                                                                <td>
                                                                    <a href='update_order.php?order_id={$row_orders['order_id']}' class='btn btn-primary btn-sm'>Edit<a>
                                                                </td>
                                                                <td>
                                                                    <a href='single_order.php?order_id={$row_orders['order_id']}' class='btn btn-secondary btn-sm'>Details<a>
                                                                </td>
                                                            </tr>";
                                                        }
                                                    }
                                                    else
                                                        print'<p style="color:red">NO SE PUEDE MOSTRAR RECORD PORQUE:'.mysqli_error($dbc).'.</P>';
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
            <!-- END TABLE CONTAINER -->
            

            <section>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="copyright">
                                <p>Copyright © 2018 Colorlib. All rights reserved. Template by <a href="https://colorlib.com">Colorlib</a>.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
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