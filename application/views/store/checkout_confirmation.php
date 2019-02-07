<main>
    <?php
    if ($logged_in == false) { ?>
        <h2>Sign in to checkout.</h2>
        <p>
        <div class="button"><a href="<?php echo site_url('home/login'); ?>">Sign in</a></div>
        </p>
        <p>
        <div class="button"><a href="<?php echo site_url('home/register'); ?>">Sign up</a></div>
        </p>
    <? } else if (empty($product_table) && empty($customer_quote_table)) { ?>
        <h2>You cannot checkout as you have no items in your basket. Add Items by going to the store.</h2>
        <p>
        <div class="button"><a href="<?php echo site_url('store/view_store'); ?>">Store</a></div>
        </p>
    <?php } else { ?>
        <div class="generic_section generic_item_information">
            <?php if (!empty($product_table)) { ?>
                <div class="table_view_info">
                    <h2 class="generic_item_header">Products</h2>
                    <?php echo $product_table; ?>
                </div>
            <?php }; ?>
            <?php if (!empty($customer_quote_table)) { ?>
                <div class="table_view_info">
                    <h2 class="generic_item_header">Your Customer Quotes</h2>
                    <?php echo $customer_quote_table; ?>
                </div>
            <?php }; ?>
            <div class="confirmation-box">
                <h4>CONFIRMATION</h4>
                <p>Total Price: <strong>€<?php echo $basket_total; ?></strong></p>
                Ship to:
                <p><?php echo $customer_details->name; ?></p>
                Address:
                <p><?php echo $customer_details->address_one; ?></p>
                <p><?php echo $customer_details->address_two; ?></p>
                <p><?php echo $customer_details->city; ?></p>
                <p><?php echo $customer_details->province; ?></p>
                <p><?php echo $customer_details->postal_code ?></p>
                <p><?php echo $customer_details->company; ?></p>
                <div class="button"><a href="<?php echo site_url('store/confirm_checkout'); ?>">Confirm</a></div>
            </div>
        </div>
    <?php }
    ?>
</main>

