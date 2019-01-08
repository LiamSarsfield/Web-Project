<html>
<head>
<meta charset="utf-8">
<title>Customer Payment</title>
<link href="style.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
</head>

<body>
<header> 
<a href="index.html"><img src="images/logo.jpg" alt="logo" width="153" height="160" title="Home"/></a><img src="images/midwest.jpg" alt="" width="780" height="160" id="title"/><img src="images/memberlogin2.jpg" alt="login" width="120" height="150" id="crest"/>
<?php require_once('customermenu.php'); ?>
 
</header>
<main>
  <section class="generic_section generic_item_information">
<h2 class="generic_item_header">Customer Order Information</h2>

  <table class="table_generic">
    <tbody>
      <tr>
        <th scope="col">Customer Name:</th>
        <th scope="col">Customer No:</th>
        <th scope="col">Product Id:</th>
        <th scope="col">Products Purchased:</th>
        <th scope="col">Proceed to payment:</th>
      </tr>
      <tr>
        <td>Keith Clifford</td>
        <td>101</td>
        <td>222</td>
        <td>Socket Expander</td>
      </tr>
      <tr>
        <td></td>
        <td></td>
        <td>1025</td>
        <td>Dual Socket</td>
        <td><a href="cardpayment.html"><div class="button">Proceed to payment</div></a></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </tbody>
  </table>
  </section>
</main>
</body>
</html>


