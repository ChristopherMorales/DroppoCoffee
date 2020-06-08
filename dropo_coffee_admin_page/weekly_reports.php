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
    <title>Product Handling</title>

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
                                                <a href="index.php">Dashboard</a>
                                            </li>
                                            <li class="list-inline-item seprate">
                                                <span>/</span>
                                            </li>
                                            <li class="list-inline-item">Weekly Reports</li>
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
                            <div class="col-md-12">
                                <!-- DATA TABLE -->
                                <h3 class="title-5 m-b-35">Weekly Reports</h3>
                                <div class="table-data__tool">
                                    <div class="table-data__tool-left">
                                    </div>
                                    <div class="table-data__tool-right">
                                        <form action='weekly_reports.php' method='post'>
                                            <div class="rs-select2--light rs-select2--lg">
                                                <p>Select a week: <input type="week" name="aweek" class="form-control" min="2020-W14">
                                            </div>
                                            <div class="rs-select2--light rs-select2--sm">
                                                <button type="submit" name="submit" class="btn btn-primary">SUBMIT</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="table-responsive table--no-card m-b-30">
                                    <table class="table table-borderless table-striped table-earning">
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
                                                if(isset($_POST['submit']))
                                                {
                                                    $myweek = $_POST['aweek'];
                                                    $dweek = new DateTime($myweek);
                                                    $week = $dweek->format('W');

                                                    $query_week = "SELECT COUNT(DISTINCT o.order_id) orders,
                                                                        COUNT(product_id*product_quantity) products,
                                                                        SUM(sale_price) sales,
                                                                        SUM(purchase_price) costs,
                                                                        SUM(sale_price-purchase_price) earnings,
                                                                        (SUM(sale_price-purchase_price)/SUM(sale_price))*100 profit
                                                                    FROM orders o INNER JOIN contain c ON o.order_id = c.order_id
                                                                    WHERE WEEK(order_date,1) = $week AND refund = 0";

                                                    if($r_week = mysqli_query($dbc, $query_week))//Save & Validate Query Results
                                                    {
                                                        $row_week=mysqli_fetch_array($r_week);//Present Users
                                                        print "
                                                            <tr>
                                                                <td class='text-center'>$week</td>
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
                                                }
                                                else
                                                {
                                                    $ddate = "2020-4-1";
                                                    $date = new DateTime($ddate);
                                                    $start_week = $date->format("W");
                                                    $current_week = date('W');//Current Week Number
                                                    for ($i = $start_week; $i <= $current_week; $i++)
                                                    {
                                                        //Query Search Producs
                                                        $query_week = "SELECT COUNT(DISTINCT o.order_id) orders,
                                                                            COUNT(product_id*product_quantity) products,
                                                                            SUM(sale_price) sales,
                                                                            SUM(purchase_price) costs,
                                                                            SUM(sale_price-purchase_price) earnings,
                                                                            (SUM(sale_price-purchase_price)/SUM(sale_price))*100 profit
                                                                        FROM orders o INNER JOIN contain c ON o.order_id = c.order_id
                                                                        WHERE WEEK(order_date,1) = $i AND refund = 0";

                                                        if($r_week = mysqli_query($dbc, $query_week))//Save & Validate Query Results
                                                        {
                                                            $row_week=mysqli_fetch_array($r_week);//Present Users
                                                                print "
                                                                <tr>
                                                                    <td class='text-center'>$i</td>
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
                                                    }
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- END DATA TABLE -->
                                <?php
                                    if(isset($_POST['submit']))
                                    {
                                        print"<a href='weekly_reports.php' class='btn btn-primary'><i class='fa fa-list-ul'></i>&nbsp;Show All<a>";
                                    }
                                ?>
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