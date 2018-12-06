<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Add Supplier</title>
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

<section>
    <fieldset>
      
      <div id="container2">
      <form action="invoice.html" method="post" name="form" id="form" onSubmit="">
      <h1>Prepare Customer Invoice</h1>
        <p>
          <label for="customer_name">Customer Name:*</label>
        <input name="customer_name" type="text" id="customer_name"></p>
        <p>
          <label for="order_number">Order Number:*</label>
          <input name="order_number" type="text" id="order_number">
        </p>
        <p>
          <label for="quantity">Quantity:*</label>
          <input name="quantity" type="quantity" id="quantity">
        </p>
        <p>
          <label for="price">Price:*</label>
          <input name="price" type="text" id="price">
        </p>

        <p>
          <input type="submit" name="submit" id="submit" value="Submit">
        </p>
        <p>* required field</p>
      </form>
        </div>
    </fieldset>
  </section>

<footer>
  <p>Copyright © 2018 Website by Dream Team </p>
</footer>
</div>

</body>
</html>
