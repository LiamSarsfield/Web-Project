<main>
    <a href="<?php echo site_url() ?>/Staff/viewProducts">
        <div class="button">Back to View Product</div>
    </a>

    <?php echo form_open_multipart(site_url('Product/edit_product/' . $product_info->product_id)) ?>
    <fieldset class="generic_edit_item_form">
        <p>* is required.</p>
        <legend>Edit Product</legend>
        <div class="table_view_info">
            <h3>Category Details</h3>
            <p>
                <label name="" class="generic_item_label">Category ID: </label>
                <input name="" class="generic_input" type="text"
                       value="<?php echo $product_info->category_id ?>" readonly="readonly">
            </p>
            <p>
                <label name="category_name" class="generic_item_label">Category Name: </label>
                <input name="category_name" class="generic_input" type="text"
                       value="<?php echo $product_info->category_name ?>" readonly="readonly">
            </p>
        </div>
        <p><label name="category_id">Change Category: </label>
            <select name="category_id" class="generic_input">
                <?php foreach ($categories as $category) { ?>
                    <option value="<?php echo $category->category_id; ?>"<?php echo ($category->category_id == $product_info->category_id) ? "selected=selected" : ""; ?>><?php echo $category->name; ?></option>
                <?php } ?>
            </select>
        </p>
        <p>
            <label for="product_id">Product ID: </label>
            <input name="product_id" class="generic_input" type="text"
                   value="<?php echo $product_info->product_id ?>" readonly="readonly">
        </p>
        <p> <?php echo form_error("name"); ?></p>
        <p>
            <label for="name">Name:*</label>
            <input name="name" class="generic_input" type="text"
                   value="<?php echo (empty(set_value("name"))) ? $product_info->name : set_value("name"); ?>">
        </p>
        <p> <?php echo form_error("description"); ?></p>
        <p>
            <label for="description">Product Description:*</label>
            <input name="description" class="generic_input" type="text"
                   value="<?php echo (empty(set_value("description"))) ? $product_info->description : set_value("description"); ?>">
        </p>
        <p> <?php echo form_error("specs"); ?></p>
        <p>
            <label for="specs">Product Specs:*</label>
            <input name="specs" class="generic_input" type="text"
                   value="<?php echo (empty(set_value("specs"))) ? $product_info->specs : set_value("specs"); ?>">
        </p>
        <p> <?php echo form_error("price"); ?></p>
        <p>
            <label for="price">Price:*</label>
            <input name="price" class="generic_input" type="text"
                   value="<?php echo (empty(set_value("price"))) ? $product_info->price : set_value("price"); ?>">
        </p>
        <p> <?php echo form_error("stock_quantity"); ?></p>
        <p>
            <label for="stock_quantity">Stock Quantity:*</label>
            <input name="stock_quantity" class="generic_input" type="text"
                   value="<?php echo (empty(set_value("stock_quantity"))) ? $product_info->stock_quantity : set_value("stock_quantity"); ?>">
        </p>
        <p>
            <label>Selected Image:*</label>
            <img class="view_edit_image" src="<?php echo base_url($product_info->image_path) ?>"
                 alt="Chosen Image">
        </p>
        <p>
            <?php echo form_error("image_path"); ?>
            <label for="image_path">Change Image:</label><input type="file" id="image_path" name="image_path"
                                                                accept="image/png, image/jpeg"></p>
        <input class="button submit_button" type="submit">
    </fieldset>
    </form>
</main>
</body>
</html>
