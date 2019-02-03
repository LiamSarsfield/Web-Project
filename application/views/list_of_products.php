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
  <a href="<?php echo site_url()?>/Staff/staffLogin"><img src="<?php echo base_url(); ?>/assests/Images/MweLogo.png" style="width:100%"></a>
  
    <span style="font-size:30px;cursor:pointer" onclick="openNav()"  class="w3-bar-item  w3-button w3-padding-large w3-hover-black">&#9776;</span>
    <div id="mySidenav" class="sidenav">
        <button onclick="dropdown()" class="dropdown-btn w3-bar-item w3-button w3-padding-large w3-hover-black">
  <a href="<?php echo site_url()?>/Home/index" class="w3-bar-item w3-button w3-hover-black" >
    <i class="
    fa fa-home w3-xxlarge"></i>
    <p>HOME</p>
  </a>
</button>

<!--  <div  class="dropdown-container">
    <a href="#about" class="fa fa-user w3-bar-item w3-button w3-padding-large w3-hover-black"><p>ABOUT</p></a>
    <a href="#contact" class="fa fa-envelope w3-bar-item w3-button w3-padding-large w3-hover-black"><p>CONTACT</p></a>
    </div>-->
  
    <button onclick="dropdown()" class="dropdown-btn w3-bar-item w3-button w3-hover-black w3-bar-item w3-button w3-padding-large w3-hover-black">
    <i class="fa fa-drivers-license-o w3-xxlarge"></i>
    <p>CUSTOMERS</p>
</button>

<div  class="dropdown-container">
    <a href="<?php echo site_url()?>/Staff_controller/view_customers" class="fa fa-male  w3-bar-item w3-button w3-padding-large w3-hover-black"><p>View Customers</p></a>
    <a href="<?php echo site_url()?>/Staff_controller/add_customer" class="fa fa-plus w3-bar-item w3-button w3-padding-large w3-hover-black"><p>Add Customer</p></a>
    <a href="<?php echo site_url()?>/Staff_controller/edit_customer" class="fa fa-refresh w3-bar-item w3-button w3-padding-large w3-hover-black"><p>Update Customer</p></a>
    <a href="<?php echo site_url()?>/Staff_controller/delete_customers" class="fa fa-minus w3-bar-item w3-button w3-padding-large w3-hover-black"><p>Delete Customer</p></a>
    </div>
  
    <button onclick="dropdown()" class="dropdown-btn w3-bar-item w3-button w3-hover-black w3-bar-item w3-button w3-padding-large w3-hover-black">
    <i class="fa fa-shopping-bag w3-xxlarge"></i>
    <p>PRODUCTS</p>
    </button>

    <div  class="dropdown-container">
    <a href="<?php echo site_url()?>/Product_controller/view_products" class="fa fa-puzzle-piece  w3-bar-item w3-button w3-padding-large w3-hover-black"><p>View Products</p></a>
    <a href="<?php echo site_url()?>/Product_controller/add_product" class="fa fa-microchip w3-bar-item w3-button w3-padding-large w3-hover-black"><p>Add Product</p></a>
    <a href="<?php echo site_url()?>/Product_controller/update_product" class="fa fa-shopping-cart w3-bar-item w3-button w3-padding-large w3-hover-black"><p>Update Product</p></a>
    <a href="<?php echo site_url()?>/Product_controller/delete_product" class="fa fa-shopping-cart w3-bar-item w3-button w3-padding-large w3-hover-black"><p>Delete Product</p></a>
    </div>

    <a href="<?php echo site_url()?>/Home/Index" class="w3-bar-item w3-button w3-padding-large w3-hover-black">
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
        <img src="<?php echo base_url(); ?>/assests/Images/banner2.png" alt="boy" class="w3-image" width="620" height="420">
   
    
		</header>

		<!-- About Section -->
		<div class="w3-content w3-justify w3-text-grey w3-padding-64" id="about">
                    
                    <h1>List of Products</h1>
                    <br>
                    
                    
                    <table style="padding: 1%; margin-bottom: 1%;">
                        <th></th>
                        <th>Name</th>
                        <th>Description</th>          
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Action</th>
		      
                    <?php
                        //If no details found 
                        if ($query == false ) { 
                               echo "<p><em>Sorry, no items to display.</em></p>"; 
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
                            echo '<td><center>€'.$row->product_price.'</center></td>';
                            echo '<td><center>'.$row->quantity.'</center></td>';
                            echo '<td>';   
                            echo '<a href="'.base_url().'index.php/Product_controller/update_product/'.$row->product_id.'"><button>Update</button></a>';
                            echo '<br><br>';    
                            echo '<a href="'.base_url().'index.php/Product_controller/delete_product/'.$row->product_id.'"><button>Delete&nbsp;</button></a>';
                            echo '</td>';                               
                                                        
                               
                        }
    }        
                        ?>    
                    </table>
                    <br>
                    <center><a href="<?php echo site_url('Product_controller/add_product'); ?>"><button>Add Product</button></a></center>
                    
				<!-- End About Section -->
			</div>
		</div>




		<!-- End About Section -->
	</div>


	<!-- Footer -->
	

	<!-- END PAGE CONTENT -->
	</div>
</body>

</html>

