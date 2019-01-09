<section>
    <fieldset style="width:60%; margin-left:20%;">
        <div id="container2">
            <?php echo form_open('functions/add/product'); ?>
            <h1>ADD CATEGORY</h1>
            <?php echo form_error('name'); ?>
            <p>
                <label for="name">Name:</label>
                <input name="name" type="text" required id="" value="<?php echo set_value('name'); ?>"><label class="requiredfield"> * required field</label>
                </br>
                
            </p>
</br>

            <button id="submit" class="w3-button w3-light-grey w3-padding-large" type="submit">
    <i class="fa fa-paper-plane"></i> Submit
    </button>

            </form>
        </div>
    </fieldset>
</section>
