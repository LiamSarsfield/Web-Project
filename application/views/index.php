<body>
<div id="page">
<header> 
<a href="<?php echo site_url('Home/index'); ?>"><img src="<?php echo base_url(); ?>assets/images/logo.jpg" alt="logo" width="153" height="160" title="Home"/></a><img src="<?php echo base_url(); ?>assets/images/midwest.jpg" alt="" width="780" height="160" id="title"/><img src="<?php echo base_url(); ?>assets/images/memberlogin2.jpg" alt="login" width="120" height="150" id="crest"/>
  <nav>
    <ul>
      <li><a class="active" href="customersearch.html">Customer</a></li>
      <li><a href="maintain_supplier.html">Supplier</a></li>
      <li><a href="view_products.html">Production</a></li>
      </ul>
</nav>
 
</header>
<p>
 
 </p>
<div id="leftCol">
  
<h1>Maintain Customer</h1>
<br>
<div class="dropdown">
<button onclick="myFunctionOne()" class="dropbtn">Customer</button>
  <div id="myDropdownOne" class="dropdown-content">
    <a href="customersearch.html">Maintain Customer</a>
    <a href="prepare_customer_invoice.html">Prepare Customer Invoices</a>
    <a href="accept_returned_goods.html">Accept Returned Goods From Customer</a>
	<a href="view_pending_customer_orders.html">Accept Customer Order</a>
	<a href="view_pending_customer_orders.html">Make Work Order(s) From Customer Order</a>
	<a href="searchquotes.html">Provide Customer Quotation (Accept/Process)</a>
	<a href="customercreditnote.html">Generate Customer Credit Note For Returned Goods</a>
	<a href="customerpayment.html">Handle Exceptional Purchase Authorisation</a>
  </div>
</div>
</div>
<div id="rightCol">
   <div id="legend">
<h1>Maintain Supplier</h1>

   </div>

<br>
<div class="dropdown">
<button onclick="myFunctionTwo()" class="dropbtn">Supplier</button>
  <div id="myDropdownTwo" class="dropdown-content">
    <a href="<?php echo site_url('Home/maintain_supplier'); ?>">Maintain Supplier</a>
    <a href="accept_material_delivery.html">Accept / Reject Materials Delivery From Supplier</a>
    <a href="generate_supplier_order_request.html">Generate Supplier Purchase Order Requests</a>
	<a href="searchsuppliers.html">Supplier Payment Authorisation</a>
  </div>
</div>

</div>
<div id="col3">
   <div id="legend">
<h1>Maintain Production</h1>


   </div>

<br>
<div class="dropdown">
<button onclick="myFunctionThree()" class="dropbtn">Production</button>
  <div id="myDropdownThree" class="dropdown-content">
    <a href="view_products.html">Maintain Product Details</a>
    <a href="maintain_material.html">Maintain Materials Details</a>
    <a href="prepare_production_materials.html">Prepare Production Materials Requirements Plan</a>
	<a href="generate_lot_traveller.html">Generate Lot Traveller</a>
	<a href="generate_supplier_order_request.html">Generate Supplier Purchase Order Requests</a>
	<a href="material_enquiry.html">Raw Materials Online Enquiry</a>
	<a href="lot_traveller.html">Update Lot Traveller Traceability</a>
	<a href="edit_lot_traveller.html">Convert Lot Traveller To Finished Goods Note</a>
	<a href="prepare_scrap_notes.html">Prepare Scrap Note Details for C&E</a>
  </div>
</div>

</div>



<footer>
  <p>Copyright © 2018 Website by Dream Team </p>
</footer>
</div>

</body>
</html>
