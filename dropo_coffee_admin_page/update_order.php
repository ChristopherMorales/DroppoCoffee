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
        
        $order_id = (int)$_POST['order_id'];
        $status = $_POST['status'];
           
      $query2 = "UPDATE orders SET status_id='$status'
                    WHERE order_id='$order_id'";
            
        if(mysqli_query($dbc, $query2))
        {
            header('Location: orders.php');
            mysqli_close($dbc);
        }
        else	  
            print '<p style="color:red;">No se pudo actualizar la información del estudiante ya que ocurrió el error:<br />' . mysqli_error($dbc);
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
                                                <a href="orders.php">Orders</a>
                                            </li>
                                            <li class="list-inline-item seprate">
                                                <span>/</span>
                                            </li>
                                            <li class="list-inline-item">UPDATE Order</li>
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
                                        <strong>UPDATE</strong> Order
                                    </div>
                                    <form action="update_order.php" method="post" enctype="multipart/form-data" class="form-horizontal">
                                        <?php
                                            //Query Search Product
                                            $query = "SELECT order_id, track_number, status_name
                                                                    FROM orders o, STATUS s
                                                                    WHERE o.status_id = s.status_id AND order_id = {$_GET['order_id']}";
                                            $r = mysqli_query($dbc,$query);//Make the Query
                                            $row = mysqli_fetch_array($r);//Save Query Result
                                        ?>
                                        <div class="card-body card-block">
                                            <!-- ORDER ID -->
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">ORDER ID</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <label for="text-input" class=" form-control-label"><?php echo $row['order_id'] ?></label>
                                                </div>
                                            </div>
                                            <!-- TRACK NUMBER -->
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">TRACK #</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <label for="text-input" class=" form-control-label"><?php echo $row['track_number'] ?></label>
                                                </div>
                                            </div>
                                            <!-- STATUS SELECT -->
                                            <?php
                                                //Query Grains
                                                $status_query = "SELECT *
                                                                    FROM status";
                                            
                                                $status_r = mysqli_query($dbc,$status_query);//Make the Query
                                            ?>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="select" class=" form-control-label">STATUS</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <select name="status" id="status" class="form-control">
                                                        <?php
                                                            print "<option value='$row[status_id]'> $row[status_name]</option>";//Default
                                                            while($status_row=mysqli_fetch_array($status_r))//Presents Grains
                                                            { 
                                                                print "<option value='$status_row[status_id]'> $status_row[status_name]</option>";
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-success btn-sm" name="update">UPDATE</button>
                                            <?php
                                                print"<input type ='hidden' name='order_id' value='".$_GET['order_id']."'>"
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