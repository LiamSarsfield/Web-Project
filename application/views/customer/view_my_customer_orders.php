<main>
    <a href="<?php echo site_url('dashboard/home') ?>">
        <div class="button">Back to Dashboard</div>
    </a>
    <div class="generic_section generic_item_information">
        <h2 class="generic_item_header">Your Customer Orders</h2>
        <?php
        echo $table;
        ?>
    </div>
</main>