<main>
    <a href="<?php echo site_url() ?>/Staff_account/view_unassigned_lot_travellers">
        <div class="button">Back to my Work Orders</div>
    </a>
    <p><?php echo $temp_info; ?></p>
    <form>
        <fieldset class="generic_edit_item_form">
            <legend>Unassigned Lot Traveller Details</legend>
            <div class="table_view_info">
                <h3>Product Info:</h3>
                <p>
                    <label>Product Name:</label>
                    <?php echo $lot_traveller_info->name; ?>
                </p>
                <p>
                    <label>Product Price:</label>
                    €<?php echo $lot_traveller_info->price; ?>
                </p>
            </div>
            <div class="table_view_info">
                <h3>Order Info:</h3>
                <p>
                    <label>Production Quantity:</label>
                    <?php echo $lot_traveller_info->production_quantity; ?>
                </p>
                <p>
                    <label>Production Status:</label>
                    <?php echo $lot_traveller_info->status; ?>
                </p>
            </div>
            <section>
                <h2 class="generic_item_header">Available Functions</h2>
                <div class="generic_item_content">
                    <?php foreach ($available_functions as $available_function) { ?>
                        <a href="<?php echo site_url("{$available_function->anchor_tag}/{$lot_traveller_info->lot_traveller_id}"); ?>">
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
