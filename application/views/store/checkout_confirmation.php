<?php

echo $table;
//if(!isset()$customer_details)
?>
<div>Ship to: <?php echo $customer_details->name; ?>
Address:
    <?php echo $customer_details->address_one; ?>
    <?php echo $customer_details->address_two; ?>
    <?php echo $customer_details->city; ?>
    <?php echo $customer_details->province; ?>
    <?php echo $customer_details->postal_code ?>
    <?php echo $customer_details->company; ?></div>
