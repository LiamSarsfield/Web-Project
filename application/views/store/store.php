    <!-- About Section -->
    <div class="w3-content w3-justify w3-text-grey w3-padding-64" id="about">
        <h3 class="w3-text-light-grey">
            <strong>Circuit Boards</strong>
        </h3>
        <hr style="width:200px" class="w3-opacity">
        <p>
        </p>

        <div class="w3-row w3-center w3-padding-16 w3-sectiFFon">

            <?php
            //If no details found
            if ($query == false) {
                echo "<p><em>Sorry, no items to display.</em></p>";
            } else {
                foreach ($query as $row) {
//                                $tag = '/Web-Project/index.php/Store/view_selected_product/'.$row->product_id;
                    echo '<div class="w3-quarter w3-section w3-light-grey" style="margin-right:5%; padding: 2%; max-width: 30%;">';
                    echo '<span class="w3-xlarge"><a href="product_view.html"><img src=' . base_url() . $row->image_path . ' width="200px"></a></span><br>';
                    echo "<strong>$row->name</strong><hr>";
                    echo "<em>$row->description</em><hr>";
                    echo "<strong>€$row->price</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ";
                    echo "<a href=" . '/Web-Project/index.php/Store/view_selected_product/' . $row->product_id . "><button>View</button></a>";
                    echo '</div>';

                }
            }
            ?>
            <!-- End About Section -->
        </div>
    </div>


    <!-- End About Section -->
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
</body>

</html>