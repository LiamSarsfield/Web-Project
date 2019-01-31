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
                <a href="<?php echo site_url()?>/Home/index"><img src="<?php echo base_url(); ?>/assests/Images/MweLogo.png" style="width:100%"></a>

		<span style="font-size:30px;cursor:pointer" onclick="openNav()" class="w3-bar-item  w3-button w3-padding-large w3-hover-black">&#9776;</span>
		<div id="mySidenav" class="sidenav">
			<button class="dropdown-btn w3-bar-item w3-button w3-padding-large w3-hover-black">
				<a href="#" class="w3-bar-item w3-button w3-hover-black">
					<i class="fa fa-shopping-basket w3-xxlarge"></i>
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
        if ($query == false ) { 
               echo "<p><em>You have no items in your basket.</em></p>";
               echo '<a href="'.base_url().'index.php/Store/view_store"><button>Continue shopping</button></a><br><br>';
        } else { 
        foreach ($query->result() as $row)
        {
         echo '<tr>';
         echo '<td style="">';   
//         echo '<img src="'.base_url().'/assets/images/cb.jpg" alt="product picture"'.$row->product_name.'" width="100px">';
         echo '<img src="'.base_url().$row->image_path.'" alt="product picture"'.$row->product_name.'" width="100px">';    
         
         echo '</td>';   
         echo '<td>'.$row->product_name.'</td>';   
         echo '<td>'.$row->product_desc.'</td>';            
         echo '<td><center>€'.$row->price.'</center></td>';
         echo '<td><center>'.$row->quantity.'</center></td>';
         echo '<td><center>€'.($row->price)*($row->quantity).'</center></td>';
         echo '<td>';   
         echo '<a href="'.base_url().'index.php/Shopping_cart_controller/remove_product_from_cart/'.$row->id.'"><button>Remove</button></a>';    
         echo '</td>';   
         }
        }
         ?>      
<!--          </tr>
          <tr>
            <td>
              <img src="sock.jpg" alt="" width="100px">
            </td>
            <td>Name Here</td>
            <td>Cast Iron High Precision Brass Electrical Sockets Coating Galvanization Surface</td>
            <td>
              <select name="" id="">
                <option value="">1</option>
                <option value="">2</option>
                <option value="">3</option>
                <td>€420</td>
                <td>
                  <button>Delete</button>
                </td>
              </select>
            </td>
          </tr>
          <tr>
            <td>
              <img src="ep.jpg" alt="" width="100px">
            </td>
            <td>Name Here</td>
            <td>Electronic components kit 1</td>
            <td>
              <select name="" id="">
                <option value="">1</option>
                <option value="">2</option>
                <option value="">3</option>
              </select>
              <td>€123</td>
              <td>
                <button>Delete</button>
              </td>

            </td>
          </tr>-->
        </table>

        <button class="w3-bar-item w3-button w3-padding-large w3-hover-black">
          <a href="<?php echo base_url()?>index.php/Shopping_cart_controller/checkout" class="w3-bar-item w3-button w3-hover-black">
            <i class="
              fa fa-credit-card w3-xxlarge"></i>
            <p>
              <strong>CHECKOUTT</strong>
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