<section>
    <fieldset style="width:60%; margin-left:20%;">
        <div id="container2">
            <?php echo form_open(uri_string()); ?>
            <h1>ADD SUPPLIER ORDER</h1>
            <?php echo $model_info['labels_info']; ?>
            <?php echo form_error('stock_quantity'); ?>
            <p>
                <label for="order_date">order_date</label>
                <input name="order_date" type="text" id="order_date" value="<?php echo set_value('order_date'); ?>">
            </p>
            <?php echo form_error('status'); ?>
            <p>
                <label for="status">status</label>
                <input name="status" type="text" id="status" value="<?php echo set_value('status'); ?>">
            </p>
            <p>
                <input type="submit" name="submit" id="submit" value="Submit">
            </p>
            <p>* field</p>
            </form>
        </div>
    </fieldset>
</section>
