<main>
    <a href="<?php echo site_url() ?>/Customer_account/view_my_customer_orders">
        <div class="button">Back to my Customer Orders</div>
    </a>
    <p><?php echo $temp_info; ?></p>
    <form>
        <fieldset class="generic_edit_item_form">
            <legend>Your Customer Order Details</legend>
            <div class="table_view_info">
                <h3>Products:</h3>
                <?php echo $product_table ?>
            </div>
            <div class="table_view_info">
                <h3>Customer Quotes:</h3>
                <?php echo $customer_quote_table; ?>
            </div>
            <p> <?php echo form_error("date_ordered"); ?></p>
            <p>
                <label for="date_ordered">Date Ordered:</label>
                <?php echo $customer_order_info->date_ordered; ?>
            </p>
            <p>
                <label for="date_ordered">Is Delivered?:</label>
                <?php echo $customer_order_info->delivery; ?>
            </p>
            <section>
                <h2 class="generic_item_header">Available Functions</h2>
                <div class="generic_item_content">
                    <?php foreach ($available_functions as $available_function) { ?>
                        <a href="<?php echo $available_function->anchor_tag; ?>">
                            <div class="button"><?php echo $available_function->name ?></div>
                        </a>
                    <?php } ?>
                </div>
            </section>
        </fieldset>
    </form>
</main>
</body>
</html>
