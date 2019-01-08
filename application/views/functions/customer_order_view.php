<main>
    <form action="<?php echo site_url() ?>/Staff/viewCustomers" class="search_product_id generic_search">
        <fieldset>
            <legend>Search Customer ID</legend>
            <div class="flex_container">
                <input type="text" class="generic_item_search_input generic_input" placeholder="Customer ID">
                <input type="image" src="<?php echo base_url(); ?>/assests/Images/search-image-icon.png" alt="Submit"
                       class="generic_search_submit"/>
            </div>
        </fieldset>
    </form>
    <table class="table_generic">
        <tbody>
        <tr>
            <th scope="col">Order ID</th>
            <th scope="col">Customer Name</th>
            <th scope="col">Date Ordered</th>
            <th scope="col">Total Price</th>
            <th scope="col">View</th>
        </tr>
        <?php foreach ($model_info as $model) { ?>
            <tr>
                <td><?php echo $model->order_id; ?></td>
                <td><?php echo $model->customer_name; ?></td>
                <td><?php echo $model->date_ordered; ?></td>
                <td><?php echo $model->total_price; ?></td>
                <td><a href="<?php echo $model->order_id; ?>">
                        <div class="button">View info</div>
                    </a></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</main>
