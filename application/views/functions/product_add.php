<section>
    <fieldset style="width:60%; margin-left:20%;">

        <div id="container2">
            <?php echo form_open_multipart('functions/add/product'); ?>

            <h1>ADD PRODUCT</h1>
            <?php echo $model_info['labels_info']; ?>
            <?php echo form_error('name'); ?>
            <p>
                <label for="name">Product Name:*</label>
                <input name="name" type="text" id="name" value="<?php echo set_value('name'); ?>"><label
                        class="requiredfield"> * required field</label>
            </p>
            <?php echo form_error('description'); ?>
            <p>
                <label for="description">Product Description</label>
                <textarea name="description" cols="55" rows="5" id=""
                          value="<?php echo set_value('description'); ?>"></textarea>
            </p>
            <?php echo form_error('specs'); ?>
            <p>
                <label for="specs">Product Specs</label>
                <textarea name="specs" cols="55" rows="5" id="" value="<?php echo set_value('specs'); ?>"></textarea>
            </p>
            <?php echo form_error('price'); ?>
            <p>
                <label for="price">Price €</label>
                <input name="price" type="text" id="" value="<?php echo set_value('price'); ?>">
            </p>
            <?php echo form_error('stock_quantity'); ?>
            <p>
                <label for="stock_quantity">Available Quantity</label>
                <input name="stock_quantity" type="text" id=""
                       value="<?php echo (set_value('stock_quantity') == "") ? set_value('stock_quantity') : "0"; ?>">
            </p>
            <?php echo form_error('image_path'); ?>
            <p>
                <label for="image_path">Product Picture:*</label>
                <input type="file" name="image_path" required>

            </p>

            <p>
                <button id="submit" class="w3-button w3-light-grey w3-padding-large" type="submit">
                    <i class="fa fa-paper-plane"></i> Submit
                </button>
            </p>

            </form>
        </div>
    </fieldset>
</section>
