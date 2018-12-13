<!-- About Section -->
<div class="w3-content w3-justify w3-text-grey w3-padding-64" id="about">
    <h3 class="w3-text-light-grey"><strong>Admin Dashboard</strong></h3>
    <hr style="width:200px" class="w3-opacity">
    <p>
    </p>
    <?php
    $sidebars = $sidebars ?? array();
    foreach ($sidebars as $sidebar) {
        if (count($side_bar->sub_side_bar_array) !== 0) { ?>
            <div class="w3-quarter w3-section w3-light-grey">
                <h2><strong><?php echo $sidebar->name ?></strong></h2>
                <?php foreach ($side_bar->sub_side_bar_array as $side_bar_dropdown) { ?>
                    <hr>
                    <h4><a href="<?php $side_bar_dropdown->anchor_tag; ?>"><?php echo $side_bar_dropdown->name ?></a> </h4>
                    <hr>
                <?php } ?>
            </div>
        <?php }
    }
    ?>
    <div class="w3-quarter w3-section w3-light-grey">

    </div>


    <!-- End About Section -->
</div>
</div>


<!-- Footer -->
<footer class="w3-content w3-padding-64 w3-text-grey w3-xlarge">
    <a href="maintenance.html"><i class="fa fa-facebook-official w3-hover-opacity"></i></a>
    <a href="maintenance.html"></a><i class="fa fa-instagram w3-hover-opacity"></i></a>
    <a href="maintenance.html"><i class="fa fa-snapchat w3-hover-opacity"></i></a>
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