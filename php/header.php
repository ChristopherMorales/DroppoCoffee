<style>

/* Header/Logo Title */
.header {
  padding: 10px;
  text-align: center;
  background: white;
  color: white;
  font-size: 30px;
}
</style>

<header class = "header" id="header">
<!--New nav-->
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
          <a class="navbar-brand" href="index.php">Dropo. Coffee</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
          </button>
			
		  
          <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">	
              <li class="nav-item"><a href="shop.php" class="nav-link">Shop</a></li>
			  <li class="nav-item"><a href="about.php" class="nav-link">About</a></li>
			  <li class="nav-item"><a href="./Login_v14/index.php" class="nav-link">LOGOUT</a></li>
              <li class="nav-item"><a href="./userProfile.php" class="nav-link">PROFILE</a></li>
              <li class="nav-item cta cta-colored"><a href="cart.php" class="nav-link"><span class="icon-shopping_cart"></span>
              <?php
            if (isset($_SESSION['cart_array'])){
                $count = count($_SESSION['cart_array']);
                echo "<span id=\"cart_count\" class=\"text-warning bg-light\">$count</span>";
            }else{
                echo "<span id=\"cart_count\" class=\"text-warning bg-light\">0</span>";
            }
            ?>
              </a></li>
            </ul>
          </div>
        </div>
      </nav>
    <!--New nav end-->


</header>












