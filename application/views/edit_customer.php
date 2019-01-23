
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Search Product</title>
        <link rel="stylesheet" href="<?php echo base_url(); ?>/assests/CSS/style.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script type="text/javascript"src="<?php echo base_url(); ?>/assests/script/navs.js"></script>
    </head>

    <body>
    <!-- Icon Bar (Sidebar - hidden on small screens) -->
<nav class="w3-sidebar w3-bar-block w3-small w3-hide-small w3-center">
  <!-- Avatar image in top left corner -->
  <a href="<?php echo site_url()?>/Staff/staffLogin"><img src="<?php echo base_url(); ?>/assests/Images/MweLogo.png" style="width:100%"></a>
  
    <span style="font-size:30px;cursor:pointer" onclick="openNav()"  class="w3-bar-item  w3-button w3-padding-large w3-hover-black">&#9776;</span>
    <div id="mySidenav" class="sidenav">
        <button onclick="dropdown()" class="dropdown-btn w3-bar-item w3-button w3-padding-large w3-hover-black">
  <a href="#" class="w3-bar-item w3-button w3-hover-black" >
    <i class="
    fa fa-home w3-xxlarge"></i>
    <p>HOME</p>
  </a>
</button>

  <div  class="dropdown-container">
    <a href="#about" class="fa fa-user w3-bar-item w3-button w3-padding-large w3-hover-black"><p>ABOUT</p></a>
    <a href="#contact" class="fa fa-envelope w3-bar-item w3-button w3-padding-large w3-hover-black"><p>CONTACT</p></a>
    </div>
  
    <button onclick="dropdown()" class="dropdown-btn w3-bar-item w3-button w3-hover-black w3-bar-item w3-button w3-padding-large w3-hover-black">
    <i class="fa fa-drivers-license-o w3-xxlarge"></i>
    <p>CUSTOMERS</p>
</button>

<div  class="dropdown-container">
    <a href="<?php echo site_url()?>/Staff/viewCustomers" class="fa fa-edit w3-bar-item w3-button w3-padding-large w3-hover-black"><p>VIEW</p></a>
    </div>
  
    <button onclick="dropdown()" class="dropdown-btn w3-bar-item w3-button w3-hover-black w3-bar-item w3-button w3-padding-large w3-hover-black">
    <i class="fa fa-shopping-bag w3-xxlarge"></i>
    <p>STORE</p>
    </button>

    <div  class="dropdown-container">
    <a href="#about" class="fa fa-puzzle-piece  w3-bar-item w3-button w3-padding-large w3-hover-black"><p>CUSTOM ORDER</p></a>
    <a href="#contact" class="fa fa-microchip w3-bar-item w3-button w3-padding-large w3-hover-black"><p>PARTS</p></a>
    <a href="#contact" class="fa fa-shopping-cart w3-bar-item w3-button w3-padding-large w3-hover-black"><p>CART</p></a>
    </div>

    <a href="<?php echo site_url()?>/Home/Index" class="w3-bar-item w3-button w3-padding-large w3-hover-black">
            <i class="fa fa-rotate-left w3-xxlarge"></i>
            <p>Logout</p>
  </a>
</div>

</nav>

<header class="w3-container w3-padding-32 w3-center w3-black" id="home">
        <img src="<?php echo base_url(); ?>/assests/Images/banner2.png" alt="boy" class="w3-image" width="620" height="420">
   
    
  </header>
<main style="margin-left:35%; margin-right:35%;">
            <a href="<?php echo site_url()?>/Staff_controller/view_customers"><div class="button">Back to View Customer</div></a>

            <form action="<?php echo site_url()?>/Staff_controller/update_customer">
                <fieldset class="generic_edit_item_form">
                    <legend>Edit Customer</legend>
                    <p>
                        <label class="generic_label generic_item_edit_label">Customer ID: </label>
                        <input class="generic_input" type="text" value="101" disabled>
                    </p>
                    <p>
                        <label class="generic_label generic_item_edit_label">Customer Name: </label>
                        <input class="generic_input" type="text" value="Keith Clifford">
                    </p>
                    <p>
                        <label class="generic_label generic_item_edit_label">Customer Email:</label>
                        <input class="generic_input" type="text" value="keithclifford500@gmail.com">
                    </p>
                    <p>
                        <label class="generic_label generic_item_edit_label">Address 1:</label>
                        <input class="generic_input" type="text" value="16 Upper St" disabled>
                    </p>
                    <p>
                        <label class="generic_label generic_item_edit_label">Address 2:</label>
                        <input class="generic_input" type="text" value="lower center">
                    </p>
                    <p>
                        <label class="generic_label generic_item_edit_label">Town:</label>
                        <input class="generic_input" type="text" value="Limerick">
                    </p>

                    <p>
                        <label class="generic_label generic_item_edit_label">Country: </label>
                        <input class="generic_input" type="text" value="Ireland">
                    </p>
                    <input class="button submit_button" type="submit">
                </fieldset>
            </form>
        </main>
    </body>
</html>
