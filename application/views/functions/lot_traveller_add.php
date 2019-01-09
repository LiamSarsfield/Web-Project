<section>
    <fieldset style="width:60%; margin-left:20%;">
        <div id="container2">
            <?php echo form_open('functions/add/lot_traveller/'); ?>
            <h1>GENERATE LOT TRAVELLER</h1>
            <?php echo form_error('name'); ?>
            <p>
            <?php echo $model_info; ?>
            </p>
            <p>
                <label for="name">Status</label>
                <select name="status">
                    <option value="In Processing">In Process</option>
                    <option value="In Production">In Production</option>
                    <option value="Being Delivered">Being Delivered</option>
                    <option value="Completed">Completed</option>
                </select>
            </p>
            <p>
                <label for="quantity">Quantity:</label>
                <input name="quantity" type="text" required id="" value="<?php echo set_value('quantity'); ?>">
            </p>
            <p>
                <input type="submit" name="submit" id="submit" value="Submit">
            </p>
            <p>* required field</p>
            </form>
        </div>
    </fieldset>
</section>
