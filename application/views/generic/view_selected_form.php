<main>
    <a href="<?php echo site_url(substr(uri_string(), 0, -2)); ?>">
        <div class="button">Back</div>
    </a>
    <div class="generic_section generic_item_information">
        <h2 class="generic_item_header"><?php echo $table_name; ?></h2>
        <?php foreach ($multi_tables as $multi_table) { ?>
            <div class="table_view_info">
                <?php echo $multi_table; ?>
            </div>
        <?php } ?>
        <?php foreach ($view_data as $table_name => $table_value) { ?>
            <div class="table_view_info">
                <h3><?php echo ucwords(str_replace("_", " ", $table_name)) ?> Details</h3>
                <?php foreach ($table_value->columns as $table_column) { ?>
                    <p>
                        <span class="generic_item_label"><?php echo $table_column->field ?>: </span><?php echo $table_column->value; ?>
                    </p>
                <?php } ?>
            </div>
        <?php } ?>
        </section>
        <section class="generic_section generic_item_information">
            <h2 class="generic_item_header">Available Functions</h2>
            <div class="generic_item_content">
                <a href="<?php echo site_url("/edit/category/1") ?>">
                    <div class="button">Edit</div>
                </a>
                <a href="<?php echo site_url() ?>/Customer/declineQuote">
                    <div class="button">Decline Quote</div>
                </a>
            </div>
        </section>
    </div>
</main>
</body>
</html>
