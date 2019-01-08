
<nav class="w3-sidebar w3-bar-block w3-small w3-hide-small w3-center">
  <!-- Avatar image in top left corner -->
  <a href="<?php echo site_url()?>/Staff/staffLogin"><img src="<?php echo base_url(); ?>/assests/Images/MweLogo.png" style="width:100%"></a>
  
    <span style="font-size:30px;cursor:pointer" onclick="openNav()"  class="w3-bar-item  w3-button w3-padding-large w3-hover-black">&#9776;</span>
    <div id="mySidenav" class="sidenav">
        <button onclick="dropdown()" class="dropdown-btn w3-bar-item w3-button w3-padding-large w3-hover-black">
  <a href="<?php echo site_url()?>/Staff/staffLogin" class="w3-bar-item w3-button w3-hover-black" >
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
    <a href="<?php echo site_url()?>/Staff/viewInvoices" class="fa fa-edit w3-bar-item w3-button w3-padding-large w3-hover-black"><p>INVOICES</p></a>
    <a href="<?php echo site_url()?>/Staff/viewReturns" class="fa fa-exchange w3-bar-item w3-button w3-padding-large w3-hover-black"><p>RETURNS</p></a>
    <a href="<?php echo site_url()?>/Staff/viewOrders" class="fa fa-edit w3-bar-item w3-button w3-padding-large w3-hover-black"><p>ORDERS</p></a>
    </div>
  
    <button onclick="dropdown()" class="dropdown-btn w3-bar-item w3-button w3-hover-black w3-bar-item w3-button w3-padding-large w3-hover-black">
    <i class="fa fa-ship w3-xxlarge"></i>
    <p>SUPPLIER</p>
    </button>

    <div  class="dropdown-container">
    <a href="<?php echo site_url()?>/Supplier/maintain" class="fa fa-edit w3-bar-item w3-button w3-padding-large w3-hover-black"><p>MAINTAIN</p></a>
    <a href="<?php echo site_url()?>/Supplier/materialReq" class="fa fa-edit w3-bar-item w3-button w3-padding-large w3-hover-black"><p>MATERIAL REQ</p></a>
    <a href="<?php echo site_url()?>/Supplier/deliveries" class="fa fa-edit w3-bar-item w3-button w3-padding-large w3-hover-black"><p>DELIVERIES</p></a>
    <a href="<?php echo site_url()?>/Supplier/materialDetails" class="fa fa-edit w3-bar-item w3-button w3-padding-large w3-hover-black"><p>MAINTAIN MATERIALS</p></a>
    <a href="<?php echo site_url()?>/Supplier/orderReq" class="fa fa-edit w3-bar-item w3-button w3-padding-large w3-hover-black"><p>ORDER REQUESTS</p></a>
    <a href="<?php echo site_url()?>/Supplier/payment" class="fa fa-money w3-bar-item w3-button w3-padding-large w3-hover-black"><p>PAYMENT</p></a>
    </div>

    <button onclick="dropdown()" class="dropdown-btn w3-bar-item w3-button w3-hover-black w3-bar-item w3-button w3-padding-large w3-hover-black">
    <i class="fa fa-sitemap w3-xxlarge"></i>
    <p>PRODUCT</p>
    </button>

    <div  class="dropdown-container">
    <a href="<?php echo site_url()?>/Product/scrapNotes" class="fa fa-edit w3-bar-item w3-button w3-padding-large w3-hover-black"><p>SCRAP NOTES</p></a>
    <a href="<?php echo site_url()?>/Product/materials" class="fa fa-edit w3-bar-item w3-button w3-padding-large w3-hover-black"><p>RAW MATERIALS</p></a>
    <a href="<?php echo site_url()?>/Product/maintain" class="fa fa-edit w3-bar-item w3-button w3-padding-large w3-hover-black"><p>MAINTAIN PRODUCTS</p></a>
    <a href="<?php echo site_url()?>/Product/updateTraveller" class="fa fa-edit w3-bar-item w3-button w3-padding-large w3-hover-black"><p>UPDATE TRAVELLER</p></a>
    <a href="<?php echo site_url()?>/Product/goodsNotes" class="fa fa-edit w3-bar-item w3-button w3-padding-large w3-hover-black"><p>GOODS NOTES</p></a>
    <a href="<?php echo site_url()?>/Product/generateTraveller" class="fa fa-edit w3-bar-item w3-button w3-padding-large w3-hover-black"><p>GENERATE TRAVELLER</p></a>
    </div>

    <a href="<?php echo site_url()?>/Home/Index" class="w3-bar-item w3-button w3-padding-large w3-hover-black">
            <i class="fa fa-rotate-left w3-xxlarge"></i>
            <p>Logout</p>
  </a>
</div>

</nav>