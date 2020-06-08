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
    <title>Add Product</title>

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
<?php
    if(isset($_POST['add']))
    {
        $errors = array();
        
        //Variables
        $brand = filter_input(INPUT_POST, 'brand');
        $description = filter_input(INPUT_POST, 'description');
        $weight = filter_input(INPUT_POST, 'weight');
        $grain = filter_input(INPUT_POST, 'grain');
        $sale_price = filter_input(INPUT_POST, 'sale_price');
        $purchase_price = filter_input(INPUT_POST, 'purchase_price');
        $quantity_stock = filter_input(INPUT_POST, 'quantity_stock');
        $quantity_sold = 0;
        $available = (int)$_POST['avaible'];
        
        //Validation
        if  (empty($brand))
            array_push($errors, 'Brand is require!');
        if  (empty($description))
            array_push($errors, 'Description is require!');
        if  (empty($weight))
            array_push($errors, 'Weight is require!');
        if  (empty($grain))
            array_push($errors, 'Grain is require!');
        if  (empty($sale_price))
            array_push($errors, 'Sale Price is require!');
        if  (empty($purchase_price))
            array_push($errors, 'Purchase Price is require!');
        if  (empty($quantity_stock))
            array_push($errors, 'Quantity is require!');
        if  (empty($available))
            $available = 0;
        
        if(count($errors) == 0)
        {
            //Query Insert Product
            $query = mysqli_query($dbc, "INSERT INTO product (brand_id, description, weight_id, grain_id, sale_price, purchase_price, quantity_stock, quantity_sold, available)
                VALUES ('$brand', '$description', '$weight', '$grain', '$sale_price', '$purchase_price', '$quantity_stock', '$quantity_sold', '$available')");
            
            if(mysqli_affected_rows($dbc) == 1)//Validate Insert
            {
                mysqli_close($dbc);
                header('Location: product_handling.php');
            }
            else
                echo '<script>alert("ERROR:The student could not be inserted.")</script>';
            
        }
    }
?>
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
                                            <li class="list-inline-item">ADD Product</li>
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
                                        <strong>ADD</strong> Product
                                    </div>
                                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                        <div class="card-body card-block">
                                            <!-- PRODUCT PICTURE -->
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">IMAGE</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="file" name="image_url" id="image_url" class="form-control">
                                                </div>
                                            </div>
                                            <!-- BRAND SELECT -->
                                            <?php
                                                //Query Brands
                                                $brand_query = "SELECT brand_id, brand_name
                                                                    FROM brand
                                                                    ORDER BY brand_name ASC";
                                                $brand_r = mysqli_query($dbc,$brand_query);//Save Query Results
                                            ?>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="select" class=" form-control-label">BRAND</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <select name="brand" id="brand" class="form-control">
                                                        <option value="0">Brand</option><!-- Default -->
                                                        <?php 
                                                            while($row=mysqli_fetch_array($brand_r))//Present All Brands
                                                            { 
                                                                print "<option value='$row[brand_id]'> $row[brand_name]</option>";
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- DESCRIPTION INPUT -->
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">DESCRIPTION</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" name="description" id="description" placeholder="Description" class="form-control">
                                                </div>
                                            </div>
                                            <!-- WEIGHT SELECT -->
                                            <?php
                                                //Query Weights
                                                $weight_query = "SELECT weight_id, weight_oz
                                                                    FROM weight
                                                                    ORDER BY weight_oz ASC";
                                            
                                                $weight_r = mysqli_query($dbc,$weight_query);//Save Query Result
                                            ?>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="select" class=" form-control-label">WEIGHT</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <select name="weight" id="weight" class="form-control">
                                                        <option value="0">Weight</option><!-- Default -->
                                                        <?php 
                                                            while($row=mysqli_fetch_array($weight_r))//Present Weights
                                                            { 
                                                                print "<option value='$row[weight_id]'> $row[weight_oz]</option>";
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- GRAIN SELECT -->
                                            <?php
                                                //Query Grain
                                                $grain_query = "SELECT grain_id, grain_type
                                                                    FROM grain";
                                            
                                                $grain_r = mysqli_query($dbc,$grain_query);//Save Query Results
                                            ?>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="select" class=" form-control-label">GRAIN</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <select name="grain" id="grain" class="form-control">
                                                        <option value="0">Grain</option><!-- Default -->
                                                        <?php 
                                                            while($row=mysqli_fetch_array($grain_r))//Present Grains
                                                            { 
                                                                print "<option value='$row[grain_id]'> $row[grain_type]</option>";
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- SALE PRICE INPUT -->
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">SALE PRICE</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input name="sale_price" id="sale_price" placeholder="Price" type="text" class="form-control" aria-required="true" aria-invalid="false">
                                                </div>
                                            </div>
                                            <!-- PURCHASE PRICE INPUT -->
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">COST PRICE</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input name="purchase_price" id="purchase_price" placeholder="Price" type="text" class="form-control" aria-required="true" aria-invalid="false">
                                                </div>
                                            </div>
                                            <!-- QUANTITY INPUT -->
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">IN STOCK</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input name="quantity_stock" id="quantity_stock" placeholder="Quantity" type="text" class="form-control" aria-required="true" aria-invalid="false">
                                                </div>
                                            </div>
                                            <!-- AVAIBLE SELECT -->
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="select" class=" form-control-label">AVAILABLE</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <select name="available" id="available" class="form-control">
                                                        <option value=0>No</option><!-- Default -->
                                                        <option value=1>Yes</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-success btn-sm" name="add">ADD</button>
                                            <button type="reset" class="btn btn-danger btn-sm">RESET</button>
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