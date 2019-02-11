<main>
    <a href="<?php echo site_url('dashboard/home') ?>">
        <div class="button">Back to Dashboard</div>
    </a>
    <div class="generic_section generic_item_information">
        <h2 class="generic_item_header">My Work Orders</h2>
        <?php
        echo $lot_traveller_table;
        ?>
    </div>
</main>