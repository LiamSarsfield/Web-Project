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
                        <a href="<?php echo site_url()?>/Home/index" class="w3-bar-item w3-button w3-padding-large w3-hover-black">
                            <i class="
                            fa fa-home w3-xxlarge"></i>
                            <p>HOME</p>
                          </a>
			<button class="dropdown-btn w3-bar-item w3-button w3-padding-large w3-hover-black">
				<a href="#" class="w3-bar-item w3-button w3-hover-black">
                                    <a href="<?php echo site_url()?>/Shopping_cart_controller/view_shopping_cart"><i class="fa fa-shopping-basket w3-xxlarge"></i></a>
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
                        if ($query == false ) { 
                               echo "<p><em>Sorry, no items to display.</em></p>"; 
                        } else { 
                        foreach ($query->result() as $row)
                        {
//                                $tag = '/Web-Project/index.php/Store/view_selected_product/'.$row->product_id;
                                echo '<div class="w3-quarter w3-section w3-light-grey" style="margin-right:5%; padding: 2%; max-width: 30%;">';
                                echo '<span class="w3-xlarge"><a href="product_view.html"><img src='.base_url().$row->image_path.' width="200px"></a></span><br>';
                                echo "<strong>$row->product_name</strong><hr>";
                                echo "<em>$row->product_desc</em><hr>";
                                echo "<strong>€$row->product_price</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ";
                                echo "<a href=".'/Web-Project/index.php/Store_controller/view_selected_product/'.$row->product_id."><button>View</button></a>";                             
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