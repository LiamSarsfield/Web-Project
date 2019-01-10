<section>
    <fieldset style="width:60%; margin-left:20%;">
        <div id="container2">
            <?php echo form_open(uri_string()); ?>
            <h1>ADD WORK ORDER</h1>
            <?php echo $model_info['labels_info']; ?>
            <?php echo form_error('status'); ?>
            <p>
                <label for="status">status</label>
                <input name="status" type="text" id="status" value="<?php echo set_value('status'); ?>">
            </p>
            <?php echo form_error('is_completed'); ?>
            <p>
                <label for="is_completed">is_completed</label>
                <input name="is_completed" type="text" id="is_completed" value="<?php echo set_value('is_completed'); ?>">
            </p>
            <p>
                <input type="submit" name="submit" id="submit" value="Submit">
            </p>
            <p>* field</p>
            </form>
        </div>
    </fieldset>
</section>
