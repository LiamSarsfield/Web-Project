<main style="width:60%;">
    <a href="<?php echo site_url('dashboard/home')?>">
        <div class="button">Back to Dashboard</div>
    </a>
    <? if (!empty($product_table)) { ?>
        <section class="generic_section generic_item_information">
            <h2 class="generic_item_header">Product Items</h2>
            <?php echo $product_table; ?>
        </section>
    <?php } ?>
    <? if (!empty($quote_table)) { ?>
        <section class="generic_section generic_item_information">
            <h2 class="generic_item_header">Quote Items</h2>
            <?php echo $quote_table; ?>
        </section>
    <?php } ?>
    <section class="generic_section generic_item_information">
        <h2 class="generic_item_header">Order Information</h2>
        <p>Date Ordered: <?php echo $order_info->date_ordered; ?></p>
        <p>Total Price: €<?php echo $order_info->total_price; ?></p>
        <p>Paid for Order? <?php echo $order_info->paid_for_order; ?></p>
    </section>
    <section class="generic_section generic_item_information">
        <h2 class="generic_item_header">Available Functions</h2>
        <div class="generic_item_content">
            <a href="<?php echo site_url() ?>/Staff/acceptOrder">
                <div class="button">Accept Customer Order</div>
            </a>
            <div class="button">Reject Customer Order</div>
        </div>
    </section>
</main>
</body>
</html>
