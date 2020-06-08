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
        
        //Variables
        $customer_id = (int)$_POST['customer_id'];
        $name = filter_input(INPUT_POST, 'name');
        $lastname = filter_input(INPUT_POST, 'lastname');
        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password');
        
        $address_id = (int)$_POST['address_id'];
        $street1 = filter_input(INPUT_POST, 'street1');
        $street2 = filter_input(INPUT_POST, 'street2');
        $city = filter_input(INPUT_POST, 'city');
        $state = filter_input(INPUT_POST, 'state');
        $zip = filter_input(INPUT_POST, 'zip');
        $country = filter_input(INPUT_POST, 'country');
        
        $payment_id = (int)$_POST['payment_id'];
        $card_name = filter_input(INPUT_POST, 'card_name');
        $card_number = filter_input(INPUT_POST, 'card_number');
        $exp_month = filter_input(INPUT_POST, 'exp_month');
        $exp_year = filter_input(INPUT_POST, 'exp_year');
        $ccv = filter_input(INPUT_POST, 'ccv');
        
        $flag = TRUE;
        
        //Validation INFO Customer
        if  (empty($name))
            array_push($errors, 'Name is require!');
        if  (empty($lastname))
            array_push($errors, 'Lastname is require!');
        if  (empty($email))
            array_push($errors, 'Email is require!');
        if  (empty($password))
            array_push($errors, 'Password is require!');
        
        if(count($errors) == 0)
        {
            //Query Update Customer
            $query_update_customer = "UPDATE customer SET name='$name', lastname='$lastname', email='$email', password='$password'
            WHERE customer_id='$customer_id'";
            
            if(mysqli_query($dbc, $query_update_customer))
            {
                $flag = TRUE;
            }
            else
            {
                $flag = FALSE;
            }
            
            //******************* ADDRESS UPDATE AND INSERT *******************//
            if(!empty($street1) or !empty($street2) or !empty($city) or !empty($state) or !empty($zip) or !empty($country))
            {
                if(empty($address_id))
                {
                    //Query Insert Address
                    $query_insert_address = "INSERT INTO shipping_address (customer_id, street1, street2, city, state, zip, country)
                                    VALUES ('$customer_id', '$street1', '$street2', '$city', '$state', '$zip', '$country')";
                    
                    if(mysqli_query($dbc, $query_insert_address))
                    {
                        $flag = TRUE;
                    }
                    else
                    {
                        $flag = FALSE;
                    }
                }
                else
                {
                    //Query Update Address
                    $query_update_address = "UPDATE shipping_address SET street1='$street1', street2='$street2', city='$city', state='$state', zip='$zip', country='$country'
                    WHERE customer_id='$customer_id'";
                    
                    if(mysqli_query($dbc, $query_update_address))
                    {
                        $flag = TRUE;
                    }
                    else
                    {
                        $flag = FALSE;
                    }
                }
            }
            //******************* PAYMENT UPDATE AND INSERT *******************//
            if(!empty($card_name) and !empty($card_number) and !empty($exp_month) and !empty($exp_year) and !empty($ccv))
            {
                if(empty($payment_id))
                {
                    //Query Insert Payment Method
                    $query_insert_payment = "INSERT INTO payment_method (customer_id, card_name, card_number, exp_month, exp_year, ccv)
                                    VALUES ('$customer_id', '$card_name', '$card_number', '$exp_month', '$exp_year', '$ccv')";
                    
                    if(mysqli_query($dbc, $query_insert_payment))
                    {
                        $flag = TRUE;
                    }
                    else
                    {
                        $flag = FALSE;
                    }
                }
                else
                {
                    //Query Update Payment Method
                    $query_update_payment = "UPDATE payment_method SET card_name='$card_name', card_number='$card_number', exp_month='$exp_month', exp_year='$exp_year', ccv='$ccv'
                    WHERE customer_id='$customer_id'";
                    
                    if(mysqli_query($dbc, $query_update_payment))
                    {
                        $flag = TRUE;
                    }
                    else
                    {
                        $flag = FALSE;
                    }
                }   
            }  
        }
        
        if($flag == TRUE)
        {
            //Back Customers Main Page
            header('Location: customers.php');
            mysqli_close($dbc);
            
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
                                                <a href="customers.php">Customer</a>
                                            </li>
                                            <li class="list-inline-item seprate">
                                                <span>/</span>
                                            </li>
                                            <li class="list-inline-item">UPDATE Customer</li>
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
                                        <strong>UPDATE</strong> Customer
                                    </div>
                                    <form action="update_customer.php" method="post" enctype="multipart/form-data" class="form-horizontal">
                                        <div class="card-body card-block">
                                            <?php
                                                //Query Search User
                                                $customer = $_GET['customer_id'];
                                                $query_customer = "SELECT *
                                                                    FROM customer
                                                                    WHERE customer_id = '$customer'";
                                                $r = mysqli_query($dbc,$query_customer);//Make the Query
                                                $row = mysqli_fetch_array($r);//Save Query Result
                                            ?>
                                            <!-- NAME INPUT -->
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">NAME</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" name="name" id="name" value="<?php echo $row['name'] ?>" class="form-control">
                                                </div>
                                            </div>
                                            <!-- LASTNAME INPUT -->
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">LASTNAME</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" name="lastname" id="lastname" value="<?php echo $row['lastname'] ?>" class="form-control">
                                                </div>
                                            </div>
                                            <!-- EMAIL INPUT -->
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">EMAIL</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" name="email" id="email" value="<?php echo $row['email'] ?>" class="form-control">
                                                </div>
                                            </div>
                                            <!-- PASSWORD INPUT -->
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">PASSWORD</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" name="password" id="password" value="<?php echo $row['password'] ?>" class="form-control">
                                                </div>
                                            </div>
                                            <?php
                                                //Query Search Address
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
                                            <!-- STREET1 INPUT -->
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label" style="text-indent : 2em;">STREET 1</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" name="street1" id="street1" value="<?php echo $row2['street1'] ?>" class="form-control">
                                                </div>
                                            </div>
                                            <!-- STREET2 INPUT -->
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label" style="text-indent : 2em;">STREET 2</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" name="street2" id="street2" value="<?php echo $row2['street2'] ?>" class="form-control">
                                                </div>
                                            </div>
                                            <!-- CITY INPUT -->
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label" style="text-indent : 2em;">CITY</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" name="city" id="city" value="<?php echo $row2['city'] ?>" class="form-control">
                                                </div>
                                            </div>
                                            <!-- STATE INPUT -->
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label" style="text-indent : 2em;">STATE</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" name="state" id="state" value="<?php echo $row2['state'] ?>" class="form-control">
                                                </div>
                                            </div>
                                            <!-- ZIPCODE INPUT -->
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label" style="text-indent : 2em;">ZIPCODE</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" name="zip" id="zip" value="<?php echo $row2['zip'] ?>" class="form-control">
                                                </div>
                                            </div>
                                            <!-- COUNTRY INPUT -->
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label" style="text-indent : 2em;">COUNTRY</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" name="country" id="country" value="<?php echo $row2['country'] ?>" class="form-control">
                                                </div>
                                            </div>
                                            <?php
                                                //Query Search Payment Method
                                                $query_card = "SELECT *
                                                            FROM payment_method
                                                            WHERE customer_id = '$customer'";
                                                $r3 = mysqli_query($dbc,$query_card);//Make the Query
                                                $row3 = mysqli_fetch_array($r3);//Save Query Result
                                            ?>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="hf-password" class=" form-control-label">PAYMENT</label>
                                                </div>
                                            </div>
                                            <!-- CARD NAME INPUT -->
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label" style="text-indent : 2em;">NAME</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" name="card_name" id="card_name" value="<?php echo $row3['card_name'] ?>" class="form-control">
                                                </div>
                                            </div>
                                            <!-- CARD NUMBER INPUT -->
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label" style="text-indent : 2em;">NUMBER</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" name="card_number" id="card_number" value="<?php echo $row3['card_number'] ?>" class="form-control">
                                                </div>
                                            </div>
                                            <!-- EXP MONTH INPUT -->
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label" style="text-indent : 2em;">MONTH</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" name="exp_month" id="exp_month" value="<?php echo $row3['exp_month'] ?>" class="form-control">
                                                </div>
                                            </div>
                                            <!-- EXP YEAR INPUT -->
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label" style="text-indent : 2em;">YEAR</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" name="exp_year" id="exp_year" value="<?php echo $row3['exp_year'] ?>" class="form-control">
                                                </div>
                                            </div>
                                            <!-- CCV INPUT -->
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label" style="text-indent : 2em;">CCV</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" name="ccv" id="ccv" value="<?php echo $row3['ccv'] ?>" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-success btn-sm" name="update">UPDATE</button>
                                            <?php
                                                //GET ID's 
                                                print"<input type ='hidden' name='customer_id' value='".$_GET['customer_id']."'>";
                                                print"<input type ='hidden' name='address_id' value='".$row2['address_id']."'>";
                                                print"<input type ='hidden' name='payment_id' value='".$row3['payment_id']."'>";
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