<section>
    <fieldset style="width:60%; margin-left:20%;">

        <div id="container2">
            <?php echo form_open(uri_string()); ?>

            <h1>ADD MATERIAL</h1>
            <?php echo $model_info['labels_info']; ?>
            <?php echo form_error('name'); ?>
            <p>
                <label for="name">Material Name:*</label>
                <input name="name" type="text" id="name" value="<?php echo set_value('name'); ?>">
            </p>
            <?php echo form_error('price'); ?>
            <p>
                <label for="price">price</label>
                <input name="price" type="text" id="price" value="<?php echo set_value('price'); ?>">
            </p>
            <?php echo form_error('stock_quantity'); ?>
            <p>
                <label for="stock_quantity">stock_quantity</label>
                <input name="stock_quantity" type="text" id="stock_quantity" value="<?php echo set_value('stock_quantity'); ?>">
            </p>
            <p>
                <input type="submit" name="submit" id="submit" value="Submit">
            </p>
            <p>* field</p>
            </form>
        </div>
    </fieldset>
</section>
