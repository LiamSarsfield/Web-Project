<main>
    <a href="<?php echo site_url() ?>/functions/view/customer_order">
        <div class="button">Back to View Customer Orders</div>
    </a>

    <form>
        <fieldset class="generic_edit_item_form">
            <div class="table_view_info">
                <h3>Products:</h3>
                <?php echo $product_table ?>
                <p>
                    <a href='<?php echo site_url("") ?>'>
                        <div class='button'>Change Products in Order</div>
                    </a>
                </p>
            </div>
            <div class="table_view_info">
                <h3>Customer Quotes:</h3>
                <?php echo $customer_quote_table; ?>
                <p><a href='<?php echo site_url('') ?>'>
                        <div class='button'>Change Customer Quotes in Order</div>
                    </a></p>
            </div>
            <p>
                <label for="date_ordered">Date Ordered:*</label>
                <input name="date_ordered" class="generic_input" type="date"
                       value="<?php echo (empty(set_value("date_ordered"))) ? $customer_order_info->date_ordered : set_value("date_ordered"); ?>">
            </p>
            <input class="button submit_button" type="submit">
        </fieldset>
    </form>
</main>
</body>
</html>
