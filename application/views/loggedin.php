<!DOCTYPE php>
<php>
    <title>W3.CSS Template</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assests/CSS/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript" src="<?php echo base_url(); ?>/assests/script/navs.js"></script>
    <body class="w3-black">

    <!-- Icon Bar (Sidebar - hidden on small screens) -->
    <nav class="w3-sidebar w3-bar-block w3-small w3-hide-small w3-center">
        <!-- Avatar image in top left corner -->
        <a href="<?php echo site_url() ?>/Customer/loggedIn"><img
                    src="<?php echo base_url(); ?>/assests/Images/MweLogo.png" style="width:100%"></a>

        <span style="font-size:30px;cursor:pointer" onclick="openNav()"
              class="w3-bar-item  w3-button w3-padding-large w3-hover-black">&#9776;</span>

            <?php foreach ($side_bars as $side_bar) {
                //if the side bar is a drop down or not
                if (count($side_bar->sub_side_bar_array) == 0) { ?>
                        <div id="mySidenav" class="sidenav" style="display: none;">
                            <a href="<?php echo site_url() . $side_bar->anchor_tag; ?>"
                               class="w3-bar-item w3-button w3-padding-large w3-hover-black">
                                <i class="<?php echo $side_bar->class ?>"></i>
                                <p><?php echo $side_bar->name; ?></p>
                            </a>
                        </div>
               <?php } else { ?>
                    <button onclick="dropdown()"
                            class="dropdown-btn w3-bar-item w3-button w3-hover-black w3-bar-item w3-button w3-padding-large w3-hover-black">
                        <i class="<?php echo $side_bar->class ?>"></i>
                        <p><?php echo $side_bar->name; ?></p>
                    </button>
                    <div class="dropdown-container">
                        <?php foreach ($side_bar->sub_side_bar_array as $side_bar_dropdown) { ?>
                            <a href="<?php echo site_url() . $side_bar_dropdown->anchor_tag ?>"
                               class="<?php echo $side_bar_dropdown->class ?>">
                                <p><?php echo $side_bar_dropdown->name; ?></p></a>
                        <?php } ?>
                    </div>
                <?php }
                ?>


            <?php } ?>

            <a href="<?php echo site_url() ?>/Home/Index" class="w3-bar-item w3-button w3-padding-large w3-hover-black">
                <i class="fa fa-rotate-left w3-xxlarge"></i>
                <p>Logout</p>
            </a>
        </div>

    </nav>


    <!-- Navbar on small screens (Hidden on medium and large screens) -->
    <div class="w3-top w3-hide-large w3-hide-medium" id="myNavbar">
        <div class="w3-bar w3-black w3-opacity w3-hover-opacity-off w3-center w3-small">
            <a href="#" class="w3-bar-item w3-button" style="width:25% !important">HOME</a>
            <a href="#about" class="w3-bar-item w3-button" style="width:25% !important">ABOUT</a>

            <a href="#contact" class="w3-bar-item w3-button" style="width:25% !important">CONTACT</a>
        </div>
    </div>

    <!-- Page Content -->
    <div class="w3-padding-large" id="main">
        <!-- Header/Home -->
        <header class="w3-container w3-padding-32 w3-center w3-black" id="home">
            <img src="<?php echo base_url(); ?>/assests/Images/banner2.png" alt="boy" class="w3-image" width="620"
                 height="420">


        </header>

        <!-- About Section -->
        <div class="w3-content w3-justify w3-text-grey w3-padding-64" id="about">
            <h2 class="w3-text-light-grey">About our Company</h2>
            <hr style="width:200px" class="w3-opacity">
            <p>Some text about me. Some text about me. I am lorem ipsum consectetur adipiscing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                ullamco laboris nisi ut aliquip
                ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
                deserunt mollit anim id est laborum consectetur
                adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
            </p>

            <div class="w3-row w3-center w3-padding-16 w3-section w3-light-grey">
                <div class="w3-quarter w3-section">
                    <span class="w3-xlarge">11+</span><br>
                    Suppliers
                </div>
                <div class="w3-quarter w3-section">
                    <span class="w3-xlarge">55+</span><br>
                    Custom Orders Completed
                </div>
                <div class="w3-quarter w3-section">
                    <span class="w3-xlarge">890+</span><br>
                    Happy Customers
                </div>
                <div class="w3-quarter w3-section">
                    <span class="w3-xlarge">150+</span><br>
                    Worldwide Customers
                </div>


                <!-- End About Section -->
            </div>
            <!-- Contact Section -->
            <div class="w3-padding-64 w3-content w3-text-grey" id="contact">
                <h2 class="w3-text-light-grey">Contact US</h2>
                <hr style="width:200px" class="w3-opacity">

                <p>Lets get in touch. Send me a message:</p>

                <form action="/action_page.php" target="_blank">
                    <p><input class="w3-input w3-padding-16" type="number" placeholder="Name" required name="Name"></p>
                    <p><input class="w3-input w3-padding-16" type="text" placeholder="Email" required name="Email"></p>
                    <p><input class="w3-input w3-padding-16" type="text" placeholder="Subject" required name="Subject">
                    </p>
                    <p><input class="w3-input w3-padding-16" type="text" placeholder="Message" required name="Message">
                    </p>
                    <p>
                        <button class="w3-button w3-light-grey w3-padding-large" type="submit">
                            <i class="fa fa-paper-plane"></i> SEND MESSAGE
                        </button>
                    </p>
                </form>
                <!-- End Contact Section -->
            </div>

            <!-- Footer -->
            <footer class="w3-content w3-padding-64 w3-text-grey w3-xlarge">
                <a href="<?php echo site_url() ?>/Home/maintenance"><i
                            class="fa fa-facebook-official w3-hover-opacity"></i></a>
                <a href="<?php echo site_url() ?>/Home/maintenance"></a><i
                        class="fa fa-instagram w3-hover-opacity"></i></a>
                <a href="<?php echo site_url() ?>/Home/maintenance"><i class="fa fa-snapchat w3-hover-opacity"></i></a>
                <p class="w3-medium">Midwest Electronics </p>
                <!-- End footer -->
            </footer>

            <!-- END PAGE CONTENT -->
        </div>
    </body>
</php>