<main>

    <a href="<?php echo site_url() ?>/admin/view">
        <div class="button">Back to View All Customers</div>
    </a>
    <section class="generic_section generic_item_information">
        <h2 class="generic_item_header">Customer Information</h2>
        <?php foreach ($customers as $field_name => $customer_field_value) { ?>
            <p><span class="generic_item_label"><?php echo $field_name; ?> </span><?php echo $customer_field_value; ?></p>
        <?php } ?>
    </section>
    <section class="generic_section generic_item_information">
        <h2 class="generic_item_header">Available Functions</h2>
        <div class="generic_item_content">
            <a href="<?php echo site_url() ?>/Staff/editCustomer">
                <div class="button">Edit Customer</div>
            </a>
        </div>
    </section>
</main>
</body>
</html>

