<!DOCTYPE php>
<php>
    <title>W3.CSS Template</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assests/CSS/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <body class="w3-black">

    <!-- Icon Bar (Sidebar - hidden on small screens) -->
    <nav class="w3-sidebar w3-bar-block w3-small w3-hide-small w3-center">
        <!-- Avatar image in top left corner -->
        <a href="<?php echo site_url() ?>/Home/index"><img src="<?php echo base_url(); ?>/assests/Images/MweLogo.png"
                                                           style="width:100%"></a>

        <span style="font-size:30px;cursor:pointer" onclick="openNav()"
              class="w3-bar-item  w3-button w3-padding-large w3-hover-black">&#9776;</span>


            <?php foreach ($side_bars as $side_bar) { ?>
        <div id="mySidenav" class="sidenav"  style="display: none;">
                <a href="<?php echo site_url() . $side_bar->anchor_tag; ?>"
                   class="w3-bar-item w3-button w3-padding-large w3-hover-black">
                    <i class="<?php echo $side_bar->class ?>"></i>
                    <p><?php echo $side_bar->name; ?></p>
                </a>
        </div>
            <?php } ?>
        

    </nav>


    <!-- Navbar on small screens (Hidden on medium and large screens) -->
    <div class="w3-top w3-hide-large w3-hide-medium" id="myNavbar">
        <div class="w3-bar w3-black w3-opacity w3-hover-opacity-off w3-center w3-small">
            <a href="index.php" class="w3-bar-item w3-button" style="width:25% !important">HOME</a>
            <a href="login.php" class="w3-bar-item w3-button" style="width:25% !important">Login</a>
            <a href="signUp.php" class="w3-bar-item w3-button" style="width:25% !important">Sign Up</a>
        </div>
    </div>

    <!-- Contact Section -->
    <div class="w3-padding-64 w3-content w3-text-grey" id="contact">
        <h2 class="w3-text-light-grey">Login</h2>
        <hr style="width:200px" class="w3-opacity">


        <form action="/action_page.php" target="_blank">
            <p><input class="w3-input w3-padding-16" type="text" placeholder="Email" required name="Email"></p>
            <p><input class="w3-input w3-padding-16" type="password" placeholder="Password" required name="Pass"></p>
            <button class="w3-button w3-light-grey w3-padding-large" type="submit">
                <i class="fa fa-paper-plane"></i> Login
            </button>
            </p>
        </form>
        <!-- End Contact Section -->
    </div>

    <!-- Footer -->
    <footer class="w3-content w3-padding-64 w3-text-grey w3-xlarge">
        <a href="<?php echo site_url() ?>/Home/maintenance"><i class="fa fa-facebook-official w3-hover-opacity"></i></a>
        <a href="<?php echo site_url() ?>/Home/maintenance"></a><i class="fa fa-instagram w3-hover-opacity"></i></a>
        <a href="<?php echo site_url() ?>/Home/maintenance"><i class="fa fa-snapchat w3-hover-opacity"></i></a>
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


    </script>
    </body>
</php>