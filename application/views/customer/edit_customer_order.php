<main>
    <a href="<?php echo site_url() ?>/functions/view/customer_order">
        <div class="button">Back to View Customer Orders</div>
    </a>

    <?php echo form_open_multipart(site_url('Customer_order/edit_customer_order/' . $customer_order_info->customer_order_id)) ?>
    <fieldset class="generic_edit_item_form">
        <p>* is required.</p>
        <legend>Edit Product</legend>
        <div class="table_view_info">
            <h3>Customer Details</h3>
            <p>
                <label name="" class="generic_item_label">Customer ID: </label>
                <input name="" class="generic_input" type="text"
                       value="<?php echo $customer_order_info->customer_id ?>" readonly="readonly">
            </p>
            <p>
                <label name="customer_name" class="generic_item_label">Customer Name: </label>
                <input name="customer_name" class="generic_input" type="text"
                       value="<?php echo $customer_order_info->customer_name ?>" readonly="readonly">
            </p>
        </div>
        <div class="table_view_info">
            <h3>Products:</h3>
            <?php echo $product_table ?>
            <p>
                <a href='<?php echo site_url("customer_order/edit_change_customer_order_products/{$customer_order_id}") ?>'>
                    <div class='button'>Change Products in Order</div>
                </a></p>
        </div>
        <div class="table_view_info">
            <h3>Customer Quotes:</h3>
            <?php echo $customer_quote_table; ?>
            <p><a href='<?php echo site_url('') ?>'>
                    <div class='button'>Change Customer Quotes in Order</div>
                </a></p>
        </div>
        <p><label name="customer_id">Change Customer: </label>
            <select name="customer_id" class="generic_input">
                <?php foreach ($customers as $customer) { ?>
                    <option value="<?php echo $customer->customer_id; ?>"<?php echo ($customer->customer_id == $customer_order_info->customer_id) ? "selected=selected" : ""; ?>><?php echo $customer->name; ?></option>
                <?php } ?>
            </select>
        </p>
        <p> <?php echo form_error("date_ordered"); ?></p>
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
