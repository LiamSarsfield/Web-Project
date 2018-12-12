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
<a href="../index.html"><img src="images/logo.jpg" alt="logo" width="153" height="160" title="Home"/></a><img src="images/midwest.jpg" alt="" width="780" height="160" id="title"/><img src="images/memberlogin2.jpg" alt="login" width="120" height="150" id="crest"/>
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
      <form action="success_add_supplier.html" method="post" name="form" id="form" onSubmit="">
      <h1>ADD SUPPLIER</h1>
        <p>
          <label for="name">Supplier Name:*</label>
        <input name="name" type="text" required id="name"></p>
        <p>
          <label for="address">Address:</label>
          <textarea name="address" cols="55" rows="5" id="address"></textarea>
        </p>
        <p>
          <label for="mobile">Phone No:*</label>
          <input name="phone" type="tel" required id="phone">
        </p>
        <p>
          <label for="email1">Email:*</label>
          <input name="email1" type="email" required id="email1">
        </p>
        <p>
          <label for="fax">Fax:*</label>
          <input name="fax" type="text" required id="fax">
        </p>
        
        <p>
          <label for="note">Note:</label>
          <textarea name="note" cols="55" rows="5" id="note"></textarea>
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
