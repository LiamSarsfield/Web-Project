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
 <a href="../index.html"><div class="button">Back To Index</div></a>
  <form action="product_information.html" class="search_product_id generic_search">
    <fieldset>
      <legend>Search Product ID</legend>
      <div class="flex_container">
        <input type="text" class="generic_item_search_input generic_input" placeholder="Product ID">
        <input type="image" src="assets/img/search-image-icon.png" alt="Submit" class="generic_search_submit" />
      </div>
    </fieldset>
  </form>
  <table class="table_generic">
    <tbody>
      <tr>
        <th scope="col">Product ID</th>
        <th scope="col">Product Name</th>
        <th scope="col">Product Price (€)</th>
        <th scope="col">View</th>
      </tr>
      <tr>
        <td>1001</td>
        <td>MSX Titan</td>
        <td>2,400</td>
        <td><a href="product_information.html"><div class="button">View</div></a></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </tbody>
  </table>
</main>
</body>
</html>
