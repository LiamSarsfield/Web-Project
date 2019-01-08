<section>
    <fieldset style="width:60%; margin-left:20%;">
        <div id="container2">
            <?php echo form_open('functions/add/product'); ?>
            <h1>ADD CATEGORY</h1>
            <?php echo form_error('name'); ?>
            <p>
                <label for="name">Name</label>
                <input name="name" type="text" required id="" value="<?php echo set_value('name'); ?>">
            </p>
            <p>
                <input type="submit" name="submit" id="submit" value="Submit">
            </p>
            <p>* required field</p>
            </form>
        </div>
    </fieldset>
</section>
