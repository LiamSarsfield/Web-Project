

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Customer Quote</title>
        <link rel="stylesheet" href="<?php echo base_url(); ?>/assests/CSS/style.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script type="text/javascript"src="<?php echo base_url(); ?>/assests/script/navs.js"></script>
    </head>

    <body>
    <?php require_once('customermenu.php'); ?>
<header class="w3-container w3-padding-32 w3-center w3-black" id="home">
        <img src="<?php echo base_url(); ?>/assests/Images/banner2.png" alt="boy" class="w3-image" width="620" height="420">
   
    
  </header>
        <main style="margin-left:10%; margin-right:10%;">
            <a href="<?php echo site_url()?>/Customer/quotes"><div class="button">Back to View All Quotes</div></a>
            <section class="generic_section generic_item_information">
                <h2 class="generic_item_header">Customer Quote</h2>
                <p><span class="generic_item_label">Quote ID: </span>Q654</p>
                <p><span class="generic_item_label">Customer Name: </span>Keith Clifford</p>
                <p><span class="generic_item_label">Customer Email: </span>keithclifford500@gmail.com</p>
                <p><span class="generic_item_label">Address 1: </span>16 Upper St</p>
                <p><span class="generic_item_label">Address 2: </span>lower center</p>
                <p><span class="generic_item_label">Town: </span>Limerick</p>
                <p><span class="generic_item_label">Country: </span>Ireland</p> 
                <p><span class="generic_item_label">Quote Amount: </span>€200</p> 
            </section>
            <section class="generic_section generic_item_information">
                <h2 class="generic_item_header">Available Functions</h2>
                <div class="generic_item_content">
                    <a href="<?php echo site_url()?>/Customer/payQuote"><div class="button">Pay Quote</div></a>
                    <a href="<?php echo site_url()?>/Customer/declineQuote"><div class="button">Decline Quote</div></a>
                </div>
            </section>
        </main>
    </body>
</html>
