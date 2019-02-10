<section>
    <fieldset style="width:60%; margin-left:20%;">
        <div id="container2">
            <?php echo form_open("functions/add/lot_traveller/{$model_info['lot_traveller_id']}"); ?>
            <h1>GENERATE LOT TRAVELLER</h1>
            <?php echo $model_info['labels_info']; ?>
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
                <?php echo form_error('production_quantity'); ?>
                <label for="production_quantity">Quantity:</label>
                <input name="production_quantity" type="text" required id=""
                       value="<?php echo set_value('quantity'); ?>">
            </p>
            <p>
                <input type="submit" name="submit" id="submit" value="Submit">
            </p>
            <p>* required field</p>
            </form>
        </div>
    </fieldset>
</section>
