<?php

//if(!isset()$customer_details)
if (empty($table)) { ?>
    <h2>You cannot checkout as you have no items in your basket. Add Items by going to the store.
        <p>
        <div class="button"><a href="<?php echo site_url('store/view_store'); ?>">Store</a></div>
        </p>
    </h2>
<?php } else {
    echo $table; ?>
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
<?php }
?>

