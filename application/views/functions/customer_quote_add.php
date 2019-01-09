<section>
    <fieldset style="width:60%; margin-left:20%;">

        <div id="container2">
            <?php echo form_open('functions/add/customer_quote'); ?>

            <h1>ADD CUSTOMER QUOTE</h1>
            <?php echo $model_info['labels_info']; ?>
            <?php echo form_error('name'); ?>
            <p>
                <label for="name">Name:*</label>
                <input name="name" type="text" id="name" value="<?php echo set_value('name'); ?>">
            </p>
            <?php echo form_error('description'); ?>
            <p>
                <label for="description">Description</label>
                <textarea name="description" cols="55" rows="5" id=""
                          value="<?php echo set_value('description'); ?>"></textarea>
            </p>
            <?php echo form_error('specs'); ?>
            <p>
                <label for="specs">Specs</label>
                <textarea name="specs" cols="55" rows="5" id="" value="<?php echo set_value('specs'); ?>"></textarea>
            </p>
            <?php echo form_error('price'); ?>
            <p>
                <label for="price">Price €</label>
                <input name="price" type="text" id="" value="<?php echo set_value('price'); ?>">
            </p>
            <p>
                <input type="submit" name="submit" id="submit" value="Submit">
            </p>
            <p>* field</p>
            </form>
        </div>
    </fieldset>
</section>
