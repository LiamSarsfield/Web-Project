
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Quote Payment</title>
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
            <form action="paymentsuccesfulquote.html">
                <fieldset class="generic_edit_item_form">
                        <h2 class="generic_item_header">Quote Payment</h2>
                        <p>
                            <label class="generic_label generic_item_edit_label">Quote Id: </label>
                            <input class="generic_input" type="text" value="Q654" disabled>
                        </p>
                        <p>
                            <label class="generic_label generic_item_edit_label">Card Number: </label>
                            <input class="generic_input" type="text">
                        </p>
                        <p>
                            <label class="generic_label generic_item_edit_label">Expiry Date: </label>
                            <input class="generic_input" type="text">
                        </p>
                        <p>
                            <label class="generic_label generic_item_edit_label">CVV:</label>
                            <input class="generic_input" type="text">
                        </p>
                        <p>
                            <label class="generic_label generic_item_edit_label">Amount to be paid:</label>
                            <input class="generic_input" type="text" value="€200" disabled>
                        </p>
                        <input class="button submit_button" value="Pay" type="submit">
                   
                </fieldset>
            </form>
        </main>
    </body>
</html>

