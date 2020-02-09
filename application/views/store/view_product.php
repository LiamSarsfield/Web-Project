<!-- About Section -->
<div class="w3-content w3-justify w3-text-grey w3-padding-64" id="about">
    <div class="container">
        <div class="w3-justify w3-half" style="float: right; clear: both; margin-top: 1px;">
            <div class="w3-half" style="float:right; margin-top: 0px; border: 1px solid  lightgray; padding: 1%;">
                <form method="POST"
                      action="<?php echo base_url(); ?>index.php/Shopping_cart/add_product_to_shopping_cart/<?php echo $product->product_id ?>">
                    <!--                  <p>Quantity: <select name="qty">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                  </select>-->
                    <button class="w3-small" style="float: right;">
                        <i class="fa fa-cart-plus w3-xxlarge"></i>
                        <br>ADD TO CART&nbsp;&nbsp;&nbsp;
                        <!--              <select name="qty">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                      </select>-->

                    </button>
                    <!--                  </p>     -->
                    </a>
                    <br>
                    <p>Quantity: <select name="qty">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                        </select>

                        <br>
                    <h2 style="color: green;">
                        <strong>In stock!</strong>
                    </h2>
                    <!--            <h3>Deliver to: </h3>
                                <p>Sam Harriman</p>
                                <p>LIT, Mainstreet</p>
                                <p>Limerick</p>-->
                </form>
            </div>
            <div>
                <h1>
                    <strong>Specs</strong>
                </h1>
                <br>
                <h5 style="max-width: 190px;">
                    <?php echo $product->specs ?>

                </h5>
                <br>
            </div>
        </div>

        <br>

    </div>

    <div class="w3-half" style="border-right: 1px solid  lightgray; padding-right: 10%;">
        <h1><?php echo $product->name ?></h1>
        <p>
            <em><?php echo $product->description ?></em>
        </p>
        <br>
        <img src="<?php echo base_url() . $product->image_path ?>" alt="circuit_board" width="400px">

    </div>
</div>


<!-- Footer
<footer class="w3-content w3-padding-64 w3-text-grey w3-xlarge">
  <a href="maintenance.html">
    <i class="fa fa-facebook-official w3-hover-opacity"></i>
  </a>
  <a href="maintenance.html"></a>
  <i class="fa fa-instagram w3-hover-opacity"></i>
  </a>
  <a href="maintenance.html">
    <i class="fa fa-snapchat w3-hover-opacity"></i>
  </a>
  <p class="w3-medium">Midwest Electronics </p>
  <!-- End footer -->
<!-- </footer> -->

<!-- END PAGE CONTENT -->
</div>


<script>

    function openNav() {
        var x = document.getElementById("mySidenav");
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }


    var dropdown = document.getElementsByClassName("dropdown-btn");
    var i;

    for (i = 0; i < dropdown.length; i++) {
        dropdown[i].addEventListener("click", function () {
            this.classList.toggle("active");
            var dropdownContent = this.nextElementSibling;
            if (dropdownContent.style.display === "block") {
                dropdownContent.style.display = "none";
            } else {
                dropdownContent.style.display = "block";
            }
        });
    }


</script>
</body>

</html>