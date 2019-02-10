<main>
    <?php echo form_open(site_url("Customer_account/pay_my_order/$customer_order_info->customer_order_id")) ?>
    <fieldset class="generic_edit_item_form">
        <h2 class="generic_item_header">Customer card Details</h2>
        <p> <?php echo form_error("card_number"); ?></p>
        <p>
            <label for="card_number" class="generic_label generic_item_edit_label">Card Number: </label>
            <input name="card_number" class="generic_input" type="text" value="<?php echo set_value("card_number") ?>">
        </p>
        <p> <?php echo form_error("expiry"); ?></p>
        <p>
            <label for="expiry" class="generic_label generic_item_edit_label">Expiry Date: </label>
            <input name="expiry" class="generic_input" type="text" value="<?php echo set_value("expiry") ?>">
        </p>
        <p> <?php echo form_error("cvv"); ?></p>
        <p>
            <label for="cvv" class="generic_label generic_item_edit_label">CVV:</label>
            <input name="cvv" class="generic_input" type="text" value="<?php echo set_value("cvv") ?>">
        </p>

        <p>
            <label class="generic_label generic_item_edit_label">Amount to be paid:</label>
            <input class="generic_input" type="text" value="€<?php echo $customer_order_info->total_price; ?>"
                   disabled>
        </p>
        <input class="button submit_button" type="submit">
    </fieldset>
    </form>
</main>
</body>
</html>
