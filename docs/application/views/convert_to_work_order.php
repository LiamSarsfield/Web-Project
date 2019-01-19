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
<a href="pending_order_information.html"><div class="button">Back to Pending Order Information</div></a>
<form action="pending_order_information.html">
    <fieldset class="generic_edit_item_form">
      <legend>Assign Work Order</legend>
      <p><span class="generic_item_label">Order Name: </span>Machine Circuits</p>
      <p>
        <label class="generic_label work_order_label">Assign Product 1: (MSX Titan) To: </label>
      <select>
        <option>John</option>
        <option>Mary</option>
        <option>Ita</option>
      </select></p>
      <p>
        <label class="generic_label work_order_label">Assign Product 2: (MSX Titan) To: </label>
      <select>
        <option>John</option>
        <option>Mary</option>
        <option>Ita</option>
      </select></p>
      <input class="button submit_button" type="submit">
    </fieldset>
  </form>
</main>
</body>
</html>
