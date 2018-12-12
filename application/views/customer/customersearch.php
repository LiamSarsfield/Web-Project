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
  <form action="maintaincustomer.html" class="search_product_id generic_search">
    <fieldset>
      <legend>Search Customer ID</legend>
      <div class="flex_container">
        <input type="text" class="generic_item_search_input generic_input" placeholder="Customer ID">
        <input type="image" src="assets/img/search-image-icon.png" alt="Submit" class="generic_search_submit" />
      </div>
    </fieldset>
  </form>
  <table class="table_generic">
    <tbody>
      <tr>
        <th scope="col">Customer ID</th>
        <th scope="col">Customer Name</th>
        <th scope="col">Customer Email</th>
        <th scope="col">View</th>
      </tr>
      <tr>
        <td>101</td>
        <td>Keith Clifford</td>
        <td>keithclifford500@gmail.com</td>
        <td><a href="maintaincustomer.html"><div class="button">View info</div></a></td>
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
