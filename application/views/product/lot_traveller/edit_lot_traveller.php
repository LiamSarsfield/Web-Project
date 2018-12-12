<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Search Lot Traveller</title>
<link href="style.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
</head>

<body>
<header> 
<a href="../../index.html"><img src="images/logo.jpg" alt="logo" width="153" height="160" title="Home"/></a><img src="images/midwest.jpg" alt="" width="780" height="160" id="title"/><img src="images/memberlogin2.jpg" alt="login" width="120" height="150" id="crest"/>
  <nav>
    <ul>
      <li><a class="active" href="customersearch.html">Customer</a></li>
      <li><a href="maintain_supplier.html">Supplier</a></li>
      <li><a href="view_products.html">Production</a></li>
      </ul>
</nav>
 
</header>
<main>
<a href="lot_traveller_information.html"><div class="button">Back to View Lot Traveller</div></a>

<form action="lot_traveller_information.html">
    <fieldset class="generic_edit_item_form">
      <legend>Update Lot Traveller</legend>
      <p>
        <label class="generic_label generic_item_edit_label">Lot Traveller ID: </label>
        <input class="generic_input" type="text" value="RT 18364" disabled>
      </p>
      <p>
        <label class="generic_label generic_item_edit_label">Lot Traveller Name: </label>
        <input class="generic_input" type="text" value="BS-111 Basic socked">
      </p>
      <p>
        <label class="generic_label generic_item_edit_label">Status</label>
        <select class="generic_input">
          <option>Not In Production</option>
          <option selected>In Production</option>
          <option>Finished & Converted To Worked Order</option>
          <option>Shipped</option>
          <option>Customer Received</option>
        </select>
      </p>
      <p>
        <label class="generic_label generic_item_edit_label">Worker Assignee</label>
        <select class="generic_input">
          <option>John</option>
          <option selected>Mary</option>
          <option>Ita</option>
        </select>
      </p>
      <input class="button submit_button" type="submit">
    </fieldset>
  </form>
</main>
</body>
</html>
