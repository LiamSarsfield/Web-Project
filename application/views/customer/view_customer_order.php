<main style="width:60%;">
    <a href="<?php echo site_url() ?>/Staff/viewOrders">
        <div class="button">Back to View All Pending Orders</div>
    </a>

    <!--        <p><span class="generic_item_label">Pending Order ID: </span>1001</p>-->
    <!--        <p><span class="generic_item_label">Order Name: </span>Machine Circuits</p>-->
    <!--        <p><span class="generic_item_label">Date Received: </span>21/11/2018</p>-->
    <!--        <p><span class="generic_item_label">Total Price: </span>4,600</p>-->
    <!--        <p><span class="generic_item_label">Products Requested: </span>MSX Titan (2)</p>-->

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
