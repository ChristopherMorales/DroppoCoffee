<?php
    $query = "SELECT name, lastname
                FROM administrator
                WHERE admi_id={$_SESSION['login']}";
    $r = mysqli_query($dbc,$query);//Make the Query
    $row = mysqli_fetch_array($r);//Save Query Result
    
    print "<!-- START MENU SIDEBAR -->
        <aside class='menu-sidebar2'>
            <div class='logo'>
                <!-- LOGO PNG -->
            </div>
            <div class='menu-sidebar2__content js-scrollbar1'>
                <div class='account2'>
                    <div class='image img-cir img-120'>
                        <!-- ADMIN PICTURE -->
                    </div>
                    <h4 class='name'>$row[name] $row[lastname]</h4>
                    <a href='login/index.php'>Sign out</a>
                </div>
                <nav class='navbar-sidebar2'>
                    <ul class='list-unstyled navbar__list'>
                        <li>
                            <a href='index.php'>
                                <i class='fas'></i><h5>Manage Orders/Make Reports</h5></a>
                        </li>
                        <li>
                            <a href='product_handling.php'>
                                <i class='fas'></i><strong>Manage Products</strong></a>
                        </li>
                        <li>
                            <a href='administrators.php'>
                                <i class='fas'></i><strong>Manage Administrator</strong></a>
                        </li>
                        <li>
                            <a href='customers.php'>
                                <i class='fas'></i><strong>Manage Customer</strong></a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR -->";
?>