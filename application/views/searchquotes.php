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
        <link href="<?php echo base_url(); ?>/assests/CSS/style.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
        <script type="text/javascript"src="<?php echo base_url(); ?>/assests/script/navs.js"></script>
    </head>

    <body>
    <?php require_once('customermenu.php'); ?>
<header class="w3-container w3-padding-32 w3-center w3-black" id="home">
        <img src="<?php echo base_url(); ?>/assests/Images/banner2.png" alt="boy" class="w3-image" width="620" height="420">
   
    
  </header>

        <main style="margin-left:10%; margin-right:8%;">
            <form action="<?php echo site_url()?>/Customer/quotes" class="search_product_id generic_search">
                <fieldset>
                    <legend>Search Quote ID</legend>
                    <div class="flex_container">
                        <input type="text" class="generic_item_search_input generic_input" placeholder="Quote ID">
                        <input type="image" src="<?php echo base_url(); ?>/assests/Images/search-image-icon.png" alt="Submit" class="generic_search_submit" />
                    </div>
                </fieldset>
            </form>
            <table class="table_generic">
                <tbody>
                    <tr>
                        <th scope="col">Customer ID</th>
                        <th scope="col">Customer Name</th>
                        <th scope="col">Customer Email</th>
                        <th scope="col">Quote ID</th>
                        <th scope="col">Quote Amount</th>
                        <th scope="col">View</th>
                    </tr>
                    <tr>
                        <td>101</td>
                        <td>Keith Clifford</td>
                        <td>keithclifford500@gmail.com</td>
                        <td>Q654</td>
                        <td>€200</td>
                        <td><a href="<?php echo site_url()?>/Customer/viewQuote"><div class="button">View info</div></a></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
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

