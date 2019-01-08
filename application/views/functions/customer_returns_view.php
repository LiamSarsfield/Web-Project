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
            <th scope="col">Customer ID</th>
            <th scope="col">Customer Name</th>
            <th scope="col">Customer Email</th>
            <th scope="col">View</th>
        </tr>
        <?php foreach ($model_info as $model) { ?>
            <tr>
                <td><?php echo $model->customer_id ?></td>
                <td><?php echo $model->customer_name ?></td>
                <td><?php echo $model->email ?></td>
                <td><a href="<?php echo site_url()?>/Staff/maintainCustomers"><div class="button">View info</div></a></td>
            </tr>
        <?php } ?>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        </tbody>
    </table>
</main>
