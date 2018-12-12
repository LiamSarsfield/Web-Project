<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Search Product</title>
<link href="style.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
</head>

<body>
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
<main>
<a href="product_information.html"><div class="button">Back to View Product</div></a>

<form action="view_products.html">
    <fieldset class="generic_edit_item_form">
      <legend>Edit Product</legend>
      <p>
        <label class="generic_label generic_item_edit_label">Product ID: </label>
        <input class="generic_input" type="text" value="1001" disabled>
      </p>
      <p>
        <label class="generic_label generic_item_edit_label">Product Name: </label>
        <input class="generic_input" type="text" value="MSX Titan">
      </p>
      <p>
        <label class="generic_label generic_item_edit_label">Product Price (€):</label>
        <input class="generic_input" type="text" value="2,400">
      </p>
      <input class="button submit_button" type="submit">
    </fieldset>
  </form>
</main>
</body>
</html>
