<main style="margin-left:10%; margin-right:10%;">
    <form action="<?php echo site_url()?>/Staff/viewCustomers" class="search_product_id generic_search">
        <fieldset>
            <legend>Search Customer ID</legend>
            <div class="flex_container">
                <input type="text" class="generic_item_search_input generic_input" placeholder="Customer ID">
                <input type="image" src="<?php echo base_url(); ?>/assests/Images/search-image-icon.png" alt="Submit" class="generic_search_submit" />
            </div>
        </fieldset>
    </form>
    <?php echo $table ?>
</main>
</body>
</html>
