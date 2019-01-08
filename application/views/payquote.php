
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Quote Payment</title>
        <link href="<?php echo base_url(); ?>/assests/CSS/style.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
        <script type="text/javascript"src="<?php echo base_url(); ?>/assests/script/navs.js"></script>
    </head>

    <body>
    <?php require_once('customermenu.php'); ?>
<header class="w3-container w3-padding-32 w3-center w3-black" id="home">
        <img src="<?php echo base_url(); ?>/assests/Images/banner2.png" alt="boy" class="w3-image" width="620" height="420">
   
    
  </header>
<main style="margin-left:10%; margin-right:10%;">
            <form action="<?php echo site_url()?>/Customer/paymentSuccess">
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

