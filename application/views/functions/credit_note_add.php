<section>
    <fieldset style="width:60%; margin-left:20%;">
        <div id="container2">
            <?php echo form_open('functions/add/customer_invoice/' . $model_info['customer_order_id']); ?>
            <h1>ADD CREDIT NOTE</h1>
            <?php echo $model_info['labels_info']; ?>
            <?php echo form_error('total_price'); ?>
            <p>
                <label for="total_price">Total Price:*</label>
                <input name="total_price" type="text" id="name" value="<?php echo set_value('total_price'); ?>">
            </p>
            <p>
                <input type="submit" name="submit" id="submit" value="Submit">
            </p>
            <p>* field</p>
            </form>
        </div>
    </fieldset>
</section>
