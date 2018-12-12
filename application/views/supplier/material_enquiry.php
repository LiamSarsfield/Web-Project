<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Material Enquiry</title>
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
      <form action="" method="post" name="form" id="form" onSubmit="">
      <h1>Material Enquiry</h1>
        <p>
          <label for="name">Material Name:*</label>
        <input name="name" type="text" required id="name"></p>
        <p>
          <label for="Enquiry">Enquiry</label>
          <textarea name="Enquiry" cols="55" rows="5" id="Enquiry"></textarea>
        </p>
        <p>
          <label for="cust_name">Name:*</label>
          <input name="cust_name" type="text" required id="cust_name">
        </p>
        <p>
          <label for="email">Email:*</label>
          <input name="email" type="email" required id="email">
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
