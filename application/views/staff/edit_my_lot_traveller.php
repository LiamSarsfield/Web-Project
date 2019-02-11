<main>
    <a href="<?php echo site_url("Staff_account/view_my_lot_travellers/{$lot_traveller_info->lot_traveller_id}") ?>">
        <div class="button">Back to View Lot Traveller</div>
    </a>
    <?php echo form_open(site_url('Staff_account/edit_my_lot_traveller/' . $lot_traveller_info->lot_traveller_id)) ?>
    <fieldset class="generic_edit_item_form">
        <p>* is required.</p>
        <legend>Edit Lot Traveller</legend>
        <p>
            <label>Product Name: </label>
            <input class="generic_input" type="text"
                   value="<?php echo $lot_traveller_info->product_name ?>" readonly="readonly">
        </p>
        <p>
            <label>Product Price: </label>
            <input class="generic_input" type="text"
                   value="<?php echo $lot_traveller_info->product_price ?>" readonly="readonly">
        </p>
        <p> <?php echo form_error("status"); ?></p>
        <p>
            <label for="status">Status:*</label>
            <input name="status" class="generic_input" type="text"
                   value="<?php echo (empty(set_value("status"))) ? $lot_traveller_info->status : set_value("status"); ?>">
        </p>
        <p> <?php echo form_error("product_quantity"); ?></p>
        <p>
            <label for="production_quantity">Production Quantity:*</label>
            <input name="production_quantity" class="generic_input" type="text"
                   value="<?php echo (empty(set_value("production_quantity"))) ? $lot_traveller_info->production_quantity : set_value("production_quantity"); ?>">
        </p>
        <input class="button submit_button" type="submit">
    </fieldset>
    </form>
</main>
</body>
</html>
