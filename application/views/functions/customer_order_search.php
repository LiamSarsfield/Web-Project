<main>
    <a href="view__customer_orders.html">
        <div class="button">Back to View All Orders</div>
    </a>
    <section class="generic_section generic_item_information">
        <h2 class="generic_item_header">Order Information</h2>
        <p><span class="generic_item_label">Order ID: </span><?php echo $model_info->order_id; ?></p>
        <p><span class="generic_item_label">Customer Name: </span><?php echo $model_info->customer_name; ?></p>
        <p><span class="generic_item_label">Date Ordered: </span><?php echo $model_info->date_ordered; ?></p>
        <p>
            <span class="generic_item_label">Products Requested: </span><?php foreach ($model_info->products as $product) { ?>
                <a href="<?php echo site_url("/functions/view/product/$product->product_id") ?>"> <?php echo $product->name ?></a> <?php echo "($product->product_quantity)"; ?>
            <?php } ?></p>
        <p><span class="generic_item_label">Total Price: </span>€<?php echo $model_info->total_price; ?></p>
        <p><span class="generic_item_label">Worked on by: </span><?php echo $model_info->order_id; ?></p>
    </section>
    <section class="generic_section generic_item_information">
        <h2 class="generic_item_header">Available Functions</h2>
        <div class="generic_item_content">
            <a href="convert_to_work_order.html">
                <div class="button">Accept Customer Order</div>
            </a>
            <div class="button">Reject Customer Order</div>
        </div>
    </section>
</main>
