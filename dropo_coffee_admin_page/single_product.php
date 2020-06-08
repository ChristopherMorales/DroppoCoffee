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
    <title>Update Product</title>

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
                                                <a href="product_handling.php">Product Handling</a>
                                            </li>
                                            <li class="list-inline-item seprate">
                                                <span>/</span>
                                            </li>
                                            <li class="list-inline-item">DETAILS Product</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END BREADCRUMB -->
            
            <!-- START FORM -->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-header">
                                        <strong>DETAILS</strong> Product
                                    </div>
                                    <form action="update_product.php" method="post" enctype="multipart/form-data" class="form-horizontal">
                                        <?php
                                            //Query Search Product
                                            $query = "SELECT *
                                                        FROM product p, brand b, weight w, grain g
                                                        WHERE (product_id = {$_GET['product_id']}) AND (p.brand_id = b.brand_id) AND (p.weight_id = w.weight_id) AND (p.grain_id = g.grain_id)";
                                            $r = mysqli_query($dbc,$query);//Make the Query
                                            $row = mysqli_fetch_array($r);//Save Query Result
                                        ?>
                                        <div class="card-body card-block">
                                            <!-- BRAND -->
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="select" class=" form-control-label">BRAND:</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                       <label for="select" class=" form-control-label"><?php echo $row['brand_name'] ?></label>
                                                </div>
                                            </div>
                                            <!-- DESCRIPTION -->
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="select" class=" form-control-label">DESCRIPTION:</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                       <label for="select" class=" form-control-label"><?php echo $row['description'] ?></label>
                                                </div>
                                            </div>
                                            <!-- WEIGHT -->
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="select" class=" form-control-label">WEIGHT:</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                       <label for="select" class=" form-control-label"><?php echo $row['weight_oz'] ?></label>
                                                </div>
                                            </div>
                                            <!-- GRAIN -->
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="select" class=" form-control-label">GRAIN:</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                       <label for="select" class=" form-control-label"><?php echo $row['grain_type'] ?></label>
                                                </div>
                                            </div>
                                            <!-- SALE PRICE -->
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="select" class=" form-control-label">SALE PRICE:</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                       <label for="select" class=" form-control-label"><?php echo $row['sale_price'] ?></label>
                                                </div>
                                            </div>
                                            <!-- COST PRICE -->
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="select" class=" form-control-label">COST PRICE:</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                       <label for="select" class=" form-control-label"><?php echo $row['purchase_price'] ?></label>
                                                </div>
                                            </div>
                                            <!-- QUANTITY IN STOCK -->
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="select" class=" form-control-label">IN STOCK:</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                       <label for="select" class=" form-control-label"><?php echo $row['quantity_stock'] ?></label>
                                                </div>
                                            </div>
                                            <!-- QUANTITY SOLD -->
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="select" class=" form-control-label">SOLD:</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                       <label for="select" class=" form-control-label"><?php echo $row['quantity_sold'] ?></label>
                                                </div>
                                            </div>
                                            <!-- AVAIBLE -->
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="select" class=" form-control-label">AVAILABLE:</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <?php
                                                        if($row['available'] ==  1)
                                                        {
                                                            print"<label for='select' class='form-control-label'>Yes</label>";
                                                        }
                                                           else
                                                           {
                                                                print"<label for='select' class='form-control-label'>No</label>";
                                                           }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END FORM -->
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