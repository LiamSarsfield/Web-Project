<!DOCTYPE html>
<html>
<title><?php echo $title ?? "No Title Registered" ?></title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/CSS/style.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script type="text/javascript" src="<?php echo base_url(); ?>/assets/script/navs.js"></script>
<body class="w3-black">
<!-- Icon Bar (Sidebar - hidden on small screens) -->
<nav class="w3-sidebar w3-bar-block w3-small w3-hide-small w3-center">
    <!-- Avatar image in top left corner -->
    <a href="<?php echo site_url() ?>/dashboard/home"><img
                src="<?php echo base_url(); ?>/assets/Images/MweLogo.png" style="width:100%"></a>
    <span style="font-size:30px;cursor:pointer" onclick="openNav()"
          class="w3-bar-item  w3-button w3-padding-large w3-hover-black">&#9776;</span>
    <div id="mySidenav" class="sidenav" style="display: none;">
        <?php $sidebars = $sidebars ?? array();
        foreach ($sidebars as $sidebar) {
            //if the side bar has no sub side bars, style is different
            if (count($sidebar->sub_sidebar_array) == 0) { ?>
                <a href="<?php echo site_url("/{$sidebar->anchor_tag}"); ?>"
                   class="w3-bar-item w3-button w3-padding-large w3-hover-black">
                    <i class="fa <?php echo $sidebar->class ?> w3-xxlarge"></i>
                    <p><?php echo $sidebar->name; ?></p>
                </a>
            <?php } else { ?>
                <button onclick="dropdown()"
                        class="dropdown-btn w3-bar-item w3-button w3-hover-black w3-bar-item w3-button w3-padding-large w3-hover-black">
                    <i class="fa <?php echo $sidebar->class ?> w3-xxlarge"></i>
                    <p><?php echo $sidebar->name; ?></p>
                </button>
                <div class="dropdown-container">
                    <?php foreach ($sidebar->sub_sidebar_array as $sub_sidebar) { ?>
                        <a href="<?php echo site_url() . "/$sub_sidebar->anchor_tag/" ?>"
                           class="w3-bar-item w3-hover-black">
                            <i class="fa <?php echo $sidebar->class ?> w3-xxlarge"></i>
                            <p><?php echo $sub_sidebar->name; ?></p>
                        </a>
                    <?php } ?>
                </div>
            <?php }
        } ?>
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
        <img src="<?php echo base_url(); ?>/assets/Images/banner2.png" alt="boy" class="w3-image" width="620"
             height="420">


    </header>
