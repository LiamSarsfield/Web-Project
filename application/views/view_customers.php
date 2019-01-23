<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

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

<main style="margin-left:10%; margin-right:10%;">
<!--  <form action="<?php echo site_url()?>/Staff/viewCustomers" class="search_product_id generic_search">
    <fieldset>
      <legend>Search Customer ID</legend>
      <div class="flex_container">
        <input type="text" class="generic_item_search_input generic_input" placeholder="Customer ID">
        <input type="image" src="<?php echo base_url(); ?>/assests/Images/search-image-icon.png" alt="Submit" class="generic_search_submit" />
      </div>
    </fieldset>
  </form>-->
    <h1>Customers</h1>  
    
  <form action="<?php echo site_url()?>/Staff/viewCustomers" class="search_product_id generic_search">
    <fieldset>
      <legend>Search Customer ID</legend>
      <div class="flex_container">
        <input type="text" class="generic_item_search_input generic_input" placeholder="Customer ID">
        <input type="image" src="<?php echo base_url(); ?>/assests/Images/search-image-icon.png" alt="Submit" class="generic_search_submit" />
      </div>
    </fieldset>
  </form>
    
    <?php
    //if no details found
    if($query == false){
        echo "<p><center><em>Sorry, no customers to display.</em></center></p>";
    }
    else{
        echo '<table class="table_generic">';
        echo "<tr>";
        echo '<th scope="col">First Name</th>';
        echo '<th scope="col">Last Name</th>';          
        echo '<th scope="col">Email</th>';
        echo '<th scope="col">Phone</th>';
        echo '<th scope="col">Address1</th>';
        echo '<th scope="col">Address2</th>';
        echo '<th scope="col">Town</th>';
        echo '<th scope="col">City</th>';
        echo '<th scope="col">Action</th>';
        echo '</tr>';
        
        foreach($query->result() as $row){
            
        echo '<tr>';
        echo '<td>'.$row->first_name.'</td>';
        echo '<td>'.$row->last_name.'</td>'; 
        echo '<td>'.$row->email.'</td>';
        echo '<td>'.$row->phone.'</td>';
        echo '<td>'.$row->address1.'</td>';
        echo '<td>'.$row->address2.'</td>';
        echo '<td>'.$row->town.'</td>';
        echo '<td>'.$row->city.'</td>';
//        echo '<td><a href="'.site_url('Staff_controller/update_room/'.$row->customer_id.'').'"><button>UPDATE</button></a></td>';
        echo '<td><a href="'.site_url('Staff_controller/view_selected_customer/'.$row->customer_id.'').'"><button>View</button></a></td>';
        echo '</tr>';
        
        }
       
        echo "</table>";
    }
?>
    <br>
    <center><a href="<?php echo site_url('Staff_controller/add_customer'); ?>"><button>Add Customer</button></a></center>
</main>
</body>
</html>

                    
                    
                    