<?php
    $dbc = @mysqli_connect('localhost','root','','dropo_coffee_db')
        OR die('No se pudo conectar a la base de datos'.mysqli_connect_error());
    
        session_start(); 
        
        session_destroy(); 
        
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
    <title>Sign Up</title>

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
<?php
    if(isset($_POST['add']))
    {
        $errors = array();
        
        //Variables
        $name = filter_input(INPUT_POST, 'name');
        $lastname = filter_input(INPUT_POST, 'lastname');
        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password');
        
        //Validation
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
            //Query Add Customer
            $query = mysqli_query($dbc, "INSERT INTO customer (name, lastname, email, password)
                VALUES ('$name', '$lastname', '$email', '$password')");
            
            if(mysqli_affected_rows($dbc) == 1)//Validate Insert
            {
                echo "<script>alert('Account Created! )</script>";

                mysqli_close($dbc);
                header('Location: ./Login_v14/index.php');
            }
            else
                echo '<script>alert("ERROR:The customer could not be inserted.")</script>';
        }
    }
?>
<body class="animsition">
    <div class="page-wrapper">

        <!-- START PAGE CONTAINER -->
        <div class="page-container2"> 
            <!-- START FORM -->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-header">
                                        Sign Up
                                    </div>
                                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                        <div class="card-body card-block">
                                            <!-- NAME INPUT -->
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">NAME</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" name="name" id="name" placeholder="name" class="form-control">
                                                </div>
                                            </div>
                                            <!-- LASTNAME INPUT -->
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">LASTNAME</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input name="lastname" id="lastname" placeholder="last name" type="text" class="form-control" aria-required="true" aria-invalid="false">
                                                </div>
                                            </div>
                                            <!-- EMAIL INPUT -->
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">EMAIL</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input name="email" id="email" placeholder="email" type="text" class="form-control" aria-required="true" aria-invalid="false">
                                                </div>
                                            </div>
                                            <!-- PASSWORD INPUT -->
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">PASSWORD</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input name="password" id="password" placeholder="password" type="text" class="form-control" aria-required="true" aria-invalid="false">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-success btn-sm" name="add">Sign Up</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

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
