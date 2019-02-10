<main>
    <a href="<?php echo site_url("Staff_account/view_my_work_orders/{$work_order_info->work_order_id}") ?>">
        <div class="button">Back to View Work Order</div>
    </a>
    <?php echo form_open(site_url('Staff_account/edit_my_work_order/' . $work_order_info->work_order_id)) ?>
    <fieldset class="generic_edit_item_form">
        <p>* is required.</p>
        <legend>Edit Work Order</legend>
        <p>
            <label>Quote Name: </label>
            <input class="generic_input" type="text"
                   value="<?php echo $work_order_info->quote_name ?>" readonly="readonly">
        </p>
        <p>
            <label>Requested Stock: </label>
            <input class="generic_input" type="text"
                   value="<?php echo $work_order_info->requested_quantity ?>" readonly="readonly">
        </p>
        <p> <?php echo form_error("status"); ?></p>
        <p>
            <label for="status">Status:*</label>
            <input name="status" class="generic_input" type="text"
                   value="<?php echo (empty(set_value("status"))) ? $work_order_info->quote_status : set_value("status"); ?>">
        </p>
        <p> <?php echo form_error("stock_quantity"); ?></p>
        <p>
            <label for="stock_quantity">Stock Quantity:*</label>
            <input name="stock_quantity" class="generic_input" type="text"
                   value="<?php echo (empty(set_value("stock_quantity"))) ? $work_order_info->quote_stock_quantity : set_value("stock_quantity"); ?>">
        </p>
        <input class="button submit_button" type="submit">
    </fieldset>
    </form>
</main>
</body>
</html>
