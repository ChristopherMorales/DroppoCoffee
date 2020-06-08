<?php
    include 'connection/connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page -->
    <title>Home</title>

    <!-- Fontfaces CSS -->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS -->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS -->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">
    <link href="vendor/vector-map/jqvmap.min.css" rel="stylesheet" media="all">

    <!-- Main CSS -->
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
                                                <a href="#">Home</a>
                                            </li>
                                            <li class="list-inline-item seprate">
                                                <span>/</span>
                                            </li>
                                            <li class="list-inline-item">Dashboard</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END BREADCRUMB -->

            <!-- STATISTIC--> 
            <section class="statistic">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6 col-lg-3">
                                <div class="statistic__item">
                                    <?php
                                        //Query Total Members
                                        $query_members = "SELECT COUNT(customer_id) AS members
                                                    FROM customer";
                                        $r_members = mysqli_query($dbc,$query_members);//Make the Query
                                        $row_members = mysqli_fetch_array($r_members);//Save Query Result
                                    ?>
                                    <h2 class="number"><?php echo $row_members['members'] ?></h2>
                                    <span class="desc">members online</span>
                                    <div class="icon">
                                        <i class="zmdi zmdi-account-o"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="statistic__item">
                                    <?php
                                        //Query Items Sold
                                        $query_itmes = "SELECT 	SUM(product_quantity) AS solds
                                                        FROM contain c, orders o
                                                        WHERE c.order_id = o.order_id AND refund = 0";
                                        $r_items = mysqli_query($dbc,$query_itmes);//Make the Query
                                        $row_itmes = mysqli_fetch_array($r_items);//Save Query Result
                                    ?>
                                    <h2 class="number"><?php echo $row_itmes['solds'] ?></h2>
                                    <span class="desc">items sold</span>
                                    <div class="icon">
                                        <i class="zmdi zmdi-shopping-cart"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="statistic__item">
                                    <?php
                                        $current_week = date('W');//Current Week Number
                                        //Query This Week
                                        $query_this_week = "SELECT SUM(sale_price-purchase_price) AS this_week
                                                            FROM orders o INNER JOIN contain c ON o.order_id = c.order_id
                                                            WHERE WEEK(order_date,1)=$current_week AND refund=0";
                                        $r_this_week = mysqli_query($dbc,$query_this_week);//Make the Query
                                        $row_this_week = mysqli_fetch_array($r_this_week);//Save Query Result
                                    ?>
                                    <h2 class="number">$<?php echo $row_this_week['this_week'] ?></h2>
                                    <span class="desc">this week</span>
                                    <div class="icon">
                                        <i class="zmdi zmdi-calendar-note"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="statistic__item">
                                    <?php
                                        //Query Earnings
                                        $query_earnings = "SELECT SUM(product_quantity*sale_price - product_quantity*purchase_price) AS earnings
                                                            FROM contain c, orders o
                                                            WHERE c.order_id = o.order_id AND refund = 0";
                                        $r_earnings = mysqli_query($dbc,$query_earnings);//Make the Query
                                        $row_earnings = mysqli_fetch_array($r_earnings);//Save Query Result
                                    ?>
                                    <h2 class="number">$<?php echo $row_earnings['earnings'] ?></h2>
                                    <span class="desc">total earnings</span>
                                    <div class="icon">
                                        <i class="zmdi zmdi-money"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END STATISTIC-->

            <!-- START ORDERS TABLE-->
            <section>
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="top-campaign">
                                    <div class="table-data__tool">
                                        <div class="table-data__tool-left">
                                            <h3 class="title-3 m-b-30">Recent Orders</h3>
                                        </div>
                                        <div class="table-data__tool-right">
                                            <a href="orders.php" class="btn btn-primary">
                                                <i></i>Show All</a>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-top-campaign">
                                            <thead>
                                                <tr>
                                                    <th class='text-center'>ID</th>
                                                    <th class='text-center'>Track #</th>
                                                    <th class='text-center'>Total Price</th>
                                                    <th class='text-center'>Date</th>
                                                    <th class='text-center'>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    //Query Search Order
                                                    $query_orders = "SELECT order_id
                                                                        FROM orders
                                                                        WHERE refund = 0
                                                                        ORDER BY YEAR(order_date), MONTH(order_date), DAY(order_date) DESC
                                                                        LIMIT 5;";

                                                    if($r_orders = mysqli_query($dbc, $query_orders))//Save & Validate Query Results
                                                    {
                                                        while($row_orders=mysqli_fetch_array($r_orders))//Present Users
                                                        {
                                                            $query_orders2 = "SELECT track_number,  SUM(sale_price) AS total, order_date, status_name
                                                                                FROM orders o, contain c, status s
                                                                                WHERE o.status_id = s.status_id AND o.order_id = c.order_id and o.order_id = $row_orders[order_id]";
                                                            if($r_orders2 = mysqli_query($dbc, $query_orders2))
                                                            {
                                                                $row_orders2=mysqli_fetch_array($r_orders2);
                                                                print "
                                                                    <tr>
                                                                        <td class='text-center'>$row_orders[order_id]</td>
                                                                        <td class='text-center'>$row_orders2[track_number]</td>
                                                                        <td class='text-center'>$row_orders2[total]</td>
                                                                        <td class='text-center'>$row_orders2[order_date]</td>
                                                                        <td class='text-center'>$row_orders2[status_name]</td>
                                                                    </tr>";
                                                            }
                                                        }
                                                    }
                                                    else
                                                        print'<p style="color:red">NO SE PUEDE MOSTRAR RECORD PORQUE:'.mysqli_error($dbc).'.</P>';
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END ORDERS TABLE-->
            
            <!-- START REFUNDS TABLE-->
            <section>
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="top-campaign">
                                    <div class="table-data__tool">
                                        <div class="table-data__tool-left">
                                            <h3 class="title-3 m-b-30">Recent Refunds</h3>
                                        </div>
                                        <div class="table-data__tool-right">
                                            <a href="refunds.php" class="btn btn-primary">
                                                <i></i>Show All</a>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-top-campaign">
                                            <thead>
                                                <tr>
                                                    <th class='text-center'>ID</th>
                                                    <th class='text-center'>Track #</th>
                                                    <th class='text-center'>Total Price</th>
                                                    <th class='text-center'>Date</th>
                                                    <th class='text-center'>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    //Query Search Order
                                                    $query_orders = "SELECT order_id
                                                                        FROM orders
                                                                        WHERE refund = 1
                                                                        ORDER BY YEAR(order_date), MONTH(order_date), DAY(order_date) DESC
                                                                        LIMIT 5;";

                                                    if($r_orders = mysqli_query($dbc, $query_orders))//Save & Validate Query Results
                                                    {
                                                        while($row_orders=mysqli_fetch_array($r_orders))//Present Users
                                                        {
                                                            $query_orders2 = "SELECT track_number,  SUM(sale_price) AS total, order_date, status_name
                                                                                FROM orders o, contain c, status s
                                                                                WHERE o.status_id = s.status_id AND o.order_id = c.order_id and o.order_id = $row_orders[order_id]";
                                                            if($r_orders2 = mysqli_query($dbc, $query_orders2))
                                                            {
                                                                $row_orders2=mysqli_fetch_array($r_orders2);
                                                                print "
                                                                    <tr>
                                                                        <td class='text-center'>$row_orders[order_id]</td>
                                                                        <td class='text-center'>$row_orders2[track_number]</td>
                                                                        <td class='text-center'>$row_orders2[total]</td>
                                                                        <td class='text-center'>$row_orders2[order_date]</td>
                                                                        <td class='text-center'>Refund</td>
                                                                    </tr>";
                                                            }
                                                        }
                                                    }
                                                    else
                                                        print'<p style="color:red">NO SE PUEDE MOSTRAR RECORD PORQUE:'.mysqli_error($dbc).'.</P>';
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END REFUNDS TABLE-->
            
            
            <!-- START EARNING BY PRODUCT TABLE-->
            <section>
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="top-campaign">
                                    <div class="table-data__tool">
                                        <div class="table-data__tool-left">
                                            <h3 class="title-3 m-b-30">TOP 5 SOLD PRODUCTS</h3>
                                        </div>
                                        <div class="table-data__tool-right">
                                            <a href="products_sales.php" class="btn btn-primary">
                                                <i></i>Show All</a>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-top-campaign">
                                            <thead>
                                                <tr>
                                                    <th class='text-left'>Product</th>
                                                    <th class='text-left'>Description</th>
                                                    <th class='text-center'>Weight</th>
                                                    <th class='text-center'>Grain</th>
                                                    <th class='text-center'>Quantity</th>
                                                    <th class='text-center'>Sales</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                //Query Search Products
                                                $query_products = "SELECT brand_name, description, weight_oz, grain_type, quantity_sold, (quantity_sold*sale_price) AS sales
                                                                        FROM product p, brand b, weight w, grain g
                                                                        WHERE p.brand_id = b.brand_id AND p.weight_id = w.weight_id AND p.grain_id = g.grain_id
                                                                        ORDER BY quantity_sold DESC, brand_name ASC, weight_oz ASC
                                                                        LIMIT 5;";
                                            
                                                if($r_products = mysqli_query($dbc, $query_products))//Save & Validate Query Results
                                                {
                                                    while($row_products=mysqli_fetch_array($r_products))//Present Users
                                                    {
                                                        print "
                                                        <tr>
                                                            <td class='text-left'>$row_products[brand_name]</td>
                                                            <td class='text-left'>$row_products[description]</td>
                                                            <td class='text-center'>$row_products[weight_oz]</td>
                                                            <td class='text-center'>$row_products[grain_type]</td>
                                                            <td class='text-center'>$row_products[quantity_sold]</td>
                                                            <td class='text-center'>$row_products[sales]</td>
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
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END EARNING BY PRODUCT TABLE-->
            
            <!-- START DAY REPORT TABLE-->
            <section>
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="top-campaign">
                                    <div class="table-data__tool">
                                        <div class="table-data__tool-left">
                                            <h3 class="title-3 m-b-30">THIS DAY REPORT</h3>
                                        </div>
                                        <div class="table-data__tool-right">
                                            <a href="daily_reports.php" class="btn btn-primary">Past Days</a>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-top-campaign">
                                            <thead>
                                                <tr>
                                                    <th class='text-center'>Day/Month</th>
                                                    <th class='text-center'>Orders</th>
                                                    <th class='text-center'>Products</th>
                                                    <th class='text-center'>Sales</th>
                                                    <th class='text-center'>Costs</th>
                                                    <th class='text-center'>Earnings</th>
                                                    <th class='text-center'>Gross Profit</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $current_day = date('d');//Current Day Number
                                                    $current_month = date('n');//Current Month Number
                                                    //Query Create Week Report
                                                    $query_day = "SELECT COUNT(DISTINCT o.order_id) orders,
                                                                        COUNT(product_id*product_quantity) products,
                                                                        SUM(sale_price) sales,
                                                                        SUM(purchase_price) costs,
                                                                        SUM(sale_price-purchase_price) earnings,
                                                                        (SUM(sale_price-purchase_price)/SUM(sale_price))*100 profit
                                                                    FROM orders o INNER JOIN contain c ON o.order_id = c.order_id
                                                                    WHERE DAY(order_date) = $current_day AND MONTH(order_date) = $current_month AND refund = 0";

                                                    if($r_day = mysqli_query($dbc, $query_day))//Save & Validate Query Results
                                                    {
                                                        $row_day=mysqli_fetch_array($r_day);//Present Users
                                                            print "
                                                            <tr>
                                                                <td class='text-center'>$current_day/$current_month</td>
                                                                <td class='text-center'>$row_day[orders]</td>
                                                                <td class='text-center'>$row_day[products]</td>
                                                                <td class='text-center'>$$row_day[sales]</td>
                                                                <td class='text-center'>$$row_day[costs]</td>
                                                                <td class='text-center'>$$row_day[earnings]</td>
                                                                <td class='text-center'>$row_day[profit]%</td>
                                                            </tr>";
                                                    }
                                                    else
                                                        print'<p style="color:red">NO SE PUEDE MOSTRAR RECORD PORQUE:'.mysqli_error($dbc).'.</P>';
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END DAY REPORT TABLE-->
            
            <!-- START WEEK REPORT TABLE-->
            <section>
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="top-campaign">
                                    <div class="table-data__tool">
                                        <div class="table-data__tool-left">
                                            <h3 class="title-3 m-b-30">THIS WEEK REPORT</h3>
                                        </div>
                                        <div class="table-data__tool-right">
                                            <a href="weekly_reports.php" class="btn btn-primary">Past Weeks</a>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-top-campaign">
                                            <thead>
                                                <tr>
                                                    <th class='text-center'>Week #</th>
                                                    <th class='text-center'>Orders</th>
                                                    <th class='text-center'>Products</th>
                                                    <th class='text-center'>Sales</th>
                                                    <th class='text-center'>Costs</th>
                                                    <th class='text-center'>Earnings</th>
                                                    <th class='text-center'>Gross Profit</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $current_week = date('W');//Current Week Number
                                                    //Query Create Week Report
                                                    $query_week = "SELECT COUNT(DISTINCT o.order_id) orders,
                                                                        COUNT(product_id*product_quantity) products,
                                                                        SUM(sale_price) sales,
                                                                        SUM(purchase_price) costs,
                                                                        SUM(sale_price-purchase_price) earnings,
                                                                        (SUM(sale_price-purchase_price)/SUM(sale_price))*100 profit
                                                                    FROM orders o INNER JOIN contain c ON o.order_id = c.order_id
                                                                    WHERE WEEK(order_date,1)=$current_week AND refund=0";

                                                    if($r_week = mysqli_query($dbc, $query_week))//Save & Validate Query Results
                                                    {
                                                        $row_week=mysqli_fetch_array($r_week);//Present Users 
                                                        print "
                                                            <tr>
                                                                <td class='text-center'>$current_week</td>
                                                                <td class='text-center'>$row_week[orders]</td>
                                                                <td class='text-center'>$row_week[products]</td>
                                                                <td class='text-center'>$$row_week[sales]</td>
                                                                <td class='text-center'>$$row_week[costs]</td>
                                                                <td class='text-center'>$$row_week[earnings]</td>
                                                                <td class='text-center'>$row_week[profit]%</td>
                                                            </tr>";
                                                    }
                                                    else
                                                        print'<p style="color:red">NO SE PUEDE MOSTRAR RECORD PORQUE:'.mysqli_error($dbc).'.</P>';
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END WEEK REPORT TABLE-->
            
            <!-- START MONTH REPORT TABLE-->
            <section>
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="top-campaign">
                                    <div class="table-data__tool">
                                        <div class="table-data__tool-left">
                                            <h3 class="title-3 m-b-30">THIS MONTH REPORT</h3>
                                        </div>
                                        <div class="table-data__tool-right">
                                            <a href="monthly_reports.php" class="btn btn-primary">Past Months</a>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-top-campaign">
                                            <thead>
                                                <tr>
                                                    <th class='text-center'>Month #</th>
                                                    <th class='text-center'>Orders</th>
                                                    <th class='text-center'>Products</th>
                                                    <th class='text-center'>Sales</th>
                                                    <th class='text-center'>Costs</th>
                                                    <th class='text-center'>Earnings</th>
                                                    <th class='text-center'>Gross Profit</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $current_month = date('n');//Current Month Number
                                                    //Query Search Producs
                                                    $query_month = "SELECT COUNT(DISTINCT o.order_id) orders,
                                                                        COUNT(product_id*product_quantity) products,
                                                                        SUM(sale_price) sales,
                                                                        SUM(purchase_price) costs,
                                                                        SUM(sale_price-purchase_price) earnings,
                                                                        (SUM(sale_price-purchase_price)/SUM(sale_price))*100 profit
                                                                    FROM orders o INNER JOIN contain c ON o.order_id = c.order_id
                                                                    WHERE MONTH(order_date) = $current_month AND refund = 0";

                                                    if($r_month = mysqli_query($dbc, $query_month))//Save & Validate Query Results
                                                    {
                                                        $row_month = mysqli_fetch_array($r_month);//Present Users
                                                            print "
                                                            <tr>
                                                                <td class='text-center'>$current_month</td>
                                                                <td class='text-center'>$row_month[orders]</td>
                                                                <td class='text-center'>$row_month[products]</td>
                                                                <td class='text-center'>$$row_month[sales]</td>
                                                                <td class='text-center'>$$row_month[costs]</td>
                                                                <td class='text-center'>$$row_month[earnings]</td>
                                                                <td class='text-center'>$row_month[profit]%</td>
                                                            </tr>";
                                                    }
                                                    else
                                                        print'<p style="color:red">NO SE PUEDE MOSTRAR RECORD PORQUE:'.mysqli_error($dbc).'.</P>';
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END MONTH REPORT TABLE-->

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
