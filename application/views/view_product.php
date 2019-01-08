<!DOCTYPE html>
<html>
<title>W3.CSS Template</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="<?php echo base_url(); ?>/assests/CSS/style.css">
<script rel="text/javascript" src="<?php echo base_url(); ?>/assests/script/navs.js"></script>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<body class="w3-black">

	<!-- Icon Bar (Sidebar - hidden on small screens) -->
	<nav class="w3-sidebar w3-bar-block w3-small w3-hide-small w3-center">
		<!-- Avatar image in top left corner -->
		<img src="<?php echo base_url(); ?>/assests/Images/MweLogo.png" style="width:100%">

		<span style="font-size:30px;cursor:pointer" onclick="openNav()" class="w3-bar-item  w3-button w3-padding-large w3-hover-black">&#9776;</span>
		<div id="mySidenav" class="sidenav">
			<button class="dropdown-btn w3-bar-item w3-button w3-padding-large w3-hover-black">
				<a href="#" class="w3-bar-item w3-button w3-hover-black">
					<i class="
    
fa fa-shopping-basket w3-xxlarge"></i>
					<p>
						<strong>CART</strong>
					</p>
				</a>
			</button>

			<div class="dropdown-container" style="color: violet">
				<a href="#" class=" w3-bar-item w3-button w3-padding-large w3-hover-black">VIEW</a>
				<a href="#" class=" w3-bar-item w3-button w3-padding-large w3-hover-black">UPDATE</a>
				<a href="#" class=" w3-bar-item w3-button w3-padding-large w3-hover-black">DELETE</a>
			</div>
			<a href="#about" class="w3-bar-item w3-button w3-padding-large w3-hover-black">
				<i class="fa fa-user w3-xxlarge"></i>
				<p>ABOUT</p>
			</a>

			<a href="#contact" class="w3-bar-item w3-button w3-padding-large w3-hover-black">
				<i class="fa fa-envelope w3-xxlarge"></i>
				<p>CONTACT</p>

				<a href="login.html" class="w3-bar-item w3-button w3-padding-large w3-hover-black">
					<i class="fa fa-pencil w3-xxlarge"></i>
					<p>Login</p>
				</a>

				<a href="signUp.html" class="w3-bar-item w3-button w3-padding-large w3-hover-black">
					<i class="fa fa-user-plus w3-xxlarge"></i>
					<p>Sign Up</p>
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
			<img src="<?php echo base_url(); ?>/assests/Images/banner2.png">
		</header>


    </header>

    <!-- About Section -->
    <div class="w3-content w3-justify w3-text-grey w3-padding-64" id="about">
      <div class="container">
        <div class="w3-justify w3-half" style="float: right; clear: both; margin-top: 1;">
          <div class="w3-half" style="float:right; margin-top: 0px; border: 1px solid  lightgray; padding: 1%;">
              <form method="POST" action="<?php echo base_url();?>index.php/Shopping_cart_controller/add_product_to_shopping_cart/<?php echo $product->product_id?>">
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

          </div>
          <div>
            <h1>
              <strong>Specs</strong>
            </h1>
              <br>  
              <h5 style="max-width: 190px;">
             <?php echo $product->product_specs ?>
           
            </h5>
            <br>
          </div>
        </div>
        
        <br>

      </div>

      <div class="w3-half" style="border-right: 1px solid  lightgray; padding-right: 10%;">
          <h1><?php echo $product->product_name ?></h1>
         <p>
         <em><?php echo $product->product_desc ?></em>
         </p>
         <br>
         <img src="<?php echo base_url().$product->image_path ?>" alt="circuit_board" width="400px">
          
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