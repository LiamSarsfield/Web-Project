<section>
    <fieldset style="width:60%; margin-left:20%;">

        <div id="container2">
            <?php echo form_open('functions/add/customer_order/' . $model_info['customer_id']); ?>
            <h1>ADD CUSTOMER ORDER</h1>
            <?php echo $model_info['labels_info']; ?>
            <?php echo form_error('date_ordered'); ?>
            <p>
                <label for="date_ordered">Date Ordered:*</label>
                <input name="date_ordered" type="text" id="name" value="<?php echo set_value('date_ordered'); ?>">
            </p>
            <p>
                <input type="submit" name="submit" id="submit" value="Submit">
            </p>
            <p>* field</p>
            </form>
        </div>
    </fieldset>
</section>
