<?php

function component($productname, $productprice, $productimg, $productid){

    $element = "
    
    <div class=\"col-md-3 col-sm-6 my-3 my-md-0\">
                <form action=\"shop.php\" method=\"post\">
                    <div class=\"card shadow\">
                        <div>
                            <img src=\"$productimg\" alt=\"Image1\" class=\"img-fluid card-img-top\">
                        </div>
                        <div class=\"card-body\">
                            <h5 class=\"card-title\">$productname</h5>
                            <p class=\"card-text\">
                                Some quick example text to build on the card.
                            </p>
                            <h5>
                                <span class=\"price\">$$productprice</span>
                            </h5>
                            <button type=\"submit\" class=\"btn btn-warning my-3\" name=\"add\">Go to Shop <i class=\"fas fa-shopping-cart\"></i></button>
                             <input type='hidden' name='product_id' value='$productid'>
                        </div>
                    </div>
                </form>
            </div>
    ";
    echo $element;
}
/* function addToCart($productid){
    $element = "
    <section>
    <div>
        <form action=\"index.php\" method=\"post\">
            <button type=\"submit\" name=\"add\" >Add to Cart <i class=\"fas fa-shopping-cart\"></i></button>
            <input type='hidden' name='product_id' value='$productid'>
        </form>
    </div>
    </section>
    ";
    echo $element;
} */

function cartElement($productimg, $productname, $productprice, $productid){
    $element = "
    
    <form action=\"cart.php?action=remove&id=$productid\" method=\"post\" class=\"cart-items\">
                    <div class=\"border rounded\">
                        <div class=\"row bg-white\">
                            <div class=\"col-md-3 pl-0\">
                                <img src=$productimg alt=\"Image1\" class=\"img-fluid\">
                            </div>
                            <div class=\"col-md-6\">
                                <h5 class=\"pt-2\">$productname</h5>
                                <small class=\"text-secondary\">Seller:LoMejorDePR</small>
                                <h5 class=\"pt-2\">$$productprice</h5>
                                <button type=\"submit\" class=\"btn btn-danger mx-2\" name=\"remove\">Remove</button>
                            </div>
                            <div class=\"col-md-3 py-5\">
                                <div>
                                    <button type=\"button\" class=\"btn bg-light border rounded-circle\"><i class=\"fas fa-minus\"></i></button>
                                    <input type=\"text\" value=\"1\" class=\"form-control w-25 d-inline\">
                                    <button type=\"button\" class=\"btn bg-light border rounded-circle\"><i class=\"fas fa-plus\"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
    
    ";
    echo  $element;
}

/* function singleProduct($productname, $productprice, $productimg){
    $element = "  
    <section class=\"ftco-section\">
    <div class=\"container\ \">
        <div class=\"row\">
            <div class=\"col-lg-6 mb-5 ftco-animate\">
                <a href=\"$productimg\" class=\"image-popup\"><img src=\"$productimg\" class=\"img-fluid\" alt=\"Colorlib Template\"></a>
            </div>
            <div class=\"col-lg-6 product-details pl-md-5 ftco-animate\">
                <h3>$productname</h3>
           
                <p class=\"price\"><span>$ $productprice</span></p>
                <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth. Text should turn around and return to its own, safe country. But nothing the copy said could convince her and so it didn’t take long until.
                    </p>
                    <div class=\"row mt-4\">
                        <div class=\"col-md-6\">
                            <div class=\"form-group d-flex\">
                  <div class=\"select-wrap\">
                  <div class=\"icon\"><span class=\"ion-ios-arrow-down\"></span></div>
                  <select name=\"\" id=\"\" class=\"form-control\">
                      <option value=\"\">Small</option>
                    <option value=\"\">Medium</option>
                    <option value=\"\">Large</option>
                    <option value=\"\">Extra Large</option>
                  </select>
                </div>
                </div>
                        </div>
                        <div class=\"w-100\"></div>
                        <div class=\"input-group col-md-6 d-flex mb-3\">
                 <span class=\"input-group-btn mr-2\">
                    <button type=\"button\" class=\"quantity-left-minus btn\"  data-type=\"minus\" data-field=\"\">
                   <i class=\"ion-ios-remove\"></i>
                    </button>
                    </span>
                 <input type=\"text\" id=\"quantity\" name=\"quantity\" class=\"form-control input-number\" value=\"1\" min=\"1\" max=\"100\">
                 <span class=\"input-group-btn ml-2\">
                    <button type=\"button\" class=\"quantity-right-plus btn\" data-type=\"plus\" data-field=\"\">
                     <i class=\"ion-ios-add\"></i>
                 </button>
                 </span>
              </div>
              <p><a href=\"cart.php\" class=\"btn btn-black py-3 px-5\">Add to Cart</a></p>
          </div>
            </div>
        </div>
    </div>
</section>
    ";
    echo $element;
} */

/* function checkoutElement($productimg, $productname, $productprice, $productid){
    $element = "
    
    <form action=\"cart.php?action=remove&id=$productid\" method=\"post\" class=\"cart-items\">
                    <div class=\"border rounded\">
                        <div class=\"row bg-white\">
                            <div class=\"col-md-3 pl-0\">
                                <img src=$productimg alt=\"Image1\" class=\"img-fluid\">
                            </div>
                            <div class=\"col-md-6\">
                                <h5 class=\"pt-2\">$productname</h5>
                                <small class=\"text-secondary\">Seller: dailytuition</small>
                                <h5 class=\"pt-2\">$$productprice</h5>
                            </div>
                        </div>
                    </div>
                </form>
    
    ";
    echo  $element;
}
 */