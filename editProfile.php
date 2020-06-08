<!DOCTYPE html>
<?php
include "conection.php";
require_once ('./php/component.php');
session_start();

?>

<html lang="en">
  <head>
    <title>Profile Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/ionicons.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">

    
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/profile.style.css">
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
            
            if(mysqli_query($con, $query_update_customer))
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
                    
                    if(mysqli_query($con, $query_insert_address))
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
                    
                    if(mysqli_query($con, $query_update_address))
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
                    
                    if(mysqli_query($con, $query_insert_payment))
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
                    
                    if(mysqli_query($con, $query_update_payment))
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
            header('Location: userProfile.php');
            mysqli_close($con);
            
        }
    }
?>
  <body class="goto-here">

<!--Nav-->
	<?php require_once ("php/header.php"); ?>
	<!--Nav end-->
<?php
      $customer_id = $_SESSION['customer_id'];
       $customer = $customer_id;//Save Customer ID
                                        //Query Search Customer
        $query_customer =  "SELECT *
                            FROM customer
                            WHERE customer_id = '$customer'";
        $r = mysqli_query($con,$query_customer);//Make the Query
        $row = mysqli_fetch_array($r);//Save Query Result
?>

<div class="main-content">
        <h2 class="mb-4">Manage Account</h2>
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-header">
                                        <strong>UPDATE</strong> Customer
                                    </div>
                                    <form action="editProfile.php" method="post" enctype="multipart/form-data" class="form-horizontal">
                                        <div class="card-body card-block">
                                            <?php
                                                //Query Search User
                                                $customer = $customer_id;
                                                $query_customer = "SELECT *
                                                                    FROM customer
                                                                    WHERE customer_id = '$customer'";
                                                $r = mysqli_query($con,$query_customer);//Make the Query
                                                $row = mysqli_fetch_array($r);//Save Query Result
                                            ?>
                                            <!-- NAME INPUT -->
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">NAME</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" name="name" id="name" value="<?php echo $row['name'] ?>" class="form-control" require>
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
                                                    <input type="email" name="email" id="email" value="<?php echo $row['email'] ?>" class="form-control">
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
                                                $r2 = mysqli_query($con,$query_address);//Make the Query
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
                                                $r3 = mysqli_query($con,$query_card);//Make the Query
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
                                                print"<input type ='hidden' name='customer_id' value='".$_SESSION['customer_id']."'>";
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
	

    
  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/bootstrap-datepicker.js"></script>
  <script src="js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="js/google-map.js"></script>
  <script src="js/main.js"></script>
    
  </body>
</html>
