<main>
    <a href="<?php echo site_url() ?>/Staff_account/view_unassigned_work_orders">
        <div class="button">Back to my Work Orders</div>
    </a>
    <p><?php echo $temp_info; ?></p>
    <form>
        <fieldset class="generic_edit_item_form">
            <legend>Unassigned Work Order Details</legend>
            <div class="table_view_info">
                <h3>Customer Info:</h3>
                <p>
                    <label>Customer Name:</label>
                    <?php echo $work_order_info->customer_name; ?>
                </p>
            </div>
            <div class="table_view_info">
                <h3>Order Info:</h3>
                <p>
                    <label>Ordered Date:</label>
                    <?php echo $work_order_info->order_date; ?>
                </p>
                <p>
                    <label>Requested Quantity:</label>
                    <?php echo $work_order_info->requested_quantity; ?>
                </p>
            </div>
            <div class="table_view_info">
                <h3>Customer Quote Info:</h3>
                <p>
                    <label>Name:</label>
                    <?php echo $work_order_info->quote_name; ?>
                </p>
                <p>
                    <label>Description:</label>
                    <?php echo $work_order_info->quote_description; ?>
                </p>
                <p>
                    <label>Specs:</label>
                    <?php echo $work_order_info->quote_specs; ?>
                </p>
                <p>
                    <label>Price:</label>
                    <?php echo $work_order_info->quote_price; ?>
                </p>
                <p>
                    <label>Stock Quantity:</label>
                    <?php echo $work_order_info->quote_stock_quantity; ?>
                </p>
            </div>
            <section>
                <h2 class="generic_item_header">Available Functions</h2>
                <div class="generic_item_content">
                    <?php foreach ($available_functions as $available_function) { ?>
                        <a href="<?php echo site_url("{$available_function->anchor_tag}/{$work_order_info->work_order_id}"); ?>">
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
