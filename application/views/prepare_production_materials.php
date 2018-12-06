<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>MWE</title>
<link href="style.css" rel="stylesheet" type="text/css">
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
<br> 
<h1>Prepare Production Materials Requirements Plan</h1>
<br>
<section>
    <fieldset>
      
      <div id="container2">
      <form action="materials.html" method="post" name="form" id="form" onSubmit="">
      <h1>Product Details</h1>
	  <br>
        <p>
          <label for="product">Product:*</label>
        <input name="product" type="text" id="product"></p>
        <p>
          <label for="quantity">Quantity:*</label>
          <input name="quantity" type="text" id="quantity">
        </p>
        <p>
          <input type="submit" name="submit" id="submit" value="Submit">
        </p>
        <p>* required field</p>
      </form>
	  <br>
        </div>
    </fieldset>
  </section>


</div>
<footer>
  <p>Copyright © 2018 Website by Dream Team </p>
</footer>
</div>

</body>
</html>
