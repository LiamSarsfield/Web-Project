<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>MWE</title>
<link href="style.css" rel="stylesheet" type="text/css">
<style>
.dropbtn {
    background-color: lightblue;
    color: black;
    padding: 16px;
    font-size: 32px;
    border: none;
    cursor: pointer;
	width: 400px;
	height: 180px;
	margin-left:15px;
}

.dropbtn:hover, .dropbtn:focus {
    background-color: #2980B9;
}

.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f1f1f1;
    min-width: 160px;
    overflow: auto;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
	width: 400px;
}

.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.dropdown a:hover {background-color: #ddd;}

.show {display: block;}
</style>
</head>

<body>
<div id="page">
<header> 
<a href="index.html"><img src="images/logo.jpg" alt="logo" width="153" height="160" title="Home"/></a><img src="images/midwest.jpg" alt="" width="780" height="160" id="title"/><img src="images/memberlogin2.jpg" alt="login" width="120" height="150" id="crest"/>
  <nav>
    <ul>
      <li><a class="active" href="customersearch.html">Customer</a></li>
      <li><a href="maintain_supplier.html">Supplier</a></li>
      <li><a href="view_products.html">Production</a></li>
      </ul>
</nav>
 
</header>
<h2></h2>
<p></p>
<br><br><br>

<div class="dropdown">
<button onmouseover="myFunctionOne()" class="dropbtn">Customer</button>
  <div id="myDropdownOne" class="dropdown-content">
    <a href="#home">Maintain Customer</a>
    <a href="#about">Prepare Customer Invoices</a>
    <a href="#contact">Accept Returned Goods From Customer</a>
	<a href="#contact">Accept Customer Order</a>
	<a href="#contact">Make Work Order(s) From Customer Order</a>
	<a href="#contact">Provide Customer Quotation (Accept/Process)</a>
	<a href="#contact">Generate Customer Credit Note For Returned Goods</a>
	<a href="#contact">Handle Exceptional Purchase Authorisation</a>
  </div>
</div>

<div class="dropdown">
<button onclick="myFunctionTwo()" class="dropbtn">Supplier</button>
  <div id="myDropdownTwo" class="dropdown-content">
    <a href="#home">Maintain Supplier</a>
    <a href="#about">Accept / Reject Materials Delivery From Supplier</a>
    <a href="#contact">Generate Supplier Purchase Order Requests</a>
	<a href="#contact">Supplier Payment Authorisation</a>
  </div>
</div>

<div class="dropdown">
<button onclick="myFunctionThree()" class="dropbtn">Production</button>
  <div id="myDropdownThree" class="dropdown-content">
    <a href="#home">Maintain Product Details</a>
    <a href="#about">Maintain Materials Details</a>
    <a href="#contact">Prepare Production Materials Requirements Plan</a>
	<a href="#contact">Generate Lot Traveller</a>
	<a href="#contact">Generate Supplier Purchase Order Requests</a>
	<a href="#contact">Raw Materials Online Enquiry</a>
	<a href="#contact">Update Lot Traveller Traceability</a>
	<a href="#contact">Convert Lot Traveller To Finished Goods Note</a>
  </div>
</div>

<script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunctionOne() {
    document.getElementById("myDropdownOne").classList.toggle("show");
	document.getElementById("myDropdownTwo").classList.toggle("hide");
	document.getElementById("myDropdownThree").classList.toggle("hide");
}
function myFunctionTwo() {
    
	document.getElementById("myDropdownTwo").classList.toggle("show");
	document.getElementById("myDropdownOne").classList.toggle("hide");
	document.getElementById("myDropdownThree").classList.toggle("hide");
	
}
function myFunctionThree() {
    
	document.getElementById("myDropdownThree").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>

<footer>
  <p>Copyright © 2018 Website by Dream Team </p>
</footer>
</div>

</body>
</html>
