

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Customer Quote</title>
        <link href="<?php echo base_url(); ?>/assests/CSS/style.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
        <script type="text/javascript"src="<?php echo base_url(); ?>/assests/script/navs.js"></script>
    </head>

    <body>
	<nav class="w3-sidebar w3-bar-block w3-small w3-hide-small w3-center">
  <!-- Avatar image in top left corner -->
  <a href="<?php echo site_url()?>/Customer/loggedIn"><img src="<?php echo base_url(); ?>/assests/Images/MweLogo.png" style="width:100%"></a>
  
    <span style="font-size:30px;cursor:pointer" onclick="openNav()"  class="w3-bar-item  w3-button w3-padding-large w3-hover-black">&#9776;</span>
    <div id="mySidenav" class="sidenav">
        <button class="dropdown-btn w3-bar-item w3-button w3-padding-large w3-hover-black">
  <a href="#" onclick="dropdown()" class="w3-bar-item w3-button w3-hover-black" >
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
    <i class="fa fa-server w3-xxlarge"></i>
    <p>ACCOUNT</p>
    </button>

<div  class="dropdown-container">
    <a href="<?php echo site_url()?>/Customer/quotes" class="fa fa-edit w3-bar-item w3-button w3-padding-large w3-hover-black"><p>QUOTES</p></a>
    <a href="#contact" class="fa fa-gear w3-bar-item w3-button w3-padding-large w3-hover-black"><p>SETTINGS</p></a>
    </div>
  
    <button  onclick="dropdown()" class="dropdown-btn w3-bar-item w3-button w3-hover-black w3-bar-item w3-button w3-padding-large w3-hover-black">
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
        <main style="margin-left:10%; margin-right:10%;">
            <a href="<?php echo site_url()?>/Customer/quotes"><div class="button">Back to View All Quotes</div></a>
            <section class="generic_section generic_item_information">
                <h2 class="generic_item_header">Customer Quote</h2>
                <p><span class="generic_item_label">Quote ID: </span>Q654</p>
                <p><span class="generic_item_label">Customer Name: </span>Keith Clifford</p>
                <p><span class="generic_item_label">Customer Email: </span>keithclifford500@gmail.com</p>
                <p><span class="generic_item_label">Address 1: </span>16 Upper St</p>
                <p><span class="generic_item_label">Address 2: </span>lower center</p>
                <p><span class="generic_item_label">Town: </span>Limerick</p>
                <p><span class="generic_item_label">Country: </span>Ireland</p> 
                <p><span class="generic_item_label">Quote Amount: </span>€200</p> 
            </section>
            <section class="generic_section generic_item_information">
                <h2 class="generic_item_header">Available Functions</h2>
                <div class="generic_item_content">
                    <a href="<?php echo site_url()?>/Customer/payQuote"><div class="button">Pay Quote</div></a>
                    <a href="<?php echo site_url()?>/Customer/declineQuote"><div class="button">Decline Quote</div></a>
                </div>
            </section>
        </main>
    </body>
</html>
