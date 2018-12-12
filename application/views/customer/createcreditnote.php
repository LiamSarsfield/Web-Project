
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Create Credit Note</title>
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
            <a href="customercreditnote.html"><div class="button">Back to Find Customer</div></a>

            <form action="submitcreditnote.html">
                <fieldset class="generic_edit_item_form">
                    <legend>Create Credit Note</legend>
                    <p>
                        <label class="generic_label generic_item_edit_label">Customer ID: </label>
                        <input class="generic_input" type="text" value="101" disabled>
                    </p>
                    <p>
                        <label class="generic_label generic_item_edit_label">Customer Name: </label>
                        <input class="generic_input" type="text" value="Keith Clifford">
                    </p>
                    <p>
                        <label class="generic_label generic_item_edit_label">Customer Email:</label>
                        <input class="generic_input" type="text" value="keithclifford500@gmail.com">
                    </p>
                    <p>
                        <label class="generic_label generic_item_edit_label">Credit Note No:</label>
                        <input class="generic_input" type="text" value="C0001" disabled>
                    </p>
                    <p>
                        <label class="generic_label generic_item_edit_label">Amount:</label>
                        <input class="generic_input" type="text" value="€150" disabled>
                    </p>
                    <p>
                        <label class="generic_label generic_item_edit_label">Reason:</label>
                        <select>
                            <option>Refund</option>
                            <option>Promotion</option>
                            <option>Discount</option>
                        </select>
                    </p>
                    <input class="button submit_button" type="submit">
                </fieldset>
            </form>
        </main>
    </body>
</html>
