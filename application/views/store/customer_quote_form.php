<main>
    <a href="<?php echo site_url() ?>/Staff/viewCustomers">
        <div class="button">Back to View Customer</div>
    </a>

    <?php echo form_open(site_url('store/customer_quote_form/')) ?>
    <fieldset class="generic_edit_item_form">
        <p>* is required.</p>
        <legend>Customer Quote Form</legend>
        <p> <?php echo form_error("name"); ?></p>
        <p>
            <label for="name">Name:*</label>
            <input name="name" class="generic_input" type="text"
                   value="<?php empty(set_value("name")); ?>">
        </p>
        <p> <?php echo form_error("description"); ?></p>
        <p>
            <label for="description">Description:</label>
            <textarea name="description" class="generic_input"
                      type="text"><?php empty(set_value("description")); ?></textarea>
        </p>
        <p> <?php echo form_error("specs"); ?></p>
        <p>
            <label for="specs">Specs:</label>
            <textarea name="specs" class="generic_input"
                      type="text"><?php empty(set_value("specs")); ?></textarea>
        </p>
        <p> <?php echo form_error("price"); ?></p>
        <p>
            <label for="price">Requested Price:*</label>
            <input name="price" class="generic_input" type="text"
                   value="<?php echo set_value("price"); ?>">
        </p>
        <p> <?php echo form_error("quantity"); ?></p>
        <p>
            <label for="quantity">Quantity Requested:*</label>
            <input name="quantity" class="generic_input" type="text"
                   value="<?php echo set_value("quantity"); ?>">
        </p>
        <input class="button submit_button" type="submit">
    </fieldset>
    </form>
</main>
</body>
</html>
