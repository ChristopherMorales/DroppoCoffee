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
<?php
    if(isset($_POST['update']))
    {
        $errors = array();
        
        $product_id = (int)$_POST['product_id'];
        $brand = filter_input(INPUT_POST, 'brand');
        $description = filter_input(INPUT_POST, 'description');
        $weight = filter_input(INPUT_POST, 'weight');
        $grain = filter_input(INPUT_POST, 'grain');
        $sale_price = filter_input(INPUT_POST, 'sale_price');
        $purchase_price = filter_input(INPUT_POST, 'purchase_price');
        $quantity = filter_input(INPUT_POST, 'quantity');
        $available = (int)$_POST['available'];
        
        echo "<script>alert('$avaible')</script>";
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
        if  (empty($quantity))
            array_push($errors, 'Quantity is require!');
        if  (empty($available))
            $available = 0;
           
        
        if(count($errors) == 0)
        {
            $query2 = "UPDATE product SET brand_id='$brand', description='$description', weight_id='$weight', grain_id='$grain', sale_price='$sale_price', purchase_price='$purchase_price', quantity_stock=$quantity, available='$available'
            WHERE product_id='$product_id'";
            
            if(mysqli_query($dbc, $query2))
            {
                header('Location: product_handling.php');
                mysqli_close($dbc);
            }
            else	  
                print '<p style="color:red;">No se pudo actualizar la información del estudiante ya que ocurrió el error:<br />' . mysqli_error($dbc);
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
                                            <li class="list-inline-item">UPDATE Product</li>
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
                                        <strong>UPDATE</strong> Product
                                    </div>
                                    <form action="update_product.php" method="post" enctype="multipart/form-data" class="form-horizontal">
                                        <?php
                                            //Query Search Product
                                            $query = "SELECT p.product_id, b.brand_id, b.brand_name, p.description, w.weight_id, w.weight_oz, g.grain_id, g.grain_type, p.sale_price, p.purchase_price, p.quantity_stock, p.available
                                                        FROM product p, brand b, weight w, grain g
                                                        WHERE (product_id = {$_GET['product_id']}) AND (p.brand_id = b.brand_id) AND (p.weight_id = w.weight_id) AND (p.grain_id = g.grain_id)";
                                            $r = mysqli_query($dbc,$query);//Make the Query
                                            $row = mysqli_fetch_array($r);//Save Query Result
                                        ?>
                                        <div class="card-body card-block">
                                            <!-- BRAND SELECT -->
                                            <?php
                                                //Query Brands
                                                $brand_query = "SELECT brand_id, brand_name
                                                                    FROM brand
                                                                    ORDER BY brand_name ASC";
                                                $brand_r = mysqli_query($dbc,$brand_query);//Make the Query
                                            ?>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="select" class=" form-control-label">BRAND</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <select name="brand" id="brand" class="form-control">
                                                        <?php
                                                            print "<option value='$row[brand_id]'> $row[brand_name]</option>";//Default
                                                            while($brand_row=mysqli_fetch_array($brand_r))//Present Brands
                                                            { 
                                                                print "<option value='$brand_row[brand_id]'> $brand_row[brand_name]</option>";
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
                                                    <input type="text" name="description" id="description" value="<?php echo $row['description'] ?>" class="form-control">
                                                </div>
                                            </div>
                                            <!-- WEIGHT SELECT -->
                                            <?php
                                                //Query Weights
                                                $weight_query = "SELECT weight_id, weight_oz
                                                                    FROM weight
                                                                    ORDER BY weight_oz ASC";
                                            
                                                $weight_r = mysqli_query($dbc,$weight_query);//Make the Query
                                            ?>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="select" class=" form-control-label">WEIGHT</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <select name="weight" id="weight" class="form-control">
                                                        <?php 
                                                            print "<option value='$row[weight_id]'> $row[weight_oz]</option>";//Default
                                                            while($weight_row=mysqli_fetch_array($weight_r))//Present Weights
                                                            { 
                                                                print "<option value='$weight_row[weight_id]'> $weight_row[weight_oz]</option>";
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- GRAIN SELECT -->
                                            <?php
                                                //Query Grains
                                                $grain_query = "SELECT grain_id, grain_type
                                                                    FROM grain";
                                            
                                                $grain_r = mysqli_query($dbc,$grain_query);//Make the Query
                                            ?>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="select" class=" form-control-label">GRAIN</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <select name="grain" id="grain" class="form-control">
                                                        <?php
                                                            print "<option value='$row[grain_id]'> $row[grain_type]</option>";//Default
                                                            while($grain_row=mysqli_fetch_array($grain_r))//Presents Grains
                                                            { 
                                                                print "<option value='$grain_row[grain_id]'> $grain_row[grain_type]</option>";
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
                                                    <input name="sale_price" id="sale_price" value="<?php echo $row['sale_price'] ?>" type="text" class="form-control" aria-required="true" aria-invalid="false">
                                                </div>
                                            </div>
                                            <!-- PURCHASE PRICE INPUT -->
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">COST PRICE</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input name="purchase_price" id="purchase_price" value="<?php echo $row['purchase_price'] ?>" type="text" class="form-control" aria-required="true" aria-invalid="false">
                                                </div>
                                            </div>
                                            <!-- QUANTITY INPUT -->
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">QUANTITY</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input name="quantity" id="quantity" value="<?php echo $row['quantity_stock'] ?>" type="text" class="form-control" aria-required="true" aria-invalid="false">
                                                </div>
                                            </div>
                                            <!-- AVAIBLE SELECT -->
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="select" class=" form-control-label">AVAIBLE</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <select name="available" id="available" class="form-control">
                                                        <?php
                                                            if($row[avaible] == 1)
                                                            {
                                                                print "<option value='$row[available]'>Yes</option>";//Default
                                                                print "<option value='0'>No</option>";
                                                            }
                                                            else
                                                            {
                                                                print "<option value='$row[available]'>No</option>";//Default
                                                                print "<option value='1'>Yes</option>";
                                                            }
                                                            //print "<option value='$row[avaible]'> $row[avaible]</option>";//Default
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-success btn-sm" name="update">UPDATE</button>
                                            <?php
                                                print"<input type ='hidden' name='product_id' value='".$_GET['product_id']."'>"
                                            ?>
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