<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>View Pending Customer Orders</title>
<link href="style.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
</head>

<body>
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
<main>
 <a href="index.html"><div class="button">Back To Index</div></a>
  <table class="table_generic">
    <tbody>
      <tr>
        <th scope="col">Pending Order ID</th>
        <th scope="col">Order Name</th>
        <th scope="col">Date Requested</th>
        <th scope="col">Total Price</th>
        <th scope="col">View</th>
      </tr>
      <tr>
        <td>3002</td>
        <td>Machine Circuits</td>
        <td>21/11/2018</td>
        <td>4,600</td>
        <td><a href="pending_order_information.html"><div class="button">View</div></a></td>
      </tr>
    </tbody>
  </table>
</main>
</body>
</html>
