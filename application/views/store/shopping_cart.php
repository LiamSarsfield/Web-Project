<!-- About Section -->
<div class="w3-content w3-justify w3-text-grey w3-padding-64" id="about">
    <!-- <h2 class="w3-text-light-grey">About our Company</h2> -->
    <hr style="width:200px" class="w3-opacity">

    <div class="w3-row w3-center w3-padding-16 w3-section w3-light-grey">
        <table style="padding: 1%; margin-bottom: 1%;">
            <th></th>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total Price</th>
            <th>Action</th>

            <!-- quantity checker todo -->

            <?php
            //If no details found
            if ($shopping_cart_items == false) {
                echo "<p><em>You have no items in your basket.</em></p>";
                echo '<a href="' . base_url() . 'index.php/Store/view_store"><button>Continue shopping</button></a><br><br>';
            } else {
                echo '<a href="' . base_url() . 'index.php/Store/view_store"><button>Continue shopping</button></a><br><br>';
                foreach ($shopping_cart_items as $row) {
                    echo '<tr>';
                    echo '<td style="">';
//         echo '<img src="'.base_url().'/assets/images/cb.jpg" alt="product picture"'.$row->product_name.'" width="100px">';
                    echo '<img src="' . base_url() . $row->image_path . '" alt="product picture"' . $row->name . '" width="100px">';

                    echo '</td>';
                    echo '<td>' . $row->name . '</td>';
                    echo '<td>' . $row->description . '</td>';
                    echo '<td><center>€' . $row->price . '</center></td>';
                    echo '<td><center>' . $row->quantity . '</center></td>';
                    echo '<td><center>€' . ($row->price) * ($row->quantity) . '</center></td>';
                    echo '<td>';
                    echo '<a href="' . base_url() . 'index.php/Shopping_cart/remove_product_from_cart/' . $row->product_id . '"><button>Remove</button></a>';
                    echo '</td>';
                }
            }
            ?>
        </table>

        <button class="w3-bar-item w3-button w3-padding-large w3-hover-black">
            <a href="<?php echo base_url() ?>index.php/Store/checkout"
               class="w3-bar-item w3-button w3-hover-black">
                <i class="
              fa fa-credit-card w3-xxlarge"></i>
                <p>
                    <strong>CHECKOUT</strong>
                </p>
            </a>
        </button>
    </div>


    <!-- Footer -->
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
    </footer>

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